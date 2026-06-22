<?php
/**
 * Hieucon E-Learning Core Settings & Post Types Registration
 * Decoupled and Integrated directly inside the Hieucon Theme.
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Chống truy cập trực tiếp
}

// Định nghĩa Constants tương thích
if ( ! defined( 'HIEUCON_ELEARNING_DIR' ) ) {
    define( 'HIEUCON_ELEARNING_DIR', HIEUCON_THEME_DIR . '/' );
}
if ( ! defined( 'HIEUCON_ELEARNING_URL' ) ) {
    define( 'HIEUCON_ELEARNING_URL', HIEUCON_THEME_URI . '/' );
}

/**
 * 1. TỰ ĐỘNG TẠO BẢNG MÃ KÍCH HOẠT KHI THEME KHỞI CHẠY
 */
if ( ! function_exists( 'hieucon_elearning_auto_create_table' ) ) {
    function hieucon_elearning_auto_create_table() {
        global $wpdb;
        $table_name = $wpdb->prefix . 'elearning_redeem_codes';

        // Tránh truy vấn lặp lại nếu bảng đã tồn tại
        $existing = $wpdb->get_var($wpdb->prepare('SHOW TABLES LIKE %s', $table_name));
        if ($existing === $table_name) {
            return;
        }

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$table_name} (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            code varchar(100) NOT NULL,
            course_id bigint(20) NOT NULL,
            status tinyint(1) DEFAULT 0 NOT NULL,
            used_by bigint(20) DEFAULT NULL,
            used_at datetime DEFAULT NULL,
            PRIMARY KEY  (id),
            UNIQUE KEY code (code),
            KEY course_id (course_id),
            KEY status (status),
            KEY used_by (used_by)
        ) {$charset_collate};";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta( $sql );

        // Gieo dữ liệu thử nghiệm ban đầu nếu bảng rỗng
        $count = $wpdb->get_var( "SELECT COUNT(*) FROM {$table_name}" );
        if ( $count == 0 ) {
            $wpdb->insert(
                $table_name,
                [
                    'code'      => 'HIEUCON-FREE-01',
                    'course_id' => 1,
                    'status'    => 0
                ]
            );
            $wpdb->insert(
                $table_name,
                [
                    'code'      => 'HIEUCON-VIP-99',
                    'course_id' => 1,
                    'status'    => 0
                ]
            );
        }
    }
    add_action( 'init', 'hieucon_elearning_auto_create_table' );
}

/**
 * 2. ĐĂNG KÝ CUSTOM POST TYPES & TAXONOMY DÀNH CHO E-LEARNING
 */
if ( ! function_exists( 'hieucon_elearning_register_cpts' ) ) {
    function hieucon_elearning_register_cpts() {
        // A. Taxonomy: Danh mục khóa học (course_cat)
        $cat_labels = [
            'name'              => 'Danh mục khóa học',
            'singular_name'     => 'Danh mục khóa học',
            'search_items'      => 'Tìm danh mục',
            'all_items'         => 'Tất cả danh mục',
            'parent_item'       => 'Danh mục cha',
            'parent_item_colon' => 'Danh mục cha:',
            'edit_item'         => 'Sửa danh mục',
            'update_item'       => 'Cập nhật danh mục',
            'add_new_item'      => 'Thêm danh mục mới',
            'new_item_name'     => 'Tên danh mục mới',
            'menu_name'         => 'Danh mục khóa học',
        ];

        register_taxonomy( 'course_cat', [ 'course' ], [
            'hierarchical'      => true,
            'labels'            => $cat_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => 'course-category' ],
        ] );

        // B. Custom Post Type: Khóa học (course)
        $course_labels = [
            'name'               => 'Khóa học',
            'singular_name'      => 'Khóa học',
            'menu_name'          => 'E-Learning',
            'name_admin_bar'     => 'Khóa học',
            'add_new'            => 'Thêm khóa học mới',
            'add_new_item'       => 'Thêm khóa học mới',
            'new_item'           => 'Khóa học mới',
            'edit_item'          => 'Sửa khóa học',
            'view_item'          => 'Xem khóa học',
            'all_items'          => 'Tất cả khóa học',
            'search_items'       => 'Tìm khóa học',
            'parent_item_colon'  => 'Khóa học cha:',
            'not_found'          => 'Không tìm thấy khóa học nào.',
            'not_found_in_trash' => 'Không tìm thấy khóa học nào trong thùng rác.'
        ];

        register_post_type( 'course', [
            'labels'             => $course_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => [ 'slug' => 'courses' ],
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => 25,
            'menu_icon'          => 'dashicons-welcome-learn-more',
            'supports'           => [ 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ],
        ] );

        // C. Custom Post Type: Bài học (lesson)
        $lesson_labels = [
            'name'               => 'Bài học',
            'singular_name'      => 'Bài học',
            'menu_name'          => 'Bài học',
            'add_new'            => 'Thêm bài học mới',
            'add_new_item'       => 'Thêm bài học mới',
            'new_item'           => 'Bài học mới',
            'edit_item'          => 'Sửa bài học',
            'view_item'          => 'Xem bài học',
            'all_items'          => 'Tất cả bài học',
            'search_items'       => 'Tìm bài học',
            'parent_item_colon'  => 'Bài học cha:',
            'not_found'          => 'Không tìm thấy bài học nào.',
            'not_found_in_trash' => 'Không tìm thấy bài học nào trong thùng rác.'
        ];

        register_post_type( 'lesson', [
            'labels'             => $lesson_labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => 'edit.php?post_type=course', // Hiển thị lồng trong menu E-Learning
            'query_var'          => true,
            'rewrite'            => [ 'slug' => 'lessons' ],
            'capability_type'    => 'post',
            'has_archive'        => false,
            'hierarchical'       => false,
            'menu_icon'          => 'dashicons-video-alt3',
            'supports'           => [ 'title', 'editor', 'comments' ],
        ] );
    }
    add_action( 'init', 'hieucon_elearning_register_cpts' );
}

