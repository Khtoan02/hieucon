<?php /* Template Name: Vat_Ly_Tri_Lieu_Tre_Tu_Ky_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vật lý trị liệu trẻ tự kỷ khi nào cần và cha mẹ nên kỳ vọng gì?</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
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
        body { background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; line-height: 1.4 !important; }
        /* Ẩn mũi tên mặc định của thẻ details/summary */
        details > summary {
            list-style: none;
        }
        details > summary::-webkit-details-marker {
            display: none;
        }
        details[open] summary ~ * {
            animation: slideDown 0.3s ease-in-out;
        }
        @keyframes slideDown {
            0% { opacity: 0; transform: translateY(-10px); }
            100% { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body class="font-quicksand text-text-dark bg-cream antialiased selection:bg-yellow selection:text-navy">

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
                        Kiến thức chuyên môn
                    </div>
                    <h1 class="font-oswald text-4xl md:text-5xl lg:text-5xl font-bold leading-tight mb-6 text-white tracking-wide uppercase">
                        VẬT LÝ TRỊ LIỆU TRẺ TỰ KỶ GIÚP CON VỮNG BƯỚC VÀ TỰ TIN HƠN TRONG TỪNG NHỊP VẬN ĐỘNG
                    </h1>
                    <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                        Làm cha mẹ của một em bé có rối loạn phổ tự kỷ, sự chú ý của chúng ta thường đổ dồn vào việc làm sao để con cất lời hay tương tác mắt tốt hơn. Thế nhưng, đằng sau những khó khăn đó, cơ thể con cũng đang âm thầm lên tiếng. Việc can thiệp thể chất chính là chiếc chìa khóa vàng giúp con tháo gỡ rào cản vận động từ gốc rễ hệ thần kinh.
                    </p>
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                        Thực Hiện Bảng Kiểm Tra Sức Khỏe Toàn Diện
                    </a>
                </div>
                
                <div class="relative hidden lg:block">
                    <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/pt_hero_img_1779077423850.png" alt="Vật lý trị liệu cho trẻ tự kỷ" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
                </div>
            </div>
        </section>

        <!-- SECTION 1 (BG: White) -->
        <section class="bg-white py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-6 max-w-4xl mx-auto">
                    Những khó khăn về thể chất ở trẻ tự kỷ mà cha mẹ thường vô tình lướt qua
                </h2>
                <p class="text-lg text-center max-w-3xl mx-auto mb-12 text-text-soft">
                    Sự phát triển của một đứa trẻ là một bức tranh tổng hòa giữa nhận thức, ngôn ngữ và thể chất. Việc nhận diện đúng bản chất của những khó khăn này sẽ giúp chúng ta yêu thương và đồng hành cùng con đúng cách.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-4xl mb-4">🧬</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4 leading-snug">
                            Cơ thể mềm nhão và mau mệt mỏi thường bắt nguồn từ tình trạng <a href="https://hieucontugoc.online/truong-luc-co-thap-tu-ky" class="underline hover:text-yellow transition-colors" target="_blank">trương lực cơ thấp & tự kỷ</a>
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Nhiều cha mẹ chia sẻ rằng con mình trông như "người không xương", hay nằm ườn ra bàn. Nguyên nhân sâu xa là do tín hiệu từ não bộ truyền đến các cơ bị yếu đi. Trương lực cơ thấp khiến cơ thể con cần tiêu hao nhiều năng lượng hơn chỉ để giữ tư thế đứng thẳng, làm con rất mau mệt mỏi.
                        </p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-4xl mb-4">🤸</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4 leading-snug">
                            Sự lóng ngóng trong sinh hoạt hàng ngày phản ánh khó khăn trong việc phối hợp vận động thô
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Việc phối hợp nhịp nhàng giữa tay và mắt là một thử thách lớn. Sự lóng ngóng khi leo cầu thang hay bắt bóng không phải vì con không cố gắng, mà bởi hệ thần kinh đang gặp khó trong việc lên kế hoạch vận động. Não bộ chưa biết cách ra lệnh cho cơ thể thực hiện trơn tru.
                        </p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow">
                        <div class="text-4xl mb-4">⚖️</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4 leading-snug">
                            Việc <a href="https://hieucontugoc.online/tre-tu-ky-hay-nga-thang-bang-kem" class="underline hover:text-yellow transition-colors" target="_blank">trẻ tự kỷ hay ngã, thăng bằng kém</a> có mối liên hệ mật thiết với hệ thống tiền đình và cảm giác thần kinh
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Nếu con thường xuyên va vấp, đi lại xiêu vẹo, đó là lúc hệ thống tiền đình và cảm giác bản thể đang lên tiếng. Khi các luồng thông tin cảm giác này không được xử lý đồng bộ, con sẽ mất đi cảm giác an toàn về không gian, dẫn đến những bước đi chệch choạc.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2 (BG: Cream) -->
        <section class="bg-cream py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-6 max-w-4xl mx-auto">
                    Nhận biết những thời điểm vàng cha mẹ nên cân nhắc can thiệp vật lý trị liệu cho con
                </h2>
                <p class="text-lg text-center max-w-3xl mx-auto mb-12 text-text-soft">
                    Vật lý trị liệu trẻ tự kỷ là sự hỗ trợ thiết yếu để tối ưu hóa khả năng độc lập của con. Dưới đây là những dấu hiệu mách bảo cha mẹ đã đến lúc cần chuyên gia đồng hành.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">⏱️</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Khi con có dấu hiệu chậm trễ rõ rệt trong việc đạt các mốc phát triển vận động theo lứa tuổi
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Nếu con đã qua độ tuổi tập đi khá lâu nhưng vẫn chưa thể tự bước đi vững vàng, hoặc không thể thực hiện các kỹ năng như nhảy lò cò, leo trèo tự nhiên. Can thiệp sớm giúp con không bị tụt lại quá xa so với đà phát triển chung.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">🧸</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Lúc sự vụng về bắt đầu cản trở con tham gia vui chơi và tương tác an toàn với bạn bè
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Nếu rào cản thể chất khiến con liên tục vấp ngã hoặc không thể chạy theo các bạn trong sân chơi, con sẽ dần thu mình lại. Vật lý trị liệu sẽ là cầu nối trang bị đủ kỹ năng để con hòa nhập sân chơi tự tin hơn.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl p-8 shadow-md hover:-translate-y-1 transition-transform">
                        <div class="text-4xl mb-4">👣</div>
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Khi con thường xuyên có các tư thế đi lại bất thường như đi nhón gót kéo dài
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Đi nhón gót kéo dài có thể làm co rút gân gót Achilles, gây đau đớn và làm biến dạng dáng đi. Trị liệu chuyên biệt giúp kéo giãn cơ gót chân, hỗ trợ con đặt cả bàn chân xuống đất một cách thoải mái nhất.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 3 (BG: White) -->
        <section class="bg-white py-16 md:py-24 px-5">
            <div class="max-w-6xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-6 max-w-4xl mx-auto">
                    Quá trình vật lý trị liệu mang đến những thay đổi thiết thực nào cho cuộc sống của con
                </h2>
                <p class="text-lg text-center max-w-3xl mx-auto mb-12 text-text-soft">
                    Đối với trẻ tự kỷ, các chuyên gia sẽ biến bài tập thành những trò chơi vận động có chủ đích nhằm xây dựng sự kết nối liền mạch giữa não bộ và cơ thể.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-stretch">
                    <div class="bg-cream rounded-2xl p-8 shadow-md border-t-4 border-yellow">
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Cải thiện sức mạnh vùng lõi giúp con duy trì tư thế ngồi vững vàng và tăng khả năng tập trung
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Các cơ ở bụng, lưng và khung chậu đóng vai trò như trụ cột. Các bài tập bò qua hầm hay ngồi trên bóng giúp đánh thức nhóm cơ này. Khi vùng lõi vững chắc, năng lượng não bộ được giải phóng để con tập trung học tập tốt hơn.
                        </p>
                    </div>
                    <div class="bg-cream rounded-2xl p-8 shadow-md border-t-4 border-yellow">
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Xây dựng kỹ năng giữ thăng bằng để con tự tin chạy nhảy và khám phá thế giới xung quanh
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Thông qua chướng ngại vật an toàn hay cầu thăng bằng, cơ thể con học cách phản ứng nhanh nhạy với những thay đổi trọng tâm đột ngột. Kết quả là con bớt vấp ngã hơn và tự do leo trèo không còn sợ hãi.
                        </p>
                    </div>
                    <div class="bg-cream rounded-2xl p-8 shadow-md border-t-4 border-yellow">
                        <h3 class="font-oswald text-navy text-xl font-bold mb-4">
                            Hỗ trợ điều hòa hệ cảm giác thông qua những bài tập chuyển động nhịp nhàng và có cấu trúc
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft">
                            Những chuyển động mạnh mẽ (kéo co, nhún nhảy) cung cấp thông tin cảm giác bản thể sâu sắc. Đây như một "liều thuốc tự nhiên" xoa dịu sự căng thẳng, giảm bớt hành vi rập khuôn và đưa hệ thần kinh về trạng thái cân bằng.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4 (BG: Cream) -->
        <section class="bg-cream py-16 md:py-24 px-5">
            <div class="max-w-5xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-6 max-w-4xl mx-auto">
                    Cha mẹ nên đặt ra những kỳ vọng thực tế nào khi đồng hành cùng con trong trị liệu
                </h2>
                <p class="text-lg text-center max-w-3xl mx-auto mb-12 text-text-soft">
                    Hành trình can thiệp chưa bao giờ là con đường có kết quả sau một đêm. Cha mẹ cần trang bị cho mình một tư duy đồng hành đầy thấu cảm.
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="bg-white rounded-2xl p-10 shadow-md flex flex-col justify-center">
                        <div class="text-5xl mb-6 text-center">🎯</div>
                        <h3 class="font-oswald text-navy text-2xl font-bold mb-4 text-center">
                            Trị liệu thể chất không nhằm thay đổi bản chất của con mà hướng tới sự an toàn và tự lập
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft text-center">
                            Mục tiêu tối thượng là giúp con có đủ sức mạnh để tự thay quần áo, đủ thăng bằng để đi lại không vấp ngã. Chúng ta hướng tới một em bé vui vẻ, tự lập trong sinh hoạt, chứ không phải một em bé hoàn hảo không tì vết.
                        </p>
                    </div>
                    <div class="bg-white rounded-2xl p-10 shadow-md flex flex-col justify-center">
                        <div class="text-5xl mb-6 text-center">🌱</div>
                        <h3 class="font-oswald text-navy text-2xl font-bold mb-4 text-center">
                            Tiến bộ của con là một hành trình tích lũy từng bước nhỏ cần sự kiên nhẫn và ăn mừng mỗi ngày
                        </h3>
                        <p class="text-base leading-relaxed text-text-soft text-center">
                            Cơ chế thần kinh cần rất nhiều thời gian để hình thành liên kết mới. Hãy ghi nhận và ăn mừng từng bước tiến nhỏ nhất. Sự kiên nhẫn và niềm tin của cha mẹ chính là động lực lớn nhất để con tiếp tục cố gắng.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 5 - CTA BLOCK (BG: White) -->
        <section class="bg-white py-20 md:py-32 px-5 text-center">
            <div class="max-w-4xl mx-auto bg-cream rounded-3xl p-10 md:p-16 shadow-lg border-2 border-dashed border-yellow">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold mb-6">
                    Bắt đầu hành trình thấu hiểu cơ thể con thông qua việc đánh giá tổng thể tại nhà
                </h2>
                <p class="text-lg mb-10 text-text-soft max-w-2xl mx-auto leading-relaxed">
                    Thay vì hoang mang trước những dấu hiệu vụng về của con, cha mẹ cần một hệ thống đánh giá khách quan, khoa học để biết chính xác tình trạng của con. Hãy dành vài phút thực hiện <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="font-bold text-navy underline hover:text-yellow">kiểm tra sức khỏe toàn diện</a> để gạt bỏ âu lo và tự tin tìm kiếm giải pháp.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-xl">
                    Làm bảng kiểm tra sức khỏe miễn phí
                </a>
            </div>
        </section>

        <!-- SECTION 6 - FAQ (BG: Cream) -->
        <section class="bg-cream py-16 md:py-24 px-5">
            <div class="max-w-3xl mx-auto">
                <h2 class="font-oswald text-navy text-3xl md:text-4xl font-bold text-center mb-12">
                    Giải đáp những trăn trở phổ biến của phụ huynh về vật lý trị liệu cho trẻ tự kỷ
                </h2>
                
                <div class="space-y-4">
                    <!-- FAQ 1 -->
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                            Trẻ tự kỷ có bắt buộc phải tập vật lý trị liệu không?
                            <span class="text-2xl text-yellow group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-soft text-base leading-relaxed">
                            Không phải tất cả trẻ tự kỷ đều cần vật lý trị liệu. Can thiệp này chỉ thực sự cần thiết khi trẻ có những suy giảm rõ rệt về kỹ năng vận động thô, gặp khó khăn trong thăng bằng, trương lực cơ thấp hoặc dáng đi bất thường gây ảnh hưởng đến sự an toàn và sinh hoạt hàng ngày.
                        </div>
                    </details>
                    
                    <!-- FAQ 2 -->
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                            Thời gian tập vật lý trị liệu thường kéo dài bao lâu?
                            <span class="text-2xl text-yellow group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-soft text-base leading-relaxed">
                            Không có một mốc thời gian cố định cho mọi em bé. Tùy thuộc vào mức độ khó khăn về vận động và sự đáp ứng của hệ thần kinh, quá trình này có thể kéo dài từ vài tháng đến vài năm. Chuyên gia sẽ thường xuyên đánh giá lại mục tiêu để điều chỉnh cường độ phù hợp.
                        </div>
                    </details>

                    <!-- FAQ 3 -->
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                            Vật lý trị liệu có giúp con bớt đi nhón gót không?
                            <span class="text-2xl text-yellow group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-soft text-base leading-relaxed">
                            Có. Nếu việc đi nhón gót của con liên quan đến vấn đề căng cơ gót Achilles hoặc thói quen vận động sai, vật lý trị liệu với các bài tập kéo giãn, mang nẹp chỉnh hình hoặc massage trị liệu sẽ mang lại hiệu quả rất tích cực, giúp con điều chỉnh lại dáng đi an toàn.
                        </div>
                    </details>

                    <!-- FAQ 4 -->
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                            Cha mẹ có thể làm gì tại nhà để hỗ trợ con ngoài giờ học trị liệu?
                            <span class="text-2xl text-yellow group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-soft text-base leading-relaxed">
                            Gia đình là môi trường trị liệu tốt nhất. Cha mẹ có thể biến các bài tập thành trò chơi hàng ngày như: cùng con chơi bò qua hầm carton, nhảy trên nệm, kéo xe chở đồ chơi, hay đơn giản là cùng con đi bộ trên nhiều bề mặt khác nhau (bãi cỏ, cát, đệm mềm) để kích thích cảm giác.
                        </div>
                    </details>

                    <!-- FAQ 5 -->
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                            Sự khác biệt giữa vật lý trị liệu và hoạt động trị liệu là gì?
                            <span class="text-2xl text-yellow group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-soft text-base leading-relaxed">
                            Vật lý trị liệu (Physical Therapy) tập trung vào các nhóm cơ lớn (vận động thô), giúp con đi đứng, thăng bằng và di chuyển. Còn Hoạt động trị liệu (Occupational Therapy) thường tập trung vào các nhóm cơ nhỏ (vận động tinh) và kỹ năng sinh hoạt, giúp con biết cầm bút, cài khuy áo và xử lý rối loạn cảm giác.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- DISCLAIMER SECTION -->
        <section class="bg-gray-100 pt-12 pb-6 px-6 text-center">
            <p class="max-w-4xl mx-auto text-text-soft text-sm italic">
                Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
            </p>
        </section>

        <!-- FOOTER / NGUỒN THAM KHẢO -->
        <footer class="bg-gray-100 py-12 px-5 text-sm text-text-soft border-t border-gray-300">
            <div class="max-w-6xl mx-auto">
                <h4 class="font-oswald font-bold text-navy mb-4 text-base uppercase">Nguồn tài liệu y khoa & giáo dục tham khảo:</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 break-words">
                    <ul class="list-disc pl-5 space-y-2">
                        <li><a href="https://www.healthline.com/health/autism/physical-therapy-for-autism" target="_blank" class="hover:text-navy transition-colors">Healthline</a></li>
                        <li><a href="https://www.verywellhealth.com/physical-therapy-for-autism-260533" target="_blank" class="hover:text-navy transition-colors">Verywell Health</a></li>
                        <li><a href="https://www.medicalnewstoday.com/articles/physical-therapy-for-autism" target="_blank" class="hover:text-navy transition-colors">Medical News Today</a></li>
                        <li><a href="https://www.psychologytoday.com/us/blog/autism-and-the-brain/motor-skills-in-autism" target="_blank" class="hover:text-navy transition-colors">Psychology Today</a></li>
                        <li><a href="https://www.webmd.com/brain/autism/therapies-to-help-with-autism" target="_blank" class="hover:text-navy transition-colors">WebMD</a></li>
                    </ul>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><a href="https://www.autismspeaks.org/physical-therapy-autism" target="_blank" class="hover:text-navy transition-colors">Autism Speaks</a></li>
                        <li><a href="https://www.cdc.gov/ncbddd/autism/treatment.html" target="_blank" class="hover:text-navy transition-colors">CDC</a></li>
                        <li><a href="https://www.understood.org/en/articles/physical-therapy-what-you-need-to-know" target="_blank" class="hover:text-navy transition-colors">Understood</a></li>
                        <li><a href="https://childmind.org/article/autism-and-motor-skills/" target="_blank" class="hover:text-navy transition-colors">Child Mind Institute</a></li>
                        <li><a href="https://pathfindersforautism.org/articles/treatments/physical-therapy/" target="_blank" class="hover:text-navy transition-colors">Pathfinders for Autism</a></li>
                    </ul>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><a href="https://napacenter.org/physical-therapy-for-autism/" target="_blank" class="hover:text-navy transition-colors">NAPA Center</a></li>
                        <li><a href="https://nspt4kids.com/specialties-and-services/physical-therapy/how-physical-therapy-helps-children-with-autism/" target="_blank" class="hover:text-navy transition-colors">NSPT4Kids</a></li>
                        <li><a href="https://www.theottoolbox.com/gross-motor-skills-and-autism/" target="_blank" class="hover:text-navy transition-colors">The OT Toolbox</a></li>
                        <li><a href="https://www.ptcentral.org/blog/how-physical-therapy-can-help-children-with-autism/" target="_blank" class="hover:text-navy transition-colors">PT Central</a></li>
                        <li><a href="https://blog.dinopt.com/autism-and-physical-therapy/" target="_blank" class="hover:text-navy transition-colors">Dino PT</a></li>
                    </ul>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><a href="https://tacanow.org/family-resources/motor-skills-and-autism/" target="_blank" class="hover:text-navy transition-colors">TACA</a></li>
                        <li><a href="https://www.autismforums.com/threads/physical-therapy-experiences.12456/" target="_blank" class="hover:text-navy transition-colors">Autism Forums</a></li>
                        <li><a href="https://wrongplanet.net/forums/viewtopic.php?t=34567" target="_blank" class="hover:text-navy transition-colors">Wrong Planet</a></li>
                        <li><a href="https://autismawarenesscentre.com/the-role-of-physiotherapy-in-autism/" target="_blank" class="hover:text-navy transition-colors">Autism Awareness Centre</a></li>
                        <li><a href="https://findingcoopersvoice.com/2019/04/15/the-importance-of-physical-therapy/" target="_blank" class="hover:text-navy transition-colors">Finding Cooper's Voice</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </main>
<?php get_footer(); ?>
</body>
</html>