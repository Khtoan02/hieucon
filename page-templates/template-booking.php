<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 phút để nhìn rõ vấn đề của con" — Bố cục thoáng theo từng màn hình, tông màu Xanh than & Cam trên nền trắng.
 *
 * @package Hieucon
 */

if ( isset( $_GET['step'] ) && 'survey' === sanitize_key( wp_unslash( $_GET['step'] ) ) ) {
    $survey_tpl = locate_template( 'page-templates/template-booking-survey.php' );
    if ( $survey_tpl ) {
        include $survey_tpl;
        return;
    }
}

get_header();

$current_member     = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_name       = $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '';
$prefill_phone      = $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '';
$prefill_child_name = $current_member && ! empty( $current_member->child_name ) ? $current_member->child_name : '';
$booking_nonce      = wp_create_nonce( 'hieucon_booking_nonce' );
?>

<style>
    /* Nền trắng chủ đạo, chỉ dùng Xanh than (#0A1931) & Cam (#f97316) */
    #primary.hc-booking-page {
        background: #ffffff !important;
        color: #0A1931;
    }

    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 20px 50px -24px rgba(10, 25, 49, 0.08);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #0A1931 0%, #f97316 100%);
    }

    /* Interactive Split Stage (#hc-diff) */
    .hc-diff-tab {
        position: relative;
        overflow: hidden;
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        background: #ffffff;
        transition: all 0.25s ease;
    }
    .hc-diff-tab:hover {
        border-color: #fdba74;
    }
    .hc-diff-tab.is-active {
        border-color: #f97316;
        background: #fff7ed;
        box-shadow: 0 14px 30px -18px rgba(249, 115, 22, 0.28);
    }
    .hc-diff-tab .hc-tab-num {
        background: #f1f5f9;
        color: #0A1931;
        transition: all 0.25s ease;
    }
    .hc-diff-tab.is-active .hc-tab-num {
        background: #f97316;
        color: #ffffff;
    }
    .hc-diff-tab .hc-tab-progress {
        position: absolute;
        left: 0;
        bottom: 0;
        height: 3.5px;
        width: 100%;
        background: #f97316;
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
        padding: 0 22px 20px 72px;
    }
    @media (max-width: 1023px) {
        .hc-diff-tab.is-active .hc-tab-mobile-body {
            display: block;
        }
    }

    /* Accordion (#hc-agenda) */
    .hc-agenda-part {
        border: 1.5px solid #e2e8f0;
        border-radius: 18px;
        background: #ffffff;
        transition: all 0.22s ease;
        overflow: hidden;
    }
    .hc-agenda-part:hover {
        border-color: #cbd5e1;
    }
    .hc-agenda-part.is-open {
        border-color: #fdba74;
        background: #fff7ed;
        box-shadow: 0 14px 30px -20px rgba(249, 115, 22, 0.22);
    }
    .hc-agenda-part .hc-agenda-num {
        background: #f1f5f9;
        color: #0A1931;
    }
    .hc-agenda-part.is-open .hc-agenda-num {
        background: #f97316;
        color: #ffffff;
    }
    .hc-agenda-part .hc-agenda-body {
        display: none;
        background: #ffffff;
        border-top: 1px solid #fed7aa;
    }
    .hc-agenda-part.is-open .hc-agenda-body {
        display: block;
    }
    .hc-agenda-part.is-open .hc-agenda-chevron {
        transform: rotate(180deg);
        background-color: #f97316;
        color: #ffffff;
    }

    /* Form Pills & Chips */
    .time-slot-pill.is-active {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
    }
    .survey-single-pill.is-selected {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
    }
    .survey-multi-chip {
        transition: all 0.18s ease;
    }
    .survey-multi-chip.is-selected {
        background-color: #fff7ed !important;
        color: #c2410c !important;
        border-color: #f97316 !important;
    }
    .survey-multi-chip.is-selected .chip-check-icon {
        background-color: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }
</style>

