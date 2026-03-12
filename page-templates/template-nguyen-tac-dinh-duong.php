<?php
/**
 * Template Name: Nguyên tắc Dinh dưỡng Phục Hồi Đường Ruột
 *
 * @package Hieucon
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nguyên tắc Dinh dưỡng Phục Hồi Đường Ruột</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        teal: {
                            50:  '#f0fdfa',
                            100: '#ccfbf1',
                            600: '#0d9488',
                            700: '#0f766e',
                            800: '#115e59',
                            900: '#134e4a',
                        },
                        amber: {
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: #1e293b; }
        h1, h2, h3, h4, h5 { font-family: 'Quicksand', sans-serif; }

        /* Reading progress */
        #reading-progress {
            position: fixed; top: 0; left: 0; height: 3px; width: 0%;
            background: linear-gradient(to right, #0f766e, #fbbf24);
            z-index: 9999; transition: width 0.1s linear;
        }

        /* Scroll animations */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(28px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.7s ease-out forwards; opacity: 0; }
        .anim.d1 { animation-delay: 80ms; }
        .anim.d2 { animation-delay: 180ms; }
        .anim.d3 { animation-delay: 280ms; }
        .anim.d4 { animation-delay: 380ms; }

        /* Card hover */
        .card-lift { transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s ease; }
        .card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 48px -10px rgba(15,118,110,0.18); }

        /* Tab active/inactive */
        .tab-active   { background: #0f766e; color: #fff; border-color: #0f766e; }
        .tab-inactive { background: #fff; color: #374151; border-color: #d1d5db; }
        .tab-inactive:hover { border-color: #0f766e; color: #0f766e; }

        /* Pill tabs */
        .pill-on  { background: #0f766e; color: #fff; }
        .pill-off { background: #f5f5f4; color: #57534e; }
        .pill-off:hover { background: #e7e5e4; }

        /* Chart */
        .chart-wrap { position: relative; width: 100%; height: 300px; max-height: 320px; }
        @media (max-width: 640px) { .chart-wrap { height: 220px; } }

        /* Floating badge */
        @keyframes float { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-10px); } }

        /* Section label */
        .section-label {
            display: inline-block;
            background: rgba(15,118,110,0.1);
            color: #0f766e;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 4px 14px;
            border-radius: 100px;
            margin-bottom: 12px;
        }
        .section-label.amber {
            background: rgba(217,119,6,0.1);
            color: #d97706;
        }

        /* Step connector */
        .step-line { position: relative; }
        .step-line::before {
            content: '';
            position: absolute;
            left: 27px;
            top: 56px;
            bottom: -24px;
            width: 2px;
            background: linear-gradient(to bottom, #0f766e33, transparent);
        }
        .step-line:last-child::before { display: none; }

        /* Fade for tab content */
        .fade-in { animation: fadeUp 0.35s ease-out; }
    </style>
    <?php wp_head(); ?>
</head>

<body class="bg-white text-slate-800 antialiased overflow-x-hidden">

<div id="reading-progress"></div>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  HERO                                                    -->
<!-- ═══════════════════════════════════════════════════════ -->
<header class="relative overflow-hidden" style="background: linear-gradient(135deg, #134e4a 0%, #0f766e 45%, #0d9488 100%);">

    <!-- Decorative circles -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-white/5 -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[380px] h-[380px] rounded-full bg-white/5 translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
    <!-- Floating icon -->
    <div class="absolute top-10 right-16 text-white/6 pointer-events-none hidden xl:block" style="animation: float 6s ease-in-out infinite; font-size: 200px;">
        <i class="fa-solid fa-seedling"></i>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-20 md:py-28 relative z-10 text-center">

        <!-- Badge -->
        <div class="anim inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/15 text-white font-semibold text-xs sm:text-sm mb-6 backdrop-blur-sm border border-white/20">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            HIỂU CON TỪ GỐC &nbsp;·&nbsp; Y SINH THỰC CHỨNG
        </div>

        <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
            Nguyên tắc Dinh dưỡng<br>
            <span class="text-amber-300">Giúp Phục hồi Đường ruột</span>
        </h1>

        <p class="text-base sm:text-lg md:text-xl text-teal-100 max-w-3xl mx-auto mb-10 leading-relaxed anim d2">
            Áp dụng dinh dưỡng y sinh để phục hồi hệ vi sinh, cung cấp vi chất tự nhiên và ổn định tinh thần thông qua <strong class="text-white">Thực phẩm toàn phần (Whole Foods)</strong>.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
            <a href="#tong-quan" class="bg-amber-400 hover:bg-amber-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                Khám phá ngay <i class="fa-solid fa-arrow-down animate-bounce"></i>
            </a>
            <a href="#lien-he" class="bg-white/15 hover:bg-white/25 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                Tôi cần hỗ trợ <i class="fa-solid fa-headset"></i>
            </a>
        </div>

        <!-- Stats Row -->
        <div class="mt-14 flex flex-wrap justify-center gap-4 anim d4">
            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl px-8 py-4 text-center">
                <div class="text-3xl font-extrabold text-amber-300 font-heading mb-0.5">3</div>
                <div class="text-xs text-teal-100 font-medium uppercase tracking-wider">Trụ cột<br>phục hồi</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl px-8 py-4 text-center">
                <div class="text-2xl font-extrabold text-amber-300 font-heading mb-0.5">GFCFSF</div>
                <div class="text-xs text-teal-100 font-medium uppercase tracking-wider">Nguyên tắc<br>ăn uống</div>
            </div>
            <div class="bg-white/10 backdrop-blur-sm border border-white/15 rounded-2xl px-8 py-4 text-center">
                <div class="text-3xl font-extrabold text-amber-300 font-heading mb-0.5">100%</div>
                <div class="text-xs text-teal-100 font-medium uppercase tracking-wider">Thực phẩm<br>tự nhiên</div>
            </div>
        </div>
    </div>

    <!-- Wave -->
    <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0] pointer-events-none">
        <svg class="relative block w-full h-[50px] md:h-[70px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
            <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#f8fafc"></path>
        </svg>
    </div>
</header>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 1: Tổng quan                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<section id="tong-quan" class="py-16 md:py-20 bg-slate-50">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

        <!-- Split layout: dark panel + light panel -->
        <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border border-slate-200 anim">
            <div class="lg:w-[45%] relative overflow-hidden p-8 sm:p-10 lg:p-12 flex flex-col justify-center" style="background: linear-gradient(135deg, #134e4a 0%, #0f766e 100%);">
                <div class="absolute -right-6 -bottom-6 text-white/8 text-[160px] pointer-events-none">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div class="relative z-10">
                    <span class="inline-flex items-center gap-2 bg-white/15 text-white text-xs font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-5">
                        <i class="fa-solid fa-circle-info text-amber-300"></i> Tổng quan
                    </span>
                    <h2 class="font-heading text-2xl sm:text-3xl font-bold text-white mb-5 leading-tight">Dinh dưỡng y sinh không đồng nghĩa với chi phí đắt đỏ</h2>
                    <p class="text-teal-100 leading-relaxed text-sm sm:text-base mb-6">
                        Khi hệ tiêu hóa bị viêm và quá tải do những thức ăn khó tiêu, cơ thể thường phản ứng bằng sự bứt rứt, kém tập trung. Đây là dấu hiệu cho thấy đường ruột đang phải tiếp nhận nguồn thức ăn không phù hợp.
                    </p>
                    <div class="bg-white/10 border border-white/15 rounded-xl p-4">
                        <div class="flex items-start gap-3">
                            <i class="fa-solid fa-star text-amber-400 mt-0.5 flex-shrink-0"></i>
                            <p class="text-teal-50 text-sm leading-relaxed">
                                Việc chăm sóc dinh dưỡng hoàn toàn có thể thực hiện bằng những <strong class="text-white">thực phẩm tự nhiên, quen thuộc tại địa phương</strong>. Hiểu đúng về cách cơ thể hấp thu dưỡng chất sẽ giúp tối ưu hóa chi phí, đồng thời phục hồi lớp niêm mạc ruột hiệu quả.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[55%] bg-white p-6 sm:p-8 flex flex-col justify-center">
                <h3 class="font-heading text-lg font-bold text-slate-700 mb-1">Biến thiên Đường huyết</h3>
                <p class="text-xs text-slate-400 mb-4">Carb tinh chế gây biến động mạnh — tạo môi trường cho Candida sinh độc tố Acetaldehyde</p>
                <div class="chart-wrap">
                    <canvas id="bloodSugarChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 2: 3 Trụ cột                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="py-16 md:py-20 bg-white relative overflow-hidden">
    <!-- Bg blobs -->
    <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-teal-50 blur-[80px] -translate-y-1/2 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[250px] h-[250px] rounded-full bg-amber-50 blur-[80px] translate-y-1/2 -translate-x-1/4 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
        <div class="text-center mb-12 anim">
            <span class="section-label">Ba trụ cột phục hồi</span>
            <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-slate-800 mb-3">
                Xây dựng nền tảng sức khỏe đường ruột
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-base sm:text-lg">
                Ba nguyên tắc cốt lõi để phục hồi tình trạng viêm và rò rỉ ruột — áp dụng theo thứ tự từ loại trừ đến bổ sung.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 lg:gap-8">

            <!-- Pillar 1 -->
            <div class="bg-white rounded-2xl lg:rounded-3xl overflow-hidden shadow-md border border-slate-200 card-lift group anim d1">
                <div class="py-5 px-7 flex items-center gap-4 relative overflow-hidden" style="background: linear-gradient(135deg, #be123c, #e11d48);">
                    <div class="absolute right-0 top-0 text-white/10 text-[80px] pointer-events-none"><i class="fa-solid fa-ban"></i></div>
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                        <span class="font-heading font-extrabold text-2xl" style="color:#e11d48">1</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-white relative z-10">Loại trừ Tác nhân</h3>
                </div>
                <div class="p-7">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 shadow-sm" style="background:#fff1f2">
                        <i class="fa-solid fa-circle-xmark text-2xl" style="color:#e11d48"></i>
                    </div>
                    <div class="inline-block bg-red-50 text-red-700 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">GFCFSF Protocol</div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Áp dụng chế độ <strong class="text-red-600">GFCFSF</strong> (Không lúa mì, Không sữa động vật, Không đậu nành). Những protein khó tiêu này khi lọt qua các khe hở trên thành ruột sẽ tạo ra các chất gây ảnh hưởng tiêu cực đến não bộ, dẫn đến rối loạn hành vi và khiến tình trạng viêm kéo dài.
                    </p>
                </div>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-2xl lg:rounded-3xl overflow-hidden shadow-md border border-slate-200 card-lift group anim d2">
                <div class="py-5 px-7 flex items-center gap-4 relative overflow-hidden" style="background: linear-gradient(135deg, #0369a1, #0ea5e9);">
                    <div class="absolute right-0 top-0 text-white/10 text-[80px] pointer-events-none"><i class="fa-solid fa-weight-scale"></i></div>
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                        <span class="font-heading font-extrabold text-2xl text-sky-600">2</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-white relative z-10">Giảm tải Áp lực</h3>
                </div>
                <div class="p-7">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 shadow-sm" style="background:#f0f9ff">
                        <i class="fa-solid fa-fire-flame-simple text-2xl text-sky-500"></i>
                    </div>
                    <div class="inline-block bg-sky-50 text-sky-700 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">Nấu chín kỹ</div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Ưu tiên thực phẩm được nấu chín kỹ (ninh, hầm) để thức ăn được mềm và dễ hấp thu. Điều này giúp giảm bớt gánh nặng cho dạ dày và tuyến tụy, đặc biệt ở những người đang bị thiếu hụt men tiêu hóa.
                    </p>
                </div>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-2xl lg:rounded-3xl overflow-hidden shadow-md border border-slate-200 card-lift group anim d3">
                <div class="py-5 px-7 flex items-center gap-4 relative overflow-hidden" style="background: linear-gradient(135deg, #0f766e, #0d9488);">
                    <div class="absolute right-0 top-0 text-white/10 text-[80px] pointer-events-none"><i class="fa-solid fa-plus"></i></div>
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                        <span class="font-heading font-extrabold text-2xl text-teal-700">3</span>
                    </div>
                    <h3 class="font-heading text-lg font-bold text-white relative z-10">Cung cấp Dưỡng chất</h3>
                </div>
                <div class="p-7">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center mb-4 shadow-sm" style="background:#f0fdfa">
                        <i class="fa-solid fa-capsules text-2xl text-teal-600"></i>
                    </div>
                    <div class="inline-block bg-teal-50 text-teal-700 text-xs font-bold px-3 py-1 rounded-full mb-3 uppercase tracking-wide">L-glutamine</div>
                    <p class="text-slate-600 text-sm leading-relaxed">
                        Lớp niêm mạc ruột cần được phục hồi liên tục. Cơ thể cần được cung cấp các axit amin (như <strong class="text-teal-700">L-glutamine</strong>), vitamin và khoáng chất tự nhiên để tự vá lại các tổn thương và duy trì các hoạt động chuyển hóa khỏe mạnh.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 3: Sinh hóa học                                -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="py-16 md:py-20" style="background:#f8fafc;">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="text-center mb-12 anim">
            <span class="section-label">Cơ sở khoa học</span>
            <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-slate-800 mb-3">
                Co-factor & Cơ chế Chuyển hóa
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-base sm:text-lg">
                Mỗi phản ứng sinh hóa trong cơ thể đều cần "chìa khóa" là các vi chất từ thực phẩm. Khám phá 3 hệ thống quan trọng nhất.
            </p>
        </div>

        <div class="bg-white rounded-2xl lg:rounded-3xl shadow-lg border border-slate-200 overflow-hidden anim d1">
            <div class="grid grid-cols-1 lg:grid-cols-5">

                <!-- Left: Tab buttons + ATP chart -->
                <div class="lg:col-span-2 p-6 sm:p-8 border-b lg:border-b-0 lg:border-r border-slate-100" style="background:#f8fafc;">
                    <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-4">Chọn tương tác phân tử</p>
                    <div class="flex flex-col gap-2">
                        <button onclick="updateBiochem('methyl')" id="btn-methyl"
                            class="tab-active text-left px-5 py-4 rounded-xl border-2 transition-all text-sm font-semibold">
                            <div class="flex items-center gap-2 mb-0.5">
                                <i class="fa-solid fa-dna text-xs opacity-70"></i>
                                Chu trình Methyl hóa
                            </div>
                            <div class="text-xs opacity-60 font-normal pl-5">Giải độc gan · Serotonin · Dopamine</div>
                        </button>
                        <button onclick="updateBiochem('enzyme')" id="btn-enzyme"
                            class="tab-inactive text-left px-5 py-4 rounded-xl border-2 transition-all text-sm font-semibold">
                            <div class="flex items-center gap-2 mb-0.5">
                                <i class="fa-solid fa-vial text-xs opacity-70"></i>
                                Hệ thống Enzyme
                            </div>
                            <div class="text-xs opacity-60 font-normal pl-5">Kẽm · Magie · Kích hoạt enzyme</div>
                        </button>
                        <button onclick="updateBiochem('tythe')" id="btn-tythe"
                            class="tab-inactive text-left px-5 py-4 rounded-xl border-2 transition-all text-sm font-semibold">
                            <div class="flex items-center gap-2 mb-0.5">
                                <i class="fa-solid fa-bolt text-xs opacity-70"></i>
                                Chức năng Ty thể (ATP)
                            </div>
                            <div class="text-xs opacity-60 font-normal pl-5">Nhà máy năng lượng tế bào</div>
                        </button>
                    </div>

                    <div class="mt-6 pt-5 border-t border-slate-200">
                        <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-3">
                            Sản lượng ATP tương đối
                        </p>
                        <div class="chart-wrap" style="height: 155px; max-height: 155px;">
                            <canvas id="atpChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right: Dynamic content -->
                <div class="lg:col-span-3 p-6 sm:p-10 flex flex-col justify-center min-h-[320px]">
                    <div class="mb-2">
                        <div class="inline-block bg-teal-50 text-teal-700 text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-widest mb-3" id="bio-badge">Methylation</div>
                    </div>
                    <h3 class="font-heading text-xl sm:text-2xl font-bold text-teal-800 mb-4 leading-snug fade-in" id="bio-title">
                        Chu trình Methyl hóa (Methylation)
                    </h3>
                    <p class="text-slate-600 leading-relaxed text-sm sm:text-base fade-in" id="bio-desc">
                        Đây là quá trình sinh hóa vô cùng quan trọng chịu trách nhiệm giải độc gan (thanh lọc kim loại nặng, hóa chất), sửa chữa cấu trúc DNA và tổng hợp các chất dẫn truyền thần kinh (như Serotonin và Dopamine). Sự vận hành trơn tru của chu trình này phụ thuộc hoàn toàn vào các vitamin tự nhiên (ví dụ: Folate từ rau xanh đậm, B12 từ đạm động vật). Sự thiếu hụt Co-factor dẫn đến suy giảm khả năng giải độc, gây tích tụ độc tố.
                    </p>
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2.5">Co-factor chính</p>
                        <div class="flex flex-wrap gap-2" id="bio-tags">
                            <span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full">Folate — Rau xanh đậm</span>
                            <span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full">B12 — Đạm động vật</span>
                            <span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full">Vitamin B6</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 4: Ứng dụng thực tiễn (GFCFSF)                -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="text-center mb-12 anim">
            <span class="section-label amber">Nguyên tắc GFCFSF</span>
            <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-slate-800 mb-3">
                Ứng dụng Thực tiễn trong Bữa ăn
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-base sm:text-lg">
                Cách xây dựng bữa ăn hàng ngày dựa trên nguyên lý Thực phẩm toàn phần — từng nhóm dinh dưỡng cần loại trừ và thay thế.
            </p>
        </div>

        <div class="bg-white rounded-2xl lg:rounded-3xl shadow-lg border border-slate-200 overflow-hidden anim d1">
            <!-- Pill tabs -->
            <div class="flex flex-wrap gap-2 px-6 py-4 border-b border-slate-100" style="background:#f8fafc;" id="meal-tabs">
                <button onclick="updateMeal('carb',this)"    class="pill-on px-5 py-2 rounded-full font-bold text-sm transition-all">
                    <i class="fa-solid fa-wheat-awn mr-1.5"></i>Carbohydrate Phức hợp
                </button>
                <button onclick="updateMeal('protein',this)" class="pill-off px-5 py-2 rounded-full font-bold text-sm transition-all">
                    <i class="fa-solid fa-drumstick-bite mr-1.5"></i>Nguồn Protein
                </button>
                <button onclick="updateMeal('vitamin',this)" class="pill-off px-5 py-2 rounded-full font-bold text-sm transition-all">
                    <i class="fa-solid fa-leaf mr-1.5"></i>Vitamin & Chất xơ
                </button>
            </div>

            <!-- Content area -->
            <div id="meal-content" class="p-6 md:p-8 fade-in">
                <div class="grid md:grid-cols-2 gap-6">
                    <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                        <h4 class="font-heading font-bold text-red-800 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-red-200 text-red-700 flex items-center justify-center text-xs font-extrabold flex-shrink-0">
                                <i class="fa-solid fa-xmark"></i>
                            </span>
                            Nhóm Loại trừ
                        </h4>
                        <ul class="space-y-3 text-red-700 text-sm">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-minus mt-0.5 text-red-400 flex-shrink-0 text-xs"></i>
                                Lúa mì và các chế phẩm từ bột mì tinh chế (Bánh mì, mì gói).
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-minus mt-0.5 text-red-400 flex-shrink-0 text-xs"></i>
                                Carbohydrate có chỉ số đường huyết (GI) cao.
                            </li>
                        </ul>
                    </div>
                    <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                        <h4 class="font-heading font-bold text-emerald-800 mb-4 flex items-center gap-2">
                            <span class="w-7 h-7 rounded-full bg-emerald-200 text-emerald-700 flex items-center justify-center text-xs font-extrabold flex-shrink-0">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            Nhóm Khuyến nghị
                        </h4>
                        <ul class="space-y-3 text-emerald-700 text-sm">
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check mt-0.5 text-emerald-500 flex-shrink-0 text-xs"></i>
                                Gạo xát dối, gạo lứt nảy mầm (phân giải axit phytic, tăng sinh khả dụng khoáng chất).
                            </li>
                            <li class="flex items-start gap-2.5">
                                <i class="fa-solid fa-check mt-0.5 text-emerald-500 flex-shrink-0 text-xs"></i>
                                Các loại củ: Khoai lang, khoai sọ, bí đỏ.
                            </li>
                        </ul>
                        <div class="mt-4 pt-3 border-t border-emerald-200">
                            <p class="text-xs font-bold text-emerald-700 flex items-start gap-1.5">
                                <i class="fa-solid fa-bolt mt-0.5 flex-shrink-0"></i>
                                Tác dụng: Ổn định nồng độ glucose trong máu, hạn chế xung động thần kinh do biến thiên đường huyết.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 5: Hướng dẫn áp dụng an toàn                  -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="py-16 md:py-20" style="background: linear-gradient(to bottom, #f8fafc, #f0fdfa);">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
        <div class="text-center mb-12 anim">
            <span class="section-label">Hướng dẫn thực hành</span>
            <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-slate-800 mb-3">
                3 nguyên tắc áp dụng an toàn
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-base">
                Thay đổi chế độ ăn cần diễn ra từ từ, có lộ trình rõ ràng để cơ thể thích nghi và hệ vi sinh không bị xáo trộn.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 anim d1">
            <!-- Step 1 -->
            <div class="step-line bg-white rounded-2xl p-7 shadow-md border border-slate-200 card-lift">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm" style="background:#f0fdfa;">
                    <i class="fa-solid fa-seedling text-2xl text-teal-600"></i>
                </div>
                <div class="inline-block bg-teal-50 text-teal-700 text-xs font-extrabold px-2 py-0.5 rounded-full mb-3 uppercase tracking-wide">Nguyên tắc 1</div>
                <h3 class="font-heading text-lg font-bold text-slate-800 mb-3">Đa dạng theo mùa vụ</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Ưu tiên thực phẩm địa phương theo mùa để đảm bảo lượng dưỡng chất dồi dào và hạn chế tối đa tồn dư hóa chất bảo vệ thực vật.</p>
            </div>

            <!-- Step 2 -->
            <div class="step-line bg-white rounded-2xl p-7 shadow-md border border-slate-200 card-lift">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm" style="background:#fff7ed;">
                    <i class="fa-solid fa-fish text-2xl text-amber-600"></i>
                </div>
                <div class="inline-block bg-amber-50 text-amber-700 text-xs font-extrabold px-2 py-0.5 rounded-full mb-3 uppercase tracking-wide">Nguyên tắc 2</div>
                <h3 class="font-heading text-lg font-bold text-slate-800 mb-3">Duy trì Canxi tự nhiên</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Sử dụng cá nhỏ (cá cơm, cá trích), vừng đen, rau họ cải, nước hầm xương có giấm táo để bổ sung canxi khi ngừng sử dụng sữa bò.</p>
            </div>

            <!-- Step 3 -->
            <div class="step-line bg-white rounded-2xl p-7 shadow-md border border-slate-200 card-lift">
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm" style="background:#f0f9ff;">
                    <i class="fa-solid fa-sliders text-2xl text-sky-600"></i>
                </div>
                <div class="inline-block bg-sky-50 text-sky-700 text-xs font-extrabold px-2 py-0.5 rounded-full mb-3 uppercase tracking-wide">Nguyên tắc 3</div>
                <h3 class="font-heading text-lg font-bold text-slate-800 mb-3">Điều chỉnh từ từ</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Bắt đầu từ lượng nhỏ và tăng dần. Việc thay đổi đột ngột có thể làm hệ vi sinh bị xáo trộn, gây đầy bụng hoặc khó chịu tạm thời.</p>
            </div>
        </div>

        <!-- Golden rule box -->
        <div class="mt-8 rounded-2xl p-6 sm:p-8 anim d2" style="background: #0f766e;">
            <div class="flex items-start gap-5">
                <div class="w-12 h-12 bg-white/15 rounded-xl flex items-center justify-center shrink-0 text-amber-400 text-2xl">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h4 class="font-heading text-lg font-bold text-white mb-2">Nguyên tắc vàng: "Chậm và Ít"</h4>
                    <p class="text-teal-100 text-sm leading-relaxed">
                        Chế độ ăn cần được điều chỉnh cho phù hợp với từng người và nên duy trì <strong class="text-white">Nhật ký ăn uống</strong> để theo dõi phản ứng. Đường ruột đang hồi phục rất nhạy cảm — ép dung nạp lượng lớn đột ngột giống như đổ dồn gạch vào một bức tường chưa khô vữa. Lưu ý rằng phương pháp này không thay thế hoàn toàn cho các hướng dẫn y tế chuyên sâu.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 6: CTA / Liên hệ                              -->
<!-- ═══════════════════════════════════════════════════════ -->
<section id="lien-he" class="relative overflow-hidden">
    <div class="py-16 md:py-20" style="background: linear-gradient(135deg, #0a1931 0%, #0f1f3d 50%, #0c3547 100%);">
        <!-- Glow blobs -->
        <div class="absolute top-0 right-1/4 w-[500px] h-[500px] rounded-full blur-[120px] pointer-events-none" style="background:rgba(15,118,110,0.12)"></div>
        <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] rounded-full blur-[120px] pointer-events-none" style="background:rgba(217,119,6,0.08)"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-12 anim">
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Cùng bạn hiểu con từ Gốc</h2>
                <p class="text-slate-300 text-base sm:text-lg max-w-3xl mx-auto leading-relaxed">
                    Chế độ dinh dưỡng y sinh là hành trình dài. Nếu bạn cần đồng hành, tư vấn hoặc giải đáp thắc mắc — hãy kết nối với chúng tôi.
                </p>
            </div>

            <!-- Contact Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-12 anim d1">
                <a href="tel:0988717107"
                   class="bg-white/10 hover:bg-teal-600 border border-white/10 hover:border-teal-500 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(13,148,136,0.3)]">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                        <i class="fa-solid fa-phone text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="font-heading font-bold text-base block">0988.717.107</span>
                        <span class="text-sm text-slate-400 group-hover:text-teal-100 transition-colors">Hotline tư vấn</span>
                    </div>
                </a>

                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener"
                   class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                        <i class="fa-brands fa-facebook text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="font-heading font-bold text-base block">Cộng đồng</span>
                        <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hiểu con từ Gốc</span>
                    </div>
                </a>

                <a href="https://zalo.me/g/vmgfxy834" target="_blank" rel="noopener"
                   class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                        <i class="fa-solid fa-comment-dots text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="font-heading font-bold text-base block">Nhóm Zalo</span>
                        <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh</span>
                    </div>
                </a>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" rel="noopener"
                   class="bg-white/10 hover:bg-emerald-600 border border-white/10 hover:border-emerald-500 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                    <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                        <i class="fa-solid fa-headset text-xl"></i>
                    </div>
                    <div class="min-w-0">
                        <span class="font-heading font-bold text-base block">Trợ lý Nam Khánh</span>
                        <span class="text-sm text-slate-400 group-hover:text-emerald-100 transition-colors">Kết nối trực tiếp</span>
                    </div>
                </a>
            </div>

            <!-- Disclaimer -->
            <div class="border-t border-white/10 pt-8 anim d2">
                <div class="bg-white/5 rounded-2xl p-5 sm:p-6 backdrop-blur-sm border border-white/5 mb-6 max-w-5xl mx-auto">
                    <p class="text-slate-400 text-xs sm:text-sm leading-relaxed text-center">
                        <strong class="text-slate-300">⚠️ TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM:</strong> Tài liệu này được biên soạn nhằm mục đích cung cấp thông tin khoa học và giáo dục cộng đồng. Nội dung văn bản không mang tính chất chẩn đoán bệnh và không thay thế cho các phương pháp điều trị được chỉ định bởi bác sĩ chuyên môn. Mọi quyết định thay đổi chế độ dinh dưỡng cần được tham khảo ý kiến của các chuyên gia y tế.
                    </p>
                </div>
                <p class="text-center text-slate-500 text-sm">© <?php echo date('Y'); ?> Hiểu con từ Gốc — Tự kỷ là Rối loạn toàn thân</p>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SCRIPTS                                                -->
<!-- ═══════════════════════════════════════════════════════ -->
<script>
// ── Reading progress ─────────────────────────────────────
const bar = document.getElementById('reading-progress');
window.addEventListener('scroll', () => {
    bar.style.width = (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight) * 100) + '%';
});

// ── Scroll-trigger animations ─────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const io = new IntersectionObserver((entries) => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.style.animationPlayState = 'running';
                io.unobserve(e.target);
            }
        });
    }, { threshold: 0.08 });
    document.querySelectorAll('.anim').forEach(el => {
        el.style.animationPlayState = 'paused';
        io.observe(el);
    });

    // ── Blood Sugar Chart ─────────────────────────────────
    new Chart(document.getElementById('bloodSugarChart').getContext('2d'), {
        type: 'line',
        data: {
            labels: ['0h','1h','2h','3h','4h'],
            datasets: [
                {
                    label: 'Carb Tinh chế (Gây biến động)',
                    data: [90,180,70,85,90],
                    borderColor: '#ef4444',
                    backgroundColor: 'rgba(239,68,68,0.08)',
                    borderWidth: 2.5, tension: 0.4, fill: true,
                    pointBackgroundColor: '#ef4444', pointRadius: 4
                },
                {
                    label: 'Thực phẩm Toàn phần (Ổn định)',
                    data: [90,110,105,95,90],
                    borderColor: '#0f766e',
                    backgroundColor: 'rgba(15,118,110,0.08)',
                    borderWidth: 2.5, tension: 0.4, fill: true,
                    borderDash: [6,4],
                    pointBackgroundColor: '#0f766e', pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { position: 'bottom', labels: { boxWidth: 12, font: { size: 11 }, padding: 16 } },
                tooltip: { mode: 'index', intersect: false }
            },
            scales: {
                y: { title: { display: true, text: 'Đường huyết (mg/dL)', font: { size: 11 } }, min: 50, max: 200, grid: { color: 'rgba(0,0,0,0.04)' } },
                x: { grid: { display: false } }
            }
        }
    });

    // ── ATP Chart ─────────────────────────────────────────
    new Chart(document.getElementById('atpChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Thiếu Co-factor','Đủ Co-factor'],
            datasets: [{ data: [35,100], backgroundColor: ['#d1d5db','#0f766e'], borderRadius: 8 }]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { callbacks: { label: c => 'Hiệu suất: ' + c.raw + '%' } }
            },
            scales: {
                y: { beginAtZero: true, max: 110, ticks: { display: false }, grid: { display: false } },
                x: { grid: { display: false }, ticks: { font: { size: 10 } } }
            }
        }
    });
});

