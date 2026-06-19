<?php
/**
 * Referral Codes Custom Post Type & Meta Configuration
 *
 * @package Hieucon
 */

if (!defined('ABSPATH')) {
    exit;
}

// ============================================================
// 1. ĐĂNG KÝ CPT REFERRAL_CODE (Mã giới thiệu)
// ============================================================
function hieucon_referral_code_register_cpt()
{
    $labels = [
        'name' => 'Mã giới thiệu',
        'singular_name' => 'Mã giới thiệu',
        'menu_name' => 'Mã giới thiệu',
        'name_admin_bar' => 'Mã giới thiệu',
        'add_new' => 'Thêm mã mới',
        'add_new_item' => 'Thêm Mã giới thiệu mới',
        'new_item' => 'Mã mới',
        'edit_item' => 'Sửa Mã giới thiệu',
        'view_item' => 'Xem Mã giới thiệu',
        'all_items' => 'Tất cả Mã giới thiệu',
        'search_items' => 'Tìm Mã giới thiệu',
        'not_found' => 'Không tìm thấy mã nào.',
        'not_found_in_trash' => 'Không tìm thấy mã nào trong thùng rác.'
    ];

    register_post_type('referral_code', [
        'labels' => $labels,
        'public' => false, // Không công khai ngoài front-end
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'capability_type' => 'post',
        'has_archive' => false,
        'hierarchical' => false,
        'menu_position' => 28,
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => ['title'], // Post title chính là code (ví dụ: INTRO50, FREEALL)
    ]);
}
add_action('init', 'hieucon_referral_code_register_cpt');

