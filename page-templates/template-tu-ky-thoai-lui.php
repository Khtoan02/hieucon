<?php
/**
 * Template Name: Trang Tự Kỷ Thoái Lui
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bí Mật Từ Chiếc Bụng - Hành Trình Thấu Hiểu Tự Kỷ Thoái Lui</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            light: '#F3E8FF', /* Tím nhạt - purple-100 */
                            DEFAULT: '#9333EA', /* Tím nổi bật - purple-600 */
                            dark: '#7E22CE', /* Tím đậm - purple-700 */
                        },
                        accent: {
                            light: '#FEF3C7', /* Vàng nhạt - amber-100 */
                            DEFAULT: '#F59E0B', /* Vàng hổ phách - amber-500 */
                        },
                        text: {
                            main: '#334155',
                            muted: '#64748B'
                        }
                    }
                }
            }
        }
    </script>
    
    <style>
        body { font-family: 'Quicksand', sans-serif; color: #334155; }
        .fade-in-up { animation: fadeInUp 0.8s ease-out forwards; opacity: 0; transform: translateY(20px); }
        .delay-100 { animation-delay: 100ms; }
        .delay-200 { animation-delay: 200ms; }
        .delay-300 { animation-delay: 300ms; }
        @keyframes fadeInUp {
            to { opacity: 1; transform: translateY(0); }
        }
        .infographic-line::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 100%;
            width: 100%;
            height: 2px;
            background-color: #cbd5e1;
            z-index: -1;
        }
        @media (max-width: 768px) {
            .infographic-line::after { display: none; }
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="bg-purple-50 antialiased overflow-x-hidden">

    <!-- Hero Section -->
    <header class="bg-gradient-to-br from-brand-light to-white py-20 px-4 sm:px-6 lg:px-8 text-center">
        <div class="max-w-4xl mx-auto fade-in-up">
            <span class="inline-block py-1 px-3 rounded-full bg-accent-light text-accent font-semibold text-sm mb-6 shadow-sm border border-orange-100">
                <i class="fas fa-book-medical mr-2"></i>Kiến thức y khoa dành cho cha mẹ
            </span>
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 leading-tight">
                Tự Kỷ Thoái Lui: <br>
                <span class="text-brand">Bí Mật Từ Đường Ruột</span>
            </h1>
            <p class="text-lg md:text-xl text-text-muted mb-10 max-w-2xl mx-auto leading-relaxed">
                Khám phá mối liên hệ bất ngờ giữa đường ruột và sự phát triển não bộ. Không phải do lỗi nuôi dạy, khoa học đã tìm ra cơ chế sinh học đằng sau sự chững lại đột ngột của con.
            </p>
            <div class="flex flex-col sm:flex-row justify-center items-center gap-4">
                <a href="#understanding" class="inline-block bg-brand hover:bg-brand-dark text-white font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 hover:-translate-y-1 w-full sm:w-auto">
                    Khám phá ngay <i class="fas fa-arrow-down ml-2"></i>
                </a>
                <a href="#cta" class="inline-block bg-white text-brand border-2 border-brand hover:bg-brand-light font-bold py-3 px-8 rounded-full shadow-lg transition duration-300 hover:-translate-y-1 w-full sm:w-auto">
                    Cần hỗ trợ <i class="fas fa-hands-helping ml-2"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Section 1: Hiện tượng Tự kỷ thoái lui -->
    <section id="understanding" class="py-16 px-4 max-w-6xl mx-auto">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden fade-in-up delay-100">
            <div class="md:flex">
                <div class="md:w-1/2 p-8 md:p-12 bg-purple-900 text-white flex flex-col justify-center">
                    <h2 class="text-3xl font-bold mb-4 flex items-center">
                        <i class="fas fa-undo-alt text-accent mr-4"></i> Tự kỷ thoái lui là gì?
                    </h2>
                    <p class="mb-4 text-purple-100 leading-relaxed">
                        Khoảng <strong class="text-white text-xl">30%</strong> trẻ em mắc Phổ Tự Kỷ (ASD) trải qua hội chứng <em>phát triển thoái lui </em> (Developmental Regression). 
                    </p>
                    <p class="text-purple-100 leading-relaxed">
                        Nhiều cha mẹ tự dằn vặt liệu mình có làm sai điều gì trong cách nuôi dạy. Câu trả lời của y học hiện đại là: <strong>Tuyệt đối không phải lỗi của cha mẹ!</strong> Đây là một tiến trình sinh học thần kinh phức tạp.
                    </p>
                </div>
                <div class="md:w-1/2 p-8 md:p-12">
                    <h3 class="text-xl font-bold text-slate-800 mb-6 text-center">Tiến trình điển hình</h3>
                    <!-- Timeline Infographic -->
                    <div class="relative border-l-2 border-brand ml-4 space-y-8">
                        <div class="relative pl-6">
                            <div class="absolute -left-3.5 top-0 bg-brand text-white w-7 h-7 rounded-full flex items-center justify-center border-4 border-white shadow">
                                <i class="fas fa-check text-xs"></i>
                            </div>
                            <h4 class="font-bold text-slate-800">Những năm đầu đời</h4>
                            <p class="text-text-muted text-sm mt-1">Trẻ phát triển bình thường: biết giao tiếp bằng mắt, cười đáp lại, phát âm cơ bản...</p>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute -left-3.5 top-0 bg-accent text-white w-7 h-7 rounded-full flex items-center justify-center border-4 border-white shadow">
                                <i class="fas fa-exclamation text-xs"></i>
                            </div>
                            <h4 class="font-bold text-slate-800">Giai đoạn 15 - 30 tháng tuổi</h4>
                            <p class="text-text-muted text-sm mt-1">Sự phát triển chững lại. Trẻ đột ngột đánh mất dần các kỹ năng, ngôn ngữ và giao tiếp xã hội đã có.</p>
                        </div>
                        <div class="relative pl-6">
                            <div class="absolute -left-3.5 top-0 bg-red-500 text-white w-7 h-7 rounded-full flex items-center justify-center border-4 border-white shadow">
                                <i class="fas fa-sync text-xs"></i>
                            </div>
                            <h4 class="font-bold text-slate-800">Hành vi thay thế</h4>
                            <p class="text-text-muted text-sm mt-1">Trẻ xuất hiện các hành vi rập khuôn, phát ra nhiều âm vô nghĩa, khó kiểm soát cảm xúc, tâm trạng, thu mình và giảm tương tác xã hội.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Trục Ruột - Não -->
    <section class="py-16 bg-brand-light px-4 relative overflow-hidden">
        <div class="max-w-6xl mx-auto text-center relative z-10 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Trục Ruột - Não: Đường Cao Tốc Sinh Học</h2>
            <p class="text-text-muted max-w-2xl mx-auto mb-16 text-lg">Ruột và não không hoạt động độc lập. Chúng liên lạc liên tục với nhau thông qua mạng lưới thần kinh và các chất hóa học dẫn truyền thần kinh.</p>
            
            <!-- Infographic 3 steps -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                
                <div class="bg-white p-8 rounded-2xl shadow-md relative infographic-line">
                    <div class="w-20 h-20 mx-auto bg-fuchsia-100 text-fuchsia-500 rounded-full flex items-center justify-center text-4xl mb-6 shadow-inner">
                        <i class="fas fa-bacteria"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">1. Hệ Vi Sinh Đường Ruột</h3>
                    <p class="text-sm text-text-muted">Hàng nghìn tỷ vi khuẩn, nấm tạo thành "khu rừng" đường ruột. Chúng sản xuất các chất dẫn truyền thần kinh và tín hiệu miễn dịch.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-md relative infographic-line">
                    <div class="w-20 h-20 mx-auto bg-brand-light text-brand rounded-full flex items-center justify-center text-4xl mb-6 shadow-inner">
                        <i class="fas fa-project-diagram"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">2. Dây Thần Kinh Phế Vị</h3>
                    <p class="text-sm text-text-muted">Cầu nối thần kinh chủ đạo (Vagus Nerve) dẫn truyền tín hiệu qua lại liên tục mỗi giây giữa hệ tiêu hóa và não bộ.</p>
                </div>

                <div class="bg-white p-8 rounded-2xl shadow-md">
                    <div class="w-20 h-20 mx-auto bg-indigo-100 text-indigo-500 rounded-full flex items-center justify-center text-4xl mb-6 shadow-inner">
                        <i class="fas fa-brain"></i>
                    </div>
                    <h3 class="text-xl font-bold mb-3">3. Phát Triển Não Bộ</h3>
                    <p class="text-sm text-text-muted">Từ 2-3 tuổi là giai đoạn vàng não bộ phát triển mạnh, cũng là lúc hệ vi sinh ruột ổn định. Sự mất cân bằng ở ruột lập tức ảnh hưởng đến não.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: 3 Cơ chế tàn phá -->
    <section class="py-20 px-4 max-w-5xl mx-auto">
        <div class="text-center mb-16 fade-in-up">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-800 mb-4">Mất cân bằng vi sinh đã "tấn công" não bộ ra sao?</h2>
            <p class="text-text-muted text-lg">Khi vi khuẩn có hại sinh trưởng quá mức, chúng kích hoạt 3 cơ chế bệnh lý nguy hiểm.</p>
        </div>

        <div class="space-y-12">
            <!-- Mechanism 1 -->
            <div class="flex flex-col md:flex-row items-center bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-slate-100 hover:shadow-xl transition duration-300 fade-in-up">
                <div class="md:w-1/3 flex justify-center mb-6 md:mb-0">
                    <div class="relative">
                        <div class="w-32 h-32 bg-red-100 rounded-full flex items-center justify-center text-red-500 text-5xl">
                            <i class="fas fa-shield-virus"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-white rounded-full p-2 shadow-md text-red-600 text-xl">
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">1. Hội chứng Rò rỉ ruột & Suy yếu hàng rào ruột, não</h3>
                    <p class="text-text-muted mb-3">Độc tố từ hại khuẩn (như LPS) làm vỡ liên kết chặt chẽ của niêm mạc ruột. Giống như hàng rào bị thủng, độc tố tràn vào máu.</p>
                    <div class="bg-red-50 border-l-4 border-red-500 p-3 text-sm text-red-800 rounded">
                        <strong>Hậu quả:</strong> Độc tố di chuyển lên não, làm suy yếu hàng rào máu não (BBB), xâm nhập thẳng vào hệ thần kinh trung ương.
                    </div>
                </div>
            </div>

            <!-- Mechanism 2 -->
            <div class="flex flex-col md:flex-row-reverse items-center bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-slate-100 hover:shadow-xl transition duration-300 fade-in-up delay-100">
                <div class="md:w-1/3 flex justify-center mb-6 md:mb-0">
                    <div class="relative">
                        <div class="w-32 h-32 bg-orange-100 rounded-full flex items-center justify-center text-orange-500 text-5xl">
                            <i class="fas fa-cut"></i>
                        </div>
                        <div class="absolute -bottom-2 -left-2 bg-white rounded-full p-2 shadow-md text-orange-600 text-xl">
                            <i class="fas fa-bolt"></i>
                        </div>
                    </div>
                </div>
                <div class="md:w-2/3 md:pr-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">2. "Bão viêm" & Cắt nhầm kết nối thần kinh</h3>
                    <p class="text-text-muted mb-3">Độc tố kích hoạt phản ứng viêm thần kinh. Các tế bào dọn dẹp (Microglia) bị kích động mạnh, chuyển từ trạng thái bảo vệ sang tấn công.</p>
                    <div class="bg-orange-50 border-l-4 border-orange-500 p-3 text-sm text-orange-800 rounded">
                        <strong>Hậu quả:</strong> Microglia "cắt tỉa" nhầm cả những kết nối thần kinh (synapse) khỏe mạnh phụ trách trí nhớ, ngôn ngữ và giao tiếp...khiến những kỹ năng đã có này đột ngột biến mất.
                    </div>
                </div>
            </div>

            <!-- Mechanism 3 -->
            <div class="flex flex-col md:flex-row items-center bg-white p-6 md:p-8 rounded-3xl shadow-lg border border-slate-100 hover:shadow-xl transition duration-300 fade-in-up delay-200">
                <div class="md:w-1/3 flex justify-center mb-6 md:mb-0">
                    <div class="relative">
                        <div class="w-32 h-32 bg-slate-100 rounded-full flex items-center justify-center text-slate-500 text-5xl">
                            <i class="fas fa-battery-quarter"></i>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-white rounded-full p-2 shadow-md text-slate-700 text-xl">
                            <i class="fas fa-power-off"></i>
                        </div>
                    </div>
                </div>
                <div class="md:w-2/3 md:pl-8">
                    <h3 class="text-2xl font-bold text-slate-800 mb-3">3. Tắt nguồn "nhà máy năng lượng" Ty thể</h3>
                    <p class="text-text-muted mb-3">Chất chuyển hóa độc hại ức chế Ty thể (nhà máy sản xuất năng lượng ATP của tế bào thần kinh), gây thiếu hụt năng lượng cấp tính.</p>
                    <div class="bg-slate-100 border-l-4 border-slate-500 p-3 text-sm text-slate-800 rounded">
                        <strong>Hậu quả:</strong> Não bộ buộc phải "tắt" hoặc đình trệ các khu vực đòi hỏi năng lượng cao (như nhận thức, ngôn ngữ, học hỏi, giao tiếp...) để duy trì chức năng sinh tồn.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 4: Dấu hiệu nhận biết -->
    <section class="py-16 bg-purple-900 text-white px-4">
        <div class="max-w-5xl mx-auto fade-in-up">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-accent-light">5 Dấu hiệu "chiếc bụng" đang kêu cứu</h2>
                <p class="text-purple-200 text-lg">Trẻ tự kỷ thoái lui có nguy cơ mắc bệnh tiêu hóa cao hơn đáng kể so với trẻ phát triển bình thường. Vì các trẻ này có khả năng ngôn ngữ diễn đạt hạn chế, hãy chú ý đến các biểu hiện hành vi phi ngôn ngữ sau:</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="bg-purple-800 p-6 rounded-2xl border border-purple-700 hover:border-accent transition duration-300">
                    <i class="fas fa-poop text-3xl text-accent mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Rối loạn tiêu hóa</h3>
                    <p class="text-purple-200 text-sm">Táo bón mạn tính (phân cứng, vón cục) hoặc tiêu chảy kéo dài không rõ nguyên nhân thực thể.</p>
                </div>
                
                <div class="bg-purple-800 p-6 rounded-2xl border border-purple-700 hover:border-accent transition duration-300">
                    <i class="fas fa-wind text-3xl text-accent mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Đầy hơi, chướng bụng</h3>
                    <p class="text-purple-200 text-sm">Bụng căng chướng, tích tụ khí quá mức gây khó chịu, đau đớn cho trẻ.</p>
                </div>

                <div class="bg-purple-800 p-6 rounded-2xl border border-purple-700 hover:border-accent transition duration-300">
                    <i class="fas fa-child text-3xl text-accent mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Phản ứng đau thể chất</h3>
                    <p class="text-purple-200 text-sm">Cáu gắt sau bữa ăn, co gập chân lên bụng, hoặc tỳ ép bụng lên vật cứng để giải tỏa cơn co thắt.</p>
                </div>

                <div class="bg-purple-800 p-6 rounded-2xl border border-purple-700 hover:border-accent transition duration-300">
                    <i class="fas fa-bed text-3xl text-accent mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Rối loạn giấc ngủ</h3>
                    <p class="text-purple-200 text-sm">Khó vào giấc hoặc giật mình thức giấc hoảng loạn, quấy khóc giữa đêm (do các cơn co thắt cơ trơn ruột).</p>
                </div>

                <div class="bg-purple-800 p-6 rounded-2xl border border-purple-700 hover:border-accent transition duration-300 lg:col-span-2">
                    <i class="fas fa-utensils text-3xl text-accent mb-4"></i>
                    <h3 class="text-xl font-bold mb-2">Kén ăn cực đoan (Picky Eating)</h3>
                    <p class="text-purple-200 text-sm">Từ chối thức ăn mới, chỉ ăn một nhóm thức ăn nhất định (thường là thực phẩm nhiều carbohydrate, tinh bột trắng, ít chất xơ, nhiều đường...).</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Giải pháp & Hy vọng -->
    <section class="py-20 px-4 bg-brand-light">
        <div class="max-w-5xl mx-auto bg-white rounded-3xl shadow-xl overflow-hidden fade-in-up">
            <div class="bg-brand text-white p-8 md:p-10 text-center">
                <h2 class="text-3xl font-bold mb-2">Hiểu để Hy Vọng</h2>
                <p class="text-brand-light text-lg">Tự kỷ thoái lui không phải là bất biến. Môi trường nội sinh có thể điều chỉnh được.</p>
            </div>
            <div class="p-8 md:p-10">
                <p class="text-center text-text-muted mb-10 max-w-3xl mx-auto">
                    Thông qua việc phối hợp cùng bác sĩ nhi khoa, bác sĩ tiêu hóa, bác sỹ y sinh và chuyên gia dinh dưỡng lâm sàng, cha mẹ có thể định hướng can thiệp phục hồi "khu rừng" đường ruột cho con bằng 3 trụ cột:
                </p>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                            <i class="fas fa-apple-alt"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg mb-2">1. Dinh dưỡng cá nhân hóa</h4>
                        <p class="text-sm text-text-muted">Giảm carbohydrate tinh chế, đồ ăn công nghiệp.Tăng cường chất xơ hòa tan, thực phẩm tự nhiên, hữu cơ an toàn dễ dung nạp.</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                            <i class="fas fa-pills"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg mb-2">2. Probiotics đặc hiệu</h4>
                        <p class="text-sm text-text-muted">Dùng chủng vi sinh vật có lợi đặc hiệu cho trục ruột - não (Psychobiotics) để ức chế hại khuẩn, giảm viêm, cải thiện trục kết nối ruột não an toàn.</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 mx-auto bg-teal-100 text-teal-600 rounded-2xl flex items-center justify-center text-2xl mb-4">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-lg mb-2">3. Điều trị y tế chuyên sâu</h4>
                        <p class="text-sm text-text-muted">Can thiệp dứt điểm các tình trạng viêm nhiễm hệ tiêu hóa, phục hồi tính toàn vẹn của hàng rào ruột não.</p>
                    </div>
                </div>

                <div class="mt-12 bg-accent-light p-6 rounded-2xl border border-accent border-opacity-30 text-center">
                    <p class="text-slate-800 font-medium italic">
                        "Khi hệ tiêu hóa bình ổn, hàng rào ruột phục hồi, bão viêm thần kinh sẽ dịu đi. Não bộ sẽ có môi trường an toàn và dồi dào năng lượng tốt để tái cấu trúc nơ-ron, giúp con dần phục hồi kỹ năng và nhận thức."
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 6: Call To Action (Liên hệ chuyên gia) -->
    <section id="cta" class="py-16 px-4 bg-purple-50">
        <div class="max-w-4xl mx-auto text-center fade-in-up">
            <div class="bg-gradient-to-br from-brand-dark to-brand rounded-3xl shadow-2xl p-10 md:p-14 text-white relative overflow-hidden">
                <!-- Decorative background elements -->
                <div class="absolute top-0 right-0 -mr-16 -mt-16 w-64 h-64 rounded-full bg-white opacity-5"></div>
                <div class="absolute bottom-0 left-0 -ml-16 -mb-16 w-48 h-48 rounded-full bg-white opacity-5"></div>
                
                <div class="relative z-10">
                    <div class="w-20 h-20 mx-auto bg-white/10 rounded-full flex items-center justify-center text-4xl mb-6 shadow-inner backdrop-blur-sm border border-white/20">
                        <i class="fas fa-hands-helping text-accent-light"></i>
                    </div>
                    <h2 class="text-3xl md:text-4xl font-bold mb-4 text-white">Bạn cần hỗ trợ cho tình trạng cụ thể của con?</h2>
                    <p class="text-brand-light text-lg mb-8 max-w-2xl mx-auto leading-relaxed">
                        Mỗi đứa trẻ là một cá thể độc lập với hệ vi sinh đường ruột và tình trạng phát triển hoàn toàn khác nhau. Đừng ngần ngại liên hệ với <strong>Helen Hoai</strong> để được lắng nghe và tư vấn lộ trình hỗ trợ phù hợp nhất cho bé yêu nhà bạn.
                    </p>
                    <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center bg-accent hover:bg-yellow-500 text-white font-bold py-4 px-10 rounded-full shadow-xl transition duration-300 hover:-translate-y-1 hover:shadow-2xl w-full sm:w-auto text-lg">
                        <i class="fab fa-facebook text-2xl mr-3"></i> Trò chuyện cùng Helen Hoai
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer / Disclaimer -->
    <footer class="bg-purple-950 text-purple-300 py-10 px-4 text-center text-sm">
        <div class="max-w-4xl mx-auto">
            <i class="fas fa-info-circle text-2xl text-purple-400 mb-4 block"></i>
            <h4 class="font-bold text-purple-200 mb-2 uppercase tracking-wider">LƯU Ý:</h4>
            <p class="mb-4">
                Các thông tin này <strong>không</strong> thay thế cho chẩn đoán y khoa, tư vấn chuyên môn hay phác đồ điều trị của bác sĩ chuyên khoa.
            </p>
            <p>
                
            </p>
            <div class="mt-8 border-t border-purple-800 pt-8">
                <p> Helen Hoai - Love for Autism</p>
            </div>
        </div>
    </footer>

    <!-- Simple Intersection Observer for scroll animations -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.animationPlayState = 'running';
                        observer.unobserve(entry.target);
                    }
                });
            }, { threshold: 0.1 });

            document.querySelectorAll('.fade-in-up').forEach((el) => {
                el.style.animationPlayState = 'paused';
                observer.observe(el);
            });
        });
    </script>
    <?php wp_footer(); ?>
</body>
