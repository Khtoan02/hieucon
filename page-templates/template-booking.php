<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 phút để nhìn rõ vấn đề của con" — Bố cục 1 màn hình cân đối 50/50, đăng ký xong chuyển thẳng qua Zalo.
 *
 * @package Hieucon
 */

if ( isset( $_GET['step'] ) && 'survey' === sanitize_key( wp_unslash( $_GET['step'] ) ) ) {
    $redir_id   = isset( $_GET['booking_id'] ) ? intval( $_GET['booking_id'] ) : 0;
    $redir_code = isset( $_GET['code'] ) ? sanitize_text_field( wp_unslash( $_GET['code'] ) ) : '';
    if ( function_exists( 'hieucon_get_booking_survey_url' ) && ( $redir_id > 0 || ! empty( $redir_code ) ) ) {
        wp_safe_redirect( hieucon_get_booking_survey_url( $redir_id, $redir_code ) );
        exit;
    }
    wp_safe_redirect( home_url( '/dat-lich-tu-van/' ) );
    exit;
}

get_header();

$current_member  = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_name    = $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '';
$prefill_phone   = $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '';
$booking_nonce   = wp_create_nonce( 'hieucon_booking_nonce' );
$zalo_target_url = get_option( 'hieucon_link_zalo_tuvan', home_url( '/zalo' ) );

// Tự động tính toán tuần thứ bao nhiêu trong năm và ngày Thứ 2 -> Thứ 7 của tuần hiện tại
$tz_now        = new DateTimeImmutable( 'now', wp_timezone() );
$day_of_week   = (int) $tz_now->format( 'N' ); // 1 (Thứ 2) -> 7 (Chủ nhật)
$monday_date   = $tz_now->modify( '-' . ( $day_of_week - 1 ) . ' days' );
$saturday_date = $monday_date->modify( '+5 days' );
$week_label    = sprintf( 'Tuần %s/%s', $tz_now->format( 'W' ), $tz_now->format( 'o' ) );
$week_range    = sprintf( '%s - %s', $monday_date->format( 'd/m' ), $saturday_date->format( 'd/m/Y' ) );
?>

<style>
    /* Nền trắng chủ đạo, chỉ dùng Xanh than (#0A1931) & Cam (#f97316) */
    #primary.hc-booking-page {
        background: #ffffff !important;
        color: #0A1931;
        padding-top: 76px !important;
    }
    @media (min-width: 1024px) {
        #primary.hc-booking-page {
            padding-top: 86px !important;
        }
    }

    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 24px 54px -24px rgba(10, 25, 49, 0.10);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #0A1931 0%, #f97316 100%);
    }

    /* Typography chống dính dấu tiếng Việt tuyệt đối (không bị Tailwind sm:text-* ghi đè line-height) */
    .hc-hero-title {
        line-height: 1.26 !important;
    }
    .hc-hero-lead {
        line-height: 1.8 !important;
    }
    .hc-focus-heading {
        line-height: 1.6 !important;
    }
    .hc-focus-list li {
        line-height: 1.72 !important;
    }

    /* Multi-select Issue Chips ("Trẻ đang gặp vấn đề gì?") */
    .hc-issue-chip {
        display: flex;
        align-items: center;
        gap: 8px;
        min-height: 44px;
        padding: 9px 12px;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        color: #0A1931;
        font-size: 13.5px;
        font-weight: 600;
        text-align: left;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    @media (min-width: 640px) {
        .hc-issue-chip {
            gap: 10px;
            padding: 10px 14px;
            font-size: 14px;
        }
    }
    .hc-issue-chip:hover {
        border-color: #fdba74;
        background: #fffaf5;
    }
    .hc-issue-chip .hc-chip-box {
        width: 19px;
        height: 19px;
        border-radius: 6px;
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.18s ease;
        color: transparent;
    }
    .hc-issue-chip.is-selected {
        background: #fff7ed !important;
        border-color: #f97316 !important;
        color: #0A1931 !important;
        box-shadow: 0 6px 16px -8px rgba(249, 115, 22, 0.32);
    }
    .hc-issue-chip.is-selected .hc-chip-box {
        background: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }

    /* 4-Column Symmetrical Time Slot Cards */
    .hc-time-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 4px;
        min-height: 54px;
        padding: 10px 8px;
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        text-align: center;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
        -webkit-tap-highlight-color: transparent;
    }
    .hc-time-card:hover {
        border-color: #94a3b8;
        background: #ffffff;
    }
    .hc-time-card .hc-time-head {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        font-size: 13.5px;
        font-weight: 700;
        color: #0A1931;
        line-height: 1.2;
    }
    .hc-time-card .hc-time-icon {
        color: #f97316;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: all 0.18s ease;
    }
    .hc-time-card .hc-time-sub {
        display: block;
        font-size: 11.5px;
        font-weight: 600;
        color: #64748b;
        line-height: 1.2;
    }
    .hc-time-card.is-active {
        background: #0A1931 !important;
        border-color: #0A1931 !important;
        box-shadow: 0 10px 22px -8px rgba(10, 25, 49, 0.32);
    }
    .hc-time-card.is-active .hc-time-head {
        color: #ffffff;
    }
    .hc-time-card.is-active .hc-time-icon {
        color: #f97316;
    }
    .hc-time-card.is-active .hc-time-sub {
        color: #fdba74;
    }
