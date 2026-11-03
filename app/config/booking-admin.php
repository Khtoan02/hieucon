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
 * Tự động ghi nhận đúng ID trang Landing / Khảo sát ngay khi Admin chỉnh sửa trang hoặc đổi đường dẫn (slug) trên host
 */
function hieucon_sync_booking_template_page_on_save( $post_id, $post ) {
    if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
        return;
    }
    if ( ! $post || 'page' !== $post->post_type || 'publish' !== $post->post_status ) {
        return;
    }
    $tpl = get_post_meta( $post_id, '_wp_page_template', true );
    if ( 'page-templates/template-booking.php' === $tpl ) {
        update_option( 'hieucon_booking_landing_page_id', intval( $post_id ) );
    } elseif ( 'page-templates/template-booking-survey.php' === $tpl ) {
        update_option( 'hieucon_booking_survey_page_id', intval( $post_id ) );
    }
}
add_action( 'save_post_page', 'hieucon_sync_booking_template_page_on_save', 20, 2 );

/**
 * Hàm lõi tìm đúng Page đang gán Template (Ưu tiên trang đã đổi link riêng trên host, tự dọn bản trùng mặc định nếu có)
 */
function hieucon_resolve_booking_system_page( $template_file, $default_slug, $default_title, $option_id_key ) {
    // 1. Lấy tất cả các trang đang Publish có gán đúng Page Template
    $tpl_pages = get_posts( [
        'post_type'              => 'page',
        'post_status'            => 'publish',
        'meta_key'               => '_wp_page_template',
        'meta_value'             => $template_file,
        'orderby'                => [ 'modified' => 'DESC', 'ID' => 'ASC' ],
        'posts_per_page'         => 10,
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
    ] );

    $chosen_page = null;

    if ( ! empty( $tpl_pages ) ) {
        $custom_slug_pages  = [];
        $default_slug_pages = [];

        foreach ( $tpl_pages as $p ) {
            if ( $default_slug !== $p->post_name ) {
                $custom_slug_pages[] = $p;
            } else {
                $default_slug_pages[] = $p;
            }
        }

        // Nếu trên host đã đổi link sang slug khác, tuyệt đối ưu tiên trang mang link đã đổi trên host
        // Đồng thời xoá bản trùng mang slug mặc định nếu trước đó bị tự sinh thừa
        if ( ! empty( $custom_slug_pages ) ) {
            $saved_id = intval( get_option( $option_id_key, 0 ) );
            foreach ( $custom_slug_pages as $cp ) {
                if ( intval( $cp->ID ) === $saved_id ) {
                    $chosen_page = $cp;
                    break;
                }
            }
            if ( ! $chosen_page ) {
                $chosen_page = $custom_slug_pages[0];
            }

            foreach ( $default_slug_pages as $dp ) {
                if ( intval( $dp->ID ) !== intval( $chosen_page->ID ) && empty( trim( (string) $dp->post_content ) ) ) {
                    wp_delete_post( $dp->ID, true );
                }
            }
        } else {
            $chosen_page = $tpl_pages[0];
        }
    }

    // 2. Nếu chưa có trang Publish nào gắn template, kiểm tra theo ID đã lưu
    if ( ! $chosen_page ) {
        $saved_id = intval( get_option( $option_id_key, 0 ) );
        if ( $saved_id > 0 ) {
            $saved_post = get_post( $saved_id );
            if ( $saved_post && 'page' === $saved_post->post_type && 'trash' !== $saved_post->post_status ) {
                if ( 'publish' !== $saved_post->post_status ) {
                    wp_update_post( [ 'ID' => $saved_post->ID, 'post_status' => 'publish' ] );
                }
                update_post_meta( $saved_post->ID, '_wp_page_template', $template_file );
                $chosen_page = get_post( $saved_post->ID );
            }
        }
    }

    // 3. Nếu vẫn chưa tìm thấy, kiểm tra theo slug mặc định
    if ( ! $chosen_page ) {
        $by_slug = get_page_by_path( $default_slug );
        if ( $by_slug && 'trash' !== $by_slug->post_status ) {
            if ( 'publish' !== $by_slug->post_status ) {
                wp_update_post( [ 'ID' => $by_slug->ID, 'post_status' => 'publish' ] );
            }
            update_post_meta( $by_slug->ID, '_wp_page_template', $template_file );
            $chosen_page = get_post( $by_slug->ID );
        }
    }

    // 4. Chỉ khi hoàn toàn chưa có bất kỳ trang nào trên hệ thống mới tự động khởi tạo
    if ( ! $chosen_page ) {
        $new_id = wp_insert_post( [
            'post_title'  => $default_title,
            'post_name'   => $default_slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( ! is_wp_error( $new_id ) && $new_id > 0 ) {
            update_post_meta( $new_id, '_wp_page_template', $template_file );
            $chosen_page = get_post( $new_id );
        }
    }

    if ( $chosen_page ) {
        update_option( $option_id_key, intval( $chosen_page->ID ) );
    }

    return $chosen_page;
}

/**
 * Lấy đường dẫn trang Landing Đặt lịch tư vấn 1:1 (Bước 1) chuẩn theo trang thực tế đang xuất bản trên host
 */
function hieucon_get_booking_landing_url() {
    static $cached_landing_url = null;
    if ( null !== $cached_landing_url ) {
        return $cached_landing_url;
    }

    $booking_page = hieucon_resolve_booking_system_page(
        'page-templates/template-booking.php',
        'dat-lich-tu-van',
        'Đặt lịch tư vấn miễn phí 1:1',
        'hieucon_booking_landing_page_id'
    );

    $cached_landing_url = $booking_page ? get_permalink( $booking_page->ID ) : home_url( '/dat-lich-tu-van/' );
    return $cached_landing_url;
}

/**
 * Lấy đường dẫn trang Khảo sát độc lập (Bước 2) có gắn thẳng mã hồ sơ
 */
function hieucon_get_booking_survey_url( $booking_id = 0, $booking_code = '' ) {
    static $cached_survey_base_url = null;

    if ( null === $cached_survey_base_url ) {
        $survey_page = hieucon_resolve_booking_system_page(
            'page-templates/template-booking-survey.php',
            'khao-sat-tu-van',
            'Khảo sát tình trạng của con',
            'hieucon_booking_survey_page_id'
        );

        $cached_survey_base_url = $survey_page ? get_permalink( $survey_page->ID ) : home_url( '/khao-sat-tu-van/' );
    }

    if ( empty( $booking_code ) && intval( $booking_id ) <= 0 ) {
        return $cached_survey_base_url;
    }

    $args = [];
    if ( ! empty( $booking_code ) ) {
        $args['code'] = sanitize_text_field( $booking_code );
    } elseif ( intval( $booking_id ) > 0 ) {
        $args['booking_id'] = intval( $booking_id );
    }

    return add_query_arg( $args, $cached_survey_base_url );
}

/**
 * Đảm bảo nếu truy cập vào /dat-lich-tu-van/ hoặc /khao-sat-tu-van/ khi trên host đã đổi sang slug khác thì tự động chuyển hướng về đúng URL mới
 */
function hieucon_booking_routes_fallback() {
    if ( is_admin() ) {
        return;
    }
    $req_uri  = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
    $req_path = trim( (string) wp_parse_url( $req_uri, PHP_URL_PATH ), '/' );

    if ( 'dat-lich-tu-van' === $req_path || str_ends_with( $req_path, '/dat-lich-tu-van' ) ) {
        $target      = hieucon_get_booking_landing_url();
        $target_path = trim( (string) wp_parse_url( $target, PHP_URL_PATH ), '/' );
        if ( $target_path !== $req_path || is_404() ) {
            if ( ! empty( $_GET ) ) {
                $target = add_query_arg( wp_unslash( $_GET ), $target );
            }
            wp_safe_redirect( $target, 302 );
            exit;
        }
    }

    if ( 'khao-sat-tu-van' === $req_path || str_ends_with( $req_path, '/khao-sat-tu-van' ) ) {
        $target      = hieucon_get_booking_survey_url();
        $target_path = trim( (string) wp_parse_url( $target, PHP_URL_PATH ), '/' );
        if ( $target_path !== $req_path || is_404() ) {
            if ( ! empty( $_GET ) ) {
                $target = add_query_arg( wp_unslash( $_GET ), $target );
            }
            wp_safe_redirect( $target, 302 );
            exit;
        }
    }
}
add_action( 'template_redirect', 'hieucon_booking_routes_fallback', 1 );

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

    $child_name         = isset( $_POST['child_name'] ) ? sanitize_text_field( wp_unslash( $_POST['child_name'] ) ) : '';
    $child_age          = isset( $_POST['child_age'] ) ? sanitize_text_field( wp_unslash( $_POST['child_age'] ) ) : '';
    $child_gender       = isset( $_POST['child_gender'] ) ? sanitize_text_field( wp_unslash( $_POST['child_gender'] ) ) : '';
    $child_weight       = isset( $_POST['child_weight'] ) ? sanitize_text_field( wp_unslash( $_POST['child_weight'] ) ) : '';
    $child_height       = isset( $_POST['child_height'] ) ? sanitize_text_field( wp_unslash( $_POST['child_height'] ) ) : '';
    $water_amount       = isset( $_POST['water_amount'] ) ? sanitize_text_field( wp_unslash( $_POST['water_amount'] ) ) : '';
    $other_difficulties = isset( $_POST['other_difficulties'] ) ? sanitize_textarea_field( wp_unslash( $_POST['other_difficulties'] ) ) : '';
    $daily_diet         = isset( $_POST['daily_diet'] ) ? sanitize_textarea_field( wp_unslash( $_POST['daily_diet'] ) ) : '';
    $risk_level         = isset( $_POST['risk_level'] ) ? sanitize_text_field( wp_unslash( $_POST['risk_level'] ) ) : '';
    $risk_title         = isset( $_POST['risk_title'] ) ? sanitize_text_field( wp_unslash( $_POST['risk_title'] ) ) : '';
    $total_score        = isset( $_POST['total_score'] ) ? intval( $_POST['total_score'] ) : 0;

    $allergies_raw = isset( $_POST['allergies_json'] ) ? json_decode( wp_unslash( $_POST['allergies_json'] ), true ) : [];
    $allergies     = is_array( $allergies_raw ) ? array_map( 'sanitize_text_field', $allergies_raw ) : [];

    $sec2_raw = isset( $_POST['section2_json'] ) ? json_decode( wp_unslash( $_POST['section2_json'] ), true ) : [];
    $sec2_ans = is_array( $sec2_raw ) ? array_map( 'sanitize_text_field', $sec2_raw ) : [];

    $sec3_raw = isset( $_POST['section3_json'] ) ? json_decode( wp_unslash( $_POST['section3_json'] ), true ) : [];
    $sec3_ans = is_array( $sec3_raw ) ? array_map( 'sanitize_text_field', $sec3_raw ) : [];

    $sec4_raw = isset( $_POST['section4_json'] ) ? json_decode( wp_unslash( $_POST['section4_json'] ), true ) : [];
    $sec4_ans = is_array( $sec4_raw ) ? array_map( 'sanitize_text_field', $sec4_raw ) : [];

    $diagnosis      = isset( $_POST['diagnosis'] ) ? sanitize_text_field( wp_unslash( $_POST['diagnosis'] ) ) : '';
    $bio_symptoms   = isset( $_POST['bio_symptoms'] ) && is_array( $_POST['bio_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['bio_symptoms'] ) ) : [];
    $behav_symptoms = isset( $_POST['behav_symptoms'] ) && is_array( $_POST['behav_symptoms'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['behav_symptoms'] ) ) : [];
    $tried_methods  = isset( $_POST['tried_methods'] ) && is_array( $_POST['tried_methods'] ) ? array_map( 'sanitize_text_field', wp_unslash( $_POST['tried_methods'] ) ) : [];
    $parent_goal    = isset( $_POST['parent_goal'] ) ? sanitize_textarea_field( wp_unslash( $_POST['parent_goal'] ) ) : '';

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
        'survey_completed'   => true,
        'child_name'         => $child_name,
        'child_age'          => $child_age,
        'child_gender'       => $child_gender,
        'child_weight'       => $child_weight,
        'child_height'       => $child_height,
        'water_amount'       => $water_amount,
        'allergies'          => $allergies,
        'other_difficulties' => $other_difficulties,
        'daily_diet'         => $daily_diet,
        'risk_level'         => $risk_level,
        'risk_title'         => $risk_title,
        'total_score'        => $total_score,
        'section2_answers'   => $sec2_ans,
        'section3_answers'   => $sec3_ans,
        'section4_answers'   => $sec4_ans,
        'diagnosis'          => $diagnosis,
        'child_issues'       => $existing_issues,
        'bio_symptoms'       => $bio_symptoms,
        'behav_symptoms'     => $behav_symptoms,
        'tried_methods'      => $tried_methods,
        'parent_goal'        => $parent_goal,
        'submitted_at'       => current_time( 'mysql' ),
    ];

    // Tạo bản tóm tắt dễ đọc cho cột issue_note
    $summary_lines = [];
    if ( ! empty( $child_name ) || ! empty( $child_age ) ) {
        $meta_parts = array_filter( [
            $child_gender,
            $child_age,
            $child_weight ? ( $child_weight . 'kg' ) : '',
            $child_height ? ( $child_height . 'cm' ) : '',
        ] );
        $summary_lines[] = '👶 Bé: ' . trim( $child_name . ( ! empty( $meta_parts ) ? ' (' . implode( ' • ', $meta_parts ) . ')' : '' ) );
    }
    if ( ! empty( $risk_title ) ) {
        $summary_lines[] = '📊 Kết quả sàng lọc: ' . $risk_title . ' (' . $total_score . ' điểm)';
    }
    if ( ! empty( $existing_issues ) ) {
        $summary_lines[] = '📌 Vấn đề chọn ban đầu: ' . implode( ', ', $existing_issues );
    }
    if ( ! empty( $bio_symptoms ) ) {
        $summary_lines[] = '🧬 Ăn uống & Tiêu hóa: ' . implode( ' | ', $bio_symptoms );
    }
    if ( ! empty( $allergies ) ) {
        $summary_lines[] = '⚠️ Dị ứng: ' . implode( ', ', $allergies );
    }
    if ( ! empty( $water_amount ) ) {
        $summary_lines[] = '💧 Lượng nước: ' . $water_amount . ' ml/ngày';
    }
    if ( ! empty( $daily_diet ) ) {
        $summary_lines[] = '🍽️ Thực đơn 1 ngày: ' . $daily_diet;
    }
    if ( ! empty( $other_difficulties ) ) {
        $summary_lines[] = '📝 Khó khăn ăn uống khác: ' . $other_difficulties;
    }
    if ( ! empty( $tried_methods ) ) {
        $summary_lines[] = '💊 Tiền sử bổ sung: ' . implode( ' | ', $tried_methods );
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
 * Helper: Lấy thống kê số lượng hồ sơ theo trạng thái & khảo sát Bước 2
 */
function hieucon_get_booking_kpi_counts() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'hieucon_bookings';
    $survey_cond = "(survey_data LIKE '%\"survey_completed\"%' OR survey_data LIKE '%\"bio_symptoms\"%' OR survey_data LIKE '%\"behav_symptoms\"%' OR survey_data LIKE '%\"tried_methods\"%' OR survey_data LIKE '%\"parent_goal\"%' OR survey_data LIKE '%\"child_name\"%')";

    $all        = intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name" ) );
    $has_survey = intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE $survey_cond" ) );

    return [
        'all'        => $all,
        'pending'    => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'pending'" ) ),
        'contacted'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'contacted'" ) ),
        'completed'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'completed'" ) ),
        'cancelled'  => intval( $wpdb->get_var( "SELECT COUNT(*) FROM $table_name WHERE status = 'cancelled'" ) ),
        'has_survey' => $has_survey,
        'step1_only' => max( 0, $all - $has_survey ),
    ];
}

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
        'counts'     => hieucon_get_booking_kpi_counts(),
    ] );
}
add_action( 'wp_ajax_hieucon_admin_update_booking', 'hieucon_ajax_admin_update_booking' );

