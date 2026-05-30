<?php
/**
 * Single Template: Khóa học (course)
 *
 * @package Hieucon
 */

get_header();

$current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$is_enrolled    = false;
$first_lesson_url = '#';

// Fetch CPT Meta fields
$price       = get_post_meta( get_the_ID(), '_course_price', true );
$level       = get_post_meta( get_the_ID(), '_course_level', true );
$intro_video = get_post_meta( get_the_ID(), '_course_intro_video', true );
$duration    = get_post_meta( get_the_ID(), '_course_duration', true );

// Fetch Syllabus (all lessons belonging to this course)
$lessons_query = new WP_Query( [
    'post_type'      => 'lesson',
    'posts_per_page' => -1,
    'meta_query'     => [
        [
            'key'     => '_belong_to_course',
            'value'   => get_the_ID(),
            'compare' => '='
        ]
    ],
    'meta_key'       => '_lesson_order',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC'
] );

$total_lessons = $lessons_query->post_count;

if ( $lessons_query->have_posts() ) {
    $first_lesson_id  = $lessons_query->posts[0]->ID;
    $first_lesson_url = get_permalink( $first_lesson_id );
}

// Check membership status and course ownership
if ( current_user_can( 'manage_options' ) ) {
    $is_enrolled = true;
    if ( ! $current_member ) {
        $wp_user = wp_get_current_user();
        $current_member = (object) [
            'id'        => 0,
            'role'      => 'administrator',
            'full_name' => $wp_user->display_name ? $wp_user->display_name : 'Quản trị viên',
            'email'     => $wp_user->user_email,
            'status'    => 'active'
        ];
    }
} elseif ( $current_member ) {
    $member_id = intval( $current_member->id );
    if ( $current_member->role === 'administrator' || $current_member->role === 'teacher' || $current_member->role === 'expert' ) {
        $is_enrolled = true;
    } else {
        $enrolled = hieucon_get_member_enrolled_courses( $member_id );
        if ( is_array( $enrolled ) && in_array( get_the_ID(), $enrolled ) ) {
            $is_enrolled = true;
        }
    }
}

// Format level label
$level_label = 'Cơ bản';
if ( $level === 'intermediate' ) {
    $level_label = 'Trung cấp';
} elseif ( $level === 'advanced' ) {
    $level_label = 'Nâng cao';
}
?>