/**
 * 3. ĐĂNG KÝ CÁC HỘP METABOXES CẤU HÌNH TRONG ADMIN
 */
if ( ! function_exists( 'hieucon_elearning_add_meta_boxes' ) ) {
    function hieucon_elearning_add_meta_boxes() {
        // Course Meta Box
        add_meta_box(
            'hieucon_course_settings',
            'Cấu hình Khóa học',
            'hieucon_course_metabox_html',
            'course',
            'normal',
            'high'
        );

        // Lesson Meta Box
        add_meta_box(
            'hieucon_lesson_settings',
            'Cấu hình Bài học',
            'hieucon_lesson_metabox_html',
            'lesson',
            'normal',
            'high'
        );
    }
    add_action( 'add_meta_boxes', 'hieucon_elearning_add_meta_boxes' );
}

// A. HTML Metabox Khóa học
if ( ! function_exists( 'hieucon_course_metabox_html' ) ) {
    function hieucon_course_metabox_html( $post ) {
        wp_nonce_field( 'hieucon_course_meta_nonce', 'course_meta_nonce' );
        
        $price       = get_post_meta( $post->ID, '_course_price', true );
        $level       = get_post_meta( $post->ID, '_course_level', true );
        $intro_video = get_post_meta( $post->ID, '_course_intro_video', true );
        $duration    = get_post_meta( $post->ID, '_course_duration', true );
        ?>
        <table class="form-table">
            <tr>
                <th><label for="course_price">Giá bán (VND)</label></th>
                <td>
                    <input type="number" id="course_price" name="course_price" value="<?php echo esc_attr( $price ); ?>" class="regular-text" placeholder="Ví dụ: 500000. Để 0 nếu Miễn phí.">
                </td>
            </tr>
            <tr>
                <th><label for="course_level">Cấp độ</label></th>
                <td>
                    <select id="course_level" name="course_level" class="regular-text">
                        <option value="basic" <?php selected( $level, 'basic' ); ?>>Cơ bản (Basic)</option>
                        <option value="intermediate" <?php selected( $level, 'intermediate' ); ?>>Trung cấp (Intermediate)</option>
                        <option value="advanced" <?php selected( $level, 'advanced' ); ?>>Nâng cao (Advanced)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="course_intro_video">Video giới thiệu (Intro URL)</label></th>
                <td>
                    <input type="url" id="course_intro_video" name="course_intro_video" value="<?php echo esc_url( $intro_video ); ?>" class="large-text" placeholder="Đường dẫn YouTube, Vimeo, hoặc Bunny.net iframe">
                </td>
            </tr>
            <tr>
                <th><label for="course_duration">Tổng thời lượng</label></th>
                <td>
                    <input type="text" id="course_duration" name="course_duration" value="<?php echo esc_attr( $duration ); ?>" class="regular-text" placeholder="Ví dụ: 12 giờ 30 phút">
                </td>
            </tr>
        </table>
        <?php
    }
}

// B. HTML Metabox Bài học
if ( ! function_exists( 'hieucon_lesson_metabox_html' ) ) {
    function hieucon_lesson_metabox_html( $post ) {
        wp_nonce_field( 'hieucon_lesson_meta_nonce', 'lesson_meta_nonce' );

        $belong_to = get_post_meta( $post->ID, '_belong_to_course', true );
        $video_url = get_post_meta( $post->ID, '_video_url', true );
        $duration  = get_post_meta( $post->ID, '_lesson_duration', true );
        $order     = get_post_meta( $post->ID, '_lesson_order', true );

        // Lấy toàn bộ khóa học để gán liên kết
        $courses = get_posts( [
            'post_type'      => 'course',
            'posts_per_page' => -1,
            'post_status'    => 'publish',
        ] );
        ?>
        <table class="form-table">
            <tr>
                <th><label for="belong_to_course">Thuộc khóa học</label></th>
                <td>
                    <select id="belong_to_course" name="belong_to_course" class="regular-text" required>
                        <option value="">-- Chọn khóa học liên kết --</option>
                        <?php foreach ( $courses as $c ) : ?>
                            <option value="<?php echo $c->ID; ?>" <?php selected( $belong_to, $c->ID ); ?>><?php echo esc_html( $c->post_title ); ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <th><label for="lesson_video_url">Video URL / Mã nhúng</label></th>
                <td>
                    <input type="text" id="lesson_video_url" name="lesson_video_url" value="<?php echo esc_attr( $video_url ); ?>" class="large-text" placeholder="Đường dẫn YouTube, Vimeo, Bunny.net Stream, hoặc iframe nhúng">
                </td>
            </tr>
            <tr>
                <th><label for="lesson_duration">Thời lượng bài học</label></th>
                <td>
                    <input type="text" id="lesson_duration" name="lesson_duration" value="<?php echo esc_attr( $duration ); ?>" class="regular-text" placeholder="Ví dụ: 15:20">
                </td>
            </tr>
            <tr>
                <th><label for="lesson_order">Thứ tự hiển thị (Playlist)</label></th>
                <td>
                    <input type="number" id="lesson_order" name="lesson_order" value="<?php echo esc_attr( $order ? $order : 1 ); ?>" class="regular-text" min="1">
                </td>
            </tr>
        </table>
        <?php
    }
}