/**
 * 4C. Xử lý AJAX Xoá 1 hoặc nhiều hồ sơ cùng lúc trong Admin
 */
function hieucon_ajax_admin_delete_bookings() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( [ 'message' => 'Bạn không có quyền thực hiện thao tác này.' ] );
    }
    check_ajax_referer( 'hieucon_booking_admin_nonce', 'nonce' );

    $raw_ids = [];
    if ( isset( $_POST['booking_ids'] ) && is_array( $_POST['booking_ids'] ) ) {
        $raw_ids = wp_unslash( $_POST['booking_ids'] );
    } elseif ( isset( $_POST['booking_id'] ) ) {
        $raw_ids = [ wp_unslash( $_POST['booking_id'] ) ];
    }

    $ids = array_values( array_unique( array_filter( array_map( 'intval', $raw_ids ), function ( $v ) {
        return $v > 0;
    } ) ) );

    if ( empty( $ids ) ) {
        wp_send_json_error( [ 'message' => 'Chưa chọn hồ sơ nào để xoá.' ] );
    }

    global $wpdb;
    $table_name   = $wpdb->prefix . 'hieucon_bookings';
    $placeholders = implode( ',', array_fill( 0, count( $ids ), '%d' ) );
    $deleted      = $wpdb->query( $wpdb->prepare( "DELETE FROM $table_name WHERE id IN ($placeholders)", $ids ) );

    if ( false === $deleted ) {
        wp_send_json_error( [ 'message' => 'Có lỗi xảy ra khi xoá hồ sơ.' ] );
    }

    wp_send_json_success( [
        'message'     => sprintf( 'Đã xoá %d hồ sơ thành công.', count( $ids ) ),
        'deleted_ids' => $ids,
        'counts'      => hieucon_get_booking_kpi_counts(),
    ] );
}
add_action( 'wp_ajax_hieucon_admin_delete_bookings', 'hieucon_ajax_admin_delete_bookings' );