<main id="primary" class="site-main min-h-screen py-10 md:py-16 bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Breadcrumb -->
        <nav class="flex text-slate-500 text-xs font-bold uppercase tracking-widest mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2">
                <li class="inline-flex items-center">
                    <a href="<?php echo esc_url( home_url( '/courses/' ) ); ?>" class="hover:text-primary text-navy/70 transition-colors flex items-center gap-2 bg-white/70 backdrop-blur-md px-4 py-2 rounded-full border border-white/80 shadow-soft">
                        <i data-lucide="graduation-cap" class="w-4 h-4 text-primary"></i> Khóa học
                    </a>
                </li>
                <li class="flex items-center">
                    <i data-lucide="chevron-right" class="w-4 h-4 text-slate-400 mx-1"></i>
                    <span class="bg-white/40 backdrop-blur-md px-4 py-2 rounded-full border border-white/40 text-slate-400 select-none max-w-[200px] md:max-w-xs truncate"><?php the_title(); ?></span>
                </li>
            </ol>
        </nav>

        <!-- Course Main Structure (2 Columns) -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column: Details & Syllabus (70%) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Main Info Card -->
                <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500">
                    <h1 class="text-2xl md:text-4xl font-serif font-bold text-navy leading-tight mb-4"><?php the_title(); ?></h1>
                    
                    <!-- Meta List -->
                    <div class="flex flex-wrap gap-y-3 gap-x-6 items-center text-slate-500 text-xs md:text-sm font-semibold mb-8 pb-6 border-b border-slate-100">
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="bar-chart" class="w-4 h-4 text-primary"></i>
                            <span>Cấp độ: <?php echo esc_html( $level_label ); ?></span>
                        </div>
                        <span class="w-1 h-1 bg-slate-300 rounded-full hidden md:inline"></span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="play-circle" class="w-4 h-4 text-primary"></i>
                            <span><?php echo esc_html( $total_lessons ); ?> bài học</span>
                        </div>
                        <span class="w-1 h-1 bg-slate-300 rounded-full hidden md:inline"></span>
                        <div class="flex items-center gap-1.5">
                            <i data-lucide="clock" class="w-4 h-4 text-primary"></i>
                            <span><?php echo esc_html( $duration ? $duration : 'Chưa rõ thời lượng' ); ?></span>
                        </div>
                    </div>

                    <!-- Video Intro Player -->
                    <?php if ( ! empty( $intro_video ) ) : ?>
                        <div class="mb-8 overflow-hidden rounded-2xl aspect-video bg-slate-950 shadow-md border border-slate-100 relative group">
                            <?php if ( strpos( $intro_video, 'iframe' ) !== false ) : ?>
                                <!-- Embedded raw iframe code -->
                                <div class="w-full h-full [&>iframe]:w-full [&>iframe]:h-full">
                                    <?php echo $intro_video; ?>
                                </div>
                            <?php elseif ( strpos( $intro_video, 'youtube.com' ) !== false || strpos( $intro_video, 'youtu.be' ) !== false ) : 
                                // YouTube URL convert to embed
                                $video_id = '';
                                if ( preg_match( '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $intro_video, $match ) ) {
                                    $video_id = $match[1];
                                }
                            ?>
                                <iframe class="w-full h-full border-0" src="https://www.youtube.com/embed/<?php echo esc_attr( $video_id ); ?>?rel=0" allowfullscreen></iframe>
                            <?php else : ?>
                                <!-- HTML5 Direct Video Player -->
                                <video class="w-full h-full" controls preload="metadata">
                                    <source src="<?php echo esc_url( $intro_video ); ?>" type="video/mp4">
                                    Trình phát của bạn không hỗ trợ định dạng video này.
                                </video>
                            <?php endif; ?>
                        </div>
                    <?php else : ?>
                        <!-- Fallback to Featured Image -->
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="mb-8 overflow-hidden rounded-2xl aspect-video bg-slate-100 shadow-sm border border-slate-100">
                                <?php the_post_thumbnail( 'large', [ 'class' => 'w-full h-full object-cover' ] ); ?>
                            </div>
                        <?php endif; ?>
                    <?php endif; ?>

                    <!-- Course Description -->
                    <div class="prose max-w-none text-slate-700 leading-relaxed">
                        <h3 class="text-xl font-serif font-bold text-navy mb-4">Giới thiệu khóa học</h3>
                        <?php the_content(); ?>
                    </div>
                </div>

                <!-- Syllabus Card (Mục lục bài học) -->
                <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 animate-fadeIn">
                    <h3 class="text-xl font-serif font-bold text-navy mb-6 flex items-center gap-2">
                        <i data-lucide="book-open" class="w-5 h-5 text-primary"></i> Đề cương môn học
                    </h3>

                    <?php if ( $lessons_query->have_posts() ) : ?>
                        <div class="space-y-3.5">
                            <?php $l_idx = 1; while ( $lessons_query->have_posts() ) : $lessons_query->the_post(); 
                                $lesson_duration = get_post_meta( get_the_ID(), '_lesson_duration', true );
                            ?>
                                <div class="p-4 bg-white/60 hover:bg-white border border-slate-150/50 rounded-2xl flex items-center justify-between transition-all duration-300 hover:shadow-soft hover:border-primary/20 group/item">
                                    <div class="flex items-center gap-4">
                                        <div class="w-9 h-9 rounded-xl bg-navy/5 text-navy font-bold text-sm flex items-center justify-center border border-navy/5 group-hover/item:bg-primary group-hover/item:text-white group-hover/item:border-primary transition-all duration-300">
                                            <?php echo $l_idx++; ?>
                                        </div>
                                        <div>
                                            <span class="text-sm md:text-base font-bold text-navy group-hover/item:text-primary transition-colors">
                                                <?php the_title(); ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-4">
                                        <?php if ( ! empty( $lesson_duration ) ) : ?>
                                            <span class="text-xs text-slate-400 group-hover/item:text-slate-500 transition-colors font-semibold flex items-center gap-1.5">
                                                <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-350"></i>
                                                <?php echo esc_html( $lesson_duration ); ?>
                                            </span>
                                        <?php endif; ?>

                                        <!-- Lock/Unlock State Icon -->
                                        <?php if ( $is_enrolled ) : ?>
                                            <a href="<?php the_permalink(); ?>" class="text-emerald-500 hover:text-emerald-600 hover:scale-110 transition-all" title="Vào học ngay">
                                                <i data-lucide="play-circle" class="w-6 h-6 fill-emerald-50"></i>
                                            </a>
                                        <?php else : ?>
                                            <span class="text-slate-300 cursor-not-allowed" title="Vui lòng đăng ký/kích hoạt khóa học để xem">
                                                <i data-lucide="lock" class="w-5 h-5"></i>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endwhile; wp_reset_postdata(); ?>
                        </div>
                    <?php else : ?>
                        <div class="text-center py-8 text-slate-500 text-sm">
                            Chương trình học đang được cập nhật. Vui lòng quay lại sau!
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Discussion & QA Section -->
                <div class="bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 animate-fadeIn mt-8">
                    <h3 class="text-xl font-serif font-bold text-navy mb-6 flex items-center gap-2">
                        <i data-lucide="messages-square" class="w-5 h-5 text-primary"></i> Thảo luận & Hỏi đáp khóa học
                    </h3>

                    <!-- Comments list mount area -->
                    <div class="relative z-10 mb-6">
                        <div id="realtime-comments-list" class="space-y-4">
                            <div class="text-center py-10 text-slate-455 text-xs select-none">
                                <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                                Đang tải thảo luận...
                            </div>
                        </div>
                    </div>

                    <!-- Submit form or Guest Notice -->
                    <div class="pt-6 border-t border-slate-100 space-y-4">
                        <h4 class="text-sm font-bold text-[#0A1931] flex items-center gap-1.5">
                            <i data-lucide="message-square-plus" class="w-4 h-4 text-primary"></i> Gửi câu hỏi / Thảo luận mới
                        </h4>
                        <?php if ( ! $current_member ) : ?>
                            <div class="p-5 bg-slate-50 border border-slate-150 rounded-2xl text-center select-none shadow-soft">
                                <p class="text-xs text-slate-500 font-semibold mb-3">Vui lòng đăng nhập để gửi thắc mắc hoặc thảo luận về khóa học này.</p>
                                <a href="<?php echo esc_url( home_url( '/dang-nhap/?redirect_to=' . urlencode( get_permalink() ) ) ); ?>" class="inline-flex items-center gap-2 px-5 py-2.5 bg-navy hover:bg-secondary text-white text-xs font-bold rounded-xl transition-all shadow-md hover:scale-102 transform duration-200">
                                    Đăng nhập ngay <i data-lucide="log-in" class="w-4 h-4"></i>
                                </a>
                            </div>
                        <?php else : ?>
                            <form id="ajax-comment-form" onsubmit="submitAjaxComment(event)" class="space-y-4">
                                <textarea id="comment-textarea" name="comment" required rows="3" class="w-full px-4 py-3 rounded-2xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Hãy viết thắc mắc hoặc thảo luận của bạn..."></textarea>
                                <input type="hidden" name="comment_post_ID" value="<?php echo get_the_ID(); ?>" id="comment_post_ID">
                                <input type="hidden" name="comment_parent" id="ajax_comment_parent" value="0">
                                <?php wp_nonce_field( 'hieucon_comment_nonce', 'comment_nonce' ); ?>
                                
                                <div class="flex justify-end">
                                    <button type="submit" id="submit-comment-btn" class="px-5 py-2.5 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-xl font-bold text-xs shadow-md hover:shadow-lg transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                                        Gửi thảo luận <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                                    </button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sidebar (30%) -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 lg:sticky lg:top-[108px] bg-white/85 backdrop-blur-xl border border-white/80 p-6 md:p-8 rounded-[2.5rem] shadow-soft hover:shadow-elegant transition-all duration-500 space-y-6 animate-fadeIn">
                    
                    <!-- Price tag -->
                    <div class="text-center pb-6 border-b border-slate-100">
                        <span class="block text-slate-400 text-xs font-bold uppercase tracking-wider mb-1">Giá trị khóa học</span>
                        <?php if ( $price == 0 ) : ?>
                            <span class="text-3xl font-extrabold text-emerald-600 bg-emerald-50 px-4 py-1.5 rounded-2xl border border-emerald-100 inline-block">Miễn phí</span>
                        <?php else : ?>
                            <span class="text-3xl font-extrabold text-navy"><?php echo number_format( $price, 0, ',', '.' ); ?> VND</span>
                        <?php endif; ?>
                    </div>

                    <!-- Commercial details checklist -->
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                            <span class="text-slate-600 text-xs md:text-sm font-semibold">Quyền truy cập học trọn đời</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                            <span class="text-slate-600 text-xs md:text-sm font-semibold">Bài giảng video HD chi tiết</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                            <span class="text-slate-600 text-xs md:text-sm font-semibold">Hỏi đáp trực tiếp cùng Giảng viên</span>
                        </div>
                        <div class="flex items-start gap-3">
                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                            <span class="text-slate-600 text-xs md:text-sm font-semibold">Tương thích Máy tính & Điện thoại</span>
                        </div>
                    </div>

                    <!-- CTA BUTTONS CONTAINER -->
                    <div class="pt-4 border-t border-slate-100 space-y-3">
                        <?php if ( ! $current_member ) : ?>
                            <!-- Guest User -->
                            <a href="<?php echo esc_url( home_url( '/dang-nhap/?redirect_to=' . urlencode( get_permalink() ) ) ); ?>" class="w-full py-4 bg-navy hover:bg-secondary text-white rounded-2xl font-bold text-sm shadow-[0_4px_20px_rgba(10,25,49,0.15)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.25)] hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-2">
                                Đăng ký để học ngay <i data-lucide="log-in" class="w-4 h-4"></i>
                            </a>
                        <?php else : ?>
                            <!-- Logged In User -->
                            <?php if ( $is_enrolled ) : ?>
                                <!-- Owned Course -->
                                <a href="<?php echo esc_url( $first_lesson_url ); ?>" class="w-full py-4 bg-emerald-600 hover:bg-emerald-550 text-white rounded-2xl font-bold text-sm shadow-[0_4px_20px_rgba(16,185,129,0.2)] hover:shadow-[0_10px_30px_rgba(16,185,129,0.3)] hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-2">
                                    VÀO HỌC NGAY <i data-lucide="play-circle" class="w-5 h-5 animate-pulse"></i>
                                </a>
                            <?php else : ?>
                                <!-- Not Owned Course -->
                                <a href="<?php echo esc_url( home_url( '/tai-khoan/' ) ); ?>" class="w-full py-4 bg-primary hover:bg-secondary text-white rounded-2xl font-bold text-sm shadow-[0_4px_20px_rgba(13,148,136,0.15)] hover:shadow-[0_10px_30px_rgba(249,115,22,0.25)] hover:scale-[1.02] transform transition-all duration-300 flex items-center justify-center gap-2">
                                    Kích hoạt khóa học bằng mã <i data-lucide="key" class="w-4 h-4"></i>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>

                </div>
            </div>

        </div>

    </div>
</main>

<?php
$like_nonce = wp_create_nonce( 'hieucon_like_nonce' );
?>

<style>
/* 5. Giao diện Thảo luận iOS Bubble Chat - Premium Solid Color Coding */
.comment-bubble-glass {
    background: #ffffff !important;
    border: 1px solid rgba(255, 214, 192, 0.45) !important; /* soft warm sand border */
    box-shadow: 0 4px 15px -3px rgba(10, 25, 49, 0.03) !important;
    border-radius: 1.25rem !important; /* 20px smooth corners */
    transition: all 0.22s cubic-bezier(0.16, 1, 0.3, 1) !important;
}
.comment-bubble-glass:hover {
    border-color: rgba(13, 148, 136, 0.35) !important;
    box-shadow: 0 6px 18px -3px rgba(10, 25, 49, 0.05) !important;
}

/* Custom Role-Based Bubble Color Themes */
.comment-role-administrator .comment-bubble-glass,
.comment-role-teacher .comment-bubble-glass {
    background: #FFF9F2 !important; /* Cozy Warm Peach Cream */
    border: 1px solid rgba(249, 115, 22, 0.2) !important; /* Premium Warm Apricot Border */
}
.comment-role-administrator .comment-bubble-glass:hover,
.comment-role-teacher .comment-bubble-glass:hover {
    border-color: rgba(249, 115, 22, 0.4) !important;
}

.comment-role-expert .comment-bubble-glass {
    background: #F3FAF6 !important; /* Cozy Calming Green Cream */
    border: 1px solid rgba(16, 185, 129, 0.2) !important; /* Sage Jade Border */
}
.comment-role-expert .comment-bubble-glass:hover {
    border-color: rgba(16, 185, 129, 0.4) !important;
}

.comment-role-assistant .comment-bubble-glass {
    background: #F3F8FB !important; /* Quiet Sky Blue Cream */
    border: 1px solid rgba(14, 165, 233, 0.2) !important; /* Soft Blue Border */
}
.comment-role-assistant .comment-bubble-glass:hover {
    border-color: rgba(14, 165, 233, 0.4) !important;
}

.comment-role-member .comment-bubble-glass {
    background: #ffffff !important;
    border: 1px solid rgba(13, 148, 136, 0.15) !important; /* Soft Teal Border for Active Members */
}
.comment-role-member .comment-bubble-glass:hover {
    border-color: rgba(13, 148, 136, 0.35) !important;
}

/* Text visibility controls on light glass backdrop - guarantees deep readability */
.comment-node span.text-white {
    color: #0A1931 !important;
    font-weight: 800 !important;
    font-family: 'Nunito', sans-serif !important;
}
.comment-node div.text-slate-200 {
    color: #2d3748 !important; /* Dark Slate Gray for comfortable reading */
    font-weight: 500 !important;
    font-size: 0.8rem !important;
    line-height: 1.65 !important;
}
.comment-node .bg-slate-800,
.comment-node .bg-slate-750 {
    background: transparent !important;
    border: none !important;
    box-shadow: none !important;
}

/* High Contrast Roles Badges with sharp borders */
.comment-node span.bg-emerald-500\/15 {
    background: rgba(16, 185, 129, 0.12) !important;
    color: #047857 !important;
    border: 1px solid rgba(16, 185, 129, 0.25) !important;
}
.comment-node span.bg-sky-500\/15 {
    background: rgba(14, 165, 233, 0.12) !important;
    color: #0369a1 !important;
    border: 1px solid rgba(14, 165, 233, 0.25) !important;
}
.comment-node span.bg-teal-500\/15 {
    background: rgba(20, 184, 166, 0.12) !important;
    color: #0f766e !important;
    border: 1px solid rgba(20, 184, 166, 0.25) !important;
}
.comment-node span.bg-red-500\/15 {
    background: rgba(239, 68, 68, 0.12) !important;
    color: #b91c1c !important;
    border: 1px solid rgba(239, 68, 68, 0.25) !important;
}
.comment-node span.bg-orange-500\/15 {
    background: rgba(249, 115, 22, 0.12) !important;
    color: #c2410c !important;
    border: 1px solid rgba(249, 115, 22, 0.25) !important;
}
.comment-node span.bg-slate-500\/15 {
    background: rgba(100, 116, 139, 0.10) !important;
    color: #475569 !important;
    border: 1px solid rgba(100, 116, 139, 0.20) !important;
}

.comment-node > div > div.rounded-full {
    color: white !important;
    border: none !important;
}

/* Thread connector line gradients */
.thread-line::before {
    content: '' !important;
    position: absolute !important;
    left: -19px !important;
    top: 0 !important;
    bottom: 0 !important;
    width: 2px !important;
    background: linear-gradient(to bottom, rgba(13, 148, 136, 0.35) 0%, rgba(249, 115, 22, 0.1) 100%) !important;
    border-radius: 99px !important;
}

/* Comment inputs warm focus borders */
#comment-textarea:focus,
.comment-node textarea:focus {
    border-color: #14b8a6 !important; /* Active teal border */
    box-shadow: 0 0 0 3px rgba(20, 184, 166, 0.12) !important;
    outline: none !important;
}
</style>

<!-- 3. Smart Redirect Warning Toast Banner -->
<div id="login-required-toast" class="fixed bottom-8 left-1/2 -translate-x-1/2 z-50 max-w-sm w-[90%] glass-panel rounded-2xl py-3 px-4 shadow-elegant border border-orange-200/50 bg-[#FFF9F0]/95 flex items-center justify-between gap-3 transform translate-y-12 opacity-0 pointer-events-none transition-all duration-400 select-none">
    <div class="flex items-center gap-2">
        <div class="w-7 h-7 rounded-xl bg-orange-100 flex items-center justify-center text-orange-600 shrink-0">
            <i data-lucide="lock" class="w-4 h-4 text-orange-500 animate-pulse"></i>
        </div>
        <div>
            <span class="text-[9px] text-slate-400 font-bold block uppercase tracking-wider">Thông báo hệ thống</span>
            <p class="text-[10px] font-bold text-[#0A1931] leading-tight">Vui lòng đăng nhập để bắt đầu học bài này nhé!</p>
        </div>
    </div>
    <div class="flex items-center gap-1 shrink-0">
        <button type="button" onclick="dismissToast()" class="text-slate-400 hover:text-slate-600 transition-colors p-1 bg-transparent border-0 cursor-pointer flex items-center justify-center rounded-lg">
            <i data-lucide="x" class="w-3.5 h-3.5"></i>
        </button>
    </div>
</div>

<script>
    const ajaxUrlLike = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const currentPostId = <?php echo get_the_ID(); ?>;
    const likeNonce = '<?php echo esc_attr( $like_nonce ); ?>';

    let isFetching = false;
    let expandedRepliesCache = []; // Expanded nested replies tracking
    let visibleTopLevelCount = 5;
    let expandedRepliesFullCache = []; // Fully expanded replies tracks
    let lastCommentsHtmlCache = ""; // Polling cache to prevent layout thrashing

    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        // Fetch comments on start
        fetchComments(false);

        // Check for error query parameter
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('error') === 'login_required') {
            showLoginRequiredToast();
        }
    });

    function showLoginRequiredToast() {
        const toast = document.getElementById('login-required-toast');
        if (toast) {
            toast.classList.remove('translate-y-12', 'opacity-0', 'pointer-events-none');
            toast.classList.add('translate-y-0', 'opacity-100', 'pointer-events-auto');
            setTimeout(() => {
                dismissToast();
            }, 5000);
        }
    }

    function dismissToast() {
        const toast = document.getElementById('login-required-toast');
        if (toast) {
            toast.classList.add('translate-y-12', 'opacity-0', 'pointer-events-none');
            toast.classList.remove('translate-y-0', 'opacity-100', 'pointer-events-auto');
            
            // Clean up URL parameter cleanly without reloading the page
            const url = new URL(window.location);
            url.searchParams.delete('error');
            window.history.replaceState({}, document.title, url.toString());
        }
    }

    // --- STATE CACHING FOR STAMINA AND CURSOR POSITION PRESERVATION ---
    function cacheActiveReplyStates() {
        const list = document.getElementById('realtime-comments-list');
        if (!list) return {};
        const state = {};
        list.querySelectorAll('.replies-container textarea').forEach(txt => {
            const id = txt.id.replace('reply-textarea-', '');
            state[id] = { val: txt.value, isFocused: (document.activeElement === txt) };
        });
        return state;
    }

    function cacheExpandedReplies() {
        return [...expandedRepliesCache];
    }

    function restoreExpandedReplies(expanded) {
        expanded.forEach(commentId => {
            const container = document.getElementById(`replies-container-${commentId}`);
            const toggleWrap = document.getElementById(`reply-toggle-wrap-${commentId}`);
            if (container && toggleWrap) {
                container.classList.remove('hidden');
                toggleWrap.innerHTML = `
                    <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-slate-500 hover:text-slate-450 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                        <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-455"></i> Ẩn phản hồi
                    </button>
                `;
            }
        });
        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    function restoreReplyStates(states, activeElementId, selectionStart, selectionEnd) {
        Object.keys(states).forEach(commentId => {
            showReplyForm(commentId, true);
            const txt = document.getElementById(`reply-textarea-${commentId}`);
            if (txt) {
                txt.value = states[commentId].val;
                if (states[commentId].isFocused) {
                    txt.focus();
                }
            }
        });

        if (activeElementId) {
            const activeEl = document.getElementById(activeElementId);
            if (activeEl) {
                activeEl.focus();
                if (selectionStart !== null && selectionEnd !== null) {
                    activeEl.setSelectionRange(selectionStart, selectionEnd);
                }
            }
        }
    }

    // --- MAIN FETCH COMMENTS ACTION ---
    async function fetchComments(silent = false, force = false) {
        if (isFetching && !force) return;
        isFetching = true;

        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) {
            isFetching = false;
            return;
        }

        const activeStates = cacheActiveReplyStates();
        const expandedReplies = cacheExpandedReplies();
        
        const activeElement = document.activeElement;
        const activeElementId = activeElement ? activeElement.id : null;
        let selectionStart = null;
        let selectionEnd = null;

        if (activeElement && (activeElement.tagName === 'TEXTAREA' || activeElement.tagName === 'INPUT')) {
            selectionStart = activeElement.selectionStart;
            selectionEnd = activeElement.selectionEnd;
        }

        if (!silent && !listContainer.querySelector('.comment-node')) {
            listContainer.innerHTML = `
                <div class="text-center py-10 text-slate-455 text-xs select-none">
                    <span class="inline-block animate-spin rounded-full h-4.5 w-4.5 border-2 border-primary border-t-transparent mr-2.5"></span>
                    Đang tải thảo luận...
                </div>
            `;
        }

        try {
            const url = `${ajaxUrlLike}?action=hieucon_fetch_comments&post_id=${currentPostId}&t=${Date.now()}`;
            const res = await fetch(url);
            const data = await res.json();

            if (data.success) {
                if (lastCommentsHtmlCache === data.data.html) {
                    isFetching = false;
                    return;
                }
                lastCommentsHtmlCache = data.data.html;
                listContainer.innerHTML = data.data.html;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }

                restoreExpandedReplies(expandedReplies);
                applyTopLevelPagination();
                applyNestedRepliesPagination();
                restoreReplyStates(activeStates, activeElementId, selectionStart, selectionEnd);
            }
        } catch (err) {
            console.error('Lỗi khi tải thảo luận:', err);
        } finally {
            isFetching = false;
        }
    }

    function showReplyForm(commentId, forceOpen = false) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (!wrap) return;

        if (!forceOpen && !wrap.classList.contains('hidden')) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
            return;
        }

        wrap.innerHTML = `
            <form onsubmit="submitAjaxComment(event, ${commentId})" class="mt-2 space-y-2 solid-panel p-3.5 rounded-2xl shadow-soft animate-fadeIn bg-white border border-[#FFD6C0]/35 select-none text-left">
                <textarea id="reply-textarea-${commentId}" required rows="2" class="w-full px-3 py-2.5 rounded-xl border border-slate-200 bg-white focus:bg-white transition-all text-xs text-slate-800 placeholder-slate-400 resize-none font-semibold shadow-soft" placeholder="Viết phản hồi của bạn..."></textarea>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="cancelReplyForm(${commentId})" class="px-3 py-1.5 bg-slate-100 hover:bg-slate-200 text-slate-655 rounded-lg font-bold text-[10px] transition-colors border border-slate-200/80 cursor-pointer">Hủy</button>
                    <button type="submit" id="submit-reply-${commentId}-btn" class="px-3 py-1.5 bg-primary hover:bg-primary/90 disabled:bg-primary/50 text-white rounded-lg font-bold text-[10px] shadow-sm transition-all flex items-center gap-1.5 btn-premium-gradient border-0 cursor-pointer">
                        Gửi phản hồi <i data-lucide="send" class="w-3.5 h-3.5 text-white"></i>
                    </button>
                </div>
            </form>
        `;
        wrap.classList.remove('hidden');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        if (!forceOpen) {
            const textarea = document.getElementById(`reply-textarea-${commentId}`);
            if (textarea) {
                textarea.focus();
            }
        }
    }

    function cancelReplyForm(commentId) {
        const wrap = document.getElementById(`reply-form-wrap-${commentId}`);
        if (wrap) {
            wrap.classList.add('hidden');
            wrap.innerHTML = '';
        }
    }

    function toggleReplies(commentId, forceOpen = false) {
        const container = document.getElementById(`replies-container-${commentId}`);
        const toggleWrap = document.getElementById(`reply-toggle-wrap-${commentId}`);
        if (!container || !toggleWrap) return;

        const isHidden = container.classList.contains('hidden');

        if (forceOpen || isHidden) {
            container.classList.remove('hidden');
            if (!expandedRepliesCache.includes(commentId)) {
                expandedRepliesCache.push(commentId);
            }

            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-slate-500 hover:text-slate-455 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-up" class="w-3.5 h-3.5 text-slate-455"></i> Ẩn phản hồi
                </button>
            `;

            applyNestedRepliesPagination();
        } else {
            container.classList.add('hidden');
            expandedRepliesCache = expandedRepliesCache.filter(id => id !== commentId);
            expandedRepliesFullCache = expandedRepliesFullCache.filter(id => id !== commentId);

            const replyCount = container.querySelectorAll('.comment-node[data-reply-index]').length;
            toggleWrap.innerHTML = `
                <button type="button" onclick="toggleReplies(${commentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0 select-none">
                    <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-primary"></i> Xem ${replyCount} câu trả lời
                </button>
            `;

            applyNestedRepliesPagination();
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    async function submitAjaxComment(event, parentId = 0) {
        event.preventDefault();

        let content = '';
        let submitBtn = null;
        let textarea = null;

        if (parentId === 0) {
            textarea = document.getElementById('comment-textarea');
            submitBtn = document.getElementById('submit-comment-btn');
        } else {
            textarea = document.getElementById(`reply-textarea-${parentId}`);
            submitBtn = document.getElementById(`submit-reply-${parentId}-btn`);
        }

        if (!textarea || !textarea.value.trim()) return;
        content = textarea.value.trim();

        // --- OPTIMISTIC UI UPDATE ---
        const listContainer = document.getElementById('realtime-comments-list');
        if (listContainer) {
            const escapedContent = content.replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\n/g, "<br>");
            const optimisticHtml = `
                <div class="comment-node group/comment relative animate-pulse mt-3 opacity-60 transition-all duration-300">
                    <div class="flex items-start gap-2.5 relative z-10">
                        <div class="w-7 h-7 rounded-full bg-slate-200 flex items-center justify-center font-bold text-[10px] text-slate-500 shadow-sm shrink-0">
                            <i data-lucide="loader-2" class="w-3.5 h-3.5 animate-spin"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="inline-block comment-bubble-glass px-4 py-2.5 rounded-2xl max-w-full border border-slate-200/50">
                                <div class="flex flex-wrap items-center gap-1.5 mb-0.5">
                                    <span class="text-xs font-extrabold text-slate-500">Đang gửi...</span>
                                </div>
                                <div class="text-[12px] md:text-xs text-slate-650 leading-relaxed break-words font-semibold">
                                    ${escapedContent}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            
            if (parentId === 0) {
                const placeholder = listContainer.querySelector('div.text-center');
                if (placeholder && placeholder.innerHTML.includes('Chưa có cuộc thảo luận nào')) {
                    listContainer.innerHTML = '';
                }
                listContainer.insertAdjacentHTML('beforeend', optimisticHtml);
            } else {
                const repliesContainer = document.getElementById(`replies-container-${parentId}`);
                if (repliesContainer) {
                    repliesContainer.classList.remove('hidden');
                    repliesContainer.insertAdjacentHTML('beforeend', optimisticHtml);
                }
            }
            
            try {
                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } catch (e) {}
        }
        
        textarea.value = '';

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_submit_comment');
        formData.append('post_id', currentPostId);
        formData.append('comment_parent', parentId);
        formData.append('content', content);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                if (parentId !== 0) {
                    cancelReplyForm(parentId);
                    if (!expandedRepliesCache.includes(parentId)) {
                        expandedRepliesCache.push(parentId);
                    }
                    if (!expandedRepliesFullCache.includes(parentId)) {
                        expandedRepliesFullCache.push(parentId);
                    }
                } else {
                    visibleTopLevelCount = 999;
                }

                lastCommentsHtmlCache = "";
                await fetchComments(true, true);
            } else {
                textarea.value = content;
                alert(data.data.message || 'Lỗi khi gửi thảo luận.');
            }
        } catch (err) {
            textarea.value = content;
            console.error('Lỗi khi gửi thảo luận:', err);
            alert('Lỗi kết nối máy chủ. Vui lòng thử lại.');
        }
    }

    async function handleCommentLike(commentId) {
        const btn = document.getElementById(`comment-like-btn-${commentId}`);
        if (!btn) return;
        btn.disabled = true;

        const nonceElem = document.getElementById('comment_nonce');
        const nonce = nonceElem ? nonceElem.value : '';

        const formData = new FormData();
        formData.append('action', 'hieucon_like_comment');
        formData.append('comment_id', commentId);
        formData.append('nonce', nonce);

        try {
            const res = await fetch(ajaxUrlLike, {
                method: 'POST',
                body: formData
            });
            const data = await res.json();

            if (data.success) {
                const isLiked = data.data.status === 'liked';
                const count = data.data.total_likes;

                btn.className = `text-[10px] font-bold transition-colors flex items-center gap-1 ${isLiked ? 'text-red-500' : 'text-slate-500 hover:text-primary'} bg-transparent border-0 cursor-pointer p-0 select-none`;
                
                const heartIcon = isLiked ? '<i data-lucide="heart" class="w-3 h-3 fill-red-500 text-red-500 liked-heart-glow"></i>' : '<i data-lucide="heart" class="w-3 h-3 text-slate-500"></i>';
                const countSpan = count > 0 ? `<span id="comment-like-count-${commentId}" class="bg-red-50 px-1.5 py-0.5 rounded text-red-500 font-bold ml-0.5 border border-red-200/50">${count}</span>` : '';
                
                btn.innerHTML = `${heartIcon} Thích ${countSpan}`;

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } else {
                alert(data.data.message || 'Lỗi khi thích bình luận.');
            }
        } catch (err) {
            console.error('Lỗi khi thích bình luận:', err);
        } finally {
            btn.disabled = false;
        }
    }

    // --- FACEBOOK PAGINATION SYSTEM ---
    function applyTopLevelPagination() {
        const listContainer = document.getElementById('realtime-comments-list');
        if (!listContainer) return;

        const topComments = Array.from(listContainer.querySelectorAll(':scope > .comment-node'));
        const total = topComments.length;
        const startIndex = Math.max(0, total - visibleTopLevelCount);
        
        topComments.forEach((comment, index) => {
            if (index >= startIndex) {
                comment.classList.remove('hidden');
            } else {
                comment.classList.add('hidden');
            }
        });

        const oldBtn = document.getElementById('load-more-comments-btn-wrap');
        if (oldBtn) oldBtn.remove();

        if (startIndex > 0) {
            const remaining = startIndex;
            const btnHtml = `
                <div id="load-more-comments-btn-wrap" class="pb-3 select-none">
                    <button type="button" onclick="loadMoreTopComments()" class="w-full py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 hover:border-slate-300 rounded-xl font-bold text-xs text-primary transition-all flex items-center justify-center gap-1.5 cursor-pointer shadow-sm border-0">
                        <i data-lucide="history" class="w-3.5 h-3.5 text-primary"></i> Xem bình luận cũ hơn (${remaining})
                    </button>
                </div>
            `;
            listContainer.insertAdjacentHTML('afterbegin', btnHtml);
            
            if (typeof lucide !== 'undefined') {
                lucide.createIcons({ strokeWidth: 1.5 });
            }
        }
    }

    function loadMoreTopComments() {
        visibleTopLevelCount += 5;
        applyTopLevelPagination();
    }

    function applyNestedRepliesPagination() {
        expandedRepliesCache.forEach(commentId => {
            const container = document.getElementById(`replies-container-${commentId}`);
            if (!container) return;

            const replies = Array.from(container.querySelectorAll(':scope > .comment-node[data-reply-index]'));
            const total = replies.length;

            const isFullyExpanded = expandedRepliesFullCache.includes(commentId);
            const defaultLimit = 3;

            if (total > defaultLimit && !isFullyExpanded) {
                const hiddenCount = total - defaultLimit;
                replies.forEach((rep, idx) => {
                    if (idx >= hiddenCount) {
                        rep.classList.remove('hidden');
                    } else {
                        rep.classList.add('hidden');
                    }
                });

                const oldBtn = document.getElementById(`load-more-replies-wrap-${commentId}`);
                if (oldBtn) oldBtn.remove();

                const btnHtml = `
                    <div id="load-more-replies-wrap-${commentId}" class="ml-10 py-1.5 animate-fadeIn select-none text-left">
                        <button type="button" onclick="loadMoreReplies(${commentId})" class="text-[10px] font-bold text-primary hover:text-primary/80 transition-colors flex items-center gap-1 bg-transparent border-0 cursor-pointer p-0">
                            <i data-lucide="messages-square" class="w-3.5 h-3.5 text-primary"></i> Xem ${hiddenCount} câu trả lời cũ hơn
                        </button>
                    </div>
                `;
                container.insertAdjacentHTML('afterbegin', btnHtml);

                if (typeof lucide !== 'undefined') {
                    lucide.createIcons({ strokeWidth: 1.5 });
                }
            } else {
                replies.forEach(rep => rep.classList.remove('hidden'));
                const oldBtn = document.getElementById(`load-more-replies-wrap-${commentId}`);
                if (oldBtn) oldBtn.remove();
            }
        });
    }

    function loadMoreReplies(commentId) {
        if (!expandedRepliesFullCache.includes(commentId)) {
            expandedRepliesFullCache.push(commentId);
        }
        applyNestedRepliesPagination();
    }
</script>

<?php
get_footer();
