<?php
/**
 * Quản lý Đặt Lịch Tư Vấn 1:1 (Database, 2-Step AJAX Handler & Admin Dashboard)
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * 1. Khởi tạo / Nâng cấp bảng CSDL wp_hieucon_bookings (v1.1.0 có thêm survey_data)
 */
function hieucon_setup_bookings_table( $force_verify = false ) {
    if ( ! $force_verify && get_option( 'hieucon_bookings_db_version' ) === '1.1.0' ) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';

    if ( ! $force_verify && get_option( 'hieucon_bookings_db_version' ) === '1.1.0' && $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table_name ) ) === $table_name ) {
        return;
    }

    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        booking_code varchar(30) NOT NULL,
        parent_name varchar(150) NOT NULL,
        phone varchar(30) NOT NULL,
        preferred_time varchar(150) NOT NULL,
        issue_note text DEFAULT NULL,
        survey_data longtext DEFAULT NULL,
        status varchar(30) NOT NULL DEFAULT 'pending',
        admin_note text DEFAULT NULL,
        member_id bigint(20) DEFAULT 0,
        ip_address varchar(45) DEFAULT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY status (status),
        KEY phone (phone),
        KEY created_at (created_at)
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta( $sql );

    update_option( 'hieucon_bookings_db_version', '1.1.0' );
}
add_action( 'init', 'hieucon_setup_bookings_table' );

/**
 * Đưa việc gửi email sang WP-Cron chạy nền (hẹn sau 45 giây để không kích hoạt spawn_cron hay SMTP trong lúc người dùng bấm nút)
 */
function hieucon_send_async_booking_mail( $to, $subject, $body ) {
    if ( empty( $to ) || ! is_email( $to ) ) {
        return;
    }
    wp_schedule_single_event( time() + 45, 'hieucon_cron_send_booking_mail_event', [ $to, $subject, $body, uniqid( '', true ) ] );
}

add_action( 'hieucon_cron_send_booking_mail_event', function ( $to, $subject, $body ) {
    if ( ! empty( $to ) && is_email( $to ) ) {
        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
        @wp_mail( $to, $subject, $body, $headers );
    }
}, 10, 3 );

/**
 * Lấy đường dẫn trang Khảo sát độc lập (Bước 2) có gắn thẳng mã hồ sơ
 */
