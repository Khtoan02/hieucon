<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page "30 phút để nhìn rõ vấn đề của con" — Bố cục 1 màn hình duy nhất, đăng ký xong chuyển thẳng qua Zalo.
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
        padding: 11px 14px;
        border-radius: 14px;
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
        width: 20px;
        height: 20px;
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
        box-shadow: 0 8px 20px -10px rgba(249, 115, 22, 0.35);
    }
    .hc-issue-chip.is-selected .hc-chip-box {
        background: #f97316 !important;
        border-color: #f97316 !important;
        color: #ffffff !important;
    }

    /* Visual Time Slot Cards */
    .hc-time-card {
        position: relative;
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 11px 13px;
        border-radius: 14px;
        border: 1.5px solid #e2e8f0;
        background: #f8fafc;
        text-align: left;
        transition: all 0.18s ease;
        cursor: pointer;
        user-select: none;
    }
    .hc-time-card:hover {
        border-color: #94a3b8;
        background: #ffffff;
    }
    .hc-time-card .hc-time-icon {
        width: 36px;
        height: 36px;
        border-radius: 10px;
        background: #ffffff;
        border: 1px solid #e2e8f0;
        color: #64748b;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.18s ease;
    }
    .hc-time-card .hc-time-title {
        display: block;
        font-size: 13.5px;
        font-weight: 700;
        color: #0A1931;
        line-height: 1.25;
    }
    .hc-time-card .hc-time-sub {
        display: block;
        font-size: 12px;
        font-weight: 600;
        color: #64748b;
        margin-top: 2px;
    }
    .hc-time-card .hc-time-dot {
        margin-left: auto;
        width: 18px;
        height: 18px;
        border-radius: 999px;
        border: 1.5px solid #cbd5e1;
        background: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        transition: all 0.18s ease;
    }
    .hc-time-card .hc-time-dot::after {
        content: '';
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: transparent;
        transition: all 0.18s ease;
    }
    .hc-time-card.is-active {
        background: #0A1931 !important;
        border-color: #0A1931 !important;
        box-shadow: 0 10px 22px -8px rgba(10, 25, 49, 0.32);
    }
    .hc-time-card.is-active .hc-time-icon {
        background: rgba(249, 115, 22, 0.18);
        border-color: rgba(249, 115, 22, 0.45);
        color: #f97316;
    }
    .hc-time-card.is-active .hc-time-title {
        color: #ffffff;
    }
    .hc-time-card.is-active .hc-time-sub {
        color: #cbd5e1;
    }
    .hc-time-card.is-active .hc-time-dot {
        border-color: #f97316;
        background: #f97316;
    }
    .hc-time-card.is-active .hc-time-dot::after {
        background: #ffffff;
    }
</style>

