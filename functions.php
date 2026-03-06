<?php
/**
 * Hieucon functions and definitions
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

define( 'HIEUCON_THEME_DIR', get_template_directory() );
define( 'HIEUCON_THEME_URI', get_template_directory_uri() );
define( 'HIEUCON_THEME_VERSION', '1.0.0' );

// Autoloader tự động nạp (include) các file Controllers và Models theo chuẩn PSR-4 thu nhỏ
spl_autoload_register( function ( $class ) {
    $prefix = 'Hieucon\\';
    $base_dir = HIEUCON_THEME_DIR . '/app/';

    // Chỉ áp dụng cho class thuộc namespace Hieucon
    $len = strlen( $prefix );
    if ( strncmp( $prefix, $class, $len ) !== 0 ) {
        return;
    }

    $relative_class = substr( $class, $len );
    $path = explode('\\', strtolower($relative_class));
    
    // Tách models hoặc controllers
    $type = array_shift($path); // 'model' hoặc 'controller'
    $file_name = 'class-' . str_replace('_', '-', implode('-', $path)) . '.php';

    $file = $base_dir . $type . 's/' . $file_name;

    if ( file_exists( $file ) ) {
        require $file;
    }
} );

// Include các tệp cấu hình (Config) 
require_once HIEUCON_THEME_DIR . '/app/config/setup.php';
