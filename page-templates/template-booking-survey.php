<?php
/**
 * Template Name: Khảo Sát Tình Trạng Của Con (Bước 2)
 * Description: Trang khảo sát độc lập sau khi phụ huynh đăng ký thông tin liên hệ ở trang Đặt lịch 1:1.
 *
 * @package Hieucon
 */

get_header();

global $wpdb;
$table_name   = $wpdb->prefix . 'hieucon_bookings';
$booking_id   = isset( $_GET['booking_id'] ) ? intval( $_GET['booking_id'] ) : 0;
$booking_code = isset( $_GET['code'] ) ? sanitize_text_field( wp_unslash( $_GET['code'] ) ) : '';

$booking_row = null;
if ( $booking_id > 0 && ! empty( $booking_code ) ) {
    $booking_row = $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d AND booking_code = %s", $booking_id, $booking_code )
    );
}

$current_member     = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_child_name = $current_member && ! empty( $current_member->child_name ) ? $current_member->child_name : '';
$booking_nonce      = wp_create_nonce( 'hieucon_booking_nonce' );

$parent_name    = $booking_row ? $booking_row->parent_name : 'ba/mẹ';
$phone          = $booking_row ? $booking_row->phone : '';
$preferred_time = $booking_row ? $booking_row->preferred_time : '';
?>

