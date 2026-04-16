<?php
/**
 * Hieucon functions and definitions
 *
 * @package Hieucon
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HIEUCON_THEME_DIR', get_template_directory());
define('HIEUCON_THEME_URI', get_template_directory_uri());
define('HIEUCON_THEME_VERSION', '1.0.0');

// Autoloader tự động nạp (include) các file Controllers và Models theo chuẩn PSR-4 thu nhỏ
spl_autoload_register(function ($class) {
    $prefix = 'Hieucon\\';
    $base_dir = HIEUCON_THEME_DIR . '/app/';

    // Chỉ áp dụng cho class thuộc namespace Hieucon
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $path = explode('\\', strtolower($relative_class));

    // Tách models hoặc controllers
    $type = array_shift($path); // 'model' hoặc 'controller'
    $file_name = 'class-' . str_replace('_', '-', implode('-', $path)) . '.php';

    $file = $base_dir . $type . 's/' . $file_name;

    if (file_exists($file)) {
        require $file;
    }
});

// Include các tệp cấu hình (Config) 
require_once HIEUCON_THEME_DIR . '/app/config/setup.php';
require_once HIEUCON_THEME_DIR . '/app/config/tracking.php';
require_once HIEUCON_THEME_DIR . '/app/config/theme-options.php';
require_once HIEUCON_THEME_DIR . '/app/config/checklist-admin.php';

// Add Pancake Livechat script to all pages
function hieucon_add_pancake_livechat()
{
    ?>
    <style>
        /* Chống tràn màn hình điện thoại cho Box Chat Pancake */
        @media (max-width: 768px) {

            iframe[id^="pancake-chat-plugin"],
            div[id^="pancake-"] iframe,
            iframe[src*="chat-plugin.pancake.vn"] {
                max-height: 65vh !important;
                /* Giới hạn chiều cao 65% màn hình */
                max-width: 85vw !important;
                /* Giới hạn chiều ngang 85% */
                bottom: 15px !important;
                /* Cách đáy màn hình */
                right: 15px !important;
                /* Cách lề phải */
                left: auto !important;
                top: auto !important;
                border-radius: 16px !important;
                box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2) !important;
                margin: 0 !important;
            }

            /* Ngăn div bao ngoài của plugin tràn full 100% nếu có */
            div[id^="pancake-chat-plugin"] {
                max-height: 65vh !important;
                max-width: 85vw !important;
                bottom: 15px !important;
                right: 15px !important;
                left: auto !important;
                top: auto !important;
                background: transparent !important;
            }
        }
    </style>
    <script src="https://chat-plugin.pancake.vn/main/auto?page_id=web_hieucontugoc"></script>
    <?php
}
add_action('wp_footer', 'hieucon_add_pancake_livechat', 999);

/**
 * Output Open Graph meta tags for social sharing (Facebook, Zalo, Telegram...)
 * Automatically picks up the page's Featured Image, title, and excerpt.
 */
function hieucon_og_meta_tags()
{
    if (!is_singular())
        return;

    global $post;
    setup_postdata($post);

    // --- Title ---
    $title = get_the_title($post);

    // --- Description: excerpt hoặc trimmed content ---
    $description = '';
    if (!empty($post->post_excerpt)) {
        $description = wp_strip_all_tags($post->post_excerpt);
    } else {
        $description = wp_trim_words(wp_strip_all_tags($post->post_content), 30, '...');
    }

    // --- Image: featured image → fallback logo site ---
    $image_url = '';
    if (has_post_thumbnail($post)) {
        $image_url = get_the_post_thumbnail_url($post, 'large');
    } else {
        // Fallback: custom_logo hoặc site icon
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo_data)
                $image_url = $logo_data[0];
        }
        if (!$image_url) {
            $image_url = get_site_icon_url(512);
        }
    }

    // --- URL ---
    $url = get_permalink($post);

    // --- Site name ---
    $site_name = get_bloginfo('name');

    // Output
    echo "\n<!-- Open Graph / Social Sharing -->\n";
    echo '<meta property="og:type"        content="article" />' . "\n";
    echo '<meta property="og:site_name"   content="' . esc_attr($site_name) . '" />' . "\n";
    echo '<meta property="og:url"         content="' . esc_url($url) . '" />' . "\n";
    echo '<meta property="og:title"       content="' . esc_attr($title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
    if ($image_url) {
        echo '<meta property="og:image"       content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width"  content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
    }
    // Twitter Card
    echo '<meta name="twitter:card"        content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title"       content="' . esc_attr($title) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
    if ($image_url) {
        echo '<meta name="twitter:image"   content="' . esc_url($image_url) . '" />' . "\n";
    }
    echo "<!-- / Open Graph -->\n";
}
add_action('wp_head', 'hieucon_og_meta_tags', 1);

