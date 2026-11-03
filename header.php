<?php
/**
 * The header for our theme
 *
 * @package Hieucon
 */

// Xác định layout hiện tại từ Admin hoặc Cài đặt riêng của trang
$header_layout = 'global';

if (is_singular()) {
    $header_layout = get_post_meta(get_the_ID(), '_hieucon_page_header_layout', true);
}

if (empty($header_layout) || $header_layout === 'global') {
    $header_layout = get_option('hieucon_global_header_layout', 'default');
}

// Nạp file giao diện tương ứng
get_template_part('template-parts/header/layout', $header_layout);
