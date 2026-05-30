<?php
/**
 * Course Management Admin Page
 * Trang Admin: Quản lý Khóa học & Ghi danh Hội viên
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// ============================================================
// 0. Cấu hình Menu Admin Hợp nhất & Chuyển hướng Thông minh
// ============================================================

// A. Đăng ký trang quản trị hợp nhất vào E-Learning menu và dọn dẹp các submenu trùng lặp
add_action( 'admin_menu', 'hieucon_configure_unified_course_menu', 999 );
function hieucon_configure_unified_course_menu() {
    // 1. Thêm trang quản lý hợp nhất làm submenu của edit.php?post_type=course (Menu E-Learning)
    add_submenu_page(
        'edit.php?post_type=course',
        'Quản lý Khóa học & Bài học',
        '📊 Quản lý Tổng hợp',
        'manage_options',
        'hieucon-courses',
        'hieucon_course_admin_page_html'
    );

    // 2. Ẩn menu con "Tất cả Khóa học" và "Bài học" mặc định của WordPress để không tách làm 2 trang riêng biệt
    remove_submenu_page( 'edit.php?post_type=course', 'edit.php?post_type=course' );
    remove_submenu_page( 'edit.php?post_type=course', 'edit.php?post_type=lesson' );
}

// B. Tự động chuyển hướng thông minh tất cả truy cập vào danh sách bài viết mặc định (Courses & Lessons) về giao diện hợp nhất
add_action( 'admin_init', 'hieucon_redirect_cpt_listings_to_unified' );
function hieucon_redirect_cpt_listings_to_unified() {
    global $pagenow;

    if ( ! is_admin() ) {
        return;
    }

    // Chuyển hướng edit.php?post_type=course về trang quản lý hợp nhất
    if ( $pagenow === 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'course' && ! isset( $_GET['page'] ) ) {
        wp_safe_redirect( admin_url( 'admin.php?page=hieucon-courses' ) );
        exit;
    }

    // Chuyển hướng edit.php?post_type=lesson về trang quản lý hợp nhất
    if ( $pagenow === 'edit.php' && isset( $_GET['post_type'] ) && $_GET['post_type'] === 'lesson' && ! isset( $_GET['page'] ) ) {
        wp_safe_redirect( admin_url( 'admin.php?page=hieucon-courses' ) );
        exit;
    }
}

// ============================================================
// 1. Đăng ký AJAX handlers cho grant/revoke enrollment
// ============================================================
add_action( 'wp_ajax_hieucon_admin_save_enrollments', 'hieucon_ajax_admin_save_enrollments' );
function hieucon_ajax_admin_save_enrollments() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce không hợp lệ.' );
    }

    $member_id  = intval( $_POST['member_id'] ?? 0 );
    $course_ids = isset( $_POST['course_ids'] ) ? array_map( 'intval', (array) $_POST['course_ids'] ) : [];

    if ( ! $member_id ) {
        wp_send_json_error( 'Hội viên không hợp lệ.' );
    }

    // Dùng helper để lưu danh sách ghi danh
    hieucon_update_member_enrolled_courses( $member_id, $course_ids );
    wp_send_json_success( [ 'message' => 'Đã cập nhật ghi danh thành công!' ] );
}

// ============================================================
// 1b. Đăng ký các AJAX handlers mới cho quản lý hợp nhất Khóa học - Bài học
// ============================================================

// A. Thêm nhanh bài học mới
add_action( 'wp_ajax_hieucon_admin_quick_add_lesson', 'hieucon_ajax_admin_quick_add_lesson' );
function hieucon_ajax_admin_quick_add_lesson() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $course_id = intval( $_POST['course_id'] ?? 0 );
    $title     = sanitize_text_field( $_POST['title'] ?? '' );
    $duration  = sanitize_text_field( $_POST['duration'] ?? '' );
    $video_url = sanitize_text_field( $_POST['video_url'] ?? '' );
    $order     = intval( $_POST['order'] ?? 1 );

    if ( ! $course_id ) {
        wp_send_json_error( 'Khóa học không hợp lệ.' );
    }
    if ( empty( $title ) ) {
        wp_send_json_error( 'Vui lòng nhập tiêu đề bài học.' );
    }

    $post_id = wp_insert_post( [
        'post_type'   => 'lesson',
        'post_title'  => $title,
        'post_status' => 'publish',
    ] );

    if ( is_wp_error( $post_id ) || ! $post_id ) {
        wp_send_json_error( 'Không thể tạo bài học mới.' );
    }

    update_post_meta( $post_id, '_belong_to_course', $course_id );
    update_post_meta( $post_id, '_lesson_duration', $duration );
    update_post_meta( $post_id, '_video_url', $video_url );
    update_post_meta( $post_id, '_lesson_order', $order );

    wp_send_json_success( [
        'id'          => $post_id,
        'title'       => esc_html( $title ),
        'duration'    => esc_html( $duration ),
        'video_url'   => esc_html( $video_url ),
        'order'       => $order,
        'status'      => 'publish',
        'status_lbl'  => 'Công khai',
        'status_bg'   => '#f0fdf4',
        'status_col'  => '#15803d',
        'edit_link'   => get_edit_post_link( $post_id ),
        'permalink'   => get_permalink( $post_id ),
        'message'     => 'Đã thêm bài học thành công!'
    ] );
}

// B. Cập nhật nhanh Thứ tự, Thời lượng, Tiêu đề & Video URL bài học
add_action( 'wp_ajax_hieucon_admin_quick_update_lesson', 'hieucon_ajax_admin_quick_update_lesson' );
function hieucon_ajax_admin_quick_update_lesson() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $lesson_id = intval( $_POST['lesson_id'] ?? 0 );
    if ( ! $lesson_id || get_post_type( $lesson_id ) !== 'lesson' ) {
        wp_send_json_error( 'Bài học không hợp lệ.' );
    }

    if ( isset( $_POST['order'] ) ) {
        update_post_meta( $lesson_id, '_lesson_order', intval( $_POST['order'] ) );
    }
    if ( isset( $_POST['duration'] ) ) {
        update_post_meta( $lesson_id, '_lesson_duration', sanitize_text_field( $_POST['duration'] ) );
    }
    if ( isset( $_POST['video_url'] ) ) {
        update_post_meta( $lesson_id, '_video_url', sanitize_text_field( $_POST['video_url'] ) );
    }
    if ( isset( $_POST['title'] ) ) {
        $title = sanitize_text_field( $_POST['title'] );
        if ( ! empty( $title ) ) {
            wp_update_post( [
                'ID'         => $lesson_id,
                'post_title' => $title
            ] );
        }
    }

    wp_send_json_success( [ 'message' => 'Đã lưu bài học!' ] );
}

// B2. Cập nhật thứ tự bài học hàng loạt (Drag & Drop)
add_action( 'wp_ajax_hieucon_admin_bulk_update_lesson_orders', 'hieucon_ajax_admin_bulk_update_lesson_orders' );
function hieucon_ajax_admin_bulk_update_lesson_orders() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $orders = isset( $_POST['orders'] ) ? (array) $_POST['orders'] : [];
    
    foreach ( $orders as $lesson_id => $order ) {
        $lesson_id = intval( $lesson_id );
        $order     = intval( $order );
        if ( $lesson_id && get_post_type( $lesson_id ) === 'lesson' ) {
            update_post_meta( $lesson_id, '_lesson_order', $order );
        }
    }

    wp_send_json_success( [ 'message' => 'Đã cập nhật thứ tự bài học!' ] );
}

// B3. Cập nhật thông tin nhanh Khóa học (Mô tả, Giá, Cấp độ, Thời lượng, Video giới thiệu)
add_action( 'wp_ajax_hieucon_admin_quick_update_course', 'hieucon_ajax_admin_quick_update_course' );
function hieucon_ajax_admin_quick_update_course() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $course_id  = intval( $_POST['course_id'] ?? 0 );
    if ( ! $course_id || get_post_type( $course_id ) !== 'course' ) {
        wp_send_json_error( 'Khóa học không hợp lệ.' );
    }

    // Cập nhật post content (Giới thiệu/mô tả khóa học)
    if ( isset( $_POST['post_content'] ) ) {
        wp_update_post( [
            'ID'           => $course_id,
            'post_content' => wp_kses_post( $_POST['post_content'] )
        ] );
    }

    // Cập nhật post metas
    if ( isset( $_POST['price'] ) ) {
        update_post_meta( $course_id, '_course_price', floatval( $_POST['price'] ) );
    }
    if ( isset( $_POST['level'] ) ) {
        update_post_meta( $course_id, '_course_level', sanitize_text_field( $_POST['level'] ) );
    }
    if ( isset( $_POST['duration'] ) ) {
        update_post_meta( $course_id, '_course_duration', sanitize_text_field( $_POST['duration'] ) );
    }
    if ( isset( $_POST['intro_video'] ) ) {
        update_post_meta( $course_id, '_course_intro_video', sanitize_text_field( $_POST['intro_video'] ) );
    }

    // Trả về dữ liệu để đồng bộ UI
    $price = get_post_meta( $course_id, '_course_price', true );
    $level = get_post_meta( $course_id, '_course_level', true );
    
    $price_lbl = 'Miễn phí';
    $price_badge = 'hieucon-badge-green';
    if ( ! empty( $price ) && floatval( $price ) > 0 ) {
        $price_lbl = number_format( floatval( $price ) ) . 'đ';
        $price_badge = 'hieucon-badge-teal';
    }

    $level_map = [
        'basic'        => [ 'lbl' => 'Cơ bản', 'badge' => 'hieucon-badge-blue' ],
        'intermediate' => [ 'lbl' => 'Trung cấp', 'badge' => 'hieucon-badge-amber' ],
        'advanced'     => [ 'lbl' => 'Nâng cao', 'badge' => 'hieucon-badge-purple' ],
    ];
    $l = $level_map[ $level ] ?? [ 'lbl' => 'Không đặt', 'badge' => 'hieucon-badge-gray' ];

    wp_send_json_success( [
        'message'     => 'Đã cập nhật thông tin khóa học!',
        'price_lbl'   => $price_lbl,
        'price_badge' => $price_badge,
        'level_lbl'   => $l['lbl'],
        'level_badge' => $l['badge'],
        'duration'    => esc_html( get_post_meta( $course_id, '_course_duration', true ) )
    ] );
}

// C. Chuyển đổi trạng thái bài học (Công khai <=> Bản nháp)
add_action( 'wp_ajax_hieucon_admin_toggle_lesson_status', 'hieucon_ajax_admin_toggle_lesson_status' );
function hieucon_ajax_admin_toggle_lesson_status() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $lesson_id = intval( $_POST['lesson_id'] ?? 0 );
    if ( ! $lesson_id || get_post_type( $lesson_id ) !== 'lesson' ) {
        wp_send_json_error( 'Bài học không hợp lệ.' );
    }

    $current_status = get_post_status( $lesson_id );
    $new_status     = ( $current_status === 'publish' ) ? 'draft' : 'publish';

    wp_update_post( [
        'ID'          => $lesson_id,
        'post_status' => $new_status
    ] );

    $status_lbl = ( $new_status === 'publish' ) ? 'Công khai' : 'Bản nháp';
    $status_bg  = ( $new_status === 'publish' ) ? '#f0fdf4' : '#fffbeb';
    $status_col = ( $new_status === 'publish' ) ? '#15803d' : '#92400e';

    wp_send_json_success( [
        'status'     => $new_status,
        'status_lbl' => $status_lbl,
        'status_bg'  => $status_bg,
        'status_col' => $status_col,
        'message'    => 'Đã đổi trạng thái bài học!'
    ] );
}

// D. Xóa nhanh bài học (đưa vào thùng rác)
add_action( 'wp_ajax_hieucon_admin_delete_lesson', 'hieucon_ajax_admin_delete_lesson' );
function hieucon_ajax_admin_delete_lesson() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_send_json_error( 'Không có quyền.' );
    }
    if ( ! check_ajax_referer( 'hieucon_course_admin_nonce', 'nonce', false ) ) {
        wp_send_json_error( 'Nonce xác thực không hợp lệ.' );
    }

    $lesson_id = intval( $_POST['lesson_id'] ?? 0 );
    if ( ! $lesson_id || get_post_type( $lesson_id ) !== 'lesson' ) {
        wp_send_json_error( 'Bài học không hợp lệ.' );
    }

    wp_trash_post( $lesson_id );

    wp_send_json_success( [ 'message' => 'Đã đưa bài học vào thùng rác thành công!' ] );
}

// Hỗ trợ điền sẵn khóa học khi bấm tạo bài học mới kiểu truyền thống
add_filter( 'default_post_metadata', function( $value, $object_id, $meta_key, $single, $meta_type ) {
    if ( $meta_type === 'post' && $meta_key === '_belong_to_course' && isset( $_GET['belong_to_course'] ) ) {
        return intval( $_GET['belong_to_course'] );
    }
    return $value;
}, 10, 5 );

// ============================================================
// 2. HTML trang Admin "Quản lý Khóa học"
// ============================================================
function hieucon_course_admin_page_html() {
    if ( ! current_user_can( 'manage_options' ) ) return;

    $active_tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'courses';
    $nonce      = wp_create_nonce( 'hieucon_course_admin_nonce' );

    ?>
    <div class="wrap">
        <h1 class="wp-heading-inline" style="display:flex;align-items:center;gap:10px;">
            <span style="font-size:28px;">📚</span> Quản lý Khóa học
        </h1>
        <hr class="wp-header-end">

        <!-- Tabs -->
        <nav class="nav-tab-wrapper" style="margin-bottom:0;">
            <a href="?page=hieucon-courses&tab=courses" class="nav-tab <?php echo $active_tab === 'courses' ? 'nav-tab-active' : ''; ?>">
                📖 Danh sách Khóa học
            </a>
            <a href="?page=hieucon-courses&tab=enrollment" class="nav-tab <?php echo $active_tab === 'enrollment' ? 'nav-tab-active' : ''; ?>">
                👥 Quản lý Ghi danh
            </a>
        </nav>

        <div style="background:#fff;border:1px solid #c3c4c7;border-top:none;padding:20px 25px;border-radius:0 0 4px 4px;">

            <?php if ( $active_tab === 'courses' ) : 
                $courses = get_posts( [
                    'post_type'      => 'course',
                    'posts_per_page' => -1,
                    'post_status'    => [ 'publish', 'draft', 'private', 'pending' ],
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ] );
            ?>
      <!-- Nhúng CSS Premium -->
    <style>
    /* Modern styling for unified course admin - redone to premium standard */
    .hieucon-admin-wrap {
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
        margin-top: 15px;
    }
    .hieucon-search-bar {
        width: 100%;
        max-width: 400px;
        padding: 10px 16px !important;
        font-size: 13px !important;
        border-radius: 10px !important;
        border: 1px solid #cbd5e1 !important;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03) !important;
        transition: all 0.25s ease !important;
        height: auto !important;
        background: #ffffff !important;
    }
    .hieucon-search-bar:focus {
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.12) !important;
        outline: none !important;
    }
    .hieucon-course-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.03), 0 2px 6px -1px rgba(15, 23, 42, 0.02);
        margin-bottom: 24px;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        overflow: hidden;
    }
    .hieucon-course-card:hover {
        box-shadow: 0 12px 30px -4px rgba(15, 23, 42, 0.06), 0 4px 10px -2px rgba(15, 23, 42, 0.04);
        border-color: #cbd5e1;
    }
    .hieucon-card-header {
        padding: 22px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 20px;
        cursor: pointer;
        user-select: none;
        background: #ffffff;
        transition: background-color 0.2s;
    }
    .hieucon-card-header:hover {
        background-color: #fafbfc;
    }
    .hieucon-card-header-left {
        display: flex;
        align-items: center;
        gap: 18px;
        flex: 1;
        min-width: 0;
    }
    .hieucon-course-thumb {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        object-fit: cover;
        flex-shrink: 0;
        border: 1px solid #e2e8f0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .hieucon-course-fallback-thumb {
        width: 60px;
        height: 60px;
        border-radius: 10px;
        background: linear-gradient(135deg, #e0f2fe, #bbf7d0);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        flex-shrink: 0;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }
    .hieucon-course-info {
        min-width: 0;
        flex: 1;
    }
    .hieucon-course-title {
        font-size: 17px;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.3;
    }
    .hieucon-course-title a {
        color: #0f172a;
        text-decoration: none;
        transition: color 0.15s;
    }
    .hieucon-course-title a:hover {
        color: #0d9488;
    }
    .hieucon-course-meta-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        align-items: center;
    }
    .hieucon-badge {
        display: inline-flex;
        align-items: center;
        padding: 2px 8px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
        line-height: 1.4;
    }
    .hieucon-badge-gray { background: #f1f5f9; color: #475569; }
    .hieucon-badge-teal { background: #f0fdfa; color: #0d9488; }
    .hieucon-badge-blue { background: #eff6ff; color: #1d4ed8; }
    .hieucon-badge-green { background: #f0fdf4; color: #166534; }
    .hieucon-badge-amber { background: #fffbeb; color: #92400e; }
    .hieucon-badge-purple { background: #faf5ff; color: #6b21a8; }
 
    .hieucon-card-header-right {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-shrink: 0;
    }
    .hieucon-course-stats {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .hieucon-stat-box {
        text-align: center;
        padding: 6px 12px;
        background: #f8fafc;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        min-width: 65px;
        box-shadow: 0 1px 2px rgba(0,0,0,0.02);
    }
    .hieucon-stat-num {
        font-size: 16px;
        font-weight: 700;
        color: #0f172a;
    }
    .hieucon-stat-lbl {
        font-size: 9px;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-top: 1px;
    }
    .hieucon-card-actions {
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .hieucon-toggle-icon {
        font-size: 12px;
        color: #64748b;
        transition: all 0.25s ease;
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f1f5f9;
    }
    .hieucon-course-card.expanded .hieucon-toggle-icon {
        transform: rotate(180deg);
        background: #0d9488;
        color: #ffffff;
    }
 
    /* Two-Column Responsive Grid Layout */
    .hieucon-card-content {
        border-top: 1px solid #f1f5f9;
        background: #fafbfc;
        display: none;
    }
    .hieucon-course-card.expanded .hieucon-card-content {
        display: block;
    }
    .hieucon-admin-grid {
        display: grid;
        grid-template-columns: 1.8fr 1.1fr;
        gap: 24px;
        padding: 24px 28px;
    }
    @media (max-width: 1100px) {
        .hieucon-admin-grid {
            grid-template-columns: 1fr;
        }
    }
 
    /* Lesson Table Spreadsheet Grid */
    .hieucon-lesson-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.02);
    }
    .hieucon-lesson-table th {
        background: #f8fafc;
        color: #475569;
        font-weight: 700;
        font-size: 11px;
        text-transform: uppercase;
        padding: 12px 14px;
        text-align: left;
        border-bottom: 2px solid #e2e8f0;
    }
    .hieucon-lesson-table td {
        padding: 8px 12px;
        border-bottom: 1px solid #e2e8f0;
        color: #334155;
        font-size: 13px;
        vertical-align: middle;
    }
    
    /* HTML5 Drag & Drop visual highlights */
    .hieucon-lesson-row.draggable {
        cursor: default;
    }
    .hieucon-dragging {
        background-color: #f1f5f9 !important;
        opacity: 0.5;
        border: 2px dashed #0d9488 !important;
    }
    .hieucon-drag-over {
        border-top: 3px solid #0d9488 !important;
        background-color: #f0fdfa !important;
    }
    .hieucon-drag-handle:hover {
        color: #0d9488 !important;
    }
 
    .hieucon-lesson-input {
        border: 1px solid #cbd5e1 !important;
        border-radius: 6px !important;
        padding: 5px 8px !important;
        font-size: 12px !important;
        background: #ffffff !important;
        transition: all 0.2s ease !important;
        margin: 0 !important;
        height: auto !important;
        color: #334155 !important;
    }
    .hieucon-lesson-input:focus {
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.12) !important;
        background-color: #ffffff !important;
        outline: none !important;
    }
    .hieucon-input-order {
        width: 55px !important;
        text-align: center;
        font-weight: 700;
    }
    .hieucon-input-duration {
        width: 75px !important;
        text-align: center;
    }
    .hieucon-input-title {
        font-size: 13px !important;
    }
    .hieucon-input-video {
        font-family: monospace !important;
        font-size: 11px !important;
        color: #475569 !important;
    }
    .hieucon-status-badge {
        cursor: pointer;
        user-select: none;
        transition: all 0.18s ease;
        display: inline-block;
    }
    .hieucon-status-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 2px 4px rgba(0,0,0,0.06);
    }
 
    /* Quick Course Editor Panel */
    .hieucon-course-edit-panel label {
        font-family: inherit !important;
        letter-spacing: 0.03em !important;
    }
    .hieucon-course-edit-panel textarea:focus,
    .hieucon-course-edit-panel input:focus,
    .hieucon-course-edit-panel select:focus {
        border-color: #0d9488 !important;
        box-shadow: 0 0 0 2px rgba(13, 148, 136, 0.12) !important;
    }
 
    /* Premium micro-animations & notifications */
    .hieucon-saving-indicator {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        font-size: 11px;
        color: #64748b;
        opacity: 0;
        transition: opacity 0.2s ease;
    }
    .hieucon-saving-indicator.visible {
        opacity: 1;
    }
    .hieucon-success-flash {
        animation: flashGreen 1s ease-out;
    }
    @keyframes flashGreen {
        0% { background-color: rgba(16, 185, 129, 0.2); }
        100% { background-color: transparent; }
    }
 
    /* Floating Toast Notification */
    #hieucon-admin-toast {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #0f172a;
        color: #ffffff;
        padding: 14px 26px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 13px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.15), 0 10px 10px -5px rgba(0,0,0,0.04);
        z-index: 99999;
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        align-items: center;
        gap: 8px;
    }
    #hieucon-admin-toast.show {
        transform: translateY(0);
        opacity: 1;
    }
    
    /* Pulsing Badge & Bounce Animations */
    .hieucon-pulse-badge {
        animation: hieucon-pulse-btn 2.5s infinite;
    }
    @keyframes hieucon-pulse-btn {
        0% {
            box-shadow: 0 0 0 0 rgba(14, 165, 233, 0.5);
        }
        70% {
            box-shadow: 0 0 0 8px rgba(14, 165, 233, 0);
        }
        100% {
            box-shadow: 0 0 0 0 rgba(14, 165, 233, 0);
        }
    }
    @keyframes bounce {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-8px);
        }
    }
    </style>

    <div class="hieucon-admin-wrap">
        <!-- Hướng dẫn sử dụng Premium -->
        <div style="background: linear-gradient(135deg, #eff6ff, #f0fdf4); border: 1px solid #bfdbfe; border-radius: 12px; padding: 18px 24px; margin-bottom: 24px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); display: flex; align-items: flex-start; gap: 16px;">
            <div style="font-size: 24px; background: #0d9488; color: white; width: 44px; height: 44px; display: flex; align-items: center; justify-content: center; border-radius: 50%; box-shadow: 0 4px 10px rgba(13, 148, 136, 0.25); flex-shrink: 0;">💡</div>
            <div>
                <h4 style="margin: 0 0 6px 0; font-size: 15px; font-weight: 700; color: #0f172a;">Làm thế nào để thêm bài học và quản lý giáo trình?</h4>
                <ul style="margin: 0; padding-left: 20px; font-size: 13px; color: #475569; line-height: 1.6; list-style-type: disc;">
                    <li><strong>Bước 1:</strong> Bấm trực tiếp vào <strong>bất kỳ Khóa học nào</strong> bên dưới để mở rộng bảng điều khiển bài học.</li>
                    <li><strong>Bước 2:</strong> Cột bên trái hiển thị danh sách bài học hiện có. Bạn có thể kéo thả biểu tượng <span style="font-weight:bold;color:#94a3b8;">⋮⋮</span> để sắp xếp lại thứ tự bài học nhanh chóng.</li>
                    <li><strong>Bước 3:</strong> Tại phần <strong>"🚀 Thêm Bài Học Mới Nhanh"</strong> bên dưới bảng bài học, nhập các thông tin rồi bấm <strong>🚀 Thêm Bài Học</strong> để thêm ngay bài học bằng AJAX mà không cần load lại trang!</li>
                    <li><strong>Mẹo chỉnh sửa:</strong> Bạn có thể sửa trực tiếp Tiêu đề bài học, Thời lượng, Video URL ngay trên bảng và hệ thống sẽ tự động lưu lại. Cột bên phải dùng để lưu nhanh Mô tả & Giới thiệu khóa học.</li>
                </ul>
            </div>
        </div>

        <!-- Control Header -->
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
            <div style="display:flex;align-items:center;gap:12px;">
                <h2 style="margin:0;font-size:18px;font-weight:700;">Tất cả Khóa học (<span id="hieucon-course-count-num"><?php echo count( $courses ); ?></span>)</h2>
                <input type="search" placeholder="🔍 Tìm kiếm khóa học nhanh..." class="hieucon-search-bar" oninput="filterHieuconCourses(this.value)">
            </div>
            <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=course' ) ); ?>" class="button button-primary" style="padding:4px 14px;font-size:13px;font-weight:600;height:auto;">
                + Tạo Khóa học Mới
            </a>
        </div>

        <?php if ( empty( $courses ) ) : ?>
            <div style="text-align:center;padding:60px 0;color:#6b7280;background:#ffffff;border:1px solid #e2e8f0;border-radius:12px;">
                <div style="font-size:48px;margin-bottom:12px;">📚</div>
                <p style="font-size:16px;font-weight:600;margin-bottom:16px;">Chưa có khóa học nào được tạo.</p>
                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=course' ) ); ?>" class="button button-primary">Tạo khóa học đầu tiên</a>
            </div>
        <?php else : ?>
            <div class="hieucon-courses-list">
                <?php foreach ( $courses as $course ) :
                    // Query bài học
                    $lessons_query = new WP_Query( [
                        'post_type'      => 'lesson',
                        'posts_per_page' => -1,
                        'meta_query'     => [
                            [
                                'key'     => '_belong_to_course',
                                'value'   => $course->ID,
                                'compare' => '='
                            ]
                        ],
                    ] );
                    $lessons = $lessons_query->posts;
                    wp_reset_postdata();

                    // Sắp xếp bài học trong PHP
                    usort( $lessons, function( $a, $b ) {
                        $order_a = intval( get_post_meta( $a->ID, '_lesson_order', true ) );
                        $order_b = intval( get_post_meta( $b->ID, '_lesson_order', true ) );
                        if ( $order_a === $order_b ) {
                            return $a->ID < $b->ID ? -1 : 1;
                        }
                        return $order_a < $order_b ? -1 : 1;
                    } );

                    $lesson_count = count( $lessons );

                    // Đếm ghi danh
                    global $wpdb;
                    $enrolled_count = (int) $wpdb->get_var( $wpdb->prepare(
                        "SELECT COUNT(*) FROM {$wpdb->options} WHERE option_name LIKE %s AND option_value LIKE %s",
                        'hieucon_enrolled_courses_%',
                        '%:' . $course->ID . ';%'
                    ) );

                    // Meta của khóa học
                    $price    = get_post_meta( $course->ID, '_course_price', true );
                    $level    = get_post_meta( $course->ID, '_course_level', true );
                    $duration = get_post_meta( $course->ID, '_course_duration', true );

                    // Định dạng giá bán
                    $price_lbl = 'Miễn phí';
                    $price_badge = 'hieucon-badge-green';
                    if ( ! empty( $price ) && floatval( $price ) > 0 ) {
                        $price_lbl = number_format( floatval( $price ) ) . 'đ';
                        $price_badge = 'hieucon-badge-teal';
                    }

                    // Cấp độ
                    $level_map = [
                        'basic'        => [ 'lbl' => 'Cơ bản', 'badge' => 'hieucon-badge-blue' ],
                        'intermediate' => [ 'lbl' => 'Trung cấp', 'badge' => 'hieucon-badge-amber' ],
                        'advanced'     => [ 'lbl' => 'Nâng cao', 'badge' => 'hieucon-badge-purple' ],
                    ];
                    $l = $level_map[ $level ] ?? [ 'lbl' => 'Không đặt', 'badge' => 'hieucon-badge-gray' ];

                    // Danh mục
                    $cats = get_the_terms( $course->ID, 'course_cat' );
                    $cat_names = $cats && ! is_wp_error( $cats ) ? implode( ', ', wp_list_pluck( $cats, 'name' ) ) : '';

                    // Status border color & labels
                    $status = $course->post_status;
                    $status_map = [
                        'publish' => [ 'lbl' => 'Công khai', 'bg' => '#10b981' ],
                        'draft'   => [ 'lbl' => 'Bản nháp',  'bg' => '#f59e0b' ],
                        'private' => [ 'lbl' => 'Riêng tư',  'bg' => '#3b82f6' ],
                    ];
                    $s = $status_map[ $status ] ?? [ 'lbl' => $status, 'bg' => '#64748b' ];

                    $thumb = get_the_post_thumbnail_url( $course->ID, 'thumbnail' );
                    ?>
                    
                    <!-- Course Card -->
                    <div class="hieucon-course-card" data-id="<?php echo $course->ID; ?>" data-title="<?php echo esc_attr( $course->post_title ); ?>" style="border-left: 6px solid <?php echo $s['bg']; ?>;">
                        <!-- Header Accordion Trigger -->
                        <div class="hieucon-card-header" onclick="toggleCourseAccordion(this)">
                            <div class="hieucon-card-header-left">
                                <?php if ( $thumb ) : ?>
                                    <img src="<?php echo esc_url( $thumb ); ?>" class="hieucon-course-thumb" alt="">
                                <?php else : ?>
                                    <div class="hieucon-course-fallback-thumb">📚</div>
                                <?php endif; ?>
                                
                                <div class="hieucon-course-info">
                                    <h3 class="hieucon-course-title">
                                        <a href="<?php echo get_edit_post_link( $course->ID ); ?>" target="_blank" onclick="event.stopPropagation();">
                                            <?php echo esc_html( $course->post_title ); ?>
                                        </a>
                                    </h3>
                                    <div class="hieucon-course-meta-tags">
                                        <span class="hieucon-badge <?php echo $price_badge; ?>"><?php echo $price_lbl; ?></span>
                                        <span class="hieucon-badge <?php echo $l['badge']; ?>"><?php echo $l['lbl']; ?></span>
                                        <?php if ( $duration ) : ?>
                                            <span class="hieucon-badge hieucon-badge-gray">⏱ <?php echo esc_html( $duration ); ?></span>
                                        <?php endif; ?>
                                        <?php if ( $cat_names ) : ?>
                                            <span class="hieucon-badge hieucon-badge-gray">🏷 <?php echo esc_html( $cat_names ); ?></span>
                                        <?php endif; ?>
                                        <span class="hieucon-badge hieucon-badge-gray" style="background:#f8fafc;border:1px solid #e2e8f0;">ID: <?php echo $course->ID; ?></span>
                                        <span class="hieucon-badge hieucon-badge-blue hieucon-pulse-badge" style="background:#f0f9ff; color:#0284c7; border: 1px solid #bae6fd; font-size: 10px; font-weight: 700;">⚡ BẤM ĐỂ MỞ RỘNG & THÊM BÀI HỌC</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="hieucon-card-header-right">
                                <div class="hieucon-course-stats">
                                    <div class="hieucon-stat-box">
                                        <div class="hieucon-stat-num hieucon-stat-lessons-num"><?php echo $lesson_count; ?></div>
                                        <div class="hieucon-stat-lbl">Bài học</div>
                                    </div>
                                    <div class="hieucon-stat-box">
                                        <div class="hieucon-stat-num"><?php echo $enrolled_count; ?></div>
                                        <div class="hieucon-stat-lbl">Hội viên</div>
                                    </div>
                                </div>
                                
                                <div class="hieucon-card-actions">
                                    <a href="<?php echo get_edit_post_link( $course->ID ); ?>" class="button button-small button-secondary" onclick="event.stopPropagation();" target="_blank" title="Mở trang soạn thảo đầy đủ của khóa học">Sửa Khóa học</a>
                                    <a href="<?php echo get_permalink( $course->ID ); ?>" class="button button-small" onclick="event.stopPropagation();" target="_blank" title="Xem trên website">👁</a>
                                </div>
                                
                                <div class="hieucon-toggle-icon">▼</div>
                            </div>
                        </div>
                        
                        <!-- Collapsible Lesson Content -->
                        <div class="hieucon-card-content">
                            <div class="hieucon-card-content-inner hieucon-admin-grid">
                                
                                <!-- Left Column: Lesson Management -->
                                <div class="hieucon-lessons-manage-col">
                                    <h4 style="margin-top:0;margin-bottom:15px;font-size:14px;font-weight:700;color:#0f172a;border-bottom:1px solid #e2e8f0;padding-bottom:10px;display:flex;justify-content:space-between;align-items:center;">
                                        <span>📖 Danh sách Bài học & Học liệu</span>
                                        <span class="hieucon-lesson-count-badge hieucon-badge hieucon-badge-teal" style="font-size:12px;font-weight:600;"><?php echo $lesson_count; ?> bài học</span>
                                    </h4>
                                    
                                    <!-- Lessons Table -->
                                    <table class="hieucon-lesson-table">
                                        <thead>
                                            <tr>
                                                <th style="width:30px;text-align:center;"></th>
                                                <th style="width:70px;text-align:center;">Thứ tự</th>
                                                <th style="width:250px;">Tiêu đề bài học</th>
                                                <th style="width:90px;">Thời lượng</th>
                                                <th>Video URL / Iframe</th>
                                                <th style="width:100px;text-align:center;">Trạng thái</th>
                                                <th style="width:140px;text-align:right;">Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if ( empty( $lessons ) ) : ?>
                                                <tr class="hieucon-empty-row">
                                                    <td colspan="7" style="text-align:center;padding:40px 20px;color:#64748b;background:#ffffff;">
                                                        <div style="font-size:36px;margin-bottom:12px;animation: bounce 2s infinite;">📖</div>
                                                        <div style="font-weight:700;font-size:14px;color:#334155;margin-bottom:6px;">Khóa học này hiện chưa có bài học nào!</div>
                                                        <p style="font-size:12px;color:#94a3b8;margin:0 0 16px 0;">Hãy bắt đầu xây dựng giáo trình bằng cách điền thông tin vào form <strong>"🚀 Thêm Bài Học Mới Nhanh"</strong> ngay phía dưới.</p>
                                                    </td>
                                                </tr>
                                            <?php else : ?>
                                                <?php foreach ( $lessons as $lesson ) :
                                                    $l_dur  = get_post_meta( $lesson->ID, '_lesson_duration', true );
                                                    $l_video = get_post_meta( $lesson->ID, '_video_url', true );
                                                    $l_order = get_post_meta( $lesson->ID, '_lesson_order', true );
                                                    if ( ! $l_order ) $l_order = 1;
                                                    
                                                    // Status badges
                                                    $l_status = $lesson->post_status;
                                                    $l_status_lbl = ($l_status === 'publish') ? 'Công khai' : 'Bản nháp';
                                                    $l_status_bg  = ($l_status === 'publish') ? '#f0fdf4' : '#fffbeb';
                                                    $l_status_col = ($l_status === 'publish') ? '#15803d' : '#92400e';
                                                    ?>
                                                    <tr class="hieucon-lesson-row draggable" data-id="<?php echo $lesson->ID; ?>" draggable="true" ondragstart="handleDragStart(event)" ondragover="handleDragOver(event)" ondragleave="handleDragLeave(event)" ondrop="handleDrop(event)" ondragend="handleDragEnd(event)">
                                                        <td style="text-align:center; cursor:move; color:#94a3b8; font-size:16px; font-weight:bold; user-select:none;" class="hieucon-drag-handle" title="Kéo thả để sắp xếp">⋮⋮</td>
                                                        <td>
                                                            <input type="number" class="hieucon-lesson-input hieucon-input-order" value="<?php echo intval( $l_order ); ?>" min="1"
                                                                onchange="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)"
                                                                onblur="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)">
                                                        </td>
                                                        <td class="hieucon-lesson-title-cell">
                                                            <input type="text" class="hieucon-lesson-input hieucon-input-title w-full font-semibold" value="<?php echo esc_attr( $lesson->post_title ); ?>"
                                                                onchange="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)"
                                                                onblur="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)" style="font-weight:700 !important; color:#1e293b !important;">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="hieucon-lesson-input hieucon-input-duration" value="<?php echo esc_attr( $l_dur ); ?>" placeholder="Ví dụ: 12:45"
                                                                onchange="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)"
                                                                onblur="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="hieucon-lesson-input hieucon-input-video w-full text-xs font-mono" value="<?php echo esc_attr( $l_video ); ?>" placeholder="Đường dẫn hoặc mã nhúng..."
                                                                onchange="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)"
                                                                onblur="saveLessonQuickMeta(<?php echo $lesson->ID; ?>, this)">
                                                        </td>
                                                        <td style="text-align:center;">
                                                            <span class="hieucon-badge hieucon-status-badge" style="background:<?php echo $l_status_bg; ?>;color:<?php echo $l_status_col; ?>;"
                                                                onclick="toggleLessonStatus(<?php echo $lesson->ID; ?>, this)">
                                                                <?php echo $l_status_lbl; ?>
                                                            </span>
                                                        </td>
                                                        <td style="text-align:right;white-space:nowrap;">
                                                            <span class="hieucon-saving-indicator">
                                                                <span class="spinner is-active" style="float:none;margin:0 4px 0 0;width:12px;height:12px;"></span>Đang lưu
                                                            </span>
                                                            <a href="<?php echo get_edit_post_link( $lesson->ID ); ?>" class="button button-small" target="_blank" title="Sửa chi tiết bài học">Sửa đầy đủ</a>
                                                            <a href="<?php echo get_permalink( $lesson->ID ); ?>" class="button button-small" target="_blank" title="Xem bài học trên web">👁</a>
                                                            <button type="button" class="button button-small button-link-delete" style="color:#ef4444;" onclick="deleteLesson(<?php echo $lesson->ID; ?>, this)">Xóa</button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    
                                    <!-- Quick Add Lesson Row -->
                                    <div class="hieucon-quick-add-wrap" style="background:#f8fafc; border:1px solid #cbd5e1; border-radius:12px; padding:20px; margin-top:20px; box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);">
                                        <h5 class="hieucon-quick-add-title" style="margin:0 0 16px 0; font-size:13px; font-weight:700; color:#1e293b; display:flex; align-items:center; gap:6px;">
                                            🚀 Thêm Bài Học Mới Nhanh Vào Khóa Học
                                        </h5>
                                        <div class="hieucon-quick-add-form">
                                            <div class="hieucon-quick-add-fields" style="display:grid; grid-template-columns: 2.2fr 1fr 2fr 80px; gap:14px; margin-bottom:16px;">
                                                <div style="display:flex; flex-direction:column; gap:6px;">
                                                    <label style="font-size:10px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.02em;">Tiêu đề bài học <span style="color:#ef4444;">*</span></label>
                                                    <input type="text" class="hieucon-lesson-input hieucon-add-title" placeholder="Ví dụ: Bài 1: Tổng quan...">
                                                </div>
                                                <div style="display:flex; flex-direction:column; gap:6px;">
                                                    <label style="font-size:10px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.02em;">Thời lượng</label>
                                                    <input type="text" class="hieucon-lesson-input hieucon-add-duration" placeholder="vd: 15:30">
                                                </div>
                                                <div style="display:flex; flex-direction:column; gap:6px;">
                                                    <label style="font-size:10px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.02em;">Video URL / Mã nhúng</label>
                                                    <input type="text" class="hieucon-lesson-input hieucon-add-video" placeholder="Youtube link, iframe v.v...">
                                                </div>
                                                <div style="display:flex; flex-direction:column; gap:6px;">
                                                    <label style="font-size:10px; font-weight:700; color:#64748b; text-transform:uppercase; letter-spacing:0.02em;">Thứ tự</label>
                                                    <input type="number" class="hieucon-lesson-input hieucon-add-order" value="<?php echo $lesson_count + 1; ?>" min="1">
                                                </div>
                                            </div>
                                            <div class="hieucon-btn-save-row" style="display:flex; gap:8px; align-items:center; justify-content:flex-end;">
                                                <span class="spinner hieucon-add-spinner" style="float:none;margin:0;display:none;"></span>
                                                <a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=lesson&belong_to_course=' . $course->ID ) ); ?>" 
                                                    class="button button-secondary" target="_blank" title="Mở trang soạn thảo Gutenberg đầy đủ cho bài học mới">
                                                    📝 Soạn thảo đầy đủ
                                                </a>
                                                <button type="button" class="button button-primary" onclick="addLessonQuick(this, <?php echo $course->ID; ?>)" style="font-weight:600; padding: 6px 20px; height: auto; background:#0d9488 !important; border-color:#0d9488 !important; border-radius: 8px !important;">
                                                    🚀 Thêm Bài Học
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Right Column: Quick Course Editor Panel -->
                                <div class="hieucon-course-edit-panel" style="background:#ffffff; border:1px solid #cbd5e1; border-radius:12px; padding:20px; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02); display: flex; flex-direction: column; gap: 15px; height: fit-content; position: sticky; top: 50px;">
                                    <h4 style="margin:0; font-size:14px; font-weight:700; color:#0f172a; display:flex; align-items:center; gap:6px; border-bottom:1px solid #e2e8f0; padding-bottom:10px;">
                                        ⚙️ Thông tin & Giới thiệu khóa học
                                    </h4>
                                    
                                    <div style="display:flex; flex-direction:column; gap:4px;">
                                        <label style="font-size:11px; font-weight:700; color:#475569;">GIÁ BÁN (VND - 0 LÀ MIỄN PHÍ)</label>
                                        <input type="number" class="hieucon-lesson-input hieucon-course-edit-price" value="<?php echo esc_attr( $price ); ?>" style="width:100% !important;">
                                    </div>
                                    
                                    <div style="display:grid; grid-template-columns: 1fr 1fr; gap:12px;">
                                        <div style="display:flex; flex-direction:column; gap:4px;">
                                            <label style="font-size:11px; font-weight:700; color:#475569;">CẤP ĐỘ</label>
                                            <select class="hieucon-lesson-input hieucon-course-edit-level" style="width:100% !important; padding:4px 8px !important; height: 30px !important;">
                                                <option value="basic" <?php selected( $level, 'basic' ); ?>>Cơ bản</option>
                                                <option value="intermediate" <?php selected( $level, 'intermediate' ); ?>>Trung cấp</option>
                                                <option value="advanced" <?php selected( $level, 'advanced' ); ?>>Nâng cao</option>
                                            </select>
                                        </div>
                                        <div style="display:flex; flex-direction:column; gap:4px;">
                                            <label style="font-size:11px; font-weight:700; color:#475569;">TỔNG THỜI LƯỢNG</label>
                                            <input type="text" class="hieucon-lesson-input hieucon-course-edit-duration" value="<?php echo esc_attr( $duration ); ?>" placeholder="Ví dụ: 12 giờ 30 phút" style="width:100% !important;">
                                        </div>
                                    </div>
                                    
                                    <div style="display:flex; flex-direction:column; gap:4px;">
                                        <label style="font-size:11px; font-weight:700; color:#475569;">VIDEO GIỚI THIỆU (YOUTUBE / BUNNY / IFRAME)</label>
                                        <input type="text" class="hieucon-lesson-input hieucon-course-edit-video" value="<?php echo esc_attr( get_post_meta( $course->ID, '_course_intro_video', true ) ); ?>" placeholder="Đường dẫn video giới thiệu..." style="width:100% !important; font-family:monospace; font-size:11px !important;">
                                    </div>

                                    <div style="display:flex; flex-direction:column; gap:4px; flex:1; min-height:160px;">
                                        <label style="font-size:11px; font-weight:700; color:#475569;">GIỚI THIỆU / MÔ TẢ KHÓA HỌC (HTML)</label>
                                        <textarea class="hieucon-lesson-input hieucon-course-edit-content" rows="6" style="width:100% !important; font-size:12px !important; line-height:1.5 !important; font-family:sans-serif !important; resize:vertical; flex:1;" placeholder="Viết giới thiệu hoặc mô tả chuẩn SEO về khóa học tại đây..."><?php echo esc_textarea( $course->post_content ); ?></textarea>
                                    </div>
                                    
                                    <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #e2e8f0; padding-top:12px; margin-top:5px;">
                                        <span class="hieucon-course-saving-indicator" style="display:inline-flex; align-items:center; gap:4px; font-size:11px; color:#64748b; opacity:0; transition:opacity 0.2s ease;">
                                            <span class="spinner is-active" style="float:none;margin:0 4px 0 0;width:12px;height:12px;"></span>Đang lưu...
                                        </span>
                                        <button type="button" class="button button-primary" onclick="saveCourseQuickInfo(<?php echo $course->ID; ?>, this)" style="font-weight:600; padding:4px 16px; font-size:12px; height:auto; background:#0d9488 !important; border-color:#0d9488 !important;">
                                            💾 Lưu Thông Tin Khóa Học
                                        </button>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

    <!-- AJAX Javascript Actions -->
    <script>
    // Dynamic Toast Notification
    function showHieuconToast(message, isError = false) {
        let toast = document.getElementById('hieucon-admin-toast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'hieucon-admin-toast';
            document.body.appendChild(toast);
        }
        toast.innerHTML = (isError ? '❌ ' : '✅ ') + message;
        toast.style.borderLeft = isError ? '4px solid #ef4444' : '4px solid #10b981';
        toast.className = 'show';
        
        // Clear previous timeout if user clicks quickly
        if (window.hieuconToastTimeout) {
            clearTimeout(window.hieuconToastTimeout);
        }
        
        window.hieuconToastTimeout = setTimeout(() => {
            toast.className = '';
        }, 3000);
    }

    // Inline Course Search Filter
    function filterHieuconCourses(query) {
        const q = query.toLowerCase().trim();
        const cards = document.querySelectorAll('.hieucon-course-card');
        let foundCount = 0;
        
        cards.forEach(card => {
            const title = card.getAttribute('data-title').toLowerCase();
            if (title.includes(q)) {
                card.style.display = 'block';
                foundCount++;
            } else {
                card.style.display = 'none';
            }
        });
        
        const countElement = document.getElementById('hieucon-course-count-num');
        if (countElement) {
            countElement.innerText = foundCount;
        }
    }

    // Toggle Course Card Accordion
    function toggleCourseAccordion(cardHeader) {
        const card = cardHeader.closest('.hieucon-course-card');
        card.classList.toggle('expanded');
    }

    // Native HTML5 Drag and Drop Handlers for Lessons
    let draggedRow = null;

    function handleDragStart(e) {
        draggedRow = e.currentTarget;
        draggedRow.classList.add('hieucon-dragging');
        e.dataTransfer.effectAllowed = 'move';
        e.dataTransfer.setData('text/plain', '');
    }

    function handleDragOver(e) {
        e.preventDefault();
        const targetRow = e.currentTarget;
        if (targetRow === draggedRow) return;
        
        // Ensure they belong to the same course table
        if (targetRow.closest('table') !== draggedRow.closest('table')) return;
        
        targetRow.classList.add('hieucon-drag-over');
    }

    function handleDragLeave(e) {
        e.currentTarget.classList.remove('hieucon-drag-over');
    }

    function handleDrop(e) {
        e.preventDefault();
        const targetRow = e.currentTarget;
        targetRow.classList.remove('hieucon-drag-over');
        
        if (targetRow === draggedRow) return;
        if (targetRow.closest('table') !== draggedRow.closest('table')) return;
        
        const tbody = targetRow.parentNode;
        const children = Array.from(tbody.children);
        const draggedIndex = children.indexOf(draggedRow);
        const targetIndex = children.indexOf(targetRow);
        
        if (draggedIndex < targetIndex) {
            tbody.insertBefore(draggedRow, targetRow.nextSibling);
        } else {
            tbody.insertBefore(draggedRow, targetRow);
        }
        
        // Save the new bulk orders
        saveLessonsOrderBulk(tbody);
    }

    function handleDragEnd(e) {
        if (draggedRow) {
            draggedRow.classList.remove('hieucon-dragging');
        }
        document.querySelectorAll('.hieucon-drag-over').forEach(el => {
            el.classList.remove('hieucon-drag-over');
        });
        draggedRow = null;
    }

    // Bulk Save Lessons Order via AJAX
    function saveLessonsOrderBulk(tbody) {
        const rows = tbody.querySelectorAll('.hieucon-lesson-row');
        const orders = {};
        
        rows.forEach((row, i) => {
            const newOrder = i + 1;
            const orderInput = row.querySelector('.hieucon-input-order');
            if (orderInput) {
                orderInput.value = newOrder;
            }
            const lessonId = row.getAttribute('data-id');
            orders[lessonId] = newOrder;
            
            const rowSaving = row.querySelector('.hieucon-saving-indicator');
            if (rowSaving) rowSaving.classList.add('visible');
        });
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_bulk_update_lesson_orders');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        
        for (const [lessonId, order] of Object.entries(orders)) {
            formData.append(`orders[${lessonId}]`, order);
        }
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            rows.forEach(row => {
                const rowSaving = row.querySelector('.hieucon-saving-indicator');
                if (rowSaving) rowSaving.classList.remove('visible');
                if (data.success) {
                    row.classList.add('hieucon-success-flash');
                    setTimeout(() => row.classList.remove('hieucon-success-flash'), 1200);
                }
            });
            
            if (data.success) {
                showHieuconToast(data.data.message || 'Đã sắp xếp lại bài học thành công.');
            } else {
                showHieuconToast(data.data || 'Có lỗi xảy ra khi sắp xếp.', true);
            }
        })
        .catch(() => {
            rows.forEach(row => {
                const rowSaving = row.querySelector('.hieucon-saving-indicator');
                if (rowSaving) rowSaving.classList.remove('visible');
            });
            showHieuconToast('Lỗi kết nối mạng khi sắp xếp.', true);
        });
    }

    // Quick Save Lesson (Order/Duration/Title/Video URL) on change or blur
    function saveLessonQuickMeta(lessonId, inputEl) {
        const row = inputEl.closest('.hieucon-lesson-row');
        const orderInput = row.querySelector('.hieucon-input-order');
        const durationInput = row.querySelector('.hieucon-input-duration');
        const titleInput = row.querySelector('.hieucon-input-title');
        const videoInput = row.querySelector('.hieucon-input-video');
        const savingIndicator = row.querySelector('.hieucon-saving-indicator');
        
        // Prevent trigger multiple times on change + blur
        if (inputEl.dataset.isSaving === "1") return;
        inputEl.dataset.isSaving = "1";
        
        if (savingIndicator) savingIndicator.classList.add('visible');
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_quick_update_lesson');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        formData.append('lesson_id', lessonId);
        formData.append('order', orderInput ? orderInput.value : '');
        formData.append('duration', durationInput ? durationInput.value : '');
        formData.append('title', titleInput ? titleInput.value : '');
        formData.append('video_url', videoInput ? videoInput.value : '');
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            inputEl.dataset.isSaving = "0";
            if (savingIndicator) savingIndicator.classList.remove('visible');
            if (data.success) {
                row.classList.add('hieucon-success-flash');
                setTimeout(() => row.classList.remove('hieucon-success-flash'), 1200);
                showHieuconToast(data.data.message || 'Đã tự động lưu thay đổi.');
            } else {
                showHieuconToast(data.data || 'Có lỗi xảy ra.', true);
            }
        })
        .catch(() => {
            inputEl.dataset.isSaving = "0";
            if (savingIndicator) savingIndicator.classList.remove('visible');
            showHieuconToast('Lỗi kết nối mạng.', true);
        });
    }

    // Toggle Lesson Status (Publish/Draft) via AJAX
    function toggleLessonStatus(lessonId, badgeEl) {
        const row = badgeEl.closest('.hieucon-lesson-row');
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_toggle_lesson_status');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        formData.append('lesson_id', lessonId);
        
        badgeEl.style.opacity = '0.5';
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            badgeEl.style.opacity = '1';
            if (data.success) {
                badgeEl.innerText = data.data.status_lbl;
                badgeEl.style.background = data.data.status_bg;
                badgeEl.style.color = data.data.status_col;
                row.classList.add('hieucon-success-flash');
                setTimeout(() => row.classList.remove('hieucon-success-flash'), 1200);
                showHieuconToast(data.data.message);
            } else {
                showHieuconToast(data.data || 'Có lỗi xảy ra.', true);
            }
        })
        .catch(() => {
            badgeEl.style.opacity = '1';
            showHieuconToast('Lỗi kết nối mạng.', true);
        });
    }

    // Delete Lesson via AJAX
    function deleteLesson(lessonId, btnEl) {
        if (!confirm('Bạn có chắc chắn muốn xóa bài học này không? Bài học sẽ được đưa vào thùng rác.')) {
            return;
        }
        
        const row = btnEl.closest('.hieucon-lesson-row');
        const table = row.closest('table');
        const card = table.closest('.hieucon-course-card');
        const courseId = card.getAttribute('data-id');
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_delete_lesson');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        formData.append('lesson_id', lessonId);
        
        row.style.opacity = '0.5';
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                row.style.transition = 'all 0.4s ease';
                row.style.transform = 'translateX(-30px)';
                row.style.opacity = '0';
                setTimeout(() => {
                    row.remove();
                    // Update lesson count badge on card
                    const countBadge = card.querySelector('.hieucon-lesson-count-badge');
                    const statBoxNum = card.querySelector('.hieucon-stat-lessons-num');
                    if (countBadge && statBoxNum) {
                        const currentCount = parseInt(statBoxNum.innerText) - 1;
                        statBoxNum.innerText = currentCount;
                        countBadge.innerText = currentCount + ' bài học';
                    }
                    
                    // Show empty text if no lessons left
                    const remainingRows = table.querySelectorAll('.hieucon-lesson-row');
                    if (remainingRows.length === 0) {
                        const tbody = table.querySelector('tbody');
                        const emptyTr = document.createElement('tr');
                        emptyTr.className = 'hieucon-empty-row';
                        emptyTr.innerHTML = `
                            <td colspan="7" style="text-align:center;padding:40px 20px;color:#64748b;background:#ffffff;">
                                <div style="font-size:36px;margin-bottom:12px;animation: bounce 2s infinite;">📖</div>
                                <div style="font-weight:700;font-size:14px;color:#334155;margin-bottom:6px;">Khóa học này hiện chưa có bài học nào!</div>
                                <p style="font-size:12px;color:#94a3b8;margin:0 0 16px 0;">Hãy bắt đầu xây dựng giáo trình bằng cách điền thông tin vào form <strong>"🚀 Thêm Bài Học Mới Nhanh"</strong> ngay phía dưới.</p>
                            </td>
                        `;
                        tbody.appendChild(emptyTr);
                    }
                }, 400);
                showHieuconToast(data.data.message);
            } else {
                row.style.opacity = '1';
                showHieuconToast(data.data || 'Có lỗi xảy ra.', true);
            }
        })
        .catch(() => {
            row.style.opacity = '1';
            showHieuconToast('Lỗi kết nối mạng.', true);
        });
    }

    // Add Lesson via AJAX (Adding full spreadsheet-like input row)
    function addLessonQuick(btnEl, courseId) {
        const form = btnEl.closest('.hieucon-quick-add-form');
        const titleInput = form.querySelector('.hieucon-add-title');
        const durationInput = form.querySelector('.hieucon-add-duration');
        const videoInput = form.querySelector('.hieucon-add-video');
        const orderInput = form.querySelector('.hieucon-add-order');
        const spinner = form.querySelector('.hieucon-add-spinner');
        
        const title = titleInput.value.trim();
        if (!title) {
            showHieuconToast('Vui lòng nhập tiêu đề bài học.', true);
            titleInput.focus();
            return;
        }
        
        btnEl.disabled = true;
        if (spinner) spinner.style.display = 'inline-block';
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_quick_add_lesson');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        formData.append('course_id', courseId);
        formData.append('title', title);
        formData.append('duration', durationInput.value.trim());
        formData.append('video_url', videoInput.value.trim());
        formData.append('order', orderInput.value);
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            btnEl.disabled = false;
            if (spinner) spinner.style.display = 'none';
            
            if (data.success) {
                const lesson = data.data;
                const card = document.querySelector(`.hieucon-course-card[data-id="${courseId}"]`);
                const table = card.querySelector('.hieucon-lesson-table');
                const tbody = table.querySelector('tbody');
                
                // Remove empty row if exists
                const emptyRow = tbody.querySelector('.hieucon-empty-row');
                if (emptyRow) emptyRow.remove();
                
                // Create new spreadsheet-styled row
                const tr = document.createElement('tr');
                tr.className = 'hieucon-lesson-row draggable hieucon-success-flash';
                tr.setAttribute('data-id', lesson.id);
                tr.setAttribute('draggable', 'true');
                
                // Bind Drag Events
                tr.addEventListener('dragstart', handleDragStart);
                tr.addEventListener('dragover', handleDragOver);
                tr.addEventListener('dragleave', handleDragLeave);
                tr.addEventListener('drop', handleDrop);
                tr.addEventListener('dragend', handleDragEnd);
                
                tr.innerHTML = `
                    <td style="text-align:center; cursor:move; color:#94a3b8; font-size:16px; font-weight:bold; user-select:none;" class="hieucon-drag-handle" title="Kéo thả để sắp xếp">⋮⋮</td>
                    <td>
                        <input type="number" class="hieucon-lesson-input hieucon-input-order" value="${lesson.order}" min="1"
                            onchange="saveLessonQuickMeta(${lesson.id}, this)" onblur="saveLessonQuickMeta(${lesson.id}, this)">
                    </td>
                    <td class="hieucon-lesson-title-cell">
                        <input type="text" class="hieucon-lesson-input hieucon-input-title w-full font-semibold" value="${lesson.title}"
                            onchange="saveLessonQuickMeta(${lesson.id}, this)" onblur="saveLessonQuickMeta(${lesson.id}, this)" style="font-weight:700 !important; color:#1e293b !important;">
                    </td>
                    <td>
                        <input type="text" class="hieucon-lesson-input hieucon-input-duration" value="${lesson.duration}" placeholder="Ví dụ: 12:45"
                            onchange="saveLessonQuickMeta(${lesson.id}, this)" onblur="saveLessonQuickMeta(${lesson.id}, this)">
                    </td>
                    <td>
                        <input type="text" class="hieucon-lesson-input hieucon-input-video w-full text-xs font-mono" value="${lesson.video_url}" placeholder="Đường dẫn hoặc mã nhúng..."
                            onchange="saveLessonQuickMeta(${lesson.id}, this)" onblur="saveLessonQuickMeta(${lesson.id}, this)">
                    </td>
                    <td style="text-align:center;">
                        <span class="hieucon-badge hieucon-status-badge" style="background:${lesson.status_bg};color:${lesson.status_col};"
                            onclick="toggleLessonStatus(${lesson.id}, this)">
                            ${lesson.status_lbl}
                        </span>
                    </td>
                    <td style="text-align:right;white-space:nowrap;">
                        <span class="hieucon-saving-indicator">
                            <span class="spinner is-active" style="float:none;margin:0 4px 0 0;width:12px;height:12px;"></span>Đang lưu
                        </span>
                        <a href="${lesson.edit_link}" class="button button-small" target="_blank" title="Sửa chi tiết">Sửa đầy đủ</a>
                        <a href="${lesson.permalink}" class="button button-small" target="_blank" title="Xem bài học">👁</a>
                        <button type="button" class="button button-small button-link-delete" style="color:#ef4444;" onclick="deleteLesson(${lesson.id}, this)">Xóa</button>
                    </td>
                `;
                
                // Append row
                tbody.appendChild(tr);
                
                // Clear input fields
                titleInput.value = '';
                durationInput.value = '';
                videoInput.value = '';
                orderInput.value = parseInt(lesson.order) + 1; // Auto increment order
                
                // Update lesson count badge on card
                const countBadge = card.querySelector('.hieucon-lesson-count-badge');
                const statBoxNum = card.querySelector('.hieucon-stat-lessons-num');
                if (countBadge && statBoxNum) {
                    const currentCount = parseInt(statBoxNum.innerText) + 1;
                    statBoxNum.innerText = currentCount;
                    countBadge.innerText = currentCount + ' bài học';
                }
                
                showHieuconToast(lesson.message);
                titleInput.focus();
            } else {
                showHieuconToast(data.data || 'Có lỗi xảy ra.', true);
            }
        })
        .catch(() => {
            btnEl.disabled = false;
            if (spinner) spinner.style.display = 'none';
            showHieuconToast('Lỗi kết nối mạng.', true);
        });
    }

    // Quick Course Info Editor Panel Save via AJAX
    function saveCourseQuickInfo(courseId, btnEl) {
        const panel = btnEl.closest('.hieucon-course-edit-panel');
        const priceInput = panel.querySelector('.hieucon-course-edit-price');
        const levelSelect = panel.querySelector('.hieucon-course-edit-level');
        const durationInput = panel.querySelector('.hieucon-course-edit-duration');
        const videoInput = panel.querySelector('.hieucon-course-edit-video');
        const contentTextarea = panel.querySelector('.hieucon-course-edit-content');
        const savingIndicator = panel.querySelector('.hieucon-course-saving-indicator');
        
        btnEl.disabled = true;
        if (savingIndicator) {
            savingIndicator.style.opacity = '1';
        }
        
        const formData = new FormData();
        formData.append('action', 'hieucon_admin_quick_update_course');
        formData.append('nonce', '<?php echo esc_attr( $nonce ); ?>');
        formData.append('course_id', courseId);
        formData.append('price', priceInput ? priceInput.value : '0');
        formData.append('level', levelSelect ? levelSelect.value : 'basic');
        formData.append('duration', durationInput ? durationInput.value : '');
        formData.append('intro_video', videoInput ? videoInput.value : '');
        formData.append('post_content', contentTextarea ? contentTextarea.value : '');
        
        fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
            method: 'POST',
            body: formData,
            credentials: 'same-origin'
        })
        .then(r => r.json())
        .then(data => {
            btnEl.disabled = false;
            if (savingIndicator) {
                savingIndicator.style.opacity = '0';
            }
            
            if (data.success) {
                showHieuconToast(data.data.message || 'Đã lưu thông tin khóa học thành công!');
                
                // Real-time synchronization of header badges on the course card
                const card = document.querySelector(`.hieucon-course-card[data-id="${courseId}"]`);
                if (card) {
                    const metaContainer = card.querySelector('.hieucon-course-meta-tags');
                    if (metaContainer) {
                        // 1. Update Price Badge (1st badge)
                        const priceBadge = metaContainer.children[0];
                        if (priceBadge) {
                            priceBadge.className = 'hieucon-badge ' + data.data.price_badge;
                            priceBadge.innerText = data.data.price_lbl;
                        }
                        
                        // 2. Update Level Badge (2nd badge)
                        const levelBadge = metaContainer.children[1];
                        if (levelBadge) {
                            levelBadge.className = 'hieucon-badge ' + data.data.level_badge;
                            levelBadge.innerText = data.data.level_lbl;
                        }
                        
                        // 3. Update or insert Duration Badge
                        let durationBadge = Array.from(metaContainer.children).find(el => el.textContent.includes('⏱'));
                        if (data.data.duration) {
                            if (!durationBadge) {
                                durationBadge = document.createElement('span');
                                durationBadge.className = 'hieucon-badge hieucon-badge-gray';
                                // Insert after level badge
                                if (metaContainer.children[2]) {
                                    metaContainer.insertBefore(durationBadge, metaContainer.children[2]);
                                } else {
                                    metaContainer.appendChild(durationBadge);
                                }
                            }
                            durationBadge.innerText = '⏱ ' + data.data.duration;
                        } else {
                            if (durationBadge) {
                                durationBadge.remove();
                            }
                        }
                    }
                }
            } else {
                showHieuconToast(data.data || 'Có lỗi xảy ra khi lưu thông tin.', true);
            }
        })
        .catch(() => {
            btnEl.disabled = false;
            if (savingIndicator) {
                savingIndicator.style.opacity = '0';
            }
            showHieuconToast('Lỗi kết nối mạng.', true);
        });
    }
    </script>
    <?php elseif ( $active_tab === 'enrollment' ) : ?>
        <?php hieucon_enrollment_tab_html( $nonce ); ?>
    <?php endif; ?>
        </div>
    </div>
    <?php
}

