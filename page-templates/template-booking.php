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

    /* Form Pills & Chips */
    .time-slot-pill.is-active {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
    }
    .survey-single-pill {
        transition: all 0.18s ease;
    }
    .survey-single-pill:hover {
        border-color: #fdba74;
    }
    .survey-single-pill.is-selected {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
        box-shadow: 0 8px 20px -6px rgba(10, 25, 49, 0.25);
    }
    .survey-multi-chip {
        transition: all 0.18s ease;
    }
    .survey-multi-chip:hover {
        border-color: #fdba74;
        background-color: #fffaf5;
    }
    .survey-multi-chip.is-selected {
        background-color: #fff7ed !important;
        color: #0A1931 !important;
        border-color: #f97316 !important;
        font-weight: 600;
    }
    .survey-multi-chip.is-selected .chip-check-icon {
        background-color: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }
</style>

<main id="primary" class="site-main hc-booking-page">

    <!-- =========================================================
         TRANG 1: LANDING PAGE ĐẶT LỊCH (#hc-landing-view)
         ========================================================= -->
    <div id="hc-landing-view">

    <!-- =========================================================
         SECTION DUY NHẤT: THÔNG ĐIỆP MỞ ĐẦU (TRÁI) & FORM ĐĂNG KÝ (PHẢI)
         ========================================================= -->
    <section id="dang-ky-case" class="min-h-screen flex items-center py-20 md:py-28 lg:py-36 bg-white">
        <div class="max-w-[1220px] w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 xl:gap-20 items-center">

                <!-- Cột trái (7/12): Thông điệp mở đầu (không có nút CTA) -->
                <div class="lg:col-span-7">
                    <h1 class="font-serif text-4xl sm:text-5xl xl:text-[3.5rem] font-bold text-navy leading-[1.16] mb-8">
                        30 phút để nhìn rõ<br class="hidden sm:inline" />
                        <span class="text-secondary">vấn đề của con</span>
                    </h1>

                    <p class="text-slate-700 text-lg sm:text-xl leading-relaxed mb-8">
                        Đợt này, đội ngũ HIỂU CON TỪ GỐC mở một số lịch trao đổi 1:1 dành cho cha mẹ đang có những băn khoăn về <strong class="text-navy">ăn uống, tiêu hóa, giấc ngủ, hành vi hoặc dinh dưỡng</strong> của con.
                    </p>

                    <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-6 sm:p-8 mb-8">
                        <p class="font-bold text-navy text-base sm:text-lg mb-4">
                            Có những gia đình đã thử rất nhiều cách nhưng vẫn chưa thực sự biết:
                        </p>
                        <ul class="space-y-3.5 text-slate-800 text-base sm:text-lg">
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

                    <p class="text-slate-700 text-base sm:text-lg leading-relaxed">
                        Trong 30 phút, buổi trao đổi tập trung vào chính vấn đề gia đình đang gặp phải, giúp ba mẹ nhìn lại tình trạng hiện tại và xác định hướng đi rõ ràng hơn.
                    </p>
                </div>

                <!-- Cột phải (5/12): Form đăng ký thông tin liên hệ -->
                <div class="lg:col-span-5">
                    <div id="booking-card-wrapper" class="hc-master-card relative">
                        <div class="hc-card-bar"></div>

                        <div id="booking-step1-container" class="p-7 sm:p-9 lg:p-10">
                            <div class="mb-7">
                                <h2 class="font-serif text-2xl sm:text-[1.75rem] font-bold text-navy leading-snug">
                                    Thông tin liên hệ của ba mẹ
                                </h2>
                                <p class="text-slate-500 text-sm mt-2 leading-relaxed">
                                    Điền thông tin liên hệ trước khi chuyển sang bảng tích chọn nhanh tình trạng của con.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-5" novalidate>
                                <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                                <div>
                                    <label for="booking-parent-name" class="block text-sm font-bold text-navy mb-1.5">
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
                                    <label for="booking-phone" class="block text-sm font-bold text-navy mb-1.5">
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
                                    <label class="block text-sm font-bold text-navy mb-1.5">
                                        Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                    </label>
                                    <div class="grid grid-cols-2 gap-2 mb-2.5" id="time-slot-group">
                                        <button type="button" data-slot="Sáng (08:30 - 11:30)" class="time-slot-pill is-active text-center px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Sáng (8h30–11h30)
                                        </button>
                                        <button type="button" data-slot="Trưa (12:00 - 13:30)" class="time-slot-pill text-center px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Trưa (12h–13h30)
                                        </button>
                                        <button type="button" data-slot="Chiều (14:00 - 17:30)" class="time-slot-pill text-center px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            Chiều (14h–17h30)
                                        </button>
                                        <button type="button" data-slot="Tối (19:30 - 21:30)" class="time-slot-pill text-center px-3 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
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

    </div><!-- /#hc-landing-view -->

    <!-- =========================================================
         TRANG 2 (MỞ TRANG MỚI TỨC THÌ 0MS): TRANG KHẢO SÁT ĐỘC LẬP (#hc-survey-page-view)
         ========================================================= -->
    <div id="hc-survey-page-view" class="hidden min-h-screen py-12 md:py-20 bg-white">
        <div class="max-w-[880px] mx-auto px-4 sm:px-6 lg:px-8">

            <!-- BƯỚC 2: KHẢO SÁT NHANH TRÊN TRANG RIÊNG -->
            <div id="booking-step2-container">

                <!-- Tiêu đề trang khảo sát -->
                <div class="text-center max-w-2xl mx-auto mb-8">
                    <span class="inline-flex items-center gap-2 bg-[#fff7ed] text-secondary border border-orange-200 font-bold text-xs px-4 py-1.5 rounded-full mb-4">
                        <span class="w-2 h-2 rounded-full bg-secondary"></span>
                        <span>Bước 2 / 2 • Hồ sơ tình trạng của con</span>
                    </span>
                    <h1 class="font-serif text-3xl sm:text-4xl font-bold text-navy leading-tight mb-3">
                        Thông tin tình trạng hiện tại của con
                    </h1>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                        Ba mẹ tích chọn nhanh các biểu hiện dưới đây để người phụ trách xem trước hồ sơ trước buổi trao đổi 30 phút.
                    </p>
                </div>

                <!-- Thanh tóm tắt thông tin liên hệ Bước 1 (Nền Xanh than + điểm nhấn Cam) -->
                <div class="bg-navy text-white rounded-2xl p-5 sm:p-6 mb-8 shadow-md">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6 items-center">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 text-secondary flex items-center justify-center shrink-0">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-white/60 uppercase tracking-wider font-semibold">Phụ huynh đăng ký</p>
                                <p id="step2-parent-name" class="text-sm sm:text-base font-bold text-white">ba/mẹ</p>
                            </div>
                        </div>

                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-white/10 text-secondary flex items-center justify-center shrink-0">
                                <i data-lucide="clock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <p class="text-[11px] text-white/60 uppercase tracking-wider font-semibold">Khung giờ trao đổi</p>
                                <p id="step2-preferred-time" class="text-sm sm:text-base font-bold text-white">Sáng (08:30 - 11:30)</p>
                            </div>
                        </div>

                        <div class="flex items-center sm:justify-end">
                            <span class="inline-flex items-center gap-2 bg-secondary/20 text-secondary border border-secondary/40 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-extrabold">
                                <span>Mã hồ sơ:</span>
                                <span id="step2-badge-code" class="text-white">TV-0000</span>
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Khung Form Khảo Sát Chính -->
                <div id="survey-card-wrapper" class="hc-master-card relative">
                    <div class="hc-card-bar"></div>

                    <form id="hieucon-booking-step2-form" class="divide-y divide-slate-200/80" novalidate>
                        <input type="hidden" id="survey-booking-id" name="booking_id" value="">
                        <input type="hidden" id="survey-booking-code" name="booking_code" value="">

                        <!-- MỤC 01: Thông tin cơ bản của bé -->
                        <div class="p-6 sm:p-9">
                            <div class="flex items-center gap-3 mb-5">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">01</span>
                                <h2 class="font-serif text-lg sm:text-xl font-bold text-navy">Thông tin cơ bản của bé</h2>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 items-start">
                                <div class="md:col-span-5">
                                    <label for="survey-child-name" class="block text-xs sm:text-sm font-bold text-navy mb-2">
                                        Tên gọi của bé ở nhà
                                    </label>
                                    <input
                                        type="text"
                                        id="survey-child-name"
                                        name="child_name"
                                        value="<?php echo esc_attr( $prefill_child_name ); ?>"
                                        placeholder="Ví dụ: Bé Bắp / Minh Khôi"
                                        class="w-full px-4 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy text-sm sm:text-base font-medium transition-all"
                                    >
                                </div>

                                <div class="md:col-span-7">
                                    <label class="block text-xs sm:text-sm font-bold text-navy mb-2">
                                        Độ tuổi hiện tại của bé
                                    </label>
                                    <input type="hidden" id="survey-child-age" name="child_age" value="2 – 3 tuổi">
                                    <div class="flex flex-wrap gap-2" data-single-group="survey-child-age">
                                        <?php
                                        $age_options = [ 'Dưới 2 tuổi', '2 – 3 tuổi', '3 – 5 tuổi', '5 – 7 tuổi', 'Trên 7 tuổi' ];
                                        foreach ( $age_options as $idx => $age_label ) :
                                            $active_cls = ( 1 === $idx ) ? 'is-selected' : '';
                                        ?>
                                        <button type="button" data-value="<?php echo esc_attr( $age_label ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold cursor-pointer">
                                            <?php echo esc_html( $age_label ); ?>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- MỤC 02: Vấn đề ba mẹ đang quan tâm nhất -->
                        <div class="p-6 sm:p-9">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">02</span>
                                <h2 class="font-serif text-lg sm:text-xl font-bold text-navy">Vấn đề ba mẹ đang quan tâm nhất ở con</h2>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 mb-4 pl-11">Chọn 1 nhóm vấn đề nổi bật nhất hiện tại:</p>

                            <input type="hidden" id="survey-diagnosis" name="diagnosis" value="Táo bón / tiêu hóa">
                            <div class="flex flex-wrap gap-2.5 pl-0 sm:pl-11" data-single-group="survey-diagnosis">
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
                                <button type="button" data-value="<?php echo esc_attr( $diag ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold cursor-pointer">
                                    <?php echo esc_html( $diag ); ?>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- MỤC 03: Biểu hiện ăn uống & tiêu hóa -->
                        <div class="p-6 sm:p-9">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">03</span>
                                <h2 class="font-serif text-lg sm:text-xl font-bold text-navy">Biểu hiện ăn uống và tiêu hóa hiện tại</h2>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 mb-4 pl-11">Ba mẹ có thể tích chọn nhiều biểu hiện đúng với bé:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-0 sm:pl-11">
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
                                <button type="button" data-multi-name="bio_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
                                    <span class="chip-check-icon w-5 h-5 rounded-md border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </span>
                                    <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- MỤC 04: Biểu hiện hấp thu, vi chất, giấc ngủ & hành vi -->
                        <div class="p-6 sm:p-9">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">04</span>
                                <h2 class="font-serif text-lg sm:text-xl font-bold text-navy">Biểu hiện hấp thu, vi chất, giấc ngủ và hành vi</h2>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 mb-4 pl-11">Ba mẹ có thể tích chọn nhiều biểu hiện đi kèm:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-0 sm:pl-11">
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
                                <button type="button" data-multi-name="behav_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
                                    <span class="chip-check-icon w-5 h-5 rounded-md border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </span>
                                    <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- MỤC 05: Những hướng gia đình đã áp dụng -->
                        <div class="p-6 sm:p-9">
                            <div class="flex items-center gap-3 mb-2">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">05</span>
                                <h2 class="font-serif text-lg sm:text-xl font-bold text-navy">Gia đình đã áp dụng những hướng nào?</h2>
                            </div>
                            <p class="text-xs sm:text-sm text-slate-500 mb-4 pl-11">Giúp đội ngũ hiểu những cách gia đình đã thử qua:</p>

                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 pl-0 sm:pl-11">
                                <?php
                                $tried_methods = [
                                    'Đã dùng men vi sinh, chất xơ hỗ trợ',
                                    'Đang bổ sung một số loại vitamin, vi chất',
                                    'Đã thử điều chỉnh chế độ ăn tại nhà',
                                    'Đang tìm hiểu hướng ưu tiên phù hợp cho con',
                                ];
                                foreach ( $tried_methods as $item ) :
                                ?>
                                <button type="button" data-multi-name="tried_methods[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
                                    <span class="chip-check-icon w-5 h-5 rounded-md border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3.5 h-3.5"></i>
                                    </span>
                                    <span class="leading-snug"><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- MỤC 06: Điều mong muốn làm rõ nhất & Nút hoàn tất -->
                        <div class="p-6 sm:p-9 bg-[#f8fafc]/60">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="w-8 h-8 rounded-lg bg-[#fff7ed] text-secondary border border-orange-200 font-extrabold text-xs flex items-center justify-center shrink-0">06</span>
                                <label for="survey-parent-goal" class="font-serif text-lg sm:text-xl font-bold text-navy">
                                    Điều ba mẹ mong muốn làm rõ nhất trong 30 phút này
                                </label>
                            </div>

                            <div class="pl-0 sm:pl-11 space-y-5">
                                <textarea
                                    id="survey-parent-goal"
                                    name="parent_goal"
                                    rows="3"
                                    placeholder="Chia sẻ ngắn gọn điều gia đình đang trăn trở nhất về tình trạng của con..."
                                    class="w-full px-4 py-3.5 rounded-xl bg-white border border-slate-200 focus:border-secondary outline-none text-navy text-sm sm:text-base transition-all resize-none"
                                ></textarea>

                                <div class="space-y-3 pt-1">
                                    <button
                                        type="submit"
                                        id="booking-step2-btn"
                                        class="w-full py-4 px-8 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base uppercase tracking-wider shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2.5 cursor-pointer"
                                    >
                                        <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                        <span>HOÀN TẤT ĐĂNG KÝ CASE CỦA CON</span>
                                    </button>

                                    <button
                                        type="button"
                                        id="booking-skip-survey-btn"
                                        class="w-full py-1.5 text-center text-xs sm:text-sm font-medium text-slate-500 hover:text-navy underline transition-colors cursor-pointer"
                                    >
                                        Bỏ qua bước khảo sát này →
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>

            </div>

            <!-- MÀN HÌNH 3: HOÀN TẤT -->
            <div id="booking-success-container" class="hidden">
                <div class="hc-master-card relative p-8 sm:p-12 text-center max-w-xl mx-auto">
                    <div class="hc-card-bar absolute top-0 left-0 right-0"></div>

                    <div class="w-16 h-16 rounded-full bg-[#fff7ed] text-secondary flex items-center justify-center mx-auto mb-5">
                        <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                    </div>
                    <span class="inline-block bg-[#fff7ed] text-secondary border border-orange-200 font-bold text-xs px-4 py-1.5 rounded-full mb-4">
                        Mã hồ sơ: <span id="res-booking-code">TV-0000</span>
                    </span>
                    <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-3">Đã tiếp nhận đầy đủ thông tin của gia đình</h3>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-md mx-auto mb-6">
                        Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ sẽ tổng hợp thông tin và liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> (khung giờ: <strong id="res-time" class="text-navy"></strong>) đối với các trường hợp phù hợp trong đợt này.
                    </p>

                    <div id="res-survey-badge" class="hidden inline-flex items-center gap-2 bg-[#f8fafc] text-navy border border-slate-200 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold mb-7">
                        <i data-lucide="file-check-2" class="w-4 h-4 text-secondary"></i>
                        <span>Đã lưu đầy đủ thông tin khảo sát tình trạng của bé</span>
                    </div>

                    <div class="max-w-sm mx-auto space-y-3">
                        <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-4 px-6 rounded-xl bg-navy hover:bg-navy/90 text-white font-bold text-sm sm:text-base flex items-center justify-center gap-2 transition-all">
                            <span>Nhắn xác nhận qua Zalo</span>
                        </a>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block text-xs sm:text-sm font-semibold text-slate-500 hover:text-navy pt-2">
                            ← Quay về trang chủ
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const nonceVal = document.getElementById('booking-nonce') ? document.getElementById('booking-nonce').value : '';

    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.5 });
    }

    // 1. Chọn nhanh Khung giờ
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

    // 6. Chuyển đổi sang Trang Khảo Sát Độc Lập TỨC THÌ (0ms, không chờ mạng)
    const landingView = document.getElementById('hc-landing-view');
    const surveyPageView = document.getElementById('hc-survey-page-view');
    const surveyCardWrapper = document.getElementById('survey-card-wrapper');
    const step2Container = document.getElementById('booking-step2-container');
    const successContainer = document.getElementById('booking-success-container');

    let latestParentName = '';
    let latestPhone = '';
    let latestPreferredTime = '';

    function openStandaloneSurveyPageInstant(parentName, phone, preferredTime, tempCode) {
        latestParentName = parentName;
        latestPhone = phone;
        latestPreferredTime = preferredTime;

        document.getElementById('survey-booking-code').value = tempCode;
        document.getElementById('step2-badge-code').textContent = tempCode;
        document.getElementById('step2-parent-name').textContent = parentName;
        document.getElementById('step2-preferred-time').textContent = preferredTime;

        document.getElementById('res-booking-code').textContent = tempCode;
        document.getElementById('res-parent-name').textContent = parentName;
        document.getElementById('res-phone').textContent = phone;
        document.getElementById('res-time').textContent = preferredTime;

        // Ẩn toàn bộ Landing Page, mở Trang Khảo Sát mới ngay lập tức (0ms)
        if (landingView) landingView.classList.add('hidden');
        if (surveyPageView) surveyPageView.classList.remove('hidden');

        window.scrollTo({ top: 0, behavior: 'instant' });

        if (window.history && window.history.pushState) {
            const newUrl = window.location.pathname + '?step=survey&code=' + encodeURIComponent(tempCode);
            window.history.pushState({ view: 'survey' }, '', newUrl);
        }

        if (typeof lucide !== 'undefined') {
            lucide.createIcons({ strokeWidth: 1.5 });
        }
    }

    window.addEventListener('popstate', function () {
        const params = new URLSearchParams(window.location.search);
        if (params.get('step') === 'survey') {
            if (landingView) landingView.classList.add('hidden');
            if (surveyPageView) surveyPageView.classList.remove('hidden');
        } else {
            if (surveyPageView) surveyPageView.classList.add('hidden');
            if (landingView) landingView.classList.remove('hidden');
        }
    });

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

        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Submit Bước 1: Mở trang khảo sát ngay tức thì (0ms) + lưu ngầm ở hậu trường
    const step1Form = document.getElementById('hieucon-booking-step1-form');
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

            const cleanPhone = phone.replace(/[^0-9+]/g, '');
            if (cleanPhone.length < 9 || cleanPhone.length > 15) {
                step1Error.textContent = 'Số điện thoại không hợp lệ. Vui lòng kiểm tra lại.';
                step1Error.classList.remove('hidden');
                return;
            }

            // Tạo mã chuẩn TVyymmdd-XXXX và mở ngay trang khảo sát mới trong 0ms
            const randSuffix = Math.random().toString(36).replace(/[^a-z0-9]/gi, '').substring(0, 4).toUpperCase().padEnd(4, '9');
            const tempCode = 'TV<?php echo esc_js( wp_date( 'ymd' ) ); ?>-' + randSuffix;
            openStandaloneSurveyPageInstant(parentName, phone, preferredTime, tempCode);

            // Gửi lưu thông tin Bước 1 chạy ngầm ở hậu trường (kèm đúng mã hồ sơ đã cấp)
            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking');
            formData.append('nonce', nonceVal);
            formData.append('booking_code', tempCode);
            formData.append('parent_name', parentName);
            formData.append('phone', phone);
            formData.append('preferred_time', preferredTime);

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                keepalive: true
            })
            .then(res => res.json())
            .then(res => {
                if (res.success && res.data) {
                    document.getElementById('survey-booking-id').value = res.data.booking_id;
                    document.getElementById('survey-booking-code').value = res.data.booking_code;
                    document.getElementById('step2-badge-code').textContent = res.data.booking_code;
                    document.getElementById('res-booking-code').textContent = res.data.booking_code;
                    if (res.data.zalo_url) {
                        document.getElementById('res-zalo-link').href = res.data.zalo_url;
                    }
                    if (res.data.survey_url && window.history && window.history.replaceState) {
                        window.history.replaceState({ view: 'survey' }, '', res.data.survey_url);
                    }
                }
            })
            .catch(() => {});
        });
    }

    // Submit Bước 2: Hiển thị hoàn tất ngay tức thì (0ms) + lưu khảo sát chạy ngầm
    const step2Form = document.getElementById('hieucon-booking-step2-form');
    const skipSurveyBtn = document.getElementById('booking-skip-survey-btn');

    if (skipSurveyBtn) {
        skipSurveyBtn.addEventListener('click', function () {
            transitionToFinalSuccess(false);
        });
    }

    if (step2Form) {
        step2Form.addEventListener('submit', function (e) {
            e.preventDefault();

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking_survey');
            formData.append('nonce', nonceVal);
            formData.append('booking_id', document.getElementById('survey-booking-id').value);
            formData.append('booking_code', document.getElementById('survey-booking-code').value);
            formData.append('parent_name', latestParentName);
            formData.append('phone', latestPhone);
            formData.append('preferred_time', latestPreferredTime);
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

            // Chuyển sang màn hình Hoàn tất ngay lập tức (0ms)
            transitionToFinalSuccess(true);

            // Lưu dữ liệu khảo sát ở hậu trường
            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                keepalive: true
            }).catch(() => {});
        });
    }
});
</script>

<?php get_footer(); ?>
