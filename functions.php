<?php
/**
 * Hieucon functions and definitions
 *
 * @package Hieucon
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

define('HIEUCON_THEME_DIR', get_template_directory());
define('HIEUCON_THEME_URI', get_template_directory_uri());
define('HIEUCON_THEME_VERSION', '1.0.0');

// Autoloader tự động nạp (include) các file Controllers và Models theo chuẩn PSR-4 thu nhỏ
spl_autoload_register(function ($class) {
    $prefix = 'Hieucon\\';
    $base_dir = HIEUCON_THEME_DIR . '/app/';

    // Chỉ áp dụng cho class thuộc namespace Hieucon
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }

    $relative_class = substr($class, $len);
    $path = explode('\\', strtolower($relative_class));

    // Tách models hoặc controllers
    $type = array_shift($path); // 'model' hoặc 'controller'
    $file_name = 'class-' . str_replace('_', '-', implode('-', $path)) . '.php';

    $file = $base_dir . $type . 's/' . $file_name;

    if (file_exists($file)) {
        require $file;
    }
});

// Include các tệp cấu hình (Config) 
require_once HIEUCON_THEME_DIR . '/app/config/setup.php';
require_once HIEUCON_THEME_DIR . '/app/config/tracking.php';
require_once HIEUCON_THEME_DIR . '/app/config/theme-options.php';
require_once HIEUCON_THEME_DIR . '/app/config/theme-settings.php';
require_once HIEUCON_THEME_DIR . '/app/config/payment-settings.php';
require_once HIEUCON_THEME_DIR . '/app/config/checklist-admin.php';
require_once HIEUCON_THEME_DIR . '/app/config/checklist-dh-admin.php';
require_once HIEUCON_THEME_DIR . '/app/config/page-generator.php';
require_once HIEUCON_THEME_DIR . '/app/config/html-page.php';
require_once HIEUCON_THEME_DIR . '/app/config/db-setup.php';
require_once HIEUCON_THEME_DIR . '/app/config/smtp-config.php';
require_once HIEUCON_THEME_DIR . '/app/config/member-admin.php';
require_once HIEUCON_THEME_DIR . '/app/config/course-cpt.php';
require_once HIEUCON_THEME_DIR . '/app/config/course-admin.php';
require_once HIEUCON_THEME_DIR . '/app/config/elearning-settings.php';
require_once HIEUCON_THEME_DIR . '/app/config/ebook-settings.php';
require_once HIEUCON_THEME_DIR . '/app/config/promo-campaign.php';
require_once HIEUCON_THEME_DIR . '/app/config/referral-codes.php';


// Khởi chạy các Controller xác thực & tài khoản cho hệ thống hội viên
add_action( 'init', function() {
    \Hieucon\Controller\Auth_Controller::init();
    \Hieucon\Controller\Account_Controller::init();
} );

// Add Pancake Livechat script to all pages
function hieucon_add_pancake_livechat()
{
    ?>
    <style>
        /* Chống tràn màn hình điện thoại cho Box Chat Pancake */
        @media (max-width: 768px) {

            iframe[id^="pancake-chat-plugin"],
            div[id^="pancake-"] iframe,
            iframe[src*="chat-plugin.pancake.vn"] {
                max-height: 65vh !important;
                /* Giới hạn chiều cao 65% màn hình */
                max-width: 85vw !important;
                /* Giới hạn chiều ngang 85% */
                bottom: 15px !important;
                /* Cách đáy màn hình */
                right: 15px !important;
                /* Cách lề phải */
                left: auto !important;
                top: auto !important;
                border-radius: 16px !important;
                box-shadow: 0 5px 25px rgba(0, 0, 0, 0.2) !important;
                margin: 0 !important;
            }

            /* Ngăn div bao ngoài của plugin tràn full 100% nếu có */
            div[id^="pancake-chat-plugin"] {
                max-height: 65vh !important;
                max-width: 85vw !important;
                bottom: 15px !important;
                right: 15px !important;
                left: auto !important;
                top: auto !important;
                background: transparent !important;
            }
        }
    </style>
    <script src="https://chat-plugin.pancake.vn/main/auto?page_id=web_hieucontugoc"></script>
    <?php
}
// add_action('wp_footer', 'hieucon_add_pancake_livechat', 999);

