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

// Chuyển hướng các file cũ để đảm bảo tương thích ngược
if (is_page_template('page-templates/Che_Do_An_Khong_Gluten_Casein_GFCF_Cho_Tre_Tu_Ky_Landing.php')) {
    $header_layout = 'landing';
}

// Nạp file giao diện tương ứng
get_template_part('template-parts/header/layout', $header_layout);
