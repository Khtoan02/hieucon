<?php
/**
 * Template Name: Đặt Lịch Tư Vấn 1:1
 * Description: Trang Landing Page đặt lịch tư vấn miễn phí 1:1 chuẩn giao diện Hiểu Con Từ Gốc.
 *
 * @package Hieucon
 */

get_header();

$current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false;
$prefill_name   = $current_member && ! empty( $current_member->full_name ) ? $current_member->full_name : '';
$prefill_phone  = $current_member && ! empty( $current_member->phone_number ) ? $current_member->phone_number : '';
$booking_nonce  = wp_create_nonce( 'hieucon_booking_nonce' );
?>

<style>
    .glass-card-booking {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.92) 0%, rgba(255, 255, 255, 0.78) 100%);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border: 1px solid rgba(255, 255, 255, 0.9);
    }
    .time-slot-pill.is-active {
        background-color: #0A1931 !important;
        color: #ffffff !important;
        border-color: #0A1931 !important;
        box-shadow: 0 6px 18px -4px rgba(10, 25, 49, 0.25);
    }
    .issue-tag-chip.is-selected {
        background-color: rgba(249, 115, 22, 0.14) !important;
        color: #ea580c !important;
        border-color: #f97316 !important;
    }
</style>

<main id="primary" class="site-main min-h-screen pb-24 pt-8 md:pt-12 relative overflow-hidden">
    <!-- Decorative background blobs -->
    <div class="pointer-events-none absolute -top-24 -right-24 w-96 h-96 rounded-full bg-secondary/10 blur-3xl"></div>
    <div class="pointer-events-none absolute top-1/3 -left-24 w-80 h-80 rounded-full bg-primary/10 blur-3xl"></div>

    <div class="max-w-[1320px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <!-- HERO + FORM 2 CỘT -->
        <section class="grid grid-cols-1 lg:grid-cols-12 gap-10 xl:gap-14 items-start pt-4 md:pt-8">

            <!-- CỘT TRÁI: THÔNG ĐIỆP & GIÁ TRỊ BUỔI TƯ VẤN (7/12) -->
            <div class="lg:col-span-7 flex flex-col justify-center lg:pr-4">
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

            <!-- CỘT PHẢI: FORM ĐẶT LỊCH TỐI GIẢN (5/12) -->
            <div class="lg:col-span-5 w-full lg:sticky lg:top-28">
                <div class="glass-card-booking rounded-[2rem] p-6 sm:p-8 xl:p-9 shadow-premium relative overflow-hidden">
                    <!-- Top accent bar -->
                    <div class="absolute top-0 left-0 right-0 h-1.5 bg-gradient-to-r from-navy via-secondary to-primary"></div>

                    <!-- TRẠNG THÁI 1: FORM ĐĂNG KÝ -->
                    <div id="booking-form-container">
                        <div class="mb-6">
                            <span class="text-[11px] font-extrabold uppercase tracking-widest text-secondary block mb-1">Điền nhanh trong 30 giây</span>
                            <h2 class="font-serif text-2xl sm:text-3xl font-bold text-navy">Thông Tin Đặt Lịch Hẹn</h2>
                            <p class="text-navy/60 text-xs sm:text-sm font-medium mt-1">
                                Chuyên gia sẽ liên hệ qua Zalo / Số điện thoại theo đúng khung giờ ba mẹ chọn.
                            </p>
                        </div>

                        <form id="hieucon-booking-form" class="space-y-5" novalidate>
                            <input type="hidden" name="nonce" value="<?php echo esc_attr( $booking_nonce ); ?>">

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
                                    <button type="button" data-slot="Sáng (08:30 - 11:30)" class="time-slot-pill is-active text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2">
                                        <i data-lucide="sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Sáng (8h30 – 11h30)</span>
                                    </button>
                                    <button type="button" data-slot="Trưa (12:00 - 13:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2">
                                        <i data-lucide="coffee" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Trưa (12h00 – 13h30)</span>
                                    </button>
                                    <button type="button" data-slot="Chiều (14:00 - 17:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2">
                                        <i data-lucide="cloud-sun" class="w-3.5 h-3.5 text-secondary shrink-0"></i>
                                        <span>Chiều (14h00 – 17h30)</span>
                                    </button>
                                    <button type="button" data-slot="Tối (19:30 - 21:30)" class="time-slot-pill text-left px-3.5 py-2.5 rounded-xl border border-navy/15 bg-white text-navy text-xs font-bold transition-all flex items-center gap-2">
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

                            <!-- 4. Vấn đề cần tư vấn -->
                            <div>
                                <label for="booking-issue" class="block text-xs font-extrabold uppercase tracking-wider text-navy mb-2">
                                    4. Vấn đề của con ba/mẹ đang trăn trở nhất
                                </label>
                                <!-- Quick Select Chips -->
                                <div class="flex flex-wrap gap-1.5 mb-2.5" id="issue-chips-group">
                                    <?php
                                    $quick_issues = [
                                        'Táo bón / Rối loạn tiêu hóa',
                                        'Kén ăn / Nhai nuốt kém',
                                        'Khó ngủ / Ngủ không sâu',
                                        'Chậm nói / Vận động miệng yếu',
                                        'Tăng động / Giảm chú ý',
                                        'La hét / Bùng nổ cảm xúc',
                                        'Tư vấn lộ trình Y sinh từ gốc',
                                    ];
                                    foreach ( $quick_issues as $qi ) :
                                    ?>
                                    <button type="button" data-issue="<?php echo esc_attr( $qi ); ?>" class="issue-tag-chip px-2.5 py-1 rounded-lg border border-navy/10 bg-white/80 hover:border-secondary/50 text-navy/80 text-[11px] font-bold transition-all">
                                        + <?php echo esc_html( $qi ); ?>
                                    </button>
                                    <?php endforeach; ?>
                                </div>
                                <textarea
                                    id="booking-issue"
                                    name="issue_note"
                                    rows="3"
                                    placeholder="Chia sẻ ngắn gọn độ tuổi và biểu hiện hiện tại của bé để chuyên gia chuẩn bị trước..."
                                    class="w-full px-4 py-3 rounded-xl bg-white border border-navy/15 focus:border-secondary focus:ring-2 focus:ring-secondary/20 outline-none text-navy font-medium text-sm transition-all resize-none"
                                ></textarea>
                            </div>

                            <!-- Thông báo lỗi nếu có -->
                            <div id="booking-error-msg" class="hidden rounded-xl bg-red-50 border border-red-200 text-red-700 text-xs font-bold px-4 py-3"></div>

                            <!-- Nút Gửi -->
                            <button
                                type="submit"
                                id="booking-submit-btn"
                                class="w-full py-4 px-6 rounded-xl bg-gradient-to-r from-secondary to-secondary_dark hover:from-secondary_dark hover:to-secondary text-white font-extrabold text-sm sm:text-base uppercase tracking-wider shadow-[0_10px_25px_-5px_rgba(249,115,22,0.45)] hover:shadow-[0_14px_30px_-5px_rgba(249,115,22,0.6)] hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center gap-2.5 cursor-pointer"
                            >
                                <i data-lucide="calendar-check" class="w-5 h-5"></i>
                                <span>Xác Nhận Đặt Lịch Tư Vấn 1:1</span>
                            </button>

                            <p class="text-center text-[11px] text-navy/50 font-semibold">
                                Cần hỗ trợ gấp ngay bây giờ?
                                <a href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="text-[#0068FF] font-extrabold underline hover:text-navy">Nhắn trực tiếp qua Zalo Tư Vấn ↗</a>
                            </p>
                        </form>
                    </div>

                    <!-- TRẠNG THÁI 2: MÀN HÌNH XÁC NHẬN THÀNH CÔNG -->
                    <div id="booking-success-container" class="hidden text-center py-4">
                        <div class="w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center mx-auto mb-4 shadow-sm">
                            <i data-lucide="check-circle-2" class="w-9 h-9"></i>
                        </div>
                        <span class="inline-block bg-emerald-50 text-emerald-700 border border-emerald-200 font-extrabold text-[11px] uppercase tracking-widest px-3 py-1 rounded-full mb-2">
                            Mã lịch hẹn: <span id="res-booking-code">TV-0000</span>
                        </span>
                        <h3 class="font-serif text-2xl sm:text-3xl font-bold text-navy mb-2">Đã Nhận Lịch Hẹn Của Ba Mẹ!</h3>
                        <p class="text-navy/70 text-sm font-medium leading-relaxed mb-6">
                            Cảm ơn <strong id="res-parent-name" class="text-navy">ba/mẹ</strong>. Đội ngũ chuyên môn <strong>Hiểu Con Từ Gốc</strong> sẽ liên hệ qua số <strong id="res-phone" class="text-secondary"></strong> vào khung giờ <strong id="res-time" class="text-navy"></strong>.
                        </p>

                        <div class="bg-[#f8fafc] border border-navy/10 rounded-2xl p-4 text-left mb-6">
                            <p class="text-xs font-extrabold text-navy uppercase tracking-wider mb-1.5 flex items-center gap-1.5">
                                <i data-lucide="sparkles" class="w-4 h-4 text-secondary"></i> Lời khuyên trong lúc chờ cuộc gọi:
                            </p>
                            <p class="text-xs text-navy/75 leading-relaxed">
                                Ba mẹ có thể bấm nút bên dưới để nhắn xác nhận qua <strong>Zalo Tư Vấn</strong> hoặc làm trước <strong>Bảng Checklist Sức Khỏe</strong> để buổi tư vấn 1:1 đạt hiệu quả cao nhất.
                            </p>
                        </div>

                        <div class="space-y-3">
                            <a id="res-zalo-link" href="<?php echo esc_url( home_url( '/zalo' ) ); ?>" target="_blank" rel="noopener noreferrer" class="w-full py-3.5 px-5 rounded-xl bg-gradient-to-r from-[#0068FF] to-[#0052CC] hover:opacity-95 text-white font-extrabold text-sm uppercase tracking-wider shadow-md flex items-center justify-center gap-2 transition-all">
                                <span class="font-black text-base leading-none">Z</span>
                                <span>Kết Nối Zalo Tư Vấn Ngay</span>
                            </a>
                            <a href="<?php echo esc_url( home_url( '/bo-cong-cu-suc-khoe/' ) ); ?>" class="w-full py-3 px-5 rounded-xl bg-navy hover:bg-navy/85 text-white font-bold text-xs uppercase tracking-wider flex items-center justify-center gap-2 transition-all">
                                <i data-lucide="clipboard-check" class="w-4 h-4 text-secondary"></i>
                                <span>Làm Bài Đánh Giá Sức Khỏe Cho Con</span>
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
                    <h3 class="font-serif font-bold text-xl text-navy mb-2">Đăng ký khung giờ phù hợp</h3>
                    <p class="text-navy/70 text-sm font-medium leading-relaxed">
                        Ba mẹ để lại SĐT/Zalo và khung giờ rảnh. Hệ thống ghi nhận ngay lập tức để sắp xếp tư vấn viên chuyên trách.
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

    // 2. Chọn nhanh Chip vấn đề cần tư vấn
    const issueChips = document.querySelectorAll('.issue-tag-chip');
    const issueTextarea = document.getElementById('booking-issue');

    issueChips.forEach(chip => {
        chip.addEventListener('click', () => {
            const text = chip.getAttribute('data-issue');
            chip.classList.toggle('is-selected');
            const currentVal = issueTextarea.value.trim();

            if (chip.classList.contains('is-selected')) {
                issueTextarea.value = currentVal ? currentVal + '; ' + text : text;
            } else {
                const parts = currentVal.split('; ').filter(item => item.trim() !== text);
                issueTextarea.value = parts.join('; ');
            }
        });
    });

    // 3. Submit Form qua AJAX
    const form = document.getElementById('hieucon-booking-form');
    const submitBtn = document.getElementById('booking-submit-btn');
    const errorBox = document.getElementById('booking-error-msg');
    const formContainer = document.getElementById('booking-form-container');
    const successContainer = document.getElementById('booking-success-container');

    if (form) {
        form.addEventListener('submit', function (e) {
            e.preventDefault();
            errorBox.classList.add('hidden');

            const parentName = document.getElementById('booking-parent-name').value.trim();
            const phone = document.getElementById('booking-phone').value.trim();
            const preferredTime = timeInput.value.trim() || 'Sớm nhất có thể';
            const issueNote = issueTextarea.value.trim();

            if (!parentName || !phone) {
                errorBox.textContent = 'Vui lòng nhập đầy đủ Họ tên và Số điện thoại/Zalo của ba/mẹ.';
                errorBox.classList.remove('hidden');
                return;
            }

            submitBtn.disabled = true;
            const originalBtnHtml = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span>Đang xử lý đặt lịch...</span>';

            const formData = new FormData();
            formData.append('action', 'hieucon_submit_booking');
            formData.append('nonce', form.querySelector('input[name="nonce"]').value);
            formData.append('parent_name', parentName);
            formData.append('phone', phone);
            formData.append('preferred_time', preferredTime);
            formData.append('issue_note', issueNote);

            fetch('<?php echo esc_url( admin_url( 'admin-ajax.php' ) ); ?>', {
                method: 'POST',
                body: formData
            })
            .then(res => res.json())
            .then(res => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;

                if (res.success && res.data) {
                    document.getElementById('res-booking-code').textContent = res.data.booking_code;
                    document.getElementById('res-parent-name').textContent = res.data.parent_name;
                    document.getElementById('res-phone').textContent = res.data.phone;
                    document.getElementById('res-time').textContent = res.data.preferred_time;
                    if (res.data.zalo_url) {
                        document.getElementById('res-zalo-link').href = res.data.zalo_url;
                    }
                    formContainer.classList.add('hidden');
                    successContainer.classList.remove('hidden');
                    if (typeof lucide !== 'undefined') {
                        lucide.createIcons({ strokeWidth: 1.5 });
                    }
                } else {
                    errorBox.textContent = (res.data && res.data.message) ? res.data.message : 'Có lỗi xảy ra, vui lòng thử lại.';
                    errorBox.classList.remove('hidden');
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = originalBtnHtml;
                errorBox.textContent = 'Không thể kết nối máy chủ. Vui lòng thử lại hoặc kết nối qua Zalo.';
                errorBox.classList.remove('hidden');
            });
        });
    }
});
</script>

<?php get_footer(); ?>
