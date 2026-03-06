<?php
/**
 * Theme setup and basic configuration
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function hieucon_setup() {
    // Để WordPress quản lý tag title.
    add_theme_support( 'title-tag' );

    // Hỗ trợ ảnh đại diện (Post Thumbnails)
    add_theme_support( 'post-thumbnails' );

    // Đăng ký Menus
    register_nav_menus(
        array(
            'primary-menu' => esc_html__( 'Menu Chính', 'hieucon' ),
            'footer-menu'  => esc_html__( 'Menu Footer', 'hieucon' ),
        )
    );

    // Hỗ trợ HTML5 cho các component của WP
    add_theme_support(
        'html5',
        array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' )
    );
}
add_action( 'after_setup_theme', 'hieucon_setup' );

/**
 * Nạp CSS và JS
 */
function hieucon_scripts() {
    // File style.css gốc của Theme (bắt buộc)
    wp_enqueue_style( 'hieucon-style', get_stylesheet_uri(), array(), HIEUCON_THEME_VERSION );
    
    // Nạp JS, CSS của giao diện (hiện tại có thể comment lại chưa cần)
    // wp_enqueue_style( 'hieucon-main', HIEUCON_THEME_URI . '/assets/css/main.css', array(), HIEUCON_THEME_VERSION );
    // wp_enqueue_script( 'hieucon-main', HIEUCON_THEME_URI . '/assets/js/main.js', array('jquery'), HIEUCON_THEME_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'hieucon_scripts' );
