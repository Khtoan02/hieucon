<?php /* Template Name: Tre_Tu_Ky_Hay_Nga_Thang_Bang_Kem_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vì sao trẻ tự kỷ hay ngã, thăng bằng kém và cách cha mẹ giúp con?</title>
    <meta name="description" content="Khám phá nguyên nhân gốc rễ khiến trẻ tự kỷ hay ngã, thăng bằng kém dưới góc độ thần kinh học và các bài tập vận động thô tại nhà giúp con đi lại vững vàng.">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
      tailwind.config = {
        theme: {
          extend: {
            colors: {
              navy: '#002795',
              yellow: '#FFD154',
              cream: '#FAF9F6',
              'text-dark': '#3D3D3D',
              'text-soft': '#555555'
            },
            fontFamily: {
              oswald: ['Oswald', 'sans-serif'],
              quicksand: ['Quicksand', 'sans-serif']
            }
          }
        }
      }
    </script>
    <style>
        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; line-height: 1.4 !important; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="antialiased bg-[#FAF9F6] text-[#3D3D3D] font-quicksand selection:bg-yellow selection:text-navy">

<main>
    <!-- HERO SECTION -->
    <section class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden">
        <!-- Background Accents -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-600 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute top-1/4 -right-24 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        </div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div>
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-cream text-sm font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-yellow animate-pulse"></span>
                    Góc Nhìn Chuyên Gia
                </div>
                <h1 class="text-cream font-oswald text-4xl md:text-5xl lg:text-6xl font-bold uppercase leading-tight mb-6">
                    Vì Sao Trẻ Tự Kỷ Hay Ngã, <span class="text-yellow">Thăng Bằng Kém</span> Và Cách Cha Mẹ Giúp Con
                </h1>
                <p class="text-cream font-quicksand text-lg md:text-xl leading-relaxed mb-10 opacity-90 font-light">
                    Nhìn con chập chững những bước đi chệnh choạng, thường xuyên vấp ngã hay lóng ngóng rơi đồ có lẽ là khoảnh khắc khiến nhiều cha mẹ thắt lòng. Bài viết này mang đến góc nhìn khoa học để lý giải tận gốc rễ, đồng thời hướng dẫn bạn các phương pháp hỗ trợ an toàn tại nhà.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all text-center">
                        Kiểm Tra Sức Khỏe Toàn Diện
                    </a>
                    <a href="#nguyen-nhan" class="bg-white/10 text-cream backdrop-blur-md border border-white/20 font-bold px-8 py-4 rounded-xl hover:bg-white/20 transition-all text-center">
                        Tìm Hiểu Nguyên Nhân
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-yellow/20 to-transparent rounded-3xl transform rotate-3 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero_balance_1778925733273.png" alt="Cha mẹ hỗ trợ con tập đi" class="relative rounded-3xl shadow-2xl border border-white/10 object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- SECTION 1: THẤU HIỂU -->
    <section class="bg-white py-20 md:py-32 px-6">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
            <div class="order-2 lg:order-1 relative group">
                <div class="absolute -inset-4 bg-gradient-to-r from-cream to-gray-100 rounded-[2.5rem] transform -rotate-2 group-hover:rotate-0 transition-transform duration-500 ease-in-out z-0"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/understanding_balance_1778925746630.png" alt="Thấu hiểu và đồng cảm" class="relative rounded-[2rem] shadow-lg w-full h-auto z-10" />
            </div>
            <div class="order-1 lg:order-2">
                <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold mb-6 leading-snug">
                    Thấu hiểu những bước chân chệnh choạng của con thay vì tự trách
                </h2>
                <p class="text-text-dark leading-relaxed mb-6 text-lg">
                    Rất nhiều cha mẹ mang trong mình cảm giác tội lỗi khi thấy con liên tục trầy xước vì những cú ngã không đáng có. Tuy nhiên, các chuyên gia tâm lý luôn nhấn mạnh rằng sự lóng ngóng này không bắt nguồn từ sự thiếu chú ý của cha mẹ hay sự bất cẩn của trẻ.
                </p>
                <div class="bg-cream/50 backdrop-blur-sm p-8 rounded-2xl border border-navy/5 relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-full bg-yellow"></div>
                    <p class="text-text-soft leading-relaxed text-lg">
                        Thực tế, thế giới qua cảm nhận của một em bé có phổ phát triển thần kinh khác biệt hoàn toàn không giống với chúng ta. Con phải nỗ lực gấp nhiều lần chỉ để duy trì tư thế đứng thẳng.
                    </p>
                </div>
                <div class="mt-8 flex items-start gap-4">
                    <div class="w-12 h-12 rounded-full bg-navy/5 flex items-center justify-center flex-shrink-0 text-2xl">🫂</div>
                    <p class="font-oswald text-navy text-xl font-medium italic">
                        "Tình yêu thương lúc này sẽ được chuyển hóa thành sự quan sát tỉ mỉ, giúp con cảm thấy an toàn tuyệt đối."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: NGUYÊN NHÂN -->
    <section id="nguyen-nhan" class="bg-cream py-20 md:py-32 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Góc Độ Khoa Học</span>
                <h2 class="text-navy font-oswald text-3xl md:text-4xl lg:text-5xl font-semibold mb-6 leading-snug">
                    Nguyên nhân cốt lõi khiến trẻ khó giữ thăng bằng
                </h2>
                <p class="text-text-dark text-lg">
                    Dưới góc độ y khoa và thần kinh học, sự lóng ngóng không phải là ngẫu nhiên. Việc nhận diện đúng cơ chế sinh học sẽ giúp cha mẹ tìm đúng phương pháp can thiệp.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 relative">
                    <div class="absolute inset-0 bg-navy/5 rounded-[2rem] transform rotate-3 scale-105"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/sensory_system_1778925761943.png" alt="Hệ thần kinh và cảm giác" class="relative rounded-[2rem] shadow-xl border border-white w-full h-auto" />
                </div>
                
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-blue-100 transition-transform">🧭</div>
                        <h3 class="text-navy font-oswald text-xl font-semibold mb-3">
                            Gián đoạn cảm thụ bản thể
                        </h3>
                        <p class="text-text-soft leading-relaxed text-sm">
                            Hoạt động như một GPS nội bộ, nhận thông tin từ cơ và khớp. Tín hiệu bị đứt gãy khiến con luôn thấy chông chênh, mất định hướng không gian.
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-14 h-14 rounded-xl bg-yellow/10 flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-yellow/20 transition-transform">👂</div>
                        <h3 class="text-navy font-oswald text-xl font-semibold mb-3">
                            Rối loạn hệ tiền đình
                        </h3>
                        <p class="text-text-soft leading-relaxed text-sm">
                            Khi hệ tiền đình bị quá tải, não bộ không xử lý kịp thay đổi vị trí. Hậu quả là trẻ luôn chóng mặt hoặc chao đảo ngay cả khi đứng yên.
                        </p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group md:col-span-2">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-green-100 transition-transform shrink-0">💪</div>
                            <div>
                                <h3 class="text-navy font-oswald text-xl font-semibold mb-2">
                                    Trương lực cơ thấp
                                </h3>
                                <p class="text-text-soft leading-relaxed text-sm mb-3">
                                    Khi cơ bắp mềm nhão, hệ khung xương thiếu đi bệ đỡ vững chắc. Việc các cơ cốt lõi yếu khiến con tiêu hao năng lượng khổng lồ chỉ để đứng vững.
                                </p>
                                <a href="https://hieucontugoc.online/truong-luc-co-thap-tu-ky" class="text-navy font-bold hover:text-blue-600 transition-colors inline-flex items-center text-sm">
                                    Tìm hiểu thêm <span class="ml-1">→</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: BIỂU HIỆN -->
    <section class="bg-white py-20 md:py-32 px-6 border-b border-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-end gap-8 mb-16">
                <div class="max-w-2xl">
                    <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold mb-4 leading-snug">
                        Nhận diện những khó khăn vận động thường ngày
                    </h2>
                    <p class="text-text-dark text-lg">
                        Sự nhạy bén của cha mẹ là chìa khóa vàng để can thiệp sớm. Trẻ thường không thể tự nói ra cảm giác chông chênh của mình.
                    </p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card -->
                <div class="relative bg-cream rounded-3xl p-8 border border-white shadow-sm overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-yellow/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="text-4xl mb-6 relative z-10">🚶</div>
                    <h3 class="text-navy font-oswald text-xl font-semibold mb-4 relative z-10">
                        Vấp váp ngay trên mặt phẳng
                    </h3>
                    <p class="text-text-soft leading-relaxed relative z-10">
                        Con bước đi nặng nề, lạch bạch hoặc đi bằng mũi chân để tìm cảm giác an toàn. Vấp ngã liên tục dù đang đi trên sàn nhà bằng phẳng.
                    </p>
                </div>
                <!-- Card -->
                <div class="relative bg-cream rounded-3xl p-8 border border-white shadow-sm overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-blue-500/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="text-4xl mb-6 relative z-10">🪜</div>
                    <h3 class="text-navy font-oswald text-xl font-semibold mb-4 relative z-10">
                        Nỗi sợ leo cầu thang
                    </h3>
                    <p class="text-text-soft leading-relaxed mb-4 relative z-10">
                        Đối với hệ tiền đình đang xáo trộn, nâng chân lên giống như nhảy qua vách đá. Con thường sợ hãi, khựng lại, phải đặt hai chân lên cùng một bậc.
                    </p>
                    <a href="https://hieucontugoc.online/tre-tu-ky-kho-leo-cau-thang" class="text-navy font-bold hover:text-blue-600 transition-colors text-sm relative z-10">Chi tiết lý do →</a>
                </div>
                <!-- Card -->
                <div class="relative bg-cream rounded-3xl p-8 border border-white shadow-sm overflow-hidden group">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-full -translate-y-1/2 translate-x-1/2 group-hover:scale-150 transition-transform duration-500"></div>
                    <div class="text-4xl mb-6 relative z-10">🧩</div>
                    <h3 class="text-navy font-oswald text-xl font-semibold mb-4 relative z-10">
                        Chậm trễ mốc vận động
                    </h3>
                    <p class="text-text-soft leading-relaxed mb-4 relative z-10">
                        Liên kết yếu giữa não và cơ kéo chậm tiến trình. Con có thể chậm ngồi, chậm đi, hoặc gặp khó khăn khi đạp xe, bắt bóng, cử động tay.
                    </p>
                    <a href="https://hieucontugoc.online/van-dong-tho-tinh-o-tre-tu-ky" class="text-navy font-bold hover:text-blue-600 transition-colors text-sm relative z-10">Xem mốc vận động →</a>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: GIẢI PHÁP -->
    <section class="bg-[#f0f4f8] py-20 md:py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Thực Hành Tại Nhà</span>
                    <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold mb-6 leading-snug">
                        Giải pháp vật lý trị liệu an toàn giúp con vững bước
                    </h2>
                    <p class="text-text-dark text-lg mb-8">
                        Can thiệp sớm không có nghĩa là ép buộc con phải tập luyện khắc nghiệt. Những phương pháp hiệu quả nhất thường được ngụy trang dưới hình thức trò chơi vui nhộn.
                    </p>
                    
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
                            <div class="w-12 h-12 rounded-full bg-blue-50 flex items-center justify-center shrink-0 text-xl">🎪</div>
                            <div>
                                <h4 class="font-oswald text-navy font-semibold text-lg mb-1">Trò chơi vận động thô</h4>
                                <p class="text-text-soft text-sm leading-relaxed">Bò qua hầm chui, nhảy lò cò vào vòng tròn giúp tăng cường sức mạnh cơ cốt lõi cực kỳ hiệu quả.</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
                            <div class="w-12 h-12 rounded-full bg-yellow/10 flex items-center justify-center shrink-0 text-xl">🏡</div>
                            <div>
                                <h4 class="font-oswald text-navy font-semibold text-lg mb-1">Môi trường an toàn</h4>
                                <p class="text-text-soft text-sm leading-relaxed">Dọn dẹp vật nhọn, trải thảm xốp. Khi biết ngã không đau, tâm lý con thư giãn, dễ học kỹ năng hơn.</p>
                            </div>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm flex gap-4">
                            <div class="w-12 h-12 rounded-full bg-green-50 flex items-center justify-center shrink-0 text-xl">🧘</div>
                            <div>
                                <h4 class="font-oswald text-navy font-semibold text-lg mb-1">Điều hòa cảm giác</h4>
                                <p class="text-text-soft text-sm leading-relaxed">Đu đưa trên võng, nhún nhảy trên bóng yoga giúp não bộ sắp xếp lại tín hiệu, thấy mặt đất vững chãi hơn.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-bl from-yellow/30 to-blue-500/10 rounded-[2rem] transform -rotate-3 scale-105 filter blur-sm"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/physical_therapy_1778925777319.png" alt="Trẻ tập luyện với bóng yoga" class="relative rounded-[2rem] shadow-xl w-full h-auto border-2 border-white" />
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 5: CALL TO ACTION -->
    <section class="bg-navy py-20 px-6 text-center relative overflow-hidden">
        <!-- Accents -->
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-0 right-0 w-full h-full bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white via-navy to-navy"></div>
        </div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="text-white font-oswald text-3xl md:text-5xl font-semibold mb-6 leading-snug">
                Đồng hành cùng sự phát triển toàn diện của con
            </h2>
            <p class="text-white/80 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                Mỗi em bé là một cá thể độc bản, việc chỉ quan sát là chưa đủ. Để thực sự thấu hiểu toàn diện bức tranh sức khỏe và tâm lý của con, hãy thực hiện bài đánh giá chuyên sâu.
            </p>
            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-10 py-5 rounded-xl shadow-lg hover:bg-white hover:-translate-y-1 transition-all inline-block uppercase tracking-wide">
                Thực Hiện Kiểm Tra Sức Khỏe Ngay
            </a>
        </div>
    </section>

    <!-- SECTION 6: FAQ ACCORDION -->
    <section class="bg-white py-20 md:py-32 px-6">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Hỏi & Đáp</span>
                <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold">
                    Giải đáp thắc mắc thường gặp
                </h2>
            </div>
            
            <div class="space-y-4">
                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Việc trẻ thường xuyên đi nhón gót có liên quan đến khả năng giữ thăng bằng kém không?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Có. Đi nhón gót thường là phản xạ tự nhiên khi hệ thống cảm thụ bản thể hoặc hệ tiền đình của trẻ bị rối loạn. Trẻ dùng mũi chân để thu thập thêm phản hồi cảm giác từ mặt đất, cố gắng tạo ra sự ổn định giả tạo cho một cơ thể đang cảm thấy chông chênh, thiếu thăng bằng.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Làm sao để phân biệt sự lóng ngóng do tự kỷ và bệnh lý xương khớp?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Sự lóng ngóng do tự kỷ thường đi kèm với các dấu hiệu chậm phát triển thần kinh khác như khó khăn trong giao tiếp, né tránh giao tiếp mắt hoặc có hành vi lặp lại. Bệnh lý xương khớp thường gây đau đớn rõ rệt tại một vùng. Luôn cần đưa con đi khám chuyên khoa để loại trừ bệnh lý thực thể.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Các bài tập với bóng yoga có an toàn cho trẻ có trương lực cơ thấp không?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Hoàn toàn an toàn nếu thực hiện đúng cách và có giám sát sát sao. Ngồi hoặc nằm sấp trên bóng yoga bập bênh nhẹ nhàng là bài tập tuyệt vời giúp kích thích cơ cốt lõi hoạt động, cải thiện trương lực cơ mà không gây áp lực mạnh lên khớp xương.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Mất bao lâu để thấy kết quả cải thiện thăng bằng tại nhà?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Sự tiến bộ ở mỗi trẻ là hoàn toàn khác nhau. Một số trẻ có thể bắt đầu đi vững hơn sau vài tuần rèn luyện nhịp nhàng, trong khi số khác cần nhiều tháng can thiệp liên tục. Điều quan trọng là cha mẹ cần ghi nhận và ăn mừng mọi bước tiến nhỏ nhất của con.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- SECTION 7: DISCLAIMER -->
    <section class="bg-gray-100 py-8 px-6 text-center border-t border-gray-200">
        <div class="max-w-4xl mx-auto">
            <p class="text-text-soft text-sm italic font-medium">
                ⚠️ Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
            </p>
        </div>
    </section>
</main>

<!-- FOOTER: NGUỒN TÀI LIỆU -->
<footer class="bg-gray-50 py-16 px-6 border-t border-gray-200">
    <div class="max-w-5xl mx-auto">
        <h4 class="font-oswald text-navy text-lg uppercase tracking-wider font-semibold mb-8 text-center md:text-left">Nguồn tài liệu tham khảo y khoa</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-3 text-xs text-text-soft font-quicksand break-words opacity-80 hover:opacity-100 transition-opacity">
            <p>[1] Healthline: <a href="https://www.healthline.com/health/autism/motor-skills" class="hover:text-navy underline">Link</a></p>
            <p>[2] Verywell Health: <a href="https://www.verywellhealth.com/autism-and-clumsiness-260303" class="hover:text-navy underline">Link</a></p>
            <p>[3] Medical News Today: <a href="https://www.medicalnewstoday.com/articles/autism-and-motor-skills" class="hover:text-navy underline">Link</a></p>
            <p>[4] Psychology Today: <a href="https://www.psychologytoday.com/us/blog/child-development-and-behavior/autism-and-motor-skills" class="hover:text-navy underline">Link</a></p>
            <p>[5] ADDitude: <a href="https://www.additudemag.com/motor-skills-autism-adhd-children/" class="hover:text-navy underline">Link</a></p>
            <p>[6] Understood: <a href="https://www.understood.org/en/articles/understanding-motor-skills-and-autism" class="hover:text-navy underline">Link</a></p>
            <p>[7] Autism Speaks: <a href="https://www.autismspeaks.org/motor-challenges-autism" class="hover:text-navy underline">Link</a></p>
            <p>[8] Child Mind Institute: <a href="https://childmind.org/article/autism-and-motor-skills/" class="hover:text-navy underline">Link</a></p>
            <p>[9] National Autistic Society: <a href="https://www.autism.org.uk/advice-and-guidance/topics/physical-health/motor-difficulties" class="hover:text-navy underline">Link</a></p>
            <p>[10] CDC: <a href="https://www.cdc.gov/ncbddd/autism/signs.html" class="hover:text-navy underline">Link</a></p>
            <p>[11] The OT Toolbox: <a href="https://www.theottoolbox.com/autism-and-balance/" class="hover:text-navy underline">Link</a></p>
            <p>[12] Harkla: <a href="https://harkla.co/blogs/special-needs/autism-balance" class="hover:text-navy underline">Link</a></p>
        </div>
    </div>
</footer>
<?php get_footer(); ?>