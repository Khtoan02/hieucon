<?php /* Template Name: Van_Dong_Tho_Va_Tinh_O_Tre_Tu_Ky_Landing */ ?>
<?php get_header(); ?>

<!-- Landing Page Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Landing Page Styles -->
<style>
    html { scroll-behavior: smooth; }
    details > summary { list-style: none; }
    details > summary::-webkit-details-marker { display: none; }
    details[open] summary ~ * { animation: sweep .3s ease-in-out; }
    @keyframes sweep {
        0%    {opacity: 0; margin-top: -10px}
        100%  {opacity: 1; margin-top: 0px}
    }
    .landing-wrapper h1, .landing-wrapper h2, .landing-wrapper h3, .landing-wrapper h4, .landing-wrapper h5, .landing-wrapper h6 { 
        font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; 
    }
    .font-oswald { font-family: 'Oswald', sans-serif !important; }
    .font-quicksand { font-family: 'Quicksand', sans-serif !important; }
    /* Reset text color for landing page */
    .landing-wrapper {
        font-family: 'Quicksand', sans-serif;
        color: #3D3D3D;
        background-color: #FAF9F6;
    }
</style>

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
                    VẬN ĐỘNG THÔ VÀ TINH Ở TRẺ TỰ KỶ CÓ ĐIỂM GÌ KHÁC BIỆT?
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Khi con thường xuyên lóng ngóng, hay vấp ngã hay gặp khó khăn khi cầm bút, xin đừng vội trách mắng. Trẻ không lười biếng hay vụng về do bản tính, con chỉ đang nỗ lực điều khiển một hệ thần kinh hoạt động theo cách rất riêng. Hãy cùng thấu hiểu nguyên nhân khoa học và tìm ra phương pháp đồng hành an toàn giúp con tự tin hơn mỗi ngày.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Đánh Giá Sức Khỏe Vận Động Cho Con
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/vat_ly_tri_lieu_hero_vi_1779077058220.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>
    </header>

    <main>
        <!-- SECTION 1: NHỮNG KHÁC BIỆT (BG-WHITE) -->
        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <h2 class="font-oswald text-3xl md:text-4xl font-bold text-[#002795] mb-6">Những khác biệt trong kỹ năng vận động thường gặp ở trẻ phát triển thần kinh khác biệt</h2>
                    <p class="text-lg text-[#555555]">Sự phát triển thể chất của trẻ tự kỷ đôi khi không đi theo một đường thẳng giống như các mốc phát triển thông thường. Việc hiểu rõ những khác biệt này là bước đầu tiên để cha mẹ đồng hành cùng con bằng tình yêu thương thay vì sự kỳ vọng khiên cưỡng.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-[#FAF9F6] rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="text-5xl mb-6">🏃‍♂️</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Dấu hiệu nhận biết con đang gặp khó khăn với các bài tập vận động thô</h3>
                        <p class="text-[#3D3D3D]">Con có thể bước đi với tư thế cứng nhắc, hay nhón gót, lóng ngóng khi bắt bóng hoặc sợ hãi khi leo trèo. Thách thức trong việc duy trì thăng bằng khiến trẻ dễ bị vấp ngã ngay cả trên những bề mặt bằng phẳng.</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-[#FAF9F6] rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="text-5xl mb-6">✍️</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Cách quan sát những thách thức trong kỹ năng vận động tinh qua sinh hoạt hàng ngày</h3>
                        <p class="text-[#3D3D3D]">Việc điều khiển nhóm cơ nhỏ tiêu tốn nhiều năng lượng. Con gặp khó khăn khi cầm thìa xúc cơm, tự cài khuy áo, buộc dây giày hoặc cầm bút với tư thế gượng gạo, ấn bút quá mạnh khiến tay nhanh mỏi.</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-[#FAF9F6] rounded-2xl p-8 shadow-md hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="text-5xl mb-6">💔</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Sự vụng về vô ý và những hiểu lầm từ người xung quanh khiến trẻ dễ bị tổn thương</h3>
                        <p class="text-[#3D3D3D]">Trẻ thường bị dán nhãn là "hậu đậu" hay "lười biếng" khi làm rơi vỡ đồ đạc. Những lời trách mắng vô tình không giúp trẻ tiến bộ mà còn làm suy giảm lòng tự trọng, khiến con dần thu mình và sợ hãi vận động.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: NGUYÊN NHÂN KHOA HỌC (BG-CREAM) -->
        <section class="bg-[#FAF9F6] py-16 md:py-24 px-6">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-16 max-w-3xl mx-auto">
                    <h2 class="font-oswald text-3xl md:text-4xl font-bold text-[#002795] mb-6">Giải mã nguyên nhân khoa học khiến con lóng ngóng và khó phối hợp cơ thể</h2>
                    <p class="text-lg text-[#555555]">Những biểu hiện vụng về hoàn toàn không xuất phát từ việc con thiếu cố gắng. Khoa học đã chứng minh sự khác biệt sâu sắc trong cấu trúc hệ thần kinh tác động trực tiếp đến cách con điều khiển cơ thể.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Card 1 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md border-t-4 border-[#FFD154]">
                        <div class="text-4xl mb-4">🧠</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Khái niệm rối loạn phối hợp vận động và sự hiện diện phổ biến trong phổ tự kỷ</h3>
                        <p class="text-[#3D3D3D] text-sm md:text-base">Nhiều trẻ gặp tình trạng Dyspraxia - rào cản thần kinh khiến não bộ khó truyền đạt thông điệp trơn tru đến cơ bắp. Con rất thông minh, hiểu luật chơi nhưng lại lóng ngóng không thể thực hiện động tác vật lý theo ý muốn.</p>
                    </div>
                    <!-- Card 2 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md border-t-4 border-[#FFD154]">
                        <div class="text-4xl mb-4">🧩</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Rào cản trong việc lập kế hoạch vận động được lý giải từ góc nhìn thần kinh học</h3>
                        <p class="text-[#3D3D3D] text-sm md:text-base">Lập kế hoạch vận động (Motor planning) là khả năng hình dung và tổ chức chuyển động. Ở trẻ tự kỷ, quá trình này bị gián đoạn, buộc con phải suy nghĩ có ý thức về từng bước nhỏ, dẫn đến phản ứng chậm chạp và ngập ngừng.</p>
                    </div>
                    <!-- Card 3 -->
                    <div class="bg-white rounded-2xl p-8 shadow-md border-t-4 border-[#FFD154]">
                        <div class="text-4xl mb-4">⚖️</div>
                        <h3 class="font-oswald text-xl font-bold text-[#002795] mb-4">Sự khác biệt trong quá trình xử lý cảm giác làm ảnh hưởng đến khả năng kiểm soát cơ bắp</h3>
                        <p class="text-[#3D3D3D] text-sm md:text-base">Hệ cảm nhận bản thể và tiền đình giúp nhận thức cơ thể trong không gian. Khi rối loạn, con không cảm nhận rõ cơ thể đang ở đâu, dẫn đến va vấp hoặc dùng lực quá mạnh/yếu khi tương tác với đồ vật và con người.</p>
                    </div>
                </div>

                <div class="mt-16 text-center">
                    <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-[#FFD154] text-[#002795] font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg uppercase tracking-wide">
                        Làm Bài Test Kiểm Tra Ngay Cho Con
                    </a>
                </div>
            </div>
        </section>

        <!-- SECTION 3: PHƯƠNG PHÁP ĐỒNG HÀNH (BG-WHITE) -->
        <section class="bg-white py-16 md:py-24 px-6">
            <div class="max-w-5xl mx-auto">
                <div class="text-center mb-16">
                    <h2 class="font-oswald text-3xl md:text-4xl font-bold text-[#002795] mb-6">Phương pháp đồng hành cùng con vượt qua rào cản thể chất tại nhà an toàn</h2>
                    <p class="text-lg text-[#555555]">Thay vì thúc ép con phải đạt được các mốc chuẩn mực, cha mẹ hãy biến các bài tập can thiệp thành những trò chơi nhỏ, vui vẻ và không áp lực.</p>
                </div>

                <div class="space-y-12">
                    <!-- Item 1 -->
                    <div class="flex flex-col md:flex-row items-start gap-8 bg-[#FAF9F6] p-8 rounded-2xl">
                        <div class="bg-[#002795] text-[#FFD154] font-oswald text-4xl font-bold w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">1</div>
                        <div>
                            <h3 class="font-oswald text-2xl font-bold text-[#002795] mb-4">Gợi ý các hoạt động phát triển vận động thô giúp con tăng cường thăng bằng và sức mạnh</h3>
                            <ul class="space-y-3 text-[#3D3D3D]">
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Trò chơi mô phỏng động vật:</strong> Khuyến khích con bò như gấu, nhảy như ếch để phát triển sức mạnh cơ lõi (core strength).</li>
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Đi bộ trên vệt băng dính:</strong> Dán đường băng dính màu trên sàn nhà, cùng con chơi trò đi thăng bằng giúp hỗ trợ hệ tiền đình.</li>
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Ném và bắt gối:</strong> Sử dụng gối mềm ném qua lại, giúp con không sợ hãi nếu bắt trượt và tăng cường phối hợp tay mắt.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="flex flex-col md:flex-row items-start gap-8 bg-[#FAF9F6] p-8 rounded-2xl">
                        <div class="bg-[#002795] text-[#FFD154] font-oswald text-4xl font-bold w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">2</div>
                        <div>
                            <h3 class="font-oswald text-2xl font-bold text-[#002795] mb-4">Các trò chơi nhỏ giọt hỗ trợ hoàn thiện kỹ năng vận động tinh một cách khéo léo</h3>
                            <ul class="space-y-3 text-[#3D3D3D]">
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Chơi với đất nặn (Play-dough):</strong> Nhào, bóp, tạo hình giúp tăng cường sức mạnh các nhóm cơ nhỏ ở ngón tay và bàn tay.</li>
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Gắp hạt bằng nhíp:</strong> Yêu cầu con gắp và phân loại hạt bông màu sắc giúp phát triển kỹ năng cầm nắm ba ngón (tiền đề cầm bút).</li>
                                <li class="flex items-start gap-3"><span class="text-[#002795] font-bold mt-1">✓</span> <strong>Xâu hạt vòng cỡ lớn:</strong> Hoạt động đòi hỏi sự phối hợp nhịp nhàng giữa cả hai tay và mắt bằng dây dù và hạt lỗ to.</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="flex flex-col md:flex-row items-start gap-8 bg-[#FAF9F6] p-8 rounded-2xl">
                        <div class="bg-[#002795] text-[#FFD154] font-oswald text-4xl font-bold w-16 h-16 rounded-full flex items-center justify-center flex-shrink-0 shadow-md">3</div>
                        <div>
                            <h3 class="font-oswald text-2xl font-bold text-[#002795] mb-4">Vai trò của các chuyên gia trị liệu hoạt động trong hành trình can thiệp sớm cho trẻ</h3>
                            <p class="text-[#3D3D3D]">Dù sự đồng hành của gia đình là vô giá, góc nhìn chuyên môn từ các chuyên gia trị liệu hoạt động (OT) là một bước đệm vững chắc. Chuyên gia sẽ đánh giá chính xác con gặp khó khăn ở hệ thống cảm giác hay nhóm cơ nào, từ đó thiết kế lộ trình can thiệp cá nhân hóa mà cha mẹ khó tự xây dựng tại nhà.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 4: FAQ (BG-CREAM) -->
        <section class="bg-[#FAF9F6] py-16 md:py-24 px-6">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="font-oswald text-3xl md:text-4xl font-bold text-[#002795] mb-4">Giải đáp những trăn trở phổ biến của phụ huynh về thể chất của trẻ tự kỷ</h2>
                    <p class="text-lg text-[#555555]">Việc nuôi dạy một đứa trẻ phát triển thần kinh khác biệt mang đến nhiều lo âu. Dưới đây là những giải đáp tận tâm dành cho cha mẹ.</p>
                </div>

                <div class="space-y-4">
                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center hover:text-[#FFD154] transition-colors">
                            Trẻ tự kỷ có thể bắt kịp đà phát triển vận động như trẻ bình thường không?
                            <span class="text-2xl group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-[#3D3D3D] border-t border-gray-50 pt-4 mt-2">
                            Mỗi đứa trẻ là một cá thể độc lập với tốc độ phát triển riêng. Nhiều trẻ tự kỷ, thông qua sự đồng hành kiên nhẫn của gia đình và các can thiệp trị liệu hoạt động phù hợp, hoàn toàn có thể cải thiện đáng kể kỹ năng vận động, tự chủ trong sinh hoạt và tham gia các hoạt động thể chất an toàn.
                        </div>
                    </details>

                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center hover:text-[#FFD154] transition-colors">
                            Cha mẹ nên làm gì khi con liên tục né tránh các môn thể thao ở trường học?
                            <span class="text-2xl group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-[#3D3D3D] border-t border-gray-50 pt-4 mt-2">
                            Sự né tránh thường bắt nguồn từ nỗi sợ hãi thất bại hoặc quá tải cảm giác (tiếng ồn, ánh sáng). Cha mẹ không nên ép buộc. Hãy trò chuyện với giáo viên để điều chỉnh bài tập, đồng thời giới thiệu các hoạt động ít áp lực cạnh tranh ở nhà như bơi lội, đạp xe hoặc yoga.
                        </div>
                    </details>

                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center hover:text-[#FFD154] transition-colors">
                            Sự vụng về của con có tự hết khi lớn lên hay bắt buộc phải can thiệp y khoa?
                            <span class="text-2xl group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-[#3D3D3D] border-t border-gray-50 pt-4 mt-2">
                            Sự khó khăn do khác biệt thần kinh hiếm khi tự động biến mất. Tuy nhiên, nếu được can thiệp sớm qua trị liệu hoạt động (OT), con sẽ học được các "chiến lược bù đắp" và rèn luyện cơ bắp. Can thiệp không nhằm "chữa khỏi" tự kỷ, mà trao cho con công cụ để tự lập.
                        </div>
                    </details>

                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center hover:text-[#FFD154] transition-colors">
                            Làm sao để phân biệt giữa thái độ lười biếng và sự khó khăn vận động thực sự?
                            <span class="text-2xl group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-[#3D3D3D] border-t border-gray-50 pt-4 mt-2">
                            Một đứa trẻ lười biếng vẫn có thể thực hiện hành động trơn tru nếu có phần thưởng. Ngược lại, trẻ gặp khó khăn vận động thực sự sẽ thể hiện sự gượng gạo, sai tư thế hoặc nhanh chóng mệt mỏi, cáu gắt ngay cả khi con rất muốn tham gia.
                        </div>
                    </details>

                    <details class="group bg-white rounded-xl shadow-sm border border-gray-100">
                        <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center hover:text-[#FFD154] transition-colors">
                            Khi nào gia đình cần đưa con đến gặp chuyên gia trị liệu hoạt động?
                            <span class="text-2xl group-open:rotate-45 transition-transform duration-300">+</span>
                        </summary>
                        <div class="px-6 pb-6 text-[#3D3D3D] border-t border-gray-50 pt-4 mt-2">
                            Khi rào cản thể chất ảnh hưởng trực tiếp đến chất lượng sống: con thường xuyên vấp ngã nguy hiểm, không thể tự thực hiện kỹ năng tự phục vụ cơ bản (xúc ăn, mặc quần áo) đúng lứa tuổi, hoặc sự tự ti khiến con thu mình, từ chối giao tiếp xã hội.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <!-- CTA FINAL -->
        <section class="bg-white py-16 px-6 text-center">
            <div class="max-w-3xl mx-auto border-t border-gray-200 pt-16">
                <h2 class="font-oswald text-3xl font-bold text-[#002795] mb-6">Đồng Hành Cùng Con Bắt Đầu Từ Việc Thấu Hiểu</h2>
                <p class="text-[#3D3D3D] mb-8 text-lg">Đừng để những lo lắng cản bước hành trình yêu thương. Hãy thực hiện ngay bảng đánh giá để có cái nhìn tổng quan nhất về tình trạng vận động và sức khỏe toàn diện của con.</p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="bg-[#FFD154] text-[#002795] font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg uppercase tracking-wide">
                    NHẬN BẢNG CHECKLIST ĐÁNH GIÁ NGAY
                </a>
            </div>
        </section>

        <!-- DISCLAIMER SECTION -->
        <section class="bg-gray-100 pb-12 pt-12 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <p class="text-[#555555] text-sm italic">
                    "Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp."
                </p>
            </div>
        </section>
    </main>

    <!-- FOOTER / SOURCES -->
    <footer class="bg-gray-100 py-12 px-6 border-t border-gray-200">
        <div class="max-w-6xl mx-auto">
            <h4 class="font-oswald text-xl font-bold text-[#002795] mb-6">Danh sách 20 nguồn tài liệu tham khảo khoa học và cộng đồng:</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-3 text-sm text-[#555555]">
                <p>[1] Verywell Health: Dấu hiệu và sự phát triển vận động ở trẻ tự kỷ (verywellhealth.com/motor-clumsiness-in-autism-260154)</p>
                <p>[2] Healthline: Mối liên hệ giữa tự kỷ và khó khăn vận động (healthline.com/health/autism/motor-skills)</p>
                <p>[3] Spectrum News: Giải thích sự khác biệt trong chức năng vận động ở trẻ tự kỷ (spectrumnews.org)</p>
                <p>[4] Raising Children Network: Sự phát triển thể chất và vận động (raisingchildren.net.au)</p>
                <p>[5] WebMD: Nhận diện các triệu chứng thể chất của phổ tự kỷ (webmd.com/brain/autism)</p>
                <p>[6] Autism Speaks: Kỹ năng vận động ở trẻ tự kỷ (autismspeaks.org)</p>
                <p>[7] Understood: Những điều phụ huynh cần biết về kỹ năng vận động (understood.org)</p>
                <p>[8] CDC: Nhận biết các cột mốc phát triển và dấu hiệu sớm (cdc.gov/ncbddd/autism)</p>
                <p>[9] Child Mind Institute: Tự kỷ và những thách thức trong vận động thô/tinh (childmind.org)</p>
                <p>[10] National Autistic Society: Rối loạn phối hợp vận động (Dyspraxia) và tự kỷ (autism.org.uk)</p>
                <p>[11] Your Kids Table: Hỗ trợ kỹ năng vận động tinh cho trẻ tự kỷ tại nhà (yourkidstable.com)</p>
                <p>[12] Harkla: Tự kỷ và sự phát triển kỹ năng vận động (harkla.co)</p>
                <p>[13] North Shore Pediatric Therapy: Khác biệt trong lập kế hoạch vận động ở trẻ tự kỷ (nspt4kids.com)</p>
                <p>[14] The OT Toolbox: Tổng quan về can thiệp vận động qua góc nhìn trị liệu (theottoolbox.com)</p>
                <p>[15] Pathways: Các mốc vận động thô/tinh cần lưu ý (pathways.org)</p>
                <p>[16] The Mighty: "Sự hậu đậu" và kỹ năng vận động qua lăng kính người tự kỷ (themighty.com)</p>
                <p>[17] Thinking Person's Guide to Autism: Hiểu về sự khác biệt vận động thay vì phán xét (thinkingautismguide.com)</p>
                <p>[18] Autistic Not Weird: Thách thức vận động thô và sự tự tin của trẻ (autisticnotweird.com)</p>
                <p>[19] Neuroclastic: Giải mã chứng mất tự dụng (Apraxia) và lập kế hoạch vận động (neuroclastic.com)</p>
                <p>[20] AANE: Hỗ trợ những thách thức thể chất vô hình của tự kỷ (aane.org)</p>
            </div>
        </div>
    </footer>


</div>

<?php get_footer(); ?>
