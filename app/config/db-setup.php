<?php
/**
 * Database setup for Hieucon Member system
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hieucon_setup_member_tables() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    // Table names
    $table_members  = $wpdb->prefix . 'hieucon_members';
    $table_otps     = $wpdb->prefix . 'hieucon_otps';
    $table_sessions = $wpdb->prefix . 'hieucon_sessions';

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';

    // 1. Members Table
    $sql_members = "CREATE TABLE $table_members (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        password_hash varchar(255) NOT NULL,
        full_name varchar(100) NOT NULL,
        date_of_birth date DEFAULT NULL,
        phone_number varchar(20) DEFAULT NULL,
        role varchar(30) NOT NULL DEFAULT 'user',
        status varchar(20) NOT NULL DEFAULT 'active',
        child_name varchar(255) DEFAULT NULL,
        child_dob varchar(50) DEFAULT NULL,
        child_gender varchar(20) DEFAULT NULL,
        child_diagnosis varchar(255) DEFAULT NULL,
        participated_checklists text DEFAULT NULL,
        has_password tinyint(1) NOT NULL DEFAULT 1,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        UNIQUE KEY email (email)
    ) $charset_collate;";
    dbDelta( $sql_members );

    // 2. OTPs Table
    $sql_otps = "CREATE TABLE $table_otps (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        email varchar(100) NOT NULL,
        otp_code varchar(10) NOT NULL,
        action varchar(30) NOT NULL,
        ip_address varchar(45) NOT NULL,
        expires_at datetime NOT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id),
        KEY email_otp (email, otp_code),
        KEY expires_at (expires_at)
    ) $charset_collate;";
    dbDelta( $sql_otps );

    // 3. Sessions Table
    $sql_sessions = "CREATE TABLE $table_sessions (
        session_id varchar(128) NOT NULL,
        member_id bigint(20) NOT NULL,
        ip_address varchar(45) NOT NULL,
        user_agent varchar(255) NOT NULL,
        expires_at datetime NOT NULL,
        created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (session_id),
        KEY member_id (member_id),
        KEY expires_at (expires_at)
    ) $charset_collate;";
    dbDelta( $sql_sessions );
}

// Chạy cài đặt bảng CSDL khi theme hoạt động
add_action( 'after_setup_theme', 'hieucon_setup_member_tables' );

/**
 * Đảm bảo trang hệ thống theo Page Template tồn tại mà không tạo trùng lặp khi trên host đã đổi đường dẫn (slug)
 */
function hieucon_ensure_system_template_page( $template_file, $default_slug, $default_title, $option_id_key = '' ) {
    $existing_by_tpl = get_posts( [
        'post_type'              => 'page',
        'post_status'            => [ 'publish', 'draft', 'private', 'pending' ],
        'meta_key'               => '_wp_page_template',
        'meta_value'             => $template_file,
        'orderby'                => [ 'modified' => 'DESC', 'ID' => 'ASC' ],
        'posts_per_page'         => 10,
        'no_found_rows'          => true,
        'update_post_term_cache' => false,
    ] );

    if ( ! empty( $existing_by_tpl ) ) {
        $custom_page  = null;
        $default_page = null;

        foreach ( $existing_by_tpl as $p ) {
            if ( $default_slug !== $p->post_name && ! $custom_page ) {
                $custom_page = $p;
            } elseif ( $default_slug === $p->post_name && ! $default_page ) {
                $default_page = $p;
            }
        }

        // Nếu trên host đã đổi sang link/slug riêng mà trước đó lỡ tự sinh thêm trang slug mặc định trùng lặp -> xoá bản trùng mặc định
        if ( $custom_page && $default_page && $custom_page->ID !== $default_page->ID ) {
            if ( empty( trim( (string) $default_page->post_content ) ) ) {
                wp_delete_post( $default_page->ID, true );
            }
            $chosen = $custom_page;
        } else {
            $chosen = $custom_page ? $custom_page : $existing_by_tpl[0];
        }

        if ( $option_id_key ) {
            update_option( $option_id_key, intval( $chosen->ID ) );
        }
        return intval( $chosen->ID );
    }

    // Nếu chưa có trang nào gắn template này, kiểm tra theo slug mặc định
    $by_slug = get_page_by_path( $default_slug );
    if ( $by_slug ) {
        update_post_meta( $by_slug->ID, '_wp_page_template', $template_file );
        if ( $option_id_key ) {
            update_option( $option_id_key, intval( $by_slug->ID ) );
        }
        return intval( $by_slug->ID );
    }

    // Chưa có cả theo template lẫn theo slug -> tạo mới 1 lần duy nhất
    $new_id = wp_insert_post( [
        'post_title'  => $default_title,
        'post_name'   => $default_slug,
        'post_status' => 'publish',
        'post_type'   => 'page',
    ] );
    if ( ! is_wp_error( $new_id ) && $new_id > 0 ) {
        update_post_meta( $new_id, '_wp_page_template', $template_file );
        if ( $option_id_key ) {
            update_option( $option_id_key, intval( $new_id ) );
        }
        return intval( $new_id );
    }

    return 0;
}

/**
 * Tự động tạo và gán Page Template cho các trang hệ thống nếu chưa tồn tại
 */
function hieucon_auto_create_member_pages() {
    if ( get_option( 'hieucon_pages_initialized_v4' ) === '1' ) {
        return;
    }

    hieucon_ensure_system_template_page( 'page-templates/template-auth.php', 'dang-nhap', 'Đăng nhập & Đăng ký' );
    hieucon_ensure_system_template_page( 'page-templates/template-my-account.php', 'tai-khoan', 'Tài khoản của tôi' );
    hieucon_ensure_system_template_page( 'page-templates/page-payment.php', 'thanh-toan', 'Thanh toán' );
    hieucon_ensure_system_template_page( 'page-templates/template-booking.php', 'dat-lich-tu-van', 'Đặt lịch tư vấn miễn phí 1:1', 'hieucon_booking_landing_page_id' );
    hieucon_ensure_system_template_page( 'page-templates/template-booking-survey.php', 'khao-sat-tu-van', 'Khảo sát tình trạng của con', 'hieucon_booking_survey_page_id' );

    update_option( 'hieucon_pages_initialized_v4', '1' );
}
add_action( 'init', 'hieucon_auto_create_member_pages' );

