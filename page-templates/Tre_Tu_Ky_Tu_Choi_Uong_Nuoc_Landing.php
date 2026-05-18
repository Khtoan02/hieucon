<?php /* Template Name: Tre_Tu_Ky_Tu_Choi_Uong_Nuoc_Landing */ ?>
<?php get_header(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vì sao trẻ tự kỷ từ chối uống nước và mẹo cải thiện là gì?</title>
    <meta name="description" content="Tìm hiểu nguyên nhân sâu xa vì sao trẻ tự kỷ từ chối uống nước dưới lăng kính giác quan. Khám phá các mẹo dịu dàng giúp con bù nước và cải thiện tiêu hóa.">
    
    <!-- Google Fonts -->
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

        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; }
        h1, h2, h3, h4, h5, h6, .font-oswald { font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; }
        
        /* Custom Accordion Icon Animation */
        details > summary::-webkit-details-marker {
            display: none;
        }
        details > summary::after {
            content: '+';
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 1.5rem;
            color: #002795;
            transition: all 0.3s;
        }
        details[open] > summary::after {
            content: '−';
        }
    </style>
</head>
<body class="font-quicksand text-text-dark bg-white antialiased leading-relaxed">

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
                    VÌ SAO TRẺ TỰ KỶ TỪ CHỐI UỐNG NƯỚC VÀ NHỮNG MẸO NHỎ GIÚP CON BÙ NƯỚC TỰ NHIÊN
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Mỗi ngày, việc mời con uống một ngụm nước lọc tưởng chừng đơn giản lại có thể biến thành một cuộc chiến. Chúng ta thường lầm tưởng con đang bướng bỉnh, nhưng sự thật ẩn sâu bên trong lại đến từ lăng kính giác quan hoàn toàn khác biệt. Hãy cùng bước vào thế giới ấy để hiểu con hơn, từ đó tìm ra những cách thức dịu dàng giúp con nạp đủ nước mà không cần bất kỳ sự ép buộc nào.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Làm Bài Đánh Giá Thể Trạng Cho Con Ngay
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/vat_ly_tri_lieu_hero_vi_1779077058220.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <main>
        <!-- SECTION 1: NGUYÊN NHÂN (WHITE) -->
        <section class="bg-white py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy text-center mb-16 font-semibold">
                    Thấu hiểu nguyên nhân sâu xa khiến con cảm thấy sợ hãi hoặc né tránh việc uống nước
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">💧</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 font-semibold">
                            Rào cản vô hình từ sự nhạy cảm với nhiệt độ và hương vị của nước lọc
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Với trẻ nhạy cảm giác quan, khái niệm "vô vị" của nước lọc không tồn tại [1]. Con có thể nếm được khoáng chất vi lượng, mùi ống nước, hoặc thấy khó chịu với nhiệt độ hơi lạnh [11]. Sự nhạy cảm cực độ này khiến mỗi ngụm nước trở thành một trải nghiệm đầy bất an, khiến con phản ứng bằng cách từ chối để bảo vệ bản thân.
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">🧠</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 font-semibold">
                            Cảm giác khó chịu với kết cấu của nước và những trải nghiệm ăn uống tiêu cực
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Kết cấu mỏng, chảy nhanh của nước đòi hỏi khả năng phối hợp cơ miệng nhịp nhàng. Nếu trẻ gặp khó khăn điều hòa vận động miệng, nước rất dễ gây sặc [6]. Vài lần sặc nước hay hoảng sợ trong quá khứ có thể tạo thành rào cản tâm lý sâu sắc [8], khiến con gắn liền cốc nước với sự nguy hiểm [12].
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">🧩</div>
                        <h3 class="font-oswald text-navy text-xl mb-4 font-semibold">
                            Khó khăn trong việc nhận biết tín hiệu khát do rối loạn cảm nhận bản thể
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Hệ thống cảm nhận bản thể giúp nhận biết tín hiệu đói, no hay khát bên trong cơ thể [4]. Ở nhiều trẻ, hệ thống này hoạt động không nhất quán [5]. Ngay cả khi cơ thể thiếu nước nghiêm trọng, não bộ con vẫn không dịch mã được tín hiệu "đang khát". Con không uống đơn giản vì không hề cảm thấy cần.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: HỆ TIÊU HÓA (CREAM) - 2 COLUMN LAYOUT -->
        <section class="bg-cream py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <!-- Left: Nỗi đau -->
                <div>
                    <h2 class="font-oswald text-3xl md:text-4xl text-navy mb-6 font-semibold leading-tight">
                        Mối liên hệ mật thiết giữa tình trạng thiếu nước và hệ tiêu hóa dạ dày trẻ tự kỷ
                    </h2>
                    <p class="font-quicksand text-lg text-text-soft mb-8">
                        Nước là thành phần cốt lõi để hệ tiêu hóa vận hành. Khi vòng lặp thiếu nước kéo dài, nó không chỉ dừng lại ở cảm giác khát mà còn kích hoạt một chuỗi phản ứng dây chuyền ảnh hưởng trực tiếp đến thể trạng, hệ vi sinh và thậm chí là hệ thần kinh của con.
                    </p>
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-md hover:scale-105 transition-all inline-block">
                        Kiểm Tra Thể Trạng Tiêu Hóa
                    </a>
                </div>

                <!-- Right: Góc nhìn khoa học -->
                <div class="space-y-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-navy">
                        <h3 class="font-oswald text-navy text-xl mb-2 font-semibold">
                            Nguy cơ khiến trẻ tự kỷ táo bón mãn tính trở nên trầm trọng hơn
                        </h3>
                        <p class="font-quicksand text-text-dark text-sm">
                            Khi cơ thể thiếu hụt chất lỏng, đại tràng sẽ tăng cường hấp thu lại nước từ phân. Hậu quả là phân khô cứng, làm trầm trọng thêm tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh" class="text-navy font-semibold hover:underline">trẻ tự kỷ táo bón mãn tính</a> [10]. Vòng lặp đau đớn khi đi vệ sinh khiến con càng sợ hãi đồ uống [15].
                        </p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-navy">
                        <h3 class="font-oswald text-navy text-xl mb-2 font-semibold">
                            Thúc đẩy tình trạng dysbiosis đường ruột ở trẻ tự kỷ
                        </h3>
                        <p class="font-quicksand text-text-dark text-sm">
                            Sự thiếu hụt nước mãn tính làm thay đổi môi trường sống của lợi khuẩn. Tình trạng mất cân bằng này, hay <a href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky" class="text-navy font-semibold hover:underline">dysbiosis đường ruột ở trẻ tự kỷ</a>, gây hệ lụy về hấp thu dinh dưỡng và miễn dịch [10]. Bù nước là bước phòng vệ đầu tiên cho thảm vi sinh đường ruột.
                        </p>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border-l-4 border-navy">
                        <h3 class="font-oswald text-navy text-xl mb-2 font-semibold">
                            Tác động dây chuyền của tiêu hóa lên trục ruột não khiến con căng thẳng
                        </h3>
                        <p class="font-quicksand text-text-dark text-sm">
                            Hệ <a href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky" class="text-navy font-semibold hover:underline">tiêu hóa dạ dày trẻ tự kỷ</a> liên lạc trực tiếp với não bộ. Sự gián đoạn trong <a href="https://hieucontugoc.online/truc-ruot-nao-tu-ky" class="text-navy font-semibold hover:underline">trục ruột não & tự kỷ</a> do thiếu nước có thể biểu hiện qua các đợt bùng nổ cảm xúc hoặc hành vi rập khuôn [15]. Chăm sóc tiêu hóa chính là giúp hệ thần kinh dịu lại.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3: MẸO CẢI THIỆN (WHITE) -->
        <section class="bg-white py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy text-center mb-16 font-semibold">
                    Những mẹo dịu dàng giúp cha mẹ khuyến khích con nạp đủ nước mà không cần ép buộc
                </h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md">
                        <h3 class="font-oswald text-navy text-xl mb-3 font-semibold flex items-center gap-2">
                            <span>🥤</span> Thay đổi hình dáng cốc hoặc ống hút
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Việc từ chối đôi khi xuất phát từ chiếc cốc (cốc rộng làm nước chảy ập, cốc thủy tinh gây tiếng ồn). Hãy thử bình có van chống sặc, ống hút xoắn ốc tạo thị giác, hoặc ống hút silicon mềm không làm đau nướu [11]. Điều này giúp con kiểm soát dòng chảy, mang lại cảm giác an toàn và dễ đoán [14].
                        </p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md">
                        <h3 class="font-oswald text-navy text-xl mb-3 font-semibold flex items-center gap-2">
                            <span>🍉</span> Chủ động bổ sung lượng nước ẩn qua thực phẩm
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Nếu uống chất lỏng trực tiếp khó khăn, hãy nạp nước vô hình qua trái cây như dưa hấu, dâu tây, lê (chứa đến 90% nước) [13]. Súp, canh hầm nhừ, hay sinh tố cũng là nguồn cung cấp chất lỏng tuyệt vời [20]. Con vẫn được giữ ẩm tự nhiên mà không cảm thấy đang bị "ép uống".
                        </p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md">
                        <h3 class="font-oswald text-navy text-xl mb-3 font-semibold flex items-center gap-2">
                            <span>🥛</span> Đảm bảo đủ nước khi áp dụng chế độ ăn GFCF
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Khi gia đình áp dụng <a href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky" class="text-navy font-semibold hover:underline">chế độ ăn không gluten casein (gfcf) cho trẻ tự kỷ</a>, bột không gluten có tính hút nước cao đòi hỏi cơ thể đủ chất lỏng [10]. Cha mẹ có thể sáng tạo làm sữa hạt pha loãng hoặc nước hầm xương dồi dào khoáng chất để con nhấm nháp [15].
                        </p>
                    </div>

                    <!-- Card 4 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md">
                        <h3 class="font-oswald text-navy text-xl mb-3 font-semibold flex items-center gap-2">
                            <span>🧊</span> Khám phá kết cấu đồ uống mới lạ
                        </h3>
                        <p class="font-quicksand text-text-dark text-base">
                            Nếu con sợ nước mỏng và trôi nhanh, hãy làm đặc nước bằng cách xay cùng xoài, chuối để tạo độ sánh [12]. Làm đá viên từ nước ép nhạt hoặc kem mút (popsicle) vừa cung cấp nước, vừa đáp ứng nhu cầu đầu vào giác quan cho những trẻ thích cảm giác mát lạnh và giòn rụm [16].
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: GIẢI PHÁP TỔNG THỂ & CTA (CREAM) -->
        <section class="bg-cream py-16 md:py-24 px-5 text-center">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy mb-6 font-semibold">
                    Nhìn nhận tổng thể bức tranh thể trạng của con để có hướng hỗ trợ vững chắc nhất
                </h2>
                <h3 class="font-oswald text-xl text-text-dark mb-6">
                    Ý nghĩa của việc thực hiện kiểm tra sức khỏe toàn diện để tháo gỡ tận gốc những khó khăn
                </h3>
                <p class="font-quicksand text-lg text-text-soft mb-10 leading-relaxed">
                    Việc từ chối uống nước có thể là phần nổi của một tảng băng chìm, liên quan đến trào ngược thầm lặng, dị ứng hay thiếu hụt khoáng chất [9]. Để không dò dẫm trong âu lo, cha mẹ cần một cái nhìn khoa học. Thực hiện kiểm tra chuyên sâu giúp đánh giá tình trạng hydrat hóa, phân tích tiêu hóa và rà soát thể chất. Từ dữ liệu đó, chúng ta mới có thể xây dựng chiến lược can thiệp yêu thương và an toàn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg uppercase tracking-wide">
                    Kiểm Tra Sức Khỏe Toàn Diện Ngay
                </a>
            </div>
        </section>

        <!-- SECTION 5: FAQ (WHITE) -->
        <section class="bg-white py-16 md:py-24 px-5">
            <div class="max-w-4xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy text-center mb-12 font-semibold">
                    Giải đáp những băn khoăn thường gặp của cha mẹ trên hành trình tập cho con uống nước
                </h2>

                <details class="group bg-cream rounded-xl shadow-sm mb-4 relative" open>
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none pr-12">
                        Làm sao để biết con đang bị thiếu nước nếu con không bao giờ biết nói khát?
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Cha mẹ hãy quan sát các dấu hiệu sinh lý như: nước tiểu màu vàng sẫm hoặc có mùi nồng, môi khô nứt nẻ, da mất độ đàn hồi, hoặc con ít đi vệ sinh hơn bình thường. Ngoài ra, sự mệt mỏi, cáu gắt thất thường hoặc táo bón cũng là những cảnh báo sớm về việc thiếu hụt chất lỏng [17].
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm mb-4 relative">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none pr-12">
                        Có nên dùng các loại nước tạo ngọt hoặc nước trái cây đóng hộp thay nước lọc không?
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Nên hạn chế tối đa nước trái cây đóng hộp vì chúng chứa lượng đường hóa học khổng lồ, có thể gây quá tải cho hệ tiêu hóa và làm tăng hiện tượng viêm [18]. Thay vào đó, hãy tự pha loãng một chút nước ép trái cây tươi nguyên chất vào nước lọc để tạo hương vị tự nhiên.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm mb-4 relative">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none pr-12">
                        Con tôi chỉ thích uống nước lạnh ngắt, điều này có ảnh hưởng gì tới dạ dày không?
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Nhiều trẻ có xu hướng tìm kiếm cảm giác mạnh từ nhiệt độ lạnh để kích thích nhận thức khoang miệng [19]. Nếu con không có vấn đề về viêm họng mãn tính, việc uống nước lạnh là tốt hơn rất nhiều so với việc không nạp đủ nước. Tuy nhiên, cha mẹ nên theo dõi sát sao biểu hiện tiêu hóa.
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm mb-4 relative">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none pr-12">
                        Làm sao để tập cho con quen dần với nước lọc mà không gây hoảng loạn?
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Sự kiên nhẫn và thay đổi từng bước nhỏ là chìa khóa. Bắt đầu bằng việc cho con uống thứ nước con thích, sau đó mỗi ngày pha thêm 10% nước lọc vào cốc cho đến khi hoàn toàn trong suốt. Quá trình này diễn ra chậm rãi để hệ giác quan của con kịp thích nghi [18].
                    </div>
                </details>

                <details class="group bg-cream rounded-xl shadow-sm mb-4 relative">
                    <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none pr-12">
                        Tình trạng táo bón do lười uống nước có thể tự hết khi con lớn lên không?
                    </summary>
                    <div class="px-6 pb-6 text-text-dark font-quicksand">
                        Táo bón mãn tính ở trẻ tự kỷ hiếm khi tự biến mất nếu không can thiệp vào gốc rễ, bao gồm tăng cường nước, chất xơ và điều chỉnh hệ vi sinh. Việc để kéo dài sẽ ảnh hưởng nghiêm trọng đến trục ruột não, làm suy giảm chất lượng cuộc sống của con [19].
                    </div>
                </details>
            </div>
        </section>

        <!-- DISCLAIMER -->
        <section class="bg-gray-100 pt-12 px-6 text-center">
            <div class="max-w-4xl mx-auto text-text-soft text-sm italic font-quicksand">
                "Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp."
            </div>
        </section>
    </main>

    <!-- FOOTER: NGUỒN THAM KHẢO -->
    <footer class="bg-gray-100 py-12 px-5 text-sm text-text-soft font-quicksand">
        <div class="max-w-6xl mx-auto border-t border-gray-300 pt-8">
            <h4 class="font-oswald text-navy text-lg mb-4 font-semibold uppercase">Nguồn tài liệu chuyên môn tham khảo</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Group 1 -->
                <div>
                    <strong class="block text-text-dark mb-2">Chuyên trang tâm lý đại chúng</strong>
                    <ul class="space-y-2 list-disc pl-4">
                        <li><a href="https://www.spectrumnews.org/news/sensory-sensitivities-in-autism-explained/" target="_blank" rel="nofollow" class="hover:text-navy">Spectrum News: Sensory sensitivities in autism</a></li>
                        <li><a href="https://www.psychologytoday.com/us/blog/autism-and-anxiety/202008/understanding-sensory-processing-in-autism" target="_blank" rel="nofollow" class="hover:text-navy">Psychology Today: Sensory Processing</a></li>
                        <li><a href="https://raisingchildren.net.au/autism/health-wellbeing/eating-habits/feeding-issues-autism" target="_blank" rel="nofollow" class="hover:text-navy">Raising Children: Feeding issues & autism</a></li>
                        <li><a href="https://www.verywellhealth.com/autism-and-sensory-issues-260249" target="_blank" rel="nofollow" class="hover:text-navy">Verywell Health: Autism and Sensory Issues</a></li>
                        <li><a href="https://childmind.org/article/sensory-processing-issues-explained/" target="_blank" rel="nofollow" class="hover:text-navy">Child Mind: Sensory Processing Issues</a></li>
                    </ul>
                </div>
                <!-- Group 2 -->
                <div>
                    <strong class="block text-text-dark mb-2">Tổ chức y tế / tự kỷ</strong>
                    <ul class="space-y-2 list-disc pl-4">
                        <li><a href="https://www.autismspeaks.org/expert-opinion/autism-and-food-aversions" target="_blank" rel="nofollow" class="hover:text-navy">Autism Speaks: Food aversions</a></li>
                        <li><a href="https://www.understood.org/en/articles/sensory-processing-issues-and-food" target="_blank" rel="nofollow" class="hover:text-navy">Understood.org: Sensory and food</a></li>
                        <li><a href="https://www.autism.org.uk/advice-and-guidance/topics/behaviour/eating" target="_blank" rel="nofollow" class="hover:text-navy">NAS UK: Eating behaviour</a></li>
                        <li><a href="https://www.cdc.gov/ncbddd/autism/signs.html" target="_blank" rel="nofollow" class="hover:text-navy">CDC: Signs of ASD</a></li>
                        <li><a href="https://network.autism.org.uk/knowledge/insight-opinion/dietary-management-children-autism-spectrum" target="_blank" rel="nofollow" class="hover:text-navy">NAS: Dietary management</a></li>
                    </ul>
                </div>
                <!-- Group 3 -->
                <div>
                    <strong class="block text-text-dark mb-2">Chuyên gia y tế / trị liệu</strong>
                    <ul class="space-y-2 list-disc pl-4">
                        <li><a href="https://www.theottoolbox.com/sensory-issues-with-drinking-water/" target="_blank" rel="nofollow" class="hover:text-navy">The OT Toolbox: Sensory Drinking</a></li>
                        <li><a href="https://harkla.co/blogs/special-needs/sensory-food-aversions" target="_blank" rel="nofollow" class="hover:text-navy">Harkla: Sensory Food Aversions</a></li>
                        <li><a href="https://kidssense.com.au/resources/feeding-difficulties/" target="_blank" rel="nofollow" class="hover:text-navy">Kid Sense: Feeding Difficulties</a></li>
                        <li><a href="https://www.arktherapeutic.com/blog/how-to-help-kids-who-refuse-to-drink/" target="_blank" rel="nofollow" class="hover:text-navy">ARK Therapeutic: Help kids drink</a></li>
                        <li><a href="https://autismdietitian.com/blog/hydration-and-autism" target="_blank" rel="nofollow" class="hover:text-navy">Autism Dietitian: Hydration</a></li>
                    </ul>
                </div>
                <!-- Group 4 -->
                <div>
                    <strong class="block text-text-dark mb-2">Góc nhìn từ cộng đồng</strong>
                    <ul class="space-y-2 list-disc pl-4">
                        <li><a href="https://themighty.com/topic/autism-spectrum-disorder/autism-sensory-issues-eating-drinking/" target="_blank" rel="nofollow" class="hover:text-navy">The Mighty: Sensory Issues Drinking</a></li>
                        <li><a href="https://community.autism.org.uk/f/parents-and-carers/21532/child-refusing-to-drink" target="_blank" rel="nofollow" class="hover:text-navy">NAS Community: Child refusing drink</a></li>
                        <li><a href="https://www.reddit.com/r/Autism_Parenting/comments/w1j89q/tips_for_toddler_who_wont_drink_water/" target="_blank" rel="nofollow" class="hover:text-navy">Reddit: Tips for toddler hydration</a></li>
                        <li><a href="https://autisticnotweird.com/advice-for-children/" target="_blank" rel="nofollow" class="hover:text-navy">Autistic Not Weird: Advice</a></li>
                        <li><a href="https://theautismcafe.com/autism-and-sensory-feeding-issues/" target="_blank" rel="nofollow" class="hover:text-navy">The Autism Cafe: Feeding Issues</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

</body>
<?php get_footer(); ?>   