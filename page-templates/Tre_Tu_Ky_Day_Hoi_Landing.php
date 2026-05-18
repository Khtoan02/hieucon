<?php /* Template Name: Tre_Tu_Ky_Day_Hoi_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trẻ tự kỷ đầy hơi và cách xử lý nhanh - Hiểu con từ gốc</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
        body { font-family: \'Quicksand\', sans-serif; background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }
        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; scroll-behavior: smooth; }
        h1, h2, h3 { font-family: 'Oswald', sans-serif; line-height: 1.4 !important; }
        .cta-button {
            background-color: #FFD154;
            color: #002795;
            font-weight: bold;
            padding: 1rem 2rem;
            border-radius: 9999px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            display: block;
            width: fit-content;
            margin: 0 auto;
        }
        .cta-button:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
    </style>
</head>
<body class="bg-white">

    <!-- HERO SECTION -->
    <section class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden" id="hero-section">
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
                <h1 class="font-oswald text-4xl md:text-5xl lg:text-5xl font-bold leading-tight mb-6 text-white tracking-wide uppercase">
                    TRẺ TỰ KỶ ĐẦY HƠI BỤNG CĂNG PHÌNH  VÀ CÁCH XỬ LÝ NHANH
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Thấu hiểu nỗi đau thể chất thầm lặng và hành trình xoa dịu hệ tiêu hóa nhạy cảm của con bằng tình yêu và kiến thức khoa học đúng đắn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    NHẬN BẢNG KIỂM TRA SỨC KHỎE CHO CON
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/oral_motor_therapy_hero_img_1779078827681.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <main>
        <section class="py-16 md:py-24 px-6 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-navy text-3xl md:text-4xl font-bold text-center mb-16 leading-tight">
                    Thấu hiểu nỗi đau thể chất khi trẻ gặp vấn đề tiêu hóa mà không thể nói ra
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="bg-cream p-8 md:p-12 rounded-3xl border-l-8 border-yellow">
                        <h3 class="text-navy text-2xl mb-6 font-semibold uppercase">Tiếng gọi thầm lặng từ cơ thể con</h3>
                        <p class="text-text-dark text-lg leading-relaxed mb-4">
                            Khi con ôm bụng gập người hay bất ngờ bùng nổ hành vi, đó không phải là sự bướng bỉnh. Với rào cản ngôn ngữ, con đang dùng cơ thể để "kêu cứu" trước những cơn đau quặn thắt do khí tích tụ.
                        </p>
                        <p class="text-text-dark text-lg leading-relaxed">
                            Mỗi hành vi tự làm đau hay cáu gắt là một nỗ lực của não bộ nhằm đánh lạc hướng sự chú ý khỏi cơn căng tức đang diễn ra bên trong ổ bụng nhạy cảm.
                        </p>
                    </div>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4">
                            <span class="text-4xl">😟</span>
                            <div>
                                <h4 class="text-navy text-xl font-bold font-oswald mb-2">Sự nhạy cảm giác quan bị phóng đại</h4>
                                <p class="text-text-soft">Một cơn đầy hơi nhẹ với chúng ta có thể biến thành nỗi đau khổng lồ trong nhận thức nhạy cảm của trẻ tự kỷ.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4">
                            <span class="text-4xl">🛑</span>
                            <div>
                                <h4 class="text-navy text-xl font-bold font-oswald mb-2">Vòng lặp bùng nổ hành vi</h4>
                                <p class="text-text-soft">Sự khó chịu kéo dài làm cạn kiệt năng lượng, khiến trẻ thu mình và từ chối mọi nỗ lực tương tác từ cha mẹ.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 md:py-24 px-6 bg-cream">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-navy text-3xl md:text-4xl font-bold text-center mb-16 leading-tight">
                    Những nguyên nhân khoa học khiến bụng con hay ậm ạch và căng cứng
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-3xl shadow-md flex flex-col">
                        <div class="text-5xl mb-6">🦠</div>
                        <h3 class="text-navy text-xl font-bold mb-4 h-16 flex items-center">Sự mất cân bằng hệ vi sinh đường ruột</h3>
                        <p class="text-text-dark flex-grow">
                            Tình trạng <a href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky" class="text-navy font-bold underline">dysbiosis đường ruột ở trẻ tự kỷ</a> làm tăng sinh hại khuẩn sinh khí, khiến thức ăn bị lên men dư thừa tạo áp lực lớn lên thành ruột.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-md flex flex-col">
                        <div class="text-5xl mb-6">🧠</div>
                        <h3 class="text-navy text-xl font-bold mb-4 h-16 flex items-center">Tác động từ hệ trục thần kinh ruột não</h3>
                        <p class="text-text-dark flex-grow">
                            Mối liên kết giữa <a href="https://hieucontugoc.online/truc-ruot-nao-tu-ky" class="text-navy font-bold underline">trục ruột não & tự kỷ</a> khiến nhu động ruột bị ức chế dưới trạng thái căng thẳng, làm thức ăn ứ đọng và sinh khí lâu ngày.
                        </p>
                    </div>
                    <div class="bg-white p-8 rounded-3xl shadow-md flex flex-col">
                        <div class="text-5xl mb-6">🚽</div>
                        <h3 class="text-navy text-xl font-bold mb-4 h-16 flex items-center">Vòng lặp kén ăn và táo bón mãn tính</h3>
                        <p class="text-text-dark flex-grow">
                            Chế độ ăn thiếu xơ và tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh" class="text-navy font-bold underline">trẻ tự kỷ táo bón mãn tính</a> làm tắc nghẽn đường thoát của khí, khiến bụng luôn căng cứng khó chịu.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 md:py-24 px-6 bg-white text-center">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-navy text-3xl md:text-4xl font-bold mb-16 leading-tight">
                    Những phương pháp xử lý nhanh giúp xoa dịu cơn căng tức bụng tại nhà
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="border-2 border-cream p-8 rounded-3xl hover:border-yellow transition-colors">
                        <div class="text-4xl mb-4">🙌</div>
                        <h3 class="text-navy text-xl font-bold mb-4">Massage theo chiều kim đồng hồ</h3>
                        <p class="text-text-soft">Sử dụng dầu ấm, xoa nhẹ vùng bụng theo hình vòng tròn để giúp phá vỡ các bọt khí và kích thích nhu động ruột hoạt động trở lại.</p>
                    </div>
                    <div class="border-2 border-cream p-8 rounded-3xl hover:border-yellow transition-colors">
                        <div class="text-4xl mb-4">🚴</div>
                        <h3 class="text-navy text-xl font-bold mb-4">Hỗ trợ vận động tư thế đạp xe</h3>
                        <p class="text-text-soft">Cho con nằm ngửa và thực hiện động tác đạp chân nhịp nhàng để tạo lực ép tự nhiên, giúp đẩy khí ứ đọng ra ngoài hiệu quả hơn.</p>
                    </div>
                    <div class="border-2 border-cream p-8 rounded-3xl hover:border-yellow transition-colors">
                        <div class="text-4xl mb-4">🥣</div>
                        <h3 class="text-navy text-xl font-bold mb-4">Ưu tiên thực phẩm mềm và lỏng</h3>
                        <p class="text-text-soft">Trong những ngày <a href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky" class="text-navy font-bold underline">tiêu hóa dạ dày trẻ tự kỷ</a> bị đình công, súp nhuyễn và cháo loãng là giải pháp an toàn để giảm tải áp lực cho bụng con.</p>
                    </div>
                </div>
                <div class="mt-16">
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button">
                        HÀNH ĐỘNG NGAY VÌ SỰ BÌNH YÊN CỦA CON
                    </a>
                </div>
            </div>
        </section>

        <section class="py-16 md:py-24 px-6 bg-cream">
            <div class="max-w-5xl mx-auto">
                <h2 class="text-navy text-3xl md:text-4xl font-bold text-center mb-16 leading-tight">
                    Xây dựng nền tảng dinh dưỡng lâu dài để bảo vệ hệ thống ruột nhạy cảm
                </h2>
                <div class="space-y-8">
                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm flex flex-col md:flex-row gap-8 items-center">
                        <div class="text-6xl">🥛</div>
                        <div>
                            <h3 class="text-navy text-2xl font-bold mb-4">Loại bỏ các nhóm chất khó dung nạp</h3>
                            <p class="text-text-dark text-lg">
                                Tìm hiểu và áp dụng <a href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky" class="text-navy font-bold underline">chế độ ăn không gluten casein (gfcf) cho trẻ tự kỷ</a> giúp giảm phản ứng viêm niêm mạc ruột, từ đó cải thiện triệt để tình trạng chướng bụng và đầy hơi kéo dài.
                            </p>
                        </div>
                    </div>
                    <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm flex flex-col md:flex-row gap-8 items-center">
                        <div class="text-6xl">✨</div>
                        <div>
                            <h3 class="text-navy text-2xl font-bold mb-4">Tái thiết lập hệ vi sinh đường ruột</h3>
                            <p class="text-text-dark text-lg">
                                Bổ sung lợi khuẩn tự nhiên giúp con tiêu hóa trơn tru hơn, đồng thời hỗ trợ tổng hợp các chất dẫn truyền thần kinh giúp con bớt cáu bẳn và ngủ sâu giấc hơn mỗi đêm.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-24 px-6 bg-white text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-navy text-3xl md:text-5xl font-bold mb-8 leading-tight uppercase">
                    Đánh giá thể trạng định kỳ là bước quan trọng nhất để thấu hiểu con từ gốc
                </h2>
                <p class="text-text-dark text-xl leading-relaxed mb-12">
                    Cha mẹ là người phiên dịch tốt nhất của con. Việc rà soát chi tiết các dấu hiệu sinh học, thói quen đi vệ sinh và hành vi sau ăn là chìa khóa để vạch ra lộ trình chăm sóc cá nhân hóa, giúp con không còn đau đớn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button">
                    NHẬN BẢNG KIỂM TRA SỨC KHỎE TOÀN DIỆN MIỄN PHÍ
                </a>
            </div>
        </section>

        <section class="py-16 md:py-24 px-6 bg-cream">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-navy text-3xl md:text-4xl font-bold text-center mb-16 leading-tight">
                    Những câu hỏi cha mẹ thường trăn trở về tình trạng căng chướng bụng ở trẻ
                </h2>
                
                <details class="group bg-white rounded-2xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center uppercase">
                        Vì sao con tôi cứ ăn xong là bụng lại căng tròn và gõ nghe tiếng bồm bộp?
                        <span class="transition group-open:rotate-180">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark text-lg border-t border-gray-100 pt-4">
                        Tình trạng này là do lượng khí dư thừa tích tụ quá nhiều. Khi hệ vi sinh mất cân bằng, thức ăn không được phân giải bình thường mà bị lên men mạnh mẽ tạo thành sự cộng hưởng khí bên trong thành ruột.
                    </div>
                </details>

                <details class="group bg-white rounded-2xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center uppercase">
                        Việc con hay thức giấc vào ban đêm và khóc thét có liên quan đến tiêu hóa không?
                        <span class="transition group-open:rotate-180">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark text-lg border-t border-gray-100 pt-4">
                        Hoàn toàn có thể. Khi nằm xuống, khí ứ đọng và axit dễ trào ngược gây nóng rát thực quản và chướng bụng. Sự đau đớn này đánh thức hệ thần kinh vốn nhạy cảm, khiến con hoảng sợ và khóc lóc trong vô thức.
                    </div>
                </details>

                <details class="group bg-white rounded-2xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center uppercase">
                        Tôi có nên tự mua men tiêu hóa hay thuốc chống đầy hơi cho con uống không?
                        <span class="transition group-open:rotate-180">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark text-lg border-t border-gray-100 pt-4">
                        Các loại thuốc thông thường chỉ giải quyết phần ngọn. Việc lạm dụng chủng men sai có thể làm rối loạn vi sinh trầm trọng hơn. Cha mẹ nên tham vấn chuyên gia để có phác đồ bổ sung chính xác cho thể trạng riêng của con.
                    </div>
                </details>

                <details class="group bg-white rounded-2xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center uppercase">
                        Trẻ tự kỷ đầy hơi và bị táo bón lâu ngày có nguy hiểm không?
                        <span class="transition group-open:rotate-180">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark text-lg border-t border-gray-100 pt-4">
                        Tình trạng này tạo ra độc tố hấp thụ ngược vào máu, gây viêm nhiễm hệ thống. Về lâu dài, nó tàn phá sức đề kháng và là rào cản lớn nhất khiến các biện pháp can thiệp hành vi kém hiệu quả.
                    </div>
                </details>

                <details class="group bg-white rounded-2xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center uppercase">
                        Làm thế nào để biết con đang bị đau bụng khi con chưa biết nói?
                        <span class="transition group-open:rotate-180">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark text-lg border-t border-gray-100 pt-4">
                        Hãy quan sát các dấu hiệu: liên tục ấn mạnh vào bụng, nhăn nhó, đột ngột từ chối món ăn yêu thích, cuộn tròn người hoặc xuất hiện các hành vi tự làm đau bản thân (đập đầu, cắn tay) bất thường.
                    </div>
                </details>
            </div>
        </section>

        <section class="bg-gray-100 py-12 px-6 text-center border-t border-gray-200">
            <div class="max-w-4xl mx-auto">
                <p class="text-text-soft text-sm italic leading-relaxed">
                    Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
                </p>
            </div>
        </section>

        <footer class="bg-gray-200 py-12 px-6 text-sm text-text-soft">
            <div class="max-w-6xl mx-auto">
                <h3 class="font-oswald text-navy text-lg mb-6 uppercase">Nguồn tham khảo uy tín</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <ul class="space-y-1">
                        <li>[1] Psychology Today - GI issues in Autism</li>
                        <li>[2] Child Mind Institute - Stomach Issues</li>
                        <li>[3] Verywell Health - Autism GI Problems</li>
                        <li>[4] Additude Mag - GI Symptoms</li>
                        <li>[5] Healthline - Autism Gut Health</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[6] Autism Speaks - GI Guide</li>
                        <li>[7] Understood.org - Stomach Problems</li>
                        <li>[8] National Autistic Society (UK)</li>
                        <li>[9] Autism Society - Medical Resources</li>
                        <li>[10] CDC - GI issues Features</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[11] Spectrum News - GI Problems Explained</li>
                        <li>[12] TACA - Family Resources GI</li>
                        <li>[13] Nourishing Hope - Diet & Digestion</li>
                        <li>[14] Dr. Mark Hyman - Fix Your Gut</li>
                        <li>[15] Amen Clinics - Gut-Brain Connection</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[16] Autism Parenting Magazine</li>
                        <li>[17] The Autism Cafe - Gut Issues</li>
                        <li>[18] Finding Coopers Voice - Gut & Autism</li>
                        <li>[19] The Mighty - Autism GI Pain</li>
                        <li>[20] AwesomismMom - Digestive Issues</li>
                    </ul>
                </div>
                <p class="mt-8 text-center border-t border-gray-300 pt-8">
                    © 2024 Hiểu Con Từ Gốc - Đồng hành cùng cha mẹ trong hành trình chăm sóc sức khỏe toàn diện cho trẻ tự kỷ.
                </p>
            </div>
        </footer>
    </main>
<?php get_footer(); ?>
</body>
