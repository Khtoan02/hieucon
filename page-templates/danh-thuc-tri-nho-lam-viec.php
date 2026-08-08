<?php /* Template Name: Danh Thức Trí Nhớ Làm Việc */ ?>
<?php get_header(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh Thức Trí Nhớ Làm Việc - Hành Trình Thấu Hiểu Con</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FontAwesome cho các biểu tượng -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts: Nunito -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                    },
                    colors: {
                        primary: '#3B82F6', // Blue 500
                        secondary: '#10B981', // Emerald 500
                        accent: '#F59E0B', // Amber 500
                        pastelBlue: '#EFF6FF',
                        pastelGreen: '#ECFDF5',
                        pastelYellow: '#FFFBEB',
                    }
                }
            }
        }
    </script>
    <style>
        .glass-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.4);
        }

        .bounce-soft {
            animation: bounceSoft 3s infinite ease-in-out;
        }

        @keyframes bounceSoft {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        html {
            scroll-behavior: smooth;
        }
    </style>
</head>

<body class="font-sans text-gray-800 bg-gray-50 leading-relaxed selection:bg-primary selection:text-white">

    <section class="relative bg-pastelBlue overflow-hidden">
        <div
            class="absolute top-0 left-0 w-64 h-64 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-pulse">
        </div>
        <div
            class="absolute top-0 right-0 w-64 h-64 bg-yellow-200 rounded-full mix-blend-multiply filter blur-3xl opacity-40 animate-pulse">
        </div>

        <div class="max-w-6xl mx-auto px-4 py-12 md:py-20 relative z-10 grid md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6">
                <div
                    class="inline-block bg-white text-primary font-bold px-4 py-1.5 rounded-full text-sm shadow-sm border border-blue-100">
                    <i class="fas fa-book-open mr-2"></i> Khoa học thưởng thức dễ hiểu
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 leading-tight">
                    ĐÁNH THỨC <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary to-secondary">"TRÍ NHỚ LÀM
                        VIỆC"</span>
                </h1>
                <p class="text-lg md:text-xl text-gray-600 font-semibold leading-relaxed">
                    Chiến lược vàng giúp ba mẹ thấu hiểu con, giảm áp lực căng thẳng & tăng khả năng tập trung cho trẻ
                    Tự kỷ & ADHD.
                </p>
                <p class="text-gray-600">
                    Ba mẹ có bao giờ tự hỏi: Tại sao con có thể nhớ vanh vách một bộ phim hay bài hát rất dài, nhưng lại
                    quên ngay lời mẹ dặn chỉ 5 giây trước? Câu trả lời không nằm ở việc con "bướng bỉnh", mà ẩn sâu bên
                    trong cơ chế vận hành kỳ diệu của não bộ.
                </p>

                <div class="pt-2 flex flex-col sm:flex-row items-center gap-4">
                    <a href="#giai-ma-wm"
                        class="w-full sm:w-auto text-center bg-gradient-to-r from-primary to-blue-600 text-white px-8 py-3.5 rounded-full font-bold text-lg hover:shadow-lg hover:scale-105 transition-all duration-300">
                        Khám phá ngay <i class="fas fa-arrow-down ml-1"></i>
                    </a>
                    <a href="#contact-helen"
                        class="w-full sm:w-auto text-center bg-white text-primary border-2 border-primary px-8 py-3.5 rounded-full font-bold text-lg hover:bg-blue-50 hover:shadow-md hover:scale-105 transition-all duration-300">
                        Cần hỗ trợ <i class="fas fa-comment-dots ml-1"></i>
                    </a>
                </div>
            </div>

            <div class="relative flex justify-center items-center">
                <img src="https://images.unsplash.com/photo-1617791160536-598cf32026fb?auto=format&fit=crop&w=600&q=80"
                    alt="Mẹ và bé"
                    class="rounded-3xl shadow-xl z-10 w-full max-w-md object-cover bounce-soft border-4 border-white">

                <div
                    class="absolute -left-4 top-1/4 bg-white p-3.5 rounded-2xl shadow-lg z-20 flex items-center gap-3 border border-gray-100">
                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center text-accent">
                        <i class="fas fa-brain"></i>
                    </div>
                    <div>
                        <p class="text-xs text-gray-400">Chìa khóa</p>
                        <p class="font-bold text-xs text-gray-800">Thấu hiểu hành vi con</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">Những "rắc rối" nhỏ lặp lại mỗi ngày</h2>
                <p class="text-gray-600">Đừng vội trách con bướng bỉnh hay chống đối, hãy quan sát xem con có đang mắc
                    kẹt trong những tình huống này không?</p>
            </div>

            <div class="grid md:grid-cols-3 gap-6">
                <div class="bg-pastelYellow p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-accent text-xl mb-4 shadow-sm relative z-10">
                        <i class="fas fa-comment-slash"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 relative z-10">Quên ngay lời dặn</h3>
                    <p class="text-sm text-gray-600 relative z-10">Con vừa nghe mẹ dặn "đi lấy dép và đội mũ" nhưng chỉ
                        đi được 3 bước liền khựng lại, quên mất mình cần phải làm gì.</p>
                </div>
                <div class="bg-pastelBlue p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-primary text-xl mb-4 shadow-sm relative z-10">
                        <i class="fas fa-bomb"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 relative z-10">Dễ bùng nổ, cáu gắt</h3>
                    <p class="text-sm text-gray-600 relative z-10">Khi được yêu cầu làm nhiều việc cùng lúc, con đột
                        nhiên hoảng loạn, hét lên, ăn vạ hoặc chọn cách thu mình phản kháng.</p>
                </div>
                <div class="bg-pastelGreen p-6 rounded-2xl shadow-sm relative overflow-hidden group">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-secondary text-xl mb-4 shadow-sm relative z-10">
                        <i class="fas fa-sync-alt"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2 relative z-10">Khó chuyển đổi nhiệm vụ</h3>
                    <p class="text-sm text-gray-600 relative z-10">Con cực kỳ khó khăn khi chuyển từ việc đang chơi dở
                        sang việc đi tắm hoặc ăn cơm, dễ nảy sinh hành vi chống đối rập khuôn.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="giai-ma-wm" class="py-16 bg-gray-50 border-t border-b border-gray-100">
        <div class="max-w-6xl mx-auto px-4">
            <div class="grid lg:grid-cols-12 gap-12 items-center">

                <div class="lg:col-span-7 space-y-6">
                    <div class="inline-block bg-blue-100 text-primary font-bold px-4 py-1.5 rounded-full text-xs">
                        <i class="fas fa-seedling mr-2"></i> Khám phá khoa học não bộ
                    </div>
                    <h2 class="text-2xl md:text-3xl font-extrabold text-gray-900">
                        1. Trí Nhớ Làm Việc (WM) Thực Chất Là Gì?
                    </h2>

                    <p class="text-gray-600">
                        Để hiểu được những khó khăn của con, trước hết ba mẹ hãy làm quen với <strong>Trí Nhớ Làm Việc
                            (Working Memory - viết tắt là WM)</strong>. Nó thuộc nhóm <em>"Chức năng điều hành"</em> –
                        đóng vai trò như <strong>Ban Giám Đốc Thần Kinh</strong> của bộ não, quản lý mọi hành vi: tự
                        kiểm soát cảm xúc, lập kế hoạch, tập trung chú ý và giải quyết vấn đề.
                    </p>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border-l-4 border-primary">
                        <h4 class="font-bold text-gray-900 mb-2 flex items-center gap-2">
                            <i class="fas fa-balance-scale text-primary"></i>
                            Sự khác biệt cốt lõi: Trí nhớ ngắn hạn vs Trí nhớ làm việc
                        </h4>
                        <div class="grid md:grid-cols-2 gap-4 mt-3 text-sm">
                            <div class="p-3 bg-gray-50 rounded-xl">
                                <span class="font-bold text-gray-700 block mb-1">Trí nhớ ngắn hạn:</span>
                                Giống như <strong>"Tờ giấy note"</strong> dán trên tủ lạnh. Con chỉ ghi nhận thông tin ở
                                đó và nhìn thấy (Ví dụ: nhớ số điện thoại vừa đọc).
                            </div>
                            <div class="p-3 bg-blue-50 text-blue-950 rounded-xl">
                                <span class="font-bold text-primary block mb-1">Trí nhớ làm việc (WM):</span>
                                Giống như <strong>"Bàn bếp nấu ăn"</strong>. Não bộ vừa phải giữ nguyên liệu (thông tin
                                mới), vừa phải nhào nặn, chế biến (xử lý hành động) cùng một lúc.
                            </div>
                        </div>
                    </div>

                    <p class="text-gray-600">
                        Khi mẹ dặn: <em>"Con cất đồ chơi rồi đi rửa tay để ăn cơm nhé"</em>, bộ não của con không chỉ
                        lưu lại lời dặn, mà phải liên tục phân tích: <em>"Đồ chơi cất ở đâu? Đi hướng nào tới bồn rửa?
                            Tay ướt thì lau vào đâu?"</em>. Toàn bộ chuỗi xử lý phức tạp này đều dựa vào "Trí nhớ làm
                        việc".
                    </p>
                </div>

                <div class="lg:col-span-5 bg-white p-6 rounded-3xl shadow-lg border border-gray-100">
                    <h3 class="text-center font-bold text-lg text-gray-800 mb-6 border-b pb-3">
                        <i class="fas fa-desktop text-primary mr-2"></i>Chiếc Bàn Làm Việc Của Bộ Não
                    </h3>
                    <p class="text-xs text-gray-500 mb-4 text-center">Cách não bộ tiếp nhận, xử lý và ra quyết định hành
                        động</p>

                    <div class="space-y-4">
                        <div class="flex items-start gap-3 p-3 bg-gray-50 rounded-xl border border-gray-150">
                            <div
                                class="w-8 h-8 bg-blue-100 text-primary rounded-full flex items-center justify-center shrink-0 font-bold text-xs">
                                1</div>
                            <div>
                                <h4 class="font-bold text-sm text-gray-900">Thông tin đi vào</h4>
                                <p class="text-xs text-gray-500">Lời nói của mẹ, hình ảnh đồ vật, yêu cầu học tập...</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-xl border border-blue-100">
                            <div
                                class="w-8 h-8 bg-primary text-white rounded-full flex items-center justify-center shrink-0 font-bold text-xs">
                                2</div>
                            <div>
                                <h4 class="font-bold text-sm text-primary">Bộ não "nhào nặn" thông tin</h4>
                                <p class="text-xs text-blue-700">Giữ thông tin tạm thời và sắp xếp các bước thực hiện
                                    trong đầu.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-green-50 rounded-xl border border-green-100">
                            <div
                                class="w-8 h-8 bg-secondary text-white rounded-full flex items-center justify-center shrink-0 font-bold text-xs">
                                3</div>
                            <div>
                                <h4 class="font-bold text-sm text-secondary">Phản hồi hành động mượt mà</h4>
                                <p class="text-xs text-green-700">Con hoàn thành việc mẹ dặn hoặc ghi nhớ bài học thành
                                    công.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12">
                <h3 class="text-xl font-bold text-gray-900 text-center mb-8">
                    4 "Nhân Viên" Cần Mẫn Trên Chiếc Bàn Não Bộ (Mô hình Baddeley dễ hiểu)
                </h3>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Component 1 -->
                    <div
                        class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative group hover:border-blue-200 transition">
                        <div
                            class="w-10 h-10 bg-blue-100 text-primary rounded-xl flex items-center justify-center text-lg mb-4">
                            <i class="fas fa-volume-up"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-2">1. "Máy Ghi Âm Nội Tâm"</h4>
                        <span class="text-xs text-gray-400 block mb-2 font-medium">Vòng lặp âm vị học</span>
                        <p class="text-xs text-gray-600">
                            Giúp con tự lặp đi lặp lại lời dặn của mẹ thầm trong đầu (như chiếc băng cassette tự phát
                            lại) để không bị quên ngay lập tức.
                        </p>
                    </div>

                    <!-- Component 2 -->
                    <div
                        class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative group hover:border-yellow-200 transition">
                        <div
                            class="w-10 h-10 bg-yellow-100 text-accent rounded-xl flex items-center justify-center text-lg mb-4">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-2">2. "Tấm Bảng Nháp Hình Ảnh"</h4>
                        <span class="text-xs text-gray-400 block mb-2 font-medium">Bảng phác thảo thị giác - không
                            gian</span>
                        <p class="text-xs text-gray-600">
                            Giúp con "vẽ" ra trong đầu bản đồ hướng đi, hình dung món đồ chơi hay tủ giày nằm ở đâu
                            trong nhà để tìm kiếm.
                        </p>
                    </div>

                    <!-- Component 3 -->
                    <div
                        class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative group hover:border-purple-200 transition">
                        <div
                            class="w-10 h-10 bg-purple-100 text-purple-600 rounded-xl flex items-center justify-center text-lg mb-4">
                            <i class="fas fa-link"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-2">3. "Cầu Nối Ký Ức Cũ"</h4>
                        <span class="text-xs text-gray-400 block mb-2 font-medium">Bộ đệm giai thoại</span>
                        <p class="text-xs text-gray-600">
                            Nhanh chóng kết nối thông tin mới với kinh nghiệm cũ của con (Ví dụ: Nhớ ra lần trước cất đồ
                            chơi vào rổ màu đỏ thì nhanh hơn).
                        </p>
                    </div>

                    <!-- Component 4 -->
                    <div
                        class="bg-white p-5 rounded-2xl border border-gray-100 shadow-sm relative group hover:border-green-200 transition">
                        <div
                            class="w-10 h-10 bg-green-100 text-secondary rounded-xl flex items-center justify-center text-lg mb-4">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h4 class="font-bold text-gray-900 text-sm mb-2">4. "Vị Nhạc Trưởng Chỉ Huy"</h4>
                        <span class="text-xs text-gray-400 block mb-2 font-medium">Hệ thống điều hành trung tâm</span>
                        <p class="text-xs text-gray-600">
                            Người sếp quyền lực nhất! Điều phối 3 nhân viên trên, quyết định việc nào cần tập trung,
                            loại bỏ phiền nhiễu xung quanh.
                        </p>
                    </div>
                </div>

                <div class="mt-8 bg-pastelYellow/80 p-5 rounded-2xl border border-yellow-100 text-sm">
                    <p class="text-yellow-900 leading-relaxed font-semibold">
                        <i class="fas fa-info-circle mr-2 text-accent text-lg"></i>
                        Hệ quả khi "Bàn làm việc" quá tải:
                    </p>
                    <p class="text-gray-700 mt-1">
                        Ở trẻ Tự kỷ & ADHD, chiếc bàn này thường <strong>nhỏ hơn hoặc hoạt động chậm hơn</strong>. Khi
                        mẹ đưa dặn quá nhiều yêu cầu cùng một lúc, chiếc bàn lập tức bị quá tải, thông tin bị rơi rớt
                        lung tung. Đây chính là nguyên nhân cốt lõi khiến con không thể tập trung, mau quên và dễ nảy
                        sinh cảm xúc tiêu cực vì bất lực trong việc xử lý thông tin.
                    </p>
                </div>
            </div>

        </div>
    </section>

    <section class="py-16 bg-white">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mb-4">2. Mối liên hệ mật thiết với hành vi của
                    con</h2>
                <p class="text-gray-600">Tại sao suy yếu trí nhớ làm việc lại dẫn đến các hành vi rập khuôn?</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <div class="p-6 rounded-2xl bg-pastelGreen border border-green-100">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-secondary text-xl mb-4 shadow-sm">
                        <i class="fas fa-hands"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Hành vi rập khuôn, lặp đi lặp lại</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Nghiên cứu khoa học chứng minh trẻ có trí nhớ làm việc kém thường có xu hướng thực hiện hành vi
                        rập khuôn (vỗ tay, lắc lư, đi nhón chân) nhiều hơn. Khi bộ não không thể xử lý thông tin trơn
                        tru, con cảm thấy mất kiểm soát. Các hành động lặp lại này thực chất là cách con tự xoa dịu, tìm
                        lại cảm giác an toàn trước luồng thông tin quá tải từ môi trường.
                    </p>
                </div>

                <div class="p-6 rounded-2xl bg-pastelBlue border border-blue-100">
                    <div
                        class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-primary text-xl mb-4 shadow-sm">
                        <i class="fas fa-random"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Rào cản lớn với việc "Đa Nhiệm"</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        Nghiên cứu cho thấy trẻ tự kỷ có thể hoàn thành rất tốt một việc đơn lẻ. Nhưng khi đối mặt với
                        "nhiệm vụ kép" (vừa phải nghe cô giáo giảng bài vừa phải chép vở), hệ thần kinh của con liền bị
                        "treo". Việc ép con phải làm nhiều việc cùng lúc sẽ tiêu tốn toàn bộ năng lượng của bộ não, dễ
                        kích hoạt các cơn bùng nổ hành vi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section
        class="py-16 bg-gray-900 text-white rounded-3xl my-8 max-w-6xl mx-auto px-6 md:px-12 relative overflow-hidden shadow-xl">
        <div class="absolute -right-12 -bottom-12 w-64 h-64 border-[30px] border-white/5 rounded-full"></div>

        <div class="relative z-10">
            <h2 class="text-xl md:text-2xl font-bold text-center mb-8">3. Điểm chung và riêng giữa trẻ Tự kỷ (ASD) &
                Tăng động (ADHD)</h2>
            <div class="grid md:grid-cols-2 gap-6 text-center">
                <div class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10">
                    <h3 class="text-lg font-bold text-accent mb-2">Trẻ ADHD</h3>
                    <p class="text-sm text-gray-300">
                        "Chiếc phanh" kiểm soát của bộ não yếu hơn. Con khó kiềm chế xung động, hành động bộc phát ngay
                        trước khi "vị nhạc trưởng" kịp phân tích thông tin.
                    </p>
                </div>
                <div class="bg-white/5 backdrop-blur-md p-6 rounded-xl border border-white/10">
                    <h3 class="text-lg font-bold text-blue-400 mb-2">Trẻ Tự Kỷ (ASD)</h3>
                    <p class="text-sm text-gray-300">
                        Gặp khó khăn lớn trong việc xử lý thông tin mới hoặc thay đổi lịch trình đột ngột. Con mất nhiều
                        thời gian hơn và dễ bộc lộ sai sót khi phải đưa ra phản ứng.
                    </p>
                </div>
            </div>
            <div
                class="mt-8 text-center bg-gradient-to-r from-blue-500 to-emerald-500 p-4 rounded-xl max-w-2xl mx-auto text-sm font-semibold">
                Điểm chung: Cả hai nhóm con đều cần được ba mẹ hỗ trợ "dọn dẹp" bớt áp lực để tăng không gian trống cho
                trí óc hoạt động.
            </div>
        </div>
    </section>

    <section id="giai-phap" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="text-center max-w-3xl mx-auto mb-12">
                <span class="text-secondary font-bold text-xs uppercase tracking-wider">Chiến lược khoa học & yêu
                    thương</span>
                <h2 class="text-2xl md:text-3xl font-bold text-gray-900 mt-2">Các giải pháp thiết thực hỗ trợ con</h2>
            </div>

            <div class="bg-white rounded-2xl p-6 md:p-8 shadow-sm border border-gray-100 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                    <i class="fas fa-bullhorn text-primary bg-blue-100 p-2.5 rounded-xl text-sm"></i>
                    1. Chiến Lược Giao Tiếp & Giáo Dục Trực Quan
                </h3>

                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm mb-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary"></span> Chia nhỏ nhiệm vụ
                        </h4>
                        <p class="text-xs text-gray-600 pl-4">
                            Hãy đưa ra chỉ dẫn ngắn gọn và làm mẫu trực quan. Thay vì ra lệnh dồn dập, hãy tách nhỏ:
                            <em>"Con cất đồ chơi màu xanh vào rổ"</em>, chờ con hoàn thành xong mới giao việc tiếp theo.
                        </p>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 text-sm mb-1 flex items-center gap-2">
                            <span class="w-2 h-2 rounded-full bg-primary"></span> Củng cố tích cực
                        </h4>
                        <p class="text-xs text-gray-600 pl-4">
                            Nghiên cứu chứng minh việc khen ngợi cụ thể hành động tốt, đập tay hay thưởng sticker ngay
                            sau khi con làm đúng sẽ giúp kích thích bộ nhớ hoạt động chính xác hơn vào những lần sau.
                        </p>
                    </div>
                </div>
            </div>

            <div
                class="bg-gradient-to-br from-blue-50 to-emerald-50 rounded-2xl p-6 md:p-8 shadow-sm border border-blue-100">
                <div class="mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-2 flex items-center gap-2">
                        <i class="fas fa-apple-alt text-secondary bg-green-100 p-2.5 rounded-xl text-sm"></i>
                        2. Nâng Cấp Nhiên Liệu Dinh Dưỡng Cho Não Bộ
                    </h3>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Dựa trên một số nghiên cứu chuyên sâu về dinh dưỡng năm 2022, chức năng điều hành và trí nhớ làm
                        việc có sự liên kết chặt chẽ với chất lượng bữa ăn của trẻ. Trẻ tự kỷ thường có xu hướng ăn uống
                        rập khuôn, kén chọn (ít ăn trái cây, lười uống sữa, thiếu đa dạng thực phẩm). Việc ba mẹ nỗ lực
                        đa dạng hóa bữa ăn, bổ sung dinh dưỡng cân bằng và hạn chế các thực phẩm "rỗng" (nhiều đường,
                        dầu mỡ) chính là một chiến lược can thiệp trực tiếp hỗ trợ bảo vệ màng tế bào thần kinh, từ đó
                        cải thiện khả năng tự tổ chức và ghi nhớ của não bộ. Bên cạnh đó, việc chủ động bổ sung các nhóm
                        chất dinh dưỡng quan trọng mà chế độ ăn hàng ngày chưa cung cấp đủ nhu cầu cơ thể và não bộ là
                        vô cùng cần thiết bao gồm
                    </p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4 text-xs">
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-accent font-bold text-sm mb-1"><i class="fas fa-bolt mr-1"></i> Khoáng chất &
                            Vitamin</div>
                        <p class="text-gray-600">Magie, Canxi, kẽm, Vitamin nhóm B (nhất là B12, Folate...) và D3 là
                            nguồn năng lượng của não. Thiếu hụt dễ dẫn đến kém tập trung, tăng động.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-primary font-bold text-sm mb-1"><i class="fas fa-fish mr-1"></i> Omega-3 & GLA
                        </div>
                        <p class="text-gray-600">DHA/EPA (Omega-3) là vật liệu xây não bộ. Kết hợp EPA/DHA cùng GLA
                            (Omega-6) hỗ trợ cải thiện khả năng tập trung tốt hơn.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-purple-600 font-bold text-sm mb-1"><i class="fas fa-leaf mr-1"></i> Aixt amin &
                            Dưỡng chất chuyên biệt</div>
                        <p class="text-gray-600">L-Theanine, GABA giúp thư giãn thần kinh, tập trung tốt hơn mà không
                            gây buồn ngủ. Choline đóng vai trò sản xuất chất dẫn truyền thần kinh để điều hòa trí nhớ,
                            tâm trạng.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-emerald-600 font-bold text-sm mb-1"><i class="fas fa-bacterium mr-1"></i> Lợi
                            khuẩn tâm thần (Psychobiotics)</div>
                        <p class="text-gray-600">Tác động qua trục Não - Ruột. Các chủng như <strong>B. breve
                                CCFM1025</strong> (tăng chất dưỡng não BDNF) và <strong>L. plantarum Lp90...</strong> hỗ
                            trợ con học tập, ghi nhớ tốt hơn.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-pink-600 font-bold text-sm mb-1"><i class="fas fa-seedling mr-1"></i> Thảo dược
                            & Chất bảo vệ</div>
                        <p class="text-gray-600">Rau đắng biển, Bạch quả và mầm bông cải xanh, các loại quả mọng... hỗ
                            trợ tuần hoàn máu não, cung cấp chất chống oxy hóa tự nhiên giúp bảo vệ màng nơ-ron thần
                            kinh.</p>
                    </div>
                    <div class="bg-white p-4 rounded-xl border border-gray-100 shadow-sm">
                        <div class="text-yellow-600 font-bold text-sm mb-1"><i class="fas fa-shield-virus mr-1"></i>
                            Phosphatidylserine</div>
                        <p class="text-gray-600">Dưỡng chất tốt cho màng tế bào não. Thử nghiệm lâm sàng cho thấy chất
                            này cũng hỗ trợ cải thiện rõ rệt sự chú ý và giảm bớt cơn bùng nổ của trẻ.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-white border-t border-gray-100 pt-16 pb-8">
        <div class="max-w-4xl mx-auto px-4 text-center">
            <div class="mb-10">
                <i class="fas fa-seedling text-3xl text-secondary mb-3"></i>
                <h2 class="text-xl font-bold text-gray-900 mb-3">🌻 Đồng hành cùng con bằng sự thấu hiểu</h2>
                <p class="text-sm text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    Hiểu được "bàn làm việc" của con đang chật hẹp thế nào chính là bước đi đầu tiên giúp ba mẹ rũ bỏ áp
                    lực và định kiến. Bằng chiến lược giáo dục và đồng hành tích cực và phù hợp, bổ dung dinh dưỡng khoa
                    học và che chở, khích lệ con bằng tình yêu thương vô điều kiện.
                </p>
            </div>

            <!-- Personalized support card with social link -->
            <div id="contact-helen"
                class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white rounded-2xl p-6 md:p-8 text-left shadow-lg mb-12 flex flex-col md:flex-row items-center justify-between gap-6">
                <div class="space-y-3 max-w-xl">
                    <span
                        class="bg-white/20 text-white font-bold px-3 py-1 rounded-full text-xs uppercase tracking-wider">
                        <i class="fas fa-heart mr-1"></i> Đồng hành cùng ba mẹ
                    </span>
                    <h3 class="text-xl md:text-2xl font-extrabold">Đồng hành cá nhân hóa cùng Helen Hoài</h3>
                    <p class="text-sm text-blue-50 leading-relaxed">
                        Các ba mẹ nhận thấy con đang gặp khó khăn trong vấn đề trí nhớ, hành vi, cảm xúc, chú ý... cần
                        được hỗ trợ cải thiện, hãy nhắn tin cho Helen Hoài để được hỗ trợ cho tình trạng cụ thể của con
                        yêu nhé!
                    </p>
                </div>
                <div class="shrink-0">
                    <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank"
                        rel="noopener noreferrer"
                        class="inline-flex items-center justify-center gap-2 bg-yellow-400 text-gray-900 px-6 py-3.5 rounded-full font-bold text-md hover:bg-yellow-300 hover:scale-105 transition-all shadow-md">
                        Liên hệ Helen Hoài <i class="fab fa-facebook text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- References without 'APA 7' reference in title -->
            <div class="border-t border-gray-100 pt-8 text-left max-w-2xl mx-auto">
                <h4 class="text-xs font-bold text-gray-400 mb-2 uppercase">📚 Tài liệu tham khảo</h4>
                <p class="text-[11px] text-gray-400 leading-relaxed">
                    Çağlar, E., & Kaynak, H. (2021). Working memory functions in Autism Spectrum Disorder: A review.
                    <em>Journal of Clinical Psychology Research</em>, <em>5</em>(2), 202-212. <a
                        href="https://doi.org/10.5455/kpd.26024438m000036" class="text-blue-400 underline"
                        target="_blank">https://doi.org/10.5455/kpd.26024438m000036</a>
                </p>
            </div>

            <p class="text-gray-400 text-xs mt-12">© 2026 Góc Đồng hành cùng Cộng Đồng có con Tự kỷ & ADHD.</p>
        </div>
    </footer>
    <?php get_footer(); ?>