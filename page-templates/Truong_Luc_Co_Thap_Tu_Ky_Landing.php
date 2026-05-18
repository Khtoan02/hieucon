<?php /* Template Name: Truong_Luc_Co_Thap_Tu_Ky_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trương lực cơ thấp & tự kỷ có mối liên hệ như thế nào?</title>
    <meta name="description" content="Khám phá mối liên hệ sinh học giữa trương lực cơ thấp & tự kỷ. Hiểu lý do trẻ tự kỷ hay ngã, thăng bằng kém và cách vật lý trị liệu giúp con phát triển.">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
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
        body { background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; line-height: 1.4 !important; }
        /* Smooth scrolling and hide detail marker */
        html { scroll-behavior: smooth; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="font-quicksand text-text-dark bg-white antialiased">

    <!-- HERO SECTION -->
    <header class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden" id="hero-section">
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden z-0">
            <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#2563eb] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[blob_7s_infinite]"></div>
            <div class="absolute top-1/4 -right-24 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[blob_7s_infinite_2s]"></div>
        </div>
        
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="text-left">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[rgba(255,255,255,0.1)] backdrop-blur-md border border-solid border-[rgba(255,255,255,0.2)] text-cream text-sm font-semibold mb-6">
                    <span class="w-2 h-2 rounded-full bg-yellow animate-pulse"></span>
                    Góc Nhìn Chuyên Gia
                </div>
                <h1 class="font-oswald text-4xl md:text-5xl lg:text-5xl font-bold leading-tight uppercase mb-6 text-white tracking-wide">
                    HIỂU ĐÚNG VỀ MỐI LIÊN HỆ ÍT AI BIẾT GIỮA TRƯƠNG LỰC CƠ THẤP VÀ TỰ KỶ Ở TRẺ
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Hành trình đồng hành cùng con mang phổ tự kỷ luôn đầy ắp những câu hỏi mà đôi khi cha mẹ chưa tìm thấy lời giải đáp thỏa đáng. Sự thật là sự lóng ngóng, hay vấp ngã hoàn toàn không phải do con lười biếng. Đây là một đặc điểm thể chất đi kèm thường gặp đòi hỏi sự thấu hiểu sâu sắc từ gia đình.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Thực Hiện Bảng Kiểm Tra Sức Khỏe Toàn Diện
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/hypotonia_hero_img_1779077438480.png" alt="Trương lực cơ thấp và tự kỷ" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </header>

    <main>
        <!-- SECTION 1: NỖI ĐAU & HIỂU LẦM (Nền Trắng) -->
        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6 leading-tight">Tại sao cha mẹ thường hiểu lầm khi thấy con đi lại lóng ngóng và hay vấp ngã</h2>
                    <p class="font-quicksand text-text-dark text-lg mb-4 leading-relaxed">Trong cuộc sống hàng ngày, không hiếm những khoảnh khắc cha mẹ cảm thấy bối rối hoặc chạnh lòng khi quan sát con chơi đùa cùng bạn bè. Có thể con chạy chậm hơn, thường xuyên vấp ngã trên mặt phẳng, hoặc từ chối tham gia các trò chơi vận động mạnh.</p>
                    <p class="font-quicksand text-text-dark text-lg leading-relaxed">Những biểu hiện này rất dễ khiến những người xung quanh, hoặc thậm chí là chính cha mẹ, nảy sinh những suy nghĩ hiểu lầm cho rằng trẻ chỉ đang làm nũng. Những phán xét vô tình đó thường tạo ra áp lực vô hình, khiến cha mẹ tự trách bản thân và ép con phải tập luyện theo những cách không phù hợp.</p>
                </div>
                <div class="bg-cream p-10 rounded-2xl shadow-sm border-l-4 border-yellow flex flex-col justify-center h-full">
                    <p class="font-quicksand text-navy text-xl italic font-medium leading-relaxed">
                        "Cơ thể của con đang thực sự phải làm việc chăm chỉ gấp nhiều lần so với những đứa trẻ khác chỉ để duy trì một tư thế đứng thẳng hoặc bước đi bình thường. Khi hiểu được điều này, cha mẹ sẽ cất đi được gánh nặng tự trách và bắt đầu nhìn nhận những khó khăn của con dưới lăng kính của sự bao dung."
                    </p>
                </div>
            </div>
        </section>

        <!-- SECTION 2: CƠ CHẾ KHOA HỌC (Nền Cream) -->
        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto text-center mb-16">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6">Giải mã hiện tượng trương lực cơ thấp dưới góc nhìn khoa học nhưng dễ hiểu</h2>
                <p class="font-quicksand text-text-soft text-lg max-w-3xl mx-auto leading-relaxed">Hiện tượng trương lực cơ thấp (hypotonia) là một tình trạng y khoa mô tả sự giảm sút lực căng cơ bản của cơ bắp ngay cả khi cơ thể đang ở trạng thái nghỉ ngơi. Ở trẻ mang phổ tự kỷ, điều này diễn ra như một rào cản sinh lý cần sự tiếp cận đặc thù.</p>
            </div>
            
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-10 rounded-2xl shadow-md transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="text-5xl mb-6">💪</div>
                    <h3 class="font-oswald text-navy text-2xl font-bold mb-4 leading-snug">Biểu hiện cơ bắp nhão và lỏng lẻo hoàn toàn không phải do con lười vận động</h3>
                    <p class="font-quicksand text-text-dark text-lg leading-relaxed">Trương lực cơ là một trạng thái vô thức được điều khiển bởi bộ não. Khi tín hiệu từ não truyền đến cơ bắp bị gián đoạn, cơ bắp sẽ không thể duy trì độ săn chắc. Việc ép trẻ tham gia các bài tập thể lực cường độ cao thường không mang lại hiệu quả mà còn khiến trẻ kiệt sức.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-10 rounded-2xl shadow-md transform hover:-translate-y-1 transition-transform duration-300">
                    <div class="text-5xl mb-6">🧠</div>
                    <h3 class="font-oswald text-navy text-2xl font-bold mb-4 leading-snug">Tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-hay-nga-thang-bang-kem" class="underline hover:text-yellow transition-colors" target="_blank">trẻ tự kỷ hay ngã, thăng bằng kém</a> bắt nguồn từ sự điều phối của hệ thần kinh</h3>
                    <p class="font-quicksand text-text-dark text-lg leading-relaxed">Khi trương lực cơ yếu, cơ thể con không nhận đủ phản hồi từ các khớp để biết vị trí của mình trong không gian. Con vấp ngã không phải vì không chú ý, mà vì cơ thể phản ứng chậm nhịp hơn so với sự biến đổi của môi trường xung quanh.</p>
                </div>
            </div>
        </section>

        <!-- SECTION 3: DẤU HIỆU NHẬN BIẾT (Nền Trắng) -->
        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto text-center mb-16">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6">Nhận diện những dấu hiệu thể chất âm thầm báo hiệu sự yếu ớt của hệ cơ bắp</h2>
                <p class="font-quicksand text-text-soft text-lg max-w-3xl mx-auto leading-relaxed">Cơ thể trẻ luôn có cách tự điều chỉnh và lên tiếng thông qua những thói quen vô thức. Việc phát hiện sớm tình trạng yếu cơ đến từ chính sự quan sát tinh tế của cha mẹ trong sinh hoạt thường ngày.</p>
            </div>

            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Card Dấu hiệu 1 -->
                <div class="bg-cream p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-5">🧘</div>
                    <h3 class="font-oswald text-navy text-xl font-bold mb-3 leading-snug">Thói quen ngồi tư thế chữ W giúp con tự bù đắp sự thiếu hụt vững chắc ở phần thân trung tâm</h3>
                    <p class="font-quicksand text-text-dark leading-relaxed">Khi cơ bụng và lưng không đủ khỏe, tư thế chữ W mang lại mặt chân đế rộng, giúp con cảm thấy vững chãi mà không cần dùng sức. Dù vậy, thói quen này cần được điều chỉnh từ từ để bảo vệ xương khớp.</p>
                </div>
                <!-- Card Dấu hiệu 2 -->
                <div class="bg-cream p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-5">🥱</div>
                    <h3 class="font-oswald text-navy text-xl font-bold mb-3 leading-snug">Trẻ mau mệt mỏi và thường xuyên muốn nằm ườn ra bàn ngay cả khi đang chơi hoặc học</h3>
                    <p class="font-quicksand text-text-dark leading-relaxed">Mỗi cử động nhỏ đều đòi hỏi nỗ lực lớn khiến năng lượng sụt giảm. Trẻ tựa đầu gục xuống bàn không phải vì chán nản, mà đó là cách cơ thể "đình công" đòi nghỉ ngơi do hệ cơ bắp đã làm việc quá tải.</p>
                </div>
                <!-- Card Dấu hiệu 3 -->
                <div class="bg-cream p-8 rounded-2xl shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-5">🖐️</div>
                    <h3 class="font-oswald text-navy text-xl font-bold mb-3 leading-snug">Những khó khăn trong vận động tinh khiến con chật vật khi cầm bút hay cài khuy áo</h3>
                    <p class="font-quicksand text-text-dark leading-relaxed">Sự yếu ớt lan sang cả đôi bàn tay. Trẻ gặp khó khăn cầm thìa, tô màu, hay cài khuy áo. Sự thiếu hụt sức mạnh ngón tay khiến các công việc tỉ mỉ trở thành thử thách, làm con dễ cáu gắt và lảng tránh.</p>
                </div>
            </div>
        </section>

        <!-- SECTION 4: GIẢI PHÁP TRỊ LIỆU (Nền Cream) -->
        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6 leading-tight">Vai trò của <a href="https://hieucontugoc.online/vat-ly-tri-lieu-tre-tu-ky" class="underline hover:text-yellow transition-colors" target="_blank">vật lý trị liệu trẻ tự kỷ</a> trong việc xây dựng nền tảng thể chất vững vàng</h2>
                    <p class="font-quicksand text-text-dark text-lg mb-6 leading-relaxed">Không thể áp dụng những bài tập thể dục thông thường cho trẻ. Thay vào đó, sự can thiệp của chuyên môn thông qua vật lý trị liệu sẽ đánh thức sự liên kết giữa não bộ và cơ bắp, giúp con cải thiện qua từng trò chơi vận động có chủ đích.</p>
                    
                    <ul class="space-y-5">
                        <li class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                            <svg class="w-6 h-6 text-yellow mt-1 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="font-quicksand text-text-dark text-lg font-medium">Tăng cường sức mạnh cho vùng cơ lõi bao gồm cơ bụng và cơ lưng.</span>
                        </li>
                        <li class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                            <svg class="w-6 h-6 text-yellow mt-1 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="font-quicksand text-text-dark text-lg font-medium">Cải thiện khả năng cảm thụ bản thể, giúp con nhận biết tư thế cơ thể tốt hơn.</span>
                        </li>
                        <li class="flex items-start bg-white p-4 rounded-xl shadow-sm">
                            <svg class="w-6 h-6 text-yellow mt-1 mr-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                            <span class="font-quicksand text-text-dark text-lg font-medium">Khuyến khích con chủ động vận động thông qua niềm vui, không gượng ép.</span>
                        </li>
                    </ul>
                </div>
                <div class="bg-white p-10 rounded-3xl shadow-md border-t-8 border-yellow h-full flex flex-col items-center justify-center text-center">
                    <div class="text-7xl mb-6">🤸‍♂️</div>
                    <p class="font-oswald text-navy text-2xl font-bold leading-relaxed">"Những thay đổi nhỏ bé mỗi ngày từ các buổi trị liệu sẽ tích tiểu thành đại, mang lại cho con sự tự tin lớn lao trong mỗi bước chân."</p>
                </div>
            </div>
        </section>

        <!-- SECTION 5: CTA VÀ BƯỚC ĐI ĐẦU TIÊN (Nền Trắng) -->
        <section class="bg-white py-16 md:py-24 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6">Bước đi đầu tiên cha mẹ cần làm để đồng hành cùng con một cách khoa học và an toàn</h2>
                <p class="font-quicksand text-text-dark text-lg mb-12 leading-relaxed">Mỗi em bé là một cá thể độc bản. Khó khăn vận động của con cần được phân tích trong một bức tranh tổng thể về sức khỏe thể chất lẫn tinh thần. Trước khi tự lên lịch tập luyện, việc có một cái nhìn bao quát về tình trạng của con là cực kỳ thiết yếu.</p>
                
                <div class="bg-cream p-10 md:p-14 rounded-3xl shadow-lg border-2 border-yellow relative overflow-hidden">
                    <div class="absolute top-0 right-0 -mt-8 -mr-8 w-32 h-32 bg-yellow opacity-20 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-0 left-0 -mb-8 -ml-8 w-32 h-32 bg-navy opacity-10 rounded-full blur-2xl"></div>
                    
                    <h3 class="font-oswald text-navy text-2xl md:text-3xl font-bold mb-4 relative z-10">Tầm quan trọng của việc thực hiện bảng kiểm tra sức khỏe toàn diện trước khi can thiệp</h3>
                    <p class="font-quicksand text-text-dark text-lg mb-10 max-w-2xl mx-auto relative z-10 leading-relaxed">Dựa trên những thông tin chi tiết từ bảng kiểm tra, gia đình và các chuyên gia mới có thể cùng nhau vẽ ra một lộ trình can thiệp an toàn, phù hợp nhất với thể trạng và nhịp độ phát triển riêng biệt của con.</p>
                    
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-5 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg md:text-xl uppercase tracking-wider relative z-10">
                        Thực Hiện Bảng Kiểm Tra Sức Khỏe Ngay
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION 6: FAQ ACCORDION (Nền Cream) -->
        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-12 text-center">Những băn khoăn thường gặp của cha mẹ về thể chất của trẻ tự kỷ</h2>
                
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-xl p-6 cursor-pointer font-semibold relative flex justify-between items-center">
                            Hiện tượng trương lực cơ thấp có thể tự biến mất khi trẻ lớn lên không?
                            <span class="transition-transform duration-300 group-open:rotate-180 flex-shrink-0 ml-4">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" class="text-yellow"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 pt-2 font-quicksand text-text-dark text-lg leading-relaxed border-t border-gray-100">
                            Tình trạng này không tự biến mất hoàn toàn theo thời gian. Tuy nhiên, với sự can thiệp sớm thông qua vật lý trị liệu và các hoạt động phù hợp, sức mạnh cơ bắp và khả năng vận động của trẻ sẽ được cải thiện đáng kể, giúp con hòa nhập và sinh hoạt tự lập hơn.
                        </div>
                    </details>

                    <!-- FAQ 2 -->
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-xl p-6 cursor-pointer font-semibold relative flex justify-between items-center">
                            Việc con ngồi tư thế chữ W có thực sự nguy hiểm không?
                            <span class="transition-transform duration-300 group-open:rotate-180 flex-shrink-0 ml-4">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" class="text-yellow"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 pt-2 font-quicksand text-text-dark text-lg leading-relaxed border-t border-gray-100">
                            Ngồi tư thế chữ W một cách thường xuyên và kéo dài có thể gây áp lực lên khớp hông, đầu gối và mắt cá chân, đồng thời hạn chế sự phát triển của cơ lõi. Cha mẹ nên nhẹ nhàng nhắc nhở và khuyến khích con chuyển sang các tư thế ngồi khác như ngồi khoanh chân hoặc ngồi trên ghế nhỏ.
                        </div>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-xl p-6 cursor-pointer font-semibold relative flex justify-between items-center">
                            Trương lực cơ thấp có ảnh hưởng đến khả năng học nói của con không?
                            <span class="transition-transform duration-300 group-open:rotate-180 flex-shrink-0 ml-4">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" class="text-yellow"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 pt-2 font-quicksand text-text-dark text-lg leading-relaxed border-t border-gray-100">
                            Có thể ảnh hưởng. Việc phát âm đòi hỏi sự phối hợp tinh vi của các cơ vùng miệng, hàm và lưỡi. Khi lực cơ vùng này yếu, trẻ có thể gặp khó khăn trong việc nhai nuốt và bật âm rõ ràng. Trị liệu ngôn ngữ kết hợp với bài tập cơ miệng sẽ giúp cải thiện tình trạng này.
                        </div>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-xl p-6 cursor-pointer font-semibold relative flex justify-between items-center">
                            Cha mẹ có thể làm gì tại nhà để giúp con cải thiện thăng bằng?
                            <span class="transition-transform duration-300 group-open:rotate-180 flex-shrink-0 ml-4">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" class="text-yellow"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 pt-2 font-quicksand text-text-dark text-lg leading-relaxed border-t border-gray-100">
                            Cha mẹ có thể tạo ra những chướng ngại vật an toàn bằng gối mềm trong phòng khách, cùng con chơi trò bò qua đường hầm, hoặc khuyến khích con tham gia các hoạt động bơi lội nhẹ nhàng. Điều quan trọng nhất là biến mọi bài tập thành một trò chơi vui nhộn.
                        </div>
                    </details>

                    <!-- FAQ 5 -->
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-xl p-6 cursor-pointer font-semibold relative flex justify-between items-center">
                            Có phải mọi trẻ em mang phổ tự kỷ đều bị yếu cơ không?
                            <span class="transition-transform duration-300 group-open:rotate-180 flex-shrink-0 ml-4">
                                <svg fill="none" height="24" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" class="text-yellow"><path d="M6 9l6 6 6-6"></path></svg>
                            </span>
                        </summary>
                        <div class="px-6 pb-6 pt-2 font-quicksand text-text-dark text-lg leading-relaxed border-t border-gray-100">
                            Không phải tất cả. Đây là một đặc điểm đi kèm khá phổ biến, nhưng mỗi trẻ tự kỷ có một hồ sơ phát triển riêng biệt. Có những trẻ sở hữu kỹ năng vận động tuyệt vời, trong khi số khác lại gặp nhiều thách thức về thể chất.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- DISCLAIMER SECTION -->
        <section class="bg-gray-100 pb-12 pt-12 px-6 text-center border-t border-gray-200">
            <div class="max-w-4xl mx-auto">
                <p class="font-quicksand text-text-soft text-sm italic">
                    Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
                </p>
            </div>
        </section>
    </main>

    <!-- FOOTER / NGUỒN THAM KHẢO -->
    <footer class="bg-gray-100 py-12 px-5 text-sm text-text-soft border-t border-gray-200">
        <div class="max-w-6xl mx-auto">
            <h4 class="font-oswald text-navy text-lg font-bold mb-4 uppercase">Nguồn Tham Khảo Y Khoa & Cộng Đồng Uy Tín:</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 font-quicksand">
                <ul class="space-y-2">
                    <li>[1] Psych Central: Autism and Low Muscle Tone (Hypotonia)</li>
                    <li>[2] Healthline: Hypotonia and Autism: What’s the Connection?</li>
                    <li>[3] Medical News Today: What is the link between autism and hypotonia?</li>
                    <li>[4] Parents: Early Signs of Autism in Infants and Toddlers</li>
                    <li>[5] Child Mind Institute: Early Signs of Autism</li>
                    <li>[6] Autism Speaks: Physical Conditions Associated with Autism</li>
                    <li>[7] Understood: What is low muscle tone?</li>
                    <li>[8] Autism.org: Motor Skills & Autism</li>
                    <li>[9] Pathfinders for Autism: Physical Therapy for Autism</li>
                    <li>[10] AANE: Motor Challenges and Autism</li>
                </ul>
                <ul class="space-y-2">
                    <li>[11] NAPA Center: Low Muscle Tone and Autism</li>
                    <li>[12] Harkla: Autism and Hypotonia - What You Need to Know</li>
                    <li>[13] Cheshire Pediatric Therapy: Low Muscle Tone (Hypotonia) & Autism</li>
                    <li>[14] OccupationalTherapy.com: Autism and Motor Skills</li>
                    <li>[15] Theraplay: How Physical Therapy Helps Children With Autism</li>
                    <li>[16] The Autism Cafe: Hypotonia (Low Muscle Tone) & Autism</li>
                    <li>[17] Finding Cooper's Voice: The Physical Side of Autism</li>
                    <li>[18] Autism Speaks Community: Discussions on Low Muscle Tone</li>
                    <li>[19] Autism Forums: Low Muscle Tone Experiences</li>
                    <li>[20] Wrong Planet: Discussions on Motor Skills and Low Muscle Tone</li>
                </ul>
            </div>
        </div>
    </footer>

<?php get_footer(); ?>
</body>
</html>