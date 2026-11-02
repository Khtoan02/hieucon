<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 Phút Để Nhìn Rõ Vấn Đề Của Con" — Thiết kế theo cấu trúc Master Card, Interactive Split Stage & Agenda Accordion.
 *
 * @package Hieucon
 */

get_header();

$current_member     = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_name       = $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '';
$prefill_phone      = $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '';
$prefill_child_name = $current_member && ! empty( $current_member->child_name ) ? $current_member->child_name : '';
$booking_nonce      = wp_create_nonce( 'hieucon_booking_nonce' );
?>

<style>
    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid rgba(10, 25, 49, 0.12);
        border-radius: 22px;
        box-shadow: 0 22px 48px -24px rgba(10, 25, 49, 0.16);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 6px;
        background: linear-gradient(90deg, #0A1931 0%, #f97316 55%, #0d9488 100%);
    }
    .hc-glass-panel {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.96) 0%, rgba(255, 255, 255, 0.88) 100%);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1.5px solid rgba(255, 255, 255, 0.95);
    }

    /* Interactive Split Stage (#hc-diff) */
    .hc-diff-tab {
        position: relative;
        overflow: hidden;
        border: 1.5px solid rgba(10, 25, 49, 0.1);
        border-radius: 16px;
        background: #ffffff;
        transition: all 0.25s ease;
    }
    .hc-diff-tab.is-active {
        border-color: #f97316;
        box-shadow: 0 14px 30px -18px rgba(249, 115, 22, 0.45);
        transform: translateY(-1px);
    }
    .hc-diff-tab .hc-tab-progress {
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3px;
        width: 100%;
        background: linear-gradient(90deg, #f97316, #0d9488);
        transform: scaleX(0);
        transform-origin: left center;
    }
    .hc-diff-tab.is-active .hc-tab-progress {
        animation: hcTabFill 5500ms linear forwards;
    }
    @keyframes hcTabFill {
        from { transform: scaleX(0); }
        to   { transform: scaleX(1); }
    }
    .hc-diff-tab .hc-tab-mobile-body {
        display: none;
        padding: 0 18px 16px 64px;
    }
    @media (max-width: 1023px) {
        .hc-diff-tab.is-active .hc-tab-mobile-body {
            display: block;
        }
    }

    /* Accordion (#hc-agenda) */
    .hc-agenda-part {
        border: 1.5px solid rgba(10, 25, 49, 0.1);
        border-radius: 16px;
        background: #ffffff;
        transition: all 0.22s ease;
        overflow: hidden;
    }
    .hc-agenda-part.is-open {
        border-color: rgba(13, 148, 136, 0.45);
        box-shadow: 0 14px 28px -18px rgba(13, 148, 136, 0.28);
    }
    .hc-agenda-part .hc-agenda-body {
        display: none;
        border-top: 1px dashed rgba(10, 25, 49, 0.1);
    }
    .hc-agenda-part.is-open .hc-agenda-body {
        display: block;
    }
    .hc-agenda-part.is-open .hc-agenda-chevron {
        transform: rotate(180deg);
        background-color: #0d9488;
        color: #ffffff;
    }

    /* Form Pills & Chips */
    .time-slot-pill.is-active {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
        box-shadow: 0 6px 18px -4px rgba(10, 25, 49, 0.25);
    }
    .survey-single-pill.is-selected {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
        box-shadow: 0 4px 12px -2px rgba(10, 25, 49, 0.2);
    }
    .survey-multi-chip {
        transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .survey-multi-chip.is-selected {
        background-color: #fff7ed !important;
        color: #c2410c !important;
        border-color: #f97316 !important;
        box-shadow: 0 4px 12px -2px rgba(249, 115, 22, 0.16);
    }
    .survey-multi-chip.is-selected .chip-check-icon {
        background-color: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }
    .survey-multi-chip.is-selected-teal {
        background-color: #f0fdfa !important;
        color: #0f766e !important;
        border-color: #0d9488 !important;
        box-shadow: 0 4px 12px -2px rgba(13, 148, 136, 0.16);
    }
    .survey-multi-chip.is-selected-teal .chip-check-icon {
        background-color: #0d9488 !important;
        border-color: #0d9488 !important;
        color: #ffffff !important;
    }
</style>

<main id="primary" class="site-main min-h-screen pb-24 pt-6 md:pt-12 relative overflow-hidden">
    <!-- Decorative soft background blobs -->
    <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- =========================================================
             SECTION 1: HERO + THÔNG BÁO MỞ ĐỢT NHẬN CASE (SPECS CARD)
             ========================================================= -->
        <section class="pt-2 md:pt-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái (7/12): Nội dung dẫn dắt trực diện -->
                <div class="lg:col-span-7">
                    <h1 class="font-serif text-3xl sm:text-5xl font-bold text-navy leading-[1.18] mb-5">
                        30 Phút Để Nhìn Rõ<br class="hidden sm:inline" />
                        <span class="text-secondary italic">Vấn Đề Của Con</span>
                    </h1>

                    <p class="text-navy/85 text-base sm:text-lg font-medium leading-relaxed mb-5">
                        Đợt này, đội ngũ mở một số lịch trao đổi 1:1 dành cho cha mẹ đang có những băn khoăn về <strong class="text-navy">ăn uống, tiêu hóa, giấc ngủ, hành vi hoặc dinh dưỡng</strong> của con.
                    </p>

                    <div class="bg-white/80 backdrop-blur-md border border-navy/10 rounded-2xl p-5 sm:p-6 mb-5 shadow-soft">
                        <p class="font-bold text-navy text-sm sm:text-base mb-3">
                            Có những gia đình đã thử rất nhiều cách nhưng vẫn chưa thực sự biết:
                        </p>
                        <ul class="space-y-2.5 text-navy/85 text-sm sm:text-base font-semibold">
                            <li class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center shrink-0 mt-0.5 text-xs font-extrabold">•</span>
                                <span>Vấn đề chính của con nằm ở đâu?</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center shrink-0 mt-0.5 text-xs font-extrabold">•</span>
                                <span>Điều gì cần được ưu tiên trước?</span>
                            </li>
                            <li class="flex items-start gap-2.5">
                                <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center shrink-0 mt-0.5 text-xs font-extrabold">•</span>
                                <span>Gia đình nên tiếp tục theo dõi, điều chỉnh hay cần hỗ trợ sâu hơn?</span>
                            </li>
                        </ul>
                    </div>

                    <p class="text-navy/80 text-sm sm:text-base font-medium leading-relaxed mb-7">
                        Trong 30 phút, buổi trao đổi tập trung vào chính vấn đề gia đình đang gặp phải, giúp ba mẹ nhìn lại tình trạng hiện tại và xác định hướng đi rõ ràng hơn.
                    </p>

                    <a href="#dang-ky-case" onclick="setTimeout(() => document.getElementById('booking-parent-name')?.focus(), 400);" class="inline-flex items-center gap-3 px-7 py-4 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark hover:from-secondary_dark hover:to-secondary text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_12px_28px_-6px_rgba(249,115,22,0.5)] hover:-translate-y-0.5 transition-all duration-300">
                        <span>Đăng Ký Case Của Con</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <!-- Cột phải (5/12): Khung Thông Tin Đợt Nhận Case & 4 Ô Thông Số -->
                <div class="lg:col-span-5">
                    <div class="hc-master-card">
                        <div class="hc-card-bar"></div>
                        <div class="p-6 sm:p-7">
                            <!-- 4 ô thông số nhanh (Specs Grid) -->
                            <div class="grid grid-cols-2 gap-3 mb-6">
                                <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-3.5">
                                    <span class="block text-[11px] font-extrabold uppercase tracking-wider text-secondary mb-0.5">Thời lượng</span>
                                    <span class="block font-serif font-bold text-navy text-base">30 Phút 1:1</span>
                                    <span class="block text-[11px] text-navy/65 font-medium mt-0.5">Qua Zalo / Điện thoại</span>
                                </div>

                                <div class="bg-[#f0fdfa] border border-teal-200/80 rounded-2xl p-3.5">
                                    <span class="block text-[11px] font-extrabold uppercase tracking-wider text-primary mb-0.5">Trọng tâm</span>
                                    <span class="block font-serif font-bold text-navy text-base">Nhìn rõ gốc rễ</span>
                                    <span class="block text-[11px] text-navy/65 font-medium mt-0.5">Xác định thứ tự ưu tiên</span>
                                </div>

                                <div class="bg-slate-50 border border-navy/10 rounded-2xl p-3.5">
                                    <span class="block text-[11px] font-extrabold uppercase tracking-wider text-navy/60 mb-0.5">Hình thức nhận</span>
                                    <span class="block font-serif font-bold text-navy text-base">Giới hạn số case</span>
                                    <span class="block text-[11px] text-navy/65 font-medium mt-0.5">Xem hồ sơ trước khi hẹn</span>
                                </div>

                                <div class="bg-emerald-50/80 border border-emerald-200/80 rounded-2xl p-3.5">
                                    <span class="block text-[11px] font-extrabold uppercase tracking-wider text-emerald-700 mb-0.5">Chi phí</span>
                                    <span class="block font-serif font-bold text-navy text-base">Miễn phí</span>
                                    <span class="block text-[11px] text-navy/65 font-medium mt-0.5">Dành cho case phù hợp</span>
                                </div>
                            </div>

                            <!-- 3 Lưu ý về giới hạn & xét duyệt case -->
                            <div class="bg-navy text-white rounded-2xl p-5 space-y-3.5">
                                <div class="flex items-start gap-3">
                                    <i data-lucide="clock" class="w-4 h-4 text-secondary shrink-0 mt-1"></i>
                                    <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                                        Để có đủ thời gian xem thông tin trước mỗi buổi trao đổi, <strong class="text-white">số lượng case được nhận trong đợt này sẽ có giới hạn</strong>.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3">
                                    <i data-lucide="file-check-2" class="w-4 h-4 text-teal-300 shrink-0 mt-1"></i>
                                    <p class="text-xs sm:text-sm text-white/90 leading-relaxed font-medium">
                                        Sau khi ba mẹ gửi thông tin, đội ngũ sẽ tổng hợp và <strong class="text-white">liên hệ với những trường hợp phù hợp</strong> để sắp xếp lịch.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3 pt-2 border-t border-white/12">
                                    <i data-lucide="alert-circle" class="w-4 h-4 text-amber-300 shrink-0 mt-0.5"></i>
                                    <p class="text-xs text-amber-200 leading-relaxed font-semibold">
                                        Form đăng ký sẽ được đóng khi đã đủ số lượng case có thể hỗ trợ trong đợt này.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================================================
             SECTION 2: CÁC VẤN ĐỀ TRỌNG TÂM (BỐ CỤC MASTER CARD NHƯ #rbl-aud)
             Kén ăn • Táo bón • Bất dung nạp • Suy dinh dưỡng • Thiếu hụt vi chất
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="text-center max-w-3xl mx-auto mb-9">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                    Những Vấn Đề Trọng Tâm Trong Đợt Trao Đổi Này
                </h2>
            </div>

            <!-- Master Card chia 5 cột có vạch ngăn -->
            <div class="hc-master-card">
                <div class="hc-card-bar"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-navy/10">

                    <!-- 01. Kén ăn -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-secondary text-white font-extrabold text-xs flex items-center justify-center shrink-0">01</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-orange-50 text-secondary">Ăn uống</span>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-navy mb-2">Kén ăn</h3>
                            <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                                Biếng ăn, chỉ ăn lặp lại vài món cố định, nhạy cảm với độ thô, ngậm lâu, nhai nuốt kém hoặc thèm đồ ngọt, sữa, tinh bột quá mức.
                            </p>
                        </div>
                    </div>

                    <!-- 02. Táo bón -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-amber-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0">02</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-amber-50 text-amber-700">Tiêu hóa</span>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-navy mb-2">Táo bón</h3>
                            <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                                Táo bón kéo dài nhiều ngày, phân cứng vón cục hoặc phân sống, lỏng nát thất thường; bụng căng phình, đầy hơi, ợ chua, hôi miệng.
                            </p>
                        </div>
                    </div>

                    <!-- 03. Bất dung nạp -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-rose-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0">03</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-rose-50 text-rose-700">Cơ địa</span>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-navy mb-2">Bất dung nạp</h3>
                            <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                                Nhạy cảm hoặc bất dung nạp đạm sữa bò (Casein), Gluten, Lactose... gây rối loạn tiêu hóa, mẩn ngứa, chàm da, khó ngủ và bức bối sau ăn.
                            </p>
                        </div>
                    </div>

                    <!-- 04. Suy dinh dưỡng -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-navy text-white font-extrabold text-xs flex items-center justify-center shrink-0">04</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-slate-100 text-navy">Hấp thu</span>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-navy mb-2">Suy dinh dưỡng</h3>
                            <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                                Đường ruột tổn thương dẫn đến kém hấp thu dưỡng chất; con ăn được nhưng chững cân, chậm phát triển chiều cao, gầy yếu, hay ốm vặt.
                            </p>
                        </div>
                    </div>

                    <!-- 05. Thiếu hụt vi chất -->
                    <div class="p-6 flex flex-col justify-between">
                        <div>
                            <div class="flex items-center gap-2.5 mb-4">
                                <span class="w-8 h-8 rounded-lg bg-primary text-white font-extrabold text-xs flex items-center justify-center shrink-0">05</span>
                                <span class="text-[11px] font-extrabold uppercase tracking-wider px-2.5 py-1 rounded-full bg-teal-50 text-primary">Vi chất</span>
                            </div>
                            <h3 class="font-serif font-bold text-lg text-navy mb-2">Thiếu hụt vi chất</h3>
                            <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                                Thiếu kẽm, sắt, canxi, magie, vitamin... hoặc ba mẹ đã bổ sung nhiều loại men, vi chất cho con nhưng chưa thấy sự thay đổi rõ rệt.
                            </p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Thanh Note chốt hạ bên dưới Master Card -->
            <div class="mt-5 bg-white/90 border border-navy/12 rounded-2xl p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 shadow-soft">
                <div class="flex items-start gap-3.5">
                    <div class="w-9 h-9 rounded-xl bg-secondary/15 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                        <i data-lucide="check-square" class="w-5 h-5"></i>
                    </div>
                    <p class="text-navy/85 text-xs sm:text-sm font-medium leading-relaxed">
                        <strong class="text-navy font-extrabold">Đặc biệt phù hợp</strong> nếu con đang gặp đồng thời nhiều biểu hiện trên (kèm theo ngủ trằn trọc, dễ cáu gắt, chậm nói hoặc giảm chú ý) — ba mẹ biết cần hỗ trợ con nhưng chưa rõ các vấn đề liên quan với nhau thế nào và nên bắt đầu từ đâu.
                    </p>
                </div>
                <a href="#dang-ky-case" class="shrink-0 px-5 py-3 rounded-xl bg-navy hover:bg-navy/90 text-white font-extrabold text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                    <span>Đăng Ký Case Của Con</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-secondary"></i>
                </a>
            </div>
        </section>

        <!-- =========================================================
             SECTION 3: VÌ SAO CẦN NHÌN RÕ TRƯỚC KHI LÀM THÊM?
             (BỐ CỤC INTERACTIVE SPLIT STAGE 5:6 NHƯ #rbl-diff)
             ========================================================= -->
        <section class="mt-20 md:mt-28" id="hc-diff-section">
            <div class="text-center max-w-3xl mx-auto mb-9">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                    Hiểu Trước Khi Can Thiệp.<br class="hidden sm:inline" />
                    <span class="text-secondary italic">Ưu Tiên Trước Khi Làm Quá Nhiều.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-11 gap-6 items-stretch">

                <!-- Cột trái (5/11): Danh sách 4 Tab tương tác -->
                <div class="lg:col-span-5 flex flex-col gap-3" role="tablist">

                    <!-- Tab 01 -->
                    <div class="hc-diff-tab is-active" data-tab-index="0">
                        <button type="button" class="w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-9 h-9 rounded-xl bg-secondary text-white font-extrabold text-xs flex items-center justify-center shrink-0">01</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Vấn đề của con không đứng riêng lẻ</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-navy/40 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-xs sm:text-sm text-navy/75 font-medium leading-relaxed">
                            Khi con bất dung nạp thực phẩm hoặc táo bón kéo dài, niêm mạc ruột tổn thương sẽ dẫn tới kém hấp thu và thiếu hụt vi chất — từ đó làm con càng kén ăn, suy dinh dưỡng, ngủ trằn trọc và dễ bức bối hơn.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <!-- Tab 02 -->
                    <div class="hc-diff-tab" data-tab-index="1">
                        <button type="button" class="w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-9 h-9 rounded-xl bg-primary text-white font-extrabold text-xs flex items-center justify-center shrink-0">02</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Không nên thử thêm một cách ngẫu nhiên</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-navy/40 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-xs sm:text-sm text-navy/75 font-medium leading-relaxed">
                            Thấy táo bón thì đổi men, thấy biếng ăn thì mua siro, thấy còi cọc lại uống thêm đủ loại vi chất. Nhìn từng triệu chứng rời rạc để thử mẹo mới chỉ khiến gia đình thêm rối và tốn kém.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <!-- Tab 03 -->
                    <div class="hc-diff-tab" data-tab-index="2">
                        <button type="button" class="w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-9 h-9 rounded-xl bg-navy text-white font-extrabold text-xs flex items-center justify-center shrink-0">03</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Xác định đúng điều cần ưu tiên trước</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-navy/40 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-xs sm:text-sm text-navy/75 font-medium leading-relaxed">
                            Cơ thể đang quá tải của con không thể nhận thêm quá nhiều thứ cùng lúc. Ba mẹ cần biết rõ việc gì phải ưu tiên xử lý trước cho đường ruột, việc gì tạm gác lại sau.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <!-- Tab 04 -->
                    <div class="hc-diff-tab" data-tab-index="3">
                        <button type="button" class="w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-9 h-9 rounded-xl bg-amber-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0">04</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Đọc kỹ hồ sơ trước mỗi buổi trao đổi</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-navy/40 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-xs sm:text-sm text-navy/75 font-medium leading-relaxed">
                            Đây không phải buổi tư vấn đại trà. Đội ngũ xem xét trước thông tin của từng bé để 30 phút đi thẳng vào phân tích tình trạng thực tế và hướng đi cho gia đình.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                </div>

                <!-- Cột phải (6/11): Khung Spotlight Panel phóng đại trên Desktop -->
                <div class="hidden lg:flex lg:col-span-6 hc-master-card p-8 xl:p-10 relative flex-col justify-center">
                    <div id="hc-diff-pane-0" class="hc-diff-pane space-y-4">
                        <span class="font-serif font-bold text-7xl text-secondary/12 absolute top-6 right-8 select-none">01</span>
                        <div class="w-12 h-12 rounded-2xl bg-secondary/12 text-secondary flex items-center justify-center">
                            <i data-lucide="network" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-navy">Vấn đề của con thường không đứng riêng lẻ</h3>
                        <p class="text-navy/80 text-base font-medium leading-relaxed">
                            Một khó khăn về tiêu hóa hay dinh dưỡng ít khi đứng một mình. Khi con <strong class="text-navy">bất dung nạp thực phẩm hoặc táo bón kéo dài</strong>, hệ vi sinh mất cân bằng và niêm mạc ruột tổn thương sẽ dẫn tới <strong class="text-navy">kém hấp thu, thiếu hụt vi chất</strong> — từ đó làm con càng kén ăn, suy dinh dưỡng, ngủ trằn trọc và dễ bức bối hơn.
                        </p>
                        <p class="text-navy/75 text-sm font-medium leading-relaxed">
                            Vì vậy, gia đình cần nhìn tổng thể bức tranh liên kết này trước khi quyết định chọn giải pháp.
                        </p>
                    </div>

                    <div id="hc-diff-pane-1" class="hc-diff-pane hidden space-y-4">
                        <span class="font-serif font-bold text-7xl text-primary/12 absolute top-6 right-8 select-none">02</span>
                        <div class="w-12 h-12 rounded-2xl bg-primary/12 text-primary flex items-center justify-center">
                            <i data-lucide="compass" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-navy">Điều ba mẹ thiếu không phải là thêm một mẹo</h3>
                        <p class="text-navy/80 text-base font-medium leading-relaxed">
                            Rất nhiều cha mẹ tìm đến buổi trao đổi khi trong nhà đã có đủ loại men vi sinh, chất xơ, siro ăn ngon và thực phẩm bổ sung. Thấy táo bón thì đổi men, thấy biếng ăn thì mua siro, thấy còi cọc lại bổ sung thêm vi chất.
                        </p>
                        <p class="text-navy/75 text-sm font-medium leading-relaxed">
                            Khi chưa rõ nút thắt chính nằm ở đâu, <strong class="text-navy">việc thử thêm giải pháp một cách ngẫu nhiên chỉ làm cả con và ba mẹ thêm mệt mỏi</strong>.
                        </p>
                    </div>

                    <div id="hc-diff-pane-2" class="hc-diff-pane hidden space-y-4">
                        <span class="font-serif font-bold text-7xl text-navy/10 absolute top-6 right-8 select-none">03</span>
                        <div class="w-12 h-12 rounded-2xl bg-navy/10 text-navy flex items-center justify-center">
                            <i data-lucide="list-filter" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-navy">Xác định đúng điều cần ưu tiên trước</h3>
                        <p class="text-navy/80 text-base font-medium leading-relaxed">
                            Một hệ tiêu hóa đang nhạy cảm và quá tải không thể tiếp nhận quá nhiều sự can thiệp cùng một lúc.
                        </p>
                        <p class="text-navy/75 text-sm font-medium leading-relaxed">
                            Buổi trao đổi giúp ba mẹ <strong class="text-navy">sắp xếp lại thứ tự ưu tiên</strong>: biết rõ việc gì cần làm ngay để làm dịu đường ruột, việc gì chưa cần vội và nên theo dõi phản ứng của con như thế nào.
                        </p>
                    </div>

                    <div id="hc-diff-pane-3" class="hc-diff-pane hidden space-y-4">
                        <span class="font-serif font-bold text-7xl text-amber-500/15 absolute top-6 right-8 select-none">04</span>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/12 text-amber-700 flex items-center justify-center">
                            <i data-lucide="file-search" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif text-2xl font-bold text-navy">Đọc kỹ hồ sơ trước mỗi buổi trao đổi</h3>
                        <p class="text-navy/80 text-base font-medium leading-relaxed">
                            Chúng tôi không thực hiện các cuộc gọi tư vấn đại trà. Số lượng case mỗi đợt đều có giới hạn để đội ngũ có thời gian <strong class="text-navy">xem xét trước thông tin ăn uống, tiêu hóa và lịch sử bổ sung của từng bé</strong>.
                        </p>
                        <p class="text-navy/75 text-sm font-medium leading-relaxed">
                            Nhờ đó, 30 phút trao đổi sẽ đi thẳng vào vấn đề cốt lõi của gia đình mà không mất thời gian hỏi lại từ đầu.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <!-- =========================================================
             SECTION 4: NỘI DUNG 30 PHÚT & KẾT QUẢ ĐẦU RA
             (BỐ CỤC AGENDA CARD + ACCORDION + 2 HỘP KẾT QUẢ NHƯ #rbl-ws)
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="max-w-3xl mb-8">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                    Cấu Trúc Buổi Trao Đổi 30 Phút 1:1
                </h2>
            </div>

            <!-- Master Agenda Card -->
            <div class="hc-master-card">
                <div class="hc-card-bar"></div>

                <!-- 3 Ô Meta ngang trên cùng -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 p-5 sm:p-6 bg-slate-50/70 border-b border-navy/10">
                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-navy/8">
                        <div class="w-9 h-9 rounded-lg bg-secondary text-white flex items-center justify-center shrink-0">
                            <i data-lucide="clock" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] font-extrabold uppercase tracking-wider text-secondary">Thời lượng</span>
                            <span class="block text-xs sm:text-sm font-extrabold text-navy">30 Phút làm việc 1:1</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-navy/8">
                        <div class="w-9 h-9 rounded-lg bg-primary text-white flex items-center justify-center shrink-0">
                            <i data-lucide="phone-call" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] font-extrabold uppercase tracking-wider text-primary">Hình thức</span>
                            <span class="block text-xs sm:text-sm font-extrabold text-navy">Trực tuyến qua Zalo / SĐT</span>
                        </div>
                    </div>

                    <div class="flex items-center gap-3 bg-white p-3.5 rounded-xl border border-navy/8">
                        <div class="w-9 h-9 rounded-lg bg-navy text-white flex items-center justify-center shrink-0">
                            <i data-lucide="clipboard-list" class="w-4 h-4"></i>
                        </div>
                        <div>
                            <span class="block text-[10px] font-extrabold uppercase tracking-wider text-navy/60">Chuẩn bị</span>
                            <span class="block text-xs sm:text-sm font-extrabold text-navy">Xem trước thông tin case</span>
                        </div>
                    </div>
                </div>

                <!-- Danh sách Accordion 4 phần trong 30 phút -->
                <div class="p-5 sm:p-7 space-y-3" id="hc-agenda-list">

                    <!-- Phần 01 (Mở sẵn) -->
                    <div class="hc-agenda-part is-open">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-8 h-8 rounded-lg bg-secondary text-white font-extrabold text-xs flex items-center justify-center shrink-0">01</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Xác định vấn đề nổi bật nhất hiện tại của con</span>
                            <span class="hc-agenda-chevron w-7 h-7 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-5 pb-5 pt-3 pl-16">
                            <ul class="space-y-2 text-xs sm:text-sm text-navy/80 font-medium list-disc">
                                <li>Nhìn lại toàn bộ biểu hiện về <strong>kén ăn, táo bón, phân sống, bất dung nạp, suy dinh dưỡng</strong> và giấc ngủ, hành vi của bé.</li>
                                <li>Rà soát những phương pháp, chế độ ăn hoặc các loại men, vi chất gia đình đã thử nhưng chưa hiệu quả.</li>
                                <li>Gọi tên chính xác <strong>vấn đề nổi bật nhất</strong> đang cản trở sự phục hồi của con lúc này.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Phần 02 -->
                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-8 h-8 rounded-lg bg-primary text-white font-extrabold text-xs flex items-center justify-center shrink-0">02</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Nhìn rõ các yếu tố liên quan</span>
                            <span class="hc-agenda-chevron w-7 h-7 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-5 pb-5 pt-3 pl-16">
                            <ul class="space-y-2 text-xs sm:text-sm text-navy/80 font-medium list-disc">
                                <li>Xâu chuỗi mối liên hệ giữa <strong>thực phẩm hàng ngày – khả năng tiêu hóa – độ nhạy cảm đường ruột</strong>.</li>
                                <li>Làm rõ vì sao con ăn được nhưng vẫn <strong>kém hấp thu, chững cân hoặc thiếu hụt vi chất</strong>.</li>
                                <li>Giải thích sự tác động qua lại giữa sự bức bối ở đường ruột với giấc ngủ trằn trọc và hành vi của con.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Phần 03 -->
                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-8 h-8 rounded-lg bg-navy text-white font-extrabold text-xs flex items-center justify-center shrink-0">03</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Xác định điều gì cần được ưu tiên trước</span>
                            <span class="hc-agenda-chevron w-7 h-7 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-5 pb-5 pt-3 pl-16">
                            <ul class="space-y-2 text-xs sm:text-sm text-navy/80 font-medium list-disc">
                                <li>Lược bỏ những việc làm dàn trải chưa thực sự cần thiết đang gây quá tải cho cả con và mẹ.</li>
                                <li>Xác định rõ <strong>1–2 ưu tiên quan trọng nhất</strong> cần tập trung điều chỉnh trước trong giai đoạn hiện tại.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Phần 04 -->
                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-3.5 p-4 sm:p-5 text-left cursor-pointer">
                            <span class="w-8 h-8 rounded-lg bg-emerald-600 text-white font-extrabold text-xs flex items-center justify-center shrink-0">04</span>
                            <span class="font-serif font-bold text-navy text-base sm:text-lg flex-1">Biết bước tiếp theo gia đình nên làm là gì</span>
                            <span class="hc-agenda-chevron w-7 h-7 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-5 pb-5 pt-3 pl-16">
                            <ul class="space-y-2 text-xs sm:text-sm text-navy/80 font-medium list-disc">
                                <li>Định hình rõ gia đình nên <strong>tiếp tục theo dõi, tự điều chỉnh tại nhà hay cần hỗ trợ chuyên sâu hơn</strong>.</li>
                                <li>Hướng dẫn những chỉ số và tín hiệu cơ thể ba mẹ cần quan sát ở con trong các tuần tiếp theo.</li>
                            </ul>
                        </div>
                    </div>

                </div>
            </div>

            <!-- 2 Hộp Kết quả đầu ra & Quy trình xét duyệt (Giống .gets của #rbl-ws) -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-6">
                <div class="bg-[#fff7ed] border border-orange-200/90 rounded-2xl p-6">
                    <div class="flex items-center gap-2.5 mb-2.5">
                        <span class="w-7 h-7 rounded-lg bg-secondary text-white flex items-center justify-center">
                            <i data-lucide="check-circle-2" class="w-4 h-4"></i>
                        </span>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-secondary">Kết quả sau 30 phút</span>
                    </div>
                    <p class="text-navy/85 text-xs sm:text-sm font-medium leading-relaxed">
                        Ba mẹ tháo gỡ được sự rối bời, nhìn rõ <strong class="text-navy">vấn đề chính của con nằm ở đâu, điều gì cần ưu tiên làm trước</strong> và có hướng đi rõ ràng, thực tế cho giai đoạn tiếp theo.
                    </p>
                </div>

                <div class="bg-[#f0fdfa] border border-teal-200/90 rounded-2xl p-6">
                    <div class="flex items-center gap-2.5 mb-2.5">
                        <span class="w-7 h-7 rounded-lg bg-primary text-white flex items-center justify-center">
                            <i data-lucide="calendar-check" class="w-4 h-4"></i>
                        </span>
                        <span class="text-xs font-extrabold uppercase tracking-wider text-primary">Quy trình sau khi gửi thông tin</span>
                    </div>
                    <p class="text-navy/85 text-xs sm:text-sm font-medium leading-relaxed">
                        Sau khi ba mẹ hoàn tất đăng ký và khảo sát bên dưới, đội ngũ sẽ <strong class="text-navy">tổng hợp, xem xét kỹ hồ sơ và liên hệ qua Zalo</strong> với những trường hợp phù hợp để sắp xếp lịch trao đổi 1:1.
                    </p>
                </div>
            </div>
        </section>

        <!-- =========================================================
             SECTION 5: KHU VỰC ĐĂNG KÝ CASE CỦA CON (#dang-ky-case)
             (Form 2 bước: Thông tin liên hệ -> Khảo sát tình trạng của con)
             ========================================================= -->
        <section id="dang-ky-case" class="mt-20 md:mt-28 scroll-mt-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-start">

                <!-- Cột trái (5/12): Tóm tắt thông tin đợt đăng ký -->
                <div class="lg:col-span-5 bg-navy text-white rounded-[2rem] p-7 sm:p-9 shadow-premium">
                    <span class="inline-block bg-secondary/20 text-secondary border border-secondary/40 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded-full mb-4">
                        Đợt nhận case hiện tại
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white leading-tight mb-4">
                        Đăng Ký Case Của Con
                    </h2>
                    <p class="text-white/80 text-xs sm:text-sm font-medium leading-relaxed mb-6">
                        Ba mẹ vui lòng điền thông tin liên hệ ở bước đầu, sau đó tích chọn nhanh tình trạng hiện tại của bé để đội ngũ có đầy đủ dữ liệu xem xét trước buổi trao đổi.
                    </p>

                    <div class="space-y-4 pt-5 border-t border-white/12 text-xs sm:text-sm">
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/10 text-secondary font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <p class="text-white/85 leading-relaxed">
                                <strong class="text-white">Gửi thông tin cơ bản & khảo sát:</strong> Giúp người phụ trách nắm bắt trước các biểu hiện ăn uống, tiêu hóa, giấc ngủ và vi chất của con.
                            </p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/10 text-teal-300 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <p class="text-white/85 leading-relaxed">
                                <strong class="text-white">Xem xét & Liên hệ xếp lịch:</strong> Đội ngũ tổng hợp hồ sơ và nhắn qua Zalo cho những trường hợp phù hợp.
                            </p>
                        </div>
                        <div class="flex items-start gap-3">
                            <span class="w-6 h-6 rounded-full bg-white/10 text-amber-300 font-extrabold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <p class="text-white/85 leading-relaxed">
                                <strong class="text-white">Trao đổi 1:1 trong 30 phút:</strong> Tập trung tháo gỡ đúng vấn đề gia đình đang gặp phải.
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 p-4 rounded-2xl bg-white/8 border border-white/12 text-xs text-amber-200 font-medium leading-relaxed">
                        * Form đăng ký sẽ được đóng ngay khi đã nhận đủ số lượng case có thể hỗ trợ trong đợt này.
                    </div>
                </div>

                <!-- Cột phải (7/12): Khung Form 2 Bước -->
                <div class="lg:col-span-7">
                    <div id="booking-card-wrapper" class="hc-master-card p-6 sm:p-8 xl:p-9 relative">
                        <div class="hc-card-bar absolute top-0 left-0 right-0"></div>

                        <!-- MÀN HÌNH 1: THÔNG TIN LIÊN HỆ CƠ BẢN -->
                        <div id="booking-step1-container" class="pt-2">
                            <div class="mb-6">
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Thông Tin Liên Hệ Của Ba Mẹ</h3>
                                <p class="text-navy/65 text-xs sm:text-sm font-medium mt-1">
                                    Điền thông tin liên hệ để hệ thống ghi nhận hồ sơ trước khi chuyển sang bảng câu hỏi nhanh về tình trạng của con.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-4" novalidate>
                                <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                                <div>
                                    <label for="booking-parent-name" class="block text-xs font-extrabold text-navy mb-1.5">
                                        Họ và tên ba/mẹ <span class="text-secondary">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="booking-parent-name"
                                        name="parent_name"
                                        value="<?php echo esc_attr( $prefill_name ); ?>"
                                        required
                                        placeholder="Ví dụ: Mẹ Nguyễn Thu Hà"
                                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50/70 border border-navy/15 focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                    >
                                </div>

                                <div>
                                    <label for="booking-phone" class="block text-xs font-extrabold text-navy mb-1.5">
                                        Số điện thoại / Zalo nhận phản hồi <span class="text-secondary">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="booking-phone"
                                        name="phone"
                                        value="<?php echo esc_attr( $prefill_phone ); ?>"
                                        required
                                        placeholder="Nhập số điện thoại có dùng Zalo..."
                                        class="w-full px-4 py-3.5 rounded-xl bg-slate-50/70 border border-navy/15 focus:bg-white focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                    >
                                </div>

                                <div>
                                    <label class="block text-xs font-extrabold text-navy mb-1.5">
                                        Khung giờ ba/mẹ thuận tiện trao đổi 30 phút <span class="text-secondary">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2 mb-2.5" id="time-slot-group">
                                        <button type="button" data-slot="Sáng (08:30 - 11:30)" class="time-slot-pill is-active text-left px-3 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i data-lucide="sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                            <span>Sáng (8h30–11h30)</span>
                                        </button>
                                        <button type="button" data-slot="Trưa (12:00 - 13:30)" class="time-slot-pill text-left px-3 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i data-lucide="coffee" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                            <span>Trưa (12h–13h30)</span>
                                        </button>
                                        <button type="button" data-slot="Chiều (14:00 - 17:30)" class="time-slot-pill text-left px-3 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i data-lucide="cloud-sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                            <span>Chiều (14h–17h30)</span>
                                        </button>
                                        <button type="button" data-slot="Tối (19:30 - 21:30)" class="time-slot-pill text-left px-3 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-1.5 cursor-pointer">
                                            <i data-lucide="moon" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                            <span>Tối (19h30–21h30)</span>
                                        </button>
                                    </div>
                                    <input
                                        type="text"
                                        id="booking-preferred-time"
                                        name="preferred_time"
                                        value="Sáng (08:30 - 11:30)"
                                        placeholder="Hoặc ghi rõ ngày/giờ cụ thể ba mẹ mong muốn..."
                                        class="w-full px-4 py-2.5 rounded-xl bg-slate-50/70 border border-navy/10 focus:bg-white focus:border-secondary outline-none text-navy font-semibold text-xs transition-all"
                                    >
                                </div>

                                <div id="booking-step1-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                                <button
                                    type="submit"
                                    id="booking-step1-btn"
                                    class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark hover:from-secondary_dark hover:to-secondary text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(249,115,22,0.45)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span>Đăng Ký Case Của Con</span>
                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>

                        <!-- MÀN HÌNH 2: KHẢO SÁT NHANH TRÊN 1 KHUNG -->
                        <div id="booking-step2-container" class="hidden pt-2">
                            <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-4 mb-5 flex items-start gap-3">
                                <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-4 h-4"></i>
                                </div>
                                <div class="text-xs leading-relaxed text-emerald-950">
                                    <p class="font-extrabold text-sm text-emerald-900">
                                        Đã ghi nhận liên hệ (<span id="step2-badge-code">TV-0000</span>)
                                    </p>
                                    <p class="font-medium mt-0.5">
                                        Để đội ngũ có thông tin xem xét trước buổi trao đổi, ba mẹ tích chọn nhanh tình trạng hiện tại của con dưới đây nhé:
                                    </p>
                                </div>
                            </div>

                            <form id="hieucon-booking-step2-form" class="space-y-4" novalidate>
                                <input type="hidden" id="survey-booking-id" name="booking_id" value="">
                                <input type="hidden" id="survey-booking-code" name="booking_code" value="">

                                <!-- Thông tin bé -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                        <div class="sm:col-span-5">
                                            <label for="survey-child-name" class="block text-xs font-extrabold text-navy mb-1.5">Tên gọi của bé</label>
                                            <input
                                                type="text"
                                                id="survey-child-name"
                                                name="child_name"
                                                value="<?php echo esc_attr( $prefill_child_name ); ?>"
                                                placeholder="VD: Bé Bắp / Minh Khôi"
                                                class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-navy/15 focus:border-secondary outline-none text-navy font-semibold text-xs"
                                            >
                                        </div>
                                        <div class="sm:col-span-7">
                                            <label class="block text-xs font-extrabold text-navy mb-1.5">Độ tuổi của bé</label>
                                            <input type="hidden" id="survey-child-age" name="child_age" value="2 – 3 tuổi">
                                            <div class="flex flex-wrap gap-1.5" data-single-group="survey-child-age">
                                                <?php
                                                $age_options = [ 'Dưới 2 tuổi', '2 – 3 tuổi', '3 – 5 tuổi', '5 – 7 tuổi', 'Trên 7 tuổi' ];
                                                foreach ( $age_options as $idx => $age_label ) :
                                                    $active_cls = ( 1 === $idx ) ? 'is-selected' : '';
                                                ?>
                                                <button type="button" data-value="<?php echo esc_attr( $age_label ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-3 py-2 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all cursor-pointer">
                                                    <?php echo esc_html( $age_label ); ?>
                                                </button>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vấn đề nổi bật nhất -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <label class="block text-xs font-extrabold text-navy mb-2">Vấn đề nổi bật nhất ba mẹ đang băn khoăn ở con</label>
                                    <input type="hidden" id="survey-diagnosis" name="diagnosis" value="Táo bón / Rối loạn tiêu hoá">
                                    <div class="flex flex-wrap gap-2" data-single-group="survey-diagnosis">
                                        <?php
                                        $diagnoses = [
                                            'Táo bón / Rối loạn tiêu hoá',
                                            'Kén ăn / Nhai nuốt kém',
                                            'Bất dung nạp / Dị ứng thực phẩm',
                                            'Kém hấp thu / Suy dinh dưỡng',
                                            'Thiếu hụt vi chất & dinh dưỡng',
                                        ];
                                        foreach ( $diagnoses as $idx => $diag ) :
                                            $active_cls = ( 0 === $idx ) ? 'is-selected' : '';
                                        ?>
                                        <button type="button" data-value="<?php echo esc_attr( $diag ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-3.5 py-2 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all cursor-pointer">
                                            <?php echo esc_html( $diag ); ?>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Biểu hiện Tiêu hoá & Ăn uống -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <label class="block text-xs font-extrabold text-navy mb-2">
                                        Biểu hiện Tiêu hoá & Ăn uống hiện tại
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $bio_symptoms = [
                                            'Táo bón kéo dài, phân cứng, vón cục',
                                            'Phân sống, lỏng nát, có bọt hoặc mùi chua',
                                            'Bụng căng phình, đầy hơi, ợ chua, hôi miệng',
                                            'Kén ăn cực đoan, chỉ ăn vài món cố định',
                                            'Nhạy cảm độ thô, ngậm lâu, nhai nuốt kém',
                                            'Thèm đồ ngọt, sữa bò hoặc tinh bột quá mức',
                                        ];
                                        foreach ( $bio_symptoms as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="bio_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3 py-2.5 rounded-xl border border-navy/12 bg-white hover:border-secondary/50 text-navy text-xs font-semibold flex items-center gap-2.5 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded-md border border-navy/25 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Dấu hiệu Bất dung nạp, Suy dinh dưỡng, Vi chất, Giấc ngủ & Hành vi -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <label class="block text-xs font-extrabold text-navy mb-2">
                                        Dấu hiệu Bất dung nạp, Hấp thu, Vi chất, Giấc ngủ & Hành vi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $behav_symptoms = [
                                            'Ăn được nhưng kém hấp thu, chậm tăng cân / chiều cao',
                                            'Nghi ngờ bất dung nạp đạm sữa bò (Casein), Gluten, Lactose',
                                            'Hay mẩn ngứa, chàm da, dị ứng hoặc ốm vặt',
                                            'Khó vào giấc, ngủ trằn trọc, nghiến răng, mồ hôi trộm',
                                            'Dễ bức bối, cáu gắt, mất tập trung khi bụng khó chịu',
                                            'Có dấu hiệu thiếu Kẽm, Sắt, Canxi, Magie, Vitamin...',
                                        ];
                                        foreach ( $behav_symptoms as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="behav_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected-teal" class="survey-multi-chip text-left px-3 py-2.5 rounded-xl border border-navy/12 bg-white hover:border-primary/50 text-navy text-xs font-semibold flex items-center gap-2.5 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded-md border border-navy/25 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Những hướng gia đình đã thử -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <label class="block text-xs font-extrabold text-navy mb-2">
                                        Gia đình đã hoặc đang thử những hướng nào?
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $tried_methods = [
                                            'Đã đổi nhiều loại men vi sinh, chất xơ nhưng chưa dứt điểm',
                                            'Đang bổ sung nhiều loại vi chất nhưng chưa rõ con hấp thu không',
                                            'Đã thử kiêng sữa bò / Gluten hoặc điều chỉnh chế độ ăn',
                                            'Đã thử nhiều cách nhưng chưa rõ nên ưu tiên xử lý gì trước',
                                        ];
                                        foreach ( $tried_methods as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="tried_methods[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3 py-2.5 rounded-xl border border-navy/12 bg-white hover:border-secondary/50 text-navy text-xs font-semibold flex items-center gap-2.5 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded-md border border-navy/25 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Điều muốn làm rõ nhất -->
                                <div class="bg-slate-50/80 border border-navy/10 rounded-2xl p-4">
                                    <label for="survey-parent-goal" class="block text-xs font-extrabold text-navy mb-1.5">
                                        Điều ba mẹ muốn làm rõ nhất trong 30 phút trao đổi này:
                                    </label>
                                    <textarea
                                        id="survey-parent-goal"
                                        name="parent_goal"
                                        rows="2"
                                        placeholder="Ví dụ: Con táo bón lâu ngày kèm kén ăn và chậm tăng cân, đã đổi nhiều loại men không đỡ, muốn biết vấn đề chính nằm ở đâu và ưu tiên gì trước..."
                                        class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-navy/15 focus:border-secondary outline-none text-navy font-medium text-xs transition-all resize-none"
                                    ></textarea>
                                </div>

                                <div id="booking-step2-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                                <div class="space-y-2.5 pt-1">
                                    <button
                                        type="submit"
                                        id="booking-step2-btn"
                                        class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-primary to-teal-700 hover:opacity-95 text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(13,148,136,0.4)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer"
                                    >
                                        <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                                        <span>Hoàn Tất Hồ Sơ Case Của Con</span>
                                    </button>

                                    <button
                                        type="button"
                                        id="booking-skip-survey-btn"
                                        class="w-full py-2 text-center text-xs font-bold text-navy/55 hover:text-navy underline transition-colors cursor-pointer"
                                    >
                                        Bỏ qua khảo sát và gửi thông tin liên hệ →
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- MÀN HÌNH 3: HOÀN TẤT -->
                        <div id="booking-success-container" class="hidden text-center py-6">
                            <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-sm">
                                <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                            </div>
                            <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded-full mb-2">
                                Mã hồ sơ: <span id="res-booking-code">TV-0000</span>
                            </span>
                            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã Tiếp Nhận Thông Tin Case!</h3>
                            <p class="text-navy/75 text-sm font-medium leading-relaxed max-w-lg mx-auto mb-5">
                                Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ sẽ tổng hợp, xem xét thông tin của bé và liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> (khung giờ ưu tiên: <strong id="res-time" class="text-navy"></strong>) đối với các trường hợp phù hợp trong đợt này.
                            </p>

                            <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-teal-50 text-teal-800 border border-teal-200 px-3.5 py-1.5 rounded-xl text-xs font-bold mb-6">
                                <i data-lucide="file-check-2" class="w-4 h-4 text-teal-600"></i>
                                <span>Đã lưu đầy đủ thông tin khảo sát tình trạng của bé</span>
                            </div>

                            <div class="max-w-md mx-auto space-y-3">
                                <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0068FF] to-[#0052CC] hover:opacity-95 text-white font-extrabold text-sm uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all">
                                    <span class="font-black text-base leading-none">Z</span>
                                    <span>Nhắn Xác Nhận Hồ Sơ Qua Zalo</span>
                                </a>
                                <a href="<?php echo esc_url( home_url( '/bo-cong-cu-suc-khoe/' ) ); ?>" class="w-full py-3 px-5 rounded-xl bg-navy hover:bg-navy/85 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                                    <i data-lucide="clipboard-check" class="w-4 h-4 text-secondary"></i>
                                    <span>Xem Bộ Công Cụ Đánh Giá Sức Khỏe</span>
                                </a>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const nonceVal = document.getElementById('booking-nonce') ? document.getElementById('booking-nonce').value : '';

    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.5 });
    }

    // 1. Interactive Split Stage (#hc-diff-section) - Tự động chuyển tab + click
    const diffTabs = document.querySelectorAll('.hc-diff-tab');
    const diffPanes = document.querySelectorAll('.hc-diff-pane');
    let currentDiffIdx = 0;
    let diffTimer = null;

    function activateDiffTab(idx) {
        currentDiffIdx = idx;
        diffTabs.forEach((tab, i) => {
            if (i === idx) {
                tab.classList.remove('is-active');
                void tab.offsetWidth; // restart progress animation
                tab.classList.add('is-active');
            } else {
                tab.classList.remove('is-active');
            }
        });
        diffPanes.forEach((pane, i) => {
            if (i === idx) {
                pane.classList.remove('hidden');
            } else {
                pane.classList.add('hidden');
            }
        });
    }

    function startDiffAutoRotate() {
        clearInterval(diffTimer);
        diffTimer = setInterval(() => {
            const nextIdx = (currentDiffIdx + 1) % diffTabs.length;
            activateDiffTab(nextIdx);
        }, 5500);
    }

    if (diffTabs.length > 0) {
        diffTabs.forEach((tab, idx) => {
            tab.addEventListener('click', () => {
                activateDiffTab(idx);
                startDiffAutoRotate();
            });
        });
        startDiffAutoRotate();
    }

    // 2. Agenda Accordion (#hc-agenda-list)
    const agendaParts = document.querySelectorAll('.hc-agenda-part');
    agendaParts.forEach(part => {
        const trigger = part.querySelector('.hc-agenda-trigger');
        if (trigger) {
            trigger.addEventListener('click', () => {
                const isOpen = part.classList.contains('is-open');
                agendaParts.forEach(p => p.classList.remove('is-open'));
                if (!isOpen) {
                    part.classList.add('is-open');
                }
            });
        }
    });

    // 3. Chọn nhanh Khung giờ
    const slotButtons = document.querySelectorAll('.time-slot-pill');
    const timeInput = document.getElementById('booking-preferred-time');

    slotButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            slotButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            timeInput.value = btn.getAttribute('data-slot');
        });
    });

    // 4. Chọn đơn (Độ tuổi & Vấn đề nổi bật)
    const singleGroups = document.querySelectorAll('[data-single-group]');
    singleGroups.forEach(group => {
        const targetInputId = group.getAttribute('data-single-group');
        const hiddenInput = document.getElementById(targetInputId);
        const pills = group.querySelectorAll('.survey-single-pill');

        pills.forEach(pill => {
            pill.addEventListener('click', () => {
                pills.forEach(p => p.classList.remove('is-selected'));
                pill.classList.add('is-selected');
                if (hiddenInput) {
                    hiddenInput.value = pill.getAttribute('data-value');
                }
            });
        });
    });

    // 5. Chọn nhiều (Khảo sát triệu chứng)
    const multiChips = document.querySelectorAll('.survey-multi-chip');
    multiChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const activeCls = chip.getAttribute('data-active-class') || 'is-selected';
            chip.classList.toggle(activeCls);
        });
    });

    // 6. Chuyển đổi bước Form
    const cardWrapper = document.getElementById('booking-card-wrapper');
    const step1Container = document.getElementById('booking-step1-container');
    const step2Container = document.getElementById('booking-step2-container');
    const successContainer = document.getElementById('booking-success-container');

    function transitionToStep2(data) {
        document.getElementById('survey-booking-id').value = data.booking_id;
        document.getElementById('survey-booking-code').value = data.booking_code;
        document.getElementById('step2-badge-code').textContent = data.booking_code;

        document.getElementById('res-booking-code').textContent = data.booking_code;
        document.getElementById('res-parent-name').textContent = data.parent_name;
        document.getElementById('res-phone').textContent = data.phone;
        document.getElementById('res-time').textContent = data.preferred_time;
        if (data.zalo_url) {
            document.getElementById('res-zalo-link').href = data.zalo_url;
        }

        step1Container.classList.add('hidden');
        step2Container.classList.remove('hidden');

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        if (cardWrapper) {
            cardWrapper.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    function transitionToFinalSuccess(hasSurvey) {
        step2Container.classList.add('hidden');
        successContainer.classList.remove('hidden');

        const surveyBadge = document.getElementById('res-survey-badge');
        if (surveyBadge) {
            if (hasSurvey) {
                surveyBadge.classList.remove('hidden');
            } else {
                surveyBadge.classList.add('hidden');
            }
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }

        if (cardWrapper) {
            cardWrapper.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
    }

    // Submit Bước 1
    const step1Form = document.getElementById('hieucon-booking-step1-form');
    const step1Btn = document.getElementById('booking-step1-btn');
    const step1Error = document.getElementById('booking-step1-error');

    if (step1Form) {
        step1Form.addEventListener('submit', function (e) {
            e.preventDefault();
            step1Error.classList.add('hidden');

            const parentName = document.getElementById('booking-parent-name').value.trim();
            const phone = document.getElementById('booking-phone').value.trim();
            const preferredTime = timeInput.value.trim() || 'Sớm nhất có thể';

            if (!parentName || !phone) {
                step1Error.textContent = 'Vui lòng nhập đầy đủ Họ tên và Số điện thoại/Zalo của ba/mẹ.';
                step1Error.classList.remove('hidden');
                return;
            }

            step1Btn.disabled = true;
            const originalHtml = step1Btn.innerHTML;
            step1Btn.innerHTML = '<span>Đang xử lý...</span>';

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking');
            formData.append('nonce', nonceVal);
            formData.append('parent_name', parentName);
            formData.append('phone', phone);
            formData.append('preferred_time', preferredTime);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                step1Btn.disabled = false;
                step1Btn.innerHTML = originalHtml;

                if (res.success && res.data) {
                    transitionToStep2(res.data);
                } else {
                    step1Error.textContent = (res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra, vui lòng thử lại.';
                    step1Error.classList.remove('hidden');
                }
            })
            .catch(() => {
                step1Btn.disabled = false;
                step1Btn.innerHTML = originalHtml;
                step1Error.textContent = 'Không thể kết nối máy chủ. Vui lòng thử lại hoặc kết nối qua Zalo.';
                step1Error.classList.remove('hidden');
            });
        });
    }

    // Submit Bước 2
    const step2Form = document.getElementById('hieucon-booking-step2-form');
    const step2Btn = document.getElementById('booking-step2-btn');
    const step2Error = document.getElementById('booking-step2-error');
    const skipSurveyBtn = document.getElementById('booking-skip-survey-btn');

    if (skipSurveyBtn) {
        skipSurveyBtn.addEventListener('click', function () {
            transitionToFinalSuccess(false);
        });
    }

    if (step2Form) {
        step2Form.addEventListener('submit', function (e) {
            e.preventDefault();
            step2Error.classList.add('hidden');

            step2Btn.disabled = true;
            const originalHtml = step2Btn.innerHTML;
            step2Btn.innerHTML = '<span>Đang lưu thông tin...</span>';

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking_survey');
            formData.append('nonce', nonceVal);
            formData.append('booking_id', document.getElementById('survey-booking-id').value);
            formData.append('booking_code', document.getElementById('survey-booking-code').value);
            formData.append('child_name', document.getElementById('survey-child-name').value.trim());
            formData.append('child_age', document.getElementById('survey-child-age').value);
            formData.append('diagnosis', document.getElementById('survey-diagnosis').value);
            formData.append('parent_goal', document.getElementById('survey-parent-goal').value.trim());

            document.querySelectorAll('.survey-multi-chip').forEach(chip => {
                const activeCls = chip.getAttribute('data-active-class') || 'is-selected';
                if (chip.classList.contains(activeCls)) {
                    formData.append(chip.getAttribute('data-multi-name'), chip.getAttribute('data-value'));
                }
            });

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                step2Btn.disabled = false;
                step2Btn.innerHTML = originalHtml;

                if (res.success) {
                    transitionToFinalSuccess(true);
                } else {
                    step2Error.textContent = (res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra khi lưu khảo sát.';
                    step2Error.classList.remove('hidden');
                }
            })
            .catch(() => {
                step2Btn.disabled = false;
                step2Btn.innerHTML = originalHtml;
                transitionToFinalSuccess(false);
            });
        });
    }
});
</script>

<?php get_footer(); ?>
