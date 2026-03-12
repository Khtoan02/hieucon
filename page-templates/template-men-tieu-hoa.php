<?php
/**
 * Template Name: Trang Men Tiêu Hóa - Premium
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>8 loại Enzyme tiêu hóa thiết yếu | Hiểu con từ Gốc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; background-color: #f0f9ff; }

        .hero-gradient {
            background: linear-gradient(135deg, #0f766e 0%, #115e59 100%);
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
            box-shadow: 0 20px 40px -12px rgba(15, 118, 110, 0.2);
        }

        .gradient-warning-soft {
            background: linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%);
            border: 1px solid #fde68a;
        }

        /* Float animation for visual interest */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        .float-anim { animation: float 4s ease-in-out infinite; }

        .mask-image {
            mask-image: linear-gradient(to bottom, black 80%, transparent 100%);
        }
    </style>
</head>

<body class="antialiased overflow-x-hidden">

    <!-- ═══════════════════════ HERO SECTION ═══════════════════════ -->
    <header class="hero-gradient relative overflow-hidden">
        <!-- Floating shapes -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-white/10 -translate-y-1/3 translate-x-1/4 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-teal-400/20 translate-y-1/3 -translate-x-1/4 blur-3xl"></div>
        
        <div class="max-w-7xl mx-auto px-6 pt-24 pb-12 md:pt-32 relative z-10">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="text-left anim">
                    <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/20 text-white font-bold text-xs sm:text-sm mb-6 backdrop-blur-md border border-white/30 uppercase tracking-widest">
                        <i class="fa-solid fa-sparkles text-yellow-300"></i> HIỂU CON TỪ GỐC
                    </span>
                    <h1 class="font-['Quicksand'] text-4xl sm:text-5xl md:text-6xl font-extrabold text-white leading-tight mb-6">
                        BÍ QUYẾT PHỤC HỒI <br>
                        <span class="text-teal-200">8 LOẠI ENZYME THIẾT YẾU</span>
                    </h1>
                    <p class="text-lg sm:text-xl text-teal-50 max-w-xl mb-10 leading-relaxed font-medium">
                        Trao cho con "chìa khóa" chuyển hóa để khơi dậy nguồn năng lượng tự nhiên và sự bình tĩnh từ bên trong.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="#basics" class="bg-yellow-500 hover:bg-yellow-400 text-teal-950 px-8 py-4 rounded-full font-bold text-lg shadow-xl hover:-translate-y-1 transition-all flex items-center justify-center gap-2">
                            Bắt đầu ngay <i class="fa-solid fa-heart-pulse"></i>
                        </a>
                        <a href="#details" class="bg-white/10 hover:bg-white/20 text-white px-8 py-4 rounded-full font-bold text-lg border border-white/30 backdrop-blur-md transition-all flex items-center justify-center gap-2">
                            Khám phá enzyme <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="hidden lg:block relative anim d2">
                    <div class="relative z-10 float-anim">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/enzyme-hero.png" alt="Happy Child" class="rounded-[4rem] shadow-2xl border-4 border-white/20">
                    </div>
                    <!-- Decorative element behind image -->
                    <div class="absolute -bottom-10 -right-10 w-64 h-64 bg-teal-400/30 rounded-full blur-3xl -z-0"></div>
                </div>
            </div>
        </div>

        <!-- Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[60px] md:h-[100px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#f0f9ff"></path>
            </svg>
        </div>
    </header>

    <!-- ═══════════════════════ BASICS SECTION ═══════════════════════ -->
    <section id="basics" class="py-16 md:py-24 px-6 bg-[#f0f9ff]">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-16 items-center anim">
                <!-- Illustration Image -->
                <div class="relative order-2 lg:order-1">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/enzyme-sources.png" alt="Natural Enzyme Sources" class="rounded-[3rem] shadow-xl relative z-10 border-8 border-white">
                    <div class="absolute -top-6 -left-6 w-32 h-32 bg-teal-200 rounded-full -z-0"></div>
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-yellow-200 rounded-full -z-0"></div>
                </div>

                <!-- Text Content -->
                <div class="space-y-8 order-1 lg:order-2">
                    <div class="inline-block bg-teal-100 text-teal-700 px-4 py-1.5 rounded-full font-bold text-sm uppercase tracking-wide">
                        Hành trình của dưỡng chất
                    </div>
                    <h2 class="font-['Quicksand'] text-3xl md:text-5xl font-bold text-slate-900 leading-tight">
                        Cơ chế <br class="hidden sm:block">
                        <span class="text-teal-600">"Chia nhỏ để hấp thu"</span>
                    </h2>
                    <div class="text-slate-600 text-lg leading-relaxed space-y-6">
                        <p>Enzyme tiêu hóa không chỉ đơn thuần là chất xúc tác sinh học. Chúng đóng vai trò là những công cụ bảo tồn năng lượng cho cơ thể và là lớp màng bảo vệ hệ miễn dịch khỏi các tác nhân viêm từ thực phẩm chưa tiêu hóa hết.</p>
                        <div class="grid sm:grid-cols-2 gap-4 pt-4">
                            <div class="bg-white p-6 rounded-3xl border border-teal-100 shadow-sm card-hover">
                                <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center text-xl mb-4 shadow-emerald-200 shadow-lg">
                                    <i class="fa-solid fa-battery-bolt"></i>
                                </div>
                                <h4 class="font-['Quicksand'] font-bold text-slate-800 text-lg mb-2">Bảo tồn ATP</h4>
                                <p class="text-sm leading-relaxed">Giảm áp lực cho tuyến tụy, dạ dày và tối ưu năng lượng cho não.</p>
                            </div>
                            <div class="bg-white p-6 rounded-3xl border border-blue-100 shadow-sm card-hover">
                                <div class="w-12 h-12 bg-blue-500 text-white rounded-2xl flex items-center justify-center text-xl mb-4 shadow-blue-200 shadow-lg">
                                    <i class="fa-solid fa-shield-heart"></i>
                                </div>
                                <h4 class="font-['Quicksand'] font-bold text-slate-800 text-lg mb-2">Bảo vệ miễn dịch</h4>
                                <p class="text-sm leading-relaxed">Phân giải protein lạ, ngăn chặn các tác nhân viêm ngay tại lòng ruột.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Warning Box (Enhanced) -->
            <div class="mt-20 gradient-warning-soft rounded-[3rem] p-8 md:p-12 relative overflow-hidden shadow-lg anim d3">
                <div class="absolute -top-10 -right-10 w-48 h-48 bg-yellow-400/20 rounded-full blur-3xl"></div>
                <h3 class="font-['Quicksand'] text-2xl md:text-3xl font-bold text-amber-900 mb-10 text-center uppercase tracking-wide">
                    Tín hiệu từ cơ thể khi thiếu hụt Enzyme
                </h3>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="flex items-start gap-4 p-5 bg-white/60 rounded-2xl border border-amber-200 shadow-sm card-hover">
                        <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center text-2xl shrink-0 shadow-md">
                            <i class="fa-solid fa-hourglass-half"></i>
                        </div>
                        <div>
                            <p class="font-bold text-amber-900 mb-1">Gánh nặng tiêu hóa</p>
                            <p class="text-amber-800 text-sm">Thức ăn ủ men thối rữa ở nhiệt độ 37°C gây chướng bụng.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-5 bg-white/60 rounded-2xl border border-amber-200 shadow-sm card-hover">
                        <div class="w-14 h-14 bg-orange-500 text-white rounded-xl flex items-center justify-center text-2xl shrink-0 shadow-md">
                            <i class="fa-solid fa-cloud-bolt"></i>
                        </div>
                        <div>
                            <p class="font-bold text-amber-900 mb-1">Căng thẳng nội sinh</p>
                            <p class="text-amber-800 text-sm">Độc tố nội sinh ngấm vào máu tác động tiêu cực lên hệ thần kinh.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 p-5 bg-white/60 rounded-2xl border border-amber-200 shadow-sm card-hover">
                        <div class="w-14 h-14 bg-pink-500 text-white rounded-xl flex items-center justify-center text-2xl shrink-0 shadow-md">
                            <i class="fa-solid fa-face-frown-open"></i>
                        </div>
                        <div>
                            <p class="font-bold text-amber-900 mb-1">Bứt rứt & Quấy khóc</p>
                            <p class="text-amber-800 text-sm">Tế bào thiếu năng lượng khiến trẻ mệt mỏi và dễ cáu gắt.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ DEEP DIVE: 8 ENZYMES ═══════════════════════ -->
    <section id="details" class="py-16 md:py-24 px-6 bg-white rounded-t-[3rem] md:rounded-t-[5rem] -mt-10 relative z-20 shadow-[0_-20px_50px_-20px_rgba(0,0,0,0.05)]">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16 anim">
                <span class="inline-block bg-emerald-100 text-emerald-700 px-4 py-1.5 rounded-full font-bold text-xs uppercase tracking-widest mb-4">Kiến thức chuyên môn</span>
                <h2 class="font-['Quicksand'] text-3xl md:text-5xl font-bold text-slate-900 mb-4">Các "Cộng sự" Enzyme thiết yếu</h2>
                <p class="text-lg text-slate-500 max-w-2xl mx-auto italic">Từng loại enzyme mang một nhiệm vụ riêng, cùng nhau dệt nên sức khỏe trọn vẹn cho con.</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 anim d1">
                <!-- 1. Amylase -->
                <div class="group bg-blue-50/50 rounded-[2.5rem] p-8 border border-blue-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-blue-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-blue-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Amylase</h3>
                    <p class="text-blue-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Tiêu hóa Tinh bột</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Giúp chuyển hóa tinh bột thành đường đơn, cung cấp nhiên liệu năng lượng cho con.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-blue-100 text-xs font-semibold text-blue-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Hạt nảy mầm, Men ngũ cốc.
                    </div>
                </div>

                <!-- 2. Bromelain -->
                <div class="group bg-amber-50/50 rounded-[2.5rem] p-8 border border-amber-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-amber-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-amber-500 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-amber-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-dna"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Bromelain</h3>
                    <p class="text-amber-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Bẻ gãy Đạm & Giảm viêm</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Xử lý protein khó nhằn và làm dịu những vùng tổn thương nhỏ trong đường ruột.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-amber-100 text-xs font-semibold text-amber-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Quả dứa tươi (đặc biệt lõi).
                    </div>
                </div>

                <!-- 3. Cellulase -->
                <div class="group bg-emerald-50/50 rounded-[2.5rem] p-8 border border-emerald-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-emerald-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-emerald-500 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-emerald-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-leaf"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Cellulase</h3>
                    <p class="text-emerald-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Mở khóa Chất xơ</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Giúp con hấp thu trọn vẹn những dưỡng chất ẩn sâu trong lớp màng thực vật.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-emerald-100 text-xs font-semibold text-emerald-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Rau hữu cơ, trái cây tươi.
                    </div>
                </div>

                <!-- 4. Glucoamylase -->
                <div class="group bg-indigo-50/50 rounded-[2.5rem] p-8 border border-indigo-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-indigo-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-indigo-600 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-indigo-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-bolt-lightning"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Glucoamylase</h3>
                    <p class="text-indigo-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Năng lượng bền bỉ</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Duy trì nồng độ glucose ổn định, hỗ trợ tối ưu cho các hoạt động của não bộ.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-indigo-100 text-xs font-semibold text-indigo-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Thực phẩm lên men sạch.
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="group bg-orange-50/50 rounded-[2.5rem] p-8 border border-orange-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-orange-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-orange-500 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-orange-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-cubes-stacked"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Invertase</h3>
                    <p class="text-orange-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Chuyển hóa Đường</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Cân bằng các loại đường phức tạp, hạn chế tình trạng lên men kỵ khí gây bứt rứt.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-orange-100 text-xs font-semibold text-orange-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Mật ong nguyên chất.
                    </div>
                </div>

                <div class="group bg-rose-50/50 rounded-[2.5rem] p-8 border border-rose-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-rose-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-rose-500 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-rose-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-glass-water"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Lactase</h3>
                    <p class="text-rose-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Êm đẹp cùng Sữa</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Phân giải đường sữa, giúp con tránh được những khó chịu tiêu hóa không đáng có.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-rose-100 text-xs font-semibold text-rose-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Lợi khuẩn Bifido.
                    </div>
                </div>

                <div class="group bg-cyan-50/50 rounded-[2.5rem] p-8 border border-cyan-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-cyan-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-cyan-500 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-cyan-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Lipase</h3>
                    <p class="text-cyan-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Hấp thụ Chất béo</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Xử lý chất béo để nuôi dưỡng hệ thần kinh và hấp thu trọn vẹn Vitamin tan trong dầu.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-cyan-100 text-xs font-semibold text-cyan-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Quả bơ, Hạt hướng dương.
                    </div>
                </div>

                <div class="group bg-purple-50/50 rounded-[2.5rem] p-8 border border-purple-100 transition-all hover:bg-white hover:shadow-2xl hover:shadow-purple-200/50 card-hover flex flex-col h-full text-center">
                    <div class="w-20 h-20 bg-purple-600 text-white rounded-[2rem] flex items-center justify-center text-3xl mx-auto mb-6 shadow-xl shadow-purple-200 group-hover:scale-110 transition-transform">
                        <i class="fa-solid fa-scissors"></i>
                    </div>
                    <h3 class="font-['Quicksand'] font-bold text-2xl text-slate-900 mb-2">Protease</h3>
                    <p class="text-purple-600 font-extrabold text-[10px] tracking-widest uppercase mb-4">Bẻ gãy Đạm lạ</p>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6 flex-1">Phòng ngừa rò rỉ ruột và các phản ứng viêm do đạm chưa tiêu hóa hết gây ra.</p>
                    <div class="bg-white/80 p-4 rounded-2xl border border-purple-100 text-xs font-semibold text-purple-800">
                        <span class="block opacity-50 uppercase mb-1">Nguồn tự nhiên</span>
                        Đu đủ, Quả Kiwi.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ LƯU Ý SECTION ═══════════════════════ -->
    <section class="py-16 md:py-24 px-6 bg-[#f0f9ff]">
        <div class="max-w-7xl mx-auto">
            <div class="bg-gradient-to-br from-teal-600 to-teal-800 text-white rounded-[3rem] p-10 md:p-16 relative overflow-hidden shadow-2xl anim">
                <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white/10 rounded-full blur-3xl -mr-64 -mt-64"></div>
                
                <div class="grid lg:grid-cols-5 gap-12 items-center relative z-10">
                    <div class="lg:col-span-2">
                        <h2 class="font-['Quicksand'] text-3xl md:text-5xl font-bold mb-8 leading-tight">Yêu con qua <br> <span class="text-teal-200">sự hiểu biết đúng đắn</span></h2>
                        <ul class="space-y-6">
                            <li class="flex gap-4 p-5 bg-white/10 rounded-2xl border border-white/20 card-hover">
                                <div class="w-12 h-12 bg-teal-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg">
                                    <i class="fa-solid fa-feather"></i>
                                </div>
                                <p class="text-teal-50 text-sm">Bắt đầu với <strong>1/4 liều lượng</strong> để hệ tiêu hóa của con thích nghi thật nhẹ nhàng.</p>
                            </li>
                            <li class="flex gap-4 p-5 bg-white/10 rounded-2xl border border-white/20 card-hover">
                                <div class="w-12 h-12 bg-teal-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg">
                                    <i class="fa-solid fa-pen-fancy"></i>
                                </div>
                                <p class="text-teal-50 text-sm">Ghi nhật ký thay đổi về <strong>hành vi & phân</strong> để theo dõi sát sao lộ trình phục hồi.</p>
                            </li>
                            <li class="flex gap-4 p-5 bg-white/10 rounded-2xl border border-white/20 card-hover">
                                <div class="w-12 h-12 bg-teal-500 text-white rounded-xl flex items-center justify-center text-xl shrink-0 shadow-lg">
                                    <i class="fa-solid fa-plate-wheat"></i>
                                </div>
                                <p class="text-teal-50 text-sm">Ưu tiên <strong>thực phẩm tươi</strong> chứa enzyme tự nhiên trước khi dùng thực phẩm bổ sung.</p>
                            </li>
                        </ul>
                    </div>

                    <div class="lg:col-span-3">
                        <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/healing-support.png" alt="Healing Support" class="rounded-[3rem] shadow-2xl border-4 border-white/20 transform hover:scale-[1.02] transition-transform">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ CONTACT SECTION ═══════════════════════ -->
    <section id="contact" class="py-16 md:py-24 px-6 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto relative z-10 text-center">
            <h2 class="font-['Quicksand'] text-3xl md:text-5xl font-bold text-teal-900 mb-6 uppercase tracking-wider">Cùng bạn đồng hành</h2>
            <p class="text-slate-600 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed mb-16">
                Mỗi hành trình đều bắt đầu từ một niềm tin. Đừng ngần ngại kết nối để chúng tôi có thể sẻ chia và đồng hành cùng gia đình bạn.
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-16 anim d1">
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="bg-teal-50 hover:bg-blue-600 hover:text-white p-8 rounded-[2rem] border border-blue-100 transition-all duration-300 group card-hover text-center flex flex-col items-center">
                    <div class="w-16 h-16 bg-white group-hover:bg-white/20 text-blue-600 group-hover:text-white rounded-[1.5rem] flex items-center justify-center mb-5 transition-all text-2xl shadow-sm">
                        <i class="fa-brands fa-facebook-f"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-1">Cộng đồng FB</h4>
                    <span class="text-sm opacity-60">Hiểu con từ Gốc</span>
                </a>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="bg-teal-50 hover:bg-teal-600 hover:text-white p-8 rounded-[2rem] border border-teal-100 transition-all duration-300 group card-hover text-center flex flex-col items-center">
                    <div class="w-16 h-16 bg-white group-hover:bg-white/20 text-teal-600 group-hover:text-white rounded-[1.5rem] flex items-center justify-center mb-5 transition-all text-2xl shadow-sm">
                        <i class="fa-solid fa-user-doctor"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-1">Trợ lý Nam Khánh</h4>
                    <span class="text-sm opacity-60">Hỗ trợ Chuyên môn</span>
                </a>

                <a href="tel:0988717107" class="bg-teal-50 hover:bg-indigo-600 hover:text-white p-8 rounded-[2rem] border border-indigo-100 transition-all duration-300 group card-hover text-center flex flex-col items-center">
                    <div class="w-16 h-16 bg-white group-hover:bg-white/20 text-indigo-600 group-hover:text-white rounded-[1.5rem] flex items-center justify-center mb-5 transition-all text-2xl shadow-sm">
                        <i class="fa-solid fa-phone"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-1">0988.717.107</h4>
                    <span class="text-sm opacity-60">Hotline / Zalo hỗ trợ</span>
                </a>

                <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="bg-teal-50 hover:bg-sky-500 hover:text-white p-8 rounded-[2rem] border border-sky-100 transition-all duration-300 group card-hover text-center flex flex-col items-center">
                    <div class="w-16 h-16 bg-white group-hover:bg-white/20 text-sky-500 group-hover:text-white rounded-[1.5rem] flex items-center justify-center mb-5 transition-all text-2xl shadow-sm">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <h4 class="font-bold text-lg mb-1">Nhóm Zalo</h4>
                    <span class="text-sm opacity-60">Hỏi đáp trực tiếp</span>
                </a>
            </div>

            <!-- Disclaimer -->
            <div class="bg-teal-50 border border-teal-200/50 p-6 md:p-8 rounded-[2.5rem] anim d2 max-w-4xl mx-auto italic text-xs text-slate-500 leading-relaxed uppercase font-medium">
                <i class="fa-solid fa-circle-info mr-2"></i> Lời nhắn gửi: Tài liệu này nhằm nâng cao nhận thức cộng đồng và không thay thế chẩn đoán y khoa chuyên sâu. Hãy luôn lắng nghe con và tham vấn chuyên gia.
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-[#f0f9ff] text-center text-slate-400 text-sm">
        <p>@2026 Toàn quyền bản quyền thuộc về Cộng đồng Hiểu con từ Gốc</p>
    </footer>

    <script>
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