</style>

<main id="primary" class="site-main hc-booking-page">

    <!-- =========================================================
         SECTION DUY NHẤT: CÂN ĐỐI TÂM THỊ GIÁC & TỐI ƯU MOBILE CHO PHỤ HUYNH
         ========================================================= -->
    <section id="dang-ky-case" class="min-h-[calc(100vh-86px)] flex items-center pt-3 pb-12 md:pt-6 md:pb-20 lg:pt-6 lg:pb-24 bg-white">
        <div class="max-w-[1280px] w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-7 sm:gap-10 lg:gap-12 xl:gap-14 items-center">

                <!-- Cột trái (6/12): Thông điệp mở đầu thoáng đãng, phân tách rõ từng ý -->
                <div class="lg:col-span-6">
                    <div class="mb-5 sm:mb-6">
                        <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-secondary text-white font-sans font-extrabold text-xs sm:text-sm uppercase tracking-wider shadow-sm mb-3">
                            CHƯƠNG TRÌNH
                        </span>
                        <h1 class="hc-hero-title font-serif text-[2rem] sm:text-4xl xl:text-[2.85rem] font-bold text-navy uppercase tracking-tight mb-2.5">
                            CÙNG MẸ HIỂU CON
                        </h1>
                        <p class="inline-block bg-[#fff7ed] border border-orange-200/90 text-secondary font-serif font-bold text-[1.15rem] sm:text-[1.4rem] px-4 py-1.5 rounded-xl">
                            Hiểu hơn về hệ tiêu hoá của con.
                        </p>
                    </div>

                    <p class="hc-hero-lead text-slate-700 text-[15.5px] sm:text-[17px] mb-4 sm:mb-5">
                        <strong class="text-navy">Hiểu con từ Gốc</strong> cùng ba mẹ tìm hiểu những khó khăn về tiêu hóa của con, từ đó định hướng chăm sóc phù hợp với từng trẻ.
                    </p>

                    <!-- Thanh thông tin tuần & ngày tháng (Tự động tính tuần & ngày trong tuần) -->
                    <div class="bg-[#fff7ed]/70 border border-orange-200/90 rounded-2xl p-3.5 sm:px-5 sm:py-3.5 mb-5 sm:mb-6 shadow-[0_10px_24px_-14px_rgba(249,115,22,0.18)] grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-orange-200/80 gap-3 sm:gap-0 items-center">
                        <!-- Cột 1: Tuần 45/2026 -->
                        <div class="flex items-center gap-3 sm:pr-4">
                            <span class="w-9 h-9 rounded-xl bg-white border border-orange-200 text-secondary flex items-center justify-center shrink-0 shadow-xs">
                                <i data-lucide="calendar-days" class="w-4.5 h-4.5"></i>
                            </span>
                            <strong id="hc-auto-week-num" class="block font-sans font-extrabold text-[15px] sm:text-[16px] text-navy leading-snug"><?php echo esc_html( $week_label ); ?></strong>
                        </div>

                        <!-- Cột 2: Ngày tháng trong tuần -->
                        <div class="flex items-center gap-3 pt-3 sm:pt-0 sm:px-4">
                            <span class="w-9 h-9 rounded-xl bg-white border border-orange-200 text-navy flex items-center justify-center shrink-0 shadow-xs">
                                <i data-lucide="calendar-range" class="w-4.5 h-4.5"></i>
                            </span>
                            <strong id="hc-auto-week-range" class="block font-sans font-extrabold text-[14.5px] sm:text-[15.5px] text-navy leading-snug tabular-nums"><?php echo esc_html( $week_range ); ?></strong>
                        </div>

                        <!-- Cột 3: 05 gia đình con từ 2-7 tuổi -->
                        <div class="flex items-center gap-3 pt-3 sm:pt-0 sm:pl-4">
                            <span class="w-9 h-9 rounded-xl bg-white border border-orange-200 text-secondary flex items-center justify-center shrink-0 shadow-xs">
                                <i data-lucide="users" class="w-4.5 h-4.5"></i>
                            </span>
                            <div>
                                <strong class="block font-sans font-extrabold text-[15px] sm:text-[15.5px] text-navy leading-tight">05 gia đình</strong>
                                <span class="block text-[12px] font-semibold text-slate-600 leading-snug mt-0.5">Con từ 2–7 tuổi</span>
                            </div>
                        </div>
                    </div>

                    <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-5 sm:p-7">
                        <p class="hc-focus-heading font-bold text-navy text-[15.5px] sm:text-[17px] mb-4 sm:mb-5">
                            Buổi tư vấn có thời gian 30 phút để ba mẹ hiểu và tìm ra các vấn đề:
                        </p>
                        <ul class="hc-focus-list divide-y divide-orange-200/60 text-slate-700 text-[14.5px] sm:text-[15.5px]">
                            <li class="flex items-start gap-3.5 pb-3.5">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">1</span>
                                <span><strong class="text-navy font-bold">Nguyên nhân gốc rễ khiến con gặp các vấn đề về tiêu hóa:</strong> kén ăn, dị ứng, bất dung nạp thực phẩm, táo bón, rối loạn tiêu hóa, chậm tăng trưởng,...</span>
                            </li>
                            <li class="flex items-start gap-3.5 py-3.5">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">2</span>
                                <span><strong class="text-navy font-bold">Các vấn đề hệ tiêu hóa ảnh hưởng như thế nào</strong> đến sức khỏe não bộ, hành vi của con?</span>
                            </li>
                            <li class="flex items-start gap-3.5 py-3.5">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">3</span>
                                <span><strong class="text-navy font-bold">Giải pháp từng bước</strong> để cải thiện các vấn đề tiêu hóa của trẻ</span>
                            </li>
                            <li class="flex items-start gap-3.5 pt-3.5">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">4</span>
                                <span><strong class="text-navy font-bold">Dinh dưỡng giúp nuôi dưỡng sức khỏe tiêu hóa và não bộ</strong> - nền tảng giúp con cải thiện các vấn đề hành vi, đạt hiệu quả can thiệp</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cột phải (6/12): Form đăng ký cân xứng chiều cao với cột trái -->
                <div class="lg:col-span-6">
                    <div id="booking-card-wrapper" class="hc-master-card relative scroll-mt-24">
                        <div class="hc-card-bar"></div>

                        <div id="booking-step1-container" class="p-5 sm:p-8 lg:p-9">
                            <div class="mb-5 sm:mb-6">
                                <h2 class="font-serif text-[1.4rem] sm:text-[1.7rem] font-bold text-navy leading-snug">
                                    Thông tin liên hệ của ba mẹ
                                </h2>
                                <p class="text-slate-500 text-xs sm:text-sm mt-1.5 leading-relaxed">
                                    Ba mẹ điền thông tin và chọn vấn đề của con để kết nối qua Zalo.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-5" novalidate>
                                <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                                <!-- 1. Họ và tên + SĐT/Zalo (font 16px trên mobile tránh iOS tự zoom) -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 sm:gap-3.5">
                                    <div>
                                        <label for="booking-parent-name" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                            Họ và tên ba/mẹ <span class="text-secondary">*</span>
                                        </label>
                                        <input
                                            type="text"
                                            id="booking-parent-name"
                                            name="parent_name"
                                            autocomplete="name"
                                            value="<?php echo esc_attr( $prefill_name ); ?>"
                                            required
                                            placeholder="VD: Mẹ Nguyễn Thu Hà"
                                            class="w-full px-3.5 py-3 sm:py-2.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-base sm:text-sm transition-all"
                                        >
                                    </div>

                                    <div>
                                        <label for="booking-phone" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                            Số điện thoại / Zalo <span class="text-secondary">*</span>
                                        </label>
                                        <input
                                            type="tel"
                                            inputmode="tel"
                                            autocomplete="tel"
                                            id="booking-phone"
                                            name="phone"
                                            value="<?php echo esc_attr( $prefill_phone ); ?>"
                                            required
                                            placeholder="Nhập SĐT có dùng Zalo..."
                                            class="w-full px-3.5 py-3 sm:py-2.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-base sm:text-sm transition-all"
                                        >
                                    </div>
                                </div>

                                <!-- 2. Trẻ đang gặp vấn đề gì? (Lưới 2 cột gọn gàng cả trên Mobile & Desktop) -->
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        <label class="block text-xs sm:text-sm font-bold text-navy">
                                            Trẻ đang gặp vấn đề gì? <span class="text-secondary">*</span>
                                        </label>
                                        <span class="text-[11px] font-semibold text-slate-400">Chọn 1 hoặc nhiều</span>
                                    </div>

                                    <div class="grid grid-cols-2 gap-2" id="child-issues-group">
                                        <?php
                                        $issue_options = [
                                            [ 'label' => 'Kén Ăn', 'span' => '' ],
                                            [ 'label' => 'Táo bón', 'span' => '' ],
                                            [ 'label' => 'Bất dung nạp', 'span' => '' ],
                                            [ 'label' => 'Suy dinh dưỡng', 'span' => '' ],
                                            [ 'label' => 'Thiếu hụt vi chất và dinh dưỡng', 'span' => 'col-span-2' ],
                                        ];
                                        foreach ( $issue_options as $opt ) :
                                        ?>
                                            <button
                                                type="button"
                                                data-issue="<?php echo esc_attr( $opt['label'] ); ?>"
                                                class="hc-issue-chip <?php echo esc_attr( $opt['span'] ); ?>"
                                            >
                                                <span class="hc-chip-box">
                                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                </span>
                                                <span class="leading-snug"><?php echo esc_html( $opt['label'] ); ?></span>
                                            </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- 3. Khung giờ thuận tiện trao đổi (3 ô cân đối trên 1 hàng cả Mobile & Desktop) -->
                                <div>
                                    <label class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                        Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                    </label>

                                    <div class="grid grid-cols-3 gap-2 sm:gap-2.5" id="time-slot-group">
                                        <button type="button" data-slot="Buổi sáng (11:00 - 11:30)" class="hc-time-card is-active">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="sunrise" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi sáng</span>
                                            </span>
                                            <span class="hc-time-sub">11:00 – 11:30</span>
                                        </button>

                                        <button type="button" data-slot="Buổi chiều (16:00 - 16:30)" class="hc-time-card">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="sunset" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi chiều</span>
                                            </span>
                                            <span class="hc-time-sub">16:00 – 16:30</span>
                                        </button>

                                        <button type="button" data-slot="Buổi tối (19:30 - 21:30)" class="hc-time-card">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="moon" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi tối</span>
                                            </span>
                                            <span class="hc-time-sub">19:30 – 21:30</span>
                                        </button>
                                    </div>

                                    <input type="hidden" id="booking-preferred-time" name="preferred_time" value="Buổi sáng (11:00 - 11:30)">
                                </div>

                                <div id="booking-step1-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3"></div>

                                <button
                                    type="submit"
                                    id="booking-step1-btn"
                                    class="w-full py-3.5 px-6 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base uppercase tracking-wider shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span>ĐĂNG KÝ</span>
                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const zaloTargetUrl = '<?php echo esc_url( $zalo_target_url ); ?>';
    const nonceVal = document.getElementById('booking-nonce') ? document.getElementById('booking-nonce').value : '';

    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.75 });
    }

    // 0. Tự động đồng bộ Tuần trong năm & ngày Thứ 2 -> Thứ 7 theo thời gian thực (chống lưu cache trang)
    const elWeekNum   = document.getElementById('hc-auto-week-num');
    const elWeekRange = document.getElementById('hc-auto-week-range');
    if (elWeekNum && elWeekRange) {
        const now = new Date();
        const day = now.getDay(); // 0 (CN) -> 6 (Thứ 7)
        const diffToMon = day === 0 ? -6 : 1 - day;
        const mon = new Date(now.getFullYear(), now.getMonth(), now.getDate() + diffToMon);
        const sat = new Date(mon.getFullYear(), mon.getMonth(), mon.getDate() + 5);

        const utcTarget = new Date(Date.UTC(now.getFullYear(), now.getMonth(), now.getDate()));
        const dayNr = (utcTarget.getUTCDay() + 6) % 7;
        utcTarget.setUTCDate(utcTarget.getUTCDate() - dayNr + 3);
        const firstThursday = utcTarget.valueOf();
        const isoYear = utcTarget.getUTCFullYear();
        utcTarget.setUTCMonth(0, 1);
        if (utcTarget.getUTCDay() !== 4) {
            utcTarget.setUTCMonth(0, 1 + (((4 - utcTarget.getUTCDay()) + 7) % 7));
        }
        const weekNo = 1 + Math.ceil((firstThursday - utcTarget) / 604800000);
        const pad2 = n => String(n).padStart(2, '0');

        elWeekNum.textContent   = 'Tuần ' + pad2(weekNo) + '/' + isoYear;
        elWeekRange.textContent = pad2(mon.getDate()) + '/' + pad2(mon.getMonth() + 1) + ' - ' + pad2(sat.getDate()) + '/' + pad2(sat.getMonth() + 1) + '/' + sat.getFullYear();
    }

    // 1. Chọn 1 hoặc nhiều vấn đề của trẻ ("Trẻ đang gặp vấn đề gì?")
    const issueChips = document.querySelectorAll('.hc-issue-chip');
    issueChips.forEach(chip => {
        chip.addEventListener('click', () => {
            chip.classList.toggle('is-selected');
        });
    });

    // 2. Chọn khung giờ thuận tiện (4 ô cân đối)
    const timeCards = document.querySelectorAll('.hc-time-card');
    const timeInput = document.getElementById('booking-preferred-time');

    timeCards.forEach(card => {
        card.addEventListener('click', () => {
            timeCards.forEach(c => c.classList.remove('is-active'));
            card.classList.add('is-active');
            timeInput.value = card.getAttribute('data-slot');
        });
    });

    // 3. Submit Form -> Gửi ngầm & nhảy qua Zalo ngay lập tức (0ms)
    const step1Form = document.getElementById('hieucon-booking-step1-form');
    const step1Error = document.getElementById('booking-step1-error');
    const submitBtn = document.getElementById('booking-step1-btn');

    if (step1Form) {
        step1Form.addEventListener('submit', function (e) {
            e.preventDefault();
            step1Error.classList.add('hidden');

            const parentName = document.getElementById('booking-parent-name').value.trim();
            const phone = document.getElementById('booking-phone').value.trim();
            const preferredTime = timeInput.value.trim() || 'Buổi sáng (11:00 - 11:30)';

            const selectedIssues = [];
            issueChips.forEach(chip => {
                if (chip.classList.contains('is-selected')) {
                    selectedIssues.push(chip.getAttribute('data-issue'));
                }
            });

            if (!parentName || !phone) {
                step1Error.textContent = 'Vui lòng nhập đầy đủ họ tên và số điện thoại/Zalo của ba/mẹ.';
                step1Error.classList.remove('hidden');
                return;
            }

            const cleanPhone = phone.replace(/[^0-9+]/g, '');
            if (cleanPhone.length < 9 || cleanPhone.length > 15) {
                step1Error.textContent = 'Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.';
                step1Error.classList.remove('hidden');
                return;
            }

            if (selectedIssues.length === 0) {
                step1Error.textContent = 'Ba/mẹ vui lòng chọn ít nhất 1 vấn đề trẻ đang gặp phải.';
                step1Error.classList.remove('hidden');
                return;
            }

            const randSuffix = Math.random().toString(36).replace(/[^a-z0-9]/gi, '').substring(0, 4).toUpperCase().padEnd(4, '9');
            const tempCode = 'TV<?php echo esc_js( wp_date( 'ymd' ) ); ?>-' + randSuffix;

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking');
            formData.append('nonce', nonceVal);
            formData.append('booking_code', tempCode);
            formData.append('parent_name', parentName);
            formData.append('phone', phone);
            formData.append('preferred_time', preferredTime);
            formData.append('diagnosis', selectedIssues.join(', '));
            selectedIssues.forEach(iss => {
                formData.append('child_issues[]', iss);
            });

            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<span>ĐANG CHUYỂN QUA ZALO...</span>';
            }

            let beaconSent = false;
            if (navigator.sendBeacon) {
                try {
                    beaconSent = navigator.sendBeacon(ajaxUrl, formData);
                } catch (err) {
                    beaconSent = false;
                }
            }
            if (!beaconSent) {
                fetch(ajaxUrl, {
                    method: 'POST',
                    body: formData,
                    keepalive: true
                }).catch(() => {});
            }

            // Nhảy thẳng qua Zalo ngay lập tức
            window.location.href = zaloTargetUrl;
        });
    }
});
</script>

<?php get_footer(); ?>
