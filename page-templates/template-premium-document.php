<?php
/**
 * Template Name: Trang Tài Liệu Premium
 * Template Post Type: post, page, course, ebook
 * Description: Template tài liệu y sinh cao cấp, giao diện hiện đại sạch sẽ, thanh mục lục bám sát ngoài container.
 */

get_header();

// Setup variables/styles
?>
<style>
    /* Hide theme header navigation and footer colophon visually */
    #main-header, 
    header.site-header,
    header.bg-navy,
    #colophon,
    footer {
        display: none !important;
    }
    
    body.has-sticky-header, 
    body {
        padding-top: 0 !important;
        background-color: #ffefd4 !important;
    }

    /* Styling for the premium document */
    .premium-doc-wrap {
        background: #ffefd4;
        color: #0F172A;
        /* navy */
        font-family: 'Nunito', sans-serif;
    }

    .glass-document-card {
        background: transparent;
        border: none;
        box-shadow: none;
    }

    /* Premium Content Typography Styling to override Tailwind Preflight reset */
    .premium-document-content h2 {
        font-family: 'Lora', serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: #0F172A;
        margin-top: 2.5rem;
        margin-bottom: 1.25rem;
        line-height: 1.35;
        border-bottom: 2px solid rgba(249, 115, 22, 0.1);
        padding-bottom: 0.5rem;
    }

    @media (min-width: 640px) {
        .premium-document-content h2 {
            font-size: 1.75rem;
        }
    }

    .premium-document-content h3 {
        font-family: 'Lora', serif;
        font-size: 1.25rem;
        font-weight: 750;
        color: #0F172A;
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.4;
    }

    @media (min-width: 640px) {
        .premium-document-content h3 {
            font-size: 1.38rem;
        }
    }

    .premium-document-content h4 {
        font-family: 'Lora', serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #0F172A;
        margin-top: 1.75rem;
        margin-bottom: 0.75rem;
        line-height: 1.4;
    }

    @media (min-width: 640px) {
        .premium-document-content h4 {
            font-size: 1.15rem;
        }
    }

    .premium-document-content p {
        font-size: 0.95rem;
        line-height: 1.8;
        color: rgba(15, 23, 42, 0.8);
        margin-top: 0;
        margin-bottom: 1.25rem;
    }

    @media (min-width: 640px) {
        .premium-document-content p {
            font-size: 1rem;
        }
    }

    .premium-document-content ul,
    .premium-document-content ol {
        margin-top: 0;
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }

    .premium-document-content ul {
        list-style-type: disc !important;
    }

    .premium-document-content ol {
        list-style-type: decimal !important;
    }

    .premium-document-content li {
        margin-bottom: 0.6rem;
        line-height: 1.7;
        color: rgba(15, 23, 42, 0.8);
        font-size: 0.95rem;
    }

    @media (min-width: 640px) {
        .premium-document-content li {
            font-size: 1rem;
        }
    }

    .premium-document-content blockquote {
        position: relative;
        border-left: 5px solid #f89202;
        background: rgba(255, 255, 255, 0.7) !important;
        padding: 1.25rem 1.5rem 1.25rem 3.5rem;
        margin: 2rem 0;
        border-radius: 4px 16px 16px 4px;
        font-style: italic;
        color: rgba(15, 23, 42, 0.9);
        box-shadow: 0 10px 30px -15px rgba(248, 146, 2, 0.08);
    }

    .premium-document-content blockquote::before {
        content: "“";
        position: absolute;
        left: 1.25rem;
        top: 0.5rem;
        font-size: 3.5rem;
        font-family: 'Lora', serif;
        color: #f89202;
        opacity: 0.45;
        line-height: 1;
    }

    .premium-document-content blockquote p {
        margin: 0;
    }

    .premium-document-content strong {
        color: #0F172A;
        font-weight: 700;
    }

    .premium-document-content a {
        color: #f97316;
        text-decoration: underline;
        font-weight: 600;
        transition: color 0.2s ease-in-out;
    }

    .premium-document-content a:hover {
        color: #ea580c;
    }


    /* Custom Scrollbar for TOC */
    .custom-toc-scroll::-webkit-scrollbar {
        width: 4px;
    }

    .custom-toc-scroll::-webkit-scrollbar-track {
        background: transparent;
    }

    .custom-toc-scroll::-webkit-scrollbar-thumb {
        background: rgba(15, 23, 42, 0.15);
        border-radius: 4px;
    }

    .custom-toc-scroll::-webkit-scrollbar-thumb:hover {
        background: rgba(15, 23, 42, 0.3);
    }

    /* Dynamic TOC offsets and states */
    #dynamic-toc a {
        transition: all 0.2s ease-in-out;
    }

    #dynamic-toc a.toc-active {
        color: #f97316;
        /* secondary */
        font-weight: 700;
        padding-left: 0.75rem;
        border-left: 2px solid #f97316;
    }

    /* Subtle Twinkle & Glow Animations for Magical Theme */
    @keyframes twinkle {
        0%, 100% { opacity: 0.25; transform: scale(0.8) rotate(0deg); }
        50% { opacity: 1; transform: scale(1.15) rotate(180deg); }
    }
    
    .animate-twinkle {
        animation: twinkle 5s ease-in-out infinite;
    }
    
    .animate-twinkle-delay-1 {
        animation: twinkle 5s ease-in-out infinite;
        animation-delay: 1.5s;
    }
    
    .animate-twinkle-delay-2 {
        animation: twinkle 5s ease-in-out infinite;
        animation-delay: 3.2s;
    }

    /* Magical Shimmer Text & Background Glow */
    @keyframes shimmerText {
        0% { background-position: 0% center; }
        100% { background-position: 200% center; }
    }

    @keyframes breathingGlow {
        0%, 100% { opacity: 0.55; transform: translate(-50%, -50%) scale(0.95); }
        50% { opacity: 0.95; transform: translate(-50%, -50%) scale(1.05); }
    }

    .magic-shimmer-title {
        background: linear-gradient(to right, #0F172A 15%, #f89202 35%, #fcd34d 50%, #f89202 65%, #0F172A 85%);
        background-size: 200% auto;
        color: transparent;
        -webkit-background-clip: text;
        background-clip: text;
        animation: shimmerText 6s linear infinite;
    }

    .magic-bg-glow {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        width: min(650px, 90vw);
        height: min(350px, 50vh);
        background: radial-gradient(circle, rgba(248, 146, 2, 0.15) 0%, rgba(255, 239, 212, 0) 70%);
        filter: blur(40px);
        border-radius: 50%;
        pointer-events: none;
        z-index: -1;
        animation: breathingGlow 8s ease-in-out infinite;
    }
</style>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
        ?>
        <div class="premium-doc-wrap pt-24 pb-20 md:pt-32 md:pb-28 relative">
            
            <!-- WATERMARK LOGO ẨN CHÌM TRÊN BACKGROUND -->
            <div class="pointer-events-none fixed top-[400px] left-0 right-0 z-0 opacity-[0.5] flex justify-center">
                <img src="<?php echo esc_url(get_stylesheet_directory_uri() . '/assets/images/pattern-hieu-con.png'); ?>" alt="Hiểu Con Từ Gốc Logo Pattern" class="w-[500px] sm:w-[700px] md:w-[800px] h-auto object-contain">
            </div>

            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

                    <?php
                    $subtitle = get_post_meta(get_the_ID(), 'subtitle', true);
                    if (empty($subtitle)) {
                        $subtitle = 'Hiểu con từ gốc';
                    }

                    $meta_desc = get_post_meta(get_the_ID(), 'meta_description', true);
                    if (empty($meta_desc)) {
                        $meta_desc = get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true);
                    }
                    if (empty($meta_desc)) {
                        $meta_desc = get_post_meta(get_the_ID(), 'rank_math_description', true);
                    }
                    if (empty($meta_desc)) {
                        $meta_desc = has_excerpt() ? get_the_excerpt() : 'Tài liệu hướng dẫn thực hành y sinh và phục hồi sức khỏe toàn diện cho trẻ đặc biệt. Vui lòng làm theo các hướng dẫn chi tiết bên dưới để đạt hiệu quả tốt nhất.';
                    }
                    ?>
                    <!-- HERO SECTION (Tiêu đề và Mô tả nằm trên cùng bài viết, rộng bằng container) -->
                    <header class="w-full text-center pb-12 md:pb-16 border-b border-navy/10 relative z-10">
                        
                        <!-- Premium Brand Icon Badge -->
                        <div class="relative inline-flex items-center justify-center w-12 h-12 rounded-full bg-[#f89202]/10 text-[#f89202] mb-4">
                            <i data-lucide="book-open" class="w-5 h-5"></i>
                            
                            <!-- Mini Sparkles around badge -->
                            <span class="absolute -top-1 -right-1 text-[#f89202] animate-twinkle">
                                <i data-lucide="sparkle" class="w-3.5 h-3.5"></i>
                            </span>
                            <span class="absolute -bottom-1 -left-1 text-[#f89202] animate-twinkle-delay-1">
                                <i data-lucide="sparkles" class="w-3 h-3"></i>
                            </span>
                        </div>
                        
                        <span class="block text-xs font-extrabold uppercase tracking-[0.25em] text-[#f89202] mb-3">
                            <?php echo esc_html($subtitle); ?>
                        </span>

                        <div class="relative max-w-5xl mx-auto">
                            <!-- Magical breathing background glow orb -->
                            <div class="magic-bg-glow"></div>

                            <!-- Floating Sparkle elements left and right of the title (desktop only) -->
                            <div class="hidden md:block absolute -left-10 top-1/2 -translate-y-1/2 text-[#f89202]/40 animate-twinkle">
                                <i data-lucide="sparkles" class="w-6 h-6"></i>
                            </div>
                            <div class="hidden md:block absolute -right-10 top-1/3 -translate-y-1/2 text-[#f89202]/50 animate-twinkle-delay-2">
                                <i data-lucide="sparkle" class="w-5 h-5"></i>
                            </div>
                            
                            <h1 class="font-serif text-3xl sm:text-4xl md:text-5xl lg:text-5xl xl:text-6xl font-black leading-[1.3] py-2 mb-6 tracking-tight magic-shimmer-title">
                                <?php the_title(); ?>
                            </h1>
                        </div>

                        <!-- Decorative Divider -->
                        <div class="flex items-center justify-center gap-3 my-6">
                            <span class="w-8 h-[2px] bg-[#f89202]/20"></span>
                            <i data-lucide="sparkles" class="w-4 h-4 text-[#f89202]/45"></i>
                            <span class="w-8 h-[2px] bg-[#f89202]/20"></span>
                        </div>

                        <p class="text-base sm:text-lg md:text-xl text-navy/60 leading-relaxed max-w-3xl font-medium mx-auto m-0">
                            <?php echo esc_html($meta_desc); ?>
                        </p>
                    </header>

                    <!-- THÂN BÀI VIẾT (Bao gồm Content và Sidebar Widget song hành) -->
                    <div class="relative w-full mt-10">

                        <main class="w-full">
                            <article class="glass-document-card w-full py-4 lg:py-6">

                        <!-- PHẦN NỘI DUNG CHÍNH -->
                        <div class="premium-document-content">

                            <?php
                            // Lấy nội dung trang
                            $content = get_the_content();

                            if (!empty(trim($content))):
                                // Nạp nội dung người dùng nhập từ admin
                                the_content();
                            else:
                                // FALLBACK DEMO: Giao diện mẫu tài liệu cực kỳ đẹp mắt nếu trang trống
                                ?>

                                <!-- Khối mở đầu thu hút -->
                                <p class="text-lg text-navy/80 leading-relaxed font-medium">
                                    Chào mừng quý phụ huynh đến với cẩm nang hướng dẫn chuyên biệt. Nội dung dưới đây là bản mô
                                    phỏng trực quan các cấu trúc khối giao diện (UI blocks) cao cấp. Quý phụ huynh có thể tham khảo
                                    trực tiếp cách thiết kế này để tùy chỉnh bài viết của mình nổi bật và dễ tiếp cận hơn.
                                </p>

                                <blockquote>
                                    "Mọi thay đổi trong hành vi của con đều phản ánh một sự xáo trộn sinh học sâu sắc bên trong cơ
                                    thể. Hãy lắng nghe con từ gốc rễ."
                                </blockquote>

                                <!-- BLOCK 1: TÓM TẮT CỐT LÕI (KEY TAKEAWAYS) -->
                                <h2 id="tom-tat-cot-loi">1. Tóm tắt cốt lõi (Key Takeaways)</h2>
                                <p>Before going deep into complex medical details, here are 3 key points you should keep in mind to
                                    support your child correctly:</p>

                                <div
                                    class="bg-emerald-50/70 border border-emerald-100 rounded-[2rem] p-6 sm:p-8 my-6 shadow-soft relative overflow-hidden">
                                    <div class="absolute -right-8 -bottom-8 opacity-5 text-emerald-950">
                                        <i data-lucide="sparkles" class="w-36 h-36"></i>
                                    </div>
                                    <h4 class="font-serif font-bold text-emerald-900 text-lg mb-4 flex items-center gap-2">
                                        <span class="p-1.5 bg-emerald-500 rounded-lg text-white"><i data-lucide="bookmark-check"
                                                class="w-4 h-4"></i></span>
                                        Những điều cần lưu ý hàng đầu
                                    </h4>
                                    <ul class="space-y-3.5 text-sm sm:text-base font-medium text-emerald-800/90 list-none pl-0">
                                        <li class="flex items-start gap-2.5">
                                            <i data-lucide="check" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                                            <span><strong>Thay thế, không cắt bỏ đột ngột:</strong> Khi điều chỉnh thực phẩm (như
                                                sữa, bột mì), hãy tìm các giải pháp thay thế dinh dưỡng tương đương để tránh làm con
                                                hụt hẫng.</span>
                                        </li>
                                        <li class="flex items-start gap-2.5">
                                            <i data-lucide="check" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                                            <span><strong>Hệ tiêu hóa là bộ não thứ hai:</strong> Khôi phục niêm mạc ruột và hệ vi
                                                sinh là bước đệm tiên quyết để giảm căng thẳng thần kinh ở trẻ đặc biệt.</span>
                                        </li>
                                        <li class="flex items-start gap-2.5">
                                            <i data-lucide="check" class="w-5 h-5 text-emerald-600 shrink-0 mt-0.5"></i>
                                            <span><strong>Quan sát chu kỳ biểu hiện:</strong> Ghi nhật ký ăn uống và hành vi trong
                                                ít nhất 2 tuần để nhận diện chính xác các tác nhân dị ứng ẩn.</span>
                                        </li>
                                    </ul>
                                </div>

                                <!-- BLOCK 2: GRID CARD NGUYÊN NHÂN (INFOGRAPHIC GRID) -->
                                <h2 id="nguyen-nhan-y-sinh">2. Nguyên nhân y sinh cốt lõi</h2>
                                <p>Việc khơi thông dòng năng lượng và giảm thiểu các rào cản sinh học giúp cơ thể con tự chữa lành.
                                    Có 3 tác nhân y sinh lớn mà chúng tôi ghi nhận thông qua thực tế lâm sàng:</p>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 my-8">

                                    <!-- Card 1 -->
                                    <div
                                        class="bg-white p-6 rounded-3xl border border-slate-100 shadow-soft premium-ui-card flex flex-col">
                                        <div
                                            class="w-12 h-12 bg-primary/10 text-primary rounded-2xl flex items-center justify-center text-xl mb-5">
                                            <i data-lucide="activity-square" class="w-6 h-6"></i>
                                        </div>
                                        <h4 class="font-serif font-bold text-navy text-lg mb-2">Hệ Vi Sinh Bị Lệch</h4>
                                        <p class="text-navy/70 text-xs sm:text-sm leading-relaxed flex-grow">
                                            Sự phát triển quá mức của hại khuẩn (Clostridia, nấm men Candida) tạo ra các độc tố thần
                                            kinh làm trẻ bứt rứt, dễ nổi cáu.
                                        </p>
                                    </div>

                                    <!-- Card 2 -->
                                    <div
                                        class="bg-white p-6 rounded-3xl border border-slate-100 shadow-soft premium-ui-card flex flex-col">
                                        <div
                                            class="w-12 h-12 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-xl mb-5">
                                            <i data-lucide="shield-alert" class="w-6 h-6"></i>
                                        </div>
                                        <h4 class="font-serif font-bold text-navy text-lg mb-2">Hội Chứng Rò Rỉ Ruột</h4>
                                        <p class="text-navy/70 text-xs sm:text-sm leading-relaxed flex-grow">
                                            Các phân tử thức ăn chưa tiêu hóa hết lọt qua màng ruột vào máu, kích hoạt hệ thống miễn
                                            dịch tạo ra phản ứng viêm toàn thân.
                                        </p>
                                    </div>

                                    <!-- Card 3 -->
                                    <div
                                        class="bg-white p-6 rounded-3xl border border-slate-100 shadow-soft premium-ui-card flex flex-col">
                                        <div
                                            class="w-12 h-12 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-xl mb-5">
                                            <i data-lucide="brain-circuit" class="w-6 h-6"></i>
                                        </div>
                                        <h4 class="font-serif font-bold text-navy text-lg mb-2">Kém Methyl Hóa</h4>
                                        <p class="text-navy/70 text-xs sm:text-sm leading-relaxed flex-grow">
                                            Thiếu hụt gốc methyl cản trở quá trình giải độc tự nhiên của gan và ngăn cản quá trình
                                            tổng hợp chất dẫn truyền thần kinh.
                                        </p>
                                    </div>

                                </div>

                                <!-- BLOCK 3: TIẾN TRÌNH THỰC HIỆN (STEP TIMELINE) -->
                                <h2 id="lo-trinh-phuc-hoi">3. Lộ trình phục hồi 3 bước</h2>
                                <p>Không nên vội vã bổ sung quá nhiều vi chất khi lòng ruột con còn viêm. Hãy kiên trì thực hiện
                                    theo đúng tiến trình y khoa khoa học sau:</p>

                                <div class="space-y-6 my-8 pl-4 border-l-2 border-solid border-slate-200">

                                    <!-- Bước 1 -->
                                    <div class="relative pl-6">
                                        <div
                                            class="absolute -left-[27px] top-1.5 w-3 h-3 bg-secondary rounded-full border-4 border-solid border-white ring-4 ring-orange-100">
                                        </div>
                                        <span
                                            class="inline-block bg-orange-50 text-secondary text-[10px] font-bold px-2 py-0.5 rounded-full mb-1">BƯỚC
                                            1: LÀM SẠCH</span>
                                        <h4 class="font-bold text-base text-navy mt-1">Giảm tải dị ứng thực phẩm và độc chất</h4>
                                        <p class="text-xs sm:text-sm text-navy/70 leading-relaxed mt-1">
                                            Áp dụng chế độ ăn kiêng sữa động vật (Casein) và bột mì (Gluten) trong 3 - 6 tháng. Đồng
                                            thời lọc sạch nguồn nước và hạn chế phơi nhiễm hóa chất gia dụng.
                                        </p>
                                    </div>

                                    <!-- Bước 2 -->
                                    <div class="relative pl-6">
                                        <div
                                            class="absolute -left-[27px] top-1.5 w-3 h-3 bg-primary rounded-full border-4 border-solid border-white ring-4 ring-teal-100">
                                        </div>
                                        <span
                                            class="inline-block bg-teal-50 text-primary text-[10px] font-bold px-2 py-0.5 rounded-full mb-1">BƯỚC
                                            2: TÁI TẠO</span>
                                        <h4 class="font-bold text-base text-navy mt-1">Bổ sung Men tiêu hóa và Tái tạo niêm mạc</h4>
                                        <p class="text-xs sm:text-sm text-navy/70 leading-relaxed mt-1">
                                            Sử dụng các loại enzyme thực vật hỗ trợ phân giải thức ăn hoàn toàn. Cung cấp
                                            L-Glutamine, nước hầm xương để vá các lỗ rò rỉ tại đường ruột.
                                        </p>
                                    </div>

                                    <!-- Bước 3 -->
                                    <div class="relative pl-6">
                                        <div
                                            class="absolute -left-[27px] top-1.5 w-3 h-3 bg-indigo-500 rounded-full border-4 border-solid border-white ring-4 ring-indigo-100">
                                        </div>
                                        <span
                                            class="inline-block bg-indigo-50 text-indigo-600 text-[10px] font-bold px-2 py-0.5 rounded-full mb-1">BƯỚC
                                            3: TỐI ƯU HÓA</span>
                                        <h4 class="font-bold text-base text-navy mt-1">Hỗ trợ chu trình Methyl hóa và Vi chất hệ
                                            thần kinh</h4>
                                        <p class="text-xs sm:text-sm text-navy/70 leading-relaxed mt-1">
                                            Khi lòng ruột đã êm, bổ sung vitamin B12 (dạng Methylcobalamin), Axit Folinic và các
                                            co-factors cần thiết để đẩy mạnh nhận thức và ngôn ngữ của con.
                                        </p>
                                    </div>

                                </div>

                                <!-- BLOCK 4: BẢNG SO SÁNH (COMPARISON GRID) -->
                                <h2 id="huong-dan-dinh-duong">4. Hướng dẫn chọn thực phẩm</h2>
                                <p>Nhận diện đúng những gì nên ăn và cần tạm tránh sẽ giúp cắt đứt nguồn thức ăn của hại khuẩn gây
                                    viêm:</p>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 my-8">

                                    <!-- Cột Nên Chọn -->
                                    <div class="bg-emerald-50/30 p-6 rounded-3xl border border-emerald-100/50">
                                        <h4 class="font-serif font-bold text-emerald-800 text-base mb-4 flex items-center gap-2">
                                            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-600"></i>
                                            Nên ưu tiên sử dụng
                                        </h4>
                                        <ul class="space-y-3 text-xs sm:text-sm font-medium text-emerald-800/80 list-none pl-0">
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                                Các loại sữa hạt tự làm (Hạt hạnh nhân, hạt óc chó, hạt điều).
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                                Tinh bột thay thế (Gạo tẻ ngon, gạo lứt, khoai lang, sắn dây).
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                                Rau xanh hữu cơ đậm màu giàu folate tự nhiên.
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 shrink-0"></span>
                                                Nước hầm xương tự nhiên đun kỹ (bổ sung collagen).
                                            </li>
                                        </ul>
                                    </div>

                                    <!-- Cột Hạn Chế -->
                                    <div class="bg-rose-50/30 p-6 rounded-3xl border border-rose-100/50">
                                        <h4 class="font-serif font-bold text-rose-800 text-base mb-4 flex items-center gap-2">
                                            <i data-lucide="x-circle" class="w-5 h-5 text-rose-600"></i>
                                            Cần hạn chế hoặc kiêng
                                        </h4>
                                        <ul class="space-y-3 text-xs sm:text-sm font-medium text-rose-800/80 list-none pl-0">
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                                Sữa bò công nghiệp & các sản phẩm từ sữa bò (phô mai, váng sữa).
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                                Bột mì thông thường (bánh mì, mì tôm, bánh ngọt chứa gluten).
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                                Thực phẩm công nghiệp chứa chất bảo quản, màu nhân tạo.
                                            </li>
                                            <li class="flex items-center gap-2">
                                                <span class="w-1.5 h-1.5 rounded-full bg-rose-500 shrink-0"></span>
                                                Đường tinh luyện (nuôi hại khuẩn đường ruột rất mạnh).
                                            </li>
                                        </ul>
                                    </div>

                                </div>

                                <!-- BLOCK 5: ACCORDION HỎI ĐÁP (DETAILS FAQ) -->
                                <h2 id="giai-dap-thac-mac">5. Câu hỏi thường gặp (FAQ)</h2>
                                <p>Dưới đây là một số câu hỏi phổ biến nhất của cha mẹ khi mới bắt đầu hành trình phục hồi y sinh:
                                </p>

                                <div class="space-y-4 my-8">

                                    <details
                                        class="group bg-white rounded-2xl border border-slate-100 p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-soft transition-all duration-300">
                                        <summary
                                            class="flex justify-between items-center font-bold text-sm sm:text-base text-navy list-none">
                                            <span>Kiêng sữa bò và bột mì thì con có bị thiếu chất không?</span>
                                            <span class="transition group-open:rotate-180 text-secondary">
                                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                            </span>
                                        </summary>
                                        <p
                                            class="text-xs sm:text-sm text-navy/70 leading-relaxed mt-3 pt-3 border-t border-slate-100 m-0">
                                            Không. Canxi và Protein trong sữa hoàn toàn có thể thay thế bằng tôm cua, cá nhỏ, các
                                            loại hạt dinh dưỡng lành tính. Carb trong bột mì có thể thay bằng khoai, gạo ngon. Sự
                                            thiếu hụt chỉ xảy ra khi cha mẹ cắt giảm hoàn toàn mà không bù đắp bằng thực phẩm thay
                                            thế hợp lý.
                                        </p>
                                    </details>

                                    <details
                                        class="group bg-white rounded-2xl border border-slate-100 p-4 [&_summary::-webkit-details-marker]:hidden cursor-pointer shadow-soft transition-all duration-300">
                                        <summary
                                            class="flex justify-between items-center font-bold text-sm sm:text-base text-navy list-none">
                                            <span>Mất bao lâu để thấy sự cải thiện đầu tiên ở con?</span>
                                            <span class="transition group-open:rotate-180 text-secondary">
                                                <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                            </span>
                                        </summary>
                                        <p
                                            class="text-xs sm:text-sm text-navy/70 leading-relaxed mt-3 pt-3 border-t border-slate-100 m-0">
                                            Thông thường, sau khi kiêng triệt để Gluten và Casein từ 2 - 4 tuần, cơ thể con bắt đầu
                                            giảm viêm. Dấu hiệu cải thiện đầu tiên thường là giấc ngủ sâu hơn, phân đều đặn hơn và
                                            giảm rõ rệt các cơn gào khóc vô cớ.
                                        </p>
                                    </details>

                                </div>

                                <!-- BLOCK 6: WARNING BOX (ĐỎ/CẢNH BÁO) -->
                                <div class="rounded-2xl p-6 md:p-8 text-left transition-all border border-solid my-10" style="background: linear-gradient(135deg, rgba(254, 242, 242, 0.6) 0%, rgba(254, 244, 244, 0.3) 100%); 
                                    border-color: rgba(239, 68, 68, 0.15); 
                                    border-left-width: 5px; 
                                    border-left-color: #ef4444;
                                    box-shadow: 0 10px 25px -5px rgba(220, 38, 38, 0.03);">

                                    <h3 class="font-bold text-sm md:text-base mb-4 flex items-center gap-3 uppercase tracking-wider"
                                        style="color: #be123c; margin-top:0; font-family:'Lora', serif;">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-full"
                                            style="background: rgba(239, 68, 68, 0.1); color: #be123c;">
                                            <i data-lucide="alert-triangle" class="w-4.5 h-4.5"></i>
                                        </span>
                                        Lưu ý y tế quan trọng
                                    </h3>

                                    <div class="text-xs sm:text-sm leading-relaxed font-bold mb-4" style="color: #9f1239;">
                                        Các thông tin hướng dẫn trên đây mang tính chất tham khảo kiến thức y sinh học chung cho
                                        cộng đồng. Cha mẹ không tự ý sử dụng các loại thuốc bổ sung vi chất liều cao mà không có sự
                                        đồng hành và hướng dẫn tầm soát chỉ số từ chuyên gia hoặc cơ sở y tế phù hợp.
                                    </div>
                                </div>

                            <?php endif; ?>

                        </div>
                    </article>
                </main>

                <!-- CỘT 1: SIDEBAR / WIDGET (Đặt tuyệt đối bên ngoài container 1400px ở góc trái trên Desktop) -->
                <aside
                    class="hidden lg:block lg:absolute lg:right-full lg:top-0 lg:bottom-0 lg:mr-8 lg:w-[280px] xl:w-[300px] z-20">
                    <div class="lg:sticky lg:top-[100px] space-y-6">

                        <!-- Mục lục động (Nền trơn, không viền, không bóng) -->
                        <div class="py-4 border-b border-navy/5">
                            <h4 class="font-serif font-bold text-lg text-navy mb-4 flex items-center gap-2">
                                <i data-lucide="list-collapse" class="w-5 h-5 text-secondary"></i> Mục lục tài liệu
                            </h4>
                            <nav id="dynamic-toc"
                                class="custom-toc-scroll text-[13px] font-medium text-navy/70 max-h-[50vh] overflow-y-auto pr-1 space-y-3.5">
                                <!-- Tự động sinh ra bằng Javascript bên dưới -->
                                <div id="toc-placeholder" class="text-xs italic text-navy/40">Đang quét mục lục...</div>
                            </nav>
                        </div>

                        <!-- Thẻ kêu gọi hành động (CTA) Facebook Group (Nền trơn, không viền, không bóng) -->
                        <div class="py-4 border-b border-navy/5 group">
                            <div class="w-full aspect-[16/9] rounded-2xl overflow-hidden bg-navy/5 mb-4">
                                <img src="https://hieucontugoc.online/wp-content/uploads/2026/05/4.jpg"
                                    alt="Cộng đồng Hiểu Con Từ Gốc"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            </div>
                            <h5 class="font-serif font-bold text-lg mb-2 text-navy">Cùng trao đổi & chia sẻ</h5>
                            <p class="text-navy/70 text-xs font-medium leading-relaxed mb-4">
                                Nhận sự đồng hành y sinh từ hàng ngàn cha mẹ đặc biệt tại cộng đồng Hiểu Con Từ Gốc.
                            </p>
                            <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                                rel="noopener noreferrer"
                                class="inline-flex items-center gap-2 bg-[#f89202] hover:bg-[#ea580c] text-white font-bold py-2.5 px-5 rounded-full text-xs transition-all w-full justify-center no-underline">
                                Hiểu Con Từ Gốc
                                <i data-lucide="arrow-right" class="w-4 h-4"></i>
                            </a>
                        </div>

                    </div>
                </aside>
            </div> <!-- Closes relative content wrapper -->
        </div> <!-- Closes max-w-[1400px] -->
        
        <!-- FLOATING BRAND BADGE (sticky in bottom right) -->
        <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" 
           class="fixed bottom-6 right-6 z-50 inline-flex items-center gap-2 bg-[#f89202] hover:bg-[#ea580c] text-white font-bold py-3 px-5 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 text-xs tracking-wider uppercase no-underline">
            <i data-lucide="users" class="w-4 h-4"></i>
            Hiểu Con Từ Gốc
        </a>
    </div> <!-- Closes premium-doc-wrap -->
        <?php
    endwhile;
