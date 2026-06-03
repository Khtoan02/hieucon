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
    // A. Đăng ký Taxonomy: Danh mục Tài liệu (ebook_cat)
    $cat_labels = [
        'name'              => 'Danh mục Tài liệu',
        'singular_name'     => 'Danh mục Tài liệu',
        'search_items'      => 'Tìm danh mục',
        'all_items'         => 'Tất cả danh mục',
        'parent_item'       => 'Danh mục cha',
        'parent_item_colon' => 'Danh mục cha:',
        'edit_item'         => 'Sửa danh mục',
        'update_item'       => 'Cập nhật danh mục',
        'add_new_item'      => 'Thêm danh mục mới',
        'new_item_name'     => 'Tên danh mục mới',
        'menu_name'         => 'Danh mục Tài liệu',
    ];

    register_taxonomy( 'ebook_cat', [ 'ebook' ], [
        'hierarchical'      => true,
        'labels'            => $cat_labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => [ 'slug' => 'docs-category' ],
    ] );

    // B. Đăng ký CPT: Ebook (ebook) - Thay đổi nhãn thành Tài liệu bồi dưỡng
    $ebook_labels = [
        'name'               => 'Tài liệu bồi dưỡng',
        'singular_name'      => 'Tài liệu bồi dưỡng',
        'menu_name'          => 'Tài liệu bồi dưỡng',
        'name_admin_bar'     => 'Tài liệu bồi dưỡng',
        'add_new'            => 'Thêm Tài liệu mới',
        'add_new_item'       => 'Thêm Tài liệu mới',
        'new_item'           => 'Tài liệu mới',
        'edit_item'          => 'Sửa Tài liệu',
        'view_item'          => 'Xem Tài liệu',
        'all_items'          => 'Tất cả Tài liệu',
        'search_items'       => 'Tìm Tài liệu',
        'parent_item_colon'  => 'Tài liệu cha:',
        'not_found'          => 'Không tìm thấy tài liệu nào.',
        'not_found_in_trash' => 'Không tìm thấy tài liệu nào trong thùng rác.'
    ];

    register_post_type( 'ebook', [
        'labels'             => $ebook_labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => [ 'slug' => 'docs' ],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 26,
        'menu_icon'          => 'dashicons-book-alt',
        'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ],
    ] );
}
add_action( 'init', 'hieucon_ebook_register_cpts' );

/**
 * Tự động flush rewrite rules một lần duy nhất khi khởi chạy hệ thống Ebook mới
 * để tránh lỗi 404 hoặc lỗi chuyển hướng lặp lặp (ERR_TOO_MANY_REDIRECTS) trên host live.
 */
function hieucon_ebook_flush_rules_once() {
    if ( ! get_option( 'hieucon_ebook_rules_flushed_v2' ) ) {
        flush_rewrite_rules( false );
        update_option( 'hieucon_ebook_rules_flushed_v2', '1' );
    }
}
add_action( 'init', 'hieucon_ebook_flush_rules_once', 99 );

