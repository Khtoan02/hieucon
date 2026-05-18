<?php /* Template Name: Tre_Tu_Ky_Di_Nhon_Got_Toe_Walking_Landing */ ?>
<?php get_header(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vì sao trẻ tự kỷ đi nhón gót và cách cha mẹ hỗ trợ con an toàn</title>
    <meta name="description" content="Trẻ tự kỷ đi nhón gót (toe walking) thường do rối loạn cảm giác hoặc trương lực cơ. Khám phá nguyên nhân và cách giúp con cải thiện an toàn tại nhà.">
    
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
        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Oswald', sans-serif; line-height: 1.4 !important; }
        details > summary { list-style: none; }
        details > summary::-webkit-details-marker { display: none; }
        details[open] summary ~ * { animation: fadeIn 0.3s ease-in-out; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(-5px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body class="antialiased bg-[#FAF9F6] text-[#3D3D3D] font-quicksand selection:bg-yellow selection:text-navy">

<main>
    <!-- HERO SECTION -->
    <section class="relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden">
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
                <h1 class="font-oswald text-4xl md:text-5xl lg:text-6xl uppercase font-bold tracking-wide leading-tight mb-6 text-white">
                    ĐẰNG SAU BƯỚC CHÂN ĐI NHÓN GÓT CỦA TRẺ TỰ KỶ VÀ CÁCH CHA MẸ ĐỒNG HÀNH CÙNG CON
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-cream/90 mb-10 opacity-90 font-light">
                    Làm cha mẹ, trái tim chúng ta luôn thắt lại mỗi khi thấy con bước đi chông chênh, dễ vấp ngã vì thói quen đi bằng mũi chân. Thực chất, tình trạng trẻ tự kỷ đi nhón gót (toe walking) hiếm khi là một sự chống đối hay một tật xấu cố ý. Thay vì ép con hạ gót, việc hiểu thấu đáo nguyên nhân sẽ giúp cha mẹ tìm ra hướng đi đúng đắn, mang lại cho con những bước chân vững chãi.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-xl shadow-lg hover:-translate-y-1 hover:shadow-xl transition-all text-center uppercase tracking-wide inline-block">
                        Đánh Giá Sức Khỏe Toàn Diện Cho Con Ngay
                    </a>
                </div>
            </div>
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-gradient-to-tl from-yellow/20 to-transparent rounded-3xl transform -rotate-3 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/toe_walking_hero_1779070330825.png" alt="Trẻ đi nhón gót" class="relative rounded-3xl shadow-2xl border border-white/10 object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <!-- SECTION 1: NGUYÊN NHÂN (BG WHITE) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 max-w-4xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy font-semibold mb-6">Giải mã lý do khiến con thường xuyên đi nhón gót thay vì đặt cả bàn chân xuống đất</h2>
                <p class="text-lg text-text-soft">
                    Nhiều cha mẹ lầm tưởng rằng con đi nhón gót chỉ vì con thích thế, nhưng đằng sau những bước chân chênh vênh ấy là cả một quá trình cơ thể đang vất vả xử lý thông tin. Các hệ thống giác quan và chức năng vận động đang chi phối mạnh mẽ cách con tiếp đất [1, 6].
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-12">
                <div class="relative hidden lg:block rounded-3xl overflow-hidden shadow-xl border border-gray-100">
                    <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/toe_walking_sensory_1779070342714.png" alt="Rối loạn cảm giác ở lòng bàn chân" class="w-full h-auto object-cover hover:scale-105 transition-transform duration-500" />
                </div>
                <div class="space-y-6">
                    <!-- Card 1 -->
                    <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow h-full flex flex-col justify-center">
                        <div class="text-5xl mb-4">🧩</div>
                        <h3 class="font-oswald text-2xl text-navy font-medium mb-3 leading-snug">Hành vi đi nhón gót giúp con tự điều chỉnh và tìm kiếm cảm giác an toàn</h3>
                        <p class="text-text-dark">
                            Rối loạn xử lý cảm giác là một nguyên nhân hàng đầu. Với trẻ quá nhạy cảm, đặt bàn chân xuống sàn có thể gây đau đớn, nên con thu hẹp diện tích tiếp xúc để bảo vệ mình. Ngược lại, trẻ kém nhạy cảm đi nhón gót để tạo lực ép mạnh lên bắp chân, gửi tín hiệu rõ ràng lên não bộ giúp con cảm nhận không gian và thấy an toàn hơn [5, 10, 13].
                        </p>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 2 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="text-5xl mb-6">💪</div>
                    <h3 class="font-oswald text-2xl text-navy font-medium mb-4 leading-snug">Mối liên hệ giữa tình trạng trương lực cơ thấp và thói quen đi nhón gót ở trẻ</h3>
                    <p class="text-text-dark">
                        Khi hệ cơ bụng, lưng và chân không đủ săn chắc, trẻ gặp khó khăn giữ thẳng người. Nếu mắc phải vấn đề <a href="https://hieucontugoc.online/truong-luc-co-thap-tu-ky" class="text-navy font-semibold underline decoration-yellow decoration-2 underline-offset-4 hover:text-yellow transition-colors">trương lực cơ thấp & tự kỷ</a>, cơ thể phản xạ bù trừ bằng cách kiễng gót lên để "khóa" khớp, tạo sự vững chắc giả tạo để cơ thể không bị chùng xuống [9, 14].
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm border border-gray-100 hover:shadow-md transition-shadow">
                    <div class="text-5xl mb-6">⚖️</div>
                    <h3 class="font-oswald text-2xl text-navy font-medium mb-4 leading-snug">Những vấn đề về hệ tiền đình khiến con khó giữ thăng bằng và hay vấp ngã</h3>
                    <p class="text-text-dark">
                        Hệ tiền đình như chiếc la bàn của cơ thể. Khi nó hoạt động kém, thế giới như tròng trành, khiến trẻ gồng cứng cơ và kiễng chân thu hẹp trọng tâm để bám víu. Hệ lụy là tình trạng <a href="https://hieucontugoc.online/tre-tu-ky-hay-nga-thang-bang-kem" class="text-navy font-semibold underline decoration-yellow decoration-2 underline-offset-4 hover:text-yellow transition-colors">trẻ tự kỷ hay ngã, thăng bằng kém</a>, làm con e ngại các hoạt động thể chất [2, 11].
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 2: RỦI RO THỂ CHẤT (BG CREAM) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="font-oswald text-3xl md:text-4xl text-navy font-semibold mb-12 text-center max-w-3xl mx-auto">Những rủi ro tiềm ẩn về thể chất nếu tình trạng đi nhón gót kéo dài</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div class="space-y-8">
                    <div>
                        <h3 class="font-oswald text-2xl text-navy font-medium mb-3">Nguy cơ co rút gân gót và ảnh hưởng đến cấu trúc xương bàn chân</h3>
                        <p class="text-text-dark">
                            Khi trẻ liên tục đi trên mũi chân, gân Achilles (gân gót) luôn bị co ngắn. Theo thời gian, gân có thể bị xơ cứng và rút ngắn vĩnh viễn. Khi điều này xảy ra, ngay cả khi muốn, trẻ cũng không thể đặt gót chân xuống đất do cấu trúc vật lý thay đổi, gây đau đớn. Việc này còn có thể làm bẹt vòm bàn chân và phát triển sai lệch xương gót [4, 15].
                        </p>
                    </div>
                    <div>
                        <h3 class="font-oswald text-2xl text-navy font-medium mb-3">Sự khó khăn trong việc phát triển đồng đều các kỹ năng vận động ở trẻ</h3>
                        <p class="text-text-dark">
                            Việc dồn trọng tâm về trước khiến cơ bắp chân làm việc quá sức, trong khi cơ mông, đùi trước và bụng bị yếu đi. Sự mất cân bằng này là rào cản lớn đối với quá trình phát triển <a href="https://hieucontugoc.online/van-dong-tho-tinh-o-tre-tu-ky" class="text-navy font-semibold underline decoration-yellow decoration-2 underline-offset-4 hover:text-yellow transition-colors">vận động thô & tinh ở trẻ tự kỷ</a>. Con có thể lóng ngóng khi leo cầu thang, khó ngồi đúng tư thế học chữ vì các cơ cốt lõi (core muscles) quá yếu [6, 9].
                        </p>
                    </div>
                </div>
                <div class="bg-white p-8 rounded-2xl shadow-sm border-l-4 border-yellow">
                    <p class="text-lg italic text-text-soft">
                        "Mặc dù đi nhón gót là phản xạ tự nhiên để thích nghi, nhưng duy trì thói quen này liên tục sẽ để lại hệ lụy lớn lên hệ cơ xương khớp đang phát triển. Nhận diện sớm rủi ro giúp cha mẹ hỗ trợ con kịp thời."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 3: PHƯƠNG PHÁP HỖ TRỢ (BG WHITE) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16 max-w-4xl mx-auto">
                <h2 class="font-oswald text-3xl md:text-4xl text-navy font-semibold mb-6">Chuyển từ việc ép con hạ gót sang những phương pháp hỗ trợ con khoa học tại nhà</h2>
                <p class="text-lg text-text-soft">
                    Mệnh lệnh "hạ gót xuống" hiếm khi hiệu quả, thậm chí gây căng thẳng. Thay vào đó, hãy áp dụng những chiến lược mềm mỏng dựa trên thấu hiểu giác quan [16].
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm">
                    <div class="text-4xl mb-4 text-navy">🔍</div>
                    <h3 class="font-oswald text-xl text-navy font-medium mb-3 leading-snug">Quan sát và ghi nhận những thời điểm con thường đi nhón gót nhiều nhất</h3>
                    <p class="text-text-dark text-sm">
                        Cha mẹ hãy ghi chép lại tần suất: Con kiễng chân trên thảm lông, cỏ ướt hay lúc căng thẳng/vui sướng? Xác định được các yếu tố kích hoạt giúp cha mẹ chủ động thay đổi môi trường và giảm tải cảm giác cho con [17, 18].
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm">
                    <div class="text-4xl mb-4 text-navy">🧸</div>
                    <h3 class="font-oswald text-xl text-navy font-medium mb-3 leading-snug">Tích hợp các bài tập giãn cơ nhẹ nhàng vào trò chơi tương tác hàng ngày</h3>
                    <p class="text-text-dark text-sm">
                        Chơi trò "gấu đi bộ" hoặc dùng ngón chân nhặt bi. Nếu cần bài bản, hãy tìm hiểu về <a href="https://hieucontugoc.online/vat-ly-tri-lieu-tre-tu-ky" class="text-navy font-semibold underline decoration-yellow decoration-2 underline-offset-4 hover:text-yellow transition-colors">vật lý trị liệu trẻ tự kỷ</a>. Các chuyên gia sẽ thiết kế hoạt động tích hợp cảm giác an toàn, giúp con quen tiếp đất [14, 15].
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="bg-cream rounded-2xl p-8 shadow-sm">
                    <div class="text-4xl mb-4 text-navy">👟</div>
                    <h3 class="font-oswald text-xl text-navy font-medium mb-3 leading-snug">Lựa chọn giày dép phù hợp giúp nâng đỡ vòm chân và mang lại sự vững chãi</h3>
                    <p class="text-text-dark text-sm">
                        Dùng tất chống trượt hoặc dép lót êm trong nhà nếu sàn gây khó chịu. Khi ra ngoài, chọn giày đế bằng, gót vững, ôm sát cổ chân. Miếng lót giày chỉnh hình cũng cung cấp thêm phản hồi cảm giác tích cực [12, 19].
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 4: KHI NÀO CẦN CAN THIỆP (BG CREAM) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-oswald text-3xl md:text-4xl text-navy font-semibold mb-8">Khi nào cha mẹ cần tìm đến sự can thiệp chuyên sâu từ các bác sĩ và chuyên gia</h2>
            <div class="bg-white p-8 md:p-10 rounded-3xl shadow-sm text-left border border-gray-100">
                <p class="text-lg text-text-dark mb-6">
                    Dù sự hỗ trợ tại nhà là vô cùng quan trọng, nhưng sẽ có những giai đoạn tình trạng của con cần y khoa can thiệp. Hãy chú ý những cờ đỏ sau đây:
                </p>
                <ul class="space-y-4 mb-6 list-disc list-inside text-text-dark">
                    <li>Con đi nhón gót liên tục trên 75% thời gian thức.</li>
                    <li>Con bắt đầu than khóc hoặc kêu đau ở vùng bắp chân, gót chân.</li>
                    <li><strong>Dấu hiệu quan trọng:</strong> Khi con nằm thư giãn, cha mẹ dùng tay đẩy nhẹ bàn chân con gập về phía ống đồng (gấp mu bàn chân) nhưng thấy có lực cản cứng ngắc, con nhăn nhó vì đau.</li>
                </ul>
                <p class="text-text-dark">
                    Đây là dấu hiệu gân gót có thể đã bị co rút [8, 15]. Lúc này, việc thăm khám với bác sĩ chỉnh hình nhi hoặc phục hồi chức năng là bắt buộc để có phương án như bó bột chỉnh hình, dùng nẹp AFO [1].
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION 5: ĐÁNH GIÁ TỔNG THỂ & CTA (BG WHITE) -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="font-oswald text-3xl md:text-4xl text-navy font-semibold mb-6">Đánh giá tổng thể sức khỏe của con để xây dựng lộ trình can thiệp toàn diện và yêu thương</h2>
            <p class="text-lg text-text-dark mb-10 max-w-3xl mx-auto">
                Đi nhón gót thường không phải triệu chứng đơn lẻ mà nằm trong bức tranh tổng thể về thể chất và thần kinh. Cha mẹ đừng vô tình bỏ lỡ những tín hiệu từ hệ tiêu hóa, giấc ngủ hay cảm giác của con. Hãy dành chút thời gian hệ thống hóa lại các dấu hiệu để tự tin trao đổi cùng chuyên gia.
            </p>
            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg">
                Thực Hiện Kiểm Tra Sức Khỏe Toàn Diện Tại Đây
            </a>
        </div>
    </section>

    <!-- SECTION 6: FAQ (BG CREAM) -->
    <section class="bg-cream py-16 md:py-24 px-6">
        <div class="max-w-3xl mx-auto">
            <h2 class="font-oswald text-3xl text-navy font-semibold mb-10 text-center">Giải đáp những trăn trở phổ biến của cha mẹ về tình trạng đi nhón gót ở trẻ tự kỷ</h2>
            
            <details class="group bg-white rounded-xl shadow-sm mb-4 border border-gray-100 open:border-navy transition-colors">
                <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none relative pr-10">
                    Đi nhón gót có chắc chắn là dấu hiệu của bệnh tự kỷ không?
                    <span class="absolute right-6 top-6 text-2xl leading-none group-open:rotate-45 transition-transform">+</span>
                </summary>
                <div class="px-6 pb-6 text-text-dark">
                    Không hoàn toàn. Nhiều trẻ phát triển bình thường cũng có giai đoạn đi nhón gót khi tập đi. Nó chỉ được coi là cờ đỏ tự kỷ khi đi kèm với các dấu hiệu khác như chậm nói, kém tương tác mắt và các hành vi rập khuôn.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm mb-4 border border-gray-100 open:border-navy transition-colors">
                <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none relative pr-10">
                    Tôi có nên nhắc nhở liên tục khi thấy con đi nhón gót?
                    <span class="absolute right-6 top-6 text-2xl leading-none group-open:rotate-45 transition-transform">+</span>
                </summary>
                <div class="px-6 pb-6 text-text-dark">
                    Việc nhắc nhở hay quát mắng thường làm tăng lo âu. Thay vì ra lệnh "hạ chân xuống", cha mẹ nên chuyển hướng con vào các hoạt động cần dùng toàn bộ bàn chân để giữ thăng bằng, hoặc thay đổi môi trường nếu con nhạy cảm.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm mb-4 border border-gray-100 open:border-navy transition-colors">
                <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none relative pr-10">
                    Trẻ lớn lên có tự hết đi nhón gót không?
                    <span class="absolute right-6 top-6 text-2xl leading-none group-open:rotate-45 transition-transform">+</span>
                </summary>
                <div class="px-6 pb-6 text-text-dark">
                    Tùy thuộc nguyên nhân. Nếu do tò mò tự nhiên, con có thể tự bỏ. Nhưng với trẻ tự kỷ có rối loạn cảm giác/trương lực cơ, thói quen này rất khó tự mất đi nếu không có bài tập và sự can thiệp phù hợp.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm mb-4 border border-gray-100 open:border-navy transition-colors">
                <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none relative pr-10">
                    Đi nhón gót có làm con bị lùn đi không?
                    <span class="absolute right-6 top-6 text-2xl leading-none group-open:rotate-45 transition-transform">+</span>
                </summary>
                <div class="px-6 pb-6 text-text-dark">
                    Không làm giảm cấu trúc xương dài, nhưng gây phát triển mất cân đối: khung chậu đổ về trước, lưng gù, tư thế sai lệch. Chính tư thế xấu khiến trẻ trông thấp bé và thiếu vững chãi hơn.
                </div>
            </details>

            <details class="group bg-white rounded-xl shadow-sm mb-4 border border-gray-100 open:border-navy transition-colors">
                <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none relative pr-10">
                    Con tôi chỉ đi nhón gót khi đi chân trần thì có sao không?
                    <span class="absolute right-6 top-6 text-2xl leading-none group-open:rotate-45 transition-transform">+</span>
                </summary>
                <div class="px-6 pb-6 text-text-dark">
                    Khả năng cao con đang nhạy cảm xúc giác quá mức (hypersensitive). Hãy tôn trọng cảm giác của con bằng cách cho đi tất/dép êm, đồng thời cho con chơi các trò giải mẫn cảm để dần quen với các bề mặt.
                </div>
            </details>
        </div>
    </section>

    <!-- DISCLAIMER -->
    <section class="bg-gray-100 pt-16 pb-6 px-6 text-center">
        <p class="text-text-soft text-sm italic max-w-4xl mx-auto">
            "Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp."
        </p>
    </section>
</main>

<!-- FOOTER: NGUỒN THAM KHẢO -->
<footer class="bg-gray-100 py-12 px-6">
    <div class="max-w-5xl mx-auto border-t border-gray-300 pt-8">
        <h4 class="font-oswald text-navy font-medium mb-4 text-lg">Nguồn Tham Khảo Chuyên Môn:</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-2 text-xs text-text-soft">
            <p>[1] Healthline - "Toe Walking and Autism"</p>
            <p>[2] Verywell Health - "Toe Walking and Autism"</p>
            <p>[3] Medical News Today - "Autism and toe walking"</p>
            <p>[4] WebMD - "Toe Walking in Autism"</p>
            <p>[5] Psychology Today - "Why Do Autistic Children Walk on Their Toes"</p>
            <p>[6] Autism Speaks - "What toe walking is and what can be done about it"</p>
            <p>[7] CDC - "Signs and Symptoms of Autism Spectrum Disorder"</p>
            <p>[8] Understood - "Toe walking: What you need to know"</p>
            <p>[9] National Autistic Society (UK) - "Physical difficulties"</p>
            <p>[10] Ambitious about Autism - "Sensory differences"</p>
            <p>[11] NAPA Center - "Toe Walking in Autism"</p>
            <p>[12] The Autism Helper - "Understanding Toe Walking"</p>
            <p>[13] Kid PT - "Toe Walking and Sensory Processing"</p>
            <p>[14] Dino PT - "Toe Walking in Children"</p>
            <p>[15] Pediatric PT and OT - "Toe Walking: When to seek help"</p>
            <p>[16] The Mighty - "Toe Walking Autism Experience"</p>
            <p>[17] MyAutismTeam - "Toe Walking and Autism: Parents Share Their Experiences"</p>
            <p>[18] National Autistic Society Community Forum - "Toe walking issues"</p>
            <p>[19] Autistic Not Weird - "Growing Up Autistic"</p>
            <p>[20] Wrong Planet - "Toe-walking traits"</p>
        </div>
    </div>
</footer>

<?php get_footer(); ?>