// C. Lưu dữ liệu Metabox
if ( ! function_exists( 'hieucon_elearning_save_meta_boxes' ) ) {
    function hieucon_elearning_save_meta_boxes( $post_id ) {
        // 1. Lưu thông số Khóa học
        if ( isset( $_POST['course_meta_nonce'] ) && wp_verify_nonce( $_POST['course_meta_nonce'], 'hieucon_course_meta_nonce' ) ) {
            if ( isset( $_POST['course_price'] ) ) {
                update_post_meta( $post_id, '_course_price', floatval( $_POST['course_price'] ) );
            }
            if ( isset( $_POST['course_level'] ) ) {
                update_post_meta( $post_id, '_course_level', sanitize_text_field( $_POST['course_level'] ) );
            }
            if ( isset( $_POST['course_intro_video'] ) ) {
                update_post_meta( $post_id, '_course_intro_video', esc_url_raw( $_POST['course_intro_video'] ) );
            }
            if ( isset( $_POST['course_duration'] ) ) {
                update_post_meta( $post_id, '_course_duration', sanitize_text_field( $_POST['course_duration'] ) );
            }
        }

        // 2. Lưu thông số Bài học
        if ( isset( $_POST['lesson_meta_nonce'] ) && wp_verify_nonce( $_POST['lesson_meta_nonce'], 'hieucon_lesson_meta_nonce' ) ) {
            if ( isset( $_POST['belong_to_course'] ) ) {
                update_post_meta( $post_id, '_belong_to_course', intval( $_POST['belong_to_course'] ) );
            }
            if ( isset( $_POST['lesson_video_url'] ) ) {
                update_post_meta( $post_id, '_video_url', sanitize_text_field( $_POST['lesson_video_url'] ) );
            }
            if ( isset( $_POST['lesson_duration'] ) ) {
                update_post_meta( $post_id, '_lesson_duration', sanitize_text_field( $_POST['lesson_duration'] ) );
            }
            if ( isset( $_POST['lesson_order'] ) ) {
                update_post_meta( $post_id, '_lesson_order', intval( $_POST['lesson_order'] ) );
            }
        }
    }
    add_action( 'save_post', 'hieucon_elearning_save_meta_boxes' );
}

/**
 * 4. XỬ LÝ KÍCH HOẠT KHÓA HỌC BẰNG MÃ (AJAX REDEEM CODE)
 */
if ( ! function_exists( 'hieucon_ajax_redeem_course_code' ) ) {
    function hieucon_ajax_redeem_course_code() {
        hieucon_debug_log( "hieucon_ajax_redeem_course_code started. POST: " . json_encode( $_POST ) );

        if ( ! isset( $_POST['nonce'] ) || ! wp_verify_nonce( $_POST['nonce'], 'hieucon_account_nonce' ) ) {
            hieucon_debug_log( "Nonce verification failed for hieucon_account_nonce." );
            wp_send_json_error( [ 'message' => 'Phiên làm việc hết hạn hoặc yêu cầu không hợp lệ. Vui lòng tải lại trang và thử lại.' ] );
        }

        // Kiểm tra lớp quản lý tài khoản thành viên
        if ( ! class_exists( '\Hieucon\Model\Member_Model' ) ) {
            hieucon_debug_log( "Member_Model class not found." );
            wp_send_json_error( [ 'message' => 'Lớp quản lý tài khoản không khả dụng.' ] );
        }

        $current_member = \Hieucon\Model\Member_Model::get_current_member();
        if ( ! $current_member ) {
            hieucon_debug_log( "No current member logged in." );
            wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập để thực hiện kích hoạt.' ] );
        }

        $code = isset( $_POST['code'] ) ? sanitize_text_field( trim( $_POST['code'] ) ) : '';
        hieucon_debug_log( "Sanitized Course Code: '{$code}'" );

        if ( empty( $code ) ) {
            hieucon_debug_log( "Course code is empty." );
            wp_send_json_error( [ 'message' => 'Vui lòng nhập mã kích hoạt.' ] );
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'elearning_redeem_codes';

        // Chống tranh chấp dữ liệu (Race Condition) khi click liên tục: Sử dụng Transaction
        $wpdb->query( 'START TRANSACTION' );

        // Truy vấn và khóa hàng (Row Lock) bằng FOR UPDATE
        $code_row = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table_name} WHERE code = %s FOR UPDATE",
                $code
            )
        );

        if ( ! $code_row ) {
            hieucon_debug_log( "Redeem code '{$code}' not found in {$table_name} table." );
            $wpdb->query( 'ROLLBACK' );
            wp_send_json_error( [ 'message' => 'Mã kích hoạt không hợp lệ hoặc không tồn tại.' ] );
        }

        hieucon_debug_log( "Redeem code found: ID: {$code_row->id}, course_id: {$code_row->course_id}, status: {$code_row->status}" );

        if ( $code_row->status == 1 ) {
            $wpdb->query( 'ROLLBACK' );
            wp_send_json_error( [ 'message' => 'Mã kích hoạt này đã được sử dụng trước đó.' ] );
        }

        $course_id = intval( $code_row->course_id );
        $member_id = intval( $current_member->id );

        // Kiểm tra khóa học liên kết tồn tại
        if ( ! get_post( $course_id ) ) {
            $wpdb->query( 'ROLLBACK' );
            wp_send_json_error( [ 'message' => 'Khóa học liên kết với mã này hiện không khả dụng.' ] );
        }

        // Đọc danh sách khóa học đã kích hoạt của hội viên
        $enrolled_courses = get_option( "hieucon_enrolled_courses_{$member_id}", [] );
        if ( ! is_array( $enrolled_courses ) ) {
            $enrolled_courses = [];
        }

        // Tránh kích hoạt trùng lặp
        if ( in_array( $course_id, $enrolled_courses ) ) {
            $wpdb->query( 'ROLLBACK' );
            wp_send_json_error( [ 'message' => 'Tài khoản của bạn đã sở hữu khóa học này từ trước.' ] );
        }

        // Kích hoạt ghi danh khóa học
        $enrolled_courses[] = $course_id;
        update_option( "hieucon_enrolled_courses_{$member_id}", $enrolled_courses );

        // Cập nhật trạng thái mã kích hoạt trong CSDL atomically
        $updated = $wpdb->update(
            $table_name,
            [
                'status'  => 1,
                'used_by' => $member_id,
                'used_at' => current_time( 'mysql' )
            ],
            [ 'id' => $code_row->id ]
        );

        if ( $updated === false ) {
            $wpdb->query( 'ROLLBACK' );
            wp_send_json_error( [ 'message' => 'Lỗi kết nối cơ sở dữ liệu khi kích hoạt mã.' ] );
        }

        $wpdb->query( 'COMMIT' );

        $course_url = get_permalink( $course_id );

        wp_send_json_success( [
            'message'      => 'Kích hoạt khóa học thành công! Chúc bạn học tập tốt.',
            'redirect_url' => $course_url
        ] );
    }
    add_action( 'wp_ajax_hieucon_redeem_course_code', 'hieucon_ajax_redeem_course_code' );
}

