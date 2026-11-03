<?php
/**
 * Template Name: Trang chủ
 * Description: Trang chủ Hiểu Con Từ Gốc — Giao diện sáng thoáng (Nền trắng #ffffff & Xám nhẹ #f8fafc, điểm nhấn Cam #f97316 đồng bộ trang Đăng ký 1:1), câu từ chuẩn hóa tích cực.
 *
 * @package Hieucon
 */

get_header();
?>

<style>
    #primary.hc-home-page {
        background: #ffffff !important;
        color: #0A1931;
        padding-top: 64px !important;
    }
    @media (min-width: 1024px) {
        #primary.hc-home-page {
            padding-top: 76px !important;
        }
    }

    /* Card chuẩn theo phong cách trang Đăng ký 1:1: nền trắng, viền xám mảnh, thanh cam điểm nhấn */
    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 20px 48px -24px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }
    .hc-card-bar {
        height: 4px;
        background: #f97316;
    }
    .hc-feature-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 12px 32px -20px rgba(15, 23, 42, 0.06);
        transition: transform 0.22s ease, border-color 0.22s ease, box-shadow 0.22s ease;
    }
    .hc-feature-card:hover {
        border-color: #fdba74;
        transform: translateY(-3px);
        box-shadow: 0 20px 40px -20px rgba(249, 115, 22, 0.12);
    }

    /* Typography chống dính dấu tiếng Việt */
    .hc-hero-title {
        line-height: 1.26 !important;
    }
    .hc-sec-title {
        line-height: 1.28 !important;
    }
    .hc-body-text {
        line-height: 1.76 !important;
    }
</style>

