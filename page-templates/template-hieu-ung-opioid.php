<?php
/**
 * Template Name: Trang Hiếu ứng Opioid
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải mã hiệu ứng Opioid - Tự kỷ là rối loạn toàn thân</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background: linear-gradient(135deg, #312e81 0%, #3730a3 35%, #4f46e5 100%);
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
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-white/5 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] rounded-full bg-white/5 translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-8 right-16 opacity-[0.06] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i data-lucide="brain" class="w-52 h-52 text-white"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/15 text-white font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-white/25">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    <i data-lucide="book-open" class="w-4 h-4"></i> HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-['Quicksand'] text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                Giải mã hiệu ứng Opioid: <br class="hidden md:block">
                <span class="text-yellow-300">Vì sao con phụ thuộc bánh mì và sữa?</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-indigo-200 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Khám phá cơ chế y sinh học đằng sau hiện tượng kén ăn chọn lọc ở trẻ tự kỷ. Trẻ không bướng bỉnh, cơ thể trẻ đang bị chi phối bởi những "chất kích thích nội sinh" từ đường ruột tổn thương.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#iceberg" class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Khám phá bản chất <i data-lucide="arrow-down" class="w-5 h-5 animate-bounce"></i>
                </a>
                <a href="#support" class="bg-white/20 hover:bg-white/30 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Nhận hỗ trợ ngay <i data-lucide="headphones" class="w-5 h-5"></i>
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

    <!-- ═══════════════════════ ICEBERG METAPHOR ═══════════════════════ -->
    <section id="iceberg" class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-indigo-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Mô hình nhận thức</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Mô hình tảng băng trôi</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Điều chúng ta thấy ở con trẻ chỉ là phần nổi, nguyên nhân thực sự nằm ẩn sâu bên trong cơ thể.</p>
            </div>

            <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border border-gray-200 anim d1">
                <!-- Left: Iceberg content -->
                <div class="lg:w-[58%] p-7 sm:p-10 lg:p-12 bg-gradient-to-b from-sky-50 to-indigo-50 flex flex-col justify-center">
                    <!-- Above water -->
                    <div class="mb-6">
                        <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-sky-800 flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 bg-sky-500 text-white rounded-lg flex items-center justify-center shrink-0">
                                <i data-lucide="eye" class="w-5 h-5"></i>
                            </div>
                            Phần nổi (hành vi quan sát được)
                        </h3>
                        <ul class="space-y-3 text-gray-700 text-base sm:text-lg">
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-red-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="x" class="w-4 h-4"></i></div>
                                Kén ăn chọn lọc, chỉ ăn bánh mì, mì gói, sữa.
                            </li>
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-red-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="x" class="w-4 h-4"></i></div>
                                Cáu gắt, ăn vạ, kích động khi bị đổi món.
                            </li>
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-red-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="x" class="w-4 h-4"></i></div>
                                Bị xã hội dán nhãn là "bướng bỉnh", "khó tính".
                            </li>
                        </ul>
                    </div>

                    <!-- Divider -->
                    <div class="border-t-2 border-dashed border-indigo-200 my-4 relative">
                        <span class="absolute -top-3 left-1/2 -translate-x-1/2 bg-gradient-to-r from-sky-50 to-indigo-50 px-3 text-xs font-bold text-indigo-400 uppercase tracking-widest">Mặt nước</span>
                    </div>

                    <!-- Below water -->
                    <div class="mt-4">
                        <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-indigo-800 flex items-center gap-2 mb-4">
                            <div class="w-10 h-10 bg-indigo-600 text-white rounded-lg flex items-center justify-center shrink-0">
                                <i data-lucide="microscope" class="w-5 h-5"></i>
                            </div>
                            Phần chìm (căn nguyên y sinh)
                        </h3>
                        <ul class="space-y-3 text-gray-700 text-base sm:text-lg">
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-emerald-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-4 h-4"></i></div>
                                Tổn thương vi mô tại niêm mạc ruột.
                            </li>
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-emerald-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-4 h-4"></i></div>
                                Nhiễu loạn hệ thống dẫn truyền thần kinh.
                            </li>
                            <li class="flex gap-3 items-start">
                                <div class="w-7 h-7 bg-emerald-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i data-lucide="check" class="w-4 h-4"></i></div>
                                Cơ chế bù trừ sinh lý do mất cân bằng hóa sinh.
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Right: Highlight card -->
                <div class="lg:w-[42%] p-7 sm:p-10 lg:p-12 flex flex-col items-center justify-center bg-white text-center">
                    <div class="w-36 h-36 sm:w-44 sm:h-44 bg-indigo-100 rounded-full flex items-center justify-center mb-6 relative">
                        <i data-lucide="mountain-snow" class="w-20 h-20 sm:w-24 sm:h-24 text-indigo-500"></i>
                        <div class="absolute inset-0 border-4 border-indigo-200 rounded-full animate-ping opacity-20"></div>
                    </div>
                    <h4 class="font-['Quicksand'] text-2xl sm:text-3xl font-bold text-slate-800 mb-3">Không phải là sở thích</h4>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">Sự đòi hỏi dai dẳng này là một trạng thái nội môi rối loạn mà bản thân trẻ không có khả năng nhận thức hoặc diễn đạt.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ PATHOPHYSIOLOGY JOURNEY ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-blue-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-blue-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Hành trình sinh bệnh</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-3">Từ dạ dày đến não bộ</h2>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d1">
                    <div class="bg-orange-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="scissors" class="w-20 h-20 text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-orange-500 text-2xl font-['Quicksand'] font-extrabold">1</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Thiếu hụt enzyme DPP-IV</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Gluten (lúa mì) và Casein (sữa) là các protein rất bền vững. Ở trẻ rối loạn, ruột thiếu hụt enzyme DPP-IV khiến protein không được cắt nhỏ hoàn toàn, tạo thành các đoạn <strong>peptide lửng lơ</strong> mang cấu trúc không hoàn chỉnh.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d2">
                    <div class="bg-red-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="waves" class="w-20 h-20 text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-red-500 text-2xl font-['Quicksand'] font-extrabold">2</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Hội chứng rò rỉ ruột</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Đáng lẽ bị đào thải, nhưng do mắc hội chứng Leaky Gut (tăng tính thấm ruột), các niêm mạc ruột có khe hở. Các đoạn peptide lửng lơ này lọt qua vách ruột, thâm nhập trực tiếp vào dòng máu ngoại vi.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d3">
                    <div class="bg-purple-600 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i data-lucide="brain" class="w-20 h-20 text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-purple-600 text-2xl font-['Quicksand'] font-extrabold">3</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Vượt hàng rào máu não</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Các peptide di chuyển theo mạch máu và vượt qua hàng rào máu não đang suy yếu. Chúng được gọi tên là <strong>Gliadorphin</strong> (từ Gluten) và <strong>Casomorphin</strong> (từ Casein).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ BIOCHEMISTRY MECHANISM ═══════════════════════ -->
    <section class="py-12 md:py-16 relative overflow-hidden">
        <div class="bg-gradient-to-br from-indigo-900 via-indigo-800 to-purple-900 py-12 md:py-16">
            <div class="absolute top-0 right-1/4 w-[400px] h-[400px] bg-indigo-500/15 rounded-full blur-[100px]"></div>
            <div class="absolute bottom-0 left-1/4 w-[300px] h-[300px] bg-purple-500/15 rounded-full blur-[100px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-12 anim">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-white mb-3">Chìa khóa giả mạo và ổ khóa Opiate</h2>
                </div>

                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-14 anim d1">
                    <!-- Text -->
                    <div class="lg:w-[55%]">
                        <p class="text-indigo-200 text-base sm:text-lg mb-6 leading-relaxed">
                            Trong não bộ con người có các <strong class="text-white">thụ thể Opiate</strong> (ổ khóa) sinh ra để nhận <strong class="text-white">Endorphin nội sinh</strong> (chìa khóa thật) - chất giúp giảm đau, tạo cảm giác dễ chịu.
                        </p>
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 sm:p-7 border border-white/10">
                            <p class="text-white text-base sm:text-lg font-medium leading-relaxed">
                                Cấu trúc của Gliadorphin và Casomorphin từ thức ăn tương đồng với Endorphin. Chúng đóng vai trò như những <span class="text-yellow-400 font-bold">"chiếc chìa khóa giả mạo"</span> gắn kết và kích hoạt các thụ thể não bộ một cách sai lệch.
                            </p>
                        </div>
                    </div>

                    <!-- Visual diagram -->
                    <div class="lg:w-[45%] flex justify-center">
                        <div class="flex gap-4 sm:gap-6 items-center">
                            <div class="bg-white/10 backdrop-blur-sm p-6 sm:p-8 rounded-2xl border border-white/10 text-center shadow-xl">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-yellow-400 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i data-lucide="key" class="w-8 h-8 sm:w-10 sm:h-10 text-yellow-900"></i>
                                </div>
                                <span class="block text-sm font-bold text-indigo-200 uppercase leading-tight">Peptide<br>thức ăn<br><span class="text-yellow-400">(chìa giả)</span></span>
                            </div>

                            <div class="flex flex-col items-center gap-1">
                                <i data-lucide="arrow-right" class="w-8 h-8 text-indigo-400 hidden sm:block"></i>
                                <i data-lucide="arrow-down" class="w-8 h-8 text-indigo-400 sm:hidden"></i>
                            </div>

                            <div class="bg-white/10 backdrop-blur-sm p-6 sm:p-8 rounded-2xl border border-white/10 text-center shadow-xl">
                                <div class="w-16 h-16 sm:w-20 sm:h-20 bg-emerald-500 rounded-2xl flex items-center justify-center mx-auto mb-3 shadow-lg">
                                    <i data-lucide="lock" class="w-8 h-8 sm:w-10 sm:h-10 text-white"></i>
                                </div>
                                <span class="block text-sm font-bold text-indigo-200 uppercase leading-tight">Thụ thể<br>Opiate<br><span class="text-emerald-400">(ổ khóa)</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ CLINICAL CONSEQUENCES ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-red-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Dấu hiệu cảnh báo</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Hệ lụy của hiệu ứng Opioid</h2>
            </div>

            <div class="grid sm:grid-cols-3 gap-5 lg:gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-red-500 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="zap" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Hưng phấn giả tạo và hành vi định hình</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        Não bị ép tiết lượng lớn Dopamine. Trẻ rơi vào hưng phấn giả tạo: cười vô cớ, chạy lăng xăng, hoặc lặp lại hành vi (stimming) để duy trì kích thích. Ánh mắt đờ đẫn như người đang "say".
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="link" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Sự phụ thuộc và phản ứng thiếu hụt</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        Cơ thể hình thành sự dung nạp, đòi hỏi ngày càng nhiều peptide từ bánh mì/sữa. Cắt giảm đột ngột sẽ gây ra phản ứng sinh lý: bứt rứt, kích động, vã mồ hôi tương tự như hội chứng cai.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-slate-700 text-white rounded-xl flex items-center justify-center mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i data-lucide="brain" class="w-7 h-7"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-900 mb-3">Phong tỏa nhận thức và giao tiếp</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                        Các vùng não xử lý ngôn ngữ, tương tác bị "đóng băng". Năng lượng (ATP) tại ty thể cạn kiệt do xử lý tín hiệu lỗi. Một bộ não cạn năng lượng sẽ phản ứng bằng cáu gắt, mất tập trung.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SOLUTIONS (GFCF) ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-emerald-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Giải pháp dinh dưỡng</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Hành trình phục hồi sinh lý</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">
                    Việc dập tắt hành vi bằng thuốc an thần chỉ là giải pháp tạm thời. Chúng ta cần cắt đứt nguồn cung cấp Gliadorphin/Casomorphin từ gốc. Dưới đây là chiến lược điều chỉnh (Chế độ GFCF).
                </p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 lg:gap-6">
                <!-- Solution 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 flex gap-5 items-start shadow-sm border border-gray-200 card-hover anim d1">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-md">
                        <i data-lucide="arrow-left-right" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-2">1. Thay thế tương đương cảm quan</h4>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Trẻ rất nhạy cảm. Hãy thay thế bánh mì bằng bánh bột gạo lứt/yến mạch không gluten; sữa bò thay bằng sữa hạt điều, macca, dừa để giảm cảm giác bị "tước đoạt".</p>
                    </div>
                </div>

                <!-- Solution 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 flex gap-5 items-start shadow-sm border border-gray-200 card-hover anim d2">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-md">
                        <i data-lucide="pill" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-2">2. Khoáng chất xoa dịu thần kinh</h4>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Trẻ sẽ bứt rứt, khó ngủ khi mất đi lượng opioid giả. Bổ sung Magie (hạt bí, rau bina) giúp thư giãn thần kinh tự nhiên, xoa dịu thụ thể đang bị kích thích.</p>
                    </div>
                </div>

                <!-- Solution 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 flex gap-5 items-start shadow-sm border border-gray-200 card-hover anim d3">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-md">
                        <i data-lucide="shield-plus" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-2">3. Nuôi dưỡng vi sinh, vá lỗ rò rỉ</h4>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Tăng cường chất xơ (Prebiotics) đa dạng để nuôi dưỡng lợi khuẩn, củng cố lớp màng nhầy niêm mạc ruột, thiết lập khiên bảo vệ dài hạn.</p>
                    </div>
                </div>

                <!-- Solution 4 -->
                <div class="bg-amber-50 rounded-2xl p-6 sm:p-7 flex gap-5 items-start shadow-sm border-2 border-amber-300 card-hover anim d4">
                    <div class="w-12 h-12 bg-amber-500 text-white rounded-xl flex items-center justify-center shrink-0 shadow-md">
                        <i data-lucide="clock-4" class="w-6 h-6"></i>
                    </div>
                    <div>
                        <h4 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-2">4. Nguyên tắc vàng: "Chậm và ít"</h4>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Tuyệt đối không cắt đột ngột. Hãy giảm dần liều lượng (titration). Cơ thể cần 2-4 tuần để cân bằng sinh lý và đào thải peptide tồn dư. 1-2 tuần đầu trẻ có thể cáu gắt hơn do phản ứng thích nghi sinh lý.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ CTA + EXPECTATIONS ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <!-- Expectations -->
            <div class="bg-indigo-600 text-white rounded-2xl lg:rounded-3xl p-7 sm:p-10 lg:p-12 mb-8 anim relative overflow-hidden">
                <div class="absolute -right-8 -bottom-8 opacity-10">
                    <i data-lucide="heart-handshake" class="w-48 h-48 text-white"></i>
                </div>
                <div class="relative z-10">
                    <h2 class="font-['Quicksand'] text-xl sm:text-2xl md:text-3xl font-bold mb-4">Quản lý kỳ vọng và đồng hành</h2>
                    <p class="text-indigo-100 text-base sm:text-lg leading-relaxed mb-4">
                        Chế độ ăn GFCF mang lại cải thiện đáng kể về giao tiếp bằng mắt và giảm bớt hành vi định hình cho nhiều trẻ, nhưng đây là <strong class="text-white">liệu pháp nền tảng</strong> giúp cân bằng môi trường não bộ, không phải phương pháp chữa khỏi tức thì. Tính độc bản sinh hóa của mỗi trẻ là khác nhau.
                    </p>
                    <p class="text-indigo-100 text-base sm:text-lg leading-relaxed">
                        Trẻ không cố tình làm khó gia đình; trẻ chỉ đang phản ứng với tín hiệu lỗi. Sự kiên nhẫn của cha mẹ là chìa khóa giải phóng thần kinh cho con.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER / CTA ═══════════════════════ -->
    <section id="support" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-indigo-900 py-14 md:py-20">
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-indigo-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/3 w-[400px] h-[400px] bg-purple-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Bạn không phải đi một mình!</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Hành trình y sinh can thiệp cho trẻ cần sự theo dõi và hỗ trợ. Hãy kết nối với cộng đồng hàng ngàn cha mẹ và chuyên gia của chúng tôi:
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
                            <span class="font-bold text-base block truncate">Group cộng đồng</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Facebook Group</span>
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
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hotline tư vấn</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                       class="bg-white/10 hover:bg-indigo-600 border border-white/10 hover:border-indigo-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(79,70,229,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i data-lucide="user-check" class="w-6 h-6"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-indigo-200 transition-colors">Kết nối trực tiếp</span>
                        </div>
                    </a>
                </div>

                <!-- Disclaimer + Copyright -->
                <div class="border-t border-white/10 pt-8 anim d2">
                    <div class="bg-white/5 rounded-2xl p-5 sm:p-6 backdrop-blur-sm border border-white/5 mb-6 max-w-5xl mx-auto">
                        <div class="flex items-start gap-3">
                            <div class="w-8 h-8 bg-amber-500/20 rounded-lg flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="alert-triangle" class="w-4 h-4 text-amber-400"></i>
                            </div>
                            <div>
                                <h4 class="text-slate-300 font-bold text-sm uppercase mb-1">Tuyên bố miễn trừ trách nhiệm y khoa</h4>
                                <p class="text-slate-400 text-xs sm:text-sm leading-relaxed">
                                    Tài liệu/Trang web này được biên soạn nhằm mục đích cung cấp thông tin khoa học chuyên sâu và nâng cao nhận thức cộng đồng. Các thông tin được cung cấp không cấu thành và không có giá trị thay thế cho các chẩn đoán lâm sàng, tư vấn chuyên khoa hay phác đồ điều trị y tế chính thức. Mọi quyết định liên quan đến việc thay đổi phác đồ dinh dưỡng hoặc áp dụng thực phẩm bổ sung cần được tham vấn với bác sĩ chuyên khoa hoặc chuyên gia y tế.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="text-slate-500 text-sm">&copy; <?php echo date('Y'); ?> Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Initialize Lucide Icons + Scroll Animation -->
    <script>
        lucide.createIcons();
        document.addEventListener("DOMContentLoaded", function() {
            // Re-init lucide after DOM ready
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