<?php
/**
 * HTML Page Builder Custom Post Type
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Register Custom Post Type 'html_page'
add_action('init', 'hieucon_register_html_page_cpt');
function hieucon_register_html_page_cpt() {
    $labels = array(
        'name'                  => _x('Trang HTML', 'Post Type General Name', 'hieucon'),
        'singular_name'         => _x('Trang HTML', 'Post Type Singular Name', 'hieucon'),
        'menu_name'             => __('Trang HTML', 'hieucon'),
        'name_admin_bar'        => __('Trang HTML', 'hieucon'),
        'archives'              => __('Kho lưu trữ', 'hieucon'),
        'attributes'            => __('Thuộc tính', 'hieucon'),
        'parent_item_colon'     => __('Trang cha:', 'hieucon'),
        'all_items'             => __('Tất cả Trang HTML', 'hieucon'),
        'add_new_item'          => __('Thêm Trang HTML Mới', 'hieucon'),
        'add_new'               => __('Thêm Mới', 'hieucon'),
        'new_item'              => __('Trang HTML Mới', 'hieucon'),
        'edit_item'             => __('Sửa Trang HTML', 'hieucon'),
        'update_item'           => __('Cập nhật Trang HTML', 'hieucon'),
        'view_item'             => __('Xem Trang HTML', 'hieucon'),
        'view_items'            => __('Xem các Trang HTML', 'hieucon'),
        'search_items'          => __('Tìm Trang HTML', 'hieucon'),
        'not_found'             => __('Không tìm thấy', 'hieucon'),
        'not_found_in_trash'    => __('Không có trong thùng rác', 'hieucon'),
    );
    $args = array(
        'label'                 => __('Trang HTML', 'hieucon'),
        'description'           => __('Chức năng tạo trang landing bằng mã HTML.', 'hieucon'),
        'labels'                => $labels,
        // Loại bỏ 'editor' để ẩn trình soạn thảo mặc định, chỉ dùng 'title', 'thumbnail'
        'supports'              => array('title', 'thumbnail', 'revisions', 'page-attributes'),
        'hierarchical'          => true, 
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 20,
        'menu_icon'             => 'dashicons-html',
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => false,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        // Tắt REST API để vô hiệu hóa hoàn toàn Block Editor (Gutenberg) cho post type này
        'show_in_rest'          => false, 
        'rewrite'               => false, // Tắt rewrite mặc định để tự quản lý slug
    );
    register_post_type('html_page', $args);
}

// 2. Add Meta Box for HTML code
add_action('add_meta_boxes', 'hieucon_html_page_meta_box');
function hieucon_html_page_meta_box() {
    add_meta_box(
        'hieucon_html_page_code_meta',
        'Cửa sổ lập trình HTML / CSS / JS',
        'hieucon_html_page_code_meta_cb',
        'html_page',
        'normal',
        'high'
    );
}

function hieucon_html_page_code_meta_cb($post) {
    wp_nonce_field('hieucon_html_page_save', 'hieucon_html_page_nonce');
    $html_content = get_post_meta($post->ID, '_hieucon_html_content', true);
    
    // Giao diện UI/UX Dark mode cực chất cho textarea
    echo '<style>
        #hieucon_html_page_code_meta .inside { margin: 0; padding: 0; }
        .hieucon-html-editor-wrap { padding: 15px; background: #1e1e1e; border-bottom-left-radius: 4px; border-bottom-right-radius: 4px; }
        .hieucon-html-editor-wrap .editor-header { color: #858585; margin-bottom: 10px; font-family: Consolas, monospace; font-size: 13px; display: flex; justify-content: space-between; }
        .hieucon-html-editor-wrap textarea {
            width: 100%;
            height: 70vh;
            min-height: 500px;
            font-family: "Fira Code", Consolas, Monaco, monospace;
            font-size: 14px;
            line-height: 1.6;
            background: #252526;
            color: #d4d4d4;
            border: 1px solid #3c3c3c;
            padding: 15px;
            border-radius: 6px;
            resize: vertical;
        }
        .hieucon-html-editor-wrap textarea:focus {
            outline: none;
            border-color: #007cba;
            box-shadow: 0 0 0 1px #007cba;
        }
        .hieucon-html-editor-wrap textarea::-webkit-scrollbar { width: 10px; }
        .hieucon-html-editor-wrap textarea::-webkit-scrollbar-track { background: #1e1e1e; }
        .hieucon-html-editor-wrap textarea::-webkit-scrollbar-thumb { background: #424242; border-radius: 5px; }
        .hieucon-html-editor-wrap textarea::-webkit-scrollbar-thumb:hover { background: #4f4f4f; }
    </style>';

    echo '<div class="hieucon-html-editor-wrap">';
    echo '<div class="editor-header">';
    echo '<span>&lt;!-- Paste mã HTML vào đây. --&gt;</span>';
    echo '<span>Hỗ trợ: HTML5, CSS (&lt;style&gt;), JS (&lt;script&gt;)</span>';
    echo '</div>';
    echo '<textarea name="hieucon_html_content" id="hieucon_html_content" spellcheck="false" placeholder="<div class=\'my-landing\'>\n  <h1>Tiêu đề</h1>\n</div>">' . esc_textarea($html_content) . '</textarea>';
    echo '</div>';
}

// 3. Save Meta Box data
add_action('save_post', 'hieucon_html_page_save_meta');
function hieucon_html_page_save_meta($post_id) {
    if (!isset($_POST['hieucon_html_page_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['hieucon_html_page_nonce'], 'hieucon_html_page_save')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_page', $post_id)) {
        return;
    }

    if (isset($_POST['hieucon_html_content'])) {
        // Lưu HTML gốc, không sanitize để cho phép CSS/JS
        update_post_meta($post_id, '_hieucon_html_content', wp_unslash($_POST['hieucon_html_content']));
    }
}

// 4. Bỏ chữ 'html_page' khỏi URL khi tạo trang
add_filter('post_type_link', 'hieucon_html_page_remove_slug', 10, 3);
function hieucon_html_page_remove_slug($post_link, $post, $leavename) {
    if ('html_page' != $post->post_type || 'publish' != $post->post_status) {
        return $post_link;
    }
    // Trả về URL chỉ bao gồm tên miền và tên bài viết (giống Page bình thường)
    return home_url('/' . $post->post_name . '/');
}

// 5. Giúp WordPress nhận diện được link vừa sửa
add_action('pre_get_posts', 'hieucon_html_page_parse_request');
function hieucon_html_page_parse_request($query) {
    if (!is_admin() && $query->is_main_query()) {
        // Kiểm tra xem user có đang truy cập một link dạng slug không
        if (isset($query->query['name']) || isset($query->query['pagename'])) {
            $current_types = $query->get('post_type');
            if (empty($current_types)) {
                $query->set('post_type', array('post', 'page', 'html_page'));
            } elseif (is_array($current_types) && !in_array('html_page', $current_types)) {
                $current_types[] = 'html_page';
                $query->set('post_type', $current_types);
            } elseif (is_string($current_types) && $current_types != 'html_page' && $current_types != 'any') {
                $query->set('post_type', array($current_types, 'html_page'));
            }
        }
    }
}