// ============================================================
// 4. Tab: Quản lý Ghi danh
// ============================================================
function hieucon_enrollment_tab_html( $nonce ) {
    global $wpdb;
    $members_table = $wpdb->prefix . 'hieucon_members';

    $selected_member_id = isset( $_GET['member_id'] ) ? intval( $_GET['member_id'] ) : 0;

    // Lấy tất cả hội viên
    $members = $wpdb->get_results( "SELECT id, full_name, email FROM $members_table ORDER BY full_name ASC" );

    // Lấy tất cả khóa học
    $courses = get_posts( [
        'post_type'      => 'course',
        'posts_per_page' => -1,
        'post_status'    => 'publish',
        'orderby'        => 'title',
        'order'          => 'ASC',
    ] );

    ?>
    <h2 style="margin-top:0;margin-bottom:20px;">Cấp / Thu hồi Quyền Học</h2>

    <!-- Chọn hội viên -->
    <div style="display:flex;gap:12px;align-items:center;margin-bottom:24px;flex-wrap:wrap;">
        <label for="member-select" style="font-weight:600;white-space:nowrap;">Chọn Hội viên:</label>
        <select id="member-select" style="min-width:300px;max-width:420px;padding:6px 10px;border-radius:6px;border:1px solid #d1d5db;"
            onchange="location.href='?page=hieucon-courses&tab=enrollment&member_id='+this.value;">
            <option value="0">— Chọn hội viên để quản lý —</option>
            <?php foreach ( $members as $m ) : ?>
                <option value="<?php echo intval( $m->id ); ?>" <?php selected( $selected_member_id, $m->id ); ?>>
                    <?php echo esc_html( $m->full_name . ' (' . $m->email . ')' ); ?>
                </option>
            <?php endforeach; ?>
        </select>
        <?php if ( $selected_member_id ) : ?>
            <a href="?page=hieucon-courses&tab=enrollment" class="button button-secondary">✕ Bỏ chọn</a>
        <?php endif; ?>
    </div>

    <?php if ( ! $selected_member_id ) : ?>
        <div style="text-align:center;padding:40px;background:#f8fafc;border-radius:12px;color:#64748b;">
            <div style="font-size:36px;margin-bottom:10px;">👆</div>
            <p style="font-size:14px;">Chọn một hội viên ở trên để xem và chỉnh sửa quyền truy cập khóa học của họ.</p>
        </div>
    <?php else :
        $selected_member = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $members_table WHERE id = %d", $selected_member_id ) );
        if ( ! $selected_member ) : ?>
            <div class="notice notice-error"><p>Không tìm thấy hội viên này.</p></div>
        <?php else :
            $enrolled_courses = hieucon_get_member_enrolled_courses( $selected_member_id );
            ?>
            <!-- Hội viên info card -->
            <div style="background:linear-gradient(135deg,#f0fdf4,#eff6ff);border:1px solid #bbf7d0;border-radius:12px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:16px;">
                <div style="width:48px;height:48px;border-radius:50%;background:#0d9488;color:white;display:flex;align-items:center;justify-content:center;font-size:20px;font-weight:700;flex-shrink:0;">
                    <?php echo mb_strtoupper( mb_substr( $selected_member->full_name, 0, 1 ) ); ?>
                </div>
                <div>
                    <div style="font-weight:700;font-size:16px;color:#0A1931;"><?php echo esc_html( $selected_member->full_name ); ?></div>
                    <div style="font-size:13px;color:#64748b;"><?php echo esc_html( $selected_member->email ); ?> &nbsp;·&nbsp;
                        <span style="font-weight:600;color:#0d9488;"><?php echo count( $enrolled_courses ); ?> khóa đã đăng ký</span>
                    </div>
                </div>
            </div>

            <?php if ( empty( $courses ) ) : ?>
                <div class="notice notice-warning"><p>Chưa có khóa học nào được tạo. Hãy <a href="<?php echo admin_url('post-new.php?post_type=course'); ?>">tạo khóa học mới</a> trước.</p></div>
            <?php else : ?>
                <!-- Course checklist -->
                <div id="enrollment-save-notice" style="display:none;"></div>
                <form id="enrollment-form">
                    <input type="hidden" name="member_id" value="<?php echo $selected_member_id; ?>">
                    <input type="hidden" name="nonce" value="<?php echo esc_attr( $nonce ); ?>">

                    <div style="display:grid;grid-template-columns:repeat(auto-fill, minmax(280px, 1fr));gap:12px;margin-bottom:20px;">
                        <?php foreach ( $courses as $course ) :
                            $is_enrolled = in_array( $course->ID, array_map( 'intval', $enrolled_courses ) );
                            $lesson_count = ( new WP_Query( [
                                'post_type'      => 'lesson',
                                'posts_per_page' => -1,
                                'fields'         => 'ids',
                                'meta_query'     => [ [ 'key' => '_belong_to_course', 'value' => $course->ID, 'compare' => '=' ] ],
                            ] ) )->found_posts;
                            wp_reset_postdata();
                            $thumb = get_the_post_thumbnail_url( $course->ID, 'thumbnail' );
                            ?>
                            <label style="
                                display:flex;align-items:flex-start;gap:14px;cursor:pointer;
                                padding:14px 16px;border-radius:12px;border:2px solid <?php echo $is_enrolled ? '#0d9488' : '#e5e7eb'; ?>;
                                background:<?php echo $is_enrolled ? 'linear-gradient(135deg,#f0fdf4,#f0fdfa)' : '#fff'; ?>;
                                transition:all 0.2s;
                            " class="course-card" onmouseover="this.style.borderColor='#0d9488'" onmouseout="if(!this.querySelector('input').checked){this.style.borderColor='#e5e7eb';this.style.background='#fff';}else{this.style.borderColor='#0d9488';}">
                                <input type="checkbox" name="course_ids[]" value="<?php echo $course->ID; ?>"
                                    <?php checked( $is_enrolled ); ?>
                                    style="margin-top:3px;width:16px;height:16px;accent-color:#0d9488;flex-shrink:0;"
                                    onchange="updateCardStyle(this)">
                                <?php if ( $thumb ) : ?>
                                    <img src="<?php echo esc_url( $thumb ); ?>" style="width:48px;height:48px;object-fit:cover;border-radius:8px;flex-shrink:0;" alt="">
                                <?php else : ?>
                                    <div style="width:48px;height:48px;background:linear-gradient(135deg,#e0f2fe,#bbf7d0);border-radius:8px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:22px;">📚</div>
                                <?php endif; ?>
                                <div style="flex:1;min-width:0;">
                                    <div style="font-weight:700;font-size:13px;color:#0A1931;margin-bottom:2px;line-height:1.3;"><?php echo esc_html( $course->post_title ); ?></div>
                                    <div style="font-size:11px;color:#64748b;"><?php echo $lesson_count; ?> bài học</div>
                                    <?php if ( $is_enrolled ) : ?>
                                        <div style="font-size:11px;color:#0d9488;font-weight:600;margin-top:3px;">✓ Đang có quyền truy cập</div>
                                    <?php endif; ?>
                                </div>
                            </label>
                        <?php endforeach; ?>
                    </div>

                    <div style="display:flex;gap:10px;align-items:center;">
                        <button type="button" onclick="saveEnrollments()" class="button button-primary" style="padding:8px 24px;font-size:14px;font-weight:600;">
                            💾 Lưu thay đổi
                        </button>
                        <button type="button" onclick="selectAllCourses(true)" class="button button-secondary">Chọn tất cả</button>
                        <button type="button" onclick="selectAllCourses(false)" class="button button-secondary">Bỏ chọn tất cả</button>
                        <span id="enrollment-spinner" style="display:none;">
                            <span class="spinner is-active" style="float:none;margin:0;"></span>
                            <span style="font-size:13px;color:#64748b;">Đang lưu...</span>
                        </span>
                    </div>
                </form>

                <script>
                function updateCardStyle(checkbox) {
                    const card = checkbox.closest('label');
                    if (checkbox.checked) {
                        card.style.borderColor = '#0d9488';
                        card.style.background = 'linear-gradient(135deg,#f0fdf4,#f0fdfa)';
                    } else {
                        card.style.borderColor = '#e5e7eb';
                        card.style.background = '#fff';
                    }
                }

                function selectAllCourses(state) {
                    document.querySelectorAll('#enrollment-form input[type="checkbox"]').forEach(cb => {
                        cb.checked = state;
                        updateCardStyle(cb);
                    });
                }

                function saveEnrollments() {
                    const form = document.getElementById('enrollment-form');
                    const notice = document.getElementById('enrollment-save-notice');
                    const spinner = document.getElementById('enrollment-spinner');
                    const btn = form.querySelector('button[onclick="saveEnrollments()"]');

                    spinner.style.display = 'inline-flex';
                    btn.disabled = true;
                    notice.style.display = 'none';

                    const formData = new FormData(form);
                    formData.append('action', 'hieucon_admin_save_enrollments');

                    // If no checkboxes checked, send empty array signal
                    const checked = form.querySelectorAll('input[name="course_ids[]"]:checked');
                    if (checked.length === 0) {
                        formData.append('course_ids[]', '');
                    }

                    fetch('<?php echo esc_url( admin_url( "admin-ajax.php" ) ); ?>', {
                        method: 'POST',
                        body: formData,
                        credentials: 'same-origin',
                    })
                    .then(r => r.json())
                    .then(data => {
                        spinner.style.display = 'none';
                        btn.disabled = false;
                        if (data.success) {
                            notice.innerHTML = '<div class="notice notice-success is-dismissible" style="margin:0 0 16px;"><p>✅ <strong>' + data.data.message + '</strong></p></div>';
                        } else {
                            notice.innerHTML = '<div class="notice notice-error is-dismissible" style="margin:0 0 16px;"><p>❌ <strong>' + (data.data || 'Có lỗi xảy ra.') + '</strong></p></div>';
                        }
                        notice.style.display = 'block';
                        window.scrollTo({top: 0, behavior:'smooth'});
                    })
                    .catch(() => {
                        spinner.style.display = 'none';
                        btn.disabled = false;
                        notice.innerHTML = '<div class="notice notice-error" style="margin:0 0 16px;"><p>❌ Lỗi kết nối. Vui lòng thử lại.</p></div>';
                        notice.style.display = 'block';
                    });
                }
                </script>
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
    <?php
}