// ── Biochemistry tabs ─────────────────────────────────────
const bioData = {
    methyl: {
        badge: 'Methylation',
        title: 'Chu trình Methyl hóa (Methylation)',
        desc:  'Đây là quá trình sinh hóa vô cùng quan trọng chịu trách nhiệm giải độc gan (thanh lọc kim loại nặng, hóa chất), sửa chữa cấu trúc DNA và tổng hợp các chất dẫn truyền thần kinh (như Serotonin và Dopamine). Sự vận hành trơn tru của chu trình này phụ thuộc hoàn toàn vào các vitamin tự nhiên (ví dụ: Folate từ rau xanh đậm, B12 từ đạm động vật). Sự thiếu hụt Co-factor dẫn đến suy giảm khả năng giải độc, gây tích tụ độc tố.',
        tags:  ['Folate — Rau xanh đậm','B12 — Đạm động vật','Vitamin B6']
    },
    enzyme: {
        badge: 'Enzyme System',
        title: 'Hoạt hóa Hệ thống Enzyme',
        desc:  'Các men tiêu hóa và men chuyển hóa chỉ có thể hoạt động hiệu quả khi có đủ các khoáng chất phù hợp (như Kẽm để tiêu hóa đạm, Magie cho các phản ứng thần kinh) từ nguồn thực phẩm. Không có các "chìa khóa" khoáng chất này, enzyme sẽ không hoạt động, dẫn đến thức ăn không được chuyển hóa tốt và các chất độc tích lũy ngay trong lòng ruột.',
        tags:  ['Kẽm — Thịt bò, hạt bí','Magie — Rau xanh','Mangan']
    },
    tythe: {
        badge: 'Mitochondria',
        title: 'Tối ưu hóa chức năng Ty thể',
        desc:  'Ty thể đóng vai trò là nhà máy sản xuất năng lượng (ATP) của tế bào. Quá trình này yêu cầu nguồn vi chất và oxy dồi dào. Việc ăn nhiều thực phẩm tinh chế, thiếu hụt Co-factor sẽ làm suy giảm chức năng của Ty thể. Khi tế bào thiếu năng lượng, cơ thể sẽ rơi vào trạng thái mệt mỏi thường xuyên, dễ dẫn đến bứt rứt và cáu gắt.',
        tags:  ['CoQ10','Sắt — Thịt đỏ','Riboflavin (B2)']
    }
};

