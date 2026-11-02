<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page đặt lịch tư vấn miễn phí 1:1 (Quy trình 2 bước: Giữ lịch cơ bản -> Khảo sát tình trạng của bé trên 1 khung).
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
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.94) 0%, rgba(255, 255, 255, 0.82) 100%);
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

<main id="primary" class="site-main min-h-screen pb-24 pt-8 md:pt-12 relative overflow-hidden">
    <!-- Decorative background blobs -->
    <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- HERO + FORM 2 CỘT -->
        <section id="booking-hero-grid" class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-14 items-start pt-4 md:pt-8 transition-all duration-500">

            <!-- CỘT TRÁI: THÔNG ĐIỆP & GIÁ TRỊ BUỔI TƯ VẤN (7/12 ở Bước 1, thu gọn nhẹ ở Bước 2) -->
            <div id="booking-left-col" class="lg:col-span-7 flex flex-col justify-center lg:pr-4 transition-all duration-500">
                <div class="inline-flex items-center gap-2 self-start bg-white/80 backdrop-blur-md border border-white px-4 py-2 rounded-full shadow-soft mb-6">
                    <span class="w-2 h-2 rounded-full bg-secondary animate-pulse"></span>
                    <span class="text-secondary font-extrabold text-xs uppercase tracking-widest">Đồng hành 1:1 • Hoàn toàn miễn phí</span>
                </div>

                <h1 class="font-serif text-3xl sm:text-4xl xl:text-5xl font-bold text-navy leading-[1.2] mb-6">
                    Đặt Lịch Tư Vấn 1:1<br class="hidden sm:inline" />
                    <span class="text-secondary italic">Thấu Hiểu Cơ Thể Con Từ Gốc</span>
                </h1>

                <div class="bg-white/60 backdrop-blur-md border-l-4 border-secondary rounded-r-2xl p-5 mb-8 shadow-soft">
                    <p class="font-serif italic text-navy/90 text-base sm:text-lg leading-relaxed">
                        “Mỗi em bé đặc biệt có một cơ địa sinh học riêng biệt. Đừng tự mò mẫm trong lo âu — hãy để đội ngũ <strong>Hiểu Con Từ Gốc</strong> cùng ba mẹ lắng nghe và giải mã những tín hiệu từ cơ thể con.”
                    </p>
                </div>

                <p class="text-navy/75 text-base sm:text-lg font-medium leading-relaxed mb-8">
                    Buổi trò chuyện 1:1 giúp ba mẹ nhìn rõ bức tranh tổng thể về <strong class="text-navy">Trục Não - Ruột, Dinh dưỡng và Giấc ngủ</strong> của con, từ đó biết chính xác nên bắt đầu từ đâu để con tiến bộ vững chắc nhất.
                </p>

                <!-- 3 Giá trị nhận được -->
                <div class="space-y-4 mb-10">
                    <div class="glass-card-booking p-5 rounded-2xl shadow-soft flex items-start gap-4 hover:-translate-y-0.5 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-secondary/10 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="search-check" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-lg mb-1">1. Giải mã tín hiệu cơ thể & hành vi của con</h3>
                            <p class="text-navy/70 text-sm font-medium leading-relaxed">
                                Kết nối các biểu hiện bề nổi (chậm nói, la hét, tăng động, khó ngủ, kén ăn, táo bón...) với nguyên nhân sinh học bên trong.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card-booking p-5 rounded-2xl shadow-soft flex items-start gap-4 hover:-translate-y-0.5 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-primary/10 text-primary flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="compass" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-lg mb-1">2. Định hướng lộ trình chăm sóc cá nhân hóa</h3>
                            <p class="text-navy/70 text-sm font-medium leading-relaxed">
                                Gợi ý thứ tự ưu tiên phù hợp riêng với độ tuổi và thể trạng của bé: chế độ ăn, phục hồi tiêu hóa và kỹ năng tương tác tại nhà.
                            </p>
                        </div>
                    </div>

                    <div class="glass-card-booking p-5 rounded-2xl shadow-soft flex items-start gap-4 hover:-translate-y-0.5 transition-transform duration-300">
                        <div class="w-12 h-12 rounded-2xl bg-navy/10 text-navy flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-serif font-bold text-navy text-lg mb-1">3. Gỡ rối trực tiếp & gửi tặng cẩm nang phù hợp</h3>
                            <p class="text-navy/70 text-sm font-medium leading-relaxed">
                                Giải đáp mọi thắc mắc của ba mẹ và gửi tặng bộ Checklist / Cẩm nang thực hành đúng với vấn đề con đang gặp phải.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cam kết 3 Không -->
                <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs sm:text-sm font-bold text-navy/75 bg-white/50 backdrop-blur-md px-5 py-4 rounded-2xl border border-white/80">
                    <span class="flex items-center gap-2">
                        <i data-lucide="shield-check" class="w-4 h-4 text-primary"></i> 100% Miễn phí tư vấn
                    </span>
                    <span class="flex items-center gap-2">
                        <i data-lucide="lock" class="w-4 h-4 text-secondary"></i> Bảo mật thông tin gia đình
                    </span>
                    <span class="flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-navy"></i> Linh hoạt theo giờ của mẹ
                    </span>
                </div>
            </div>

            <!-- CỘT PHẢI: KHUNG ĐẶT LỊCH 2 BƯỚC (5/12 ở Bước 1, mở rộng 7/12 ở Bước 2 để hiển thị trọn vẹn khảo sát) -->
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
                                <span class="block text-xs font-bold text-navy">Khảo sát tình trạng bé</span>
                            </div>
                        </div>
                    </div>

                    <!-- ==========================================
                         BƯỚC 1: FORM THÔNG TIN CƠ BẢN (GIỮ LỊCH HẸN)
                         ========================================== -->
                    <div id="booking-step1-container">
                        <div class="mb-6">
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Đăng Ký Giữ Lịch Tư Vấn</h2>
                            <p class="text-navy/65 text-xs sm:text-sm font-medium mt-1">
                                Điền 3 thông tin cơ bản bên dưới (chỉ 15 giây) để hệ thống giữ lịch hẹn 1:1 trước cho gia đình mình.
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
                                    2. Số điện thoại / Zalo nhận tư vấn <span class="text-secondary">*</span>
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
                                    3. Khung giờ thuận tiện nghe máy <span class="text-secondary">*</span>
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
                                <span>Tiếp Tục: Khảo Sát Tình Trạng Của Bé</span>
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </button>

                            <p class="text-center text-[11px] text-navy/50 font-semibold">
                                Cần hỗ trợ gấp ngay bây giờ?
                                <a href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="text-[#0068FF] font-extrabold underline hover:text-navy">Nhắn trực tiếp qua Zalo Tư Vấn ↗</a>
                            </p>
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
                                    Đã giữ lịch hẹn (<span id="step2-badge-code" class="underline">TV-0000</span>)!
                                </p>
                                <p class="font-medium mt-0.5">
                                    Để buổi tư vấn 1:1 đi thẳng vào trọng tâm và sát nhất với cơ địa của con, ba mẹ dành thêm <strong>1 phút tích chọn nhanh</strong> các biểu hiện hiện tại của bé dưới đây nhé:
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

                            <!-- MỤC 3: TÍN HIỆU TIÊU HÓA, GIẤC NGỦ & Y SINH (CHỌN NHIỀU) -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <div class="flex items-center justify-between gap-2 mb-2.5">
                                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">3</span>
                                        Tín hiệu Tiêu hóa, Giấc ngủ & Cơ thể
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

                            <!-- MỤC 4: BIỂU HIỆN NGÔN NGỮ, CẢM GIÁC & HÀNH VI (CHỌN NHIỀU) -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <div class="flex items-center justify-between gap-2 mb-2.5">
                                    <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy flex items-center gap-2">
                                        <span class="w-5 h-5 rounded-full bg-primary/15 text-primary flex items-center justify-center text-[11px]">4</span>
                                        Biểu hiện Ngôn ngữ, Cảm giác & Hành vi
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

                            <!-- MỤC 5: PHƯƠNG PHÁP GIA ĐÌNH ĐÃ / ĐANG ÁP DỤNG -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <h3 class="text-xs font-extrabold uppercase tracking-wider text-navy mb-2.5 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-navy/10 text-navy flex items-center justify-center text-[11px]">5</span>
                                    Gia đình đã hoặc đang áp dụng phương pháp nào chưa?
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <?php
                                    $tried_methods = [
                                        'Đang học can thiệp giáo dục đặc biệt / âm ngữ',
                                        'Đã áp dụng chế độ ăn kiêng (GFCF / giảm đường, sữa)',
                                        'Đang bổ sung men vi sinh / vi chất (Omega-3, GABA, Kẽm...)',
                                        'Chưa áp dụng phương pháp nào, đang tìm hướng đi từ gốc',
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

                            <!-- MỤC 6: MONG MUỐN LỚN NHẤT CỦA BA MẸ -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4 sm:p-5">
                                <label for="survey-parent-goal" class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2 flex items-center gap-2">
                                    <span class="w-5 h-5 rounded-full bg-secondary/15 text-secondary flex items-center justify-center text-[11px]">6</span>
                                    Điều ba mẹ trăn trở hoặc mong muốn cải thiện nhất lúc này (Tùy chọn)
                                </label>
                                <textarea
                                    id="survey-parent-goal"
                                    name="parent_goal"
                                    rows="2"
                                    placeholder="Ví dụ: Mong muốn cải thiện táo bón lâu ngày, giúp con ngủ sâu giấc hơn và giảm la hét..."
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
                                    <span>Hoàn Tất Hồ Sơ Tư Vấn Cho Bé</span>
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
                            Mã lịch hẹn: <span id="res-booking-code">TV-0000</span>
                        </span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã Hoàn Tất Hồ Sơ Đặt Lịch!</h3>
                        <p class="text-navy/70 text-sm font-medium leading-relaxed mb-4">
                            Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ chuyên môn <strong>Hiểu Con Từ Gốc</strong> sẽ liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> vào khung giờ <strong id="res-time" class="text-navy"></strong>.
                        </p>

                        <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-teal-50 text-teal-800 border border-teal-200 px-3.5 py-1.5 rounded-xl text-xs font-bold mb-6">
                            <i data-lucide="file-check-2" class="w-4 h-4 text-teal-600"></i>
                            <span>Chuyên gia đã nhận được phiếu khảo sát tình trạng của bé</span>
                        </div>

                        <div class="bg-[#f8fafc] border border-navy/10 rounded-2xl p-4 text-left mb-6">
                            <p class="text-xs font-extrabold text-navy uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                                <i data-lucide="sparkles" class="w-4 h-4 text-secondary"></i> Bước tiếp theo dành cho ba mẹ:
                            </p>
                            <p class="text-xs text-navy/75 leading-relaxed">
                                Ba mẹ có thể bấm nút bên dưới để nhắn xác nhận ngay qua <strong>Zalo Tư Vấn</strong> hoặc trải nghiệm thêm <strong>Bộ Công Cụ Đánh Giá Sức Khỏe</strong> của Hiểu Con Từ Gốc.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0068FF] to-[#0052CC] hover:opacity-95 text-white font-extrabold text-sm uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all">
                                <span class="font-black text-base leading-none">Z</span>
                                <span>Kết Nối Zalo Tư Vấn Ngay</span>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/bo-cong-cu-suc-khoe/' ) ); ?>" class="w-full py-3 px-5 rounded-xl bg-navy hover:bg-navy/85 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-secondary"></i>
                                <span>Khám Phá Bộ Công Cụ Sức Khỏe</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- QUY TRÌNH 3 BƯỚC ĐỒNG HÀNH -->
        <section class="mt-20 md:mt-28">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-secondary font-extrabold text-xs uppercase tracking-widest block mb-2">Quy trình tận tâm & khoa học</span>
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy">3 Bước Tư Vấn 1:1 Cùng Ba Mẹ</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <div class="glass-card-booking p-7 rounded-[2rem] shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">01</span>
                    <div class="w-12 h-12 rounded-2xl bg-navy text-white flex items-center justify-center mb-5">
                        <i data-lucide="calendar-plus" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2">Đăng ký & Khảo sát nhanh</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Ba mẹ để lại SĐT/Zalo giữ lịch hẹn, sau đó tích chọn nhanh các biểu hiện của bé để chuyên gia nắm bắt trước hồ sơ.
                    </p>
                </div>

                <div class="glass-card-booking p-7 rounded-[2rem] shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">02</span>
                    <div class="w-12 h-12 rounded-2xl bg-secondary text-white flex items-center justify-center mb-5">
                        <i data-lucide="messages-square" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2">Trò chuyện & Giải mã 1:1</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Cùng nhìn lại toàn diện tình trạng tiêu hóa, giấc ngủ, dinh dưỡng và hành vi của con để tìm ra nút thắt gốc rễ.
                    </p>
                </div>

                <div class="glass-card-booking p-7 rounded-[2rem] shadow-soft relative">
                    <span class="font-serif font-bold text-4xl text-secondary/20 absolute top-5 right-6">03</span>
                    <div class="w-12 h-12 rounded-2xl bg-primary text-white flex items-center justify-center mb-5">
                        <i data-lucide="file-check-2" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif font-bold text-xl text-navy mb-2">Nhận lộ trình & Đồng hành</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Nhận hướng dẫn thực hành từng bước tại nhà, tài liệu chuyên sâu và sự đồng hành sát sao từ cộng đồng Hiểu Con Từ Gốc.
                    </p>
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
            step1Btn.innerHTML = '<span>Đang giữ lịch hẹn...</span>';

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
            step2Btn.innerHTML = '<span>Đang lưu hồ sơ khảo sát...</span>';

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
