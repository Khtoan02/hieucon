<?php
/*
Template Name: Trang Van Dong Kinh
*/
?>
<?php get_header(); ?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiểu Về Động Kinh Ở Trẻ Rối Loạn Phát Triển</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#faf5ff',
                            100: '#f3e8ff',
                            200: '#e9d5ff',
                            300: '#d8b4fe',
                            400: '#c084fc',
                            500: '#a855f7',
                            600: '#9333ea',
                            700: '#7e22ce',
                            800: '#6b21a8',
                            900: '#581c87',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        /* Tùy chỉnh hiệu ứng cho thẻ detail (FAQ) */
        details>summary {
            list-style: none;
        }

        details>summary::-webkit-details-marker {
            display: none;
        }

        .infographic-line {
            position: absolute;
            top: 50%;
            left: 50%;
            width: 100%;
            height: 2px;
            background-color: #d8b4fe;
            z-index: -1;
        }

        @media (max-width: 768px) {
            .infographic-line {
                width: 2px;
                height: 100%;
                left: 50%;
                top: 0;
            }
        }
    </style>
</head>

<body class="bg-brand-50 text-slate-800 antialiased selection:bg-brand-200 selection:text-brand-900">

    <!-- Hero Section -->
    <header class="relative bg-gradient-to-br from-brand-100 via-white to-brand-50 pt-20 pb-24 overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
            <!-- Decorative background pattern -->
            <svg class="absolute w-full h-full" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                        <path d="M 40 0 L 0 0 0 40" fill="none" stroke="currentColor" stroke-width="1" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
        </div>

        <div class="max-w-5xl mx-auto px-6 relative z-10 text-center">
            <span
                class="inline-block py-1 px-3 rounded-full bg-brand-200 text-brand-800 text-sm font-bold tracking-wide mb-4">
                Dành Cho Cha Mẹ
            </span>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 leading-tight mb-6">
                Động Kinh Ở Trẻ Em: <br class="hidden md:block" />
                <span class="text-brand-600">Hiểu Đúng Để Đồng Hành Tốt Hơn</span>
            </h1>
            <p class="text-lg md:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed mb-10">
                Khám phá bức tranh toàn cảnh về cách những "cơn bão điện từ" trong não bộ ảnh hưởng đến sự phát triển,
                nhận thức và hành vi của trẻ.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="#tam-giac-tac-dong"
                    class="inline-flex w-full sm:w-auto items-center justify-center px-8 py-4 text-base font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-full shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    Khám phá ngay <i data-lucide="arrow-down" class="ml-2 w-5 h-5"></i>
                </a>
                <a href="#cta-support"
                    class="inline-flex w-full sm:w-auto items-center justify-center px-8 py-4 text-base font-bold text-brand-700 bg-white border-2 border-brand-200 hover:border-brand-400 hover:bg-brand-50 rounded-full shadow hover:shadow-md transition-all duration-300 transform hover:-translate-y-1">
                    Cần hỗ trợ <i data-lucide="heart-handshake" class="ml-2 w-5 h-5"></i>
                </a>
            </div>
        </div>
    </header>

    <!-- Intro Section -->
    <section class="py-16 bg-white">
        <div class="max-w-4xl mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <div class="w-full md:w-1/3 flex justify-center">
                    <div class="w-40 h-40 bg-brand-100 rounded-full flex items-center justify-center shrink-0">
                        <i data-lucide="heart-handshake" class="w-20 h-20 text-brand-600"></i>
                    </div>
                </div>
                <div class="w-full md:w-2/3">
                    <p class="text-lg text-slate-700 leading-relaxed">
                        Đồng hành cùng con trong quá trình khôn lớn chưa bao giờ là điều dễ dàng, đặc biệt là khi con có
                        những nét khác biệt trong sự phát triển. Khi phải đối mặt thêm với <strong>chứng động
                            kinh</strong>, nhiều cha mẹ không khỏi lo lắng tột độ.
                    </p>
                    <p class="text-lg text-slate-700 leading-relaxed mt-4">
                        Tuy nhiên, sự cáu gắt, thu mình hay chậm chạp của con không phải là "lỗi" của con. Dựa trên các
                        nghiên cứu y khoa, bài viết này sẽ bóc tách các khía cạnh một cách dễ hiểu nhất để cha mẹ an tâm
                        hơn trên hành trình hỗ trợ não bộ của trẻ.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Infographic: Tam Giác Tác Động -->
    <section id="tam-giac-tac-dong" class="py-20 bg-brand-50">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-4">Tại Sao Động Kinh Lại Ảnh Hưởng Đến Trí
                    Não?</h2>
                <p class="text-lg text-slate-600 max-w-2xl mx-auto">Không chỉ là những cơn co giật, có 3 yếu tố cốt lõi
                    (Tam giác tác động) làm thay đổi cách trẻ suy nghĩ và hành xử.</p>
            </div>

            <div class="relative">
                <div class="infographic-line hidden md:block"></div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative z-10">

                    <!-- Card 1 -->
                    <div class="bg-white p-8 rounded-2xl shadow-md border-t-4 border-amber-400 relative">
                        <div
                            class="w-16 h-16 bg-amber-100 text-amber-600 rounded-full flex items-center justify-center mb-6 mx-auto shadow-inner">
                            <i data-lucide="zap" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-3 text-slate-800">Cơn Bão Điện Từ</h3>
                        <p class="text-slate-600 text-center">Ngay cả khi không co giật biểu hiện ra ngoài, những sóng
                            điện ngầm bất thường trong não vẫn cản trở việc xử lý thông tin liên tục.</p>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-8 rounded-2xl shadow-md border-t-4 border-brand-500 relative">
                        <div
                            class="w-16 h-16 bg-brand-100 text-brand-600 rounded-full flex items-center justify-center mb-6 mx-auto shadow-inner">
                            <i data-lucide="brain" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-3 text-slate-800">Cấu Trúc Não Bộ</h3>
                        <p class="text-slate-600 text-center">Bản thân những cấu trúc gốc rễ khiến trẻ bị động kinh cũng
                            thường là nguyên nhân gốc rễ gây ra khó khăn trong học tập và phát triển.</p>
                    </div>

                    <!-- Card 3 -->
                    <div class="bg-white p-8 rounded-2xl shadow-md border-t-4 border-indigo-400 relative">
                        <div
                            class="w-16 h-16 bg-indigo-100 text-indigo-600 rounded-full flex items-center justify-center mb-6 mx-auto shadow-inner">
                            <i data-lucide="pill" class="w-8 h-8"></i>
                        </div>
                        <h3 class="text-xl font-bold text-center mb-3 text-slate-800">Tác Dụng Phụ Của Thuốc</h3>
                        <p class="text-slate-600 text-center">Thuốc làm "dịu" hệ thần kinh để chống co giật, nhưng đôi
                            khi cũng làm chậm lại tốc độ suy nghĩ và thay đổi cảm xúc của trẻ.</p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 3 Core Impacts Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Sự phát triển -->
            <div class="flex flex-col lg:flex-row items-center gap-12 mb-24">
                <div class="w-full lg:w-1/2">
                    <div class="bg-sky-100 p-8 rounded-3xl">
                        <!-- Placeholder for visual/illustration -->
                        <div
                            class="aspect-video bg-white rounded-2xl flex items-center justify-center shadow-sm border border-sky-200">
                            <div class="text-center text-sky-400">
                                <i data-lucide="baby" class="w-20 h-20 mx-auto mb-2 opacity-50"></i>
                                <p class="font-medium opacity-80">Sự Phát Triển Của Trẻ</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="inline-flex items-center text-sky-600 font-bold mb-3">
                        <span class="w-8 h-8 rounded-full bg-sky-100 flex items-center justify-center mr-3">1</span>
                        <span>Ảnh Hưởng Thể Chất & Kỹ Năng</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">Tác Động Đến Sự Phát Triển</h2>
                    <ul class="space-y-6">
                        <li class="flex items-start">
                            <i data-lucide="hourglass" class="w-6 h-6 text-sky-500 mr-4 mt-1 shrink-0"></i>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Chậm đạt các cột mốc</h4>
                                <p class="text-slate-600">Các cơn phóng điện cản trở kết nối thần kinh mới. Trẻ có thể
                                    chậm đi, chậm nói, hoặc lóng ngóng tay chân hơn bạn bè.</p>
                            </div>
                        </li>
                        <li class="flex items-start">
                            <i data-lucide="undo-2" class="w-6 h-6 text-sky-500 mr-4 mt-1 shrink-0"></i>
                            <div>
                                <h4 class="font-bold text-slate-800 text-lg">Sự thoái lui (Quên kỹ năng)</h4>
                                <p class="text-slate-600">Đây là điều khiến cha mẹ đau lòng nhất. Trong những giai đoạn
                                    bão điện từ tấn công, trẻ có thể "quên" những gì đã làm được (ví dụ: từng biết gọi
                                    "ba mẹ" nhưng nay lại im lặng).</p>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Nhận thức -->
            <div class="flex flex-col lg:flex-row-reverse items-center gap-12 mb-24">
                <div class="w-full lg:w-1/2">
                    <div class="bg-emerald-100 p-8 rounded-3xl grid grid-cols-2 gap-4">
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <i data-lucide="timer" class="w-8 h-8 text-emerald-500 mx-auto mb-2"></i>
                            <p class="font-bold text-sm text-slate-700">Xử lý chậm</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <i data-lucide="save" class="w-8 h-8 text-emerald-500 mx-auto mb-2"></i>
                            <p class="font-bold text-sm text-slate-700">Trí nhớ giảm</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <i data-lucide="settings" class="w-8 h-8 text-emerald-500 mx-auto mb-2"></i>
                            <p class="font-bold text-sm text-slate-700">Chức năng điều hành</p>
                        </div>
                        <div class="bg-white p-4 rounded-xl shadow-sm text-center">
                            <i data-lucide="message-circle" class="w-8 h-8 text-emerald-500 mx-auto mb-2"></i>
                            <p class="font-bold text-sm text-slate-700">Rào cản ngôn ngữ</p>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="inline-flex items-center text-emerald-600 font-bold mb-3">
                        <span class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center mr-3">2</span>
                        <span>Cách Não Bộ Xử Lý Thông Tin</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">Tác Động Đến Nhận Thức</h2>
                    <p class="text-slate-600 mb-6">Động kinh ảnh hưởng trực tiếp đến 4 chức năng cốt lõi của não bộ
                        trong việc học hỏi:</p>
                    <div class="space-y-4">
                        <div class="border-l-4 border-emerald-400 pl-4">
                            <h4 class="font-bold text-slate-800">Sự chú ý & Tốc độ</h4>
                            <p class="text-slate-600 text-sm">Não mất nhiều thời gian hơn để hiểu một câu lệnh. Trẻ có
                                vẻ lơ đãng hoặc khó duy trì sự chú ý.</p>
                        </div>
                        <div class="border-l-4 border-emerald-400 pl-4">
                            <h4 class="font-bold text-slate-800">Trí nhớ - Hồi hải mã (Hippocampus)</h4>
                            <p class="text-slate-600 text-sm">Khó lưu trữ thông tin ngắn hạn và củng cố trí nhớ vào ban
                                đêm do sóng nhiễu loạn.</p>
                        </div>
                        <div class="border-l-4 border-emerald-400 pl-4">
                            <h4 class="font-bold text-slate-800">Chức năng điều hành</h4>
                            <p class="text-slate-600 text-sm">Cực kỳ khó chịu khi phải chuyển đổi trạng thái (ví dụ: cất
                                đồ chơi để đi tắm), khó kiểm soát sự bốc đồng.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hành vi -->
            <div class="flex flex-col lg:flex-row items-center gap-12">
                <div class="w-full lg:w-1/2">
                    <div class="bg-rose-100 p-8 rounded-3xl relative overflow-hidden">
                        <div class="absolute -right-10 -top-10 opacity-20">
                            <i data-lucide="activity" class="w-64 h-64 text-rose-500"></i>
                        </div>
                        <div class="relative z-10 space-y-4">
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl">
                                <p class="font-bold text-rose-700 flex items-center"><i data-lucide="flame"
                                        class="w-5 h-5 mr-2"></i> Bùng nổ & Cáu gắt</p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl">
                                <p class="font-bold text-rose-700 flex items-center"><i data-lucide="cloud-rain"
                                        class="w-5 h-5 mr-2"></i> Lo âu & Thu mình</p>
                            </div>
                            <div class="bg-white/80 backdrop-blur p-5 rounded-xl">
                                <p class="font-bold text-rose-700 flex items-center"><i data-lucide="users"
                                        class="w-5 h-5 mr-2"></i> Khó kết nối xã hội</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="inline-flex items-center text-rose-600 font-bold mb-3">
                        <span class="w-8 h-8 rounded-full bg-rose-100 flex items-center justify-center mr-3">3</span>
                        <span>Cảm Xúc & Tương Tác</span>
                    </div>
                    <h2 class="text-3xl font-bold text-slate-900 mb-6">Tác Động Đến Hành Vi</h2>
                    <p class="text-slate-600 mb-6">Mối liên hệ giữa động kinh và các vấn đề hành vi là rất chặt chẽ, đôi
                        khi gây mệt mỏi hơn cả những cơn co giật.</p>
                    <ul class="space-y-4 text-slate-600">
                        <li><strong>Giống hội chứng ADHD:</strong> Sự kiệt sức sau cơn động kinh và tác dụng phụ của
                            thuốc khiến trẻ bồn chồn, tăng động, dễ ăn vạ.</li>
                        <li><strong>Trầm cảm và nhạy cảm:</strong> Trẻ cảm thấy bất an khi mất kiểm soát cơ thể, dẫn đến
                            sợ hãi đám đông, bám mẹ.</li>
                        <li><strong>Khó kết bạn:</strong> Rào cản ngôn ngữ và chậm xử lý thông tin khiến trẻ khó hòa
                            nhịp vào các trò chơi nhóm.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section>

    <!-- Triggers Section (Kích phát) -->
    <section class="py-16 bg-amber-50">
        <div class="max-w-6xl mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-slate-900 mb-10">5 "Thủ Phạm" Kích Phát Cơn Động Kinh</h2>
            <div class="grid grid-cols-2 md:grid-cols-5 gap-4">

                <div class="bg-white p-6 rounded-xl text-center shadow-sm hover:shadow-md transition-shadow">
                    <i data-lucide="moon" class="w-10 h-10 text-amber-500 mx-auto mb-3"></i>
                    <h4 class="font-bold text-slate-800 text-sm">Thiếu ngủ</h4>
                </div>
                <div class="bg-white p-6 rounded-xl text-center shadow-sm hover:shadow-md transition-shadow">
                    <i data-lucide="frown" class="w-10 h-10 text-amber-500 mx-auto mb-3"></i>
                    <h4 class="font-bold text-slate-800 text-sm">Căng thẳng (Stress)</h4>
                </div>
                <div class="bg-white p-6 rounded-xl text-center shadow-sm hover:shadow-md transition-shadow">
                    <i data-lucide="calendar-x-2" class="w-10 h-10 text-amber-500 mx-auto mb-3"></i>
                    <h4 class="font-bold text-slate-800 text-sm">Quên uống thuốc</h4>
                </div>
                <div class="bg-white p-6 rounded-xl text-center shadow-sm hover:shadow-md transition-shadow">
                    <i data-lucide="thermometer" class="w-10 h-10 text-amber-500 mx-auto mb-3"></i>
                    <h4 class="font-bold text-slate-800 text-sm">Ốm sốt / Nhiễm trùng</h4>
                </div>
                <div
                    class="bg-white p-6 rounded-xl text-center shadow-sm hover:shadow-md transition-shadow col-span-2 md:col-span-1">
                    <i data-lucide="monitor-play" class="w-10 h-10 text-amber-500 mx-auto mb-3"></i>
                    <h4 class="font-bold text-slate-800 text-sm">Ánh sáng chớp nháy</h4>
                </div>

            </div>
        </div>
    </section>

    <!-- Actionable Advice for Parents -->
    <section class="py-20 bg-brand-600 text-white">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Cha Mẹ Cần Làm Gì Để Hỗ Trợ Con?</h2>

            <div class="space-y-6">
                <!-- Checklist item -->
                <div class="bg-brand-700/50 p-6 rounded-2xl flex items-start gap-4 backdrop-blur-sm">
                    <div class="bg-brand-400 p-2 rounded-full shrink-0 mt-1">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Đánh giá toàn diện (Không chỉ đo điện não)</h4>
                        <p class="text-brand-100">Khám chuyên khoa tâm lý/phát triển song song với thần kinh. Trẻ cần
                            được đánh giá định kỳ về trí tuệ và ngôn ngữ để can thiệp sớm ngay lập tức.</p>
                    </div>
                </div>

                <!-- Checklist item -->
                <div class="bg-brand-700/50 p-6 rounded-2xl flex items-start gap-4 backdrop-blur-sm">
                    <div class="bg-brand-400 p-2 rounded-full shrink-0 mt-1">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Thiết kế lại cách giao tiếp (Quy tắc 5-10s)</h4>
                        <p class="text-brand-100">Nói chậm, dùng câu ngắn. Đếm thầm 5-10 giây chờ con xử lý thông tin
                            trước khi nhắc lại. Chia nhỏ các nhiệm vụ thay vì gộp chung một câu dài.</p>
                    </div>
                </div>

                <!-- Checklist item -->
                <div class="bg-brand-700/50 p-6 rounded-2xl flex items-start gap-4 backdrop-blur-sm">
                    <div class="bg-brand-400 p-2 rounded-full shrink-0 mt-1">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Trở thành "Camera chạy bằng cơm"</h4>
                        <p class="text-brand-100">Theo dõi chặt chẽ tác dụng phụ của thuốc. Ghi chép lại nếu con bỗng
                            nhiên lờ đờ quá mức hoặc hung hăng đập phá sau khi đổi thuốc, để báo ngay cho bác sĩ.</p>
                    </div>
                </div>

                <!-- Checklist item -->
                <div class="bg-brand-700/50 p-6 rounded-2xl flex items-start gap-4 backdrop-blur-sm">
                    <div class="bg-brand-400 p-2 rounded-full shrink-0 mt-1">
                        <i data-lucide="check" class="w-5 h-5 text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-bold mb-2">Báo trước để tránh "bùng nổ"</h4>
                        <p class="text-brand-100">Hỗ trợ chức năng điều hành bằng cách báo trước các hoạt động sắp tới.
                            Ví dụ: "5 phút nữa mình cất xe ô tô đi tắm nhé", kết hợp cùng đồng hồ bấm giờ.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="py-20 bg-brand-50">
        <div class="max-w-3xl mx-auto px-6">
            <div class="text-center mb-12">
                <i data-lucide="help-circle" class="w-12 h-12 text-brand-500 mx-auto mb-4"></i>
                <h2 class="text-3xl font-bold text-slate-900">Góc Giải Đáp Cho Cha Mẹ</h2>
            </div>

            <div class="space-y-4">
                <!-- FAQ 1 -->
                <details
                    class="group bg-white rounded-xl shadow-sm [&_summary::-webkit-details-marker]:hidden border border-slate-200">
                    <summary
                        class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold text-lg">
                        Động kinh ở trẻ em có thể chữa khỏi hoàn toàn không?
                        <span class="relative h-5 w-5 shrink-0">
                            <i data-lucide="plus"
                                class="absolute inset-0 opacity-100 group-open:opacity-0 transition-opacity"></i>
                            <i data-lucide="minus"
                                class="absolute inset-0 opacity-0 group-open:opacity-100 transition-opacity"></i>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 pt-0 text-slate-600 leading-relaxed border-t border-slate-100 mt-2 pt-4">
                        Tùy thuộc vào loại động kinh và nguyên nhân gây bệnh. Tin vui là rất nhiều trẻ em (hơn 60%) có
                        thể "lớn lên và bỏ lại bệnh động kinh phía sau" khi não bộ trưởng thành hoàn thiện. Một số khác
                        có thể cần dùng thuốc lâu dài để kiểm soát, nhưng các em vẫn có thể học tập và sinh hoạt bình
                        thường.
                    </div>
                </details>

                <!-- FAQ 2 -->
                <details
                    class="group bg-white rounded-xl shadow-sm [&_summary::-webkit-details-marker]:hidden border border-slate-200">
                    <summary
                        class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold text-lg">
                        Cơn "thẫn thờ, nhìn chằm chằm" có nguy hiểm bằng co giật toàn thân không?
                        <span class="relative h-5 w-5 shrink-0">
                            <i data-lucide="plus"
                                class="absolute inset-0 opacity-100 group-open:opacity-0 transition-opacity"></i>
                            <i data-lucide="minus"
                                class="absolute inset-0 opacity-0 group-open:opacity-100 transition-opacity"></i>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 pt-0 text-slate-600 leading-relaxed border-t border-slate-100 mt-2 pt-4">
                        Cơn vắng ý thức thường không gây nguy hiểm đe dọa tính mạng ngay (như ngã đập đầu). Tuy nhiên,
                        nó cực kỳ "nguy hiểm" cho việc học. Tưởng tượng con đang nghe giảng mà bị "tắt nguồn" vài giây
                        liên tục hàng chục lần mỗi ngày, con sẽ bị hổng kiến thức và giảm trí nhớ nghiêm trọng.
                    </div>
                </details>

                <!-- FAQ 3 -->
                <details
                    class="group bg-white rounded-xl shadow-sm [&_summary::-webkit-details-marker]:hidden border border-slate-200">
                    <summary
                        class="flex cursor-pointer items-center justify-between gap-1.5 p-6 text-slate-900 font-bold text-lg">
                        Trẻ bị động kinh có thể đi học trường lớp bình thường không?
                        <span class="relative h-5 w-5 shrink-0">
                            <i data-lucide="plus"
                                class="absolute inset-0 opacity-100 group-open:opacity-0 transition-opacity"></i>
                            <i data-lucide="minus"
                                class="absolute inset-0 opacity-0 group-open:opacity-100 transition-opacity"></i>
                        </span>
                    </summary>
                    <div class="px-6 pb-6 pt-0 text-slate-600 leading-relaxed border-t border-slate-100 mt-2 pt-4">
                        Hoàn toàn có thể! Nếu được kiểm soát tốt bằng thuốc, không có lý do gì con không thể hòa nhập.
                        Tuy nhiên, cha mẹ cần trao đổi kỹ với giáo viên về tình trạng của con, cách sơ cứu cơ bản, và
                        xin giáo viên hỗ trợ thêm nếu con tiếp thu chậm hơn do ảnh hưởng của thuốc.
                    </div>
                </details>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="cta-support" class="py-20 bg-brand-200 relative overflow-hidden">
        <div class="absolute -right-10 -top-10 opacity-20 transform rotate-12 pointer-events-none">
            <i data-lucide="messages-square" class="w-64 h-64 text-brand-600"></i>
        </div>
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-slate-900 mb-6">Bạn Cần Hỗ Trợ Cho Tình Trạng Cụ Thể Của Con?
            </h2>
            <p class="text-lg text-slate-700 mb-10 max-w-2xl mx-auto">
                Mỗi đứa trẻ là một cá thể độc bản với những đặc điểm phát triển khác nhau. Nếu cha mẹ có những băn khoăn
                riêng hoặc cần tư vấn chuyên sâu hơn về tình trạng của bé, hãy kết nối ngay để được hỗ trợ kịp thời.
            </p>
            <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" rel="noopener noreferrer"
                class="inline-flex items-center justify-center px-10 py-5 text-lg font-bold text-white bg-brand-600 hover:bg-brand-700 rounded-full shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">
                <i data-lucide="facebook" class="mr-3 w-6 h-6"></i> Liên hệ Helen Hoai
            </a>
        </div>
    </section>

    <!-- Footer / Conclusion -->
    <footer class="bg-slate-900 text-slate-300 py-12 text-center">
        <div class="max-w-3xl mx-auto px-6">
            <i data-lucide="quote" class="w-10 h-10 text-slate-600 mx-auto mb-6"></i>
            <p class="text-xl italic font-light leading-relaxed mb-8">
                "Bộ não trẻ em có một đặc tính tuyệt vời là <strong>Sự dẻo dai thần kinh (Neuroplasticity)</strong> –
                khả năng tự tổ chức lại và học hỏi không ngừng. Với sự đồng hành đúng đắn và tình yêu thương vô điều
                kiện, trẻ hoàn toàn có thể vượt qua rào cản để phát huy tối đa tiềm năng."
            </p>
            <div class="w-16 h-1 bg-brand-500 mx-auto rounded mb-6"></div>
            <p class="text-sm opacity-60">
                Thông tin được tổng hợp và biên dịch dựa trên nền tảng y khoa từ Dementech Neurosciences, Anh
                Quốc.<br />
                Luôn tham khảo ý kiến bác sĩ chuyên khoa cho trường hợp cụ thể của con bạn.
            </p>
        </div>
    </footer>

    <!-- Initialize Icons -->
    <script>
        lucide.createIcons();
    </script>
</body>

</html>

<?php get_footer(); ?>