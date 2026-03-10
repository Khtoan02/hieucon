<?php
/**
 * Template Name: Trang Đường Tăng Động
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đường tinh luyện và trẻ tăng động: Cơ chế và giải pháp</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #2563eb 100%);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.7s ease-out forwards; opacity: 0; }
        .anim.d1 { animation-delay: 80ms; }
        .anim.d2 { animation-delay: 160ms; }
        .anim.d3 { animation-delay: 240ms; }
        .anim.d4 { animation-delay: 320ms; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .card-hover {
            transition: transform 0.35s cubic-bezier(.4,0,.2,1), box-shadow 0.35s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px -12px rgba(0,0,0,0.15);
        }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased overflow-x-hidden">

    <!-- ═══════════════════════ HERO ═══════════════════════ -->
    <header class="hero-bg relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-blue-500/10 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] rounded-full bg-white/5 translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-8 right-16 opacity-[0.04] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i class="fa-solid fa-candy-cane text-white text-[200px]"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-blue-500/20 text-blue-200 font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-['Quicksand'] text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                ĐƯỜNG TINH LUYỆN <br class="hidden md:block">
                <span class="text-amber-300">VÀ TÌNH TRẠNG TĂNG ĐỘNG</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-slate-300 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Tại sao kẹo ngọt lại gây ra sự bùng phát hành vi? Tìm hiểu cơ chế sinh hóa đằng sau tình trạng mất tập trung và giải pháp can thiệp hiệu quả.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#mechanism" class="bg-amber-400 hover:bg-amber-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Tìm hiểu cơ chế <i class="fa-solid fa-arrow-down animate-bounce"></i>
                </a>
                <a href="#contact" class="bg-white/15 hover:bg-white/25 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/25 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Nhận tư vấn ngay <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[40px] md:h-[60px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#ffffff"></path>
            </svg>
        </div>
    </header>

    <!-- ═══════════════════════ INTRODUCTION ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border border-gray-200 anim">
                <!-- Quote side -->
                <div class="lg:w-[42%] bg-gradient-to-br from-slate-800 to-slate-900 p-7 sm:p-10 lg:p-12 flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <i class="fa-solid fa-triangle-exclamation text-[140px] text-white"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-red-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 shadow-lg">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-white mb-4">Tín hiệu báo động</h3>
                        <p class="text-slate-300 text-base sm:text-lg italic leading-relaxed mb-6">
                            "Con bỗng trở nên lăng xăng và mất kiểm soát chỉ sau vài phút ăn đồ ngọt..."
                        </p>
                        <div class="border-t border-white/10 pt-5">
                            <p class="text-slate-400 text-sm leading-relaxed">
                                Đây không đơn thuần là sự phấn khích nhất thời. Dưới lăng kính y sinh, tình trạng tăng động thường phản ánh một hệ thống chuyển hóa đang bị quá tải. Hãy coi các hành vi này như một tín hiệu báo động về sự bất ổn hóa học bên trong cơ thể trẻ.
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Content side -->
                <div class="lg:w-[58%] p-7 sm:p-10 lg:p-12 flex flex-col justify-center bg-white">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl font-bold text-slate-900 mb-6 leading-snug">
                        Mối liên hệ giữa đường và hành vi xung động
                    </h2>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-4">
                        Đường tinh luyện có cấu trúc phân tử đơn giản, cho phép hấp thụ trực tiếp vào tuần hoàn máu mà không cần qua các công đoạn tiêu hóa phức tạp. Tốc độ này nhanh đến mức khiến cơ thể không kịp thích nghi.
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-5">
                        Sự xâm nhập ồ ạt của glucose buộc hệ nội tiết phải bước vào trạng thái ứng phó khẩn cấp, dẫn đến một chu kỳ biến động hóa học cực đoan ngay bên trong hệ thần kinh trung ương của trẻ.
                    </p>
                    <div class="bg-amber-500 rounded-xl p-5 text-white">
                        <p class="font-bold text-base mb-1 flex items-center gap-2">
                            <i class="fa-solid fa-lightbulb text-yellow-200"></i> Lưu ý cho ba mẹ:
                        </p>
                        <p class="text-amber-50 text-sm leading-relaxed italic">
                            Trẻ không hề bướng bỉnh, mà đang phản ứng lại với sự thay đổi hóa học đột ngột trong môi trường nội môi.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ MECHANISM 1: Blood Sugar ═══════════════════════ -->
    <section id="mechanism" class="py-12 md:py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-blue-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế 1</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-3">Biến thiên đường huyết và hệ nội tiết</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Sự tăng vọt và sụt giảm glucose huyết kích hoạt các phản ứng sinh tồn tiêu cực.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d1">
                    <div class="bg-blue-600 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-chart-line text-[70px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-blue-600 text-2xl font-['Quicksand'] font-extrabold">01</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Gia tăng glucose</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Đường huyết tăng vọt kích hoạt tuyến tụy giải phóng lượng lớn <strong>Insulin</strong> để vận chuyển glucose vào nội bào khẩn cấp.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d2">
                    <div class="bg-orange-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-arrow-trend-down text-[70px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-orange-500 text-2xl font-['Quicksand'] font-extrabold">02</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Hạ đường huyết</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Đáp ứng insulin quá mức khiến đường huyết sụt giảm đột ngột dưới mức ổn định, gây thiếu hụt năng lượng tạm thời cho não bộ.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d3">
                    <div class="bg-red-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-bolt text-[70px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-red-500 text-2xl font-['Quicksand'] font-extrabold">03</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Bùng phát Adrenaline</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Cơ thể giải phóng <strong>Adrenaline</strong> và <strong>Cortisol</strong> để bù đắp đường. Các hormone này gây tăng nhịp tim và các hành vi xung động mạnh.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ MECHANISM 2: Gut-Brain / Candida ═══════════════════════ -->
    <section id="gut-brain" class="py-12 md:py-16 relative overflow-hidden">
        <div class="bg-gradient-to-br from-slate-900 via-slate-800 to-blue-900 py-12 md:py-16">
            <div class="absolute top-0 right-1/4 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-12 anim">
                    <span class="inline-block bg-blue-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế 2</span>
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-3">Trục não - ruột và độc tố nấm men</h2>
                </div>

                <div class="flex flex-col lg:flex-row gap-8 lg:gap-12">
                    <!-- Explanation cards -->
                    <div class="lg:w-[55%] space-y-5 anim d1">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 sm:p-7 border border-white/10 flex gap-5 items-start">
                            <div class="w-12 h-12 bg-blue-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shrink-0 shadow-lg">A</div>
                            <div>
                                <h4 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white mb-2">Bùng phát nấm Candida</h4>
                                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">Đường đơn là nguồn dinh dưỡng ưu tiên của nấm men. Chúng sinh sôi mạnh và tiến hành lên men kỵ khí ngay tại đường ruột.</p>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 sm:p-7 border border-white/10 flex gap-5 items-start">
                            <div class="w-12 h-12 bg-red-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shrink-0 shadow-lg">B</div>
                            <div>
                                <h4 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white mb-2">Độc tố acetaldehyde</h4>
                                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">Sản phẩm phụ của quá trình lên men là acetaldehyde — một hợp chất có độc tính thần kinh tương tự như cồn.</p>
                            </div>
                        </div>

                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 sm:p-7 border border-white/10 flex gap-5 items-start">
                            <div class="w-12 h-12 bg-purple-500 text-white rounded-xl flex items-center justify-center font-bold text-lg shrink-0 shadow-lg">C</div>
                            <div>
                                <h4 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white mb-2">Biểu hiện "nhiễm độc" nhẹ</h4>
                                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">Trẻ xuất hiện các hành vi như cười vô cớ, ánh mắt lờ đờ hoặc suy giảm phối hợp vận động do nhiễu loạn tín hiệu não.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Cycle diagram -->
                    <div class="lg:w-[45%] anim d2">
                        <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-6 sm:p-8 border border-white/10">
                            <h4 class="text-center font-['Quicksand'] font-bold text-lg mb-8 text-blue-300 uppercase tracking-widest">Chu trình độc tính</h4>
                            <div class="space-y-4 relative">
                                <div class="absolute left-6 top-8 bottom-8 w-0.5 bg-white/10"></div>

                                <div class="flex items-center gap-5 relative z-10">
                                    <div class="w-12 h-12 bg-amber-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg"><i class="fa-solid fa-candy-cane"></i></div>
                                    <div class="flex-1 p-4 bg-white/10 border border-white/10 rounded-xl text-sm font-semibold text-white">Nạp đường tinh luyện</div>
                                </div>
                                <div class="flex items-center gap-5 relative z-10">
                                    <div class="w-12 h-12 bg-green-600 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg"><i class="fa-solid fa-virus"></i></div>
                                    <div class="flex-1 p-4 bg-white/10 border border-white/10 rounded-xl text-sm font-semibold text-white">Nấm Candida tăng sinh</div>
                                </div>
                                <div class="flex items-center gap-5 relative z-10">
                                    <div class="w-12 h-12 bg-red-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg"><i class="fa-solid fa-flask"></i></div>
                                    <div class="flex-1 p-4 bg-red-500/20 border border-red-500/30 rounded-xl text-sm font-bold text-red-300">Sản sinh độc tố thần kinh</div>
                                </div>
                                <div class="flex items-center gap-5 relative z-10">
                                    <div class="w-12 h-12 bg-blue-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg"><i class="fa-solid fa-brain"></i></div>
                                    <div class="flex-1 p-4 bg-blue-500/20 border border-blue-500/30 rounded-xl text-sm font-bold text-blue-300">Biến đổi hành vi vận động</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ NUTRIENT DEPLETION ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-14 anim">
                <!-- Mineral grid -->
                <div class="lg:w-[40%]">
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-600 text-white p-6 sm:p-8 rounded-2xl text-center card-hover shadow-md">
                            <div class="text-3xl sm:text-4xl mb-2 font-extrabold font-['Quicksand']">Mg</div>
                            <div class="text-xs font-bold uppercase tracking-wider text-blue-200">Magnesium</div>
                        </div>
                        <div class="bg-slate-700 text-white p-6 sm:p-8 rounded-2xl text-center card-hover shadow-md">
                            <div class="text-3xl sm:text-4xl mb-2 font-extrabold font-['Quicksand']">Zn</div>
                            <div class="text-xs font-bold uppercase tracking-wider text-slate-300">Kẽm</div>
                        </div>
                        <div class="bg-orange-500 text-white p-6 sm:p-8 rounded-2xl text-center card-hover shadow-md">
                            <div class="text-3xl sm:text-4xl mb-2 font-extrabold font-['Quicksand']">B6</div>
                            <div class="text-xs font-bold uppercase tracking-wider text-orange-100">Vitamin B6</div>
                        </div>
                        <div class="bg-red-500 text-white p-6 sm:p-8 rounded-2xl text-center card-hover shadow-md">
                            <div class="text-3xl sm:text-4xl mb-2 font-extrabold font-['Quicksand']">B12</div>
                            <div class="text-xs font-bold uppercase tracking-wider text-red-100">Vitamin B12</div>
                        </div>
                    </div>
                </div>

                <!-- Text -->
                <div class="lg:w-[60%]">
                    <span class="inline-block bg-slate-700 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Hệ quả vi chất</span>
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-5">Tiêu hao vi chất và năng lượng "rỗng"</h2>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-5">
                        Đường tinh luyện tiêu tốn nguồn lực dự trữ của cơ thể để chuyển hóa thành năng lượng (ATP) mà không hề bù đắp lại các vi chất cần thiết.
                    </p>
                    <div class="space-y-4">
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 bg-blue-600 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-check text-sm"></i></div>
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Thiếu hụt magie và vitamin B gây đình trệ hoạt động của ty thể (nhà máy năng lượng tế bào).</p>
                        </div>
                        <div class="flex items-start gap-3">
                            <div class="w-7 h-7 bg-blue-600 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-check text-sm"></i></div>
                            <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Trẻ rơi vào nghịch lý: Cơ thể mệt mỏi thể chất nhưng hệ thần kinh lại bị kích thích bứt rứt liên tục.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SOLUTIONS ═══════════════════════ -->
    <section id="solution" class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-emerald-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Phương hướng can thiệp</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Giải pháp ổn định sinh lý lâu dài</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Từng bước thiết lập lại sự cân bằng thông qua dinh dưỡng khoa học.</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-5 lg:gap-6">
                <!-- Method 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-apple-whole"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Carbohydrate phức hợp</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Ưu tiên rau củ và trái cây nguyên quả. Chất xơ giúp glucose giải phóng từ từ, ngăn chặn các đỉnh đường huyết gây áp lực lên não.</p>
                    <span class="inline-block bg-emerald-50 text-emerald-700 rounded-lg px-3 py-1.5 text-xs font-bold border border-emerald-200">
                        <i class="fa-solid fa-bullseye mr-1"></i> Mục tiêu: Ổn định insulin
                    </span>
                </div>

                <!-- Method 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Vị ngọt tự nhiên an toàn</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Sử dụng cỏ ngọt (Stevia) hoặc Erythritol. Các chất này không kích thích insulin và không làm nguồn thức ăn cho nấm men Candida.</p>
                    <span class="inline-block bg-emerald-50 text-emerald-700 rounded-lg px-3 py-1.5 text-xs font-bold border border-emerald-200">
                        <i class="fa-solid fa-shield-halved mr-1"></i> Lợi ích: Kiểm soát nấm men
                    </span>
                </div>

                <!-- Method 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-chart-simple"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Chiến lược giảm dần</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Tránh cắt giảm đột ngột. Áp dụng lộ trình giảm dần nồng độ ngọt để hệ thống nội tiết và vị giác của trẻ thích nghi bền vững.</p>
                    <span class="inline-block bg-amber-50 text-amber-700 rounded-lg px-3 py-1.5 text-xs font-bold border border-amber-200">
                        <i class="fa-solid fa-arrows-down-to-line mr-1"></i> Phương pháp: Tapering hiệu quả
                    </span>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ DISCLAIMER ═══════════════════════ -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 anim">
            <div class="bg-slate-700 rounded-2xl p-6 sm:p-8 text-white shadow-md">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center shrink-0 shadow-lg">
                        <i class="fa-solid fa-triangle-exclamation text-white text-xl"></i>
                    </div>
                    <div>
                        <h3 class="font-['Quicksand'] font-bold text-sm uppercase tracking-widest mb-2 text-slate-200">Tuyên bố miễn trừ trách nhiệm y khoa</h3>
                        <p class="text-slate-300 text-sm leading-relaxed">
                            Tài liệu này cung cấp thông tin dựa trên cơ sở khoa học và mục đích giáo dục, không thay thế cho các chỉ định lâm sàng của bác sĩ chuyên khoa. Mọi thay đổi trong chế độ dinh dưỡng cần được thảo luận kỹ lưỡng với chuyên gia y tế dựa trên hồ sơ bệnh lý riêng biệt của mỗi trẻ.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER / CTA ═══════════════════════ -->
    <section id="contact" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-blue-900 py-14 md:py-20">
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Ba mẹ không cần phải đơn độc</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Đồng hành cùng cộng đồng "Hiểu con từ Gốc" để nhận phác đồ can thiệp y sinh cá nhân hóa và sự hỗ trợ từ chuyên gia.
                    </p>
                </div>

                <!-- CTA Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-12 anim d1">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Facebook</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Cộng đồng phụ huynh</span>
                        </div>
                    </a>

                    <a href="https://zalo.me/g/vmgfxy834" target="_blank"
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-comment-dots text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Zalo hỗ trợ</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh</span>
                        </div>
                    </a>

                    <a href="tel:0988717107"
                       class="bg-white/10 hover:bg-blue-600 border border-white/10 hover:border-blue-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(37,99,235,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hotline tư vấn</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                       class="bg-white/10 hover:bg-slate-700 border border-white/10 hover:border-slate-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(100,116,139,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-user-doctor text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-slate-200 transition-colors">Kết nối trực tiếp</span>
                        </div>
                    </a>
                </div>

                <!-- Copyright -->
                <div class="text-center border-t border-white/10 pt-8 anim d2">
                    <p class="text-slate-500 text-sm">&copy; <?php echo date('Y'); ?> Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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
        });
    </script>

    <?php wp_footer(); ?>
</body>