<main id="primary" class="site-main hc-booking-page">

    <!-- =========================================================
         SECTION 1: HERO (CHIẾM TRỌN MÀN HÌNH ĐẦU TIÊN - TẬP TRUNG TUYỆT ĐỐI)
         ========================================================= -->
    <section class="min-h-[calc(80vh-96px)] flex items-center py-12 md:py-16 lg:py-20 bg-white">
        <div class="max-w-[1220px] w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-14 xl:gap-16 items-center">

                <!-- Cột trái (7/12): Thông điệp mở đầu -->
                <div class="lg:col-span-7">
                    <h1 class="font-serif text-4xl sm:text-5xl xl:text-[3.5rem] font-bold text-navy leading-[1.16] mb-7">
                        30 phút để nhìn rõ<br class="hidden sm:inline" />
                        <span class="text-secondary">vấn đề của con</span>
                    </h1>

                    <p class="text-slate-700 text-lg sm:text-xl leading-relaxed mb-7">
                        Đợt này, đội ngũ mở một số lịch trao đổi 1:1 dành cho cha mẹ đang có những băn khoăn về <strong class="text-navy">ăn uống, tiêu hóa, giấc ngủ, hành vi hoặc dinh dưỡng</strong> của con.
                    </p>

                    <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-6 sm:p-7 mb-7">
                        <p class="font-bold text-navy text-base sm:text-lg mb-4">
                            Có những gia đình đã thử rất nhiều cách nhưng vẫn chưa thực sự biết:
                        </p>
                        <ul class="space-y-3 text-slate-800 text-base sm:text-lg">
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">1</span>
                                <span>Vấn đề chính của con nằm ở đâu?</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">2</span>
                                <span>Điều gì cần được ưu tiên trước?</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">3</span>
                                <span>Gia đình nên tiếp tục theo dõi, điều chỉnh hay cần hỗ trợ sâu hơn?</span>
                            </li>
                        </ul>
                    </div>

                    <p class="text-slate-700 text-base sm:text-lg leading-relaxed mb-9">
                        Trong 30 phút, buổi trao đổi tập trung vào chính vấn đề gia đình đang gặp phải, giúp ba mẹ nhìn lại tình trạng hiện tại và xác định hướng đi rõ ràng hơn.
                    </p>

                    <a href="#dang-ky-case" onclick="setTimeout(() => document.getElementById('booking-parent-name')?.focus(), 400);" class="inline-flex items-center justify-center gap-3 px-8 py-4 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base uppercase tracking-wider shadow-[0_14px_30px_-8px_rgba(249,115,22,0.45)] hover:-translate-y-0.5 transition-all duration-200">
                        <span>ĐĂNG KÝ CASE CỦA CON</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                </div>

                <!-- Cột phải (5/12): Khung thông tin đợt nhận case -->
                <div class="lg:col-span-5">
                    <div class="hc-master-card">
                        <div class="hc-card-bar"></div>
                        <div class="p-7 sm:p-9">
                            <div class="grid grid-cols-2 gap-4 mb-6">
                                <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-4">
                                    <span class="block text-xs text-slate-500 font-semibold mb-1">Thời lượng</span>
                                    <span class="block font-serif font-bold text-navy text-lg">30 phút 1:1</span>
                                </div>

                                <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-4">
                                    <span class="block text-xs text-slate-500 font-semibold mb-1">Hình thức</span>
                                    <span class="block font-serif font-bold text-navy text-lg">Qua Zalo / SĐT</span>
                                </div>

                                <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-4">
                                    <span class="block text-xs text-slate-500 font-semibold mb-1">Số lượng nhận</span>
                                    <span class="block font-serif font-bold text-navy text-lg">Giới hạn số case</span>
                                </div>

                                <div class="bg-[#fff7ed] border border-orange-200/90 rounded-2xl p-4">
                                    <span class="block text-xs text-secondary font-semibold mb-1">Chi phí hỗ trợ</span>
                                    <span class="block font-serif font-bold text-secondary text-lg">Miễn phí</span>
                                </div>
                            </div>

                            <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-6 space-y-4 text-slate-700 text-sm sm:text-base leading-relaxed">
                                <div class="flex items-start gap-3">
                                    <i data-lucide="clock" class="w-5 h-5 text-secondary shrink-0 mt-0.5"></i>
                                    <p>
                                        Để có đủ thời gian xem thông tin trước mỗi buổi trao đổi, <strong class="text-navy">số lượng case được nhận trong đợt này sẽ có giới hạn</strong>.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3">
                                    <i data-lucide="check-circle-2" class="w-5 h-5 text-secondary shrink-0 mt-0.5"></i>
                                    <p>
                                        Sau khi ba mẹ gửi thông tin, đội ngũ sẽ tổng hợp và <strong class="text-navy">liên hệ với những trường hợp phù hợp</strong> để sắp xếp lịch.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3 pt-3 border-t border-slate-200 text-navy font-semibold">
                                    <i data-lucide="info" class="w-5 h-5 text-secondary shrink-0 mt-0.5"></i>
                                    <p>
                                        Form đăng ký sẽ được đóng khi đã đủ số lượng case có thể hỗ trợ trong đợt này.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 2: 5 VẤN ĐỀ TRỌNG TÂM (KHOẢNG THỞ RỘNG RÃI)
         ========================================================= -->
    <section class="py-24 lg:py-32 bg-[#f8fafc] border-y border-slate-200/70">
        <div class="max-w-[1220px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.6rem] font-bold text-navy leading-tight">
                    Những vấn đề trọng tâm trong đợt trao đổi này
                </h2>
            </div>

            <div class="hc-master-card">
                <div class="hc-card-bar"></div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 divide-y md:divide-y-0 md:divide-x divide-slate-200/80">

                    <div class="p-7 lg:p-8">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#fff7ed] text-secondary font-extrabold text-sm mb-5">01</span>
                        <h3 class="font-serif font-bold text-xl text-navy mb-3">Kén ăn</h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Con ăn chọn lọc vài món quen thuộc, nhạy cảm với độ thô hoặc việc nhai nuốt còn hạn chế.
                        </p>
                    </div>

                    <div class="p-7 lg:p-8">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#fff7ed] text-secondary font-extrabold text-sm mb-5">02</span>
                        <h3 class="font-serif font-bold text-xl text-navy mb-3">Táo bón</h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Đi ngoài chưa đều, phân cứng hoặc phân sống thất thường, bụng dễ đầy hơi, chướng khí.
                        </p>
                    </div>

                    <div class="p-7 lg:p-8">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#fff7ed] text-secondary font-extrabold text-sm mb-5">03</span>
                        <h3 class="font-serif font-bold text-xl text-navy mb-3">Bất dung nạp</h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Cơ thể nhạy cảm với một số nhóm thực phẩm (đạm sữa, Gluten, Lactose...) ảnh hưởng đến tiêu hóa và giấc ngủ.
                        </p>
                    </div>

                    <div class="p-7 lg:p-8">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#fff7ed] text-secondary font-extrabold text-sm mb-5">04</span>
                        <h3 class="font-serif font-bold text-xl text-navy mb-3">Chậm tăng trưởng</h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Đường ruột hấp thu chưa trọn vẹn khiến con chậm tăng cân, chững chiều cao hoặc suy dinh dưỡng.
                        </p>
                    </div>

                    <div class="p-7 lg:p-8">
                        <span class="inline-flex items-center justify-center w-9 h-9 rounded-xl bg-[#fff7ed] text-secondary font-extrabold text-sm mb-5">05</span>
                        <h3 class="font-serif font-bold text-xl text-navy mb-3">Thiếu hụt vi chất</h3>
                        <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                            Cần làm rõ cơ thể con đang thiếu hụt vi chất gì để bổ sung đúng, hợp lý và hiệu quả.
                        </p>
                    </div>

                </div>
            </div>

            <div class="mt-8 bg-white border border-slate-200 rounded-2xl p-6 sm:p-7 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 shadow-sm">
                <p class="text-slate-700 text-sm sm:text-base leading-relaxed">
                    <strong class="text-navy">Đặc biệt phù hợp</strong> với gia đình muốn nhìn tổng thể mối liên hệ giữa tiêu hóa, dinh dưỡng, giấc ngủ và hành vi của con để biết nên bắt đầu hỗ trợ từ đâu.
                </p>
                <a href="#dang-ky-case" class="shrink-0 px-6 py-3.5 rounded-xl bg-navy hover:bg-navy/90 text-white font-bold text-xs sm:text-sm uppercase tracking-wider transition-all flex items-center gap-2">
                    <span>ĐĂNG KÝ CASE CỦA CON</span>
                    <i data-lucide="arrow-right" class="w-4 h-4 text-secondary"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 3: HIỂU TRƯỚC KHI CAN THIỆP (MỖI MÀN HÌNH 1 TRỌNG TÂM)
         ========================================================= -->
    <section class="py-24 lg:py-32 bg-white" id="hc-diff-section">
        <div class="max-w-[1220px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-3xl mx-auto mb-14">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.6rem] font-bold text-navy leading-snug">
                    Hiểu trước khi can thiệp.<br class="hidden sm:inline" />
                    <span class="text-secondary">Ưu tiên trước khi làm quá nhiều.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-11 gap-8 lg:gap-10 items-stretch">

                <!-- Cột trái (5/11): 4 Tab lớn, thoáng -->
                <div class="lg:col-span-5 flex flex-col gap-4" role="tablist">

                    <div class="hc-diff-tab is-active" data-tab-index="0">
                        <button type="button" class="w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-tab-num w-10 h-10 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">01</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Vấn đề của con không đứng riêng lẻ</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-sm sm:text-base text-slate-600 leading-relaxed">
                            Tiêu hóa, khả năng hấp thu, giấc ngủ và hành vi của con luôn liên kết chặt chẽ với nhau. Nhìn tổng thể giúp ba mẹ hiểu đúng nguyên nhân gốc rễ.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <div class="hc-diff-tab" data-tab-index="1">
                        <button type="button" class="w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-tab-num w-10 h-10 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">02</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Hiểu rõ trước khi thử thêm giải pháp</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-sm sm:text-base text-slate-600 leading-relaxed">
                            Thay vì đổi nhiều loại men hay thực phẩm bổ sung theo cảm tính, việc hiểu rõ cơ địa hiện tại của con giúp gia đình đi đúng hướng ngay từ đầu.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <div class="hc-diff-tab" data-tab-index="2">
                        <button type="button" class="w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-tab-num w-10 h-10 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">03</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Xác định đúng điều cần ưu tiên</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-sm sm:text-base text-slate-600 leading-relaxed">
                            Cơ thể trẻ cần sự điều chỉnh từng bước nhẹ nhàng. Biết rõ 1–2 việc cần ưu tiên làm trước sẽ giúp con thích nghi tốt và tiến bộ bền vững.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                    <div class="hc-diff-tab" data-tab-index="3">
                        <button type="button" class="w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-tab-num w-10 h-10 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">04</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Xem kỹ thông tin trước buổi hẹn</span>
                            <i data-lucide="chevron-right" class="w-5 h-5 text-slate-400 shrink-0"></i>
                        </button>
                        <div class="hc-tab-mobile-body text-sm sm:text-base text-slate-600 leading-relaxed">
                            Đội ngũ xem trước thông tin khảo sát của từng bé để 30 phút trao đổi tập trung trọn vẹn vào hoàn cảnh thực tế của gia đình.
                        </div>
                        <span class="hc-tab-progress"></span>
                    </div>

                </div>

                <!-- Cột phải (6/11): Khung Spotlight lớn, thoáng -->
                <div class="hidden lg:flex lg:col-span-6 hc-master-card p-10 xl:p-14 relative flex-col justify-center bg-[#f8fafc]">
                    <div id="hc-diff-pane-0" class="hc-diff-pane space-y-5">
                        <span class="font-serif font-bold text-8xl text-navy/5 absolute top-8 right-10 select-none">01</span>
                        <div class="w-14 h-14 rounded-2xl bg-[#fff7ed] text-secondary flex items-center justify-center">
                            <i data-lucide="network" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-serif text-2xl xl:text-3xl font-bold text-navy">Vấn đề của con thường không đứng riêng lẻ</h3>
                        <p class="text-slate-700 text-base xl:text-lg leading-relaxed">
                            Ăn uống, tiêu hóa, khả năng hấp thu, giấc ngủ và cảm xúc của con luôn có sự liên kết chặt chẽ. Khi đường ruột êm dịu và hấp thu tốt, con sẽ ăn ngon miệng hơn, ngủ sâu giấc hơn và tập trung tốt hơn.
                        </p>
                    </div>

                    <div id="hc-diff-pane-1" class="hc-diff-pane hidden space-y-5">
                        <span class="font-serif font-bold text-8xl text-navy/5 absolute top-8 right-10 select-none">02</span>
                        <div class="w-14 h-14 rounded-2xl bg-[#fff7ed] text-secondary flex items-center justify-center">
                            <i data-lucide="compass" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-serif text-2xl xl:text-3xl font-bold text-navy">Hiểu rõ trước khi thử thêm giải pháp</h3>
                        <p class="text-slate-700 text-base xl:text-lg leading-relaxed">
                            Điều ba mẹ cần thường không phải là thử thêm thật nhiều mẹo mới, mà là nhìn rõ nguyên nhân chính đang nằm ở đâu để chọn hướng điều chỉnh phù hợp và tiết kiệm công sức cho gia đình.
                        </p>
                    </div>

                    <div id="hc-diff-pane-2" class="hc-diff-pane hidden space-y-5">
                        <span class="font-serif font-bold text-8xl text-navy/5 absolute top-8 right-10 select-none">03</span>
                        <div class="w-14 h-14 rounded-2xl bg-[#fff7ed] text-secondary flex items-center justify-center">
                            <i data-lucide="list-filter" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-serif text-2xl xl:text-3xl font-bold text-navy">Xác định đúng điều cần ưu tiên</h3>
                        <p class="text-slate-700 text-base xl:text-lg leading-relaxed">
                            Thay vì thay đổi quá nhiều thứ cùng lúc, buổi trao đổi giúp gia đình xác định 1–2 điều quan trọng nhất cần làm trước để cơ thể con thích nghi nhẹ nhàng và cải thiện từng bước.
                        </p>
                    </div>

                    <div id="hc-diff-pane-3" class="hc-diff-pane hidden space-y-5">
                        <span class="font-serif font-bold text-8xl text-navy/5 absolute top-8 right-10 select-none">04</span>
                        <div class="w-14 h-14 rounded-2xl bg-[#fff7ed] text-secondary flex items-center justify-center">
                            <i data-lucide="file-search" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-serif text-2xl xl:text-3xl font-bold text-navy">Xem kỹ thông tin trước buổi hẹn</h3>
                        <p class="text-slate-700 text-base xl:text-lg leading-relaxed">
                            Số lượng case mỗi đợt đều có giới hạn để người phụ trách đọc kỹ thông tin ăn uống, tiêu hóa và lịch sử bổ sung của từng bé trước khi cuộc trao đổi 30 phút diễn ra.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 4: NỘI DUNG BUỔI TRAO ĐỔI 30 PHÚT
         ========================================================= -->
    <section class="py-24 lg:py-32 bg-[#f8fafc] border-y border-slate-200/70">
        <div class="max-w-[1040px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center max-w-2xl mx-auto mb-14">
                <h2 class="font-serif text-3xl sm:text-4xl lg:text-[2.6rem] font-bold text-navy">
                    Nội dung buổi trao đổi 30 phút
                </h2>
            </div>

            <div class="hc-master-card">
                <div class="hc-card-bar"></div>

                <div class="p-6 sm:p-9 space-y-4" id="hc-agenda-list">

                    <div class="hc-agenda-part is-open">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-agenda-num w-9 h-9 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">01</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Xác định vấn đề nổi bật hiện tại của con</span>
                            <span class="hc-agenda-chevron w-8 h-8 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-6 pb-6 pt-4 pl-[4.25rem] text-sm sm:text-base text-slate-700 space-y-2">
                            <p>• Rà soát các biểu hiện về ăn uống, tiêu hóa, hấp thu, giấc ngủ và hành vi của bé.</p>
                            <p>• Nhìn lại những cách gia đình đã áp dụng để tìm ra nút thắt chính hiện tại.</p>
                        </div>
                    </div>

                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-agenda-num w-9 h-9 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">02</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Nhìn rõ các yếu tố liên quan</span>
                            <span class="hc-agenda-chevron w-8 h-8 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-6 pb-6 pt-4 pl-[4.25rem] text-sm sm:text-base text-slate-700 space-y-2">
                            <p>• Kết nối mối liên hệ giữa chế độ ăn hàng ngày, tiêu hóa và nhu cầu vi chất của con.</p>
                            <p>• Hiểu rõ vì sao các biểu hiện của con lại xuất hiện cùng nhau.</p>
                        </div>
                    </div>

                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-agenda-num w-9 h-9 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">03</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Xác định điều cần được ưu tiên trước</span>
                            <span class="hc-agenda-chevron w-8 h-8 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-6 pb-6 pt-4 pl-[4.25rem] text-sm sm:text-base text-slate-700 space-y-2">
                            <p>• Sắp xếp thứ tự ưu tiên rõ ràng để ba mẹ không phải làm quá nhiều việc cùng lúc.</p>
                            <p>• Biết việc gì cần điều chỉnh ngay và việc gì có thể theo dõi thêm.</p>
                        </div>
                    </div>

                    <div class="hc-agenda-part">
                        <button type="button" class="hc-agenda-trigger w-full flex items-center gap-4 p-5 sm:p-6 text-left cursor-pointer">
                            <span class="hc-agenda-num w-9 h-9 rounded-xl font-extrabold text-sm flex items-center justify-center shrink-0">04</span>
                            <span class="font-serif font-bold text-navy text-lg sm:text-xl flex-1">Định hình bước tiếp theo cho gia đình</span>
                            <span class="hc-agenda-chevron w-8 h-8 rounded-full bg-slate-100 text-navy flex items-center justify-center transition-transform duration-200 shrink-0">
                                <i data-lucide="chevron-down" class="w-4 h-4"></i>
                            </span>
                        </button>
                        <div class="hc-agenda-body px-6 pb-6 pt-4 pl-[4.25rem] text-sm sm:text-base text-slate-700 space-y-2">
                            <p>• Làm rõ gia đình nên tiếp tục theo dõi, tự điều chỉnh tại nhà hay cần hỗ trợ sâu hơn.</p>
                            <p>• Nắm được các dấu hiệu tích cực cần quan sát ở con trong giai đoạn tới.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- =========================================================
         SECTION 5: KHU VỰC ĐĂNG KÝ CASE CỦA CON (#dang-ky-case)
         ========================================================= -->
    <section id="dang-ky-case" class="py-24 lg:py-32 bg-white scroll-mt-16">
        <div class="max-w-[1220px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 items-start">

                <!-- Cột trái (5/12): Khung hướng dẫn Xanh than & Cam -->
                <div class="lg:col-span-5 bg-navy text-white rounded-[24px] p-8 sm:p-10 shadow-lg">
                    <span class="inline-block bg-secondary/20 text-secondary border border-secondary/40 font-bold text-xs px-3.5 py-1 rounded-full mb-4">
                        Đợt nhận case hiện tại
                    </span>
                    <h2 class="font-serif text-3xl sm:text-4xl font-bold text-white mb-4">
                        Đăng ký case của con
                    </h2>
                    <p class="text-white/80 text-sm sm:text-base leading-relaxed mb-8">
                        Ba mẹ điền thông tin liên hệ ở bước đầu, sau đó tích chọn nhanh tình trạng hiện tại của bé để đội ngũ xem trước hồ sơ.
                    </p>

                    <div class="space-y-5 pt-6 border-t border-white/15 text-sm sm:text-base text-white/85">
                        <div class="flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-full bg-secondary text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">1</span>
                            <p class="leading-relaxed">
                                <strong class="text-white">Gửi thông tin & khảo sát nhanh:</strong> Giúp người phụ trách nắm bắt trước các biểu hiện của con.
                            </p>
                        </div>
                        <div class="flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-full bg-secondary text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">2</span>
                            <p class="leading-relaxed">
                                <strong class="text-white">Tổng hợp & liên hệ xếp lịch:</strong> Đội ngũ xem xét hồ sơ và nhắn xác nhận qua Zalo với các trường hợp phù hợp.
                            </p>
                        </div>
                        <div class="flex items-start gap-3.5">
                            <span class="w-7 h-7 rounded-full bg-secondary text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">3</span>
                            <p class="leading-relaxed">
                                <strong class="text-white">Trao đổi 1:1 trong 30 phút:</strong> Tập trung làm rõ vấn đề và hướng đi cho gia đình.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cột phải (7/12): Khung Form 2 bước nền trắng -->
                <div class="lg:col-span-7">
                    <div id="booking-card-wrapper" class="hc-master-card p-7 sm:p-10 relative">
                        <div class="hc-card-bar absolute top-0 left-0 right-0"></div>

                        <!-- BƯỚC 1: THÔNG TIN LIÊN HỆ -->
                        <div id="booking-step1-container" class="pt-2">
                            <div class="mb-7">
                                <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Thông tin liên hệ của ba mẹ</h3>
                                <p class="text-slate-500 text-sm sm:text-base mt-1.5">
                                    Điền thông tin liên hệ trước khi chuyển sang bảng tích chọn nhanh tình trạng của con.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-5" novalidate>
                                <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                                <div>
                                    <label for="booking-parent-name" class="block text-sm font-bold text-navy mb-2">
                                        Họ và tên ba/mẹ <span class="text-secondary">*</span>
                                    </label>
                                    <input
                                        type="text"
                                        id="booking-parent-name"
                                        name="parent_name"
                                        value="<?php echo esc_attr( $prefill_name ); ?>"
                                        required
                                        placeholder="Ví dụ: Mẹ Nguyễn Thu Hà"
                                        class="w-full px-4 py-3.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-base transition-all"
                                    >
                                </div>

                                <div>
                                    <label for="booking-phone" class="block text-sm font-bold text-navy mb-2">
                                        Số điện thoại / Zalo liên hệ <span class="text-secondary">*</span>
                                    </label>
                                    <input
                                        type="tel"
                                        id="booking-phone"
                                        name="phone"
                                        value="<?php echo esc_attr( $prefill_phone ); ?>"
                                        required
                                        placeholder="Nhập số điện thoại có dùng Zalo..."
                                        class="w-full px-4 py-3.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-base transition-all"
                                    >
                                </div>

                                <div>
                                    <label class="block text-sm font-bold text-navy mb-2">
                                        Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2.5 mb-3" id="time-slot-group">
                                        <button type="button" data-slot="Sáng (08:30 - 11:30)" class="time-slot-pill is-active text-center px-3 py-3 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Sáng (8h30–11h30)
                                        </button>
                                        <button type="button" data-slot="Trưa (12:00 - 13:30)" class="time-slot-pill text-center px-3 py-3 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Trưa (12h–13h30)
                                        </button>
                                        <button type="button" data-slot="Chiều (14:00 - 17:30)" class="time-slot-pill text-center px-3 py-3 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Chiều (14h–17h30)
                                        </button>
                                        <button type="button" data-slot="Tối (19:30 - 21:30)" class="time-slot-pill text-center px-3 py-3 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Tối (19h30–21h30)
                                        </button>
                                    </div>
                                    <input
                                        type="text"
                                        id="booking-preferred-time"
                                        name="preferred_time"
                                        value="Sáng (08:30 - 11:30)"
                                        placeholder="Hoặc ghi rõ ngày/giờ ba mẹ mong muốn..."
                                        class="w-full px-4 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-sm transition-all"
                                    >
                                </div>

                                <div id="booking-step1-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3"></div>

                                <button
                                    type="submit"
                                    id="booking-step1-btn"
                                    class="w-full py-4 px-6 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base uppercase tracking-wider shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center gap-2 cursor-pointer"
                                >
                                    <span>ĐĂNG KÝ CASE CỦA CON</span>
                                    <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                </button>
                            </form>
                        </div>

                        <!-- BƯỚC 2: KHẢO SÁT NHANH TRÊN 1 KHUNG -->
                        <div id="booking-step2-container" class="hidden pt-2">
                            <div class="bg-[#fff7ed] border border-orange-200 rounded-xl p-4 mb-6 flex items-start gap-3">
                                <div class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5">
                                    <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                </div>
                                <div class="text-xs sm:text-sm leading-relaxed text-slate-700">
                                    <p class="font-bold text-navy">
                                        Đã lưu thông tin liên hệ (<span id="step2-badge-code">TV-0000</span>)
                                    </p>
                                    <p class="mt-0.5">
                                        Ba mẹ tích chọn nhanh các biểu hiện của con dưới đây để đội ngũ xem trước hồ sơ nhé:
                                    </p>
                                </div>
                            </div>

                            <form id="hieucon-booking-step2-form" class="space-y-5" novalidate>
                                <input type="hidden" id="survey-booking-id" name="booking_id" value="">
                                <input type="hidden" id="survey-booking-code" name="booking_code" value="">

                                <!-- Thông tin bé -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                        <div class="sm:col-span-5">
                                            <label for="survey-child-name" class="block text-xs font-bold text-navy mb-1.5">Tên gọi của bé</label>
                                            <input
                                                type="text"
                                                id="survey-child-name"
                                                name="child_name"
                                                value="<?php echo esc_attr( $prefill_child_name ); ?>"
                                                placeholder="VD: Bé Bắp / Minh Khôi"
                                                class="w-full px-3.5 py-2 rounded-lg bg-white border border-slate-200 focus:border-secondary outline-none text-navy text-xs sm:text-sm"
                                            >
                                        </div>
                                        <div class="sm:col-span-7">
                                            <label class="block text-xs font-bold text-navy mb-1.5">Độ tuổi của bé</label>
                                            <input type="hidden" id="survey-child-age" name="child_age" value="2 – 3 tuổi">
                                            <div class="flex flex-wrap gap-1.5" data-single-group="survey-child-age">
                                                <?php
                                                $age_options = [ 'Dưới 2 tuổi', '2 – 3 tuổi', '3 – 5 tuổi', '5 – 7 tuổi', 'Trên 7 tuổi' ];
                                                foreach ( $age_options as $idx => $age_label ) :
                                                    $active_cls = ( 1 === $idx ) ? 'is-selected' : '';
                                                ?>
                                                <button type="button" data-value="<?php echo esc_attr( $age_label ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-3 py-1.5 rounded-lg border border-slate-200 bg-white text-navy text-xs font-semibold transition-all cursor-pointer">
                                                    <?php echo esc_html( $age_label ); ?>
                                                </button>
                                                <?php endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Vấn đề nổi bật nhất -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <label class="block text-xs font-bold text-navy mb-2">Vấn đề ba mẹ đang quan tâm nhất ở con</label>
                                    <input type="hidden" id="survey-diagnosis" name="diagnosis" value="Táo bón / tiêu hóa">
                                    <div class="flex flex-wrap gap-2" data-single-group="survey-diagnosis">
                                        <?php
                                        $diagnoses = [
                                            'Táo bón / tiêu hóa',
                                            'Kén ăn / nhai nuốt',
                                            'Bất dung nạp thực phẩm',
                                            'Hấp thu / chậm tăng cân',
                                            'Thiếu hụt vi chất',
                                        ];
                                        foreach ( $diagnoses as $idx => $diag ) :
                                            $active_cls = ( 0 === $idx ) ? 'is-selected' : '';
                                        ?>
                                        <button type="button" data-value="<?php echo esc_attr( $diag ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-3.5 py-2 rounded-lg border border-slate-200 bg-white text-navy text-xs font-semibold transition-all cursor-pointer">
                                            <?php echo esc_html( $diag ); ?>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Biểu hiện tiêu hóa & ăn uống -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <label class="block text-xs font-bold text-navy mb-2">
                                        Biểu hiện ăn uống & tiêu hóa hiện tại
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $bio_symptoms = [
                                            'Táo bón, đi ngoài chưa đều',
                                            'Phân sống, lỏng hoặc có bọt',
                                            'Bụng dễ đầy hơi, chướng khí',
                                            'Kén ăn, chỉ ăn vài món quen thuộc',
                                            'Nhạy cảm độ thô, ngậm thức ăn lâu',
                                            'Thích đồ ngọt, sữa hoặc tinh bột',
                                        ];
                                        foreach ( $bio_symptoms as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="bio_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3 py-2.5 rounded-lg border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs font-medium flex items-center gap-2 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Dấu hiệu hấp thu, vi chất, giấc ngủ & hành vi -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <label class="block text-xs font-bold text-navy mb-2">
                                        Biểu hiện hấp thu, vi chất, giấc ngủ & hành vi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $behav_symptoms = [
                                            'Hấp thu chưa tốt, chậm tăng cân',
                                            'Nhạy cảm với sữa bò, Gluten, Lactose',
                                            'Da nhạy cảm, dễ mẩn ngứa hoặc ốm vặt',
                                            'Khó vào giấc, ngủ chưa sâu giấc',
                                            'Dễ cáu gắt hoặc giảm sự tập trung',
                                            'Có dấu hiệu thiếu hụt vi chất (Kẽm, Sắt, Canxi...)',
                                        ];
                                        foreach ( $behav_symptoms as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="behav_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3 py-2.5 rounded-lg border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs font-medium flex items-center gap-2 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Những hướng gia đình đã áp dụng -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <label class="block text-xs font-bold text-navy mb-2">
                                        Gia đình đã áp dụng những hướng nào?
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                        <?php
                                        $tried_methods = [
                                            'Đã dùng men vi sinh, chất xơ hỗ trợ',
                                            'Đang bổ sung một số loại vitamin, vi chất',
                                            'Đã thử điều chỉnh chế độ ăn tại nhà',
                                            'Đang tìm hiểu hướng ưu tiên phù hợp cho con',
                                        ];
                                        foreach ( $tried_methods as $item ) :
                                        ?>
                                        <button type="button" data-multi-name="tried_methods[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3 py-2.5 rounded-lg border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs font-medium flex items-center gap-2 cursor-pointer">
                                            <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                                <i data-lucide="check" class="w-3 h-3"></i>
                                            </span>
                                            <span><?php echo esc_html( $item ); ?></span>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>

                                <!-- Điều muốn làm rõ nhất -->
                                <div class="bg-[#f8fafc] border border-slate-200/80 rounded-xl p-4 sm:p-5">
                                    <label for="survey-parent-goal" class="block text-xs font-bold text-navy mb-1.5">
                                        Điều ba mẹ mong muốn làm rõ nhất trong 30 phút này:
                                    </label>
                                    <textarea
                                        id="survey-parent-goal"
                                        name="parent_goal"
                                        rows="2"
                                        placeholder="Chia sẻ ngắn gọn điều gia đình đang quan tâm nhất ở con..."
                                        class="w-full px-3.5 py-2.5 rounded-lg bg-white border border-slate-200 focus:border-secondary outline-none text-navy text-xs sm:text-sm transition-all resize-none"
                                    ></textarea>
                                </div>

                                <div id="booking-step2-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3"></div>

                                <div class="space-y-2.5 pt-1">
                                    <button
                                        type="submit"
                                        id="booking-step2-btn"
                                        class="w-full py-4 px-6 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-sm transition-all flex items-center justify-center gap-2 cursor-pointer"
                                    >
                                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                        <span>HOÀN TẤT ĐĂNG KÝ CASE CỦA CON</span>
                                    </button>

                                    <button
                                        type="button"
                                        id="booking-skip-survey-btn"
                                        class="w-full py-1.5 text-center text-xs font-medium text-slate-500 hover:text-navy underline transition-colors cursor-pointer"
                                    >
                                        Bỏ qua bước khảo sát và gửi thông tin liên hệ →
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- MÀN HÌNH 3: HOÀN TẤT -->
                        <div id="booking-success-container" class="hidden text-center py-8">
                            <div class="w-16 h-16 rounded-full bg-[#fff7ed] text-secondary flex items-center justify-center mx-auto mb-4">
                                <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                            </div>
                            <span class="inline-block bg-[#fff7ed] text-secondary border border-orange-200 font-bold text-xs px-3.5 py-1 rounded-full mb-3">
                                Mã hồ sơ: <span id="res-booking-code">TV-0000</span>
                            </span>
                            <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã tiếp nhận thông tin của gia đình</h3>
                            <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-md mx-auto mb-6">
                                Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ sẽ tổng hợp thông tin và liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> (khung giờ: <strong id="res-time" class="text-navy"></strong>) đối với các trường hợp phù hợp trong đợt này.
                            </p>

                            <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-[#f8fafc] text-navy border border-slate-200 px-4 py-2 rounded-xl text-xs font-semibold mb-6">
                                <i data-lucide="file-check-2" class="w-4 h-4 text-secondary"></i>
                                <span>Đã lưu đầy đủ thông tin tình trạng của bé</span>
                            </div>

                            <div class="max-w-sm mx-auto space-y-2.5">
                                <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-navy hover:bg-navy/90 text-white font-bold text-sm flex items-center justify-center gap-2 transition-all">
                                    <span>Nhắn xác nhận qua Zalo</span>
                                </a>
                            </div>
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
    const nonceVal = document.getElementById('booking-nonce') ? document.getElementById('booking-nonce').value : '';

    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.5 });
    }

    // 1. Interactive Split Stage (#hc-diff-section)
    const diffTabs = document.querySelectorAll('.hc-diff-tab');
    const diffPanes = document.querySelectorAll('.hc-diff-pane');
    let currentDiffIdx = 0;
    let diffTimer = null;

    function activateDiffTab(idx) {
        currentDiffIdx = idx;
        diffTabs.forEach((tab, i) => {
            if (i === idx) {
                tab.classList.remove('is-active');
                void tab.offsetWidth;
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
                step1Error.textContent = 'Vui lòng nhập đầy đủ họ tên và số điện thoại/Zalo của ba/mẹ.';
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
                if (res.success && res.data) {
                    if (res.data.survey_url) {
                        step1Btn.innerHTML = '<span>Đang mở trang khảo sát...</span>';
                        window.location.href = res.data.survey_url;
                        return;
                    }
                    step1Btn.disabled = false;
                    step1Btn.innerHTML = originalHtml;
                    transitionToStep2(res.data);
                } else {
                    step1Btn.disabled = false;
                    step1Btn.innerHTML = originalHtml;
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
