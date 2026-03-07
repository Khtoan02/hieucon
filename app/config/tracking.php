<?php
/**
 * Theo dõi Truy cập, Lượt xem, Unique, Click ra ngoài và Thời gian giữ chân
 * Cập nhật: Sử dụng AJAX, đo lường Cookie, thời gian đọc thực tế so với kỳ vọng.
 *
 * @package Hieucon
 */

if (!defined('ABSPATH')) {
    exit;
}

// 1. Endpoint: Lượt xem (Views) & Khách truy cập (Unique)
function hieucon_track_view_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $is_unique = isset($_POST['is_unique']) ? intval($_POST['is_unique']) : 0;
    
    if ($post_id) {
        $views = get_post_meta($post_id, '_hieucon_page_views', true);
        update_post_meta($post_id, '_hieucon_page_views', intval($views) + 1);

        if ($is_unique === 1) {
            $uniques = get_post_meta($post_id, '_hieucon_unique_views', true);
            update_post_meta($post_id, '_hieucon_unique_views', intval($uniques) + 1);
        }
    }
    wp_die();
}
add_action('wp_ajax_hieucon_track_view', 'hieucon_track_view_ajax');
add_action('wp_ajax_nopriv_hieucon_track_view', 'hieucon_track_view_ajax');

// 2. Endpoint: Lượt Click ra (Click-out)
function hieucon_track_click_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    if ($post_id) {
        $clicks = get_post_meta($post_id, '_hieucon_page_clicks', true);
        update_post_meta($post_id, '_hieucon_page_clicks', intval($clicks) + 1);
    }
    wp_die();
}
add_action('wp_ajax_hieucon_track_click', 'hieucon_track_click_ajax');
add_action('wp_ajax_nopriv_hieucon_track_click', 'hieucon_track_click_ajax');

// 3. Endpoint: Thời gian trên trang (Time on Page)
function hieucon_track_time_ajax()
{
    $post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
    $time_spent = isset($_POST['time_spent']) ? intval($_POST['time_spent']) : 0;
    $estimated_time = isset($_POST['estimated_time']) ? intval($_POST['estimated_time']) : 30;

    if ($post_id && $time_spent > 0) {
        // Cộng dồn tổng thời gian (giây) mà tất cả user lưu lại
        $total_time = get_post_meta($post_id, '_hieucon_total_time', true);
        update_post_meta($post_id, '_hieucon_total_time', intval($total_time) + $time_spent);
        
        // Cập nhật lại thời gian đọc dự kiến
        update_post_meta($post_id, '_hieucon_estimated_time', $estimated_time);
    }
    wp_die();
}
add_action('wp_ajax_hieucon_track_time', 'hieucon_track_time_ajax');
add_action('wp_ajax_nopriv_hieucon_track_time', 'hieucon_track_time_ajax');

// 4. Nhúng Script Bắt sự kiện Tổng hợp
function hieucon_tracking_script()
{
    if (is_single() || is_page()) {
        global $post;
        ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var post_id = <?php echo $post->ID; ?>;
                var ajaxurl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
                
                // === A. KIỂM TRA UNIQUE VÀ ĐẾM VIEW ===
                var cookieName = 'hieucon_visited_' + post_id;
                var isUnique = 0;
                // Kiểm tra Cookie - nếu chưa có tức là Unique
                if (!document.cookie.split('; ').find(row => row.startsWith(cookieName + '='))) {
                    isUnique = 1;
                    // Đặt cookie 30 ngày
                    document.cookie = cookieName + '=1; max-age=' + (60*60*24*30) + '; path=/';
                }
                
                var xhrView = new XMLHttpRequest();
                xhrView.open('POST', ajaxurl, true);
                xhrView.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                xhrView.send('action=hieucon_track_view&post_id=' + post_id + '&is_unique=' + isUnique);

                // === B. ĐẾM SỰ KIỆN CLICK OUT ===
                var currentDomain = window.location.hostname;
                var links = document.querySelectorAll('a[href^="http"]');
                links.forEach(function (link) {
                    if (link.hostname && link.hostname !== currentDomain) {
                        link.addEventListener('click', function () {
                            var xhrClick = new XMLHttpRequest();
                            xhrClick.open('POST', ajaxurl, true);
                            xhrClick.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
                            xhrClick.send('action=hieucon_track_click&post_id=' + post_id);
                        });
                    }
                });

                // === C. ĐO LƯỜNG THỜI GIAN VÀ RETENTION ===
                var startTime = Date.now();
                // Thuật toán đo tốc độ đọc trung bình (200 chữ/phút)
                var wordCount = document.body.innerText.split(/\s+/).length || 500;
                var estimatedTimeSec = Math.max(30, Math.ceil((wordCount / 200) * 60)); 
                
                function logTimeSpent(isFinal) {
                    var timeSpent = Math.floor((Date.now() - startTime) / 1000);
                    // Lọc nhiễu: Chỉ lưu khi thời gian > 3s và < 2 tiếng (tránh máy treo)
                    if (timeSpent > 3 && timeSpent < 7200) {
                        var data = new FormData();
                        data.append('action', 'hieucon_track_time');
                        data.append('post_id', post_id);
                        data.append('time_spent', timeSpent);
                        data.append('estimated_time', estimatedTimeSec);
                        
                        if (navigator.sendBeacon) {
                            navigator.sendBeacon(ajaxurl, data);
                        } else {
                            var xhrTime = new XMLHttpRequest();
                            xhrTime.open('POST', ajaxurl, false); // đồng bộ
                            xhrTime.send(data);
                        }
                    }
                    if (!isFinal) {
                        // Reset lại mốc tính thời gian cho nhịp đo tiếp theo
                        startTime = Date.now();
                    }
                }

                // Khi user nhảy sang thẻ tab khác
                document.addEventListener('visibilitychange', function() {
                    if (document.visibilityState === 'hidden') {
                        logTimeSpent(false);
                    } else if (document.visibilityState === 'visible') {
                        // Trở lại đọc bài
                        startTime = Date.now();
                    }
                });

                // Khi user đóng trình duyệt
                window.addEventListener('beforeunload', function() {
                     logTimeSpent(true);
                });
                
                // Backup gửi nhịp nhịp mỗi 30s phòng trường hợp safari/điện thoại ngắt ngang
                setInterval(function() {
                    if (document.visibilityState === 'visible') {
                        logTimeSpent(false);
                    }
                }, 30000);
            });
        </script>
        <?php
    }
}
add_action('wp_footer', 'hieucon_tracking_script', 99);