<main id="primary" class="site-main hc-booking-page">

    <!-- =========================================================
         SECTION DUY NHẤT (100VH): THÔNG ĐIỆP MỞ ĐẦU (TRÁI) & FORM ĐĂNG KÝ (PHẢI)
         ========================================================= -->
    <section id="dang-ky-case" class="min-h-screen flex items-center py-20 md:py-28 lg:py-36 bg-white">
        <div class="max-w-[1240px] w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-14 xl:gap-16 items-center">

                <!-- Cột trái (7/12): Thông điệp mở đầu -->
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

                <!-- Cột phải (5/12): Form đăng ký 1 bước nhảy thẳng qua Zalo -->
                <div class="lg:col-span-5">
                    <div id="booking-card-wrapper" class="hc-master-card relative">
                        <div class="hc-card-bar"></div>

                        <div id="booking-step1-container" class="p-6 sm:p-8 lg:p-9">
                            <div class="mb-6">
                                <h2 class="font-serif text-2xl sm:text-[1.7rem] font-bold text-navy leading-snug">
                                    Thông tin liên hệ của ba mẹ
                                </h2>
                                <p class="text-slate-500 text-sm mt-1.5 leading-relaxed">
                                    Ba mẹ điền thông tin và chọn vấn đề của con để kết nối qua Zalo.
                                </p>
                            </div>

                            <form id="hieucon-booking-step1-form" class="space-y-5" novalidate>
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
                                            placeholder="VD: Mẹ Thu Hà"
                                            class="w-full px-3.5 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-sm transition-all"
                                        >
                                    </div>

                                    <div>
                                        <label for="booking-phone" class="block text-sm font-bold text-navy mb-1.5">
                                            SĐT / Zalo liên hệ <span class="text-secondary">*</span>
                                        </label>
                                        <input
                                            type="tel"
                                            id="booking-phone"
                                            name="phone"
                                            value="<?php echo esc_attr( $prefill_phone ); ?>"
                                            required
                                            placeholder="Số điện thoại Zalo..."
                                            class="w-full px-3.5 py-3 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-sm transition-all"
                                        >
                                    </div>
                                </div>

                                <!-- 2. Trẻ đang gặp vấn đề gì? (Chọn 1 hoặc nhiều) -->
                                <div>
                                    <div class="flex items-center justify-between gap-2 mb-2">
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

                                <!-- 3. Khung giờ thuận tiện trao đổi (Visual Time Cards) -->
                                <div>
                                    <label class="block text-sm font-bold text-navy mb-2">
                                        Khung giờ thuận tiện trao đổi <span class="text-secondary">*</span>
                                    </label>

                                    <div class="grid grid-cols-2 gap-2.5 mb-2.5" id="time-slot-group">
                                        <button type="button" data-slot="Buổi sáng (08:30 - 11:30)" class="hc-time-card is-active">
                                            <span class="hc-time-icon">
                                                <i data-lucide="sunrise" class="w-4 h-4"></i>
                                            </span>
                                            <span>
                                                <span class="hc-time-title">Buổi sáng</span>
                                                <span class="hc-time-sub">08:30 – 11:30</span>
                                            </span>
                                            <span class="hc-time-dot"></span>
                                        </button>

                                        <button type="button" data-slot="Buổi trưa (12:00 - 13:30)" class="hc-time-card">
                                            <span class="hc-time-icon">
                                                <i data-lucide="sun" class="w-4 h-4"></i>
                                            </span>
                                            <span>
                                                <span class="hc-time-title">Buổi trưa</span>
                                                <span class="hc-time-sub">12:00 – 13:30</span>
                                            </span>
                                            <span class="hc-time-dot"></span>
                                        </button>

                                        <button type="button" data-slot="Buổi chiều (14:00 - 17:30)" class="hc-time-card">
                                            <span class="hc-time-icon">
                                                <i data-lucide="sunset" class="w-4 h-4"></i>
                                            </span>
                                            <span>
                                                <span class="hc-time-title">Buổi chiều</span>
                                                <span class="hc-time-sub">14:00 – 17:30</span>
                                            </span>
                                            <span class="hc-time-dot"></span>
                                        </button>

                                        <button type="button" data-slot="Buổi tối (19:30 - 21:30)" class="hc-time-card">
                                            <span class="hc-time-icon">
                                                <i data-lucide="moon" class="w-4 h-4"></i>
                                            </span>
                                            <span>
                                                <span class="hc-time-title">Buổi tối</span>
                                                <span class="hc-time-sub">19:30 – 21:30</span>
                                            </span>
                                            <span class="hc-time-dot"></span>
                                        </button>
                                    </div>

                                    <input type="hidden" id="booking-preferred-time" name="preferred_time" value="Buổi sáng (08:30 - 11:30)">

                                    <div class="relative">
                                        <span class="absolute left-3.5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <i data-lucide="calendar-clock" class="w-4 h-4"></i>
                                        </span>
                                        <input
                                            type="text"
                                            id="booking-custom-time-note"
                                            placeholder="Ghi chú thêm giờ hoặc ngày cụ thể nếu cần..."
                                            class="w-full pl-9 pr-3.5 py-2.5 rounded-xl bg-[#f8fafc] border border-slate-200 focus:bg-white focus:border-secondary outline-none text-navy font-medium text-xs sm:text-sm transition-all"
                                        >
                                    </div>
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

    // 2. Chọn khung giờ thuận tiện (Visual Time Cards)
    const timeCards = document.querySelectorAll('.hc-time-card');
    const timeInput = document.getElementById('booking-preferred-time');
    const customTimeNote = document.getElementById('booking-custom-time-note');

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
            const selectedSlot = timeInput.value.trim() || 'Buổi sáng (08:30 - 11:30)';
            const extraTimeNote = customTimeNote ? customTimeNote.value.trim() : '';
            const preferredTime = extraTimeNote ? (selectedSlot + ' • ' + extraTimeNote) : selectedSlot;

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

            // Đổi trạng thái nút và gửi ngầm bằng sendBeacon / fetch keepalive để chuyển thẳng qua Zalo không bị trễ
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
