<?php
/**
 * Template Name: Trang Rối loạn chuyển hóa
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thiếu hụt vi chất nội bào</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #2563eb 100%);
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
        <div class="absolute top-8 right-16 opacity-[0.05] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i data-lucide="flask-conical" class="w-52 h-52 text-white"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-blue-500/20 text-blue-200 font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-['Quicksand'] text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                THIẾU HỤT VI CHẤT <br class="hidden md:block">
                <span class="text-amber-300">VÀ RỐI LOẠN CHUYỂN HÓA Ở TRẺ</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Khi trẻ "no bụng" nhưng cơ thể lại đang "đói tế bào". Hiểu đúng về bản chất của dinh dưỡng ở cấp độ tế bào để tìm ra giải pháp can thiệp tận gốc cho rào cản phát triển của con.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#thong-tin-lien-he" class="bg-amber-400 hover:bg-amber-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Nhận tư vấn chuyên môn <i data-lucide="arrow-down" class="w-5 h-5 animate-bounce"></i>
                </a>
                <a href="#nghich-ly" class="bg-white/15 hover:bg-white/25 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/25 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Tìm hiểu ngay <i data-lucide="microscope" class="w-5 h-5"></i>
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

    <!-- ═══════════════════════ SECTION 1: Nghịch lý ═══════════════════════ -->
    <section id="nghich-ly" class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Đặt vấn đề</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Nghịch lý giữa dung nạp đa lượng và thiếu hụt vi lượng</h2>
            </div>

            <div class="bg-gray-50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 border border-gray-200 shadow-sm mb-8 anim d1">
                <p class="text-base sm:text-lg text-gray-600 leading-relaxed text-center max-w-5xl mx-auto">
                    Qua thực tiễn lâm sàng, chúng tôi ghi nhận một hiện tượng nghịch lý: Đa số trẻ có chỉ số thể chất đạt chuẩn, ăn uống nhiều, nhưng xét nghiệm sinh hóa lại cho thấy <strong>suy giảm nghiêm trọng các vi khoáng thiết yếu (Kẽm, Magie, Vitamin B6, Omega-3)</strong>.
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 lg:gap-6 mb-6 anim d2">
                <!-- Card 1: No bụng -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-slate-600 text-white rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i data-lucide="pizza" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800">Trạng thái đáp ứng năng lượng đa lượng</h3>
                    </div>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        Cơ thể tiếp nhận đầy đủ hoặc dư thừa năng lượng từ các nhóm chất đa lượng như carbohydrate (tinh bột) và lipid (chất béo). Hay còn gọi là <strong>"No bụng"</strong>.
                    </p>
                </div>

                <!-- Card 2: Đói tế bào -->
                <div class="bg-blue-600 rounded-2xl p-6 sm:p-7 shadow-md card-hover group text-white">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-white text-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform shadow-md">
                            <i data-lucide="activity" class="w-7 h-7"></i>
                        </div>
                        <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl">Trạng thái đáp ứng vi chất nội bào</h3>
                    </div>
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        Khả năng hấp thu, chuyển hóa và vận chuyển thành công các vitamin, khoáng chất qua màng tế bào. Khi điều này thất bại, cơ thể rơi vào trạng thái <strong>"Đói tế bào"</strong>.
                    </p>
                </div>
            </div>

            <!-- Warning -->
            <div class="bg-amber-500 rounded-2xl p-5 sm:p-6 text-white flex gap-4 items-start shadow-md anim d3">
                <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                    <i data-lucide="alert-triangle" class="w-5 h-5"></i>
                </div>
                <p class="text-sm sm:text-base leading-relaxed">
                    Các hội chứng như suy giảm tương tác, thiếu tập trung hay rối loạn hành vi giống như <strong>đèn báo lỗi sinh lý</strong>. Hệ thần kinh trung ương đang cạn kiệt dưỡng chất, bất chấp hệ tiêu hóa vẫn liên tục được cung cấp năng lượng đa lượng.
                </p>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 2: Rò rỉ ruột Infographic ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-blue-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-red-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế bệnh lý</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Tăng tính thấm niêm mạc ruột và cơ chế thất thoát vi chất</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Nguyên nhân căn bản dẫn đến sự suy giảm vi chất nội bào thường khởi phát từ các rối loạn chức năng tại hệ tiêu hóa.</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 lg:gap-6">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden card-hover anim d1">
                    <div class="bg-red-500 py-4 px-5 flex items-center gap-3 relative overflow-hidden">
                        <div class="absolute right-1 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="bug" class="w-16 h-16 text-white"></i>
                        </div>
                        <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-red-500 text-lg font-['Quicksand'] font-extrabold">1</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-base sm:text-lg font-bold text-white relative z-10 leading-tight">Mất cân bằng vi sinh</h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="text-gray-600 text-sm leading-relaxed">Trẻ có hệ vi sinh đường ruột rối loạn (dysbiosis) gây khởi phát quá trình viêm.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden card-hover anim d2">
                    <div class="bg-orange-500 py-4 px-5 flex items-center gap-3 relative overflow-hidden">
                        <div class="absolute right-1 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="flame" class="w-16 h-16 text-white"></i>
                        </div>
                        <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-orange-500 text-lg font-['Quicksand'] font-extrabold">2</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-base sm:text-lg font-bold text-white relative z-10 leading-tight">Viêm và tổn thương nhung mao</h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="text-gray-600 text-sm leading-relaxed">Cấu trúc vi nhung mao ruột bị viêm nhiễm hoặc thoái hóa, làm suy giảm diện tích hấp thu.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden card-hover anim d3">
                    <div class="bg-amber-500 py-4 px-5 flex items-center gap-3 relative overflow-hidden">
                        <div class="absolute right-1 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="filter-x" class="w-16 h-16 text-white"></i>
                        </div>
                        <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-amber-500 text-lg font-['Quicksand'] font-extrabold">3</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-base sm:text-lg font-bold text-white relative z-10 leading-tight">Thất thoát vi chất</h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="text-gray-600 text-sm leading-relaxed">Thực phẩm không được phân giải hoàn toàn, các vitamin và khoáng chất bị đào thải ra ngoài.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden card-hover anim d4">
                    <div class="bg-blue-600 py-4 px-5 flex items-center gap-3 relative overflow-hidden">
                        <div class="absolute right-1 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="skull" class="w-16 h-16 text-white"></i>
                        </div>
                        <div class="w-11 h-11 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-blue-600 text-lg font-['Quicksand'] font-extrabold">4</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-base sm:text-lg font-bold text-white relative z-10 leading-tight">Xâm nhập độc tố</h3>
                    </div>
                    <div class="p-5 sm:p-6">
                        <p class="text-gray-600 text-sm leading-relaxed">Đại phân tử thức ăn và độc tố lọt qua hàng rào niêm mạc suy yếu vào máu, gây áp lực cho gan.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 3: Ty thể ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-yellow-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Chuyển hóa năng lượng</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Vai trò đồng nhân tố và cơ chế tổng hợp năng lượng tại ty thể</h2>
                <p class="text-gray-500 max-w-4xl mx-auto text-base sm:text-lg">Ty thể (Mitochondria) là bào quan đảm nhiệm chức năng chuyển hóa cơ chất thành năng lượng (ATP). Sự vắng mặt của các "đồng nhân tố" sẽ làm đình trệ toàn bộ chuỗi phản ứng này.</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-5 lg:gap-6 mb-8">
                <!-- Box 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-yellow-500 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="zap" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Vitamin nhóm B (B1, B2, B3)</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Đóng vai trò là các coenzyme mang điện tử. Sự vắng mặt của các vi chất này làm gián đoạn quá trình trích xuất năng lượng từ cơ chất dinh dưỡng.</p>
                </div>

                <!-- Box 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-emerald-500 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="hexagon" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Magie (Magnesium)</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">ATP bắt buộc phải hình thành phức hợp Mg-ATP để tham gia phản ứng sinh học. Kém hấp thu Magie tạo ra trạng thái năng lượng "vô hiệu" dù cơ thể đã tổng hợp được ATP.</p>
                </div>

                <!-- Box 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-indigo-500 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="shield" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Kẽm và Coenzyme Q10</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Đảm nhận vai trò thiết yếu bảo vệ màng ty thể khỏi các gốc tự do (oxidative stress) phát sinh trong chuỗi chuyền điện tử, duy trì tính toàn vẹn của bào quan.</p>
                </div>
            </div>

            <!-- Clinical consequence box -->
            <div class="bg-blue-600 text-white rounded-2xl p-6 sm:p-8 flex flex-col md:flex-row items-center gap-6 shadow-lg anim d4 relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <i data-lucide="battery-warning" class="w-40 h-40 text-white"></i>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center shrink-0 backdrop-blur-sm">
                    <i data-lucide="battery-warning" class="w-8 h-8 text-yellow-300"></i>
                </div>
                <div class="relative z-10">
                    <h4 class="font-['Quicksand'] text-xl sm:text-2xl font-bold mb-2">Hệ quả lâm sàng</h4>
                    <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                        Sự sụt giảm ATP hữu dụng toàn thân giải thích các biểu hiện như giảm trương lực cơ, sương mù não (brain fog) và suy nhược mạn tính. Các hành vi tăng động thường là <strong class="text-white">cơ chế bù trừ sinh lý tự phát</strong> nhằm kích thích hệ thần kinh đang thiếu năng lượng.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 4: Não bộ ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-14 anim">
                <!-- Brain visual -->
                <div class="lg:w-[40%] flex justify-center">
                    <div class="relative w-56 h-56 sm:w-72 sm:h-72 bg-blue-100 rounded-full flex items-center justify-center shadow-inner">
                        <i data-lucide="brain-circuit" class="w-28 h-28 sm:w-36 sm:h-36 text-blue-600"></i>
                        <div class="absolute top-4 right-2 sm:top-6 sm:right-4 bg-white py-2 px-3 rounded-xl shadow-lg font-bold text-xs sm:text-sm text-slate-700" style="animation: float 3s ease-in-out infinite;">2% Trọng lượng</div>
                        <div class="absolute bottom-4 left-2 sm:bottom-6 sm:left-4 bg-white py-2 px-3 rounded-xl shadow-lg font-bold text-xs sm:text-sm text-slate-700" style="animation: float 3s ease-in-out infinite 0.5s;">20% Tiêu thụ ATP</div>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:w-[60%]">
                    <span class="inline-block bg-purple-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Não bộ</span>
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-4">Rối loạn dẫn truyền thần kinh do thiếu hụt nguyên liệu chuyển hóa</h2>
                    <p class="text-gray-600 text-base sm:text-lg mb-6">Não bộ đòi hỏi nguồn cung cấp vi chất liên tục với mật độ cao. Sự thiếu hụt gây ra 3 hệ quả nghiêm trọng:</p>

                    <div class="space-y-5">
                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-red-500 text-white rounded-lg flex items-center justify-center shrink-0 mt-0.5 shadow-md">
                                <i data-lucide="x-circle" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-['Quicksand'] font-bold text-slate-800 text-lg">Suy giảm tổng hợp chất dẫn truyền</h4>
                                <p class="text-gray-600 text-sm sm:text-base">Quá trình sản xuất Serotonin (điều hòa khí sắc) và GABA (ức chế) bị đình trệ do thiếu Vitamin B6 và Kẽm.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-orange-500 text-white rounded-lg flex items-center justify-center shrink-0 mt-0.5 shadow-md">
                                <i data-lucide="radio" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-['Quicksand'] font-bold text-slate-800 text-lg">Nhiễu loạn tín hiệu thần kinh</h4>
                                <p class="text-gray-600 text-sm sm:text-base">Mất cân bằng nội môi đặt hệ thần kinh vào trạng thái quá kích thích (overdrive), gây khó khăn trong xử lý thông tin và kiểm soát xung động.</p>
                            </div>
                        </div>

                        <div class="flex gap-4 items-start">
                            <div class="w-10 h-10 bg-purple-600 text-white rounded-lg flex items-center justify-center shrink-0 mt-0.5 shadow-md">
                                <i data-lucide="biohazard" class="w-5 h-5"></i>
                            </div>
                            <div>
                                <h4 class="font-['Quicksand'] font-bold text-slate-800 text-lg">Suy giảm năng lực giải độc nội sinh</h4>
                                <p class="text-gray-600 text-sm sm:text-base">Thiếu Kẽm, Selen làm suy giảm hệ enzyme giải độc gan. Độc tính tích tụ tác động lên hàng rào máu não, gây suy giảm định hướng và sự chú ý.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 5: Giải pháp ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-emerald-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Giải pháp</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">TÁI THIẾT LẬP CHỨC NĂNG TẾ BÀO</h2>
            </div>

            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-xl border border-gray-200 overflow-hidden anim d1">
                <div class="flex flex-col lg:flex-row">
                    <!-- Left: Nguyên lý -->
                    <div class="lg:w-1/2 p-6 sm:p-8 lg:p-10 bg-gradient-to-br from-emerald-50 to-teal-50">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shadow-md">
                                <i data-lucide="sprout" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-slate-800">Tuân thủ nguyên lý hấp thu</h3>
                        </div>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-6">
                            Bổ sung vitamin tổng hợp liều cao khi niêm mạc ruột chưa phục hồi sẽ mang lại sinh khả dụng thấp và tăng gánh nặng bài tiết. Phải tiến hành đồng thời hai lộ trình: <strong>hỗ trợ phục hồi niêm mạc</strong> và <strong>cung cấp vi chất sinh khả dụng cao</strong>.
                        </p>
                        <div class="bg-white rounded-xl p-5 border border-emerald-200 shadow-sm">
                            <h4 class="font-['Quicksand'] font-bold text-slate-800 mb-3">Khuyến cáo lâm sàng</h4>
                            <ul class="space-y-2">
                                <li class="flex items-start gap-2 text-sm text-gray-600">
                                    <div class="w-5 h-5 bg-emerald-500 text-white rounded flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></div>
                                    Điều chỉnh phác đồ: hạn chế carbohydrate tinh chế, kiểm soát protein gây bất dung nạp.
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-600">
                                    <div class="w-5 h-5 bg-emerald-500 text-white rounded flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></div>
                                    Ghi chép theo dõi lâm sàng liên tục các đáp ứng sinh lý.
                                </li>
                                <li class="flex items-start gap-2 text-sm text-gray-600">
                                    <div class="w-5 h-5 bg-emerald-500 text-white rounded flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-3 h-3"></i></div>
                                    Tham vấn chuyên gia dinh dưỡng y sinh để cá nhân hóa phác đồ.
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Right: Tối ưu nguồn cung -->
                    <div class="lg:w-1/2 p-6 sm:p-8 lg:p-10">
                        <div class="flex items-center gap-3 mb-6">
                            <div class="w-12 h-12 bg-blue-600 text-white rounded-xl flex items-center justify-center shadow-md">
                                <i data-lucide="check-circle" class="w-6 h-6"></i>
                            </div>
                            <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-slate-800">Tối ưu hóa nguồn cung</h3>
                        </div>

                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg shrink-0 shadow-md font-['Quicksand']">1</div>
                                <div>
                                    <h4 class="font-['Quicksand'] font-bold text-slate-800 text-base sm:text-lg">Thực phẩm toàn phần (Whole foods)</h4>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">Vi chất tự nhiên đi kèm enzyme đồng vận tối ưu hấp thu. Ví dụ: Kẽm từ hạt bí, Magie từ rau xanh, Omega-3 từ cá nhỏ.</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg shrink-0 shadow-md font-['Quicksand']">2</div>
                                <div>
                                    <h4 class="font-['Quicksand'] font-bold text-slate-800 text-base sm:text-lg">Hợp chất sinh khả dụng cao</h4>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">Ưu tiên khoáng chất dạng chelate (Magie Glycinate, Kẽm Picolinate) và Vitamin B đã hoạt hóa (P-5-P cho B6, Methylfolate cho B9).</p>
                                </div>
                            </div>

                            <div class="flex gap-4">
                                <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold text-lg shrink-0 shadow-md font-['Quicksand']">3</div>
                                <div>
                                    <h4 class="font-['Quicksand'] font-bold text-slate-800 text-base sm:text-lg">Nguyên tắc chuẩn độ (Low and Slow)</h4>
                                    <p class="text-sm text-gray-600 mt-1 leading-relaxed">Khởi đầu với liều lượng tối thiểu và tăng dần theo đáp ứng, giúp hệ thống dung nạp mà không gây kích ứng.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ DISCLAIMER ═══════════════════════ -->
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 anim">
            <div class="bg-slate-700 rounded-2xl p-6 sm:p-8 text-white shadow-md">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-amber-500 rounded-xl flex items-center justify-center shrink-0 shadow-lg">
                        <i data-lucide="alert-triangle" class="w-6 h-6 text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-['Quicksand'] font-bold text-sm uppercase tracking-widest mb-2 text-slate-200">Tuyên bố miễn trừ trách nhiệm y khoa (Disclaimer)</h3>
                        <p class="text-slate-300 text-sm leading-relaxed">
                            Tài liệu này được biên soạn với mục đích giáo dục cộng đồng và cung cấp thông tin khoa học tham khảo; không cấu thành và không thay thế cho các chẩn đoán, tư vấn chuyên môn hay phác đồ điều trị y khoa lâm sàng. Quyết định điều chỉnh chế độ dinh dưỡng hoặc áp dụng thực phẩm bổ sung cần được thực hiện dưới sự giám sát và tham vấn trực tiếp của các bác sĩ chuyên khoa hoặc chuyên gia y tế, căn cứ trên hồ sơ bệnh án và tình trạng sức khỏe thực tế của từng cá nhân.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER / CTA ═══════════════════════ -->
    <section id="thong-tin-lien-he" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-blue-900 py-14 md:py-20">
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Thông tin hỗ trợ chuyên môn</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Tiến trình can thiệp y sinh là một quy trình phức tạp. Nếu con bạn gặp khó khăn mạn tính về tiêu hóa, giấc ngủ hay rào cản hành vi, hãy liên hệ với chúng tôi để được đồng hành.
                    </p>
                </div>

                <!-- CTA Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-12 anim d1">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="facebook" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Cộng đồng Y sinh</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hiểu con từ Gốc</span>
                        </div>
                    </a>

                    <a href="https://zalo.me/g/vmgfxy834" target="_blank"
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="message-circle" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Zalo hỗ trợ</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh</span>
                        </div>
                    </a>

                    <a href="tel:0988717107"
                       class="bg-white/10 hover:bg-blue-600 border border-white/10 hover:border-blue-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(37,99,235,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="phone" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hotline/Zalo</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                       class="bg-white/10 hover:bg-indigo-600 border border-white/10 hover:border-indigo-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(79,70,229,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="user-check" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-indigo-200 transition-colors">Hỗ trợ trực tiếp</span>
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

    <!-- Initialize Lucide + Scroll Animations -->
    <script>
        lucide.createIcons();
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
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