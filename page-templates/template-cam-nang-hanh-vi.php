<?php
/**
 * Template Name: Trang CẨM NANG THẤU HIỂU HÀNH VI
 * 
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wiki Hành Vi Tự Kỷ - Hiểu Đúng Để Đồng Hành Cùng Con</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50:  '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }
        body { font-family: 'Quicksand', sans-serif; }

        /* === SIDEBAR TRANSITION === */
        #sidebar {
            transition: transform 0.3s ease-in-out;
        }
        #sidebar-overlay {
            transition: opacity 0.3s ease-in-out;
        }

        /* === VIEWS === */
        .view { display: none; }
        .view.active { display: block; }

        /* === SCROLL ANIMATION === */
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.6s ease-out forwards; opacity: 0; }
        .anim.d1 { animation-delay: 80ms; }
        .anim.d2 { animation-delay: 160ms; }
        .anim.d3 { animation-delay: 240ms; }

        /* === NAV BUTTON ACTIVE === */
        .nav-btn.active {
            background-color: #eff6ff;
            color: #1d4ed8;
        }
        .nav-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            color: #475569;
            text-align: left;
            cursor: pointer;
            border: none;
            background: transparent;
        }
        .nav-btn:hover { background-color: #f1f5f9; }
        .nav-btn.active { background-color: #eff6ff; color: #1d4ed8; }

        /* === BEHAVIOR CARD HOVER === */
        .card-hover {
            transition: transform 0.3s cubic-bezier(.4,0,.2,1), box-shadow 0.3s ease;
        }
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 16px 40px -8px rgba(0,0,0,0.12);
        }

        /* === SIDEBAR BEHAVIOR BUTTON === */
        .behavior-btn.active {
            background-color: #eff6ff;
            color: #1d4ed8;
            font-weight: 600;
        }
        .behavior-btn {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            transition: background 0.15s, color 0.15s;
            color: #475569;
            text-align: left;
            cursor: pointer;
            border: none;
            background: transparent;
        }
        .behavior-btn:hover { background-color: #f1f5f9; }
        .behavior-btn i { width: 16px; height: 16px; flex-shrink: 0; color: #94a3b8; }
        .behavior-btn.active i { color: #2563eb; }
    </style>
    <?php wp_head(); ?>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">

    <!-- ═══════════════════════════════════════════════════════════
         SIDEBAR OVERLAY (mobile)
    ═══════════════════════════════════════════════════════════ -->
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/40 z-40 hidden opacity-0 lg:hidden"
         onclick="closeSidebar()"></div>

    <!-- ═══════════════════════════════════════════════════════════
         APP WRAPPER — sidebar + content must be siblings in flex
    ═══════════════════════════════════════════════════════════ -->
    <div class="flex h-screen overflow-hidden">

    <!-- ═══════════════════════════════════════════════════════════
         SIDEBAR
    ═══════════════════════════════════════════════════════════ -->
    <aside id="sidebar"
           class="fixed inset-y-0 left-0 z-50 w-72 flex-shrink-0 bg-white shadow-xl flex flex-col
                  -translate-x-full lg:relative lg:translate-x-0 lg:inset-auto">

        <!-- Logo -->
        <div class="p-6 bg-brand-600 text-white flex items-center justify-between">
            <div>
                <h1 class="text-xl font-bold tracking-tight">Hiểu Con Từ Gốc</h1>
                <p class="text-brand-200 text-sm mt-1">CẨM NANG THẤU HIỂU HÀNH VI</p>
            </div>
            <button onclick="closeSidebar()" class="lg:hidden text-white hover:text-brand-200 p-1">
                <i data-lucide="x" class="w-6 h-6"></i>
            </button>
        </div>

        <!-- Search -->
        <div class="p-4 border-b border-slate-100">
            <div class="relative">
                <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-slate-400"></i>
                <input id="search-input"
                       type="text"
                       placeholder="Tìm kiếm hành vi..."
                       oninput="handleSearch(this.value)"
                       class="w-full pl-9 pr-4 py-2 bg-slate-100 border border-transparent rounded-lg text-sm
                              focus:bg-white focus:border-brand-500 focus:ring-2 focus:ring-brand-200 outline-none transition-all">
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
            <button class="nav-btn active" id="nav-home" onclick="navigate('home')">
                <i data-lucide="home" class="w-4 h-4 shrink-0"></i> Trang chủ
            </button>
            <button class="nav-btn" id="nav-fundamentals" onclick="navigate('fundamentals')">
                <i data-lucide="book-open" class="w-4 h-4 shrink-0"></i> Kiến thức nền tảng
            </button>

            <div class="pt-4 pb-2 px-3">
                <p class="text-xs font-bold text-slate-400 uppercase tracking-wider">10 Loại Hành Vi</p>
            </div>

            <div id="behavior-nav-list" class="space-y-0.5">
                <!-- Generated by JS -->
            </div>

            <!-- No results message -->
            <p id="no-results" class="text-sm text-slate-400 px-3 py-2 hidden">Không tìm thấy kết quả.</p>

            <!-- Community link -->
            <div class="pt-3 mt-1 border-t border-slate-100">
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan"
                   target="_blank" rel="noopener noreferrer"
                   class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-sm font-medium text-pink-600 hover:bg-pink-50 transition-colors">
                    <i data-lucide="heart" class="w-4 h-4 shrink-0"></i> Cộng đồng hỗ trợ
                </a>
            </div>
        </nav>
    </aside>

    <!-- ═══════════════════════════════════════════════════════════
         RIGHT COLUMN (mobile header + main content)
    ═══════════════════════════════════════════════════════════ -->
    <div class="flex-1 flex flex-col min-w-0 overflow-hidden">

        <!-- Mobile header -->
        <div class="lg:hidden flex-shrink-0 h-16 bg-brand-600 text-white flex items-center justify-between px-4 shadow-md z-40">
            <div class="flex items-center gap-3">
                <button onclick="openSidebar()" class="p-1 hover:bg-brand-700 rounded-md">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <span class="font-bold text-lg">Wiki Tự Kỷ</span>
            </div>
        </div>

        <!-- Main scrollable -->
        <main class="flex-1 overflow-y-auto bg-slate-50">
            <div class="max-w-4xl mx-auto p-6 md:p-10 pb-24">

                <!-- ─────────────────────────────────────────
                     VIEW: HOME
                ───────────────────────────────────────── -->
                <div id="view-home" class="view active">
                    <!-- Hero card -->
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8 anim">
                        <div class="bg-gradient-to-r from-brand-600 to-indigo-600 px-8 py-12 text-white text-center">
                            <h2 class="text-3xl md:text-4xl font-extrabold mb-4">CẨM NANG THẤU HIỂU HÀNH VI</h2>
                            <p class="text-brand-100 text-lg max-w-2xl mx-auto leading-relaxed">
                                Thay vì hỏi <em>"Làm sao để con ngừng hành vi này?"</em>, hãy cùng nhau tìm câu trả lời cho câu hỏi:<br>
                                <strong class="text-white text-xl mt-2 block">"Hành vi này đang giúp con điều gì?"</strong>
                            </p>
                        </div>
                        <div class="p-8">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Fundamentals card -->
                                <div onclick="navigate('fundamentals')"
                                     class="group cursor-pointer p-6 rounded-xl border border-slate-200 hover:border-brand-300 hover:shadow-md transition-all bg-slate-50">
                                    <i data-lucide="book-open" class="text-brand-500 w-8 h-8 mb-4"></i>
                                    <h3 class="text-xl font-bold mb-2 text-slate-800 group-hover:text-brand-600 transition-colors">Kiến thức nền tảng</h3>
                                    <p class="text-slate-600 text-sm leading-relaxed">Đọc bài viết này đầu tiên để hiểu đúng về "Tự kích thích" (Stimming) và nắm vững quy tắc quan sát 3 bước.</p>
                                </div>
                                <!-- Community card -->
                                <div class="p-6 rounded-xl border border-slate-200 bg-slate-50">
                                    <i data-lucide="heart" class="text-pink-500 w-8 h-8 mb-4"></i>
                                    <h3 class="text-xl font-bold mb-2 text-slate-800">Cộng đồng đồng hành</h3>
                                    <p class="text-slate-600 text-sm leading-relaxed mb-4">Kết nối với nhóm cha mẹ "Hiểu con từ Gốc" để tiếp cận giải pháp phục hồi sinh học và giáo dục toàn diện.</p>
                                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan"
                                       target="_blank" rel="noopener noreferrer"
                                       class="text-sm font-semibold text-pink-600 hover:text-pink-700 flex items-center gap-1">
                                        Tham gia ngay &rarr;
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Behavior grid -->
                    <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2 anim d1">
                        <i data-lucide="box" class="w-6 h-6 text-brand-600"></i> Tra cứu nhanh 10 Hành Vi
                    </h2>
                    <div id="home-behavior-grid" class="grid grid-cols-1 sm:grid-cols-2 gap-4 anim d2">
                        <!-- Generated by JS -->
                    </div>
                </div>

                <!-- ─────────────────────────────────────────
                     VIEW: FUNDAMENTALS
                ───────────────────────────────────────── -->
                <div id="view-fundamentals" class="view">
                    <div class="mb-8 anim">
                        <h2 class="text-3xl font-extrabold text-slate-900 mb-4">Kiến Thức Nền Tảng</h2>
                        <p class="text-lg text-slate-600 leading-relaxed">Những nguyên tắc cốt lõi mọi cha mẹ cần biết trước khi cố gắng thay đổi hành vi của con.</p>
                    </div>

                    <!-- What is stimming? -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 mb-6 anim d1">
                        <h3 class="text-2xl font-bold flex items-center gap-2 mb-4 text-slate-800">
                            <i data-lucide="info" class="w-6 h-6 text-brand-500"></i>
                            Hành vi tự kích thích (Stimming) là gì?
                        </h3>
                        <p class="text-slate-600 leading-relaxed">Là những hành vi lặp đi lặp lại mà trẻ thực hiện để tạo ra một cảm giác quen thuộc, dễ chịu hoặc giúp bản thân tự điều chỉnh tốt hơn. Nó không chỉ có ở trẻ tự kỷ. Người lớn chúng ta cũng rung chân, gõ bút, hay lẩm bẩm khi lo lắng.</p>
                        <p class="font-medium mt-4 p-4 bg-brand-50 text-brand-800 rounded-lg border-l-4 border-brand-500">
                            Lưu ý: Một hành vi có thể có nhiều chức năng cùng lúc, và ý nghĩa của nó ở mỗi trẻ có thể hoàn toàn khác nhau.
                        </p>
                    </div>

                    <!-- 3-step observation rule -->
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-slate-200 mb-6 anim d2">
                        <h3 class="text-2xl font-bold mb-6 text-slate-800">Quy tắc quan sát 3 thời điểm</h3>
                        <div class="space-y-6">
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center font-bold text-slate-500 shrink-0 text-lg">1</div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-800">Trước hành vi</h4>
                                    <p class="text-sm mt-1 text-slate-600">Điều gì vừa xảy ra? Con phải chờ đợi, bị từ chối, tiếng ồn lớn hay phải chuyển môi trường?</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full bg-brand-100 flex items-center justify-center font-bold text-brand-600 shrink-0 text-lg">2</div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-800">Trong khi hành vi diễn ra</h4>
                                    <p class="text-sm mt-1 text-slate-600">Trạng thái của con ra sao? Vui, căng thẳng, bồn chồn hay đang tách dần khỏi thực tại? Cường độ mạnh hay nhẹ?</p>
                                </div>
                            </div>
                            <div class="flex gap-4">
                                <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center font-bold text-green-600 shrink-0 text-lg">3</div>
                                <div>
                                    <h4 class="font-bold text-lg text-slate-800">Sau hành vi</h4>
                                    <p class="text-sm mt-1 text-slate-600">Con có dịu hơn, tập trung hơn không? Hay con ngày càng kích động và mất kiểm soát?</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- When to seek help? -->
                    <div class="bg-red-50 p-8 rounded-2xl border border-red-100 mb-6 anim d3">
                        <h3 class="text-2xl font-bold flex items-center gap-2 mb-4 text-red-800">
                            <i data-lucide="shield-alert" class="w-6 h-6"></i>
                            Khi nào cần lưu ý và can thiệp chuyên môn?
                        </h3>
                        <ul class="list-disc pl-5 space-y-2 text-red-900">
                            <li>Khiến trẻ tự làm đau bản thân (cào cấu, cắn chảy máu).</li>
                            <li>Gây nguy hiểm cho trẻ hoặc người xung quanh.</li>
                            <li>Xuất hiện với cường độ mạnh, kéo dài, cản trở việc ăn, ngủ, học tập.</li>
                            <li>Tăng rõ rệt theo thời gian đi kèm sự mất kiểm soát.</li>
                        </ul>
                        <p class="mt-4 text-sm text-red-700 italic">* Nếu hành vi an toàn và không cản trở sinh hoạt, trước hết cha mẹ nên quan sát và chấp nhận thay vì ép dừng đột ngột.</p>
                    </div>
                </div>

                <!-- ─────────────────────────────────────────
                     VIEW: BEHAVIOR DETAIL
                ───────────────────────────────────────── -->
                <div id="view-behavior" class="view">
                    <!-- Breadcrumb -->
                    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
                        <button onclick="navigate('home')" class="hover:text-brand-600">Trang chủ</button>
                        <span>/</span>
                        <span id="detail-breadcrumb" class="text-slate-800 font-medium"></span>
                    </div>

                    <div class="flex flex-col xl:flex-row gap-8 items-start">
                        <!-- Article -->
                        <article class="flex-1 min-w-0">
                            <div class="flex items-center gap-4 mb-6">
                                <div class="p-4 bg-brand-100 text-brand-600 rounded-2xl" id="detail-icon-wrap">
                                    <i id="detail-icon" class="w-9 h-9"></i>
                                </div>
                                <div>
                                    <h2 id="detail-title" class="text-3xl md:text-4xl font-extrabold text-slate-900"></h2>
                                    <p id="detail-category" class="text-brand-600 font-medium mt-1"></p>
                                </div>
                            </div>

                            <!-- Definition -->
                            <div id="detail-definition"
                                 class="text-lg leading-relaxed mb-8 bg-white p-6 rounded-2xl border border-slate-200 shadow-sm text-slate-700"></div>

                            <!-- Manifestations -->
                            <h3 class="text-2xl font-bold text-slate-800 mb-4 border-b pb-2">Biểu hiện thường gặp</h3>
                            <ul id="detail-manifestations" class="space-y-3 mb-8 bg-slate-50 p-6 rounded-xl"></ul>

                            <!-- Reasons -->
                            <h3 class="text-2xl font-bold text-slate-800 mb-4 border-b pb-2">Tại sao con làm vậy?</h3>
                            <p class="mb-4 text-slate-600">Hệ thần kinh của trẻ tự kỷ xử lý thông tin giác quan theo cách khác biệt. Trẻ tìm đến hành vi này chủ yếu để:</p>
                            <ul id="detail-reasons" class="space-y-3 mb-8 bg-brand-50 p-6 rounded-xl text-brand-900"></ul>

                            <!-- Dos and Don'ts -->
                            <h3 class="text-2xl font-bold text-slate-800 mb-4 border-b pb-2">Hướng dẫn cha mẹ</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                                <div class="bg-white p-6 rounded-xl border border-green-200 shadow-sm">
                                    <h4 class="font-bold text-green-700 mb-4 flex items-center gap-2">
                                        <i data-lucide="check-circle-2" class="w-5 h-5"></i> Nên làm
                                    </h4>
                                    <ul id="detail-dos" class="space-y-3"></ul>
                                </div>
                                <div class="bg-white p-6 rounded-xl border border-red-200 shadow-sm">
                                    <h4 class="font-bold text-red-700 mb-4 flex items-center gap-2">
                                        <i data-lucide="x-circle" class="w-5 h-5"></i> Không nên
                                    </h4>
                                    <ul id="detail-donts" class="space-y-3"></ul>
                                </div>
                            </div>
                        </article>

                        <!-- Infobox sidebar -->
                        <aside class="w-full xl:w-80 shrink-0">
                            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-6">
                                <div class="bg-slate-800 text-white p-4 font-bold text-center uppercase tracking-wider text-sm">
                                    Tóm tắt nhanh
                                </div>
                                <div class="p-5 space-y-4">
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase font-semibold">Nhóm giác quan</span>
                                        <p id="info-category" class="font-medium text-slate-800 mt-1"></p>
                                    </div>
                                    <hr class="border-slate-100">
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase font-semibold">Thông điệp chính</span>
                                        <p id="info-core-purpose" class="font-medium text-slate-800 text-sm leading-relaxed mt-1"></p>
                                    </div>
                                    <hr class="border-slate-100">
                                    <div>
                                        <span class="text-xs text-slate-500 uppercase font-semibold">Mức độ an toàn</span>
                                        <div id="info-danger" class="mt-2"></div>
                                    </div>
                                </div>
                                <div class="bg-slate-50 p-4 border-t border-slate-200">
                                    <p class="text-xs text-slate-500 text-center italic">Đừng hỏi "Làm sao để dừng", hãy hỏi "Hành vi giúp con điều gì?"</p>
                                </div>
                            </div>
                        </aside>
                    </div>
                </div>

            </div><!-- /max-w-4xl -->
        </main>
    </div><!-- /flex wrapper -->

    <!-- ═══════════════════════════════════════════════════════════
         SCRIPT: DATA + LOGIC
    ═══════════════════════════════════════════════════════════ -->
    <script>
    // ─── DATA ────────────────────────────────────────────────────
    const behaviorsData = [
        {
            id: 'van-dong',
            title: 'Hành vi Vận động',
            icon: 'activity',
            category: 'Vận động / Cơ thể',
            dangerLevel: 'Thường an toàn',
            corePurpose: 'Hành vi tự kích thích vận động không phải lúc nào cũng là vấn đề cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tự điều chỉnh cơ thể và cảm xúc trong một môi trường mà trẻ cảm thấy quá mạnh, quá khó đoán hoặc quá tải.',
            definition: 'Là những chuyển động cơ thể lặp đi lặp lại như vẫy tay, lắc người, nhảy lên nhảy xuống hay chạy qua chạy lại.',
            manifestations: [
                'Vẫy tay khi vui, hồi hộp hoặc chờ đợi',
                'Lắc người khi ngồi chơi',
                'Nhảy lên nhảy xuống khi phấn khích',
                'Chạy qua chạy lại nhiều lần',
                'Đi kiễng chân lặp đi lặp lại'
            ],
            reasons: [
                'Tự làm dịu khi căng thẳng hoặc quá tải',
                'Giải tỏa năng lượng khi quá phấn khích',
                'Tăng khả năng tập trung trong một số tình huống'
            ],
            dos: ['Tạo khoảng nghỉ vận động', 'Cho con không gian an toàn để nhảy/lắc', 'Quan sát bối cảnh để hiểu nguyên nhân'],
            donts: ['Ép con ngồi yên ngay lập tức', 'Quát mắng con là hiếu động', 'Cố giữ tay/chân con lại bằng vũ lực']
        },
        {
            id: 'am-thanh',
            title: 'Hành vi Âm thanh',
            icon: 'volume-2',
            category: 'Phát âm',
            dangerLevel: 'An toàn',
            corePurpose: 'Hành vi tự kích thích bằng âm thanh không phải lúc nào cũng là điều vô nghĩa hay cần loại bỏ ngay. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng làm dịu bản thân, tìm cảm giác phù hợp hoặc giữ cho mình ổn định hơn trong một môi trường nhiều áp lực.',
            definition: 'Là việc trẻ phát ra những âm thanh hoặc kiểu phát âm lặp đi lặp lại như ngâm nga, ê a, tạo tiếng ở cổ họng.',
            manifestations: [
                'Ngâm nga một giai điệu không rõ lời',
                'Lặp đi lặp lại một âm hoặc một từ',
                'Tạo tiếng ở cổ họng nhiều lần',
                'Lặp lại tiếng nghe được từ video, quảng cáo'
            ],
            reasons: [
                'Xây dựng "chiếc kén" an toàn lấn át sự hỗn loạn bên ngoài',
                'Tự làm dịu khi căng thẳng hoặc lo lắng',
                'Giải tỏa năng lượng khi vui vẻ'
            ],
            dos: ['Cho con khoảng nghỉ yên tĩnh', 'Lắng nghe xem âm thanh này mang ý nghĩa vui hay buồn', 'Cung cấp tai nghe chống ồn nếu môi trường quá tải'],
            donts: ['Bắt con "im lặng ngay"', 'Xem mọi âm thanh lặp lại là hành vi xấu']
        },
        {
            id: 'thi-giac',
            title: 'Hành vi Thị giác',
            icon: 'eye',
            category: 'Thị giác',
            dangerLevel: 'An toàn (Cần lưu ý nếu mất tập trung quá lâu)',
            corePurpose: 'Hành vi tự kích thích thị giác không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm lại cảm giác dễ chịu, quen thuộc và dễ kiểm soát hơn trong một môi trường quá nhiều thông tin.',
            definition: 'Là hành vi lặp đi lặp lại liên quan đến việc nhìn để tìm kiếm cảm giác dễ chịu, quen thuộc. Trẻ bị thu hút bởi ánh sáng, vật quay, bóng đổ.',
            manifestations: [
                'Nhìn chăm chú vào quạt quay, bánh xe',
                'Đưa tay, ngón tay ra trước mắt rồi nhìn rất lâu',
                'Thích nhìn ánh đèn, phản chiếu, ánh sáng qua khe cửa',
                'Dõi mắt theo chuyển động lặp lại (rèm bay, nước chảy)'
            ],
            reasons: [
                'Tìm sự dễ dự đoán, đều đặn để ổn định tâm trí',
                'Tạm tách mình khỏi một thế giới quá nhiều thông tin hỗn loạn',
                'Tự làm dịu khi căng thẳng'
            ],
            dos: ['Giảm bớt ánh sáng mạnh/đèn chớp nếu con quá tải', 'Sắp xếp không gian học tập gọn gàng, ít phân tán', 'Tạo thời gian riêng cho con thư giãn bằng thị giác'],
            donts: ['Giật mạnh đồ vật con đang nhìn', 'Quát mắng con là "vô hồn" hay "lơ đễnh"']
        },
        {
            id: 'xuc-giac',
            title: 'Hành vi Xúc giác',
            icon: 'hand',
            category: 'Da / Tiếp xúc',
            dangerLevel: 'Thường an toàn (Lưu ý nếu cọ đến trầy da)',
            corePurpose: 'Hành vi tự kích thích xúc giác không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm một cảm giác dễ chịu, quen thuộc và an toàn hơn cho cơ thể mình.',
            definition: 'Là những hành vi lặp đi lặp lại nhằm tìm kiếm cảm giác qua da bằng cách sờ, vuốt, miết, cọ xát vào các bề mặt, chất liệu.',
            manifestations: [
                'Thích sờ, vuốt mép chăn, gối, áo, tóc',
                'Hay cọ tay, cọ người vào tường, đồ vật',
                'Xoa hai bàn tay vào nhau liên tục',
                'Bóp, nắn, vê một món đồ nhỏ trong tay'
            ],
            reasons: [
                'Tìm kiếm sự an ủi như một "cái ôm vô hình"',
                'Cảm nhận ranh giới cơ thể rõ ràng hơn',
                'Duy trì sự ổn định khi môi trường quá khó chịu'
            ],
            dos: ['Cung cấp đồ vật mềm, an toàn (gối ôm, thú bông, đồ chơi squishy)', 'Điều chỉnh quần áo nếu con khó chịu với nhãn mác/chất vải'],
            donts: ['Giằng lấy chiếc chăn "ghiền" của con', 'Cấm đoán con sờ vào đồ vật an toàn']
        },
        {
            id: 'thinh-giac',
            title: 'Hành vi Thính giác',
            icon: 'headphones',
            category: 'Thính giác',
            dangerLevel: 'An toàn',
            corePurpose: 'Hành vi tự kích thích thính giác không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm một âm thanh quen thuộc để làm dịu bản thân, ổn định cảm xúc và dễ chịu hơn trong một môi trường nhiều áp lực.',
            definition: 'Là hành vi tìm kiếm hoặc lặp lại trải nghiệm nghe. Trẻ chủ động tìm đến một âm thanh và nghe đi nghe lại nhiều lần.',
            manifestations: [
                'Nghe đi nghe lại đúng một đoạn nhạc, một bài hát 5 giây',
                'Áp tai nghe tiếng quạt, máy giặt, máy sấy',
                'Yêu cầu mở lại cùng một âm thanh rất nhiều lần'
            ],
            reasons: [
                'Giảm bớt sự khó chịu do âm thanh hỗn loạn xung quanh',
                'Tạo cảm giác quen thuộc, an toàn, dễ dự đoán',
                'Giữ trạng thái ổn định, tập trung'
            ],
            dos: ['Trang bị tai nghe nhạc cho con', 'Tạo khoảng nghỉ yên tĩnh khi con ngợp', 'Hỗ trợ chuyển đổi sang hoạt động khác từ từ'],
            donts: ['Tắt nhạc/máy đột ngột khiến con hoảng sợ', 'Cho rằng con cố chấp hay có sở thích kỳ lạ']
        },
        {
            id: 'vi-giac-mieng',
            title: 'Hành vi Vị giác / Miệng',
            icon: 'coffee',
            category: 'Miệng / Vị giác',
            dangerLevel: 'Cần giám sát (Tránh nhai vật nguy hiểm)',
            corePurpose: 'Hành vi tự kích thích vị giác/miệng không phải lúc nào cũng là điều xấu cần loại bỏ ngay. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm một cảm giác quen thuộc, rõ ràng và dễ chịu hơn để làm dịu bản thân, ổn định cơ thể và bớt căng thẳng hơn.',
            definition: 'Là hành vi lặp đi lặp lại liên quan đến vùng miệng như nhai, cắn, liếm, ngậm đồ vật hoặc tìm kiếm vị/nhiệt độ mạnh.',
            manifestations: [
                'Nhai tay áo, cổ áo, khăn',
                'Cắn bút, đồ chơi, nắp chai',
                'Cho nhiều món không phải thức ăn vào miệng',
                'Thích đồ ăn có vị rất đậm (cay, chua, mặn) hoặc nóng/lạnh rõ rệt'
            ],
            reasons: [
                'Vùng miệng có nhiều dây thần kinh, giúp giải tỏa bồn chồn hiệu quả',
                'Tự làm dịu khi phải chờ đợi hoặc căng thẳng',
                'Cảm nhận cơ thể rõ rệt hơn'
            ],
            dos: ['Mua đồ gặm/vòng nhai y tế an toàn (Chewelry)', 'Loại bỏ các vật nhỏ, độc hại khỏi tầm tay', 'Cung cấp đồ ăn giòn, dai để đáp ứng nhu cầu nhai'],
            donts: ['Đánh vào tay/miệng con', 'Ép con nhả ra bằng vũ lực khiến con hoảng']
        },
        {
            id: 'khuu-giac',
            title: 'Hành vi Khứu giác',
            icon: 'wind',
            category: 'Khứu giác',
            dangerLevel: 'Cần giám sát (Tránh ngửi hóa chất)',
            corePurpose: 'Hành vi tự kích thích khứu giác không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm một cảm giác quen thuộc, dễ chịu và an toàn hơn cho bản thân trong những lúc khó chịu hoặc quá tải.',
            definition: 'Là hành vi lặp đi lặp lại nhằm tìm kiếm cảm giác qua mùi, bằng cách ngửi đồ vật, quần áo, thức ăn.',
            manifestations: [
                'Hay đưa đồ vật lên mũi ngửi nhiều lần',
                'Ngửi tay, ngửi tóc, ngửi áo người thân',
                'Ngửi thức ăn rất kỹ trước khi ăn',
                'Bị thu hút bởi một mùi quen thuộc'
            ],
            reasons: [
                'Mùi hương là mỏ neo cảm xúc giúp con thấy an toàn ở môi trường lạ',
                'Tự làm dịu hệ thần kinh đang chao đảo',
                'Giúp cơ thể ổn định trước sự thay đổi'
            ],
            dos: ['Cho phép con mang theo một chiếc khăn/áo có mùi quen thuộc khi đến nơi mới', 'Đảm bảo môi trường không có hóa chất độc hại'],
            donts: ['Xấu hổ vì con hay ngửi', 'Giật mạnh đồ vật ra khỏi mũi con']
        },
        {
            id: 'ban-the',
            title: 'Hành vi Cảm giác bản thể',
            icon: 'shield-alert',
            category: 'Cơ khớp / Áp lực',
            dangerLevel: 'Cần giám sát (Tránh va chạm chấn thương)',
            corePurpose: 'Hành vi tự kích thích cảm giác bản thể không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng cảm nhận cơ thể mình rõ hơn, ổn định hơn và dễ chịu hơn trong một môi trường nhiều áp lực.',
            definition: 'Là những hành vi giúp trẻ tìm cảm giác từ cơ, khớp và áp lực lên cơ thể. Trẻ tạo ra lực ép, lực kéo, đẩy hoặc va chạm mạnh.',
            manifestations: [
                'Thích ôm siết mạnh, đè người vào gối/nệm',
                'Chui vào các khe hẹp (khe tủ, dưới gầm bàn)',
                'Thích đẩy, kéo đồ vật nặng',
                'Lao người, nhảy mạnh xuống sàn'
            ],
            reasons: [
                'Giúp não bộ xác nhận ranh giới cơ thể ("Mình đang ở đây, mình an toàn")',
                'Điều chỉnh mức độ tỉnh táo và sự tập trung',
                'Giải tỏa năng lượng dư thừa'
            ],
            dos: ['Chơi các trò đẩy/kéo nặng (chơi kéo co, đẩy bóng yoga)', 'Cho con ôm chăn trọng lượng (weighted blanket)', 'Ôm siết con thật chặt nếu con yêu cầu'],
            donts: ['Mắng con là bạo lực hay phá phách', 'Cấm đoán con vận động mạnh mà không có giải pháp thay thế']
        },
        {
            id: 'tien-dinh',
            title: 'Hành vi Tiền đình',
            icon: 'rotate-ccw',
            category: 'Thăng bằng / Chuyển động',
            dangerLevel: 'Cần giám sát (Tránh té ngã)',
            corePurpose: 'Hành vi tự kích thích tiền đình không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng điều chỉnh mức độ tỉnh táo, cảm nhận cơ thể rõ hơn và tìm lại trạng thái dễ chịu hơn cho bản thân.',
            definition: 'Là hành vi tìm kiếm cảm giác liên quan đến chuyển động và vị trí cơ thể trong không gian (xoay, lắc, đung đưa, leo trèo).',
            manifestations: [
                'Thích xoay vòng liên tục mà không chóng mặt',
                'Đung đưa người khi ngồi hoặc đứng',
                'Chạy nhảy, leo trèo liên tục không biết mệt',
                'Thích các trò chơi quay, nhún mạnh'
            ],
            reasons: [
                'Đánh thức một hệ thần kinh đang uể oải',
                'Hoặc ngược lại: Tự ru ngủ, làm dịu tâm trí đang lo âu',
                'Tìm kiếm cảm giác chuyển động để cơ thể cân bằng'
            ],
            dos: ['Đưa con ra công viên chơi xích đu, cầu trượt', 'Sắm bạt nhún (trampoline) nhỏ trong nhà', 'Đảm bảo không gian an toàn, không có góc nhọn'],
            donts: ['Nhốt con lại trong không gian hẹp', 'Bắt con ngồi yên quá lâu trong các môi trường căng thẳng']
        },
        {
            id: 'do-vat',
            title: 'Hành vi với Đồ vật',
            icon: 'box',
            category: 'Tương tác / Chơi',
            dangerLevel: 'An toàn',
            corePurpose: 'Hành vi tự kích thích với đồ vật không phải lúc nào cũng là điều bất thường cần loại bỏ. Trong nhiều trường hợp, đó là cách trẻ đang cố gắng tìm cảm giác quen thuộc, dễ chịu và có thể kiểm soát được trong một môi trường quá nhiều thay đổi.',
            definition: 'Là việc tương tác với đồ vật theo một cách nhất định lặp đi lặp lại thay vì dùng theo công năng thông thường.',
            manifestations: [
                'Xếp đồ chơi, bút, ô tô thành một đường thẳng tắp',
                'Lật ngửa ô tô để xoay bánh xe',
                'Đóng mở nắp hộp, công tắc, cửa nhiều lần',
                'Chỉ chú ý một chi tiết nhỏ của món đồ'
            ],
            reasons: [
                'Sự lặp lại mang lại cảm giác có thể kiểm soát và dễ dự đoán',
                'Thiết lập trật tự cho tâm trí giữa thế giới khó lường',
                'Tự làm dịu thông qua một tác vụ quen thuộc'
            ],
            dos: ['Tôn trọng cách chơi của con', 'Chơi cùng con theo cách của con rồi từ từ mở rộng cách chơi', 'Cho con không gian riêng'],
            donts: ['Phá vỡ hàng đồ chơi con vừa xếp', 'Ép con phải chơi "đúng cách" của người lớn']
        }
    ];

    // ─── STATE ───────────────────────────────────────────────────
    let currentView = 'home';
    let currentBehavior = null;

    // ─── SIDEBAR ─────────────────────────────────────────────────
    function openSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        sidebar.classList.remove('-translate-x-full');
        overlay.classList.remove('hidden');
        setTimeout(() => overlay.classList.replace('opacity-0', 'opacity-100'), 10);
    }
    function closeSidebar() {
        const sidebar  = document.getElementById('sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        sidebar.classList.add('-translate-x-full');
        overlay.classList.replace('opacity-100', 'opacity-0');
        setTimeout(() => overlay.classList.add('hidden'), 300);
    }

    // ─── NAVIGATION ──────────────────────────────────────────────
    function navigate(view, behavior = null) {
        // Hide all views
        document.querySelectorAll('.view').forEach(v => v.classList.remove('active'));
        document.getElementById('view-' + view).classList.add('active');

        // Update nav highlights
        document.querySelectorAll('.nav-btn').forEach(b => b.classList.remove('active'));
        const navBtn = document.getElementById('nav-' + view);
        if (navBtn) navBtn.classList.add('active');

        document.querySelectorAll('.behavior-btn').forEach(b => b.classList.remove('active'));
        if (behavior) {
            const bBtn = document.getElementById('bnavbtn-' + behavior.id);
            if (bBtn) bBtn.classList.add('active');
        }

        currentView = view;
        currentBehavior = behavior;

        if (view === 'behavior' && behavior) renderBehaviorDetail(behavior);

        closeSidebar();
        window.scrollTo(0, 0);
    }

    // ─── SEARCH ──────────────────────────────────────────────────
    function handleSearch(query) {
        const q = query.toLowerCase().trim();
        const noResults = document.getElementById('no-results');
        const buttons = document.querySelectorAll('.behavior-btn');

        let visible = 0;
        buttons.forEach(btn => {
            const id = btn.dataset.id;
            const b = behaviorsData.find(x => x.id === id);
            const match = !q ||
                b.title.toLowerCase().includes(q) ||
                b.manifestations.some(m => m.toLowerCase().includes(q));
            btn.style.display = match ? '' : 'none';
            if (match) visible++;
        });

        noResults.classList.toggle('hidden', visible > 0);
    }

    // ─── RENDER SIDEBAR NAV LIST ──────────────────────────────────
    function renderBehaviorNav() {
        const list = document.getElementById('behavior-nav-list');
        list.innerHTML = behaviorsData.map(b => `
            <button class="behavior-btn" id="bnavbtn-${b.id}" data-id="${b.id}"
                    onclick="navigate('behavior', behaviorsData.find(x => x.id === '${b.id}'))">
                <i data-lucide="${b.icon}" class="w-4 h-4 shrink-0"></i>
                <span style="white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">${b.title}</span>
            </button>
        `).join('');
    }

    // ─── RENDER HOME GRID ─────────────────────────────────────────
    function renderHomeGrid() {
        const grid = document.getElementById('home-behavior-grid');
        grid.innerHTML = behaviorsData.map(b => `
            <button onclick="navigate('behavior', behaviorsData.find(x => x.id === '${b.id}'))"
                    class="flex items-start gap-4 p-4 rounded-xl bg-white border border-slate-200
                           hover:border-brand-400 hover:shadow-sm transition-all text-left group card-hover">
                <div class="p-3 rounded-lg bg-brand-50 text-brand-600 group-hover:bg-brand-600 group-hover:text-white transition-colors shrink-0">
                    <i data-lucide="${b.icon}" class="w-6 h-6"></i>
                </div>
                <div>
                    <h4 class="font-bold text-slate-800 group-hover:text-brand-700">${b.title}</h4>
                    <p class="text-xs text-slate-500 mt-1 line-clamp-2">${b.category}</p>
                </div>
            </button>
        `).join('');
    }

    // ─── RENDER BEHAVIOR DETAIL ───────────────────────────────────
    function renderBehaviorDetail(b) {
        document.getElementById('detail-breadcrumb').textContent = b.title;
        document.getElementById('detail-title').textContent = b.title;
        document.getElementById('detail-category').textContent = b.category;
        document.getElementById('detail-icon').setAttribute('data-lucide', b.icon);
        document.getElementById('detail-definition').innerHTML = `<strong>Định nghĩa: </strong>${b.definition}`;
        document.getElementById('info-category').textContent = b.category;
        document.getElementById('info-core-purpose').textContent = b.corePurpose;

        // Manifestations
        document.getElementById('detail-manifestations').innerHTML = b.manifestations.map(item => `
            <li class="flex items-start gap-3">
                <div class="w-1.5 h-1.5 rounded-full bg-brand-500 mt-2.5 shrink-0"></div>
                <span class="text-slate-700">${item}</span>
            </li>
        `).join('');

        // Reasons
        document.getElementById('detail-reasons').innerHTML = b.reasons.map(item => `
            <li class="flex items-start gap-3">
                <i data-lucide="check-circle-2" class="w-5 h-5 text-brand-500 shrink-0 mt-0.5"></i>
                <span class="font-medium">${item}</span>
            </li>
        `).join('');

        // Dos
        document.getElementById('detail-dos').innerHTML = b.dos.map(item => `
            <li class="flex items-start gap-2 text-sm text-slate-700">
                <span class="text-green-500 font-bold">•</span> ${item}
            </li>
        `).join('');

        // Don'ts
        document.getElementById('detail-donts').innerHTML = b.donts.map(item => `
            <li class="flex items-start gap-2 text-sm text-slate-700">
                <span class="text-red-500 font-bold">•</span> ${item}
            </li>
        `).join('');

        // Danger badge
        const danger = b.dangerLevel;
        let cls = 'bg-green-100 text-green-700';
        let icon = 'check-circle-2';
        if (danger.includes('giám sát')) { cls = 'bg-amber-100 text-amber-700'; icon = 'shield-alert'; }
        else if (danger.includes('Cần lưu ý')) { cls = 'bg-amber-100 text-amber-700'; icon = 'shield-alert'; }
        document.getElementById('info-danger').innerHTML = `
            <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-sm font-medium ${cls}">
                <i data-lucide="${icon}" class="w-3.5 h-3.5"></i>
                ${danger}
            </div>
        `;

        // Re-initialize lucide icons for dynamically added elements
        lucide.createIcons();
    }

    // ─── INIT ─────────────────────────────────────────────────────
    document.addEventListener('DOMContentLoaded', function() {
        renderBehaviorNav();
        renderHomeGrid();

        // Init Lucide icons
        lucide.createIcons();

        // Scroll-reveal animations
        const io = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) {
                    e.target.style.animationPlayState = 'running';
                    io.unobserve(e.target);
                }
            });
        }, { threshold: 0.08 });

        document.querySelectorAll('.anim').forEach(el => {
            el.style.animationPlayState = 'paused';
            io.observe(el);
        });
    });
    </script>

        </main><!-- /main scrollable -->
    </div><!-- /right column -->
    </div><!-- /app wrapper -->

<?php wp_footer(); ?>
</body>
</html>