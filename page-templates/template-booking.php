<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 Phút Để Nhìn Rõ Vấn Đề Của Con" - Quy trình 2 bước (Giữ lịch cơ bản -> Khảo sát tình trạng của bé trên 1 khung).
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
    .glass-card-booking {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.84) 100%);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.92);
    }
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

<main id="primary" class="site-main min-h-screen pb-24 pt-6 md:pt-10 relative overflow-hidden">
    <!-- Decorative background blobs -->
    <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- =========================================================
             PHẦN MỞ ĐẦU (HERO) + KHUNG ĐĂNG KÝ 2 BƯỚC
             Câu lõi: 30 PHÚT ĐỂ NHÌN RÕ VẤN ĐỀ CỦA CON
             Thông điệp: Hiểu trước khi can thiệp. Ưu tiên trước khi làm quá nhiều.
             ========================================================= -->
        <section id="booking-hero-grid" class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-14 items-start pt-2 md:pt-6 transition-all duration-500">

            <!-- CỘT TRÁI: THÔNG ĐIỆP CỐT LÕI (7/12 ở Bước 1, thu gọn 5/12 ở Bước 2) -->
            <div id="booking-left-col" class="lg:col-span-7 flex flex-col justify-center lg:pr-4 transition-all duration-500">
                <div class="inline-flex items-center gap-2 self-start bg-white/85 backdrop-blur-md border border-navy/10 px-4 py-2 rounded-full shadow-soft mb-6">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                    <span class="text-navy font-extrabold text-xs uppercase tracking-widest">Phiên làm việc 1:1 • Giới hạn số ca mỗi tuần</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-4xl xl:text-[2.9rem] font-bold text-navy leading-[1.18] mb-5">
                    30 Phút Để Nhìn Rõ<br class="hidden sm:inline" />
                    <span class="text-secondary italic">Vấn Đề Của Con</span>
                </h1>

                <!-- Thông điệp phía sau -->
                <div class="bg-navy text-white rounded-2xl p-5 sm:p-6 mb-7 shadow-premium relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 w-28 h-28 rounded-full bg-secondary/20 blur-xl pointer-events-none"></div>
                    <p class="text-[11px] font-extrabold uppercase tracking-widest text-secondary mb-1.5">Nguyên tắc cốt lõi của Hiểu Con Từ Gốc</p>
                    <p class="font-serif italic text-xl sm:text-2xl font-bold leading-snug text-white">
                        “Hiểu trước khi can thiệp. Ưu tiên trước khi làm quá nhiều.”
                    </p>
                </div>

                <p class="text-navy/80 text-base sm:text-lg font-medium leading-relaxed mb-7">
                    Khi con gặp khó khăn về <strong class="text-navy">ăn uống, tiêu hoá, giấc ngủ, hành vi hay vi chất</strong>, điều ba mẹ thiếu thường không phải là thêm một mẹo mới — mà là một khoảng lặng có chuyên môn để <strong class="text-navy">nhìn tổng thể những gì đang diễn ra trong cơ thể con</strong> và biết nên ưu tiên điều gì trước.
                </p>

                <!-- 4 Giá trị cốt lõi của buổi 30 phút -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5 mb-7">
                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-secondary/12 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="target" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-sm sm:text-base mb-0.5">1. Xác định vấn đề nổi bật</h3>
                            <p class="text-navy/70 text-xs font-medium leading-relaxed">
                                Gọi tên đúng nút thắt lớn nhất đang cản trở con hiện tại.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-primary/12 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="network" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-sm sm:text-base mb-0.5">2. Nhìn các yếu tố liên quan</h3>
                            <p class="text-navy/70 text-xs font-medium leading-relaxed">
                                Kết nối tiêu hoá, giấc ngủ, ăn uống với biểu hiện hành vi của con.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-navy/10 text-navy flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="list-filter" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-sm sm:text-base mb-0.5">3. Xác định điều cần ưu tiên</h3>
                            <p class="text-navy/70 text-xs font-medium leading-relaxed">
                                Biết việc gì cần làm trước, việc gì chưa cần vội để tránh quá tải.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-start gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/12 text-emerald-700 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="compass" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-sm sm:text-base mb-0.5">4. Biết bước tiếp theo là gì</h3>
                            <p class="text-navy/70 text-xs font-medium leading-relaxed">
                                Có hướng đi rõ ràng, thực tế và phù hợp với hoàn cảnh gia đình.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Lưu ý: Không phải tư vấn đại trà -->
                <div class="bg-amber-50/90 border border-amber-200/90 rounded-2xl p-4 flex items-start gap-3 text-xs sm:text-sm text-navy/85">
                    <i data-lucide="sliders-horizontal" class="w-5 h-5 text-secondary shrink-0 mt-0.5"></i>
                    <p class="leading-relaxed font-medium">
                        <strong class="text-navy font-extrabold">Lưu ý trước khi đăng ký:</strong> Đây không phải buổi tư vấn đại trà. Đội ngũ có giới hạn số ca mỗi tuần và <strong class="text-navy">xem xét kỹ thông tin khảo sát trước buổi hẹn</strong> để chỉ nhận những trường hợp thực sự phù hợp.
                    </p>
                </div>
            </div>

            <!-- CỘT PHẢI: KHUNG ĐĂNG KÝ 2 BƯỚC (5/12 ở Bước 1, mở rộng 7/12 ở Bước 2) -->
            <div id="booking-right-col" class="lg:col-span-5 w-full lg:sticky lg:top-28 transition-all duration-500">
                <div id="booking-card-wrapper" class="glass-card-booking rounded-[2rem] p-6 sm:p-8 xl:p-9 shadow-premium relative overflow-hidden">
                    <!-- Top accent bar -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-navy via-secondary to-primary"></div>

                    <!-- THANH TIẾN TRÌNH 2 BƯỚC -->
                    <div id="booking-stepper" class="flex items-center justify-between gap-2 pb-5 mb-6 border-b border-navy/10">
                        <div id="step-indicator-1" class="flex items-center gap-2.5">
                            <span id="step-badge-1" class="w-7 h-7 rounded-full bg-navy text-white text-xs font-extrabold flex items-center justify-center shadow-sm">1</span>
                            <div>
                                <span class="block text-[10px] font-extrabold uppercase tracking-wider text-secondary">Bước 1 / 2</span>
                                <span class="block text-xs font-bold text-navy">Thông tin liên hệ</span>
                            </div>
                        </div>

                        <div class="flex-1 h-0.5 bg-navy/10 mx-2 rounded-full overflow-hidden">
                            <div id="step-progress-bar" class="h-full bg-gradient-to-r from-secondary to-primary w-1/2 transition-all duration-500"></div>
                        </div>

                        <div id="step-indicator-2" class="flex items-center gap-2.5 opacity-50 transition-opacity duration-300">
                            <span id="step-badge-2" class="w-7 h-7 rounded-full bg-navy/10 text-navy text-xs font-extrabold flex items-center justify-center">2</span>
                            <div>
                                <span class="block text-[10px] font-extrabold uppercase tracking-wider text-navy/60">Bước 2 / 2</span>
                                <span class="block text-xs font-bold text-navy">Khảo sát trước buổi hẹn</span>
                            </div>
                        </div>
                    </div>

                    <!-- ==========================================
                         BƯỚC 1: FORM THÔNG TIN CƠ BẢN (GIỮ LỊCH HẸN)
                         ========================================== -->
                    <div id="booking-step1-container">
                        <div class="mb-6">
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Đăng Ký Buổi 30 Phút 1:1</h2>
                            <p class="text-navy/65 text-xs sm:text-sm font-medium mt-1">
                                Điền thông tin liên hệ cơ bản trước, sau đó ba mẹ sẽ chuyển sang bước <strong>khảo sát nhanh tình trạng của con</strong> để đội ngũ xem xét hồ sơ trước buổi hẹn.
                            </p>
                        </div>

                        <form id="hieucon-booking-step1-form" class="space-y-5" novalidate>
                            <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                            <!-- 1. Họ tên ba/mẹ -->
                            <div>
                                <label for="booking-parent-name" class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2">
                                    1. Họ và tên ba/mẹ <span class="text-secondary">*</span>
                                </label>
                                <div class="relative">
                                    <i data-lucide="user" class="w-4 h-4 text-navy/40 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                    <input
                                        type="text"
                                        id="booking-parent-name"
                                        name="parent_name"
                                        value="<?php echo esc_attr( $prefill_name ); ?>"
                                        required
                                        placeholder="Ví dụ: Mẹ Nguyễn Thu Hà"
                                        class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-white border border-navy/15 focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                    >
                                </div>
                            </div>

                            <!-- 2. Số điện thoại / Zalo -->
                            <div>
                                <label for="booking-phone" class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2">
                                    2. Số điện thoại / Zalo liên hệ <span class="text-secondary">*</span>
                                </label>
                                <div class="relative">
                                    <i data-lucide="phone-call" class="w-4 h-4 text-navy/40 absolute left-4 top-1/2 -translate-y-1/2 pointer-events-none"></i>
                                    <input
                                        type="tel"
                                        id="booking-phone"
                                        name="phone"
                                        value="<?php echo esc_attr( $prefill_phone ); ?>"
                                        required
                                        placeholder="Nhập số điện thoại có dùng Zalo..."
                                        class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-white border border-navy/15 focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                    >
                                </div>
                            </div>

                            <!-- 3. Khung giờ mong muốn -->
                            <div>
                                <label class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2">
                                    3. Khung giờ ba/mẹ thuận tiện trao đổi 30 phút <span class="text-secondary">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-2 mb-2.5" id="time-slot-group">
                                    <button type="button" data-slot="Sáng (08:30 - 11:30)" class="time-slot-pill is-active text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                                        <i data-lucide="sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Sáng (8h30 – 11h30)</span>
                                    </button>
                                    <button type="button" data-slot="Trưa (12:00 - 13:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                                        <i data-lucide="coffee" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Trưa (12h00 – 13h30)</span>
                                    </button>
                                    <button type="button" data-slot="Chiều (14:00 - 17:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                                        <i data-lucide="cloud-sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Chiều (14h00 – 17h30)</span>
                                    </button>
                                    <button type="button" data-slot="Tối (19:30 - 21:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2 cursor-pointer">
                                        <i data-lucide="moon" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Tối (19h30 – 21h30)</span>
                                    </button>
                                </div>
                                <input
                                    type="text"
                                    id="booking-preferred-time"
                                    name="preferred_time"
                                    value="Sáng (08:30 - 11:30)"
                                    placeholder="Hoặc ghi rõ ngày/giờ cụ thể ba mẹ mong muốn..."
                                    class="w-full px-4 py-2.5 rounded-xl bg-white/90 border border-navy/10 focus:border-secondary outline-none text-navy font-semibold text-xs transition-all"
                                >
                            </div>

                            <!-- Thông báo lỗi Bước 1 -->
                            <div id="booking-step1-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                            <!-- Nút Tiếp tục sang Bước 2 -->
                            <button
                                type="submit"
                                id="booking-step1-btn"
                                class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark hover:from-secondary_dark hover:to-secondary text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(249,115,22,0.45)] hover:shadow-[0_14px_30px_-5px_rgba(249,115,22,0.6)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2.5 cursor-pointer"
                            >
                                <span>Tiếp Tục: Khảo Sát Vấn Đề Của Con</span>
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </button>

                            <div class="flex items-center justify-center gap-4 text-[11px] font-bold text-navy/55 pt-1">
                                <span class="flex items-center gap-1"><i data-lucide="shield-check" class="w-3.5 h-3.5 text-primary"></i> Không chèo kéo, ép mua</span>
                                <span>•</span>
                                <span class="flex items-center gap-1"><i data-lucide="lock" class="w-3.5 h-3.5 text-secondary"></i> Bảo mật 100%</span>
                            </div>
                        </form>
                    </div>

                    <!-- ==========================================
                         BƯỚC 2: KHẢO SÁT NHANH TRÊN 1 KHUNG DUY NHẤT
                         ========================================== -->
                    <div id="booking-step2-container" class="hidden">
                        <!-- Thông báo đã giữ lịch thành công ở Bước 1 -->
                        <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-4 mb-6 flex items-start gap-3">
                            <div class="w-8 h-8 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs leading-relaxed text-emerald-950">
                                <p class="font-extrabold text-sm text-emerald-900">
                                    Đã ghi nhận thông tin liên hệ (<span id="step2-badge-code" class="underline">TV-0000</span>)!
                                </p>
                                <p class="font-medium mt-0.5">
                                    Vì đội ngũ <strong>xem xét kỹ thông tin trước mỗi buổi hẹn</strong> để chuẩn bị hướng phân tích sát nhất, ba mẹ dành thêm <strong>1 phút tích chọn các vấn đề con đang gặp</strong> dưới đây nhé:
                                </p>
                            </div>
                        </div>

                        <form id="hieucon-booking-step2-form" class="space-y-6" novalidate>
                            <input type="hidden" id="survey-booking-id" name="booking_id" value="">
                            <input type="hidden" id="survey-booking-code" name="booking_code" value="">

                            <!-- MỤC 1: THÔNG TIN CƠ BẢN CỦA BÉ -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy mb-3 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">1</span>
                                    Thông tin cơ bản của bé
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-12 gap-4">
                                    <div class="sm:col-span-5">
                                        <label for="survey-child-name" class="block text-[11px] font-bold text-navy/70 mb-1.5">Tên gọi ở nhà / Họ tên bé</label>
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
                                        <label class="block text-[11px] font-bold text-navy/70 mb-1.5">Độ tuổi hiện tại của bé</label>
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

                            <!-- MỤC 2: TÌNH TRẠNG / CHẨN ĐOÁN HIỆN TẠI -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy mb-2.5 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">2</span>
                                    Tình trạng hoặc chẩn đoán hiện tại của bé
                                </h3>
                                <input type="hidden" id="survey-diagnosis" name="diagnosis" value="Chậm nói / Giao tiếp">
                                <div class="flex flex-wrap gap-2" data-single-group="survey-diagnosis">
                                    <?php
                                    $diagnoses = [
                                        'Chậm nói / Giao tiếp',
                                        'Theo dõi / Nghi ngờ tự kỷ (ASD)',
                                        'Đã có chẩn đoán Tự kỷ (ASD)',
                                        'Tăng động giảm chú ý (ADHD)',
                                        'Chưa thăm khám / Khác',
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

                            <!-- MỤC 3: ĂN UỐNG, TIÊU HOÁ, GIẤC NGỦ & VI CHẤT (CHỌN NHIỀU) -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <div class="flex items-center justify-between gap-2 mb-2.5">
                                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">3</span>
                                        Vấn đề Ăn uống, Tiêu hoá, Giấc ngủ & Vi chất
                                    </h3>
                                    <span class="text-[11px] font-bold text-secondary">Tích chọn nhiều mục</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <?php
                                    $bio_symptoms = [
                                        'Táo bón / Phân cứng, vón cục',
                                        'Phân sống, lỏng nát / Tiêu chảy',
                                        'Đầy hơi, bụng căng phình, ợ chua',
                                        'Kén ăn cực đoan / Chỉ ăn đồ mềm, tránh nhai',
                                        'Khó vào giấc, ngủ trằn trọc, hay thức đêm',
                                        'Hay ốm vặt, dị ứng, chàm da / mẩn ngứa',
                                        'Hơi thở có mùi / Nghiến răng khi ngủ',
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

                            <!-- MỤC 4: BIỂU HIỆN HÀNH VI, CẢM XÚC & NGÔN NGỮ (CHỌN NHIỀU) -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <div class="flex items-center justify-between gap-2 mb-2.5">
                                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-primary/15 text-primary flex items-center justify-center text-[11px]">4</span>
                                        Vấn đề Hành vi, Cảm giác & Ngôn ngữ
                                    </h3>
                                    <span class="text-[11px] font-bold text-primary">Tích chọn nhiều mục</span>
                                </div>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <?php
                                    $behav_symptoms = [
                                        'Chưa có ngôn ngữ / Chỉ kéo tay người lớn',
                                        'Nói nhại lời / Phát âm không rõ, chảy dãi',
                                        'Ít giao tiếp mắt / Gọi tên ít phản ứng',
                                        'Hay la hét, ăn vạ, bùng nổ cảm xúc',
                                        'Tăng động, chạy nhảy liên tục, mất tập trung',
                                        'Hành vi lặp lại (nhón gót, vẫy tay, xoay tròn...)',
                                        'Nhạy cảm âm thanh / Sợ cắt tóc, cắt móng tay',
                                        'Khó chuyển đổi hoạt động / Dễ căng thẳng',
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

                            <!-- MỤC 5: NHỮNG CÁCH GIA ĐÌNH ĐÃ THỬ -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy mb-2.5 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-navy/10 text-navy flex items-center justify-center text-[11px]">5</span>
                                    Gia đình đã hoặc đang thử những hướng nào?
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <?php
                                    $tried_methods = [
                                        'Đang học can thiệp giáo dục đặc biệt / âm ngữ',
                                        'Đã áp dụng chế độ ăn kiêng (GFCF / giảm đường, sữa)',
                                        'Đang bổ sung men vi sinh / vi chất (Omega-3, GABA, Kẽm...)',
                                        'Đã thử nhiều mẹo nhưng chưa rõ nên ưu tiên gì trước',
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

                            <!-- MỤC 6: ĐIỀU BA MẸ ĐANG RỐI HOẶC MONG MUỐN NHÌN RÕ NHẤT -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <label for="survey-parent-goal" class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">6</span>
                                    Điều ba mẹ đang bối rối nhất hoặc muốn làm rõ nhất trong 30 phút này:
                                </label>
                                <textarea
                                    id="survey-parent-goal"
                                    name="parent_goal"
                                    rows="2"
                                    placeholder="Ví dụ: Con vừa táo bón vừa khó ngủ và hay la hét, mẹ đã thử bổ sung men nhưng chưa cải thiện, muốn biết nên ưu tiên xử lý từ đâu trước..."
                                    class="w-full px-3.5 py-2.5 rounded-xl bg-white border border-navy/15 focus:border-secondary outline-none text-navy font-medium text-xs transition-all resize-none"
                                ></textarea>
                            </div>

                            <!-- Thông báo lỗi Bước 2 -->
                            <div id="booking-step2-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                            <!-- Nút Hoàn tất Khảo sát hoặc Bỏ qua -->
                            <div class="space-y-3 pt-1">
                                <button
                                    type="submit"
                                    id="booking-step2-btn"
                                    class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-primary to-teal-700 hover:opacity-95 text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(13,148,136,0.4)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2.5 cursor-pointer"
                                >
                                    <i data-lucide="clipboard-check" class="w-5 h-5"></i>
                                    <span>Hoàn Tất Hồ Sơ Cho Buổi 30 Phút</span>
                                </button>

                                <button
                                    type="button"
                                    id="booking-skip-survey-btn"
                                    class="w-full py-2.5 text-center text-xs font-bold text-navy/55 hover:text-navy underline transition-colors cursor-pointer"
                                >
                                    Tôi đang bận, bỏ qua bước khảo sát này và giữ lịch hẹn →
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- ==========================================
                         MÀN HÌNH XÁC NHẬN HOÀN TẤT (SAU BƯỚC 2)
                         ========================================== -->
                    <div id="booking-success-container" class="hidden text-center py-4">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                        </div>
                        <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded-full mb-2">
                            Mã hồ sơ: <span id="res-booking-code">TV-0000</span>
                        </span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã Tiếp Nhận Hồ Sơ Của Gia Đình!</h3>
                        <p class="text-navy/70 text-sm font-medium leading-relaxed mb-4">
                            Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ chuyên môn <strong>Hiểu Con Từ Gốc</strong> sẽ xem xét kỹ thông tin của bé và liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> vào khung giờ <strong id="res-time" class="text-navy"></strong>.
                        </p>

                        <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-teal-50 text-teal-800 border border-teal-200 px-3.5 py-1.5 rounded-xl text-xs font-bold mb-6">
                            <i data-lucide="file-check-2" class="w-4 h-4 text-teal-600"></i>
                            <span>Hồ sơ khảo sát của bé đã được gửi tới bộ phận chuyên môn</span>
                        </div>

                        <div class="bg-[#f8fafc] border border-navy/10 rounded-2xl p-4 text-left mb-6">
                            <p class="text-xs font-extrabold text-navy uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                                <i data-lucide="sparkles" class="w-4 h-4 text-secondary"></i> Quy trình tiếp theo:
                            </p>
                            <p class="text-xs text-navy/75 leading-relaxed">
                                Chuyên viên phụ trách sẽ đọc trước hồ sơ của bé và nhắn xác nhận lịch hẹn 30 phút qua <strong>Zalo</strong>. Ba mẹ có thể bấm nút bên dưới để chủ động kết nối Zalo ngay.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0068FF] to-[#0052CC] hover:opacity-95 text-white font-extrabold text-sm uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all">
                                <span class="font-black text-base leading-none">Z</span>
                                <span>Kết Nối Zalo Xác Nhận Lịch Hẹn</span>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/bo-cong-cu-suc-khoe/' ) ); ?>" class="w-full py-3 px-5 rounded-xl bg-navy hover:bg-navy/85 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-secondary"></i>
                                <span>Xem Thêm Bộ Công Cụ Đánh Giá Sức Khỏe</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- =========================================================
             Ý CỐT LÕI 1: CHA MẸ ĐANG GẶP VẤN ĐỀ THẬT VỚI CON
             (Ăn uống • Tiêu hoá • Giấc ngủ • Hành vi • Vi chất/Dinh dưỡng)
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-secondary font-extrabold text-xs uppercase tracking-widest block mb-2">Bước 1 trong hành trình nhận thức</span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight mb-4">
                    Có Phải Gia Đình Mình Đang Đối Mặt Với<br class="hidden sm:inline" /> Những Trăn Trở Này Mỗi Ngày?
                </h2>
                <p class="text-navy/70 text-sm sm:text-base font-medium leading-relaxed">
                    Nhiều ba mẹ tìm đến <strong>Hiểu Con Từ Gốc</strong> khi những khó khăn dưới đây đã kéo dài nhiều tháng, thậm chí nhiều năm làm cả con và gia đình đều mệt mỏi:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- 1. Ăn uống -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft flex flex-col justify-between hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-orange-500/10 text-secondary flex items-center justify-center mb-4">
                            <i data-lucide="utensils" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-2">1. Ăn uống</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Kén ăn cực đoan, chỉ ăn lặp lại vài món cố định, nhạy cảm với độ thô, ngậm thức ăn lâu, nhai nuốt kém hoặc lại quá thèm đồ ngọt, sữa, tinh bột.
                        </p>
                    </div>
                    <span class="mt-4 pt-3 border-t border-navy/5 text-[11px] font-extrabold text-secondary uppercase tracking-wider block">Bữa ăn luôn căng thẳng</span>
                </div>

                <!-- 2. Tiêu hoá -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft flex flex-col justify-between hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center mb-4">
                            <i data-lucide="activity" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-2">2. Tiêu hoá</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Táo bón dai dẳng, phân cứng vón cục hoặc phân sống, lỏng nát thất thường; bụng thường xuyên căng phình, đầy hơi, ợ chua, hơi thở có mùi.
                        </p>
                    </div>
                    <span class="mt-4 pt-3 border-t border-navy/5 text-[11px] font-extrabold text-amber-700 uppercase tracking-wider block">Đường ruột bất ổn</span>
                </div>

                <!-- 3. Giấc ngủ -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft flex flex-col justify-between hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center mb-4">
                            <i data-lucide="moon-star" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-2">3. Giấc ngủ</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Rất khó vào giấc, trằn trọc lăn lộn hàng giờ, ngủ nông dễ giật mình, nghiến răng, đổ mồ hôi trộm hoặc thức dậy giữa đêm tỉnh táo, quấy khóc.
                        </p>
                    </div>
                    <span class="mt-4 pt-3 border-t border-navy/5 text-[11px] font-extrabold text-indigo-600 uppercase tracking-wider block">Cơ thể khó phục hồi</span>
                </div>

                <!-- 4. Hành vi -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft flex flex-col justify-between hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center mb-4">
                            <i data-lucide="zap" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-2">4. Hành vi</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Hay la hét, ăn vạ kéo dài, bùng nổ cảm xúc không rõ lý do; chạy nhảy liên tục, khó ngồi yên, mất tập trung khiến việc học can thiệp chậm tiến bộ.
                        </p>
                    </div>
                    <span class="mt-4 pt-3 border-t border-navy/5 text-[11px] font-extrabold text-rose-600 uppercase tracking-wider block">Hệ thần kinh quá tải</span>
                </div>

                <!-- 5. Vi chất / Dinh dưỡng -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft flex flex-col justify-between hover:-translate-y-1 transition-all duration-300">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-primary flex items-center justify-center mb-4">
                            <i data-lucide="flask-conical" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-2">5. Vi chất & Dinh dưỡng</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Con thiếu hụt vi chất, hay ốm vặt, chàm da/dị ứng; hoặc ba mẹ đứng trước hàng chục loại men, vitamin, Omega-3 mà không biết con thực sự cần gì.
                        </p>
                    </div>
                    <span class="mt-4 pt-3 border-t border-navy/5 text-[11px] font-extrabold text-primary uppercase tracking-wider block">Bổ sung nhưng kém hấp thu</span>
                </div>
            </div>
        </section>

        <!-- =========================================================
             Ý CỐT LÕI 2 & 3: VẤN ĐỀ KHÔNG ĐỨNG RIÊNG LẺ &
             ĐIỀU CHA MẸ THIẾU KHÔNG PHẢI LÀ THÊM MỘT MẸO
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="glass-card-booking rounded-[2.5rem] p-7 sm:p-10 lg:p-14 shadow-premium">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                    <!-- Cột trái: Phân tích vì sao cha mẹ bị rối -->
                    <div class="lg:col-span-7 space-y-6">
                        <span class="text-secondary font-extrabold text-xs uppercase tracking-widest block">Vì sao càng làm nhiều càng dễ rối?</span>
                        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                            Vấn Đề Của Con Không Đứng Riêng Lẻ — Và Điều Ba Mẹ Thiếu Không Phải Là Thêm Một Mẹo
                        </h2>

                        <div class="space-y-4 text-navy/80 text-sm sm:text-base font-medium leading-relaxed">
                            <p>
                                Khi con khó ngủ, chúng ta tìm mẹo giúp ngủ ngon. Khi con táo bón, chúng ta đổi loại men hoặc chất xơ. Khi con mất tập trung hay bùng nổ hành vi, chúng ta lại vội vã tăng giờ học hoặc tìm thêm thực phẩm bổ não.
                            </p>
                            <p>
                                Thực tế, <strong class="text-navy">một biểu hiện bề nổi của con thường là kết quả của nhiều yếu tố đang tác động qua lại</strong>: một đường ruột đang viêm hoặc táo bón có thể khiến con bức bối trong người, dẫn đến khó ngủ ban đêm và cáu gắt, giảm chú ý vào ngày hôm sau.
                            </p>
                            <p>
                                Hầu hết ba mẹ đều đã đọc rất nhiều, thử rất nhiều cách. Nhưng nếu vẫn nhìn từng triệu chứng rời rạc và thử thêm giải pháp một cách ngẫu nhiên, gia đình sẽ rất dễ rơi vào vòng lặp <strong class="text-navy">tốn kém – quá tải – mà vẫn không biết đâu mới là điểm mấu chốt</strong>.
                            </p>
                        </div>
                    </div>

                    <!-- Cột phải: Khung Chuyển Dịch Nhận Thức -->
                    <div class="lg:col-span-5">
                        <div class="bg-navy text-white rounded-3xl p-6 sm:p-8 shadow-premium space-y-6 relative overflow-hidden">
                            <div class="absolute -top-10 -right-10 w-36 h-36 rounded-full bg-secondary/15 blur-2xl pointer-events-none"></div>

                            <div class="bg-white/8 border border-white/15 rounded-2xl p-4">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-rose-300 flex items-center gap-1.5 mb-1.5">
                                    <i data-lucide="x-circle" class="w-4 h-4"></i> Thay vì tiếp tục hỏi:
                                </span>
                                <p class="font-serif italic text-base sm:text-lg text-white/85">
                                    “Tôi cần tìm thêm mẹo gì, mua thêm loại gì để thử tiếp cho con?”
                                </p>
                            </div>

                            <div class="flex justify-center">
                                <div class="w-9 h-9 rounded-full bg-secondary text-white flex items-center justify-center shadow-md">
                                    <i data-lucide="arrow-down" class="w-5 h-5"></i>
                                </div>
                            </div>

                            <div class="bg-gradient-to-br from-secondary/25 to-primary/25 border border-secondary/50 rounded-2xl p-5">
                                <span class="text-[11px] font-extrabold uppercase tracking-wider text-amber-300 flex items-center gap-1.5 mb-1.5">
                                    <i data-lucide="check-circle-2" class="w-4 h-4"></i> Hãy chuyển sang bước đi vững chắc hơn:
                                </span>
                                <p class="font-serif font-bold text-lg sm:text-xl text-white leading-snug">
                                    “Tôi cần nhìn tổng thể để hiểu rõ vấn đề của con trước — và biết chính xác điều gì cần ưu tiên làm đầu tiên.”
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================
             Ý CỐT LÕI 4: BUỔI 30 PHÚT GIÚP LÀM RÕ VẤN ĐỀ NHƯ THẾ NÀO?
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-primary font-extrabold text-xs uppercase tracking-widest block mb-2">Giá trị thực sự của 30 phút 1:1</span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight mb-4">
                    30 Phút Này Giúp Ba Mẹ Làm Rõ 4 Điều Quan Trọng Nhất
                </h2>
                <p class="text-navy/70 text-sm sm:text-base font-medium leading-relaxed">
                    Giá trị cốt lõi của buổi hẹn không nằm ở hai chữ “miễn phí”, mà ở việc giúp ba mẹ gỡ bỏ sự mơ hồ và có được một bức tranh sáng rõ về tình trạng hiện tại của con:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="glass-card-booking p-7 rounded-3xl shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">01</span>
                    <div class="w-12 h-12 rounded-2xl bg-navy text-white flex items-center justify-center mb-5">
                        <i data-lucide="focus" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2.5">Xác định vấn đề nổi bật</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Giữa hàng loạt triệu chứng làm ba mẹ lo lắng, cùng bóc tách xem đâu mới là rào cản cốt lõi nhất đang ảnh hưởng trực tiếp đến sức khỏe và sự phát triển của con.
                    </p>
                </div>

                <div class="glass-card-booking p-7 rounded-3xl shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">02</span>
                    <div class="w-12 h-12 rounded-2xl bg-secondary text-white flex items-center justify-center mb-5">
                        <i data-lucide="git-merge" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2.5">Nhìn các yếu tố liên quan</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Xâu chuỗi mối liên hệ giữa chế độ ăn, tiêu hoá, giấc ngủ, vi chất và hành vi để ba mẹ hiểu vì sao các biểu hiện đó lại xuất hiện cùng nhau ở con.
                    </p>
                </div>

                <div class="glass-card-booking p-7 rounded-3xl shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">03</span>
                    <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center mb-5">
                        <i data-lucide="list-ordered" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2.5">Xác định điều cần ưu tiên</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Không ôm đồm làm tất cả cùng lúc. Ba mẹ biết rõ 1–2 mục tiêu quan trọng nhất cần tập trung xử lý trước để tạo đà thay đổi bền vững cho cơ thể con.
                    </p>
                </div>

                <div class="glass-card-booking p-7 rounded-3xl shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">04</span>
                    <div class="w-12 h-12 rounded-2xl bg-emerald-600 text-white flex items-center justify-center mb-5">
                        <i data-lucide="footprints" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2.5">Biết bước tiếp theo là gì</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Kết thúc 30 phút, ba mẹ có định hướng rõ ràng về bước tiếp theo nên thực hiện tại nhà hoặc cần theo dõi thêm chỉ số nào cho con.
                    </p>
                </div>
            </div>
        </section>

        <!-- =========================================================
             Ý CỐT LÕI 5: ĐÂY KHÔNG PHẢI TƯ VẤN ĐẠI TRÀ
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="bg-navy text-white rounded-[2.5rem] p-8 sm:p-12 lg:p-14 shadow-premium relative overflow-hidden">
                <div class="absolute -bottom-20 -right-20 w-80 h-80 rounded-full bg-primary/20 blur-3xl pointer-events-none"></div>

                <div class="max-w-3xl mb-10">
                    <span class="inline-block bg-secondary/20 text-secondary border border-secondary/40 font-extrabold text-xs uppercase tracking-widest px-3.5 py-1 rounded-full mb-4">
                        Sự nghiêm túc từ cả hai phía
                    </span>
                    <h2 class="font-serif text-2xl sm:text-4xl font-bold text-white leading-tight mb-4">
                        Vì Sao Đây Không Phải Là Một Buổi Tư Vấn Đại Trà?
                    </h2>
                    <p class="text-white/75 text-sm sm:text-base font-medium leading-relaxed">
                        Chúng tôi không tổ chức những cuộc gọi qua loa theo kịch bản có sẵn. Để 30 phút thực sự mang lại giá trị rõ ràng cho từng gia đình, quy trình làm việc được thiết kế có chọn lọc:
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white/8 border border-white/15 rounded-3xl p-6">
                        <div class="w-11 h-11 rounded-2xl bg-secondary/20 text-secondary flex items-center justify-center mb-4">
                            <i data-lucide="calendar-clock" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-white mb-2">1. Giới hạn số ca mỗi tuần</h3>
                        <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                            Mỗi tuần đội ngũ chỉ nhận một số lượng lịch hẹn giới hạn để đảm bảo người phụ trách có đủ thời gian nghiên cứu kỹ hồ sơ và lắng nghe sâu sát từng trường hợp.
                        </p>
                    </div>

                    <div class="bg-white/8 border border-white/15 rounded-3xl p-6">
                        <div class="w-11 h-11 rounded-2xl bg-primary/25 text-teal-300 flex items-center justify-center mb-4">
                            <i data-lucide="file-search" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-white mb-2">2. Xem xét thông tin trước buổi hẹn</h3>
                        <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                            Thông tin khảo sát ở Bước 2 được xem xét trước để buổi 30 phút không mất thời gian hỏi lại từ đầu, mà đi thẳng vào phân tích vấn đề và thứ tự ưu tiên của con.
                        </p>
                    </div>

                    <div class="bg-white/8 border border-white/15 rounded-3xl p-6">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center mb-4">
                            <i data-lucide="user-check" class="w-6 h-6"></i>
                        </div>
                        <h3 class="font-serif font-bold text-lg text-white mb-2">3. Chỉ nhận trường hợp phù hợp</h3>
                        <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                            Buổi 30 phút dành riêng cho những ba mẹ thực sự mong muốn tìm hiểu nguyên nhân gốc rễ bên trong cơ thể con và sẵn sàng đồng hành kiên trì, khoa học.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- =========================================================
             Ý CỐT LÕI 6: 5 ĐIỀU GIÚP CHA MẸ HOÀN TOÀN AN TÂM KHI ĐĂNG KÝ
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-secondary font-extrabold text-xs uppercase tracking-widest block mb-2">Giải đáp minh bạch trước khi đăng ký</span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight mb-4">
                    5 Điều Giúp Ba Mẹ Hoàn Toàn An Tâm Khi Đặt Lịch
                </h2>
                <p class="text-navy/70 text-sm sm:text-base font-medium leading-relaxed">
                    Chúng tôi hiểu việc chia sẻ câu chuyện của con cần rất nhiều sự tin tưởng. Dưới đây là những cam kết rõ ràng từ <strong>Hiểu Con Từ Gốc</strong>:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Câu hỏi 1 -->
                <div class="glass-card-booking p-6 sm:p-7 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg sm:text-xl text-navy mb-2.5 flex items-start gap-3">
                        <span class="w-7 h-7 rounded-full bg-secondary/15 text-secondary text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">?</span>
                        <span>1. Gia đình tôi có phù hợp với buổi 30 phút này không?</span>
                    </h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed pl-10">
                        Phù hợp nếu con đang gặp các vấn đề về <strong>ăn uống, tiêu hoá, giấc ngủ, hành vi, chậm nói, tự kỷ (ASD), tăng động (ADHD) hoặc rối loạn vi chất</strong> mà ba mẹ đang bối rối chưa rõ nguyên nhân liên quan hay nên ưu tiên xử lý từ đâu trước.
                    </p>
                </div>

                <!-- Câu hỏi 2 -->
                <div class="glass-card-booking p-6 sm:p-7 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg sm:text-xl text-navy mb-2.5 flex items-start gap-3">
                        <span class="w-7 h-7 rounded-full bg-primary/15 text-primary text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">?</span>
                        <span>2. Sau 30 phút trao đổi, tôi sẽ nhận được gì?</span>
                    </h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed pl-10">
                        Ba mẹ sẽ có cái nhìn tổng thể về mối liên hệ giữa các triệu chứng của con, xác định được <strong>vấn đề nổi bật nhất cần ưu tiên</strong> trong giai đoạn hiện tại, biết bước tiếp theo nên làm gì và nhận tài liệu/cẩm nang hướng dẫn thực hành phù hợp.
                    </p>
                </div>

                <!-- Câu hỏi 3 -->
                <div class="glass-card-booking p-6 sm:p-7 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg sm:text-xl text-navy mb-2.5 flex items-start gap-3">
                        <span class="w-7 h-7 rounded-full bg-emerald-500/15 text-emerald-700 text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">?</span>
                        <span>3. Tôi có bị chèo kéo hay ép mua sản phẩm gì không?</span>
                    </h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed pl-10">
                        <strong>Hoàn toàn không.</strong> Mục tiêu duy nhất của 30 phút này là giúp ba mẹ hiểu rõ vấn đề của con và định hình thứ tự ưu tiên. Mọi quyết định áp dụng hay đồng hành tiếp theo đều hoàn toàn thuộc về sự chủ động của gia đình.
                    </p>
                </div>

                <!-- Câu hỏi 4 -->
                <div class="glass-card-booking p-6 sm:p-7 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg sm:text-xl text-navy mb-2.5 flex items-start gap-3">
                        <span class="w-7 h-7 rounded-full bg-navy/10 text-navy text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">?</span>
                        <span>4. Sau khi đăng ký trên trang này sẽ diễn ra thế nào?</span>
                    </h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed pl-10">
                        (1) Ba mẹ điền thông tin liên hệ ở Bước 1 và tích chọn khảo sát nhanh ở Bước 2 → (2) Bộ phận chuyên môn xem xét hồ sơ và nhắn xác nhận lịch qua Zalo → (3) Thực hiện cuộc trò chuyện 1:1 trong 30 phút theo đúng khung giờ đã hẹn.
                    </p>
                </div>

                <!-- Câu hỏi 5 (Full width on md) -->
                <div class="glass-card-booking p-6 sm:p-7 rounded-3xl shadow-soft md:col-span-2 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div>
                        <h3 class="font-serif font-bold text-lg sm:text-xl text-navy mb-2 flex items-start gap-3">
                            <span class="w-7 h-7 rounded-full bg-secondary/15 text-secondary text-xs font-extrabold flex items-center justify-center shrink-0 mt-0.5">?</span>
                            <span>5. Thông tin của con và gia đình có được lắng nghe nghiêm túc & bảo mật không?</span>
                        </h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed pl-10">
                            Mọi thông tin khảo sát về tình trạng của bé chỉ phục vụ duy nhất cho việc chuẩn bị chuyên môn trước buổi hẹn 1:1, được lắng nghe với sự tôn trọng, thấu cảm và <strong>bảo mật tuyệt đối 100%</strong>.
                        </p>
                    </div>

                    <a href="#booking-card-wrapper" onclick="document.getElementById('booking-parent-name')?.focus();" class="shrink-0 px-6 py-4 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider shadow-md hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <span>Đăng Ký 30 Phút Nhìn Rõ Vấn Đề Của Con</span>
                        <i data-lucide="arrow-up-right" class="w-4 h-4"></i>
                    </a>
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

    // 1. Chọn nhanh Khung giờ ở Bước 1
    const slotButtons = document.querySelectorAll('.time-slot-pill');
    const timeInput = document.getElementById('booking-preferred-time');

    slotButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            slotButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            timeInput.value = btn.getAttribute('data-slot');
        });
    });

    // 2. Chọn đơn (Single-select pills) ở Bước 2 (Độ tuổi & Chẩn đoán)
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

    // 3. Chọn nhiều (Multi-select chips) ở Bước 2 (Tiêu hóa, Hành vi, Phương pháp đã thử)
    const multiChips = document.querySelectorAll('.survey-multi-chip');
    multiChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const activeCls = chip.getAttribute('data-active-class') || 'is-selected';
            chip.classList.toggle(activeCls);
        });
    });

    // Elements chuyển đổi trạng thái
    const leftCol = document.getElementById('booking-left-col');
    const rightCol = document.getElementById('booking-right-col');
    const cardWrapper = document.getElementById('booking-card-wrapper');
    const stepper = document.getElementById('booking-stepper');
    const stepBadge1 = document.getElementById('step-badge-1');
    const stepIndicator2 = document.getElementById('step-indicator-2');
    const stepBadge2 = document.getElementById('step-badge-2');
    const stepProgressBar = document.getElementById('step-progress-bar');

    const step1Container = document.getElementById('booking-step1-container');
    const step2Container = document.getElementById('booking-step2-container');
    const successContainer = document.getElementById('booking-success-container');

    // Chuyển sang màn hình Bước 2 (Mở rộng cột phải thành 7/12 trên desktop để hiển thị khảo sát rộng rãi)
    function transitionToStep2(data) {
        document.getElementById('survey-booking-id').value = data.booking_id;
        document.getElementById('survey-booking-code').value = data.booking_code;
        document.getElementById('step2-badge-code').textContent = data.booking_code;

        // Cập nhật sẵn dữ liệu màn hình kết quả cuối
        document.getElementById('res-booking-code').textContent = data.booking_code;
        document.getElementById('res-parent-name').textContent = data.parent_name;
        document.getElementById('res-phone').textContent = data.phone;
        document.getElementById('res-time').textContent = data.preferred_time;
        if (data.zalo_url) {
            document.getElementById('res-zalo-link').href = data.zalo_url;
        }

        // Cập nhật thanh tiến trình
        stepBadge1.innerHTML = '<i data-lucide="check" class="w-4 h-4"></i>';
        stepBadge1.className = 'w-7 h-7 rounded-full bg-emerald-500 text-white text-xs font-extrabold flex items-center justify-center shadow-sm';
        stepIndicator2.classList.remove('opacity-50');
        stepBadge2.className = 'w-7 h-7 rounded-full bg-secondary text-white text-xs font-extrabold flex items-center justify-center shadow-sm';
        stepProgressBar.classList.remove('w-1/2');
        stepProgressBar.classList.add('w-full');

        // Mở rộng khung phải trên màn hình lớn để form khảo sát thoáng, dễ tích chọn trên 1 khung
        if (leftCol && rightCol) {
            leftCol.classList.remove('lg:col-span-7');
            leftCol.classList.add('lg:col-span-5');
            rightCol.classList.remove('lg:col-span-5', 'lg:sticky', 'lg:top-28');
            rightCol.classList.add('lg:col-span-7');
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

    // Chuyển sang màn hình Hoàn tất cuối cùng
    function transitionToFinalSuccess(hasSurvey) {
        stepper.classList.add('hidden');
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

    // 4. Xử lý Submit Bước 1 (Lưu thông tin liên hệ cơ bản)
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
            step1Btn.innerHTML = '<span>Đang lưu thông tin...</span>';

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

    // 5. Xử lý Submit Bước 2 (Gửi khảo sát tình trạng của bé)
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
            step2Btn.innerHTML = '<span>Đang gửi hồ sơ khảo sát...</span>';

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking_survey');
            formData.append('nonce', nonceVal);
            formData.append('booking_id', document.getElementById('survey-booking-id').value);
            formData.append('booking_code', document.getElementById('survey-booking-code').value);
            formData.append('child_name', document.getElementById('survey-child-name').value.trim());
            formData.append('child_age', document.getElementById('survey-child-age').value);
            formData.append('diagnosis', document.getElementById('survey-diagnosis').value);
            formData.append('parent_goal', document.getElementById('survey-parent-goal').value.trim());

            // Thu thập các mục multi-select đã chọn
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