// 5. CỘT THỐNG KÊ ADMIN (Kết hợp toàn bộ số liệu 1 cột) cho toàn bộ Post Type
function hieucon_add_tracking_columns($columns)
{
    $new_columns = array();
    foreach ($columns as $key => $title) {
        if ($key == 'date') {
            $new_columns['page_metrics'] = 'Thông số Analytics';
        }
        $new_columns[$key] = $title;
    }
    return $new_columns;
}

function hieucon_register_tracking_columns() {
    $post_types = get_post_types(array('public' => true), 'names');
    foreach ($post_types as $post_type) {
        add_filter("manage_{$post_type}_posts_columns", 'hieucon_add_tracking_columns');
        add_action("manage_{$post_type}_posts_custom_column", 'hieucon_show_tracking_columns', 10, 2);
        add_filter("manage_edit-{$post_type}_sortable_columns", 'hieucon_sortable_tracking_columns');
    }
}
add_action('admin_init', 'hieucon_register_tracking_columns');

// 6. Tính toán & Hiển thị chỉ số
function hieucon_show_tracking_columns($column_name, $post_id)
{
    if ($column_name == 'page_metrics') {
        $views = intval(get_post_meta($post_id, '_hieucon_page_views', true));
        $uniques = intval(get_post_meta($post_id, '_hieucon_unique_views', true));
        $clicks = intval(get_post_meta($post_id, '_hieucon_page_clicks', true));
        
        $total_time = intval(get_post_meta($post_id, '_hieucon_total_time', true));
        $estimated = intval(get_post_meta($post_id, '_hieucon_estimated_time', true)) ?: 30;
        
        // Tính thời gian Active Time trung bình trên 1 Unique User (hoặc fallback về Views nếu Unique hỏng)
        $avg_time = 0;
        if ($uniques > 0) {
            $avg_time = round($total_time / $uniques);
        } elseif ($views > 0) {
            $avg_time = round($total_time / $views);
        }

        // Ước lượng Tỉ lệ giữ chân (Retention %)
        $retention = 0;
        if ($estimated > 0) {
            $retention = min(100, round(($avg_time / $estimated) * 100)); // Không vượt 100%
        }

        // Định dạng ra format phút:giây
        $avg_time_formatted = sprintf('%02dm %02ds', floor($avg_time / 60), $avg_time % 60);

        echo '<div style="font-size:13px; line-height:1.6;">';
        echo '<div style="margin-bottom:4px;">👁️ Lượt xem: <strong>' . $views . '</strong> <span style="color:#646970;">(UV: <strong>' . $uniques . '</strong>)</span></div>';
        echo '<div style="margin-bottom:4px;" title="Thời gian đọc dự kiến: '. sprintf('%02dm %02ds', floor($estimated / 60), $estimated % 60) .'">⌚ Thời gian ở lại TB: <strong>' . $avg_time_formatted . '</strong></div>';
        
        // Cảnh báo màu theo Retention
        $retention_color = $retention > 50 ? '#00a32a' : ($retention > 20 ? '#d63638' : '#646970');
        echo '<div style="margin-bottom:4px;">🔥 Tỉ lệ giữ chân: <strong style="color:'. $retention_color .';">' . $retention . '%</strong></div>';
        
        echo '<div>🔗 Click-out: <strong style="color:#2271b1;">' . $clicks . '</strong></div>';
        echo '</div>';
    }
}
// Đã được đăng ký tự động qua hieucon_register_tracking_columns