<style>
    #primary.hc-survey-page {
        background: #ffffff !important;
        color: #0A1931;
    }
    .hc-survey-card {
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

<main id="primary" class="site-main hc-survey-page min-h-screen py-12 md:py-20">
    <div class="max-w-[820px] mx-auto px-4 sm:px-6 lg:px-8">

        <div id="survey-card-wrapper" class="hc-survey-card relative">
            <div class="hc-card-bar"></div>

            <div class="p-6 sm:p-10">

                <!-- MÀN HÌNH KHẢO SÁT -->
                <div id="booking-step2-container">
                    <!-- Thông báo đã giữ thông tin liên hệ -->
                    <div class="bg-[#fff7ed] border border-orange-200/90 rounded-2xl p-5 mb-8 flex items-start gap-3.5">
                        <div class="w-8 h-8 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="check" class="w-4 h-4"></i>
                        </div>
                        <div class="text-sm sm:text-base leading-relaxed text-slate-700">
                            <p class="font-bold text-navy text-base sm:text-lg">
                                Đã ghi nhận thông tin liên hệ của <?php echo esc_html( $parent_name ); ?>
                                <?php if ( ! empty( $booking_code ) ) : ?>
                                    <span class="inline-block ml-1 text-xs font-extrabold bg-white text-secondary border border-orange-200 px-2.5 py-0.5 rounded-full align-middle">
                                        Mã hồ sơ: <?php echo esc_html( $booking_code ); ?>
                                    </span>
                                <?php endif; ?>
                            </p>
                            <p class="mt-1">
                                Để đội ngũ nắm rõ tình trạng của bé trước buổi trao đổi 30 phút<?php echo ! empty( $preferred_time ) ? ' (khung giờ: <strong class="text-navy">' . esc_html( $preferred_time ) . '</strong>)' : ''; ?>, ba mẹ dành 1 phút tích chọn nhanh các biểu hiện dưới đây nhé:
                            </p>
                        </div>
                    </div>

                    <div class="mb-7">
                        <h1 class="font-serif text-2xl sm:text-3xl font-bold text-navy">
                            Khảo sát nhanh tình trạng của con
                        </h1>
                    </div>

                    <form id="hieucon-booking-step2-form" class="space-y-6" novalidate>
                        <input type="hidden" id="booking-nonce" name="nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">
                        <input type="hidden" id="survey-booking-id" name="booking_id" value="<?php echo esc_attr( $booking_id ); ?>">
                        <input type="hidden" id="survey-booking-code" name="booking_code" value="<?php echo esc_attr( $booking_code ); ?>">

                        <!-- 1. Thông tin bé -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <div class="grid grid-cols-1 sm:grid-cols-12 gap-5">
                                <div class="sm:col-span-5">
                                    <label for="survey-child-name" class="block text-sm font-bold text-navy mb-2">Tên gọi của bé</label>
                                    <input
                                        type="text"
                                        id="survey-child-name"
                                        name="child_name"
                                        value="<?php echo esc_attr( $prefill_child_name ); ?>"
                                        placeholder="VD: Bé Bắp / Minh Khôi"
                                        class="w-full px-4 py-2.5 rounded-xl bg-white border border-slate-200 focus:border-secondary outline-none text-navy text-sm font-medium"
                                    >
                                </div>
                                <div class="sm:col-span-7">
                                    <label class="block text-sm font-bold text-navy mb-2">Độ tuổi của bé</label>
                                    <input type="hidden" id="survey-child-age" name="child_age" value="2 – 3 tuổi">
                                    <div class="flex flex-wrap gap-2" data-single-group="survey-child-age">
                                        <?php
                                        $age_options = [ 'Dưới 2 tuổi', '2 – 3 tuổi', '3 – 5 tuổi', '5 – 7 tuổi', 'Trên 7 tuổi' ];
                                        foreach ( $age_options as $idx => $age_label ) :
                                            $active_cls = ( 1 === $idx ) ? 'is-selected' : '';
                                        ?>
                                        <button type="button" data-value="<?php echo esc_attr( $age_label ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-3.5 py-2 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                            <?php echo esc_html( $age_label ); ?>
                                        </button>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 2. Vấn đề quan tâm nhất -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <label class="block text-sm font-bold text-navy mb-3">Vấn đề ba mẹ đang quan tâm nhất ở con</label>
                            <input type="hidden" id="survey-diagnosis" name="diagnosis" value="Táo bón / tiêu hóa">
                            <div class="flex flex-wrap gap-2.5" data-single-group="survey-diagnosis">
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
                                <button type="button" data-value="<?php echo esc_attr( $diag ); ?>" class="survey-single-pill <?php echo esc_attr( $active_cls ); ?> px-4 py-2.5 rounded-xl border border-slate-200 bg-white text-navy text-xs sm:text-sm font-semibold transition-all cursor-pointer">
                                    <?php echo esc_html( $diag ); ?>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 3. Biểu hiện ăn uống & tiêu hóa -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <label class="block text-sm font-bold text-navy mb-3">
                                Biểu hiện ăn uống & tiêu hóa hiện tại (có thể chọn nhiều)
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
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
                                <button type="button" data-multi-name="bio_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3.5 py-3 rounded-xl border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-2.5 cursor-pointer">
                                    <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </span>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 4. Biểu hiện hấp thu, vi chất, giấc ngủ & hành vi -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <label class="block text-sm font-bold text-navy mb-3">
                                Biểu hiện hấp thu, vi chất, giấc ngủ & hành vi (có thể chọn nhiều)
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
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
                                <button type="button" data-multi-name="behav_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3.5 py-3 rounded-xl border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-2.5 cursor-pointer">
                                    <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </span>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 5. Những hướng gia đình đã áp dụng -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <label class="block text-sm font-bold text-navy mb-3">
                                Gia đình đã áp dụng những hướng nào?
                            </label>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2.5">
                                <?php
                                $tried_methods = [
                                    'Đã dùng men vi sinh, chất xơ hỗ trợ',
                                    'Đang bổ sung một số loại vitamin, vi chất',
                                    'Đã thử điều chỉnh chế độ ăn tại nhà',
                                    'Đang tìm hiểu hướng ưu tiên phù hợp cho con',
                                ];
                                foreach ( $tried_methods as $item ) :
                                ?>
                                <button type="button" data-multi-name="tried_methods[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip text-left px-3.5 py-3 rounded-xl border border-slate-200 bg-white hover:border-secondary/50 text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-2.5 cursor-pointer">
                                    <span class="chip-check-icon w-4 h-4 rounded border border-slate-300 flex items-center justify-center shrink-0 text-transparent transition-colors">
                                        <i data-lucide="check" class="w-3 h-3"></i>
                                    </span>
                                    <span><?php echo esc_html( $item ); ?></span>
                                </button>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- 6. Điều muốn làm rõ nhất -->
                        <div class="bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-5 sm:p-6">
                            <label for="survey-parent-goal" class="block text-sm font-bold text-navy mb-2">
                                Điều ba mẹ mong muốn làm rõ nhất trong 30 phút này:
                            </label>
                            <textarea
                                id="survey-parent-goal"
                                name="parent_goal"
                                rows="3"
                                placeholder="Chia sẻ ngắn gọn điều gia đình đang quan tâm nhất ở con..."
                                class="w-full px-4 py-3 rounded-xl bg-white border border-slate-200 focus:border-secondary outline-none text-navy text-sm transition-all resize-none"
                            ></textarea>
                        </div>

                        <div id="booking-step2-error" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-semibold px-4 py-3"></div>

                        <div class="space-y-3 pt-2">
                            <button
                                type="submit"
                                id="booking-step2-btn"
                                class="w-full py-4 px-6 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base uppercase tracking-wider shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2 cursor-pointer"
                            >
                                <i data-lucide="check-circle-2" class="w-5 h-5"></i>
                                <span>HOÀN TẤT ĐĂNG KÝ CASE CỦA CON</span>
                            </button>

                            <button
                                type="button"
                                id="booking-skip-survey-btn"
                                class="w-full py-2 text-center text-xs sm:text-sm font-medium text-slate-500 hover:text-navy underline transition-colors cursor-pointer"
                            >
                                Bỏ qua bước khảo sát này →
                            </button>
                        </div>
                    </form>
                </div>

                <!-- MÀN HÌNH HOÀN TẤT -->
                <div id="booking-success-container" class="hidden text-center py-8">
                    <div class="w-16 h-16 rounded-full bg-[#fff7ed] text-secondary flex items-center justify-center mx-auto mb-4">
                        <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                    </div>
                    <?php if ( ! empty( $booking_code ) ) : ?>
                        <span class="inline-block bg-[#fff7ed] text-secondary border border-orange-200 font-bold text-xs px-3.5 py-1 rounded-full mb-3">
                            Mã hồ sơ: <?php echo esc_html( $booking_code ); ?>
                        </span>
                    <?php endif; ?>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-3">Đã tiếp nhận đầy đủ thông tin của gia đình</h2>
                    <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-lg mx-auto mb-6">
                        Cảm ơn <strong class="text-navy"><?php echo esc_html( $parent_name ); ?></strong>. Đội ngũ sẽ tổng hợp, xem xét thông tin của bé và liên hệ<?php echo ! empty( $phone ) ? ' qua số <strong class="text-secondary">' . esc_html( $phone ) . '</strong>' : ''; ?> đối với các trường hợp phù hợp trong đợt này.
                    </p>

                    <div id="res-survey-badge" class="hidden inline-flex items-center gap-1.5 bg-[#f8fafc] text-navy border border-slate-200 px-4 py-2 rounded-xl text-xs sm:text-sm font-semibold mb-7">
                        <i data-lucide="file-check-2" class="w-4 h-4 text-secondary"></i>
                        <span>Đã lưu thông tin khảo sát tình trạng của bé</span>
                    </div>

                    <div class="max-w-sm mx-auto space-y-3">
                        <a href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-navy hover:bg-navy/90 text-white font-bold text-sm flex items-center justify-center gap-2 transition-all">
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

    // Chọn đơn (Độ tuổi & Vấn đề quan tâm)
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

    // Chọn nhiều
    const multiChips = document.querySelectorAll('.survey-multi-chip');
    multiChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const activeCls = chip.getAttribute('data-active-class') || 'is-selected';
            chip.classList.toggle(activeCls);
        });
    });

    const cardWrapper = document.getElementById('survey-card-wrapper');
    const step2Container = document.getElementById('booking-step2-container');
    const successContainer = document.getElementById('booking-success-container');
    const step2Form = document.getElementById('hieucon-booking-step2-form');
    const step2Btn = document.getElementById('booking-step2-btn');
    const step2Error = document.getElementById('booking-step2-error');
    const skipSurveyBtn = document.getElementById('booking-skip-survey-btn');

    function showSuccess(hasSurvey) {
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

    if (skipSurveyBtn) {
        skipSurveyBtn.addEventListener('click', function () {
            showSuccess(false);
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

            // Hiển thị ngay kết quả hoàn tất (0ms) không bắt phụ huynh chờ
            showSuccess(true);

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
