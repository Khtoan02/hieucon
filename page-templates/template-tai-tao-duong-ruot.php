<?php
/**
 * Template Name: Trang Tái tạo đường ruột
 *
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- SEO Meta Tags -->
    <title>Tái tạo hàng rào ruột bằng Men vi sinh (Probiotics) Đúng Chuẩn</title>
    <meta name="description" content="Hướng dẫn chi tiết về cách sử dụng Probiotics để phục hồi hệ tiêu hóa, tái tạo màng ruột rò rỉ và cải thiện nhận thức cho trẻ theo phương pháp y sinh.">
    <meta name="keywords" content="men vi sinh, probiotics, tái tạo màng ruột, tự kỷ, y sinh, leaky gut, sIgA, die-off">
    <meta property="og:title" content="Tái tạo hàng rào ruột bằng Men vi sinh Đúng Chuẩn">
    <meta property="og:description" content="Giải pháp bền vững để phục hồi nội môi và bảo vệ não bộ cho trẻ thông qua hệ vi sinh đường ruột.">
    <meta property="og:type" content="article">

    <!-- Schema.org for SEO -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "HealthTopic",
      "name": "Tái tạo hàng rào ruột bằng Men vi sinh (Probiotics) Đúng Chuẩn",
      "description": "Hướng dẫn phục hồi niêm mạc ruột bằng lợi khuẩn trị liệu.",
      "author": { "@type": "Organization", "name": "Hiểu con từ Gốc" }
    }
    </script>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=Nunito:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        navy: { DEFAULT: '#0A1931', light: '#1A365D' },
                        primary: '#0d9488',
                        secondary: '#f97316',
                        emerald: {
                            50: '#ecfdf5', 100: '#d1fae5', 200: '#a7f3d0',
                            300: '#6ee7b7', 400: '#34d399', 500: '#10b981',
                            600: '#059669', 700: '#047857', 800: '#065f46', 900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Nunito', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Lora', serif; }

        /* ── Reading Progress Bar ── */
        #progress-bar {
            height: 3px;
            background: linear-gradient(90deg, #10b981, #0d9488);
            width: 0%;
            position: fixed;
            top: 0; left: 0;
            z-index: 999;
            transition: width 0.1s linear;
        }

        /* ── Hero Gradient ── */
        .hero-gradient {
            background: linear-gradient(135deg, #064e3b 0%, #065f46 50%, #047857 100%);
        }

        /* ── Section Reveal Animation ── */
        .section-reveal {
            opacity: 0;
            transform: translateY(28px);
            transition: all 0.7s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .section-reveal.visible { opacity: 1; transform: translateY(0); }

        /* ── Chart Container ── */
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 480px;
            margin: auto;
            height: 280px;
            max-height: 320px;
        }

        /* ── Mobile Nav Scrollbar Hide ── */
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

        /* ── Nav Active State ── */
        .nav-link-active {
            color: #065f46;
            border-bottom: 2px solid #10b981;
            font-weight: 800;
        }

        /* ── Gut Simulation ── */
        .gut-cell { transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1); }
        .gut-gap {
            transition: all 0.5s ease;
            width: 18px;
            background-color: transparent;
            border-radius: 4px;
        }
        .siga-active .gut-gap {
            width: 6px;
            background-color: #10b981;
            box-shadow: 0 0 12px rgba(16,185,129,0.6);
        }
        .toxin-particle { transition: all 0.6s ease; }
        .siga-active .toxin-particle {
            opacity: 0;
            transform: translateY(-36px) scale(0.5);
        }

        /* ── Criteria Card Hover ── */
        .criteria-card {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .criteria-card:hover {
            transform: translateX(6px);
            border-color: #10b981;
            box-shadow: 0 8px 30px rgba(16,185,129,0.12);
        }

        /* ── Glassmorphism Card ── */
        .glass-card {
            background: rgba(255,255,255,0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255,255,255,0.9);
        }

        /* ── Page Background ── */
        .page-bg {
            background: linear-gradient(to bottom, #f0fdf4 0%, #ecfdf5 40%, #f8fafc 100%);
            min-height: 100vh;
        }
    </style>
</head>

<body class="page-bg text-navy antialiased">

<div id="progress-bar"></div>

<!-- ════════════════════════════════════════════ -->
<!-- SITE HEADER (giống theme) -->
<!-- ════════════════════════════════════════════ -->
<header id="main-header" class="sticky top-0 z-[100] w-full bg-white/80 backdrop-blur-xl border-b border-emerald-100/60 shadow-sm" style="margin-top:3px">
    <div class="max-w-4xl mx-auto px-4">
        <div class="flex items-center justify-between h-14">
            <!-- Logo / Back -->
            <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2 text-emerald-800 hover:text-emerald-600 transition-colors group">
                <i data-lucide="arrow-left" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                <span class="font-serif font-bold text-sm hidden sm:inline">Hiểu con từ Gốc</span>
            </a>

            <!-- Article Title -->
            <div class="flex flex-col items-center">
                <span class="text-xs font-bold text-emerald-700 uppercase tracking-widest">Bài 14</span>
                <h1 class="font-serif font-bold text-sm text-slate-800 hidden sm:block">Tái Tạo Hàng Rào Ruột</h1>
            </div>

            <!-- Meta -->
            <div class="flex items-center gap-2">
                <span class="bg-emerald-100 text-emerald-700 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Y Sinh</span>
                <span class="text-xs text-slate-400 hidden sm:inline font-medium">8 phút</span>
            </div>
        </div>
    </div>

    <!-- Horizontal Scroll Nav -->
    <nav class="border-t border-emerald-50 overflow-x-auto no-scrollbar bg-white/60">
        <div class="max-w-4xl mx-auto flex whitespace-nowrap px-4 gap-1">
            <button onclick="scrollToSection('intro')" id="nav-intro" class="py-2.5 px-3 text-xs font-semibold transition-all nav-link-active rounded-t-lg">Khởi Đầu</button>
            <button onclick="scrollToSection('mechanism')" id="nav-mechanism" class="py-2.5 px-3 text-xs font-semibold transition-all text-slate-400 hover:text-emerald-700">Cơ Chế</button>
            <button onclick="scrollToSection('barrier')" id="nav-barrier" class="py-2.5 px-3 text-xs font-semibold transition-all text-slate-400 hover:text-emerald-700">Màng Ruột</button>
            <button onclick="scrollToSection('selection')" id="nav-selection" class="py-2.5 px-3 text-xs font-semibold transition-all text-slate-400 hover:text-emerald-700">Tiêu Chí</button>
            <button onclick="scrollToSection('safety')" id="nav-safety" class="py-2.5 px-3 text-xs font-semibold transition-all text-slate-400 hover:text-emerald-700">Lưu Ý</button>
            <button onclick="scrollToSection('contact')" id="nav-contact" class="py-2.5 px-3 text-xs font-semibold transition-all text-slate-400 hover:text-emerald-700">Liên Hệ</button>
        </div>
    </nav>
</header>

<!-- ════════════════════════════════════════════ -->
<!-- HERO SECTION -->
<!-- ════════════════════════════════════════════ -->
<div class="hero-gradient text-white">
    <div class="max-w-4xl mx-auto px-4 py-12 md:py-16">
        <div class="flex items-center gap-3 mb-5">
            <span class="bg-white/20 text-white text-[11px] font-bold px-3 py-1.5 rounded-full uppercase tracking-widest backdrop-blur-sm border border-white/20">Y Sinh · Bài 14</span>
        </div>
        <h1 class="font-serif font-bold text-3xl md:text-4xl lg:text-5xl leading-tight mb-5">
            Tái Tạo Lại<br>
            <span class="text-emerald-300">Hàng Rào Ruột</span>
        </h1>
        <p class="text-emerald-100 text-base md:text-lg leading-relaxed max-w-2xl mb-8">
            Dập tắt lửa chỉ mới ngăn hủy hoại tiếp diễn. Để niêm mạc ruột thực sự vững chãi, cần chủ động đưa những "thợ xây" lành nghề — <strong class="text-white">Probiotics đúng chuẩn</strong> — vào tái thiết từ gốc.
        </p>
        <div class="flex flex-wrap gap-4">
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2.5 border border-white/20">
                <i data-lucide="clock" class="w-4 h-4 text-emerald-300"></i>
                <span class="text-sm font-semibold">8 phút đọc</span>
            </div>
            <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2.5 border border-white/20">
                <i data-lucide="flask-conical" class="w-4 h-4 text-emerald-300"></i>
                <span class="text-sm font-semibold">Khoa học y sinh</span>
            </div>
        </div>
    </div>
</div>

<!-- ════════════════════════════════════════════ -->
<!-- MAIN CONTENT -->
<!-- ════════════════════════════════════════════ -->
<main class="max-w-4xl mx-auto px-4 py-10 md:py-14">
<article>

    <!-- ── Section 1: Intro ── -->
    <section id="intro" class="mb-16 scroll-mt-28 section-reveal">

        <!-- Analogy Card -->
        <div class="bg-amber-50 rounded-3xl p-6 md:p-8 border border-amber-200/60 shadow-sm mb-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-amber-100/60 rounded-full -translate-y-8 translate-x-8 pointer-events-none"></div>
            <div class="flex items-start gap-4 relative z-10">
                <div class="bg-amber-100 rounded-2xl p-3 shrink-0">
                    <span class="text-3xl leading-none">🔥</span>
                </div>
                <div>
                    <h2 class="font-serif font-bold text-xl text-amber-900 mb-2">Ẩn dụ: Ngôi nhà sau hỏa hoạn</h2>
                    <p class="text-amber-800 leading-relaxed text-sm md:text-base">
                        Giống như một ngôi nhà vừa trải qua cơn hỏa hoạn, dập tắt lửa chỉ mới ngăn hủy hoại tiếp diễn. Để cấu trúc ngôi nhà (niêm mạc ruột) thực sự vững chãi, chúng ta cần <strong>chủ động tái thiết</strong> bằng những vật liệu chuyên dụng.
                    </p>
                </div>
            </div>
        </div>

        <!-- Quote Banner -->
        <div class="bg-gradient-to-r from-emerald-800 to-emerald-700 text-white rounded-3xl p-6 md:p-8 shadow-xl flex flex-col sm:flex-row items-center gap-5">
            <div class="bg-white/10 rounded-2xl p-4 shrink-0">
                <span class="text-4xl">👷‍♂️</span>
            </div>
            <div>
                <p class="text-xl font-serif font-bold italic text-white mb-2">"Gieo hạt thay vì chỉ tiêu diệt"</p>
                <p class="text-emerald-100 text-sm leading-relaxed">
                    Chúng ta cần chủ động đưa những <strong class="text-white">người thợ xây lành nghề</strong> — Men vi sinh (Probiotics) đúng chuẩn — vào để tái tạo lại hàng rào màng ruột từ bên trong.
                </p>
            </div>
        </div>
    </section>

    <!-- ── Section 2: Mechanism ── -->
    <section id="mechanism" class="mb-16 scroll-mt-28 section-reveal">
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="swords" class="w-4 h-4 text-emerald-700"></i>
                </div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Cơ chế tác động</span>
            </div>
            <h2 class="font-serif font-bold text-2xl md:text-3xl text-slate-900">Cuộc Chiến "Cạnh Tranh Loại Trừ"</h2>
            <div class="h-1 w-16 bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full mt-3"></div>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
            <!-- Left: mechanism list -->
            <div>
                <p class="text-slate-600 leading-relaxed mb-6">
                    Khi bổ sung Probiotics với mật độ lớn, chúng hoạt động dựa trên cơ chế sinh thái học vô cùng thông minh:
                </p>
                <div class="space-y-4">
                    <div class="flex items-start gap-4 bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all">
                        <div class="bg-emerald-100 rounded-xl p-2.5 shrink-0">
                            <i data-lucide="anchor" class="w-5 h-5 text-emerald-700"></i>
                        </div>
                        <div>
                            <strong class="block text-slate-800 font-bold mb-1">Chiếm chỗ neo đậu</strong>
                            <span class="text-sm text-slate-500 leading-relaxed">Lợi khuẩn bám dính và lấp đầy các thụ thể trên niêm mạc, không để hại khuẩn có chỗ trú.</span>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all">
                        <div class="bg-emerald-100 rounded-xl p-2.5 shrink-0">
                            <i data-lucide="salad" class="w-5 h-5 text-emerald-700"></i>
                        </div>
                        <div>
                            <strong class="block text-slate-800 font-bold mb-1">Cạnh tranh dinh dưỡng</strong>
                            <span class="text-sm text-slate-500 leading-relaxed">Hại khuẩn và nấm men bị cô lập do cạn kiệt nguồn thức ăn, buộc phải rút lui khỏi lãnh thổ.</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Chart -->
            <div class="bg-white rounded-3xl p-6 border border-slate-100 shadow-sm">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="font-serif font-semibold text-slate-700 text-sm">Mô hình Hệ vi sinh đường ruột</h3>
                    <div class="flex gap-3 text-xs">
                        <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-red-400 inline-block"></span>Hại khuẩn</span>
                        <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500 inline-block"></span>Lợi khuẩn</span>
                        <span class="flex items-center gap-1"><span class="w-2.5 h-2.5 rounded-full bg-amber-400 inline-block"></span>Nấm</span>
                    </div>
                </div>
                <div class="chart-container">
                    <canvas id="gutChart"></canvas>
                </div>
                <!-- Chart Status -->
                <div id="chart-status" class="text-center mt-3 mb-4">
                    <p class="text-xs font-bold text-red-500 uppercase tracking-wider">⚠ Mất cân bằng vi sinh</p>
                </div>
                <button id="btn-simulate" class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 active:scale-95 text-white font-bold rounded-2xl shadow-lg shadow-emerald-200 transition-all flex items-center justify-center gap-2 text-sm">
                    <i data-lucide="plus-circle" class="w-4 h-4" id="btn-simulate-icon"></i>
                    <span id="btn-simulate-text">Bổ sung Probiotics Trị liệu</span>
                </button>
            </div>
        </div>
    </section>

    <!-- ── Section 3: Barrier Simulation ── -->
    <section id="barrier" class="mb-16 scroll-mt-28 section-reveal">
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="shield" class="w-4 h-4 text-emerald-700"></i>
                </div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Màng ruột & sIgA</span>
            </div>
            <h2 class="font-serif font-bold text-2xl md:text-3xl text-slate-900">Trám Lại Lỗ Hổng Bằng sIgA</h2>
            <div class="h-1 w-16 bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full mt-3"></div>
        </header>

        <!-- Simulation Container -->
        <div class="bg-slate-900 rounded-3xl p-6 md:p-8 text-white overflow-hidden shadow-2xl mb-6 relative">
            <div class="absolute inset-0 opacity-5">
                <div class="absolute top-8 left-8 w-32 h-32 rounded-full bg-emerald-400 blur-3xl"></div>
                <div class="absolute bottom-8 right-8 w-24 h-24 rounded-full bg-blue-400 blur-2xl"></div>
            </div>

            <div class="relative z-10">
                <div class="text-center mb-8">
                    <span class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-800 text-emerald-400 text-[10px] font-bold rounded-full mb-3 uppercase tracking-widest border border-emerald-900">
                        <i data-lucide="activity" class="w-3 h-3"></i> Live Simulation
                    </span>
                    <h3 class="font-serif font-bold text-xl text-white">Hội chứng Rò rỉ ruột (Leaky Gut)</h3>
                    <p class="text-slate-400 text-sm mt-1">Quan sát cách độc tố lọt qua kẽ hở khi thiếu sIgA</p>
                </div>

                <!-- Gut Wall Simulation -->
                <div class="flex flex-col items-center justify-center min-h-[130px] mb-6" id="sim-container">
                    <!-- Toxins -->
                    <div class="flex justify-around w-full max-w-[280px] mb-5" id="toxin-area">
                        <div class="toxin-particle text-2xl filter drop-shadow-lg">☠️</div>
                        <div class="toxin-particle text-2xl filter drop-shadow-lg" style="transition-delay: 0.12s">🦠</div>
                        <div class="toxin-particle text-2xl filter drop-shadow-lg" style="transition-delay: 0.24s">☠️</div>
                        <div class="toxin-particle text-2xl filter drop-shadow-lg" style="transition-delay: 0.08s">🦠</div>
                    </div>

                    <!-- Gut Cells -->
                    <div class="flex items-end" id="cell-barrier">
                        <div class="gut-cell h-14 w-11 bg-pink-300 border-2 border-pink-400 rounded-t-xl shadow-sm"></div>
                        <div class="gut-gap h-14"></div>
                        <div class="gut-cell h-14 w-11 bg-pink-300 border-2 border-pink-400 rounded-t-xl shadow-sm"></div>
                        <div class="gut-gap h-14"></div>
                        <div class="gut-cell h-14 w-11 bg-pink-300 border-2 border-pink-400 rounded-t-xl shadow-sm"></div>
                        <div class="gut-gap h-14"></div>
                        <div class="gut-cell h-14 w-11 bg-pink-300 border-2 border-pink-400 rounded-t-xl shadow-sm"></div>
                        <div class="gut-gap h-14"></div>
                        <div class="gut-cell h-14 w-11 bg-pink-300 border-2 border-pink-400 rounded-t-xl shadow-sm"></div>
                    </div>
                    <div class="h-4 w-full max-w-[310px] bg-slate-800 rounded-b-lg border-t border-slate-700"></div>
                </div>

                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-slate-800/60 p-4 rounded-2xl border border-white/5 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div id="siga-status-dot" class="w-2 h-2 rounded-full bg-red-400 animate-pulse shrink-0"></div>
                        <p id="siga-msg" class="text-sm text-slate-300 italic">Trạng thái: Độc tố lọt vào máu, não bộ bị tấn công.</p>
                    </div>
                    <button id="btn-siga" class="px-5 py-2.5 bg-emerald-500 hover:bg-emerald-400 active:scale-95 text-slate-950 font-bold rounded-xl shadow-lg transition-all whitespace-nowrap flex items-center gap-2 text-sm shrink-0">
                        <i data-lucide="zap" class="w-4 h-4" id="siga-icon"></i>
                        <span id="siga-text">Kích hoạt sIgA</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Benefits Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all">
                <div class="bg-emerald-100 w-10 h-10 rounded-xl flex items-center justify-center mb-4">
                    <i data-lucide="shield-check" class="w-5 h-5 text-emerald-700"></i>
                </div>
                <h4 class="font-serif font-bold text-slate-900 mb-2">Bacteriocin</h4>
                <p class="text-sm text-slate-500 leading-relaxed">Kháng sinh nội sinh do lợi khuẩn tiết ra, trực tiếp ức chế nấm Candida, chấm dứt hiện tượng tạo độc tố gây "say rượu" ở trẻ.</p>
            </div>
            <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm hover:shadow-md hover:border-emerald-200 transition-all">
                <div class="bg-emerald-100 w-10 h-10 rounded-xl flex items-center justify-center mb-4">
                    <i data-lucide="battery-charging" class="w-5 h-5 text-emerald-700"></i>
                </div>
                <h4 class="font-serif font-bold text-slate-900 mb-2">Bảo toàn năng lượng</h4>
                <p class="text-sm text-slate-500 leading-relaxed">Khi màng ruột kín, hệ miễn dịch ngừng báo động đỏ. Cơ thể tiết kiệm ATP, giúp não bộ đủ năng lượng để tập trung và học tập.</p>
            </div>
        </div>
    </section>

    <!-- ── Section 4: Selection Criteria ── -->
    <section id="selection" class="mb-16 scroll-mt-28 section-reveal">
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="list-checks" class="w-4 h-4 text-emerald-700"></i>
                </div>
                <span class="text-xs font-bold text-emerald-600 uppercase tracking-widest">Hướng dẫn lựa chọn</span>
            </div>
            <h2 class="font-serif font-bold text-2xl md:text-3xl text-slate-900">Tiêu Chí Chọn Men Trị Liệu</h2>
            <div class="h-1 w-16 bg-gradient-to-r from-emerald-500 to-emerald-300 rounded-full mt-3"></div>
        </header>

        <div class="space-y-3 mb-8">
            <!-- Criteria 1 -->
            <div class="criteria-card flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm cursor-default">
                <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center font-serif font-bold text-lg shadow-sm">1</div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-serif font-bold text-slate-900 mb-1">Độ tinh khiết GFCFSF</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Cam kết 100% không chứa Gluten, Casein, Đậu nành, đường tinh luyện và phẩm màu. Phụ gia là "kẻ thù" của màng ruột đang viêm.</p>
                    <div class="flex flex-wrap gap-1.5 mt-3">
                        <span class="text-[11px] bg-red-50 text-red-600 border border-red-100 px-2 py-0.5 rounded-full font-semibold">✗ Gluten</span>
                        <span class="text-[11px] bg-red-50 text-red-600 border border-red-100 px-2 py-0.5 rounded-full font-semibold">✗ Casein</span>
                        <span class="text-[11px] bg-red-50 text-red-600 border border-red-100 px-2 py-0.5 rounded-full font-semibold">✗ Đậu nành</span>
                        <span class="text-[11px] bg-red-50 text-red-600 border border-red-100 px-2 py-0.5 rounded-full font-semibold">✗ Đường tinh luyện</span>
                    </div>
                </div>
            </div>

            <!-- Criteria 2 -->
            <div class="criteria-card flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm cursor-default">
                <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center font-serif font-bold text-lg shadow-sm">2</div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-serif font-bold text-slate-900 mb-1">Đa chủng (Multi-strain)</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Phải chứa từ 5–10 chủng trở lên với mật độ CFU cực cao để vượt qua rào cản axit dạ dày khắc nghiệt và đến đích đúng cách.</p>
                    <div class="mt-3 flex items-center gap-2">
                        <div class="flex-1 bg-slate-100 rounded-full h-1.5 overflow-hidden">
                            <div class="bg-emerald-500 h-1.5 rounded-full" style="width:85%"></div>
                        </div>
                        <span class="text-[11px] font-bold text-emerald-700 whitespace-nowrap">≥ 5–10 chủng</span>
                    </div>
                </div>
            </div>

            <!-- Criteria 3 -->
            <div class="criteria-card flex gap-4 p-5 bg-white border border-slate-100 rounded-2xl shadow-sm cursor-default">
                <div class="shrink-0 w-12 h-12 bg-gradient-to-br from-emerald-500 to-emerald-600 text-white rounded-2xl flex items-center justify-center font-serif font-bold text-lg shadow-sm">3</div>
                <div class="flex-1 min-w-0">
                    <h4 class="font-serif font-bold text-slate-900 mb-1">S. boulardii kháng nấm</h4>
                    <p class="text-sm text-slate-500 leading-relaxed">Cần sự hiện diện của chủng nấm men có lợi <em>Saccharomyces boulardii</em> để dọn dẹp triệt để nấm Candida xấu trong quá trình đi qua ruột.</p>
                    <div class="mt-3 inline-flex items-center gap-1.5 text-[11px] bg-emerald-50 text-emerald-700 border border-emerald-100 px-2.5 py-1 rounded-full font-bold">
                        <i data-lucide="check-circle" class="w-3 h-3"></i> Kháng khuẩn + kháng nấm
                    </div>
                </div>
            </div>
        </div>

        <!-- Prebiotics Banner -->
        <div class="bg-gradient-to-br from-teal-800 to-emerald-800 text-white rounded-3xl p-6 md:p-8 flex flex-col sm:flex-row items-center gap-5 shadow-xl">
            <div class="bg-white/10 rounded-2xl p-4 shrink-0">
                <span class="text-4xl">🥦</span>
            </div>
            <div>
                <h4 class="font-serif font-bold text-lg mb-1.5">Đừng quên Prebiotics!</h4>
                <p class="text-teal-100 text-sm leading-relaxed">
                    Lợi khuẩn chỉ ăn chất xơ thực vật. Hãy bổ sung <strong class="text-white">măng tây, chuối xanh, khoai lang</strong> để "nuôi quân" — giúp đội ngũ thợ xây phát triển bền vững lâu dài.
                </p>
            </div>
        </div>
    </section>

    <!-- ── Section 5: Safety / Die-off ── -->
    <section id="safety" class="mb-16 scroll-mt-28 section-reveal">
        <header class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <div class="w-8 h-8 bg-amber-100 rounded-xl flex items-center justify-center">
                    <i data-lucide="triangle-alert" class="w-4 h-4 text-amber-600"></i>
                </div>
                <span class="text-xs font-bold text-amber-600 uppercase tracking-widest">Quan trọng</span>
            </div>
            <h2 class="font-serif font-bold text-2xl md:text-3xl text-slate-900">Lưu Ý & Phản Ứng Die-off</h2>
            <div class="h-1 w-16 bg-gradient-to-r from-amber-500 to-amber-300 rounded-full mt-3"></div>
        </header>

        <div class="bg-white rounded-3xl border-2 border-amber-200 overflow-hidden shadow-sm">
            <!-- Warning Header -->
            <div class="bg-gradient-to-r from-amber-500 to-amber-400 px-6 py-4 text-white flex items-center gap-3">
                <div class="bg-white/20 rounded-lg p-1.5">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
                <div>
                    <p class="font-serif font-bold text-base">Cảnh báo: Hiện tượng Herxheimer (Die-off)</p>
                    <p class="text-amber-100 text-xs mt-0.5">Phản ứng có thể xảy ra trong 1–2 tuần đầu</p>
                </div>
            </div>

            <div class="p-6 md:p-8">
                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 mb-6">
                    <p class="font-serif font-bold text-amber-900 text-base mb-2">🏅 Quy tắc vàng: "Chậm và Ít"</p>
                    <p class="text-sm text-amber-800 leading-relaxed">
                        Khi lợi khuẩn tiêu diệt nấm men, xác chết nấm giải phóng độc tố vào máu <em>trước khi</em> bị đào thải. Trong giai đoạn này, trẻ có thể biểu hiện:
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-6">
                    <div class="flex flex-col items-center gap-2 bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                        <span class="text-2xl">💩</span>
                        <span class="text-xs font-bold text-amber-700">Đi ngoài phân lỏng</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                        <span class="text-2xl">💨</span>
                        <span class="text-xs font-bold text-amber-700">Xì hơi nhiều</span>
                    </div>
                    <div class="flex flex-col items-center gap-2 bg-slate-50 rounded-2xl p-4 border border-slate-100 text-center">
                        <span class="text-2xl">😤</span>
                        <span class="text-xs font-bold text-amber-700">Tăng bứt rứt</span>
                    </div>
                </div>

                <div class="flex items-start gap-3 p-4 bg-emerald-50 rounded-2xl border border-dashed border-emerald-200">
                    <i data-lucide="info" class="w-4 h-4 text-emerald-600 mt-0.5 shrink-0"></i>
                    <p class="text-sm text-emerald-800 leading-relaxed">
                        <strong>Tăng liều cực nhỏ từng bước</strong> giúp gan có thời gian dọn dẹp nội môi mà không bị quá tải. Đây là quá trình tự nhiên — kiên nhẫn là chìa khóa.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── Section 6: Contact ── -->
    <footer id="contact" class="scroll-mt-28 section-reveal">
        <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-3xl p-6 md:p-10 border border-emerald-100 shadow-sm">
            <div class="text-center mb-8">
                <span class="text-3xl mb-3 block">🤝</span>
                <h3 class="font-serif font-bold text-xl md:text-2xl text-emerald-900 mb-2">Đồng Hành Cùng Gia Đình Bạn</h3>
                <p class="text-sm text-emerald-700/80">Kết nối với cộng đồng và chuyên gia để được hỗ trợ tốt nhất</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mb-8">
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl hover:bg-emerald-50 transition-all border border-white hover:border-emerald-200 shadow-sm hover:shadow-md group">
                    <div class="bg-blue-100 rounded-xl p-2.5 shrink-0">
                        <span class="text-xl">👥</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-sm font-bold text-slate-800 block group-hover:text-emerald-800 transition-colors">Cộng đồng Hiểu con từ Gốc</span>
                        <span class="text-xs text-slate-400">Facebook Group</span>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 ml-auto transition-colors shrink-0"></i>
                </a>

                <a href="https://zalo.me/g/vmgfxy834" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl hover:bg-emerald-50 transition-all border border-white hover:border-emerald-200 shadow-sm hover:shadow-md group">
                    <div class="bg-sky-100 rounded-xl p-2.5 shrink-0">
                        <span class="text-xl">💬</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-sm font-bold text-slate-800 block group-hover:text-emerald-800 transition-colors">Nhóm Zalo Giải đáp</span>
                        <span class="text-xs text-slate-400">Hỏi đáp trực tiếp</span>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 ml-auto transition-colors shrink-0"></i>
                </a>

                <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-white shadow-sm">
                    <div class="bg-emerald-100 rounded-xl p-2.5 shrink-0">
                        <span class="text-xl">📞</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-sm font-bold text-slate-800 block">Hotline tư vấn</span>
                        <span class="text-xs text-emerald-600 font-bold">0988.717.107</span>
                    </div>
                </div>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-4 p-4 bg-white rounded-2xl hover:bg-emerald-50 transition-all border border-white hover:border-emerald-200 shadow-sm hover:shadow-md group">
                    <div class="bg-emerald-100 rounded-xl p-2.5 shrink-0">
                        <span class="text-xl">👤</span>
                    </div>
                    <div class="min-w-0">
                        <span class="text-sm font-bold text-slate-800 block group-hover:text-emerald-800 transition-colors">Trợ lý Nam Khánh</span>
                        <span class="text-xs text-slate-400">Facebook cá nhân</span>
                    </div>
                    <i data-lucide="arrow-up-right" class="w-4 h-4 text-slate-300 group-hover:text-emerald-500 ml-auto transition-colors shrink-0"></i>
                </a>
            </div>

            <div class="pt-6 border-t border-emerald-200 text-[10px] text-emerald-600/60 text-justify uppercase tracking-tight leading-relaxed">
                Bài viết chỉ nhằm mục đích cung cấp thông tin khoa học và giáo dục cộng đồng, hoàn toàn không thay thế cho các chẩn đoán hay phác đồ điều trị y khoa chuyên nghiệp.
            </div>
        </div>
    </footer>

</article>
</main>

<!-- ════════════════════════════════════════════ -->
<!-- SCRIPTS -->
<!-- ════════════════════════════════════════════ -->
<script>
    // Init Lucide Icons
    lucide.createIcons({ strokeWidth: 1.5 });

    // ── Reading Progress Bar ──
    window.addEventListener('scroll', () => {
        const winScroll = document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        document.getElementById('progress-bar').style.width = ((winScroll / height) * 100) + '%';

        // Update active nav link
        const sections = ['intro', 'mechanism', 'barrier', 'selection', 'safety', 'contact'];
        sections.forEach(id => {
            const el = document.getElementById(id);
            if (!el) return;
            const rect = el.getBoundingClientRect();
            const navBtn = document.getElementById('nav-' + id);
            if (!navBtn) return;
            if (rect.top >= 0 && rect.top <= 180) {
                document.querySelectorAll('nav button').forEach(b => {
                    b.classList.remove('nav-link-active');
                    b.classList.add('text-slate-400');
                    b.classList.remove('text-slate-800');
                });
                navBtn.classList.add('nav-link-active');
                navBtn.classList.remove('text-slate-400');
            }
        });
    });

    // ── Smooth Scroll ──
    function scrollToSection(id) {
        document.getElementById(id)?.scrollIntoView({ behavior: 'smooth' });
    }

    // ── Section Reveal on Scroll ──
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible');
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.1 });

    document.querySelectorAll('.section-reveal').forEach(el => observer.observe(el));

    // ── Chart.js Setup ──
    const gutStats = {
        unbalanced: [65, 15, 20],
        balanced: [8, 87, 5]
    };
    let chartSimulated = false;

    const ctx = document.getElementById('gutChart').getContext('2d');
    const gutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Hại khuẩn', 'Lợi khuẩn', 'Nấm men'],
            datasets: [{
                data: gutStats.unbalanced,
                backgroundColor: ['#f87171', '#10b981', '#fbbf24'],
                borderWidth: 0,
                hoverOffset: 12,
                borderRadius: 4,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: (ctx) => ` ${ctx.label}: ${ctx.parsed}%`
                    }
                }
            },
            cutout: '72%',
            animation: { duration: 1200, easing: 'easeOutQuart' }
        }
    });

    // ── Probiotics Simulator ──
    document.getElementById('btn-simulate').addEventListener('click', function() {
        const statusEl = document.getElementById('chart-status');
        const iconEl  = document.getElementById('btn-simulate-icon');
        const textEl  = document.getElementById('btn-simulate-text');

        if (!chartSimulated) {
            gutChart.data.datasets[0].data = gutStats.balanced;
            statusEl.innerHTML = '<p class="text-xs font-bold text-emerald-600 uppercase tracking-wider">✓ Cân bằng vi sinh phục hồi</p>';
            textEl.textContent = 'Khôi phục trạng thái ban đầu';
            iconEl.setAttribute('data-lucide', 'rotate-ccw');
            this.classList.replace('bg-emerald-600', 'bg-slate-600');
            this.classList.replace('hover:bg-emerald-700', 'hover:bg-slate-700');
            chartSimulated = true;
        } else {
            gutChart.data.datasets[0].data = gutStats.unbalanced;
            statusEl.innerHTML = '<p class="text-xs font-bold text-red-500 uppercase tracking-wider">⚠ Mất cân bằng vi sinh</p>';
            textEl.textContent = 'Bổ sung Probiotics Trị liệu';
            iconEl.setAttribute('data-lucide', 'plus-circle');
            this.classList.replace('bg-slate-600', 'bg-emerald-600');
            this.classList.replace('hover:bg-slate-700', 'hover:bg-emerald-700');
            chartSimulated = false;
        }
        gutChart.update();
        lucide.createIcons({ strokeWidth: 1.5 });
    });

    // ── sIgA Simulator ──
    document.getElementById('btn-siga').addEventListener('click', function() {
        const container = document.getElementById('sim-container');
        const msg       = document.getElementById('siga-msg');
        const dot       = document.getElementById('siga-status-dot');
        const textEl    = document.getElementById('siga-text');
        const iconEl    = document.getElementById('siga-icon');

        if (!container.classList.contains('siga-active')) {
            container.classList.add('siga-active');
            msg.innerHTML = '<span class="text-emerald-400 font-bold">Thành công: sIgA đã trám kín lỗ hổng, bảo vệ tế bào não!</span>';
            dot.classList.replace('bg-red-400', 'bg-emerald-400');
            dot.classList.remove('animate-pulse');
            textEl.textContent = 'Gỡ bỏ lớp trám';
            iconEl.setAttribute('data-lucide', 'zap-off');
            this.classList.replace('bg-emerald-500', 'bg-slate-600');
            this.classList.replace('hover:bg-emerald-400', 'hover:bg-slate-500');
            this.classList.add('text-white');
            this.classList.remove('text-slate-950');
        } else {
            container.classList.remove('siga-active');
            msg.textContent = 'Trạng thái: Độc tố lọt vào máu, não bộ bị tấn công.';
            dot.classList.replace('bg-emerald-400', 'bg-red-400');
            dot.classList.add('animate-pulse');
            textEl.textContent = 'Kích hoạt sIgA';
            iconEl.setAttribute('data-lucide', 'zap');
            this.classList.replace('bg-slate-600', 'bg-emerald-500');
            this.classList.replace('hover:bg-slate-500', 'hover:bg-emerald-400');
            this.classList.remove('text-white');
            this.classList.add('text-slate-950');
        }
        lucide.createIcons({ strokeWidth: 1.5 });
    });
</script>

</body>
</html>
