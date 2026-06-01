<?php
/**
 * Ebook Custom Post Type & Meta Configuration
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// 1. ĐĂNG KÝ CPT EBOOK & TAXONOMY EBOOK_CAT
// ============================================================
function hieucon_ebook_register_cpts() {
    // A. Đăng ký Taxonomy: Danh mục Ebook (ebook_cat)
    $cat_labels = [
        'name'              => 'Danh mục Ebook',
        'singular_name'     => 'Danh mục Ebook',
        'search_items'      => 'Tìm danh mục',
        'all_items'         => 'Tất cả danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
        'edit_item'         => 'Sửa danh mục',
        'update_item'       => 'Cập nhật danh mục',
        'add_new_item'      => 'Thêm danh mục mới',
        'new_item_name'     => 'Tên danh mục mới',
        'menu_name'         => 'Danh mục Ebook',
    ];

    register_taxonomy( 'ebook_cat', [ 'ebook' ], [
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'ebook-category' ],
    ] );

    // B. Đăng ký CPT: Ebook (ebook)
    $ebook_labels = [
        'name'               => 'Ebook',
        'singular_name'      => 'Ebook',
        'menu_name'          => 'Ebooks & Tài liệu',
        'name_admin_bar'     => 'Ebook',
        'add_new'            => 'Thêm Ebook mới',
        'add_new_item'       => 'Thêm Ebook mới',
        'new_item'           => 'Ebook mới',
        'edit_item'          => 'Sửa Ebook',
        'view_item'          => 'Xem Ebook',
        'all_items'          => 'Tất cả Ebook',
        'search_items'       => 'Tìm Ebook',
        'parent_item_colon'  => 'Ebook cha:',
        'not_found'          => 'Không tìm thấy Ebook nào.',
        'not_found_in_trash' => 'Không tìm thấy Ebook nào trong thùng rác.'
    ];

    register_post_type( 'ebook', [
        'labels'             => $ebook_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'ebooks' ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ],
    ] );
}
add_action( 'init', 'hieucon_ebook_register_cpts' );

// ============================================================
// 2. ĐĂNG KÝ METABOX CẤU HÌNH EBOOK TRONG ADMIN
// ============================================================
function hieucon_ebook_add_meta_boxes() {
    add_meta_box(
        'hieucon_ebook_settings',
        'Cấu hình Ebook & Tài liệu',
        'hieucon_ebook_metabox_html',
        'ebook',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hieucon_ebook_add_meta_boxes' );

function hieucon_ebook_metabox_html( $post ) {
    wp_nonce_field( 'hieucon_ebook_meta_nonce', 'ebook_meta_nonce' );

    $price      = get_post_meta( $post->ID, '_ebook_price', true );
    $pdf_url    = get_post_meta( $post->ID, '_ebook_pdf_url', true );
    $pages      = get_post_meta( $post->ID, '_ebook_pages', true );
    $sample_url = get_post_meta( $post->ID, '_ebook_sample_url', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ebook_price">Giá bán (VND)</label></th>
            <td>
                <input type="number" id="ebook_price" name="ebook_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="Ví dụ: 200000. Để trống hoặc 0 nếu Miễn phí.">
            </td>
        </tr>
        <tr>
            <th><label for="ebook_pdf_url">Đường dẫn tệp PDF gốc</label></th>
            <td>
                <input type="text" id="ebook_pdf_url" name="ebook_pdf_url" value="<?php echo esc_attr( $pdf_url ); ?>" class="large-text" placeholder="Tải lên thư viện Media và dán link file .pdf vào đây">
                <button type="button" class="button hieucon-upload-pdf-btn">Tải tệp từ Media</button>
            </td>
        </tr>
        <tr>
            <th><label for="ebook_pages">Số trang</label></th>
            <td>
                <input type="number" id="ebook_pages" name="ebook_pages" value="<?php echo esc_attr( $pages ); ?>" class="regular-text" placeholder="Ví dụ: 120" min="1">
            </td>
        </tr>
        <tr>
            <th><label for="ebook_sample_url">Tệp đọc thử (PDF trích dẫn - Optional)</label></th>
            <td>
                <input type="text" id="ebook_sample_url" name="ebook_sample_url" value="<?php echo esc_attr( $sample_url ); ?>" class="large-text" placeholder="Link PDF đọc thử (ví dụ: 10 trang đầu)">
            </td>
        </tr>
    </table>

    <!-- Javascript nạp thư viện WP Media Uploader chuyên nghiệp -->
    <script>
        jQuery(document).ready(function($) {
            $('.hieucon-upload-pdf-btn').click(function(e) {
                e.preventDefault();
                var button = $(this);
                var inputField = button.prev('input');
                var custom_uploader = wp.media({
                    title: 'Chọn tệp Ebook PDF',
                    button: {
                        text: 'Sử dụng tệp này'
                    },
                    multiple: false
                }).on('select', function() {
                    var attachment = custom_uploader.state().get('selection').first().toJSON();
                    inputField.val(attachment.url);
                }).open();
            });
        });
    </script>
    <?php
}

function hieucon_ebook_save_meta_boxes( $post_id ) {
    if ( isset( $_POST['ebook_meta_nonce'] ) && wp_verify_nonce( $_POST['ebook_meta_nonce'], 'hieucon_ebook_meta_nonce' ) ) {
        if ( isset( $_POST['ebook_price'] ) ) {
            update_post_meta( $post_id, '_ebook_price', floatval( $_POST['ebook_price'] ) );
        }
        if ( isset( $_POST['ebook_pdf_url'] ) ) {
            update_post_meta( $post_id, '_ebook_pdf_url', sanitize_text_field( $_POST['ebook_pdf_url'] ) );
        }
        if ( isset( $_POST['ebook_pages'] ) ) {
            update_post_meta( $post_id, '_ebook_pages', intval( $_POST['ebook_pages'] ) );
        }
        if ( isset( $_POST['ebook_sample_url'] ) ) {
            update_post_meta( $post_id, '_ebook_sample_url', sanitize_text_field( $_POST['ebook_sample_url'] ) );
        }
    }
}
add_action( 'save_post', 'hieucon_ebook_save_meta_boxes' );

// ============================================================
// 3. THÊM CỘT TÙY CHỈNH DANH SÁCH EBOOK TRONG ADMIN
// ============================================================
function hieucon_ebook_columns( $cols ) {
    $new = [];
    foreach ( $cols as $key => $val ) {
        $new[ $key ] = $val;
        if ( $key === 'title' ) {
            $new['ebook_price']     = 'Giá bán';
            $new['ebook_pages']     = 'Số trang';
            $new['ebook_enrolled']  = 'Lượt mua';
        }
    }
    return $new;
}
add_filter( 'manage_ebook_posts_columns', 'hieucon_ebook_columns' );

function hieucon_ebook_column_content( $col, $post_id ) {
    if ( $col === 'ebook_price' ) {
        $price = get_post_meta( $post_id, '_ebook_price', true );
        if ( $price == 0 ) {
            echo '<span style="color:#22c55e;font-weight:700;">Miễn phí</span>';
        } else {
            echo '<strong>' . number_format( $price, 0, ',', '.' ) . 'đ</strong>';
        }
    }
    if ( $col === 'ebook_pages' ) {
        $pages = get_post_meta( $post_id, '_ebook_pages', true );
        echo $pages ? intval( $pages ) . ' trang' : '<span style="color:#9ca3af;">—</span>';
    }
    if ( $col === 'ebook_enrolled' ) {
        global $wpdb;
        $count = (int) $wpdb->get_var( $wpdb->prepare(
            "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s AND option_value LIKE %s",
            'hieucon_enrolled_ebooks_%',
            '%:' . $post_id . ';%'
        ) );
        echo '<span style="background:#f0fdf4;color:#15803d;padding:2px 10px;border-radius:999px;font-weight:700;font-size:12px;">' . $count . ' lượt</span>';
    }
}
add_action( 'manage_ebook_posts_custom_column', 'hieucon_ebook_column_content', 10, 2 );

// ============================================================
// 4. CÁC HÀM BỔ TRỢ GHI DANH / QUẢN LÝ QUYỀN SỞ HỮU EBOOK
// ============================================================

/**
 * Lấy danh sách Ebook đã mua của Hội viên
 */
function hieucon_get_member_enrolled_ebooks( $member_id ) {
    $member_id = intval( $member_id );
    if ( ! $member_id ) {
        return [];
    }

    $enrolled = get_option( "hieucon_enrolled_ebooks_{$member_id}", null );
    if ( ! is_array( $enrolled ) ) {
        $enrolled = [];
    }
    return $enrolled;
}

/**
 * Cập nhật danh sách Ebook đã mua của Hội viên
 */
function hieucon_update_member_enrolled_ebooks( $member_id, $ebook_ids ) {
    $member_id = intval( $member_id );
    $ebook_ids = array_values( array_filter( array_map( 'intval', (array) $ebook_ids ) ) );

    if ( ! $member_id ) {
        return;
    }

    update_option( "hieucon_enrolled_ebooks_{$member_id}", $ebook_ids, false );
}
