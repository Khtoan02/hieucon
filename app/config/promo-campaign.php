<?php
/**
 * Promotional Campaigns Custom Post Type & Meta Configuration
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// 1. ĐĂNG KÝ CPT PROMO_CAMPAIGN (Chiến dịch Khuyến mãi)
// ============================================================
function hieucon_promo_campaign_register_cpt() {
    $labels = [
        'name'               => 'Khuyến mãi',
        'singular_name'      => 'Chiến dịch Khuyến mãi',
        'menu_name'          => 'Khuyến mãi (CTKM)',
        'name_admin_bar'     => 'Khuyến mãi',
        'add_new'            => 'Thêm CTKM mới',
        'add_new_item'       => 'Thêm Chiến dịch mới',
        'new_item'           => 'Chiến dịch mới',
        'edit_item'          => 'Sửa Chiến dịch',
        'view_item'          => 'Xem Chiến dịch',
        'all_items'          => 'Tất cả CTKM',
        'search_items'       => 'Tìm Chiến dịch',
        'not_found'          => 'Không tìm thấy chiến dịch nào.',
        'not_found_in_trash' => 'Không tìm thấy chiến dịch nào trong thùng rác.'
    ];

    register_post_type( 'promo_campaign', [
        'labels'             => $labels,
        'public'             => false, // Không công khai ngoài front-end (chỉ quản trị trong admin)
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => 27,
        'menu_icon'          => 'dashicons-tag',
        'supports'           => [ 'title' ], // Chỉ cần tiêu đề chiến dịch
    ] );
}
add_action( 'init', 'hieucon_promo_campaign_register_cpt' );

// ============================================================
// 2. ĐĂNG KÝ METABOX CẤU HÌNH CTKM TRONG ADMIN
// ============================================================
function hieucon_promo_campaign_add_meta_boxes() {
    add_meta_box(
        'hieucon_promo_campaign_settings',
        'Cấu hình Chương trình Khuyến mãi',
        'hieucon_promo_campaign_metabox_html',
        'promo_campaign',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hieucon_promo_campaign_add_meta_boxes' );

function hieucon_promo_campaign_metabox_html( $post ) {
    wp_nonce_field( 'hieucon_promo_campaign_meta_nonce', 'promo_campaign_meta_nonce' );

    $active         = get_post_meta( $post->ID, '_promo_active', true );
    if ( $active === '' ) {
        $active = 'yes'; // Mặc định là bật khi tạo mới
    }
    $discount_type  = get_post_meta( $post->ID, '_promo_discount_type', true );
    if ( empty( $discount_type ) ) {
        $discount_type = 'percent';
    }
    $discount_value = get_post_meta( $post->ID, '_promo_discount_value', true );
    $promo_target   = get_post_meta( $post->ID, '_promo_target', true );
    if ( empty( $promo_target ) ) {
        $promo_target = 'all';
    }
    $applied_ebooks = get_post_meta( $post->ID, '_promo_applied_ebooks', true );
    if ( ! is_array( $applied_ebooks ) ) {
        $applied_ebooks = [];
    }

    // Lấy tất cả ebook đang hoạt động
    $ebooks = get_posts( [
        'post_type'      => 'ebook',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC'
    ] );
    ?>
    <table class="form-table">
        <tr>
            <th>Trạng thái chiến dịch</th>
            <td>
                <label>
                    <input type="checkbox" name="promo_active" value="yes" <?php checked( $active, 'yes' ); ?>>
                    Kích hoạt (Cho phép áp dụng chiến dịch khuyến mãi này)
                </label>
            </td>
        </tr>
        <tr>
            <th><label for="promo_discount_type">Loại giảm giá</label></th>
            <td>
                <select id="promo_discount_type" name="promo_discount_type" class="regular-text">
                    <option value="percent" <?php selected( $discount_type, 'percent' ); ?>>Giảm theo phần trăm (%)</option>
                    <option value="fixed" <?php selected( $discount_type, 'fixed' ); ?>>Giảm số tiền cố định (VND)</option>
                </select>
            </td>
        </tr>
        <tr>
            <th><label for="promo_discount_value">Mức giảm</label></th>
            <td>
                <input type="number" id="promo_discount_value" name="promo_discount_value" value="<?php echo esc_attr( $discount_value ); ?>" class="regular-text" placeholder="Ví dụ: 20 (cho 20%) hoặc 50000 (cho 50.000đ)" required min="0">
            </td>
        </tr>
        <tr>
            <th><label for="promo_target">Đối tượng áp dụng</label></th>
            <td>
                <select id="promo_target" name="promo_target" class="regular-text">
                    <option value="all" <?php selected( $promo_target, 'all' ); ?>>Tất cả khách hàng</option>
                    <option value="new" <?php selected( $promo_target, 'new' ); ?>>Khách hàng mới (chưa mua khóa học/ebook)</option>
                    <option value="loyal" <?php selected( $promo_target, 'loyal' ); ?>>Khách hàng thân thiết (đã sở hữu ít nhất 1 khóa học/ebook)</option>
                </select>
            </td>
        </tr>
        <tr>
            <th>Tài liệu áp dụng</th>
            <td>
                <?php if ( ! empty( $ebooks ) ) : ?>
                    <div style="max-height: 250px; overflow-y: auto; border: 1px solid #ccd0d4; padding: 10px; background: #fff; border-radius: 4px;">
                        <?php foreach ( $ebooks as $ebook ) : ?>
                            <label style="display: block; margin-bottom: 6px; font-weight: 500;">
                                <input type="checkbox" name="promo_applied_ebooks[]" value="<?php echo esc_attr( $ebook->ID ); ?>" <?php checked( in_array( $ebook->ID, $applied_ebooks ) ); ?>>
                                <?php echo esc_html( $ebook->post_title ); ?>
                            </label>
                        <?php endforeach; ?>
                    </div>
                    <p class="description">Tích chọn các Tài liệu bồi dưỡng được áp dụng chương trình khuyến mãi này.</p>
                <?php else : ?>
                    <p style="color: #9ca3af; font-style: italic;">Chưa có Tài liệu bồi dưỡng nào được xuất bản trên hệ thống.</p>
                <?php endif; ?>
            </td>
        </tr>
    </table>
    <?php
}

function hieucon_promo_campaign_save_meta_boxes( $post_id ) {
    if ( isset( $_POST['promo_campaign_meta_nonce'] ) && wp_verify_nonce( $_POST['promo_campaign_meta_nonce'], 'hieucon_promo_campaign_meta_nonce' ) ) {
        // Lưu Active State
        $active_val = isset( $_POST['promo_active'] ) ? 'yes' : 'no';
        update_post_meta( $post_id, '_promo_active', $active_val );

        // Lưu loại giảm giá
        if ( isset( $_POST['promo_discount_type'] ) ) {
            update_post_meta( $post_id, '_promo_discount_type', sanitize_key( $_POST['promo_discount_type'] ) );
        }

        // Lưu mức giảm
        if ( isset( $_POST['promo_discount_value'] ) ) {
            update_post_meta( $post_id, '_promo_discount_value', floatval( $_POST['promo_discount_value'] ) );
        }

        // Lưu đối tượng áp dụng
        if ( isset( $_POST['promo_target'] ) ) {
            update_post_meta( $post_id, '_promo_target', sanitize_key( $_POST['promo_target'] ) );
        }

        // Lưu danh sách Ebook áp dụng
        $applied_ebooks = isset( $_POST['promo_applied_ebooks'] ) ? array_map( 'intval', $_POST['promo_applied_ebooks'] ) : [];
        update_post_meta( $post_id, '_promo_applied_ebooks', $applied_ebooks );
    }
}
add_action( 'save_post', 'hieucon_promo_campaign_save_meta_boxes' );

// ============================================================
// 3. THÊM CỘT TÙY CHỈNH CHO DANH SÁCH CTKM TRONG ADMIN
// ============================================================
function hieucon_promo_campaign_columns( $cols ) {
    $new = [
        'cb'                   => $cols['cb'],
        'title'                => $cols['title'],
        'promo_discount'       => 'Mức giảm giá',
        'promo_target_col'     => 'Đối tượng',
        'promo_applied_count'  => 'Số lượng tài liệu áp dụng',
        'promo_status'         => 'Trạng thái',
        'date'                 => $cols['date']
    ];
    return $new;
}
add_filter( 'manage_promo_campaign_posts_columns', 'hieucon_promo_campaign_columns' );

function hieucon_promo_campaign_column_content( $col, $post_id ) {
    if ( $col === 'promo_discount' ) {
        $type  = get_post_meta( $post_id, '_promo_discount_type', true );
        $value = get_post_meta( $post_id, '_promo_discount_value', true );
        if ( $type === 'percent' ) {
            echo '<strong style="color:#ef4444;">Giảm ' . $value . '%</strong>';
        } else {
            echo '<strong style="color:#ef4444;">Giảm -' . number_format( floatval( $value ), 0, ',', '.' ) . 'đ</strong>';
        }
    }
    if ( $col === 'promo_target_col' ) {
        $target = get_post_meta( $post_id, '_promo_target', true );
        if ( $target === 'new' ) {
            echo '<span style="background:#fff7ed;color:#ea580c;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Khách mới</span>';
        } elseif ( $target === 'loyal' ) {
            echo '<span style="background:#eff6ff;color:#1d4ed8;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Hội viên</span>';
        } else {
            echo '<span style="background:#f1f5f9;color:#334155;padding:3px 10px;border-radius:12px;font-weight:600;font-size:11px;">Tất cả</span>';
        }
    }
    if ( $col === 'promo_applied_count' ) {
        $applied = get_post_meta( $post_id, '_promo_applied_ebooks', true );
        $count = is_array( $applied ) ? count( $applied ) : 0;
        echo '<strong>' . $count . ' tài liệu</strong>';
    }
    if ( $col === 'promo_status' ) {
        $active = get_post_meta( $post_id, '_promo_active', true );
        if ( $active === 'yes' ) {
            echo '<span style="color:#22c55e;font-weight:700;">Đang hoạt động</span>';
        } else {
            echo '<span style="color:#9ca3af;">Đã tạm dừng</span>';
        }
    }
}
add_action( 'manage_promo_campaign_posts_custom_column', 'hieucon_promo_campaign_column_content', 10, 2 );
