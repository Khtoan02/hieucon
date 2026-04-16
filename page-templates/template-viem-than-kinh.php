<?php
/**
 * Template Name: Trang Viêm Thần Kinh
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Khi thức ăn trở thành kẻ thù - Hiểu con từ Gốc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#E3F2FD',
                            100: '#BBDEFB',
                            200: '#90CAF9',
                            300: '#64B5F6',
                            400: '#42A5F5',
                            500: '#0056B3',
                            600: '#004A99',
                            700: '#003D80',
                            800: '#002E66',
                            900: '#001F4D',
                        },
                        secondary: {
                            50: '#E0F7FA',
                            100: '#B2EBF2',
                            200: '#80DEEA',
                            300: '#4DD0E1',
                            400: '#26C6DA',
                            500: '#17A2B8',
                            600: '#13899C',
                            700: '#0F7080',
                            800: '#0B5764',
                            900: '#073E48',
                        },
                        warning: {
                            50: '#FFF8E1',
                            100: '#FFECB3',
                            200: '#FFE082',
                            300: '#FFD54F',
                            400: '#FFCA28',
                            500: '#FFC107',
                            600: '#FFB300',
                            700: '#FFA000',
                            800: '#FF8F00',
                            900: '#FF6F00',
                        },
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Quicksand', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; }

        /* Animations */
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

        /* Hero gradient using original colors */
        .hero-bg {
            background: linear-gradient(135deg, #003D80 0%, #0056B3 35%, #17A2B8 100%);
        }

        /* Smooth card hover */
        .card-hover {
            transition: transform 0.35s cubic-bezier(.4,0,.2,1), box-shadow 0.35s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px -12px rgba(0,0,0,0.15);
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    <!-- ═══════════════════════════ HERO ═══════════════════════════ -->
    <header class="hero-bg relative overflow-hidden">
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] rounded-full bg-white/5 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[400px] h-[400px] rounded-full bg-white/5 translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-10 right-16 opacity-[0.07] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i class="fas fa-brain text-white text-[220px]"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/15 text-white font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-white/25">
                    <span class="w-2 h-2 rounded-full bg-yellow-400 animate-pulse"></span>
                    <i class="fas fa-heart"></i> HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                Khi thức ăn trở thành kẻ thù <br class="hidden md:block">
                <span class="text-yellow-300">Khởi nguồn của cơn bão viêm</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-blue-100 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Đã bao giờ bạn tự hỏi: Tại sao con chỉ ăn một mẩu bánh mì nhỏ hay uống một ngụm sữa bò, mà ngay sau đó lại lăng xăng, bứt rứt và cáu gắt khó kiểm soát? Hãy cùng tìm hiểu những gì thực sự đang diễn ra bên trong cơ thể con.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#section-1" class="bg-yellow-400 hover:bg-yellow-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Khám phá sự thật <i class="fas fa-arrow-down animate-bounce"></i>
                </a>
                <a href="#footer-cta" class="bg-white/20 hover:bg-white/30 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Tôi cần hỗ trợ <i class="fas fa-headset"></i>
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

    <!-- ═══════════════════════════ SECTION 1: Vấn đề ═══════════════════════════ -->
    <section id="section-1" class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-stretch gap-8 lg:gap-12">

                <!-- IMAGE — chiếm diện tích lớn để gây chú ý -->
                <div class="lg:w-[55%] anim">
                    <div class="relative rounded-2xl lg:rounded-3xl overflow-hidden shadow-2xl group h-full min-h-[320px] md:min-h-[420px] lg:min-h-[480px]">
                        <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=1400&q=80" 
                             alt="Hiểu con từ gốc" 
                             class="w-full h-full object-cover absolute inset-0 transition-transform duration-700 group-hover:scale-105" 
                             onerror="this.src='https://placehold.co/800x500/0056B3/ffffff?text=Hiểu+Con+Từ+Gốc'">
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                        <!-- Quote overlay -->
                        <div class="absolute bottom-0 left-0 right-0 p-5 sm:p-8">
                            <div class="bg-white/15 backdrop-blur-lg rounded-xl sm:rounded-2xl p-4 sm:p-5 border border-white/20">
                                <p class="text-white font-medium text-base sm:text-lg italic leading-relaxed">
                                    <i class="fas fa-quote-left text-yellow-400 mr-2"></i>
                                    Những hành vi mất kiểm soát không phải là con đang "hư", đó là tiếng chuông báo động của một cơ thể đang quá tải...
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- TEXT -->
                <div class="lg:w-[45%] flex flex-col justify-center anim d1">
                    <h2 class="font-heading text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-6 leading-snug">
                        <i class="fas fa-search-plus text-secondary-500 mr-2"></i>
                        Đằng sau những hành vi khó hiểu
                        <span class="block w-16 h-1 bg-secondary-500 rounded-full mt-3"></span>
                    </h2>

                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-4">
                        Trong xã hội hiện đại, khi thấy một em bé la hét, chạy nhảy không ngừng hoặc hay ăn vạ sau bữa ăn, nhiều người thường vội vàng kết luận rằng bé bị "chiều hư" hoặc mắc lỗi hành vi. Tuy nhiên, sự thật lại nằm ở một nơi ít ai ngờ tới: <strong class="text-primary-500">Đường ruột của trẻ.</strong>
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-6">
                        Khi đường ruột của con không khỏe, một món ăn rất đỗi bình thường (như bánh mì, sữa, hay đồ ngọt) lại bị cơ thể hiểu nhầm là "kẻ lạ mặt" xâm nhập. Khi đó, hệ miễn dịch sẽ tự động bật chế độ chiến đấu, tạo ra một làn sóng viêm nhiễm đi từ bụng trôi ngược lên tận não bộ.
                    </p>

                    <!-- Callout box — biểu tượng rõ contrast -->
                    <div class="bg-primary-500 rounded-xl sm:rounded-2xl p-5 sm:p-6 text-white">
                        <p class="font-bold text-base sm:text-lg mb-2 flex items-center gap-2">
                            <i class="fas fa-exclamation-circle text-yellow-400 text-xl"></i>
                            Trẻ đang chịu đựng sự khó chịu từ bên trong!
                        </p>
                        <p class="text-blue-100 text-sm sm:text-base leading-relaxed">
                            Cảm giác của con lúc này giống như bạn đang phải ngồi trong một căn phòng vô cùng ồn ào, ngột ngạt và ngứa ngáy khắp người nhưng lại không thể nói ra thành lời. Con bứt rứt, cáu gắt chính là cách duy nhất để con thể hiện sự quá tải đó.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════ SECTION 2: Infographic ═══════════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-primary-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[250px] h-[250px] rounded-full bg-secondary-100/50 blur-[80px] translate-y-1/2 -translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <!-- Section Header -->
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-primary-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế bệnh sinh</span>
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-3">Hành trình của "cơn bão viêm"</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg leading-relaxed">
                    Tại sao thức ăn lại có thể ảnh hưởng đến não bộ? Hãy cùng hình dung cơ thể con giống như một ngôi nhà, và mọi chuyện bắt đầu từ khi cánh cửa an ninh bị hỏng hóc.
                </p>
            </div>

            <!-- STEP 1 -->
            <div class="bg-white rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 flex flex-col lg:flex-row items-center gap-6 lg:gap-10 shadow-md border-l-4 border-primary-500 mb-6 card-hover anim d1">
                <div class="lg:w-auto flex items-center gap-4 lg:flex-col lg:items-center shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-primary-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-2xl sm:text-3xl font-heading font-extrabold">1</span>
                    </div>
                    <i class="fas fa-door-open text-3xl sm:text-4xl text-primary-500"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-heading text-xl sm:text-2xl lg:text-3xl font-bold text-primary-500 mb-3">Cánh cửa đường ruột bị hở</h3>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-3">
                        Đường ruột vốn có một lớp lưới lọc cực kỳ thông minh. Lớp lưới này bình thường chỉ cho phép những chất dinh dưỡng đã được tiêu hóa thật nhỏ, thật nhuyễn đi vào máu để nuôi cơ thể. 
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                        Nhưng ở nhiều trẻ, do mất cân bằng vi khuẩn hoặc tiêu hóa kém, lớp lưới này bị rách, tạo ra những "khe hở". Lúc này, những mẩu thức ăn lớn, chưa được tiêu hóa kỹ (đặc biệt là chất đạm trong lúa mì và sữa bò) đã <strong class="text-primary-500 underline decoration-primary-200 decoration-2 underline-offset-2">lọt qua khe hở này và trôi thẳng vào dòng máu.</strong>
                    </p>
                </div>
            </div>

            <!-- Arrow -->
            <div class="flex justify-center my-1 anim d1">
                <div class="w-10 h-10 bg-secondary-500 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-arrow-down text-white animate-bounce"></i>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="bg-white rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 flex flex-col lg:flex-row-reverse items-center gap-6 lg:gap-10 shadow-md border-r-4 border-secondary-500 mb-6 card-hover anim d2">
                <div class="lg:w-auto flex items-center gap-4 lg:flex-col lg:items-center shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-secondary-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-2xl sm:text-3xl font-heading font-extrabold">2</span>
                    </div>
                    <i class="fas fa-shield-virus text-3xl sm:text-4xl text-secondary-500"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-heading text-xl sm:text-2xl lg:text-3xl font-bold text-secondary-600 mb-3">Cơ thể nhầm lẫn và tấn công</h3>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed mb-3">
                        Mạch máu của chúng ta là nơi cần được bảo vệ sạch sẽ nhất. Khi cơ thể bất ngờ thấy những "mẩu thức ăn to đùng" trôi nổi trong máu, nó không biết đó là đồ ăn. Nó lầm tưởng đó là virus, vi khuẩn hay kẻ thù nguy hiểm.
                    </p>
                    <p class="text-gray-600 text-base sm:text-lg leading-relaxed">
                        Ngay lập tức, cơ thể tự động sinh ra vũ khí để "trói chặt" và tiêu diệt những mẩu thức ăn này. Cuộc chiến này tạo ra một lượng lớn <strong class="text-secondary-600 underline decoration-secondary-200 decoration-2 underline-offset-2">rác thải và các cục bám dính</strong> trôi nổi khắp hệ tuần hoàn. Khi rác này bám vào da, con bị ngứa ngáy. Khi rác bám vào khớp, con hay vặn vẹo. Và đáng sợ nhất, rác này trôi thẳng lên não.
                    </p>
                </div>
            </div>

            <!-- Arrow -->
            <div class="flex justify-center my-1 anim d2">
                <div class="w-10 h-10 bg-warning-600 rounded-full flex items-center justify-center shadow-md">
                    <i class="fas fa-arrow-down text-white animate-bounce"></i>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="bg-warning-50 rounded-2xl lg:rounded-3xl p-6 sm:p-8 lg:p-10 flex flex-col lg:flex-row items-start gap-6 lg:gap-10 shadow-md border-l-4 border-warning-500 card-hover anim d3">
                <div class="lg:w-auto flex items-center gap-4 lg:flex-col lg:items-center shrink-0">
                    <div class="w-16 h-16 sm:w-20 sm:h-20 bg-warning-500 rounded-full flex items-center justify-center shadow-lg">
                        <span class="text-white text-2xl sm:text-3xl font-heading font-extrabold">3</span>
                    </div>
                    <i class="fas fa-fire text-3xl sm:text-4xl text-warning-700"></i>
                </div>
                <div class="flex-1">
                    <h3 class="font-heading text-xl sm:text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Não bộ "bốc cháy" vì căng thẳng</h3>
                    <p class="text-gray-700 text-base sm:text-lg leading-relaxed mb-5">
                        Trong não con có một đội lính gác vô cùng mẫn cán. Khi thấy lượng "rác thải" từ ruột dội lên quá nhiều, đội lính gác này hoảng hốt và phản ứng thái quá, vô tình tạo ra một <strong class="text-warning-800">tình trạng sưng viêm (giống như một đám cháy nhỏ)</strong> ngay trong hệ thần kinh. Hậu quả là:
                    </p>

                    <div class="grid sm:grid-cols-3 gap-4">
                        <div class="bg-white rounded-xl p-4 sm:p-5 border border-warning-200 shadow-sm">
                            <div class="w-10 h-10 bg-warning-500 text-white rounded-lg flex items-center justify-center mb-3">
                                <i class="fas fa-shield-alt text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Mất lớp màng bảo vệ</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Các chất bảo vệ não bị cạn kiệt, khiến não non nớt của con dễ bị tổn thương bởi môi trường xung quanh.</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 sm:p-5 border border-warning-200 shadow-sm">
                            <div class="w-10 h-10 bg-warning-500 text-white rounded-lg flex items-center justify-center mb-3">
                                <i class="fas fa-battery-quarter text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Cạn kiệt năng lượng</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Đám cháy làm hỏng các "nhà máy năng lượng" trong não. Trẻ mệt mỏi từ bên trong nên cực kỳ dễ cáu bẳn và suy sụp (meltdown).</p>
                        </div>
                        <div class="bg-white rounded-xl p-4 sm:p-5 border border-warning-200 shadow-sm">
                            <div class="w-10 h-10 bg-warning-500 text-white rounded-lg flex items-center justify-center mb-3">
                                <i class="fas fa-wifi text-lg"></i>
                            </div>
                            <h4 class="font-bold text-gray-900 text-sm mb-1">Nhiễu sóng thông tin</h4>
                            <p class="text-gray-600 text-sm leading-relaxed">Tín hiệu thần kinh truyền đi bị lộn xộn. Trẻ nghe nhưng không hiểu, mất tập trung, lăng xăng giống hệt như một chiếc radio bị dò sai đài.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════ SECTION 3: Giải pháp ═══════════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-secondary-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Giải pháp dinh dưỡng</span>
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-gray-900 mb-3">Làm dịu cơ thể con bằng thức ăn hàng ngày</h2>
                <p class="text-gray-500 max-w-4xl mx-auto text-base sm:text-lg leading-relaxed">
                    Chúng ta không thể dùng thuốc để "bịt miệng" những khó chịu của con. Cách bền vững nhất là hàn gắn lại chiếc lưới lọc đường ruột và dọn dẹp đám cháy trong não bộ bằng chính những bữa ăn gia đình.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 lg:gap-6">
                <!-- Box 1 -->
                <div class="bg-white rounded-2xl p-6 lg:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-primary-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform">
                        <i class="fas fa-bread-slice"></i>
                    </div>
                    <h3 class="font-heading text-lg sm:text-xl font-bold text-gray-900 mb-3">Tạm ngừng "thủ phạm" gây rối</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Lúa mì (chứa Gluten) và Sữa bò (chứa Casein) là hai loại đạm dai, dính, rất khó tiêu hóa. Việc ba mẹ thử thách tạm ngừng nhóm thực phẩm này (chế độ ăn không Gluten/Casein) sẽ giúp đường ruột con được "nghỉ ngơi", không phải gồng mình chống đỡ hàng ngày.
                    </p>
                </div>

                <!-- Box 2 -->
                <div class="bg-white rounded-2xl p-6 lg:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-secondary-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform">
                        <i class="fas fa-tint"></i>
                    </div>
                    <h3 class="font-heading text-lg sm:text-xl font-bold text-gray-900 mb-3">Đổi loại dầu ăn trong bếp</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Nhiều loại dầu ăn thông thường (dầu đậu nành, hướng dương) chứa chất dễ gây thêm phản ứng sưng viêm. Hãy thay bằng nguồn chất béo tốt như <strong>Omega-3</strong> (từ cá hồi, cá trích nhỏ, hạt chia). Omega-3 hoạt động giống như dòng nước mát, giúp dập tắt "đám cháy" trong não con.
                    </p>
                </div>

                <!-- Box 3 -->
                <div class="bg-white rounded-2xl p-6 lg:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-green-600 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform">
                        <i class="fas fa-apple-alt"></i>
                    </div>
                    <h3 class="font-heading text-lg sm:text-xl font-bold text-gray-900 mb-3">Thêm thực phẩm dọn dẹp</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Các loại trái cây nhiều màu sắc (việt quất, dâu tây) hay gia vị truyền thống như củ nghệ tươi chính là đội ngũ công nhân dọn rác cần mẫn. Chúng cung cấp lượng lớn chất bảo vệ tự nhiên, giúp làm sạch những rác thải đang làm nhiễu loạn thần kinh của trẻ.
                    </p>
                </div>

                <!-- Box 4 -->
                <div class="bg-warning-50 rounded-2xl p-6 lg:p-7 border-2 border-warning-300 shadow-sm card-hover group anim d4">
                    <div class="w-14 h-14 bg-warning-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform">
                        <i class="fas fa-shoe-prints"></i>
                    </div>
                    <h3 class="font-heading text-lg sm:text-xl font-bold text-gray-900 mb-3">Bước đi thật chậm</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Khi bắt đầu thay đổi món ăn hoặc bổ sung bất kỳ thứ gì mới cho con, ba mẹ luôn nhớ nguyên tắc: <strong>Bắt đầu từ lượng cực nhỏ</strong>. Cơ thể con nhạy cảm vô cùng, con cần thời gian để làm quen dần mà không bị sốc hay khó chịu thêm.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════ SECTION 4: Lưu ý ═══════════════════════════ -->
    <section class="py-10 md:py-14 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 anim">
            <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md overflow-hidden border border-gray-200">
                <!-- Header bar -->
                <div class="bg-warning-500 py-4 px-6 sm:px-8 flex items-center gap-3">
                    <i class="fas fa-exclamation-triangle text-white text-xl sm:text-2xl"></i>
                    <h4 class="font-heading text-lg sm:text-xl md:text-2xl font-bold text-white">Mỗi em bé là một vũ trụ riêng biệt</h4>
                </div>
                <!-- Body -->
                <div class="p-6 sm:p-8 lg:p-10 flex flex-col lg:flex-row gap-6 lg:gap-10">
                    <div class="flex-1">
                        <p class="text-gray-700 leading-relaxed text-base sm:text-lg">
                            Cơ địa của mỗi em bé là hoàn toàn khác nhau. Một loại thức ăn rất tốt và giúp em bé này ngoan ngoãn hơn, nhưng lại có thể khiến em bé khác bị ngứa ngáy hay khó tiêu. Không có một thực đơn chung nào hoàn hảo cho tất cả. Việc ba mẹ kiên nhẫn ghi lại nhật ký món ăn hàng ngày và quan sát phân, giấc ngủ, hành vi của con chính là chìa khóa vàng an toàn nhất.
                        </p>
                    </div>
                    <div class="lg:w-[380px] shrink-0 bg-gray-50 rounded-xl p-5 border border-gray-200">
                        <h5 class="text-xs font-bold text-gray-500 uppercase mb-2 tracking-wider flex items-center gap-2">
                            <i class="fas fa-info-circle text-primary-500"></i>
                            Không thay thế lời khuyên bác sĩ
                        </h5>
                        <p class="text-sm text-gray-500 leading-relaxed">
                            Tài liệu này được viết ra với mong muốn cung cấp thêm góc nhìn khoa học dễ hiểu cho các bậc cha mẹ, giúp gia đình vững tin hơn trên hành trình nuôi con. Tuy nhiên, nó không dùng để thay thế cho việc đi khám hay các chỉ định trực tiếp từ bác sĩ chuyên khoa. Mọi quyết định thay đổi lớn về ăn uống của con, ba mẹ nên cân nhắc tham khảo ý kiến người có chuyên môn nhé.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════════ FOOTER / CTA ═══════════════════════════ -->
    <section id="footer-cta" class="relative overflow-hidden">
        <!-- Dark gradient background -->
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-primary-900 py-14 md:py-20">
            <!-- Subtle glow -->
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-primary-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/3 w-[400px] h-[400px] bg-secondary-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <!-- Heading area -->
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Hành trình này, ba mẹ không phải đi một mình</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Nuôi dạy một em bé có đường ruột nhạy cảm là một hành trình rất vất vả và cần nhiều sự kiên nhẫn. Nếu con đang gặp rào cản hành vi, rối loạn tiêu hóa và bạn cần một nơi để chia sẻ, học hỏi và đồng hành, hãy kết nối ngay với chúng tôi.
                    </p>
                </div>

                <!-- CTA Cards — full width grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-12 anim d1">
                    <!-- Facebook -->
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" 
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fab fa-facebook text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Cộng đồng phụ huynh</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Facebook Group</span>
                        </div>
                    </a>

                    <!-- Zalo -->
                    <a href="https://zalo.me/g/vmgfxy834" target="_blank" 
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fas fa-comment-dots text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Zalo hỗ trợ</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh</span>
                        </div>
                    </a>

                    <!-- Hotline -->
                    <a href="tel:0988717107" 
                       class="bg-white/10 hover:bg-primary-500 border border-white/10 hover:border-primary-500 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,86,179,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fas fa-phone-alt text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Hotline tư vấn</span>
                        </div>
                    </a>

                    <!-- Trợ lý -->
                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank" 
                       class="bg-white/10 hover:bg-secondary-500 border border-white/10 hover:border-secondary-500 text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(23,162,184,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fas fa-user-md text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-teal-100 transition-colors">Kết nối trực tiếp</span>
                        </div>
                    </a>
                </div>

                <!-- Copyright -->
                <div class="text-center border-t border-white/10 pt-8 anim d2">
                    <p class="text-slate-400 text-sm mb-1">Nội dung được tổng hợp nhằm mục đích nâng cao nhận thức y sinh cho ba mẹ có con tự kỷ.</p>
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