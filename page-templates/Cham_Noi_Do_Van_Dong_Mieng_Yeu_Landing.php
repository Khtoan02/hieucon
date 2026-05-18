<?php /* Template Name: Cham_Noi_Do_Van_Dong_Mieng_Yeu_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chậm nói do vận động miệng yếu hay do con chậm phát triển?</title>
    <meta name="description" content="Trẻ chậm nói do vận động miệng yếu thường hiểu chuyện nhưng khó phát âm. Tìm hiểu cách nhận biết và hỗ trợ con tại nhà qua đánh giá y khoa chuẩn xác.">
    
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
        h1, h2, h3, h4, h5, h6, summary { font-family: 'Oswald', sans-serif; }
        .details-content { transition: max-height 0.3s ease-out; overflow: hidden; }
        details[open] summary ~ * { animation: sweep .5s ease-in-out; }
        @keyframes sweep {
            0%    {opacity: 0; margin-top: -10px}
            100%  {opacity: 1; margin-top: 0px}
        }
        details summary::-webkit-details-marker { display:none; }
        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }
    </style>
</head>
<body class="antialiased">

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
                    Kiến Thức Chuyên Môn
                </div>
                <h1 class="font-oswald text-4xl md:text-5xl lg:text-5xl font-bold leading-tight mb-6 text-white tracking-wide uppercase">
                    CHẬM NÓI DO VẬN ĐỘNG MIỆNG YẾU VÀ NHỮNG RÀO CẢN VÔ HÌNH KHIẾN CON CHƯA THỂ CẤT LỜI
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Làm cha mẹ, không có nỗi trăn trở nào lớn hơn việc nhìn con háo hức muốn kể về thế giới xung quanh nhưng lại chỉ có thể phát ra những âm thanh không rõ nghĩa. Đằng sau sự im lặng ấy có thể không phải là do con không muốn giao tiếp, mà là một khó khăn mang tính thể chất. Hãy cùng bước chậm lại, gạt bỏ những áp lực vô hình để nhìn sâu vào thế giới của con và tìm ra giải pháp hỗ trợ an toàn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    BẮT ĐẦU BẢNG KIỂM TRA SỨC KHỎE TOÀN DIỆN
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/oral_motor_weakness_hero_img_1779078815111.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- SECTION 1: NGUYÊN NHÂN (Nền Trắng) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl text-navy font-bold mb-6 leading-tight">
                    Thấu hiểu nguyên nhân sâu xa khiến trẻ chậm nói do vận động miệng yếu thay vì trách mắng con
                </h2>
                <p class="text-text-dark text-lg leading-relaxed">
                    Khi một đứa trẻ chậm nói, phản ứng đầu tiên thường là khuyên cha mẹ hãy đợi thêm, hoặc tệ hơn là cho rằng đứa trẻ "lười nói". Sự phán xét này vô tình tạo ra một gánh nặng tâm lý khổng lồ. Thực tế, chứng mất vận động ngôn ngữ (apraxia of speech) hay sự yếu ớt của hệ thống cơ miệng chính là rào cản lớn nhất ngăn cản ý muốn giao tiếp của trẻ được chuyển hóa thành âm thanh [6]. Con rất muốn gọi "mẹ", nhưng đôi môi và chiếc lưỡi nhỏ bé lại không biết phải cử động thế nào cho đúng.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-4">🧠</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4 leading-snug">
                        Rối loạn vận động miệng làm gián đoạn chuỗi lệnh từ não bộ đến cơ hàm như thế nào
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Để nói được một từ đơn giản, não bộ cần gửi đi một loạt các tín hiệu thần kinh chính xác đến môi, hàm, lưỡi và vòm miệng. Đối với trẻ gặp khó khăn về vận động cơ miệng, đường truyền tín hiệu này giống như một mạng lưới điện chập chờn. Não bộ vẫn thiết kế bản vẽ hoàn hảo cho từ ngữ, nhưng các nhóm cơ lại thi hành một cách lộn xộn hoặc yếu ớt [12]. Điều này giải thích tại sao đôi khi con vô thức phát âm rõ, nhưng khi yêu cầu lặp lại con lại chật vật [1].
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-4">🗣️</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4 leading-snug">
                        Phân biệt rõ ràng chậm nói do ngôn ngữ hay do vận động miệng yếu để can thiệp đúng hướng
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Đánh đồng mọi hình thức chậm nói sẽ dẫn đến can thiệp sai lệch. Trẻ chậm phát triển ngôn ngữ thường gặp khó khăn trong việc hiểu lời nói, ít tương tác mắt. Ngược lại, trẻ yếu cơ miệng cực kỳ nhanh nhạy trong giao tiếp phi ngôn ngữ [4]. Việc phân định rõ <a href="https://hieucontugoc.online/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu" class="text-navy font-bold underline hover:text-yellow">chậm nói do ngôn ngữ hay do vận động miệng yếu</a> là bước đầu tiên thiết yếu để xây dựng lộ trình đồng hành hiệu quả.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: DẤU HIỆU (Nền Cream) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl text-navy font-bold mb-6 leading-tight">
                    Những dấu hiệu sinh lý và thể chất đi kèm giúp mẹ nhận diện cơ miệng con đang gặp khó khăn
                </h2>
                <p class="text-text-dark text-lg leading-relaxed">
                    Lời nói là kết quả cao nhất của chuỗi vận động vùng miệng. Trước khi trẻ có thể nói rõ ràng, các nhóm cơ này phải phục vụ tốt chức năng sinh tồn cơ bản như ăn, uống và kiểm soát nước bọt. Các chuyên gia y khoa nhấn mạnh rằng sự yếu ớt thể chất ở vùng miệng thường đi kèm với những biểu hiện sinh lý đặc trưng mà phụ huynh hay vô tình lướt qua [10].
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-4">💧</div>
                    <h3 class="text-xl text-navy font-bold mb-4 leading-snug">
                        Trẻ tự kỷ chảy nước dãi nhiều và sự yếu ớt của các nhóm cơ vùng mặt
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Kiểm soát và nuốt nước bọt diễn ra liên tục nhờ cơ hàm và môi. Khi cơ quá yếu, môi trẻ thường mở ra, lưỡi thụt lùi, khiến nước bọt chảy tự do [18]. Hiện tượng <a href="https://hieucontugoc.online/tre-tu-ky-chay-nuoc-dai-nhieu" class="text-navy font-bold underline hover:text-yellow">trẻ tự kỷ chảy nước dãi nhiều</a> là minh chứng nét cho thấy hệ thống cơ mặt đang thiếu hụt trương lực cần thiết để khép kín khẩu hình [11].
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-4">🍽️</div>
                    <h3 class="text-xl text-navy font-bold mb-4 leading-snug">
                        Khó khăn khi nhai nuốt thức ăn thô báo hiệu rào cản vận động miệng họng trẻ tự kỷ
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Trẻ có cơ miệng yếu thường ngậm thức ăn lâu, từ chối thức ăn thô cứng. Khả năng nhai liên quan mật thiết đến cử động xoay tròn của hàm và sự linh hoạt của lưỡi [14]. Sự thiếu linh hoạt trong <a href="https://hieucontugoc.online/van-dong-mieng-hong-tre-tu-ky" class="text-navy font-bold underline hover:text-yellow">vận động miệng họng trẻ tự kỷ</a> chính là lời giải thích khoa học cho chứng kén ăn.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white rounded-2xl p-8 shadow-sm hover:shadow-md transition-shadow">
                    <div class="text-4xl mb-4">👄</div>
                    <h3 class="text-xl text-navy font-bold mb-4 leading-snug">
                        Con chật vật khi bắt chước các cử động chu môi hoặc tặc lưỡi đơn giản
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Trẻ yếu cơ miệng chật vật với các biểu cảm khuôn mặt cơ bản. Não bộ con dường như không biết cách chỉ huy đôi môi chu ra phía trước để hôn gió hay thổi tắt nến [13]. Những nỗ lực vụng về này là manh mối y khoa quan trọng cha mẹ cần ghi nhận để trao đổi với chuyên gia [7].
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: PHƯƠNG PHÁP (Nền Trắng) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl text-navy font-bold mb-6 leading-tight">
                    Phương pháp oral motor therapy là gì và giải thích dễ hiểu cho mẹ để áp dụng tại nhà
                </h2>
                <p class="text-text-dark text-lg leading-relaxed">
                    Liệu pháp vận động miệng chính là phòng tập gym dành riêng cho các cơ bắp vùng mặt. Để hiểu rõ <a href="https://hieucontugoc.online/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me" class="text-navy font-bold underline hover:text-yellow">oral motor therapy là gì? giải thích dễ hiểu cho mẹ</a>, mục tiêu cốt lõi không phải là ép trẻ nói ngay, mà là rèn luyện sức bền, sự dẻo dai của môi, lưỡi, hàm qua các trò chơi vui nhộn, không áp lực [8].
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="bg-cream rounded-2xl p-8 shadow-sm">
                    <div class="text-4xl mb-4">🎈</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4">Cải thiện sức mạnh cơ hàm thông qua các bài tập thổi bong bóng và nhai an toàn</h3>
                    <p class="text-text-dark leading-relaxed">
                        Tại nhà, mẹ có thể biến trị liệu thành giờ chơi. Thổi bong bóng, thổi còi, hay dùng ống hút uống sinh tố đặc buộc môi khép chặt và dùng lực hơi từ bụng [15]. Cung cấp đồ nhai silicon (chewy tubes) giúp cơ hàm hoạt động liên tục, xây dựng lại trương lực cơ đã mất, chuẩn bị cho khẩu hình miệng [12].
                    </p>
                </div>
                <div class="bg-cream rounded-2xl p-8 shadow-sm">
                    <div class="text-4xl mb-4">💆</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4">Đánh thức cảm giác vùng miệng bằng massage nhẹ nhàng giúp con tự tin hơn khi bật âm</h3>
                    <p class="text-text-dark leading-relaxed">
                        Nhiều trẻ yếu cơ miệng bị rối loạn cảm giác (quá nhạy cảm hoặc kém nhạy cảm) [16]. Massage vùng mặt bằng bàn chải silicon mềm mại giúp điều hòa thần kinh cảm giác. Các động tác vuốt ve gò má, ấn nhẹ quanh viền môi gửi tín hiệu tích cực về não bộ, đánh thức các nhóm cơ đang "ngủ quên" [19].
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: HÀNH TRÌNH ĐỒNG HÀNH (Nền Cream) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center max-w-4xl mx-auto mb-12">
                <h2 class="text-3xl md:text-4xl text-navy font-bold mb-6 leading-tight">
                    Hành trình đồng hành cùng con vượt qua rào cản phát âm cần sự kiên nhẫn và đánh giá chuyên sâu
                </h2>
                <p class="text-text-dark text-lg leading-relaxed">
                    Mọi nỗ lực trị liệu tại nhà đều đáng trân trọng, nhưng tình yêu thương cần đi đôi với sự hướng dẫn y khoa. Yếu kém vận động miệng có thể là phần nổi của tảng băng liên quan đến phát triển thần kinh phức tạp [17]. Sự can thiệp sớm, chuẩn xác và đúng phương pháp luôn mang lại điều kỳ diệu cho trẻ.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                <div class="bg-white rounded-2xl p-8 border-t-4 border-navy shadow-sm">
                    <div class="text-4xl mb-4">🏥</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4">
                        Tầm quan trọng của việc làm kiểm tra sức khỏe toàn diện trước khi áp dụng bất kỳ bài tập trị liệu nào
                    </h3>
                    <p class="text-text-dark leading-relaxed mb-6">
                        Mỗi đứa trẻ là một vũ trụ khác biệt. Phụ huynh cần đến cơ sở y tế để loại trừ nguyên nhân thực thể như dính thắng lưỡi [9]. Song song đó, việc thực hiện <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="text-navy font-bold underline hover:text-yellow">kiểm tra sức khỏe toàn diện</a> về thần kinh, vận động và tương tác xã hội là hoàn toàn bắt buộc để phác họa tấm bản đồ rõ nét cho con.
                    </p>
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-6 py-3 rounded-full shadow hover:scale-105 transition-transform">
                        Khảo sát Tình trạng của Bé Ngay
                    </a>
                </div>
                <div class="bg-white rounded-2xl p-8 border-t-4 border-yellow shadow-sm">
                    <div class="text-4xl mb-4">👨‍👩‍👦</div>
                    <h3 class="text-xl md:text-2xl text-navy font-bold mb-4">
                        Môi trường gia đình thấu cảm và không phán xét là liều thuốc tinh thần tốt nhất cho trẻ
                    </h3>
                    <p class="text-text-dark leading-relaxed">
                        Con đã cố gắng hết sức trong giới hạn cơ thể mình. Con cần một người mẹ cổ vũ tận tâm hơn là một giáo viên khắt khe [20]. Đừng ép con nói nếu con chưa sẵn sàng. Sự an toàn, thấu hiểu trong vòng tay gia đình sẽ xoa dịu căng thẳng, giúp con vững tin rằng tiếng nói của con luôn được trân trọng [5].
                    </p>
                </div>
            </div>
            
            <div class="text-center mt-12">
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-navy text-cream font-bold text-lg px-8 py-4 rounded-full shadow-lg hover:bg-navy/90 hover:shadow-xl transition-all block w-fit mx-auto">
                    THỰC HIỆN BẢNG ĐÁNH GIÁ Y KHOA TẠI NHÀ
                </a>
            </div>
        </div>
    </section>

    <!-- SECTION 5: FAQ (Nền Trắng) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl text-navy font-bold mb-10 text-center">
                Giải đáp những trăn trở thường gặp của cha mẹ về tình trạng yếu cơ miệng ở trẻ
            </h2>
            
            <div class="space-y-4">
                <details class="group bg-cream rounded-xl shadow-sm">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Con chậm nói nhưng rất hiểu chuyện thì có phải do cơ miệng yếu không?
                        <span class="transform group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Đúng vậy. Khi não bộ con xử lý tốt thông tin (hiểu ngôn ngữ) nhưng miệng không thể phát âm, nguyên nhân lớn nhất thường nằm ở sự gián đoạn truyền tín hiệu vận động hoặc hệ thống cơ hàm, môi, lưỡi quá yếu để thực hiện khẩu hình.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Các bài tập cơ miệng có thể chữa khỏi hoàn toàn chứng chậm nói không?
                        <span class="transform group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Bài tập cơ miệng giúp xây dựng sức mạnh thể chất làm nền tảng cho việc phát âm. Tuy nhiên, nó không phải là "thuốc tiên". Trẻ vẫn cần sự hỗ trợ của chuyên gia âm ngữ trị liệu để chuyển hóa sức mạnh cơ bắp thành khả năng sản xuất âm thanh có ý nghĩa.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Dấu hiệu nào cho thấy con cần can thiệp vận động miệng khẩn cấp?
                        <span class="transform group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Cha mẹ cần lưu ý ngay nếu con trên 2 tuổi nhưng liên tục chảy dãi, không biết nhai đồ cứng, thường xuyên nghẹn khi ăn, và không thể bắt chước các cử động đơn giản như chu môi, phồng má.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Nên bắt đầu bài tập vận động miệng cho con từ độ tuổi nào?
                        <span class="transform group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Các trò chơi tăng cường sức mạnh vùng miệng (thổi bong bóng, dùng ống hút, nhai đồ gặm an toàn) có thể bắt đầu rất sớm, ngay từ giai đoạn ăn dặm. Tuy nhiên, các liệu pháp trị liệu chuyên sâu cần có đánh giá của chuyên gia.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Làm sao để con hợp tác khi áp dụng các bài massage vùng miệng?
                        <span class="transform group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Đừng ép buộc con. Hãy bắt đầu bằng cách chạm nhẹ vào những vùng ít nhạy cảm như tay, vai, má rồi mới tiến dần đến quanh môi. Hãy biến nó thành một trò chơi nhẹ nhàng kèm theo những bài hát ru êm ái để con cảm thấy an toàn tuyệt đối.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- DISCLAIMER -->
    <section class="bg-gray-100 pb-12 px-6 pt-12 text-center">
        <p class="text-text-soft text-sm italic max-w-3xl mx-auto">
            Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
        </p>
    </section>

    <!-- FOOTER: REFERENCES -->
    <footer class="bg-gray-100 py-12 px-6 border-t border-gray-200">
        <div class="max-w-5xl mx-auto">
            <h4 class="font-oswald text-navy text-xl mb-6 uppercase">Nguồn Tham Khảo Y Khoa & Tâm Lý Học Uy Tín</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-text-soft">
                <ul class="space-y-2">
                    <li>[1] <a href="https://www.understood.org/en/articles/childhood-apraxia-of-speech-what-you-need-to-know" class="hover:text-navy underline">Understood: Childhood Apraxia of Speech</a></li>
                    <li>[2] <a href="https://www.healthline.com/health/speech-delay" class="hover:text-navy underline">Healthline: Understanding Speech Delays</a></li>
                    <li>[3] <a href="https://kidshealth.org/en/parents/not-talk.html" class="hover:text-navy underline">KidsHealth: Delayed Speech or Language</a></li>
                    <li>[4] <a href="https://www.parents.com/toddlers-preschoolers/development/language/speech-delays-in-toddlers/" class="hover:text-navy underline">Parents Magazine: Recognizing Speech Delays</a></li>
                    <li>[5] <a href="https://www.verywellfamily.com/what-is-a-speech-delay-289660" class="hover:text-navy underline">Verywell Family: What Is a Speech Delay?</a></li>
                    <li>[6] <a href="https://www.asha.org/public/speech/disorders/childhood-apraxia-of-speech/" class="hover:text-navy underline">ASHA: Childhood Apraxia of Speech</a></li>
                    <li>[7] <a href="https://www.cdc.gov/ncbddd/childdevelopment/language-disorders.html" class="hover:text-navy underline">CDC: Language and Speech Disorders</a></li>
                    <li>[8] <a href="https://www.autismspeaks.org/speech-therapy-autism" class="hover:text-navy underline">Autism Speaks: Speech Therapy</a></li>
                    <li>[9] <a href="https://www.mayoclinic.org/diseases-conditions/childhood-apraxia-of-speech/symptoms-causes/syc-20352045" class="hover:text-navy underline">Mayo Clinic: Apraxia Symptoms & Causes</a></li>
                    <li>[10] <a href="https://www.nationwidechildrens.org/family-resources-education/700childrens/2018/12/speech-delay-vs-autism-what-parents-need-to-know" class="hover:text-navy underline">Nationwide Children's: Speech Delay vs Autism</a></li>
                </ul>
                <ul class="space-y-2">
                    <li>[11] <a href="https://www.arktherapeutic.com/blog/oral-motor-skills-what-are-they-and-why-are-they-important/" class="hover:text-navy underline">ARK Therapeutic: Oral Motor Skills</a></li>
                    <li>[12] <a href="https://mommyspeechtherapy.com/?p=2158" class="hover:text-navy underline">Mommy Speech Therapy: Oral Motor Exercises</a></li>
                    <li>[13] <a href="https://www.speechandlanguagekids.com/oral-motor-exercises-for-speech-clarity/" class="hover:text-navy underline">Speech And Language Kids: Oral Motor Clarity</a></li>
                    <li>[14] <a href="https://www.thespeech-languageconnection.com/oral-motor-therapy/" class="hover:text-navy underline">The Speech-Language Connection: Demystifying</a></li>
                    <li>[15] <a href="https://leader.pubs.asha.org/do/10.1044/oral-motor-exercises-for-speech-to-use-or-not-to-use/" class="hover:text-navy underline">ASHA Leader: Oral-Motor Exercises</a></li>
                    <li>[16] <a href="https://www.autismparentingmagazine.com/autism-speech-delay/" class="hover:text-navy underline">Autism Parenting Magazine: Speech Delays</a></li>
                    <li>[17] <a href="https://www.myautismteam.com/resources/speech-delays-and-autism" class="hover:text-navy underline">My Autism Team: Speech Delays and Autism</a></li>
                    <li>[18] <a href="https://theautismhelper.com/the-role-of-oral-motor-in-speech/" class="hover:text-navy underline">The Autism Helper: Role of Oral Motor</a></li>
                    <li>[19] <a href="https://themighty.com/topic/autism-spectrum-disorder/nonverbal-autism-speech-delay-reality/" class="hover:text-navy underline">The Mighty: Nonverbal Autism Reality</a></li>
                    <li>[20] <a href="https://findingcoopersvoice.com/2018/02/21/the-reality-of-apraxia/" class="hover:text-navy underline">Finding Cooper's Voice: Reality of Apraxia</a></li>
                </ul>
            </div>
        </div>
    </footer>
</main>

<script>
    // Ensure all accordions work smoothly if standard <details> is modified
    const details = document.querySelectorAll("details");
    details.forEach((targetDetail) => {
        targetDetail.addEventListener("click", () => {
            details.forEach((detail) => {
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