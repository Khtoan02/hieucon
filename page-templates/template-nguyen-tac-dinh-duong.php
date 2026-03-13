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
                        emerald: {
                            50:  '#f0fdf4',
                            100: '#dcfce7',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                        },
                        sky: {
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
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
            background: linear-gradient(to right, #10b981, #0ea5e9);
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
        .card-lift:hover { transform: translateY(-6px); box-shadow: 0 20px 48px -10px rgba(16,185,129,0.15); }

        /* Tab active/inactive */
        .tab-active   { background: #10b981; color: #fff; border-color: #10b981; }
        .tab-inactive { background: #fff; color: #374151; border-color: #d1d5db; }
        .tab-inactive:hover { border-color: #10b981; color: #10b981; }

        /* Pill tabs */
        .pill-on  { background: #10b981; color: #fff; }
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
            background: rgba(16,185,129,0.1);
            color: #059669;
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
            background: linear-gradient(to bottom, #10b98133, transparent);
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
<header class="relative overflow-hidden" style="background: linear-gradient(135deg, #10b981 0%, #0ea5e9 100%);">

    <!-- Decorative circles -->
    <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-white/10 -translate-y-1/3 translate-x-1/4 pointer-events-none"></div>
    <div class="absolute bottom-0 left-0 w-[380px] h-[380px] rounded-full bg-white/10 translate-y-1/3 -translate-x-1/4 pointer-events-none"></div>
    <!-- Floating icon -->
    <div class="absolute top-10 right-16 text-white/10 pointer-events-none hidden xl:block" style="animation: float 6s ease-in-out infinite; font-size: 200px;">
        <i class="fa-solid fa-seedling"></i>
    </div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-20 md:py-32 relative z-10 text-center">

        <!-- Badge -->
        <div class="anim inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/20 text-white font-semibold text-xs sm:text-sm mb-6 backdrop-blur-sm border border-white/30">
            <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
            HIỂU CON TỪ GỐC &nbsp;·&nbsp; Y SINH THỰC CHỨNG
        </div>

        <h1 class="font-heading text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6 anim d1">
            Nguyên tắc Dinh dưỡng<br>
            <span class="text-amber-300">Phục hồi Đường ruột</span>
        </h1>

        <p class="text-base sm:text-lg md:text-xl text-emerald-50 max-w-3xl mx-auto mb-10 leading-relaxed anim d2">
            Lộ trình dinh dưỡng y sinh cá nhân hóa, giúp phục hồi hệ vi sinh và khơi dậy nguồn năng lượng tự nhiên thông qua <strong class="text-white">Thực phẩm toàn phần (Whole Foods)</strong>.
        </p>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row justify-center gap-4 anim d3">
            <a href="#tong-quan" class="bg-amber-400 hover:bg-amber-300 text-slate-900 px-8 py-4 rounded-full font-bold text-lg shadow-xl shadow-amber-900/20 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                Khám phá ngay <i class="fa-solid fa-arrow-down-long animate-bounce"></i>
            </a>
            <a href="#lien-he" class="bg-white/10 hover:bg-white/20 text-white px-8 py-4 rounded-full font-bold text-lg border border-white/30 backdrop-blur-sm transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                Tôi cần hỗ trợ <i class="fa-solid fa-headset"></i>
            </a>
        </div>

        <!-- Stats Row -->
        <div class="mt-14 flex flex-wrap justify-center gap-4 anim d4">
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-8 py-5 text-center min-w-[140px]">
                <div class="text-3xl font-extrabold text-amber-300 font-heading mb-1">3</div>
                <div class="text-[10px] text-emerald-50 font-bold uppercase tracking-widest">Trụ cột<br>phục hồi</div>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-8 py-5 text-center min-w-[140px]">
                <div class="text-2xl font-extrabold text-amber-300 font-heading mb-1">GFCFSF</div>
                <div class="text-[10px] text-emerald-50 font-bold uppercase tracking-widest">Nguyên tắc<br>ăn uống</div>
            </div>
            <div class="bg-white/10 backdrop-blur-md border border-white/20 rounded-2xl px-8 py-5 text-center min-w-[140px]">
                <div class="text-3xl font-extrabold text-amber-300 font-heading mb-1">100%</div>
                <div class="text-[10px] text-emerald-50 font-bold uppercase tracking-widest">Thực phẩm<br>tự nhiên</div>
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
<section id="tong-quan" class="py-16 md:py-24 bg-slate-50/50">
    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">

        <!-- Split layout: light panel + chart panel -->
        <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-[3rem] overflow-hidden shadow-2xl border border-slate-200 anim">
            <div class="lg:w-[45%] relative overflow-hidden p-8 sm:p-10 lg:p-14 flex flex-col justify-center bg-gradient-to-br from-emerald-600 to-emerald-700">
                <div class="absolute -right-10 -bottom-10 text-white/5 text-[200px] pointer-events-none">
                    <i class="fa-solid fa-leaf"></i>
                </div>
                <div class="relative z-10">
                    <span class="inline-flex items-center gap-2 bg-white/10 text-white text-[10px] font-bold uppercase tracking-widest px-3 py-1.5 rounded-full mb-6 border border-white/20">
                        <i class="fa-solid fa-circle-info text-amber-300"></i> Ý nghĩa thực tiễn
                    </span>
                    <h2 class="font-heading text-2xl sm:text-3xl font-extrabold text-white mb-6 leading-tight text-shadow-sm">Dinh dưỡng y sinh thực tế và tiết kiệm</h2>
                    <p class="text-emerald-50 leading-relaxed text-sm sm:text-base mb-8 opacity-90">
                        Chăm sóc dinh dưỡng cho con không nhất thiết phải tốn kém. Bằng cách hiểu đúng về thực phẩm toàn phần bản địa, chúng ta không chỉ tối ưu chi phí mà còn tạo điều kiện tốt nhất để niêm mạc ruột con được chữa lành tự nhiên.
                    </p>
                    <div class="bg-white/10 border border-white/10 rounded-2xl p-5 backdrop-blur-sm">
                        <div class="flex items-start gap-4 text-emerald-50 text-sm leading-relaxed">
                            <i class="fa-solid fa-lightbulb text-amber-300 text-lg mt-0.5"></i>
                            <p>Ưu tiên thực phẩm địa phương theo mùa giúp đảm bảo lượng dưỡng chất tươi mới nhất cho cơ thể.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:w-[55%] bg-white p-8 sm:p-12 flex flex-col justify-center">
                <div class="mb-8">
                    <h3 class="font-heading text-xl font-bold text-slate-800 mb-1">Biểu đồ Cân bằng Đường huyết</h3>
                    <p class="text-xs text-slate-500 font-medium italic">So sánh tác động của hai nhóm thực phẩm đối với năng lượng cơ thể</p>
                </div>

                <div class="chart-wrap" style="height: 280px;">
                    <canvas id="bloodSugarChart"></canvas>
                </div>

                <div class="mt-8 flex flex-wrap items-center justify-center gap-6">
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-sm shadow-emerald-200"></span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Thực phẩm Toàn phần (Gợi ý)</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="w-3 h-3 rounded-full bg-rose-500 shadow-sm shadow-rose-200"></span>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Tinh chế (Cần hạn chế)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ═══════════════════════════════════════════════════════ -->
<!--  SECTION 2: 3 Trụ cột                                   -->
<!-- ═══════════════════════════════════════════════════════ -->
<section class="py-16 md:py-24 bg-white relative overflow-hidden">
    <!-- Background accents -->
    <div class="absolute top-1/2 left-0 w-96 h-96 bg-emerald-50 rounded-full blur-[100px] -translate-x-1/2 -translate-y-1/2 pointer-events-none opacity-60"></div>

    <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
        <div class="text-center mb-16 anim">
            <span class="section-label">Lộ trình phục hồi</span>
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-900 mb-4">
                Ba trụ cột dinh dưỡng nền tảng
            </h2>
            <p class="text-slate-500 max-w-2xl mx-auto text-lg leading-relaxed">
                Nguyên lý vàng để hồi sinh hệ tiêu hóa và vá lành "rò rỉ ruột" một cách bền vững.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <!-- Pillar 1 -->
            <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-100 border border-slate-100 card-lift group anim d1 relative">
                <div class="w-16 h-16 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-emerald-500 group-hover:text-white transition-all duration-300">
                    01
                </div>
                <h3 class="font-heading text-xl font-bold text-slate-800 mb-4">Loại trừ Tác nhân</h3>
                <div class="inline-block bg-indigo-50 text-indigo-700 text-[10px] font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-widest">Protocol GFCFSF</div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Tạm dừng <strong class="text-emerald-600">Lúa mì, Sữa động vật & Đậu nành</strong>. Những protein này dễ gây viêm và tạo gánh nặng cho hệ thống thần kinh khi đường ruột chưa phục hồi.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-100 border border-slate-100 card-lift group anim d2 relative">
                <div class="w-16 h-16 bg-sky-100 text-sky-600 rounded-2xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-sky-500 group-hover:text-white transition-all duration-300">
                    02
                </div>
                <h3 class="font-heading text-xl font-bold text-slate-800 mb-4">Giảm tải Áp lực</h3>
                <div class="inline-block bg-sky-50 text-sky-700 text-[10px] font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-widest">Ninh hầm kỹ</div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Ưu tiên thực phẩm <strong class="text-sky-600">ninh hầm chín tới</strong> để thức ăn mềm mại, dễ bẻ gãy, giúp hệ tiêu hóa đang nhạy cảm dễ dàng hấp thụ dưỡng chất mà không tốn nhiều năng lượng.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-3xl p-8 shadow-xl shadow-slate-100 border border-slate-100 card-lift group anim d3 relative">
                <div class="w-16 h-16 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center text-2xl font-black mb-6 group-hover:bg-amber-500 group-hover:text-white transition-all duration-300">
                    03
                </div>
                <h3 class="font-heading text-xl font-bold text-slate-800 mb-4">Vá lành Niêm mạc</h3>
                <div class="inline-block bg-amber-50 text-amber-700 text-[10px] font-bold px-3 py-1 rounded-full mb-4 uppercase tracking-widest">Dưỡng chất y sinh</div>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Cung cấp <strong class="text-amber-600">L-glutamine & Vitamin tự nhiên</strong> để vá lại các tế bào biểu mô ruột, khép kín các khe hở và tái lập lớp hàng rào bảo vệ vững chắc cho cơ thể.
                </p>
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
                        <div class="inline-block bg-emerald-50 text-emerald-700 text-xs font-extrabold px-3 py-1 rounded-full uppercase tracking-widest mb-3" id="bio-badge">Methylation</div>
                    </div>
                    <h3 class="font-heading text-xl sm:text-2xl font-bold text-emerald-800 mb-4 leading-snug fade-in" id="bio-title">
                        Chu trình Methyl hóa (Methylation)
                    </h3>
                    <p class="text-slate-600 leading-relaxed text-sm sm:text-base fade-in" id="bio-desc">
                        Đây là quá trình sinh hóa vô cùng quan trọng chịu trách nhiệm giải độc gan (thanh lọc kim loại nặng, hóa chất), sửa chữa cấu trúc DNA và tổng hợp các chất dẫn truyền thần kinh (như Serotonin và Dopamine). Sự vận hành trơn tru của chu trình này phụ thuộc hoàn toàn vào các vitamin tự nhiên (ví dụ: Folate từ rau xanh đậm, B12 từ đạm động vật). Sự thiếu hụt Co-factor dẫn đến suy giảm khả năng giải độc, gây tích tụ độc tố.
                    </p>
                    <div class="mt-6 p-4 bg-slate-50 rounded-xl border border-slate-100">
                        <p class="text-xs font-extrabold text-slate-400 uppercase tracking-widest mb-2.5">Co-factor chính</p>
                        <div class="flex flex-wrap gap-2" id="bio-tags">
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">Folate — Rau xanh đậm</span>
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">B12 — Đạm động vật</span>
                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">Vitamin B6</span>
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
                <div class="w-14 h-14 rounded-2xl flex items-center justify-center mb-5 shadow-sm" style="background:#f0fdf4;">
                    <i class="fa-solid fa-seedling text-2xl text-emerald-600"></i>
                </div>
                <div class="inline-block bg-emerald-50 text-emerald-700 text-xs font-extrabold px-2 py-0.5 rounded-full mb-3 uppercase tracking-wide">Nguyên tắc 1</div>
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
        <div class="mt-8 rounded-2xl p-6 sm:p-8 anim d2" style="background: linear-gradient(135deg, #059669 0%, #047857 100%); transition: all 0.3s ease;">
            <div class="flex items-start gap-5">
                <div class="w-12 h-12 bg-white/15 rounded-xl flex items-center justify-center shrink-0 text-amber-400 text-2xl">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
                <div>
                    <h4 class="font-heading text-lg font-bold text-white mb-2">Nguyên tắc vàng: "Chậm và Ít"</h4>
                    <p class="text-emerald-50 text-sm leading-relaxed">
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
    <div class="py-20 md:py-28 bg-[#0f172a] text-white overflow-hidden relative">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[120px] -translate-y-1/2 translate-x-1/2"></div>
        <div class="absolute bottom-0 left-0 w-[600px] h-[600px] bg-sky-500/10 rounded-full blur-[120px] translate-y-1/2 -translate-x-1/2"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-16 anim">
                <h2 class="font-heading text-3xl md:text-5xl font-extrabold mb-6">Đồng hành cùng gia đình bạn</h2>
                <p class="text-slate-400 text-lg max-w-2xl mx-auto leading-relaxed">
                    Dinh dưỡng là chìa khóa của sự phục hồi. Hãy liên hệ để được hỗ trợ chuyên sâu và cá nhân hóa lộ trình cho con.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-20 anim d1">
                <a href="tel:0988717107" class="group bg-slate-800/50 hover:bg-emerald-600 border border-slate-700 p-8 rounded-[2.5rem] transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-emerald-500/20 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-emerald-400 group-hover:text-white mb-6 text-2xl transition-all">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">0988.717.107</h4>
                    <span class="text-sm text-slate-500 group-hover:text-white/70">Hotline tư vấn</span>
                </a>

                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="group bg-slate-800/50 hover:bg-blue-600 border border-slate-700 p-8 rounded-[2.5rem] transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-blue-500/20 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-blue-400 group-hover:text-white mb-6 text-2xl transition-all">
                        <i class="fa-brands fa-facebook"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Cộng đồng FB</h4>
                    <span class="text-sm text-slate-500 group-hover:text-white/70">Hiểu con từ Gốc</span>
                </a>

                <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="group bg-slate-800/50 hover:bg-sky-500 border border-slate-700 p-8 rounded-[2.5rem] transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-sky-500/20 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-sky-400 group-hover:text-white mb-6 text-2xl transition-all">
                        <i class="fa-solid fa-comment-dots"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Nhóm Zalo</h4>
                    <span class="text-sm text-slate-500 group-hover:text-white/70">Hỏi đáp trực tiếp</span>
                </a>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="group bg-slate-800/50 hover:bg-indigo-600 border border-slate-700 p-8 rounded-[2.5rem] transition-all duration-500 flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-indigo-500/20 group-hover:bg-white/20 rounded-2xl flex items-center justify-center text-indigo-400 group-hover:text-white mb-6 text-2xl transition-all">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h4 class="font-bold text-xl mb-2">Trợ lý Chuyên môn</h4>
                    <span class="text-sm text-slate-500 group-hover:text-white/70">Kết nối 1:1</span>
                </a>
            </div>

            <!-- Bottom Note -->
            <div class="bg-gradient-to-r from-emerald-900/30 to-sky-900/30 rounded-3xl p-8 border border-white/5 text-center text-xs text-slate-400 max-w-4xl mx-auto italic font-medium">
                <i class="fa-solid fa-circle-info mr-2 text-emerald-500"></i> Lời nhắn gửi: Tài liệu này nhằm nâng cao nhận thức cộng đồng và không thay thế chẩn đoán y khoa chuyên sâu. Hãy luôn lắng nghe con và tham vấn chuyên gia.
            </div>
            <p class="text-center mt-12 text-slate-600 text-[10px] uppercase tracking-widest font-bold">© 2026 Hiểu con từ Gốc — Tình yêu song hành cùng trí tuệ</p>
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
            labels: ['Trước ăn', 'Sau 1h', 'Sau 2h', 'Sau 3h', 'Sau 4h'],
            datasets: [
                {
                    label: 'Carb Tinh chế',
                    data: [90, 180, 70, 85, 90],
                    borderColor: '#f43f5e',
                    backgroundColor: 'rgba(244,63,94,0.05)',
                    borderWidth: 3, tension: 0.45, fill: true,
                    pointBackgroundColor: '#fff', pointBorderColor: '#f43f5e', pointBorderWidth: 2, pointRadius: 4
                },
                {
                    label: 'Thực phẩm Toàn phần',
                    data: [90, 110, 105, 95, 90],
                    borderColor: '#10b981',
                    backgroundColor: 'rgba(16,185,129,0.05)',
                    borderWidth: 3, tension: 0.45, fill: true,
                    pointBackgroundColor: '#fff', pointBorderColor: '#10b981', pointBorderWidth: 2, pointRadius: 4
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    mode: 'index', intersect: false,
                    backgroundColor: 'rgba(255,255,255,0.95)',
                    titleColor: '#1e293b', bodyColor: '#475569',
                    borderColor: '#e2e8f0', borderWidth: 1
                }
            },
            scales: {
                y: {
                    title: { display: true, text: 'Chỉ số Đường huyết', font: { size: 10, weight: '700' } },
                    min: 50, max: 200,
                    grid: { color: 'rgba(0,0,0,0.03)' }
                },
                x: { grid: { display: false } }
            }
        }
    });

    // ── ATP Chart ─────────────────────────────────────────
    new Chart(document.getElementById('atpChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: ['Thiếu Co-factor','Đủ Co-factor'],
            datasets: [{ data: [35,100], backgroundColor: ['#e2e8f0','#10b981'], borderRadius: 8 }]
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
        `<span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-3 py-1 rounded-full">${t}</span>`
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
