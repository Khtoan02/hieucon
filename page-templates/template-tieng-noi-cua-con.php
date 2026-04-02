<?php
/**
 * Template Name: Trang tiếng nói của con
 * 
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải Mã Rào Cản Ngôn Ngữ Ở Trẻ Tự Kỷ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        h1, h2, h3, .font-display {
            font-family: 'Quicksand', sans-serif;
        }
        .hero-gradient {
            background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
        }
        .infographic-card:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .pulse-soft {
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body class="bg-[#FBFBFF] text-gray-800">

    <!-- Header / Navigation -->
    <nav class="sticky top-0 bg-white/80 backdrop-blur-md z-50 border-b border-purple-100">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                <span class="font-bold text-xl text-purple-900 tracking-tight">HealthPath</span>
            </div>
            <div class="hidden md:flex gap-8 text-sm font-semibold text-gray-600">
                <a href="#overview" class="hover:text-purple-600 transition">Tổng quan</a>
                <a href="#causes" class="hover:text-purple-600 transition">6 Nguyên nhân</a>
                <a href="#nutrients" class="hover:text-purple-600 transition">Vi chất thiết yếu</a>
                <a href="#contact-helen" class="hover:text-purple-600 transition">Liên hệ chuyên gia</a>
            </div>
            <a href="#contact-helen" class="bg-purple-600 text-white px-5 py-2 rounded-full text-sm font-bold hover:bg-purple-700 transition shadow-lg shadow-purple-200">Cần hỗ trợ ngay</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <header class="hero-gradient pt-16 pb-24 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-block bg-purple-100 text-purple-700 px-4 py-1 rounded-full text-sm font-bold mb-6 italic">Dành cho Cha mẹ có con chậm nói</span>
            <h1 class="text-4xl md:text-6xl font-bold text-gray-900 mb-6 leading-tight">
                Tiếng nói của con đang bị "khóa" bởi những rào cản y khoa nào?
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mb-10 leading-relaxed max-w-2xl mx-auto">
                Chậm nói ở trẻ tự kỷ không chỉ là vấn đề hành vi. Hiểu rõ các rào cản sinh học giúp cha mẹ mở cánh cửa ngôn ngữ cho con một cách khoa học và nhân văn hơn.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#causes" class="bg-purple-600 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:shadow-xl hover:bg-purple-700 transition">Khám phá ngay</a>
                <a href="#contact-helen" class="bg-white text-purple-600 border-2 border-purple-100 px-8 py-4 rounded-2xl font-bold text-lg hover:bg-purple-50 transition shadow-sm">Cần hỗ trợ</a>
            </div>
        </div>
    </header>

    <!-- Infographic Summary Section -->
    <section id="overview" class="py-20 px-4 -mt-12">
        <div class="max-w-6xl mx-auto bg-white rounded-[2rem] shadow-2xl p-8 md:p-12 border border-purple-50">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4 text-purple-600 italic">Hệ sinh thái ngôn ngữ của trẻ</h2>
                <p class="text-gray-500 max-w-xl mx-auto text-sm md:text-base">6 trụ cột y tế cần được khơi thông để trẻ có thể giao tiếp tự tin.</p>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
                <div class="text-center p-4 rounded-2xl bg-purple-50 border border-purple-100 infographic-card">
                    <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-purple-900 uppercase tracking-wider">Vận động âm</span>
                </div>
                <div class="text-center p-4 rounded-2xl bg-indigo-50 border border-indigo-100 infographic-card">
                    <div class="w-12 h-12 bg-indigo-500 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    </div>
                    <span class="text-xs font-bold text-indigo-900 uppercase tracking-wider">Năng lượng</span>
                </div>
                <div class="text-center p-4 rounded-2xl bg-pink-50 border border-pink-100 infographic-card">
                    <div class="w-12 h-12 bg-pink-500 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 10 10 10-10"/></svg>
                    </div>
                    <span class="text-xs font-bold text-pink-900 uppercase tracking-wider">Điện não</span>
                </div>
                <div class="text-center p-4 rounded-2xl bg-violet-50 border border-violet-100 infographic-card">
                    <div class="w-12 h-12 bg-violet-500 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h.01"/><path d="M7 12h.01"/><path d="M11 12h.01"/><path d="M15 12h.01"/><path d="M19 12h.01"/><path d="M21 12c0 4.418-4.03 8-9 8s-9-3.582-9-8 4.03-8 9-8 9 3.582 9 8z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-violet-900 uppercase tracking-wider">Thính giác</span>
                </div>
                <div class="text-center p-4 rounded-2xl bg-fuchsia-50 border border-fuchsia-100 infographic-card">
                    <div class="w-12 h-12 bg-fuchsia-500 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v10"/><path d="M18.4 6.6a9 9 0 1 1-12.77.04"/></svg>
                    </div>
                    <span class="text-xs font-bold text-fuchsia-900 uppercase tracking-wider">Vi chất</span>
                </div>
                <div class="text-center p-4 rounded-2xl bg-slate-50 border border-slate-100 infographic-card">
                    <div class="w-12 h-12 bg-slate-600 rounded-full flex items-center justify-center text-white mx-auto mb-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    </div>
                    <span class="text-xs font-bold text-slate-900 uppercase tracking-wider">Hệ Folate</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Detailed Causes Section -->
    <section id="causes" class="py-20 px-4 bg-purple-50/30">
        <div class="max-w-5xl mx-auto">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-16 text-gray-900">Chi tiết 6 Nguyên Nhân Y Tế Gây Chậm Ngôn Ngữ</h2>
            
            <div class="grid md:grid-cols-2 gap-12">
                <!-- Cause 1 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-purple-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-purple-100 rounded-2xl flex items-center justify-center text-purple-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-purple-900">1. Chứng Khó Điều Khiển Vận Động (Apraxia)</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Đây là tình trạng não bộ gặp khó khăn trong việc lập kế hoạch và điều phối các chuyển động cơ bắp cần thiết để tạo ra âm thanh rõ ràng. Trẻ có thể biết mình muốn nói gì, nhưng não không thể gửi đúng "bản đồ" tín hiệu đến môi, lưỡi và hàm.
                    </p>
                    <ul class="mt-4 space-y-2 text-xs text-purple-700 font-medium">
                        <li>• Khó phối hợp các âm tiết phức tạp.</li>
                        <li>• Khó nhai, nuốt hoặc hay chảy nước dãi.</li>
                        <li>• Phát âm không nhất quán (cùng một từ nhưng nói mỗi lúc một kiểu).</li>
                    </ul>
                </div>

                <!-- Cause 2 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-purple-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-indigo-100 rounded-2xl flex items-center justify-center text-indigo-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 12h-4l-3 9L9 3l-3 9H2"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-indigo-900">2. Rối Loạn Chức Năng Ti Thể</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Ti thể là "nhà máy năng lượng" của tế bào. Việc tạo âm thanh và xử lý ngôn ngữ đòi hỏi rất nhiều năng lượng. Nếu các nhà máy này hoạt động kém, não bộ sẽ rơi vào tình trạng uể oải, không đủ "điện" để vận hành hệ thống ngôn ngữ phức tạp.
                    </p>
                    <ul class="mt-4 space-y-2 text-xs text-indigo-700 font-medium">
                        <li>• Trẻ nhanh mệt mỏi sau các hoạt động thể chất hoặc học tập.</li>
                        <li>• Khả năng xử lý thông tin chậm chạp.</li>
                        <li>• Ngôn ngữ bị suy giảm rõ rệt khi trẻ ốm hoặc sốt.</li>
                    </ul>
                </div>

                <!-- Cause 3 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-purple-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-pink-100 rounded-2xl flex items-center justify-center text-pink-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m2 7 10 10 10-10"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-pink-900">3. Hoạt Động Điện Não Bất Thường</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Khoảng 1/3 trẻ tự kỷ gặp các vấn đề về động kinh hoặc điện não bất thường, kể cả khi không biểu hiện ra ngoài bằng các cơn co giật và nó thường bị bỏ sót do triệu chứng dễ nhầm lẫn với biểu hiện tự kỷ (vd. hành vi tự kích thích, tics..) hoặc do thời gian đo điện não đồ (EEG) quá ngắn. Khi co giật xảy ra tại khu vực não bộ phụ trách lời nói và ngôn ngữ, chúng sẽ trực tiếp khiến trẻ gặp khó khăn trong quá trình phát triển ngôn ngữ,giao tiếp.
                    </p>
                    <ul class="mt-4 space-y-2 text-xs text-pink-700 font-medium">
                        <li>• Trẻ bị thoái lùi ngôn ngữ (đang nói được bỗng dưng mất đi).</li>
                        <li>• Khó tập trung, hay lơ đãng như đang "mất kết nối".</li>
                        <li>• Cần thực hiện điện não đồ (EEG) giấc ngủ để tầm soát.</li>
                    </ul>
                </div>

                <!-- Cause 4 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-purple-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-violet-100 rounded-2xl flex items-center justify-center text-violet-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 12h.01"/><path d="M7 12h.01"/><path d="M11 12h.01"/><path d="M15 12h.01"/><path d="M19 12h.01"/><path d="M21 12c0 4.418-4.03 8-9 8s-9-3.582-9-8 4.03-8 9-8 9 3.582 9 8z"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-violet-900">4. Vấn Đề Thính Giác & Viêm Tai Mãn Tính</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Nếu trẻ thường xuyên bị tích dịch trong tai hoặc viêm tai giữa, âm thanh truyền đến não sẽ bị mờ đục như thể đang nghe dưới nước. Khi không nghe rõ âm thanh, trẻ không thể bắt chước chính xác lời nói.
                    </p>
                    <ul class="mt-4 space-y-2 text-xs text-violet-700 font-medium">
                        <li>• Trẻ thường xuyên bị chảy mũi, viêm họng hoặc dị ứng.</li>
                        <li>• Không phản ứng khi được gọi tên nhưng lại nhạy cảm với âm thanh lạ.</li>
                        <li>• Nói ngọng hoặc âm thanh phát ra không có ngữ điệu.</li>
                    </ul>
                </div>

                <!-- Cause 5 -->
                <div class="bg-white p-8 rounded-[2rem] shadow-sm border border-purple-100 hover:shadow-md transition">
                    <div class="w-14 h-14 bg-fuchsia-100 rounded-2xl flex items-center justify-center text-fuchsia-600 mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2v10"/><path d="M18.4 6.6a9 9 0 1 1-12.77.04"/></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-4 text-fuchsia-900">5. Thiếu Hụt Vi Chất & Methyl Hóa</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        Não bộ cần các "nguyên liệu" như B12, Sắt, Kẽm để xây dựng kết nối thần kinh. Ở trẻ tự kỷ, quá trình Methyl hóa (giúp giải độc và dẫn truyền thần kinh) thường gặp trục trặc, khiến trẻ bị thiếu hụt vi chất trầm trọng dù chế độ ăn có vẻ ổn.
                    </p>
                    <ul class="mt-4 space-y-2 text-xs text-fuchsia-700 font-medium">
                        <li>• Trẻ cực kỳ kén ăn hoặc có vấn đề tiêu hóa mãn tính.</li>
                        <li>• Thiếu tập trung, trí nhớ kém.</li>
                        <li>• B12 và Folate là hai chất quan trọng nhất cần kiểm tra.</li>
                    </ul>
                </div>

                <!-- Cause 6 -->
                <div class="bg-purple-900 text-white p-8 rounded-[2rem] shadow-xl border-4 border-purple-800 flex flex-col justify-between">
                    <div>
                        <div class="w-14 h-14 bg-purple-500 rounded-2xl flex items-center justify-center text-white mb-6 pulse-soft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                        </div>
                        <h3 class="text-xl font-bold mb-4">6. Thiếu Hụt Folate Não (CFD)</h3>
                        <p class="text-purple-100 text-sm leading-relaxed">
                            Đây là một tình trạng nghiêm trọng khi Folate bị chặn không cho đi vào não bởi các kháng thể. Ngay cả khi xét nghiệm máu bình thường, não bộ của trẻ vẫn có thể bị "đói" Folate, dẫn đến chậm nói, co giật và các vấn đề vận động.
                        </p>
                    </div>
                    <div class="mt-6 p-4 bg-purple-800/50 rounded-xl border border-purple-700">
                        <p class="text-xs text-purple-200 italic">Sử dụng Axit Folinic liều cao theo chỉ định bác sĩ là phương pháp điều trị đặc hiệu cho tình trạng này.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Nutrients Detailed List -->
    <section id="nutrients" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold mb-4 text-gray-900">Danh mục "Nguyên Liệu" Cho Não Bộ</h2>
                <p class="text-gray-500 italic">Hỗ trợ khơi thông các rào cản y tế thông qua dinh dưỡng đúng dạng (Tổng hợp 9 vi chất chính).</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- 1. B12 -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🧬</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Vitamin B12 (Cobalamin)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Thiết yếu cho nhận thức, tốc độ xử lý thông tin, khả năng ngôn ngữ,tập trung,năng lượng và ổn định tâm trạng. B12 kết nối chu trình Folate với chu trình Methyl hóa, giúp bảo vệ tế bào não khỏi căng thẳng oxy hóa.</p>
                </div>

                <!-- 2. Folate -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🥬</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Folate (Axit Folinic/5MTHF)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Giải quyết tình trạng thiếu hụt folate chức năng và thiếu hụt folate não. Bổ sung đúng dạng giúp cải thiện trực tiếp khả năng bật âm và tư duy ngôn ngữ.</p>
                </div>

                <!-- 3. Omega-3 -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🐟</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Omega-3 (DHA/EPA)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Thành phần xây dựng màng tế bào não và lớp vỏ bảo vệ thần kinh. Giúp tăng tốc độ dẫn truyền tín hiệu từ não đến cơ quan phát âm nhanh nhạy hơn.</p>
                </div>

                <!-- 4. Sắt -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🩸</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Sắt (Iron)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Vận chuyển oxy nuôi não. Trẻ thiếu sắt thường chậm xử lý thông tin, trí nhớ kém và gặp khó khăn trong việc tiếp thu từ vựng mới.</p>
                </div>

                <!-- 5. Magie & B6 -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">💊</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Magie & B6 (Dạng PLP)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Làm dịu hệ thần kinh trung ương, giảm các hành vi nhạy cảm quá mức. Giúp trẻ bình tĩnh và tập trung tốt hơn trong các giờ học giao tiếp xã hội.</p>
                </div>

                <!-- 6. Sulforaphane -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🥦</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Sulforaphane</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Hợp chất chống viêm mạnh mẽ từ mầm bông cải xanh. Nghiên cứu chỉ ra khả năng giúp <strong>tăng 42%</strong> khả năng giao tiếp xã hội và bật âm lời nói ở trẻ.</p>
                </div>

                <!-- 7. Vitamin D (Newly expanded) -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">☀️</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">Vitamin D</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Hoạt động như một hormone điều phối sự trưởng thành của các vùng chức năng trong não. Nồng độ Vitamin D tối ưu là nền tảng cho sự liên kết ngôn ngữ phức tạp.</p>
                </div>

                <!-- 8. L-Creatine (Newly added) -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">⚡</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">L-Creatine</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Cung cấp năng lượng tức thời cho tế bào não và các bó cơ phát âm. Hỗ trợ đắc lực cho trẻ gặp khó khăn trong vận động tinh và phối hợp âm tiết.</p>
                </div>

                <!-- 9. CoQ10 (Newly added) -->
                <div class="p-6 rounded-3xl bg-purple-50/30 hover:bg-white hover:shadow-xl transition border border-transparent hover:border-purple-100 flex flex-col">
                    <div class="text-4xl mb-4">🔋</div>
                    <h4 class="font-bold text-xl text-purple-900 mb-2">CoQ10 (Ubiquinone)</h4>
                    <p class="text-gray-600 text-sm leading-relaxed mb-4">Hỗ trợ trực tiếp cho chức năng ti thể (nhà máy năng lượng). Giúp cải thiện tình trạng uể oải, tăng cường sự bền bỉ của não bộ trong quá trình học ngôn ngữ.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call To Action: Helen Hoai -->
    <section id="contact-helen" class="py-24 px-4 bg-gradient-to-br from-purple-700 to-indigo-800 text-white rounded-t-[3rem] -mt-12 shadow-inner">
        <div class="max-w-4xl mx-auto text-center">
            <div class="mb-10 relative inline-block">
                <div class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-purple-300/50 p-1 mx-auto overflow-hidden bg-white/10 backdrop-blur shadow-xl">
                    <svg viewBox="0 0 24 24" fill="none" class="w-full h-full text-purple-200" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                </div>
                <div class="absolute bottom-0 right-0 bg-green-500 w-6 h-6 rounded-full border-4 border-purple-700"></div>
            </div>
            
            <h2 class="text-3xl md:text-5xl font-bold mb-6 italic">Tìm lại tiếng nói cho con bắt đầu từ sự thấu hiểu</h2>
            <p class="text-lg md:text-xl text-purple-100 mb-10 leading-relaxed max-w-2xl mx-auto">
                Mỗi đứa trẻ là một bản thể duy nhất. Hãy kết nối với <strong>Helen Hoài</strong> để được tư vấn lộ trình y sinh cá nhân hóa, giúp con gỡ bỏ những rào cản sinh học âm thầm.
            </p>
            
            <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" class="inline-flex items-center gap-3 bg-white text-purple-700 px-10 py-5 rounded-2xl font-bold text-xl hover:bg-purple-50 transition transform hover:scale-105 shadow-2xl">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                Kết nối với Helen Hoài
            </a>
            
            <p class="mt-8 text-sm text-purple-300 italic">Đừng để rào cản y khoa ngăn cản tương lai của trẻ.</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 bg-gray-900 text-gray-500 px-4 text-center">
        <div class="max-w-6xl mx-auto">
            <p class="text-sm mb-4">© 2024 Dự án nâng cao nhận thức y sinh cho cha mẹ Việt. Mọi quyền được bảo lưu.</p>
            <p class="text-xs italic">Nguồn tài liệu: TACA - The Autism Community in Action (Family Resources: Medical Causes of Speech Issues in Autism).</p>
        </div>
    </footer>

</body>
</html>

<?php wp_footer(); ?>