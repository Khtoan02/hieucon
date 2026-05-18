<?php /* Template Name: Tre_Tu_Ky_Tao_Bon_Man_Tinh_Landing */ ?>
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
                    TRẺ TỰ KỶ TÁO BÓN MÃN TÍNH VÀ HÀNH TRÌNH THẤU HIỂU ĐỂ XOA DỊU
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Đằng sau những khó khăn mỗi lần đi vệ sinh của con là cả một hệ thống sinh học phức tạp đang gặp sự cố. Hãy cùng khám phá giải pháp can thiệp an toàn từ gốc rễ để mang lại nụ cười cho thiên thần nhỏ của bạn.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    LÀM BẢNG KIỂM TRA SỨC KHỎE NGAY
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/oral_motor_therapy_hero_img_1779078827681.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>
    </header>

    <section class="py-20 md:py-28 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-[#002795] text-3xl md:text-4xl font-semibold text-center mb-16 max-w-4xl mx-auto">
                Những khó khăn thầm lặng khi con không thể gọi tên nỗi đau thể chất
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <div class="bg-[#FAF9F6] p-10 rounded-3xl shadow-sm border border-[#002795]/5">
                    <div class="text-5xl mb-6 text-[#002795]">🧩</div>
                    <h3 class="text-[#002795] text-2xl mb-4">Hành vi kích động do đau đôi khi bị nhầm lẫn với sự bùng nổ cảm xúc thông thường</h3>
                    <p class="text-[#555555] leading-relaxed">
                        Nhiều trẻ em trên phổ tự kỷ gặp khó khăn trong việc cảm nhận tín hiệu từ bên trong cơ thể (interoception). Khi đại tràng căng tức, con không thể nói "mẹ ơi con đau" mà bộc lộ qua việc la hét, khóc lóc dai dẳng hoặc tự làm đau bản thân. Những tiếng kêu cứu này thường bị nhầm với "khủng hoảng hành vi".
                    </p>
                </div>
                <div class="bg-[#FAF9F6] p-10 rounded-3xl shadow-sm border border-[#002795]/5">
                    <div class="text-5xl mb-6 text-[#002795]">💔</div>
                    <h3 class="text-[#002795] text-2xl mb-4">Nỗi xót xa của cha mẹ khi chứng kiến những vấn đề rối loạn tiêu hóa ở trẻ tự kỷ</h3>
                    <p class="text-[#555555] leading-relaxed">
                        Nhìn con trốn vào góc phòng, gồng đỏ mặt toát mồ hôi mà không thể đi ngoài khiến trái tim cha mẹ thắt lại. Tình trạng <a href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky" class="text-[#002795] font-bold underline">tiêu hóa dạ dày trẻ tự kỷ</a> không chỉ gây đau đớn mà còn làm suy giảm giấc ngủ và khả năng học hỏi của con.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-28 px-6 bg-[#FAF9F6]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-[#002795] text-3xl md:text-4xl font-semibold text-center mb-16 max-w-4xl mx-auto">
                Khám phá mối liên hệ sâu sắc giữa đường ruột và não bộ của trẻ phát triển thần kinh khác biệt
            </h2>
            <div class="flex flex-col md:flex-row gap-16 items-center">
                <div class="w-full md:w-1/2 space-y-8">
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#002795] text-[#FAF9F6] rounded-full flex items-center justify-center font-bold">1</div>
                        <div>
                            <h3 class="text-[#002795] text-xl font-bold mb-2 uppercase">Hệ thống giao tiếp hai chiều</h3>
                            <p class="text-[#555555]">
                                <a href="https://hieucontugoc.online/truc-ruot-nao-tu-ky" class="text-[#002795] font-bold underline">Trục ruột não & tự kỷ</a> chứng minh rằng sự căng thẳng thần kinh làm chậm nhu động ruột, và ngược lại, áp lực tiêu hóa sẽ truyền tín hiệu cảnh báo lên não gây bất ổn cảm xúc.
                            </p>
                        </div>
                    </div>
                    <div class="flex gap-6">
                        <div class="flex-shrink-0 w-12 h-12 bg-[#002795] text-[#FAF9F6] rounded-full flex items-center justify-center font-bold">2</div>
                        <div>
                            <h3 class="text-[#002795] text-xl font-bold mb-2 uppercase">Sự nhạy cảm từ dysbiosis</h3>
                            <p class="text-[#555555]">
                                Tình trạng <a href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky" class="text-[#002795] font-bold underline">dysbiosis đường ruột ở trẻ tự kỷ</a> (loạn khuẩn) khiến thức ăn lên men, sinh khí ga, tạo độc tố ngấm qua thành ruột và tác động trực tiếp lên hệ thần kinh của con.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="w-full md:w-1/2 bg-[#002795] p-12 rounded-[3rem] text-[#FAF9F6] shadow-2xl">
                    <p class="text-2xl font-oswald italic mb-6">"Đường ruột là bộ não thứ hai. Khi ruột bị tổn thương, tâm trí con không thể bình yên."</p>
                    <hr class="border-[#FAF9F6]/20 mb-6">
                    <p class="text-sm opacity-80 leading-relaxed font-quicksand">Cha mẹ cần nhìn nhận tổng thể thay vì chỉ điều trị triệu chứng táo bón bằng thuốc nhuận tràng thông thường.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-28 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-[#002795] text-3xl md:text-4xl font-semibold text-center mb-16 max-w-4xl mx-auto">
                Cách nhận biết sự thay đổi trong hệ tiêu hóa khi con gặp khó khăn trong việc đi vệ sinh
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-8 border-2 border-[#FAF9F6] rounded-2xl hover:border-[#FFD154] transition-colors">
                    <h3 class="text-[#002795] text-xl mb-3">Dấu hiệu thể chất</h3>
                    <ul class="space-y-3 text-[#555555] text-sm">
                        <li class="flex items-start gap-2"><span>✔</span> Bụng căng cứng, phình to.</li>
                        <li class="flex items-start gap-2"><span>✔</span> Đi kiễng gót hoặc bắt chéo chân.</li>
                        <li class="flex items-start gap-2"><span>✔</span> Phân cứng như phân dê, có máu.</li>
                    </ul>
                </div>
                <div class="p-8 border-2 border-[#FAF9F6] rounded-2xl hover:border-[#FFD154] transition-colors">
                    <h3 class="text-[#002795] text-xl mb-3">Hành vi bộc phát</h3>
                    <ul class="space-y-3 text-[#555555] text-sm">
                        <li class="flex items-start gap-2"><span>✔</span> Rối loạn giấc ngủ, khóc đêm.</li>
                        <li class="flex items-start gap-2"><span>✔</span> Đột ngột cáu gắt không lý do.</li>
                        <li class="flex items-start gap-2"><span>✔</span> Ăn vạ (meltdown) dữ dội.</li>
                    </ul>
                </div>
                <div class="p-8 border-2 border-[#FAF9F6] rounded-2xl hover:border-[#FFD154] transition-colors">
                    <h3 class="text-[#002795] text-xl mb-3">Sự luân phiên bất thường</h3>
                    <p class="text-[#555555] text-sm leading-relaxed">
                        Hiện tượng phân lỏng rỉ ra xen kẽ chuỗi ngày táo bón (trẻ tự kỷ tiêu chảy mãn tính) thường do khối phân cứng mắc kẹt ở trực tràng.
                    </p>
                    <a href="https://hieucontugoc.online/tre-tu-ky-tieu-chay-man-tinh" class="text-[#002795] text-xs font-bold mt-4 block underline">Tìm hiểu về tiêu chảy mãn tính</a>
                </div>
            </div>
            <div class="mt-16 text-center">
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button">
                    CON ĐANG GẶP DẤU HIỆU NÀO? KIỂM TRA NGAY
                </a>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-28 px-6 bg-[#FAF9F6]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-[#002795] text-3xl md:text-4xl font-semibold text-center mb-16 max-w-4xl mx-auto">
                Những phương pháp can thiệp nhẹ nhàng từ gốc rễ giúp con cân bằng lại hệ vi sinh
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <div class="bg-white p-8 rounded-3xl shadow-sm text-center">
                    <div class="w-16 h-16 bg-[#FFD154] rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🏠</div>
                    <h3 class="text-[#002795] text-xl mb-4">Môi trường an toàn</h3>
                    <p class="text-[#555555] text-sm font-light">Tạo không gian vệ sinh thư giãn, tư thế ngồi khoa học (đầu gối cao hơn hông) để con không còn sợ hãi việc đi ngoài.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm text-center">
                    <div class="w-16 h-16 bg-[#FFD154] rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🥗</div>
                    <h3 class="text-[#002795] text-xl mb-4">Dinh dưỡng chữa lành</h3>
                    <p class="text-[#555555] text-sm font-light">Cân nhắc áp dụng <a href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky" class="text-[#002795] font-bold underline">chế độ ăn GFCF</a> để giảm viêm niêm mạc ruột và loại bỏ các protein khó tiêu hóa.</p>
                </div>
                <div class="bg-white p-8 rounded-3xl shadow-sm text-center border-2 border-[#002795]">
                    <div class="w-16 h-16 bg-[#002795] text-white rounded-full flex items-center justify-center mx-auto mb-6 text-2xl">🩺</div>
                    <h3 class="text-[#002795] text-xl mb-4">Kiểm tra toàn diện</h3>
                    <p class="text-[#555555] text-sm font-light">Tìm ra bức tranh tổng thể về thể chất của con thông qua đánh giá hệ thống, tránh áp dụng phác đồ rời rạc.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 md:py-28 px-6 bg-white">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-[#002795] text-3xl md:text-4xl font-semibold text-center mb-16">
                Câu hỏi thường gặp về sức khỏe đường ruột ở trẻ tự kỷ
            </h2>
            <div class="space-y-4">
                <details class="group bg-[#FAF9F6] rounded-2xl shadow-sm">
                    <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Tại sao việc thay đổi chế độ ăn lại là thử thách lớn đối với trẻ?
                        <span class="group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#555555] leading-relaxed font-quicksand">
                        Trẻ tự kỷ thường nhạy cảm với mùi vị và kết cấu thức ăn. Việc đột ngột thay đổi kích hoạt sự phòng vệ. Cha mẹ cần giới thiệu món mới từng chút một, kiên nhẫn và tinh tế.
                    </div>
                </details>
                <details class="group bg-[#FAF9F6] rounded-2xl shadow-sm">
                    <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Thuốc nhuận tràng có phải là giải pháp lâu dài không?
                        <span class="group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#555555] leading-relaxed font-quicksand">
                        Chỉ dùng trong giai đoạn cấp tính. Lạm dụng lâu dài khiến cơ ruột lười biếng. Giải pháp bền vững phải đến từ cân bằng hệ vi sinh và dinh dưỡng.
                    </div>
                </details>
                <details class="group bg-[#FAF9F6] rounded-2xl shadow-sm">
                    <summary class="font-oswald text-[#002795] text-lg p-6 cursor-pointer font-semibold flex justify-between items-center">
                        Dấu hiệu nào cần đưa con gặp bác sĩ ngay lập tức?
                        <span class="group-open:rotate-180 transition-transform">▼</span>
                    </summary>
                    <div class="px-6 pb-6 text-[#555555] leading-relaxed font-quicksand">
                        Nếu trẻ nôn ra dịch màu xanh/vàng, bụng sưng to cứng như đá, sốt cao kèm khóc thét không ngừng hoặc đi ngoài ra máu đỏ tươi.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <section class="bg-gray-100 py-12 px-6 text-center">
        <p class="text-[#555555] text-sm italic max-w-3xl mx-auto">
            Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
        </p>
    </section>

    <footer class="bg-[#002795] text-[#FAF9F6]/60 py-16 px-6">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
            <div>
                <h3 class="text-[#FAF9F6] text-2xl font-bold mb-6">Hiểu Con Từ Gốc</h3>
                <p class="text-sm leading-relaxed mb-6">Đồng hành cùng cha mẹ thấu hiểu sâu sắc và khoa học về sức khỏe trẻ phát triển thần kinh khác biệt.</p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button">LÀM CHECKLIST NGAY</a>
            </div>
            <div>
                <h4 class="text-[#FAF9F6] font-bold mb-4 uppercase text-sm">Nguồn tham khảo uy tín</h4>
                <div class="grid grid-cols-1 gap-2 text-xs">
                    <a href="https://www.healthline.com/health/autism/autism-and-constipation" class="hover:text-[#FFD154] transition-colors underline">1. Healthline - Autism and Constipation</a>
                    <a href="https://www.medicalnewstoday.com/articles/autism-and-stomach-issues" class="hover:text-[#FFD154] transition-colors underline">2. Medical News Today - Autism and stomach issues</a>
                    <a href="https://www.spectrumnews.org/news/gastrointestinal-problems-autism-explained/" class="hover:text-[#FFD154] transition-colors underline">3. Spectrum News - GI Problems Explained</a>
                    <a href="https://www.psychologytoday.com/us/blog/the-fallible-mind/201701/the-gut-brain-connection-in-autism" class="hover:text-[#FFD154] transition-colors underline">4. Psychology Today - Gut-Brain Connection</a>
                    <a href="https://www.autismspeaks.org/gastrointestinal-gi-issues-autism" class="hover:text-[#FFD154] transition-colors underline">5. Autism Speaks - GI Issues</a>
                    <a href="https://www.autism.org.uk/advice-and-guidance/topics/physical-health/bowel-management" class="hover:text-[#FFD154] transition-colors underline">6. National Autistic Society - Bowel Management</a>
                    <a href="https://childmind.org/article/autism-and-diet/" class="hover:text-[#FFD154] transition-colors underline">7. Child Mind Institute - Autism and Diet</a>
                    <a href="https://drroseann.com/gut-health-and-autism/" class="hover:text-[#FFD154] transition-colors underline">8. Dr. Roseann - Gut Health and Autism</a>
                    <a href="https://www.amenclinics.com/blog/how-the-gut-brain-connection-affects-autism/" class="hover:text-[#FFD154] transition-colors underline">9. Amen Clinics - Gut-Brain Connection</a>
                    <a href="https://www.ifm.org/news-insights/gut-brain-axis-autism-spectrum-disorder/" class="hover:text-[#FFD154] transition-colors underline">10. IFM - Gut-Brain Axis in ASD</a>
                    <a href="https://www.autismparentingmagazine.com/autism-constipation-issues/" class="hover:text-[#FFD154] transition-colors underline">11. Autism Parenting Magazine - Constipation</a>
                    <a href="https://theautismcafe.com/autism-and-constipation/" class="hover:text-[#FFD154] transition-colors underline">12. The Autism Cafe - Autism & Constipation</a>
                    <a href="https://findingcoopersvoice.com/2019/02/12/the-gut-and-autism/" class="hover:text-[#FFD154] transition-colors underline">13. Finding Cooper's Voice - The Gut & Autism</a>
                    <a href="https://themighty.com/topic/autism-spectrum-disorder/autism-gi-issues-constipation/" class="hover:text-[#FFD154] transition-colors underline">14. The Mighty - ASD & GI Issues</a>
                    <a href="https://geekclubbooks.com/2016/10/autism-and-gastrointestinal-issues/" class="hover:text-[#FFD154] transition-colors underline">15. Geek Club Books - Autism and GI</a>
                    </div>
            </div>
        </div>
    </footer>


</div>

<?php get_footer(); ?>