function updateBiochem(key) {
    ['methyl','enzyme','tythe'].forEach(k => {
        document.getElementById('btn-' + k).classList.toggle('tab-active', k === key);
        document.getElementById('btn-' + k).classList.toggle('tab-inactive', k !== key);
    });
    const d = bioData[key];
    const titleEl = document.getElementById('bio-title');
    const descEl  = document.getElementById('bio-desc');
    [titleEl, descEl].forEach(el => { el.classList.remove('fade-in'); void el.offsetWidth; el.classList.add('fade-in'); });
    document.getElementById('bio-badge').textContent = d.badge;
    titleEl.textContent = d.title;
    descEl.textContent  = d.desc;
    document.getElementById('bio-tags').innerHTML = d.tags.map(t =>
        `<span class="bg-teal-100 text-teal-800 text-xs font-bold px-3 py-1 rounded-full">${t}</span>`
    ).join('');
}

// ── Meal tabs ─────────────────────────────────────────────
const mealData = {
    carb: {
        icon: 'fa-wheat-awn',
        avoid: ['Lúa mì và các chế phẩm từ bột mì tinh chế (Bánh mì, mì gói).','Carbohydrate có chỉ số đường huyết (GI) cao.'],
        rec:   ['Gạo xát dối, gạo lứt nảy mầm (phân giải axit phytic, tăng sinh khả dụng khoáng chất).','Các loại củ: Khoai lang, khoai sọ, bí đỏ.'],
        impact:'Ổn định nồng độ glucose trong máu, hạn chế xung động thần kinh do biến thiên đường huyết.'
    },
    protein: {
        icon: 'fa-drumstick-bite',
        avoid: ['Sữa động vật (chứa Casein gây viêm).','Đậu nành và nước tương công nghiệp (dư lượng lúa mì lên men).'],
        rec:   ['Thịt gia súc, gia cầm nuôi tự nhiên.','Cá nhỏ (cá cơm, cá trích) giàu Omega-3 kháng viêm, ít kim loại nặng.','Nước mắm cốt truyền thống kết hợp gừng, hành, nghệ (Curcumin).'],
        impact:'Cung cấp axit amin thiết yếu an toàn, gia tăng hiệu quả kháng viêm tại niêm mạc dạ dày.'
    },
    vitamin: {
        icon: 'fa-leaf',
        avoid: ['Dầu thực vật tinh luyện (dễ bị oxy hóa sinh gốc tự do gây viêm).','Thực phẩm trái mùa nhiều hóa chất.'],
        rec:   ['Rau lá xanh sẫm.','Mỡ động vật chưa qua chế biến sâu, dầu dừa/oliu.','Tỏi, hành (hợp chất lưu huỳnh hỗ trợ gan).'],
        impact:'Nuôi dưỡng và tái thiết lập cân bằng hệ vi sinh vật đường ruột (microbiome) nhờ prebiotics.'
    }
};