<main id="primary" class="site-main hc-home-page font-sans text-[#0A1931] antialiased selection:bg-[#f97316] selection:text-white">

    <!-- ==============================================================
         1. ẢNH BÌA TOÀN MÀN HÌNH (GIỮ NGUYÊN BỐ CỤC BANNER GỐC)
         ============================================================== -->
    <section class="w-full relative bg-white">
        <img
            src="https://hieucontugoc.online/wp-content/uploads/2026/05/2.jpg"
            alt="Ảnh bìa Hiểu Con Từ Gốc"
            class="w-full h-auto object-contain block mx-auto"
            loading="eager"
        >
        <div class="absolute bottom-0 left-0 w-full h-10 md:h-20 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
    </section>

    <!-- ==============================================================
         2. LỜI CHÀO MỞ ĐẦU (EDITORIAL WELCOME)
         ============================================================== -->
    <section id="loi-chao" class="py-12 sm:py-16 lg:py-20 bg-white border-b border-slate-100">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">

            <span class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#fff7ed] border border-orange-200/80 text-[#f97316] font-bold text-xs uppercase tracking-wider mb-5">
                <i data-lucide="sparkles" class="w-3.5 h-3.5"></i>
                <span>Bắt đầu từ lòng yêu thương</span>
            </span>

            <h1 class="hc-hero-title font-serif text-3xl sm:text-4xl lg:text-5xl font-bold text-[#0A1931] mb-3">
                Chào mừng ba mẹ đến với ngôi nhà chung
            </h1>
            <p class="font-serif text-xl sm:text-2xl lg:text-3xl text-[#f97316] italic mb-8">
                "Thấu hiểu để đồng hành cùng con"
            </p>

            <!-- Khung trích dẫn điểm nhấn -->
            <div class="hc-master-card max-w-3xl mx-auto mb-8 text-left sm:text-center">
                <div class="hc-card-bar"></div>
                <div class="p-6 sm:p-8">
                    <p class="font-serif text-lg sm:text-2xl text-[#0A1931] leading-relaxed italic mb-3">
                        "Yêu thương không chỉ là sự kiên nhẫn đón nhận, mà còn là hành trình tìm hiểu gốc rễ vấn đề để <strong class="font-bold text-[#f97316] not-italic">chăm sóc và nâng đỡ</strong> sức khỏe cho con."
                    </p>
                    <p class="hc-body-text text-[15px] sm:text-base text-slate-600 max-w-2xl mx-auto">
                        Tại đây, chúng ta chuyển dịch từ việc chỉ quan sát những biểu hiện hành vi bề nổi sang việc lắng nghe và nuôi dưỡng nền tảng sức khỏe bên trong của trẻ.
                    </p>
                </div>
            </div>

            <!-- Cụm nút hành động (1 dòng gọn gàng, không rớt chữ) -->
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3.5">
                <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold text-[15px] px-6 py-3.5 rounded-xl shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all whitespace-nowrap no-underline">
                    <i data-lucide="calendar-check" class="w-4 h-4 shrink-0"></i>
                    <span>Đăng ký tư vấn dinh dưỡng 1:1</span>
                </a>
                <a href="#goc-nhin-khoa-hoc" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#f8fafc] hover:bg-slate-100 text-[#0A1931] border border-slate-200 font-semibold text-[15px] px-6 py-3.5 rounded-xl transition-all whitespace-nowrap no-underline">
                    <span>Tìm hiểu góc nhìn khoa học</span>
                    <i data-lucide="arrow-down" class="w-4 h-4 text-[#f97316] shrink-0"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         3. GÓC NHÌN KHOA HỌC (3 THẺ NỀN TRẮNG, ĐIỂM NHẤN CAM ĐỒNG NHẤT)
         ============================================================== -->
    <section id="goc-nhin-khoa-hoc" class="py-14 sm:py-20 bg-[#f8fafc] border-b border-slate-200/70">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-orange-200/80 text-[#f97316] text-xs font-bold uppercase tracking-wider mb-3">
                    Góc nhìn khoa học
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931] mb-4">
                    Vì sao cần thấu hiểu cơ thể con từ gốc?
                </h2>
                <p class="hc-body-text text-[15.5px] sm:text-[16.5px] text-slate-600">
                    Nhiều ba mẹ thường chỉ tập trung vào các biểu hiện hành vi bên ngoài. Tuy nhiên, <strong class="text-[#0A1931] font-bold">não bộ không hoạt động biệt lập</strong> mà luôn gắn kết chặt chẽ với hệ tiêu hóa, miễn dịch và chế độ dinh dưỡng hằng ngày.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Thẻ 1 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="activity" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Hệ tiêu hóa & hấp thu</h3>
                    <p class="hc-body-text text-[15px] text-slate-600 flex-grow">
                        Các vấn đề như táo bón, đầy bụng, rối loạn tiêu hóa hay mất cân bằng hệ vi sinh đường ruột có thể tác động trực tiếp đến giấc ngủ, cảm xúc và sự thoải mái của trẻ thông qua trục Não – Ruột.
                    </p>
                </div>

                <!-- Thẻ 2 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="apple" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Đáp ứng thực phẩm & cơ địa</h3>
                    <p class="hc-body-text text-[15px] text-slate-600 flex-grow">
                        Mỗi em bé có một cơ địa riêng. Việc nhận diện sớm tình trạng kén ăn, dị ứng hoặc bất dung nạp thực phẩm giúp ba mẹ điều chỉnh bữa ăn phù hợp để cơ thể con nhẹ nhàng và dễ chịu hơn.
                    </p>
                </div>

                <!-- Thẻ 3 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="sparkles" class="w-6 h-6"></i>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Cân bằng vi chất & năng lượng</h3>
                    <p class="hc-body-text text-[15px] text-slate-600 flex-grow">
                        Thiếu hụt vi chất và dưỡng chất thiết yếu khiến trẻ chậm tăng trưởng và thiếu năng lượng. Bổ sung đúng và đủ chính là nền tảng nuôi dưỡng cả thể chất lẫn sự phát triển trí não.
                    </p>
                </div>
            </div>

            <!-- Thanh đúc kết -->
            <div class="mt-8 sm:mt-10 bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-5 sm:p-6 max-w-3xl mx-auto flex flex-col sm:flex-row items-center gap-4 text-center sm:text-left">
                <div class="w-11 h-11 rounded-full bg-[#f97316] text-white flex items-center justify-center shrink-0 shadow-sm">
                    <i data-lucide="sun" class="w-5 h-5"></i>
                </div>
                <p class="hc-body-text text-[15.5px] sm:text-[16.5px] text-[#0A1931] font-medium">
                    Vì vậy, để hỗ trợ con tập trung và tiếp thu tốt hơn, chúng ta cần bắt đầu <strong class="text-[#f97316] font-bold">chăm sóc nền tảng sức khỏe từ cơ thể</strong>.
                </p>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         4. PHƯƠNG PHÁP ĐỒNG HÀNH (TIẾP CẬN TOÀN DIỆN & KẾT HỢP)
         ============================================================== -->
    <section id="phuong-phap" class="py-14 sm:py-20 bg-white border-b border-slate-100">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái: Định hướng -->
                <div class="lg:col-span-5 space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-orange-200/80 text-[#f97316] text-xs font-bold uppercase tracking-wider">
                        Phương pháp đồng hành
                    </span>
                    <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931]">
                        Tiếp cận toàn diện & kết hợp
                    </h2>
                    <p class="hc-body-text text-[15.5px] sm:text-[16.5px] text-slate-600">
                        Việc chăm sóc sức khỏe tiêu hóa, dinh dưỡng cần được đan xen chặt chẽ như những mảnh ghép cùng với giáo dục kỹ năng và sự đồng hành mỗi ngày của gia đình.
                    </p>
                    <div class="pl-4 border-l-4 border-[#f97316] py-1">
                        <p class="font-serif italic text-[16.5px] sm:text-[17.5px] text-[#0A1931] font-medium">
                            "Giúp con có nền tảng thể chất khỏe khoắn để nâng cao khả năng tập trung và đạt hiệu quả can thiệp tối ưu."
                        </p>
                    </div>
                </div>

                <!-- Cột phải: 2 Mảnh ghép -->
                <div class="lg:col-span-7 space-y-4">
                    <div class="hc-feature-card p-6 sm:p-7 flex items-start gap-4 sm:gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center shrink-0">
                            <i data-lucide="heart-pulse" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-1.5">Phần nền: Dinh dưỡng & tiêu hóa</h3>
                            <p class="hc-body-text text-[15px] text-slate-600">
                                Giúp con có cơ thể khỏe mạnh từ bên trong, bụng êm, hấp thu tốt, thiết lập lại giấc ngủ sâu và sự tập trung làm nền tảng.
                            </p>
                        </div>
                    </div>

                    <div class="hc-feature-card p-6 sm:p-7 flex items-start gap-4 sm:gap-5">
                        <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center shrink-0">
                            <i data-lucide="graduation-cap" class="w-6 h-6"></i>
                        </div>
                        <div>
                            <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-1.5">Phần kỹ năng: Giáo dục & tương tác</h3>
                            <p class="hc-body-text text-[15px] text-slate-600">
                                Đồng hành cùng con học hỏi kỹ năng mới, phát triển ngôn ngữ, giao tiếp, vận động và từng bước hòa nhập với cuộc sống xung quanh.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==============================================================
         5. KHÔNG GIAN ĐỒNG HÀNH (3 TRỤ CỘT DÀNH CHO BA MẸ)
         ============================================================== -->
    <section id="hoat-dong" class="py-14 sm:py-20 bg-[#f8fafc] border-b border-slate-200/70">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-orange-200/80 text-[#f97316] text-xs font-bold uppercase tracking-wider mb-3">
                    Hoạt động trọng tâm
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931]">
                    Không gian này là để chúng ta...
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Hoạt động 1 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="book-open" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#f97316] mb-1">Trụ cột khoa học</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-4">Khám phá kiến thức</h3>
                    <ul class="space-y-3 text-[15px] text-slate-600 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Trục Não – Ruột và vai trò của hệ vi sinh đường ruột.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Dinh dưỡng nền tảng và cách xây dựng chế độ ăn phù hợp cơ địa.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Cân bằng vi chất, hỗ trợ tiêu hóa và cải thiện giấc ngủ tự nhiên.</span>
                        </li>
                    </ul>
                </div>

                <!-- Hoạt động 2 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="message-circle" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#f97316] mb-1">Đồng hành sát sao</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-4">Trao đổi & tư vấn</h3>
                    <ul class="space-y-3 text-[15px] text-slate-600 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Hướng dẫn cách lắng nghe và <strong class="text-[#0A1931] font-semibold">đọc hiểu tín hiệu cơ thể</strong>: giấc ngủ, tiêu hóa, hành vi, dị ứng thực phẩm.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Giải đáp thắc mắc về thực đơn, vi chất và định hướng chăm sóc phù hợp cho từng bé.</span>
                        </li>
                    </ul>
                </div>

                <!-- Hoạt động 3 -->
                <div class="hc-feature-card p-6 sm:p-8 flex flex-col h-full">
                    <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mb-5">
                        <i data-lucide="users" class="w-6 h-6"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#f97316] mb-1">Chủ động đồng hành</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-4">Sẻ chia giải pháp</h3>
                    <ul class="space-y-3 text-[15px] text-slate-600 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Không chỉ sẻ chia cảm xúc, chúng ta cùng nhau tìm kiếm <strong class="text-[#0A1931] font-semibold">giải pháp thiết thực</strong>.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2.5 shrink-0"></span>
                            <span>Cùng kiên trì áp dụng từng bước để cảm nhận sự thay đổi tích cực mỗi ngày của con.</span>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         6. MỤC TIÊU CỦA CỘNG ĐỒNG & ĐẶT LỊCH TƯ VẤN 1:1
         (ĐỒNG BỘ 100% PHONG CÁCH KHUNG CAM NHẠT CỦA TRANG ĐĂNG KÝ 1:1)
         ============================================================== -->
    <section class="py-14 sm:py-20 bg-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="hc-master-card">
                <div class="hc-card-bar"></div>
                <div class="p-6 sm:p-10 lg:p-12">

                    <div class="text-center mb-8">
                        <div class="w-12 h-12 rounded-2xl bg-[#fff7ed] border border-orange-200/80 text-[#f97316] flex items-center justify-center mx-auto mb-4">
                            <i data-lucide="feather" class="w-6 h-6"></i>
                        </div>
                        <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931]">
                            Mục tiêu của cộng đồng
                        </h2>
                    </div>

                    <!-- Khung 3 mục tiêu đồng bộ y hệt khung 4 ý trên trang Đăng ký 1:1 -->
                    <div class="bg-[#fff7ed] border border-orange-200/80 rounded-2xl p-5 sm:p-7 mb-8">
                        <ul class="divide-y divide-orange-200/60 text-slate-700 text-[15px] sm:text-[16px]">
                            <li class="flex items-start gap-3.5 pb-4">
                                <span class="w-6 h-6 rounded-full bg-[#f97316] text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">1</span>
                                <span class="hc-body-text">
                                    Ba mẹ hiểu biết, không phó mặc, chủ động trở thành <strong class="text-[#0A1931] font-bold">người đồng hành thấu hiểu con nhất</strong> ngay tại gia đình.
                                </span>
                            </li>
                            <li class="flex items-start gap-3.5 py-4">
                                <span class="w-6 h-6 rounded-full bg-[#f97316] text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">2</span>
                                <span class="hc-body-text">
                                    Lan tỏa tư duy chăm sóc sức khỏe cốt lõi: <strong class="text-[#0A1931] font-bold">"Cơ thể khỏe mạnh là nền tảng vững chắc để nuôi dưỡng não bộ"</strong>.
                                </span>
                            </li>
                            <li class="flex items-start gap-3.5 pt-4">
                                <span class="w-6 h-6 rounded-full bg-[#f97316] text-white flex items-center justify-center shrink-0 mt-1 text-xs font-bold shadow-sm">3</span>
                                <span class="hc-body-text">
                                    Là điểm tựa tin cậy, ấm áp và văn minh dựa trên nền tảng <strong class="text-[#0A1931] font-bold">khoa học dinh dưỡng thực tế</strong>.
                                </span>
                            </li>
                        </ul>
                    </div>

                    <!-- Nút kêu gọi đặt lịch 1:1 -->
                    <div class="text-center">
                        <p class="text-slate-600 text-sm sm:text-[15px] mb-4">
                            Hiểu Con Từ Gốc dành tặng <strong class="text-[#f97316]">30 lịch tư vấn dinh dưỡng 1:1 (30 phút)</strong> cho các bé gặp vấn đề tiêu hóa, kén ăn, táo bón, chậm tăng trưởng:
                        </p>
                        <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="inline-flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white font-extrabold text-[15px] sm:text-base uppercase tracking-wider px-8 py-4 rounded-xl shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] hover:-translate-y-0.5 transition-all whitespace-nowrap no-underline">
                            <span>Đăng ký tư vấn 1:1 ngay</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 shrink-0"></i>
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