/**
 * 5. XỬ LÝ THẢ TIM / YÊU THÍCH BÀI VIẾT (AJAX LIKE SYSTEM)
 */
if ( ! function_exists( 'hieucon_ajax_like_post' ) ) {
    function hieucon_ajax_like_post() {
        check_ajax_referer( 'hieucon_like_nonce', 'nonce' );

        if ( ! class_exists( '\Hieucon\Model\Member_Model' ) ) {
            wp_send_json_error( [ 'message' => 'Lớp quản lý tài khoản không khả dụng.' ] );
        }

        $current_member = \Hieucon\Model\Member_Model::get_current_member();
        if ( ! $current_member ) {
            wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập để thích bài viết.' ] );
        }

        $post_id   = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
        $member_id = intval( $current_member->id );

        if ( ! $post_id || ! get_post( $post_id ) ) {
            wp_send_json_error( [ 'message' => 'Bài viết không hợp lệ.' ] );
        }

        // Đọc danh sách đã thích
        $liked_by = get_post_meta( $post_id, '_liked_by_users', true );
        if ( ! is_array( $liked_by ) ) {
            $liked_by = [];
        }

        if ( in_array( $member_id, $liked_by ) ) {
            // Hủy thích
            $liked_by = array_diff( $liked_by, [ $member_id ] );
            $status   = 'unliked';
        } else {
            // Thích bài viết
            $liked_by[] = $member_id;
            $status     = 'liked';
        }

        $liked_by = array_values( $liked_by );

        update_post_meta( $post_id, '_liked_by_users', $liked_by );
        $total_likes = count( $liked_by );

        wp_send_json_success( [
            'status'      => $status,
            'total_likes' => $total_likes,
            'message'     => $status === 'liked' ? 'Đã thêm vào danh sách yêu thích!' : 'Đã xóa khỏi danh sách yêu thích.'
        ] );
    }
    add_action( 'wp_ajax_hieucon_like_post', 'hieucon_ajax_like_post' );
}

/**
 * 6. TRANG CẤU HÌNH THÔNG BÁO EMAIL THẢO LUẬN TRONG WP ADMIN
 */
if ( ! function_exists( 'hieucon_elearning_admin_menu' ) ) {
    function hieucon_elearning_admin_menu() {
        add_submenu_page(
            'edit.php?post_type=course',
            'Cài đặt Thông báo Email',
            'Cài đặt Email',
            'manage_options',
            'hieucon-elearning-settings',
            'hieucon_elearning_settings_html'
        );
    }
    add_action( 'admin_menu', 'hieucon_elearning_admin_menu' );
}