/**
 * 5. Giao diện Trang Quản lý Lịch hẹn Tư vấn 1:1 (Chuẩn UX/UI CRM - Hỗ trợ Table & Table Card, Chọn nhiều & Xoá, Copy Link Khảo sát)
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

    if ( isset( $_POST['hieucon_bulk_delete_bookings'] ) && check_admin_referer( 'hieucon_booking_admin_action' ) ) {
        $bulk_ids = isset( $_POST['bulk_ids'] ) && is_array( $_POST['bulk_ids'] )
            ? array_values( array_filter( array_map( 'intval', wp_unslash( $_POST['bulk_ids'] ) ) ) )
            : [];
        if ( ! empty( $bulk_ids ) ) {
            $placeholders = implode( ',', array_fill( 0, count( $bulk_ids ), '%d' ) );
            $wpdb->query( $wpdb->prepare( "DELETE FROM $table_name WHERE id IN ($placeholders)", $bulk_ids ) );
            $notice = sprintf( 'Đã xóa %d hồ sơ đã chọn.', count( $bulk_ids ) );
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

    $survey_sql_cond = "(survey_data LIKE '%\"survey_completed\"%' OR survey_data LIKE '%\"bio_symptoms\"%' OR survey_data LIKE '%\"behav_symptoms\"%' OR survey_data LIKE '%\"tried_methods\"%' OR survey_data LIKE '%\"parent_goal\"%' OR survey_data LIKE '%\"child_name\"%')";

    $where  = 'WHERE 1=1';
    $params = [];
    if ( ! empty( $filter_status ) ) {
        $where   .= ' AND status = %s';
        $params[] = $filter_status;
    }
    if ( 'completed' === $filter_survey ) {
        $where .= " AND $survey_sql_cond";
    } elseif ( 'step1_only' === $filter_survey ) {
        $where .= " AND NOT $survey_sql_cond";
    }
    if ( ! empty( $search_query ) ) {
        $where .= ' AND (parent_name LIKE %s OR phone LIKE %s OR booking_code LIKE %s OR issue_note LIKE %s OR admin_note LIKE %s)';
        $like   = '%' . $wpdb->esc_like( $search_query ) . '%';
        array_push( $params, $like, $like, $like, $like, $like );
    }

    $sql      = "SELECT * FROM $table_name $where ORDER BY created_at DESC LIMIT 200";
    $bookings = ! empty( $params ) ? $wpdb->get_results( $wpdb->prepare( $sql, $params ) ) : $wpdb->get_results( $sql );

    $counts       = hieucon_get_booking_kpi_counts();
    $notify_email = get_option( 'hieucon_booking_notify_email', get_option( 'admin_email' ) );
    $admin_nonce  = wp_create_nonce( 'hieucon_booking_admin_nonce' );
    $landing_url  = hieucon_get_booking_landing_url();
    $landing_path = wp_parse_url( $landing_url, PHP_URL_PATH ) ?: '/dat-lich-tu-van/';
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
            justify-content: center;
            gap: 7px;
            padding: 9px 16px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid transparent;
            transition: all 0.18s ease;
            line-height: 1.2;
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
            margin-bottom: 12px;
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

        /* View Switcher (Table vs Table Card) */
        .hc-bk-view-switcher {
            display: inline-flex;
            align-items: center;
            background: #f1f5f9;
            padding: 3px;
            border-radius: 10px;
            border: 1px solid #cbd5e1;
            gap: 2px;
        }
        .hc-view-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 32px;
            padding: 0 13px;
            border-radius: 7px;
            border: none;
            background: transparent;
            color: #475569;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.15s ease;
        }
        .hc-view-btn:hover {
            color: #0A1931;
        }
        .hc-view-btn.is-active {
            background: #0A1931;
            color: #ffffff;
            box-shadow: 0 2px 6px rgba(10, 25, 49, 0.18);
        }

        /* Bulk Selection & Delete Action Bar */
        .hc-bk-bulk-bar {
            background: #ffffff;
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 10px 18px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            transition: all 0.18s ease;
        }
        .hc-bk-bulk-bar.has-selection {
            background: #fffaf5;
            border-color: #f97316;
            box-shadow: 0 10px 24px -14px rgba(249, 115, 22, 0.25);
        }
        .hc-bk-checkbox {
            width: 17px !important;
            height: 17px !important;
            border-radius: 5px !important;
            border: 1.5px solid #94a3b8 !important;
            cursor: pointer;
            accent-color: #f97316;
            margin: 0 !important;
            vertical-align: middle;
        }
        .hc-bk-del-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            height: 28px;
            padding: 0 10px;
            border-radius: 7px;
            font-size: 11.5px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #dc2626;
            transition: all 0.15s ease;
        }
        .hc-bk-del-btn:hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }
        .hc-bulk-delete-btn {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            height: 34px;
            padding: 0 16px;
            border-radius: 8px;
            font-size: 12.5px;
            font-weight: 700;
            cursor: pointer;
            border: 1px solid #fecaca;
            background: #fef2f2;
            color: #dc2626;
            transition: all 0.16s ease;
        }
        .hc-bulk-delete-btn:not(:disabled):hover {
            background: #dc2626;
            border-color: #dc2626;
            color: #ffffff;
        }
        .hc-bulk-delete-btn:disabled {
            opacity: 0.45;
            cursor: not-allowed;
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #64748b;
        }

        /* Compact Data Grid Table */
        .hc-bk-table-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-radius: 12px;
            overflow: auto;
            max-inline-size: 100%;
            max-block-size: 76vh;
            container-type: inline-size;
            box-shadow: 0 4px 16px -6px rgba(10, 25, 49, 0.05);
        }
        .hc-bk-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            text-align: left;
            table-layout: fixed;
            min-width: 1420px;
        }
        .hc-bk-table thead {
            position: sticky;
            inset-block-start: 0;
            z-index: 2;
        }
        .hc-bk-table th {
            background: #f8fafc;
            color: #475569;
            font-size: 11.5px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            padding: 12px 12px;
            border-bottom: 1px solid #cbd5e1;
            border-right: 1px solid #e2e8f0;
            white-space: nowrap;
        }
        .hc-bk-table th:last-child {
            border-right: none;
        }
        .hc-bk-table td {
            padding: 11px 12px;
            border-bottom: 1px solid #e2e8f0;
            border-right: 1px solid #f1f5f9;
            vertical-align: middle;
            font-size: 13px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            background: #ffffff;
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
        .hc-bk-table tbody tr.is-selected td {
            background: #fff7ed;
        }
        .hc-bk-table tbody tr:last-child td {
            border-bottom: none;
        }

        /* TABLE CARD VIEW (Dạng Thẻ CRM Hiện Đại, Gọn Gàng & Trực Quan) */
        .hc-bk-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
            gap: 16px;
            align-items: stretch;
        }
        @media (max-width: 782px) {
            .hc-bk-cards-grid {
                grid-template-columns: 1fr;
            }
        }
        .hc-case-card {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            border-top: 3.5px solid #f97316;
            border-radius: 14px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 2px 10px -3px rgba(10, 25, 49, 0.05);
            transition: all 0.18s ease;
            position: relative;
            overflow: hidden;
        }
        .hc-case-card[data-status="pending"]   { border-top-color: #f97316; }
        .hc-case-card[data-status="contacted"] { border-top-color: #2563eb; }
        .hc-case-card[data-status="completed"] { border-top-color: #10b981; }
        .hc-case-card[data-status="cancelled"] { border-top-color: #94a3b8; }

        .hc-case-card:hover {
            border-color: #94a3b8;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px -12px rgba(10, 25, 49, 0.13);
        }
        .hc-case-card.is-selected {
            border-color: #f97316 !important;
            background: #fffdf9;
            box-shadow: 0 0 0 2px rgba(249, 115, 22, 0.16), 0 12px 28px -12px rgba(249, 115, 22, 0.2);
        }
        .hc-card-top {
            padding: 11px 15px;
            background: #fcfcfd;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            align-items: safe center;
            justify-content: space-between;
            gap: 8px;
        }
        .hc-card-top-left {
            display: flex;
            align-items: center;
            gap: 8px;
            min-inline-size: 0;
        }
        .hc-card-identity {
            padding: 14px 15px 12px;
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 12px;
        }
        .hc-card-avatar {
            width: 38px;
            height: 38px;
            border-radius: 10px;
            background: #fff7ed;
            border: 1px solid #fed7aa;
            color: #ea580c;
            font-size: 14px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            text-transform: uppercase;
        }
        .hc-card-parent-info {
            flex: 1;
            min-inline-size: 0;
        }
        .hc-card-parent-name {
            font-size: 15px;
            font-weight: 800;
            color: #0A1931;
            line-height: 1.3;
            margin: 0 0 4px;
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .hc-card-phone-row {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .hc-card-phone-num {
            font-size: 13.5px;
            font-weight: 800;
            color: #f97316;
            font-variant-numeric: tabular-nums;
        }
        .hc-card-meta-strip {
            margin: 0 15px 12px;
            padding: 9px 12px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 10px;
        }
        .hc-card-meta-item {
            min-inline-size: 0;
        }
        .hc-card-meta-label {
            font-size: 10px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 3px;
            display: block;
        }
        .hc-card-meta-val {
            font-size: 12px;
            font-weight: 700;
            color: #0A1931;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
        }
        .hc-card-body {
            padding: 0 15px 14px;
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .hc-card-section-label {
            font-size: 10.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            margin-bottom: 5px;
            display: block;
        }
        .hc-card-issues-wrap {
            display: flex;
            flex-wrap: wrap;
            flex-wrap: balance;
            gap: 5px;
        }
        .hc-card-note-box {
            margin-block-start: auto;
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 9px;
            padding: 8px 11px;
            font-size: 12px;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: flex-start;
            gap: 6px;
        }
        .hc-card-note-box:hover {
            border-color: #f97316;
            background: #fffaf5;
        }
        .hc-case-card-foot {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            flex-wrap: wrap;
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
        .hc-bk-survey-box {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: #fff7ed;
            border: 1px solid #fdba74;
            border-radius: 7px;
            padding: 3px 6px;
            max-width: 100%;
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
            max-width: 800px;
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
                    Theo dõi danh sách phụ huynh đăng ký trao đổi 30 phút, gửi link khảo sát kèm mã hồ sơ và quản lý trạng thái từng case.
                </p>
            </div>
            <div style="display:flex; gap:10px; align-items:center; flex-wrap:wrap;">
                <button
                    type="button"
                    class="hc-bk-btn hc-bk-btn-outline hc-copy-survey-btn"
                    data-url="<?php echo esc_attr( $landing_url ); ?>"
                    data-default-label="📋 Copy link Landing"
                    title="Sao chép đường dẫn trang Landing Đặt lịch tư vấn 1:1: <?php echo esc_attr( $landing_url ); ?>"
                >
                    <span>📋 Copy link Landing</span>
                </button>
                <a href="<?php echo esc_url( $landing_url ); ?>" target="_blank" rel="noopener noreferrer" class="hc-bk-btn hc-bk-btn-outline" title="<?php echo esc_attr( $landing_url ); ?>">
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
                <div class="hc-bk-stat-num" id="hc-stat-all"><?php echo esc_html( $counts['all'] ); ?></div>
                <div class="hc-bk-stat-sub">Đã điền khảo sát: <strong id="hc-stat-has-survey"><?php echo esc_html( $counts['has_survey'] ); ?></strong> case</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=pending' ) ); ?>" class="hc-bk-stat-card <?php echo 'pending' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#c2410c;">Chờ liên hệ</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#f97316;"></span>
                </div>
                <div class="hc-bk-stat-num" id="hc-stat-pending" style="color:#f97316;"><?php echo esc_html( $counts['pending'] ); ?></div>
                <div class="hc-bk-stat-sub">Cần xem hồ sơ & nhắn Zalo</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=contacted' ) ); ?>" class="hc-bk-stat-card <?php echo 'contacted' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#1d4ed8;">Đã liên hệ xếp lịch</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#2563eb;"></span>
                </div>
                <div class="hc-bk-stat-num" id="hc-stat-contacted" style="color:#2563eb;"><?php echo esc_html( $counts['contacted'] ); ?></div>
                <div class="hc-bk-stat-sub">Đã hẹn khung giờ trao đổi</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&status=completed' ) ); ?>" class="hc-bk-stat-card <?php echo 'completed' === $filter_status ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#047857;">Đã trao đổi xong</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#10b981;"></span>
                </div>
                <div class="hc-bk-stat-num" id="hc-stat-completed" style="color:#047857;"><?php echo esc_html( $counts['completed'] ); ?></div>
                <div class="hc-bk-stat-sub">Hoàn tất buổi 1:1 30 phút</div>
            </a>

            <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings&survey=step1_only' ) ); ?>" class="hc-bk-stat-card <?php echo 'step1_only' === $filter_survey ? 'is-active' : ''; ?>">
                <div class="hc-bk-stat-label">
                    <span style="color:#475569;">Chưa điền khảo sát</span>
                    <span style="width:8px; height:8px; border-radius:99px; background:#94a3b8;"></span>
                </div>
                <div class="hc-bk-stat-num" id="hc-stat-step1" style="color:#475569;"><?php echo esc_html( $counts['step1_only'] ); ?></div>
                <div class="hc-bk-stat-sub">Copy link khảo sát gửi phụ huynh</div>
            </a>
        </div>

        <!-- TOOLBAR: SEARCH, FILTER, VIEW SWITCHER & EMAIL SETTING -->
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
                    style="min-width: 260px;"
                >

                <select name="survey" class="hc-bk-select">
                    <option value="" <?php selected( $filter_survey, '' ); ?>>Tất cả trạng thái khảo sát</option>
                    <option value="completed" <?php selected( $filter_survey, 'completed' ); ?>>Đã hoàn tất khảo sát (Bước 2)</option>
                    <option value="step1_only" <?php selected( $filter_survey, 'step1_only' ); ?>>Chưa điền khảo sát chuyên sâu</option>
                </select>

                <button type="submit" class="hc-bk-btn" style="background:#0A1931; color:#fff; height:36px; padding:0 15px;">
                    Lọc hồ sơ
                </button>

                <?php if ( ! empty( $search_query ) || ! empty( $filter_status ) || ! empty( $filter_survey ) ) : ?>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=hieucon-bookings' ) ); ?>" class="hc-bk-btn" style="background:#f1f5f9; color:#475569; height:36px; padding:0 13px;">
                        Xóa bộ lọc
                    </a>
                <?php endif; ?>
            </form>

            <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <!-- Chuyển đổi giao diện Bảng (Table) / Thẻ trực quan (Table Card) -->
                <div class="hc-bk-view-switcher" role="group" aria-label="Chế độ hiển thị danh sách">
                    <button type="button" class="hc-view-btn is-active" data-view="table">
                        <span>☰ Dạng Bảng (Table)</span>
                    </button>
                    <button type="button" class="hc-view-btn" data-view="card">
                        <span>⊞ Dạng Thẻ (Table Card)</span>
                    </button>
                </div>

                <form method="post" style="display:flex; gap:8px; align-items:center; flex-wrap:wrap;">
                    <?php wp_nonce_field( 'hieucon_booking_admin_action' ); ?>
                    <label style="font-size:12.5px; font-weight:700; color:#475569;">Email nhận thông báo:</label>
                    <input
                        type="email"
                        name="booking_notify_email"
                        value="<?php echo esc_attr( $notify_email ); ?>"
                        class="hc-bk-input"
                        style="min-width: 210px;"
                    >
                    <button type="submit" name="hieucon_save_booking_email" value="1" class="hc-bk-btn" style="background:#f8fafc; border-color:#cbd5e1; color:#0A1931; height:36px; padding:0 14px;">
                        Lưu email
                    </button>
                </form>
            </div>
        </div>

        <!-- THANH TÍCH CHỌN HỒ SƠ & XOÁ HÀNG LOẠT -->
        <div id="hc-bk-bulk-bar" class="hc-bk-bulk-bar">
            <div style="display:flex; align-items:center; gap:14px; flex-wrap:wrap;">
                <label style="display:inline-flex; align-items:center; gap:8px; font-size:13px; font-weight:700; color:#0A1931; cursor:pointer; user-select:none;">
                    <input type="checkbox" id="hc-select-all-master" class="hc-bk-checkbox">
                    <span>Tích chọn tất cả (<span id="hc-total-visible-count"><?php echo count( $bookings ); ?></span> hồ sơ)</span>
                </label>

                <span style="height:16px; width:1px; background:#cbd5e1;"></span>

                <span style="font-size:13px; color:#475569;">
                    Đang chọn: <strong id="hc-selected-count" style="color:#f97316; font-size:14px;">0</strong> hồ sơ
                </span>

                <button type="button" id="hc-clear-selection-btn" class="hc-bk-icon-btn" style="display:none; height:28px; padding:0 10px;">
                    Bỏ chọn
                </button>
            </div>

            <div style="display:flex; align-items:center; gap:10px;">
                <button type="button" id="hc-bulk-delete-btn" class="hc-bulk-delete-btn" disabled>
                    <span>🗑 Xoá hồ sơ đã chọn (<span id="hc-bulk-del-num">0</span>)</span>
                </button>
            </div>
        </div>

        <?php
        // Chuẩn bị dữ liệu chuẩn hoá cho cả 2 giao diện (Table & Table Card)
        $prepared_items = [];
        if ( ! empty( $bookings ) ) {
            foreach ( $bookings as $b ) {
                $st               = $status_meta[ $b->status ] ?? $status_meta['pending'];
                $clean_zalo_phone = preg_replace( '/[^0-9]/', '', $b->phone );
                $survey           = ! empty( $b->survey_data ) ? json_decode( $b->survey_data, true ) : null;
                $has_any_survey   = is_array( $survey ) && ! empty( $survey );
                $is_survey_done   = is_array( $survey ) && (
                    ! empty( $survey['survey_completed'] ) ||
                    ! empty( $survey['child_name'] ) ||
                    ! empty( $survey['bio_symptoms'] ) ||
                    ! empty( $survey['behav_symptoms'] ) ||
                    ! empty( $survey['tried_methods'] ) ||
                    ! empty( $survey['parent_goal'] )
                );
                $survey_link      = hieucon_get_booking_survey_url( $b->id, $b->booking_code );

                $issues_list = [];
                if ( $has_any_survey && ! empty( $survey['child_issues'] ) && is_array( $survey['child_issues'] ) ) {
                    $issues_list = $survey['child_issues'];
                } elseif ( $has_any_survey && ! empty( $survey['diagnosis'] ) ) {
                    $issues_list = array_values( array_filter( array_map( 'trim', explode( ',', $survey['diagnosis'] ) ) ) );
                }

                $symptom_count = 0;
                if ( $is_survey_done ) {
                    $symptom_count = count( (array) ( $survey['bio_symptoms'] ?? [] ) ) + count( (array) ( $survey['behav_symptoms'] ?? [] ) );
                }

                $created_fmt = wp_date( 'H:i • d/m/Y', strtotime( $b->created_at ) );

                $modal_json = wp_json_encode( [
                    'id'             => intval( $b->id ),
                    'booking_code'   => $b->booking_code,
                    'parent_name'    => $b->parent_name,
                    'phone'          => $b->phone,
                    'clean_phone'    => $clean_zalo_phone,
                    'preferred_time' => $b->preferred_time,
                    'created_at'     => $created_fmt,
                    'status'         => $b->status,
                    'status_label'   => $st['label'],
                    'admin_note'     => (string) $b->admin_note,
                    'has_survey'     => $is_survey_done,
                    'survey'         => $survey,
                    'issues_list'    => $issues_list,
                    'issue_note'     => (string) $b->issue_note,
                    'survey_link'    => $survey_link,
                ], JSON_UNESCAPED_UNICODE );

                $prepared_items[] = [
                    'row'              => $b,
                    'id'               => intval( $b->id ),
                    'st'               => $st,
                    'clean_zalo_phone' => $clean_zalo_phone,
                    'survey'           => $survey,
                    'is_survey_done'   => $is_survey_done,
                    'survey_link'      => $survey_link,
                    'issues_list'      => $issues_list,
                    'symptom_count'    => $symptom_count,
                    'created_fmt'      => $created_fmt,
                    'modal_json'       => $modal_json,
                ];
            }
        }
        ?>

        <!-- =========================================================
             GIAO DIỆN 1: DẠNG BẢNG (COMPACT DATA GRID TABLE)
             ========================================================= -->
        <div id="hc-view-table" class="hc-bk-table-card" tabindex="0" role="region" aria-label="Bảng quản lý hồ sơ đặt lịch tư vấn 1:1">
            <table class="hc-bk-table">
                <thead>
                    <tr>
                        <th style="width: 44px; text-align: center;">
                            <input type="checkbox" id="hc-select-all-table" class="hc-bk-checkbox" title="Chọn tất cả">
                        </th>
                        <th style="width: 125px;">Mã hồ sơ</th>
                        <th style="width: 128px;">Thời gian</th>
                        <th style="width: 155px;">Phụ huynh</th>
                        <th style="width: 205px;">SĐT / Zalo</th>
                        <th style="width: 155px;">Khung giờ hẹn</th>
                        <th style="width: 220px;">Trẻ đang gặp vấn đề gì?</th>
                        <th style="width: 230px;">Đường link khảo sát</th>
                        <th style="width: 165px;">Trạng thái</th>
                        <th style="width: 170px;">Ghi chú phụ trách</th>
                        <th style="width: 150px; text-align: center;">Thao tác</th>
                    </tr>
                </thead>
                <tbody id="hc-table-tbody">
                    <?php if ( empty( $prepared_items ) ) : ?>
                        <tr>
                            <td colspan="11" style="padding: 48px 20px; text-align: center; color: #64748b;">
                                <div style="font-size: 15px; font-weight: 700; color: #0A1931; margin-bottom: 4px;">Chưa có hồ sơ đăng ký nào khớp với bộ lọc</div>
                                <div style="font-size: 13px;">Khi phụ huynh gửi thông tin tại trang <a href="<?php echo esc_url( $landing_url ); ?>" target="_blank" rel="noopener noreferrer" style="color:#f97316; font-weight:700; text-decoration:underline;"><code><?php echo esc_html( $landing_path ); ?></code> ↗</a>, dữ liệu sẽ hiển thị ngay tại đây.</div>
                            </td>
                        </tr>
                    <?php else : ?>
                        <?php foreach ( $prepared_items as $item ) :
                            $b                = $item['row'];
                            $id               = $item['id'];
                            $st               = $item['st'];
                            $clean_zalo_phone = $item['clean_zalo_phone'];
                            $is_survey_done   = $item['is_survey_done'];
                            $survey_link      = $item['survey_link'];
                            $issues_list      = $item['issues_list'];
                        ?>
                        <tr id="hc-booking-row-<?php echo esc_attr( $id ); ?>" class="hc-case-record" data-id="<?php echo esc_attr( $id ); ?>" data-case="<?php echo esc_attr( $item['modal_json'] ); ?>">
                            <!-- 0. Checkbox chọn hồ sơ -->
                            <td style="text-align: center;">
                                <input type="checkbox" class="hc-bk-checkbox hc-case-checkbox" value="<?php echo esc_attr( $id ); ?>" aria-label="Chọn hồ sơ <?php echo esc_attr( $b->booking_code ); ?>">
                            </td>

                            <!-- 1. Mã hồ sơ -->
                            <td>
                                <span class="hc-bk-code"><?php echo esc_html( $b->booking_code ); ?></span>
                            </td>

                            <!-- 2. Thời gian -->
                            <td style="color: #64748b; font-size: 12.5px; font-weight: 500;">
                                <?php echo esc_html( $item['created_fmt'] ); ?>
                            </td>

                            <!-- 3. Phụ huynh -->
                            <td style="font-weight: 700; color: #0A1931;" title="<?php echo esc_attr( $b->parent_name ); ?>">
                                <?php echo esc_html( $b->parent_name ); ?>
                            </td>

                            <!-- 4. SĐT / Zalo -->
                            <td>
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 6px;">
                                    <span style="font-weight: 800; color: #f97316; font-size: 13px;"><?php echo esc_html( $b->phone ); ?></span>
                                    <div style="display: inline-flex; gap: 4px; flex-shrink: 0;">
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
                                <span style="font-weight: 600; color: #0A1931; font-size: 12.5px;" title="<?php echo esc_attr( $b->preferred_time ); ?>">
                                    <?php echo esc_html( $b->preferred_time ); ?>
                                </span>
                            </td>

                            <!-- 6. Vấn đề trẻ đang gặp phải -->
                            <td>
                                <?php if ( ! empty( $issues_list ) ) : ?>
                                    <div style="display: flex; align-items: center; gap: 5px; overflow: hidden;">
                                        <?php foreach ( array_slice( $issues_list, 0, 2 ) as $iss ) : ?>
                                            <span style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74; font-weight:700; font-size:11.5px; padding:2px 7px; border-radius:6px; flex-shrink:0;">
                                                <?php echo esc_html( $iss ); ?>
                                            </span>
                                        <?php endforeach; ?>
                                        <?php if ( count( $issues_list ) > 2 ) : ?>
                                            <span style="color:#64748b; font-size:11.5px; font-weight:700;">+<?php echo intval( count( $issues_list ) - 2 ); ?></span>
                                        <?php endif; ?>
                                    </div>
                                <?php else : ?>
                                    <span style="color:#94a3b8; font-size:12px; font-style:italic;">Chưa chọn vấn đề</span>
                                <?php endif; ?>
                            </td>

                            <!-- 7. Đường link khảo sát (Có gắn mã hồ sơ) -->
                            <td>
                                <div style="display: flex; align-items: center; justify-content: space-between; gap: 5px;">
                                    <span
                                        class="hc-bk-pill"
                                        style="<?php echo $is_survey_done ? 'background:#ecfdf5; color:#047857; border:1px solid #a7f3d0;' : 'background:#f8fafc; color:#475569; border:1px solid #cbd5e1;'; ?> font-size:11px; padding:2px 7px;"
                                        title="<?php echo esc_attr( $survey_link ); ?>"
                                    >
                                        <?php echo $is_survey_done ? '✓ Đã điền' : '⏳ Chờ điền'; ?>
                                    </span>
                                    <div style="display: inline-flex; align-items: center; gap: 4px; flex-shrink: 0;">
                                        <button
                                            type="button"
                                            class="hc-bk-icon-btn hc-copy-btn"
                                            data-copy="<?php echo esc_attr( $survey_link ); ?>"
                                            style="background:#fff7ed; color:#c2410c; border-color:#fdba74; font-weight:700;"
                                            title="Copy đường link khảo sát có gắn mã <?php echo esc_attr( $b->booking_code ); ?>"
                                        >
                                            📋 Copy link
                                        </button>
                                        <a
                                            href="<?php echo esc_url( $survey_link ); ?>"
                                            target="_blank"
                                            rel="noopener"
                                            class="hc-bk-icon-btn"
                                            title="Truy cập trực tiếp trang khảo sát của mã <?php echo esc_attr( $b->booking_code ); ?>"
                                        >
                                            Mở ↗
                                        </a>
                                    </div>
                                </div>
                            </td>

                            <!-- 8. Trạng thái xử lý -->
                            <td>
                                <select
                                    class="hc-bk-status-select hc-row-status-select"
                                    data-id="<?php echo esc_attr( $id ); ?>"
                                    style="background:<?php echo esc_attr( $st['bg'] ); ?>; color:<?php echo esc_attr( $st['color'] ); ?>; border-color:<?php echo esc_attr( $st['border'] ); ?>;"
                                >
                                    <option value="pending" <?php selected( $b->status, 'pending' ); ?>>Chờ liên hệ</option>
                                    <option value="contacted" <?php selected( $b->status, 'contacted' ); ?>>Đã liên hệ xếp lịch</option>
                                    <option value="completed" <?php selected( $b->status, 'completed' ); ?>>Đã trao đổi xong</option>
                                    <option value="cancelled" <?php selected( $b->status, 'cancelled' ); ?>>Đã hủy</option>
                                </select>
                            </td>

                            <!-- 9. Ghi chú phụ trách -->
                            <td class="hc-row-note-cell hc-open-modal-trigger" data-id="<?php echo esc_attr( $id ); ?>" style="cursor: pointer;" title="Bấm để xem hoặc sửa ghi chú">
                                <?php if ( ! empty( $b->admin_note ) ) : ?>
                                    <span class="hc-row-note-text" style="color: #0A1931; font-size: 12.5px;"><?php echo esc_html( $b->admin_note ); ?></span>
                                <?php else : ?>
                                    <span class="hc-row-note-text" style="color: #94a3b8; font-size: 12px; font-style: italic;">+ Thêm ghi chú...</span>
                                <?php endif; ?>
                            </td>

                            <!-- 10. Thao tác (Chi tiết + Nút Xoá rõ ràng) -->
                            <td style="text-align: center;">
                                <div style="display: inline-flex; align-items: center; gap: 6px;">
                                    <button type="button" class="hc-bk-icon-btn hc-open-modal-trigger" data-id="<?php echo esc_attr( $id ); ?>" style="background:#0A1931; color:#ffffff; border-color:#0A1931; padding:0 10px; height:28px;">
                                        Chi tiết
                                    </button>
                                    <button
                                        type="button"
                                        class="hc-bk-del-btn hc-single-delete-btn"
                                        data-id="<?php echo esc_attr( $id ); ?>"
                                        data-code="<?php echo esc_attr( $b->booking_code ); ?>"
                                        title="Xoá hồ sơ <?php echo esc_attr( $b->booking_code ); ?>"
                                    >
                                        🗑 Xoá
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- =========================================================
             GIAO DIỆN 2: DẠNG THẺ TRỰC QUAN (TABLE CARD VIEW)
             ========================================================= -->
        <div id="hc-view-card" style="display: none;">
            <?php if ( empty( $prepared_items ) ) : ?>
                <div style="background:#ffffff; border:1px solid #cbd5e1; border-radius:14px; padding:48px 20px; text-align:center; color:#64748b;">
                    <div style="font-size:15px; font-weight:700; color:#0A1931; margin-bottom:4px;">Chưa có hồ sơ đăng ký nào khớp với bộ lọc</div>
                    <div style="font-size:13px;">Khi phụ huynh gửi thông tin tại trang <a href="<?php echo esc_url( $landing_url ); ?>" target="_blank" rel="noopener noreferrer" style="color:#f97316; font-weight:700; text-decoration:underline;"><code><?php echo esc_html( $landing_path ); ?></code> ↗</a>, dữ liệu sẽ hiển thị ngay tại đây.</div>
                </div>
            <?php else : ?>
                <div class="hc-bk-cards-grid" id="hc-cards-container">
                    <?php foreach ( $prepared_items as $item ) :
                        $b                = $item['row'];
                        $id               = $item['id'];
                        $st               = $item['st'];
                        $clean_zalo_phone = $item['clean_zalo_phone'];
                        $survey           = $item['survey'];
                        $is_survey_done   = $item['is_survey_done'];
                        $survey_link      = $item['survey_link'];
                        $issues_list      = $item['issues_list'];

                        // Lấy chữ cái đầu của tên phụ huynh làm Avatar
                        $name_words = preg_split( '/\s+/u', trim( (string) $b->parent_name ), -1, PREG_SPLIT_NO_EMPTY );
                        $initials   = 'PH';
                        if ( ! empty( $name_words ) ) {
                            $last_word = end( $name_words );
                            $first_word = reset( $name_words );
                            $initials = ( count( $name_words ) > 1 )
                                ? mb_substr( $first_word, 0, 1, 'UTF-8' ) . mb_substr( $last_word, 0, 1, 'UTF-8' )
                                : mb_substr( $last_word, 0, 2, 'UTF-8' );
                        }
                    ?>
                    <div id="hc-booking-card-<?php echo esc_attr( $id ); ?>" class="hc-case-card" data-id="<?php echo esc_attr( $id ); ?>" data-status="<?php echo esc_attr( $b->status ); ?>">
                        <!-- 1. Thanh tiêu đề gọn: Checkbox + Mã hồ sơ + Thời gian + Select Trạng thái -->
                        <div class="hc-card-top">
                            <div class="hc-card-top-left">
                                <input type="checkbox" class="hc-bk-checkbox hc-case-checkbox" value="<?php echo esc_attr( $id ); ?>" aria-label="Chọn hồ sơ <?php echo esc_attr( $b->booking_code ); ?>">
                                <span class="hc-bk-code"><?php echo esc_html( $b->booking_code ); ?></span>
                                <span style="font-size:11.5px; color:#64748b; font-weight:500; white-space:nowrap;">
                                    <?php echo esc_html( $item['created_fmt'] ); ?>
                                </span>
                            </div>

                            <select
                                class="hc-bk-status-select hc-row-status-select"
                                data-id="<?php echo esc_attr( $id ); ?>"
                                style="background:<?php echo esc_attr( $st['bg'] ); ?>; color:<?php echo esc_attr( $st['color'] ); ?>; border-color:<?php echo esc_attr( $st['border'] ); ?>; max-width:152px; height:28px; font-size:11.5px;"
                            >
                                <option value="pending" <?php selected( $b->status, 'pending' ); ?>>Chờ liên hệ</option>
                                <option value="contacted" <?php selected( $b->status, 'contacted' ); ?>>Đã liên hệ xếp lịch</option>
                                <option value="completed" <?php selected( $b->status, 'completed' ); ?>>Đã trao đổi xong</option>
                                <option value="cancelled" <?php selected( $b->status, 'cancelled' ); ?>>Đã hủy</option>
                            </select>
                        </div>

                        <!-- 2. Khối thông tin Phụ huynh & SĐT/Zalo -->
                        <div class="hc-card-identity">
                            <div style="display:flex; align-items:flex-start; gap:11px; min-inline-size:0; flex:1;">
                                <div class="hc-card-avatar"><?php echo esc_html( $initials ); ?></div>
                                <div class="hc-card-parent-info">
                                    <div class="hc-card-parent-name">
                                        <span style="overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo esc_html( $b->parent_name ); ?></span>
                                        <?php if ( $is_survey_done && ( ! empty( $survey['child_name'] ) || ! empty( $survey['child_age'] ) ) ) : ?>
                                            <span style="font-size:11px; color:#475569; background:#f1f5f9; border:1px solid #e2e8f0; padding:1px 7px; border-radius:6px; font-weight:600;">
                                                👶 <?php echo esc_html( trim( ( $survey['child_name'] ?? '' ) . ( ! empty( $survey['child_age'] ) ? ' • ' . $survey['child_age'] : '' ) ) ); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="hc-card-phone-row">
                                        <span class="hc-card-phone-num"><?php echo esc_html( $b->phone ); ?></span>
                                        <button type="button" class="hc-bk-icon-btn hc-copy-btn" data-copy="<?php echo esc_attr( $clean_zalo_phone ); ?>" style="height:23px; padding:0 7px; font-size:10.5px;">
                                            Copy SĐT
                                        </button>
                                        <a href="https://zalo.me/<?php echo esc_attr( $clean_zalo_phone ); ?>" target="_blank" rel="noopener" class="hc-bk-icon-btn" style="background:#0068FF; color:#fff; border-color:#0068FF; height:23px; padding:0 8px; font-size:10.5px;">
                                            Zalo ↗
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 3. Khung giờ hẹn & Trạng thái khảo sát (2 cột cân đối) -->
                        <div class="hc-card-meta-strip">
                            <div class="hc-card-meta-item" style="border-right:1px solid #e2e8f0; padding-right:8px;">
                                <span class="hc-card-meta-label">Khung giờ hẹn</span>
                                <span class="hc-card-meta-val" title="<?php echo esc_attr( $b->preferred_time ); ?>">
                                    🗓 <?php echo esc_html( $b->preferred_time ); ?>
                                </span>
                            </div>
                            <div class="hc-card-meta-item" style="padding-left:2px;">
                                <span class="hc-card-meta-label">Khảo sát Bước 2</span>
                                <?php if ( $is_survey_done ) : ?>
                                    <span class="hc-card-meta-val" style="color:#047857;">
                                        ✓ Đã hoàn tất<?php echo $item['symptom_count'] > 0 ? ' (' . intval( $item['symptom_count'] ) . ' mục)' : ''; ?>
                                    </span>
                                <?php else : ?>
                                    <span class="hc-card-meta-val" style="color:#64748b; font-weight:600;">
                                        ⏳ Chờ điền khảo sát
                                    </span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 4. Vấn đề của trẻ & Ghi chú phụ trách -->
                        <div class="hc-card-body">
                            <div>
                                <span class="hc-card-section-label">Vấn đề trẻ đang gặp phải</span>
                                <?php if ( ! empty( $issues_list ) ) : ?>
                                    <div class="hc-card-issues-wrap">
                                        <?php foreach ( $issues_list as $iss ) : ?>
                                            <span style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74; font-weight:700; font-size:11.5px; padding:3px 9px; border-radius:6px; line-height:1.25;">
                                                <?php echo esc_html( $iss ); ?>
                                            </span>
                                        <?php endforeach; ?>
                                    </div>
                                <?php else : ?>
                                    <span style="color:#94a3b8; font-size:12px; font-style:italic;">Chưa chọn vấn đề</span>
                                <?php endif; ?>

                                <?php if ( $is_survey_done && ! empty( $survey['parent_goal'] ) ) : ?>
                                    <div style="margin-top:8px; background:#fffaf5; border-left:3px solid #f97316; padding:6px 10px; border-radius:0 6px 6px 0; font-size:12px; color:#334155; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                        <strong>🎯 Mong muốn:</strong> <?php echo esc_html( $survey['parent_goal'] ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Ô Ghi chú phụ trách (Bấm để sửa nhanh) -->
                            <div class="hc-card-note-box hc-open-modal-trigger" data-id="<?php echo esc_attr( $id ); ?>" title="Bấm để xem hoặc cập nhật ghi chú phụ trách">
                                <span style="font-size:12px; line-height:1.3;">📝</span>
                                <?php if ( ! empty( $b->admin_note ) ) : ?>
                                    <span class="hc-row-note-text" style="color:#0A1931; font-size:12px; line-height:1.4; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;"><?php echo esc_html( $b->admin_note ); ?></span>
                                <?php else : ?>
                                    <span class="hc-row-note-text" style="color:#94a3b8; font-size:12px; font-style:italic; line-height:1.4;">+ Thêm ghi chú phụ trách...</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- 5. Card Footer: Nút Copy Link Khảo Sát + Chi tiết + Xoá -->
                        <div class="hc-case-card-foot">
                            <div style="display:inline-flex; align-items:center; gap:5px;">
                                <button
                                    type="button"
                                    class="hc-bk-icon-btn hc-copy-btn"
                                    data-copy="<?php echo esc_attr( $survey_link ); ?>"
                                    style="background:#fff7ed; color:#c2410c; border-color:#fdba74; font-weight:700; height:28px; padding:0 10px; font-size:11.5px;"
                                    title="Copy đường link khảo sát: <?php echo esc_attr( $survey_link ); ?>"
                                >
                                    📋 Copy link khảo sát
                                </button>
                                <a
                                    href="<?php echo esc_url( $survey_link ); ?>"
                                    target="_blank"
                                    rel="noopener"
                                    class="hc-bk-icon-btn"
                                    style="height:28px; padding:0 8px; font-size:11.5px;"
                                    title="Mở trực tiếp trang khảo sát của mã <?php echo esc_attr( $b->booking_code ); ?>"
                                >
                                    Mở ↗
                                </a>
                            </div>

                            <div style="display:inline-flex; align-items:center; gap:6px;">
                                <button type="button" class="hc-bk-icon-btn hc-open-modal-trigger" data-id="<?php echo esc_attr( $id ); ?>" style="background:#0A1931; color:#ffffff; border-color:#0A1931; height:28px; padding:0 11px; font-size:11.5px;">
                                    Chi tiết
                                </button>
                                <button
                                    type="button"
                                    class="hc-bk-del-btn hc-single-delete-btn"
                                    data-id="<?php echo esc_attr( $id ); ?>"
                                    data-code="<?php echo esc_attr( $b->booking_code ); ?>"
                                    style="height:28px; padding:0 10px; font-size:11.5px;"
                                    title="Xoá hồ sơ <?php echo esc_attr( $b->booking_code ); ?>"
                                >
                                    🗑 Xoá
                                </button>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
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
                    <input type="hidden" id="hc-modal-booking-code-raw" value="">
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
                    <div style="display:flex; justify-content:space-between; align-items:center; gap:12px; margin-top:14px; flex-wrap:wrap;">
                        <button type="button" id="hc-modal-delete-btn" class="hc-bk-del-btn" style="height:36px; padding:0 14px; font-size:12.5px;">
                            🗑 Xoá hồ sơ này
                        </button>
                        <div style="display:flex; align-items:center; gap:12px;">
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

        // 1. Chuyển đổi chế độ hiển thị: Table vs Table Card (Lưu vào localStorage)
        const viewButtons = document.querySelectorAll('.hc-view-btn');
        const viewTable = document.getElementById('hc-view-table');
        const viewCard = document.getElementById('hc-view-card');

        function setViewMode(mode) {
            const targetMode = (mode === 'card') ? 'card' : 'table';
            viewButtons.forEach(btn => {
                btn.classList.toggle('is-active', btn.getAttribute('data-view') === targetMode);
            });
            if (viewTable && viewCard) {
                viewTable.style.display = (targetMode === 'table') ? 'block' : 'none';
                viewCard.style.display  = (targetMode === 'card') ? 'block' : 'none';
            }
            try {
                localStorage.setItem('hc_bookings_view_mode', targetMode);
            } catch (e) {}
        }

        viewButtons.forEach(btn => {
            btn.addEventListener('click', function () {
                setViewMode(btn.getAttribute('data-view'));
            });
        });

        try {
            const savedView = localStorage.getItem('hc_bookings_view_mode');
            if (savedView === 'card' || savedView === 'table') {
                setViewMode(savedView);
            }
        } catch (e) {}

        // 2. Copy SĐT & Copy Link Khảo Sát
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

        // 3. Cập nhật bộ đếm KPI trực tiếp
        function updateKpiStats(counts) {
            if (!counts) return;
            const map = {
                'hc-stat-all': counts.all,
                'hc-stat-has-survey': counts.has_survey,
                'hc-stat-pending': counts.pending,
                'hc-stat-contacted': counts.contacted,
                'hc-stat-completed': counts.completed,
                'hc-stat-step1': counts.step1_only
            };
            Object.keys(map).forEach(id => {
                const el = document.getElementById(id);
                if (el && typeof map[id] !== 'undefined') {
                    el.textContent = map[id];
                }
            });
        }

        // 4. Quản lý Tích chọn 1 hoặc nhiều hồ sơ (Đồng bộ giữa Table & Table Card)
        const selectedIds = new Set();
        const masterCheckbox = document.getElementById('hc-select-all-master');
        const tableSelectAll = document.getElementById('hc-select-all-table');
        const selectedCountEl = document.getElementById('hc-selected-count');
        const bulkDelNumEl = document.getElementById('hc-bulk-del-num');
        const bulkDeleteBtn = document.getElementById('hc-bulk-delete-btn');
        const clearSelectionBtn = document.getElementById('hc-clear-selection-btn');
        const bulkBar = document.getElementById('hc-bk-bulk-bar');
        const totalVisibleEl = document.getElementById('hc-total-visible-count');

        function getAllRecordIds() {
            const ids = [];
            document.querySelectorAll('tr.hc-case-record').forEach(tr => {
                const id = parseInt(tr.getAttribute('data-id'), 10);
                if (id > 0) ids.push(id);
            });
            return ids;
        }

        function syncSelectionUI() {
            const allIds = getAllRecordIds();
            if (totalVisibleEl) {
                totalVisibleEl.textContent = allIds.length;
            }

            // Loại bỏ các ID không còn trên DOM
            Array.from(selectedIds).forEach(id => {
                if (!allIds.includes(id)) {
                    selectedIds.delete(id);
                }
            });

            document.querySelectorAll('.hc-case-checkbox').forEach(cb => {
                const id = parseInt(cb.value, 10);
                cb.checked = selectedIds.has(id);
            });

            allIds.forEach(id => {
                const isSel = selectedIds.has(id);
                const row = document.getElementById('hc-booking-row-' + id);
                const card = document.getElementById('hc-booking-card-' + id);
                if (row) row.classList.toggle('is-selected', isSel);
                if (card) card.classList.toggle('is-selected', isSel);
            });

            const count = selectedIds.size;
            if (selectedCountEl) selectedCountEl.textContent = count;
            if (bulkDelNumEl) bulkDelNumEl.textContent = count;
            if (bulkDeleteBtn) bulkDeleteBtn.disabled = (count === 0);
            if (clearSelectionBtn) clearSelectionBtn.style.display = (count > 0) ? 'inline-flex' : 'none';
            if (bulkBar) bulkBar.classList.toggle('has-selection', count > 0);

            const allChecked = allIds.length > 0 && count === allIds.length;
            const someChecked = count > 0 && count < allIds.length;
            [masterCheckbox, tableSelectAll].forEach(box => {
                if (!box) return;
                box.checked = allChecked;
                box.indeterminate = someChecked;
            });
        }

        document.querySelectorAll('.hc-case-checkbox').forEach(cb => {
            cb.addEventListener('change', function () {
                const id = parseInt(cb.value, 10);
                if (!id) return;
                if (cb.checked) {
                    selectedIds.add(id);
                } else {
                    selectedIds.delete(id);
                }
                syncSelectionUI();
            });
        });

        function handleSelectAllToggle(checked) {
            const allIds = getAllRecordIds();
            selectedIds.clear();
            if (checked) {
                allIds.forEach(id => selectedIds.add(id));
            }
            syncSelectionUI();
        }

        if (masterCheckbox) {
            masterCheckbox.addEventListener('change', () => handleSelectAllToggle(masterCheckbox.checked));
        }
        if (tableSelectAll) {
            tableSelectAll.addEventListener('change', () => handleSelectAllToggle(tableSelectAll.checked));
        }
        if (clearSelectionBtn) {
            clearSelectionBtn.addEventListener('click', () => handleSelectAllToggle(false));
        }

        // 5. Xoá 1 hoặc nhiều hồ sơ qua AJAX
        function deleteBookingsAjax(idsToDelete, onDone) {
            if (!idsToDelete || !idsToDelete.length) return;
            const fd = new FormData();
            fd.append('action', 'hieucon_admin_delete_bookings');
            fd.append('nonce', adminNonce);
            idsToDelete.forEach(id => fd.append('booking_ids[]', id));

            fetch(ajaxUrl, { method: 'POST', body: fd })
                .then(r => r.json())
                .then(res => {
                    if (res && res.success) {
                        idsToDelete.forEach(id => {
                            selectedIds.delete(parseInt(id, 10));
                            const row = document.getElementById('hc-booking-row-' + id);
                            const card = document.getElementById('hc-booking-card-' + id);
                            if (row) row.remove();
                            if (card) card.remove();
                        });
                        if (res.data && res.data.counts) {
                            updateKpiStats(res.data.counts);
                        }
                        syncSelectionUI();
                    } else {
                        alert((res && res.data && res.data.message) ? res.data.message : 'Không thể xoá hồ sơ. Vui lòng thử lại.');
                    }
                    if (onDone) onDone(res);
                })
                .catch(() => {
                    alert('Lỗi kết nối máy chủ khi xoá hồ sơ.');
                    if (onDone) onDone({ success: false });
                });
        }

        document.querySelectorAll('.hc-single-delete-btn').forEach(btn => {
            btn.addEventListener('click', function (e) {
                e.stopPropagation();
                const id = parseInt(btn.getAttribute('data-id'), 10);
                const code = btn.getAttribute('data-code') || ('#' + id);
                if (!id) return;
                if (!confirm('Bạn có chắc chắn muốn xoá hồ sơ ' + code + ' không?')) {
                    return;
                }
                btn.disabled = true;
                btn.textContent = 'Đang xoá...';
                deleteBookingsAjax([id]);
            });
        });

        if (bulkDeleteBtn) {
            bulkDeleteBtn.addEventListener('click', function () {
                const ids = Array.from(selectedIds);
                if (!ids.length) return;
                if (!confirm('Bạn có chắc chắn muốn xoá ' + ids.length + ' hồ sơ đã chọn không? Thao tác này không thể hoàn tác.')) {
                    return;
                }
                const origHtml = bulkDeleteBtn.innerHTML;
                bulkDeleteBtn.disabled = true;
                bulkDeleteBtn.textContent = 'Đang xoá ' + ids.length + ' hồ sơ...';
                deleteBookingsAjax(ids, function () {
                    bulkDeleteBtn.innerHTML = origHtml;
                    syncSelectionUI();
                });
            });
        }

        // 6. Lưu Trạng thái & Ghi chú qua AJAX (Đồng bộ cả Table & Table Card)
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
                    const card = document.getElementById('hc-booking-card-' + bookingId);
                    if (row && res.success) {
                        const caseData = JSON.parse(row.getAttribute('data-case') || '{}');
                        caseData.status = newStatus;
                        caseData.admin_note = newNote;
                        row.setAttribute('data-case', JSON.stringify(caseData));

                        const st = statusMeta[newStatus] || statusMeta.pending;
                        if (card) {
                            card.setAttribute('data-status', newStatus);
                        }
                        [row, card].forEach(container => {
                            if (!container) return;
                            const sel = container.querySelector('.hc-row-status-select');
                            if (sel) {
                                sel.value = newStatus;
                                sel.style.background = st.bg;
                                sel.style.color = st.color;
                                sel.style.borderColor = st.border;
                            }
                            const noteText = container.querySelector('.hc-row-note-text');
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
                        });

                        if (res.data && res.data.counts) {
                            updateKpiStats(res.data.counts);
                        }
                    }
                    if (onDone) onDone(res);
                })
                .catch(() => {
                    if (onDone) onDone({ success: false });
                });
        }

        // Đổi trạng thái trực tiếp trên dòng Grid Table hoặc trên Card
        document.querySelectorAll('.hc-row-status-select').forEach(select => {
            select.addEventListener('change', function () {
                const bookingId = select.getAttribute('data-id');
                const row = document.getElementById('hc-booking-row-' + bookingId);
                const caseData = row ? JSON.parse(row.getAttribute('data-case') || '{}') : {};
                saveBookingAjax(bookingId, select.value, caseData.admin_note || '');
            });
        });

        // 7. Mở Pop-up Chi tiết
        const modalBackdrop = document.getElementById('hc-bk-modal-backdrop');
        const modalClose = document.getElementById('hc-modal-close');
        const modalCode = document.getElementById('hc-modal-code');
        const modalParent = document.getElementById('hc-modal-parent');
        const modalBody = document.getElementById('hc-modal-body');
        const modalBookingId = document.getElementById('hc-modal-booking-id');
        const modalBookingCodeRaw = document.getElementById('hc-modal-booking-code-raw');
        const modalStatus = document.getElementById('hc-modal-status');
        const modalNote = document.getElementById('hc-modal-note');
        const modalSaveBtn = document.getElementById('hc-modal-save-btn');
        const modalSaveMsg = document.getElementById('hc-modal-save-msg');
        const modalDeleteBtn = document.getElementById('hc-modal-delete-btn');

        function renderListTags(items) {
            if (!items || !items.length) return '<span style="color:#94a3b8; font-style:italic;">Không tích chọn</span>';
            return items.map(i => '<span class="hc-bk-tag">' + i + '</span>').join('');
        }

        function openCaseModalById(bookingId) {
            const row = document.getElementById('hc-booking-row-' + bookingId);
            if (!row) return;
            const data = JSON.parse(row.getAttribute('data-case') || '{}');
            const sv = data.survey || {};

            modalCode.textContent = data.booking_code + ' • ' + data.created_at;
            modalParent.textContent = 'Phụ huynh: ' + data.parent_name;
            modalBookingId.value = data.id;
            if (modalBookingCodeRaw) modalBookingCodeRaw.value = data.booking_code || '';
            modalStatus.value = data.status || 'pending';
            modalNote.value = data.admin_note || '';
            modalSaveMsg.style.display = 'none';

            let surveyRowsHtml = '';
            const issueTags = (data.issues_list && data.issues_list.length)
                ? data.issues_list
                : ((sv.child_issues && sv.child_issues.length)
                    ? sv.child_issues
                    : (sv.diagnosis ? sv.diagnosis.split(',').map(s => s.trim()).filter(Boolean) : []));

            surveyRowsHtml = `
                <tr>
                    <th>Đường link khảo sát (Gắn mã)</th>
                    <td>
                        <div style="display:flex; align-items:center; justify-content:space-between; gap:8px; flex-wrap:wrap;">
                            <code style="font-size:12px; color:#0A1931; background:#f1f5f9; padding:5px 10px; border-radius:6px; border:1px solid #cbd5e1; word-break:break-all; flex:1;">${data.survey_link || ''}</code>
                            <button type="button" class="hc-bk-icon-btn hc-copy-btn" data-copy="${data.survey_link || ''}" style="background:#fff7ed; color:#c2410c; border-color:#fdba74; font-weight:700; height:28px; padding:0 10px;">📋 Copy link khảo sát</button>
                            <a href="${data.survey_link || '#'}" target="_blank" rel="noopener" class="hc-bk-icon-btn" style="height:28px; padding:0 10px;">Mở trang khảo sát ↗</a>
                        </div>
                    </td>
                </tr>
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

            if (sv.child_name || sv.child_age || sv.bio_symptoms?.length || sv.behav_symptoms?.length || sv.tried_methods?.length || sv.parent_goal || sv.risk_title) {
                const childMeta = [
                    sv.child_gender || '',
                    sv.child_age || '',
                    sv.child_weight ? (sv.child_weight + ' kg') : '',
                    sv.child_height ? (sv.child_height + ' cm') : '',
                    sv.water_amount ? ('Uống: ' + sv.water_amount + ' ml/ngày') : ''
                ].filter(Boolean).join(' • ');

                surveyRowsHtml += `
                    <tr>
                        <th>Thông tin cơ bản của bé</th>
                        <td>
                            <strong style="color:#0A1931;">${sv.child_name || 'Chưa điền tên'}</strong>
                            ${childMeta ? '<span style="margin-left:6px; color:#475569; font-weight:600;">(' + childMeta + ')</span>' : ''}
                        </td>
                    </tr>
                    ${sv.risk_title ? `
                    <tr>
                        <th>Kết quả sàng lọc sơ bộ</th>
                        <td>
                            <span style="background:#fff7ed; color:#c2410c; border:1px solid #fdba74; font-weight:800; padding:4px 10px; border-radius:6px; display:inline-block;">
                                ${sv.risk_title} (${typeof sv.total_score !== 'undefined' ? sv.total_score + ' điểm' : ''})
                            </span>
                        </td>
                    </tr>
                    ` : ''}
                    <tr>
                        <th>Ăn uống & tiêu hóa tổng quát</th>
                        <td>${renderListTags(sv.bio_symptoms)}</td>
                    </tr>
                    ${(sv.allergies && sv.allergies.length) ? `
                    <tr>
                        <th>Tiền sử dị ứng</th>
                        <td>${renderListTags(sv.allergies)}</td>
                    </tr>
                    ` : ''}
                    <tr>
                        <th>Dinh dưỡng, cảm giác & vận động</th>
                        <td>${renderListTags(sv.behav_symptoms)}</td>
                    </tr>
                    ${sv.other_difficulties ? `
                    <tr>
                        <th>Khó khăn ăn uống khác</th>
                        <td><div style="white-space:pre-line; color:#334155;">${sv.other_difficulties}</div></td>
                    </tr>
                    ` : ''}
                    ${sv.daily_diet ? `
                    <tr>
                        <th>Thực đơn điển hình 1 ngày</th>
                        <td><div style="white-space:pre-line; background:#f8fafc; border:1px solid #e2e8f0; padding:8px 12px; border-radius:8px; color:#1e293b;">${sv.daily_diet}</div></td>
                    </tr>
                    ` : ''}
                    <tr>
                        <th>Tiền sử bổ sung vi chất</th>
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
                const id = el.getAttribute('data-id') || (el.closest('[data-id]') ? el.closest('[data-id]').getAttribute('data-id') : '');
                if (id) openCaseModalById(id);
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

        if (modalDeleteBtn) {
            modalDeleteBtn.addEventListener('click', function () {
                const id = parseInt(modalBookingId.value, 10);
                const code = (modalBookingCodeRaw && modalBookingCodeRaw.value) ? modalBookingCodeRaw.value : ('#' + id);
                if (!id) return;
                if (!confirm('Bạn có chắc chắn muốn xoá hồ sơ ' + code + ' không?')) {
                    return;
                }
                modalDeleteBtn.disabled = true;
                modalDeleteBtn.textContent = 'Đang xoá...';
                deleteBookingsAjax([id], function (res) {
                    modalDeleteBtn.disabled = false;
                    modalDeleteBtn.textContent = '🗑 Xoá hồ sơ này';
                    if (res && res.success) {
                        modalBackdrop.classList.remove('is-open');
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
