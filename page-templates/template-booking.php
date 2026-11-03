<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 phút để nhìn rõ vấn đề của con" — Bố cục 1 màn hình cân đối 50/50, đăng ký xong chuyển thẳng qua Zalo.
 *
 * @package Hieucon
 */

if ( isset( $_GET['step'] ) && 'survey' === sanitize_key( wp_unslash( $_GET['step'] ) ) ) {
    wp_safe_redirect( home_url( '/dat-lich-tu-van/' ) );
    exit;
}

get_header();

$current_member  = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_name    = $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '';
$prefill_phone   = $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '';
$booking_nonce   = wp_create_nonce( 'hieucon_booking_nonce' );
$zalo_target_url = get_option( 'hieucon_link_zalo_tuvan', home_url( '/zalo' ) );
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

    /* Multi-select Issue Chips ("Trẻ đang gặp vấn đề gì?") */
    .hc-issue-chip {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 12px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        color: #0A1931;
        font-size: 14px;
        font-weight: 600;
        text-align: left;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
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
        padding: 11px 8px;
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        text-align: center;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
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
         SECTION DUY NHẤT: CÂN ĐỐI TÂM THỊ GIÁC & ĐỒNG ĐỀU CHIỀU CAO 2 CỘT
         ========================================================= -->
    <section id="dang-ky-case" class="min-h-[calc(100vh-86px)] flex items-center pt-4 pb-14 md:pt-6 md:pb-20 lg:pt-6 lg:pb-24 bg-white">
        <div class="max-w-[1280px] w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 lg:gap-12 xl:gap-14 items-center">

                <!-- Cột trái (6/12): Thông điệp mở đầu -->
                <div class="lg:col-span-6">
                    <h1 class="font-serif text-3xl sm:text-4xl xl:text-[2.9rem] font-bold text-navy leading-[1.18] mb-4">
                        30 phút để nhìn rõ<br class="hidden sm:inline" />
                        <span class="text-secondary">vấn đề của con</span>
                    </h1>

                    <p class="text-slate-700 text-base sm:text-[17px] leading-relaxed mb-5">
                        <strong class="text-navy">Hiểu Con Từ Gốc</strong> dành tặng <strong class="text-secondary">30 lịch tư vấn dinh dưỡng 1:1</strong> tặng các con có vấn đề về <strong class="text-navy">kén ăn, dị ứng, bất dung nạp thực phẩm, táo bón, rối loạn tiêu hóa, chậm tăng trưởng,...</strong>
                    </p>

                    <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-5 sm:p-6">
                        <p class="font-bold text-navy text-base sm:text-[17px] mb-3.5">
                            Buổi tư vấn có thời gian 30 phút để ba mẹ hiểu và tìm ra các vấn đề:
                        </p>
                        <ul class="space-y-2.5 text-slate-800 text-sm sm:text-[15px] leading-relaxed">
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">1</span>
                                <span>Nguyên nhân gốc rễ khiến con gặp các vấn đề về tiêu hóa: kén ăn, dị ứng, bất dung nạp thực phẩm, táo bón, rối loạn tiêu hóa, chậm tăng trưởng,...</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">2</span>
                                <span>Các vấn đề hệ tiêu hóa ảnh hưởng như thế nào đến sức khỏe não bộ, hành vi của con?</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">3</span>
                                <span>Giải pháp từng bước để cải thiện các vấn đề tiêu hóa của trẻ</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="w-6 h-6 rounded-full bg-secondary text-white flex items-center justify-center shrink-0 mt-0.5 text-xs font-bold">4</span>
                                <span>Dinh dưỡng giúp nuôi dưỡng sức khỏe tiêu hóa và não bộ - nền tảng giúp con cải thiện các vấn đề hành vi, đạt hiệu quả can thiệp</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Cột phải (6/12): Form đăng ký cân xứng chiều cao với cột trái -->
                <div class="lg:col-span-6">
                    <div id="booking-card-wrapper" class="hc-master-card relative">
                        <div class="hc-card-bar"></div>

                        <div id="booking-step1-container" class="p-6 sm:p-8">
                            <div class="mb-5">
                                <h2 class="font-serif text-2xl sm:text-[1.65rem] font-bold text-navy leading-snug">
                                    Thông tin liên hệ của ba mẹ
                                </h2>
                                <p class="text-slate-500 text-sm mt-1 leading-relaxed">
                                    Ba mẹ điền thông tin và chọn vấn đề của con để kết nối qua Zalo.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-4" novalidate>
                                <input type="hidden" name="nonce" id="booking-nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

                                <!-- 1. Họ và tên + SĐT/Zalo -->
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3.5">
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
                                            placeholder="VD: Mẹ Nguyễn Thu Hà"
                                            class="w-full px-3.5 py-2.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-sm transition-all"
                                        >
                                    </div>

                                    <div>
                                        <label for="booking-phone" class="block text-sm font-bold text-navy mb-1.5">
                                            Số điện thoại / Zalo <span class="text-secondary">*</span>
                                        </label>
                                        <input
                                            type="tel"
                                            id="booking-phone"
                                            name="phone"
                                            value="<?php echo esc_attr( $prefill_phone ); ?>"
                                            required
                                            placeholder="Nhập SĐT có dùng Zalo..."
                                            class="w-full px-3.5 py-2.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-sm transition-all"
                                        >
                                    </div>
                                </div>

                                <!-- 2. Trẻ đang gặp vấn đề gì? (Chọn 1 hoặc nhiều) -->
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-1.5">
                                        <label class="block text-sm font-bold text-navy">
                                            Trẻ đang gặp vấn đề gì? <span class="text-secondary">*</span>
                                        </label>
                                        <span class="text-[11px] font-semibold text-slate-400">Chọn 1 hoặc nhiều</span>
                                    </div>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-2" id="child-issues-group">
                                        <?php
                                        $issue_options = [
                                            [ 'label' => 'Kén Ăn', 'span' => '' ],
                                            [ 'label' => 'Táo bón', 'span' => '' ],
                                            [ 'label' => 'Bất dung nạp', 'span' => '' ],
                                            [ 'label' => 'Suy dinh dưỡng', 'span' => '' ],
                                            [ 'label' => 'Thiếu hụt vi chất và dinh dưỡng', 'span' => 'sm:col-span-2' ],
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

                                <!-- 3. Khung giờ thuận tiện trao đổi (4 ô cân đối trên 1 hàng) -->
                                <div>
                                    <label class="block text-sm font-bold text-navy mb-1.5">
                                        Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                    </label>

                                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-2" id="time-slot-group">
                                        <button type="button" data-slot="Buổi sáng (08:30 - 11:30)" class="hc-time-card is-active">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="sunrise" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi sáng</span>
                                            </span>
                                            <span class="hc-time-sub">08:30 – 11:30</span>
                                        </button>

                                        <button type="button" data-slot="Buổi trưa (12:00 - 13:30)" class="hc-time-card">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="sun" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi trưa</span>
                                            </span>
                                            <span class="hc-time-sub">12:00 – 13:30</span>
                                        </button>

                                        <button type="button" data-slot="Buổi chiều (14:00 - 17:30)" class="hc-time-card">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="sunset" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi chiều</span>
                                            </span>
                                            <span class="hc-time-sub">14:00 – 17:30</span>
                                        </button>

                                        <button type="button" data-slot="Buổi tối (19:30 - 21:30)" class="hc-time-card">
                                            <span class="hc-time-head">
                                                <span class="hc-time-icon"><i data-lucide="moon" class="w-3.5 h-3.5"></i></span>
                                                <span>Buổi tối</span>
                                            </span>
                                            <span class="hc-time-sub">19:30 – 21:30</span>
                                        </button>
                                    </div>

                                    <input type="hidden" id="booking-preferred-time" name="preferred_time" value="Buổi sáng (08:30 - 11:30)">
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
            const preferredTime = timeInput.value.trim() || 'Buổi sáng (08:30 - 11:30)';

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
