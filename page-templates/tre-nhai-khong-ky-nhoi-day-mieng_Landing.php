<?php /* Template Name: tre-nhai-khong-ky-nhoi-day-mieng_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trẻ Nhai Không Kỹ, Nhồi Đầy Miệng: Cách Chỉnh Hành Vi</title>
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
        .content-links a { color: #002795; text-decoration: underline; font-weight: 600; }
        .content-links a:hover { color: #FFD154; }
        
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] summary ~ * { animation: sweep .3s ease-in-out; }
        @keyframes sweep {
            0%    {opacity: 0; transform: translateY(-10px)}
            100%  {opacity: 1; transform: translateY(0)}
        }
        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }
    </style>
</head>
<body class="font-quicksand text-text-dark bg-white antialiased">

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
                    HIỂU ĐÚNG NGUYÊN NHÂN VÀ CÁCH CHỈNH HÀNH VI KHI TRẺ NHAI KHÔNG KỸ VÀ NHỒI ĐẦY MIỆNG
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Mỗi bữa ăn trôi qua thường để lại trong lòng cha mẹ những tiếng thở dài lo âu khi chứng kiến tình trạng trẻ nhai không kỹ, nhồi đầy miệng bằng thức ăn mà không chịu nuốt. Đôi lúc, con nhét thức ăn phồng cả hai má, tạo ra nguy cơ bị nghẹn. Việc hiểu rõ cội rễ của vấn đề sẽ giúp cha mẹ gỡ bỏ áp lực, từ đó tìm ra những phương pháp can thiệp khoa học và an toàn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Thực Hiện Bảng Checklist Ngay
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/stuffing_hero_img_1779078774052.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- SECTION 1: Nỗi đau (bg-white) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-4">Những nỗi lo lắng thầm kín của cha mẹ trong mỗi bữa ăn của con</h2>
                <div class="w-24 h-1 bg-yellow mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="text-text-soft text-lg leading-relaxed space-y-6">
                    <p>Khi nuôi dưỡng một đứa trẻ có sự phát triển thần kinh khác biệt, bữa ăn đôi khi không còn là khoảng thời gian gắn kết gia đình mà trở thành một cuộc chiến đầy nước mắt và sự bất lực.</p>
                    <p>Những người làm cha mẹ thường xuyên phải đối mặt với cảm giác thót tim khi thấy con liên tục đưa thức ăn vào miệng dù phần cắn trước đó vẫn chưa được nhai nghiền. Con có thể nhét thức ăn phồng to ở hai bên má hệt như những chú sóc nhỏ cất giấu hạt dẻ [16].</p>
                    <p>Thực tế, đứa trẻ không hề cố ý làm khó cha mẹ. Việc con tích trữ thức ăn trong khoang miệng là một tín hiệu cho thấy cơ thể con đang gặp trục trặc trong việc xử lý thông tin. Con thực sự cần sự giúp đỡ chuyên môn và sự thấu hiểu từ gia đình thay vì những hình phạt hay sự ép buộc.</p>
                </div>
                
                <div class="space-y-6">
                    <div class="bg-cream rounded-2xl p-8 shadow-sm flex gap-6 items-start">
                        <div class="text-4xl">😨</div>
                        <div>
                            <h3 class="font-oswald text-navy text-xl font-semibold mb-2">Nguy cơ nghẹn và tắc đường thở</h3>
                            <p class="text-text-soft">Sự lo sợ lớn nhất và ám ảnh nhất đối với gia đình chính là nguy cơ con bị nghẹn. Cha mẹ thường xuyên phải dùng tay lấy thức ăn thừa ra khỏi miệng con trong sự chống cự dữ dội [18].</p>
                        </div>
                    </div>
                    <div class="bg-cream rounded-2xl p-8 shadow-sm flex gap-6 items-start">
                        <div class="text-4xl">💔</div>
                        <div>
                            <h3 class="font-oswald text-navy text-xl font-semibold mb-2">Sự bất lực khi nhắc nhở</h3>
                            <p class="text-text-soft">Khi những lời nhắc nhở nhẹ nhàng như "con nhai đi" hay "con nuốt đi" dường như rơi vào hư không, sự kiên nhẫn dần cạn kiệt, nhường chỗ cho những tiếng quát mắng vô tình làm tổn thương cả hai [20].</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: Khoa học (bg-cream) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-4">Lý giải góc nhìn khoa học về thói quen nhồi nhét thức ăn ở trẻ</h2>
                <div class="w-24 h-1 bg-yellow mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-text-soft max-w-3xl mx-auto">Để giải quyết tận gốc vấn đề, chúng ta cần gác lại những suy đoán chủ quan và nhìn nhận hành vi này dưới lăng kính của tâm lý học hành vi và trị liệu hoạt động. Có hai nguyên nhân cốt lõi về mặt thể chất và thần kinh.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-stretch content-links">
                <div class="bg-white rounded-2xl p-10 shadow-md flex flex-col">
                    <div class="text-5xl mb-6">🧠</div>
                    <h3 class="font-oswald text-navy text-2xl font-semibold mb-4 leading-snug">Rối loạn xử lý cảm giác khiến khoang miệng con khao khát tìm kiếm kích thích mạnh</h3>
                    <p class="text-text-soft text-lg leading-relaxed mb-4">Hệ thống cảm giác của con người giúp chúng ta nhận biết thức ăn đang ở đâu trong miệng, có kích thước bao nhiêu và khi nào thì an toàn để nuốt. Tuy nhiên, đối với những trẻ bị giảm nhạy cảm ở vùng miệng (hyposensitivity), hệ thống rào chắn tín hiệu này hoạt động vô cùng yếu ớt [4].</p>
                    <p class="text-text-soft text-lg leading-relaxed">Khoang miệng của con giống như một không gian tê bì, khiến con không thể cảm nhận rõ ràng sự hiện diện của lượng nhỏ thức ăn. Để não bộ nhận được tín hiệu "đang có đồ ăn", con buộc phải nhét thật đầy, tạo áp lực lớn lên má và nướu [7]. Đây là một phản xạ tìm kiếm cảm giác vô thức giúp con tự điều chỉnh lại những xáo trộn thần kinh [10], [17].</p>
                </div>

                <div class="bg-white rounded-2xl p-10 shadow-md flex flex-col">
                    <div class="text-5xl mb-6">💪</div>
                    <h3 class="font-oswald text-navy text-2xl font-semibold mb-4 leading-snug">Trương lực cơ hàm yếu làm con khó khăn trong việc điều khiển và nhai nghiền thức ăn</h3>
                    <p class="text-text-soft text-lg leading-relaxed mb-4">Quá trình nhai nuốt đòi hỏi sự phối hợp nhịp nhàng của cơ hàm, lưỡi, môi và nướu. Khi một đứa trẻ có trương lực cơ hàm thấp, con sẽ cảm thấy việc nhai thức ăn tốn rất nhiều sức lực và dễ dàng bị mỏi [11], [15].</p>
                    <p class="text-text-soft text-lg leading-relaxed">Thay vì nhai xoay tròn để nghiền nát thức ăn, lưỡi của con có thể chỉ đẩy thức ăn từ bên này sang bên kia một cách vụng về, cuối cùng dồn tất cả vào một góc má [14]. Sự thiếu hụt sức mạnh này khiến con có xu hướng giữ nguyên thức ăn ở dạng thô trong miệng. Hãy tìm hiểu thêm về <a href="https://hieucontugoc.online/van-dong-mieng-hong-tre-tu-ky">vận động miệng họng trẻ tự kỷ</a> để có cái nhìn toàn diện.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: Can thiệp (bg-white) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-4">Cách cha mẹ đồng hành cùng con điều chỉnh hành vi an toàn và thấu cảm</h2>
                <div class="w-24 h-1 bg-yellow mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-text-soft max-w-3xl mx-auto">Hành trình thay đổi một thói quen liên quan đến cảm giác và vận động đòi hỏi sự bền bỉ. Mục tiêu không phải là ép con ăn thật nhanh, mà là dạy con cách kiểm soát khoang miệng và bảo vệ sự an toàn.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 content-links">
                <div class="bg-cream rounded-2xl p-8 shadow-md">
                    <div class="text-4xl mb-4">🍽️</div>
                    <h3 class="font-oswald text-navy text-xl font-semibold mb-4">Bước đầu tiên là thay đổi môi trường và cách cắt thái thức ăn để giảm nguy cơ nghẹn</h3>
                    <p class="text-text-soft leading-relaxed mb-4">Thay vì dọn ra một bát cơm đầy, hãy bắt đầu bằng việc kiểm soát lượng thức ăn hiện diện trên bàn. Việc chia nhỏ khẩu phần giúp loại bỏ cơ hội để con có thể bốc và nhồi nhét liên tục [1], [6].</p>
                    <ul class="list-disc pl-5 text-text-soft space-y-2">
                        <li><strong>Điều chỉnh kích thước:</strong> Cắt nhỏ thức ăn thành hạt lựu, đặc biệt là các loại thịt hay trái cây cứng.</li>
                        <li><strong>Điều chỉnh kết cấu:</strong> Nếu trương lực cơ yếu, ưu tiên các món ăn mềm, dễ tan trong miệng [3], [8].</li>
                    </ul>
                </div>

                <div class="bg-cream rounded-2xl p-8 shadow-md">
                    <div class="text-4xl mb-4">🪥</div>
                    <h3 class="font-oswald text-navy text-xl font-semibold mb-4">Áp dụng các bài tập vận động nhẹ nhàng giúp khoang miệng con tăng cường cảm nhận</h3>
                    <p class="text-text-soft leading-relaxed">Để đánh thức hệ thống cảm giác đang "ngủ quên", cha mẹ có thể áp dụng các liệu pháp kích thích xúc giác trước mỗi bữa ăn. Hãy sử dụng những chiếc bàn chải silicon mềm hoặc ngón tay sạch để massage nhẹ nhàng hai bên má, nướu và môi của con.</p>
                    <p class="text-text-soft leading-relaxed mt-4">Những động tác này gửi tín hiệu đánh thức lên não bộ [12], [13]. Tìm hiểu thêm chi tiết qua bài viết: <a href="https://hieucontugoc.online/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me">oral motor therapy là gì? giải thích dễ hiểu cho mẹ</a>.</p>
                </div>

                <div class="bg-cream rounded-2xl p-8 shadow-md">
                    <div class="text-4xl mb-4">⏳</div>
                    <h3 class="font-oswald text-navy text-xl font-semibold mb-4">Xây dựng nhịp điệu nhai nuốt từ tốn để bữa ăn không bao giờ là một cuộc chiến</h3>
                    <p class="text-text-soft leading-relaxed">Sử dụng các công cụ hỗ trợ trực quan như đồng hồ cát nhỏ trên bàn ăn để tạo nhịp điệu: "Khi cát chảy hết, chúng ta sẽ nuốt và lấy miếng tiếp theo nhé".</p>
                    <p class="text-text-soft leading-relaxed mt-4">Khoảng nghỉ giữa các lần đưa thức ăn giúp não bộ xử lý thông tin. Quan trọng nhất, hãy giữ thái độ bình tĩnh, khen ngợi nỗ lực dù là nhỏ nhất của con thay vì tập trung vào những lúc con làm sai [2], [5], [19].</p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: FAQ (bg-cream) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-4">Giải đáp những thắc mắc thường gặp về rối loạn ăn uống và vận động miệng ở trẻ</h2>
                <div class="w-24 h-1 bg-yellow mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-text-soft max-w-3xl mx-auto">Trong quá trình đồng hành cùng con, cha mẹ chắc chắn sẽ gặp phải rất nhiều câu hỏi mang tính đan xen giữa vấn đề ăn uống, giao tiếp và vận động.</p>
            </div>

            <div class="space-y-4 content-links">
                <details class="group bg-white rounded-xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Phụ huynh làm sao để nhận biết chậm nói do ngôn ngữ hay do vận động miệng yếu
                        <span class="text-navy group-open:rotate-180 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark leading-relaxed">
                        <p>Rất nhiều trường hợp trẻ nhai không kỹ, ngậm thức ăn cũng đồng thời gặp khó khăn trong việc phát âm. Nguyên nhân là do bộ máy cấu âm (môi, lưỡi, hàm) quá yếu để thực hiện các chuyển động linh hoạt. Để phân biệt rõ ràng, cha mẹ có thể tham khảo bài viết chi tiết: <a href="https://hieucontugoc.online/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu">chậm nói do ngôn ngữ hay do vận động miệng yếu?</a>.</p>
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Nguyên nhân sâu xa khiến trẻ tự kỷ chảy nước dãi nhiều ngay cả khi không ăn
                        <span class="text-navy group-open:rotate-180 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark leading-relaxed">
                        <p>Chảy nước dãi vô thức liên quan mật thiết đến trương lực cơ yếu và việc trẻ không cảm nhận được nước bọt đang tích tụ trong miệng (do giảm nhạy cảm xúc giác). Đây cũng chính là cơ chế gây ra tình trạng ngậm và nhồi thức ăn. Cha mẹ có thể tìm hiểu thêm về sự liên kết này qua bài phân tích <a href="https://hieucontugoc.online/tre-tu-ky-chay-nuoc-dai-nhieu">trẻ tự kỷ chảy nước dãi nhiều</a>.</p>
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Khi nào gia đình thực sự cần tìm đến chuyên gia âm ngữ trị liệu để can thiệp
                        <span class="text-navy group-open:rotate-180 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark leading-relaxed">
                        <p>Nếu tình trạng nhồi đầy thức ăn đi kèm với biểu hiện sặc, ho tím tái, hoặc trẻ sụt cân nghiêm trọng do tránh né bữa ăn, đây là lúc gia đình cần sự can thiệp y khoa chuyên nghiệp. Các chuyên gia Âm ngữ trị liệu (SLP) sẽ có những bài đánh giá chuyên sâu về cấu trúc và chức năng nuốt của con.</p>
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Trẻ ngậm thức ăn rất lâu không chịu nuốt có phải do rào cản về kết cấu và mùi vị
                        <span class="text-navy group-open:rotate-180 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark leading-relaxed">
                        <p>Đúng vậy. Ở chiều ngược lại với những trẻ thiếu nhạy cảm, một số trẻ lại quá nhạy cảm (hypersensitive) với kết cấu lạ. Một miếng thịt có chút gân hoặc rau có xơ có thể mang lại cảm giác khó chịu tột độ khiến con không dám nuốt, dẫn đến việc ngậm thức ăn trong miệng hàng giờ đồng hồ.</p>
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm mb-4">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Việc dùng bàn chải massage có giúp trẻ nhạy cảm khoang miệng giảm nhồi nhét không
                        <span class="text-navy group-open:rotate-180 transition-transform duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark leading-relaxed">
                        <p>Hoàn toàn có tác dụng. Các loại bàn chải rung hoặc bàn chải đầu gai silicon sẽ cung cấp luồng kích thích an toàn và tập trung. Khi khoang miệng đã "no" cảm giác từ các bài tập massage, não bộ sẽ giảm bớt nhu cầu phải dùng thức ăn để tìm kiếm sự bù đắp, từ đó hành vi nhồi nhét sẽ thuyên giảm.</p>
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- SECTION 5: Final CTA (bg-white) -->
    <section class="bg-white py-20 px-6 text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-oswald text-navy text-3xl font-bold mb-6">Hãy đồng hành cùng con bằng sự thấu hiểu</h2>
            <p class="text-text-soft text-lg mb-10">Để có thể giúp con vượt qua rào cản này một cách toàn diện, chúng ta cần nhìn nhận trẻ ở nhiều góc độ khác nhau từ vận động, giác quan đến tâm lý. Cha mẹ hãy dành vài phút để thực hiện đánh giá tổng quát nhằm xác định rõ lộ trình đồng hành và mang lại cho con sự hỗ trợ đúng đắn nhất ngay từ hôm nay.</p>
            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg uppercase tracking-wide">
                Thực Hiện Bảng Kiểm Tra Sức Khỏe Toàn Diện
            </a>
        </div>
    </section>

    <!-- DISCLAIMER -->
    <section class="bg-gray-100 pb-12 px-6 text-center pt-12 border-t border-gray-200">
        <p class="text-text-soft text-sm italic max-w-4xl mx-auto">Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.</p>
    </section>
</main>

<!-- FOOTER: Nguồn tham khảo -->
<footer class="bg-gray-100 py-12 px-5 text-sm text-text-soft border-t border-gray-300">
    <div class="max-w-6xl mx-auto">
        <h4 class="font-oswald text-navy text-xl font-bold mb-6">Nguồn tài liệu tham khảo khoa học và cộng đồng:</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 break-all">
            <p>[1] https://childmind.org/article/feeding-issues-in-children-with-autism/</p>
            <p>[2] https://www.psychologytoday.com/us/blog/autism-and-anxiety/202008/autism-and-eating-challenges</p>
            <p>[3] https://raisingchildren.net.au/autism/health-wellbeing/diet-eating/eating-habits-autism</p>
            <p>[4] https://www.additudemag.com/sensory-processing-disorder-feeding-issues-picky-eaters/</p>
            <p>[5] https://www.healthline.com/health/autism/autism-and-eating</p>
            <p>[6] https://www.autismspeaks.org/expert-opinion/autism-and-food-stuffing</p>
            <p>[7] https://www.understood.org/en/articles/sensory-processing-issues-and-eating-what-you-need-to-know</p>
            <p>[8] https://nationalautismsociety.org.uk/advice-and-guidance/topics/physical-health/eating/parents</p>
            <p>[9] https://www.asha.org/public/speech/swallowing/feeding-and-swallowing-disorders-in-children/</p>
            <p>[10] https://kidshealth.org/en/parents/sensory-eating.html</p>
            <p>[11] https://harkla.co/blogs/special-needs/food-stuffing-pocketing</p>
            <p>[12] https://www.theottoolbox.com/oral-motor-exercises/</p>
            <p>[13] https://yourkidstable.com/food-stuffing/</p>
            <p>[14] https://www.arktherapeutic.com/blog/pocketing-food-in-the-cheeks/</p>
            <p>[15] https://nspt4kids.com/specialties-and-services/speech-language-pathology/why-does-my-child-stuff-food-in-their-mouth/</p>
            <p>[16] https://www.autismforums.com/threads/stuffing-food-in-mouth-sensory-need.1234/</p>
            <p>[17] https://theautismcafe.com/sensory-processing-and-eating/</p>
            <p>[18] https://community.babycenter.com/post/a54321/toddler-stuffing-food-in-cheeks-sensory</p>
            <p>[19] https://findingcoopersvoice.com/2019/04/10/autism-and-the-struggle-with-eating/</p>
            <p>[20] https://www.mumsnet.com/talk/special_educational_needs/eating-issues-pocketing-food-autism</p>
        </div>
    </div>
</footer>

<script>
    const detailsElements = document.querySelectorAll("details");
    detailsElements.forEach((targetDetail) => {
        targetDetail.addEventListener("click", () => {
            detailsElements.forEach((detail) => {
                if (detail !== targetDetail) {
                    detail.removeAttribute("open");
                }
            });
        });
    });
</script>
<?php get_footer(); ?>
</body>
</html>