/**
 * Output Open Graph meta tags for social sharing (Facebook, Zalo, Telegram...)
 * Automatically picks up the page's Featured Image, title, and excerpt.
 */
function hieucon_og_meta_tags()
{
    if (!is_singular())
        return;

    global $post;
    setup_postdata($post);

    // --- Title ---
    $title = get_the_title($post);

    // --- Description: excerpt hoặc trimmed content ---
    $description = '';
    if (!empty($post->post_excerpt)) {
        $description = wp_strip_all_tags($post->post_excerpt);
    } else {
        $description = wp_trim_words(wp_strip_all_tags($post->post_content), 30, '...');
    }

    // --- Image: featured image → fallback logo site ---
    $image_url = '';
    if (has_post_thumbnail($post)) {
        $image_url = get_the_post_thumbnail_url($post, 'large');
    } else {
        // Fallback: custom_logo hoặc site icon
        $custom_logo_id = get_theme_mod('custom_logo');
        if ($custom_logo_id) {
            $logo_data = wp_get_attachment_image_src($custom_logo_id, 'full');
            if ($logo_data)
                $image_url = $logo_data[0];
        }
        if (!$image_url) {
            $image_url = get_site_icon_url(512);
        }
    }

    // --- URL ---
    $url = get_permalink($post);

    // --- Site name ---
    $site_name = get_bloginfo('name');

    // Output
    echo "\n<!-- Open Graph / Social Sharing -->\n";
    echo '<meta property="og:type"        content="article" />' . "\n";
    echo '<meta property="og:site_name"   content="' . esc_attr($site_name) . '" />' . "\n";
    echo '<meta property="og:url"         content="' . esc_url($url) . '" />' . "\n";
    echo '<meta property="og:title"       content="' . esc_attr($title) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
    if ($image_url) {
        echo '<meta property="og:image"       content="' . esc_url($image_url) . '" />' . "\n";
        echo '<meta property="og:image:width"  content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
    }
    // Twitter Card
    echo '<meta name="twitter:card"        content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title"       content="' . esc_attr($title) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";
    if ($image_url) {
        echo '<meta name="twitter:image"   content="' . esc_url($image_url) . '" />' . "\n";
    }
    echo "<!-- / Open Graph -->\n";
}
add_action('wp_head', 'hieucon_og_meta_tags', 1);


/**
 * ------------------------------------------------------------------------
 * E-LEARNING WORKSPACE: REALTIME THREADED AJAX DISCUSSION SYSTEM
 * ------------------------------------------------------------------------
 */

