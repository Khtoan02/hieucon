<?php /* Template Name: Tre_Tu_Ky_Hay_Dau_Bung_Khong_Ro_Nguyen_Nhan_Landing */ ?>

<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vì sao trẻ tự kỷ hay đau bụng không rõ nguyên nhân?</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS -->
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
        /* Tùy chỉnh ẩn mũi tên mặc định của details/summary */
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }

        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; scroll-behavior: smooth; }
        h1, h2, h3 { font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; }
        /* Liên kết trong nội dung */
        .content-link {
            color: #002795;
            text-decoration: underline;
            text-decoration-color: #FFD154;
            text-decoration-thickness: 2px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .content-link:hover {
            color: #3D3D3D;
            background-color: #FFD154;
            text-decoration: none;
        }
    </style>
</head>
<body class="font-quicksand text-text-dark bg-white antialiased leading-relaxed">

    <main>
        <!-- HERO SECTION -->
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
                    VÌ SAO TRẺ TỰ KỶ HAY ĐAU BỤNG KHÔNG RÕ NGUYÊN NHÂN
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Làm cha mẹ của một em bé có rối loạn phổ tự kỷ là một hành trình đòi hỏi sự kiên nhẫn và tình yêu thương vô bờ bến. Có lẽ không ít lần, bạn cảm thấy xót xa và hoang mang khi thấy con khóc lóc, cáu gắt hoặc gồng mình mà không rõ lý do. Thực tế, trẻ tự kỷ hay đau bụng không rõ nguyên nhân là một tình trạng rất phổ biến nhưng lại thường bị hiểu lầm. Hãy cùng giải mã tiếng kêu cứu thầm lặng của cơ thể con.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Thực Hiện Đánh Giá Sức Khỏe Cho Con Ngay
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/stuffing_hero_img_1779078774052.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

        <!-- SECTION 1: NỖI ĐAU THẦM LẶNG (BG-WHITE) -->
        <section class="py-16 md:py-24 px-6 bg-white">
            <div class="max-w-5xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Nỗi đau thầm lặng khi con không thể nói ra cảm giác khó chịu của cơ thể
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-cream rounded-2xl p-8 shadow-sm">
                        <div class="text-4xl mb-4">😶</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Những rào cản giao tiếp khiến cha mẹ dễ nhầm lẫn cơn đau với hành vi khó chiều
                        </h3>
                        <p class="text-text-dark">
                            Nhiều em bé tự kỷ gặp khó khăn trong việc sử dụng ngôn ngữ nói để diễn đạt mong muốn của mình [8]. Khi con cảm thấy đau đớn ở bụng, thay vì nói "mẹ ơi con đau", con có thể phản ứng bằng cách ném đồ đạc, tự làm đau bản thân hoặc khóc thét kéo dài [17]. Đáng buồn thay, những biểu hiện này thường bị đánh đồng với hành vi bùng nổ cảm xúc hoặc sự khó chiều thường thấy ở trẻ [13]. Sự nhầm lẫn này khiến những vấn đề y tế thực sự bị bỏ qua, để lại con một mình chống chọi với cơn đau trong sự cô độc.
                        </p>
                    </div>
                    <div class="bg-cream rounded-2xl p-8 shadow-sm">
                        <div class="text-4xl mb-4">🧩</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Khó khăn trong việc nhận biết tín hiệu bên trong cơ thể của những em bé phát triển khác biệt
                        </h3>
                        <p class="text-text-dark">
                            Khả năng cảm nhận các tín hiệu từ bên trong cơ thể, hay còn gọi là interoception, thường bị suy giảm hoặc rối loạn ở trẻ có phổ tự kỷ [18]. Điều này có nghĩa là con có thể không nhận thức rõ ràng được cảm giác no, đói, hoặc vị trí chính xác của cơn đau [19]. Đôi khi, cơn đau quặn thắt ở ruột lại được con cảm nhận một cách mơ hồ hoặc bị khuếch đại thành một sự hoảng loạn toàn thân. Việc con không thể tự định vị cơn đau là rào cản lớn khiến tình trạng đau bụng kéo dài mà không được xử lý kịp thời.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: NGUYÊN NHÂN SÂU XA (BG-CREAM) -->
        <section class="py-16 md:py-24 px-6 bg-cream">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Lý giải nguyên nhân sâu xa khiến trẻ tự kỷ hay gặp vấn đề về tiêu hóa
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md">
                        <div class="text-4xl mb-4">🧠</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Mối liên hệ mật thiết giữa sự phát triển não bộ và cơ chế trục ruột não
                        </h3>
                        <p class="text-text-dark">
                            Hệ tiêu hóa và não bộ luôn trò chuyện với nhau thông qua mạng lưới thần kinh phức tạp. Các nghiên cứu chỉ ra rằng những rối loạn ở <a href="https://hieucontugoc.online/truc-ruot-nao-tu-ky" class="content-link">trục ruột não & tự kỷ</a> có tác động rất lớn đến sức khỏe thể chất lẫn hành vi của trẻ [4, 14]. Khi đường ruột gặp vấn đề, nó sẽ gửi tín hiệu căng thẳng lên não, khiến trẻ lo âu, dễ kích động. Ngược lại, sự căng thẳng ở não bộ cũng làm giảm nhu động ruột, tạo ra vòng lặp của cơn đau và sự bất ổn tâm lý.
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md">
                        <div class="text-4xl mb-4">🦠</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Sự mất cân bằng hệ vi sinh và tình trạng dysbiosis đường ruột
                        </h3>
                        <p class="text-text-dark">
                            Hệ vi sinh vật đường ruột đóng vai trò như bộ não thứ hai, bảo vệ cơ thể. Ở nhiều em bé, sự đa dạng của các vi khuẩn có lợi bị suy giảm, dẫn đến tình trạng <a href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky" class="content-link">dysbiosis đường ruột ở trẻ tự kỷ</a> [1, 9]. Sự mất cân bằng này tạo điều kiện cho vi khuẩn có hại sinh sôi, gây ra hiện tượng viêm nhiễm nhẹ nhưng kéo dài. Quá trình viêm này chính là thủ phạm âm thầm tạo ra những cơn đau quặn bụng, đầy hơi khiến con không thể yên giấc.
                        </p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md">
                        <div class="text-4xl mb-4">🌾</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Tình trạng nhạy cảm thức ăn và cân nhắc về chế độ ăn loại bỏ
                        </h3>
                        <p class="text-text-dark">
                            Nhiều trẻ tự kỷ có hệ tiêu hóa cực kỳ nhạy cảm với một số loại protein cụ thể như gluten và casein [6]. Khi cơ thể không dung nạp được, chúng sẽ kích hoạt phản ứng viêm và gây đau đớn. Đây là lý do chuyên gia thường thảo luận về <a href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky" class="content-link">chế độ ăn không gluten casein (gfcf) cho trẻ tự kỷ</a> [10]. Việc điều chỉnh dinh dưỡng nhằm loại bỏ tác nhân gây viêm, giúp hệ tiêu hóa của con được nghỉ ngơi.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: DẤU HIỆU TINH TẾ (BG-WHITE) -->
        <section class="py-16 md:py-24 px-6 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Những dấu hiệu tinh tế báo hiệu con đang bị đau bụng hoặc rối loạn tiêu hóa
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100">
                        <div class="text-4xl mb-4">🌙</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Những thay đổi bất thường trong giấc ngủ báo hiệu vấn đề dạ dày
                        </h3>
                        <p class="text-text-dark">
                            Giấc ngủ phản chiếu rõ nhất tình trạng sức khỏe bên trong. Nếu con thường xuyên trằn trọc, thức giấc và khóc thét, rất có thể con đang gặp trục trặc về <a href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky" class="content-link">tiêu hóa dạ dày trẻ tự kỷ</a> [2, 5]. Trào ngược axit hay co thắt thường tồi tệ hơn khi con nằm xuống. Sự gián đoạn này làm con kiệt sức và trầm trọng thêm hành vi thách thức vào ngày hôm sau.
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100">
                        <div class="text-4xl mb-4">🫂</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Hiểu đúng về hành vi tự kích thích hoặc gồng mình tự xoa dịu
                        </h3>
                        <p class="text-text-dark">
                            Khi đối mặt với cơn đau vượt ngưỡng, con sẽ tìm cách tự xoa dịu. Hành vi tỳ bụng vào cạnh bàn, nằm sấp cuộn tròn người, hoặc liên tục đập tay vào bụng không phải là vô nghĩa [16, 20]. Đó là cách con dùng áp lực vật lý để làm giảm bớt cơn co thắt bên trong. Việc hiểu đúng giúp cha mẹ thay vì ngăn cản, sẽ ôm ấp và tìm cách chườm ấm cho con.
                        </p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100">
                        <div class="text-4xl mb-4">🚽</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Dấu hiệu nhận biết tình trạng táo bón mãn tính thường bị bỏ sót
                        </h3>
                        <p class="text-text-dark">
                            Táo bón rất dễ bị bỏ qua. Tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh" class="content-link">trẻ tự kỷ táo bón mãn tính</a> đôi khi biểu hiện qua việc són phân lỏng ra quần (phân lỏng tràn qua khối phân cứng) [7, 11]. Những dấu hiệu khác như con lảng tránh phòng tắm, sợ hãi khi ngồi bồn cầu, hoặc có tư thế đi lại cứng nhắc cũng là những tín hiệu báo động đỏ cần lưu tâm [12].
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: GIẢI PHÁP HÀNH ĐỘNG (BG-CREAM) -->
        <section class="py-16 md:py-24 px-6 bg-cream">
            <div class="max-w-5xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Cha mẹ có thể làm gì để xoa dịu cơn đau và cải thiện sức khỏe thể chất cho con
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center bg-white p-8 md:p-12 rounded-3xl shadow-lg">
                    <div>
                        <div class="mb-8">
                            <h3 class="font-oswald text-navy text-2xl font-bold mb-3">
                                Ghi chép lại nhật ký sinh hoạt để tìm ra quy luật của những cơn đau nhức ẩn giấu
                            </h3>
                            <p class="text-text-dark">
                                Hãy kiên nhẫn ghi lại những món con ăn, thời gian đi vệ sinh, hình thái phân, và thời điểm con gồng mình hay cáu gắt [3, 15]. Dữ liệu thực tế này giúp bạn xác định được nhóm thực phẩm gây dị ứng hoặc thời điểm tiêu hóa nhạy cảm nhất.
                            </p>
                        </div>
                        <div>
                            <h3 class="font-oswald text-navy text-2xl font-bold mb-3">
                                Đánh giá tình trạng của con qua bảng kiểm tra để có cơ sở làm việc cùng bác sĩ
                            </h3>
                            <p class="text-text-dark">
                                Việc hoàn thành <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="content-link">kiểm tra sức khỏe toàn diện</a> giúp bạn có cái nhìn hệ thống và không bỏ sót chi tiết nào. Đây chính là tiếng nói đại diện mạnh mẽ nhất để bác sĩ có thể thấu hiểu và lên phác đồ hỗ trợ phù hợp.
                            </p>
                        </div>
                    </div>
                    <div class="flex flex-col items-center justify-center text-center bg-cream p-8 rounded-2xl h-full border border-gray-100">
                        <div class="text-6xl mb-6">📝</div>
                        <h4 class="font-oswald text-navy text-xl font-bold mb-4">Bạn không đơn độc trên hành trình này</h4>
                        <p class="text-text-soft mb-8">Hãy bắt đầu bằng việc quan sát và ghi nhận cẩn thận từng biểu hiện của con thông qua bảng đánh giá chuyên sâu của chúng tôi.</p>
                        <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-full text-center">
                            Bảng kiểm tra sức khỏe toàn diện
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5: FAQ (BG-WHITE) -->
        <section class="py-16 md:py-24 px-6 bg-white">
            <div class="max-w-3xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Giải đáp những thắc mắc thường gặp của cha mẹ về sức khỏe đường ruột của con
                </h2>
                
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <details class="group bg-cream rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold outline-none flex justify-between items-center">
                            Tại sao con tôi lại kén ăn và chỉ ăn một vài món nhất định?
                            <span class="text-yellow text-2xl transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark border-t border-gray-200 mt-2 pt-4">
                            Việc kén ăn thường không phải do con bướng bỉnh. Đôi khi, do kết cấu thức ăn gây khó chịu về mặt giác quan, hoặc do cơ thể con vô thức tránh né những món từng gây đau bụng trước đây. Hãy kiên nhẫn giới thiệu thức ăn mới một cách từ từ.
                        </div>
                    </details>
                    
                    <!-- FAQ 2 -->
                    <details class="group bg-cream rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold outline-none flex justify-between items-center">
                            Làm sao để biết con đang bị đau bụng hay chỉ đang tức giận?
                            <span class="text-yellow text-2xl transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark border-t border-gray-200 mt-2 pt-4">
                            Hãy quan sát các biểu hiện đi kèm. Nếu sự bùng nổ cảm xúc đi kèm với việc con ôm bụng, đổ mồ hôi, mặt nhợt nhạt hoặc thay đổi thói quen đi vệ sinh, rất có thể nguyên nhân bắt nguồn từ nỗi đau thể chất.
                        </div>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="group bg-cream rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold outline-none flex justify-between items-center">
                            Tôi có nên tự ý cho con uống men vi sinh không?
                            <span class="text-yellow text-2xl transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark border-t border-gray-200 mt-2 pt-4">
                            Men vi sinh có thể hỗ trợ hệ vi sinh đường ruột, nhưng mỗi trẻ có một hệ vi sinh khác nhau. Tốt nhất, bạn nên tham khảo ý kiến bác sĩ để chọn chủng men phù hợp, tránh gây ra tình trạng đầy hơi nghiêm trọng hơn.
                        </div>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="group bg-cream rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold outline-none flex justify-between items-center">
                            Mất bao lâu để thấy sự cải thiện khi thay đổi chế độ ăn?
                            <span class="text-yellow text-2xl transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark border-t border-gray-200 mt-2 pt-4">
                            Mỗi cơ thể có một tốc độ thích ứng riêng. Thông thường, cần từ 3 đến 6 tháng duy trì chế độ ăn kiêng hoặc bổ sung dinh dưỡng nghiêm ngặt để đường ruột thực sự phục hồi và thể hiện ra bằng sự thay đổi tích cực trong hành vi.
                        </div>
                    </details>

                    <!-- FAQ 5 -->
                    <details class="group bg-cream rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold outline-none flex justify-between items-center">
                            Khám tiêu hóa cho con có cần thiết phải nội soi không?
                            <span class="text-yellow text-2xl transition-transform group-open:rotate-45">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark border-t border-gray-200 mt-2 pt-4">
                            Không phải lúc nào cũng cần nội soi. Bác sĩ chuyên khoa tiêu hóa sẽ bắt đầu bằng việc khám lâm sàng, siêu âm, xét nghiệm phân và phân tích nhật ký sinh hoạt mà bạn cung cấp trước khi đưa ra các chỉ định chuyên sâu hơn.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- DISCLAIMER SECTION -->
        <section class="bg-gray-100 pt-16 pb-6 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <p class="text-text-soft text-sm italic">
                    Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
                </p>
            </div>
        </section>

        <!-- REFERENCES FOOTER -->
        <footer class="bg-gray-100 pb-12 px-6">
            <div class="max-w-4xl mx-auto border-t border-gray-300 pt-8">
                <h4 class="font-oswald text-text-dark text-lg font-bold mb-4">Nguồn Tham Khảo Học Thuật Đại Chúng:</h4>
                <ul class="text-sm text-text-soft space-y-2 list-none p-0">
                    <li>[1] Spectrum News: Gastrointestinal problems in autism, explained (https://www.spectrumnews.org/news/gastrointestinal-problems-in-autism-explained/)</li>
                    <li>[2] Verywell Health: Stomach Pain and Digestive Issues in Autism (https://www.verywellhealth.com/gastrointestinal-issues-and-autism-4134015)</li>
                    <li>[3] Healthline: Autism and Digestive Issues: What’s the Connection? (https://www.healthline.com/health/autism/autism-and-digestive-issues)</li>
                    <li>[4] Psychology Today: The Gut-Brain Connection in Autism (https://www.psychologytoday.com/us/blog/the-fallible-mind/201701/the-gut-brain-connection-in-autism)</li>
                    <li>[5] Parents Magazine: Understanding Medical Issues in Children with Autism (https://www.parents.com/health/autism/understanding-medical-issues-in-children-with-autism/)</li>
                    <li>[6] Autism Speaks: Gastrointestinal (GI) Issues in Autism (https://www.autismspeaks.org/gastrointestinal-gi-issues-autism)</li>
                    <li>[7] Centers for Disease Control and Prevention (CDC): Associated Medical Conditions with Autism Spectrum Disorder (https://www.cdc.gov/ncbddd/autism/data.html)</li>
                    <li>[8] Understood: Why Kids With Autism Might Have Tummy Troubles (https://www.understood.org/en/articles/autism-and-stomach-issues)</li>
                    <li>[9] Autism Research Institute: Gastrointestinal Issues and Autism (https://autism.org/gastrointestinal-issues-and-autism/)</li>
                    <li>[10] National Autistic Society (UK): Constipation, Diet and Autism (https://www.autism.org.uk/advice-and-guidance/topics/physical-health/diet-and-bowels)</li>
                    <li>[11] Children's Hospital of Philadelphia (CHOP): GI Symptoms in Children with Autism Spectrum Disorder (https://www.chop.edu/news/gi-symptoms-children-autism-spectrum-disorder)</li>
                    <li>[12] Nationwide Children's Hospital: Autism and Gastrointestinal Disorders (https://www.nationwidechildrens.org/family-resources-education/700childrens/2015/08/autism-and-gastrointestinal-disorders)</li>
                    <li>[13] Child Mind Institute: Medical Issues That Can Be Mistaken for Behavioral Issues (https://childmind.org/article/medical-causes-behavior-problems/)</li>
                    <li>[14] Cleveland Clinic Health Essentials: How Gut Health Affects Children With Autism (https://health.clevelandclinic.org/how-gut-health-affects-children-with-autism/)</li>
                    <li>[15] Seattle Children’s Hospital Blog: Autism and GI Issues: What Parents Need to Know (https://pulse.seattlechildrens.org/autism-and-gi-issues-what-parents-need-to-know/)</li>
                    <li>[16] Autism Parenting Magazine: GI Problems in Children with Autism: A Parent's Guide (https://www.autismparentingmagazine.com/gi-problems-autism/)</li>
                    <li>[17] The Mighty: What to Know When Your Autistic Child Has Unexplained Stomach Pain (https://themighty.com/topic/autism-spectrum-disorder/autism-unexplained-stomach-pain/)</li>
                    <li>[18] Spark for Autism: Unraveling the Mystery of GI Issues and Autism (https://sparkforautism.org/discover_article/gi-issues-autism/)</li>
                    <li>[19] Thinking Person's Guide to Autism: Autistic Perspectives on Gut Health and Pain (http://www.thinkingautismguide.com/2018/05/autistic-perspectives-on-gut-health.html)</li>
                    <li>[20] Action for Autism: Parent Forum Discussions on Managing Tummy Aches (https://www.actionforautism.co.uk/forum/diet-and-health/managing-tummy-aches)</li>
                </ul>
            </div>
        </footer>
    </main>
    <?php get_footer(); ?>