function updateMeal(key, btn) {
    document.querySelectorAll('#meal-tabs button').forEach(b => {
        b.classList.remove('pill-on'); b.classList.add('pill-off');
    });
    btn.classList.add('pill-on'); btn.classList.remove('pill-off');

    const d = mealData[key];
    const avoidHtml = d.avoid.map(i =>
        `<li class="flex items-start gap-2.5"><i class="fa-solid fa-minus mt-0.5 text-red-400 flex-shrink-0 text-xs"></i>${i}</li>`
    ).join('');
    const recHtml = d.rec.map(i =>
        `<li class="flex items-start gap-2.5"><i class="fa-solid fa-check mt-0.5 text-emerald-500 flex-shrink-0 text-xs"></i>${i}</li>`
    ).join('');

    const box = document.getElementById('meal-content');
    box.style.opacity = '0';
    setTimeout(() => {
        box.innerHTML = `
            <div class="grid md:grid-cols-2 gap-6 fade-in">
                <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                    <h4 class="font-heading font-bold text-red-800 mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-red-200 text-red-700 flex items-center justify-center text-xs font-extrabold flex-shrink-0"><i class="fa-solid fa-xmark"></i></span>
                        Nhóm Loại trừ
                    </h4>
                    <ul class="space-y-3 text-red-700 text-sm">${avoidHtml}</ul>
                </div>
                <div class="bg-emerald-50 p-6 rounded-2xl border border-emerald-100">
                    <h4 class="font-heading font-bold text-emerald-800 mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-full bg-emerald-200 text-emerald-700 flex items-center justify-center text-xs font-extrabold flex-shrink-0"><i class="fa-solid fa-check"></i></span>
                        Nhóm Khuyến nghị
                    </h4>
                    <ul class="space-y-3 text-emerald-700 text-sm">${recHtml}</ul>
                    <div class="mt-4 pt-3 border-t border-emerald-200">
                        <p class="text-xs font-bold text-emerald-700 flex items-start gap-1.5">
                            <i class="fa-solid fa-bolt mt-0.5 flex-shrink-0"></i>
                            Tác dụng: ${d.impact}
                        </p>
                    </div>
                </div>
            </div>`;
        box.style.transition = 'opacity 0.3s';
        box.style.opacity = '1';
    }, 180);
}
</script>

<?php wp_footer(); ?>
</body>
