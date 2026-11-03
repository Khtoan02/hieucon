<?php
/**
 * Template Name: Trang chủ
 * Description: Trang chủ Hiểu Con Từ Gốc — Giao diện sáng thoáng đồng bộ với trang Đăng ký tư vấn 1:1 (Nền trắng, Xanh than #0A1931 & Cam #f97316), ngôn từ chuẩn hóa và tích cực.
 *
 * @package Hieucon
 */

get_header();
?>

<style>
    /* Đồng bộ hệ màu & nền trắng tinh gọn với trang Đăng ký tư vấn 1:1 */
    #primary.hc-home-page {
        background: #ffffff !important;
        color: #0A1931;
        padding-top: 76px !important;
    }
    @media (min-width: 1024px) {
        #primary.hc-home-page {
            padding-top: 86px !important;
        }
    }

    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 24px;
        box-shadow: 0 24px 54px -24px rgba(10, 25, 49, 0.09);
        overflow: hidden;
    }
    .hc-sub-card {
        background: #ffffff;
        border: 1.5px solid #e2e8f0;
        border-radius: 20px;
        box-shadow: 0 16px 36px -22px rgba(10, 25, 49, 0.08);
        transition: all 0.22s ease;
    }
    .hc-sub-card:hover {
        border-color: #fdba74;
        transform: translateY(-3px);
        box-shadow: 0 22px 44px -20px rgba(249, 115, 22, 0.14);
    }
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #0A1931 0%, #f97316 100%);
    }

    /* Typography chống dính dấu tiếng Việt trên mọi kích thước màn hình */
    .hc-hero-title {
        line-height: 1.26 !important;
    }
    .hc-sec-title {
        line-height: 1.28 !important;
    }
    .hc-body-copy {
        line-height: 1.76 !important;
    }
</style>