// Helper to render comments recursively
function hieucon_render_comments_tree( $parent_id, $comments_by_parent, $depth = 0 ) {
    if ( ! isset( $comments_by_parent[ $parent_id ] ) ) {
        return;
    }

    // Get current logged in member for like verification
    $current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
    $member_id      = 0;
    if ( $current_member ) {
        $member_id = intval( $current_member->id );
    } elseif ( is_user_logged_in() ) {
        $member_id = -intval( get_current_user_id() );
    }

    $item_index = 0;
    foreach ( $comments_by_parent[ $parent_id ] as $comment ) {
        $comment_id = intval( $comment->comment_ID );
        $email      = $comment->comment_author_email;
        $author_name = $comment->comment_author;
        $role_badge = '';
        $found_in_hieucon = false;
        $member_role = 'member';

        // 1. Check in Hieucon Members database first
        if ( class_exists( '\Hieucon\Model\Member_Model' ) ) {
            global $wpdb;
            $table = $wpdb->prefix . 'hieucon_members';
            $member = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM $table WHERE email = %s LIMIT 1", $email ) );
            if ( $member ) {
                $found_in_hieucon = true;
                $author_name = $member->full_name;
                $member_role = $member->role;
                if ( $member->role === 'expert' ) {
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-emerald-500/15 text-emerald-600 border border-emerald-500/30 shadow-[0_0_12px_rgba(16,185,129,0.15)] text-[8px] font-bold uppercase tracking-wider shrink-0">Chuyên gia</span>';
                } elseif ( $member->role === 'assistant' ) {
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-sky-500/15 text-sky-600 border border-sky-500/30 shadow-[0_0_12px_rgba(14,165,233,0.15)] text-[8px] font-bold uppercase tracking-wider shrink-0">Trợ lý</span>';
                } else {
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-teal-500/15 text-teal-600 border border-teal-500/30 shadow-[0_0_12px_rgba(20,184,166,0.15)] text-[8px] font-bold uppercase tracking-wider shrink-0">Hội viên</span>';
                }
            }
        }

        // 2. Fall back to standard WordPress Users
        if ( ! $found_in_hieucon ) {
            $wp_user = get_user_by( 'email', $email );
            if ( $wp_user ) {
                $author_name = $wp_user->display_name;
                if ( in_array( 'administrator', $wp_user->roles ) ) {
                    $member_role = 'administrator';
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-red-500/15 text-red-650 border border-red-500/30 shadow-[0_0_12px_rgba(239,68,68,0.15)] text-[8px] font-bold uppercase tracking-wider shrink-0">Quản trị viên</span>';
                } elseif ( array_intersect( [ 'teacher', 'expert', 'assistant', 'editor' ], $wp_user->roles ) ) {
                    $member_role = 'teacher';
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-orange-500/15 text-orange-600 border border-orange-500/30 shadow-[0_0_12px_rgba(249,115,22,0.15)] text-[8px] font-bold uppercase tracking-wider shrink-0">Giảng viên</span>';
                } else {
                    $role_badge = '<span class="ml-1.5 px-1.5 py-0.5 rounded-full bg-slate-500/15 text-slate-550 border border-slate-500/30 text-[8px] font-bold uppercase tracking-wider shrink-0">Học viên</span>';
                }
            }
        }

        // Determine avatar background gradient and shadow inline in PHP - 100% solid browser compatibility
        $avatar_style = 'background: linear-gradient(135deg, #64748b 0%, #475569 100%); color: white; box-shadow: 0 4px 10px rgba(100, 116, 139, 0.15); border: none;';
        if ( $member_role === 'administrator' ) {
            $avatar_style = 'background: linear-gradient(135deg, #ef4444 0%, #ea580c 100%); color: white; box-shadow: 0 4px 10px rgba(239, 68, 68, 0.25); border: none;';
        } elseif ( $member_role === 'expert' ) {
            $avatar_style = 'background: linear-gradient(135deg, #10b981 0%, #059669 100%); color: white; box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25); border: none;';
        } elseif ( $member_role === 'assistant' ) {
            $avatar_style = 'background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%); color: white; box-shadow: 0 4px 10px rgba(14, 165, 233, 0.25); border: none;';
        } elseif ( $member_role === 'teacher' ) {
            $avatar_style = 'background: linear-gradient(135deg, #f97316 0%, #ea580c 100%); color: white; box-shadow: 0 4px 10px rgba(249, 115, 22, 0.25); border: none;';
        } elseif ( $member_role === 'member' || $found_in_hieucon ) {
            $avatar_style = 'background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%); color: white; box-shadow: 0 4px 10px rgba(20, 184, 166, 0.25); border: none;';
        }

        // Fetch likes for this comment
        $comment_liked_by = get_comment_meta( $comment_id, '_liked_by_users', true );
        if ( ! is_array( $comment_liked_by ) ) {
            $comment_liked_by = [];
        }
        $is_liked   = in_array( $member_id, $comment_liked_by );
        $like_count = count( $comment_liked_by );

        // Initials avatar
        $initial = mb_substr( esc_html( $author_name ), 0, 1, 'utf-8' );
        $indent_class = $depth > 0 ? 'ml-8 thread-line pl-4.5 mt-2.5 relative' : '';
        
        $node_attrs = '';
        if ( $depth === 0 ) {
            $node_attrs = 'data-top-index="' . $item_index . '"';
        } else {
            $node_attrs = 'data-reply-index="' . $item_index . '"';
        }
        ?>
        <div class="comment-node group/comment comment-role-<?php echo esc_attr( $member_role ); ?> relative <?php echo $indent_class; ?>" data-id="<?php echo $comment_id; ?>" <?php echo $node_attrs; ?>>
            <div class="flex items-start gap-2.5 relative z-10">
                <!-- Avatar -->
                <div class="w-7 h-7 rounded-full flex items-center justify-center font-bold uppercase shrink-0 text-[10px] shadow-sm select-none" style="<?php echo esc_attr( $avatar_style ); ?>">
                    <?php echo $initial; ?>
                </div>

                <!-- Content Column -->
                <div class="flex-1 min-w-0">
                    <!-- Comment Bubble -->
                    <div class="inline-block comment-bubble-glass px-4 py-2.5 rounded-2xl max-w-full">
                        <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                            <span class="text-xs font-extrabold text-[#0A1931]"><?php echo esc_html( $author_name ); ?></span>
                            <?php echo $role_badge; ?>
                        </div>
                        <div class="text-[12px] md:text-xs text-slate-700 leading-relaxed break-words font-semibold">
                            <?php echo nl2br( wp_strip_all_tags( $comment->comment_content ) ); ?>
                        </div>
                    </div>

                    <!-- Actions Row Below Bubble -->
                    <div class="flex items-center gap-3.5 mt-1 ml-1 select-none">
                        <!-- Time -->
                        <span class="text-[9px] text-slate-500 font-semibold" title="<?php echo esc_attr( $comment->comment_date ); ?>">
                            <?php echo esc_html( date_i18n( 'H:i', strtotime( $comment->comment_date ) ) ); ?>
                        </span>

                        <!-- Comment Like Button -->
                        <button type="button" onclick="handleCommentLike(<?php echo $comment_id; ?>)" id="comment-like-btn-<?php echo $comment_id; ?>" class="text-[10px] font-bold transition-colors flex items-center gap-1 <?php echo $is_liked ? 'text-red-500' : 'text-slate-500 hover:text-red-400'; ?> bg-transparent border-0 cursor-pointer p-0">
                            <i data-lucide="heart" class="w-3 h-3 <?php echo $is_liked ? 'fill-red-500 text-red-500' : ''; ?>"></i> 
                            Thích <?php if ( $like_count > 0 ) : ?><span id="comment-like-count-<?php echo $comment_id; ?>" class="bg-red-50 px-1.5 py-0.5 rounded text-red-500 font-bold ml-0.5 border border-red-200/50"><?php echo esc_html( $like_count ); ?></span><?php endif; ?>
                        </button>

                        <!-- Reply Trigger -->
                        <button type="button" onclick="showReplyForm(<?php echo $comment_id; ?>)" class="text-[10px] font-bold text-slate-500 hover:text-primary transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0">
                            <i data-lucide="reply" class="w-3 h-3"></i> Phản hồi
                        </button>
                    </div>
                </div>
            </div>

            <!-- Dynamic Reply Form Container -->
            <div id="reply-form-wrap-<?php echo $comment_id; ?>" class="hidden mt-2 relative z-20 ml-10"></div>

            <!-- Child Comments Render -->
            <?php if ( isset( $comments_by_parent[ $comment_id ] ) ) : ?>
                <?php if ( $depth === 0 ) : ?>
                    <!-- Collapsed by default for top-level comments -->
                    <div id="replies-container-<?php echo $comment_id; ?>" class="replies-container mt-2 space-y-2 hidden">
                        <?php hieucon_render_comments_tree( $comment_id, $comments_by_parent, $depth + 1 ); ?>
                    </div>
                    <div class="reply-toggle-wrap mt-2 ml-10" id="reply-toggle-wrap-<?php echo $comment_id; ?>">
                        <button type="button" onclick="toggleReplies(<?php echo $comment_id; ?>)" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0">
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5"></i> Xem <?php echo count( $comments_by_parent[ $comment_id ] ); ?> câu trả lời
                        </button>
                    </div>
                <?php else : ?>
                    <!-- Direct show for second+ levels -->
                    <div class="replies-container mt-2 space-y-2">
                        <?php hieucon_render_comments_tree( $comment_id, $comments_by_parent, $depth + 1 ); ?>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php
        $item_index++;
    }
}

