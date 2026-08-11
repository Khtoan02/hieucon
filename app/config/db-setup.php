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
 * Tự động tạo và gán Page Template cho trang Đăng nhập và Tài khoản nếu chưa tồn tại
 */
function hieucon_auto_create_member_pages() {
    // 1. Trang Đăng nhập & Đăng ký
    $auth_slug = 'dang-nhap';
    $auth_page = get_page_by_path( $auth_slug );
    $auth_template = 'page-templates/template-auth.php';

    if ( ! $auth_page ) {
        $auth_id = wp_insert_post( [
            'post_title'  => 'Đăng nhập & Đăng ký',
            'post_name'   => $auth_slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( ! is_wp_error( $auth_id ) ) {
            update_post_meta( $auth_id, '_wp_page_template', $auth_template );
        }
    } else {
        // Đảm bảo template luôn đúng
        update_post_meta( $auth_page->ID, '_wp_page_template', $auth_template );
    }

    // 2. Trang Tài khoản
    $account_slug = 'tai-khoan';
    $account_page = get_page_by_path( $account_slug );
    $account_template = 'page-templates/template-my-account.php';

    if ( ! $account_page ) {
        $account_id = wp_insert_post( [
            'post_title'  => 'Tài khoản của tôi',
            'post_name'   => $account_slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( ! is_wp_error( $account_id ) ) {
            update_post_meta( $account_id, '_wp_page_template', $account_template );
        }
    } else {
        // Đảm bảo template luôn đúng
        update_post_meta( $account_page->ID, '_wp_page_template', $account_template );
    }

    // 3. Trang Thanh toán (SePay VietQR)
    $payment_slug = 'thanh-toan';
    $payment_page = get_page_by_path( $payment_slug );
    $payment_template = 'page-templates/page-payment.php';

    if ( ! $payment_page ) {
        $payment_id = wp_insert_post( [
            'post_title'  => 'Thanh toán',
            'post_name'   => $payment_slug,
            'post_status' => 'publish',
            'post_type'   => 'page',
        ] );
        if ( ! is_wp_error( $payment_id ) ) {
            update_post_meta( $payment_id, '_wp_page_template', $payment_template );
        }
    } else {
        // Đảm bảo template luôn đúng
        update_post_meta( $payment_page->ID, '_wp_page_template', $payment_template );
    }
}
add_action( 'init', 'hieucon_auto_create_member_pages' );