endif;
?>

<!-- JAVASCRIPT XỬ LÝ MỤC LỤC ĐỘNG VÀ ĐỒNG BỘ CUỘN -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // 1. Quét tiêu đề
        const contentArea = document.querySelector('.premium-document-content');
        const tocContainer = document.getElementById('dynamic-toc');

        if (contentArea && tocContainer) {
            // Tìm toàn bộ thẻ H2 và H3 trong bài viết
            const headings = contentArea.querySelectorAll('h2, h3');

            if (headings.length === 0) {
                tocContainer.innerHTML = '<div class="text-xs italic text-navy/40">Tài liệu không có đề mục chính.</div>';
                return;
            }

            // Clear placeholder
            tocContainer.innerHTML = '';

            const mainUl = document.createElement('ul');
            mainUl.className = 'space-y-4';

            let currentH2Li = null;
            let currentH3Ul = null;
            const headingList = [];

            headings.forEach((heading, index) => {
                // Tự tạo ID nếu heading chưa có ID
                if (!heading.id) {
                    const cleanSlug = heading.textContent.toLowerCase()
                        .normalize("NFD").replace(/[\u0300-\u036f]/g, "") // Xóa dấu tiếng Việt
                        .replace(/[^a-z0-9 ]/g, "")
                        .replace(/\s+/g, '-');
                    heading.id = cleanSlug || ('sec-' + index);
                }

                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;
                a.className = 'block text-navy/70 hover:text-secondary transition-all leading-relaxed duration-200 line-clamp-2 no-underline';

                if (heading.tagName.toLowerCase() === 'h2') {
                    // Tạo wrapper li cho H2 và danh sách H3 con
                    const li = document.createElement('li');
                    li.className = 'toc-h2-item';
                    
                    a.className += ' font-bold text-[14px] toc-h2-link';
                    li.appendChild(a);

                    // Tạo sub-list chứa các đề mục H3
                    const subUl = document.createElement('ul');
                    subUl.className = 'toc-h3-list hidden space-y-2.5 mt-2.5 ml-1 border-l-2 border-navy/5 pl-3.5';
                    li.appendChild(subUl);

                    mainUl.appendChild(li);
                    
                    currentH2Li = li;
                    currentH3Ul = subUl;
                } else if (heading.tagName.toLowerCase() === 'h3') {
                    const li = document.createElement('li');
                    li.className = 'relative';
                    a.className += ' text-xs text-navy/55 toc-h3-link';
                    li.appendChild(a);

                    if (currentH3Ul) {
                        currentH3Ul.appendChild(li);
                    } else {
                        mainUl.appendChild(li);
                    }
                }

                // Lưu trữ để phục vụ theo dõi cuộn
                headingList.push({
                    element: heading,
                    link: a
                });
            });

            tocContainer.appendChild(mainUl);

            // Hàm đóng mở Accordion H2 mục lục
            function expandH2(h2Link) {
                if (!h2Link) return;
                
                const parentLi = h2Link.closest('.toc-h2-item');
                if (!parentLi) return;
                
                const targetH3List = parentLi.querySelector('.toc-h3-list');
                
                // Ẩn tất cả H3 của H2 khác
                tocContainer.querySelectorAll('.toc-h3-list').forEach(list => {
                    if (list !== targetH3List) {
                        list.classList.add('hidden');
                    }
                });
                
                // Hiển thị danh sách H3 của H2 hiện tại
                if (targetH3List && targetH3List.children.length > 0) {
                    targetH3List.classList.remove('hidden');
                }
            }

            // Cờ đánh dấu đang cuộn tự động (chặn scrollspy bắt nhầm khi đi qua các phần khác)
            let isProgrammaticScrolling = false;
            let scrollTimeout = null;
            let activeLink = null;

            // 2. Xử lý tương tác Click trên các đề mục mục lục
            const headerOffset = 150;
            tocContainer.querySelectorAll('a').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    
                    if (this.classList.contains('toc-h2-link')) {
                        // Click vào H2 chỉ đóng/mở danh sách con, KHÔNG cuộn trang!
                        expandH2(this);
                    } else if (this.classList.contains('toc-h3-link')) {
                        // Click vào H3 mới thực hiện cuộn trang tới nội dung chi tiết
                        const targetId = this.getAttribute('href').substring(1);
                        const targetElement = document.getElementById(targetId);

                        if (targetElement) {
                            // Bật flag chặn scrollspy
                            isProgrammaticScrolling = true;
                            clearTimeout(scrollTimeout);

                            // Đánh dấu active phần tử được click ngay lập tức
                            if (activeLink) {
                                activeLink.classList.remove('toc-active');
                            }
                            this.classList.add('toc-active');
                            activeLink = this;

                            // Mở rộng/Giữ nguyên trạng thái hiển thị của thư mục mẹ
                            const parentLi = this.closest('.toc-h2-item');
                            if (parentLi) {
                                const parentH2Link = parentLi.querySelector('.toc-h2-link');
                                expandH2(parentH2Link);
                            }

                            const elementPosition = targetElement.getBoundingClientRect().top;
                            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: 'smooth'
                            });

                            // Nhả flag sau khi hành động cuộn hoàn tất
                            scrollTimeout = setTimeout(() => {
                                isProgrammaticScrolling = false;
                            }, 850);
                        }
                    }
                });
            });

            // 3. Intersection Observer để theo dõi phần tử đang hiển thị và kích hoạt trạng thái Active trên menu
            const observerOptions = {
                root: null,
                rootMargin: '-160px 0px -60% 0px', // Quét phần tử xuất hiện ở vùng trên của màn hình
                threshold: 0
            };

            const observer = new IntersectionObserver(entries => {
                // Nếu đang cuộn tự động do click mục lục, chặn hoàn toàn scrollspy
                if (isProgrammaticScrolling) return;

                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const id = entry.target.getAttribute('id');
                        const targetLink = tocContainer.querySelector(`a[href="#${id}"]`);

                        if (targetLink) {
                            // Gỡ bỏ class active cũ
                            if (activeLink) {
                                activeLink.classList.remove('toc-active');
                            }
                            // Thêm class active mới
                            targetLink.classList.add('toc-active');
                            activeLink = targetLink;

                            // Tự động đóng mở mục lục theo trạng thái cuộn
                            if (targetLink.classList.contains('toc-h2-link')) {
                                expandH2(targetLink);
                            } else if (targetLink.classList.contains('toc-h3-link')) {
                                const parentLi = targetLink.closest('.toc-h2-item');
                                if (parentLi) {
                                    const parentH2Link = parentLi.querySelector('.toc-h2-link');
                                    expandH2(parentH2Link);
                                }
                            }

                            // Tự động cuộn mục lục nhỏ của sidebar nếu danh sách quá dài
                            const containerRect = tocContainer.getBoundingClientRect();
                            const linkRect = targetLink.getBoundingClientRect();
                            if (linkRect.top < containerRect.top || linkRect.bottom > containerRect.bottom) {
                                targetLink.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                            }
                        }
                    }
                });
            }, observerOptions);

            headings.forEach(heading => observer.observe(heading));
        }
    });
</script>

<!-- Tự động nạp Lucide Icons sau khi trang tải -->
<script>
    if (typeof lucide !== 'undefined') {
        lucide.createIcons();
    }
</script>

<?php
get_footer();
?>