// ============================================================
// 2. ĐĂNG KÝ METABOX CẤU HÌNH MÃ GIỚI THIỆU TRONG ADMIN
// ============================================================
function hieucon_referral_code_add_meta_boxes()
{
    add_meta_box(
        'hieucon_referral_code_settings',
        'Cấu hình Mã giới thiệu',
        'hieucon_referral_code_metabox_html',
        'referral_code',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'hieucon_referral_code_add_meta_boxes');

function hieucon_referral_code_metabox_html($post)
{
    wp_nonce_field('hieucon_referral_code_meta_nonce', 'referral_code_meta_nonce');

    $active = get_post_meta($post->ID, '_ref_active', true);
    if ($active === '') {
        $active = 'yes';
    }
    $type = get_post_meta($post->ID, '_ref_type', true);
    if (empty($type)) {
        $type = 'free_all';
    }
    $discount_value = get_post_meta($post->ID, '_ref_discount_value', true);
    $usage_limit = get_post_meta($post->ID, '_ref_usage_limit', true);

    $applied_courses = get_post_meta($post->ID, '_ref_applied_courses', true);
    if (!is_array($applied_courses)) {
        $applied_courses = [];
    }

    $applied_ebooks = get_post_meta($post->ID, '_ref_applied_ebooks', true);
    if (!is_array($applied_ebooks)) {
        $applied_ebooks = [];
    }

    $used_by = get_post_meta($post->ID, '_ref_used_by_members', true);
    $used_count = is_array($used_by) ? count($used_by) : 0;

    // Lấy tất cả khóa học
    $courses = get_posts([
        'post_type' => 'course',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ]);

    // Lấy tất cả ebook
    $ebooks = get_posts([
        'post_type' => 'ebook',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'orderby' => 'title',
        'order' => 'ASC'
    ]);
    ?>
    <table class="form-table">
        <tr>
            <th>Trạng thái mã</th>
            <td>
                <label>
                    <input type="checkbox" name="ref_active" value="yes" <?php checked($active, 'yes'); ?>>
                    Kích hoạt sử dụng mã này
                </label>
            </td>
        </tr>
        <tr>
            <th><label for="ref_type">Loại ưu đãi</label></th>
            <td>
                <select id="ref_type" name="ref_type" class="regular-text" onchange="hieuconToggleRefFields(this.value)">
                    <option value="free_all" <?php selected($type, 'free_all'); ?>>Miễn phí toàn bộ học liệu (Tất cả Khóa học & Ebooks)</option>
                    <option value="free_items" <?php selected($type, 'free_items'); ?>>Miễn phí các học liệu được chọn</option>
                    <option value="discount_percent" <?php selected($type, 'discount_percent'); ?>>Giảm giá theo phần trăm (%)</option>
                    <option value="discount_fixed" <?php selected($type, 'discount_fixed'); ?>>Giảm giá số tiền cố định (VND)</option>
                </select>
            </td>
        </tr>
        <tr class="ref-field-discount" style="<?php echo (strpos($type, 'discount') !== false) ? '' : 'display:none;'; ?>">
            <th><label for="ref_discount_value">Mức giảm giá</label></th>
            <td>
                <input type="number" id="ref_discount_value" name="ref_discount_value"
                    value="<?php echo esc_attr($discount_value); ?>" class="regular-text"
                    placeholder="Ví dụ: 30 (cho 30%) hoặc 100000 (cho 100.000đ)">
            </td>
        </tr>
        <tr>
            <th><label for="ref_usage_limit">Giới hạn số lần sử dụng</label></th>
            <td>
                <input type="number" id="ref_usage_limit" name="ref_usage_limit"
                    value="<?php echo esc_attr($usage_limit); ?>" class="regular-text"
                    placeholder="Để trống nếu không giới hạn số lần sử dụng" min="1">
                <p class="description">Đã sử dụng: <strong><?php echo $used_count; ?></strong> lần.</p>
            </td>
        </tr>
        <tr class="ref-field-items" style="<?php echo ($type !== 'free_all') ? '' : 'display:none;'; ?>">
            <th>Áp dụng cho Khóa học</th>
            <td>
                <?php if (!empty($courses)): ?>
                    <div style="max-height: 180px; overflow-y: auto; border: 1px solid #ccd0d4; padding: 10px; background: #fff; border-radius: 4px; max-width: 500px;">
                        <?php foreach ($courses as $c): ?>
                            <label style="display: block; margin-bottom: 6px;">
                                <input type="checkbox" name="ref_applied_courses[]" value="<?php echo esc_attr($c->ID); ?>"
                                    <?php checked(in_array($c->ID, $applied_courses)); ?>>
                                <?php echo esc_html($c->post_title); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <p class="description">Chưa có khóa học nào trên hệ thống.</p>
                <?php endif; ?>
            </td>
        </tr>
        <tr class="ref-field-items" style="<?php echo ($type !== 'free_all') ? '' : 'display:none;'; ?>">
            <th>Áp dụng cho Cẩm nang (Ebook)</th>
            <td>
                <?php if (!empty($ebooks)): ?>
                    <div style="max-height: 180px; overflow-y: auto; border: 1px solid #ccd0d4; padding: 10px; background: #fff; border-radius: 4px; max-width: 500px;">
                        <?php foreach ($ebooks as $eb): ?>
                            <label style="display: block; margin-bottom: 6px;">
                                <input type="checkbox" name="ref_applied_ebooks[]" value="<?php echo esc_attr($eb->ID); ?>"
                                    <?php checked(in_array($eb->ID, $applied_ebooks)); ?>>
                                <?php echo esc_html($eb->post_title); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="description">Chọn học liệu áp dụng cho mã này (bắt buộc đối với loại "Miễn phí học liệu được chọn" hoặc giảm giá cụ thể).</p>
                <?php else: ?>
                    <p class="description">Chưa có Cẩm nang nào trên hệ thống.</p>
                <?php endif; ?>
            </td>
        </tr>
        <?php if (!empty($used_by)): ?>
        <tr>
            <th>Danh sách người đã dùng</th>
            <td>
                <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccd0d4; padding: 10px; background: #f9f9f9; border-radius: 4px; max-width: 500px;">
                    <ul style="margin: 0; padding-left: 15px; list-style-type: decimal;">
                        <?php 
                        global $wpdb;
                        $table = $wpdb->prefix . 'hieucon_members';
                        foreach ($used_by as $uid) {
                            $member_row = $wpdb->get_row($wpdb->prepare("SELECT full_name, email FROM $table WHERE id = %d", $uid));
                            if ($member_row) {
                                echo '<li style="margin-bottom: 4px;"><strong>' . esc_html($member_row->full_name) . '</strong> (' . esc_html($member_row->email) . ')</li>';
                            } else {
                                echo '<li style="margin-bottom: 4px; color:#999;">Thành viên #' . intval($uid) . ' (Đã bị xoá hoặc không tồn tại)</li>';
                            }
                        }
                        ?>
                    </ul>
                </div>
                <p class="description">Danh sách chi tiết các hội viên đã kích hoạt thành công mã giới thiệu này.</p>
            </td>
        </tr>
        <?php endif; ?>
    </table>

    <script>
        function hieuconToggleRefFields(val) {
            var discountFields = document.querySelectorAll('.ref-field-discount');
            var itemFields = document.querySelectorAll('.ref-field-items');
            
            if (val.indexOf('discount') !== -1) {
                discountFields.forEach(el => el.style.display = '');
            } else {
                discountFields.forEach(el => el.style.display = 'none');
            }

            if (val !== 'free_all') {
                itemFields.forEach(el => el.style.display = '');
            } else {
                itemFields.forEach(el => el.style.display = 'none');
            }
        }
    </script>
    <?php
}

function hieucon_referral_code_save_meta_boxes($post_id)
{
    if (isset($_POST['referral_code_meta_nonce']) && wp_verify_nonce($_POST['referral_code_meta_nonce'], 'hieucon_referral_code_meta_nonce')) {
        // Lưu Active State
        $active_val = isset($_POST['ref_active']) ? 'yes' : 'no';
        update_post_meta($post_id, '_ref_active', $active_val);

        // Lưu Loại
        if (isset($_POST['ref_type'])) {
            update_post_meta($post_id, '_ref_type', sanitize_key($_POST['ref_type']));
        }

        // Lưu Giá trị giảm giá
        if (isset($_POST['ref_discount_value'])) {
            update_post_meta($post_id, '_ref_discount_value', floatval($_POST['ref_discount_value']));
        }

        // Lưu Giới hạn sử dụng
        if (isset($_POST['ref_usage_limit'])) {
            $limit = $_POST['ref_usage_limit'] !== '' ? intval($_POST['ref_usage_limit']) : '';
            update_post_meta($post_id, '_ref_usage_limit', $limit);
        }

        // Lưu danh sách khóa học áp dụng
        $courses = isset($_POST['ref_applied_courses']) ? array_map('intval', $_POST['ref_applied_courses']) : [];
        update_post_meta($post_id, '_ref_applied_courses', $courses);

        // Lưu danh sách ebook áp dụng
        $ebooks = isset($_POST['ref_applied_ebooks']) ? array_map('intval', $_POST['ref_applied_ebooks']) : [];
        update_post_meta($post_id, '_ref_applied_ebooks', $ebooks);
    }
}
add_action('save_post', 'hieucon_referral_code_save_meta_boxes');

// ============================================================
// 3. THÊM CỘT TÙY CHỈNH CHO DANH SÁCH MÃ TRONG ADMIN
// ============================================================
function hieucon_referral_code_columns($cols)
{
    $new = [
        'cb' => $cols['cb'],
        'title' => 'Mã giới thiệu',
        'ref_type_col' => 'Loại ưu đãi',
        'ref_benefit' => 'Mức giảm / Quyền lợi',
        'ref_usage' => 'Lượt sử dụng',
        'ref_status' => 'Trạng thái',
        'date' => $cols['date']
    ];
    return $new;
}
add_filter('manage_referral_code_posts_columns', 'hieucon_referral_code_columns');

function hieucon_referral_code_column_content($col, $post_id)
{
    if ($col === 'ref_type_col') {
        $type = get_post_meta($post_id, '_ref_type', true);
        if ($type === 'free_all') {
            echo '<span style="background:#ecfdf5;color:#065f46;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Tất cả Free</span>';
        } elseif ($type === 'free_items') {
            echo '<span style="background:#f0fdf4;color:#166534;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Mục Free riêng</span>';
        } elseif ($type === 'discount_percent') {
            echo '<span style="background:#fef3c7;color:#92400e;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Giảm %</span>';
        } elseif ($type === 'discount_fixed') {
            echo '<span style="background:#eff6ff;color:#1e40af;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Giảm VND</span>';
        }
    }
    if ($col === 'ref_benefit') {
        $type = get_post_meta($post_id, '_ref_type', true);
        $value = get_post_meta($post_id, '_ref_discount_value', true);
        if ($type === 'free_all') {
            echo '<strong>Miễn phí toàn thư viện</strong>';
        } elseif ($type === 'free_items') {
            $courses = get_post_meta($post_id, '_ref_applied_courses', true);
            $ebooks = get_post_meta($post_id, '_ref_applied_ebooks', true);
            $cnt = (is_array($courses) ? count($courses) : 0) + (is_array($ebooks) ? count($ebooks) : 0);
            echo '<strong>Free ' . $cnt . ' tài liệu đã chọn</strong>';
        } elseif ($type === 'discount_percent') {
            echo '<strong style="color:#ef4444;">Giảm ' . $value . '%</strong>';
        } elseif ($type === 'discount_fixed') {
            echo '<strong style="color:#ef4444;">Giảm -' . number_format(floatval($value), 0, ',', '.') . 'đ</strong>';
        }
    }
    if ($col === 'ref_usage') {
        $limit = get_post_meta($post_id, '_ref_usage_limit', true);
        $used_by = get_post_meta($post_id, '_ref_used_by_members', true);
        $used_count = is_array($used_by) ? count($used_by) : 0;
        
        $limit_text = ($limit === '' || is_null($limit)) ? '∞' : $limit;
        echo '<strong>' . $used_count . ' / ' . $limit_text . '</strong>';
    }
    if ($col === 'ref_status') {
        $active = get_post_meta($post_id, '_ref_active', true);
        if ($active === 'yes') {
            echo '<span style="color:#22c55e;font-weight:700;">Hoạt động</span>';
        } else {
            echo '<span style="color:#9ca3af;">Tạm dừng</span>';
        }
    }
}
add_action('manage_referral_code_posts_custom_column', 'hieucon_referral_code_column_content', 10, 2);