// 7. Sort Analytics (Theo lượt views)
function hieucon_sortable_tracking_columns($columns)
{
    $columns['page_metrics'] = 'page_views';
    return $columns;
}
add_filter('manage_edit-page_sortable_columns', 'hieucon_sortable_tracking_columns');
add_filter('manage_edit-post_sortable_columns', 'hieucon_sortable_tracking_columns');

function hieucon_tracking_orderby($query)
{
    if (!is_admin() || !$query->is_main_query()) {
        return;
    }
    $orderby = $query->get('orderby');
    if ('page_views' == $orderby) {
        $query->set('meta_key', '_hieucon_page_views');
        $query->set('orderby', 'meta_value_num');
    }
}
add_action('pre_get_posts', 'hieucon_tracking_orderby');

// 8. BẢNG ĐIỀU KHIỂN (DASHBOARD WIDGET) TỔNG QUAN
function hieucon_analytics_dashboard_widget() {
    global $wpdb;

    // Lấy top 5 bài viết/trang có lượt xem nhiều nhất
    $top_posts = $wpdb->get_results("
        SELECT p.ID, p.post_title, m.meta_value as views
        FROM {$wpdb->posts} p
        INNER JOIN {$wpdb->postmeta} m ON p.ID = m.post_id
        WHERE p.post_status = 'publish' AND m.meta_key = '_hieucon_page_views'
        ORDER BY CAST(m.meta_value AS UNSIGNED) DESC
        LIMIT 5
    ");

    echo '<div style="margin:-11px -12px;">';
    echo '<div style="background:#f0f6fc; padding:15px; border-bottom:1px solid #c3c4c7;">';
    echo '<p style="margin:0; font-size:14px; color:#1d2327;">Đây là bảng tổng hợp và xếp hạng các trang (Landing Page, Bài viết) thu hút khách truy cập hiệu quả nhất dựa trên công cụ Tracking nội bộ (Cookie & Beacon API).</p>';
    echo '</div>';

    if ($top_posts) {
        echo '<table class="wp-list-table widefat fixed striped" style="border:none;">';
        echo '<thead><tr>';
        echo '<th style="font-weight:bold; width: 40%;">Tên Trang</th>';
        echo '<th style="font-weight:bold; text-align:center;">Lượt xem</th>';
        echo '<th style="font-weight:bold; text-align:center;">Khách (UV)</th>';
        echo '<th style="font-weight:bold; text-align:center;">Giữ chân %</th>';
        echo '<th style="font-weight:bold; text-align:center;">Click <i class="dashicons dashicons-external" style="font-size:14px;"></i></th>';
        echo '</tr></thead><tbody>';

        foreach ($top_posts as $post) {
            $views = intval(get_post_meta($post->ID, '_hieucon_page_views', true));
            $uniques = intval(get_post_meta($post->ID, '_hieucon_unique_views', true));
            $clicks = intval(get_post_meta($post->ID, '_hieucon_page_clicks', true));
            $total_time = intval(get_post_meta($post->ID, '_hieucon_total_time', true));
            $estimated = intval(get_post_meta($post->ID, '_hieucon_estimated_time', true)) ?: 30;

            $avg_time = ($uniques > 0) ? round($total_time / $uniques) : (($views > 0) ? round($total_time / $views) : 0);
            $retention = ($estimated > 0) ? min(100, round(($avg_time / $estimated) * 100)) : 0;
            $ret_color = $retention > 50 ? '#00a32a' : ($retention > 20 ? '#d63638' : '#72777c');

            $edit_link = get_edit_post_link($post->ID);
            $title = wp_trim_words($post->post_title, 8, '...');

            echo '<tr>';
            echo '<td><strong><a href="'. esc_url($edit_link) .'">'. esc_html($title) .'</a></strong></td>';
            echo '<td style="text-align:center;"><strong>'. $views .'</strong></td>';
            echo '<td style="text-align:center;">'. $uniques .'</td>';
            echo '<td style="text-align:center;"><strong style="color: '. $ret_color .'">'. $retention .'%</strong></td>';
            echo '<td style="text-align:center; color:#2271b1;"><strong>'. $clicks .'</strong></td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    } else {
        echo '<div style="padding:20px; text-align:center; color:#646970;">Chưa có dữ liệu theo dõi hoặc chưa có ai truy cập. Bạn hãy mở một trang ngẫu nhiên để ghi nhận dữ liệu đầu tiên.</div>';
    }
    echo '<div style="padding:10px 15px; border-top:1px solid #c3c4c7; background:#fff; text-align:right;"><a href="'. admin_url('edit.php?post_type=page') .'">Xem chi tiết tất cả Trang &rarr;</a></div>';
    echo '</div>';
}

function hieucon_add_analytics_widget() {
    wp_add_dashboard_widget(
        'hieucon_analytics_dashboard', 
        '📊 Thống Kê Tracking Hieucon (Views, Lưu lượng, Chuyển đổi)', 
        'hieucon_analytics_dashboard_widget'
    );
}
add_action('wp_dashboard_setup', 'hieucon_add_analytics_widget');