function hieucon_get_booking_survey_url( $booking_id, $booking_code ) {
    $survey_slug = 'khao-sat-tu-van';
    $survey_page = get_page_by_path( $survey_slug );

    if ( ! $survey_page ) {
        $survey_id = wp_insert_post( [
            'post_title'  => 'Khảo sát tình trạng của con',
            'post_name'   => $survey_slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( ! is_wp_error( $survey_id ) && $survey_id > 0 ) {
            update_post_meta( $survey_id, '_wp_page_template', 'page-templates/template-booking-survey.php' );
            $survey_page = get_post( $survey_id );
        }
    } else {
        $tpl = get_post_meta( $survey_page->ID, '_wp_page_template', true );
        if ( 'page-templates/template-booking-survey.php' !== $tpl ) {
            update_post_meta( $survey_page->ID, '_wp_page_template', 'page-templates/template-booking-survey.php' );
        }
    }

    $base_url = $survey_page ? get_permalink( $survey_page->ID ) : home_url( '/khao-sat-tu-van/' );
    $args     = [
        'code' => sanitize_text_field( $booking_code ),
    ];
    if ( ! $survey_page && intval( $booking_id ) > 0 ) {
        $args['booking_id'] = intval( $booking_id );
        $args['step']       = 'survey';
    }
    return add_query_arg( $args, $base_url );
}

/**
 * 2A. BƯỚC 1: Xử lý AJAX Đặt lịch cơ bản (Lưu ngay thông tin liên hệ & chuyển sang trang khảo sát riêng)
 */
function hieucon_ajax_submit_booking() {
    check_ajax_referer( 'hieucon_booking_nonce', 'nonce' );

    $parent_name    = isset( $_POST['parent_name'] ) ? sanitize_text_field( wp_unslash( $_POST['parent_name'] ) ) : '';
    $phone          = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $preferred_time = isset( $_POST['preferred_time'] ) ? sanitize_text_field( wp_unslash( $_POST['preferred_time'] ) ) : '';
    $child_issues   = isset( $_POST['child_issues'] ) && is_array( $_POST['child_issues'] )
        ? array_values( array_filter( array_map( 'sanitize_text_field', wp_unslash( $_POST['child_issues'] ) ) ) )
        : [];
    $diagnosis_str  = isset( $_POST['diagnosis'] ) ? sanitize_text_field( wp_unslash( $_POST['diagnosis'] ) ) : '';
    if ( empty( $child_issues ) && ! empty( $diagnosis_str ) ) {
        $child_issues = array_values( array_filter( array_map( 'trim', explode( ',', $diagnosis_str ) ) ) );
    }
    $issues_joined  = ! empty( $child_issues ) ? implode( ', ', $child_issues ) : $diagnosis_str;

    if ( empty( $parent_name ) || empty( $phone ) ) {
        wp_send_json_error( [ 'message' => 'Vui lòng nhập đầy đủ Họ tên và Số điện thoại/Zalo của ba/mẹ.' ] );
    }

    $clean_phone = preg_replace( '/[^0-9+]/', '', $phone );
    if ( strlen( $clean_phone ) < 9 || strlen( $clean_phone ) > 15 ) {
        wp_send_json_error( [ 'message' => 'Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.' ] );
    }

    if ( empty( $preferred_time ) ) {
        $preferred_time = 'Sớm nhất có thể';
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';
    hieucon_setup_bookings_table();

    $current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
    $member_id      = $current_member ? intval( $current_member->id ) : 0;
    $ip_address     = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';
    $posted_code    = isset( $_POST['booking_code'] ) ? strtoupper( sanitize_text_field( wp_unslash( $_POST['booking_code'] ) ) ) : '';
    if ( ! empty( $posted_code ) && preg_match( '/^TV[0-9]{6}-[A-Z0-9]{4}$/', $posted_code ) ) {
        $booking_code = $posted_code;
    } else {
        $booking_code = 'TV' . wp_date( 'ymd' ) . '-' . strtoupper( wp_generate_password( 4, false, false ) );
    }

    $issue_note  = ! empty( $issues_joined ) ? ( '🩺 Vấn đề của trẻ: ' . $issues_joined ) : '';
    $survey_json = ! empty( $issues_joined ) ? wp_json_encode( [
        'diagnosis'    => $issues_joined,
        'child_issues' => $child_issues,
        'submitted_at' => current_time( 'mysql' ),
    ], JSON_UNESCAPED_UNICODE ) : null;

    $insert_data = [
        'booking_code'   => $booking_code,
        'parent_name'    => $parent_name,
        'phone'          => $phone,
        'preferred_time' => $preferred_time,
        'issue_note'     => $issue_note,
        'survey_data'    => $survey_json,
        'status'         => 'pending',
        'member_id'      => $member_id,
        'ip_address'     => $ip_address,
        'created_at'     => current_time( 'mysql' ),
    ];
    $insert_format = [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s' ];

    $inserted = $wpdb->insert( $table_name, $insert_data, $insert_format );

    if ( ! $inserted ) {
        // Phòng trường hợp bảng chưa tồn tại, tạo bảng rồi thử lại 1 lần
        hieucon_setup_bookings_table( true );
        $inserted = $wpdb->insert( $table_name, $insert_data, $insert_format );
    }

    if ( ! $inserted ) {
        wp_send_json_error( [ 'message' => 'Có lỗi xảy ra khi lưu lịch hẹn. Vui lòng thử lại hoặc nhắn trực tiếp qua Zalo.' ] );
    }

    $booking_id = intval( $wpdb->insert_id );

    // Gửi Email thông báo cho Admin ở chế độ chạy ngầm (không chặn phản hồi người dùng)
    $notify_email = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    if ( ! empty( $notify_email ) && is_email( $notify_email ) ) {
        $subject   = sprintf( '[Hiểu Con Từ Gốc] Đăng ký tư vấn 1:1 mới từ %s (%s)', $parent_name, $phone );
        $admin_url = admin_url( 'admin.php?page=hieucon-bookings' );

        $body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;">
            <div style="background: #0A1931; color: #ffffff; padding: 20px 24px;">
                <h2 style="margin: 0; font-size: 18px;">📅 Đăng Ký Tư Vấn 1:1 Mới</h2>
                <p style="margin: 4px 0 0; font-size: 13px; color: #cbd5e1;">Mã lịch hẹn: <strong>' . esc_html( $booking_code ) . '</strong></p>
            </div>
            <div style="padding: 24px; background: #ffffff; color: #1e293b; line-height: 1.6;">
                <table style="width: 100%; border-collapse: collapse; font-size: 14px;">
                    <tr>
                        <td style="padding: 8px 0; color: #64748b; width: 150px;"><strong>Họ tên ba/mẹ:</strong></td>
                        <td style="padding: 8px 0; font-weight: bold; color: #0A1931;">' . esc_html( $parent_name ) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;"><strong>SĐT / Zalo:</strong></td>
                        <td style="padding: 8px 0; font-weight: bold; color: #f97316;">' . esc_html( $phone ) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;"><strong>Vấn đề của trẻ:</strong></td>
                        <td style="padding: 8px 0; font-weight: bold; color: #c2410c;">' . esc_html( ! empty( $issues_joined ) ? $issues_joined : 'Chưa chọn' ) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;"><strong>Khung giờ hẹn:</strong></td>
                        <td style="padding: 8px 0; font-weight: bold; color: #0d9488;">' . esc_html( $preferred_time ) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;"><strong>Thời gian gửi:</strong></td>
                        <td style="padding: 8px 0;">' . esc_html( wp_date( 'H:i - d/m/Y' ) ) . '</td>
                    </tr>
                </table>
                <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f1f5f9; text-align: center;">
                    <a href="' . esc_url( $admin_url ) . '" style="display: inline-block; background: #f97316; color: #ffffff; text-decoration: none; font-weight: bold; padding: 12px 24px; border-radius: 10px; font-size: 14px;">Xem trong WP Admin</a>
                </div>
            </div>
        </div>';

        hieucon_send_async_booking_mail( $notify_email, $subject, $body );
    }

    $zalo_target = get_option( 'hieucon_link_zalo_tuvan', home_url( '/zalo' ) );

    wp_send_json_success( [
        'message'        => 'Đã lưu đăng ký! Đang chuyển sang Zalo...',
        'booking_id'     => $booking_id,
        'booking_code'   => $booking_code,
        'parent_name'    => $parent_name,
        'phone'          => $phone,
        'preferred_time' => $preferred_time,
        'diagnosis'      => $issues_joined,
        'zalo_url'       => $zalo_target,
    ] );
}
add_action( 'wp_ajax_hieucon_submit_booking', 'hieucon_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_hieucon_submit_booking', 'hieucon_ajax_submit_booking' );

/**
 * 2B. BƯỚC 2: Xử lý AJAX Lưu khảo sát chuyên sâu phục vụ tư vấn 1:1
 */
function hieucon_ajax_submit_booking_survey() {
    check_ajax_referer( 'hieucon_booking_nonce', 'nonce' );

    $booking_id     = isset( $_POST['booking_id'] ) ? intval( $_POST['booking_id'] ) : 0;
    $booking_code   = isset( $_POST['booking_code'] ) ? sanitize_text_field( wp_unslash( $_POST['booking_code'] ) ) : '';
    $parent_name    = isset( $_POST['parent_name'] ) ? sanitize_text_field( wp_unslash( $_POST['parent_name'] ) ) : '';
    $phone          = isset( $_POST['phone'] ) ? sanitize_text_field( wp_unslash( $_POST['phone'] ) ) : '';
    $preferred_time = isset( $_POST['preferred_time'] ) ? sanitize_text_field( wp_unslash( $_POST['preferred_time'] ) ) : 'Sớm nhất có thể';

    $child_name      = isset( $_POST['child_name'] ) ? sanitize_text_field( wp_unslash( $_POST['child_name'] ) ) : '';
    $child_age       = isset( $_POST['child_age'] ) ? sanitize_text_field( wp_unslash( $_POST['child_age'] ) ) : '';
    $diagnosis       = isset( $_POST['diagnosis'] ) ? sanitize_text_field( wp_unslash( $_POST['diagnosis'] ) ) : '';
    $bio_symptoms    = isset( $_POST['bio_symptoms'] ) && is_array( $_POST['bio_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['bio_symptoms'] ) ) : [];
    $behav_symptoms  = isset( $_POST['behav_symptoms'] ) && is_array( $_POST['behav_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['behav_symptoms'] ) ) : [];
    $tried_methods   = isset( $_POST['tried_methods'] ) && is_array( $_POST['tried_methods'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['tried_methods'] ) ) : [];
    $parent_goal     = isset( $_POST['parent_goal'] ) ? sanitize_textarea_field( wp_unslash( $_POST['parent_goal'] ) ) : '';

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';
    hieucon_setup_bookings_table();

    $booking_row = null;
    if ( $booking_id > 0 ) {
        $booking_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $booking_id ) );
    }
    if ( ! $booking_row && ! empty( $booking_code ) ) {
        $booking_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE booking_code = %s ORDER BY id DESC LIMIT 1", $booking_code ) );
    }
    if ( ! $booking_row && ! empty( $phone ) ) {
        $booking_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE phone = %s ORDER BY id DESC LIMIT 1", $phone ) );
    }

    // Giữ lại danh sách child_issues đã chọn ở Bước 1 (nếu có)
    $existing_issues = [];
    if ( $booking_row && ! empty( $booking_row->survey_data ) ) {
        $prev_sv = json_decode( $booking_row->survey_data, true );
        if ( is_array( $prev_sv ) && ! empty( $prev_sv['child_issues'] ) && is_array( $prev_sv['child_issues'] ) ) {
            $existing_issues = $prev_sv['child_issues'];
        }
    }

    $survey_payload = [
        'survey_completed' => true,
        'child_name'       => $child_name,
        'child_age'        => $child_age,
        'diagnosis'        => $diagnosis,
        'child_issues'     => $existing_issues,
        'bio_symptoms'     => $bio_symptoms,
        'behav_symptoms'   => $behav_symptoms,
        'tried_methods'    => $tried_methods,
        'parent_goal'      => $parent_goal,
        'submitted_at'     => current_time( 'mysql' ),
    ];

    // Tạo bản tóm tắt dễ đọc cho cột issue_note
    $summary_lines = [];
    if ( ! empty( $child_name ) || ! empty( $child_age ) ) {
        $summary_lines[] = '👶 Bé: ' . trim( $child_name . ( $child_age ? " ($child_age)" : '' ) );
    }
    if ( ! empty( $existing_issues ) ) {
        $summary_lines[] = '📌 Vấn đề chọn ban đầu: ' . implode( ', ', $existing_issues );
    }
    if ( ! empty( $diagnosis ) ) {
        $summary_lines[] = '🩺 Vấn đề nổi bật: ' . $diagnosis;
    }
    if ( ! empty( $bio_symptoms ) ) {
        $summary_lines[] = '🧬 Tiêu hoá & Ăn uống: ' . implode( ', ', $bio_symptoms );
    }
    if ( ! empty( $behav_symptoms ) ) {
        $summary_lines[] = '🔬 Bất dung nạp & Vi chất: ' . implode( ', ', $behav_symptoms );
    }
    if ( ! empty( $tried_methods ) ) {
        $summary_lines[] = '🛠️ Đã thử: ' . implode( ', ', $tried_methods );
    }
    if ( ! empty( $parent_goal ) ) {
        $summary_lines[] = '🎯 Điều muốn làm rõ: ' . $parent_goal;
    }
    $issue_summary = implode( "\n", $summary_lines );

    if ( ! $booking_row && ! empty( $phone ) ) {
        // Tạo mới nếu request Bước 1 chạy nền chưa kịp hoàn tất
        $new_code = ! empty( $booking_code ) ? $booking_code : ( 'TV' . wp_date( 'ymd' ) . '-' . strtoupper( wp_generate_password( 4, false, false ) ) );
        $wpdb->insert(
            $table_name,
            [
                'booking_code'   => $new_code,
                'parent_name'    => ! empty( $parent_name ) ? $parent_name : 'Phụ huynh',
                'phone'          => $phone,
                'preferred_time' => $preferred_time,
                'issue_note'     => $issue_summary,
                'survey_data'    => wp_json_encode( $survey_payload, JSON_UNESCAPED_UNICODE ),
                'status'         => 'pending',
                'created_at'     => current_time( 'mysql' ),
            ],
            [ '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s' ]
        );
        $booking_id  = intval( $wpdb->insert_id );
        $booking_row = $booking_id > 0 ? $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d", $booking_id ) ) : null;
    }

    if ( ! $booking_row ) {
        wp_send_json_error( [ 'message' => 'Không tìm thấy mã lịch hẹn để cập nhật khảo sát.' ] );
    }

    $booking_id   = intval( $booking_row->id );
    $booking_code = $booking_row->booking_code;

    $wpdb->update(
        $table_name,
        [
            'issue_note'  => $issue_summary,
            'survey_data' => wp_json_encode( $survey_payload, JSON_UNESCAPED_UNICODE ),
        ],
        [ 'id' => $booking_id ],
        [ '%s', '%s' ],
        [ '%d' ]
    );

    // Gửi Email bổ sung kết quả khảo sát cho Admin
    $notify_email = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    if ( ! empty( $notify_email ) && is_email( $notify_email ) ) {
        $subject   = sprintf( '[Hồ sơ Khảo sát 1:1] %s (%s) - Mã %s', $booking_row->parent_name, $booking_row->phone, $booking_code );
        $admin_url = admin_url( 'admin.php?page=hieucon-bookings' );

        $body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;">
            <div style="background: #0d9488; color: #ffffff; padding: 20px 24px;">
                <h2 style="margin: 0; font-size: 18px;">📋 Phụ Huynh Đã Hoàn Tất Khảo Sát Tư Vấn 1:1</h2>
                <p style="margin: 4px 0 0; font-size: 13px; color: #ccfbf1;">Mã lịch hẹn: <strong>' . esc_html( $booking_code ) . '</strong> — Khung giờ: <strong>' . esc_html( $booking_row->preferred_time ) . '</strong></p>
            </div>
            <div style="padding: 24px; background: #ffffff; color: #1e293b; line-height: 1.6;">
                <p style="margin-top:0;"><strong>Phụ huynh:</strong> ' . esc_html( $booking_row->parent_name ) . ' — <strong>SĐT/Zalo:</strong> <span style="color:#f97316;font-weight:bold;">' . esc_html( $booking_row->phone ) . '</span></p>
                <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:16px; font-size:14px; white-space:pre-line;">' . esc_html( $issue_summary ) . '</div>
                <div style="margin-top: 20px; text-align: center;">
                    <a href="' . esc_url( $admin_url ) . '" style="display: inline-block; background: #0A1931; color: #ffffff; text-decoration: none; font-weight: bold; padding: 12px 24px; border-radius: 10px; font-size: 14px;">Mở trang Quản lý Lịch hẹn</a>
                </div>
            </div>
        </div>';

        hieucon_send_async_booking_mail( $notify_email, $subject, $body );
    }

    wp_send_json_success( [
        'message' => 'Đã cập nhật đầy đủ hồ sơ khảo sát của bé!',
    ] );
}
add_action( 'wp_ajax_hieucon_submit_booking_survey', 'hieucon_ajax_submit_booking_survey' );
add_action( 'wp_ajax_nopriv_hieucon_submit_booking_survey', 'hieucon_ajax_submit_booking_survey' );

/**
 * 3. Đăng ký Menu Quản lý Lịch hẹn Tư vấn 1:1 trong WP Admin
 */
function hieucon_register_bookings_admin_menu() {
    global $wpdb;
    $table_name    = $wpdb->prefix . 'hieucon_bookings';
    $pending_count = 0;

    if ( $wpdb->get_var( $wpdb->prepare( 'SHOW TABLES LIKE %s', $table_name ) ) === $table_name ) {
        $pending_count = intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'pending'" ) );
    }

    $menu_label = 'Lịch Tư Vấn 1:1';
    if ( $pending_count > 0 ) {
        $menu_label .= sprintf( ' <span class="awaiting-mod">%d</span>', $pending_count );
    }

    add_menu_page(
        'Quản lý Lịch Tư Vấn 1:1',
        $menu_label,
        'manage_options',
        'hieucon-bookings',
        'hieucon_render_bookings_admin_page',
        'dashicons-calendar-alt',
        26
    );
}
add_action( 'admin_menu', 'hieucon_register_bookings_admin_menu' );

/**
 * 4. Xử lý Xuất CSV trong Admin
 */
function hieucon_handle_bookings_admin_actions() {
    if ( ! is_admin() || ! isset( $_GET['page'] ) || $_GET['page'] !== 'hieucon-bookings' ) {
        return;
    }
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';

    if ( isset( $_GET['export_csv'] ) && $_GET['export_csv'] === '1' && check_admin_referer( 'hieucon_export_bookings' ) ) {
        $rows = $wpdb->get_results( "SELECT * FROM $table_name ORDER BY created_at DESC", ARRAY_A );
        header( 'Content-Type: text/csv; charset=utf-8' );
        header( 'Content-Disposition: attachment; filename=lich-tu-van-1-1-' . wp_date( 'Y-m-d' ) . '.csv' );
        $output = fopen( 'php://output', 'w' );
        fprintf( $output, chr(0xEF) . chr(0xBB) . chr(0xBF) ); // UTF-8 BOM
        fputcsv( $output, [ 'ID', 'Mã đặt lịch', 'Họ tên ba/mẹ', 'SĐT / Zalo', 'Khung giờ mong muốn', 'Hồ sơ khảo sát & Vấn đề', 'Trạng thái', 'Ghi chú Admin', 'Thời gian đăng ký' ] );
        foreach ( $rows as $r ) {
            fputcsv( $output, [
                $r['id'],
                $r['booking_code'],
                $r['parent_name'],
                $r['phone'],
                $r['preferred_time'],
                $r['issue_note'],
                $r['status'],
                $r['admin_note'],
                $r['created_at'],
            ] );
        }
        fclose( $output );
        exit;
    }
}
add_action( 'admin_init', 'hieucon_handle_bookings_admin_actions' );

/**
 * 4B. Xử lý AJAX Cập nhật nhanh Trạng thái & Ghi chú trong Admin (Không cần tải lại trang)
 */
function hieucon_ajax_admin_update_booking() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => 'Bạn không có quyền thực hiện thao tác này.' ] );
    }
    check_ajax_referer( 'hieucon_booking_admin_nonce', 'nonce' );

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';

    $booking_id = isset( $_POST['booking_id'] ) ? intval( $_POST['booking_id'] ) : 0;
    $new_status = isset( $_POST['status'] ) ? sanitize_text_field( wp_unslash( $_POST['status'] ) ) : 'pending';
    $admin_note = isset( $_POST['admin_note'] ) ? sanitize_textarea_field( wp_unslash( $_POST['admin_note'] ) ) : '';

    if ( $booking_id <= 0 ) {
        wp_send_json_error( [ 'message' => 'ID hồ sơ không hợp lệ.' ] );
    }

    $updated = $wpdb->update(
        $table_name,
        [
            'status'     => $new_status,
            'admin_note' => $admin_note,
        ],
        [ 'id' => $booking_id ],
        [ '%s', '%s' ],
        [ '%d' ]
    );

    if ( false === $updated ) {
        wp_send_json_error( [ 'message' => 'Lỗi cơ sở dữ liệu khi lưu cập nhật.' ] );
    }

    wp_send_json_success( [
        'message'    => 'Đã lưu cập nhật hồ sơ #' . $booking_id,
        'booking_id' => $booking_id,
        'status'     => $new_status,
        'admin_note' => $admin_note,
    ] );
}
add_action( 'wp_ajax_hieucon_admin_update_booking', 'hieucon_ajax_admin_update_booking' );

/**
 * 5. Giao diện Trang Quản lý Lịch hẹn Tư vấn 1:1 (Chuẩn UX/UI CRM)
 */
function hieucon_render_bookings_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';
    hieucon_setup_bookings_table();

    $notice = '';

    if ( isset( $_POST['hieucon_save_booking_email'] ) && check_admin_referer( 'hieucon_booking_admin_action' ) ) {
        $new_email = sanitize_email( wp_unslash( $_POST['booking_notify_email'] ?? '' ) );
        update_option( 'hieucon_booking_notify_email', $new_email );
        $notice = 'Đã lưu địa chỉ email nhận thông báo khi có phụ huynh đăng ký case.';
    }

    if ( isset( $_POST['hieucon_update_booking'] ) && check_admin_referer( 'hieucon_booking_admin_action' ) ) {
        $booking_id = intval( $_POST['booking_id'] ?? 0 );
        $new_status = sanitize_text_field( wp_unslash( $_POST['status'] ?? 'pending' ) );
        $admin_note = sanitize_textarea_field( wp_unslash( $_POST['admin_note'] ?? '' ) );
        if ( $booking_id > 0 ) {
            $wpdb->update(
                $table_name,
                [ 'status' => $new_status, 'admin_note' => $admin_note ],
                [ 'id' => $booking_id ],
                [ '%s', '%s' ],
                [ '%d' ]
            );
            $notice = 'Đã cập nhật hồ sơ #' . $booking_id . '.';
        }
    }

    if ( isset( $_GET['delete_id'] ) && check_admin_referer( 'hieucon_delete_booking_' . intval( $_GET['delete_id'] ) ) ) {
        $del_id = intval( $_GET['delete_id'] );
        $wpdb->delete( $table_name, [ 'id' => $del_id ], [ '%d' ] );
        $notice = 'Đã xóa hồ sơ #' . $del_id . '.';
    }

    $filter_status = isset( $_GET['status'] ) ? sanitize_text_field( wp_unslash( $_GET['status'] ) ) : '';
    $filter_survey = isset( $_GET['survey'] ) ? sanitize_text_field( wp_unslash( $_GET['survey'] ) ) : '';
    $search_query  = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';

    $where  = 'WHERE 1=1';
    $params = [];
    if ( ! empty( $filter_status ) ) {
        $where   .= ' AND status = %s';
        $params[] = $filter_status;
    }
    if ( 'completed' === $filter_survey ) {
        $where .= " AND survey_data IS NOT NULL AND survey_data <> ''";
    } elseif ( 'step1_only' === $filter_survey ) {
        $where .= " AND (survey_data IS NULL OR survey_data = '')";
    }
    if ( ! empty( $search_query ) ) {
        $where .= ' AND (parent_name LIKE %s OR phone LIKE %s OR booking_code LIKE %s OR issue_note LIKE %s OR admin_note LIKE %s)';
        $like   = '%' . $wpdb->esc_like( $search_query ) . '%';
        array_push( $params, $like, $like, $like, $like, $like );
    }

    $sql      = "SELECT * FROM $table_name $where ORDER BY created_at DESC LIMIT 200";
    $bookings = ! empty( $params ) ? $wpdb->get_results( $wpdb->prepare( $sql, $params ) ) : $wpdb->get_results( $sql );

    $counts = [
        'all'        => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" ) ),
        'pending'    => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'pending'" ) ),
        'contacted'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'contacted'" ) ),
        'completed'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'completed'" ) ),
        'cancelled'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'cancelled'" ) ),
        'has_survey' => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE survey_data IS NOT NULL AND survey_data <> ''" ) ),
    ];

    $notify_email = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    $admin_nonce  = wp_create_nonce( 'hieucon_booking_admin_nonce' );
    $status_meta  = [
        'pending'   => [ 'label' => 'Chờ liên hệ', 'bg' => '#fff7ed', 'color' => '#c2410c', 'border' => '#fed7aa', 'dot' => '#f97316' ],
        'contacted' => [ 'label' => 'Đã liên hệ xếp lịch', 'bg' => '#eff6ff', 'color' => '#1d4ed8', 'border' => '#bfdbfe', 'dot' => '#2563eb' ],
        'completed' => [ 'label' => 'Đã trao đổi xong', 'bg' => '#ecfdf5', 'color' => '#047857', 'border' => '#a7f3d0', 'dot' => '#10b981' ],
        'cancelled' => [ 'label' => 'Đã hủy / Không phù hợp', 'bg' => '#f8fafc', 'color' => '#64748b', 'border' => '#e2e8f0', 'dot' => '#94a3b8' ],
    ];
    ?>
    <style>
        .hc-bk-wrap {
            width: auto;
            max-width: none;
            margin: 20px 24px 40px 4px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            color: #0A1931;
        }
        .hc-bk-wrap * {
            box-sizing: border-box;
        }
        /* Top Banner */
        .hc-bk-header {
            background: #0A1931;
            color: #ffffff;
            padding: 24px 30px;
            border-radius: 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 22px;
            box-shadow: 0 16px 36px -18px rgba(10, 25, 49, 0.25);
            position: relative;
            overflow: hidden;
        }
        .hc-bk-header::after {
            content: "";
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #f97316 0%, #fb923c 50%, #0A1931 100%);
        }
        .hc-bk-header h1 {
            color: #ffffff;
            margin: 0 0 6px;
            font-size: 22px;
            font-weight: 700;
            letter-spacing: -0.01em;
        }
        .hc-bk-header p {
            margin: 0;
            color: #cbd5e1;
            font-size: 13.5px;
        }
        .hc-bk-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.18s ease;
        }
        .hc-bk-btn-orange {
            background: #f97316;
            color: #ffffff !important;
        }
        .hc-bk-btn-orange:hover {
            background: #ea580c;
            color: #ffffff !important;
        }
        .hc-bk-btn-outline {
            background: rgba(255, 255, 255, 0.08);
            color: #ffffff !important;
            border-color: rgba(255, 255, 255, 0.2);
        }
        .hc-bk-btn-outline:hover {
            background: rgba(255, 255, 255, 0.16);
        }

        /* Stat Cards */
        .hc-bk-stats {
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 16px;
            margin-bottom: 20px;
        }
        @media (max-width: 1200px) {
            .hc-bk-stats {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }
        .hc-bk-stat-card {
            background: #ffffff;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            padding: 16px 20px;
            text-decoration: none;
            transition: all 0.18s ease;
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .hc-bk-stat-card:hover {
            border-color: #cbd5e1;
            transform: translateY(-1px);
            box-shadow: 0 10px 24px -14px rgba(10, 25, 49, 0.1);
        }
        .hc-bk-stat-card.is-active {
            border-color: #f97316;
            background: #fffaf5;
            box-shadow: 0 10px 25px -14px rgba(249, 115, 22, 0.22);
        }
        .hc-bk-stat-label {
            font-size: 12px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .hc-bk-stat-num {
            font-size: 28px;
            font-weight: 800;
            color: #0A1931;
            margin-top: 8px;
            line-height: 1;
        }
        .hc-bk-stat-sub {
            font-size: 11.5px;
            color: #64748b;
            margin-top: 6px;
        }

        /* Toolbar */
        .hc-bk-toolbar {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 18px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }
        .hc-bk-input,
        .hc-bk-select {
            height: 36px;
            padding: 0 12px;
            border-radius: 8px;
            border: 1px solid #cbd5e1;
            font-size: 13px;
            color: #0A1931;
            background: #f8fafc;
        }
        .hc-bk-input:focus,
        .hc-bk-select:focus {
            border-color: #f97316;
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.15);
        }

        /* Compact Data Grid Table */
        .hc-bk-table-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow-x: auto;
            box-shadow: 0 4px 16px -6px rgba(10, 25, 49, 0.05);
        }
        .hc-bk-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
            table-layout: fixed;
            min-width: 1180px;
        }
        .hc-bk-table th {
            background: #f8fafc;
            color: #475569;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 12px 14px;
            border-bottom: 1px solid #cbd5e1;
            border-right: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .hc-bk-table th:last-child {
            border-right: none;
        }
        .hc-bk-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .hc-bk-table td:last-child {
            border-right: none;
        }
        .hc-bk-table tbody tr {
            transition: background 0.12s ease;
        }
        .hc-bk-table tbody tr:hover td {
            background: #f8fafc;
        }
        .hc-bk-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Badges & Chips */
        .hc-bk-code {
            display: inline-block;
            font-family: ui-monospace, SFMono-Regular, Menlo, monospace;
            font-size: 12px;
            font-weight: 800;
            color: #0A1931;
            background: #f1f5f9;
            border: 1px solid #cbd5e1;
            padding: 2px 8px;
            border-radius: 6px;
        }
        .hc-bk-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 9px;
            border-radius: 99px;
            font-size: 11.5px;
            font-weight: 700;
            line-height: 1.2;
        }
        .hc-bk-tag {
            display: inline-block;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            color: #334155;
            border-radius: 6px;
            padding: 3px 8px;
            font-size: 12px;
            font-weight: 500;
            margin: 2px 4px 2px 0;
            white-space: normal;
        }
        .hc-bk-icon-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            height: 26px;
            padding: 0 8px;
            border-radius: 6px;
            font-size: 11px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid #cbd5e1;
            background: #ffffff;
            color: #0A1931;
            transition: all 0.15s ease;
        }
        .hc-bk-icon-btn:hover {
            border-color: #f97316;
            color: #f97316;
        }
        .hc-bk-status-select {
            height: 30px;
            padding: 0 24px 0 10px;
            border-radius: 99px;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid transparent;
            width: 100%;
            max-width: 165px;
        }

        /* Modal Pop-up */
        .hc-bk-modal-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(10, 25, 49, 0.55);
            backdrop-filter: blur(3px);
            z-index: 100000;
            display: none;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .hc-bk-modal-backdrop.is-open {
            display: flex;
        }
        .hc-bk-modal {
            background: #ffffff;
            border-radius: 18px;
            max-width: 780px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            box-shadow: 0 25px 60px -15px rgba(10, 25, 49, 0.35);
            border: 1px solid #e2e8f0;
        }
        .hc-modal-grid-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 18px;
        }
        .hc-modal-grid-table th,
        .hc-modal-grid-table td {
            padding: 11px 14px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 13px;
            text-align: left;
            vertical-align: top;
        }
        .hc-modal-grid-table th {
            width: 210px;
            background: #f8fafc;
            color: #475569;
            font-weight: 700;
            border-right: 1px solid #e2e8f0;
        }
        .hc-modal-grid-table tr:last-child th,
        .hc-modal-grid-table tr:last-child td {
            border-bottom: none;
        }
    </style>

    <div class="hc-bk-wrap">

        <!-- HEADER -->
        <div class="hc-bk-header">
            <div>
                <h1>Quản lý đăng ký case tư vấn 1:1</h1>
                <p>
                    Theo dõi danh sách phụ huynh đăng ký trao đổi 30 phút và hồ sơ khảo sát tình trạng tiêu hóa, dinh dưỡng của bé.
                </p>
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" target="_blank" class="hc-bk-btn hc-bk-btn-outline">
                    <span>Xem trang Landing</span>
                    <span>↗</span>
                </a>
                <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=hieucon-bookings&export_csv=1' ), 'hieucon_export_bookings' ) ); ?>" class="hc-bk-btn hc-bk-btn-orange">
                    <span>Xuất danh sách CSV</span>
                </a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) : ?>
            <div class="notice notice-success is-dismissible" style="margin: 0 0 18px; border-radius: 10px; border-left-color: #f97316;">
                <p><strong><?php echo esc_html( $notice ); ?></strong></p>
            </div>
        <?php endif; ?>

        <!-- KPI STAT CARDS -->
        <div class="hc-bk-stats">
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings' ) ); ?>" class="hc-bk-stat-card <?php echo ( empty( $filter_status ) && empty( $filter_survey ) ) ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span>Tổng số case</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#0A1931;"></span>
                </div>
                <div class="hc-bk-stat-num"><?php echo esc_html( $counts['all'] ); ?></div>
                <div class="hc-bk-stat-sub">Đã điền khảo sát: <strong><?php echo esc_html( $counts['has_survey'] ); ?></strong> case</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=pending' ) ); ?>" class="hc-bk-stat-card <?php echo 'pending' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#c2410c;">Chờ liên hệ</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#f97316;"></span>
                </div>
                <div class="hc-bk-stat-num" style="color:#f97316;"><?php echo esc_html( $counts['pending'] ); ?></div>
                <div class="hc-bk-stat-sub">Cần xem hồ sơ & nhắn Zalo</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=contacted' ) ); ?>" class="hc-bk-stat-card <?php echo 'contacted' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#1d4ed8;">Đã liên hệ xếp lịch</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#2563eb;"></span>
                </div>
                <div class="hc-bk-stat-num" style="color:#2563eb;"><?php echo esc_html( $counts['contacted'] ); ?></div>
                <div class="hc-bk-stat-sub">Đã hẹn khung giờ trao đổi</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=completed' ) ); ?>" class="hc-bk-stat-card <?php echo 'completed' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#047857;">Đã trao đổi xong</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#10b981;"></span>
                </div>
                <div class="hc-bk-stat-num" style="color:#047857;"><?php echo esc_html( $counts['completed'] ); ?></div>
                <div class="hc-bk-stat-sub">Hoàn tất buổi 1:1 30 phút</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&survey=step1_only' ) ); ?>" class="hc-bk-stat-card <?php echo 'step1_only' === $filter_survey ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#475569;">Chưa điền khảo sát</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#94a3b8;"></span>
                </div>
                <div class="hc-bk-stat-num" style="color:#475569;"><?php echo esc_html( max( 0, $counts['all'] - $counts['has_survey'] ) ); ?></div>
                <div class="hc-bk-stat-sub">Mới gửi SĐT ở Bước 1</div>
            </a>
        </div>

        <!-- TOOLBAR: SEARCH, FILTER & EMAIL SETTING -->
        <div class="hc-bk-toolbar">
            <form method="get" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                <input type="hidden" name="page" value="hieucon-bookings">
                <?php if ( ! empty( $filter_status ) ) : ?>
                    <input type="hidden" name="status" value="<?php echo esc_attr( $filter_status ); ?>">
                <?php endif; ?>

                <input
                    type="search"
                    name="s"
                    value="<?php echo esc_attr( $search_query ); ?>"
                    placeholder="Tìm tên ba mẹ, tên bé, SĐT, mã hồ sơ..."
                    class="hc-bk-input"
                    style="min-width: 270px;"
                >

                <select name="survey" class="hc-bk-select">
                    <option value="" <?php selected( $filter_survey, '' ); ?>>Tất cả trạng thái khảo sát</option>
                    <option value="completed" <?php selected( $filter_survey, 'completed' ); ?>>Đã hoàn tất khảo sát (Bước 2)</option>
                    <option value="step1_only" <?php selected( $filter_survey, 'step1_only' ); ?>>Mới điền liên hệ (Bước 1)</option>
                </select>

                <button type="submit" class="hc-bk-btn" style="background:#0A1931; color:#fff; height:38px; padding:0 16px;">
                    Lọc hồ sơ
                </button>

                <?php if ( ! empty( $search_query ) || ! empty( $filter_status ) || ! empty( $filter_survey ) ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings' ) ); ?>" class="hc-bk-btn" style="background:#f1f5f9; color:#475569; height:38px; padding:0 14px;">
                        Xóa bộ lọc
                    </a>
                <?php endif; ?>
            </form>

            <form method="post" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                <?php wp_nonce_field( 'hieucon_booking_admin_action' ); ?>
                <label style="font-size:12.5px; font-weight:700; color:#475569;">Email nhận thông báo:</label>
                <input
                    type="email"
                    name="booking_notify_email"
                    value="<?php echo esc_attr( $notify_email ); ?>"
                    class="hc-bk-input"
                    style="min-width: 220px;"
                >
                <button type="submit" name="hieucon_save_booking_email" value="1" class="hc-bk-btn" style="background:#f8fafc; border-color:#cbd5e1; color:#0A1931; height:38px; padding:0 14px;">
                    Lưu email
                </button>
            </form>
        </div>

        <!-- COMPACT DATA GRID TABLE -->
        <div class="hc-bk-table-card">
            <table class="hc-bk-table">
                <thead>
                    <tr>
                        <th style="width: 130px;">Mã hồ sơ</th>
                        <th style="width: 135px;">Thời gian</th>
                        <th style="width: 165px;">Phụ huynh</th>
                        <th style="width: 210px;">SĐT / Zalo</th>
                        <th style="width: 160px;">Khung giờ hẹn</th>
                        <th>Trẻ đang gặp vấn đề gì?</th>
                        <th style="width: 175px;">Trạng thái</th>
                        <th style="width: 190px;">Ghi chú phụ trách</th>
                        <th style="width: 135px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( empty( $bookings ) ) : ?>
                        <tr>
                            <td colspan="9" style="padding: 48px 20px; text-align: center; color: #64748b;">
                                <div style="font-size: 15px; font-weight: 700; color: #0A1931; margin-bottom: 4px;">Chưa có hồ sơ đăng ký nào khớp với bộ lọc</div>
                                <div style="font-size: 13px;">Khi phụ huynh gửi thông tin tại trang <code>/dat-lich-tu-van/</code>, dữ liệu sẽ hiển thị ngay tại đây.</div>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $bookings as $b ) :
                            $st               = $status_meta[ $b->status ] ?? $status_meta['pending'];
                            $clean_zalo_phone = preg_replace( '/[^0-9]/', '', $b->phone );
                            $survey           = ! empty( $b->survey_data ) ? json_decode( $b->survey_data, true ) : null;
                            $has_survey       = is_array( $survey ) && ! empty( $survey );
                            $survey_link      = hieucon_get_booking_survey_url( $b->id, $b->booking_code );

                            $symptom_count = 0;
                            if ( $has_survey ) {
                                $symptom_count = count( (array) ( $survey['bio_symptoms'] ?? [] ) ) + count( (array) ( $survey['behav_symptoms'] ?? [] ) );
                            }

                            $modal_json = wp_json_encode( [
                                'id'             => intval( $b->id ),
                                'booking_code'   => $b->booking_code,
                                'parent_name'    => $b->parent_name,
                                'phone'          => $b->phone,
                                'clean_phone'    => $clean_zalo_phone,
                                'preferred_time' => $b->preferred_time,
                                'created_at'     => wp_date( 'H:i • d/m/Y', strtotime( $b->created_at ) ),
                                'status'         => $b->status,
                                'status_label'   => $st['label'],
                                'admin_note'     => (string) $b->admin_note,
                                'has_survey'     => $has_survey,
                                'survey'         => $survey,
                                'issue_note'     => (string) $b->issue_note,
                                'survey_link'    => $survey_link,
                            ], JSON_UNESCAPED_UNICODE );
                        ?>
                        <tr id="hc-booking-row-<?php echo intval( $b->id ); ?>" data-case="<?php echo esc_attr( $modal_json ); ?>">
                            <!-- 1. Mã hồ sơ -->
                            <td>
                                <span class="hc-bk-code"><?php echo esc_html( $b->booking_code ); ?></span>
                            </td>

                            <!-- 2. Thời gian -->
                            <td style="color: #64748b; font-size: 12.5px; font-weight: 500;">
                                <?php echo esc_html( wp_date( 'H:i • d/m/Y', strtotime( $b->created_at ) ) ); ?>
                            </td>

                            <!-- 3. Phụ huynh -->
                            <td style="font-weight: 700; color: #0A1931;" title="<?php echo esc_attr( $b->parent_name ); ?>">
                                <?php echo esc_html( $b->parent_name ); ?>
                            </td>

                            <!-- 4. SĐT / Zalo -->
                            <td>
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 6px;">
                                    <span style="font-weight: 800; color: #f97316; font-size: 13px;"><?php echo esc_html( $b->phone ); ?></span>
                                    <div style="display: inline-flex; gap: 4px; shrink: 0;">
                                        <button type="button" class="hc-bk-icon-btn hc-copy-btn" data-copy="<?php echo esc_attr( $clean_zalo_phone ); ?>" title="Copy số điện thoại">
                                            Copy
                                        </button>
                                        <a href="https://zalo.me/<?php echo esc_attr( $clean_zalo_phone ); ?>" target="_blank" rel="noopener" class="hc-bk-icon-btn" style="background:#0068FF; color:#fff; border-color:#0068FF;" title="Mở chat Zalo">
                                            Zalo ↗
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- 5. Khung giờ hẹn -->
                            <td>
                                <span style="font-weight: 600; color: #0A1931; font-size: 12.5px;">
                                    <?php echo esc_html( $b->preferred_time ); ?>
                                </span>
                            </td>

                            <!-- 6. Vấn đề trẻ đang gặp phải (Gọn trên 1 dòng) -->
                            <td>
                                <?php
                                $issues_list = [];
                                if ( $has_survey && ! empty( $survey['child_issues'] ) && is_array( $survey['child_issues'] ) ) {
                                    $issues_list = $survey['child_issues'];
                                } elseif ( $has_survey && ! empty( $survey['diagnosis'] ) ) {
                                    $issues_list = array_values( array_filter( array_map( 'trim', explode( ',', $survey['diagnosis'] ) ) ) );
                                }
                                ?>
                                <?php if ( ! empty( $issues_list ) ) : ?>
                                    <div style="display: flex; align-items: center; gap: 6px; overflow: hidden;">
                                        <?php foreach ( array_slice( $issues_list, 0, 3 ) as $iss ) : ?>
                                            <span style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74; font-weight:700; font-size:11.5px; padding:2px 8px; border-radius:6px; shrink:0;">
                                                <?php echo esc_html( $iss ); ?>
                                            </span>
                                        <?php endforeach; ?>
                                        <?php if ( count( $issues_list ) > 3 ) : ?>
                                            <span style="color:#64748b; font-size:11.5px; font-weight:700;">+<?php echo intval( count( $issues_list ) - 3 ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <span style="color:#94a3b8; font-size:12px; font-style:italic;">Chưa chọn vấn đề</span>
                                <?php endif; ?>
                            </td>

                            <!-- 7. Trạng thái xử lý (Select đổi trực tiếp) -->
                            <td>
                                <select
                                    class="hc-bk-status-select hc-row-status-select"
                                    data-id="<?php echo intval( $b->id ); ?>"
                                    style="background:<?php echo esc_attr( $st['bg'] ); ?>; color:<?php echo esc_attr( $st['color'] ); ?>; border-color:<?php echo esc_attr( $st['border'] ); ?>;"
                                >
                                    <option value="pending" <?php selected( $b->status, 'pending' ); ?>>Chờ liên hệ</option>
                                    <option value="contacted" <?php selected( $b->status, 'contacted' ); ?>>Đã liên hệ xếp lịch</option>
                                    <option value="completed" <?php selected( $b->status, 'completed' ); ?>>Đã trao đổi xong</option>
                                    <option value="cancelled" <?php selected( $b->status, 'cancelled' ); ?>>Đã hủy</option>
                                </select>
                            </td>

                            <!-- 8. Ghi chú phụ trách (1 dòng gọn gàng) -->
                            <td class="hc-row-note-cell hc-open-modal-trigger" style="cursor: pointer;" title="Bấm để xem hoặc sửa ghi chú">
                                <?php if ( ! empty( $b->admin_note ) ) : ?>
                                    <span class="hc-row-note-text" style="color: #0A1931; font-size: 12.5px;"><?php echo esc_html( $b->admin_note ); ?></span>
                                <?php else : ?>
                                    <span class="hc-row-note-text" style="color: #94a3b8; font-size: 12px; font-style: italic;">+ Thêm ghi chú...</span>
                                <?php endif; ?>
                            </td>

                            <!-- 9. Thao tác -->
                            <td style="text-align: center;">
                                <div style="display: inline-flex; align-items: center; gap: 6px;">
                                    <button type="button" class="hc-bk-icon-btn hc-open-modal-trigger" style="background:#0A1931; color:#ffffff; border-color:#0A1931; padding:0 10px; height:28px;">
                                        Chi tiết
                                    </button>
                                    <a
                                        href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=hieucon-bookings&delete_id=' . intval( $b->id ) ), 'hieucon_delete_booking_' . intval( $b->id ) ) ); ?>"
                                        onclick="return confirm('Bạn có chắc muốn xóa hồ sơ này?');"
                                        class="hc-bk-icon-btn"
                                        style="color:#94a3b8; border-color:#e2e8f0; height:28px;"
                                        title="Xóa hồ sơ"
                                        onmouseover="this.style.color='#ef4444';this.style.borderColor='#fecaca';"
                                        onmouseout="this.style.color='#94a3b8';this.style.borderColor='#e2e8f0';"
                                    >
                                        ✕
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- POP-UP MODAL: XEM CHI TIẾT HỒ SƠ & CẬP NHẬT TRẠNG THÁI / GHI CHÚ -->
    <div id="hc-bk-modal-backdrop" class="hc-bk-modal-backdrop">
        <div class="hc-bk-modal">
            <div style="background:#0A1931; color:#ffffff; padding:18px 24px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #f97316;">
                <div style="display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
                    <span id="hc-modal-code" style="font-family:monospace; font-size:12.5px; background:rgba(249,115,22,0.2); color:#f97316; border:1px solid rgba(249,115,22,0.45); padding:3px 10px; border-radius:6px; font-weight:800;">TV-0000</span>
                    <h2 id="hc-modal-parent" style="color:#ffffff; margin:0; font-size:18px; font-weight:700;">Chi tiết hồ sơ đăng ký</h2>
                </div>
                <button type="button" id="hc-modal-close" style="background:rgba(255,255,255,0.12); color:#fff; border:none; width:32px; height:32px; border-radius:8px; font-size:16px; cursor:pointer;">✕</button>
            </div>

            <div style="padding:22px 24px; color:#0A1931;">
                <!-- Bảng Grid Chi tiết Hồ sơ -->
                <div id="hc-modal-body"></div>

                <!-- Khung xử lý Trạng thái & Ghi chú ngay trong Pop-up -->
                <div style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:12px; padding:16px 18px; margin-top:16px;">
                    <div style="font-size:12px; font-weight:800; text-transform:uppercase; letter-spacing:0.04em; color:#0A1931; margin-bottom:12px;">
                        Cập nhật xử lý của người phụ trách
                    </div>
                    <input type="hidden" id="hc-modal-booking-id" value="">
                    <div style="display:grid; grid-template-columns: 220px 1fr; gap:14px; align-items:start;">
                        <div>
                            <label style="display:block; font-size:12px; font-weight:700; color:#475569; margin-bottom:6px;">Trạng thái hồ sơ</label>
                            <select id="hc-modal-status" class="hc-bk-select" style="width:100%; font-weight:700; background:#ffffff;">
                                <option value="pending">Chờ liên hệ</option>
                                <option value="contacted">Đã liên hệ xếp lịch</option>
                                <option value="completed">Đã trao đổi xong</option>
                                <option value="cancelled">Đã hủy / Không phù hợp</option>
                            </select>
                        </div>
                        <div>
                            <label style="display:block; font-size:12px; font-weight:700; color:#475569; margin-bottom:6px;">Ghi chú tư vấn / Lịch hẹn</label>
                            <textarea
                                id="hc-modal-note"
                                class="hc-bk-input"
                                rows="3"
                                placeholder="Nhập ghi chú về tình trạng của bé, lịch hẹn hoặc kết quả sau buổi trao đổi..."
                                style="width:100%; height:auto; padding:8px 12px; background:#ffffff; resize:vertical;"
                            ></textarea>
                        </div>
                    </div>
                    <div style="display:flex; justify-content:flex-end; align-items:center; gap:12px; margin-top:14px;">
                        <span id="hc-modal-save-msg" style="font-size:12.5px; font-weight:700; color:#047857; display:none;">
                            ✓ Đã lưu cập nhật thành công
                        </span>
                        <button type="button" id="hc-modal-save-btn" class="hc-bk-btn hc-bk-btn-orange" style="padding:8px 20px;">
                            Lưu cập nhật hồ sơ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
        const adminNonce = '<?php echo esc_js( $admin_nonce ); ?>';

        const statusMeta = {
            pending:   { label: 'Chờ liên hệ', bg: '#fff7ed', color: '#c2410c', border: '#fed7aa' },
            contacted: { label: 'Đã liên hệ xếp lịch', bg: '#eff6ff', color: '#1d4ed8', border: '#bfdbfe' },
            completed: { label: 'Đã trao đổi xong', bg: '#ecfdf5', color: '#047857', border: '#a7f3d0' },
            cancelled: { label: 'Đã hủy', bg: '#f8fafc', color: '#64748b', border: '#e2e8f0' }
        };

        function bindCopyButtons(root) {
            (root || document).querySelectorAll('.hc-copy-btn').forEach(btn => {
                if (btn.dataset.bound) return;
                btn.dataset.bound = '1';
                btn.addEventListener('click', function (e) {
                    e.stopPropagation();
                    const text = btn.getAttribute('data-copy') || '';
                    if (!text) return;
                    const origText = btn.textContent;
                    navigator.clipboard.writeText(text).then(() => {
                        btn.textContent = '✓ Đã copy';
                        btn.style.borderColor = '#10b981';
                        btn.style.color = '#047857';
                        setTimeout(() => {
                            btn.textContent = origText;
                            btn.style.borderColor = '';
                            btn.style.color = '';
                        }, 1400);
                    });
                });
            });
        }
        bindCopyButtons(document);

        function saveBookingAjax(bookingId, newStatus, newNote, onDone) {
            const fd = new FormData();
            fd.append('action', 'hieucon_admin_update_booking');
            fd.append('nonce', adminNonce);
            fd.append('booking_id', bookingId);
            fd.append('status', newStatus);
            fd.append('admin_note', newNote);

            fetch(ajaxUrl, { method: 'POST', body: fd })
                .then(r => r.json())
                .then(res => {
                    const row = document.getElementById('hc-booking-row-' + bookingId);
                    if (row && res.success) {
                        const caseData = JSON.parse(row.getAttribute('data-case') || '{}');
                        caseData.status = newStatus;
                        caseData.admin_note = newNote;
                        row.setAttribute('data-case', JSON.stringify(caseData));

                        const rowSelect = row.querySelector('.hc-row-status-select');
                        const st = statusMeta[newStatus] || statusMeta.pending;
                        if (rowSelect) {
                            rowSelect.value = newStatus;
                            rowSelect.style.background = st.bg;
                            rowSelect.style.color = st.color;
                            rowSelect.style.borderColor = st.border;
                        }

                        const noteText = row.querySelector('.hc-row-note-text');
                        if (noteText) {
                            if (newNote.trim() !== '') {
                                noteText.textContent = newNote;
                                noteText.style.color = '#0A1931';
                                noteText.style.fontStyle = 'normal';
                            } else {
                                noteText.textContent = '+ Thêm ghi chú...';
                                noteText.style.color = '#94a3b8';
                                noteText.style.fontStyle = 'italic';
                            }
                        }
                    }
                    if (onDone) onDone(res);
                })
                .catch(() => {
                    if (onDone) onDone({ success: false });
                });
        }

        // Đổi trạng thái trực tiếp trên dòng Grid Table
        document.querySelectorAll('.hc-row-status-select').forEach(select => {
            select.addEventListener('change', function () {
                const bookingId = select.getAttribute('data-id');
                const row = document.getElementById('hc-booking-row-' + bookingId);
                const caseData = row ? JSON.parse(row.getAttribute('data-case') || '{}') : {};
                saveBookingAjax(bookingId, select.value, caseData.admin_note || '');
            });
        });

        // Mở Pop-up Chi tiết
        const modalBackdrop = document.getElementById('hc-bk-modal-backdrop');
        const modalClose = document.getElementById('hc-modal-close');
        const modalCode = document.getElementById('hc-modal-code');
        const modalParent = document.getElementById('hc-modal-parent');
        const modalBody = document.getElementById('hc-modal-body');
        const modalBookingId = document.getElementById('hc-modal-booking-id');
        const modalStatus = document.getElementById('hc-modal-status');
        const modalNote = document.getElementById('hc-modal-note');
        const modalSaveBtn = document.getElementById('hc-modal-save-btn');
        const modalSaveMsg = document.getElementById('hc-modal-save-msg');

        function renderListTags(items) {
            if (!items || !items.length) return '<span style="color:#94a3b8; font-style:italic;">Không tích chọn</span>';
            return items.map(i => '<span class="hc-bk-tag">' + i + '</span>').join('');
        }

        function openCaseModal(row) {
            const data = JSON.parse(row.getAttribute('data-case') || '{}');
            const sv = data.survey || {};

            modalCode.textContent = data.booking_code + ' • ' + data.created_at;
            modalParent.textContent = 'Phụ huynh: ' + data.parent_name;
            modalBookingId.value = data.id;
            modalStatus.value = data.status || 'pending';
            modalNote.value = data.admin_note || '';
            modalSaveMsg.style.display = 'none';

            let surveyRowsHtml = '';
            const issueTags = (sv.child_issues && sv.child_issues.length)
                ? sv.child_issues
                : (sv.diagnosis ? sv.diagnosis.split(',').map(s => s.trim()).filter(Boolean) : []);

            surveyRowsHtml = `
                <tr>
                    <th>Trẻ đang gặp vấn đề gì?</th>
                    <td>
                        ${issueTags.length
                            ? issueTags.map(t => '<span style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74; font-weight:700; padding:4px 10px; border-radius:6px; display:inline-block; margin:2px 6px 2px 0;">' + t + '</span>').join('')
                            : '<span style="color:#94a3b8; font-style:italic;">Chưa chọn vấn đề</span>'
                        }
                    </td>
                </tr>
            `;

            if (sv.bio_symptoms?.length || sv.behav_symptoms?.length || sv.tried_methods?.length || sv.parent_goal) {
                surveyRowsHtml += `
                    <tr>
                        <th>Biểu hiện ăn uống & tiêu hóa</th>
                        <td>${renderListTags(sv.bio_symptoms)}</td>
                    </tr>
                    <tr>
                        <th>Hấp thu, vi chất, giấc ngủ & hành vi</th>
                        <td>${renderListTags(sv.behav_symptoms)}</td>
                    </tr>
                    <tr>
                        <th>Hướng gia đình đã áp dụng</th>
                        <td>${renderListTags(sv.tried_methods)}</td>
                    </tr>
                    <tr>
                        <th>Điều muốn làm rõ trong 30 phút</th>
                        <td><div style="background:#fffaf5; border-left:3px solid #f97316; padding:8px 12px; border-radius:0 8px 8px 0; font-weight:600;">${sv.parent_goal || '<span style="color:#94a3b8;font-weight:400;font-style:italic;">Không có ghi chú thêm</span>'}</div></td>
                    </tr>
                `;
            }

            modalBody.innerHTML = `
                <table class="hc-modal-grid-table">
                    <tbody>
                        <tr>
                            <th>Họ tên ba/mẹ</th>
                            <td><strong style="font-size:14px;">${data.parent_name}</strong></td>
                        </tr>
                        <tr>
                            <th>Số điện thoại / Zalo</th>
                            <td>
                                <div style="display:flex; align-items:center; gap:8px; flex-wrap:wrap;">
                                    <strong style="color:#f97316; font-size:14px;">${data.phone}</strong>
                                    <button type="button" class="hc-bk-icon-btn hc-copy-btn" data-copy="${data.clean_phone}">Copy SĐT</button>
                                    <a href="https://zalo.me/${data.clean_phone}" target="_blank" rel="noopener" class="hc-bk-icon-btn" style="background:#0068FF; color:#fff; border-color:#0068FF;">Nhắn Zalo ↗</a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th>Khung giờ hẹn trao đổi</th>
                            <td><strong style="color:#0A1931;">${data.preferred_time}</strong></td>
                        </tr>
                        ${surveyRowsHtml}
                    </tbody>
                </table>
            `;

            bindCopyButtons(modalBody);
            modalBackdrop.classList.add('is-open');
        }

        document.querySelectorAll('.hc-open-modal-trigger').forEach(el => {
            el.addEventListener('click', function () {
                const row = el.closest('tr');
                if (row) openCaseModal(row);
            });
        });

        if (modalSaveBtn) {
            modalSaveBtn.addEventListener('click', function () {
                const id = modalBookingId.value;
                if (!id) return;
                modalSaveBtn.disabled = true;
                modalSaveBtn.textContent = 'Đang lưu...';
                saveBookingAjax(id, modalStatus.value, modalNote.value, function (res) {
                    modalSaveBtn.disabled = false;
                    modalSaveBtn.textContent = 'Lưu cập nhật hồ sơ';
                    if (res && res.success) {
                        modalSaveMsg.style.display = 'inline';
                        setTimeout(() => { modalSaveMsg.style.display = 'none'; }, 2200);
                    }
                });
            });
        }

        if (modalClose) {
            modalClose.addEventListener('click', () => modalBackdrop.classList.remove('is-open'));
        }
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', (e) => {
                if (e.target === modalBackdrop) modalBackdrop.classList.remove('is-open');
            });
        }
    });
    </script>
    <?php
}
