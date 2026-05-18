<?php /* Template Name: Tre_Tu_Ky_Tieu_Chay_Man_Tinh_Landing */ ?>
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
                    LẮNG NGHE TIẾNG GỌI TỪ CHIẾC BỤNG ĐAU KHI TRẺ TỰ KỶ TIÊU CHẢY MÃN TÍNH
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Hành trình làm cha mẹ của một em bé phát triển thần kinh khác biệt vốn dĩ đã có nhiều đêm thức trắng. Sự
                vất vả ấy lại càng nhân lên gấp bội khi bạn phải chứng kiến con mình đi ngoài phân lỏng ngày qua ngày.
                Tình trạng trẻ tự kỷ tiêu chảy mãn tính không chỉ đơn thuần là một vấn đề về hệ bài tiết, mà nó còn là
                tiếng kêu cứu từ một cơ thể đang chịu nhiều tổn thương nhưng lại thiếu đi ngôn ngữ để diễn đạt.
                
                Khi con liên tục cáu gắt, đập phá đồ đạc hay bứt rứt không yên, nhiều cha mẹ dễ rơi vào vòng lặp mệt mỏi
                và nghĩ rằng con đang "ăn vạ" hoặc biểu hiện "hành vi tự kỷ". Thế nhưng, sự thật thường xót xa hơn rất
                nhiều. Những cơn cuộn thắt trong ruột, cảm giác sôi bụng và sự mệt mỏi kéo dài do mất nước đang bào mòn
                năng lượng của con. Đừng để con phải đơn độc chịu đựng những cơn đau vô hình.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    BẮT ĐẦU KIỂM TRA SỨC KHỎE TOÀN DIỆN
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/vat_ly_tri_lieu_hero_vi_1779077058220.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>
    </section>

    <!-- Section 1: Dấu hiệu cảnh báo -->
    <section class="bg-[#FAF9F6] py-16 md:py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-oswald font-bold text-[#002795] text-center mb-12">
                Những dấu hiệu cảnh báo con đang chịu đựng cơn đau tiêu hóa mà cha mẹ dễ bỏ qua
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Card 1 -->
                <div class="bg-white rounded-2xl p-8 shadow-md border-t-4 border-[#FFD154]">
                    <div class="text-4xl mb-4">🤐</div>
                    <h3 class="text-xl font-oswald font-bold text-[#002795] mb-4">
                        Biểu hiện rối loạn hành vi do con không thể diễn đạt nỗi đau bằng lời
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Một em bé có khả năng ngôn ngữ bình thường sẽ dễ dàng nói với mẹ rằng bụng con đau quá hoặc con
                        muốn đi vệ sinh. Nhưng với trẻ tự kỷ, đặc biệt là những trẻ hạn chế về mặt ngôn ngữ, mọi sự khó
                        chịu về thể chất đều bị dồn nén lại [1, 6]. Khi cơn đau ập đến, trẻ thường có những hành vi vô
                        thức để cố gắng xoa dịu sự khó chịu.
                        <br><br>
                        Cha mẹ có thể quan sát thấy con thường xuyên lấy tay ấn mạnh vào vùng bụng dưới, hoặc nằm vắt
                        ngang bụng qua thành ghế tì đè mạnh. Một số bé lại có tư thế đi đứng gù lưng lại, ôm lấy bụng và
                        nhón gót chân. Những hành vi này không phải là sự kỳ lạ vô cớ, mà là phản xạ tự nhiên của cơ thể
                        nhằm tạo áp lực lên ổ bụng để giảm bớt cảm giác quặn thắt do tiêu chảy kéo dài gây ra.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white rounded-2xl p-8 shadow-md border-t-4 border-[#FFD154]">
                    <div class="text-4xl mb-4">⚠️</div>
                    <h3 class="text-xl font-oswald font-bold text-[#002795] mb-4">
                        Nhận biết sự khác biệt giữa những đợt tiêu chảy cấp tính và tình trạng mãn tính kéo dài
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Trẻ nhỏ bị rối loạn tiêu hóa vài ngày do ăn phải thức ăn lạ là điều rất bình thường. Tuy nhiên,
                        tình trạng mãn tính lại mang một hình thái hoàn toàn khác và nguy hiểm hơn. Theo các chuyên gia
                        tiêu hóa [2, 8], nếu con đi ngoài phân lỏng, nát, có mùi chua ngoét hoặc chứa thức ăn chưa tiêu
                        hóa hết kéo dài trên bốn tuần, đó là lúc ruột của con đang phát đi tín hiệu cấp cứu.
                        <br><br>
                        Tình trạng này không diễn ra liên tục mỗi ngày mà có thể lặp đi lặp lại thành từng đợt. Thậm
                        chí, nhiều trẻ vừa đi ngoài phân lỏng, vừa xen kẽ những ngày không thể đi vệ sinh được. Phân
                        lỏng làm mất đi lượng nước và khoáng chất quý giá, khiến con luôn trong trạng thái lờ đờ, nhợt
                        nhạt, thiếu sinh khí và đặc biệt nhạy cảm với mọi âm thanh hay ánh sáng xung quanh.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Cơ chế sinh học -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-oswald font-bold text-[#002795] text-center mb-6">
                Lý giải cơ chế sinh học khiến đường ruột của trẻ trở nên cực kỳ nhạy cảm
            </h2>
            <p class="text-center font-quicksand text-[#555555] text-lg max-w-3xl mx-auto mb-16">
                Nhiều cha mẹ thường thắc mắc tại sao các vấn đề về <a
                    href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky"
                    class="text-[#002795] font-bold hover:underline">tiêu hóa dạ dày trẻ tự kỷ</a> lại phổ biến và nghiêm
                trọng đến vậy. Câu trả lời nằm ở những khác biệt sâu sắc trong cấu trúc sinh học. Không phải do cha mẹ
                chăm sóc không tốt, mà là do cơ thể con vốn dĩ đã có những nhạy cảm đặc thù.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-start">
                <div class="bg-[#FAF9F6] p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">🧠</div>
                    <h3 class="text-2xl font-oswald font-bold text-[#002795] mb-4">
                        Mối liên hệ mật thiết giữa hệ thần kinh và hệ tiêu hóa thông qua trục ruột não
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Khoa học hiện đại đã chứng minh rằng đường ruột được xem như bộ não thứ hai của con người. Giữa
                        não bộ và đường ruột tồn tại một mạng lưới giao tiếp liên tục được gọi là trục ruột não [15,
                        19]. Đối với một em bé có sự phát triển thần kinh khác biệt, hệ thống giao tiếp này thường trở
                        nên quá tải. Mọi thông tin sâu hơn đều được tổng hợp đầy đủ trong chủ đề <a
                            href="https://hieucontugoc.online/truc-ruot-nao-tu-ky"
                            class="text-[#002795] font-bold hover:underline">trục ruột não & tự kỷ</a>.
                        <br><br>
                        Khi não bộ gặp căng thẳng từ môi trường như tiếng ồn, ánh sáng chói, nó sẽ gửi tín hiệu báo động
                        xuống đường ruột. Ngược lại, khi đường ruột bị viêm nhiễm hoặc co thắt liên tục do tiêu chảy, nó
                        sẽ gửi ngược những tín hiệu đau đớn lên não. Vòng lặp luẩn quẩn này khiến hệ thần kinh của con
                        luôn trong trạng thái căng như dây đàn, dẫn đến những cơn khủng hoảng tâm lý không thể kiểm
                        soát.
                    </p>
                </div>

                <div class="bg-[#FAF9F6] p-8 rounded-2xl shadow-sm">
                    <div class="text-4xl mb-4">🦠</div>
                    <h3 class="text-2xl font-oswald font-bold text-[#002795] mb-4">
                        Tổn thương hệ vi sinh vật khiến cơ thể con phản ứng thái quá với thức ăn
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Bên trong hệ tiêu hóa của chúng ta là một hệ sinh thái khổng lồ gồm hàng tỷ vi khuẩn. Ở những em
                        bé bình thường, hệ sinh thái này duy trì sự cân bằng hoàn hảo. Tuy nhiên, các chuyên gia [11,
                        13] chỉ ra rằng, phần lớn trẻ tự kỷ đang gặp phải tình trạng mất cân bằng hệ vi sinh nghiêm
                        trọng. Cha mẹ có thể tìm hiểu thêm về hiện tượng <a
                            href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky"
                            class="text-[#002795] font-bold hover:underline">dysbiosis đường ruột ở trẻ tự kỷ</a> để hiểu rõ
                        hơn.
                        <br><br>
                        Sự thiếu hụt trầm trọng lợi khuẩn khiến lớp niêm mạc ruột mỏng manh và dễ tổn thương. Thay vì
                        hấp thụ dinh dưỡng, ruột non lại để rò rỉ những phân tử thức ăn chưa tiêu hóa hoàn toàn vào máu.
                        Cơ thể nhận diện đây là những kẻ xâm nhập và kích hoạt hệ miễn dịch tấn công, tạo ra các phản
                        ứng viêm kéo dài. Kết quả là bất cứ thứ gì con ăn vào cũng có thể trở thành tác nhân gây co thắt
                        và đẩy ra ngoài dưới dạng phân lỏng.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Phân biệt hành vi -->
    <section class="bg-[#FAF9F6] py-16 md:py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-oswald font-bold text-[#002795] text-center mb-6">
                Cách phân biệt cơn đau thể chất với những rối loạn hành vi thông thường ở trẻ
            </h2>
            <p class="text-center font-quicksand text-[#555555] text-lg max-w-3xl mx-auto mb-12">
                Ranh giới giữa một hành vi mang tính đặc thù của chứng tự kỷ và một phản ứng do đau đớn thể chất đôi khi
                rất mong manh. Nếu chúng ta chỉ dùng các biện pháp can thiệp hành vi để xử lý một em bé đang bị đau bụng
                quằn quại, đó sẽ là một sự bất công rất lớn đối với con.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-white rounded-2xl p-8 shadow-md">
                    <div class="text-4xl mb-4">🤕</div>
                    <h3 class="text-xl font-oswald font-bold text-[#002795] mb-4">
                        Con tự làm đau bản thân hoặc cắn xé đồ vật để xoa dịu sự bứt rứt bên trong
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Hành vi tự gây thương tích luôn là nỗi ám ảnh. Khi thấy con tự đập đầu vào tường, cắn mạnh vào
                        mu bàn tay hay cào cấu chính mình, phản ứng đầu tiên thường là hoảng sợ. Tuy nhiên, theo WebMD
                        [4] và Autism Parenting Magazine [16], đây có thể là cách đánh lạc hướng cơn đau.
                        <br><br>
                        Khi cơn đau từ hệ tiêu hóa quá sức chịu đựng và mơ hồ, việc tạo ra một nỗi đau vật lý rõ ràng ở
                        bên ngoài bằng cách cắn tay hay đập đầu sẽ giúp hệ thần kinh tạm thời chuyển hướng sự chú ý.
                        Tương tự như việc người lớn thường nghiến răng khi đang bị đau dữ dội. Nếu con đột ngột xuất
                        hiện các hành vi này đi kèm với dấu hiệu bụng đầy hơi, cha mẹ cần nghĩ ngay đến các vấn đề tiêu
                        hóa.
                    </p>
                </div>

                <div class="bg-white rounded-2xl p-8 shadow-md">
                    <div class="text-4xl mb-4">🌙</div>
                    <h3 class="text-xl font-oswald font-bold text-[#002795] mb-4">
                        Giấc ngủ chập chờn và những cơn bùng nổ cảm xúc đột ngột giữa đêm
                    </h3>
                    <p class="font-quicksand text-[#3D3D3D] leading-relaxed">
                        Giấc ngủ là thời điểm cơ thể cần được nghỉ ngơi, nhưng với những em bé bị viêm ruột mãn tính,
                        đêm về lại là lúc những cơn đau hoành hành rõ rệt nhất [12, 17]. Bạn sẽ thấy con ngủ không sâu
                        giấc, hay trở mình, vã mồ hôi trộm và thường xuyên tỉnh dậy khóc thét giữa đêm.
                        <br><br>
                        Điều này cũng xảy ra ở các thái cực đối lập, ví dụ như khi <a
                            href="https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh"
                            class="text-[#002795] font-bold hover:underline">trẻ tự kỷ táo bón mãn tính</a>. Sự ách tắc và
                        rối loạn nhu động ruột đều tạo ra những áp lực lớn lên hệ thần kinh. Khi con không có một giấc
                        ngủ trọn vẹn, hệ lụy tất yếu vào ngày hôm sau là sự cáu gắt, giảm khả năng tập trung và từ chối
                        hợp tác.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Giải pháp & CTA -->
    <section class="bg-white py-16 md:py-24 px-6">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-oswald font-bold text-[#002795] text-center mb-12">
                Từng bước đồng hành giúp con xoa dịu nỗi đau và phục hồi nhịp sinh học đường ruột
            </h2>

            <div class="mb-12">
                <h3 class="text-2xl font-oswald font-bold text-[#002795] mb-4">
                    Điều chỉnh dinh dưỡng để làm dịu niêm mạc ruột đang chịu tổn thương
                </h3>
                <p class="font-quicksand text-[#3D3D3D] leading-relaxed bg-[#FAF9F6] p-6 rounded-xl border-l-4 border-[#002795]">
                    Khi ruột đang bị viêm do tiêu chảy kéo dài, việc loại bỏ các tác nhân gây kích ứng là ưu tiên hàng
                    đầu. Protein từ lúa mì (Gluten) và protein từ sữa bò (Casein) là hai thành phần cực kỳ khó tiêu hóa
                    [7, 20]. Chúng có thể tạo ra các hợp chất gây viêm và làm trầm trọng thêm tình trạng rò rỉ ruột.
                    <br><br>
                    Nhiều gia đình đã ghi nhận những cải thiện tích cực khi áp dụng <a
                        href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky"
                        class="text-[#002795] font-bold hover:underline">chế độ ăn không gluten casein (gfcf) cho trẻ tự
                        kỷ</a>. Chế độ này đóng vai trò như một lớp áo giáp bảo vệ, cho phép lớp niêm mạc đường ruột có
                    thời gian được nghỉ ngơi và tái tạo tế bào mới. Hãy bổ sung cho con các loại nước hầm xương giàu
                    collagen, các loại rau củ nấu chín nhừ và cung cấp đủ nước lọc.
                </p>
            </div>

            <div class="mb-16">
                <h3 class="text-2xl font-oswald font-bold text-[#002795] mb-4">
                    Quan sát ghi chép nhật ký tiêu hóa và tìm kiếm sự hỗ trợ từ y khoa
                </h3>
                <p class="font-quicksand text-[#3D3D3D] leading-relaxed bg-[#FAF9F6] p-6 rounded-xl border-l-4 border-[#002795]">
                    Không có một phương pháp chung nào hiệu quả cho mọi em bé. Cách tốt nhất để thấu hiểu đường ruột của
                    con là cha mẹ hãy bắt đầu viết một cuốn "Nhật ký tiêu hóa". Hãy ghi chép lại một cách tỉ mỉ những gì
                    con đã ăn, biểu hiện cảm xúc của con, màu sắc của phân và chất lượng giấc ngủ [9, 14].
                    <br><br>
                    Thay vì tự ý dùng thuốc cầm tiêu chảy làm che lấp triệu chứng, cha mẹ hãy dựa vào những ghi chép đó
                    và thực hiện một bước quan trọng. Hãy chủ động rà soát tổng thể để đội ngũ chuyên môn có cơ sở đồng
                    hành.
                </p>
            </div>

            <div class="text-center">
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/"
                    class="bg-[#FFD154] text-[#002795] font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all block w-fit mx-auto text-lg uppercase tracking-wide">
                    ĐIỀN BẢNG KIỂM TRA SỨC KHỎE NGAY HÔM NAY
                </a>
                <p class="mt-4 font-quicksand text-[#555555] text-sm">Hành động nhỏ của cha mẹ có thể xoa dịu nỗi đau vô
                    hình của con.</p>
            </div>
        </div>
    </section>

    <!-- Section 5: FAQ Accordion -->
    <section class="bg-[#FAF9F6] py-16 md:py-24 px-6">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-oswald font-bold text-[#002795] text-center mb-10">
                Chuyên mục giải đáp những trăn trở của cha mẹ về tình trạng rối loạn tiêu hóa ở con
            </h2>

            <div class="space-y-4">
                <details class="group bg-white rounded-xl shadow-sm">
                    <summary
                        class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Làm sao để tôi biết con đang bị đau bụng khi con chưa biết chỉ tay hay nói chuyện?
                        <span class="text-2xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#3D3D3D] font-quicksand">
                        Bạn hãy quan sát những thay đổi đột ngột trong ngôn ngữ cơ thể của con. Trẻ bị đau bụng quặn
                        thắt thường có xu hướng gập người lại, nằm đè bụng lên gối hoặc thành giường cứng. Con cũng có
                        thể cáu gắt vô cớ, tự cắn vào tay mình, trằn trọc vào ban đêm và từ chối những món đồ chơi mà
                        trước đây con từng rất thích.
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm">
                    <summary
                        class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Tình trạng đi ngoài phân lỏng của con tôi cứ thuyên giảm được vài ngày rồi lại tái phát thì phải
                        làm sao?
                        <span class="text-2xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#3D3D3D] font-quicksand">
                        Đây là biểu hiện đặc trưng của tình trạng rối loạn hệ vi sinh đường ruột hoặc bất dung nạp thực
                        phẩm mãn tính. Lúc này, việc cho con uống men vi sinh thông thường có thể không giải quyết được
                        gốc rễ. Bạn cần xem xét lại chế độ ăn, loại bỏ các tác nhân gây viêm và thực hiện ghi chép nhật
                        ký dinh dưỡng.
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm">
                    <summary
                        class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Việc cắt bỏ lúa mì và sữa bò (áp dụng GFCF) có khiến con tôi bị thiếu chất dinh dưỡng không?
                        <span class="text-2xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#3D3D3D] font-quicksand">
                        Không, nếu bạn biết cách thay thế bằng các nguồn thực phẩm khác tương đương. Canxi từ sữa bò có
                        thể thay thế bằng các loại hạt, rau lá xanh đậm. Tinh bột từ lúa mì thay thế bằng gạo tẻ, yến
                        mạch không chứa gluten, khoai lang. Bạn nên tham khảo ý kiến chuyên gia dinh dưỡng trước khi
                        thay đổi toàn diện thực đơn.
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm">
                    <summary
                        class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Có phải tất cả trẻ tự kỷ đều gặp vấn đề về tiêu chảy hoặc táo bón không?
                        <span class="text-2xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#3D3D3D] font-quicksand">
                        Không phải tất cả, nhưng tỷ lệ này rất cao. Theo các báo cáo y khoa, trẻ phát triển thần kinh
                        khác biệt có nguy cơ mắc các bệnh lý dạ dày ruột cao gấp 3 đến 4 lần so với trẻ phát triển điển
                        hình do sự khác biệt trong hoạt động của trục ruột não và hệ vi sinh.
                    </div>
                </details>

                <details class="group bg-white rounded-xl shadow-sm">
                    <summary
                        class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Tôi nên bắt đầu từ đâu để giúp con thoát khỏi chuỗi ngày mệt mỏi do rối loạn tiêu hóa này?
                        <span class="text-2xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#3D3D3D] font-quicksand">
                        Bước đầu tiên và quan trọng nhất là đánh giá tổng thể bức tranh sức khỏe của con chứ không chỉ
                        nhìn vào triệu chứng tiêu chảy. Cha mẹ hãy dành vài phút để hoàn thành <a
                            href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/"
                            class="text-[#002795] font-bold hover:underline">bảng kiểm tra sức khỏe toàn diện</a> nhằm giúp
                        các chuyên gia có cái nhìn đa chiều về tình trạng của con.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Disclaimer -->
    <section class="bg-gray-100 pt-16 pb-8 px-6 text-center">
        <div class="max-w-4xl mx-auto">
            <p class="text-[#555555] text-sm italic font-quicksand">
                "Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát
                triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp."
            </p>
        </div>
    </section>

    <!-- Nguồn tham khảo -->
    <section class="bg-gray-100 py-12 px-6">
        <div class="max-w-4xl mx-auto border-t border-gray-300 pt-8">
            <h4 class="font-oswald text-[#3D3D3D] font-bold mb-4 uppercase">Nguồn bài báo và kiến thức tham khảo:</h4>
            <ul class="text-sm text-[#555555] font-quicksand space-y-2 list-disc list-inside">
                <li>[1] Healthline - Autism and Constipation - What's the Connection?</li>
                <li>[2] Healthline - IBS and Autism - Exploring Digestive Issues in ASD</li>
                <li>[3] Medical News Today - Autism and precocious puberty: Is there a connection?</li>
                <li>[4] WebMD - What to Know About Potty Training for Children With Autism</li>
                <li>[5] Psychology Today - Autism and Related Conditions</li>
                <li>[6] Autism Speaks - Gastrointestinal Conditions in Autism</li>
                <li>[7] Autism Speaks - Expert Opinion - Autism and GI Disorders</li>
                <li>[8] Understood - Gastrointestinal Issues and Kids: What You Need to Know</li>
                <li>[9] CDC - Associated Medical Conditions with Autism Spectrum Disorder</li>
                <li>[10] National Autistic Society - Constipation, Diarrhea, and Autism</li>
                <li>[11] Spectrum News - Gastrointestinal issues in autism, explained</li>
                <li>[12] Seattle Children's Hospital - Autism and Gastrointestinal Problems</li>
                <li>[13] Massachusetts General Hospital - Gastrointestinal Issues in Autism</li>
                <li>[14] Kennedy Krieger Institute - Autism and GI Issues</li>
                <li>[15] Stanford Medicine - Researchers find link between autism and GI issues</li>
                <li>[16] Autism Parenting Magazine - Autism and GI Issues: What You Need To Know</li>
                <li>[17] Autism Parenting Magazine - Navigating Diarrhea and Bowel Issues in Autism</li>
                <li>[18] The Autism Community in Action (TACA) - Gastrointestinal Issues in Autism</li>
                <li>[19] Autism Awareness Centre - The Gut-Brain Connection in Autism</li>
                <li>[20] National Autism Resources - Autism and Digestion</li>
            </ul>
        </div>
    </section>


</div>

<?php get_footer(); ?>