<main id="primary" class="site-main hc-home-page font-sans text-[#0A1931] antialiased selection:bg-[#f97316] selection:text-white">

    <!-- ==============================================================
         MÀN 1: HERO — HIỂU CON TỪ GỐC (CÂN ĐỐI 2 CỘT)
         ============================================================== -->
    <section class="relative bg-white py-8 sm:py-12 lg:py-16 border-b border-slate-100">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái: Thông điệp trọng tâm & Hành động -->
                <div class="lg:col-span-6 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-[#f97316]"></span>
                        Đồng hành cùng gia đình
                    </div>

                    <h1 class="hc-hero-title font-serif text-[26px] sm:text-4xl lg:text-[42px] font-bold text-[#0A1931] tracking-tight">
                        <span class="block">Chào mừng ba mẹ đến với</span>
                        <span class="block mt-1 text-[#f97316]">HIỂU CON TỪ GỐC</span>
                    </h1>

                    <p class="hc-body-copy text-[15px] sm:text-[16.5px] text-slate-600 font-normal">
                        Yêu thương không chỉ là sự kiên nhẫn đón nhận, mà còn là hành trình thấu hiểu cơ thể con từ gốc rễ để chăm sóc sức khỏe tiêu hóa, dinh dưỡng và giấc ngủ vững vàng mỗi ngày.
                    </p>

                    <div class="rounded-2xl bg-[#f8fafc] border border-slate-200/90 p-4 sm:p-5">
                        <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-[#0A1931] font-medium">
                            Tại đây, chúng ta chuyển dịch từ việc chỉ quan sát những biểu hiện hành vi bề nổi sang việc lắng nghe và chăm sóc nền tảng sức khỏe bên trong của trẻ.
                        </p>
                    </div>

                    <!-- Cụm nút điều hướng chính -->
                    <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5">
                        <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="inline-flex items-center justify-center gap-2.5 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold text-[15px] px-6 py-3.5 rounded-xl shadow-[0_12px_24px_-8px_rgba(249,115,22,0.45)] transition-all no-underline">
                            <i data-lucide="calendar-check" class="w-4 h-4"></i>
                            <span>Đăng ký tư vấn dinh dưỡng 1:1</span>
                        </a>
                        <a href="#goc-nhin-toan-dien" class="inline-flex items-center justify-center gap-2 bg-white hover:bg-slate-50 text-[#0A1931] border border-slate-200 font-semibold text-[15px] px-5 py-3.5 rounded-xl transition-all no-underline">
                            <span>Tìm hiểu hướng tiếp cận</span>
                            <i data-lucide="arrow-down" class="w-4 h-4 text-[#f97316]"></i>
                        </a>
                    </div>
                </div>

                <!-- Cột phải: Khung ảnh minh họa & 3 điểm tựa nền tảng -->
                <div class="lg:col-span-6">
                    <div class="hc-master-card">
                        <div class="hc-card-bar"></div>
                        <div class="p-3 sm:p-4 bg-white">
                            <div class="overflow-hidden rounded-2xl border border-slate-100 bg-[#fffaf5]">
                                <img
                                    src="https://hieucontugoc.online/wp-content/uploads/2026/05/2.jpg"
                                    alt="Hiểu Con Từ Gốc - Thấu hiểu để đồng hành cùng con"
                                    class="w-full h-auto object-cover block"
                                    loading="eager"
                                />
                            </div>

                            <div class="grid grid-cols-3 gap-2.5 pt-3.5 mt-3.5 border-t border-slate-100 text-center">
                                <div class="px-2 py-2 rounded-xl bg-[#f8fafc]">
                                    <p class="text-[12px] sm:text-[13px] font-bold text-[#0A1931]">Tiêu hóa khỏe</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Êm bụng & hấp thu tốt</p>
                                </div>
                                <div class="px-2 py-2 rounded-xl bg-[#fff7ed]">
                                    <p class="text-[12px] sm:text-[13px] font-bold text-[#ea580c]">Dinh dưỡng đúng</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Phù hợp cơ địa trẻ</p>
                                </div>
                                <div class="px-2 py-2 rounded-xl bg-[#f8fafc]">
                                    <p class="text-[12px] sm:text-[13px] font-bold text-[#0A1931]">Não bộ & Hành vi</p>
                                    <p class="text-[11px] text-slate-500 mt-0.5">Ngủ sâu & tập trung</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==============================================================
         MÀN 2: GÓC NHÌN TOÀN DIỆN — VÌ SAO CẦN CHĂM SÓC TỪ CƠ THỂ?
         ============================================================== -->
    <section id="goc-nhin-toan-dien" class="py-12 sm:py-16 lg:py-20 bg-[#f8fafc] border-b border-slate-200/70">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-slate-200 text-[#f97316] text-xs font-bold uppercase tracking-wider mb-3">
                    Góc nhìn khoa học
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931] mb-4">
                    Vì sao cần thấu hiểu cơ thể con từ gốc?
                </h2>
                <p class="hc-body-copy text-[15px] sm:text-[16px] text-slate-600">
                    Não bộ không hoạt động tách rời mà luôn gắn kết chặt chẽ với hệ tiêu hóa và chế độ dinh dưỡng hằng ngày. Khi cơ thể bên trong gặp trở ngại, con rất dễ mệt mỏi, khó ngủ và giảm khả năng tập trung.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Yếu tố 1 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-11 h-11 rounded-xl bg-[#0A1931] text-white flex items-center justify-center">
                            <i data-lucide="activity" class="w-5 h-5"></i>
                        </span>
                        <span class="text-xs font-extrabold text-slate-400 tracking-wider">YẾU TỐ 01</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Hệ tiêu hóa & hấp thu</h3>
                    <p class="hc-body-copy text-[14.5px] text-slate-600 flex-grow">
                        Các vấn đề như táo bón, đầy bụng, rối loạn tiêu hóa hay mất cân bằng hệ vi sinh đường ruột có thể tác động trực tiếp đến cảm xúc, giấc ngủ và sự thoải mái của trẻ qua trục Não – Ruột.
                    </p>
                </div>

                <!-- Yếu tố 2 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-11 h-11 rounded-xl bg-[#f97316] text-white flex items-center justify-center">
                            <i data-lucide="apple" class="w-5 h-5"></i>
                        </span>
                        <span class="text-xs font-extrabold text-[#f97316] tracking-wider">YẾU TỐ 02</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Đáp ứng thực phẩm & cơ địa</h3>
                    <p class="hc-body-copy text-[14.5px] text-slate-600 flex-grow">
                        Mỗi em bé có một cơ địa riêng. Việc nhận diện sớm tình trạng kén ăn, dị ứng hoặc bất dung nạp thực phẩm giúp ba mẹ xây dựng thực đơn phù hợp để cơ thể con nhẹ nhàng và dễ chịu hơn.
                    </p>
                </div>

                <!-- Yếu tố 3 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="w-11 h-11 rounded-xl bg-[#0A1931] text-white flex items-center justify-center">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                        </span>
                        <span class="text-xs font-extrabold text-slate-400 tracking-wider">YẾU TỐ 03</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Cân bằng vi chất & năng lượng</h3>
                    <p class="hc-body-copy text-[14.5px] text-slate-600 flex-grow">
                        Thiếu hụt vi chất và dưỡng chất thiết yếu khiến trẻ chậm tăng trưởng và thiếu năng lượng. Bổ sung đúng và đủ chính là nền tảng nuôi dưỡng cả thể chất lẫn sự phát triển trí não.
                    </p>
                </div>
            </div>

            <!-- Thông điệp đúc kết -->
            <div class="mt-8 sm:mt-10 bg-white border border-slate-200 rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4 shadow-sm">
                <div class="flex items-center gap-3.5 text-left">
                    <span class="w-10 h-10 rounded-xl bg-[#fff7ed] border border-[#fed7aa] text-[#f97316] flex items-center justify-center shrink-0">
                        <i data-lucide="sun" class="w-5 h-5"></i>
                    </span>
                    <p class="hc-body-copy text-[15px] sm:text-[16px] text-[#0A1931] font-medium">
                        Khi <strong class="font-bold text-[#f97316]">cơ thể bên trong khỏe mạnh và êm dịu</strong>, con sẽ có nền tảng vững vàng hơn để ngủ ngon, tập trung và tiếp thu tốt hơn.
                    </p>
                </div>
                <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="shrink-0 inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#0A1931] transition-colors no-underline">
                    <span>Tìm hiểu tình trạng của con</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         MÀN 3: PHƯƠNG PHÁP ĐỒNG HÀNH — KẾT HỢP CHĂM SÓC NỀN TẢNG & GIÁO DỤC
         ============================================================== -->
    <section id="phuong-phap" class="py-12 sm:py-16 lg:py-20 bg-white border-b border-slate-100">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái: Định hướng -->
                <div class="lg:col-span-5 space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider">
                        Phương pháp đồng hành
                    </span>
                    <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931]">
                        Kết hợp hài hòa giữa chăm sóc sức khỏe và giáo dục kỹ năng
                    </h2>
                    <p class="hc-body-copy text-[15px] sm:text-[16px] text-slate-600">
                        Chăm sóc dinh dưỡng, tiêu hóa và rèn luyện kỹ năng giáo dục là hai mảnh ghép bổ trợ mật thiết cho nhau trên hành trình đồng hành cùng con.
                    </p>
                    <div class="pl-4 border-l-4 border-[#f97316] py-1">
                        <p class="font-serif italic text-[16px] sm:text-[17px] text-[#0A1931] font-semibold">
                            "Nuôi dưỡng cơ thể khỏe mạnh để tạo đà cho con học hỏi, giao tiếp và đạt hiệu quả can thiệp tốt hơn."
                        </p>
                    </div>
                </div>

                <!-- Cột phải: 2 Mảnh ghép -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Mảnh ghép 1 -->
                    <div class="hc-master-card flex flex-col">
                        <div class="hc-card-bar"></div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="w-11 h-11 rounded-xl bg-[#0A1931] text-white flex items-center justify-center mb-4">
                                <i data-lucide="heart-pulse" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Nền tảng bên trong</span>
                            <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Dinh dưỡng & tiêu hóa</h3>
                            <p class="hc-body-copy text-[14.5px] text-slate-600 flex-grow">
                                Cải thiện tiêu hóa, xây dựng chế độ ăn phù hợp và ổn định giấc ngủ để cơ thể con khỏe khoắn, tinh thần thoải mái và sẵn sàng đón nhận bài học mới.
                            </p>
                        </div>
                    </div>

                    <!-- Mảnh ghép 2 -->
                    <div class="hc-master-card flex flex-col">
                        <div class="hc-card-bar"></div>
                        <div class="p-6 flex flex-col flex-grow">
                            <div class="w-11 h-11 rounded-xl bg-[#f97316] text-white flex items-center justify-center mb-4">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#f97316] mb-1">Phát triển bên ngoài</span>
                            <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-2.5">Giáo dục & kỹ năng</h3>
                            <p class="hc-body-copy text-[14.5px] text-slate-600 flex-grow">
                                Đồng hành rèn luyện ngôn ngữ, giao tiếp, vận động và kỹ năng tự lập từng bước vững chắc trong sinh hoạt hằng ngày cùng gia đình và thầy cô.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- ==============================================================
         MÀN 4: KHÔNG GIAN ĐỒNG HÀNH — BA TRỤ CỘT DÀNH CHO BA MẸ
         ============================================================== -->
    <section id="hoat-dong" class="py-12 sm:py-16 lg:py-20 bg-[#f8fafc] border-b border-slate-200/70">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-slate-200 text-[#0A1931] text-xs font-bold uppercase tracking-wider mb-3">
                    Hệ sinh thái nội dung
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-[#0A1931] mb-3">
                    Không gian đồng hành cùng ba mẹ mỗi ngày
                </h2>
                <p class="hc-body-copy text-[15px] sm:text-[16px] text-slate-600">
                    Hệ thống bài viết, cẩm nang và lịch tư vấn được sắp xếp rõ ràng, dễ hiểu để ba mẹ dễ dàng áp dụng ngay tại nhà.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Trụ cột 1: Kiến thức -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="w-11 h-11 rounded-xl bg-[#0A1931] text-white flex items-center justify-center mb-4">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Chuyên mục kiến thức</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-3">Tìm hiểu kiến thức nền tảng</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-slate-600 mb-6 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Mối liên hệ mật thiết giữa hệ tiêu hóa, giấc ngủ và hành vi của trẻ.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Nguyên tắc lựa chọn thực phẩm và xây dựng bữa ăn giàu dưỡng chất.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Cách quan sát và lắng nghe các tín hiệu cơ thể của con mỗi ngày.</span>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/bai-viet-kien-thuc/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#0A1931] hover:text-[#f97316] transition-colors no-underline">
                        <span>Xem chuyên mục bài viết</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Trụ cột 2: Cẩm nang -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="w-11 h-11 rounded-xl bg-[#f97316] text-white flex items-center justify-center mb-4">
                        <i data-lucide="library" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#f97316] mb-1">Thư viện thực hành</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-3">Cẩm nang hướng dẫn từng bước</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-slate-600 mb-6 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0A1931] mt-2 shrink-0"></span>
                            <span>Cẩm nang cải thiện tình trạng kén ăn, táo bón và rối loạn tiêu hóa.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0A1931] mt-2 shrink-0"></span>
                            <span>Hướng dẫn thiết lập thói quen sinh hoạt và kỹ năng tự lập tại nhà.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#0A1931] mt-2 shrink-0"></span>
                            <span>Trình bày trực quan theo từng chương mục để ba mẹ tra cứu nhanh.</span>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/docs/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#0A1931] transition-colors no-underline">
                        <span>Khám phá thư viện cẩm nang</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Trụ cột 3: Tư vấn 1:1 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="w-11 h-11 rounded-xl bg-[#0A1931] text-white flex items-center justify-center mb-4">
                        <i data-lucide="message-circle-heart" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-1">Đồng hành trực tiếp</p>
                    <h3 class="font-serif text-xl font-bold text-[#0A1931] mb-3">Tư vấn dinh dưỡng 1:1</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-slate-600 mb-6 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>30 phút trao đổi trực tiếp để nhìn rõ các vấn đề tiêu hóa của trẻ.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Hiểu rõ mối liên hệ giữa tiêu hóa, dinh dưỡng với não bộ và hành vi.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Định hình từng bước cải thiện bữa ăn phù hợp với thể trạng của con.</span>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#0A1931] hover:text-[#f97316] transition-colors no-underline">
                        <span>Đăng ký lịch tư vấn 1:1</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         MÀN 5: GIÁ TRỊ CỐT LÕI & LỜI MỜI ĐẶT LỊCH TƯ VẤN 1:1
         ============================================================== -->
    <section class="py-12 sm:py-16 lg:py-20 bg-white">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="hc-master-card">
                <div class="hc-card-bar"></div>
                <div class="p-6 sm:p-10 lg:p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-10 items-center">

                        <!-- Cột trái: 3 Giá trị cốt lõi của cộng đồng -->
                        <div class="lg:col-span-7 space-y-5">
                            <div>
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider mb-2.5">
                                    Giá trị hướng tới
                                </span>
                                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl font-bold text-[#0A1931]">
                                    Mục tiêu của cộng đồng Hiểu Con Từ Gốc
                                </h2>
                            </div>

                            <div class="space-y-3.5">
                                <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-[#f8fafc] border border-slate-200/80">
                                    <span class="w-7 h-7 rounded-lg bg-[#0A1931] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">01</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-[#0A1931]">
                                        <strong class="font-bold">Ba mẹ thấu hiểu & chủ động:</strong> Trang bị kiến thức thiết thực để ba mẹ tự tin trở thành người bạn đồng hành hiểu con nhất ngay tại gia đình.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-[#f8fafc] border border-slate-200/80">
                                    <span class="w-7 h-7 rounded-lg bg-[#f97316] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">02</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-[#0A1931]">
                                        <strong class="font-bold">Chăm sóc sức khỏe nền tảng:</strong> Lan tỏa góc nhìn tích cực rằng một hệ tiêu hóa êm dịu và dinh dưỡng cân bằng sẽ nâng đỡ sự phát triển trí não của trẻ.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3.5 p-3.5 rounded-xl bg-[#f8fafc] border border-slate-200/80">
                                    <span class="w-7 h-7 rounded-lg bg-[#0A1931] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5">03</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-[#0A1931]">
                                        <strong class="font-bold">Điểm tựa sẻ chia & bền bỉ:</strong> Xây dựng môi trường văn minh, ấm áp, nơi các gia đình cùng nhau kiên trì áp dụng giải pháp mỗi ngày.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Cột phải: Khung kêu gọi đăng ký lịch tư vấn 1:1 -->
                        <div class="lg:col-span-5">
                            <div class="rounded-2xl bg-[#0A1931] text-white p-6 sm:p-7 space-y-4">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white/10 text-[#fdba74] text-xs font-bold uppercase tracking-wider">
                                    Quà tặng dành cho ba mẹ
                                </span>
                                <h3 class="font-serif text-xl sm:text-2xl font-bold text-white leading-snug">
                                    Dành tặng 30 lịch tư vấn dinh dưỡng 1:1 trong 30 phút
                                </h3>
                                <p class="text-sm text-slate-300 leading-relaxed">
                                    Dành cho các bé đang gặp vấn đề về kén ăn, dị ứng, bất dung nạp thực phẩm, táo bón, rối loạn tiêu hóa hoặc chậm tăng trưởng.
                                </p>
                                <div class="pt-1">
                                    <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold text-[15px] px-5 py-3.5 rounded-xl shadow-lg transition-all no-underline">
                                        <span>Đăng ký nhận lịch tư vấn 1:1</span>
                                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </section>

</main>

<?php get_footer(); ?>
