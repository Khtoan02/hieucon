<?php /* Template Name: Giai_Ma_Giac_Ngu_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải Mã Giấc Ngủ Của Trẻ Tự Kỷ | Hành trình tìm lại bình yên</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            dark: '#1e1b4b', // Deep indigo
                            primary: '#4338ca', // Indigo
                            light: '#818cf8',
                            accent: '#f59e0b', // Amber/Gold
                            soft: '#f8fafc' // Slate 50
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { scroll-behavior: smooth; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="font-sans text-gray-800 bg-brand-soft antialiased">

    <!-- Hero Section -->
    <section class="relative bg-brand-dark overflow-hidden min-h-[90vh] flex items-center">
        <!-- Background decorations -->
        <div class="absolute inset-0 z-0">
            <div class="absolute top-20 left-10 w-72 h-72 bg-brand-primary rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
            <div class="absolute bottom-20 right-10 w-96 h-96 bg-purple-900 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
            <!-- Stars -->
            <div class="absolute top-1/4 left-1/4 text-white opacity-20 text-xs"><i class="fas fa-star"></i></div>
            <div class="absolute top-1/3 right-1/3 text-white opacity-40 text-sm"><i class="fas fa-star"></i></div>
            <div class="absolute bottom-1/4 right-1/4 text-white opacity-30 text-xs"><i class="fas fa-star"></i></div>
        </div>

        <div class="container mx-auto px-6 relative z-10 py-20">
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="lg:w-1/2 text-center lg:text-left">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 text-brand-accent text-sm font-semibold mb-6 border border-white/20 backdrop-blur-sm">
                        <i class="fas fa-moon"></i> Dựa trên nghiên cứu Y khoa từ Viện Nghiên cứu Tự kỷ (ARI)
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-6">
                        Giải Mã Bí Ẩn <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-accent to-yellow-300">Giấc Ngủ Trẻ Tự Kỷ</span>
                    </h1>
                    <p class="text-lg md:text-xl text-blue-100 mb-8 max-w-2xl mx-auto lg:mx-0 leading-relaxed">
                        Khi mất ngủ không chỉ là "chuyện thói quen" hay "sự bướng bỉnh". Khám phá sự thật từ khoa học não bộ để giúp thiên thần nhỏ tìm lại những đêm bình yên.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="#kham-pha" class="px-8 py-4 bg-brand-accent hover:bg-yellow-500 text-brand-dark font-bold rounded-full transition-all shadow-[0_0_20px_rgba(245,158,11,0.4)] transform hover:-translate-y-1 text-center">
                            Khám Phá Ngay
                        </a>
                        <a href="#chia-se" class="px-8 py-4 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full border border-white/30 transition-all text-center">
                            Cần Hỗ Trợ
                        </a>
                    </div>
                </div>
                <div class="lg:w-1/2 flex justify-center animate-float">
                    <!-- Conceptual Illustration using SVG -->
                    <svg viewBox="0 0 500 500" class="w-full max-w-md drop-shadow-2xl">
                        <defs>
                            <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" style="stop-color:#818cf8;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#4338ca;stop-opacity:1" />
                            </linearGradient>
                        </defs>
                        <circle cx="250" cy="250" r="200" fill="url(#grad1)" opacity="0.2"/>
                        <circle cx="250" cy="250" r="150" fill="url(#grad1)" opacity="0.4"/>
                        <path d="M250,120 Q350,120 350,220 Q350,320 250,320 Q150,320 150,220 Q150,120 250,120 Z" fill="#ffffff" opacity="0.1"/>
                        <g transform="translate(150, 150)">
                            <!-- Brain Icon -->
                            <path d="M100,20 C130,20 160,40 160,80 C160,95 150,110 135,120 C150,135 155,160 140,180 C120,200 80,200 60,180 C45,160 50,135 65,120 C50,110 40,95 40,80 C40,40 70,20 100,20 Z" fill="none" stroke="#f59e0b" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
                            <path d="M100,20 L100,185" fill="none" stroke="#f59e0b" stroke-width="4" stroke-dasharray="8,8"/>
                            <!-- Zzz -->
                            <text x="140" y="40" font-family="Arial" font-size="30" fill="#ffffff" font-weight="bold">Z</text>
                            <text x="165" y="20" font-family="Arial" font-size="20" fill="#ffffff" font-weight="bold">z</text>
                            <text x="180" y="5" font-family="Arial" font-size="14" fill="#ffffff" font-weight="bold">z</text>
                        </g>
                    </svg>
                </div>
            </div>
        </div>
        <!-- Wave transition -->
        <div class="absolute bottom-0 w-full overflow-hidden leading-none">
            <svg class="relative block w-full h-[50px] md:h-[100px]" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118,130.85,130.2,201.5,123.1,242.4,118.9,282.8,107.1,321.39,56.44Z" fill="#f8fafc"></path>
            </svg>
        </div>
    </section>

    <!-- Intro / Empathy Section -->
    <section id="kham-pha" class="py-16 md:py-24 bg-brand-soft px-6">
        <div class="max-w-4xl mx-auto text-center">
            <i class="fas fa-quote-left text-4xl text-brand-light mb-6 opacity-50"></i>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-6 leading-relaxed">
                "Trên hành trình đồng hành cùng con, những đêm thức trắng vắt kiệt sức lực không phải là điều ba mẹ <span class="text-brand-primary underline decoration-brand-accent decoration-4 underline-offset-4">phải cắn răng chịu đựng</span>."
            </h2>
            <p class="text-lg text-gray-600 mb-8">
                Đôi khi, chúng ta lầm tưởng rằng con không chịu ngủ là do bướng bỉnh hay thói quen chưa tốt. Nhưng dưới góc nhìn của y học thần kinh, những khó khăn của con có nguyên nhân sâu xa từ thể chất.
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-brand-primary to-brand-accent mx-auto rounded-full"></div>
        </div>
    </section>

    <!-- Section 1: Não bộ và Giấc ngủ REM (Infographic style) -->
    <section class="py-16 bg-white px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-brand-primary font-bold tracking-wider uppercase text-sm">Sự Thật Bị Bỏ Quên</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-brand-dark mt-2">Khi Não Bộ Thiếu Thời Gian "Dọn Dẹp"</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-12 items-center">
                <!-- Text Content -->
                <div class="space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center flex-shrink-0 text-xl">
                            <i class="fas fa-brain"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Giấc ngủ mơ (REM) là gì?</h3>
                            <p class="text-gray-600">Với người bình thường, giai đoạn này não bộ hoạt động hết công suất để xử lý, sắp xếp lại cảm xúc, ký ức xã hội trong ngày. Giúp chúng ta thức dậy cân bằng.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 text-red-600 flex items-center justify-center flex-shrink-0 text-xl">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Trẻ tự kỷ bị thiếu hụt REM trầm trọng</h3>
                            <p class="text-gray-600">Nghiên cứu chỉ ra trẻ tự kỷ thiếu hụt nghiêm trọng giai đoạn này. Não bộ không kịp "tiêu hóa" cảm xúc phức tạp.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4">
                        <div class="w-12 h-12 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center flex-shrink-0 text-xl">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Hệ quả biểu hiện ra bên ngoài</h3>
                            <p class="text-gray-600">Trẻ thức dậy trong trạng thái bứt rứt, quá tải, cáu gắt, khó kiểm soát tâm trạng và bám víu vào các <strong>hành vi lặp đi lặp lại</strong> để tự xoa dịu.</p>
                        </div>
                    </div>
                </div>

                <!-- Visual Infographic -->
                <div class="bg-brand-soft rounded-3xl p-8 border border-gray-100 shadow-xl relative">
                    <h4 class="text-center font-bold text-gray-700 mb-6">Biểu Đồ Chu Kỳ Giấc Ngủ (Minh họa)</h4>
                    
                    <!-- Normal Brain -->
                    <div class="mb-8">
                        <div class="flex justify-between text-sm mb-2 font-semibold">
                            <span class="text-green-600">Não bộ điển hình</span>
                            <span class="text-gray-500">Đủ chu kỳ REM</span>
                        </div>
                        <div class="h-8 bg-gray-200 rounded-full flex overflow-hidden">
                            <div class="w-[60%] bg-blue-400 h-full flex items-center justify-center text-xs text-white font-bold">Ngủ sâu</div>
                            <div class="w-[40%] bg-green-500 h-full flex items-center justify-center text-xs text-white font-bold">Ngủ REM (Mơ)</div>
                        </div>
                    </div>

                    <!-- Autism Brain -->
                    <div>
                        <div class="flex justify-between text-sm mb-2 font-semibold">
                            <span class="text-brand-primary">Não bộ trẻ tự kỷ</span>
                            <span class="text-red-500">Thiếu hụt REM</span>
                        </div>
                        <div class="h-8 bg-gray-200 rounded-full flex overflow-hidden">
                            <div class="w-[85%] bg-blue-400 h-full flex items-center justify-center text-xs text-white font-bold">Ngủ sâu / Chập chờn</div>
                            <div class="w-[15%] bg-red-400 h-full flex items-center justify-center text-xs text-white font-bold">REM</div>
                        </div>
                    </div>
                    
                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg animate-bounce">
                        <div class="text-center leading-tight">
                            <span class="block text-2xl">🚨</span>
                            <span class="text-[10px] font-bold text-red-600 uppercase">Cảnh báo</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Gốc rễ Sinh hóa -->
    <section class="py-16 bg-gradient-to-br from-indigo-50 to-blue-100 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-brand-primary font-bold tracking-wider uppercase text-sm">Bản chất Sinh Hóa</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-brand-dark mt-2">Chiếc Đồng Hồ Sinh Học Lệch Nhịp</h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Tại sao hệ thần kinh của các con lại khó chìm vào giấc ngủ đến vậy? Bí mật nằm ở các "người đưa tin" hóa học trong não.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Melatonin Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-t-4 border-indigo-500 hover:shadow-2xl transition-shadow relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 opacity-5 text-9xl text-indigo-500"><i class="fas fa-clock"></i></div>
                    <div class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-inner">
                        <i class="fas fa-moon"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Thiếu hụt Melatonin</h3>
                    <p class="text-indigo-600 font-semibold mb-4">"Chiếc chuông báo ngủ bị hỏng"</p>
                    <p class="text-gray-600 leading-relaxed">
                        Melatonin là hormone nhắc nhở cơ thể "đến giờ ngủ rồi". Ở trẻ tự kỷ, chiếc chuông này thường <strong>gõ sai nhịp</strong>, hoặc lượng hormone tiết ra <strong>quá ít</strong>, khiến cơ thể con không nhận được tín hiệu buồn ngủ tự nhiên.
                    </p>
                </div>

                <!-- GABA Card -->
                <div class="bg-white rounded-2xl p-8 shadow-lg border-t-4 border-teal-500 hover:shadow-2xl transition-shadow relative overflow-hidden">
                    <div class="absolute -right-10 -top-10 opacity-5 text-9xl text-teal-500"><i class="fas fa-shield-alt"></i></div>
                    <div class="w-16 h-16 bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-inner">
                        <i class="fas fa-hand-paper"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-3">Thiếu hụt GABA</h3>
                    <p class="text-teal-600 font-semibold mb-4">"Mất đi chiếc phanh làm dịu"</p>
                    <p class="text-gray-600 leading-relaxed">
                        GABA là chất tự nhiên giúp ức chế căng thẳng, làm dịu thần kinh. Khi thiếu đi "cái phanh" này, não bộ của con <strong>luôn căng như dây đàn</strong>, việc thư giãn và đi vào giấc ngủ trở nên vô cùng khó khăn.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Những kẻ cắp giấc ngủ (Grid) -->
    <section class="py-20 bg-white px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <span class="text-red-500 font-bold tracking-wider uppercase text-sm">Cảnh Giác Y Khoa</span>
                <h2 class="text-3xl md:text-4xl font-extrabold text-brand-dark mt-2">4 "Kẻ Cắp" Giấc Ngủ Giấu Mặt Từ Cơ Thể</h2>
                <p class="mt-4 text-gray-600 max-w-2xl mx-auto">Giáo sư Williams nhấn mạnh: Tuyệt đối không được bỏ qua những căn bệnh tiềm ẩn phá bĩnh giấc ngủ của con.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Item 1 -->
                <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-red-200 hover:bg-red-50 transition-colors group">
                    <div class="w-14 h-14 bg-white rounded-full shadow-sm flex items-center justify-center text-2xl text-red-500 mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Bứt rứt chân tay</h3>
                    <p class="text-sm text-gray-600">Trẻ bồn chồn, phải cử động chân liên tục. Thủ phạm cực kỳ đơn giản: <strong>Thiếu Sắt</strong>. Bổ sung đủ Sắt có thể giải quyết dứt điểm.</p>
                </div>

                <!-- Item 2 -->
                <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-blue-200 hover:bg-blue-50 transition-colors group">
                    <div class="w-14 h-14 bg-white rounded-full shadow-sm flex items-center justify-center text-2xl text-blue-500 mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-lungs"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Khó thở, ngáy to</h3>
                    <p class="text-sm text-gray-600">Amidan/VA sưng to làm nghẽn đường thở, gây thiếu oxy não. Trẻ lờ đờ ngày hôm sau, dễ bị chẩn đoán nhầm thành <strong>Tăng động (ADHD)</strong>.</p>
                </div>

                <!-- Item 3 -->
                <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-orange-200 hover:bg-orange-50 transition-colors group">
                    <div class="w-14 h-14 bg-white rounded-full shadow-sm flex items-center justify-center text-2xl text-orange-500 mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-fire-alt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Chiếc bụng "ấm ách"</h3>
                    <p class="text-sm text-gray-600">Trào ngược dạ dày (gây nóng rát khi nằm) hoặc táo bón kéo dài làm con bứt rứt, gào khóc giữa đêm vì quá đau đớn khó chịu.</p>
                </div>

                <!-- Item 4 -->
                <div class="p-6 rounded-2xl bg-gray-50 border border-gray-100 hover:border-purple-200 hover:bg-purple-50 transition-colors group">
                    <div class="w-14 h-14 bg-white rounded-full shadow-sm flex items-center justify-center text-2xl text-purple-500 mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2">Co giật ngầm</h3>
                    <p class="text-sm text-gray-600">Sóng điện não bất thường (động kinh vắng ý thức) xảy ra <strong>ngay trong lúc ngủ</strong>, phá vỡ cấu trúc giấc ngủ mà mắt thường khó nhận ra.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Giải Pháp & Dinh Dưỡng Dẫn Truyền -->
    <section class="py-20 bg-brand-dark text-white px-6 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-primary rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-900 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
        
        <div class="max-w-5xl mx-auto relative z-10">
            <div class="text-center mb-16">
                <span class="text-brand-accent font-bold tracking-wider uppercase text-sm">Lộ trình hỗ trợ</span>
                <h2 class="text-3xl md:text-4xl font-extrabold mt-2">5 Bước "Dọn Đường" Cho Giấc Ngủ Bình An</h2>
                <p class="mt-4 text-blue-200 max-w-2xl mx-auto">Kết hợp giữa y khoa, dinh dưỡng thiết yếu và thiết lập hành vi trực quan.</p>
            </div>

            <div class="space-y-8">
                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-6 bg-white/5 p-6 rounded-3xl border border-white/10 backdrop-blur-sm">
                    <div class="w-16 h-16 rounded-full bg-brand-accent text-brand-dark font-bold text-2xl flex items-center justify-center flex-shrink-0">1</div>
                    <div>
                        <h3 class="text-xl font-bold text-yellow-300 mb-2">Kiểm tra sức khỏe tổng quát</h3>
                        <p class="text-gray-300">Khám Tai-Mũi-Họng (Amidan/VA), đo điện não (tầm soát động kinh), xét nghiệm máu (đặc biệt là lượng Sắt dự trữ Ferritin, B12..), giải quyết triệt để bệnh tiêu hóa (táo bón, trào ngược). Cơ thể hết đau đớn, con mới có thể thư giãn.</p>
                    </div>
                </div>

                <!-- Step 2: NUTRITION FOCUS (As requested) -->
                <div class="flex flex-col md:flex-row gap-6 bg-gradient-to-r from-brand-primary/40 to-purple-900/40 p-6 md:p-8 rounded-3xl border border-brand-accent/50 shadow-[0_0_30px_rgba(67,56,202,0.5)]">
                    <div class="w-16 h-16 rounded-full bg-brand-accent text-brand-dark font-bold text-2xl flex items-center justify-center flex-shrink-0">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <div class="w-full">
                        <h3 class="text-2xl font-bold text-yellow-300 mb-2 flex items-center gap-2">
                            Dinh dưỡng & Vi chất vàng hỗ trợ não bộ 
                            <span class="bg-yellow-500 text-brand-dark text-xs px-2 py-1 rounded-full uppercase font-bold animate-pulse">Quan Trọng</span>
                        </h3>
                        <p class="text-gray-200 mb-6">Cung cấp nguyên liệu để não bộ tự sản xuất các "chất dẫn truyền thần kinh" giúp ngủ ngon:</p>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nutrient Items -->
                            <div class="bg-white/10 p-4 rounded-xl border border-white/5">
                                <h4 class="text-green-300 font-bold mb-1"><i class="fas fa-leaf mr-2"></i>GABA & L-theanine</h4>
                                <p class="text-sm text-gray-300">Hỗ trợ trực tiếp thư giãn thần kinh, "đạp phanh" giảm căng thẳng để não chuyển sang trạng thái nghỉ.</p>
                            </div>
                            <div class="bg-white/10 p-4 rounded-xl border border-white/5">
                                <h4 class="text-blue-300 font-bold mb-1"><i class="fas fa-gem mr-2"></i>Magie (Glycinate/Threonate)</h4>
                                <p class="text-sm text-gray-300">"Khoáng chất thư giãn", giúp giảm căng cơ, bồn chồn và làm dịu hệ thần kinh trung ương.</p>
                            </div>
                            <div class="bg-white/10 p-4 rounded-xl border border-white/5">
                                <h4 class="text-orange-300 font-bold mb-1"><i class="fas fa-capsules mr-2"></i>Vitamin D, nhóm B (B6 & B12..)</h4>
                                <p class="text-sm text-gray-300">Đóng vai trò sống còn để cơ thể tổng hợp Serotonin thành Melatonin (chuông báo ngủ tự nhiên).</p>
                            </div>
                            <div class="bg-white/10 p-4 rounded-xl border border-white/5">
                                <h4 class="text-cyan-300 font-bold mb-1"><i class="fas fa-fish mr-2"></i>Omega 3 & Kẽm</h4>
                                <p class="text-sm text-gray-300">Omega 3 bảo vệ tế bào thần kinh, Kẽm cân bằng dẫn truyền. Hỗ trợ hệ miễn dịch và chất lượng giấc ngủ.</p>
                            </div>
                        </div>
                        <p class="text-xs text-brand-accent mt-4 italic">* Lưu ý: Việc bổ sung Melaton vi chất cần tham khảo ý kiến bác sĩ/chuyên gia dinh dưỡng để cá nhân hóa liều lượng.</p>
                    </div>
                </div>

                <!-- Step 3, 4, 5 -->
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="bg-white/5 p-6 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <h3 class="text-lg font-bold text-yellow-300 mb-2">3. Bổ sung Melatonin</h3>
                        <p class="text-sm text-gray-300">An toàn & hiệu quả. Bắt đầu từ liều thấp. Nếu con hay tỉnh giấc giữa đêm, dùng loại giải phóng chậm (Tham khảo BS).</p>
                    </div>
                    <div class="bg-white/5 p-6 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <h3 class="text-lg font-bold text-yellow-300 mb-2">4. "Cai" Ánh sáng xanh</h3>
                        <p class="text-sm text-gray-300">Vận động ngoài trời ban ngày. <strong>Cắt Tivi/Điện thoại</strong> trước giờ ngủ để não không bị kích thích và đòi xem tiếp giữa đêm.</p>
                    </div>
                    <div class="bg-white/5 p-6 rounded-3xl border border-white/10 backdrop-blur-sm">
                        <h3 class="text-lg font-bold text-yellow-300 mb-2">5. Lịch trình hình ảnh</h3>
                        <p class="text-sm text-gray-300">Trẻ tự kỷ cần sự nhất quán. Thiết lập trình tự đi ngủ (đánh răng, đọc sách) bằng thẻ hình ảnh lặp lại mỗi tối.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Community / CTA Section -->
    <section id="chia-se" class="py-20 bg-brand-soft px-6">
        <div class="max-w-4xl mx-auto bg-white rounded-[2rem] shadow-2xl overflow-hidden">
            <div class="md:flex">
                <div class="md:w-5/12 bg-gradient-to-br from-orange-400 to-red-400 p-10 text-white flex flex-col justify-center">
                    <i class="fas fa-heart text-5xl mb-6 opacity-80"></i>
                    <h2 class="text-3xl font-bold mb-4">Đồng Hành Cùng Ba Mẹ</h2>
                    <p class="text-white/90 leading-relaxed">
                        Bạn không đơn độc trên hành trình này. Helen Hoai luôn sẵn sàng lắng nghe, phân tích và đồng hành tháo gỡ khó khăn cùng gia đình bạn!
                    </p>
                </div>
                <div class="md:w-7/12 p-10">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">"Kẻ cắp" nào đang làm phiền bé nhà bạn?</h3>
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-brand-primary mt-1"></i>
                            <span class="text-gray-600">Trằn trọc hàng giờ không ngủ được?</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-brand-primary mt-1"></i>
                            <span class="text-gray-600">Tỉnh giấc giữa đêm, gào khóc, khó dỗ lại?</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <i class="fas fa-check-circle text-brand-primary mt-1"></i>
                            <span class="text-gray-600">Bứt rứt chân, ngáy to, hay bị đầy bụng?</span>
                        </li>
                    </ul>
                    <p class="text-sm text-gray-600 mb-6 italic font-medium">Mỗi em bé là một cá thể riêng biệt với gốc rễ vấn đề khác nhau. Hãy nhắn tin trực tiếp cho Helen Hoai để nhận được những phân tích chuyên sâu và lộ trình hỗ trợ phù hợp nhất cho con bạn.</p>
                    <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" rel="noopener noreferrer" class="flex items-center justify-center gap-2 w-full py-4 bg-[#1877F2] hover:bg-[#166FE5] text-white font-bold rounded-xl transition-all shadow-[0_4px_15px_rgba(24,119,242,0.4)] transform hover:-translate-y-1">
                        <i class="fab fa-facebook-f text-xl"></i>
                        Liên Hệ Helen Hoai để được hỗ trợ !  
                    </a>
                </div>
            </div>
        </div>
        
        <!-- References -->
        <div class="max-w-4xl mx-auto mt-12 text-center text-xs text-gray-400">
            <p class="font-bold mb-2">Tài liệu tham khảo Y khoa:</p>
            <p>Báo cáo "Sleep Issues and Autism Spectrum Disorders" - GS.BS Gail Williams (Viện Nghiên cứu Tự kỷ ARI - Mỹ)</p>
        </div>
    </section>
<?php get_footer(); ?>