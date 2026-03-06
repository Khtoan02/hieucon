<?php
/**
 * Theo dõi Lượt xem và Click ra ngoài
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// 1. Theo dõi lượt xem trang (Page Views)
function hieucon_track_page_view() {
    if ( is_single() || is_page() ) {
        global $post;
        // Tăng lượt xem
        $views = get_post_meta( $post->ID, '_hieucon_page_views', true );
        $views = $views ? intval( $views ) + 1 : 1;
        update_post_meta( $post->ID, '_hieucon_page_views', $views );
    }
}
// Chạy hàm đếm view ngay khi WP render thẻ head
add_action( 'wp_head', 'hieucon_track_page_view' );

// 2. Điểm cuối AJAX cho Lượt Click ra (Click-out)
function hieucon_track_click_ajax() {
    $post_id = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    if ( $post_id ) {
        $clicks = get_post_meta( $post_id, '_hieucon_page_clicks', true );
        $clicks = $clicks ? intval( $clicks ) + 1 : 1;
        update_post_meta( $post_id, '_hieucon_page_clicks', $clicks );
    }
    wp_die();
}
// Đăng ký API AJAX cho user đang login lẫn khách chưa login
add_action( 'wp_ajax_hieucon_track_click', 'hieucon_track_click_ajax' );
add_action( 'wp_ajax_nopriv_hieucon_track_click', 'hieucon_track_click_ajax' );

// 3. Nhúng Script bắt sự kiện click ra link ngoài
function hieucon_tracking_script() {
    if ( is_single() || is_page() ) {
        global $post;
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var currentDomain = window.location.hostname;
            // Tìm toàn bộ thẻ A có http hoặc https
            var links = document.querySelectorAll('a[href^="http"]');
            
            links.forEach(function(link) {
                // Kiểm tra nếu link trỏ ra ngoài domain hiện tại
                if (link.hostname && link.hostname !== currentDomain) {
                    link.addEventListener('click', function() {
                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                        // Gửi post_id ẩn danh về WP Admin
                        xhr.send('action=hieucon_track_click&post_id=<?php echo $post->ID; ?>');
                    });
                }
            });
        });
        </script>
        <?php
    }
}
// Đẩy JS xuống cuối trang để tăng tốc độ load
add_action( 'wp_footer', 'hieucon_tracking_script', 99 );

// 4. Bổ sung cột Thống kê trong màn hình Quản trị (Admin)
function hieucon_add_tracking_columns( $columns ) {
    $new_columns = array();
    foreach ( $columns as $key => $title ) {
        if ( $key == 'date' ) {
            // Chèn vào trước cột Ngày tháng (date)
            $new_columns['page_views'] = 'Lượt xem';
            $new_columns['click_outs'] = 'Click ra (Out)';
        }
        $new_columns[$key] = $title;
    }
    return $new_columns;
}
add_filter( 'manage_pages_columns', 'hieucon_add_tracking_columns' );
add_filter( 'manage_posts_columns', 'hieucon_add_tracking_columns' );

// 5. Hiển thị dữ liệu trong cột
function hieucon_show_tracking_columns( $column_name, $post_id ) {
    if ( $column_name == 'page_views' ) {
        $views = get_post_meta( $post_id, '_hieucon_page_views', true );
        echo $views ? '<strong>' . esc_html( $views ) . '</strong>' : '0';
    }
    if ( $column_name == 'click_outs' ) {
        $clicks = get_post_meta( $post_id, '_hieucon_page_clicks', true );
        echo $clicks ? '<strong style="color:#d63638;">' . esc_html( $clicks ) . '</strong>' : '0';
    }
}
add_action( 'manage_pages_custom_column', 'hieucon_show_tracking_columns', 10, 2 );
add_action( 'manage_posts_custom_column', 'hieucon_show_tracking_columns', 10, 2 );

// 6. Cho phép sắp xếp (Sort) theo cột lượt xem và click
function hieucon_sortable_tracking_columns( $columns ) {
    $columns['page_views'] = 'page_views';
    $columns['click_outs'] = 'click_outs';
    return $columns;
}
add_filter( 'manage_edit-page_sortable_columns', 'hieucon_sortable_tracking_columns' );
add_filter( 'manage_edit-post_sortable_columns', 'hieucon_sortable_tracking_columns' );

function hieucon_tracking_orderby( $query ) {
    if ( ! is_admin() || ! $query->is_main_query() ) {
        return;
    }
    
    $orderby = $query->get( 'orderby' );

    if ( 'page_views' == $orderby ) {
        $query->set( 'meta_key', '_hieucon_page_views' );
        $query->set( 'orderby', 'meta_value_num' );
    }
    if ( 'click_outs' == $orderby ) {
        $query->set( 'meta_key', '_hieucon_page_clicks' );
        $query->set( 'orderby', 'meta_value_num' );
    }
}
add_action( 'pre_get_posts', 'hieucon_tracking_orderby' );
