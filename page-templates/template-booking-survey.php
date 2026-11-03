<?php
/**
 * Template Name: Khảo Sát Tình Trạng Của Con (Bước 2)
 * Description: Phiếu Đánh Giá & Khảo Sát Dinh Dưỡng Chuyên Sâu (4 phần - 28 câu hỏi) theo phong cách Hiểu Con Từ Gốc.
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

$current_member     = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$booking_id         = $booking_row ? intval( $booking_row->id ) : 0;
$booking_code       = $booking_row ? $booking_row->booking_code : $booking_code;
$parent_name        = $booking_row ? $booking_row->parent_name : ( $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '' );
$phone              = $booking_row ? $booking_row->phone : ( $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '' );
$preferred_time     = $booking_row && ! empty( $booking_row->preferred_time ) ? $booking_row->preferred_time : 'Buổi sáng (11:00 - 11:30)';
$existing_survey    = ( $booking_row && ! empty( $booking_row->survey_data ) ) ? json_decode( $booking_row->survey_data, true ) : [];
if ( ! is_array( $existing_survey ) ) {
    $existing_survey = [];
}

$prefill_child_name = ! empty( $existing_survey['child_name'] )
    ? $existing_survey['child_name']
    : ( $current_member && ! empty( $current_member->child_name ) ? $current_member->child_name : '' );
$prefill_child_age  = ! empty( $existing_survey['child_age'] ) ? $existing_survey['child_age'] : '';
$prefill_gender     = ! empty( $existing_survey['child_gender'] ) ? $existing_survey['child_gender'] : 'Bé Trai';
$prefill_weight     = ! empty( $existing_survey['child_weight'] ) ? $existing_survey['child_weight'] : '';
$prefill_height     = ! empty( $existing_survey['child_height'] ) ? $existing_survey['child_height'] : '';
$prefill_water      = ! empty( $existing_survey['water_amount'] ) ? $existing_survey['water_amount'] : '';
$prefill_other_diff = ! empty( $existing_survey['other_difficulties'] ) ? $existing_survey['other_difficulties'] : '';
$prefill_daily_diet = ! empty( $existing_survey['daily_diet'] ) ? $existing_survey['daily_diet'] : '';
$prefill_goal       = ! empty( $existing_survey['parent_goal'] ) ? $existing_survey['parent_goal'] : '';
$step1_issues       = ! empty( $existing_survey['child_issues'] ) && is_array( $existing_survey['child_issues'] ) ? $existing_survey['child_issues'] : [];

$booking_nonce      = wp_create_nonce( 'hieucon_booking_nonce' );
$zalo_target_url    = get_option( 'hieucon_link_zalo_tuvan', home_url( '/zalo' ) );

$clean_digits        = preg_replace( '/\D+/', '', (string) $phone );
$last4_digits        = strlen( $clean_digits ) >= 4 ? substr( $clean_digits, -4 ) : $clean_digits;
$masked_phone        = '' !== $last4_digits ? ( 'xxxxxxx' . $last4_digits ) : 'xxxxxxx----';
$display_parent_name = ! empty( $parent_name ) ? $parent_name : 'Phụ huynh';

// Danh sách 14 câu hỏi Phần 3 (Vấn đề dinh dưỡng, cảm giác & vận động)
// reverse_score = true nghĩa là chọn "Không" tính 1 điểm nguy cơ; ngược lại chọn "Có" tính 1 điểm nguy cơ
$section3_questions = [
    [
        'id'      => 'q7_1',
        'num'     => '1',
        'title'   => 'Trẻ có thích những đồ dùng và thức ăn thô ráp không?',
        'reverse' => true,
    ],
    [
        'id'      => 'q7_2',
        'num'     => '2',
        'title'   => 'Trẻ có tình trạng lười ăn rau, lười ăn hoa quả không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_3',
        'num'     => '3',
        'title'   => 'Trẻ có quá nhạy cảm với mùi, màu sắc hoặc kết cấu thực phẩm không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_4',
        'num'     => '4',
        'title'   => 'Trẻ có thường xuyên sử dụng thực phẩm trái mùa không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_5',
        'num'     => '5',
        'title'   => 'Trẻ có thường xuyên ăn bánh kẹo ngọt, đồ ngọt không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_6',
        'num'     => '6',
        'title'   => 'Trẻ có thường xuyên uống nước ngọt, nước có gas không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_7',
        'num'     => '7',
        'title'   => 'Trẻ có thường xuyên sử dụng socola, thực phẩm chứa caffein không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_8',
        'num'     => '8',
        'title'   => 'Trẻ có ăn thực phẩm chế biến sẵn, đóng hộp (xúc xích, mì gói, snack)?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_9',
        'num'     => '9',
        'title'   => 'Trẻ có sống gần nhà máy, xí nghiệp, khói bụi hoặc nguồn ô nhiễm không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_10',
        'num'     => '10',
        'title'   => 'Trẻ có được sử dụng nguồn nước tinh khiết, lọc RO/Nano đạt chuẩn không?',
        'reverse' => true,
    ],
    [
        'id'      => 'q7_11',
        'num'     => '11',
        'title'   => 'Trẻ thường xuyên xì hơi hoặc đi phân có mùi khó chịu/chua nồng không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_12',
        'num'     => '12',
        'title'   => 'Trẻ có khó khăn, sợ sệt hoặc gồng mình khi đi đại tiện không?',
        'reverse' => false,
    ],
    [
        'id'      => 'q7_13',
        'num'     => '13',
        'title'   => 'Trẻ có thường xuyên vận động thể lực (đi bộ, bơi, chạy nhảy, đạp xe)?',
        'reverse' => true,
    ],
    [
        'id'      => 'q7_14',
        'num'     => '14',
        'title'   => 'Trẻ có gặp khó khăn khi cầm thìa, tự xúc cơm ăn không?',
        'reverse' => false,
    ],
];

// Danh sách 9 câu hỏi Phần 4 (Khai thác bổ sung & tiền sử dùng vi chất - 3 nút bấm đồng bộ Phần 3)
$section4_supplements = [
    [
        'id'      => 'supp_vitamin',
        'num'     => '1',
        'title'   => 'Trẻ có uống bổ sung vitamin, khoáng chất hàng ngày không?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_special',
        'num'     => '2',
        'title'   => 'Trẻ có dùng sản phẩm dinh dưỡng hoặc sữa công thức đặc thù không?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_gfcf',
        'num'     => '3',
        'title'   => 'Trẻ đã thử chế độ ăn kiêng không gluten, không casein (GFCF) chưa?',
        'options' => [ 'Đang áp dụng', 'Đã dừng', 'Chưa thử' ],
    ],
    [
        'id'      => 'supp_iron',
        'num'     => '4',
        'title'   => 'Trẻ có dấu hiệu thiếu máu hoặc từng chẩn đoán thiếu máu thiếu sắt?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_vitd_test',
        'num'     => '5',
        'title'   => 'Trẻ đã từng xét nghiệm kiểm tra mức Vitamin D trong máu chưa?',
        'options' => [ 'Đã xét nghiệm', 'Chưa từng', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_vitd_use',
        'num'     => '6',
        'title'   => 'Trẻ có đang bổ sung Vitamin D hàng ngày hoặc định kỳ không?',
        'options' => [ 'Hàng ngày', 'Định kỳ', 'Không dùng' ],
    ],
    [
        'id'      => 'supp_enzyme',
        'num'     => '7',
        'title'   => 'Trẻ có đang dùng men tiêu hóa (Enzyme) hỗ trợ không?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_omega',
        'num'     => '8',
        'title'   => 'Trẻ có uống bổ sung Omega-3, Kẽm, Magie, Acid folic, B6 không?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
    [
        'id'      => 'supp_probiotic',
        'num'     => '9',
        'title'   => 'Trẻ có dùng men vi sinh (probiotic) hoặc thực phẩm lên men (≥2 lần/tuần)?',
        'options' => [ 'Có', 'Không', 'Không rõ' ],
    ],
];

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<?php get_template_part( 'template-parts/header/site-head' ); ?>
<body <?php body_class( 'antialiased text-navy bg-[#f8fafc]' ); ?>>
<?php wp_body_open(); ?>

<style>
    #primary.hc-survey-page {
        background: #f8fafc !important;
        color: #0A1931;
        padding-top: 0 !important;
    }
    .hc-section-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 20px 50px -28px rgba(10, 25, 49, 0.08);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #f97316 0%, #fb923c 100%);
    }

    /* Single-choice Cards (Phần 2: Câu 1, 2, 4, 6) */
    .hc-choice-card {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 13px 15px;
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
        text-align: left;
        height: 100%;
    }
    .hc-choice-card:hover {
        border-color: #fdba74;
        background: #fffaf5;
    }
    .hc-choice-card.is-selected {
        border-color: #f97316 !important;
        background: #fff7ed !important;
        box-shadow: 0 8px 20px -10px rgba(249, 115, 22, 0.35);
    }
    .hc-radio-dot {
        width: 20px;
        height: 20px;
        border-radius: 9999px;
        border: 2px solid #cbd5e1;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.18s ease;
    }
    .hc-radio-dot::after {
        content: '';
        width: 10px;
        height: 10px;
        border-radius: 9999px;
        background: #f97316;
        transform: scale(0);
        transition: transform 0.18s ease;
    }
    .hc-choice-card.is-selected .hc-radio-dot {
        border-color: #f97316;
    }
    .hc-choice-card.is-selected .hc-radio-dot::after {
        transform: scale(1);
    }

    /* Multi-choice Check Cards (Phần 2: Câu 3 & Câu 5) */
    .hc-check-card {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 13px 14px;
        border-radius: 16px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
        text-align: left;
        height: 100%;
    }
    .hc-check-card:hover {
        border-color: #fdba74;
        background: #fffaf5;
    }
    .hc-check-card.is-selected {
        border-color: #f97316 !important;
        background: #fff7ed !important;
        box-shadow: 0 8px 20px -10px rgba(249, 115, 22, 0.3);
    }
    .hc-check-box {
        width: 20px;
        height: 20px;
        border-radius: 6px;
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        color: transparent;
        transition: all 0.18s ease;
    }
    .hc-check-card.is-selected .hc-check-box {
        background: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }

    /* Row Buttons (Phần 3 & Phần 4: 3 cột nút bấm đều nhau tăm tắp) */
    .hc-row-btn,
    .hc-supp-btn {
        height: 40px;
        padding: 0 10px;
        border-radius: 11px;
        border: 1.5px solid #e2e8f0;
        background: #ffffff;
        color: #475569;
        font-size: 13px;
        font-weight: 700;
        transition: all 0.16s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        white-space: nowrap;
        width: 100%;
    }
    .hc-row-btn:hover,
    .hc-supp-btn:hover {
        border-color: #fdba74;
        color: #0A1931;
        background: #fffaf5;
    }
    .hc-row-btn.is-active,
    .hc-supp-btn.is-active {
        background: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
        box-shadow: 0 6px 14px -4px rgba(249, 115, 22, 0.35);
    }

    /* Dòng câu hỏi Phần 3 & Phần 4 */
    .hc-survey-row {
        transition: background-color 0.16s ease;
    }
    .hc-survey-row.is-error {
        background-color: #fef2f2 !important;
        border-radius: 12px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>

<main id="primary" class="site-main hc-survey-page min-h-screen pb-16 md:pb-24">

    <div class="max-w-[920px] mx-auto px-4 sm:px-6 lg:px-8 pt-6 sm:pt-10">

        <!-- Tiêu đề mở đầu -->
        <div class="text-center max-w-2xl mx-auto mb-5 sm:mb-7">
            <h1 class="font-serif text-2xl sm:text-4xl font-bold text-navy leading-tight">
                Khảo sát ban đầu
            </h1>
            <p class="mt-2 text-sm sm:text-base font-bold text-slate-600 flex items-center justify-center gap-2">
                <span class="text-navy"><?php echo esc_html( $display_parent_name ); ?></span>
                <span class="text-slate-300">•</span>
                <span class="font-mono tracking-wider text-secondary"><?php echo esc_html( $masked_phone ); ?></span>
            </p>
        </div>

        <!-- FORM KHẢO SÁT 4 PHẦN -->
        <form id="hieucon-booking-step2-form" class="space-y-6 sm:space-y-8" novalidate>
            <input type="hidden" id="booking-nonce" name="nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">
            <input type="hidden" id="survey-booking-id" name="booking_id" value="<?php echo esc_attr( $booking_id ); ?>">
            <input type="hidden" id="survey-booking-code" name="booking_code" value="<?php echo esc_attr( $booking_code ); ?>">
            <input type="hidden" id="survey-preferred-time" name="preferred_time" value="<?php echo esc_attr( $preferred_time ); ?>">
            <input type="hidden" id="parentName" name="parent_name" value="<?php echo esc_attr( $parent_name ); ?>">
            <input type="hidden" id="parentPhone" name="phone" value="<?php echo esc_attr( $phone ); ?>">

            <!-- =========================================================
                 PHẦN 1: THÔNG TIN CỦA BÉ
                 ========================================================= -->
            <section class="hc-section-card" id="sec-info">
                <div class="hc-card-bar"></div>
                <div class="p-5 sm:p-8">
                    <div class="flex items-center gap-3.5 pb-4 mb-5 border-b border-slate-100">
                        <span class="w-9 h-9 rounded-xl bg-secondary text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-xs">1</span>
                        <h2 class="font-serif text-base sm:text-xl font-bold text-navy uppercase tracking-wide">THÔNG TIN CỦA BÉ</h2>
                    </div>

                    <div class="space-y-4 sm:space-y-5">
                        <!-- Hàng 1: Họ tên trẻ + Giới tính -->
                        <div class="grid grid-cols-1 sm:grid-cols-12 gap-4 sm:gap-5">
                            <!-- Họ và tên trẻ -->
                            <div class="sm:col-span-7">
                                <label for="childName" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                    Họ và tên trẻ (hoặc tên ở nhà) <span class="text-secondary">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="childName"
                                    name="child_name"
                                    value="<?php echo esc_attr( $prefill_child_name ); ?>"
                                    required
                                    placeholder="Ví dụ: Bé Nguyễn Minh Khôi / Bé Bắp"
                                    class="w-full h-12 px-4 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-semibold text-base sm:text-sm transition-all"
                                >
                            </div>

                            <!-- Giới tính -->
                            <div class="sm:col-span-5">
                                <label class="block text-xs sm:text-sm font-bold text-navy mb-1.5">Giới tính</label>
                                <input type="hidden" id="childGender" name="child_gender" value="<?php echo esc_attr( $prefill_gender ); ?>">
                                <div class="grid grid-cols-2 gap-2.5">
                                    <button type="button" data-gender="Bé Trai" class="hc-gender-btn h-12 px-4 rounded-xl border text-sm font-bold transition-all cursor-pointer flex items-center justify-center gap-1.5 <?php echo 'Bé Gái' !== $prefill_gender ? 'bg-[#fff7ed] text-secondary border-secondary shadow-xs' : 'bg-[#f8fafc] text-slate-700 border-slate-200'; ?>">
                                        <span>👦</span> <span>Bé Trai</span>
                                    </button>
                                    <button type="button" data-gender="Bé Gái" class="hc-gender-btn h-12 px-4 rounded-xl border text-sm font-bold transition-all cursor-pointer flex items-center justify-center gap-1.5 <?php echo 'Bé Gái' === $prefill_gender ? 'bg-[#fff7ed] text-secondary border-secondary shadow-xs' : 'bg-[#f8fafc] text-slate-700 border-slate-200'; ?>">
                                        <span>👧</span> <span>Bé Gái</span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Hàng 2: Độ tuổi + Cân nặng + Chiều cao (Mobile: Tuổi 1 hàng, Cân nặng & Chiều cao 2 cột song song) -->
                        <div class="grid grid-cols-2 sm:grid-cols-12 gap-3.5 sm:gap-5">
                            <!-- Tuổi / Tháng tuổi -->
                            <div class="col-span-2 sm:col-span-4">
                                <label for="childAge" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                    Tuổi / Tháng tuổi của bé <span class="text-secondary">*</span>
                                </label>
                                <input
                                    type="text"
                                    id="childAge"
                                    name="child_age"
                                    value="<?php echo esc_attr( $prefill_child_age ); ?>"
                                    required
                                    placeholder="VD: 3 tuổi 4 tháng"
                                    class="w-full h-12 px-4 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-semibold text-base sm:text-sm transition-all"
                                >
                            </div>

                            <!-- Cân nặng (kg) -->
                            <div class="col-span-1 sm:col-span-4">
                                <label for="childWeight" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                    Cân nặng
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        inputmode="decimal"
                                        id="childWeight"
                                        name="child_weight"
                                        value="<?php echo esc_attr( $prefill_weight ); ?>"
                                        placeholder="VD: 14.5"
                                        class="w-full h-12 pl-4 pr-11 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-semibold text-base sm:text-sm transition-all"
                                    >
                                    <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 pointer-events-none">kg</span>
                                </div>
                            </div>

                            <!-- Chiều cao (cm) -->
                            <div class="col-span-1 sm:col-span-4">
                                <label for="childHeight" class="block text-xs sm:text-sm font-bold text-navy mb-1.5">
                                    Chiều cao
                                </label>
                                <div class="relative">
                                    <input
                                        type="text"
                                        inputmode="decimal"
                                        id="childHeight"
                                        name="child_height"
                                        value="<?php echo esc_attr( $prefill_height ); ?>"
                                        placeholder="VD: 96"
                                        class="w-full h-12 pl-4 pr-11 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-semibold text-base sm:text-sm transition-all"
                                    >
                                    <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 pointer-events-none">cm</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- =========================================================
                 PHẦN 2: TÌNH TRẠNG ĂN UỐNG & TIÊU HÓA TỔNG QUÁT (7 CÂU)
                 ========================================================= -->
            <section class="hc-section-card" id="sec-general">
                <div class="hc-card-bar"></div>
                <div class="p-5 sm:p-8 space-y-6">
                    <div class="flex items-center gap-3.5 pb-4 border-b border-slate-100">
                        <span class="w-9 h-9 rounded-xl bg-secondary text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-xs">2</span>
                        <h2 class="font-serif text-base sm:text-xl font-bold text-navy uppercase tracking-wide">TÌNH TRẠNG ĂN UỐNG &amp; TIÊU HÓA TỔNG QUÁT</h2>
                    </div>

                    <!-- Câu 1: Thói quen ăn uống -->
                    <div class="question-block space-y-2.5" data-qid="q1_eating">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">1. Thói quen ăn uống hàng ngày của bé:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="hc-choice-card" data-qid="q1_eating" data-score="0" data-label="Ăn đa dạng thực phẩm">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Ăn đa dạng thực phẩm</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Chấp nhận nhiều nhóm thức ăn</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q1_eating" data-score="1" data-label="Kén chọn đồ ăn">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Kén chọn đồ ăn</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Ăn chọn lọc, khó thử món mới</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q1_eating" data-score="0" data-label="Nếp ăn rất tốt">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Nếp ăn rất tốt</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Hào hứng với bữa ăn</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Câu 2: Khả năng nhai nuốt -->
                    <div class="question-block space-y-2.5 pt-1" data-qid="q2_chewing">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">2. Khả năng nhai nuốt và xử lý thức ăn:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="hc-choice-card" data-qid="q2_chewing" data-score="0" data-label="Nhai nuốt bình thường">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Nhai nuốt bình thường</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Nhai kỹ, nuốt gọn</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q2_chewing" data-score="1" data-label="Ngậm đồ ăn trong miệng">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Ngậm đồ ăn trong miệng</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Ngậm lâu, lười nhai, dễ ọe</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q2_chewing" data-score="0" data-label="Nhai nuốt rất tốt">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Nhai nuốt rất tốt</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Xử lý thức ăn thô tốt</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Câu 3: Tình trạng tiêu hóa và bài tiết (Chọn nhiều - 4 cột đồng bộ 1 dòng) -->
                    <?php
                    $has_taobon = in_array( 'Táo bón', $step1_issues, true );
                    ?>
                    <div class="space-y-2.5 pt-1" id="q3-digest-block">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">
                            3. Tình trạng tiêu hóa và bài tiết của trẻ <span class="text-xs font-normal text-slate-500">(Chọn các tình trạng bé đang gặp)</span>:
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                            <button type="button" data-digest="Táo bón" data-score="1" class="hc-check-card hc-digest-card <?php echo $has_taobon ? 'is-selected' : ''; ?>">
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy whitespace-nowrap">Táo bón</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Phân cứng, khó đi</span>
                                </div>
                            </button>

                            <button type="button" data-digest="Tiêu chảy" data-score="1" class="hc-check-card hc-digest-card">
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy whitespace-nowrap">Tiêu chảy</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Phân lỏng, phân sống</span>
                                </div>
                            </button>

                            <button type="button" data-digest="Nôn trớ, trào ngược" data-score="1" class="hc-check-card hc-digest-card">
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy whitespace-nowrap">Nôn trớ, trào ngược</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Ợ chua, hay nôn</span>
                                </div>
                            </button>

                            <button type="button" data-digest="Bình thường" data-score="0" data-exclusive="1" class="hc-check-card hc-digest-card">
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy whitespace-nowrap">Bình thường</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Không có vấn đề</span>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Câu 4: Chất lượng giấc ngủ ban đêm -->
                    <div class="question-block space-y-2.5 pt-1" data-qid="q4_sleep">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">4. Chất lượng giấc ngủ ban đêm:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="hc-choice-card" data-qid="q4_sleep" data-score="0" data-label="Trẻ ngủ ngon, sâu giấc">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Trẻ ngủ ngon, sâu giấc</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Ít giật mình, tỉnh táo</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q4_sleep" data-score="1" data-label="Khó ngủ, thức giấc nửa đêm">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Khó ngủ, thức giấc nửa đêm</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Trằn trọc, ngủ không sâu</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q4_sleep" data-score="0" data-label="Khác / Bình thường">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Khác / Bình thường</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Giấc ngủ chấp nhận được</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Câu 5: Tiền sử dị ứng đã biết (4 cột đồng bộ 1 dòng tiêu đề + 1 dòng phụ) -->
                    <div class="space-y-2.5 pt-1">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">
                            5. Tiền sử dị ứng đã biết <span class="text-xs font-normal text-slate-500">(Có thể chọn nhiều)</span>:
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3" id="allergy-group">
                            <?php
                            $allergy_opts = [
                                [
                                    'val'   => 'Dị ứng thuốc',
                                    'title' => 'Dị ứng thuốc',
                                    'sub'   => 'Kháng sinh, hạ sốt...',
                                    'excl'  => false,
                                ],
                                [
                                    'val'   => 'Dị ứng thực phẩm (tôm, cua, trứng, đậu phộng...)',
                                    'title' => 'Dị ứng thực phẩm',
                                    'sub'   => 'Tôm, cua, trứng, đậu...',
                                    'excl'  => false,
                                ],
                                [
                                    'val'   => 'Dị ứng sữa bò & các chế phẩm từ sữa',
                                    'title' => 'Dị ứng đạm sữa bò',
                                    'sub'   => 'Sữa bò & chế phẩm sữa',
                                    'excl'  => false,
                                ],
                                [
                                    'val'   => 'Chưa phát hiện dị ứng nào',
                                    'title' => 'Chưa phát hiện',
                                    'sub'   => 'Chưa ghi nhận dị ứng',
                                    'excl'  => true,
                                ],
                            ];
                            foreach ( $allergy_opts as $al_item ) :
                            ?>
                            <button type="button" data-allergy="<?php echo esc_attr( $al_item['val'] ); ?>" <?php echo $al_item['excl'] ? 'data-exclusive="1"' : ''; ?> class="hc-check-card hc-allergy-card">
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy whitespace-nowrap"><?php echo esc_html( $al_item['title'] ); ?></span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5 truncate"><?php echo esc_html( $al_item['sub'] ); ?></span>
                                </div>
                            </button>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Câu 6: Sử dụng thiết bị điện tử trong khi ăn -->
                    <div class="question-block space-y-2.5 pt-1" data-qid="q6_screen">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">6. Sử dụng thiết bị điện tử (điện thoại, TV, iPad) trong khi ăn:</label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="hc-choice-card" data-qid="q6_screen" data-score="0" data-label="Không dùng">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Không dùng</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Tập trung vào bàn ăn</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q6_screen" data-score="1" data-label="Ít dùng / Thỉnh thoảng">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Ít dùng / Thỉnh thoảng</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Chỉ xem lúc mệt mỏi</span>
                                </div>
                            </div>
                            <div class="hc-choice-card" data-qid="q6_screen" data-score="2" data-label="Dùng thường xuyên">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Dùng thường xuyên</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Phải có màn hình mới chịu ăn</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Câu 7: Lượng nước trẻ uống mỗi ngày (Khung ngang cân đối 100%) -->
                    <div class="pt-1">
                        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3.5 bg-[#f8fafc] border border-slate-200/90 rounded-2xl p-4 sm:px-5">
                            <div>
                                <label for="waterAmount" class="block text-sm sm:text-[15px] font-bold text-navy">
                                    7. Lượng nước trẻ uống mỗi ngày (khoảng):
                                </label>
                                <span class="block text-xs text-slate-500 mt-0.5">Bao gồm cả sữa, nước lọc, nước hoa quả, nước canh...</span>
                            </div>
                            <div class="relative w-full sm:w-64 shrink-0">
                                <input
                                    type="text"
                                    inputmode="numeric"
                                    id="waterAmount"
                                    name="water_amount"
                                    value="<?php echo esc_attr( $prefill_water ); ?>"
                                    placeholder="VD: 800"
                                    class="w-full h-12 pl-4 pr-20 rounded-xl bg-white border border-slate-200 focus:border-secondary outline-none text-navy font-semibold text-base sm:text-sm transition-all"
                                >
                                <span class="absolute right-3.5 top-1/2 -translate-y-1/2 text-xs font-bold text-slate-400 pointer-events-none">ml/ngày</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- =========================================================
                 PHẦN 3: VẤN ĐỀ DINH DƯỠNG, CẢM GIÁC & VẬN ĐỘNG (14 CÂU)
                 ========================================================= -->
            <section class="hc-section-card" id="detailedQuestionsContainer">
                <div class="hc-card-bar"></div>
                <div class="p-5 sm:p-8">
                    <div class="flex items-center gap-3.5 pb-4 mb-1 border-b border-slate-100">
                        <span class="w-9 h-9 rounded-xl bg-secondary text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-xs">3</span>
                        <h2 class="font-serif text-base sm:text-xl font-bold text-navy uppercase tracking-wide">VẤN ĐỀ DINH DƯỠNG, CẢM GIÁC &amp; VẬN ĐỘNG</h2>
                    </div>

                    <div class="divide-y divide-slate-100">
                        <?php foreach ( $section3_questions as $q ) :
                            $yes_score = $q['reverse'] ? 0 : 1;
                            $no_score  = $q['reverse'] ? 1 : 0;
                        ?>
                        <div class="py-3.5 flex flex-col sm:flex-row sm:items-center justify-between gap-2.5 sm:gap-4 question-row hc-survey-row" data-qid="<?php echo esc_attr( $q['id'] ); ?>" data-qtitle="<?php echo esc_attr( $q['num'] . '. ' . $q['title'] ); ?>">
                            <span class="text-sm sm:text-[14.5px] font-bold text-navy leading-snug">
                                <?php echo esc_html( $q['num'] . '. ' . $q['title'] ); ?>
                            </span>
                            <div class="grid grid-cols-3 gap-2 w-full sm:w-[270px] shrink-0">
                                <button type="button" data-qid="<?php echo esc_attr( $q['id'] ); ?>" data-score="<?php echo esc_attr( $yes_score ); ?>" data-ans="Có" class="hc-row-btn">Có</button>
                                <button type="button" data-qid="<?php echo esc_attr( $q['id'] ); ?>" data-score="<?php echo esc_attr( $no_score ); ?>" data-ans="Không" class="hc-row-btn">Không</button>
                                <button type="button" data-qid="<?php echo esc_attr( $q['id'] ); ?>" data-score="0" data-ans="Không rõ" class="hc-row-btn">Không rõ</button>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="pt-5 mt-2 border-t border-slate-100">
                        <label for="otherFeedingDifficulties" class="block text-sm sm:text-[14.5px] font-bold text-navy mb-2">
                            15. Trẻ có gặp các khó khăn ăn uống đặc thù nào khác không? (Nếu có):
                        </label>
                        <textarea
                            id="otherFeedingDifficulties"
                            name="other_difficulties"
                            rows="2"
                            placeholder="Ví dụ: Bé chỉ ăn cơm với nước tương, hễ có màu xanh là nhè ra; hoặc bé rất sợ tiếng máy xay sinh tố..."
                            class="w-full px-4 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy text-sm transition-all"
                        ><?php echo esc_textarea( $prefill_other_diff ); ?></textarea>
                    </div>
                </div>
            </section>

            <!-- =========================================================
                 PHẦN 4: KHAI THÁC BỔ SUNG & TIỀN SỬ DÙNG VI CHẤT
                 ========================================================= -->
            <section class="hc-section-card" id="sec-supplements">
                <div class="hc-card-bar"></div>
                <div class="p-5 sm:p-8 space-y-6">
                    <div class="flex items-center gap-3.5 pb-4 border-b border-slate-100">
                        <span class="w-9 h-9 rounded-xl bg-secondary text-white font-extrabold text-sm flex items-center justify-center shrink-0 shadow-xs">4</span>
                        <h2 class="font-serif text-base sm:text-xl font-bold text-navy uppercase tracking-wide">KHAI THÁC BỔ SUNG &amp; TIỀN SỬ DÙNG VI CHẤT</h2>
                    </div>

                    <!-- Cụm 1: Các vi chất / sản phẩm bé đang bổ sung (Tích chọn nhanh) -->
                    <div class="space-y-2.5" id="supp-active-group">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">
                            1. Các vi chất hoặc sản phẩm dinh dưỡng bé đang sử dụng <span class="text-xs font-normal text-slate-500">(Chọn các loại bé đang dùng)</span>:
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                            <?php
                            $supp_usage_cards = [
                                [
                                    'id'    => 'supp_vitamin',
                                    'q'     => '1. Bổ sung vitamin, khoáng chất hàng ngày',
                                    'title' => 'Vitamin & khoáng chất',
                                    'sub'   => 'Uống bổ sung hàng ngày',
                                    'excl'  => false,
                                ],
                                [
                                    'id'    => 'supp_vitd_use',
                                    'q'     => '6. Bổ sung Vitamin D hàng ngày/định kỳ',
                                    'title' => 'Vitamin D (D3 / D3K2)',
                                    'sub'   => 'Bổ sung hàng ngày hoặc định kỳ',
                                    'excl'  => false,
                                ],
                                [
                                    'id'    => 'supp_omega',
                                    'q'     => '8. Bổ sung Omega-3, Kẽm, Magie, Acid folic, B6',
                                    'title' => 'Omega-3, Kẽm, Magie, B6...',
                                    'sub'   => 'Vi chất hỗ trợ giấc ngủ, tập trung',
                                    'excl'  => false,
                                ],
                                [
                                    'id'    => 'supp_probiotic',
                                    'q'     => '9. Dùng men vi sinh (probiotic) / thực phẩm lên men',
                                    'title' => 'Men vi sinh (Probiotic)',
                                    'sub'   => 'Hoặc sữa chua lên men ≥ 2 lần/tuần',
                                    'excl'  => false,
                                ],
                                [
                                    'id'    => 'supp_enzyme',
                                    'q'     => '7. Dùng men tiêu hóa (Enzyme) hỗ trợ',
                                    'title' => 'Men tiêu hóa (Enzyme)',
                                    'sub'   => 'Hỗ trợ phân giải & tiêu hóa thức ăn',
                                    'excl'  => false,
                                ],
                                [
                                    'id'    => 'supp_special',
                                    'q'     => '2. Dùng sản phẩm dinh dưỡng / sữa công thức đặc thù',
                                    'title' => 'Sữa / Dinh dưỡng đặc thù',
                                    'sub'   => 'Sữa thủy phân, sữa hạt chuyên biệt...',
                                    'excl'  => false,
                                ],
                            ];
                            foreach ( $supp_usage_cards as $sc ) :
                            ?>
                            <button
                                type="button"
                                data-supp-id="<?php echo esc_attr( $sc['id'] ); ?>"
                                data-qtitle="<?php echo esc_attr( $sc['q'] ); ?>"
                                class="hc-check-card hc-supp-check-card"
                            >
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy"><?php echo esc_html( $sc['title'] ); ?></span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5"><?php echo esc_html( $sc['sub'] ); ?></span>
                                </div>
                            </button>
                            <?php endforeach; ?>

                            <button
                                type="button"
                                data-supp-none="1"
                                data-exclusive="1"
                                class="hc-check-card hc-supp-check-card sm:col-span-2 lg:col-span-3 justify-center bg-slate-50/90"
                            >
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <span class="text-xs sm:text-[13.5px] font-bold text-navy">Hiện tại bé chưa bổ sung loại vi chất hay sản phẩm nào ở trên</span>
                            </button>
                        </div>
                    </div>

                    <!-- Cụm 2: Chế độ ăn kiêng không Gluten, không Casein (GFCF) -->
                    <div class="question-block space-y-2.5 pt-1" data-qid="supp_gfcf">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">
                            2. Trẻ đã thử chế độ ăn kiêng không gluten, không casein (GFCF) chưa?
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <div class="hc-choice-card hc-gfcf-card" data-gfcf="Đang áp dụng chế độ GFCF">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Đang áp dụng GFCF</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Kiêng đạm sữa bò &amp; bột mì</span>
                                </div>
                            </div>
                            <div class="hc-choice-card hc-gfcf-card" data-gfcf="Đã từng nhưng đã dừng">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Đã từng nhưng đã dừng</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Có thử qua trước đây</span>
                                </div>
                            </div>
                            <div class="hc-choice-card hc-gfcf-card" data-gfcf="Chưa từng thử qua">
                                <span class="hc-radio-dot"></span>
                                <div>
                                    <span class="block text-xs sm:text-sm font-bold text-navy">Chưa từng thử qua</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Ăn chế độ bình thường</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cụm 3: Tiền sử thiếu máu & Xét nghiệm vi chất -->
                    <div class="space-y-2.5 pt-1" id="supp-med-group">
                        <label class="block text-sm sm:text-[15px] font-bold text-navy">
                            3. Tiền sử thiếu máu &amp; xét nghiệm kiểm tra vi chất <span class="text-xs font-normal text-slate-500">(Chọn mục đúng với bé)</span>:
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <button
                                type="button"
                                data-med-id="supp_iron"
                                data-qtitle="4. Dấu hiệu hoặc chẩn đoán thiếu máu thiếu sắt"
                                class="hc-check-card hc-med-check-card"
                            >
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy">Có dấu hiệu thiếu máu</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Hoặc từng chẩn đoán thiếu sắt</span>
                                </div>
                            </button>

                            <button
                                type="button"
                                data-med-id="supp_vitd_test"
                                data-qtitle="5. Đã từng xét nghiệm Vitamin D trong máu"
                                class="hc-check-card hc-med-check-card"
                            >
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy">Đã xét nghiệm Vitamin D</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Đã kiểm tra nồng độ trong máu</span>
                                </div>
                            </button>

                            <button
                                type="button"
                                data-med-none="1"
                                data-exclusive="1"
                                class="hc-check-card hc-med-check-card"
                            >
                                <span class="hc-check-box">
                                    <svg class="w-3.5 h-3.5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M16.704 5.29a1 1 0 010 1.42l-7.5 7.5a1 1 0 01-1.42 0l-3.5-3.5a1 1 0 011.42-1.42L8.5 12.09l6.79-6.8a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                </span>
                                <div class="min-w-0">
                                    <span class="block text-xs sm:text-[13.5px] font-bold text-navy">Chưa từng kiểm tra</span>
                                    <span class="block text-[11.5px] text-slate-500 mt-0.5">Không có biểu hiện thiếu máu</span>
                                </div>
                            </button>
                        </div>
                    </div>

                    <!-- Câu 4: Thực đơn 1 ngày điển hình (rows=4 hiển thị trọn vẹn 4 dòng placeholder không thanh cuộn) -->
                    <div class="pt-4 border-t border-slate-100">
                        <label for="dailyDietDesc" class="block text-sm sm:text-[15px] font-bold text-navy mb-2">
                            4. Mô tả chế độ ăn hiện tại điển hình trong 1 ngày của con:
                        </label>
                        <textarea
                            id="dailyDietDesc"
                            name="daily_diet"
                            rows="4"
                            placeholder="Sáng: ...&#10;Trưa: ...&#10;Tối: ...&#10;Các bữa phụ (sữa/bánh/hoa quả): ..."
                            class="w-full px-4 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy text-sm leading-relaxed transition-all"
                        ><?php echo esc_textarea( $prefill_daily_diet ); ?></textarea>
                    </div>

                    <!-- Câu 5: Điều mong muốn làm rõ nhất trong buổi 1:1 -->
                    <div class="pt-3 border-t border-slate-100">
                        <label for="survey-parent-goal" class="block text-sm sm:text-[15px] font-bold text-navy mb-2">
                            5. Điều ba mẹ mong muốn được giải đáp nhất trong buổi trao đổi 30 phút:
                        </label>
                        <textarea
                            id="survey-parent-goal"
                            name="parent_goal"
                            rows="2"
                            placeholder="Chia sẻ ngắn gọn điều gia đình đang trăn trở nhất về tình trạng của con..."
                            class="w-full px-4 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy text-sm leading-relaxed transition-all"
                        ><?php echo esc_textarea( $prefill_goal ); ?></textarea>
                    </div>

                    <!-- Nút Gửi Khảo Sát -->
                    <div class="pt-2">
                        <button
                            type="submit"
                            id="booking-step2-btn"
                            class="w-full py-4 px-8 rounded-2xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-base sm:text-lg uppercase tracking-wider shadow-[0_14px_28px_-8px_rgba(249,115,22,0.45)] hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2.5 cursor-pointer"
                        >
                            <i data-lucide="send" class="w-5 h-5"></i>
                            <span>GỬI KHẢO SÁT</span>
                        </button>
                    </div>
                </div>
            </section>
        </form>

        <!-- =========================================================
             MÀN HÌNH KẾT QUẢ ĐÁNH GIÁ TÌNH TRẠNG DINH DƯỠNG
             ========================================================= -->
        <div id="resultCard" class="hidden mt-8 hc-section-card border-2 border-secondary scroll-mt-28">
            <div class="hc-card-bar"></div>
            <div class="p-6 sm:p-10">
                <div class="text-center border-b border-slate-100 pb-6">
                    <span class="inline-flex items-center gap-1.5 bg-[#fff7ed] text-secondary border border-orange-200 px-3.5 py-1 rounded-full text-xs font-extrabold uppercase tracking-wider mb-3">
                        <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                        <span>Báo cáo sàng lọc sơ bộ</span>
                    </span>
                    <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">
                        KẾT QUẢ ĐÁNH GIÁ TÌNH TRẠNG DINH DƯỠNG
                    </h2>
                    <p class="text-sm sm:text-base text-slate-600">
                        Dành cho bé: <strong id="resChildName" class="text-navy">-</strong>
                        (<span id="resChildAge" class="font-semibold text-secondary">-</span>)
                        • Phụ huynh: <strong id="resParentName" class="text-navy">-</strong>
                    </p>
                    <div class="mt-4">
                        <div id="resultBadge" class="inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl text-sm sm:text-base font-bold"></div>
                    </div>
                </div>

                <!-- Khung Nhận xét & Định hướng theo 3 mức điểm -->
                <div id="resultFeedbackBox" class="mt-6 p-5 sm:p-6 rounded-2xl text-sm sm:text-[15px] leading-relaxed"></div>

                <!-- Lưu ý quan trọng (Disclaimer) -->
                <div class="mt-5 p-4 rounded-xl bg-slate-50 border border-slate-200/90 flex items-start gap-2.5 text-xs sm:text-[13px] text-slate-600 leading-relaxed">
                    <i data-lucide="info" class="w-4 h-4 text-secondary shrink-0 mt-0.5"></i>
                    <div>
                        <strong class="text-navy">Lưu ý quan trọng:</strong> Kết quả được tổng hợp theo các dấu hiệu sàng lọc của bảng hỏi, mang tính chất định hướng hỗ trợ phụ huynh và <strong>không xác định trẻ thiếu vi chất</strong> hay thay thế cho việc thăm khám, chẩn đoán hoặc điều trị y tế.
                    </div>
                </div>

                <!-- Thông báo đã lưu & CTA kết nối Zalo -->
                <div class="mt-6 pt-6 border-t border-slate-100 text-center space-y-4">
                    <div class="inline-flex items-center gap-2 bg-emerald-50 text-emerald-800 border border-emerald-200 px-4 py-2 rounded-xl text-xs sm:text-sm font-bold">
                        <i data-lucide="check-circle-2" class="w-4 h-4 text-emerald-600"></i>
                        <span>Kết quả đánh giá của bé đã được lưu vào hồ sơ tư vấn 1:1 (SĐT: <strong id="resSavedPhone">-</strong>)</span>
                    </div>

                    <div class="max-w-md mx-auto flex flex-col sm:flex-row gap-3 justify-center pt-1">
                        <a
                            href="<?php echo esc_url( $zalo_target_url ); ?>"
                            target="_blank"
                            rel="noopener noreferrer"
                            class="flex-1 py-4 px-6 rounded-xl bg-secondary hover:bg-secondary_dark text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all flex items-center justify-center gap-2"
                        >
                            <span>Nhận Tư Vấn Chi Tiết Qua Zalo</span>
                            <i data-lucide="arrow-up-right" class="w-5 h-5"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Toast thông báo nhẹ nhàng cho phụ huynh -->
<div id="assessmentToast" class="fixed bottom-6 left-1/2 -translate-x-1/2 z-50 max-w-md w-[92%] px-5 py-3.5 rounded-2xl shadow-xl text-center text-xs sm:text-sm font-bold transition-all duration-300 pointer-events-none opacity-0 translate-y-4 bg-secondary text-white border-2 border-orange-300"></div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const ajaxUrl = '<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>';
    const nonceVal = document.getElementById('booking-nonce') ? document.getElementById('booking-nonce').value : '';
    const TOTAL_QUESTIONS = 28; // 4 single (Phần 2) + 1 digest (Phần 2) + 14 row (Phần 3) + 9 supp (Phần 4)

    const assessmentState = {
        scores: {},
        multiScores: { digest: 0 },
        section2Answers: {},
        section3Answers: {},
        section4Answers: {}
    };

    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.75 });
    }

    function showToast(msg) {
        const toast = document.getElementById('assessmentToast');
        if (!toast) return;
        toast.textContent = msg;
        toast.classList.remove('opacity-0', 'translate-y-4', 'pointer-events-none');
        toast.classList.add('opacity-100', 'translate-y-0');
        clearTimeout(toast._timer);
        toast._timer = setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-y-0');
            toast.classList.add('opacity-0', 'translate-y-4', 'pointer-events-none');
        }, 3800);
    }

    function updateProgress() {
        let answered = Object.keys(assessmentState.scores).length;
        const hasDigest = document.querySelectorAll('.hc-digest-card.is-selected').length > 0;
        if (hasDigest) answered += 1;

        answered += Object.keys(assessmentState.section4Answers).length;

        const pct = Math.min(100, Math.round((answered / TOTAL_QUESTIONS) * 100));
        const barEl = document.getElementById('hc-progress-bar');
        const txtEl = document.getElementById('hc-progress-text');
        if (barEl) barEl.style.width = pct + '%';
        if (txtEl) txtEl.textContent = answered + '/' + TOTAL_QUESTIONS + ' câu';
    }

    // 1. Chọn Giới tính (Phần 1)
    const genderBtns = document.querySelectorAll('.hc-gender-btn');
    const genderInput = document.getElementById('childGender');
    genderBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            genderBtns.forEach(b => {
                b.classList.remove('bg-[#fff7ed]', 'text-secondary', 'border-secondary', 'shadow-xs');
                b.classList.add('bg-[#f8fafc]', 'text-slate-700', 'border-slate-200');
            });
            btn.classList.remove('bg-[#f8fafc]', 'text-slate-700', 'border-slate-200');
            btn.classList.add('bg-[#fff7ed]', 'text-secondary', 'border-secondary', 'shadow-xs');
            if (genderInput) genderInput.value = btn.getAttribute('data-gender');
        });
    });

    // 2. Chọn đơn ở Phần 2 (Câu 1, 2, 4, 6)
    document.querySelectorAll('#sec-general .hc-choice-card').forEach(card => {
        card.addEventListener('click', () => {
            const qid = card.getAttribute('data-qid');
            const score = parseInt(card.getAttribute('data-score') || '0', 10);
            const label = card.getAttribute('data-label') || '';
            const block = card.closest('.question-block');
            if (block) {
                block.querySelectorAll('.hc-choice-card').forEach(c => c.classList.remove('is-selected'));
            }
            card.classList.add('is-selected');
            assessmentState.scores[qid] = score;
            assessmentState.section2Answers[qid] = label;
            updateProgress();
        });
    });

    // 3. Chọn nhiều Tình trạng tiêu hóa (Phần 2 - Câu 3)
    const digestCards = document.querySelectorAll('.hc-digest-card');
    function syncDigestScore() {
        let score = 0;
        const chosen = [];
        digestCards.forEach(c => {
            if (c.classList.contains('is-selected')) {
                score += parseInt(c.getAttribute('data-score') || '0', 10);
                chosen.push(c.getAttribute('data-digest'));
            }
        });
        assessmentState.multiScores.digest = score;
        assessmentState.section2Answers['q3_digest'] = chosen.join(', ');
        updateProgress();
    }
    digestCards.forEach(card => {
        card.addEventListener('click', () => {
            const isExcl = card.getAttribute('data-exclusive') === '1';
            if (isExcl) {
                const willSelect = !card.classList.contains('is-selected');
                digestCards.forEach(c => c.classList.remove('is-selected'));
                if (willSelect) card.classList.add('is-selected');
            } else {
                digestCards.forEach(c => {
                    if (c.getAttribute('data-exclusive') === '1') c.classList.remove('is-selected');
                });
                card.classList.toggle('is-selected');
            }
            syncDigestScore();
        });
    });
    syncDigestScore();

    // 4. Chọn nhiều Tiền sử dị ứng (Phần 2 - Câu 5)
    const allergyCards = document.querySelectorAll('.hc-allergy-card');
    allergyCards.forEach(card => {
        card.addEventListener('click', () => {
            const isExcl = card.getAttribute('data-exclusive') === '1';
            if (isExcl) {
                const willSelect = !card.classList.contains('is-selected');
                allergyCards.forEach(c => c.classList.remove('is-selected'));
                if (willSelect) card.classList.add('is-selected');
            } else {
                allergyCards.forEach(c => {
                    if (c.getAttribute('data-exclusive') === '1') c.classList.remove('is-selected');
                });
                card.classList.toggle('is-selected');
            }
        });
    });

    // 5. Chọn 14 câu hỏi Phần 3 (Có / Không rõ / Không)
    document.querySelectorAll('.hc-row-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const row = btn.closest('.question-row');
            const qid = btn.getAttribute('data-qid');
            const score = parseInt(btn.getAttribute('data-score') || '0', 10);
            const ans = btn.getAttribute('data-ans') || '';
            const qtitle = row ? row.getAttribute('data-qtitle') : qid;

            if (row) {
                row.querySelectorAll('.hc-row-btn').forEach(b => b.classList.remove('is-active'));
            }
            btn.classList.add('is-active');
            assessmentState.scores[qid] = score;
            assessmentState.section3Answers[qtitle] = ans;
            updateProgress();
        });
    });

    // 6. Phần 4: 3 Cụm Thẻ Tích Chọn Nhanh (Vi chất đang dùng + GFCF + Tiền sử thiếu máu/Vitamin D)
    const suppCheckCards = document.querySelectorAll('.hc-supp-check-card');
    const gfcfCards = document.querySelectorAll('.hc-gfcf-card');
    const medCheckCards = document.querySelectorAll('.hc-med-check-card');

    function syncSection4State() {
        const s4 = {};
        suppCheckCards.forEach(c => {
            const qtitle = c.getAttribute('data-qtitle');
            if (!qtitle) return;
            s4[qtitle] = c.classList.contains('is-selected') ? 'Có đang dùng' : 'Không dùng';
        });

        let gfcfVal = 'Chưa từng thử qua';
        gfcfCards.forEach(c => {
            if (c.classList.contains('is-selected')) {
                gfcfVal = c.getAttribute('data-gfcf') || 'Chưa từng thử qua';
            }
        });
        s4['3. Chế độ ăn kiêng không gluten, không casein (GFCF)'] = gfcfVal;

        medCheckCards.forEach(c => {
            const qtitle = c.getAttribute('data-qtitle');
            if (!qtitle) return;
            s4[qtitle] = c.classList.contains('is-selected') ? 'Có / Đã từng kiểm tra' : 'Chưa từng / Không có';
        });

        assessmentState.section4Answers = s4;
        updateProgress();
    }

    suppCheckCards.forEach(card => {
        card.addEventListener('click', () => {
            const isExcl = card.getAttribute('data-exclusive') === '1';
            if (isExcl) {
                const willSelect = !card.classList.contains('is-selected');
                suppCheckCards.forEach(c => c.classList.remove('is-selected'));
                if (willSelect) card.classList.add('is-selected');
            } else {
                suppCheckCards.forEach(c => {
                    if (c.getAttribute('data-exclusive') === '1') c.classList.remove('is-selected');
                });
                card.classList.toggle('is-selected');
            }
            syncSection4State();
        });
    });

    gfcfCards.forEach(card => {
        card.addEventListener('click', () => {
            gfcfCards.forEach(c => c.classList.remove('is-selected'));
            card.classList.add('is-selected');
            syncSection4State();
        });
    });

    medCheckCards.forEach(card => {
        card.addEventListener('click', () => {
            const isExcl = card.getAttribute('data-exclusive') === '1';
            if (isExcl) {
                const willSelect = !card.classList.contains('is-selected');
                medCheckCards.forEach(c => c.classList.remove('is-selected'));
                if (willSelect) card.classList.add('is-selected');
            } else {
                medCheckCards.forEach(c => {
                    if (c.getAttribute('data-exclusive') === '1') c.classList.remove('is-selected');
                });
                card.classList.toggle('is-selected');
            }
            syncSection4State();
        });
    });
    syncSection4State();

    // 7. Xử lý Submit -> Tính điểm & Hiển thị Kết quả Đánh giá + Lưu vào WP Admin
    const form = document.getElementById('hieucon-booking-step2-form');
    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const childName = document.getElementById('childName').value.trim();
            const childAge = document.getElementById('childAge').value.trim();
            const parentName = document.getElementById('parentName').value.trim() || '<?php echo esc_js( $display_parent_name ); ?>';
            const parentPhone = document.getElementById('parentPhone').value.trim();

            if (!childName || !childAge) {
                showToast('Ba mẹ vui lòng điền Họ tên bé và Độ tuổi của bé ở Phần 1 nhé!');
                document.getElementById('sec-info')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            syncSection4State();

            // Kiểm tra tối thiểu số câu đã trả lời ở Phần 2 & 3
            if (Object.keys(assessmentState.scores).length < 5) {
                showToast('Ba mẹ vui lòng trả lời các câu hỏi ở Phần 2 và Phần 3 để có kết quả đánh giá sát thực tế nhất nhé!');
                document.getElementById('detailedQuestionsContainer')?.scrollIntoView({ behavior: 'smooth', block: 'center' });
                return;
            }

            // Tính tổng điểm sàng lọc
            let totalScore = 0;
            Object.values(assessmentState.scores).forEach(s => { totalScore += Number(s || 0); });
            totalScore += Number(assessmentState.multiScores.digest || 0);

            let riskLevel = 'low';
            let riskTitle = 'Nguy cơ dinh dưỡng thấp / Cần điều chỉnh nhẹ';
            let feedbackHtml = '';

            const badgeEl = document.getElementById('resultBadge');
            const boxEl = document.getElementById('resultFeedbackBox');
            const cardEl = document.getElementById('resultCard');

            if (totalScore <= 5) {
                riskLevel = 'low';
                riskTitle = 'Nguy cơ dinh dưỡng thấp / Cần điều chỉnh nhẹ';
                badgeEl.className = 'inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl text-sm sm:text-base font-bold bg-emerald-50 text-emerald-800 border border-emerald-300';
                badgeEl.innerHTML = '<span class="w-3 h-3 rounded-full bg-emerald-500"></span> Mức Độ: Nguy Cơ Dinh Dưỡng Thấp / Cần Điều Chỉnh Nhẹ';
                boxEl.className = 'mt-6 p-5 sm:p-6 rounded-2xl bg-emerald-50/70 border border-emerald-200 text-emerald-950';
                feedbackHtml = `
                    <h3 class="font-bold text-base sm:text-lg mb-2 text-emerald-900">Nhận xét &amp; đánh giá tình trạng:</h3>
                    <p class="mb-3">Bé hiện có một số rào cản nhẹ trong nếp ăn uống hoặc sở thích vị giác. Tình trạng đường ruột và chuyển hóa của con nhìn chung vẫn trong ngưỡng kiểm soát được.</p>
                    <p class="font-bold mb-1.5 text-emerald-900">Định hướng cho ba mẹ:</p>
                    <ul class="list-disc pl-5 space-y-1.5 text-xs sm:text-sm">
                        <li>Điều chỉnh khẩu phần ăn gia đình theo hướng tăng dần các nhóm màu sắc và đa dạng rau củ.</li>
                        <li>Giảm thiểu tối đa việc cho bé ăn quà vặt, bánh kẹo ngọt và hạn chế thiết bị điện tử khi ngồi vào bàn ăn.</li>
                        <li>Khuyến khích con tham gia vận động thể lực ngoài trời để tăng trao đổi chất và kích thích cảm giác thèm ăn tự nhiên.</li>
                    </ul>
                `;
            } else if (totalScore <= 10) {
                riskLevel = 'medium';
                riskTitle = 'Nguy cơ dinh dưỡng trung bình';
                badgeEl.className = 'inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl text-sm sm:text-base font-bold bg-amber-50 text-amber-800 border border-amber-300';
                badgeEl.innerHTML = '<span class="w-3 h-3 rounded-full bg-amber-500"></span> Mức Độ: Nguy Cơ Dinh Dưỡng Trung Bình';
                boxEl.className = 'mt-6 p-5 sm:p-6 rounded-2xl bg-amber-50/70 border border-amber-200 text-amber-950';
                feedbackHtml = `
                    <h3 class="font-bold text-base sm:text-lg mb-2 text-amber-900">Nhận xét &amp; đánh giá tình trạng:</h3>
                    <p class="mb-3">Bé đang gặp phải những rào cản rõ rệt về cảm giác thức ăn hoặc đường tiêu hóa (như ngậm thức ăn, táo bón/nôn trớ, nhạy cảm mùi vị hoặc lười ăn rau quả kéo dài). Đây là dấu hiệu thường gặp cảnh báo nguy cơ mất cân bằng dinh dưỡng tích lũy.</p>
                    <p class="font-bold mb-1.5 text-amber-900">Định hướng cho ba mẹ:</p>
                    <ul class="list-disc pl-5 space-y-1.5 text-xs sm:text-sm">
                        <li>Cần có kế hoạch điều chỉnh chế độ ăn sớm để giải phóng áp lực bàn ăn cho cả mẹ và con.</li>
                        <li>Ưu tiên phục hồi hệ vi sinh đường ruột và tối ưu hóa việc hấp thu vi chất thiết yếu.</li>
                        <li>Trong buổi trao đổi 1:1, chuyên gia sẽ cùng ba mẹ định hướng thực đơn phân cấp màu sắc/kết cấu phù hợp với mức nhạy cảm của con.</li>
                    </ul>
                `;
            } else {
                riskLevel = 'high';
                riskTitle = 'Nguy cơ dinh dưỡng cao / Cần đồng hành sớm';
                badgeEl.className = 'inline-flex items-center gap-2.5 px-5 py-2.5 rounded-2xl text-sm sm:text-base font-bold bg-rose-50 text-rose-800 border border-rose-300';
                badgeEl.innerHTML = '<span class="w-3 h-3 rounded-full bg-rose-500"></span> Mức Độ: Nguy Cơ Dinh Dưỡng Cao / Cần Đồng Hành Sớm';
                boxEl.className = 'mt-6 p-5 sm:p-6 rounded-2xl bg-rose-50/70 border border-rose-200 text-rose-950';
                feedbackHtml = `
                    <h3 class="font-bold text-base sm:text-lg mb-2 text-rose-900">Nhận xét &amp; đánh giá tình trạng:</h3>
                    <p class="mb-3">Bé có nhiều biểu hiện rõ nét về khó khăn cảm giác ăn uống, tiêu hóa và thói quen sinh hoạt. Tình trạng ăn chọn lọc kết hợp với hệ tiêu hóa nhạy cảm kéo dài cần có sự đồng hành và điều chỉnh kịp thời.</p>
                    <p class="font-bold mb-1.5 text-rose-900">Định hướng hỗ trợ:</p>
                    <ul class="list-disc pl-5 space-y-1.5 text-xs sm:text-sm">
                        <li>Cần xây dựng chế độ dinh dưỡng cá nhân hóa sớm để chăm sóc niêm mạc ruột và hỗ trợ sức khỏe toàn diện của con.</li>
                        <li>Tránh ép ăn căng thẳng hay phụ thuộc vào màn hình điện tử vì dễ khiến con sợ bữa ăn.</li>
                        <li>Ba mẹ hãy nhắn qua Zalo bên dưới để chuyên gia xem chi tiết từng câu trả lời và trao đổi kỹ trong buổi 1:1.</li>
                    </ul>
                `;
            }

            document.getElementById('resChildName').textContent = childName;
            document.getElementById('resChildAge').textContent = childAge;
            document.getElementById('resParentName').textContent = parentName;
            document.getElementById('resSavedPhone').textContent = '<?php echo esc_js( $masked_phone ); ?>';
            boxEl.innerHTML = feedbackHtml;

            cardEl.classList.remove('hidden');
            if (typeof lucide !== 'undefined') {
                lucide.createIcons({ strokeWidth: 1.75 });
            }
            cardEl.scrollIntoView({ behavior: 'smooth', block: 'start' });

            // Gom dữ liệu gửi về máy chủ WordPress lưu vào hồ sơ đặt lịch 1:1
            const allergies = [];
            document.querySelectorAll('.hc-allergy-card.is-selected').forEach(c => {
                allergies.push(c.getAttribute('data-allergy'));
            });

            const digestList = [];
            document.querySelectorAll('.hc-digest-card.is-selected').forEach(c => {
                digestList.push(c.getAttribute('data-digest'));
            });

            const bioSymptomsSummary = [];
            if (assessmentState.section2Answers['q1_eating']) bioSymptomsSummary.push('Ăn uống: ' + assessmentState.section2Answers['q1_eating']);
            if (assessmentState.section2Answers['q2_chewing']) bioSymptomsSummary.push('Nhai nuốt: ' + assessmentState.section2Answers['q2_chewing']);
            if (digestList.length) bioSymptomsSummary.push('Tiêu hóa: ' + digestList.join(', '));
            if (assessmentState.section2Answers['q4_sleep']) bioSymptomsSummary.push('Giấc ngủ: ' + assessmentState.section2Answers['q4_sleep']);
            if (assessmentState.section2Answers['q6_screen']) bioSymptomsSummary.push('Thiết bị khi ăn: ' + assessmentState.section2Answers['q6_screen']);

            const behavSymptomsSummary = [];
            Object.entries(assessmentState.section3Answers).forEach(([q, a]) => {
                if (a === 'Có' || a === 'Không') {
                    behavSymptomsSummary.push(q + ': ' + a);
                }
            });

            const triedMethodsSummary = [];
            Object.entries(assessmentState.section4Answers).forEach(([q, a]) => {
                triedMethodsSummary.push(q + ': ' + a);
            });

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking_survey');
            formData.append('nonce', nonceVal);
            formData.append('booking_id', document.getElementById('survey-booking-id').value);
            formData.append('booking_code', document.getElementById('survey-booking-code').value);
            formData.append('preferred_time', document.getElementById('survey-preferred-time').value);
            formData.append('parent_name', parentName);
            formData.append('phone', parentPhone);
            formData.append('child_name', childName);
            formData.append('child_age', childAge);
            formData.append('child_gender', document.getElementById('childGender').value);
            formData.append('child_weight', document.getElementById('childWeight').value.trim());
            formData.append('child_height', document.getElementById('childHeight').value.trim());
            formData.append('water_amount', document.getElementById('waterAmount').value.trim());
            formData.append('other_difficulties', document.getElementById('otherFeedingDifficulties').value.trim());
            formData.append('daily_diet', document.getElementById('dailyDietDesc').value.trim());
            formData.append('parent_goal', document.getElementById('survey-parent-goal').value.trim());
            formData.append('diagnosis', riskTitle + ' (' + totalScore + ' điểm)');
            formData.append('risk_level', riskLevel);
            formData.append('risk_title', riskTitle);
            formData.append('total_score', String(totalScore));
            formData.append('allergies_json', JSON.stringify(allergies));
            formData.append('section2_json', JSON.stringify(assessmentState.section2Answers));
            formData.append('section3_json', JSON.stringify(assessmentState.section3Answers));
            formData.append('section4_json', JSON.stringify(assessmentState.section4Answers));

            bioSymptomsSummary.forEach(item => formData.append('bio_symptoms[]', item));
            behavSymptomsSummary.forEach(item => formData.append('behav_symptoms[]', item));
            triedMethodsSummary.forEach(item => formData.append('tried_methods[]', item));

            fetch(ajaxUrl, {
                method: 'POST',
                body: formData,
                keepalive: true
            }).catch(() => {});
        });
    }
});
</script>

<?php wp_footer(); ?>
</body>
</html>
