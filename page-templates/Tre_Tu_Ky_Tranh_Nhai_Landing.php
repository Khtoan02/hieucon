<?php /* Template Name: Tre_Tu_Ky_Tranh_Nhai_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trẻ tự kỷ chỉ ăn đồ mềm tránh nhai và cách mẹ đồng hành giúp con</title>
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
        .font-oswald { font-family: 'Oswald', sans-serif; }
        .cta-button {
            background-color: #FFD154;
            color: #002795;
            font-weight: 700;
            padding: 1rem 2rem;
            border-radius: 9999px;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
            display: inline-block;
            text-align: center;
        }
        .cta-button:hover {
            transform: scale(1.05);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body class="bg-white">

    <main>
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
                        TRẺ TỰ KỶ CHỈ ĂN ĐỒ MỀM TRÁNH NHAI VÀ CÁCH MẸ ĐỒNG HÀNH GIÚP CON
                    </h1>
                    <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                        Việc con né tránh nhai không phải do con hư hay bướng bỉnh, mà ẩn chứa những khó khăn về thần kinh và thể chất mà con chưa thể nói thành lời.
                    </p>
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                        LÀM BẢNG KIỂM TRA SỨC KHỎE CHO CON NGAY
                    </a>
                </div>
                
                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/chewing_hero_img_1779077717139.png" alt="Trẻ tự kỷ tránh nhai" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
                </div>
            </div>
        </section>

        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl mb-8 leading-snug uppercase">
                    Thấu cảm cùng mẹ khi mỗi bữa ăn của con trở thành một cuộc chiến đầy áp lực
                </h2>
                <div class="space-y-6 text-lg text-text-dark leading-relaxed text-justify">
                    <p>
                        Mẹ thương mến, nhìn con ngậm mãi một miếng thức ăn hay khóc thét khi thấy đồ ăn thô, chắc hẳn mẹ cảm thấy vô cùng bất lực. Nhiều bà mẹ chia sẻ rằng bé chỉ chấp nhận duy nhất một loại cháo xay nhuyễn mịn, hoặc ngậm thức ăn hàng giờ đồng hồ như một chú sóc nhỏ, kiên quyết không nhai cũng không nuốt [16], [18].
                    </p>
                    <p>
                        Những khoảnh khắc ấy rút cạn năng lượng và khiến mẹ dằn vặt với hàng ngàn câu hỏi. Nhưng mẹ hãy hít một hơi thật sâu và buông bỏ sự tự trách. Con chối từ thức ăn thô bắt nguồn từ những cơ chế thần kinh và vận động phức tạp mà con đang phải đối mặt hàng ngày [19].
                    </p>
                </div>
            </div>
        </section>

        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl text-center mb-16 leading-snug uppercase">
                    Lý giải cơ chế thần kinh và thể chất khiến con cảm thấy sợ hãi khi nhai thức ăn thô
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white p-10 rounded-2xl shadow-md border-t-4 border-navy">
                        <div class="text-4xl mb-6">🧠</div>
                        <h3 class="font-oswald text-navy text-2xl mb-4 uppercase">Rối loạn xử lý cảm giác</h3>
                        <p class="text-text-dark leading-relaxed">
                            Hệ thần kinh nhạy cảm khiến kết cấu lợn cợn của thức ăn phát ra tín hiệu "nguy hiểm". Với con, một gợn nhỏ trong bát cháo cũng có thể gây khó chịu như dị vật sắc nhọn, buộc con phải nôn ọe để tự bảo vệ mình [1], [3], [20].
                        </p>
                    </div>
                    <div class="bg-white p-10 rounded-2xl shadow-md border-t-4 border-navy">
                        <div class="text-4xl mb-6">👄</div>
                        <h3 class="font-oswald text-navy text-2xl mb-4 uppercase">Vận động miệng yếu</h3>
                        <p class="text-text-dark leading-relaxed">
                            Nhiều trẻ có trương lực cơ vùng hàm và lưỡi thấp, khiến việc nhai trở nên cực kỳ mệt mỏi. Con không biết điều khiển khối thức ăn và lo sợ bị nghẹn bất cứ lúc nào [13], [15]. Mẹ có thể tìm hiểu thêm về <a href="https://hieucontugoc.online/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me" class="text-navy font-bold underline">oral motor therapy là gì? giải thích dễ hiểu cho mẹ</a> và liệu con <a href="https://hieucontugoc.online/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu" class="text-navy font-bold underline">chậm nói do ngôn ngữ hay do vận động miệng yếu?</a>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div>
                        <h2 class="font-oswald text-navy text-3xl md:text-4xl mb-8 leading-snug uppercase">
                            Những hệ lụy sức khỏe thầm lặng khi con chối từ việc nhai trong thời gian dài
                        </h2>
                        <ul class="space-y-6 text-lg">
                            <li class="flex items-start">
                                <span class="text-navy mr-3 text-2xl">✔</span>
                                <span><strong>Thiếu hụt vi chất:</strong> Nguy cơ thiếu kẽm, sắt và protein ảnh hưởng trực tiếp đến sự phát triển của não bộ và hệ miễn dịch [6], [9].</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-navy mr-3 text-2xl">✔</span>
                                <span><strong>Vấn đề về dãi:</strong> Cơ hàm yếu khiến con khó đóng kín môi, dẫn đến tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-chay-nuoc-dai-nhieu" class="text-navy font-bold underline">trẻ tự kỷ chảy nước dãi nhiều</a>.</span>
                            </li>
                            <li class="flex items-start">
                                <span class="text-navy mr-3 text-2xl">✔</span>
                                <span><strong>Khó khăn phát âm:</strong> Việc không luyện tập nhai khiến các bài tập <a href="https://hieucontugoc.online/van-dong-mieng-hong-tre-tu-ky" class="text-navy font-bold underline">vận động miệng họng trẻ tự kỷ</a> trở nên cần thiết hơn để cải thiện khả năng giao tiếp [11], [14].</span>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-cream p-8 rounded-3xl border-2 border-dashed border-navy">
                        <p class="italic text-navy text-xl text-center font-semibold">
                            "Mọi sự thay đổi về thói quen ăn uống luôn cần một nền tảng sức khỏe vững chắc được kiểm chứng bởi chuyên gia."
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl text-center mb-16 leading-snug uppercase">
                    Từng bước nhỏ giúp con làm quen với việc nhai mà không gây ra sự hoảng loạn
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🥣</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 uppercase">Thay đổi kết cấu cực nhỏ</h3>
                        <p class="text-text-soft">Sử dụng kỹ thuật Food Chaining, bắt đầu bằng việc trộn 10% phần thức ăn lợn cợn vào bát cháo mịn quen thuộc của con [4], [12].</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🎺</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 uppercase">Trò chơi vận động miệng</h3>
                        <p class="text-text-soft">Thổi bong bóng xà phòng, thổi còi hoặc dùng dụng cụ gặm nhai trị liệu để rèn luyện sức mạnh cơ hàm một cách vui vẻ [11], [13].</p>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-sm text-center">
                        <div class="w-16 h-16 bg-yellow rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🛡</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 uppercase">Môi trường ăn uống an toàn</h3>
                        <p class="text-text-soft">Giảm bớt áp lực, tắt tivi, ipad và cho phép con được chạm vào thức ăn bằng tay để não bộ làm quen với cảm giác [2], [10].</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-white py-16 md:py-24 px-6 text-center border-t border-gray-100">
            <div class="max-w-3xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl mb-8 leading-snug uppercase">
                    Thời điểm mẹ cần tìm đến sự hỗ trợ chuyên sâu từ các chuyên gia trị liệu
                </h2>
                <p class="text-lg mb-10 text-text-dark">
                    Đừng tự mình gồng gánh nếu con có biểu hiện sụt cân, nôn trớ liên tục hoặc sặc khi nuốt. Hãy bắt đầu bằng một tấm bản đồ sức khỏe rõ ràng dành riêng cho con.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button">
                    NHẬN BẢNG KIỂM TRA SỨC KHỎE TOÀN DIỆN CHO CON
                </a>
            </div>
        </section>

        <section class="bg-cream py-16 md:py-24 px-6">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl text-center mb-12 uppercase">Giải đáp thắc mắc thường gặp</h2>
                <div class="space-y-4">
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Việc con né tránh nhai lớn lên có tự khỏi không?
                            <span class="transition group-open:rotate-180">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark">
                            Phần lớn các rối loạn về giác quan và vận động miệng sẽ không tự biến mất nếu không có sự can thiệp đúng cách. Nếu để kéo dài, cơ hàm yếu đi sẽ càng gây khó khăn cho việc cải thiện sau này.
                        </div>
                    </details>
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Tôi có nên giấu đồ ăn thô vào bát cháo xay của con không?
                            <span class="transition group-open:rotate-180">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark">
                            Tuyệt đối không nên. Việc này gây ra cảm giác bị phản bội, khiến trẻ mất niềm tin vào bữa ăn và có thể từ chối luôn cả món cháo yêu thích ban đầu.
                        </div>
                    </details>
                    <details class="group bg-white rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Tại sao con ngậm thức ăn trong miệng hàng giờ?
                            <span class="transition group-open:rotate-180">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark">
                            Nguyên nhân thường do cơ hàm yếu không thể nhai nát thức ăn, kết hợp với lưỡi kém linh hoạt không đẩy được thức ăn xuống họng. Con ngậm thức ăn vì sợ bị nghẹn.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <section class="bg-gray-100 py-12 px-6 text-center">
            <p class="text-text-soft text-sm italic max-w-2xl mx-auto leading-relaxed">
                Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
            </p>
        </section>

        <footer class="bg-gray-100 pb-20 px-6 border-t border-gray-200">
            <div class="max-w-6xl mx-auto pt-10">
                <h3 class="font-oswald text-navy text-sm mb-6 uppercase tracking-widest text-center">Nguồn tham khảo uy tín</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-[10px] text-text-soft">
                    <ul class="space-y-1">
                        <li>[1] childmind.org/article/autism-and-picky-eating/</li>
                        <li>[2] raisingchildren.net.au/autism/health-wellbeing/eating-habits/fussy-eating-autism</li>
                        <li>[3] psychologytoday.com/us/blog/autism-in-real-life/202008/understanding-sensory-eating-in-autism</li>
                        <li>[4] autismparentingmagazine.com/autism-picky-eater-tips/</li>
                        <li>[5] sparkforautism.org/discover_article/autism-and-picky-eating/</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[6] autism.org.uk/advice-and-guidance/topics/behaviour/eating</li>
                        <li>[7] autismspeaks.org/expert-opinion/autism-and-food-aversions</li>
                        <li>[8] understood.org/en/articles/sensory-processing-issues-and-food</li>
                        <li>[9] kidshealth.org/en/parents/autism-feeding.html</li>
                        <li>[10] aane.org/resources/adults/health-and-wellness/eating-and-nutrition/</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[11] yourkidstable.com/autism-and-eating/</li>
                        <li>[12] sosapproachtofeeding.com/autism-and-feeding-problems/</li>
                        <li>[13] arktherapeutic.com/blog/how-to-help-a-child-who-refuses-to-chew/</li>
                        <li>[14] speechandlanguagekids.com/feeding-therapy-for-picky-eaters-and-children-with-autism/</li>
                        <li>[15] blog.therapro.com/sensory-based-feeding-challenges-in-autism/</li>
                    </ul>
                    <ul class="space-y-1">
                        <li>[16] themighty.com/topic/autism-spectrum-disorder/autism-sensory-eating-habits/</li>
                        <li>[17] neuroclastic.com/arfid-autism-and-the-sensory-hell-of-eating/</li>
                        <li>[18] theautismcafe.com/autism-picky-eating-sensory-issues/</li>
                        <li>[19] findingcoopersvoice.com/2019/03/12/the-boy-who-wont-eat/</li>
                        <li>[20] embracing-autism.com/texture-sensitivities-in-autistic-children/</li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>
    <?php get_footer(); ?>
</body>
</html>