// 1. AJAX Action: Fetch comments list HTML
add_action( 'wp_ajax_hieucon_fetch_comments', 'hieucon_ajax_fetch_comments' );
add_action( 'wp_ajax_nopriv_hieucon_fetch_comments', 'hieucon_ajax_fetch_comments' );

function hieucon_ajax_fetch_comments() {
    $post_id = isset( $_GET['post_id'] ) ? intval( $_GET['post_id'] ) : 0;
    if ( ! $post_id ) {
        wp_send_json_error( [ 'message' => 'Bài học không hợp lệ.' ] );
    }

    $comments = get_comments( [
        'post_id'       => $post_id,
        'status'        => 'approve',
        'order'         => 'ASC',
        'cache_results' => false, // Bypass comment object caching for instant real-time updates
    ] );

    $comments_by_parent = [];

    foreach ( $comments as $comment ) {
        $parent = intval( $comment->comment_parent );
        $comments_by_parent[ $parent ][] = $comment;
    }

    ob_start();
    if ( ! empty( $comments_by_parent[0] ) ) {
        hieucon_render_comments_tree( 0, $comments_by_parent, 0 );
    } else {
        ?>
        <div class="text-center py-12 text-slate-650 text-xs">
            <i data-lucide="messages-square" class="w-10 h-10 mx-auto mb-3 text-slate-800"></i>
            Chưa có cuộc thảo luận nào. Hãy bắt đầu câu hỏi đầu tiên!
        </div>
        <?php
    }
    $html = ob_get_clean();

    wp_send_json_success( [ 'html' => $html ] );
}

