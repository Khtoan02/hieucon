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
 * Gửi email thông báo chạy ngầm sau khi đã trả JSON về trình duyệt để không làm chậm nút bấm
 */
function hieucon_send_async_booking_mail( $to, $subject, $body ) {
    if ( empty( $to ) || ! is_email( $to ) ) {
        return;
    }
    register_shutdown_function( function () use ( $to, $subject, $body ) {
        if ( function_exists( 'fastcgi_finish_request' ) ) {
            @fastcgi_finish_request();
        }
        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
        @wp_mail( $to, $subject, $body, $headers );
    } );
}

/**
 * Lấy đường dẫn trang Khảo sát độc lập (Bước 2)
 */
function hieucon_get_booking_survey_url( $booking_id, $booking_code ) {
    $survey_page = get_page_by_path( 'khao-sat-tu-van' );
    $base_url    = $survey_page ? get_permalink( $survey_page->ID ) : home_url( '/dat-lich-tu-van/' );
    $args        = [
        'booking_id' => intval( $booking_id ),
        'code'       => sanitize_text_field( $booking_code ),
    ];
    if ( ! $survey_page ) {
        $args['step'] = 'survey';
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
    $booking_code   = 'TV' . wp_date( 'ymd' ) . '-' . strtoupper( wp_generate_password( 4, false, false ) );

    $inserted = $wpdb->insert(
        $table_name,
        [
            'booking_code'   => $booking_code,
            'parent_name'    => $parent_name,
            'phone'          => $phone,
            'preferred_time' => $preferred_time,
            'status'         => 'pending',
            'member_id'      => $member_id,
            'ip_address'     => $ip_address,
            'created_at'     => current_time( 'mysql' ),
        ],
        [ '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s' ]
    );

    if ( ! $inserted ) {
        // Phòng trường hợp bảng chưa tồn tại, tạo bảng rồi thử lại 1 lần
        hieucon_setup_bookings_table( true );
        $inserted = $wpdb->insert(
            $table_name,
            [
                'booking_code'   => $booking_code,
                'parent_name'    => $parent_name,
                'phone'          => $phone,
                'preferred_time' => $preferred_time,
                'status'         => 'pending',
                'member_id'      => $member_id,
                'ip_address'     => $ip_address,
                'created_at'     => current_time( 'mysql' ),
            ],
            [ '%s', '%s', '%s', '%s', '%s', '%d', '%s', '%s' ]
        );
    }

    if ( ! $inserted ) {
        wp_send_json_error( [ 'message' => 'Có lỗi xảy ra khi lưu lịch hẹn. Vui lòng thử lại hoặc nhắn trực tiếp qua Zalo.' ] );
    }

    $booking_id = intval( $wpdb->insert_id );

    // Gửi Email thông báo Bước 1 cho Admin ở chế độ chạy ngầm (không chặn phản hồi người dùng)
    $notify_email = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    if ( ! empty( $notify_email ) && is_email( $notify_email ) ) {
        $subject   = sprintf( '[Hiểu Con Từ Gốc] Đặt lịch tư vấn 1:1 mới từ %s (%s)', $parent_name, $phone );
        $admin_url = admin_url( 'admin.php?page=hieucon-bookings' );

        $body = '
        <div style="font-family: Arial, sans-serif; max-width: 600px; margin: 0 auto; border: 1px solid #e2e8f0; border-radius: 16px; overflow: hidden;">
            <div style="background: #0A1931; color: #ffffff; padding: 20px 24px;">
                <h2 style="margin: 0; font-size: 18px;">📅 Đăng Ký Tư Vấn 1:1 Mới (Bước 1)</h2>
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
                        <td style="padding: 8px 0; color: #64748b;"><strong>Khung giờ hẹn:</strong></td>
                        <td style="padding: 8px 0; font-weight: bold; color: #0d9488;">' . esc_html( $preferred_time ) . '</td>
                    </tr>
                    <tr>
                        <td style="padding: 8px 0; color: #64748b;"><strong>Thời gian gửi:</strong></td>
                        <td style="padding: 8px 0;">' . esc_html( wp_date( 'H:i - d/m/Y' ) ) . '</td>
                    </tr>
                </table>
                <p style="font-size: 12.5px; color: #64748b; margin-top: 14px;"><em>* Phụ huynh đang tiếp tục điền phiếu khảo sát chi tiết về bé ở Bước 2.</em></p>
                <div style="margin-top: 20px; padding-top: 16px; border-top: 1px solid #f1f5f9; text-align: center;">
                    <a href="' . esc_url( $admin_url ) . '" style="display: inline-block; background: #f97316; color: #ffffff; text-decoration: none; font-weight: bold; padding: 12px 24px; border-radius: 10px; font-size: 14px;">Xem trong WP Admin</a>
                </div>
            </div>
        </div>';

        hieucon_send_async_booking_mail( $notify_email, $subject, $body );
    }

    wp_send_json_success( [
        'message'        => 'Đã lưu lịch hẹn! Đang chuyển sang trang khảo sát tình trạng của bé...',
        'booking_id'     => $booking_id,
        'booking_code'   => $booking_code,
        'parent_name'    => $parent_name,
        'phone'          => $phone,
        'preferred_time' => $preferred_time,
        'survey_url'     => hieucon_get_booking_survey_url( $booking_id, $booking_code ),
        'zalo_url'       => home_url( '/zalo' ),
    ] );
}
add_action( 'wp_ajax_hieucon_submit_booking', 'hieucon_ajax_submit_booking' );
add_action( 'wp_ajax_nopriv_hieucon_submit_booking', 'hieucon_ajax_submit_booking' );

/**
 * 2B. BƯỚC 2: Xử lý AJAX Lưu khảo sát chuyên sâu phục vụ tư vấn 1:1
 */
function hieucon_ajax_submit_booking_survey() {
    check_ajax_referer( 'hieucon_booking_nonce', 'nonce' );

    $booking_id   = isset( $_POST['booking_id'] ) ? intval( $_POST['booking_id'] ) : 0;
    $booking_code = isset( $_POST['booking_code'] ) ? sanitize_text_field( wp_unslash( $_POST['booking_code'] ) ) : '';

    if ( $booking_id <= 0 || empty( $booking_code ) ) {
        wp_send_json_error( [ 'message' => 'Không tìm thấy mã lịch hẹn để cập nhật khảo sát.' ] );
    }

    $child_name      = isset( $_POST['child_name'] ) ? sanitize_text_field( wp_unslash( $_POST['child_name'] ) ) : '';
    $child_age       = isset( $_POST['child_age'] ) ? sanitize_text_field( wp_unslash( $_POST['child_age'] ) ) : '';
    $diagnosis       = isset( $_POST['diagnosis'] ) ? sanitize_text_field( wp_unslash( $_POST['diagnosis'] ) ) : '';
    $bio_symptoms    = isset( $_POST['bio_symptoms'] ) && is_array( $_POST['bio_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['bio_symptoms'] ) ) : [];
    $behav_symptoms  = isset( $_POST['behav_symptoms'] ) && is_array( $_POST['behav_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['behav_symptoms'] ) ) : [];
    $tried_methods   = isset( $_POST['tried_methods'] ) && is_array( $_POST['tried_methods'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['tried_methods'] ) ) : [];
    $parent_goal     = isset( $_POST['parent_goal'] ) ? sanitize_textarea_field( wp_unslash( $_POST['parent_goal'] ) ) : '';

    $survey_payload = [
        'child_name'     => $child_name,
        'child_age'      => $child_age,
        'diagnosis'      => $diagnosis,
        'bio_symptoms'   => $bio_symptoms,
        'behav_symptoms' => $behav_symptoms,
        'tried_methods'  => $tried_methods,
        'parent_goal'    => $parent_goal,
        'submitted_at'   => current_time( 'mysql' ),
    ];

    // Tạo bản tóm tắt dễ đọc cho cột issue_note
    $summary_lines = [];
    if ( ! empty( $child_name ) || ! empty( $child_age ) ) {
        $summary_lines[] = '👶 Bé: ' . trim( $child_name . ( $child_age ? " ($child_age)" : '' ) );
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

    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';

    $booking_row = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d AND booking_code = %s", $booking_id, $booking_code ) );
    if ( ! $booking_row ) {
        wp_send_json_error( [ 'message' => 'Lịch hẹn không hợp lệ.' ] );
    }

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
 * 5. Giao diện Trang Quản lý Lịch hẹn Tư vấn 1:1
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
        $notice = 'Đã lưu địa chỉ Email nhận thông báo đặt lịch.';
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
            $notice = 'Đã cập nhật lịch hẹn #' . $booking_id . '.';
        }
    }

    if ( isset( $_GET['delete_id'] ) && check_admin_referer( 'hieucon_delete_booking_' . intval( $_GET['delete_id'] ) ) ) {
        $del_id = intval( $_GET['delete_id'] );
        $wpdb->delete( $table_name, [ 'id' => $del_id ], [ '%d' ] );
        $notice = 'Đã xóa lịch hẹn #' . $del_id . '.';
    }

    $filter_status = isset( $_GET['status'] ) ? sanitize_text_field( wp_unslash( $_GET['status'] ) ) : '';
    $search_query  = isset( $_GET['s'] ) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';

    $where  = 'WHERE 1=1';
    $params = [];
    if ( ! empty( $filter_status ) ) {
        $where   .= ' AND status = %s';
        $params[] = $filter_status;
    }
    if ( ! empty( $search_query ) ) {
        $where .= ' AND (parent_name LIKE %s OR phone LIKE %s OR booking_code LIKE %s OR issue_note LIKE %s)';
        $like   = '%' . $wpdb->esc_like( $search_query ) . '%';
        array_push( $params, $like, $like, $like, $like );
    }

    $sql      = "SELECT * FROM $table_name $where ORDER BY created_at DESC LIMIT 200";
    $bookings = ! empty( $params ) ? $wpdb->get_results( $wpdb->prepare( $sql, $params ) ) : $wpdb->get_results( $sql );

    $counts = [
        'all'       => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" ) ),
        'pending'   => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'pending'" ) ),
        'contacted' => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'contacted'" ) ),
        'completed' => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'completed'" ) ),
        'cancelled' => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'cancelled'" ) ),
    ];

    $notify_email  = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    $status_labels = [
        'pending'   => [ 'label' => 'Chờ liên hệ', 'bg' => '#FEF3C7', 'color' => '#B45309' ],
        'contacted' => [ 'label' => 'Đã liên hệ', 'bg' => '#DBEAFE', 'color' => '#1D4ED8' ],
        'completed' => [ 'label' => 'Đã tư vấn xong', 'bg' => '#D1FAE5', 'color' => '#047857' ],
        'cancelled' => [ 'label' => 'Đã hủy', 'bg' => '#F1F5F9', 'color' => '#64748B' ],
    ];
    ?>
    <div class="wrap" style="max-width: 1440px;">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; margin-bottom:20px; background:#0A1931; color:#fff; padding:22px 28px; border-radius:14px;">
            <div>
                <h1 style="color:#fff; margin:0 0 6px; font-size:22px; font-weight:700;">📅 Quản Lý Đặt Lịch Tư Vấn 1:1 & Hồ Sơ Khảo Sát</h1>
                <p style="margin:0; color:#cbd5e1; font-size:13.5px;">Trang đích: <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" target="_blank" style="color:#f97316; font-weight:700; text-decoration:underline;"><?php echo esc_html( home_url( '/dat-lich-tu-van/' ) ); ?> ↗</a></p>
            </div>
            <div style="display:flex; gap:10px; align-items:center;">
                <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=hieucon-bookings&export_csv=1' ), 'hieucon_export_bookings' ) ); ?>" class="button" style="background:#0d9488; color:#fff; border:none; padding:6px 16px; border-radius:8px; font-weight:600;">📥 Xuất file CSV</a>
            </div>
        </div>

        <?php if ( ! empty( $notice ) ) : ?>
            <div class="notice notice-success is-dismissible"><p><strong><?php echo esc_html( $notice ); ?></strong></p></div>
        <?php endif; ?>

        <!-- Thống kê -->
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap:14px; margin-bottom:20px;">
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings' ) ); ?>" style="text-decoration:none; background:#fff; padding:16px 20px; border-radius:12px; border:2px solid <?php echo empty( $filter_status ) ? '#0A1931' : '#e2e8f0'; ?>;">
                <div style="font-size:12px; color:#64748b; font-weight:600; text-transform:uppercase;">Tổng số đăng ký</div>
                <div style="font-size:26px; font-weight:800; color:#0A1931; margin-top:4px;"><?php echo esc_html( $counts['all'] ); ?></div>
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=pending' ) ); ?>" style="text-decoration:none; background:#fff; padding:16px 20px; border-radius:12px; border:2px solid <?php echo $filter_status === 'pending' ? '#f97316' : '#e2e8f0'; ?>;">
                <div style="font-size:12px; color:#b45309; font-weight:700; text-transform:uppercase;">⏳ Chờ liên hệ</div>
                <div style="font-size:26px; font-weight:800; color:#f97316; margin-top:4px;"><?php echo esc_html( $counts['pending'] ); ?></div>
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=contacted' ) ); ?>" style="text-decoration:none; background:#fff; padding:16px 20px; border-radius:12px; border:2px solid <?php echo $filter_status === 'contacted' ? '#2563eb' : '#e2e8f0'; ?>;">
                <div style="font-size:12px; color:#1d4ed8; font-weight:700; text-transform:uppercase;">📞 Đã liên hệ</div>
                <div style="font-size:26px; font-weight:800; color:#2563eb; margin-top:4px;"><?php echo esc_html( $counts['contacted'] ); ?></div>
            </a>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=completed' ) ); ?>" style="text-decoration:none; background:#fff; padding:16px 20px; border-radius:12px; border:2px solid <?php echo $filter_status === 'completed' ? '#0d9488' : '#e2e8f0'; ?>;">
                <div style="font-size:12px; color:#047857; font-weight:700; text-transform:uppercase;">✅ Đã tư vấn xong</div>
                <div style="font-size:26px; font-weight:800; color:#0d9488; margin-top:4px;"><?php echo esc_html( $counts['completed'] ); ?></div>
            </a>
        </div>

        <!-- Thanh công cụ Tìm kiếm & Email thông báo -->
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; background:#fff; padding:14px 20px; border-radius:12px; border:1px solid #e2e8f0; margin-bottom:20px;">
            <form method="get" style="display:flex; gap:8px; align-items:center;">
                <input type="hidden" name="page" value="hieucon-bookings">
                <?php if ( ! empty( $filter_status ) ) : ?>
                    <input type="hidden" name="status" value="<?php echo esc_attr( $filter_status ); ?>">
                <?php endif; ?>
                <input type="search" name="s" value="<?php echo esc_attr( $search_query ); ?>" placeholder="Tìm theo tên, SĐT, mã lịch, triệu chứng..." style="min-width:260px; padding:6px 12px; border-radius:8px;">
                <button type="submit" class="button button-primary">Tìm kiếm</button>
                <?php if ( ! empty( $search_query ) || ! empty( $filter_status ) ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings' ) ); ?>" class="button">Xóa lọc</a>
                <?php endif; ?>
            </form>

            <form method="post" style="display:flex; gap:8px; align-items:center;">
                <?php wp_nonce_field( 'hieucon_booking_admin_action' ); ?>
                <label style="font-size:13px; font-weight:600; color:#475569;">📧 Email nhận thông báo:</label>
                <input type="email" name="booking_notify_email" value="<?php echo esc_attr( $notify_email ); ?>" style="min-width:220px; padding:6px 10px; border-radius:8px;">
                <button type="submit" name="hieucon_save_booking_email" value="1" class="button">Lưu Email</button>
            </form>
        </div>

        <!-- Bảng Danh sách Lịch hẹn -->
        <div style="background:#fff; border-radius:12px; border:1px solid #e2e8f0; overflow-x:auto;">
            <table class="wp-list-table widefat fixed striped" style="border:none;">
                <thead>
                    <tr>
                        <th style="width:115px; font-weight:700;">Mã / Ngày</th>
                        <th style="width:190px; font-weight:700;">Phụ huynh & SĐT/Zalo</th>
                        <th style="width:155px; font-weight:700;">Khung giờ hẹn</th>
                        <th style="font-weight:700;">Hồ sơ Khảo sát của Bé (Bước 2)</th>
                        <th style="width:300px; font-weight:700;">Trạng thái & Ghi chú Tư vấn viên</th>
                        <th style="width:60px; font-weight:700; text-align:right;">Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( empty( $bookings ) ) : ?>
                        <tr>
                            <td colspan="6" style="padding:32px; text-align:center; color:#64748b;">Chưa có lịch hẹn tư vấn nào trong danh mục này.</td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $bookings as $b ) :
                            $st = $status_labels[ $b->status ] ?? $status_labels['pending'];
                            $clean_zalo_phone = preg_replace( '/[^0-9]/', '', $b->phone );
                            $survey = ! empty( $b->survey_data ) ? json_decode( $b->survey_data, true ) : null;
                        ?>
                        <tr>
                            <td>
                                <strong style="color:#0A1931; font-family:monospace; font-size:13px;"><?php echo esc_html( $b->booking_code ); ?></strong><br>
                                <span style="font-size:12px; color:#64748b;"><?php echo esc_html( wp_date( 'H:i d/m/Y', strtotime( $b->created_at ) ) ); ?></span>
                            </td>
                            <td>
                                <strong style="font-size:14px; color:#0A1931;"><?php echo esc_html( $b->parent_name ); ?></strong><br>
                                <div style="display:flex; align-items:center; gap:6px; margin-top:4px;">
                                    <a href="tel:<?php echo esc_attr( $clean_zalo_phone ); ?>" style="color:#f97316; font-weight:700; text-decoration:none; font-size:13.5px;"><?php echo esc_html( $b->phone ); ?></a>
                                    <a href="https://zalo.me/<?php echo esc_attr( $clean_zalo_phone ); ?>" target="_blank" rel="noopener" style="background:#0068FF; color:#fff; font-size:10px; font-weight:700; padding:2px 7px; border-radius:99px; text-decoration:none;">Chat Zalo ↗</a>
                                </div>
                            </td>
                            <td>
                                <span style="display:inline-block; background:#f0fdfa; color:#0f766e; border:1px solid #99f6e4; padding:4px 10px; border-radius:8px; font-weight:600; font-size:12.5px;">
                                    <?php echo esc_html( $b->preferred_time ); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ( is_array( $survey ) ) : ?>
                                    <div style="display:flex; flex-direction:column; gap:5px; font-size:12.5px; line-height:1.45;">
                                        <div>
                                            <?php if ( ! empty( $survey['child_name'] ) || ! empty( $survey['child_age'] ) ) : ?>
                                                <span style="background:#eff6ff; color:#1e40af; font-weight:700; padding:2px 8px; border-radius:6px; margin-right:4px;">
                                                    👶 <?php echo esc_html( trim( ( $survey['child_name'] ?? '' ) . ( ! empty( $survey['child_age'] ) ? ' - ' . $survey['child_age'] : '' ) ) ); ?>
                                                </span>
                                            <?php endif; ?>
                                            <?php if ( ! empty( $survey['diagnosis'] ) ) : ?>
                                                <span style="background:#fef3c7; color:#92400e; font-weight:700; padding:2px 8px; border-radius:6px;">
                                                    🩺 <?php echo esc_html( $survey['diagnosis'] ); ?>
                                                </span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ( ! empty( $survey['bio_symptoms'] ) ) : ?>
                                            <div><strong style="color:#0f766e;">🧬 Tiêu hoá & Ăn uống:</strong> <?php echo esc_html( implode( ', ', (array) $survey['bio_symptoms'] ) ); ?></div>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $survey['behav_symptoms'] ) ) : ?>
                                            <div><strong style="color:#c2410c;">🔬 Bất dung nạp & Vi chất:</strong> <?php echo esc_html( implode( ', ', (array) $survey['behav_symptoms'] ) ); ?></div>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $survey['tried_methods'] ) ) : ?>
                                            <div><strong style="color:#475569;">🛠️ Đã thử:</strong> <?php echo esc_html( implode( ', ', (array) $survey['tried_methods'] ) ); ?></div>
                                        <?php endif; ?>
                                        <?php if ( ! empty( $survey['parent_goal'] ) ) : ?>
                                            <div style="background:#f8fafc; border-left:3px solid #f97316; padding:4px 8px; color:#0A1931;">
                                                <strong>🎯 Muốn làm rõ:</strong> <?php echo esc_html( $survey['parent_goal'] ); ?>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                <?php elseif ( ! empty( $b->issue_note ) ) : ?>
                                    <div style="font-size:13px; color:#1e293b; line-height:1.5; white-space:pre-line;"><?php echo esc_html( $b->issue_note ); ?></div>
                                <?php else : ?>
                                    <em style="color:#94a3b8; font-size:12px;">Mới điền Bước 1 (Chưa điền khảo sát Bước 2)</em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <form method="post" style="display:flex; flex-direction:column; gap:6px;">
                                    <?php wp_nonce_field( 'hieucon_booking_admin_action' ); ?>
                                    <input type="hidden" name="booking_id" value="<?php echo intval( $b->id ); ?>">
                                    <div style="display:flex; gap:6px; align-items:center;">
                                        <span style="display:inline-block; padding:3px 8px; border-radius:6px; font-size:11px; font-weight:700; background:<?php echo esc_attr( $st['bg'] ); ?>; color:<?php echo esc_attr( $st['color'] ); ?>;">
                                            <?php echo esc_html( $st['label'] ); ?>
                                        </span>
                                        <select name="status" style="font-size:12px; padding:2px 24px 2px 8px; border-radius:6px;">
                                            <option value="pending" <?php selected( $b->status, 'pending' ); ?>>Chờ liên hệ</option>
                                            <option value="contacted" <?php selected( $b->status, 'contacted' ); ?>>Đã liên hệ</option>
                                            <option value="completed" <?php selected( $b->status, 'completed' ); ?>>Đã tư vấn xong</option>
                                            <option value="cancelled" <?php selected( $b->status, 'cancelled' ); ?>>Đã hủy</option>
                                        </select>
                                        <button type="submit" name="hieucon_update_booking" value="1" class="button button-small">Lưu</button>
                                    </div>
                                    <input type="text" name="admin_note" value="<?php echo esc_attr( $b->admin_note ); ?>" placeholder="Ghi chú của tư vấn viên..." style="width:100%; font-size:12px; padding:4px 8px; border-radius:6px;">
                                </form>
                            </td>
                            <td style="text-align:right;">
                                <a href="<?php echo esc_url( wp_nonce_url( admin_url( 'admin.php?page=hieucon-bookings&delete_id=' . intval( $b->id ) ), 'hieucon_delete_booking_' . intval( $b->id ) ) ); ?>" onclick="return confirm('Bạn có chắc muốn xóa lịch hẹn này?');" style="color:#ef4444; text-decoration:none; font-size:12px; font-weight:600;">Xóa</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php
}
