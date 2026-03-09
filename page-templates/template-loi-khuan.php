<?php
/**
 * Template Name: Trang Lợi Khuẩn & Tự Kỷ
 * 
 * @package Hieucon
 */
?>
<?php wp_head(); ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Con uống lợi khuẩn lại quấy hơn? | Giải mã "Die-off"</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0fdfa',
                            100: '#ccfbf1',
                            500: '#14b8a6',
                            600: '#0d9488',
                            700: '#0f766e',
                            900: '#134e4a',
                        },
                        accent: {
                            50: '#fffbeb',
                            500: '#f59e0b',
                            600: '#d97706',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { scroll-behavior: smooth; }
        .gradient-text {
            background: linear-gradient(to right, #0d9488, #0284c7);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .infographic-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
    </style>
</head>

<?php wp_head(); ?>

<body class="font-sans text-gray-800 bg-gray-50 antialiased">

    <!-- Hero Section -->
    <header class="bg-brand-50 relative overflow-hidden">
        <div class="absolute inset-0 z-0 opacity-20">
            <svg viewBox="0 0 100 100" preserveAspectRatio="none" class="h-full w-full">
                <path d="M0,0 L100,0 L100,100 C75,80 25,120 0,100 Z" fill="#ccfbf1"></path>
            </svg>
        </div>
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 pb-20 relative z-10 text-center">
            <span class="inline-block py-1 px-3 rounded-full bg-brand-100 text-brand-700 font-medium text-sm mb-4">Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</span>
            <h1 class="font-heading text-4xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                Dùng lợi khuẩn sao con lại <br class="hidden md:block"/>
                <span class="text-red-500">quấy khóc & hành vi hơn?</span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto mb-8 leading-relaxed">
                Ba mẹ khoan vội hoang mang! Quấy khóc, đi ngoài, bứt rứt có thể không phải do lợi khuẩn gây hại, mà là dấu hiệu của <strong class="text-brand-700">Phản ứng "Die-off"</strong> - một cột mốc quan trọng trong hành trình chữa lành.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#kham-pha" class="bg-brand-600 text-white px-8 py-3 rounded-full font-semibold hover:bg-brand-700 transition shadow-lg flex items-center justify-center gap-2">
                    Khám phá sự thật <i class="fas fa-arrow-down"></i>
                </a>
                <a href="#lien-he" class="bg-white text-brand-700 border-2 border-brand-100 px-8 py-3 rounded-full font-semibold hover:bg-brand-50 hover:border-brand-200 transition shadow-sm flex items-center justify-center gap-2">
                    Tôi cần hỗ trợ <i class="fas fa-headset"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Section 1: Nỗi đau & Sự thật (The Hook) -->
    <section id="kham-pha" class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center gap-12">
                <div class="md:w-1/2">
                    <div class="bg-red-50 p-8 rounded-2xl border border-red-100 relative">
                        <div class="absolute -top-6 -left-6 bg-white rounded-full p-2 shadow-sm">
                            <div class="bg-red-100 text-red-500 w-12 h-12 rounded-full flex items-center justify-center text-2xl">
                                <i class="fas fa-heart-crack"></i>
                            </div>
                        </div>
                        <h3 class="font-heading text-2xl font-bold text-red-800 mb-4 mt-2">Kỳ vọng và nỗi sợ</h3>
                        <p class="text-gray-700 mb-4 leading-relaxed">
                            Nhiều ba mẹ bổ sung lợi khuẩn với mong muốn con tiêu hóa tốt, ăn ngủ ngon. Nhưng thực tế lại phũ phàng: <span class="font-semibold text-red-600">Con quấy dữ dội, đi ngoài bất thường, lờ đờ, mất tập trung hoặc cáu gắt vô cớ.</span>
                        </p>
                        <p class="text-gray-700 leading-relaxed">
                            Sự thất vọng và sợ hãi khiến nhiều gia đình quyết định vứt bỏ hộp men đắt tiền và dừng lại. Nhưng sự thật đằng sau đó là gì?
                        </p>
                    </div>
                </div>
                <div class="md:w-1/2">
                    <h2 class="font-heading text-3xl font-bold text-gray-900 mb-6">Trục ruột - não: Nơi mọi thứ bắt đầu</h2>
                    <ul class="space-y-4">
                        <li class="flex items-start gap-4">
                            <div class="mt-1 bg-brand-100 text-brand-600 p-2 rounded-lg"><i class="fas fa-microscope text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-gray-900">100 nghìn tỷ vi sinh vật</h4>
                                <p class="text-gray-600 text-sm">Nhiều gấp 10 lần tổng tế bào cơ thể, đóng vai trò như hệ miễn dịch thứ hai.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="mt-1 bg-brand-100 text-brand-600 p-2 rounded-lg"><i class="fas fa-shield-virus text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-gray-900">Vệ sĩ niêm mạc ruột</h4>
                                <p class="text-gray-600 text-sm">Lợi khuẩn là rào chắn, ngăn chặn nấm men (Candida) và vi khuẩn có hại bám rễ, gây hội chứng "ruột rò rỉ".</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="mt-1 bg-brand-100 text-brand-600 p-2 rounded-lg"><i class="fas fa-brain text-xl"></i></div>
                            <div>
                                <h4 class="font-bold text-gray-900">Nhà máy sản xuất hạnh phúc</h4>
                                <p class="text-gray-600 text-sm">Lên đến 90% Serotonin (Hormone điều chỉnh cảm xúc, giấc ngủ) được sản xuất tại ruột. Ruột khỏe, não mới êm!</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 2: Giải thích "Die-off" (Infographic Style) -->
    <section class="py-16 bg-gray-50 border-y border-gray-100">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mb-4">Giải mã phản ứng "Die-off"</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">Tại sao lợi khuẩn vào lại làm con mệt mỏi hơn?</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-left">
                <!-- Step 1 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 infographic-card">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-ghost"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">1. Cuộc chiến sinh tồn</h3>
                    <p class="text-gray-600 text-sm">Hàng tỷ lợi khuẩn tiến vào ruột, tranh giành thức ăn và chỗ đứng, khiến nấm men và vi khuẩn có hại bị tiêu diệt hàng loạt.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 infographic-card relative">
                    <div class="hidden md:block absolute top-1/2 -left-6 text-gray-300 text-2xl"><i class="fas fa-chevron-right"></i></div>
                    <div class="w-14 h-14 bg-red-100 text-red-600 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-biohazard"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">2. Xả độc ồ ạt</h3>
                    <p class="text-gray-600 text-sm">Khi hại khuẩn chết đi, màng tế bào vỡ vụn, giải phóng lập tức một lượng khổng lồ nội độc tố (như Acetaldehyde) và kim loại nặng vào máu.</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 infographic-card relative">
                    <div class="hidden md:block absolute top-1/2 -left-6 text-gray-300 text-2xl"><i class="fas fa-chevron-right"></i></div>
                    <div class="w-14 h-14 bg-accent-100 text-accent-600 rounded-full flex items-center justify-center text-2xl mb-6">
                        <i class="fas fa-filter"></i>
                    </div>
                    <h3 class="font-bold text-xl mb-3">3. Quá tải hệ thải độc</h3>
                    <p class="text-gray-600 text-sm">Gan, thận của trẻ chưa kịp xử lý mẻ rác khổng lồ này, khiến độc tố ứ đọng tạm thời, gây ra sự xáo trộn cả về thể chất lẫn hành vi.</p>
                </div>
            </div>

            <!-- Metaphor Box -->
            <div class="mt-12 bg-accent-50 border-l-8 border-accent-500 rounded-2xl p-8 shadow-md text-left max-w-4xl mx-auto flex flex-col md:flex-row items-center gap-8">
                <div class="md:w-1/4 text-center flex justify-center">
                    <div class="w-24 h-24 bg-white rounded-full flex items-center justify-center shadow-sm border border-accent-200">
                        <i class="fas fa-broom text-5xl text-accent-500"></i>
                    </div>
                </div>
                <div class="md:w-3/4">
                    <h4 class="font-heading text-2xl font-bold text-gray-900 mb-3">Hình ảnh ẩn dụ: Tổng vệ sinh nhà cửa</h4>
                    <p class="text-gray-700 text-lg leading-relaxed">Giống như dọn một căn nhà ẩm mốc lâu năm. Khi bạn cọ rửa mạnh, bụi bẩn bay mù mịt khiến bạn ngạt thở tạm thời. Nhưng khi dọn xong, không gian sẽ hoàn toàn sạch sẽ, thoáng đãng.</p>
                    <p class="mt-3 text-accent-600 font-bold text-xl">Die-off chính là lúc bụi bẩn đang "bay mù mịt" bên trong cơ thể con!</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 3: Dấu hiệu nhận biết (Comparison Table) -->
    <section class="py-16 bg-white">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-heading text-3xl font-bold text-gray-900 text-center mb-12">Cách nhận diện cơn bão "Die-off"</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Physical Signs -->
                <div class="border-2 border-blue-100 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-blue-50 py-4 px-6 border-b border-blue-100 flex items-center gap-3">
                        <i class="fas fa-temperature-half text-blue-600 text-xl"></i>
                        <h3 class="font-heading text-xl font-bold text-blue-900">Dấu hiệu thể chất</h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-viruses text-blue-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Giống cúm:</strong> Mệt mỏi lừ đừ, uể oải, nhức cơ, hâm hấp sốt nhẹ.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-poop text-blue-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Biến đổi phân:</strong> Tiêu chảy, phân lỏng, có mùi chua/khẳm rất nặng, hoặc có bọt/nhầy.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-wind text-blue-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Tiêu hóa dồn dập:</strong> Đầy hơi, chướng bụng căng cứng, ợ hơi, sôi bụng, trào ngược.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-allergies text-blue-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Biểu hiện da:</strong> Phát ban nhẹ, nổi mẩn đỏ nếp gấp (cổ, bẹn), ngứa ngáy.</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Behavioral Signs -->
                <div class="border-2 border-orange-100 rounded-2xl overflow-hidden shadow-sm">
                    <div class="bg-orange-50 py-4 px-6 border-b border-orange-100 flex items-center gap-3">
                        <i class="fas fa-face-angry text-orange-600 text-xl"></i>
                        <h3 class="font-heading text-xl font-bold text-orange-900">Dấu hiệu hành vi</h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <i class="fas fa-bolt text-orange-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Cảm xúc bùng nổ:</strong> Cáu gắt vô cớ, dễ kích động, ăn vạ kéo dài, tức giận nhiều.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-arrow-rotate-left text-orange-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Thoái lui kỹ năng:</strong> Tạm thời mất đi kỹ năng giao tiếp, vốn từ vựng mới học.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-cloud text-orange-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Sương mù não (Brain fog):</strong> Ánh mắt lờ đờ, tránh né giao tiếp mắt rõ rệt hơn.</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <i class="fas fa-bed text-orange-400 mt-1"></i>
                                <span class="text-gray-700"><strong>Rối loạn cực đoan:</strong> Tăng hành vi tự kích (vẩy tay, kiễng gót), mất ngủ trầm trọng, hay giật mình la hét.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            <p class="text-center text-sm text-gray-500 mt-6 italic">* Lưu ý: Mức độ biểu hiện phụ thuộc vào mức độ loạn khuẩn ban đầu và khả năng thải độc của gan, thận từng bé.</p>
        </div>
    </section>

    <!-- Section 4: Nguyên tắc Vàng (Timeline) -->
    <section class="py-16 bg-brand-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <span class="bg-accent-100 text-accent-700 px-4 py-1 rounded-full font-bold text-sm tracking-wide">NGUYÊN TẮC VÀNG</span>
                <h2 class="font-heading text-3xl md:text-4xl font-bold text-gray-900 mt-4">Bắt đầu thấp - tăng chậm</h2>
                <p class="text-gray-600 mt-2">"Start Low and Go Slow" - Bí quyết để con thải độc nhẹ nhàng, không kiệt sức.</p>
            </div>

            <div class="relative">
                <!-- Vertical Line -->
                <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 w-1 bg-brand-200 h-full"></div>

                <!-- Step 1 -->
                <div class="relative flex flex-col md:flex-row justify-between items-center mb-12">
                    <div class="md:w-5/12 text-right md:pr-8 mb-4 md:mb-0">
                        <h4 class="font-bold text-xl text-gray-900">1. Liều cực nhỏ (Nguyên tắc hạt gạo)</h4>
                        <p class="text-gray-600 text-sm mt-2">Bỏ qua liều khuyến cáo trên vỏ hộp. Hãy mở vỏ nang, lấy 1/8 lượng bột, hoặc dùng đầu tăm nhúng bột chỉ bằng 1-2 hạt gạo để cơ thể con làm quen.</p>
                    </div>
                    <div class="w-12 h-12 bg-white border-4 border-brand-500 rounded-full flex justify-center items-center z-10 shadow-md">
                        <span class="text-brand-600 font-bold">1</span>
                    </div>
                    <div class="md:w-5/12 md:pl-8"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative flex flex-col md:flex-row justify-between items-center mb-12">
                    <div class="md:w-5/12 md:pr-8 mb-4 md:mb-0 order-3 md:order-1"></div>
                    <div class="w-12 h-12 bg-white border-4 border-brand-500 rounded-full flex justify-center items-center z-10 shadow-md order-2">
                        <span class="text-brand-600 font-bold">2</span>
                    </div>
                    <div class="md:w-5/12 text-left md:pl-8 mb-4 md:mb-0 order-1 md:order-3">
                        <h4 class="font-bold text-xl text-gray-900">2. Theo dõi sát sao</h4>
                        <p class="text-gray-600 text-sm mt-2">Giữ nguyên liều siêu nhỏ trong 3-5 ngày. Quan sát kỹ phân, giấc ngủ và hành vi. Trẻ vui vẻ bình thường = Gan đang dọn dẹp tốt.</p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative flex flex-col md:flex-row justify-between items-center mb-12">
                    <div class="md:w-5/12 text-right md:pr-8 mb-4 md:mb-0">
                        <h4 class="font-bold text-xl text-gray-900">3. Giảm hoặc Tạm nghỉ</h4>
                        <p class="text-gray-600 text-sm mt-2">Nếu Die-off xảy ra dữ dội kéo dài quá 2 ngày, hãy GIẢM NỬA liều đang dùng, hoặc dừng hẳn 1-3 ngày cho gan thận được "thở" rồi mới tiếp tục.</p>
                    </div>
                    <div class="w-12 h-12 bg-white border-4 border-red-500 rounded-full flex justify-center items-center z-10 shadow-md text-red-500">
                        <i class="fas fa-pause"></i>
                    </div>
                    <div class="md:w-5/12 md:pl-8"></div>
                </div>

                <!-- Step 4 -->
                <div class="relative flex flex-col md:flex-row justify-between items-center">
                    <div class="md:w-5/12 md:pr-8 mb-4 md:mb-0 order-3 md:order-1"></div>
                    <div class="w-12 h-12 bg-white border-4 border-green-500 rounded-full flex justify-center items-center z-10 shadow-md text-green-500 order-2">
                        <i class="fas fa-arrow-up"></i>
                    </div>
                    <div class="md:w-5/12 text-left md:pl-8 mb-4 md:mb-0 order-1 md:order-3">
                        <h4 class="font-bold text-xl text-gray-900">4. Tăng chậm đến đích</h4>
                        <p class="text-gray-600 text-sm mt-2">Khi con đã quen và triệu chứng tan biến, tăng nhẹ từng nấc nhỏ (ví dụ từ 1/4 lên 1/2 viên). Giữ liều mới 4-7 ngày trước khi tăng tiếp.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section 5: Bí kíp thực hành -->
    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="font-heading text-3xl font-bold text-gray-900 text-center mb-4">Mẹo hữu ích khi cho con uống lợi khuẩn</h2>
            <p class="text-center text-gray-600 mb-12 max-w-2xl mx-auto">Trẻ tự kỷ cực kỳ nhạy cảm về giác quan. Hãy áp dụng những bí kíp này để tránh phản ứng từ chối từ con và bảo toàn giá trị của thuốc.</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Tip 1 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-mask text-3xl text-brand-600 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Mẹo "Ngụy trang"</h3>
                    <p class="text-gray-600 text-sm">Trộn bột vào thức ăn sệt con thích: sốt táo, bơ nghiền, sữa chua nguội. Không pha nước tinh khiết vì mùi vị lạ sẽ khiến bé cảnh giác, nôn ọe.</p>
                </div>
                <!-- Tip 2 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-eye-slash text-3xl text-brand-600 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Đánh lừa thị giác</h3>
                    <p class="text-gray-600 text-sm">Dùng cốc đục màu (không trong suốt), ống hút hoặc bình tập uống có nắp che kín cặn trắng lơ lửng. Thị giác của trẻ rất nhạy!</p>
                </div>
                <!-- Tip 3 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-thermometer-empty text-3xl text-red-500 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Nhiệt độ = Sống còn</h3>
                    <p class="text-gray-600 text-sm">Tuyệt đối không pha vào cháo/nước nóng (>40°C). Nhiệt độ cao sẽ luộc chín vi khuẩn. Chỉ nhỏ lên tay thử độ ấm nhẹ như pha sữa rồi mới trộn.</p>
                </div>
                <!-- Tip 4 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-snowflake text-3xl text-blue-500 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Bảo quản ngăn mát</h3>
                    <p class="text-gray-600 text-sm">Ngoại trừ chủng bào tử, hầu hết lợi khuẩn sống cần cất tủ lạnh sau khi mở. Đi xa nhớ mang túi giữ nhiệt và đá khô.</p>
                </div>
                <!-- Tip 5 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-pills text-3xl text-orange-500 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Cách ly kháng sinh</h3>
                    <p class="text-gray-600 text-sm">Kháng sinh tiêu diệt sạch vi khuẩn không phân biệt tốt xấu. Phải uống lợi khuẩn cách kháng sinh tối thiểu 2-3 giờ.</p>
                </div>
                <!-- Tip 6 -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-100 hover:shadow-md transition">
                    <i class="fas fa-user-doctor text-3xl text-green-600 mb-4"></i>
                    <h3 class="font-bold text-lg mb-2">Tuyệt đối không tự ý</h3>
                    <p class="text-gray-600 text-sm">Không mù quáng sao chép liều lượng của trẻ khác. Mỗi bé có mức độ loạn khuẩn riêng, cần sự đồng hành của chuyên gia y sinh.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer & CTA Section -->
    <section id="lien-he" class="bg-gray-900 text-white py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="font-heading text-3xl font-bold mb-6">Bạn không phải đi một mình</h2>
            <p class="text-gray-300 mb-10 text-lg">
                Phản ứng Die-off là tín hiệu đáng mừng chứng tỏ ruột đang được dọn dẹp để chuẩn bị cho sự bứt phá về sức khỏe và nhận thức. Hãy để cộng đồng và chuyên gia đồng hành cùng ba mẹ!
            </p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="bg-[#1877F2] hover:bg-[#166fe5] text-white p-4 rounded-xl transition flex flex-col items-center justify-center gap-2 group">
                    <i class="fab fa-facebook text-3xl group-hover:scale-110 transition"></i>
                    <span class="font-bold text-sm">Cộng đồng Facebook</span>
                    <span class="text-xs text-blue-200">Hiểu con từ Gốc</span>
                </a>
                
                <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="bg-[#0068FF] hover:bg-[#005ce6] text-white p-4 rounded-xl transition flex flex-col items-center justify-center gap-2 group">
                    <i class="fas fa-comment-dots text-3xl group-hover:scale-110 transition"></i>
                    <span class="font-bold text-sm">Nhóm Zalo hỗ trợ</span>
                    <span class="text-xs text-blue-200">Giải đáp nhanh chóng</span>
                </a>

                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="bg-brand-600 hover:bg-brand-700 text-white p-4 rounded-xl transition flex flex-col items-center justify-center gap-2 group">
                    <i class="fas fa-headset text-3xl group-hover:scale-110 transition"></i>
                    <span class="font-bold text-sm">Trợ lý Nam Khánh</span>
                    <span class="text-xs text-brand-200">Tư vấn trực tiếp</span>
                </a>
            </div>
            
            <div class="border-t border-gray-700 pt-8 mt-12 text-gray-400 text-sm">
                <p class="mb-2">Nội dung được tổng hợp nhằm mục đích nâng cao nhận thức y sinh cho ba mẹ có con tự kỷ.<br>Luôn tham khảo ý kiến bác sĩ/chuyên gia trước khi áp dụng phác đồ điều trị mới.</p>
                <p>&copy; 2026 Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
            </div>
        </div>
    </section>

<?php wp_footer(); ?>
</body>