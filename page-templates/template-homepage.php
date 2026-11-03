<?php
/**
 * Template Name: Trang chủ
 * Description: Trang chủ Hiểu Con Từ Gốc — Phong cách Warm Sunrise Editorial (Trắng kem ấm & Dải sắc độ Cam đơn sắc #f97316), nhẹ nhàng, gần gũi và chuẩn hóa ngôn từ.
 *
 * @package Hieucon
 */

get_header();
?>

<style>
    /* ==========================================================================
       WARM SUNRISE EDITORIAL — BẢNG MÀU CAM ĐƠN SẮC ẤM ÁP (KHÔNG DÙNG MẢNG ĐEN)
       ========================================================================== */
    #primary.hc-home-page {
        background: #ffffff !important;
        color: #292524; /* Nâu đá ấm dịu mắt thay vì đen/xanh đen */
        padding-top: 76px !important;
    }
    @media (min-width: 1024px) {
        #primary.hc-home-page {
            padding-top: 86px !important;
        }
    }

    /* Haptic Double-Bezel Card (Khung lồng 2 lớp tạo chiều sâu tinh tế) */
    .hc-bezel-shell {
        background: linear-gradient(180deg, #fff7ed 0%, #fffaf5 100%);
        border: 1px solid #fed7aa;
        border-radius: 28px;
        padding: 8px;
        box-shadow: 0 24px 56px -24px rgba(234, 88, 12, 0.12);
    }
    .hc-bezel-core {
        background: #ffffff;
        border: 1px solid #ffedd5;
        border-radius: 21px;
        overflow: hidden;
    }

    /* Master Card & Sub Card đồng bộ dải màu Cam ấm */
    .hc-master-card {
        background: #ffffff;
        border: 1.5px solid #fed7aa;
        border-radius: 24px;
        box-shadow: 0 22px 50px -24px rgba(234, 88, 12, 0.11);
        overflow: hidden;
    }
    .hc-sub-card {
        background: #ffffff;
        border: 1.5px solid #f5ebe1;
        border-radius: 22px;
        box-shadow: 0 14px 34px -20px rgba(234, 88, 12, 0.08);
        transition: transform 0.25s cubic-bezier(0.22, 1, 0.36, 1), border-color 0.25s ease, box-shadow 0.25s ease;
    }
    .hc-sub-card:hover {
        border-color: #fdba74;
        transform: translateY(-3px);
        box-shadow: 0 22px 44px -20px rgba(249, 115, 22, 0.16);
    }

    /* Thanh điểm nhấn đầu thẻ: 100% dải sắc độ Cam ấm (Không pha màu đen) */
    .hc-card-bar {
        height: 5px;
        background: linear-gradient(90deg, #ea580c 0%, #f97316 50%, #fb923c 100%);
    }

    /* Hộp icon & Nhãn số Tonal Orange */
    .hc-icon-box {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: #fff7ed;
        border: 1px solid #fed7aa;
        color: #ea580c;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    .hc-icon-box-solid {
        width: 46px;
        height: 46px;
        border-radius: 14px;
        background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);
        color: #ffffff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        box-shadow: 0 10px 20px -8px rgba(249, 115, 22, 0.45);
    }

    /* Quầng sáng cam đào dịu nhẹ phía sau Hero */
    .hc-warm-hero-bg {
        background:
            radial-gradient(circle at 88% 18%, rgba(251, 146, 60, 0.12) 0%, rgba(251, 146, 60, 0) 48%),
            radial-gradient(circle at 10% 85%, rgba(254, 215, 170, 0.22) 0%, rgba(254, 215, 170, 0) 50%),
            #ffffff;
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

<main id="primary" class="site-main hc-home-page font-sans text-stone-800 antialiased selection:bg-[#f97316] selection:text-white">

    <!-- ==============================================================
         MÀN 1: HERO — HIỂU CON TỪ GỐC (ẤM ÁP, THOÁNG ĐÃNG, 1 TÔNG CAM)
         ============================================================== -->
    <section class="relative hc-warm-hero-bg py-8 sm:py-12 lg:py-16 border-b border-[#f5ebe1]">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái: Thông điệp trọng tâm & Hành động -->
                <div class="lg:col-span-6 space-y-5">
                    <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider">
                        <span class="w-2 h-2 rounded-full bg-[#f97316]"></span>
                        Bắt đầu từ lòng yêu thương
                    </div>

                    <h1 class="hc-hero-title font-serif text-[26px] sm:text-4xl lg:text-[42px] font-bold text-stone-800 tracking-tight">
                        <span class="block">Chào mừng ba mẹ đến với</span>
                        <span class="block mt-1 text-[#f97316]">HIỂU CON TỪ GỐC</span>
                    </h1>

                    <p class="hc-body-copy text-[15.5px] sm:text-[16.5px] text-stone-600 font-normal">
                        Yêu thương không chỉ là sự kiên nhẫn đón nhận, mà còn là hành trình thấu hiểu cơ thể con từ gốc rễ để chăm sóc sức khỏe tiêu hóa, dinh dưỡng và giấc ngủ vững vàng mỗi ngày.
                    </p>

                    <div class="rounded-2xl bg-[#fff7ed]/80 border border-[#fed7aa] p-4 sm:p-5">
                        <p class="hc-body-copy text-[14.5px] sm:text-[15.5px] text-stone-700 font-medium">
                            Tại đây, chúng ta chuyển dịch từ việc chỉ quan sát những biểu hiện hành vi bề nổi sang việc lắng nghe và nuôi dưỡng nền tảng sức khỏe bên trong của trẻ.
                        </p>
                    </div>

                    <!-- Cụm nút điều hướng chính (100% tông Cam & Kem ấm) -->
                    <div class="pt-1 flex flex-col sm:flex-row items-stretch sm:items-center gap-3.5">
                        <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="inline-flex items-center justify-center gap-2.5 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold text-[15px] px-6 py-3.5 rounded-xl shadow-[0_12px_24px_-8px_rgba(249,115,22,0.45)] transition-all no-underline">
                            <i data-lucide="calendar-check" class="w-4 h-4"></i>
                            <span>Đăng ký tư vấn dinh dưỡng 1:1</span>
                        </a>
                        <a href="#goc-nhin-toan-dien" class="inline-flex items-center justify-center gap-2 bg-[#fff7ed] hover:bg-[#ffedd5] text-[#c2410c] border border-[#fed7aa] font-bold text-[15px] px-5 py-3.5 rounded-xl transition-all no-underline">
                            <span>Tìm hiểu hướng tiếp cận</span>
                            <i data-lucide="arrow-down" class="w-4 h-4 text-[#f97316]"></i>
                        </a>
                    </div>
                </div>

                <!-- Cột phải: Khung ảnh Double-Bezel ấm áp & 3 điểm tựa nền tảng -->
                <div class="lg:col-span-6">
                    <div class="hc-bezel-shell">
                        <div class="hc-bezel-core">
                            <div class="hc-card-bar"></div>
                            <div class="p-3 sm:p-4 bg-white">
                                <div class="overflow-hidden rounded-2xl border border-[#ffedd5] bg-[#fffaf5]">
                                    <img
                                        src="https://hieucontugoc.online/wp-content/uploads/2026/05/2.jpg"
                                        alt="Hiểu Con Từ Gốc - Thấu hiểu để đồng hành cùng con"
                                        class="w-full h-auto object-cover block"
                                        loading="eager"
                                    />
                                </div>

                                <div class="grid grid-cols-3 gap-2.5 pt-3.5 mt-3.5 border-t border-[#fff7ed] text-center">
                                    <div class="px-2 py-2.5 rounded-xl bg-[#fffaf5] border border-[#ffedd5]">
                                        <p class="text-[12px] sm:text-[13px] font-bold text-[#c2410c]">Tiêu hóa khỏe</p>
                                        <p class="text-[11px] text-stone-500 mt-0.5">Êm bụng & hấp thu tốt</p>
                                    </div>
                                    <div class="px-2 py-2.5 rounded-xl bg-[#fff7ed] border border-[#fed7aa]">
                                        <p class="text-[12px] sm:text-[13px] font-bold text-[#ea580c]">Dinh dưỡng đúng</p>
                                        <p class="text-[11px] text-stone-500 mt-0.5">Phù hợp cơ địa trẻ</p>
                                    </div>
                                    <div class="px-2 py-2.5 rounded-xl bg-[#fffaf5] border border-[#ffedd5]">
                                        <p class="text-[12px] sm:text-[13px] font-bold text-[#c2410c]">Não bộ & Hành vi</p>
                                        <p class="text-[11px] text-stone-500 mt-0.5">Ngủ sâu & tập trung</p>
                                    </div>
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
    <section id="goc-nhin-toan-dien" class="py-12 sm:py-16 lg:py-20 bg-[#fffaf5] border-b border-[#f5ebe1]">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider mb-3">
                    Góc nhìn khoa học
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-stone-800 mb-4">
                    Vì sao cần thấu hiểu cơ thể con từ gốc?
                </h2>
                <p class="hc-body-copy text-[15px] sm:text-[16px] text-stone-600">
                    Não bộ không hoạt động tách rời mà luôn gắn kết chặt chẽ với hệ tiêu hóa và chế độ dinh dưỡng hằng ngày. Khi cơ thể bên trong gặp trở ngại, con rất dễ mệt mỏi, khó ngủ và giảm khả năng tập trung.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Yếu tố 1 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="hc-icon-box">
                            <i data-lucide="activity" class="w-5 h-5"></i>
                        </span>
                        <span class="px-2.5 py-1 rounded-full bg-[#fff7ed] text-[#ea580c] text-xs font-extrabold tracking-wider">YẾU TỐ 01</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-2.5">Hệ tiêu hóa & hấp thu</h3>
                    <p class="hc-body-copy text-[14.5px] text-stone-600 flex-grow">
                        Các vấn đề như táo bón, đầy bụng, rối loạn tiêu hóa hay mất cân bằng hệ vi sinh đường ruột có thể tác động trực tiếp đến cảm xúc, giấc ngủ và sự thoải mái của trẻ qua trục Não – Ruột.
                    </p>
                </div>

                <!-- Yếu tố 2 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="hc-icon-box-solid">
                            <i data-lucide="apple" class="w-5 h-5"></i>
                        </span>
                        <span class="px-2.5 py-1 rounded-full bg-[#ffedd5] text-[#c2410c] text-xs font-extrabold tracking-wider">YẾU TỐ 02</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-2.5">Đáp ứng thực phẩm & cơ địa</h3>
                    <p class="hc-body-copy text-[14.5px] text-stone-600 flex-grow">
                        Mỗi em bé có một cơ địa riêng. Việc nhận diện sớm tình trạng kén ăn, dị ứng hoặc bất dung nạp thực phẩm giúp ba mẹ xây dựng thực đơn phù hợp để cơ thể con nhẹ nhàng và dễ chịu hơn.
                    </p>
                </div>

                <!-- Yếu tố 3 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="flex items-center justify-between mb-4">
                        <span class="hc-icon-box">
                            <i data-lucide="sparkles" class="w-5 h-5"></i>
                        </span>
                        <span class="px-2.5 py-1 rounded-full bg-[#fff7ed] text-[#ea580c] text-xs font-extrabold tracking-wider">YẾU TỐ 03</span>
                    </div>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-2.5">Cân bằng vi chất & năng lượng</h3>
                    <p class="hc-body-copy text-[14.5px] text-stone-600 flex-grow">
                        Thiếu hụt vi chất và dưỡng chất thiết yếu khiến trẻ chậm tăng trưởng và thiếu năng lượng. Bổ sung đúng và đủ chính là nền tảng nuôi dưỡng cả thể chất lẫn sự phát triển trí não.
                    </p>
                </div>
            </div>

            <!-- Thông điệp đúc kết -->
            <div class="mt-8 sm:mt-10 bg-[#fff7ed] border border-[#fed7aa] rounded-2xl p-5 sm:p-6 flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="flex items-center gap-3.5 text-left">
                    <span class="w-10 h-10 rounded-xl bg-white border border-[#fed7aa] text-[#f97316] flex items-center justify-center shrink-0 shadow-sm">
                        <i data-lucide="sun" class="w-5 h-5"></i>
                    </span>
                    <p class="hc-body-copy text-[15px] sm:text-[16px] text-stone-800 font-medium">
                        Khi <strong class="font-bold text-[#ea580c]">cơ thể bên trong khỏe mạnh và êm dịu</strong>, con sẽ có nền tảng vững vàng hơn để ngủ ngon, tập trung và tiếp thu tốt hơn.
                    </p>
                </div>
                <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="shrink-0 inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#c2410c] transition-colors no-underline">
                    <span>Tìm hiểu tình trạng của con</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         MÀN 3: PHƯƠNG PHÁP ĐỒNG HÀNH — KẾT HỢP CHĂM SÓC NỀN TẢNG & GIÁO DỤC
         ============================================================== -->
    <section id="phuong-phap" class="py-12 sm:py-16 lg:py-20 bg-white border-b border-[#f5ebe1]">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">

                <!-- Cột trái: Định hướng -->
                <div class="lg:col-span-5 space-y-4">
                    <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider">
                        Phương pháp đồng hành
                    </span>
                    <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-stone-800">
                        Kết hợp hài hòa giữa chăm sóc sức khỏe và giáo dục kỹ năng
                    </h2>
                    <p class="hc-body-copy text-[15px] sm:text-[16px] text-stone-600">
                        Chăm sóc dinh dưỡng, tiêu hóa và rèn luyện kỹ năng giáo dục là hai mảnh ghép bổ trợ mật thiết cho nhau trên hành trình đồng hành cùng con.
                    </p>
                    <div class="pl-4 border-l-4 border-[#f97316] py-1.5 bg-[#fffaf5] rounded-r-xl pr-3">
                        <p class="font-serif italic text-[15.5px] sm:text-[16.5px] text-[#c2410c] font-semibold">
                            "Nuôi dưỡng cơ thể khỏe mạnh để tạo đà cho con học hỏi, giao tiếp và đạt hiệu quả can thiệp tốt hơn."
                        </p>
                    </div>
                </div>

                <!-- Cột phải: 2 Mảnh ghép tông Cam ấm -->
                <div class="lg:col-span-7 grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <!-- Mảnh ghép 1 -->
                    <div class="hc-master-card flex flex-col">
                        <div class="hc-card-bar"></div>
                        <div class="p-6 flex flex-col flex-grow bg-white">
                            <div class="hc-icon-box mb-4">
                                <i data-lucide="heart-pulse" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#ea580c] mb-1">Nền tảng bên trong</span>
                            <h3 class="font-serif text-xl font-bold text-stone-800 mb-2.5">Dinh dưỡng & tiêu hóa</h3>
                            <p class="hc-body-copy text-[14.5px] text-stone-600 flex-grow">
                                Cải thiện tiêu hóa, xây dựng chế độ ăn phù hợp và ổn định giấc ngủ để cơ thể con khỏe khoắn, tinh thần thoải mái và sẵn sàng đón nhận bài học mới.
                            </p>
                        </div>
                    </div>

                    <!-- Mảnh ghép 2 -->
                    <div class="hc-master-card flex flex-col">
                        <div class="hc-card-bar"></div>
                        <div class="p-6 flex flex-col flex-grow bg-[#fffaf5]">
                            <div class="hc-icon-box-solid mb-4">
                                <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-wider text-[#ea580c] mb-1">Phát triển bên ngoài</span>
                            <h3 class="font-serif text-xl font-bold text-stone-800 mb-2.5">Giáo dục & kỹ năng</h3>
                            <p class="hc-body-copy text-[14.5px] text-stone-600 flex-grow">
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
    <section id="hoat-dong" class="py-12 sm:py-16 lg:py-20 bg-[#fffaf5] border-b border-[#f5ebe1]">
        <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8">

            <div class="max-w-3xl mx-auto text-center mb-10 sm:mb-12">
                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider mb-3">
                    Hệ sinh thái nội dung
                </span>
                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl lg:text-4xl font-bold text-stone-800 mb-3">
                    Không gian đồng hành cùng ba mẹ mỗi ngày
                </h2>
                <p class="hc-body-copy text-[15px] sm:text-[16px] text-stone-600">
                    Hệ thống bài viết, cẩm nang và lịch tư vấn được sắp xếp rõ ràng, dễ hiểu để ba mẹ dễ dàng áp dụng ngay tại nhà.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-5 sm:gap-6">
                <!-- Trụ cột 1: Kiến thức -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="hc-icon-box mb-4">
                        <i data-lucide="book-open" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#ea580c] mb-1">Chuyên mục kiến thức</p>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-3">Tìm hiểu kiến thức nền tảng</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-stone-600 mb-6 flex-grow">
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
                    <a href="<?php echo esc_url( home_url( '/bai-viet-kien-thuc/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#c2410c] transition-colors no-underline">
                        <span>Xem chuyên mục bài viết</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Trụ cột 2: Cẩm nang -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="hc-icon-box-solid mb-4">
                        <i data-lucide="library" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#ea580c] mb-1">Thư viện thực hành</p>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-3">Cẩm nang hướng dẫn từng bước</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-stone-600 mb-6 flex-grow">
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Cẩm nang cải thiện tình trạng kén ăn, táo bón và rối loạn tiêu hóa.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Hướng dẫn thiết lập thói quen sinh hoạt và kỹ năng tự lập tại nhà.</span>
                        </li>
                        <li class="flex items-start gap-2.5">
                            <span class="w-1.5 h-1.5 rounded-full bg-[#f97316] mt-2 shrink-0"></span>
                            <span>Trình bày trực quan theo từng chương mục để ba mẹ tra cứu nhanh.</span>
                        </li>
                    </ul>
                    <a href="<?php echo esc_url( home_url( '/docs/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#c2410c] transition-colors no-underline">
                        <span>Khám phá thư viện cẩm nang</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>

                <!-- Trụ cột 3: Tư vấn 1:1 -->
                <div class="hc-sub-card p-6 sm:p-7 flex flex-col">
                    <div class="hc-icon-box mb-4">
                        <i data-lucide="message-circle-heart" class="w-5 h-5"></i>
                    </div>
                    <p class="text-xs font-bold uppercase tracking-wider text-[#ea580c] mb-1">Đồng hành trực tiếp</p>
                    <h3 class="font-serif text-xl font-bold text-stone-800 mb-3">Tư vấn dinh dưỡng 1:1</h3>
                    <ul class="space-y-2.5 text-[14.5px] text-stone-600 mb-6 flex-grow">
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
                    <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#ea580c] hover:text-[#c2410c] transition-colors no-underline">
                        <span>Đăng ký lịch tư vấn 1:1</span>
                        <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                </div>
            </div>

        </div>
    </section>

    <!-- ==============================================================
         MÀN 5: GIÁ TRỊ CỐT LÕI & QUÀ TẶNG 30 LỊCH TƯ VẤN (100% TÔNG CAM ẤM)
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
                                <span class="inline-flex items-center gap-1.5 px-3.5 py-1 rounded-full bg-[#fff7ed] border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider mb-2.5">
                                    Giá trị hướng tới
                                </span>
                                <h2 class="hc-sec-title font-serif text-2xl sm:text-3xl font-bold text-stone-800">
                                    Mục tiêu của cộng đồng Hiểu Con Từ Gốc
                                </h2>
                            </div>

                            <div class="space-y-3.5">
                                <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-[#fffaf5] border border-[#ffedd5]">
                                    <span class="w-7 h-7 rounded-lg bg-[#f97316] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-sm">01</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-stone-700">
                                        <strong class="font-bold text-stone-800">Ba mẹ thấu hiểu & chủ động:</strong> Trang bị kiến thức thiết thực để ba mẹ tự tin trở thành người bạn đồng hành hiểu con nhất ngay tại gia đình.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-[#fffaf5] border border-[#ffedd5]">
                                    <span class="w-7 h-7 rounded-lg bg-[#f97316] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-sm">02</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-stone-700">
                                        <strong class="font-bold text-stone-800">Chăm sóc sức khỏe nền tảng:</strong> Lan tỏa góc nhìn tích cực rằng một hệ tiêu hóa êm dịu và dinh dưỡng cân bằng sẽ nâng đỡ sự phát triển trí não của trẻ.
                                    </p>
                                </div>

                                <div class="flex items-start gap-3.5 p-4 rounded-2xl bg-[#fffaf5] border border-[#ffedd5]">
                                    <span class="w-7 h-7 rounded-lg bg-[#f97316] text-white font-bold text-xs flex items-center justify-center shrink-0 mt-0.5 shadow-sm">03</span>
                                    <p class="hc-body-copy text-[14.5px] sm:text-[15px] text-stone-700">
                                        <strong class="font-bold text-stone-800">Điểm tựa sẻ chia & bền bỉ:</strong> Xây dựng môi trường văn minh, ấm áp, nơi các gia đình cùng nhau kiên trì áp dụng giải pháp mỗi ngày.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Cột phải: Khung quà tặng tư vấn 1:1 tông Cam đào ấm áp (thay cho hộp màu đen cũ) -->
                        <div class="lg:col-span-5">
                            <div class="rounded-2xl bg-gradient-to-br from-[#fff7ed] via-[#ffedd5]/75 to-[#fff7ed] border-2 border-[#fdba74] p-6 sm:p-7 space-y-4 shadow-[0_18px_40px_-20px_rgba(249,115,22,0.22)]">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-white border border-[#fed7aa] text-[#ea580c] text-xs font-bold uppercase tracking-wider">
                                    <i data-lucide="gift" class="w-3.5 h-3.5"></i>
                                    Quà tặng dành cho ba mẹ
                                </span>
                                <h3 class="font-serif text-xl sm:text-2xl font-bold text-stone-800 leading-snug">
                                    Dành tặng 30 lịch tư vấn dinh dưỡng 1:1 trong 30 phút
                                </h3>
                                <p class="text-[14.5px] text-stone-600 leading-relaxed">
                                    Dành cho các bé đang gặp vấn đề về kén ăn, dị ứng, bất dung nạp thực phẩm, táo bón, rối loạn tiêu hóa hoặc chậm tăng trưởng.
                                </p>
                                <div class="pt-1">
                                    <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="w-full inline-flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold text-[15px] px-5 py-3.5 rounded-xl shadow-[0_12px_24px_-8px_rgba(249,115,22,0.45)] transition-all no-underline">
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
