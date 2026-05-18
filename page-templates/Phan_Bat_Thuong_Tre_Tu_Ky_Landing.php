<?php /* Template Name: Phan_Bat_Thuong_Tre_Tu_Ky_Landing */ ?>

<?php get_header(); ?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phân bất thường ở trẻ tự kỷ và cách chăm sóc sức khỏe ruột</title>
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
        body { font-family: \'Quicksand\', sans-serif; background-color: #FAF9F6; }
        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }
        body { font-family: 'Quicksand', sans-serif; color: #3D3D3D; scroll-behavior: smooth; }
        h1, h2, h3 { font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; }
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
                    GIẢI MÃ PHÂN BẤT THƯỜNG ĐỂ CHĂM SÓC ĐƯỜNG RUỘT TRẺ TỰ KỶ
                </h1>
                <p class="font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light">
                    Những cơn quấy khóc hay hành vi cáu gắt đôi khi không phải đặc điểm của hội chứng tự kỷ, mà là tiếng kêu cứu từ một hệ tiêu hóa đang chịu nhiều tổn thương thầm lặng.
                </p>
                <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg">
                    Kiểm tra sức khỏe toàn diện cho con ngay
                </a>
            </div>
            
            <div class="relative hidden lg:block">
                <div class="absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105"></div>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/articulation_hero_img_1779078788806.png" alt="Hero Image" class="relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto" />
            </div>
        </div>
    </section>

    <main>
        <section class="py-20 px-6 bg-white">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl text-navy text-center mb-16 leading-snug">
                    Lý do cha mẹ cần đặc biệt lưu tâm đến vấn đề bài tiết của con
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                    <div class="space-y-6">
                        <div class="bg-cream p-8 rounded-2xl border-l-4 border-navy shadow-sm">
                            <h3 class="text-xl text-navy mb-4 font-semibold">Cơn đau không thể diễn đạt bằng lời</h3>
                            <p class="text-text-dark leading-relaxed">
                                Rào cản ngôn ngữ khiến em bé không thể nói "mẹ ơi con đau bụng". Cảm giác đầy hơi, chướng bụng âm ỉ trở thành nỗi đau ẩn giấu mà con phải tự mình chịu đựng ngày qua ngày. Quan sát phân chính là cách cha mẹ "lắng nghe" cơ thể con.
                            </p>
                        </div>
                        <div class="bg-cream p-8 rounded-2xl border-l-4 border-navy shadow-sm">
                            <h3 class="text-xl text-navy mb-4 font-semibold">Hành vi là ngôn ngữ của cơ thể</h3>
                            <p class="text-text-dark leading-relaxed">
                                Những cơn bùng nổ cảm xúc, la hét hay tự làm hại bản thân (meltdown) đôi khi là phản ứng bản năng khi hệ tiêu hóa gặp trục trặc. Khi bụng êm ái, tâm trí con cũng sẽ bình an hơn.
                            </p>
                        </div>
                    </div>
                    <div class="relative">
                        <div class="bg-navy/5 rounded-3xl p-10 text-center">
                            <p class="italic text-lg text-navy font-medium mb-4">"Mọi hành vi đều mang một ý nghĩa. Khi trẻ không thể nói, cơ thể sẽ lên tiếng thông qua những tín hiệu sinh học quan trọng nhất."</p>
                            <p class="text-sm text-text-soft">— Trích dẫn từ cộng đồng hỗ trợ tự kỷ</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 bg-cream">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl text-navy text-center mb-16">
                    Nhận diện những biểu hiện phân bất thường ở trẻ tự kỷ để kịp thời hỗ trợ
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-md flex flex-col hover:shadow-xl transition-shadow">
                        <div class="text-4xl mb-6">🧱</div>
                        <h3 class="text-2xl text-navy mb-4">Táo bón mãn tính</h3>
                        <p class="text-text-dark flex-grow">
                            Phân tích tụ lâu ngày trở nên khô cứng, gây đau rát tột cùng. Trẻ thường hình thành thói quen nín nhịn đi tiêu vì sợ hãi cảm giác đau, dẫn đến vòng lặp tích tụ độc tố trong cơ thể.
                        </p>
                        <a href="https://hieucontugoc.online/tre-tu-ky-tao-bon-man-tinh" class="mt-6 text-navy font-bold hover:underline">Tìm hiểu thêm về táo bón →</a>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-md flex flex-col hover:shadow-xl transition-shadow">
                        <div class="text-4xl mb-6">💧</div>
                        <h3 class="text-2xl text-navy mb-4">Phân lỏng và phân sống</h3>
                        <p class="text-text-dark flex-grow">
                            Dấu hiệu của việc niêm mạc ruột bị tổn thương, thức ăn đi qua quá nhanh khiến cơ thể không kịp hấp thu dưỡng chất. Trẻ thường xanh xao, thiếu sắt, kẽm và các vi chất cho não bộ.
                        </p>
                        <a href="https://hieucontugoc.online/tieu-hoa-da-day-tre-tu-ky" class="mt-6 text-navy font-bold hover:underline">Vấn đề tiêu hóa dạ dày →</a>
                    </div>
                    <div class="bg-white p-8 rounded-2xl shadow-md flex flex-col hover:shadow-xl transition-shadow">
                        <div class="text-4xl mb-6">🍋</div>
                        <h3 class="text-2xl text-navy mb-4">Mùi chua và màu sắc lạ</h3>
                        <p class="text-text-dark flex-grow">
                            Mùi chua gắt hoặc nồng nặc cảnh báo sự lên men bừa bãi của nấm men và hại khuẩn. Độc tố từ quá trình này ngấm vào máu, gây ra trạng thái "sương mù não" khiến con lơ đãng.
                        </p>
                        <a href="https://hieucontugoc.online/dysbiosis-duong-ruot-o-tre-tu-ky" class="mt-6 text-navy font-bold hover:underline">Về Dysbiosis đường ruột →</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 bg-white">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl md:text-4xl text-navy mb-8">
                    Khám phá mối liên hệ mật thiết giữa trục ruột não và hội chứng tự kỷ
                </h2>
                <p class="text-lg text-text-dark mb-12 leading-relaxed">
                    Đường ruột được mệnh danh là "bộ não thứ hai". Tại đây, hàng tỷ vi sinh vật tham gia sản xuất Serotonin - hormone quyết định tâm trạng và giấc ngủ của con. Khi đường ruột bất ổn, não bộ cũng không thể bình yên.
                </p>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left">
                    <div class="border-2 border-navy/10 p-8 rounded-2xl hover:border-navy transition-colors">
                        <h3 class="text-xl text-navy mb-4 font-bold tracking-tight">Hệ vi sinh mất cân bằng</h3>
                        <p class="text-text-dark text-sm leading-relaxed">Sự phát triển quá mức của hại khuẩn tạo ra các hợp chất viêm nhiễm chạy dọc theo dây thần kinh phế vị, kích hoạt phản ứng bồn chồn và tăng động.</p>
                        <a href="https://hieucontugoc.online/truc-ruot-nao-tu-ky" class="inline-block mt-4 text-navy text-xs font-bold uppercase tracking-widest">Khám phá trục ruột não</a>
                    </div>
                    <div class="border-2 border-navy/10 p-8 rounded-2xl hover:border-navy transition-colors">
                        <h3 class="text-xl text-navy mb-4 font-bold tracking-tight">Hệ tiêu hóa khỏe mạnh</h3>
                        <p class="text-text-dark text-sm leading-relaxed">Khi niêm mạc ruột lành lặn, cơ thể sản sinh đủ Serotonin giúp xoa dịu các rối loạn cảm giác và giúp trẻ sẵn sàng hơn cho các hoạt động tương tác xã hội.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 bg-cream">
            <div class="max-w-6xl mx-auto">
                <div class="bg-navy rounded-[3rem] p-12 md:p-20 text-cream relative overflow-hidden shadow-2xl">
                    <div class="relative z-10 grid grid-cols-1 md:grid-cols-2 gap-16 items-center">
                        <div>
                            <h2 class="text-3xl md:text-5xl font-bold mb-8 leading-tight">Phương pháp an toàn nâng đỡ hệ tiêu hóa của con</h2>
                            <ul class="space-y-6 text-lg">
                                <li class="flex items-start gap-4">
                                    <span class="text-yellow text-2xl">✓</span>
                                    <span><strong>Chế độ ăn GFCF:</strong> Loại bỏ Gluten và Casein giúp giảm viêm và phục hồi niêm mạc ruột rò rỉ.</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="text-yellow text-2xl">✓</span>
                                    <span><strong>Men vi sinh đặc hiệu:</strong> Bổ sung các chủng Probiotics phù hợp để tái lập sự cân bằng vi sinh.</span>
                                </li>
                                <li class="flex items-start gap-4">
                                    <span class="text-yellow text-2xl">✓</span>
                                    <span><strong>Thói quen tích cực:</strong> Massage bụng, uống đủ nước ấm và thiết lập giờ đi tiêu cố định.</span>
                                </li>
                            </ul>
                            <div class="mt-12 flex flex-wrap gap-4">
                                <a href="https://hieucontugoc.online/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky" class="text-yellow border border-yellow px-6 py-2 rounded-full text-sm font-bold hover:bg-yellow hover:text-navy transition-all">Tìm hiểu GFCF</a>
                            </div>
                        </div>
                        <div class="bg-white/10 p-8 rounded-3xl backdrop-blur-sm">
                            <h3 class="text-2xl font-bold text-yellow mb-6">Mục tiêu tối thượng</h3>
                            <p class="mb-8 leading-relaxed">Mọi sự thay đổi về dinh dưỡng và lối sống đều cần dựa trên một lộ trình cá nhân hóa. Đừng thử nghiệm sai lầm trên cơ thể con.</p>
                            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="cta-button w-full">ĐIỀN BẢNG KIỂM TRA NGAY</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 px-6 bg-white">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl md:text-4xl text-navy text-center mb-16">
                    Giải đáp trăn trở về hệ tiêu hóa của trẻ
                </h2>
                <div class="space-y-4">
                    <details class="group bg-cream rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Khi nào phân bất thường cần gặp chuyên gia?
                            <span class="group-open:rotate-180 transition-transform">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark leading-relaxed">
                            Nếu tình trạng tiêu chảy, táo bón hoặc phân có nhầy máu kéo dài liên tục trên 3 ngày. Trực giác của cha mẹ rất quan trọng, nếu bạn cảm thấy con quá mệt mỏi và đau đớn, hãy tìm kiếm sự hỗ trợ ngay.
                        </div>
                    </details>
                    <details class="group bg-cream rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Chế độ ăn GFCF có gây thiếu chất không?
                            <span class="group-open:rotate-180 transition-transform">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark leading-relaxed">
                            Hoàn toàn không nếu được thiết kế cân bằng. Bạn có thể thay thế canxi từ sữa bò bằng sữa hạt, rau xanh đậm. Tinh bột lúa mì thay bằng gạo tẻ, yến mạch không gluten để đảm bảo đủ năng lượng.
                        </div>
                    </details>
                    <details class="group bg-cream rounded-xl shadow-sm">
                        <summary class="font-oswald text-navy text-lg p-6 cursor-pointer font-semibold list-none flex justify-between items-center">
                            Tại sao con có hành vi bôi trét phân?
                            <span class="group-open:rotate-180 transition-transform">▼</span>
                        </summary>
                        <div class="px-6 pb-6 text-text-dark leading-relaxed">
                            Thường xuất phát từ rối loạn cảm giác (thích cảm giác mềm mại) hoặc do con bị đau bụng, ngứa rát mà không biết cách xử lý. Hãy giữ bình tĩnh và theo dõi sức khỏe đường ruột của con.
                        </div>
                    </details>
                </div>
            </div>
        </section>

        <section class="bg-gray-100 py-12 px-6 text-center">
            <div class="max-w-4xl mx-auto">
                <p class="text-text-soft text-sm italic leading-relaxed">
                    Bài viết mang tính tham khảo, không thay thế chẩn đoán hay tư vấn y khoa. Nếu bạn lo lắng về sự phát triển của con, hãy gặp chuyên gia có chứng chỉ để được đánh giá trực tiếp.
                </p>
            </div>
        </section>
    </main>

    <footer class="bg-gray-200 py-16 px-6 border-t border-gray-300">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-navy font-bold mb-8 uppercase tracking-widest text-sm">20 Nguồn tham khảo chuyên môn uy tín</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 text-[10px] text-text-soft">
                <ul class="space-y-1 lowercase">
                    <li>[1] spectrumnews.org/gastrointestinal-problems</li>
                    <li>[2] autismparentingmagazine.com/bowel-problems</li>
                    <li>[3] psychcentral.com/autism-poop-issues</li>
                    <li>[4] medicalnewstoday.com/articles/autism-gi</li>
                    <li>[5] healthline.com/health/autism-poop</li>
                </ul>
                <ul class="space-y-1 lowercase">
                    <li>[6] autismspeaks.org/gastrointestinal-issues</li>
                    <li>[7] nationalautismassociation.org/gi-issues</li>
                    <li>[8] understood.org/stomach-problems-kids</li>
                    <li>[9] autism.org/gastrointestinal-issues</li>
                    <li>[10] childmind.org/autism-and-gi-issues</li>
                </ul>
                <ul class="space-y-1 lowercase">
                    <li>[11] tacanow.org/poop-matters</li>
                    <li>[12] harkla.co/autism-and-constipation</li>
                    <li>[13] amenclinics.com/gut-brain-autism</li>
                    <li>[14] corticahealth.com/gi-issues-autism</li>
                    <li>[15] gemiini.org/understanding-gi-autism</li>
                </ul>
                <ul class="space-y-1 lowercase">
                    <li>[16] theautismcafe.com/gi-issues-experience</li>
                    <li>[17] findingcoopersvoice.com/unspoken-gi-side</li>
                    <li>[18] theautismdad.net/autism-gi-issues</li>
                    <li>[19] wrongplanet.net/forums/gi-discussion</li>
                    <li>[20] the-art-of-autism.com/gut-health</li>
                </ul>
            </div>
            <div class="mt-12 pt-8 border-t border-gray-300 text-center text-text-soft text-xs uppercase tracking-widest">
                &copy; <?php echo date("Y"); ?> Hiểu Con Từ Gốc. Bảo lưu mọi quyền.
            </div>
        </div>
    </footer>
<?php get_footer(); ?>