<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 Phút Để Nhìn Rõ Vấn Đề Của Con" — Tập trung chuyên sâu Tiêu hoá, Kén ăn, Táo bón, Bất dung nạp, Suy dinh dưỡng & Thiếu hụt vi chất.
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
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(255, 255, 255, 0.85) 100%);
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

<main id="primary" class="site-main min-h-screen pb-24 pt-6 md:pt-12 relative overflow-hidden">
    <!-- Decorative background blobs -->
    <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- =========================================================
             HERO + FORM ĐĂNG KÝ
             ========================================================= -->
        <section id="booking-hero-grid" class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-14 items-start pt-2 md:pt-6 transition-all duration-500">

            <!-- CỘT TRÁI: THÔNG ĐIỆP TRUNG TÂM -->
            <div id="booking-left-col" class="lg:col-span-7 flex flex-col justify-center lg:pr-6 transition-all duration-500">
                <h1 class="font-serif text-3xl sm:text-5xl font-bold text-navy leading-[1.18] mb-5">
                    30 Phút Để Nhìn Rõ<br class="hidden sm:inline" />
                    <span class="text-secondary italic">Vấn Đề Của Con</span>
                </h1>

                <p class="font-serif italic text-xl sm:text-2xl text-navy/90 border-l-4 border-secondary pl-5 py-1 mb-8">
                    “Hiểu trước khi can thiệp. Ưu tiên trước khi làm quá nhiều.”
                </p>

                <!-- 4 điểm rõ ràng nhận được sau 30 phút -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-secondary/12 text-secondary flex items-center justify-center shrink-0">
                            <i data-lucide="target" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-navy text-sm sm:text-base">Xác định vấn đề nổi bật của con</span>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-primary/12 text-primary flex items-center justify-center shrink-0">
                            <i data-lucide="network" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-navy text-sm sm:text-base">Nhìn rõ các yếu tố liên quan</span>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-navy/10 text-navy flex items-center justify-center shrink-0">
                            <i data-lucide="list-filter" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-navy text-sm sm:text-base">Biết điều gì cần ưu tiên trước</span>
                    </div>

                    <div class="glass-card-booking p-4 rounded-2xl shadow-soft flex items-center gap-3.5">
                        <div class="w-9 h-9 rounded-xl bg-emerald-500/12 text-emerald-700 flex items-center justify-center shrink-0">
                            <i data-lucide="compass" class="w-5 h-5"></i>
                        </div>
                        <span class="font-bold text-navy text-sm sm:text-base">Rõ bước tiếp theo nên làm gì</span>
                    </div>
                </div>
            </div>

            <!-- CỘT PHẢI: FORM ĐĂNG KÝ -->
            <div id="booking-right-col" class="lg:col-span-5 w-full lg:sticky lg:top-28 transition-all duration-500">
                <div id="booking-card-wrapper" class="glass-card-booking rounded-[2rem] p-6 sm:p-8 shadow-premium relative overflow-hidden">
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-navy via-secondary to-primary"></div>

                    <!-- MÀN HÌNH 1: THÔNG TIN LIÊN HỆ CƠ BẢN -->
                    <div id="booking-step1-container">
                        <div class="mb-6">
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Đăng Ký Lịch Hẹn 30 Phút</h2>
                            <p class="text-navy/65 text-xs sm:text-sm font-medium mt-1.5">
                                Đội ngũ xem xét thông tin trước mỗi buổi hẹn và giới hạn số ca mỗi tuần để đảm bảo chất lượng trao đổi cho từng gia đình.
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
                                    class="w-full px-4 py-3.5 rounded-xl bg-white border border-navy/15 focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                >
                            </div>

                            <div>
                                <label for="booking-phone" class="block text-xs font-extrabold text-navy mb-1.5">
                                    Số điện thoại / Zalo liên hệ <span class="text-secondary">*</span>
                                </label>
                                <input
                                    type="tel"
                                    id="booking-phone"
                                    name="phone"
                                    value="<?php echo esc_attr( $prefill_phone ); ?>"
                                    required
                                    placeholder="Nhập số điện thoại có dùng Zalo..."
                                    class="w-full px-4 py-3.5 rounded-xl bg-white border border-navy/15 focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-semibold text-sm transition-all"
                                >
                            </div>

                            <div>
                                <label class="block text-xs font-extrabold text-navy mb-1.5">
                                    Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                </label>
                                <div class="grid grid-cols-2 gap-2 mb-2" id="time-slot-group">
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
                                    placeholder="Hoặc ghi rõ ngày/giờ ba mẹ mong muốn..."
                                    class="w-full px-4 py-2.5 rounded-xl bg-white/90 border border-navy/10 focus:border-secondary outline-none text-navy font-semibold text-xs transition-all"
                                >
                            </div>

                            <div id="booking-step1-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                            <button
                                type="submit"
                                id="booking-step1-btn"
                                class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark hover:from-secondary_dark hover:to-secondary text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(249,115,22,0.45)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <span>Tiếp Tục</span>
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>

                    <!-- MÀN HÌNH 2: KHẢO SÁT NHANH TRƯỚC BUỔI HẸN (TẬP TRUNG TIÊU HOÁ & DINH DƯỠNG) -->
                    <div id="booking-step2-container" class="hidden">
                        <div class="bg-emerald-50/90 border border-emerald-200 rounded-2xl p-4 mb-5 flex items-start gap-3">
                            <div class="w-7 h-7 rounded-full bg-emerald-500 text-white flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-4 h-4"></i>
                            </div>
                            <div class="text-xs leading-relaxed text-emerald-950">
                                <p class="font-extrabold text-sm text-emerald-900">
                                    Đã ghi nhận thông tin liên hệ (<span id="step2-badge-code">TV-0000</span>)
                                </p>
                                <p class="font-medium mt-0.5">
                                    Ba mẹ tích chọn nhanh tình trạng tiêu hoá & dinh dưỡng hiện tại của con để người phụ trách nắm rõ hồ sơ trước buổi trao đổi 30 phút nhé:
                                </p>
                            </div>
                        </div>

                        <form id="hieucon-booking-step2-form" class="space-y-5" novalidate>
                            <input type="hidden" id="survey-booking-id" name="booking_id" value="">
                            <input type="hidden" id="survey-booking-code" name="booking_code" value="">

                            <!-- Thông tin bé -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
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

                            <!-- Vấn đề trọng tâm nhất hiện tại -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
                                <label class="block text-xs font-extrabold text-navy mb-2">Vấn đề nổi bật nhất ba mẹ đang lo lắng ở con</label>
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

                            <!-- Biểu hiện Tiêu hoá & Kén ăn -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
                                <label class="block text-xs font-extrabold text-navy mb-2">
                                    Biểu hiện Tiêu hoá & Ăn uống của bé
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

                            <!-- Dấu hiệu Bất dung nạp, Suy dinh dưỡng & Thiếu hụt vi chất -->
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
                                <label class="block text-xs font-extrabold text-navy mb-2">
                                    Dấu hiệu Bất dung nạp, Suy dinh dưỡng & Thiếu vi chất
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
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
                                <label class="block text-xs font-extrabold text-navy mb-2">
                                    Gia đình đã hoặc đang thử những hướng nào?
                                </label>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                                    <?php
                                    $tried_methods = [
                                        'Đã đổi nhiều loại men vi sinh, chất xơ nhưng chưa dứt điểm',
                                        'Đang bổ sung nhiều loại vi chất nhưng chưa rõ con hấp thu không',
                                        'Đã thử kiêng sữa bò / Gluten hoặc điều chỉnh chế độ ăn',
                                        'Đã thử nhiều mẹo nhưng chưa rõ nên ưu tiên xử lý gì trước',
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
                            <div class="bg-white/75 border border-navy/10 rounded-2xl p-4">
                                <label for="survey-parent-goal" class="block text-xs font-extrabold text-navy mb-1.5">
                                    Điều ba mẹ đang bối rối nhất hoặc muốn làm rõ nhất trong 30 phút này:
                                </label>
                                <textarea
                                    id="survey-parent-goal"
                                    name="parent_goal"
                                    rows="2"
                                    placeholder="Ví dụ: Con táo bón lâu ngày kèm kén ăn và chậm tăng cân, đã đổi nhiều loại men không đỡ, muốn biết nên ưu tiên xử lý từ đâu trước..."
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
                                    <span>Hoàn Tất Đăng Ký</span>
                                </button>

                                <button
                                    type="button"
                                    id="booking-skip-survey-btn"
                                    class="w-full py-2 text-center text-xs font-bold text-navy/55 hover:text-navy underline transition-colors cursor-pointer"
                                >
                                    Bỏ qua khảo sát và giữ lịch hẹn →
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- MÀN HÌNH 3: HOÀN TẤT -->
                    <div id="booking-success-container" class="hidden text-center py-4">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                        </div>
                        <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded-full mb-2">
                            Mã hồ sơ: <span id="res-booking-code">TV-0000</span>
                        </span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã Tiếp Nhận Thông Tin!</h3>
                        <p class="text-navy/70 text-sm font-medium leading-relaxed mb-5">
                            Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ <strong>Hiểu Con Từ Gốc</strong> sẽ xem xét thông tin của bé và liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> vào khung giờ <strong id="res-time" class="text-navy"></strong>.
                        </p>

                        <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-teal-50 text-teal-800 border border-teal-200 px-3.5 py-1.5 rounded-xl text-xs font-bold mb-6">
                            <i data-lucide="file-check-2" class="w-4 h-4 text-teal-600"></i>
                            <span>Đã lưu thông tin khảo sát tình trạng của bé</span>
                        </div>

                        <div class="space-y-3">
                            <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0068FF] to-[#0052CC] hover:opacity-95 text-white font-extrabold text-sm uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all">
                                <span class="font-black text-base leading-none">Z</span>
                                <span>Nhắn Xác Nhận Lịch Hẹn Qua Zalo</span>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/bo-cong-cu-suc-khoe/' ) ); ?>" class="w-full py-3 px-5 rounded-xl bg-navy hover:bg-navy/85 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-secondary"></i>
                                <span>Xem Bộ Công Cụ Đánh Giá Sức Khỏe</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </section>

        <!-- =========================================================
             1. 5 VẤN ĐỀ TIÊU HOÁ & DINH DƯỠNG CHA MẸ ĐANG GẶP VỚI CON
             (Kén ăn • Táo bón • Bất dung nạp • Suy dinh dưỡng • Thiếu hụt vi chất)
             ========================================================= -->
        <section class="mt-20 md:mt-28">
            <div class="max-w-3xl mb-10">
                <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight mb-3">
                    Những Vấn Đề Tiêu Hoá & Dinh Dưỡng Nhiều Gia Đình Đang Gặp Ở Con
                </h2>
                <p class="text-navy/70 text-sm sm:text-base font-medium leading-relaxed">
                    Phần lớn ba mẹ tìm đến buổi trao đổi khi con đang gặp một hoặc nhiều tình trạng kéo dài dưới đây:
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-5">
                <!-- 1. Kén ăn -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <div class="w-11 h-11 rounded-2xl bg-orange-500/10 text-secondary flex items-center justify-center mb-4">
                        <i data-lucide="utensils" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Kén ăn</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Biếng ăn, chỉ ăn lặp lại vài món cố định, nhạy cảm với độ thô, ngậm thức ăn lâu, nhai nuốt kém hoặc chỉ thèm đồ ngọt, sữa, tinh bột.
                    </p>
                </div>

                <!-- 2. Táo bón -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <div class="w-11 h-11 rounded-2xl bg-amber-500/10 text-amber-600 flex items-center justify-center mb-4">
                        <i data-lucide="activity" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Táo bón</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Táo bón dai dẳng nhiều ngày, phân cứng vón cục hoặc phân sống, lỏng nát thất thường; bụng hay căng phình, đầy hơi, ợ chua, hơi thở có mùi.
                    </p>
                </div>

                <!-- 3. Bất dung nạp -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <div class="w-11 h-11 rounded-2xl bg-rose-500/10 text-rose-600 flex items-center justify-center mb-4">
                        <i data-lucide="shield-alert" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Bất dung nạp</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Cơ thể nhạy cảm hoặc bất dung nạp đạm sữa bò (Casein), Gluten, Lactose... gây rối loạn tiêu hoá, mẩn ngứa, chàm da, bức bối và khó ngủ sau ăn.
                    </p>
                </div>

                <!-- 4. Suy dinh dưỡng -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <div class="w-11 h-11 rounded-2xl bg-indigo-500/10 text-indigo-600 flex items-center justify-center mb-4">
                        <i data-lucide="trending-down" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Suy dinh dưỡng</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Đường ruột tổn thương dẫn đến kém hấp thu dưỡng chất; con ăn được nhưng chững cân, chậm phát triển chiều cao, thể trạng gầy yếu, hay ốm vặt.
                    </p>
                </div>

                <!-- 5. Thiếu hụt vi chất & dinh dưỡng -->
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <div class="w-11 h-11 rounded-2xl bg-teal-500/10 text-primary flex items-center justify-center mb-4">
                        <i data-lucide="flask-conical" class="w-5 h-5"></i>
                    </div>
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Thiếu hụt vi chất</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Thiếu kẽm, sắt, canxi, magie, vitamin... hoặc ba mẹ đã mua rất nhiều loại men, vi chất cho con uống nhưng chưa thấy cải thiện rõ rệt.
                    </p>
                </div>
            </div>
        </section>

        <!-- =========================================================
             2. VẤN ĐỀ KHÔNG ĐỨNG RIÊNG LẺ & CHUYỂN DỊCH NHẬN THỨC
             ========================================================= -->
        <section class="mt-20 md:mt-24">
            <div class="glass-card-booking rounded-[2.5rem] p-7 sm:p-10 lg:p-12 shadow-premium">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">

                    <div class="lg:col-span-7 space-y-5">
                        <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                            Vấn Đề Của Con Thường Không Đứng Riêng Lẻ — Và Điều Ba Mẹ Thiếu Không Phải Là Thêm Một Mẹo
                        </h2>

                        <div class="space-y-4 text-navy/80 text-sm sm:text-base font-medium leading-relaxed">
                            <p>
                                Một khó khăn về tiêu hoá và dinh dưỡng ít khi đứng một mình. Khi con bất dung nạp thực phẩm hoặc táo bón kéo dài, hệ vi sinh mất cân bằng và niêm mạc ruột tổn thương sẽ dẫn tới kém hấp thu, thiếu hụt vi chất — từ đó làm con càng kén ăn, suy dinh dưỡng, ngủ trằn trọc và dễ bức bối hơn.
                            </p>
                            <p>
                                Ba mẹ rất dễ bị rối khi nhìn từng triệu chứng riêng biệt để tìm cách xử lý: thấy táo bón thì đổi men, thấy biếng ăn thì mua thêm siro, thấy còi cọc lại bổ sung thêm nhiều loại vi chất. Đọc nhiều, thử nhiều nhưng vẫn mệt mỏi vì chưa biết đâu mới là gốc rễ cần ưu tiên trước.
                            </p>
                        </div>
                    </div>

                    <div class="lg:col-span-5">
                        <div class="bg-navy text-white rounded-3xl p-6 sm:p-8 space-y-5">
                            <div class="bg-white/8 border border-white/15 rounded-2xl p-4">
                                <span class="text-xs font-bold text-rose-300 block mb-1">Thay vì tiếp tục tìm kiếm:</span>
                                <p class="font-serif italic text-base sm:text-lg text-white/85">
                                    “Tôi cần thêm giải pháp hay mua thêm loại gì để thử tiếp cho con.”
                                </p>
                            </div>

                            <div class="flex justify-center">
                                <i data-lucide="arrow-down" class="w-5 h-5 text-secondary"></i>
                            </div>

                            <div class="bg-white/12 border border-secondary/50 rounded-2xl p-5">
                                <span class="text-xs font-bold text-amber-300 block mb-1">Điều con thực sự cần lúc này là:</span>
                                <p class="font-serif font-bold text-lg sm:text-xl text-white leading-snug">
                                    “Tôi cần hiểu rõ vấn đề của con trước — và biết nên ưu tiên điều gì đầu tiên.”
                                </p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- =========================================================
             3. BUỔI 30 PHÚT GIÚP LÀM RÕ VẤN ĐỀ GÌ & TÍNH CHỌN LỌC
             ========================================================= -->
        <section class="mt-20 md:mt-24 grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">

            <!-- Cột 7/12: 30 phút làm rõ 4 việc -->
            <div class="lg:col-span-7 glass-card-booking rounded-[2.5rem] p-7 sm:p-10 shadow-soft flex flex-col justify-between">
                <div>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-3">
                        Buổi 30 Phút Giúp Ba Mẹ Làm Rõ Điều Gì?
                    </h2>
                    <p class="text-navy/70 text-sm sm:text-base font-medium leading-relaxed mb-7">
                        Mục tiêu của cuộc trò chuyện là giúp gia đình tháo gỡ sự rối bời và nhìn rõ 4 điểm cốt lõi:
                    </p>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div class="bg-white/80 border border-navy/8 rounded-2xl p-5">
                            <h3 class="font-serif font-bold text-lg text-navy mb-1.5">Xác định vấn đề nổi bật</h3>
                            <p class="text-navy/70 text-xs sm:text-sm font-medium leading-relaxed">
                                Bóc tách giữa kén ăn, táo bón, bất dung nạp hay kém hấp thu xem đâu là rào cản chính đang ảnh hưởng trực tiếp đến con lúc này.
                            </p>
                        </div>

                        <div class="bg-white/80 border border-navy/8 rounded-2xl p-5">
                            <h3 class="font-serif font-bold text-lg text-navy mb-1.5">Nhìn các yếu tố liên quan</h3>
                            <p class="text-navy/70 text-xs sm:text-sm font-medium leading-relaxed">
                                Kết nối chế độ ăn hàng ngày, khả năng tiêu hoá – hấp thu với tình trạng suy dinh dưỡng và thiếu hụt vi chất hiện tại của con.
                            </p>
                        </div>

                        <div class="bg-white/80 border border-navy/8 rounded-2xl p-5">
                            <h3 class="font-serif font-bold text-lg text-navy mb-1.5">Xác định điều cần ưu tiên</h3>
                            <p class="text-navy/70 text-xs sm:text-sm font-medium leading-relaxed">
                                Không bổ sung dàn trải cùng lúc; biết rõ việc gì cần ưu tiên làm trước cho đường ruột và chế độ dinh dưỡng của con.
                            </p>
                        </div>

                        <div class="bg-white/80 border border-navy/8 rounded-2xl p-5">
                            <h3 class="font-serif font-bold text-lg text-navy mb-1.5">Biết bước tiếp theo là gì</h3>
                            <p class="text-navy/70 text-xs sm:text-sm font-medium leading-relaxed">
                                Có hướng đi rõ ràng, thực tế và phù hợp với cơ địa tiêu hoá của con sau buổi trao đổi.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Cột 5/12: Không phải tư vấn đại trà -->
            <div class="lg:col-span-5 bg-navy text-white rounded-[2.5rem] p-7 sm:p-10 shadow-premium flex flex-col justify-between">
                <div>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-white mb-3">
                        Đây Không Phải Buổi Tư Vấn Đại Trà
                    </h2>
                    <p class="text-white/75 text-sm font-medium leading-relaxed mb-7">
                        Để 30 phút thực sự đi vào chiều sâu và mang lại hướng đi rõ ràng cho gia đình:
                    </p>

                    <div class="space-y-5">
                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-secondary/20 text-secondary flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="calendar-clock" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-sm sm:text-base mb-0.5">Giới hạn số ca mỗi tuần</h3>
                                <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                                    Đảm bảo người phụ trách có đủ thời gian tập trung cho từng trường hợp.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-primary/25 text-teal-300 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="file-search" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-sm sm:text-base mb-0.5">Xem xét thông tin trước buổi hẹn</h3>
                                <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                                    Hồ sơ khảo sát được đọc trước để 30 phút đi thẳng vào phân tích vấn đề của con.
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start gap-3.5">
                            <div class="w-9 h-9 rounded-xl bg-emerald-500/20 text-emerald-300 flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="user-check" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-sm sm:text-base mb-0.5">Chỉ nhận những trường hợp phù hợp</h3>
                                <p class="text-white/70 text-xs sm:text-sm leading-relaxed">
                                    Dành cho những ba mẹ thực sự muốn hiểu rõ vấn đề của con trước khi can thiệp.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        <!-- =========================================================
             4. NHỮNG CÂU HỎI GIÚP CHA MẸ AN TÂM ĐĂNG KÝ
             ========================================================= -->
        <section class="mt-20 md:mt-24">
            <h2 class="font-serif text-2xl sm:text-4xl font-bold text-navy mb-8">
                Những Điều Ba Mẹ Thường Băn Khoăn Trước Khi Đăng Ký
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Gia đình tôi có phù hợp không?</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Phù hợp nếu con đang gặp các vấn đề về <strong>kén ăn, táo bón, rối loạn tiêu hoá, bất dung nạp thực phẩm, kém hấp thu, suy dinh dưỡng hoặc thiếu hụt vi chất</strong> mà ba mẹ đang rối chưa biết nguyên nhân liên quan hay nên ưu tiên xử lý từ đâu trước.
                    </p>
                </div>

                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Tôi sẽ nhận được gì sau 30 phút?</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Ba mẹ nhìn rõ bức tranh tổng thể về các vấn đề tiêu hoá và dinh dưỡng của con, xác định được điều nổi bật nhất cần ưu tiên trong giai đoạn hiện tại và biết bước tiếp theo nên thực hiện là gì.
                    </p>
                </div>

                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Có bị ép mua gì không?</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Hoàn toàn không. Mục tiêu của 30 phút là giúp gia đình hiểu rõ vấn đề của con và định hình thứ tự ưu tiên. Mọi quyết định tiếp theo đều hoàn toàn do gia đình chủ động.
                    </p>
                </div>

                <div class="glass-card-booking p-6 rounded-3xl shadow-soft">
                    <h3 class="font-serif font-bold text-lg text-navy mb-2">Sau khi đăng ký sẽ diễn ra thế nào?</h3>
                    <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                        Sau khi ba mẹ điền thông tin liên hệ và tích chọn khảo sát tình trạng của bé, đội ngũ sẽ xem xét trước hồ sơ, nhắn xác nhận qua Zalo và trao đổi 1:1 trong 30 phút theo đúng lịch hẹn.
                    </p>
                </div>

                <div class="glass-card-booking p-6 rounded-3xl shadow-soft md:col-span-2 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
                    <div>
                        <h3 class="font-serif font-bold text-lg text-navy mb-1.5">Thông tin của con có được lắng nghe nghiêm túc không?</h3>
                        <p class="text-navy/75 text-xs sm:text-sm font-medium leading-relaxed">
                            Mọi thông tin gia đình chia sẻ đều được bảo mật và chỉ dùng để người phụ trách chuẩn bị kỹ trước cuộc gọi, giúp 30 phút trao đổi thực sự tập trung vào trường hợp riêng của con.
                        </p>
                    </div>

                    <a href="#booking-card-wrapper" onclick="document.getElementById('booking-parent-name')?.focus();" class="shrink-0 px-6 py-3.5 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark text-white font-extrabold text-xs sm:text-sm uppercase tracking-wider shadow-md hover:-translate-y-0.5 transition-all flex items-center gap-2">
                        <span>Đăng Ký Lịch Hẹn 30 Phút</span>
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

    // Chọn nhanh Khung giờ
    const slotButtons = document.querySelectorAll('.time-slot-pill');
    const timeInput = document.getElementById('booking-preferred-time');

    slotButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            slotButtons.forEach(b => b.classList.remove('is-active'));
            btn.classList.add('is-active');
            timeInput.value = btn.getAttribute('data-slot');
        });
    });

    // Chọn đơn (Độ tuổi & Tình trạng)
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

    // Chọn nhiều (Khảo sát triệu chứng)
    const multiChips = document.querySelectorAll('.survey-multi-chip');
    multiChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const activeCls = chip.getAttribute('data-active-class') || 'is-selected';
            chip.classList.toggle(activeCls);
        });
    });

    const leftCol = document.getElementById('booking-left-col');
    const rightCol = document.getElementById('booking-right-col');
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

    // Submit thông tin liên hệ cơ bản
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

    // Submit khảo sát tình trạng của bé
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