// ============================================================
// 2. ĐĂNG KÝ METABOX CẤU HÌNH EBOOK TRONG ADMIN
// ============================================================
function hieucon_ebook_add_meta_boxes() {
    add_meta_box(
        'hieucon_ebook_settings',
        'Cấu hình Tài liệu bồi dưỡng',
        'hieucon_ebook_metabox_html',
        'ebook',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'hieucon_ebook_add_meta_boxes' );

function hieucon_ebook_metabox_html( $post ) {
    wp_nonce_field( 'hieucon_ebook_meta_nonce', 'ebook_meta_nonce' );

    $price         = get_post_meta( $post->ID, '_ebook_price', true );
    $pdf_url       = get_post_meta( $post->ID, '_ebook_pdf_url', true );
    $pages         = get_post_meta( $post->ID, '_ebook_pages', true );
    $sample_url    = get_post_meta( $post->ID, '_ebook_sample_url', true );
    ?>
    <table class="form-table">
        <tr>
            <th><label for="ebook_price">Giá bán thường (VND)</label></th>
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
            $price_val = $_POST['ebook_price'];
            if ( $price_val === '' ) {
                update_post_meta( $post_id, '_ebook_price', '' );
            } else {
                update_post_meta( $post_id, '_ebook_price', floatval( $price_val ) );
            }
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

        // Dọn dẹp trường khuyến mãi cũ (nếu có) để tránh dữ liệu rác trong database
        delete_post_meta( $post_id, '_ebook_promo_enabled' );
        delete_post_meta( $post_id, '_ebook_sale_price' );
        delete_post_meta( $post_id, '_ebook_promo_target' );
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
        $price_details = hieucon_get_ebook_price_details( $post_id );
        $price         = $price_details['display_price'];
        $orig_price    = $price_details['original_price'];
        $is_promo      = $price_details['is_promo_active'];
        
        if ( $orig_price === '' || is_null( $orig_price ) ) {
            echo '<span style="color:#9ca3af;">Chưa đặt giá</span>';
        } elseif ( floatval( $orig_price ) === 0.0 ) {
            echo '<span style="color:#22c55e;font-weight:700;">Miễn phí</span>';
        } else {
            $formatted_orig = number_format( floatval( $orig_price ), 0, ',', '.' ) . 'đ';
            if ( $is_promo && ! is_null( $price ) ) {
                $formatted_sale = number_format( floatval( $price ), 0, ',', '.' ) . 'đ';
                $target_label = 'Mọi khách';
                if ( $price_details['promo_target'] === 'new' ) {
                    $target_label = 'Khách mới';
                } elseif ( $price_details['promo_target'] === 'loyal' ) {
                    $target_label = 'Hội viên';
                }
                
                $promo_badge = ! empty( $price_details['promo_title'] ) ? $price_details['promo_title'] : $target_label;
                
                echo '<strong style="color:#ef4444;">' . $formatted_sale . '</strong> ';
                echo '<span style="text-decoration:line-through;color:#9ca3af;font-size:11px;">' . $formatted_orig . '</span> ';
                echo '<span style="font-size:10px;background:#fff7ed;color:#ea580c;border:1px solid #ffedd5;padding:1px 5px;border-radius:4px;font-weight:600;" title="' . esc_attr( $price_details['promo_title'] ) . '">' . esc_html( $promo_badge ) . '</span>';
            } else {
                echo '<strong>' . $formatted_orig . '</strong>';
            }
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

/**
 * Kiểm tra xem Hội viên có phải là khách hàng thân thiết không (đã sở hữu khóa học hoặc ebook nào chưa)
 */
function hieucon_is_member_loyal_customer( $member_id ) {
    $member_id = intval( $member_id );
    if ( ! $member_id ) {
        return false;
    }

    // Kiểm tra đã sở hữu khóa học nào chưa
    if ( function_exists( 'hieucon_get_member_enrolled_courses' ) ) {
        $courses = hieucon_get_member_enrolled_courses( $member_id );
        if ( ! empty( $courses ) ) {
            return true;
        }
    }

    // Kiểm tra đã sở hữu ebook nào chưa
    $ebooks = hieucon_get_member_enrolled_ebooks( $member_id );
    if ( ! empty( $ebooks ) ) {
        return true;
    }

    return false;
}

/**
 * Lấy thông tin chi tiết về giá bán Ebook (bao gồm giá gốc và khuyến mãi đang áp dụng)
 */
function hieucon_get_ebook_price_details( $ebook_id ) {
    $raw_price      = get_post_meta( $ebook_id, '_ebook_price', true );
    $original_price = ( $raw_price !== '' ) ? floatval( $raw_price ) : null;

    $display_price   = $original_price;
    $is_promo_active = false;
    $applied_promo_title = '';
    $applied_promo_target = 'all';

    // Nếu Ebook chưa cấu hình giá thường hoặc là miễn phí, không áp dụng khuyến mãi
    if ( is_null( $original_price ) || $original_price === 0.0 ) {
        return [
            'original_price'  => $original_price,
            'display_price'   => $display_price,
            'is_promo_active' => $is_promo_active,
            'promo_title'     => $applied_promo_title,
            'promo_target'    => $applied_promo_target,
        ];
    }

    // Truy vấn tất cả các chiến dịch khuyến mãi đang hoạt động
    $campaigns = get_posts( [
        'post_type'      => 'promo_campaign',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'meta_query'     => [
            [
                'key'     => '_promo_active',
                'value'   => 'yes',
                'compare' => '='
            ]
        ]
    ] );

    if ( ! empty( $campaigns ) ) {
        $current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
        $lowest_price   = $original_price;

        foreach ( $campaigns as $campaign ) {
            $applied_ebooks = get_post_meta( $campaign->ID, '_promo_applied_ebooks', true );
            if ( ! is_array( $applied_ebooks ) ) {
                $applied_ebooks = [];
            }

            // Kiểm tra Ebook này có thuộc chiến dịch không
            if ( in_array( $ebook_id, $applied_ebooks ) ) {
                $promo_target   = get_post_meta( $campaign->ID, '_promo_target', true );
                $discount_type  = get_post_meta( $campaign->ID, '_promo_discount_type', true );
                $discount_value = floatval( get_post_meta( $campaign->ID, '_promo_discount_value', true ) );

                $is_eligible = false;
                if ( $promo_target === 'all' ) {
                    $is_eligible = true;
                } elseif ( $promo_target === 'new' ) {
                    if ( ! $current_member || ! hieucon_is_member_loyal_customer( $current_member->id ) ) {
                        $is_eligible = true;
                    }
                } elseif ( $promo_target === 'loyal' ) {
                    if ( $current_member && hieucon_is_member_loyal_customer( $current_member->id ) ) {
                        $is_eligible = true;
                    }
                }

                if ( $is_eligible ) {
                    $temp_price = $original_price;
                    if ( $discount_type === 'percent' ) {
                        $temp_price = $original_price * ( 1 - $discount_value / 100 );
                    } elseif ( $discount_type === 'fixed' ) {
                        $temp_price = $original_price - $discount_value;
                    }
                    
                    $temp_price = max( 0.0, $temp_price );

                    // Tìm mức giá ưu đãi nhất (thấp nhất) cho khách hàng
                    if ( $temp_price < $lowest_price ) {
                        $lowest_price         = $temp_price;
                        $is_promo_active      = true;
                        $applied_promo_title  = $campaign->post_title;
                        $applied_promo_target = $promo_target;
                    }
                }
            }
        }

        $display_price = $lowest_price;
    }

    return [
        'original_price'  => $original_price,
        'display_price'   => $display_price,
        'is_promo_active' => $is_promo_active,
        'promo_title'     => $applied_promo_title,
        'promo_target'    => $applied_promo_target,
    ];
}
