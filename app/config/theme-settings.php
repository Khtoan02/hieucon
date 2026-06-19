<?php
/**
 * Theme Settings - Quản lý Tracking Code và Giao diện Header
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Đăng ký trang Cài đặt Theme
function hieucon_theme_settings_menu() {
    add_menu_page(
        'Cài đặt Theme',          // Page title
        'Cài đặt Theme',          // Menu title
        'manage_options',         // Capability
        'hieucon-theme-settings', // Menu slug
        'hieucon_theme_settings_html', // Callback
        'dashicons-admin-generic',
        65
    );
}
add_action('admin_menu', 'hieucon_theme_settings_menu');

// 2. Đăng ký các Settings
function hieucon_register_theme_settings() {
    // Header Selection
    register_setting('hieucon_theme_options', 'hieucon_global_header_layout');
    
    // Tracking & Custom Codes
    register_setting('hieucon_theme_options', 'hieucon_custom_head_code');
    register_setting('hieucon_theme_options', 'hieucon_custom_body_code');
    register_setting('hieucon_theme_options', 'hieucon_custom_footer_code');
    register_setting('hieucon_theme_options', 'hieucon_custom_css');
    register_setting('hieucon_theme_options', 'hieucon_show_courses_in_account');
}
add_action('admin_init', 'hieucon_register_theme_settings');

// 3. Giao diện trang Cài đặt Theme
function hieucon_theme_settings_html() {
    if (!current_user_can('manage_options')) {
        return;
    }
    
    // Lấy giá trị hiện tại
    $global_header = get_option('hieucon_global_header_layout', 'default');
    $head_code = get_option('hieucon_custom_head_code', '');
    $body_code = get_option('hieucon_custom_body_code', '');
    $footer_code = get_option('hieucon_custom_footer_code', '');
    $custom_css = get_option('hieucon_custom_css', '');
    
    // Danh sách các layouts hiện có (đọc từ thư mục template-parts/header/)
    $layouts = [
        'default' => 'Header Mặc định (Menu Sản phẩm)',
        'full'    => 'Header Đầy đủ (Thêm Menu Documenting Hope & Kế hoạch Dinh dưỡng)',
        'landing' => 'Header Landing Page (Tối giản, chỉ Logo)'
    ];
    ?>
    <div class="wrap">
        <h1>Cài đặt Theme (Hieucon)</h1>
        <p>Quản lý giao diện chung và mã theo dõi cho toàn bộ Website.</p>
        
        <form action="options.php" method="post">
            <?php
            settings_fields('hieucon_theme_options');
            do_settings_sections('hieucon_theme_options');
            ?>
            
            <h2 class="title">1. Tùy chọn Giao diện (Header)</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label>Header Áp dụng Chung</label></th>
                    <td>
                        <style>
                            .hieucon-header-select { display: flex; gap: 20px; flex-wrap: wrap; }
                            .hieucon-header-card { cursor: pointer; border: 2px solid transparent; border-radius: 8px; padding: 10px; background: #fff; box-shadow: 0 1px 3px rgba(0,0,0,0.1); transition: all 0.2s; width: 280px; text-align: center; position: relative; }
                            .hieucon-header-card:hover { border-color: #2271b1; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
                            .hieucon-header-card input[type="radio"] { position: absolute; opacity: 0; }
                            .hieucon-header-card input[type="radio"]:checked + .hieucon-header-preview { border-color: #2271b1; }
                            .hieucon-header-card.selected { border-color: #2271b1; background: #f0f6fc; }
                            .hieucon-header-card.selected::after { content: '✓'; position: absolute; top: -10px; right: -10px; background: #2271b1; color: white; width: 24px; height: 24px; border-radius: 50%; line-height: 24px; font-weight: bold; }
                            .hieucon-header-preview { border: 1px solid #ddd; border-radius: 4px; overflow: hidden; margin-bottom: 10px; background: #f5f5f5; height: 120px; display: flex; align-items: flex-start; justify-content: center; }
                            .hieucon-header-title { font-weight: 600; font-size: 14px; margin-bottom: 5px; color: #1d2327; }
                            .hieucon-header-desc { font-size: 12px; color: #646970; }
                        </style>
                        
                        <div class="hieucon-header-select">
                            <!-- Layout Mặc định -->
                            <label class="hieucon-header-card <?php echo $global_header === 'default' ? 'selected' : ''; ?>" onclick="document.querySelectorAll('.hieucon-header-card').forEach(e=>e.classList.remove('selected')); this.classList.add('selected');">
                                <input type="radio" name="hieucon_global_header_layout" value="default" <?php checked($global_header, 'default'); ?>>
                                <div class="hieucon-header-preview">
                                    <svg width="260" height="120" viewBox="0 0 260 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="260" height="120" fill="#F8FAFC"/>
                                        <rect width="260" height="30" fill="#0A1931"/>
                                        <rect x="10" y="8" width="14" height="14" rx="2" fill="white"/>
                                        <rect x="30" y="12" width="40" height="6" rx="3" fill="white" fill-opacity="0.8"/>
                                        <!-- Only 1 menu item -->
                                        <rect x="120" y="13" width="20" height="4" rx="2" fill="white" fill-opacity="0.6"/>
                                        <!-- Buttons -->
                                        <rect x="180" y="8" width="30" height="14" rx="7" fill="white" fill-opacity="0.8"/>
                                        <rect x="215" y="8" width="35" height="14" rx="7" fill="#F97316"/>
                                    </svg>
                                </div>
                                <div class="hieucon-header-title">Header Mặc định</div>
                                <div class="hieucon-header-desc">Logo, 1 Menu Sản phẩm và 2 nút chức năng.</div>
                            </label>

                            <!-- Layout Full -->
                            <label class="hieucon-header-card <?php echo $global_header === 'full' ? 'selected' : ''; ?>" onclick="document.querySelectorAll('.hieucon-header-card').forEach(e=>e.classList.remove('selected')); this.classList.add('selected');">
                                <input type="radio" name="hieucon_global_header_layout" value="full" <?php checked($global_header, 'full'); ?>>
                                <div class="hieucon-header-preview">
                                    <svg width="260" height="120" viewBox="0 0 260 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="260" height="120" fill="#F8FAFC"/>
                                        <!-- Header Bar -->
                                        <rect width="260" height="30" fill="#0A1931"/>
                                        <!-- Logo -->
                                        <rect x="10" y="8" width="14" height="14" rx="2" fill="white"/>
                                        <rect x="30" y="12" width="40" height="6" rx="3" fill="white" fill-opacity="0.8"/>
                                        <!-- 3 Menu Items -->
                                        <rect x="90" y="13" width="25" height="4" rx="2" fill="white" fill-opacity="0.6"/>
                                        <rect x="125" y="13" width="35" height="4" rx="2" fill="white" fill-opacity="0.6"/>
                                        <rect x="170" y="13" width="35" height="4" rx="2" fill="white" fill-opacity="0.6"/>
                                        <!-- Only 1 Button -->
                                        <rect x="215" y="8" width="35" height="14" rx="7" fill="#F97316"/>
                                        
                                        <!-- Full Mega Menu Mock -->
                                        <rect x="40" y="32" width="180" height="60" rx="4" fill="white" stroke="#E2E8F0"/>
                                        <rect x="45" y="38" width="40" height="48" rx="2" fill="#F1F5F9"/>
                                        <rect x="90" y="38" width="30" height="48" rx="2" fill="#F8FAFC"/>
                                        <rect x="125" y="38" width="30" height="48" rx="2" fill="#F8FAFC"/>
                                        <rect x="160" y="38" width="30" height="48" rx="2" fill="#F8FAFC"/>
                                    </svg>
                                </div>
                                <div class="hieucon-header-title">Header Đầy Đủ</div>
                                <div class="hieucon-header-desc">3 Mega Menu (Sản phẩm, Doc Hope, Dinh dưỡng) và 1 nút tham gia.</div>
                            </label>

                            <!-- Layout Landing -->
                            <label class="hieucon-header-card <?php echo $global_header === 'landing' ? 'selected' : ''; ?>" onclick="document.querySelectorAll('.hieucon-header-card').forEach(e=>e.classList.remove('selected')); this.classList.add('selected');">
                                <input type="radio" name="hieucon_global_header_layout" value="landing" <?php checked($global_header, 'landing'); ?>>
                                <div class="hieucon-header-preview">
                                    <svg width="260" height="120" viewBox="0 0 260 120" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <rect width="260" height="120" fill="#F8FAFC"/>
                                        <!-- Header Bar -->
                                        <rect width="260" height="40" fill="#0A1931"/>
                                        <!-- Logo Center -->
                                        <rect x="120" y="10" width="20" height="20" rx="4" fill="white"/>
                                        <!-- Body mock -->
                                        <rect x="40" y="60" width="180" height="20" rx="4" fill="#E2E8F0"/>
                                        <rect x="80" y="90" width="100" height="30" rx="4" fill="#CBD5E1"/>
                                    </svg>
                                </div>
                                <div class="hieucon-header-title">Header Landing Page</div>
                                <div class="hieucon-header-desc">Thiết kế tối giản, chỉ giữ lại Logo căn giữa để tập trung vào nội dung chuyển đổi.</div>
                            </label>
                        </div>
                        <p class="description" style="margin-top: 15px;">Header này sẽ hiển thị trên tất cả các trang, bài viết nếu trang đó không tự chọn Header riêng.</p>
                    </td>
                </tr>
            </table>
            
            <hr>
            
            <h2 class="title">2. Mã Tracking & Custom Code</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label for="hieucon_custom_head_code">Mã thẻ &lt;head&gt;</label></th>
                    <td>
                        <textarea name="hieucon_custom_head_code" id="hieucon_custom_head_code" rows="6" class="large-text code"><?php echo esc_textarea($head_code); ?></textarea>
                        <p class="description">Dán Google Analytics, Facebook Pixel... (sẽ chèn ngay trước thẻ &lt;/head&gt;).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="hieucon_custom_body_code">Mã sau thẻ &lt;body&gt;</label></th>
                    <td>
                        <textarea name="hieucon_custom_body_code" id="hieucon_custom_body_code" rows="6" class="large-text code"><?php echo esc_textarea($body_code); ?></textarea>
                        <p class="description">Mã yêu cầu dán ngay sau thẻ mở &lt;body&gt; (Google Tag Manager iframe...).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="hieucon_custom_footer_code">Mã thẻ Footer</label></th>
                    <td>
                        <textarea name="hieucon_custom_footer_code" id="hieucon_custom_footer_code" rows="6" class="large-text code"><?php echo esc_textarea($footer_code); ?></textarea>
                        <p class="description">Mã Chatbot, livechat... (sẽ chèn ngay trước thẻ &lt;/body&gt;).</p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><label for="hieucon_custom_css">CSS Tùy chỉnh (Toàn cầu)</label></th>
                    <td>
                        <textarea name="hieucon_custom_css" id="hieucon_custom_css" rows="8" class="large-text code"><?php echo esc_textarea($custom_css); ?></textarea>
                        <p class="description">Viết CSS để ghi đè giao diện web. Không cần thêm thẻ &lt;style&gt;.</p>
                    </td>
                </tr>
            </table>
            
            <h2 class="title">3. Cài đặt Tài khoản Hội viên</h2>
            <table class="form-table">
                <tr>
                    <th scope="row"><label>Hiển thị Khóa học?</label></th>
                    <td>
                        <?php $show_courses = get_option('hieucon_show_courses_in_account', '0'); ?>
                        <label>
                            <input type="checkbox" name="hieucon_show_courses_in_account" value="1" <?php checked($show_courses, '1'); ?>>
                            Cho phép hiển thị tab "Khóa học của tôi" và "Kích hoạt khóa học" ở trang tài khoản hội viên.
                        </label>
                        <p class="description">Mặc định tính năng khóa học sẽ bị ẩn ở trang tài khoản, chỉ hiển thị tài liệu/cẩm nang.</p>
                    </td>
                </tr>
            </table>
            
            <?php submit_button('Lưu tất cả thay đổi'); ?>
        </form>
    </div>
    <?php
}

// 4. Metabox: Cho phép ghi đè Header Layout trên từng Bài viết/Trang
function hieucon_add_header_layout_metabox() {
    $post_types = get_post_types(array('public' => true), 'names');
    foreach ($post_types as $post_type) {
        add_meta_box(
            'hieucon_header_layout_metabox',
            'Tùy chọn Header (Giao diện)',
            'hieucon_render_header_layout_metabox',
            $post_type,
            'side',
            'high'
        );
    }
}
add_action('add_meta_boxes', 'hieucon_add_header_layout_metabox');

function hieucon_render_header_layout_metabox($post) {
    // Add nonce
    wp_nonce_field('hieucon_save_header_layout_data', 'hieucon_header_layout_meta_nonce');
    
    // Get saved value
    $saved_layout = get_post_meta($post->ID, '_hieucon_page_header_layout', true);
    if (empty($saved_layout)) {
        $saved_layout = 'global';
    }
    
    $layouts = [
        'global'  => 'Dùng Header Chung (Theme Settings)',
        'default' => 'Header Mặc định (Menu Sản phẩm)',
        'full'    => 'Header Đầy đủ (Thêm Menu Documenting Hope & Kế hoạch Dinh dưỡng)',
        'landing' => 'Header Landing (Chỉ Logo)'
    ];
    
    echo '<p>Chọn Header hiển thị riêng cho trang này:</p>';
    echo '<select name="hieucon_page_header_layout" id="hieucon_page_header_layout" style="width:100%;">';
    foreach ($layouts as $val => $label) {
        echo '<option value="' . esc_attr($val) . '" ' . selected($saved_layout, $val, false) . '>' . esc_html($label) . '</option>';
    }
    echo '</select>';
}

function hieucon_save_header_layout_meta($post_id) {
    if (!isset($_POST['hieucon_header_layout_meta_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['hieucon_header_layout_meta_nonce'], 'hieucon_save_header_layout_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['post_type']) && 'page' == $_POST['post_type']) {
        if (!current_user_can('edit_page', $post_id)) {
            return;
        }
    } else {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
    }
    
    if (!isset($_POST['hieucon_page_header_layout'])) {
        return;
    }
    
    $my_data = sanitize_text_field($_POST['hieucon_page_header_layout']);
    update_post_meta($post_id, '_hieucon_page_header_layout', $my_data);
}
add_action('save_post', 'hieucon_save_header_layout_meta');
