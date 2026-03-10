<?php
/**
 * Template Name: Trang Chế độ ăn GFCF
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phương pháp can thiệp dinh dưỡng GFCF và SF</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        .hero-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 40%, #334155 100%);
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
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-blue-500/5 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] rounded-full bg-teal-500/5 translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-8 right-16 opacity-[0.04] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i class="fa-solid fa-wheat-awn text-white text-[200px]"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-blue-500/20 text-blue-200 font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-blue-400/30">
                    <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                    <i class="fa-solid fa-book-medical"></i> HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-['Quicksand'] text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                CHẾ ĐỘ ĂN GFCFSF <br class="hidden md:block">
                <span class="text-teal-300">Không chỉ là "kiêng khem"</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-slate-300 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Từ góc nhìn sinh lý học thần kinh: Cắt đứt sự phụ thuộc hóa học, kiến tạo môi trường nội môi thuận lợi cho sự tự phục hồi ở trẻ có rối loạn phát triển.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#thong-tin-lien-he" class="bg-teal-400 hover:bg-teal-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Nhận tham vấn chuyên môn <i class="fa-solid fa-arrow-down animate-bounce"></i>
                </a>
                <a href="#co-che" class="bg-white/15 hover:bg-white/25 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/25 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Tìm hiểu cơ chế <i class="fa-solid fa-microscope"></i>
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

    <!-- ═══════════════════════ SECTION 1: Rào cản tâm lý ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border border-gray-200 anim">
                <!-- Text side -->
                <div class="lg:w-[58%] p-7 sm:p-10 lg:p-12 flex flex-col justify-center bg-white">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl font-bold text-slate-800 mb-6 flex items-start gap-3">
                        <span class="w-1.5 h-full min-h-[2rem] bg-blue-600 rounded-full shrink-0 mt-1"></span>
                        Khái quát về các rào cản tâm lý trong quá trình can thiệp
                    </h2>
                    <p class="mb-4 text-gray-600 text-base sm:text-lg leading-relaxed">
                        Tập quán văn hóa thường gắn liền sự chăm sóc với việc cung cấp nguồn dinh dưỡng phong phú. Việc áp dụng phác đồ <strong>GFCF và SF (Không lúa mì, Không sữa bò, Không đậu nành)</strong> thường làm dấy lên những lo ngại về việc hạn chế khẩu phần ăn của trẻ.
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                        Tuy nhiên, các phản ứng tiêu cực khi trẻ bị từ chối thực phẩm quen thuộc không nên được diễn giải thuần túy là sự rối loạn hành vi. Chúng đóng vai trò như những <strong>tín hiệu cảnh báo</strong> về sự phụ thuộc của hệ thần kinh trung ương vào các hợp chất không phù hợp. Việc tuân thủ phác đồ là hỗ trợ cơ thể loại bỏ sự phụ thuộc hóa học.
                    </p>
                </div>
                <!-- Card side -->
                <div class="lg:w-[42%] bg-gradient-to-br from-emerald-50 to-teal-50 p-7 sm:p-10 lg:p-12 flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-6 -top-6 opacity-10">
                        <i class="fa-solid fa-seedling text-[140px] text-emerald-600"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 shadow-md">
                            <i class="fa-solid fa-seedling"></i>
                        </div>
                        <h3 class="font-['Quicksand'] text-xl sm:text-2xl font-bold text-slate-800 mb-4">Căn nguyên từ gốc rễ</h3>
                        <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                            Hành vi ăn vạ, bứt rứt đòi thực phẩm chứa Gluten/Casein/Soy chỉ là những "chiếc lá héo úa" thể hiện trên bề mặt. Đó không phải là do trẻ "hư", mà là biểu hiện của một "bộ rễ" tiêu hóa đang bị tổn thương sâu sắc bởi viêm nhiễm nội môi. Can thiệp dinh dưỡng chính là quá trình chữa lành từ gốc.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 2: Cơ chế sinh lý ═══════════════════════ -->
    <section id="co-che" class="py-12 md:py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-blue-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-slate-700 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế sinh lý</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-slate-900 mb-3">Cơ chế sinh lý học thần kinh của sự thèm ăn</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Quá trình các protein chưa được phân giải hoàn toàn chuyển hóa thành các peptide có hoạt tính kích thích hệ thần kinh trung ương.</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Bước 1 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d1">
                    <div class="bg-red-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-bacterium text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-red-500 text-2xl font-['Quicksand'] font-extrabold">1</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Tổn thương niêm mạc ruột</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Hội chứng rò rỉ ruột (Leaky Gut) và thiếu hụt enzyme dẫn đến việc phân giải không hoàn toàn protein từ lúa mì, sữa bò và đậu nành.
                        </p>
                    </div>
                </div>

                <!-- Bước 2 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d2">
                    <div class="bg-amber-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-dna text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-amber-500 text-2xl font-['Quicksand'] font-extrabold">2</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Hình thành chuỗi Peptide</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Tạo ra các chuỗi peptide lửng lơ mang hoạt tính sinh học đặc biệt: <span class="font-semibold text-amber-600">Gliadorphin</span>, <span class="font-semibold text-amber-600">Casomorphin</span> và <span class="font-semibold text-amber-600">Soymorphin</span>.
                        </p>
                    </div>
                </div>

                <!-- Bước 3 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover anim d3">
                    <div class="bg-blue-600 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-2 top-1/2 -translate-y-1/2 opacity-10">
                            <i class="fa-solid fa-head-side-virus text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-blue-600 text-2xl font-['Quicksand'] font-extrabold">3</span>
                        </div>
                        <h3 class="font-['Quicksand'] text-lg sm:text-xl font-bold text-white relative z-10">Kích thích thụ thể Opiate</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Peptide vượt hàng rào máu não, liên kết thụ thể Opiate, gây hưng phấn nhất thời nhưng sau đó nhiễu loạn dẫn truyền thần kinh, gây tăng động và giảm chú ý.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 3: Hội chứng cai ═══════════════════════ -->
    <section class="py-12 md:py-16 relative overflow-hidden">
        <div class="bg-gradient-to-br from-slate-800 via-slate-900 to-slate-800 py-12 md:py-16">
            <div class="absolute top-0 right-1/4 w-[400px] h-[400px] bg-blue-500/10 rounded-full blur-[100px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="flex flex-col lg:flex-row items-center gap-8 lg:gap-14 anim">
                    <!-- Content -->
                    <div class="lg:w-[60%]">
                        <span class="inline-block bg-blue-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-4">Giai đoạn chuyển tiếp</span>
                        <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-blue-300 mb-6">Hội chứng cai (Withdrawal Syndrome)</h2>
                        <p class="text-slate-300 text-base sm:text-lg leading-relaxed mb-6">
                            Sự sụt giảm đột ngột nồng độ các peptide có tính kích thích sẽ đẩy hệ thần kinh vào trạng thái thiếu hụt. Trong chu kỳ <strong class="text-white">1 đến 3 tuần đầu tiên</strong>, bệnh nhi có khả năng biểu hiện:
                        </p>
                        <ul class="space-y-4 mb-6">
                            <li class="flex items-start gap-3">
                                <div class="w-7 h-7 bg-blue-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-check text-sm"></i></div>
                                <span class="text-slate-200 text-base sm:text-lg">Gia tăng mức độ kích thích, cáu gắt và bứt rứt.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-7 h-7 bg-blue-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-check text-sm"></i></div>
                                <span class="text-slate-200 text-base sm:text-lg">Rối loạn chu kỳ giấc ngủ, khó vào giấc hoặc thức giấc giữa đêm.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="w-7 h-7 bg-blue-500 text-white rounded-md flex items-center justify-center shrink-0 mt-0.5"><i class="fa-solid fa-check text-sm"></i></div>
                                <span class="text-slate-200 text-base sm:text-lg">Sự từ chối tiếp nhận các dạng thức ăn mới.</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Highlight quote -->
                    <div class="lg:w-[40%]">
                        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 sm:p-8 border border-white/10">
                            <div class="w-12 h-12 bg-blue-500 text-white rounded-xl flex items-center justify-center text-xl mb-4 shadow-lg">
                                <i class="fa-solid fa-chart-line"></i>
                            </div>
                            <p class="text-blue-100 text-base sm:text-lg italic leading-relaxed">
                                "Những biểu hiện trên không phản ánh sự thoái lui về mặt nhận thức hay kỹ năng, mà là minh chứng cho quá trình cơ thể đang gia tăng năng lượng để đào thải tàn dư hóa học, nhằm thiết lập lại trạng thái cân bằng sinh lý mới."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 4: Giải pháp dinh dưỡng ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-teal-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Khuyến nghị</span>
                <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl font-bold text-slate-900 mb-3">Xây dựng khẩu phần an toàn và hỗ trợ phục hồi</h2>
                <p class="text-gray-500 max-w-4xl mx-auto text-base sm:text-lg">Nguyên tắc nền tảng: Luôn thiết lập sẵn các phương án thực phẩm thay thế có giá trị cảm quan tương đương trước khi tiến hành loại trừ.</p>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 lg:gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-teal-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-bottle-droplet"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Kiểm soát gia vị và lipid</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Đậu nành có cấu trúc phân tử tương đồng Casein, dễ gây phản ứng chéo. Khuyến nghị loại bỏ hoàn toàn nước tương, dầu đậu nành.</p>
                    <div class="bg-teal-50 rounded-xl p-4 border border-teal-100">
                        <p class="text-sm font-semibold text-teal-800"><i class="fa-solid fa-lightbulb text-teal-500 mr-1"></i> Thay thế: Nước mắm truyền thống, muối biển, nước tương dừa. Dùng mỡ lợn sạch, dầu oliu để kháng viêm.</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-teal-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-bowl-rice"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Ưu tiên thực phẩm nguyên bản</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Xây dựng chế độ dinh dưỡng dựa trên thực phẩm tự nhiên, chưa qua chế biến sâu để tối ưu hóa quá trình phục hồi biểu mô ruột.</p>
                    <div class="bg-teal-50 rounded-xl p-4 border border-teal-100">
                        <p class="text-sm font-semibold text-teal-800"><i class="fa-solid fa-lightbulb text-teal-500 mr-1"></i> Khuyến khích: Cơm trắng, các loại tinh bột tự nhiên (khoai, ngô), thịt cá tươi sống, rau củ quả đa dạng.</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-teal-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-mug-hot"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Bổ sung dưỡng chất hỗ trợ</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Nước hầm xương chứa hàm lượng cao collagen và axit amin tự do (L-glutamine) là liệu pháp hỗ trợ đắc lực đối với hội chứng rò rỉ ruột.</p>
                    <div class="bg-teal-50 rounded-xl p-4 border border-teal-100">
                        <p class="text-sm font-semibold text-teal-800"><i class="fa-solid fa-lightbulb text-teal-500 mr-1"></i> Thực hành: Trữ đông nước hầm xương để làm dung môi thay thế hạt nêm công nghiệp trong chế biến thức ăn.</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-amber-50 rounded-2xl p-6 sm:p-7 border-2 border-amber-300 shadow-sm card-hover group anim d4">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-seedling"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl text-slate-800 mb-3">Nguyên tắc chuyển đổi tiệm cận</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-4">Đối với bệnh nhi mẫn cảm cao, nên điều chỉnh giảm dần tỷ lệ thực phẩm gây viêm để hệ vi sinh có thời gian thích nghi.</p>
                    <div class="bg-amber-100 rounded-xl p-4 border border-amber-200">
                        <p class="text-sm font-semibold text-amber-800"><i class="fa-solid fa-lightbulb text-amber-600 mr-1"></i> Mẹo thực thi: Pha loãng tỷ lệ sữa bò và sữa hạt dần dần. Sử dụng lại bao bì cũ trong những ngày đầu để giảm rào cản thị giác.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 5: Lưu ý lâm sàng ═══════════════════════ -->
    <section class="py-10 md:py-14 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 anim">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md overflow-hidden border border-gray-200">
                <!-- Header bar -->
                <div class="bg-indigo-600 py-4 px-6 sm:px-8 flex items-center gap-3">
                    <i class="fa-solid fa-clipboard-list text-white text-xl sm:text-2xl"></i>
                    <h2 class="font-['Quicksand'] text-lg sm:text-xl md:text-2xl font-bold text-white">Những lưu ý về tính đa dạng trong đáp ứng lâm sàng</h2>
                </div>
                <!-- Body -->
                <div class="p-6 sm:p-8 lg:p-10 flex flex-col lg:flex-row gap-6 lg:gap-10">
                    <div class="flex-1">
                        <p class="text-gray-700 leading-relaxed text-base sm:text-lg mb-4">
                            Phác đồ GFCF & SF mang lại các cải thiện lâm sàng khả quan (thuyên giảm rối loạn hành vi, cải thiện tiêu hóa, nâng cao tập trung). Tuy nhiên, đây không phải phương pháp có tính đáp ứng phổ quát. Sự khác biệt về thẩm thấu ruột dẫn đến thời gian đáp ứng khác nhau (từ vài tuần đến nhiều tháng).
                        </p>
                        <p class="text-gray-700 font-semibold text-base sm:text-lg">
                            * Phương pháp đánh giá khách quan nhất là thiết lập hệ thống ghi chép nhật ký dinh dưỡng và hành vi liên tục.
                        </p>
                    </div>
                    <div class="lg:w-[380px] shrink-0 bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <h3 class="font-['Quicksand'] text-lg font-bold text-slate-800 mb-2">Kết luận</h3>
                        <p class="text-gray-600 text-sm leading-relaxed">
                            Tái cấu trúc chế độ dinh dưỡng đòi hỏi sự đầu tư lớn về nguồn lực và sự kiên định. Thông qua việc loại trừ các hợp chất gây nhiễu loạn thần kinh, phác đồ hướng tới mục tiêu thiết lập lại trạng thái cân bằng sinh lý. Khi nền tảng thể chất được tối ưu hóa, trẻ sẽ có điều kiện tiếp nhận và đáp ứng hiệu quả hơn đối với các liệu pháp can thiệp giáo dục.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ DISCLAIMER ═══════════════════════ -->
    <section class="py-8 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 anim">
            <div class="bg-red-500 rounded-2xl p-6 sm:p-8 text-white shadow-md">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="font-['Quicksand'] font-bold text-lg sm:text-xl uppercase mb-2">Tuyên bố miễn trừ trách nhiệm y khoa (Disclaimer)</h3>
                        <p class="text-red-100 text-sm sm:text-base leading-relaxed">
                            Tài liệu này được biên soạn độc quyền nhằm mục đích giáo dục cộng đồng và cung cấp thông tin khoa học khái quát. Nội dung trong văn bản không cấu thành và không được phép thay thế cho các chẩn đoán y khoa, phác đồ điều trị hay lời khuyên từ các chuyên gia y tế có chuyên môn. Mọi quyết định liên quan đến việc điều chỉnh chế độ dinh dưỡng, sử dụng thực phẩm bổ sung, hoặc can thiệp y tế đối với trẻ em cần phải được thông qua và giám sát bởi bác sĩ chuyên khoa hoặc chuyên gia dinh dưỡng lâm sàng, căn cứ trên tình trạng sức khỏe thực tế của từng cá nhân.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER / CTA ═══════════════════════ -->
    <section id="thong-tin-lien-he" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-slate-800 py-14 md:py-20">
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-blue-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/3 w-[400px] h-[400px] bg-teal-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-['Quicksand'] text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Thông tin hỗ trợ và tham vấn chuyên môn</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Quá trình can thiệp y sinh là một lộ trình dài hạn và cần sự đồng hành từ các chuyên gia.
                    </p>
                </div>

                <!-- CTA Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-12 anim d1">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-brands fa-facebook-f text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Cộng đồng Facebook</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hiểu con từ Gốc</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                       class="bg-white/10 hover:bg-teal-500 border border-white/10 hover:border-teal-500 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(20,184,166,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-user-doctor text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-teal-100 transition-colors">Tư vấn trực tiếp</span>
                        </div>
                    </a>

                    <a href="tel:0988717107"
                       class="bg-white/10 hover:bg-blue-600 border border-white/10 hover:border-blue-600 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(37,99,235,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hotline hỗ trợ</span>
                        </div>
                    </a>

                    <a href="https://zalo.me/g/vmgfxy834" target="_blank"
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-comment-dots text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Kênh Zalo</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp trực tuyến</span>
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