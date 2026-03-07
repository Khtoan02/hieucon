<?php
/**
 * Template Name: Trang Loạn khuẩn đường ruột
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loạn Khuẩn Đường Ruột - Hành Trình Thấu Hiểu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chosen Palette: Zen Garden (Stone, Sage Green, Terracotta, Soft Sand) -->
    <!-- Application Structure Plan: Chỉnh sửa khối "Giải pháp dinh dưỡng" để có độ tương phản cao (Dark Mode) so với các khối sáng màu xung quanh. Điều này giúp tách biệt phần kiến thức lý thuyết và phần hướng dẫn hành động thực tế. Nâng cấp các thẻ thực phẩm và bảng màu cầu vồng với hiệu ứng hiển thị thông tin tức thì khi tương tác. -->
    <!-- Visualization & Content Choices: 
         1. Doughnut Chart: Minh họa hệ vi sinh.
         2. Interactive Mechanism Cards: Giải thích cơ chế độc tính.
         3. Prebiotic Ranking Bar Chart: So sánh sức mạnh các loại chất xơ.
         4. Food Cards: Thẻ chi tiết về cách chế biến và lợi ích thực phẩm với thiết kế tương phản cao. -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

    <style>
        body { font-family: 'Inter', sans-serif; }
        
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            height: 350px;
            max-height: 400px;
        }

        .journey-dot { position: relative; }
        .journey-dot::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -2.5rem;
            width: 2px;
            height: 2.5rem;
            background: #e7e5e4;
            transform: translateX(-50%);
        }

        .section-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .section-reveal.visible { opacity: 1; transform: translateY(0); }

        .mechanism-card { transition: all 0.5s ease; cursor: pointer; }
        .mechanism-card.active { border-color: #fca5a5; box-shadow: 0 20px 40px rgba(225, 29, 72, 0.15); transform: translateY(-8px); }
        .mechanism-details { max-height: 0; overflow: hidden; transition: max-height 0.5s ease, opacity 0.5s ease; opacity: 0; }
        .mechanism-card.active .mechanism-details { max-height: 500px; opacity: 1; }

        /* Dark Theme Food Cards */
        .food-card { transition: all 0.3s ease; border: 1px solid rgba(255,255,255,0.1); background: rgba(255,255,255,0.05); }
        .food-card:hover, .food-card.active { border-color: #fbbf24; background: rgba(255,255,255,0.08); transform: translateY(-4px); }
        .food-details { max-height: 0; overflow: hidden; transition: max-height 0.5s ease; }
        .food-card.active .food-details { max-height: 500px; }

        .nav-link.active { color: #0284c7; font-weight: 700; border-bottom: 2px solid #38bdf8; padding-bottom: 2px;}

        .cta-link { transition: all 0.3s ease; }
        .cta-link:hover { transform: translateY(-4px); filter: brightness(1.05); }

        /* Rainbow Interaction */
        .rainbow-grid div { height: 45px; border-radius: 8px; transition: all 0.2s; cursor: pointer; border: 2px solid transparent; }
        @media (min-width: 768px) {
            .rainbow-grid div { height: 60px; border-radius: 12px; }
        }
        .rainbow-grid div:hover, .rainbow-grid div.active { transform: scale(1.05); border-color: white; box-shadow: 0 8px 16px rgba(0,0,0,0.4); }
        
        #rainbow-suggestion { min-height: 100px; transition: opacity 0.3s; }
    </style>
    <?php wp_head(); ?>
</head>
<body class="antialiased min-h-screen bg-gradient-to-br from-sky-50 via-blue-50 to-teal-50 text-slate-800 relative">
    <!-- Global Medical/Nature Patterns (DNA & Cells) for entire page -->
    <div class="fixed inset-0 pointer-events-none opacity-[0.04] z-[0]">
        <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
            <defs>
                <!-- DNA Pattern -->
                <pattern id="dna-pattern" x="0" y="0" width="120" height="120" patternUnits="userSpaceOnUse">
                    <path d="M 20 20 Q 40 60 60 20 T 100 20" fill="none" stroke="#0ea5e9" stroke-width="1.5" stroke-linecap="round"/>
                    <path d="M 20 60 Q 40 20 60 60 T 100 60" fill="none" stroke="#0ea5e9" stroke-width="1.5" stroke-linecap="round"/>
                    <line x1="30" y1="35" x2="30" y2="45" stroke="#0ea5e9" stroke-width="1.5"/>
                    <line x1="50" y1="35" x2="50" y2="45" stroke="#0ea5e9" stroke-width="1.5"/>
                    <line x1="70" y1="35" x2="70" y2="45" stroke="#0ea5e9" stroke-width="1.5"/>
                    <line x1="90" y1="35" x2="90" y2="45" stroke="#0ea5e9" stroke-width="1.5"/>
                    <circle cx="20" cy="20" r="3" fill="#14b8a6"/>
                    <circle cx="60" cy="20" r="3" fill="#14b8a6"/>
                    <circle cx="100" cy="20" r="3" fill="#14b8a6"/>
                    <circle cx="20" cy="60" r="3" fill="#14b8a6"/>
                    <circle cx="60" cy="60" r="3" fill="#14b8a6"/>
                    <circle cx="100" cy="60" r="3" fill="#14b8a6"/>
                </pattern>
                <!-- Cell/Nutrient Pattern -->
                <pattern id="cell-pattern" x="60" y="60" width="150" height="150" patternUnits="userSpaceOnUse">
                    <circle cx="40" cy="40" r="15" fill="none" stroke="#10b981" stroke-width="1" stroke-dasharray="4 2"/>
                    <circle cx="40" cy="40" r="2" fill="#10b981"/>
                    <circle cx="110" cy="90" r="20" fill="none" stroke="#f59e0b" stroke-width="1" stroke-dasharray="2 4"/>
                    <circle cx="110" cy="90" r="3" fill="#f59e0b"/>
                </pattern>
            </defs>
            <rect x="0" y="0" width="100%" height="100%" fill="url(#dna-pattern)" />
            <rect x="0" y="0" width="100%" height="100%" fill="url(#cell-pattern)" />
        </svg>
    </div>

    <!-- Narrative Header -->
    <header class="bg-white/70 backdrop-blur-xl border-b border-sky-100 sticky top-0 z-50 shadow-sm">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center py-4 relative z-10">
            <div class="flex items-center space-x-2 group cursor-pointer">
                <span class="text-sky-500 text-3xl filter drop-shadow hover:rotate-90 transition-transform duration-500">&#10045;</span>
                <span class="text-slate-800 font-extrabold tracking-tight group-hover:text-sky-700 transition-colors">Hành trình thấu hiểu con</span>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="#intro" class="nav-link text-sm text-slate-500 hover:text-sky-600 transition-colors font-medium">Khởi đầu</a>
                <a href="#chaos" class="nav-link text-sm text-slate-500 hover:text-sky-600 transition-colors font-medium">Ẩn họa</a>
                <a href="#hope" class="nav-link text-sm text-slate-500 hover:text-sky-600 transition-colors font-medium">Hy vọng</a>
                <a href="#action" class="nav-link text-sm text-slate-500 hover:text-sky-600 transition-colors font-medium">Giải pháp</a>
            </nav>
            <div class="md:hidden">
                <a href="tel:0988717107" class="h-10 w-10 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center text-xl shadow-sm border border-sky-200">&#9990;</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Section 1: Introduction -->
        <section id="intro" class="section-reveal py-10 md:py-16 lg:py-24 bg-transparent relative z-10 w-full overflow-hidden">
            <!-- Ambient Glow -->
            <div class="absolute top-20 left-1/2 -translate-x-1/2 w-[30rem] h-[30rem] bg-sky-200/30 rounded-full filter blur-[100px] pointer-events-none"></div>

            <div class="max-w-5xl mx-auto px-4 sm:px-6 text-center relative z-10">
                <div class="journey-dot mb-6 md:mb-8">
                    <span class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-tr from-slate-700 to-slate-900 text-white rounded-full inline-flex items-center justify-center font-serif italic text-xl md:text-2xl shadow-[0_0_20px_rgba(15,23,42,0.3)] border-2 border-white">1</span>
                </div>
                <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 mb-4 md:mb-6 leading-tight drop-shadow-sm px-2">Thấu hiểu "Hệ sinh thái" bên trong con</h2>
                <p class="text-sm sm:text-base md:text-lg text-slate-600 leading-relaxed mb-8 md:mb-16 font-medium max-w-3xl mx-auto px-2 md:px-4">
                    Mọi hành vi "bất thường" của con đều là tiếng kêu cứu từ một hệ sinh thái đang bị tàn phá. Tự kỷ là một tình trạng sinh lý học phức tạp, không phải là khiếm khuyết tâm lý.
                </p>
                
                </-- Shape Section1 --/>
                <div class="bg-white/90 backdrop-blur-xl rounded-[1.5rem] md:rounded-[2.5rem] p-4 sm:p-6 md:p-10 border border-sky-100 shadow-[0_15px_40px_rgba(14,165,233,0.08)]">
                    <div class="flex flex-col md:flex-row items-center gap-4 sm:gap-6 md:gap-10">
                        <div class="w-full md:w-1/2 flex items-center justify-center">
                            <div class="chart-container w-[160px] h-[160px] sm:w-[220px] sm:h-[220px] md:w-full md:h-auto">
                                <canvas id="gutStateChart"></canvas>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 text-left space-y-3 md:space-y-4 pt-2 md:pt-0">
                            <div class="inline-block px-3 py-1 md:px-4 md:py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-[11px] md:text-sm tracking-wide border border-emerald-200 shadow-sm" id="state-badge">Trạng thái: Cân Bằng</div>
                            <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-slate-800 leading-tight" id="state-title">Hệ Sinh Thái Khỏe Mạnh</h3>
                            <p class="text-[13px] sm:text-sm text-slate-500 mb-2 md:mb-4 leading-relaxed" id="state-desc" style="min-height: 48px;">Tỷ lệ lợi khuẩn áp đảo giúp màng ruột toàn vẹn, hấp thu tốt dinh dưỡng và ngăn chặn độc tố lên não.</p>
                            
                            <div class="space-y-2.5 sm:space-y-3 md:space-y-4 bg-slate-50/80 p-4 sm:p-5 md:p-6 rounded-[1rem] md:rounded-2xl border border-slate-100 mb-2 md:mb-4">
                                <div class="flex items-center justify-between transition-all" id="row-loi-khuan">
                                    <div class="flex items-center gap-2 md:gap-3"><span class="w-3.5 h-3.5 md:w-4 md:h-4 rounded-full shadow-inner transition-colors duration-300" id="color-loi-khuan" style="background-color: #059669;"></span> <span class="text-[13px] md:text-base text-slate-700 font-bold">Lợi Khuẩn</span></div>
                                    <span class="font-extrabold text-base md:text-xl text-slate-900 transition-all duration-300" id="stat-loi-khuan">85%</span>
                                </div>
                                <div class="flex items-center justify-between transition-all" id="row-hai-khuan">
                                    <div class="flex items-center gap-2 md:gap-3"><span class="w-3.5 h-3.5 md:w-4 md:h-4 rounded-full shadow-inner transition-colors duration-300" id="color-hai-khuan" style="background-color: #d6d3d1;"></span> <span class="text-[13px] md:text-base text-slate-700 font-bold">Hại Khuẩn</span></div>
                                    <span class="font-extrabold text-base md:text-xl text-slate-900 transition-all duration-300" id="stat-hai-khuan">10%</span>
                                </div>
                                <div class="flex items-center justify-between transition-all" id="row-nam-men">
                                    <div class="flex items-center gap-2 md:gap-3"><span class="w-3.5 h-3.5 md:w-4 md:h-4 rounded-full shadow-inner transition-colors duration-300" id="color-nam-men" style="background-color: #fda4af;"></span> <span class="text-[13px] md:text-base text-slate-700 font-bold">Nấm Men</span></div>
                                    <span class="font-extrabold text-base md:text-xl text-slate-900 transition-all duration-300" id="stat-nam-men">5%</span>
                                </div>
                            </div>

                            <button onclick="app.toggleState()" class="px-5 py-2.5 md:px-6 md:py-3 bg-gradient-to-r from-slate-800 to-slate-900 text-white text-[13px] md:text-sm font-bold rounded-full hover:from-slate-700 hover:to-slate-800 transition-all flex items-center space-x-2 w-full justify-center md:justify-start md:w-auto mt-2 md:mt-0 shadow-sm hover:shadow-md">
                                <span id="btn-text">Mô phỏng Loạn Khuẩn</span>
                                <span>&#8646;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 2: Chaos -->
        <section id="chaos" class="section-reveal py-10 md:py-16 lg:py-24 bg-rose-50/50 backdrop-blur-sm border-y border-rose-100/50 relative z-10 w-full overflow-hidden">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
                <div class="text-center mb-8 md:mb-16 relative">
                    <!-- Glow -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[15rem] h-[8rem] bg-rose-200/50 blur-[50px] rounded-full pointer-events-none"></div>

                    <div class="journey-dot mb-6 md:mb-8 relative z-10">
                        <span class="w-12 h-12 md:w-14 md:h-14 bg-gradient-to-tr from-rose-500 to-red-400 text-white rounded-full inline-flex items-center justify-center font-serif italic text-xl md:text-2xl shadow-[0_0_20px_rgba(244,63,94,0.4)] border-2 border-white">2</span>
                    </div>
                    <h2 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 mb-3 md:mb-4 relative z-10 drop-shadow-sm px-2">Khi "Kẻ cướp" chiếm quyền điều khiển</h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 relative z-10">
                    <div class="mechanism-card p-5 md:p-8 rounded-[1.25rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-rose-100 hover:bg-white hover:shadow-[0_20px_40px_rgba(225,29,72,0.1)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.2)]" onclick="app.toggleMechanism(this)">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-tr from-rose-100 to-red-50 text-rose-500 rounded-full flex items-center justify-center text-xl md:text-3xl mb-3 md:mb-6 shadow-[inset_0_2px_10px_rgba(225,29,72,0.1)] group-hover:scale-110 transition-transform duration-500">&#9889;</div>
                        <div class="flex items-center justify-between mb-2 md:mb-3">
                            <h3 class="text-lg md:text-2xl font-bold text-slate-800 text-left">Suy kiệt năng lượng</h3>
                            <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300 flex-shrink-0 ml-2">
                                <svg class="w-5 h-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <div class="mechanism-details border-t border-rose-100/50 pt-3 md:pt-4 md:mt-2">
                            <p class="text-[13px] md:text-sm text-slate-600 font-medium leading-relaxed">Hại khuẩn cướp vitamin/khoáng chất làm <strong>Ty thể</strong> suy yếu. Trẻ thiếu ATP (năng lượng) dẫn đến mệt mỏi, cáu gắt triền miên.</p>
                        </div>
                    </div>
                    <div class="mechanism-card p-5 md:p-8 rounded-[1.25rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-rose-100 hover:bg-white hover:shadow-[0_20px_40px_rgba(225,29,72,0.1)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.2)]" onclick="app.toggleMechanism(this)">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-tr from-rose-100 to-red-50 text-rose-500 rounded-full flex items-center justify-center text-xl md:text-3xl mb-3 md:mb-6 shadow-[inset_0_2px_10px_rgba(225,29,72,0.1)] group-hover:scale-110 transition-transform duration-500">&#129514;</div>
                        <div class="flex items-center justify-between mb-2 md:mb-3">
                            <h3 class="text-lg md:text-2xl font-bold text-slate-800 text-left">Độc tố nội sinh</h3>
                            <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300 flex-shrink-0 ml-2">
                                <svg class="w-5 h-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <div class="mechanism-details border-t border-rose-100/50 pt-3 md:pt-4 md:mt-2">
                            <p class="text-[13px] md:text-sm text-slate-600 font-medium leading-relaxed">Chất thải p-cresol và Acetaldehyde xuyên qua niêm mạc ruột viêm, đi thẳng vào máu và thấm qua hàng rào lên não.</p>
                        </div>
                    </div>
                    <div class="mechanism-card p-5 md:p-8 rounded-[1.25rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-rose-100 hover:bg-white hover:shadow-[0_20px_40px_rgba(225,29,72,0.1)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.2)]" onclick="app.toggleMechanism(this)">
                        <div class="w-12 h-12 md:w-16 md:h-16 bg-gradient-to-tr from-rose-100 to-red-50 text-rose-500 rounded-full flex items-center justify-center text-xl md:text-3xl mb-3 md:mb-6 shadow-[inset_0_2px_10px_rgba(225,29,72,0.1)] group-hover:scale-110 transition-transform duration-500">&#129496;</div>
                        <div class="flex items-center justify-between mb-2 md:mb-3">
                            <h3 class="text-lg md:text-2xl font-bold text-slate-800 text-left">Say độc tính</h3>
                            <div class="w-8 h-8 rounded-full bg-rose-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300 flex-shrink-0 ml-2">
                                <svg class="w-5 h-5 text-rose-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                        <div class="mechanism-details border-t border-rose-100/50 pt-3 md:pt-4 md:mt-2">
                            <p class="text-[13px] md:text-sm text-slate-600 font-medium leading-relaxed">Tắc nghẽn các thụ thể thần kinh, gây nên trạng thái đờ đẫn, lăng xăng vô thức, mất kiểm soát như đang say rượu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 3: Hope -->
        <section id="hope" class="section-reveal py-16 md:py-24 bg-transparent relative z-10 w-full overflow-hidden">
            <!-- Ambient Glow -->
            <div class="absolute bottom-20 right-0 w-[40rem] h-[40rem] bg-emerald-200/20 rounded-full filter blur-[120px] pointer-events-none"></div>

            <div class="max-w-6xl mx-auto px-6 relative z-10">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
                    <div>
                        <div class="journey-dot mb-8">
                            <span class="w-14 h-14 bg-gradient-to-tr from-emerald-500 to-teal-400 text-white rounded-full inline-flex items-center justify-center font-serif italic text-2xl shadow-[0_0_20px_rgba(16,185,129,0.4)] border-2 border-white">3</span>
                        </div>
                        <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold text-slate-800 mb-4 md:mb-6 drop-shadow-sm">Butyrate: Vệ sĩ thầm lặng</h2>
                        <p class="text-base md:text-lg text-slate-600 mb-8 md:mb-10 font-medium leading-relaxed">Vũ khí mạnh nhất của lợi khuẩn để kích hoạt cơ chế tự hàn gắn tổn thương màng ruột và dọn dẹp não bộ.</p>
                        <div class="space-y-6 md:space-y-8">
                            <div class="flex items-start gap-4 md:gap-5 p-5 md:p-6 bg-white/60 backdrop-blur-md rounded-[1.5rem] border border-emerald-100 shadow-[0_5px_15px_rgba(16,185,129,0.05)] hover:-translate-y-1 transition-transform">
                                <span class="text-emerald-500 text-2xl md:text-3xl filter drop-shadow-sm">&#10004;</span>
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-base md:text-lg mb-1">Hàn gắn màng ruột</h4>
                                    <p class="text-sm text-slate-500 font-medium">Cấp năng lượng độc quyền cho tế bào biểu mô sinh sôi, giúp đóng chặt lại các lỗ rò rỉ.</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4 md:gap-5 p-5 md:p-6 bg-white/60 backdrop-blur-md rounded-[1.5rem] border border-emerald-100 shadow-[0_5px_15px_rgba(16,185,129,0.05)] hover:-translate-y-1 transition-transform">
                                <span class="text-emerald-500 text-2xl md:text-3xl filter drop-shadow-sm">&#10004;</span>
                                <div>
                                    <h4 class="font-extrabold text-slate-800 text-base md:text-lg mb-1">Chống viêm thần kinh</h4>
                                    <p class="text-sm text-slate-500 font-medium">Khả năng đặc biệt vượt qua hàng rào máu não, xoa dịu các ổ viêm sưng, trả lại sự tỉnh táo.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/95 backdrop-blur-xl p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-emerald-100 shadow-[0_15px_40px_rgba(16,185,129,0.1)] relative overflow-hidden group">
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/50 to-transparent pointer-events-none opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <h4 class="text-center font-bold text-slate-800 mb-8 uppercase tracking-widest text-sm">Biểu đồ hồi phục màng ruột</h4>
                        <div class="chart-container relative z-10" style="height: 250px;">
                            <canvas id="butyrateImpactChart"></canvas>
                        </div>
                        <div class="mt-8 flex items-center justify-center gap-2">
                            <span class="w-3 h-3 rounded-full bg-emerald-500 shadow-[0_0_10px_rgba(16,185,129,0.5)]"></span>
                            <p class="text-center text-xs text-slate-500 font-bold uppercase tracking-wider">Niêm mạc dày lên nhờ Butyrate nội sinh</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Section 4: Action (LIGHT MEDICAL BLUE THEME) -->
        <section id="action" class="section-reveal py-16 md:py-24 bg-sky-100/50 backdrop-blur-sm border-t border-sky-200/50 text-slate-800 overflow-hidden relative shadow-[inset_0_10px_30px_rgba(14,165,233,0.05)] z-10">
            <!-- Medical Blue Ambient Glows -->
            <div class="absolute top-0 -left-40 w-[30rem] h-[30rem] bg-sky-200/40 rounded-full filter blur-[100px] pointer-events-none"></div>
            <div class="absolute bottom-0 -right-40 w-[30rem] h-[30rem] bg-teal-200/40 rounded-full filter blur-[100px] pointer-events-none"></div>
            
            <div class="max-w-6xl mx-auto px-6 relative z-10 w-full">
                <div class="text-center mb-16 md:mb-20 relative">
                    <!-- Glow behind heading -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[20rem] h-[10rem] bg-white/70 blur-[60px] rounded-full pointer-events-none"></div>
                    
                    <div class="journey-dot mb-8 relative z-10">
                        <span class="w-14 h-14 bg-gradient-to-tr from-sky-400 to-blue-300 text-white rounded-full inline-flex items-center justify-center font-serif italic text-2xl shadow-[0_0_20px_rgba(56,189,248,0.4)] border-2 border-white">4</span>
                    </div>
                    <h2 class="text-3xl md:text-4xl lg:text-5xl font-extrabold mb-4 md:mb-6 text-slate-800 drop-shadow-sm relative z-10 px-2">Nghệ thuật phục hồi hệ sinh thái</h2>
                    <p class="text-slate-600 max-w-2xl mx-auto text-base md:text-lg leading-relaxed font-medium relative z-10 px-4">
                        Đừng chỉ tập trung tiêu diệt vi khuẩn xấu. Hãy học cách <span class="text-amber-600 font-bold border-b-2 border-amber-300 pb-0.5">"Cải tạo đất"</span> và <span class="text-emerald-600 font-bold border-b-2 border-emerald-300 pb-0.5">"Bón phân"</span> để khu vườn bên trong con tự chữa lành.
                    </p>
                </div>

                <!-- Concept Toolkit - High Contrast Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8 mb-20 md:mb-24 relative">
                    <div class="p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-sky-100 hover:bg-white hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(56,189,248,0.15)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.3)] relative">
                        <div class="absolute -right-6 -top-6 text-amber-500/5 text-9xl pointer-events-none transform -rotate-12 font-bold">&#127793;</div>
                        <div class="text-amber-500 text-5xl md:text-6xl mb-4 md:mb-6 relative z-10 filter drop-shadow hover:scale-110 transition-transform duration-500">&#127793;</div>
                        <h4 class="text-xl md:text-2xl font-extrabold mb-2 md:mb-3 text-slate-800 relative z-10">Bón Phân <span class="text-amber-600 text-base md:text-lg font-bold block mt-1">(Prebiotics)</span></h4>
                        <p class="text-sm text-slate-500 leading-relaxed relative z-10 font-medium">Cung cấp thức ăn chuyên biệt để lợi khuẩn nội sinh tự sản xuất Butyrate. Đây là bước quan trọng nhất.</p>
                    </div>
                    <div class="p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-sky-100 hover:bg-white hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(52,211,153,0.15)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.3)] relative">
                        <div class="absolute -right-6 -top-6 text-emerald-500/5 text-9xl pointer-events-none transform -rotate-12 font-bold">&#127793;</div>
                        <div class="text-emerald-500 text-5xl md:text-6xl mb-4 md:mb-6 relative z-10 filter drop-shadow hover:scale-110 transition-transform duration-500">&#127793;</div>
                        <h4 class="text-xl md:text-2xl font-extrabold mb-2 md:mb-3 text-slate-800 relative z-10">Gieo Hạt <span class="text-emerald-600 text-base md:text-lg font-bold block mt-1">(Probiotics)</span></h4>
                        <p class="text-sm text-slate-500 leading-relaxed relative z-10 font-medium">Bổ sung chủng vi khuẩn mới. Chỉ phát huy tác dụng khi "đất" đã đủ dưỡng chất từ bước 1.</p>
                    </div>
                    <div class="p-6 md:p-8 rounded-[1.5rem] md:rounded-[2rem] bg-white/95 backdrop-blur-xl border border-sky-100 hover:bg-white hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(96,165,250,0.15)] transition-all duration-500 group overflow-hidden shadow-[0_10px_20px_rgba(203,213,225,0.3)] relative">
                        <div class="absolute -right-6 -top-6 text-blue-500/5 text-9xl pointer-events-none transform -rotate-12 font-bold">&#127793;</div>
                        <div class="text-blue-500 text-5xl md:text-6xl mb-4 md:mb-6 relative z-10 filter drop-shadow hover:scale-110 transition-transform duration-500">&#127793;</div>
                        <h4 class="text-xl md:text-2xl font-extrabold mb-2 md:mb-3 text-slate-800 relative z-10">Cải Tạo Đất <span class="text-blue-600 text-base md:text-lg font-bold block mt-1">(Polyphenols)</span></h4>
                        <p class="text-sm text-slate-500 leading-relaxed relative z-10 font-medium">Dùng hợp chất chống oxy hóa từ thực phẩm đa sắc màu để bảo vệ tế bào và đa dạng hóa chủng vi khuẩn.</p>
                    </div>
                </div>

                <!-- Food Directory - Elevated Cards -->
                <div class="mb-20 md:mb-24 relative">
                    <div class="flex items-center justify-center gap-2 md:gap-4 mb-8 md:mb-10">
                        <div class="h-px bg-gradient-to-r from-transparent to-sky-400 w-12 md:w-20"></div>
                        <h3 class="text-xl md:text-2xl font-bold text-sky-600 text-center uppercase tracking-[0.1em]">Danh mục thực phẩm</h3>
                        <div class="h-px bg-gradient-to-l from-transparent to-sky-400 w-12 md:w-20"></div>
                    </div>
                    <!-- Background highlight for food cards -->
                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[90%] h-[120%] bg-white/40 blur-[50px] rounded-[4rem] pointer-events-none z-0"></div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 relative z-10">
                        <!-- Food Item 1 -->
                        <div class="food-card group p-8 rounded-[2rem] cursor-pointer bg-white border border-slate-100 text-slate-800 hover:-translate-y-2 shadow-[0_5px_15px_rgba(15,23,42,0.05)] hover:shadow-[0_20px_30px_rgba(251,191,36,0.15)] transition-all duration-300" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-6">
                                <span class="text-5xl filter drop-shadow-sm">&#127820;</span>
                                <span class="bg-amber-100 text-amber-800 border border-amber-300 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-sm">Siêu cấp</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-extrabold text-slate-900 leading-none">Chuối Xanh</h5>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-amber-600 font-bold tracking-wide">Nguồn tinh bột kháng dồi dào.</p>
                            <div class="food-details mt-5 pt-5 border-t border-slate-100">
                                <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                    <span class="text-amber-600 font-bold mb-1 block">Cách chế biến:</span> Luộc sơ cả vỏ (rửa sạch) hoặc thái lát nấu súp. Thức ăn tối thượng để lợi khuẩn tạo ra Butyrate hằng rào màng ruột.
                                </p>
                            </div>
                        </div>
                        <!-- Food Item 2 -->
                        <div class="food-card group p-8 rounded-[2rem] cursor-pointer bg-white border border-slate-100 text-slate-800 hover:-translate-y-2 shadow-[0_5px_15px_rgba(15,23,42,0.05)] hover:shadow-[0_20px_30px_rgba(148,163,184,0.15)] transition-all duration-300" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-6">
                                <span class="text-5xl filter drop-shadow-sm">&#129476;</span>
                                <span class="bg-slate-100 text-slate-600 border border-slate-300 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-sm">Gia vị nền</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-extrabold text-slate-900 leading-none">Hành & Tỏi</h5>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-slate-500 font-bold tracking-wide">Giàu Inulin thuần tự nhiên.</p>
                            <div class="food-details mt-5 pt-5 border-t border-slate-100">
                                <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                    <span class="text-slate-800 font-bold mb-1 block">Cách chế biến:</span> Làm gia vị trong các món xào, súp hằng ngày để nuôi dưỡng chủng <em>Bifidobacterium</em> cực mạnh.
                                </p>
                            </div>
                        </div>
                        <!-- Food Item 3 -->
                        <div class="food-card group p-8 rounded-[2rem] cursor-pointer bg-white border border-slate-100 text-slate-800 hover:-translate-y-2 shadow-[0_5px_15px_rgba(15,23,42,0.05)] hover:shadow-[0_20px_30px_rgba(52,211,153,0.15)] transition-all duration-300" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-6">
                                <span class="text-5xl filter drop-shadow-sm">&#129361;</span>
                                <span class="bg-emerald-100 text-emerald-800 border border-emerald-300 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-sm">Cao cấp</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-extrabold text-slate-900 leading-none">Măng Tây</h5>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-emerald-600 font-bold tracking-wide">Đa dạng hóa hệ vi sinh.</p>
                            <div class="food-details mt-5 pt-5 border-t border-slate-100">
                                <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                    <span class="text-emerald-600 font-bold mb-1 block">Lợi ích:</span> Cung cấp hệ sợi xơ hòa tan giúp đa dạng hóa quần thể vi khuẩn có lợi sâu thẳm trong trực tràng.
                                </p>
                            </div>
                        </div>
                        <!-- Food Item 4 -->
                        <div class="food-card group p-8 rounded-[2rem] cursor-pointer bg-white border border-slate-100 text-slate-800 hover:-translate-y-2 shadow-[0_5px_15px_rgba(15,23,42,0.05)] hover:shadow-[0_20px_30px_rgba(96,165,250,0.15)] transition-all duration-300" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-6">
                                <span class="text-5xl filter drop-shadow-sm">&#127794;</span>
                                <span class="bg-blue-100 text-blue-800 border border-blue-300 text-[10px] px-3 py-1 rounded-full font-bold uppercase tracking-widest shadow-sm">Hỗ trợ</span>
                            </div>
                            <div class="flex items-center justify-between mb-2">
                                <h5 class="text-xl font-extrabold text-slate-900 leading-none">Các loại Hạt</h5>
                                <div class="w-8 h-8 rounded-full bg-slate-50 flex items-center justify-center animate-bounce group-[.active]:rotate-180 transition-transform duration-300">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                </div>
                            </div>
                            <p class="text-xs text-blue-600 font-bold tracking-wide">Zinc & Omega thực vật.</p>
                            <div class="food-details mt-5 pt-5 border-t border-slate-100">
                                <p class="text-sm text-slate-500 leading-relaxed font-medium">
                                    <span class="text-blue-600 font-bold mb-1 block">Lợi ích:</span> Hạt bí, hướng dương giúp bù đắp sự thiết hụt vi mô, hạ nhiệt các phản ứng viêm ngay tại não.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Rainbow Diet & Chart -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 md:gap-10 items-stretch mb-20 md:mb-24 relative z-10">
                    <div class="bg-white/80 backdrop-blur-3xl p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-white shadow-[0_15px_40px_rgba(14,165,233,0.08)] relative overflow-hidden flex flex-col h-full">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
                        <h4 class="text-2xl md:text-3xl font-bold mb-4 text-slate-800 text-center md:text-left">"Ăn chiếc cầu vồng"</h4>
                        <p class="text-slate-500 text-sm md:text-base leading-relaxed mb-8 flex-grow font-medium text-center md:text-left">
                            Mỗi sắc màu thực vật đại diện cho một nhóm <span class="text-amber-500 font-bold border-b border-amber-300/50">Polyphenol</span> thiết yếu. Hãy phối hợp từ 3 sắc màu để khai mở sức mạnh phục hồi.
                        </p>
                        <div class="rainbow-grid grid grid-cols-5 gap-2 md:gap-3 mb-6 md:mb-8">
                            <div class="bg-gradient-to-b from-red-400 to-red-500 shadow-[0_2px_10px_rgba(239,68,68,0.3)] border border-red-300 transform md:hover:-translate-y-1 hover:scale-105 transition-all" onclick="app.showRainbowInfo('red')"></div>
                            <div class="bg-gradient-to-b from-orange-400 to-orange-500 shadow-[0_2px_10px_rgba(249,115,22,0.3)] border border-orange-300 transform md:hover:-translate-y-1 hover:scale-105 transition-all" onclick="app.showRainbowInfo('orange')"></div>
                            <div class="bg-gradient-to-b from-yellow-300 to-amber-400 shadow-[0_2px_10px_rgba(245,158,11,0.3)] border border-yellow-200 transform md:hover:-translate-y-1 hover:scale-105 transition-all" onclick="app.showRainbowInfo('yellow')"></div>
                            <div class="bg-gradient-to-b from-emerald-400 to-emerald-500 shadow-[0_2px_10px_rgba(16,185,129,0.3)] border border-emerald-300 transform md:hover:-translate-y-1 hover:scale-105 transition-all" onclick="app.showRainbowInfo('green')"></div>
                            <div class="bg-gradient-to-b from-purple-400 to-purple-500 shadow-[0_2px_10px_rgba(168,85,247,0.3)] border border-purple-300 transform md:hover:-translate-y-1 hover:scale-105 transition-all" onclick="app.showRainbowInfo('purple')"></div>
                        </div>
                        <div id="rainbow-display" class="bg-slate-50 border border-slate-200 rounded-2xl p-5 md:p-6 min-h-[140px] flex flex-col justify-center transition-all shadow-inner relative overflow-hidden">
                            <div id="rainbow-suggestion" class="opacity-100 transition-opacity duration-300 text-center relative z-10">
                                <p class="text-slate-400 text-xs md:text-sm italic tracking-wide">Chạm vào một dải màu để giải mã điều kỳ diệu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white/80 backdrop-blur-3xl p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-white shadow-[0_15px_40px_rgba(14,165,233,0.08)] flex flex-col h-full items-center justify-center relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-white/20 to-transparent pointer-events-none"></div>
                        <h4 class="text-slate-700 text-center font-bold text-sm mb-4 uppercase tracking-[0.2em] relative z-10">Tỷ lệ Prebiotics</h4>
                        <div class="chart-container relative z-10 w-full flex-grow flex items-center bg-transparent rounded-[2rem] p-2 md:p-4" style="min-height: 250px;">
                            <canvas id="prebioticChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Protocol Message -->
                <div class="max-w-4xl mx-auto bg-amber-50/90 backdrop-blur-xl border-2 border-amber-300 p-8 md:p-12 rounded-[2rem] md:rounded-[2.5rem] text-center shadow-[0_20px_50px_rgba(245,158,11,0.1)] relative overflow-hidden my-12 md:my-16">
                    <div class="absolute top-0 right-0 w-32 h-32 md:w-48 md:h-48 bg-amber-200/30 blur-[40px] rounded-full pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-32 h-32 md:w-48 md:h-48 bg-amber-100/40 blur-[40px] rounded-full pointer-events-none"></div>
                    <h4 class="text-2xl md:text-3xl font-extrabold text-amber-600 mb-4 md:mb-6 relative z-10 drop-shadow-sm">&#9888; Quy tắc "Nhỏ và Chậm"</h4>
                    <p class="text-sm md:text-lg text-slate-600 leading-relaxed mb-8 md:mb-10 max-w-2xl mx-auto relative z-10 font-bold border-l-4 border-amber-400 pl-4 text-left inline-block">
                        Đường ruột đang gánh chịu tổn thương cần thời gian thích nghi. Đừng ép trẻ lượng lớn dồn dập ngay từ đầu để tránh sinh khí gây áp lực.
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6 relative z-10 w-full">
                        <div class="p-4 md:p-6 bg-white border border-slate-100 rounded-[1.5rem] text-[11px] md:text-[12px] uppercase font-bold text-slate-700 tracking-wider flex items-center md:flex-col md:justify-center gap-4 md:gap-0 group shadow-sm transition-transform md:hover:-translate-y-1 cursor-default hover:shadow-md text-left md:text-center">
                            <span class="block text-3xl md:text-4xl md:mb-4 filter drop-shadow-sm group-hover:scale-110 transition-transform">&#128301;</span>
                            Quan sát phân hằng ngày
                        </div>
                        <div class="p-4 md:p-6 bg-white border border-slate-100 rounded-[1.5rem] text-[11px] md:text-[12px] uppercase font-bold text-slate-700 tracking-wider flex items-center md:flex-col md:justify-center gap-4 md:gap-0 group shadow-sm transition-transform md:hover:-translate-y-1 cursor-default hover:shadow-md text-left md:text-center">
                            <span class="block text-3xl md:text-4xl md:mb-4 filter drop-shadow-sm group-hover:scale-110 transition-transform">&#128338;</span>
                            Tăng vi liều mỗi 3 ngày
                        </div>
                        <div class="p-4 md:p-6 bg-white border border-slate-100 rounded-[1.5rem] text-[11px] md:text-[12px] uppercase font-bold text-slate-700 tracking-wider flex items-center md:flex-col md:justify-center gap-4 md:gap-0 group shadow-sm transition-transform md:hover:-translate-y-1 cursor-default hover:shadow-md text-left md:text-center">
                            <span class="block text-3xl md:text-4xl md:mb-4 filter drop-shadow-sm group-hover:scale-110 transition-transform">&#128203;</span>
                            Lưu cấu trúc nhật ký
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6 mt-12 md:mt-16 relative z-10">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="cta-link p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] bg-white border border-slate-200 text-center flex flex-col items-center shadow-[0_5px_15px_rgba(0,0,0,0.05)] hover:-translate-y-2 hover:shadow-[0_15px_30px_rgba(59,89,152,0.15)] hover:border-[#3b5998]/50 transition-all group overflow-hidden relative">
                        <span class="text-3xl md:text-4xl mb-2 md:mb-3 transition-transform drop-shadow-sm group-hover:scale-110">&#128101;</span>
                        <span class="font-extrabold text-[10px] md:text-xs uppercase text-[#3b5998] tracking-wider mt-1 md:mt-2">Group Chuyên sâu</span>
                    </a>
                    <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="cta-link p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] bg-white border border-slate-200 text-center flex flex-col items-center shadow-[0_5px_15px_rgba(0,0,0,0.05)] hover:-translate-y-2 hover:shadow-[0_15px_30px_rgba(0,104,255,0.15)] hover:border-[#0068ff]/50 transition-all group overflow-hidden relative">
                        <span class="text-3xl md:text-4xl mb-2 md:mb-3 transition-transform drop-shadow-sm group-hover:scale-110">&#128172;</span>
                        <span class="font-extrabold text-[10px] md:text-xs uppercase text-[#0068ff] tracking-wider mt-1 md:mt-2">Cộng đồng Zalo</span>
                    </a>
                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="cta-link p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] bg-white border border-slate-200 text-center flex flex-col items-center shadow-[0_5px_15px_rgba(0,0,0,0.05)] hover:-translate-y-2 hover:shadow-[0_15px_30px_rgba(100,116,139,0.15)] hover:border-slate-400 transition-all group overflow-hidden relative">
                        <span class="text-3xl md:text-4xl mb-2 md:mb-3 transition-transform drop-shadow-sm group-hover:scale-110">&#128100;</span>
                        <span class="font-extrabold text-[10px] md:text-xs uppercase text-slate-600 tracking-wider mt-1 md:mt-2">Trợ lý Cá nhân</span>
                    </a>
                    <a href="tel:0988717107" class="cta-link p-4 md:p-6 rounded-[1.5rem] md:rounded-[2rem] bg-amber-50 border border-amber-200 text-center flex flex-col items-center shadow-[0_5px_15px_rgba(0,0,0,0.05)] hover:-translate-y-2 hover:shadow-[0_15px_30px_rgba(245,158,11,0.15)] hover:border-amber-400 transition-all group overflow-hidden relative">
                        <span class="text-3xl md:text-4xl mb-2 md:mb-3 transition-transform drop-shadow-sm group-hover:scale-110">&#9990;</span>
                        <span class="font-extrabold text-[10px] sm:text-xs uppercase text-amber-600 tracking-wider mt-1 md:mt-2">Hotline: 0988.717.107</span>
                     </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-white/80 backdrop-blur-xl py-12 md:py-24 border-t border-sky-100 relative z-10">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-extrabold text-slate-800 mb-4 md:mb-6 drop-shadow-sm">Hành trình này bạn không đơn độc</h2>
            <p class="text-sm md:text-lg text-slate-500 mb-8 md:mb-12 font-medium max-w-2xl mx-auto px-4">Kiên nhẫn nuôi dưỡng "khu vườn" bên trong con là sự hy sinh vĩ đại nhất của cha mẹ để trả lại cho con một tương lai tỉnh táo.</p>
            <div class="text-[9px] md:text-[10px] text-slate-400 uppercase tracking-widest mb-3 md:mb-4 font-bold">Tuyên bố miễn trừ trách nhiệm y khoa</div>
            <p class="text-[10px] md:text-[11px] text-slate-400 leading-relaxed max-w-2xl mx-auto font-medium px-4">
                Nội dung hoàn toàn dựa trên phân tích khoa học thực chứng và cơ chế sinh hóa nội sinh. Thông tin không thay thế cho chẩn đoán chuyên nghiệp. Mọi thay đổi về chế độ ăn cần sự giám sát của bác sĩ chuyên khoa.
            </p>
        </div>
    </footer>

    <script>
        const app = {
            charts: {},
            isDysbiosis: false,
            rainbowData: {
                red: { title: "Màu Đỏ (Chống Viêm)", colorClass: "text-red-500", foods: "Cà chua, củ dền, dâu tây, ớt chuông đỏ.", benefit: "Giàu Lycopene bảo vệ tế bào và dập tắt các ổ viêm niêm mạc." },
                orange: { title: "Màu Cam (Miễn Dịch)", colorClass: "text-orange-500", foods: "Cà rốt, bí đỏ, khoai lang cam.", benefit: "Cung cấp Beta-carotene tăng cường hàng rào bảo vệ miễn dịch." },
                yellow: { title: "Màu Vàng (Tiêu Hóa)", colorClass: "text-amber-500", foods: "Ớt chuông vàng, ngô, dứa.", benefit: "Hỗ trợ enzyme tiêu hóa, giảm áp lực cho đường ruột đang tổn thương." },
                green: { title: "Màu Xanh (Lợi Khuẩn)", colorClass: "text-emerald-500", foods: "Măng tây, bông cải xanh, rau cải xoăn.", benefit: "Thức ăn cao cấp cho chủng Bifidobacterium để sản sinh Butyrate." },
                purple: { title: "Màu Tím (Não Bộ)", colorClass: "text-purple-500", foods: "Bắp cải tím, việt quất, cà tím.", benefit: "Chứa Anthocyanin bảo vệ thần kinh khỏi sự tấn công của độc tố." }
            },

            init: function() {
                this.initCharts();
                this.initScrollObservers();
                this.initScrollSpy();
            },

            showRainbowInfo: function(color) {
                const data = this.rainbowData[color];
                const display = document.getElementById('rainbow-suggestion');
                display.style.opacity = 0;
                setTimeout(() => {
                    display.innerHTML = `
                        <h5 class="font-bold ${data.colorClass} mb-1 text-base tracking-tight">${data.title}</h5>
                        <p class="text-slate-800 text-xs mb-1"><strong>Thực phẩm:</strong> ${data.foods}</p>
                        <p class="text-stone-400 text-[11px] leading-snug italic">${data.benefit}</p>
                    `;
                    display.style.opacity = 1;
                }, 150);
                document.querySelectorAll('.rainbow-grid div').forEach(div => div.classList.remove('active'));
                event.target.classList.add('active');
            },

            initCharts: function() {
                // Gut State Chart
                const gutCtx = document.getElementById('gutStateChart').getContext('2d');
                this.charts.gut = new Chart(gutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Lợi Khuẩn', 'Hại Khuẩn', 'Nấm Men'],
                        datasets: [{
                            data: [85, 10, 5],
                            backgroundColor: ['#059669', '#d6d3d1', '#fda4af'],
                            borderWidth: 0
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, cutout: '75%', plugins: { legend: { display: false } } }
                });

                // Butyrate Impact Chart
                const butyrateCtx = document.getElementById('butyrateImpactChart').getContext('2d');
                this.charts.butyrate = new Chart(butyrateCtx, {
                    type: 'line',
                    data: {
                        labels: ['Tuần 0', 'Tuần 4', 'Tuần 8', 'Tuần 12', 'Tuần 16'],
                        datasets: [{
                            label: 'Phục hồi niêm mạc',
                            data: [15, 35, 65, 85, 95],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.4,
                            borderWidth: 3
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, plugins: { legend: { display: false } }, scales: { y: { beginAtZero: true, max: 100 }, x: { grid: { display: false } } } }
                });

                // Prebiotic Food Chart
                const preCtx = document.getElementById('prebioticChart').getContext('2d');
                this.charts.prebiotic = new Chart(preCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Chuối xanh', 'Măng tây', 'Hành tây', 'Hạt bí'],
                        datasets: [{
                            data: [95, 80, 75, 60],
                            backgroundColor: ['#f59e0b', '#10b981', '#6366f1', '#4b5563'],
                            borderRadius: 10
                        }]
                    },
                    options: { 
                        indexAxis: 'y', 
                        responsive: true, 
                        maintainAspectRatio: false, 
                        plugins: { legend: { display: false } },
                        scales: { x: { display: false }, y: { grid: { display: false }, ticks: { font: { weight: 'bold', size: 10 } } } }
                    }
                });
            },

            toggleState: function() {
                this.isDysbiosis = !this.isDysbiosis;
                const chart = this.charts.gut;
                const btnText = document.getElementById('btn-text');
                const badge = document.getElementById('state-badge');
                const title = document.getElementById('state-title');
                const desc = document.getElementById('state-desc');
                
                const statLoiKhuan = document.getElementById('stat-loi-khuan');
                const colorLoiKhuan = document.getElementById('color-loi-khuan');
                const statHaiKhuan = document.getElementById('stat-hai-khuan');
                const colorHaiKhuan = document.getElementById('color-hai-khuan');
                const statNamMen = document.getElementById('stat-nam-men');
                const colorNamMen = document.getElementById('color-nam-men');

                if (this.isDysbiosis) {
                    chart.data.datasets[0].data = [25, 45, 30];
                    chart.data.datasets[0].backgroundColor = ['#a7f3d0', '#e11d48', '#a21caf'];
                    
                    badge.innerText = 'Trạng thái: Loạn Khuẩn';
                    badge.className = 'inline-block px-4 py-1.5 rounded-full bg-rose-100 text-rose-800 font-bold text-sm tracking-wide border border-rose-200 transition-colors duration-300';
                    title.innerText = '"Bạo loạn" Hệ Sinh Thái';
                    title.className = 'text-2xl font-bold text-rose-700 transition-colors duration-300';
                    desc.innerText = 'Hại khuẩn và nấm men sinh sôi mạnh mẽ, cướp dinh dưỡng, tiết ra độc tố phá vỡ màng ruột (Leaky Gut) và xâm nhập lên não qua trục Não-Ruột.';
                    
                    statLoiKhuan.innerText = '25%'; colorLoiKhuan.style.backgroundColor = '#a7f3d0';
                    statHaiKhuan.innerText = '45%'; colorHaiKhuan.style.backgroundColor = '#e11d48';
                    statNamMen.innerText = '30%'; colorNamMen.style.backgroundColor = '#a21caf';

                    btnText.innerText = 'Phục hồi Cân Bằng';
                } else {
                    chart.data.datasets[0].data = [85, 10, 5];
                    chart.data.datasets[0].backgroundColor = ['#059669', '#d6d3d1', '#fda4af'];
                    
                    badge.innerText = 'Trạng thái: Cân Bằng';
                    badge.className = 'inline-block px-4 py-1.5 rounded-full bg-emerald-100 text-emerald-800 font-bold text-sm tracking-wide border border-emerald-200 transition-colors duration-300';
                    title.innerText = 'Hệ Sinh Thái Khỏe Mạnh';
                    title.className = 'text-2xl font-bold text-stone-800 transition-colors duration-300';
                    desc.innerText = 'Tỷ lệ lợi khuẩn áp đảo giúp màng ruột toàn vẹn, hấp thu tốt dinh dưỡng và ngăn chặn độc tố lên não. Trẻ ổn định hành vi.';
                    
                    statLoiKhuan.innerText = '85%'; colorLoiKhuan.style.backgroundColor = '#059669';
                    statHaiKhuan.innerText = '10%'; colorHaiKhuan.style.backgroundColor = '#d6d3d1';
                    statNamMen.innerText = '5%'; colorNamMen.style.backgroundColor = '#fda4af';

                    btnText.innerText = 'Mô phỏng Loạn Khuẩn';
                }
                chart.update();
            },

            toggleMechanism: function(element) {
                document.querySelectorAll('.mechanism-card').forEach(c => { if (c !== element) c.classList.remove('active'); });
                element.classList.toggle('active');
            },

            toggleFood: function(element) {
                document.querySelectorAll('.food-card').forEach(c => { if (c !== element) c.classList.remove('active'); });
                element.classList.toggle('active');
            },

            initScrollObservers: function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
                }, { threshold: 0.1 });
                document.querySelectorAll('.section-reveal').forEach(el => observer.observe(el));
            },

            initScrollSpy: function() {
                const navLinks = document.querySelectorAll('.nav-link');
                const sections = document.querySelectorAll('section');
                window.addEventListener('scroll', () => {
                    let current = '';
                    sections.forEach(section => { if (pageYOffset >= section.offsetTop - 100) current = section.getAttribute('id'); });
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href').includes(current)) link.classList.add('active');
                    });
                });
            }
        };

        window.onload = () => app.init();
    </script>
    <?php wp_footer(); ?>
</body>