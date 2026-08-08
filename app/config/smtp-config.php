<?php
/**
 * Custom SMTP Configuration using WordPress PHPMailer Init hook
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hieucon_custom_smtp_setup( $phpmailer ) {
    // Lấy các tùy chọn SMTP được lưu trong wp_options
    $smtp_enabled   = get_option( 'hieucon_smtp_enabled', '0' );
    $smtp_host      = get_option( 'hieucon_smtp_host', '' );
    $smtp_port      = get_option( 'hieucon_smtp_port', '587' );
    $smtp_user      = get_option( 'hieucon_smtp_user', '' );
    $smtp_pass      = get_option( 'hieucon_smtp_pass', '' );
    $smtp_secure    = get_option( 'hieucon_smtp_secure', 'tls' ); // 'tls', 'ssl', 'none'
    $smtp_from      = get_option( 'hieucon_smtp_from', '' );
    $smtp_from_name = get_option( 'hieucon_smtp_from_name', get_bloginfo( 'name' ) );

    // Nếu không bật SMTP hoặc thiếu Host/User/Pass thì bỏ qua, dùng mặc định
    if ( '1' !== $smtp_enabled || empty( $smtp_host ) || empty( $smtp_user ) || empty( $smtp_pass ) ) {
        return;
    }

    // Thiết lập PHPMailer để dùng SMTP
    $phpmailer->isSMTP();
    $phpmailer->Host       = $smtp_host;
    $phpmailer->SMTPAuth   = true;
    $phpmailer->Port       = intval( $smtp_port );
    $phpmailer->Username   = $smtp_user;
    $phpmailer->Password   = $smtp_pass;
    
    // Cấu hình Encryption
    if ( 'ssl' === $smtp_secure ) {
        $phpmailer->SMTPSecure = 'ssl';
    } elseif ( 'tls' === $smtp_secure ) {
        $phpmailer->SMTPSecure = 'tls';
    } else {
        $phpmailer->SMTPSecure = '';
        $phpmailer->SMTPAutoTLS = false;
    }

    // Người gửi
    if ( ! empty( $smtp_from ) && is_email( $smtp_from ) ) {
        $phpmailer->From     = $smtp_from;
        $phpmailer->FromName = $smtp_from_name;
    }
}
add_action( 'phpmailer_init', 'hieucon_custom_smtp_setup', 999 );

/**
 * Log wp_mail failures to options for easy admin debugging
 */
function hieucon_log_mail_errors( $wp_error ) {
    if ( is_wp_error( $wp_error ) ) {
        update_option( 'hieucon_smtp_last_error', $wp_error->get_error_message() );
        error_log( 'wp_mail failed: ' . $wp_error->get_error_message() );
    }
}
add_action( 'wp_mail_failed', 'hieucon_log_mail_errors', 10, 1 );
