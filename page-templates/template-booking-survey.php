<?php
/**
 * Template Name: Khảo Sát Tình Trạng Của Con (Bước 2)
 * Description: Trang khảo sát độc lập sau khi phụ huynh đăng ký thông tin liên hệ ở trang Đặt lịch 1:1.
 *
 * @package Hieucon
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $wpdb;
$table_name   = $wpdb->prefix . 'hieucon_bookings';
$booking_id   = isset( $_GET['booking_id'] ) ? intval( $_GET['booking_id'] ) : 0;
$raw_code     = isset( $_GET['code'] ) ? wp_unslash( $_GET['code'] ) : ( isset( $_GET['booking_code'] ) ? wp_unslash( $_GET['booking_code'] ) : '' );
$booking_code = strtoupper( sanitize_text_field( $raw_code ) );

$landing_page_url = function_exists( 'hieucon_get_booking_landing_url' ) ? hieucon_get_booking_landing_url() : home_url( '/dat-lich-tu-van/' );

if ( empty( $booking_code ) && $booking_id <= 0 ) {
    wp_safe_redirect( $landing_page_url );
    exit;
}

$booking_row = null;
if ( $booking_id > 0 && ! empty( $booking_code ) ) {
    $booking_row = $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d AND booking_code = %s LIMIT 1", $booking_id, $booking_code )
    );
}
if ( ! $booking_row && ! empty( $booking_code ) ) {
    $booking_row = $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM $table_name WHERE booking_code = %s ORDER BY id DESC LIMIT 1", $booking_code )
    );
}
if ( ! $booking_row && $booking_id > 0 ) {
    $booking_row = $wpdb->get_row(
        $wpdb->prepare( "SELECT * FROM $table_name WHERE id = %d LIMIT 1", $booking_id )
    );
}

if ( ! $booking_row ) {
    wp_safe_redirect( $landing_page_url );
    exit;
}

$booking_id         = intval( $booking_row->id );
$booking_code       = $booking_row->booking_code;
$parent_name        = $booking_row->parent_name;
$phone              = $booking_row->phone;
$preferred_time     = $booking_row->preferred_time;
$existing_survey    = ! empty( $booking_row->survey_data ) ? json_decode( $booking_row->survey_data, true ) : [];
if ( ! is_array( $existing_survey ) ) {
    $existing_survey = [];
}

$current_member     = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_child_name = ! empty( $existing_survey['child_name'] )
    ? $existing_survey['child_name']
    : ( $current_member && ! empty( $current_member->child_name ) ? $current_member->child_name : '' );
$prefill_child_age  = ! empty( $existing_survey['child_age'] ) ? $existing_survey['child_age'] : '2 – 3 tuổi';
$prefill_diagnosis  = ! empty( $existing_survey['diagnosis'] ) ? $existing_survey['diagnosis'] : 'Táo bón / tiêu hóa';
$prefill_bio        = isset( $existing_survey['bio_symptoms'] ) && is_array( $existing_survey['bio_symptoms'] ) ? $existing_survey['bio_symptoms'] : [];
$prefill_behav      = isset( $existing_survey['behav_symptoms'] ) && is_array( $existing_survey['behav_symptoms'] ) ? $existing_survey['behav_symptoms'] : [];
$prefill_tried      = isset( $existing_survey['tried_methods'] ) && is_array( $existing_survey['tried_methods'] ) ? $existing_survey['tried_methods'] : [];
$prefill_goal       = ! empty( $existing_survey['parent_goal'] ) ? $existing_survey['parent_goal'] : '';
$booking_nonce      = wp_create_nonce( 'hieucon_booking_nonce' );

get_header();
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
        box-shadow: 0 24px 60px -28px rgba(10, 25, 49, 0.08);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #0A1931 0%, #f97316 100%);
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

<main id="primary" class="site-main hc-survey-page min-h-screen py-12 md:py-20">
    <div class="max-w-[880px] mx-auto px-4 sm:px-6 lg:px-8">

        <!-- MÀN HÌNH KHẢO SÁT -->
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
                            <p class="text-sm sm:text-base font-bold text-white"><?php echo esc_html( $parent_name ); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-white/10 text-secondary flex items-center justify-center shrink-0">
                            <i data-lucide="clock" class="w-5 h-5"></i>
                        </div>
                        <div>
                            <p class="text-[11px] text-white/60 uppercase tracking-wider font-semibold">Khung giờ trao đổi</p>
                            <p class="text-sm sm:text-base font-bold text-white"><?php echo esc_html( $preferred_time ); ?></p>
                        </div>
                    </div>

                    <div class="flex items-center sm:justify-end">
                        <span class="inline-flex items-center gap-2 bg-secondary/20 text-secondary border border-secondary/40 px-3.5 py-2 rounded-xl text-xs sm:text-sm font-extrabold">
                            <span>Mã hồ sơ:</span>
                            <span class="text-white"><?php echo esc_html( $booking_code ); ?></span>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Khung Form Khảo Sát Chính -->
            <div id="survey-card-wrapper" class="hc-survey-card relative">
                <div class="hc-card-bar"></div>

                <form id="hieucon-booking-step2-form" class="divide-y divide-slate-200/80" novalidate>
                    <input type="hidden" id="booking-nonce" name="nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">
                    <input type="hidden" id="survey-booking-id" name="booking_id" value="<?php echo esc_attr( $booking_id ); ?>">
                    <input type="hidden" id="survey-booking-code" name="booking_code" value="<?php echo esc_attr( $booking_code ); ?>">

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
                                <input type="hidden" id="survey-child-age" name="child_age" value="<?php echo esc_attr( $prefill_child_age ); ?>">
                                <div class="flex flex-wrap gap-2" data-single-group="survey-child-age">
                                    <?php
                                    $age_options = [ 'Dưới 2 tuổi', '2 – 3 tuổi', '3 – 5 tuổi', '5 – 7 tuổi', 'Trên 7 tuổi' ];
                                    foreach ( $age_options as $idx => $age_label ) :
                                        $active_cls = ( $age_label === $prefill_child_age || ( ! in_array( $prefill_child_age, $age_options, true ) && 1 === $idx ) ) ? 'is-selected' : '';
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

                        <?php
                        $diagnoses = [
                            'Táo bón / tiêu hóa',
                            'Kén ăn / nhai nuốt',
                            'Bất dung nạp thực phẩm',
                            'Hấp thu / chậm tăng cân',
                            'Thiếu hụt vi chất',
                        ];
                        $matched_diag = $diagnoses[0];
                        foreach ( $diagnoses as $d_opt ) {
                            if ( $d_opt === $prefill_diagnosis || false !== mb_stripos( $prefill_diagnosis, explode( ' /', $d_opt )[0] ) ) {
                                $matched_diag = $d_opt;
                                break;
                            }
                        }
                        ?>
                        <input type="hidden" id="survey-diagnosis" name="diagnosis" value="<?php echo esc_attr( $matched_diag ); ?>">
                        <div class="flex flex-wrap gap-2.5 pl-0 sm:pl-11" data-single-group="survey-diagnosis">
                            <?php
                            foreach ( $diagnoses as $idx => $diag ) :
                                $active_cls = ( $diag === $matched_diag ) ? 'is-selected' : '';
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
                                $chip_sel = in_array( $item, $prefill_bio, true ) ? 'is-selected' : '';
                            ?>
                            <button type="button" data-multi-name="bio_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip <?php echo esc_attr( $chip_sel ); ?> text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
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
                                $chip_sel = in_array( $item, $prefill_behav, true ) ? 'is-selected' : '';
                            ?>
                            <button type="button" data-multi-name="behav_symptoms[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip <?php echo esc_attr( $chip_sel ); ?> text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
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
                                $chip_sel = in_array( $item, $prefill_tried, true ) ? 'is-selected' : '';
                            ?>
                            <button type="button" data-multi-name="tried_methods[]" data-value="<?php echo esc_attr( $item ); ?>" data-active-class="is-selected" class="survey-multi-chip <?php echo esc_attr( $chip_sel ); ?> text-left px-4 py-3.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-xs sm:text-sm font-medium flex items-center gap-3 cursor-pointer">
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
                            ><?php echo esc_textarea( $prefill_goal ); ?></textarea>

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

        <!-- MÀN HÌNH HOÀN TẤT -->
        <div id="booking-success-container" class="hidden">
            <div class="hc-survey-card relative p-8 sm:p-12 text-center max-w-xl mx-auto">
                <div class="hc-card-bar absolute top-0 left-0 right-0"></div>

                <div class="w-16 h-16 rounded-full bg-[#fff7ed] text-secondary flex items-center justify-center mx-auto mb-5">
                    <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                </div>

                <span class="inline-block bg-[#fff7ed] text-secondary border border-orange-200 font-bold text-xs px-4 py-1.5 rounded-full mb-4">
                    Mã hồ sơ: <?php echo esc_html( $booking_code ); ?>
                </span>

                <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-3">
                    Đã tiếp nhận đầy đủ thông tin của gia đình
                </h2>

                <p class="text-slate-600 text-sm sm:text-base leading-relaxed max-w-md mx-auto mb-6">
                    Cảm ơn <strong class="text-navy"><?php echo esc_html( $parent_name ); ?></strong>. Đội ngũ sẽ tổng hợp, xem trước thông tin của bé và liên hệ qua số <strong class="text-secondary"><?php echo esc_html( $phone ); ?></strong> (khung giờ: <strong class="text-navy"><?php echo esc_html( $preferred_time ); ?></strong>) đối với các trường hợp phù hợp trong đợt này.
                </p>

                <div id="res-survey-badge" class="hidden inline-flex items-center gap-2 bg-[#f8fafc] text-navy border border-slate-200 px-4 py-2.5 rounded-xl text-xs sm:text-sm font-semibold mb-7">
                    <i data-lucide="file-check-2" class="w-4 h-4 text-secondary"></i>
                    <span>Đã lưu đầy đủ thông tin khảo sát tình trạng của bé</span>
                </div>

                <div class="max-w-sm mx-auto space-y-3">
                    <a href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-4 px-6 rounded-xl bg-navy hover:bg-navy/90 text-white font-bold text-sm sm:text-base flex items-center justify-center gap-2 transition-all">
                        <span>Nhắn xác nhận qua Zalo</span>
                    </a>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="block text-xs sm:text-sm font-semibold text-slate-500 hover:text-navy pt-2">
                        ← Quay về trang chủ
                    </a>
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

    const step2Container = document.getElementById('booking-step2-container');
    const successContainer = document.getElementById('booking-success-container');
    const step2Form = document.getElementById('hieucon-booking-step2-form');
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

        window.scrollTo({ top: 0, behavior: 'smooth' });
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

            // Hiển thị ngay kết quả hoàn tất (0ms)
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
