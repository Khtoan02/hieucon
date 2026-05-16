<?php /* Template Name: Tre_Tu_Ky_Kho_Leo_Cau_Thang_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tại sao trẻ tự kỷ khó leo cầu thang và cách cha mẹ hỗ trợ con</title>
    <meta name="description" content="Trẻ tự kỷ khó leo cầu thang không phải do con lười biếng mà thường xuất phát từ những rào cản vô hình về vận động và cảm giác. Khám phá cách giúp con tự tin hơn.">
    
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
                    Trẻ Tự Kỷ <span class="text-yellow">Khó Leo Cầu Thang</span> Và Những Rào Cản Vô Hình
                </h1>
                <p class="text-cream font-quicksand text-lg md:text-xl leading-relaxed mb-10 opacity-90 font-light">
                    Nhìn thấy con chần chừ, khóc lóc hoặc khựng lại trước những bậc cầu thang, nhiều bậc cha mẹ không khỏi xót xa. Sự thật là hiện tượng này không bắt nguồn từ sự lười biếng, mà là do những rào cản về thần kinh, cảm giác mà con đang âm thầm đối mặt.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all text-center uppercase tracking-wide">
                        Kiểm Tra Sức Khỏe Toàn Diện
                    </a>
                </div>
            </div>
            <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-tr from-yellow/20 to-transparent rounded-3xl transform rotate-3 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hero_stairs_1778927721326.png" alt="Cha mẹ hỗ trợ con bước lên bậc thềm" class="relative rounded-3xl shadow-2xl border border-white/10 object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- SECTION 1: NGUYÊN NHÂN -->
    <section class="bg-white py-20 md:py-32 px-6 relative">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Cơ Chế Khoa Học</span>
                <h2 class="text-navy font-oswald text-3xl md:text-4xl lg:text-5xl font-semibold mb-6 leading-snug">
                    Thấu hiểu nguyên nhân sâu xa
                </h2>
                <p class="text-text-dark text-lg">
                    Sự phát triển vận động của trẻ trên phổ tự kỷ thường diễn ra theo một nhịp độ rất riêng. Việc di chuyển trên địa hình không bằng phẳng như cầu thang đòi hỏi sự phối hợp phức tạp của nhiều cơ quan.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-5 relative order-2 lg:order-1">
                    <div class="absolute inset-0 bg-navy/5 rounded-[2rem] transform -rotate-3 scale-105"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/cause_stairs_1778927736663.png" alt="Hệ thần kinh và vận động" class="relative rounded-[2rem] shadow-xl border border-white w-full h-auto" />
                </div>
                
                <div class="lg:col-span-7 grid grid-cols-1 md:grid-cols-2 gap-6 order-1 lg:order-2">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-14 h-14 rounded-xl bg-blue-50 flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-blue-100 transition-transform">🦵</div>
                        <h3 class="text-navy font-oswald text-xl font-semibold mb-3">
                            Trương lực cơ thấp
                        </h3>
                        <p class="text-text-soft leading-relaxed text-sm">
                            Khiến con tiêu hao nhiều năng lượng hơn bình thường chỉ để nhấc chân lên bậc thềm tiếp theo, dẫn đến việc kiệt sức và từ chối leo cầu thang.
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group">
                        <div class="w-14 h-14 rounded-xl bg-yellow/10 flex items-center justify-center text-2xl mb-6 group-hover:scale-110 group-hover:bg-yellow/20 transition-transform">⚖️</div>
                        <h3 class="text-navy font-oswald text-xl font-semibold mb-3">
                            Rối loạn tiền đình
                        </h3>
                        <p class="text-text-soft leading-relaxed text-sm">
                            Hệ tiền đình nhạy cảm khiến thông tin không gian bị sai lệch, làm con khó đánh giá khoảng cách và độ cao, sinh ra cảm giác hoảng loạn.
                        </p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 group md:col-span-2">
                        <div class="flex items-start gap-6">
                            <div class="w-14 h-14 rounded-xl bg-green-50 flex items-center justify-center text-2xl group-hover:scale-110 group-hover:bg-green-100 transition-transform shrink-0">🧠</div>
                            <div>
                                <h3 class="text-navy font-oswald text-xl font-semibold mb-2">
                                    Chứng khó vận động (Dyspraxia)
                                </h3>
                                <p class="text-text-soft leading-relaxed text-sm mb-3">
                                    Khiến não bộ gặp trục trặc trong việc gửi tín hiệu chỉ đạo cơ bắp thực hiện chuỗi hành động đúng thứ tự. Chuỗi mệnh lệnh leo cầu thang bị đứt gãy khiến con lóng ngóng.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: MỐI LIÊN HỆ -->
    <section class="bg-cream py-20 md:py-32 px-6 border-y border-gray-50">
        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold mb-6 leading-snug">
                        Mối liên hệ giữa vận động và phát triển toàn diện
                    </h2>
                    <p class="text-text-dark text-lg mb-8">
                        Sự tự do trong di chuyển chính là nền tảng vững chắc để trẻ tự kỷ khám phá thế giới, phát triển nhận thức và tự tin hơn trong các tương tác xã hội.
                    </p>
                    <div class="space-y-6">
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h4 class="font-oswald text-navy font-semibold text-lg mb-2">Đánh giá kỹ năng vận động sớm</h4>
                            <p class="text-text-soft text-sm leading-relaxed mb-2">
                                Giúp cha mẹ xác định đúng rào cản cơ bắp để can thiệp kịp thời, giải phóng năng lượng ứ đọng an toàn.
                            </p>
                            <a href="https://hieucontugoc.online/van-dong-tho-tinh-o-tre-tu-ky" class="text-navy font-bold hover:text-blue-600 transition-colors inline-flex items-center text-sm">
                                Vận động thô & tinh ở trẻ tự kỷ <span class="ml-1">→</span>
                            </a>
                        </div>
                        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                            <h4 class="font-oswald text-navy font-semibold text-lg mb-2">Nguy cơ tiềm ẩn khi thiếu vững vàng</h4>
                            <p class="text-text-soft text-sm leading-relaxed mb-2">
                                Không chỉ gây rủi ro an toàn mà còn hình thành tâm lý tự ti, chối bỏ hoạt động tập thể.
                            </p>
                            <a href="https://hieucontugoc.online/tre-tu-ky-hay-nga-thang-bang-kem" class="text-navy font-bold hover:text-blue-600 transition-colors inline-flex items-center text-sm">
                                Trẻ tự kỷ hay ngã, thăng bằng kém <span class="ml-1">→</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="relative group">
                    <div class="absolute -inset-4 bg-gradient-to-r from-blue-100 to-yellow/20 rounded-[2.5rem] transform rotate-2 group-hover:rotate-0 transition-transform duration-500 ease-in-out z-0"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/importance_stairs_1778927753149.png" alt="Trẻ em tự tin khám phá" class="relative rounded-[2rem] shadow-lg w-full h-auto z-10" />
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: GIẢI PHÁP -->
    <section class="bg-white py-20 md:py-32 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Thực Hành & Yêu Thương</span>
                <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold mb-6 leading-snug">
                    Giải pháp an toàn giúp con bước qua nỗi sợ
                </h2>
                <p class="text-text-dark text-lg">
                    Thay vì lo lắng và thúc ép, cha mẹ có thể trở thành người bạn đồng hành an toàn nhất.
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-16">
                <div class="order-2 lg:order-1 relative">
                    <div class="absolute inset-0 bg-gradient-to-bl from-yellow/30 to-blue-500/10 rounded-[2rem] transform -rotate-2 scale-105 filter blur-sm"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/solution_stairs_1778927766558.png" alt="Giải pháp tập luyện cho trẻ" class="relative rounded-[2rem] shadow-xl w-full h-auto border-2 border-white" />
                </div>
                <div class="order-1 lg:order-2 space-y-6">
                    <!-- Step 1 -->
                    <div class="bg-cream rounded-2xl p-6 shadow-sm flex gap-6 relative overflow-hidden group">
                        <div class="absolute left-0 top-0 w-1.5 h-full bg-yellow"></div>
                        <div class="text-4xl group-hover:scale-110 transition-transform">1️⃣</div>
                        <div>
                            <h3 class="font-oswald text-navy text-xl font-semibold mb-2">Chuẩn bị tâm lý và không gian</h3>
                            <p class="text-text-soft leading-relaxed text-sm">Bắt đầu từ những bậc thềm rất thấp, bề mặt không trơn trượt. Cho phép con bò, ngồi lết nếu con thấy an toàn. Trang bị thảm xốp ở chân cầu thang.</p>
                        </div>
                    </div>
                    <!-- Step 2 -->
                    <div class="bg-cream rounded-2xl p-6 shadow-sm flex gap-6 relative overflow-hidden group">
                        <div class="absolute left-0 top-0 w-1.5 h-full bg-blue-400"></div>
                        <div class="text-4xl group-hover:scale-110 transition-transform">2️⃣</div>
                        <div>
                            <h3 class="font-oswald text-navy text-xl font-semibold mb-2">Chia nhỏ các bước tập luyện</h3>
                            <p class="text-text-soft leading-relaxed text-sm">Thực hành bước qua chướng ngại vật nhỏ như gối ném, hộp xốp. Đặt đồ chơi ở bậc thang thứ nhất hoặc thứ hai để khơi gợi sự tò mò.</p>
                        </div>
                    </div>
                    <!-- Step 3 -->
                    <div class="bg-cream rounded-2xl p-6 shadow-sm flex gap-6 relative overflow-hidden group">
                        <div class="absolute left-0 top-0 w-1.5 h-full bg-green-400"></div>
                        <div class="text-4xl group-hover:scale-110 transition-transform">3️⃣</div>
                        <div>
                            <h3 class="font-oswald text-navy text-xl font-semibold mb-2">Can thiệp chuyên gia</h3>
                            <p class="text-text-soft leading-relaxed text-sm">Khi nỗ lực tại nhà chưa cải thiện, chuyên gia vật lý trị liệu sẽ dùng dụng cụ chuyên dụng (bóng gai, xích đu) để tăng sức mạnh lõi và cân bằng tiền đình.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: CTA -->
    <section class="bg-navy py-20 px-6 text-center relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-10">
            <div class="absolute top-0 right-0 w-full h-full bg-[radial-gradient(ellipse_at_center,_var(--tw-gradient-stops))] from-white via-navy to-navy"></div>
        </div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="text-white font-oswald text-3xl md:text-5xl font-semibold mb-6 leading-snug">
                Lắng nghe cơ thể con qua bài kiểm tra sức khỏe
            </h2>
            <p class="text-white/80 text-lg leading-relaxed mb-10 max-w-2xl mx-auto">
                Việc chờ đợi con tự "lớn lên rồi sẽ cứng cáp" đôi khi làm lỡ mất giai đoạn vàng để can thiệp hỗ trợ. Hãy rà soát lại các mốc phát triển ngay hôm nay.
            </p>
            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-10 py-5 rounded-xl shadow-lg hover:bg-white hover:-translate-y-1 transition-all inline-block uppercase tracking-wide">
                Hoàn Thành Bảng Kiểm Tra Sức Khỏe
            </a>
        </div>
    </section>

    <!-- SECTION 5: FAQ -->
    <section class="bg-white py-20 md:py-32 px-6">
        <div class="max-w-3xl mx-auto">
            <div class="text-center mb-12">
                <span class="text-navy/60 font-oswald font-semibold tracking-wider uppercase text-sm mb-2 block">Hỏi & Đáp</span>
                <h2 class="text-navy font-oswald text-3xl md:text-4xl font-semibold">
                    Câu hỏi thường gặp
                </h2>
            </div>
            
            <div class="space-y-4">
                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Trẻ tự kỷ mấy tuổi mới biết leo cầu thang độc lập?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Sự phát triển ở mỗi trẻ là khác nhau. Trẻ bình thường có thể leo cầu thang bằng hai chân trên mỗi bậc ở khoảng 2 tuổi và bước luân phiên ở 3-4 tuổi. Tuy nhiên, trẻ tự kỷ có thể chậm hơn từ 1 đến 2 năm. Cha mẹ không nên so sánh mà cần theo dõi sự tiến bộ so với chính bản thân trẻ.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Việc con đi kiễng gót có liên quan đến việc khó leo cầu thang không?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Có. Đi kiễng gót làm giảm diện tích tiếp xúc của bàn chân với mặt đất, làm giảm khả năng giữ thăng bằng và khiến việc bước lên bậc thang trở nên vô cùng khó khăn và thiếu an toàn.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Tôi có nên bế con qua những bậc cầu thang khi con khóc lóc không?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Trong lúc hoảng loạn, việc bế con để đảm bảo an toàn tâm lý là cần thiết. Tuy nhiên, về lâu dài, hãy bắt đầu từ việc nắm chặt tay con bước 1-2 bậc đầu tiên, sau đó mới bế, để con dần quen với cảm giác bề mặt.
                    </div>
                </details>

                <details class="group bg-gray-50 rounded-2xl border border-gray-100 open:bg-white open:ring-1 open:ring-navy/10 open:shadow-md transition-all duration-300">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center list-none">
                        Có bài tập đơn giản tại nhà giúp con tăng cường sức mạnh đôi chân không?
                        <span class="text-navy/50 text-2xl group-open:rotate-45 group-open:text-yellow transition-all duration-300 transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-soft font-quicksand leading-relaxed">
                        Bài tập bật nhảy trên đệm lò xo mini (trampoline) có tay vịn là một lựa chọn tuyệt vời. Nó giúp tăng cường trương lực cơ chân, cải thiện thăng bằng và cung cấp đầu vào cảm giác cho hệ tiền đình.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- DISCLAIMER -->
    <section class="bg-gray-100 py-8 px-6 text-center border-t border-gray-200">
        <div class="max-w-4xl mx-auto">
            <p class="text-text-soft text-sm italic font-medium">
                ⚠️ Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
            </p>
        </div>
    </section>

</main>

<!-- NGUỒN THAM KHẢO -->
<footer class="bg-gray-50 py-16 px-6 border-t border-gray-200">
    <div class="max-w-5xl mx-auto">
        <h4 class="font-oswald text-navy text-lg uppercase tracking-wider font-semibold mb-8 text-center md:text-left">Nguồn tham khảo tài liệu uy tín</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-3 text-xs text-text-soft font-quicksand break-words opacity-80 hover:opacity-100 transition-opacity">
            <p>[1] Understood - Gross motor skills.</p>
            <p>[2] Verywell Family - Gross Motor Skills.</p>
            <p>[3] Child Mind Institute - Dyspraxia.</p>
            <p>[4] Healthline - Autism and Clumsiness.</p>
            <p>[5] Psychology Today - Motor Skills.</p>
            <p>[6] CDC - Signs and Symptoms.</p>
            <p>[7] Autism Speaks - Physical Therapy.</p>
            <p>[8] National Autistic Society - Motor skills.</p>
            <p>[9] AOTA - Occupational Therapy.</p>
            <p>[10] Spectrum News - Motor difficulties.</p>
            <p>[11] The OT Toolbox - Gross Motor Skills.</p>
            <p>[12] Your Therapy Source - Stair Climbing.</p>
            <p>[13] NAPA Center - Hypotonia in Autism.</p>
            <p>[14] Pediatric APTA - Fact Sheet.</p>
            <p>[15] ARK Therapeutic - Gross Motor.</p>
            <p>[16] The Mighty - Community stories.</p>
            <p>[17] Autism Forums - Discussions.</p>
            <p>[18] Autistic Not Weird - Navigating.</p>
            <p>[19] Autism Speaks Community.</p>
            <p>[20] Reddit (r/Autism_Parenting).</p>
        </div>
    </div>
</footer>

<?php get_footer(); ?>