// Giao diện cấu hình trong trang quản trị
if ( ! function_exists( 'hieucon_elearning_settings_html' ) ) {
    function hieucon_elearning_settings_html() {
        if ( ! current_user_can( 'manage_options' ) ) {
            return;
        }

        // Xử lý lưu thiết lập thủ công
        if ( isset( $_POST['hieucon_elearning_save_settings'] ) ) {
            check_admin_referer( 'hieucon_elearning_settings_save', 'hieucon_elearning_settings_nonce' );
            
            $enabled = isset( $_POST['notify_enabled'] ) ? '1' : '0';
            $emails = isset( $_POST['notify_emails'] ) ? sanitize_textarea_field( $_POST['notify_emails'] ) : '';
            
            update_option( 'hieucon_elearning_notify_enabled', $enabled );
            update_option( 'hieucon_elearning_notify_emails', $emails );
            
            echo '<div class="notice notice-success is-dismissible"><p><strong>Đã cập nhật cấu hình email thông báo thành công!</strong></p></div>';
        }

        $enabled = get_option( 'hieucon_elearning_notify_enabled', '1' );
        $emails = get_option( 'hieucon_elearning_notify_emails', '' );
        $settings_nonce = wp_create_nonce( 'hieucon_elearning_settings_save' );
        $ajax_nonce = wp_create_nonce( 'hieucon_elearning_settings_nonce' );
        ?>
        <div class="wrap hieucon-admin-wrap" style="max-width: 900px; margin: 30px auto 30px 20px;">
            <style>
                .hieucon-admin-header {
                    background: linear-gradient(135deg, #0a1931 0%, #15305b 100%);
                    border-radius: 20px;
                    padding: 35px 40px;
                    color: #ffffff;
                    box-shadow: 0 10px 25px -5px rgba(10,25,49,0.15);
                    margin-bottom: 30px;
                    position: relative;
                    overflow: hidden;
                }
                .hieucon-admin-header::after {
                    content: '';
                    position: absolute;
                    top: -50%;
                    right: -20%;
                    width: 300px;
                    height: 300px;
                    background: radial-gradient(circle, rgba(249,115,22,0.1) 0%, rgba(0,0,0,0) 70%);
                    border-radius: 50%;
                }
                .hieucon-admin-header h1 {
                    color: #ffffff !important;
                    font-size: 28px !important;
                    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
                    font-weight: 700 !important;
                    margin: 0 0 8px 0 !important;
                }
                .hieucon-admin-header p {
                    font-size: 14px;
                    color: rgba(255,255,255,0.7);
                    margin: 0;
                    font-weight: 500;
                }
                .hieucon-admin-card {
                    background: #ffffff;
                    border-radius: 20px;
                    border: 1px solid rgba(0,0,0,0.06);
                    box-shadow: 0 4px 20px -2px rgba(0,0,0,0.03);
                    padding: 30px 40px;
                    margin-bottom: 25px;
                }
                .hieucon-section-title {
                    font-size: 18px;
                    font-weight: 700;
                    color: #0a1931;
                    margin: 0 0 20px 0;
                    border-bottom: 2px solid #f1f5f9;
                    padding-bottom: 12px;
                    display: flex;
                    align-items: center;
                    gap: 10px;
                }
                .form-grid {
                    display: grid;
                    grid-template-columns: 220px 1fr;
                    gap: 30px;
                    align-items: start;
                }
                .form-label {
                    font-weight: 700;
                    color: #334155;
                    font-size: 14px;
                    padding-top: 8px;
                }
                .form-value {
                    position: relative;
                }
                
                /* Modern Toggle Switch */
                .switch-container {
                    display: inline-flex;
                    align-items: center;
                    gap: 12px;
                    cursor: pointer;
                }
                .switch-input {
                    display: none;
                }
                .switch-slider {
                    width: 50px;
                    height: 28px;
                    background-color: #cbd5e1;
                    border-radius: 14px;
                    position: relative;
                    transition: background-color 0.3s;
                }
                .switch-slider::before {
                    content: '';
                    position: absolute;
                    width: 22px;
                    height: 22px;
                    border-radius: 50%;
                    background-color: #ffffff;
                    top: 3px;
                    left: 3px;
                    transition: transform 0.3s;
                    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                }
                .switch-input:checked + .switch-slider {
                    background-color: #f97316;
                }
                .switch-input:checked + .switch-slider::before {
                    transform: translateX(22px);
                }
                .switch-text {
                    font-size: 14px;
                    font-weight: 600;
                    color: #475569;
                }
                
                .textarea-input {
                    width: 100%;
                    border-radius: 12px;
                    border: 1px solid #cbd5e1;
                    padding: 12px 16px;
                    font-size: 14px;
                    font-family: monospace;
                    line-height: 1.5;
                    background-color: #f8fafc;
                    transition: all 0.3s;
                    min-height: 120px;
                }
                .textarea-input:focus {
                    border-color: #f97316;
                    outline: none;
                    background-color: #ffffff;
                    box-shadow: 0 0 0 3px rgba(249,115,22,0.15);
                }
                
                .premium-btn {
                    background-color: #0a1931;
                    color: #ffffff;
                    border: none;
                    padding: 12px 24px;
                    border-radius: 12px;
                    font-size: 13px;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.3s;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                    box-shadow: 0 4px 10px rgba(10,25,49,0.1);
                }
                .premium-btn:hover {
                    background-color: #15305b;
                    transform: translateY(-1px);
                    box-shadow: 0 6px 15px rgba(10,25,49,0.15);
                }
                .premium-btn-secondary {
                    background-color: #ffffff;
                    color: #0a1931;
                    border: 1.5px solid #0a1931;
                    padding: 10px 22px;
                    border-radius: 12px;
                    font-size: 13px;
                    font-weight: 700;
                    cursor: pointer;
                    transition: all 0.3s;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                }
                .premium-btn-secondary:hover {
                    background-color: #f8fafc;
                    transform: translateY(-1px);
                }
                
                .input-desc {
                    font-size: 12px;
                    color: #64748b;
                    margin-top: 6px;
                    line-height: 1.4;
                }
                .alert-info-box {
                    background-color: #eff6ff;
                    border-left: 4px solid #3b82f6;
                    color: #1e3a8a;
                    padding: 16px 20px;
                    border-radius: 8px;
                    margin-top: 15px;
                    font-size: 13px;
                    line-height: 1.5;
                }
                
                #test-result-message {
                    margin-top: 15px;
                    padding: 12px 16px;
                    border-radius: 8px;
                    font-size: 13px;
                    font-weight: 600;
                    display: none;
                }
                #test-result-message.success {
                    background-color: #f0fdf4;
                    border-left: 4px solid #22c55e;
                    color: #14532d;
                }
                #test-result-message.error {
                    background-color: #fef2f2;
                    border-left: 4px solid #ef4444;
                    color: #7f1d1d;
                }
            </style>

            <div class="hieucon-admin-header">
                <h1>Cấu hình thông báo Email</h1>
                <p>Thiết lập danh sách hòm thư nhận thông báo thời gian thực khi học viên gửi thảo luận.</p>
            </div>

            <form method="post" action="">
                <input type="hidden" name="hieucon_elearning_save_settings" value="1">
                <input type="hidden" name="hieucon_elearning_settings_nonce" value="<?php echo esc_attr( $settings_nonce ); ?>">

                <div class="hieucon-admin-card">
                    <h2 class="hieucon-section-title">
                        <span class="dashicons dashicons-email-alt" style="margin-top: 2px;"></span> Cấu hình nhận thông báo
                    </h2>
                    
                    <div class="form-grid">
                        <div class="form-label">Thông báo thảo luận</div>
                        <div class="form-value">
                            <label class="switch-container">
                                <input type="checkbox" name="notify_enabled" class="switch-input" value="1" <?php checked( $enabled, '1' ); ?>>
                                <div class="switch-slider"></div>
                                <span class="switch-text">Bật nhận thông báo khi có bình luận mới</span>
                            </label>
                            <p class="input-desc">Tự động gửi email thông báo chi tiết khi có bất cứ bình luận hoặc phản hồi thảo luận nào từ học viên trong workspace khóa học.</p>
                        </div>
                    </div>

                    <div style="height: 30px;"></div>

                    <div class="form-grid">
                        <div class="form-label">Email người nhận</div>
                        <div class="form-value">
                            <textarea name="notify_emails" class="textarea-input" placeholder="admin@domain.com&#10;manager@domain.com"><?php echo esc_textarea( $emails ); ?></textarea>
                            <p class="input-desc">Nhập danh sách địa chỉ email nhận thông báo (mỗi dòng một email hoặc ngăn cách nhau bằng dấu phẩy). Những email này sẽ nhận thư thông báo thời gian thực.</p>
                            
                            <div class="alert-info-box">
                                <strong>Lưu ý quan trọng:</strong> Hệ thống sẽ gửi thư trực tiếp đến các hòm thư này thay vì hòm thư cài đặt SMTP mặc định của WordPress. Vui lòng đảm bảo rằng plugin cấu hình SMTP của bạn đang hoạt động bình thường trên máy chủ để email không bị rơi vào thư rác.
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hieucon-admin-card">
                    <h2 class="hieucon-section-title">
                        <span class="dashicons dashicons-admin-tools" style="margin-top: 2px;"></span> Công cụ Kiểm thử (Live Testing)
                    </h2>
                    <p style="font-size: 13px; color: #475569; margin: 0 0 20px 0;">Sử dụng nút kiểm tra dưới đây để thực hiện gửi một email thử nghiệm ngay lập tức đến các hòm thư đã thiết lập ở trên nhằm kiểm tra tính tương thích và tốc độ nhận thư.</p>
                    
                    <div class="form-grid">
                        <div class="form-label">Hành động</div>
                        <div class="form-value">
                            <button type="button" onclick="hieuconSendTestEmail()" id="btn-send-test-email" class="premium-btn-secondary">
                                <span class="dashicons dashicons-paper-plane" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Gửi Email Thử Nghiệm
                            </button>
                            
                            <div id="test-result-message"></div>
                        </div>
                    </div>
                </div>

                <div style="text-align: right; padding-right: 10px;">
                    <button type="submit" class="premium-btn">
                        <span class="dashicons dashicons-saved" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Lưu cấu hình thay đổi
                    </button>
                </div>
            </form>
        </div>

        <script type="text/javascript">
            async function hieuconSendTestEmail() {
                const btn = document.getElementById('btn-send-test-email');
                const resultMsg = document.getElementById('test-result-message');
                const emailsTextarea = document.querySelector('textarea[name="notify_emails"]');
                
                if (!emailsTextarea.value.trim()) {
                    resultMsg.className = 'error';
                    resultMsg.textContent = 'Vui lòng điền ít nhất một Email người nhận trước khi kiểm tra.';
                    resultMsg.style.display = 'block';
                    return;
                }

                btn.disabled = true;
                btn.innerHTML = '<span class="spinner is-active" style="float:none; margin:0 5px 0 0; vertical-align:middle;"></span> Đang gửi thử nghiệm...';
                resultMsg.style.display = 'none';

                const formData = new FormData();
                formData.append('action', 'hieucon_elearning_send_test_email');
                formData.append('nonce', '<?php echo esc_attr( $ajax_nonce ); ?>');
                formData.append('emails', emailsTextarea.value);

                try {
                    const response = await fetch(ajaxurl, {
                        method: 'POST',
                        body: formData
                    });
                    const result = await response.json();
                    
                    if (result.success) {
                        resultMsg.className = 'success';
                        resultMsg.textContent = result.data.message;
                    } else {
                        resultMsg.className = 'error';
                        resultMsg.textContent = result.data.message || 'Gửi email thất bại.';
                    }
                } catch (error) {
                    resultMsg.className = 'error';
                    resultMsg.textContent = 'Lỗi kết nối đến máy chủ: ' + error.message;
                } finally {
                    resultMsg.style.display = 'block';
                    btn.disabled = false;
                    btn.innerHTML = '<span class="dashicons dashicons-paper-plane" style="font-size: 16px; width: 16px; height: 16px; margin-top: 2px;"></span> Gửi Email Thử Nghiệm';
                }
            }
        </script>
        <?php
    }
}

