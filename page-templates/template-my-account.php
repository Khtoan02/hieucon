<?php
/**
 * Template Name: Tài khoản Hội viên Hieucon
 *
 * @package Hieucon
 */

use Hieucon\Model\Member_Model;

// Kiểm tra đăng nhập, nếu chưa đăng nhập chuyển hướng ra trang Đăng nhập
$current_member = Member_Model::get_current_member();

if (current_user_can('manage_options')) {
    if (!$current_member) {
        $wp_user = wp_get_current_user();
        $current_member = (object) [
            'id' => 0,
            'role' => 'administrator',
            'full_name' => $wp_user->display_name ? $wp_user->display_name : 'Quản trị viên',
            'email' => $wp_user->user_email,
            'status' => 'active'
        ];
    }
}

if (!$current_member) {
    wp_redirect(home_url('/dang-nhap/'));
    exit;
}

get_header();

$turnstile_sitekey = ''; // get_option( 'hieucon_turnstile_sitekey', '' );
$account_nonce = wp_create_nonce('hieucon_account_nonce');
?>

<?php if (!empty($turnstile_sitekey)): ?>
    <script src="https://challenges.cloudflare.com/turnstile/v0/api.js" defer></script>
<?php endif; ?>

<main id="primary"
    class="site-main min-h-screen py-12 md:py-20 bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/20">
    <div class="max-w-[1000px] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header tài khoản -->
        <div
            class="flex flex-col md:flex-row items-center justify-between gap-6 mb-10 bg-white/70 backdrop-blur-xl border border-white p-6 rounded-[2rem] shadow-sm">
            <div class="flex items-center gap-4 text-center md:text-left flex-col md:flex-row">
                <div
                    class="w-16 h-16 rounded-full bg-navy/5 flex items-center justify-center text-navy font-bold text-2xl border border-navy/10 uppercase">
                    <?php echo mb_substr(esc_html($current_member->full_name), 0, 1, 'utf-8'); ?>
                </div>
                <div>
                    <h1 class="text-xl md:text-2xl font-serif font-bold text-navy">
                        <?php echo esc_html($current_member->full_name); ?></h1>
                    <div class="flex flex-wrap items-center gap-2 mt-1.5 justify-center md:justify-start">
                        <span
                            class="text-xs font-semibold text-navy/60"><?php echo esc_html($current_member->email); ?></span>
                        <span class="w-1 h-1 bg-slate-300 rounded-full"></span>

                        <!-- Role Badge -->
                        <?php
                        if ($current_member->role === 'expert') {
                            echo '<span class="px-2.5 py-0.5 rounded-full bg-emerald-50 text-emerald-600 border border-emerald-100 text-[10px] font-bold uppercase tracking-wider">Chuyên gia</span>';
                        } elseif ($current_member->role === 'assistant') {
                            echo '<span class="px-2.5 py-0.5 rounded-full bg-blue-50 text-blue-600 border border-blue-100 text-[10px] font-bold uppercase tracking-wider">Trợ lý</span>';
                        } else {
                            echo '<span class="px-2.5 py-0.5 rounded-full bg-slate-50 text-slate-500 border border-slate-200 text-[10px] font-bold uppercase tracking-wider">Hội viên</span>';
                        }
                        ?>
                    </div>
                </div>
            </div>

            <button type="button" onclick="handleLogout()"
                class="px-5 py-2.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-xl font-bold text-xs border border-red-100 transition-colors flex items-center gap-2">
                Đăng Xuất <i data-lucide="log-out" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- Layout Body -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            <!-- Sidebar Menu -->
            <div class="md:col-span-1 space-y-2">
                <?php
                $show_courses = get_option('hieucon_show_courses_in_account', '0') === '1';
                ?>
                <button type="button" onclick="switchAccountTab('ebooks')" id="menu-ebooks-btn"
                    class="w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy bg-white shadow-soft border border-white flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4"></i> Danh sách tài liệu của tôi
                </button>
                <button type="button" onclick="switchAccountTab('redeem')" id="menu-redeem-btn"
                    class="w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy/60 hover:text-navy hover:bg-white/50 flex items-center gap-2">
                    <i data-lucide="ticket" class="w-4 h-4"></i> Nhập mã giới thiệu
                </button>
                <?php if ($show_courses) : ?>
                    <button type="button" onclick="switchAccountTab('courses')" id="menu-courses-btn"
                        class="w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy/60 hover:text-navy hover:bg-white/50 flex items-center gap-2">
                        <i data-lucide="graduation-cap" class="w-4 h-4"></i> Khóa học của tôi
                    </button>
                <?php endif; ?>
                <button type="button" onclick="switchAccountTab('profile')" id="menu-profile-btn"
                    class="w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy/60 hover:text-navy hover:bg-white/50 flex items-center gap-2">
                    <i data-lucide="user" class="w-4 h-4"></i> Thông tin cá nhân
                </button>
                <button type="button" onclick="switchAccountTab('password')" id="menu-password-btn"
                    class="w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy/60 hover:text-navy hover:bg-white/50 flex items-center gap-2">
                    <i data-lucide="key" class="w-4 h-4"></i> Đổi mật khẩu
                </button>
            </div>

            <!-- Content Area Card -->
            <div
                class="md:col-span-3 bg-white/70 backdrop-blur-xl border border-white shadow-elegant rounded-[2.5rem] p-6 md:p-8">

                <div id="account-alert"
                    class="hidden mb-6 p-4 rounded-2xl text-xs md:text-sm font-semibold transition-all duration-300 transform scale-95 opacity-0">
                </div>

                <!-- ================= TAB 1: THÔNG TIN CÁ NHÂN ================= -->
                <div id="tab-profile-view" class="hidden transition-opacity duration-300">
                    <h2 class="text-lg font-serif font-bold text-navy mb-6 pb-2 border-b border-slate-100">Cập nhật
                        Thông tin Cá nhân</h2>

                    <form id="form-profile-update" onsubmit="triggerProfileUpdateOTP(event)" class="space-y-5">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Họ và
                                    Tên</label>
                                <input type="text" name="full_name" required
                                    value="<?php echo esc_attr($current_member->full_name); ?>"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Địa
                                    chỉ Email</label>
                                <input type="email" value="<?php echo esc_attr($current_member->email); ?>" readonly
                                    class="w-full px-4 py-3 rounded-xl border border-slate-100 bg-slate-50 text-navy/40 text-sm font-semibold cursor-not-allowed select-none">
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Số
                                    điện thoại</label>
                                <input type="tel" name="phone_number"
                                    value="<?php echo esc_attr($current_member->phone_number); ?>"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                            </div>
                            <div class="space-y-1">
                                <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Ngày
                                    sinh</label>
                                <input type="date" name="date_of_birth"
                                    value="<?php echo esc_attr($current_member->date_of_birth); ?>"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm">
                            </div>
                        </div>

                        <!-- Turnstile Captcha hiển thị trước khi lưu -->
                        <?php if (!empty($turnstile_sitekey)): ?>
                            <div class="cf-turnstile" data-sitekey="<?php echo esc_attr($turnstile_sitekey); ?>"
                                data-theme="light"></div>
                        <?php endif; ?>

                        <div class="pt-2">
                            <button type="submit"
                                class="px-6 py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-colors flex items-center gap-2">
                                Lưu thay đổi <i data-lucide="check" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ================= TAB 2: ĐỔI MẬT KHẨU ================= -->
                <div id="tab-password-view" class="hidden transition-opacity duration-300">
                    <h2 class="text-lg font-serif font-bold text-navy mb-6 pb-2 border-b border-slate-100">Thay đổi Mật
                        khẩu Bảo mật</h2>

                    <form id="form-password-update" onsubmit="triggerPasswordUpdateOTP(event)" class="space-y-5">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Mật khẩu
                                mới</label>
                            <input type="password" id="new-password" name="password" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                placeholder="Tối thiểu 8 ký tự">
                        </div>

                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Xác nhận
                                mật khẩu mới</label>
                            <input type="password" id="confirm-password" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm"
                                placeholder="Nhập lại mật khẩu mới">
                        </div>

                        <?php if (!empty($turnstile_sitekey)): ?>
                            <div class="cf-turnstile" data-sitekey="<?php echo esc_attr($turnstile_sitekey); ?>"
                                data-theme="light"></div>
                        <?php endif; ?>

                        <div class="pt-2">
                            <button type="submit"
                                class="px-6 py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-colors flex items-center gap-2">
                                Đổi mật khẩu <i data-lucide="lock" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- ================= TAB 3: KHÓA HỌC CỦA TÔI ================= -->
                <div id="tab-courses-view" class="hidden transition-opacity duration-300">
                    <h2 class="text-lg font-serif font-bold text-navy mb-6 pb-2 border-b border-slate-100">Khóa học của
                        tôi</h2>

                    <?php
                    $enrolled_ids = hieucon_get_member_enrolled_courses($current_member->id);
                    if (!is_array($enrolled_ids)) {
                        $enrolled_ids = [];
                    }

                    $is_privileged = in_array($current_member->role, ['administrator', 'teacher', 'expert']) || current_user_can('manage_options');

                    if (empty($enrolled_ids) && !$is_privileged) {
                        ?>
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-slate-50 text-slate-450 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                <i data-lucide="book-open" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <p class="text-slate-550 font-medium mb-6 text-sm">Bạn chưa sở hữu khóa học nào trên hệ thống.
                            </p>
                            <a href="<?php echo esc_url(home_url('/courses/')); ?>"
                                class="inline-flex items-center gap-2 px-6 py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-colors">
                                Khám phá khóa học <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                        <?php
                    } else {
                        // Query the enrolled courses
                        $query_args = [
                            'post_type' => 'course',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        ];
                        if (!$is_privileged) {
                            $query_args['post__in'] = $enrolled_ids;
                        }

                        $my_courses_query = new WP_Query($query_args);

                        if ($my_courses_query->have_posts()) {
                            ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <?php while ($my_courses_query->have_posts()):
                                    $my_courses_query->the_post();
                                    $price = get_post_meta(get_the_ID(), '_course_price', true);
                                    $level = get_post_meta(get_the_ID(), '_course_level', true);
                                    $duration = get_post_meta(get_the_ID(), '_course_duration', true);

                                    // Count number of lessons
                                    $lessons = get_posts([
                                        'post_type' => 'lesson',
                                        'posts_per_page' => -1,
                                        'meta_query' => [
                                            [
                                                'key' => '_belong_to_course',
                                                'value' => get_the_ID(),
                                                'compare' => '='
                                            ]
                                        ]
                                    ]);
                                    $lessons_count = count($lessons);

                                    // Find first lesson for direct "Vào học" button link
                                    $first_lesson_url = '#';
                                    if (!empty($lessons)) {
                                        // Sort them by _lesson_order
                                        usort($lessons, function ($a, $b) {
                                            $order_a = intval(get_post_meta($a->ID, '_lesson_order', true));
                                            $order_b = intval(get_post_meta($b->ID, '_lesson_order', true));
                                            return $order_a <=> $order_b;
                                        });
                                        $first_lesson_url = get_permalink($lessons[0]->ID);
                                    }

                                    $level_label = 'Cơ bản';
                                    $level_class = 'bg-slate-50 text-slate-500 border-slate-200';
                                    if ($level === 'intermediate') {
                                        $level_label = 'Trung cấp';
                                        $level_class = 'bg-blue-50 text-blue-600 border-blue-100';
                                    } elseif ($level === 'advanced') {
                                        $level_label = 'Nâng cao';
                                        $level_class = 'bg-amber-50 text-amber-600 border-amber-100';
                                    }
                                    ?>
                                    <div
                                        class="bg-white/50 border border-slate-100 rounded-3xl p-4 flex flex-col justify-between group hover:bg-white hover:shadow-soft transition-all duration-300">
                                        <div>
                                            <!-- Course Thumbnail fallback/active -->
                                            <div class="relative aspect-video w-full rounded-2xl overflow-hidden bg-slate-150 mb-4">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('medium_large', ['class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500']); ?>
                                                <?php else: ?>
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                                        <i data-lucide="graduation-cap" class="w-10 h-10"></i>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="absolute top-3 left-3">
                                                    <span
                                                        class="px-2 py-0.5 rounded-full text-[9px] font-bold uppercase tracking-wider border <?php echo $level_class; ?>">
                                                        <?php echo esc_html($level_label); ?>
                                                    </span>
                                                </div>
                                            </div>

                                            <h3
                                                class="font-serif font-bold text-navy text-sm md:text-base group-hover:text-primary transition-colors line-clamp-2 mb-2">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div
                                                class="flex items-center gap-4 text-[10px] md:text-[11px] text-slate-550 font-semibold mb-4">
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="play" class="w-3.5 h-3.5 text-slate-400"></i>
                                                    <?php echo $lessons_count; ?> bài học
                                                </span>
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="clock" class="w-3.5 h-3.5 text-slate-400"></i>
                                                    <?php echo esc_html($duration ? $duration : 'Chưa cập nhật'); ?>
                                                </span>
                                            </div>
                                        </div>

                                        <a href="<?php echo esc_url($first_lesson_url); ?>"
                                            class="w-full py-3 bg-emerald-50 hover:bg-emerald-600 hover:text-white text-emerald-600 rounded-xl font-bold text-xs transition-colors flex items-center justify-center gap-1.5 border border-emerald-100">
                                            Vào học ngay <i data-lucide="circle-play" class="w-4 h-4"></i>
                                        </a>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="text-center py-12 text-slate-500 text-sm">
                                Chưa có khóa học nào được đăng tải trên hệ thống.
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

                <!-- ================= TAB 4: NHẬP MÃ GIỚI THIỆU ================= -->
                <div id="tab-redeem-view" class="hidden transition-opacity duration-300">
                    <h2 class="text-lg font-serif font-bold text-navy mb-6 pb-2 border-b border-slate-100">Nhập mã giới thiệu hoặc kích hoạt</h2>

                    <div
                        class="bg-gradient-to-r from-orange-50/50 via-amber-50/30 to-slate-50 p-6 rounded-3xl border border-orange-100/50 mb-6 flex items-start gap-4">
                        <div
                            class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center shrink-0 border border-orange-200">
                            <i data-lucide="ticket" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h4 class="text-sm font-bold text-navy mb-1">Mã giới thiệu & Kích hoạt học liệu Hieucon</h4>
                            <p class="text-xs text-slate-500 leading-relaxed font-medium">Nhập mã giới thiệu, mã giảm giá hoặc mã kích hoạt học liệu của bạn vào đây để mở khóa nội dung hoặc nhận ưu đãi.</p>
                        </div>
                    </div>

                    <form id="form-redeem-code" onsubmit="handleRedeemCode(event)" class="space-y-5">
                        <div class="space-y-1">
                            <label class="block text-xs font-bold text-navy/70 uppercase tracking-widest pl-1">Nhập mã của bạn (Referral / Redeem Code)</label>
                            <input type="text" id="redeem-code-input" required
                                class="w-full px-4 py-3.5 rounded-xl border border-slate-200 bg-white/50 focus:bg-white focus:ring-2 focus:ring-primary/20 focus:border-primary transition-all text-sm font-mono tracking-wider placeholder:font-sans placeholder:tracking-normal text-center uppercase"
                                placeholder="Ví dụ: FREEALL, GIFT50, HIEUCON-XXXX">
                        </div>

                        <div class="pt-2">
                            <button type="submit" id="btn-redeem-submit"
                                class="px-6 py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-all duration-300 flex items-center gap-2">
                                Kích hoạt ngay <i data-lucide="sparkles" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </form>

                    <?php
                    // Lấy tất cả mã giới thiệu mà hội viên hiện tại đã sử dụng
                    $member_id = intval($current_member->id);
                    $applied_codes_query = new WP_Query([
                        'post_type' => 'referral_code',
                        'posts_per_page' => -1,
                        'post_status' => 'publish',
                    ]);

                    $my_used_codes = [];
                    if ($applied_codes_query->have_posts()) {
                        while ($applied_codes_query->have_posts()) {
                            $applied_codes_query->the_post();
                            $used_by = get_post_meta(get_the_ID(), '_ref_used_by_members', true);
                            if (is_array($used_by) && in_array($member_id, $used_by)) {
                                $type_label = '';
                                $type = get_post_meta(get_the_ID(), '_ref_type', true);
                                $val = get_post_meta(get_the_ID(), '_ref_discount_value', true);
                                if ($type === 'free_all') {
                                    $type_label = 'Miễn phí toàn bộ thư viện';
                                } elseif ($type === 'free_items') {
                                    $type_label = 'Mở khóa miễn phí tài liệu được áp dụng';
                                } elseif ($type === 'discount_percent') {
                                    $type_label = 'Giảm giá ' . $val . '%';
                                } elseif ($type === 'discount_fixed') {
                                    $type_label = 'Giảm giá cố định ' . number_format($val, 0, ',', '.') . 'đ';
                                }

                                $my_used_codes[] = [
                                    'code' => get_the_title(),
                                    'benefit' => $type_label,
                                ];
                            }
                        }
                        wp_reset_postdata();
                    }

                    if (hieucon_member_has_unlocked_all($member_id)) {
                        // Thêm trường hợp nếu có unlock all toàn hệ thống nhưng ko tìm thấy code cụ thể (vẫn show)
                        $has_freeall = false;
                        foreach ($my_used_codes as $c) {
                            if (strpos(strtolower($c['benefit']), 'toàn bộ') !== false) {
                                $has_freeall = true;
                                break;
                            }
                        }
                        if (!$has_freeall) {
                            $my_used_codes[] = [
                                'code' => 'HỆ THỐNG',
                                'benefit' => 'Đã mở khoá toàn bộ thư viện học liệu (Admin cấp)',
                            ];
                        }
                    }

                    if (!empty($my_used_codes)):
                    ?>
                        <div class="mt-8 border-t border-slate-100 pt-6">
                            <h3 class="text-xs font-bold text-navy/70 uppercase tracking-widest mb-4">Mã giới thiệu đang hoạt động trên tài khoản</h3>
                            <div class="space-y-3">
                                <?php foreach ($my_used_codes as $item): ?>
                                    <div class="flex items-center justify-between p-3.5 bg-emerald-50/50 border border-emerald-100 rounded-2xl">
                                        <div class="flex items-center gap-2.5">
                                            <span class="px-2.5 py-1 bg-emerald-600 text-white rounded-lg font-mono text-[10px] font-bold uppercase tracking-wider">
                                                <?php echo esc_html($item['code']); ?>
                                            </span>
                                            <span class="text-xs text-navy/80 font-semibold">
                                                <?php echo esc_html($item['benefit']); ?>
                                            </span>
                                        </div>
                                        <span class="flex items-center gap-1 text-[10px] font-bold text-emerald-600 uppercase tracking-wider shrink-0 bg-emerald-100/60 px-2 py-0.5 rounded-full">
                                            <i data-lucide="check-circle" class="w-3.5 h-3.5"></i> Đang áp dụng
                                        </span>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- ================= TAB 5: EBOOK CỦA TÔI ================= -->
                <div id="tab-ebooks-view" class="transition-opacity duration-300">
                    <h2 class="text-lg font-serif font-bold text-navy mb-6 pb-2 border-b border-slate-100">Cẩm nang của
                        tôi</h2>

                    <?php
                    $enrolled_ebook_ids = hieucon_get_member_enrolled_ebooks($current_member->id);
                    if (!is_array($enrolled_ebook_ids)) {
                        $enrolled_ebook_ids = [];
                    }

                    $is_privileged = in_array($current_member->role, ['administrator', 'teacher', 'expert']) || current_user_can('manage_options');

                    if (empty($enrolled_ebook_ids) && !$is_privileged) {
                        ?>
                        <div class="text-center py-12">
                            <div
                                class="w-16 h-16 bg-slate-50 text-slate-450 rounded-full flex items-center justify-center mx-auto mb-4 border border-slate-100">
                                <i data-lucide="book-open" class="w-8 h-8 text-slate-400"></i>
                            </div>
                            <p class="text-slate-550 font-medium mb-6 text-sm">Bạn chưa sở hữu tài liệu nào trên hệ thống.
                            </p>
                            <a href="<?php echo esc_url(get_post_type_archive_link('ebook')); ?>"
                                class="inline-flex items-center gap-2 px-6 py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-colors">
                                Khám phá thư viện tài liệu <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>
                        <?php
                    } else {
                        // Query the enrolled ebooks
                        $query_args = [
                            'post_type' => 'ebook',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                        ];
                        if (!$is_privileged) {
                            $query_args['post__in'] = $enrolled_ebook_ids;
                        }

                        $my_ebooks_query = new WP_Query($query_args);

                        if ($my_ebooks_query->have_posts()) {
                            ?>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                                <?php while ($my_ebooks_query->have_posts()):
                                    $my_ebooks_query->the_post();
                                    $pdf_url = get_post_meta(get_the_ID(), '_ebook_pdf_url', true);
                                    $ebook_pages = get_post_meta(get_the_ID(), '_ebook_pages', true);

                                    $ebook_pages = !empty($ebook_pages) ? intval($ebook_pages) : 0;
                                    $read_url = get_permalink();
                                    ?>
                                    <div
                                        class="bg-white/50 border border-slate-100 rounded-3xl p-4 flex flex-col justify-between group hover:bg-white hover:shadow-soft transition-all duration-300">
                                        <div>
                                            <!-- Ebook Thumbnail -->
                                            <div
                                                class="relative w-28 mx-auto aspect-[3/4] rounded-2xl overflow-hidden bg-slate-150 mb-4 shadow-sm group-hover:scale-103 transition-transform duration-300">
                                                <?php if (has_post_thumbnail()): ?>
                                                    <?php the_post_thumbnail('medium', ['class' => 'w-full h-full object-cover']); ?>
                                                <?php else: ?>
                                                    <div
                                                        class="w-full h-full flex items-center justify-center text-slate-400 bg-slate-100">
                                                        <i data-lucide="book-open" class="w-8 h-8"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                            <h3
                                                class="font-serif font-bold text-navy text-sm md:text-base group-hover:text-primary transition-colors text-center line-clamp-2 mb-2">
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h3>

                                            <div
                                                class="flex items-center justify-center gap-4 text-[10px] md:text-[11px] text-slate-550 font-semibold mb-4">
                                                <span class="flex items-center gap-1">
                                                    <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-400"></i>
                                                    <?php echo $ebook_pages ? $ebook_pages . ' trang' : 'Đang cập nhật'; ?>
                                                </span>
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <?php if (!empty($pdf_url)): ?>
                                                <a href="<?php echo esc_url($pdf_url); ?>" target="_blank"
                                                    class="w-full py-3 bg-emerald-600 hover:bg-emerald-550 text-white rounded-xl font-bold text-xs transition-all flex items-center justify-center gap-1.5 shadow-sm border-0">
                                                    Đọc Toàn Bộ (PDF) <i data-lucide="external-link" class="w-4 h-4"></i>
                                                </a>
                                                <a href="<?php echo esc_url($read_url); ?>"
                                                    class="w-full py-2 bg-slate-50 hover:bg-slate-100 text-slate-550 rounded-xl font-bold text-[10px] transition-colors flex items-center justify-center gap-1.5 border border-slate-150">
                                                    Xem Chi Tiết <i data-lucide="info" class="w-3.5 h-3.5"></i>
                                                </a>
                                            <?php else: ?>
                                                <a href="<?php echo esc_url($read_url); ?>"
                                                    class="w-full py-3 bg-amber-500 hover:bg-amber-600 text-white rounded-xl font-bold text-xs transition-colors flex items-center justify-center gap-1.5 border-0">
                                                    Xem Chi Tiết Tài Liệu <i data-lucide="book-open" class="w-4 h-4"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                <?php endwhile;
                                wp_reset_postdata(); ?>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="text-center py-12 text-slate-500 text-sm">
                                Chưa có tài liệu nào được tìm thấy trên tài khoản của bạn.
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>

            </div>
        </div>
    </div>
</main>

<!-- ================= POPUP MODAL NHẬP MÃ OTP BẢO MẬT 2 LỚP ================= -->
<div id="otp-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
    <!-- Overlay nền xám -->
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeOTPModal()"></div>

    <!-- Hộp thoại Modal -->
    <div
        class="bg-white/95 backdrop-blur-xl border border-white max-w-[450px] w-full mx-4 rounded-3xl p-6 md:p-8 relative z-10 shadow-2xl animate-fade-in">

        <button type="button" onclick="closeOTPModal()"
            class="absolute top-4 right-4 text-navy/40 hover:text-navy transition-colors">
            <i data-lucide="x" class="w-5 h-5"></i>
        </button>

        <div class="text-center">
            <div
                class="w-12 h-12 bg-orange-50 text-secondary rounded-full flex items-center justify-center mx-auto mb-4 border border-orange-100">
                <i data-lucide="mail-check" class="w-6 h-6"></i>
            </div>

            <h3 class="text-lg font-serif font-bold text-navy">Xác thực OTP Bảo mật</h3>
            <p class="text-navy/60 text-xs md:text-sm mt-2 font-medium">Để bảo vệ thông tin tài khoản, chúng tôi đã gửi
                1 mã xác thực OTP gồm 6 chữ số về Email của bạn. Hãy kiểm tra hộp thư.</p>
        </div>

        <div id="modal-alert" class="hidden my-4 p-3 rounded-xl text-xs font-semibold text-center"></div>

        <form id="form-otp-verification" onsubmit="submitOTPVerifiedData(event)" class="mt-6 space-y-4">
            <div class="space-y-1">
                <label class="block text-xs font-bold text-navy/70 text-center uppercase tracking-widest">Mã OTP (6 chữ
                    số)</label>
                <input type="text" id="modal-otp-input" maxlength="6" required
                    class="w-full px-4 py-3.5 rounded-xl border border-slate-200 text-center tracking-[1em] text-lg font-bold focus:ring-2 focus:ring-primary/20 focus:border-primary bg-slate-50 focus:bg-white transition-all"
                    placeholder="000000">
            </div>

            <!-- Turnstile xác thực riêng trong Modal để đảm bảo tính an toàn chống bypass -->
            <?php if (!empty($turnstile_sitekey)): ?>
                <div class="cf-turnstile flex justify-center" id="modal-turnstile-container"
                    data-sitekey="<?php echo esc_attr($turnstile_sitekey); ?>" data-theme="light"></div>
            <?php endif; ?>

            <button type="submit" id="btn-modal-confirm"
                class="w-full py-3.5 bg-navy hover:bg-navy/90 text-white rounded-xl font-bold text-xs shadow-md transition-colors flex items-center justify-center gap-2">
                Xác nhận & Hoàn tất <i data-lucide="shield-check" class="w-4 h-4"></i>
            </button>
        </form>
    </div>
</div>

<script>
    const ajaxUrl = '<?php echo esc_url(admin_url('admin-ajax.php')); ?>';
    let pendingAction = ''; // 'profile' hoặc 'password'

    // --- CHUYỂN TABS SIDEBAR ---
    function switchAccountTab(tab) {
        const tabs = ['profile', 'password', 'courses', 'redeem', 'ebooks'];

        hideAccountAlert();

        tabs.forEach(t => {
            const view = document.getElementById(`tab-${t}-view`);
            const btn = document.getElementById(`menu-${t}-btn`);
            if (!view || !btn) return;

            if (t === tab) {
                view.classList.remove('hidden');
                btn.className = "w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy bg-white shadow-soft border border-white flex items-center gap-2";
            } else {
                view.classList.add('hidden');
                btn.className = "w-full text-left px-5 py-3.5 rounded-2xl text-sm font-bold transition-all text-navy/60 hover:text-navy hover:bg-white/50 flex items-center gap-2";
            }
        });

        if (window.turnstile) {
            window.turnstile.reset();
        }
    }

    // --- AJAX KÍCH HOẠT MÃ KHÓA HỌC / MÃ GIỚI THIỆU ---
    async function handleRedeemCode(event) {
        event.preventDefault();

        const input = document.getElementById('redeem-code-input');
        const submitBtn = document.getElementById('btn-redeem-submit');
        const codeVal = input.value.trim();

        if (!codeVal) {
            showAccountAlert('Vui lòng nhập mã kích hoạt.');
            return;
        }

        hideAccountAlert();
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Đang kích hoạt... <i data-lucide="loader" class="w-4 h-4 animate-spin"></i>';
        lucide.createIcons();

        // 1. Try applying as a referral code first
        const refFormData = new FormData();
        refFormData.append('action', 'hieucon_apply_referral_code');
        refFormData.append('code', codeVal);
        refFormData.append('nonce', '<?php echo wp_create_nonce("hieucon_ref_nonce"); ?>');
        refFormData.append('post_id', '0');

        try {
            const refRes = await fetch(ajaxUrl, { method: 'POST', body: refFormData });
            const refData = await refRes.json();

            if (refData.success) {
                showAccountAlert(refData.data.message, 'success');
                input.value = '';
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Kích hoạt ngay <i data-lucide="sparkles" class="w-4 h-4"></i>';
                lucide.createIcons();

                if (refData.data.action === 'reload') {
                    setTimeout(() => window.location.reload(), 2000);
                }
                return;
            }
        } catch (e) {
            console.error('Error verifying referral code:', e);
        }

        // 2. If not a valid referral code, fallback to traditional course code activation
        const formData = new FormData();
        formData.append('action', 'hieucon_redeem_course_code');
        formData.append('code', codeVal);
        formData.append('nonce', '<?php echo esc_attr($account_nonce); ?>');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                showAccountAlert(data.data.message, 'success');
                input.value = '';

                // Redirect user to their course page after 2 seconds
                if (data.data.redirect_url) {
                    setTimeout(() => {
                        window.location.href = data.data.redirect_url;
                    }, 2000);
                } else {
                    setTimeout(() => window.location.reload(), 2000);
                }
            } else {
                showAccountAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Kích hoạt ngay <i data-lucide="sparkles" class="w-4 h-4"></i>';
                lucide.createIcons();
            }
        } catch (e) {
            showAccountAlert('Lỗi kết nối khi gửi yêu cầu kích hoạt.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Kích hoạt ngay <i data-lucide="sparkles" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- HIỂN THỊ THÔNG BÁO ---
    function showAccountAlert(message, type = 'error') {
        const alert = document.getElementById('account-alert');
        alert.innerHTML = message;
        alert.classList.remove('hidden', 'bg-red-50', 'text-red-600', 'border-red-200', 'bg-green-50', 'text-green-600', 'border-green-200');

        if (type === 'error') {
            alert.classList.add('bg-red-50', 'text-red-600', 'border', 'border-red-200');
        } else {
            alert.classList.add('bg-green-50', 'text-green-600', 'border', 'border-green-200');
        }

        alert.classList.remove('scale-95', 'opacity-0');
        alert.classList.add('scale-100', 'opacity-100');
    }

    function hideAccountAlert() {
        const alert = document.getElementById('account-alert');
        alert.classList.add('scale-95', 'opacity-0');
        alert.classList.remove('scale-100', 'opacity-100');
        setTimeout(() => alert.classList.add('hidden'), 300);
    }

    // --- MODAL ALERT ---
    function showModalAlert(message, type = 'error') {
        const alert = document.getElementById('modal-alert');
        alert.innerHTML = message;
        alert.classList.remove('hidden', 'bg-red-50', 'text-red-600', 'bg-green-50', 'text-green-600');
        if (type === 'error') {
            alert.classList.add('bg-red-50', 'text-red-600');
        } else {
            alert.classList.add('bg-green-50', 'text-green-600');
        }
        alert.classList.remove('hidden');
    }

    // --- BẬT/TẮT MODAL ---
    function openOTPModal() {
        document.getElementById('otp-modal').classList.remove('hidden');
        document.getElementById('modal-otp-input').focus();
        if (window.turnstile) {
            window.turnstile.reset();
        }
    }

    function closeOTPModal() {
        document.getElementById('otp-modal').classList.add('hidden');
        document.getElementById('modal-otp-input').value = '';
        document.getElementById('modal-alert').classList.add('hidden');
        pendingAction = '';
    }

    // --- LẤY TOKEN TURNSTILE ---
    function getTurnstileToken(form) {
        if (!window.turnstile) return '';
        const response = form.querySelector('[name="cf-turnstile-response"]');
        return response ? response.value : '';
    }

    // --- BƯỚC 1: YÊU CẦU OTP KHI SỬA THÔNG TIN CÁ NHÂN ---
    async function triggerProfileUpdateOTP(event) {
        event.preventDefault();
        const form = document.getElementById('form-profile-update');
        const submitBtn = form.querySelector('button[type="submit"]');

        hideAccountAlert();
        submitBtn.disabled = true;
        submitBtn.innerText = 'Đang kiểm tra...';

        const captchaToken = getTurnstileToken(form);
        const formData = new FormData();
        formData.append('action', 'hieucon_send_otp_update');
        formData.append('captcha_token', captchaToken);
        formData.append('nonce', '<?php echo esc_attr($account_nonce); ?>');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                pendingAction = 'profile';
                openOTPModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Lưu thay đổi <i data-lucide="check" class="w-4 h-4"></i>';
                lucide.createIcons();
            } else {
                showAccountAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Lưu thay đổi <i data-lucide="check" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAccountAlert('Lỗi hệ thống khi yêu cầu xác thực OTP.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Lưu thay đổi <i data-lucide="check" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- BƯỚC 1: YÊU CẦU OTP KHI ĐỔI MẬT KHẨU ---
    async function triggerPasswordUpdateOTP(event) {
        event.preventDefault();

        const password = document.getElementById('new-password').value;
        const confirm = document.getElementById('confirm-password').value;
        const form = document.getElementById('form-password-update');
        const submitBtn = form.querySelector('button[type="submit"]');

        hideAccountAlert();

        if (password !== confirm) {
            showAccountAlert('Xác nhận mật khẩu mới không khớp.');
            return;
        }

        if (password.length < 8) {
            showAccountAlert('Mật khẩu mới phải dài tối thiểu 8 ký tự.');
            return;
        }

        submitBtn.disabled = true;
        submitBtn.innerText = 'Đang kiểm tra...';

        const captchaToken = getTurnstileToken(form);
        const formData = new FormData();
        formData.append('action', 'hieucon_send_otp_update');
        formData.append('captcha_token', captchaToken);
        formData.append('nonce', '<?php echo esc_attr($account_nonce); ?>');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();

            if (data.success) {
                pendingAction = 'password';
                openOTPModal();
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Đổi mật khẩu <i data-lucide="lock" class="w-4 h-4"></i>';
                lucide.createIcons();
            } else {
                showAccountAlert(data.data.message);
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Đổi mật khẩu <i data-lucide="lock" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showAccountAlert('Lỗi hệ thống kết nối.');
            submitBtn.disabled = false;
            submitBtn.innerHTML = 'Đổi mật khẩu <i data-lucide="lock" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- BƯỚC 2: XÁC NHẬN OTP & LƯU THAY ĐỔI CUỐI CÙNG ---
    async function submitOTPVerifiedData(event) {
        event.preventDefault();

        const modalForm = document.getElementById('form-otp-verification');
        const confirmBtn = document.getElementById('btn-modal-confirm');
        const otpVal = document.getElementById('modal-otp-input').value.trim();

        if (otpVal.length !== 6) {
            showModalAlert('Mã OTP phải có độ dài đúng 6 số.');
            return;
        }

        confirmBtn.disabled = true;
        confirmBtn.innerHTML = 'Đang cập nhật... <i data-lucide="loader" class="w-4 h-4 animate-spin"></i>';
        lucide.createIcons();
        document.getElementById('modal-alert').classList.add('hidden');

        // Trích xuất Token captcha riêng từ Modal Turnstile
        const modalCaptchaToken = getTurnstileToken(modalForm);

        let finalFormData = new FormData();
        finalFormData.append('otp', otpVal);
        finalFormData.append('captcha_token', modalCaptchaToken);
        finalFormData.append('nonce', '<?php echo esc_attr($account_nonce); ?>');

        if (pendingAction === 'profile') {
            const profileForm = document.getElementById('form-profile-update');
            finalFormData.append('action', 'hieucon_update_profile_info');
            finalFormData.append('full_name', profileForm.querySelector('[name="full_name"]').value);
            finalFormData.append('phone_number', profileForm.querySelector('[name="phone_number"]').value);
            finalFormData.append('date_of_birth', profileForm.querySelector('[name="date_of_birth"]').value);
        } else if (pendingAction === 'password') {
            const passwordForm = document.getElementById('form-password-update');
            finalFormData.append('action', 'hieucon_update_member_password');
            finalFormData.append('password', passwordForm.querySelector('[name="password"]').value);
        }

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: finalFormData });
            const data = await res.json();

            if (data.success) {
                closeOTPModal();
                showAccountAlert(data.data.message, 'success');

                // Reload trang sau 1.5 giây để cập nhật lại thông tin mới
                setTimeout(() => window.location.reload(), 1500);
            } else {
                showModalAlert(data.data.message);
                confirmBtn.disabled = false;
                confirmBtn.innerHTML = 'Xác nhận & Hoàn tất <i data-lucide="shield-check" class="w-4 h-4"></i>';
                lucide.createIcons();
                if (window.turnstile) window.turnstile.reset();
            }
        } catch (e) {
            showModalAlert('Lỗi xử lý lưu dữ liệu.');
            confirmBtn.disabled = false;
            confirmBtn.innerHTML = 'Xác nhận & Hoàn tất <i data-lucide="shield-check" class="w-4 h-4"></i>';
            lucide.createIcons();
        }
    }

    // --- THAO TÁC ĐĂNG XUẤT ---
    async function handleLogout() {
        if (!confirm('Bạn có muốn đăng xuất khỏi hệ thống không?')) return;

        const formData = new FormData();
        formData.append('action', 'hieucon_logout_member');

        try {
            const res = await fetch(ajaxUrl, { method: 'POST', body: formData });
            const data = await res.json();
            if (data.success) {
                window.location.href = '<?php echo esc_url(home_url("/dang-nhap/")); ?>';
            }
        } catch (e) {
            alert('Lỗi khi thực hiện đăng xuất.');
        }
    }
</script>

<?php
get_footer();