// 2. AJAX Action: Submit a comment or reply
add_action( 'wp_ajax_hieucon_submit_comment', 'hieucon_ajax_submit_comment' );
add_action( 'wp_ajax_nopriv_hieucon_submit_comment', 'hieucon_ajax_submit_comment' );

function hieucon_ajax_submit_comment() {
    check_ajax_referer( 'hieucon_comment_nonce', 'nonce' );

    $current_member = false;
    if ( class_exists( '\Hieucon\Model\Member_Model' ) ) {
        $current_member = \Hieucon\Model\Member_Model::get_current_member();
    }

    $author_name = '';
    $author_email = '';

    if ( $current_member ) {
        $author_name = $current_member->full_name;
        $author_email = $current_member->email;
    } elseif ( is_user_logged_in() ) {
        $wp_user = wp_get_current_user();
        $author_name = $wp_user->display_name;
        $author_email = $wp_user->user_email;
    } else {
        wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập để gửi thảo luận.' ] );
    }

    $post_id        = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    $comment_parent = isset( $_POST['comment_parent'] ) ? intval( $_POST['comment_parent'] ) : 0;
    $content        = isset( $_POST['content'] ) ? trim( $_POST['content'] ) : '';

    if ( empty( $content ) ) {
        wp_send_json_error( [ 'message' => 'Nội dung thảo luận không được để trống.' ] );
    }

    if ( ! $post_id || ! get_post( $post_id ) ) {
        wp_send_json_error( [ 'message' => 'Bài học không hợp lệ.' ] );
    }

    $commentdata = [
        'comment_post_ID'      => $post_id,
        'comment_author'       => $author_name,
        'comment_author_email' => $author_email,
        'comment_content'      => esc_html( $content ),
        'comment_parent'       => $comment_parent,
        'user_id'              => 0, // Keep Hieucon comments decoupled from WP backend users to prevent admin role contamination
        'comment_approved'     => 1, // Auto approve course discussion comments
        'comment_type'         => 'comment',
    ];

    $comment_id = wp_insert_comment( $commentdata );

    if ( $comment_id ) {
        // Send email notifications to administrators configured in E-Learning Email settings
        if ( function_exists( 'hieucon_elearning_send_comment_notification' ) ) {
            hieucon_elearning_send_comment_notification( $comment_id );
        }
        wp_send_json_success( [ 'message' => 'Gửi thảo luận thành công!', 'comment_id' => $comment_id ] );
    } else {
        wp_send_json_error( [ 'message' => 'Có lỗi xảy ra khi lưu bình luận. Vui lòng thử lại.' ] );
    }
}

