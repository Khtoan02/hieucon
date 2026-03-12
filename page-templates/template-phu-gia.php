<?php
/**
 * Template Name: Trang Phụ Gia & Phẩm Màu
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ gia, Phẩm màu (MSG) - Công tắc bật lên sự tăng động</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: #F9F8F6; /* Warm Sand */
            color: #1E293B; /* Deep Slate */
        }
        
        .font-heading { font-family: 'Quicksand', sans-serif; }

        /* Color System based on original palette */
        :root {
            --brand-sand: #F9F8F6;
            --brand-teal: #0F766E;
            --brand-sage: #10B981;
            --brand-orange: #F97316;
            --brand-dark: #1E293B;
        }

        .hero-gradient {
            background: linear-gradient(135deg, #0F766E 0%, #134e4a 100%);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.7s ease-out forwards; opacity: 0; }
        .anim.d1 { animation-delay: 100ms; }
        .anim.d2 { animation-delay: 200ms; }
        .anim.d3 { animation-delay: 300ms; }
        .anim.d4 { animation-delay: 400ms; }

        .card-hover {
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px -12px rgba(15, 118, 110, 0.15);
        }

        .glass-teal {
            background: rgba(15, 118, 110, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(15, 118, 110, 0.1);
        }

        .tab-active {
            background-color: #0F766E;
            color: white;
            box-shadow: 0 4px 12px rgba(15, 118, 110, 0.2);
        }
        
        .pulse-warning {
            animation: pulse-border 2s infinite;
        }
        @keyframes pulse-border {
            0% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0.4); }
            70% { box-shadow: 0 0 0 15px rgba(249, 115, 22, 0); }
            100% { box-shadow: 0 0 0 0 rgba(249, 115, 22, 0); }
        }
    </style>
</head>

<body class="antialiased overflow-x-hidden">

    <!-- ═══════════════════════ HERO SECTION ═══════════════════════ -->
    <header class="hero-gradient relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-white/5 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-black/5 translate-y-1/3 -translate-x-1/4"></div>
        
        <div class="max-w-7xl mx-auto px-6 pt-24 pb-20 md:pt-32 md:pb-28 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/10 text-white font-bold text-xs sm:text-sm mb-6 backdrop-blur-md border border-white/20 uppercase tracking-widest">
                    <i class="fa-solid fa-leaf text-teal-300"></i> HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-7xl font-extrabold text-white leading-tight mb-6 anim d1">
                Phụ gia, phẩm màu (MSG)<br>
                <span class="text-orange-400">Công tắc bật lên sự tăng động</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-teal-50 max-w-3xl mx-auto mb-10 leading-relaxed anim d2">
                Nhận diện những tác nhân "tàng hình" trong mâm cơm gia đình và giải mã cơ chế sinh lý khiến hệ thần kinh của trẻ rơi vào trạng thái quá tải.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4 anim d3">
                <a href="#co-che" class="bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-full font-bold text-lg shadow-xl hover:shadow-orange-500/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-1">
                    Tìm hiểu cơ chế <i class="fa-solid fa-arrow-down-long animate-bounce"></i>
                </a>
                <a href="#lien-he" class="bg-white/10 hover:bg-white/20 text-white px-10 py-4 rounded-full font-bold text-lg backdrop-blur-md border border-white/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-1">
                    Hỗ trợ ngay <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- Wave Separator -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#F9F8F6"></path>
            </svg>
        </div>
    </header>

    <!-- ═══════════════════════ LỜI MỞ ĐẦU ═══════════════════════ -->
    <section id="loi-mo-dau" class="py-16 md:py-24 px-6 relative overflow-hidden">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center anim">
                <div class="space-y-6">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-teal-800 flex items-center gap-3">
                        <span class="w-12 h-1 bg-orange-500 rounded-full"></span>
                        Những tác nhân tàng hình trong mâm cơm
                    </h2>
                    <div class="space-y-4 text-slate-600 text-lg leading-relaxed">
                        <p>Trong cuộc sống hiện đại bận rộn, việc sử dụng các loại thực phẩm chế biến sẵn, gia vị công nghiệp hay những gói bim bim, kẹo xốp nhiều màu sắc đã trở thành thói quen của nhiều gia đình.</p>
                        <p>Tuy nhiên, sau những bữa ăn vặt dường như vô hại ấy, cha mẹ thường quan sát thấy con bỗng nhiên chạy nhảy liên tục, cáu gắt vô cớ, nói nhảm hoặc mất hoàn toàn khả năng ngồi yên.</p>
                        <p>Chúng ta dễ có xu hướng cho rằng trẻ con bản tính hiếu động, hoặc con đang quá phấn khích. Tuy nhiên, dưới góc nhìn y sinh học, những thay đổi hành vi đột ngột này có một cơ chế sinh lý rất rõ ràng.</p>
                    </div>
                </div>

                <!-- Analogy Box -->
                <div class="bg-white rounded-[32px] p-8 md:p-10 shadow-xl border border-teal-100 relative overflow-hidden card-hover">
                    <div class="absolute -right-8 -top-8 text-teal-500/5 text-9xl">
                        <i class="fa-solid fa-bell"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-orange-100 text-orange-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm">
                            <i class="fa-solid fa-triangle-exclamation"></i>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-teal-900 mb-4">Tiếng "còi báo cháy" của cơ thể</h3>
                        <p class="text-slate-600 text-lg leading-relaxed italic">
                            Hãy nhớ lại rằng, "Tự kỷ" hay "Tăng động" thực chất chỉ là một nhãn mác bề ngoài, hoạt động giống như chiếc <strong>còi báo cháy</strong> trong nhà. Tiếng còi ồn ào không tự nó sinh ra, mà nó báo hiệu đang có một "đám cháy" ngầm bên trong.
                        </p>
                        <p class="mt-4 text-slate-600 text-lg leading-relaxed">
                            Tương tự, sự lăng xăng, bứt rứt khó kiểm soát của trẻ là <strong>tín hiệu báo động</strong> của một hệ thần kinh đang bị bốc hỏa, kích thích quá mức bởi các hóa chất nhân tạo lọt vào cơ thể.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ BẢN CHẤT KÍCH THÍCH ═══════════════════════ -->
    <section id="co-che" class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 anim">
                <span class="inline-block bg-teal-800 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-4">Khoa học thần kinh</span>
                <h2 class="font-heading text-3xl md:text-5xl font-bold text-teal-900 mb-4">Bản chất của sự kích thích</h2>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto">Hiểu rõ điều gì xảy ra bên trong não bộ khi trẻ tiếp xúc với bột ngọt (MSG) và phẩm màu công nghiệp.</p>
            </div>

            <!-- Interative State Grid -->
            <div class="grid lg:grid-cols-12 gap-8 items-center anim d1">
                <!-- Controls -->
                <div class="lg:col-span-4 space-y-6">
                    <div class="flex flex-col gap-3 p-2 bg-gray-100/80 rounded-2xl border border-gray-200">
                        <button id="btn-balance" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left tab-active" onclick="switchState('balance')">
                            <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-leaf"></i>
                            </div>
                            <div>
                                <div class="text-sm opacity-80 uppercase tracking-tighter italic">Trạng thái</div>
                                Cân bằng tự nhiên
                            </div>
                        </button>
                        <button id="btn-msg" class="flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left bg-white text-slate-500 hover:bg-gray-200" onclick="switchState('msg')">
                            <div class="w-10 h-10 bg-orange-100 text-orange-500 rounded-lg flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-bolt"></i>
                            </div>
                            <div>
                                <div class="text-sm opacity-80 uppercase tracking-tighter italic">Trạng thái</div>
                                Quá tải MSG
                            </div>
                        </button>
                    </div>

                    <div id="content-balance" class="space-y-4 animate-[fadeUp_0.5s_ease-out]">
                        <h3 class="font-heading text-2xl font-bold text-teal-800">Vai trò của Glutamate tự nhiên</h3>
                        <p class="text-slate-600 leading-relaxed">Trong cơ thể con người, Glutamate tự nhiên là một chất dẫn truyền thần kinh đóng vai trò quan trọng trong việc học tập và ghi nhớ.</p>
                        <ul class="space-y-3">
                            <li class="flex items-center gap-3 text-slate-600 font-medium">
                                <i class="fa-solid fa-circle-check text-teal-500"></i> Glutamate giúp nơ-ron phát xung tín hiệu.
                            </li>
                            <li class="flex items-center gap-3 text-slate-600 font-medium">
                                <i class="fa-solid fa-circle-check text-teal-500"></i> GABA đối trọng giúp não bộ thư giãn.
                            </li>
                            <li class="flex items-center gap-3 text-slate-600 font-medium">
                                <i class="fa-solid fa-circle-check text-teal-500"></i> Trạng thái: Điềm tĩnh, tập trung.
                            </li>
                        </ul>
                    </div>

                    <div id="content-msg" class="hidden space-y-4 animate-[fadeUp_0.5s_ease-out]">
                        <h3 class="font-heading text-2xl font-bold text-orange-600">Độc tính kích thích (Excitotoxicity)</h3>
                        <p class="text-slate-600 leading-relaxed">Lượng Glutamate tự do có trong bột ngọt công nghiệp đi vào cơ thể với nồng độ quá lớn và quá nhanh, vượt qua hàng rào máu não.</p>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3 text-slate-600">
                                <i class="fa-solid fa-circle-xmark text-orange-500 mt-1"></i>
                                <span><strong>Nơ-ron kích thích liên tục:</strong> Không đủ GABA kiềm chế, gây bồn chồn, khó ngủ, bùng nổ cảm xúc.</span>
                            </li>
                            <li class="flex items-start gap-3 text-slate-600">
                                <i class="fa-solid fa-battery-empty text-orange-500 mt-1"></i>
                                <span><strong>Cạn kiệt năng lượng:</strong> Ty thể bị vắt kiệt, thiếu hụt ATP. Não bộ như chiếc xe "chạy khi bình xăng cạn".</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Visual -->
                <div class="lg:col-span-8 flex items-center justify-center p-8 bg-teal-50/50 rounded-[40px] border border-teal-100 relative min-h-[400px]">
                    <div id="brain-visual" class="relative w-64 h-64 sm:w-80 sm:h-80 rounded-full border-8 flex items-center justify-center transition-all duration-700" style="border-color: #10B981;">
                        <i id="brain-icon" class="fa-solid fa-brain text-[120px] sm:text-[160px] transition-colors duration-700" style="color: #10B981;"></i>
                        
                        <!-- Floating Badges -->
                        <div id="badge-gaba" class="absolute top-8 left-8 bg-blue-500 text-white px-4 py-1.5 rounded-full font-bold text-sm shadow-lg transition-all duration-500">GABA</div>
                        <div id="badge-glu" class="absolute bottom-8 right-8 bg-teal-500 text-white px-4 py-1.5 rounded-full font-bold text-sm shadow-lg transition-all duration-500">Glutamate</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ TIMELINE PHẢN ỨNG ═══════════════════════ -->
    <section class="py-16 md:py-24 bg-teal-900 overflow-hidden relative">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/carbon-fibre.png')] opacity-10"></div>
        
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16 anim">
                <h2 class="font-heading text-3xl md:text-5xl font-bold text-white mb-4">Chuỗi phản ứng của cơ thể khi tiếp xúc MSG</h2>
                <p class="text-teal-200 text-lg max-w-2xl mx-auto">Điều gì thực sự diễn ra đằng sau những giờ phút con bỗng nhiên lăng xăng, cáu gắt và mất kiểm soát?</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 md:gap-12 relative">
                <!-- Steps with colored bars -->
                <div class="group anim d1">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl card-hover h-full flex flex-col">
                        <div class="bg-orange-500 py-6 px-8 flex justify-between items-center">
                            <span class="text-white/50 font-bold text-4xl">01</span>
                            <i class="fa-solid fa-bolt text-white text-3xl"></i>
                        </div>
                        <div class="p-8 flex-1">
                            <span class="inline-block px-3 py-1 bg-orange-100 text-orange-700 text-xs rounded-full font-bold mb-4 uppercase">30 Phút - 1 Giờ đầu</span>
                            <h4 class="font-heading text-xl font-bold text-teal-900 mb-4">Bùng nổ kích thích</h4>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">Glutamate ồ ạt tràn vào não. Các nơ-ron bị "ép" phát xung liên tục không ngừng nghỉ.</p>
                            <div class="bg-orange-50 rounded-2xl p-4 border border-orange-100">
                                <strong class="text-orange-800 text-xs block mb-1 uppercase tracking-wider">Hành vi quan sát:</strong>
                                <p class="text-slate-700 text-sm">Lăng xăng, chạy nhảy không ngừng, bứt rứt, nói nhảm, vô cớ cáu gắt.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group anim d2">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl card-hover h-full flex flex-col">
                        <div class="bg-red-500 py-6 px-8 flex justify-between items-center">
                            <span class="text-white/50 font-bold text-4xl">02</span>
                            <i class="fa-solid fa-fire text-white text-3xl"></i>
                        </div>
                        <div class="p-8 flex-1">
                            <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full font-bold mb-4 uppercase">1 Giờ - 2 Giờ tiếp</span>
                            <h4 class="font-heading text-xl font-bold text-teal-900 mb-4">Đốt cháy năng lượng</h4>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">Để đáp ứng trạng thái kích thích liên tục, Ty thể (nhà máy năng lượng) phải làm việc kiệt sức.</p>
                            <div class="bg-red-50 rounded-2xl p-4 border border-red-100">
                                <strong class="text-red-800 text-xs block mb-1 uppercase tracking-wider">Bên trong tế bào:</strong>
                                <p class="text-slate-700 text-sm">Năng lượng dự trữ (ATP) bị vắt kiệt và đốt sạch một cách nhanh chóng.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="group anim d3">
                    <div class="bg-white rounded-3xl overflow-hidden shadow-2xl card-hover h-full flex flex-col">
                        <div class="bg-slate-600 py-6 px-8 flex justify-between items-center">
                            <span class="text-white/50 font-bold text-4xl">03</span>
                            <i class="fa-solid fa-battery-empty text-white text-3xl"></i>
                        </div>
                        <div class="p-8 flex-1">
                            <span class="inline-block px-3 py-1 bg-slate-100 text-slate-700 text-xs rounded-full font-bold mb-4 uppercase">Sau 3 - 4 Giờ</span>
                            <h4 class="font-heading text-xl font-bold text-teal-900 mb-4">Suy nhược & Sập nguồn</h4>
                            <p class="text-slate-600 text-sm leading-relaxed mb-6">Hệ thần kinh rơi vào trạng thái thiếu hụt ATP, hệt như một chiếc xe "chạy khi cạn bình xăng".</p>
                            <div class="bg-slate-50 rounded-2xl p-4 border border-slate-200">
                                <strong class="text-slate-800 text-xs block mb-1 uppercase tracking-wider">Hệ quả sau đó:</strong>
                                <p class="text-slate-700 text-sm">Mệt mỏi, đờ đẫn, quấy khóc vô cớ hoặc trằn trọc mất ngủ.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ PHẨM MÀU CÔNG NGHIỆP ═══════════════════════ -->
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-16 items-center anim">
                <div class="lg:w-1/2 space-y-8">
                    <div>
                        <span class="inline-block bg-orange-600 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-4">Tác nhân hóa học</span>
                        <h2 class="font-heading text-3xl md:text-5xl font-bold text-teal-900 leading-tight">Phẩm màu công nghiệp và nhiễu loạn nhận thức</h2>
                        <p class="text-slate-600 text-lg leading-relaxed mt-4">Bên cạnh MSG, các loại phẩm màu nhân tạo và chất bảo quản trong bánh kẹo cũng là những tác nhân gây căng thẳng cho hệ thần kinh.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-6">
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-teal-50 card-hover">
                            <div class="w-12 h-12 bg-orange-500 text-white rounded-xl flex items-center justify-center text-xl mb-4 shadow-sm">
                                <i class="fa-solid fa-vial"></i>
                            </div>
                            <h4 class="font-heading font-bold text-teal-900 mb-2">Xáo trộn tín hiệu</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Ảnh hưởng trực tiếp đến hệ vi sinh đường ruột và làm suy giảm nồng độ Kẽm thiết yếu.</p>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-lg border border-teal-50 card-hover">
                            <div class="w-12 h-12 bg-teal-600 text-white rounded-xl flex items-center justify-center text-xl mb-4 shadow-sm">
                                <i class="fa-solid fa-eye-slash"></i>
                            </div>
                            <h4 class="font-heading font-bold text-teal-900 mb-2">Biểu hiện "say"</h4>
                            <p class="text-slate-500 text-sm leading-relaxed">Nhiễu loạn tín hiệu khiến trẻ mất tập trung, ánh mắt đờ đẫn do cơ thể gồng mình xử lý chất độc.</p>
                        </div>
                    </div>
                </div>

                <div class="lg:w-1/2 flex justify-center">
                    <div class="relative w-full max-w-sm grid grid-cols-2 gap-4">
                        <div class="aspect-square bg-red-500 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-xl transform -rotate-6 hover:rotate-0 transition-all cursor-crosshair">Red 40</div>
                        <div class="aspect-square bg-yellow-400 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-xl translate-y-8 transform rotate-6 hover:rotate-0 transition-all cursor-crosshair">Yellow 5</div>
                        <div class="aspect-square bg-blue-500 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-xl transform rotate-3 hover:rotate-0 transition-all cursor-crosshair">Blue 1</div>
                        <div class="aspect-square bg-slate-800 rounded-3xl flex items-center justify-center text-white font-bold text-xl shadow-xl translate-y-8 transform -rotate-3 hover:rotate-0 transition-all cursor-crosshair">Bảo quản</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ GIẢI PHÁP ═══════════════════════ -->
    <section id="giai-phap" class="py-16 md:py-24 bg-teal-50/50 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 anim">
                <span class="inline-block bg-teal-800 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-4">Lộ trình phục hồi</span>
                <h2 class="font-heading text-3xl md:text-5xl font-bold text-teal-900 mb-4">Giải pháp dinh dưỡng: Trở về với thực phẩm nguyên bản</h2>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto">Việc dùng thuốc kìm hãm chỉ là giải pháp tạm thời. Cần thiết lập lại môi trường dinh dưỡng nguyên bản để não bộ tự làm dịu.</p>
            </div>

            <div class="grid lg:grid-cols-3 gap-8 anim d1">
                <!-- Step 1 -->
                <div class="bg-white rounded-[40px] p-8 shadow-xl border border-teal-100 card-hover flex flex-col">
                    <div class="w-16 h-16 bg-teal-700 text-white rounded-2xl flex items-center justify-center font-bold text-2xl mb-8 shadow-md">1</div>
                    <h3 class="font-heading text-2xl font-bold text-teal-900 mb-4">Loại bỏ gia vị công nghiệp</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-1">Đọc nhãn mác thực phẩm và loại bỏ dần các sản phẩm chứa bột ngọt (MSG), chất điều vị, bột nêm công nghiệp.</p>
                    <div class="bg-teal-50 rounded-2xl p-5 border border-teal-100">
                        <span class="text-teal-800 font-bold text-sm block mb-2"><i class="fa-solid fa-swap text-teal-600 mr-2"></i>Thay thế bằng:</span>
                        <p class="text-slate-700 text-sm">Nước mắm cốt, muối biển, bột nấm rơm, bột tôm hay nước hầm xương tự nhiên.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-[40px] p-8 shadow-xl border border-teal-100 card-hover flex flex-col">
                    <div class="w-16 h-16 bg-teal-700 text-white rounded-2xl flex items-center justify-center font-bold text-2xl mb-8 shadow-md">2</div>
                    <h3 class="font-heading text-2xl font-bold text-teal-900 mb-4">Sử dụng màu thiên nhiên</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-1">Thay kẹo bánh công nghiệp bằng màu tự nhiên để cung cấp thêm chất chống oxy hóa bảo vệ tế bào não.</p>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 bg-green-50 text-green-700 px-4 py-2 rounded-xl border border-green-100 text-sm">
                            <i class="fa-solid fa-leaf"></i> Màu xanh từ lá nếp
                        </div>
                        <div class="flex items-center gap-3 bg-red-50 text-red-700 px-4 py-2 rounded-xl border border-red-100 text-sm">
                            <i class="fa-solid fa-carrot"></i> Màu đỏ từ gấc / củ dền
                        </div>
                        <div class="flex items-center gap-3 bg-purple-50 text-purple-700 px-4 py-2 rounded-xl border border-purple-100 text-sm">
                            <i class="fa-solid fa-flower"></i> Màu tím hoa đậu biếc
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-[40px] p-8 shadow-xl border border-teal-100 card-hover flex flex-col">
                    <div class="w-16 h-16 bg-orange-500 text-white rounded-2xl flex items-center justify-center font-bold text-2xl mb-8 shadow-md">3</div>
                    <h3 class="font-heading text-2xl font-bold text-teal-900 mb-4">Nguyên tắc "Chậm và Ít"</h3>
                    <p class="text-slate-600 leading-relaxed mb-8 flex-1">Thay đổi thói quen cần sự cẩn trọng y hệt như việc dùng thuốc. Chậm rãi để hệ thần kinh của trẻ thích nghi.</p>
                    <div class="bg-orange-50 rounded-2xl p-5 border border-orange-100">
                        <span class="text-orange-800 font-bold text-sm block mb-2"><i class="fa-solid fa-lightbulb text-orange-600 mr-2"></i>Quy tắc an toàn:</span>
                        <p class="text-slate-700 text-sm">Giảm dần tỷ lệ trộn. Pha trộn hương vị cũ và mới để vị giác trẻ kịp cảm nhận mà không hụt hẫng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ LƯU Ý & LỜI KẾT ═══════════════════════ -->
    <section class="py-16 md:py-24 bg-white px-6">
        <div class="max-w-7xl mx-auto grid md:grid-cols-2 gap-12 anim">
            <div class="bg-slate-50 p-8 md:p-12 rounded-[40px] border border-slate-100 shadow-sm">
                <h3 class="font-heading text-2xl md:text-3xl font-bold text-teal-800 mb-6 flex items-center gap-4">
                    <i class="fa-solid fa-clipboard-check text-orange-500"></i> Lưu ý quan trọng
                </h3>
                <p class="text-slate-700 text-lg leading-relaxed mb-6">Khoa học luôn cần sự quan sát khách quan. Việc loại bỏ bột ngọt, phẩm màu giúp giảm thiểu rõ rệt tình trạng tăng động, nhưng <strong>đây không phải là phương pháp trị liệu giải quyết mọi vấn đề</strong>.</p>
                <p class="text-slate-500 text-base leading-relaxed">Sự nhạy cảm ở mỗi trẻ là khác nhau. Có trẻ điềm tĩnh ngay sau vài ngày, có trẻ cần kết hợp chế độ GFCF. Duy trì thử nghiệm "chậm và ít", tự nấu ăn tại nhà và theo dõi phản ứng là hướng đi an toàn nhất.</p>
            </div>
            
            <div class="bg-teal-900 p-8 md:p-12 rounded-[40px] shadow-2xl relative overflow-hidden text-white">
                <div class="absolute -right-10 -bottom-10 opacity-10">
                    <i class="fa-solid fa-heart text-[200px]"></i>
                </div>
                <div class="relative z-10">
                    <h3 class="font-heading text-2xl md:text-3xl font-bold mb-6 flex items-center gap-4">
                        <i class="fa-solid fa-cloud-sun text-teal-300"></i> Trả lại sự tĩnh lặng
                    </h3>
                    <p class="text-teal-50 text-lg leading-relaxed mb-6">Sự bứt rứt của con nhiều khi không phải do bản tính, mà do cơ thể đang quá tải. Sự kiên nhẫn lựa chọn thực phẩm sạch là món quà tuyệt vời nhất cha mẹ dành cho con.</p>
                    <p class="text-teal-200 text-base leading-relaxed">Bằng cách giảm thiểu những "công tắc" kích thích, chúng ta đang trả lại cho não bộ con sự tĩnh lặng tự nhiên, tạo điều kiện thuận lợi nhất để con lắng nghe và học hỏi.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER CTA ═══════════════════════ -->
    <section id="lien-he" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-teal-950 py-16 md:py-24">
            <div class="absolute top-0 left-1/4 w-[500px] h-[500px] bg-teal-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="text-center mb-16 anim">
                    <h2 class="font-heading text-3xl md:text-5xl font-bold text-white mb-6">Cùng bạn hiểu con</h2>
                    <p class="text-slate-300 text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Hành trình y sinh không phải là một con đường dễ dàng và không một gia đình nào nên phải đi một mình. Nếu bạn cần hỗ trợ, hãy kết nối ngay với chúng tôi:
                    </p>
                </div>

                <!-- CTA Grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-16 anim d1">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-3xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-brands fa-facebook-f text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Facebook Group</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Cộng đồng Hiểu con</span>
                        </div>
                    </a>

                    <a href="https://zalo.me/g/vmgfxy834" target="_blank"
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-3xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-comments text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Zalo</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hỗ trợ 24/7</span>
                        </div>
                    </a>

                    <a href="tel:0988717107"
                       class="bg-white/10 hover:bg-teal-600 border border-white/10 hover:border-teal-600 text-white p-6 rounded-3xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(20,184,166,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-teal-100 transition-colors">Hotline / Zalo</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                       class="bg-white/10 hover:bg-orange-600 border border-white/10 hover:border-orange-600 text-white p-6 rounded-3xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(249,115,22,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-2xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-user-doctor text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-orange-100 transition-colors">Hỗ trợ chuyên môn</span>
                        </div>
                    </a>
                </div>

                <!-- Disclaimer -->
                <div class="bg-red-950/40 border border-red-900/40 p-6 md:p-8 rounded-[32px] anim d2 max-w-5xl mx-auto">
                    <h4 class="font-heading font-bold text-red-400 mb-2 uppercase text-sm flex items-center gap-2">
                        <i class="fa-solid fa-circle-info"></i> Tuyên bố miễn trừ trách nhiệm y khoa (Disclaimer)
                    </h4>
                    <p class="text-xs sm:text-sm text-slate-400 leading-relaxed">
                        Bài viết chỉ nhằm mục đích cung cấp thông tin khoa học và giáo dục cộng đồng, hoàn toàn không thay thế cho các chẩn đoán hay phác đồ điều trị y khoa chuyên nghiệp. Mọi quyết định thay đổi chế độ ăn hoặc sử dụng thực phẩm bổ sung cần được tham khảo ý kiến bác sĩ hoặc chuyên gia y tế, dựa trên tình trạng sức khỏe thực tế của từng trẻ.
                    </p>
                </div>
                
                <div class="text-center border-t border-white/10 mt-12 pt-8">
                    <p class="text-slate-500 text-sm">@2026 Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SCRIPTS ═══════════════════════ -->
    <script>
        // --- State Management for Interactive Visual ---
        const states = {
            balance: {
                color: '#10B981', // Sage
                icon: 'fa-brain',
                pulseClass: false,
                gabaOpacity: '1',
                gluBg: '#10B981',
                gluScale: 'scale(1)'
            },
            msg: {
                color: '#F97316', // Orange
                icon: 'fa-fire-flame-curved',
                pulseClass: true,
                gabaOpacity: '0.2',
                gluBg: '#EF4444',
                gluScale: 'scale(1.4)'
            }
        };

        function switchState(stateName) {
            // Buttons
            document.getElementById('btn-balance').className = stateName === 'balance' ? 'flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left tab-active' : 'flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left bg-white text-slate-500 hover:bg-gray-100';
            const msgBtn = document.getElementById('btn-msg');
            msgBtn.className = stateName === 'msg' ? 'flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left bg-orange-600 text-white shadow-xl' : 'flex items-center gap-4 px-6 py-4 rounded-xl font-bold transition-all text-left bg-white text-slate-500 hover:bg-gray-100';
            
            msgBtn.querySelector('div.bg-orange-100').className = stateName === 'msg' ? 'w-10 h-10 bg-white/20 text-white rounded-lg flex items-center justify-center shrink-0' : 'w-10 h-10 bg-orange-100 text-orange-500 rounded-lg flex items-center justify-center shrink-0';

            // Text
            document.getElementById('content-balance').classList.toggle('hidden', stateName !== 'balance');
            document.getElementById('content-msg').classList.toggle('hidden', stateName !== 'msg');

            // Visual
            const s = states[stateName];
            const visual = document.getElementById('brain-visual');
            const icon = document.getElementById('brain-icon');
            const gaba = document.getElementById('badge-gaba');
            const glu = document.getElementById('badge-glu');

            visual.style.borderColor = s.color;
            if (s.pulseClass) visual.classList.add('pulse-warning');
            else visual.classList.remove('pulse-warning');

            icon.className = `fa-solid ${s.icon} text-[120px] sm:text-[160px] transition-all duration-700`;
            icon.style.color = s.color;

            gaba.style.opacity = s.gabaOpacity;
            glu.style.backgroundColor = s.gluBg;
            glu.style.transform = s.gluScale;
        }

        // --- Scroll Animations ---
        document.addEventListener("DOMContentLoaded", function() {
            const io = new IntersectionObserver((entries) => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        e.target.style.animationPlayState = 'running';
                        io.unobserve(e.target);
                    }
                });
            }, { threshold: 0.1 });
            
            document.querySelectorAll('.anim').forEach(el => {
                el.style.animationPlayState = 'paused';
                io.observe(el);
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>