// C. AJAX Gửi Email thử nghiệm Backend Handler
if ( ! function_exists( 'hieucon_ajax_send_test_email' ) ) {
    function hieucon_ajax_send_test_email() {
        check_ajax_referer( 'hieucon_elearning_settings_nonce', 'nonce' );

        if ( ! current_user_can( 'manage_options' ) ) {
            wp_send_json_error( [ 'message' => 'Bạn không có quyền thực hiện hành động này.' ] );
        }

        $emails_str = isset( $_POST['emails'] ) ? trim( $_POST['emails'] ) : '';
        if ( empty( $emails_str ) ) {
            wp_send_json_error( [ 'message' => 'Vui lòng điền ít nhất một địa chỉ Email để kiểm tra.' ] );
        }

        $emails = array_map( 'sanitize_email', array_filter( array_map( 'trim', preg_split( '/[\r\n,]+/', $emails_str ) ) ) );
        if ( empty( $emails ) ) {
            wp_send_json_error( [ 'message' => 'Danh sách Email không hợp lệ.' ] );
        }

        $subject = '[Hieucon E-Learning] Thử nghiệm gửi Email thông báo';
        $message = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: sans-serif; background-color: #f6f9fc; margin:0; padding: 40px 0; color: #1e293b; }
                .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; padding: 40px 32px; text-align: center; }
                .header { color: #f97316; font-size: 24px; font-weight: 700; margin-bottom: 20px; }
                .btn { display: inline-block; background-color: #0f172a; color: #ffffff !important; font-weight: 700; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 13px; text-transform: uppercase; margin-top: 24px; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">GỬI EMAIL THÀNH CÔNG!</div>
                <p style="font-size: 16px; line-height: 1.6; text-align: left;">Xin chào Admin,</p>
                <p style="font-size: 15px; line-height: 1.6; color: #475569; text-align: left;">Đây là Email thử nghiệm được gửi từ trang cấu hình thông báo E-Learning của theme Hieucon. Nếu bạn nhận được thư này, điều đó có nghĩa là máy chủ email SMTP của bạn đã được cấu hình và hoạt động hoàn hảo!</p>
                <a href="' . esc_url( admin_url( 'edit.php?post_type=course&page=hieucon-elearning-settings' ) ) . '" class="btn">Quay lại trang quản trị</a>
            </div>
        </body>
        </html>
        ';

        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
        $sent = wp_mail( $emails, $subject, $message, $headers );

        if ( $sent ) {
            wp_send_json_success( [ 'message' => 'Email thử nghiệm đã được gửi thành công đến các hòm thư!' ] );
        } else {
            wp_send_json_error( [ 'message' => 'Không thể gửi email. Vui lòng kiểm tra lại cấu hình SMTP hoặc máy chủ mail của bạn.' ] );
        }
    }
    add_action( 'wp_ajax_hieucon_elearning_send_test_email', 'hieucon_ajax_send_test_email' );
}

// D. Hàm gửi thông báo khi có thảo luận bình luận mới
if ( ! function_exists( 'hieucon_elearning_send_comment_notification' ) ) {
    function hieucon_elearning_send_comment_notification( $comment_id ) {
        $enabled = get_option( 'hieucon_elearning_notify_enabled', '1' );
        if ( $enabled !== '1' ) {
            return;
        }

        $emails_str = get_option( 'hieucon_elearning_notify_emails', '' );
        if ( empty( $emails_str ) ) {
            return;
        }

        $emails = array_map( 'sanitize_email', array_filter( array_map( 'trim', preg_split( '/[\r\n,]+/', $emails_str ) ) ) );
        if ( empty( $emails ) ) {
            return;
        }

        $comment = get_comment( $comment_id );
        if ( ! $comment ) {
            return;
        }

        $post = get_post( $comment->comment_post_ID );
        if ( ! $post ) {
            return;
        }

        $course_title = 'Không xác định';
        if ( $post->post_type === 'lesson' ) {
            $belong_to_course_id = get_post_meta( $post->ID, '_belong_to_course', true );
            if ( $belong_to_course_id ) {
                $course_post = get_post( $belong_to_course_id );
                if ( $course_post ) {
                    $course_title = $course_post->post_title;
                }
            }
        } elseif ( $post->post_type === 'course' ) {
            $course_title = $post->post_title;
        }

        $lesson_title = $post->post_title;
        $lesson_url = get_permalink( $post->ID );

        // Tra cứu vai trò trong hieucon_members
        $user_role = 'Học viên (Guest)';
        if ( class_exists( '\Hieucon\Model\Member_Model' ) ) {
            $member = \Hieucon\Model\Member_Model::get_by_email( $comment->comment_author_email );
            if ( $member ) {
                if ( $member->role === 'expert' ) {
                    $user_role = 'Chuyên gia';
                } elseif ( $member->role === 'assistant' ) {
                    $user_role = 'Trợ lý';
                } elseif ( $member->role === 'administrator' ) {
                    $user_role = 'Quản trị viên';
                } elseif ( $member->role === 'teacher' ) {
                    $user_role = 'Giảng viên';
                } elseif ( $member->role === 'user' ) {
                    $user_role = 'Hội viên';
                }
            }
        }

        $subject = '[Hieucon E-Learning] Thảo luận mới từ học viên: ' . $comment->comment_author;
        
        $message = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="utf-8">
            <style>
                body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif; background-color: #f6f9fc; margin: 0; padding: 40px 0; color: #1e293b; }
                .container { max-width: 600px; margin: 0 auto; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #e2e8f0; }
                .header { background: linear-gradient(135deg, #0a1931 0%, #15305b 100%); padding: 32px 24px; text-align: center; color: #ffffff; }
                .header h2 { margin: 0; font-size: 20px; font-weight: 700; letter-spacing: 0.5px; color: #ffffff; }
                .header p { margin: 8px 0 0 0; font-size: 13px; color: rgba(255,255,255,0.7); }
                .content { padding: 32px 24px; }
                .meta-box { background-color: #f8fafc; border-radius: 12px; padding: 20px; border: 1px solid #e2e8f0; margin-bottom: 24px; }
                .meta-item { display: flex; margin-bottom: 12px; font-size: 14px; }
                .meta-item:last-child { margin-bottom: 0; }
                .meta-label { width: 120px; font-weight: 700; color: #64748b; text-transform: uppercase; font-size: 11px; letter-spacing: 0.5px; padding-top: 2px; }
                .meta-value { flex: 1; font-weight: 500; color: #0f172a; }
                .meta-value a { color: #f97316; text-decoration: none; font-weight: 600; }
                .comment-box { border-left: 4px solid #f97316; background-color: #fffaf0; padding: 16px 20px; border-radius: 4px 12px 12px 4px; margin-bottom: 32px; font-size: 15px; line-height: 1.6; color: #334155; font-style: italic; }
                .footer { padding: 24px; text-align: center; background-color: #f8fafc; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b; }
                .btn { display: inline-block; background-color: #0a1931; color: #ffffff !important; font-weight: 700; padding: 12px 24px; border-radius: 8px; text-decoration: none; font-size: 13px; text-transform: uppercase; letter-spacing: 0.5px; margin-top: 8px; box-shadow: 0 4px 6px rgba(10,25,49,0.1); }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>THẢO LUẬN MỚI TRÊN HỆ THỐNG</h2>
                    <p>Học viên vừa gửi ý kiến phản hồi trong khóa học</p>
                </div>
                <div class="content">
                    <div class="meta-box">
                        <div class="meta-item">
                            <div class="meta-label">Khóa học:</div>
                            <div class="meta-value">' . esc_html( $course_title ) . '</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Bài học:</div>
                            <div class="meta-value"><a href="' . esc_url( $lesson_url ) . '">' . esc_html( $lesson_title ) . '</a></div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Học viên:</div>
                            <div class="meta-value">' . esc_html( $comment->comment_author ) . ' (' . esc_html( $comment->comment_author_email ) . ')</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Vai trò:</div>
                            <div class="meta-value">' . esc_html( $user_role ) . '</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Thời gian:</div>
                            <div class="meta-value">' . esc_html( $comment->comment_date ) . '</div>
                        </div>
                    </div>
                    
                    <h3 style="font-size: 14px; text-transform: uppercase; color: #64748b; margin-bottom: 12px; font-weight: 700;">Nội dung thảo luận:</h3>
                    <div class="comment-box">
                        ' . nl2br( esc_html( $comment->comment_content ) ) . '
                    </div>
                    
                    <div style="text-align: center;">
                        <a href="' . esc_url( $lesson_url ) . '" class="btn">Xem chi tiết & Phản hồi</a>
                    </div>
                </div>
                <div class="footer">
                    Hệ thống thông báo E-Learning Hieucon &copy; ' . date('Y') . '. Mọi quyền được bảo lưu.
                </div>
            </div>
        </body>
        </html>
        ';

        $headers = [ 'Content-Type: text/html; charset=UTF-8' ];
        wp_mail( $emails, $subject, $message, $headers );
    }
}

/**
 * 7. TRÌNH THEO DÕI TIẾN ĐỘ HỌC TẬP CỦA HỘC VIÊN (PROGRESS TRACKING HELPERS)
 */

// A. Đọc mảng tiến độ
if ( ! function_exists( 'hieucon_get_member_lesson_progress' ) ) {
    function hieucon_get_member_lesson_progress( $member_id ) {
        $progress = get_option( "hieucon_lesson_progress_{$member_id}", [] );
        return is_array( $progress ) ? $progress : [];
    }
}

// B. Lưu tiến độ bài học (chỉ tăng tiến độ lên)
if ( ! function_exists( 'hieucon_save_member_lesson_progress' ) ) {
    function hieucon_save_member_lesson_progress( $member_id, $lesson_id, $percent ) {
        $percent = min( 100, max( 0, intval( $percent ) ) );
        $progress = hieucon_get_member_lesson_progress( $member_id );
        
        $existing = isset( $progress[ $lesson_id ] ) ? intval( $progress[ $lesson_id ] ) : 0;
        
        if ( $percent > $existing ) {
            $progress[ $lesson_id ] = $percent;
            update_option( "hieucon_lesson_progress_{$member_id}", $progress );
            return true;
        }
        
        return false;
    }
}

// C. AJAX xử lý cập nhật lưu tiến độ bài học
if ( ! function_exists( 'hieucon_ajax_save_lesson_progress' ) ) {
    function hieucon_ajax_save_lesson_progress() {
        check_ajax_referer( 'hieucon_like_nonce', 'nonce' );

        if ( ! class_exists( '\Hieucon\Model\Member_Model' ) ) {
            wp_send_json_error( [ 'message' => 'Lớp quản lý tài khoản không khả dụng.' ] );
        }

        $current_member = \Hieucon\Model\Member_Model::get_current_member();
        
        $member_id = 0;
        if ( $current_member ) {
            $member_id = intval( $current_member->id );
        } elseif ( current_user_can( 'manage_options' ) ) {
            $member_id = 0; // Admin mock progress
        } else {
            wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập để lưu tiến độ.' ] );
        }

        $lesson_id = isset( $_POST['lesson_id'] ) ? intval( $_POST['lesson_id'] ) : 0;
        $percent   = isset( $_POST['percent'] ) ? intval( $_POST['percent'] ) : 0;

        if ( ! $lesson_id || ! get_post( $lesson_id ) ) {
            wp_send_json_error( [ 'message' => 'Bài học không hợp lệ.' ] );
        }

        $updated = hieucon_save_member_lesson_progress( $member_id, $lesson_id, $percent );

        wp_send_json_success( [
            'message' => 'Cập nhật tiến độ thành công.',
            'updated' => $updated,
            'percent' => $percent
        ] );
    }
    add_action( 'wp_ajax_hieucon_save_lesson_progress', 'hieucon_ajax_save_lesson_progress' );
    add_action( 'wp_ajax_nopriv_hieucon_save_lesson_progress', 'hieucon_ajax_save_lesson_progress' );
}