// 3. AJAX Action: Like a comment
add_action( 'wp_ajax_hieucon_like_comment', 'hieucon_ajax_like_comment' );
add_action( 'wp_ajax_nopriv_hieucon_like_comment', 'hieucon_ajax_like_comment' );

function hieucon_ajax_like_comment() {
    check_ajax_referer( 'hieucon_comment_nonce', 'nonce' );

    $current_member = false;
    if ( class_exists( '\Hieucon\Model\Member_Model' ) ) {
        $current_member = \Hieucon\Model\Member_Model::get_current_member();
    }

    $member_id = 0;

    if ( $current_member ) {
        $member_id = intval( $current_member->id );
    } elseif ( is_user_logged_in() ) {
        $member_id = -intval( get_current_user_id() );
    } else {
        wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập để thích bình luận.' ] );
    }

    $comment_id = isset( $_POST['comment_id'] ) ? intval( $_POST['comment_id'] ) : 0;

    if ( ! $comment_id || ! get_comment( $comment_id ) ) {
        wp_send_json_error( [ 'message' => 'Bình luận không hợp lệ.' ] );
    }

    $liked_by = get_comment_meta( $comment_id, '_liked_by_users', true );
    if ( ! is_array( $liked_by ) ) {
        $liked_by = [];
    }

    if ( in_array( $member_id, $liked_by ) ) {
        $liked_by = array_diff( $liked_by, [ $member_id ] );
        $status   = 'unliked';
    } else {
        $liked_by[] = $member_id;
        $status     = 'liked';
    }

    $liked_by = array_values( $liked_by );
    update_comment_meta( $comment_id, '_liked_by_users', $liked_by );
    $total_likes = count( $liked_by );

    wp_send_json_success( [
        'status'      => $status,
        'total_likes' => $total_likes
    ] );
}

/**
 * Securely fetches a member's enrolled courses with auto-migration from old usermeta storage
 */
function hieucon_get_member_enrolled_courses( $member_id ) {
    $member_id = intval( $member_id );
    if ( ! $member_id ) {
        return [];
    }

    $enrolled = get_option( "hieucon_enrolled_courses_{$member_id}", null );
    $old_enrolled = get_user_meta( $member_id, '_enrolled_courses', true );

    if ( is_array( $old_enrolled ) && ! empty( $old_enrolled ) ) {
        if ( ! is_array( $enrolled ) ) {
            $enrolled = [];
        }
        // Merge both arrays to preserve both old and new enrollments, ensuring no duplicates
        $merged = array_unique( array_merge( $enrolled, $old_enrolled ) );
        
        // Atomically update the option if it changed
        if ( $enrolled !== $merged ) {
            update_option( "hieucon_enrolled_courses_{$member_id}", $merged );
            $enrolled = $merged;
        }
    } else {
        if ( ! is_array( $enrolled ) ) {
            $enrolled = [];
        }
    }

    return $enrolled;
}

/**
 * Updates a member's complete enrolled courses list (Admin use)
 * Replaces the entire enrollment with the provided array of course IDs.
 *
 * @param int   $member_id  The Hieucon member ID.
 * @param array $course_ids Array of course IDs (integers) to enroll.
 */
function hieucon_update_member_enrolled_courses( $member_id, $course_ids ) {
    $member_id  = intval( $member_id );
    $course_ids = array_values( array_filter( array_map( 'intval', (array) $course_ids ) ) );

    if ( ! $member_id ) {
        return;
    }

    update_option( "hieucon_enrolled_courses_{$member_id}", $course_ids, false );
}

