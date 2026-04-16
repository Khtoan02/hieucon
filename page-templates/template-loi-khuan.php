<?php
/**
 * Template Name: Trang Lợi Khuẩn & Tự Kỷ
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Con uống lợi khuẩn lại quấy hơn? | Giải mã "Die-off"</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            900: '#134e4a',
                        },
                        accent: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                        }
                    },
                    boxShadow: {
                        'soft': '0 10px 40px -10px rgba(0,0,0,0.08)',
                        'glow': '0 0 20px rgba(13, 148, 136, 0.3)',
                    }
                }
            }
        }
    </script>
    <style>
        body { scroll-behavior: smooth; }
        .gradient-text {
            background: linear-gradient(135deg, #0d9488, #0284c7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #f0fdfa 0%, #e0f2fe 100%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .infographic-card {
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .infographic-card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: 0 15px 30px -10px rgba(0,0,0,0.1);
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-up {
            animation: fadeUp 0.8s ease-out forwards;
            opacity: 0;
        }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        
        .blob {
            position: absolute;
            filter: blur(40px);
            z-index: 0;
            opacity: 0.4;
            border-radius: 50%;
        }
        .blob-1 { top: -10%; left: -10%; width: 400px; height: 400px; background: #ccfbf1; }
        .blob-2 { bottom: -10%; right: -10%; width: 300px; height: 300px; background: #bae6fd; }
    </style>
    <?php wp_head(); ?>
</head>

<body class="font-sans text-gray-800 bg-gray-50 flex flex-col min-h-screen antialiased">

    <!-- Hero Section -->
    <header class="gradient-bg relative overflow-hidden">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-24 relative z-10 text-center">
            <div class="animate-fade-up">
                <span class="inline-flex items-center gap-2 py-1.5 px-4 rounded-full bg-white text-brand-700 font-semibold text-sm mb-6 shadow-sm border border-brand-100">
                    <span class="w-2 h-2 rounded-full bg-brand-500"></span>
                    Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân
                </span>
                
                <h1 class="font-heading text-4xl md:text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight mb-6">
                    Dùng lợi khuẩn sao con lại <br class="hidden md:block"/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-red-500 to-rose-600 drop-shadow-sm">quấy khóc & hành vi hơn?</span>
                </h1>
                
                <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-10 leading-relaxed font-medium">
                    Ba mẹ khoan vội hoang mang! Quấy khóc, đi ngoài, bứt rứt có thể không phải do lợi khuẩn gây hại, mà là dấu hiệu của <strong class="text-brand-700 px-1 bg-brand-50 rounded">Phản ứng "Die-off"</strong> - một cột mốc quan trọng trong hành trình chữa lành.
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#kham-pha" class="bg-gradient-to-r from-brand-600 to-brand-500 text-white px-8 py-3.5 rounded-full font-semibold hover:from-brand-700 hover:to-brand-600 transition-all shadow-glow hover:shadow-lg flex items-center justify-center gap-2 transform hover:-translate-y-1">
                        Khám phá sự thật <i class="fas fa-arrow-down ml-1 animate-bounce"></i>
                    </a>
                    <a href="#lien-he" class="glass-card text-brand-700 px-8 py-3.5 rounded-full font-semibold hover:bg-white transition-all shadow-sm flex items-center justify-center gap-2 transform hover:-translate-y-1">
                        Tôi cần hỗ trợ <i class="fas fa-headset ml-1"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <!-- Decorative wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-[calc(110%+1.3px)] h-[50px] md:h-[80px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#ffffff"></path>
            </svg>
        </div>
    </header>

    <!-- Section 1: Nỗi đau & Sự thật (The Hook) -->
    <section id="kham-pha" class="py-20 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 animate-fade-up">
                    <div class="bg-gradient-to-br from-red-50 to-rose-50 p-8 md:p-10 rounded-3xl border border-red-100 shadow-soft relative">
                        <div class="absolute -top-6 -left-6 bg-white rounded-full p-2 shadow-md">
                            <div class="bg-gradient-to-br from-red-100 to-rose-100 text-red-500 w-14 h-14 rounded-full flex items-center justify-center text-2xl">
                                <i class="fas fa-heart-crack"></i>
                            </div>
                        </div>
                        <h3 class="font-heading text-2xl md:text-3xl font-bold text-red-900 mb-5 mt-2">Kỳ vọng và nỗi sợ</h3>
                        <p class="text-gray-700 text-lg mb-4 leading-relaxed">
                            Nhiều ba mẹ bổ sung lợi khuẩn với mong muốn con tiêu hóa tốt, ăn ngủ ngon. Nhưng thực tế lại phũ phàng: <span class="font-bold text-red-600 bg-red-100/50 px-1 rounded">Con quấy dữ dội, đi ngoài bất thường, lờ đờ, mất tập trung hoặc cáu gắt vô cớ.</span>
                        </p>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Sự thất vọng và sợ hãi khiến nhiều gia đình quyết định vứt bỏ hộp men đắt tiền và dừng lại. Nhưng sự thật đằng sau đó là gì?
                        </p>
                    </div>
                </div>
                
                <div class="lg:w-1/2 animate-fade-up delay-100">
                    <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-8 inline-block relative">
                        Trục ruột - não: <br class="hidden sm:block"/>Nơi mọi thứ bắt đầu
                        <span class="absolute -bottom-2 left-0 w-1/3 h-1.5 bg-brand-500 rounded-full"></span>
                    </h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-brand-50 transition border border-transparent hover:border-brand-100">
                            <div class="flex-shrink-0 mt-1 bg-gradient-to-br from-brand-100 to-teal-100 text-brand-600 w-12 h-12 rounded-xl flex items-center justify-center shadow-sm">
                                <i class="fas fa-microscope text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-1">100 nghìn tỷ vi sinh vật</h4>
                                <p class="text-gray-600 text-base">Nhiều gấp 10 lần tổng tế bào cơ thể, đóng vai trò như hệ miễn dịch thứ hai.</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-brand-50 transition border border-transparent hover:border-brand-100">
                            <div class="flex-shrink-0 mt-1 bg-gradient-to-br from-brand-100 to-teal-100 text-brand-600 w-12 h-12 rounded-xl flex items-center justify-center shadow-sm">
                                <i class="fas fa-shield-virus text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-1">Vệ sĩ niêm mạc ruột</h4>
                                <p class="text-gray-600 text-base">Lợi khuẩn là rào chắn, ngăn chặn nấm men (Candida) và vi khuẩn có hại bám rễ, gây hội chứng "ruột rò rỉ".</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-5 p-4 rounded-2xl hover:bg-brand-50 transition border border-transparent hover:border-brand-100">
                            <div class="flex-shrink-0 mt-1 bg-gradient-to-br from-brand-100 to-teal-100 text-brand-600 w-12 h-12 rounded-xl flex items-center justify-center shadow-sm">
                                <i class="fas fa-brain text-2xl"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg text-gray-900 mb-1">Nhà máy sản xuất hạnh phúc</h4>
                                <p class="text-gray-600 text-base">Lên đến 90% Serotonin (Hormone điều chỉnh cảm xúc, giấc ngủ) được sản xuất tại ruột. Ruột khỏe, não mới êm!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Giải thích "Die-off" (Infographic Style) -->
    <section class="py-20 bg-gray-50 border-y border-gray-100 relative overflow-hidden">
        <!-- Background elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-brand-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 z-0"></div>
        <div class="absolute bottom-0 left-0 w-64 h-64 bg-accent-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 z-0"></div>
        
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4 animate-fade-up">Giải mã phản ứng "Die-off"</h2>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto mb-16 animate-fade-up delay-100">Tại sao lợi khuẩn vào lại làm con mệt mỏi hơn?</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left mb-16 relative">
                <!-- Connecting Line for Desktop -->
                <div class="hidden md:block absolute top-28 left-1/6 right-1/6 h-0.5 bg-gradient-to-r from-blue-200 via-red-200 to-accent-200 z-0"></div>

                <!-- Step 1 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 infographic-card relative z-10 animate-fade-up delay-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-cyan-100 text-blue-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm mx-auto md:mx-0">
                        <i class="fas fa-ghost"></i>
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900 text-center md:text-left">1. Cuộc chiến sinh tồn</h3>
                    <p class="text-gray-600 text-base leading-relaxed text-center md:text-left">Hàng tỷ lợi khuẩn tiến vào ruột, tranh giành thức ăn và chỗ đứng, khiến nấm men và vi khuẩn có hại bị tiêu diệt hàng loạt.</p>
                </div>
                
                <!-- Step 2 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 infographic-card relative z-10 animate-fade-up delay-200 md:mt-12">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-100 to-rose-100 text-red-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm mx-auto md:mx-0">
                        <i class="fas fa-biohazard"></i>
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900 text-center md:text-left">2. Xả độc ồ ạt</h3>
                    <p class="text-gray-600 text-base leading-relaxed text-center md:text-left">Khi hại khuẩn chết đi, màng tế bào vỡ vụn, giải phóng lập tức một lượng khổng lồ nội độc tố (như Acetaldehyde) và kim loại nặng vào máu.</p>
                </div>
                
                <!-- Step 3 -->
                <div class="bg-white p-8 rounded-3xl shadow-soft border border-gray-100 infographic-card relative z-10 animate-fade-up delay-300 md:mt-24">
                    <div class="w-16 h-16 bg-gradient-to-br from-accent-100 to-orange-100 text-accent-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-sm mx-auto md:mx-0">
                        <i class="fas fa-filter"></i>
                    </div>
                    <h3 class="font-bold text-xl md:text-2xl mb-3 text-gray-900 text-center md:text-left">3. Quá tải hệ thải độc</h3>
                    <p class="text-gray-600 text-base leading-relaxed text-center md:text-left">Gan, thận của trẻ chưa kịp xử lý mẻ rác khổng lồ này, khiến độc tố ứ đọng tạm thời, gây ra sự xáo trộn cả về thể chất lẫn hành vi.</p>
                </div>
            </div>

            <!-- Metaphor Box -->
            <div class="bg-gradient-to-r from-accent-50 to-orange-50 rounded-3xl p-8 md:p-10 shadow-soft border border-accent-100 text-left max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-10 animate-fade-up relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-accent-100 rounded-full mix-blend-multiply opacity-50 -translate-y-1/2 translate-x-1/2"></div>
                
                <div class="md:w-1/3 flex justify-center z-10">
                    <div class="w-32 h-32 bg-white rounded-full flex items-center justify-center shadow-lg border-4 border-accent-100 relative">
                        <div class="absolute inset-0 rounded-full border border-accent-200 animate-ping opacity-20"></div>
                        <i class="fas fa-broom text-6xl text-gradient bg-clip-text text-transparent bg-gradient-to-br from-accent-500 to-orange-500"></i>
                    </div>
                </div>
                <div class="md:w-2/3 z-10">
                    <div class="inline-block bg-accent-100 text-accent-700 px-3 py-1 rounded-full text-xs font-bold tracking-wider mb-3">HÌNH ẢNH ẨN DỤ</div>
                    <h4 class="font-heading text-2xl md:text-3xl font-bold text-gray-900 mb-4">Tổng vệ sinh nhà cửa</h4>
                    <p class="text-gray-700 text-lg leading-relaxed mb-4">Giống như dọn một căn nhà ẩm mốc lâu năm. Khi bạn cọ rửa mạnh, bụi bẩn bay mù mịt khiến bạn ngạt thở tạm thời. Nhưng khi dọn xong, không gian sẽ hoàn toàn sạch sẽ, thoáng đãng.</p>
                    <div class="bg-white/80 rounded-xl p-4 border-l-4 border-accent-500">
                        <p class="text-accent-700 font-bold text-lg md:text-xl">👉 Die-off chính là lúc bụi bẩn đang "bay mù mịt" bên trong cơ thể con!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Dấu hiệu nhận biết (Comparison Table) -->
    <section class="py-20 bg-white relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16 animate-fade-up">
                <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Cách nhận diện cơn bão "Die-off"</h2>
                <div class="w-24 h-1.5 bg-brand-500 mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
                <!-- Physical Signs -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft border border-gray-100 transition-all hover:shadow-lg animate-fade-up">
                    <div class="bg-gradient-to-r from-blue-500 to-cyan-500 py-6 px-8 text-white relative overflow-hidden">
                        <i class="fas fa-temperature-half absolute -right-4 -bottom-4 text-7xl opacity-20"></i>
                        <div class="flex items-center gap-4 relative z-10">
                            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-temperature-half text-2xl"></i>
                            </div>
                            <h3 class="font-heading text-2xl font-bold">Dấu hiệu thể chất</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-viruses text-blue-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Giống cúm:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Mệt mỏi lừ đừ, uể oải, nhức cơ, hâm hấp sốt nhẹ.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-poop text-blue-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Biến đổi phân:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Tiêu chảy, phân lỏng, có mùi chua/khẳm rất nặng, hoặc có bọt/nhầy.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-wind text-blue-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Tiêu hóa dồn dập:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Đầy hơi, chướng bụng căng cứng, ợ hơi, sôi bụng, trào ngược.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-allergies text-blue-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Biểu hiện da:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Phát ban nhẹ, nổi mẩn đỏ nếp gấp (cổ, bẹn), ngứa ngáy.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Behavioral Signs -->
                <div class="bg-white rounded-3xl overflow-hidden shadow-soft border border-gray-100 transition-all hover:shadow-lg animate-fade-up delay-100">
                    <div class="bg-gradient-to-r from-orange-500 to-amber-500 py-6 px-8 text-white relative overflow-hidden">
                        <i class="fas fa-face-angry absolute -right-4 -bottom-4 text-7xl opacity-20"></i>
                        <div class="flex items-center gap-4 relative z-10">
                            <div class="bg-white/20 p-3 rounded-xl backdrop-blur-sm">
                                <i class="fas fa-face-angry text-2xl"></i>
                            </div>
                            <h3 class="font-heading text-2xl font-bold">Dấu hiệu hành vi</h3>
                        </div>
                    </div>
                    <div class="p-8">
                        <ul class="space-y-6">
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-bolt text-orange-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Cảm xúc bùng nổ:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Cáu gắt vô cớ, dễ kích động, ăn vạ kéo dài, tức giận nhiều.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-arrow-rotate-left text-orange-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Thoái lui kỹ năng:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Tạm thời mất đi kỹ năng giao tiếp, vốn từ vựng mới học.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-cloud text-orange-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Sương mù não (Brain fog):</strong> 
                                    <span class="text-gray-600 leading-relaxed">Ánh mắt lờ đờ, tránh né giao tiếp mắt rõ rệt hơn.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-4">
                                <div class="w-10 h-10 rounded-full bg-orange-50 flex items-center justify-center flex-shrink-0 mt-1">
                                    <i class="fas fa-bed text-orange-500 text-lg"></i>
                                </div>
                                <div>
                                    <strong class="text-gray-900 text-lg block mb-1">Rối loạn cực đoan:</strong> 
                                    <span class="text-gray-600 leading-relaxed">Tăng hành vi tự kích (vẩy tay, kiễng gót), mất ngủ trầm trọng, hay giật mình la hét.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <div class="mt-10 bg-gray-50 border border-gray-200 rounded-2xl p-6 text-center shadow-sm animate-fade-up delay-200">
                <p class="text-base text-gray-600 font-medium">
                    <span class="text-brand-600"><i class="fas fa-info-circle mr-2"></i>Lưu ý:</span> 
                    Mức độ biểu hiện phụ thuộc vào mức độ loạn khuẩn ban đầu và khả năng thải độc của gan, thận từng bé.
                </p>
            </div>
        </div>
    </section>

    <!-- Section 4: Nguyên tắc Vàng (Timeline) -->
    <section class="py-24 bg-gradient-to-b from-brand-50 to-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-20 animate-fade-up">
                <span class="inline-block bg-gradient-to-r from-accent-500 to-orange-500 text-white px-5 py-1.5 rounded-full font-bold text-sm tracking-wider uppercase mb-4 shadow-md">Nguyên tắc vàng</span>
                <h2 class="font-heading text-3xl md:text-5xl font-bold text-gray-900 mb-6">Bắt đầu thấp - tăng chậm</h2>
                <p class="text-xl text-gray-600 font-medium">"Start Low and Go Slow" - Bí quyết để con thải độc nhẹ nhàng, không kiệt sức.</p>
            </div>

            <div class="relative wrap overflow-hidden p-4 md:p-10 h-full">
                <!-- Vertical Line -->
                <div class="absolute border-opacity-20 border-brand-500 h-full border-l-4 left-1/2 transform -translate-x-1/2 hidden md:block rounded-full"></div>

                <!-- Step 1 -->
                <div class="mb-12 flex justify-between items-center w-full right-timeline group">
                    <div class="order-1 md:w-5/12 hidden md:block"></div>
                    <div class="z-20 flex items-center order-1 w-16 h-16 rounded-full shadow-lg bg-white border-4 border-brand-500 group-hover:scale-110 group-hover:bg-brand-50 transition-all duration-300 mx-auto md:mx-0">
                        <h1 class="mx-auto font-heading font-bold text-2xl text-brand-600">1</h1>
                    </div>
                    <div class="order-1 bg-white rounded-2xl shadow-soft w-full md:w-5/12 px-6 py-6 text-left border border-gray-100 mt-6 md:mt-0 group-hover:-translate-y-2 transition-all duration-300">
                        <h4 class="mb-3 font-bold text-xl md:text-2xl text-gray-900">Liều cực nhỏ (Nguyên tắc hạt gạo)</h4>
                        <p class="text-sm md:text-base leading-snug text-gray-600 text-opacity-100">Bỏ qua liều khuyến cáo trên vỏ hộp. Hãy mở vỏ nang, lấy 1/8 lượng bột, hoặc dùng đầu tăm nhúng bột chỉ bằng 1-2 hạt gạo để cơ thể con làm quen.</p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="mb-12 flex justify-between flex-row-reverse items-center w-full left-timeline group">
                    <div class="order-1 md:w-5/12 hidden md:block"></div>
                    <div class="z-20 flex items-center order-1 w-16 h-16 rounded-full shadow-lg bg-white border-4 border-brand-500 group-hover:scale-110 group-hover:bg-brand-50 transition-all duration-300 mx-auto md:mx-0">
                        <h1 class="mx-auto font-heading font-bold text-2xl text-brand-600">2</h1>
                    </div>
                    <div class="order-1 bg-white rounded-2xl shadow-soft w-full md:w-5/12 px-6 py-6 text-left border border-gray-100 mt-6 md:mt-0 group-hover:-translate-y-2 transition-all duration-300">
                        <h4 class="mb-3 font-bold text-xl md:text-2xl text-gray-900">Theo dõi sát sao</h4>
                        <p class="text-sm md:text-base leading-snug text-gray-600 text-opacity-100">Giữ nguyên liều siêu nhỏ trong 3-5 ngày. Quan sát kỹ phân, giấc ngủ và hành vi. <span class="font-semibold text-brand-600">Trẻ vui vẻ bình thường = Gan đang dọn dẹp tốt.</span></p>
                    </div>
                </div>
                
                <!-- Step 3 -->
                <div class="mb-12 flex justify-between items-center w-full right-timeline group">
                    <div class="order-1 md:w-5/12 hidden md:block"></div>
                    <div class="z-20 flex items-center order-1 w-16 h-16 rounded-full shadow-lg bg-white border-4 border-red-500 group-hover:scale-110 group-hover:bg-red-50 transition-all duration-300 mx-auto md:mx-0 text-red-500">
                        <i class="mx-auto fas fa-pause text-xl"></i>
                    </div>
                    <div class="order-1 bg-white rounded-2xl shadow-soft w-full md:w-5/12 px-6 py-6 text-left border border-gray-100 mt-6 md:mt-0 group-hover:-translate-y-2 transition-all duration-300">
                        <h4 class="mb-3 font-bold text-xl md:text-2xl text-gray-900">Giảm hoặc Tạm nghỉ</h4>
                        <p class="text-sm md:text-base leading-snug text-gray-600 text-opacity-100">Nếu Die-off xảy ra dữ dội kéo dài quá 2 ngày, hãy <span class="font-bold text-red-600">GIẢM NỬA</span> liều đang dùng, hoặc dừng hẳn 1-3 ngày cho gan thận được "thở" rồi mới tiếp tục.</p>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="mb-12 flex justify-between flex-row-reverse items-center w-full left-timeline group">
                    <div class="order-1 md:w-5/12 hidden md:block"></div>
                    <div class="z-20 flex items-center order-1 w-16 h-16 rounded-full shadow-lg bg-white border-4 border-green-500 group-hover:scale-110 group-hover:bg-green-50 transition-all duration-300 mx-auto md:mx-0 text-green-500">
                        <i class="mx-auto fas fa-arrow-up text-xl"></i>
                    </div>
                    <div class="order-1 bg-white rounded-2xl shadow-soft w-full md:w-5/12 px-6 py-6 text-left border border-gray-100 mt-6 md:mt-0 group-hover:-translate-y-2 transition-all duration-300">
                        <h4 class="mb-3 font-bold text-xl md:text-2xl text-gray-900">Tăng chậm đến đích</h4>
                        <p class="text-sm md:text-base leading-snug text-gray-600 text-opacity-100">Khi con đã quen và triệu chứng tan biến, tăng nhẹ từng nấc nhỏ (ví dụ từ 1/4 lên 1/2 viên). Giữ liều mới 4-7 ngày trước khi tăng tiếp.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Bí kíp thực hành -->
    <section class="py-24 bg-white relative">
        <div class="absolute top-0 left-0 w-full h-full bg-[radial-gradient(#e5e7eb_1px,transparent_1px)] [background-size:20px_20px] opacity-30"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 animate-fade-up">
                <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-6">Mẹo hữu ích khi cho con uống lợi khuẩn</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed">Trẻ tự kỷ cực kỳ nhạy cảm về giác quan. Hãy áp dụng những bí kíp này để tránh phản ứng từ chối từ con và bảo toàn giá trị của thuốc.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Tip 1 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-brand-50 text-brand-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-brand-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-mask"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Mẹo "Ngụy trang"</h3>
                    <p class="text-gray-600 leading-relaxed">Trộn bột vào thức ăn sệt con thích: sốt táo, bơ nghiền, sữa chua nguội. Không pha nước tinh khiết vì mùi vị lạ sẽ khiến bé cảnh giác, nôn ọe.</p>
                </div>
                
                <!-- Tip 2 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-indigo-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-eye-slash"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Đánh lừa thị giác</h3>
                    <p class="text-gray-600 leading-relaxed">Dùng cốc đục màu (không trong suốt), ống hút hoặc bình tập uống có nắp che kín cặn trắng lơ lửng. Thị giác của trẻ rất nhạy!</p>
                </div>
                
                <!-- Tip 3 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-red-50 text-red-500 flex items-center justify-center text-3xl mb-6 group-hover:bg-red-500 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-thermometer-empty"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Nhiệt độ = Sống còn</h3>
                    <p class="text-gray-600 leading-relaxed">Tuyệt đối không pha vào cháo/nước nóng (>40°C). Nhiệt độ cao sẽ luộc chín vi khuẩn. Chỉ nhỏ lên tay thử độ ấm nhẹ như pha sữa rồi mới trộn.</p>
                </div>
                
                <!-- Tip 4 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-blue-50 text-blue-500 flex items-center justify-center text-3xl mb-6 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-snowflake"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Bảo quản ngăn mát</h3>
                    <p class="text-gray-600 leading-relaxed">Ngoại trừ chủng bào tử, hầu hết lợi khuẩn sống cần cất tủ lạnh sau khi mở. Đi xa nhớ mang túi giữ nhiệt và đá khô.</p>
                </div>
                
                <!-- Tip 5 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-orange-50 text-orange-500 flex items-center justify-center text-3xl mb-6 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-pills"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Cách ly kháng sinh</h3>
                    <p class="text-gray-600 leading-relaxed">Kháng sinh tiêu diệt sạch vi khuẩn không phân biệt tốt xấu. Phải uống lợi khuẩn cách kháng sinh tối thiểu 2-3 giờ.</p>
                </div>
                
                <!-- Tip 6 -->
                <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-soft hover:shadow-xl transition-all duration-300 group hover:-translate-y-2">
                    <div class="w-16 h-16 rounded-2xl bg-green-50 text-green-600 flex items-center justify-center text-3xl mb-6 group-hover:bg-green-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-user-doctor"></i>
                    </div>
                    <h3 class="font-heading font-bold text-xl md:text-2xl text-gray-900 mb-4">Tuyệt đối không tự ý</h3>
                    <p class="text-gray-600 leading-relaxed">Không mù quáng sao chép liều lượng của trẻ khác. Mỗi bé có mức độ loạn khuẩn riêng, cần sự đồng hành của chuyên gia y sinh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer & CTA Section -->
    <section id="lien-he" class="bg-slate-900 text-white py-20 relative overflow-hidden">
        <div class="absolute inset-0 z-0">
            <div class="absolute top-0 right-1/4 w-96 h-96 bg-brand-600 rounded-full mix-blend-screen filter blur-[100px] opacity-20"></div>
            <div class="absolute bottom-0 left-1/4 w-96 h-96 bg-blue-600 rounded-full mix-blend-screen filter blur-[100px] opacity-20"></div>
        </div>
        
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center relative z-10">
            <h2 class="font-heading text-3xl md:text-4xl lg:text-5xl font-bold mb-6">Bạn không phải đi một mình</h2>
            <p class="text-slate-300 mb-12 text-lg md:text-xl max-w-3xl mx-auto leading-relaxed">
                Phản ứng Die-off là tín hiệu đáng mừng chứng tỏ ruột đang được dọn dẹp để chuẩn bị cho sự bứt phá về sức khỏe và nhận thức. Hãy để cộng đồng và chuyên gia đồng hành cùng ba mẹ!
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-16">
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="bg-slate-800/80 hover:bg-[#1877F2] border border-slate-700 hover:border-[#1877F2] text-white p-8 rounded-3xl transition-all duration-300 flex flex-col items-center justify-center gap-4 group backdrop-blur-sm transform hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(24,119,242,0.4)]">
                    <div class="bg-slate-700/50 group-hover:bg-white/20 p-4 rounded-2xl transition-colors">
                        <i class="fab fa-facebook text-4xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div>
                        <span class="font-bold text-lg block mb-1">Cộng đồng Facebook</span>
                        <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hiểu con từ Gốc</span>
                    </div>
                </a>
                
                <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="bg-slate-800/80 hover:bg-[#0068FF] border border-slate-700 hover:border-[#0068FF] text-white p-8 rounded-3xl transition-all duration-300 flex flex-col items-center justify-center gap-4 group backdrop-blur-sm transform hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(0,104,255,0.4)]">
                    <div class="bg-slate-700/50 group-hover:bg-white/20 p-4 rounded-2xl transition-colors">
                        <i class="fas fa-comment-dots text-4xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div>
                        <span class="font-bold text-lg block mb-1">Nhóm Zalo hỗ trợ</span>
                        <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh chóng</span>
                    </div>
                </a>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="bg-slate-800/80 hover:bg-brand-600 border border-slate-700 hover:border-brand-500 text-white p-8 rounded-3xl transition-all duration-300 flex flex-col items-center justify-center gap-4 group backdrop-blur-sm transform hover:-translate-y-2 hover:shadow-[0_0_30px_rgba(13,148,136,0.4)]">
                    <div class="bg-slate-700/50 group-hover:bg-white/20 p-4 rounded-2xl transition-colors">
                        <i class="fas fa-headset text-4xl group-hover:scale-110 transition-transform"></i>
                    </div>
                    <div>
                        <span class="font-bold text-lg block mb-1">Trợ lý Nam Khánh</span>
                        <span class="text-sm text-slate-400 group-hover:text-brand-100 transition-colors">Tư vấn trực tiếp</span>
                    </div>
                </a>
            </div>
            
            <div class="border-t border-slate-800 pt-10 text-slate-400 text-sm">
                <p class="mb-3 leading-relaxed max-w-2xl mx-auto">Nội dung được tổng hợp nhằm mục đích nâng cao nhận thức y sinh cho ba mẹ có con tự kỷ.<br>Luôn tham khảo ý kiến bác sĩ/chuyên gia trước khi áp dụng phác đồ điều trị mới.</p>
                <p class="font-medium text-slate-500">&copy; <?php echo date('Y'); ?> Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
            </div>
        </div>
    </section>

<?php wp_footer(); ?>
</body>