/**
 * ------------------------------------------------------------------------
 * REFERRAL CODES REDEMPTION & ACCESS LOGIC
 * ------------------------------------------------------------------------
 */

function hieucon_member_has_unlocked_all( $member_id ) {
    return (int) get_option( "hieucon_member_unlocked_all_" . intval( $member_id ), 0 ) === 1;
}

add_action( 'wp_ajax_hieucon_apply_referral_code', 'hieucon_ajax_apply_referral_code' );
function hieucon_ajax_apply_referral_code() {
    check_ajax_referer( 'hieucon_ref_nonce', 'nonce' );

    $current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
    if ( ! $current_member ) {
        wp_send_json_error( [ 'message' => 'Vui lòng đăng nhập trước khi áp dụng mã.' ] );
    }
    $member_id = intval( $current_member->id );

    $code      = isset( $_POST['code'] ) ? strtoupper( sanitize_text_field( trim( $_POST['code'] ) ) ) : '';
    $post_id   = isset( $_POST['post_id'] ) ? intval( $_POST['post_id'] ) : 0;
    $post_type = isset( $_POST['post_type'] ) ? sanitize_key( $_POST['post_type'] ) : '';

    if ( empty( $code ) ) {
        wp_send_json_error( [ 'message' => 'Thông tin không hợp lệ.' ] );
    }

    global $wpdb;
    $ref_post_id = $wpdb->get_var( $wpdb->prepare(
        "SELECT ID FROM $wpdb->posts WHERE post_title = %s AND post_type = 'referral_code' AND post_status = 'publish' LIMIT 1",
        $code
    ) );

    if ( ! $ref_post_id ) {
        wp_send_json_error( [ 'message' => 'Mã giới thiệu không hợp lệ hoặc không tồn tại.' ] );
    }

    $active = get_post_meta( $ref_post_id, '_ref_active', true );
    if ( $active !== 'yes' ) {
        wp_send_json_error( [ 'message' => 'Mã giới thiệu này đã tạm ngưng hoạt động.' ] );
    }

    $limit   = get_post_meta( $ref_post_id, '_ref_usage_limit', true );
    $used_by = get_post_meta( $ref_post_id, '_ref_used_by_members', true );
    if ( ! is_array( $used_by ) ) {
        $used_by = [];
    }

    if ( $limit !== '' && ! is_null( $limit ) && count( $used_by ) >= intval( $limit ) ) {
        wp_send_json_error( [ 'message' => 'Mã giới thiệu này đã đạt giới hạn số lần sử dụng.' ] );
    }

    if ( in_array( $member_id, $used_by ) ) {
        wp_send_json_error( [ 'message' => 'Bạn đã sử dụng mã giới thiệu này rồi.' ] );
    }

    $type = get_post_meta( $ref_post_id, '_ref_type', true );

    if ( $type === 'free_all' ) {
        update_option( "hieucon_member_unlocked_all_{$member_id}", 1, false );

        $used_by[] = $member_id;
        update_post_meta( $ref_post_id, '_ref_used_by_members', $used_by );

        wp_send_json_success( [ 
            'message' => 'Kích hoạt thành công! Đã mở khóa miễn phí toàn bộ thư viện học liệu.',
            'action' => 'reload'
        ] );
    }

    // Nếu không truyền post_id (đăng ký từ trang tài khoản) thì xử lý/trả về thông báo hợp lệ
    if ( ! $post_id ) {
        if ( $type === 'free_items' ) {
            // Tự động thêm các khoá học/ebook miễn phí trong danh sách áp dụng vào tài khoản của hội viên
            $applied_courses = get_post_meta( $ref_post_id, '_ref_applied_courses', true );
            $applied_ebooks  = get_post_meta( $ref_post_id, '_ref_applied_ebooks', true );
            if ( ! is_array( $applied_courses ) ) $applied_courses = [];
            if ( ! is_array( $applied_ebooks ) ) $applied_ebooks = [];

            if ( ! empty( $applied_courses ) ) {
                $enrolled_courses = hieucon_get_member_enrolled_courses( $member_id );
                $enrolled_courses = array_unique( array_merge( $enrolled_courses, $applied_courses ) );
                hieucon_update_member_enrolled_courses( $member_id, $enrolled_courses );
            }
            if ( ! empty( $applied_ebooks ) ) {
                $enrolled_ebooks = hieucon_get_member_enrolled_ebooks( $member_id );
                $enrolled_ebooks = array_unique( array_merge( $enrolled_ebooks, $applied_ebooks ) );
                hieucon_update_member_enrolled_ebooks( $member_id, $enrolled_ebooks );
            }

            $used_by[] = $member_id;
            update_post_meta( $ref_post_id, '_ref_used_by_members', $used_by );

            wp_send_json_success( [
                'message' => 'Kích hoạt thành công! Đã tự động thêm các tài liệu được áp dụng vào tài khoản của bạn.',
                'action' => 'reload'
            ] );
        } elseif ( $type === 'discount_percent' || $type === 'discount_fixed' ) {
            wp_send_json_success( [
                'message' => 'Mã giảm giá hợp lệ! Hãy truy cập tài liệu bạn muốn mua trong Thư viện để áp dụng mã giảm giá này.',
                'action' => 'message'
            ] );
        }
    }

    // Kiểm tra tính hợp lệ của học liệu áp dụng (nếu giới hạn)
    $applied_courses = get_post_meta( $ref_post_id, '_ref_applied_courses', true );
    $applied_ebooks  = get_post_meta( $ref_post_id, '_ref_applied_ebooks', true );
    if ( ! is_array( $applied_courses ) ) $applied_courses = [];
    if ( ! is_array( $applied_ebooks ) ) $applied_ebooks = [];

    $is_restricted = ( ! empty( $applied_courses ) || ! empty( $applied_ebooks ) );
    $is_eligible = true;

    if ( $is_restricted ) {
        if ( $post_type === 'course' ) {
            $is_eligible = in_array( $post_id, $applied_courses );
        } elseif ( $post_type === 'ebook' ) {
            $is_eligible = in_array( $post_id, $applied_ebooks );
        } else {
            $is_eligible = false;
        }
    }

    if ( ! $is_eligible ) {
        wp_send_json_error( [ 'message' => 'Mã giới thiệu này không áp dụng cho học liệu hiện tại.' ] );
    }

    if ( $type === 'free_items' ) {
        if ( $post_type === 'course' ) {
            $enrolled = hieucon_get_member_enrolled_courses( $member_id );
            if ( ! in_array( $post_id, $enrolled ) ) {
                $enrolled[] = $post_id;
                hieucon_update_member_enrolled_courses( $member_id, $enrolled );
            }
        } elseif ( $post_type === 'ebook' ) {
            $enrolled = hieucon_get_member_enrolled_ebooks( $member_id );
            if ( ! in_array( $post_id, $enrolled ) ) {
                $enrolled[] = $post_id;
                hieucon_update_member_enrolled_ebooks( $member_id, $enrolled );
            }
        }

        $used_by[] = $member_id;
        update_post_meta( $ref_post_id, '_ref_used_by_members', $used_by );

        wp_send_json_success( [
            'message' => 'Kích hoạt thành công! Học liệu này đã được mở khóa miễn phí cho bạn.',
            'action' => 'reload'
        ] );
    }

    if ( $type === 'discount_percent' || $type === 'discount_fixed' ) {
        // Trả về link chuyển khoản giảm giá
        $checkout_url = home_url( '/thanh-toan/?' . ( $post_type === 'ebook' ? 'ebook_id' : 'course_id' ) . '=' . $post_id . '&ref_code=' . urlencode( $code ) );
        wp_send_json_success( [
            'message' => 'Mã giảm giá hợp lệ! Đang chuyển hướng bạn tới trang thanh toán...',
            'action' => 'redirect',
            'url' => $checkout_url
        ] );
    }

    wp_send_json_error( [ 'message' => 'Loại ưu đãi của mã không hợp lệ.' ] );
}

