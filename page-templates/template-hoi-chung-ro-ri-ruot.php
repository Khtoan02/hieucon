<?php
/**
 * Template Name: Trang Hội chứng rò rỉ ruột
 * 
 * @package Hieucon
 */
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hội chứng "rò rỉ ruột" (Leaky Gut) - Tương tác y sinh học</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tailwind Config & Custom CSS -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        warm: {
                            50: '#fafaf9',
                            100: '#f5f5f4',
                            200: '#e7e5e4',
                            300: '#d6d3d1',
                            800: '#292524',
                            900: '#1c1917',
                        },
                        heal: {
                            light: '#d1fae5', // emerald-100
                            DEFAULT: '#10b981', // emerald-500
                            dark: '#047857', // emerald-700
                        },
                        alert: {
                            light: '#fee2e2', // red-100
                            DEFAULT: '#ef4444', // red-500
                        }
                    },
                    fontFamily: {
                        sans: ['Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>

    <style>
        /* CSS Customization & Chart Container Rules */
        body {
            background-color: #fafaf9;
            /* warm-50 */
            color: #292524;
            /* warm-800 */
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 800px;
            /* Constrain max width for readability */
            margin-left: auto;
            margin-right: auto;
            height: 50vh;
            /* Responsive height */
            max-height: 400px;
            /* Prevent over-expanding vertically */
        }

        @media (max-width: 640px) {
            .chart-container {
                height: 40vh;
                max-height: 300px;
            }
        }

        /* Abstract HTML Diagram Styles */
        .gut-cell {
            width: 40px;
            height: 80px;
            background-color: #fca5a5;
            /* rose-300 */
            border-radius: 8px;
            transition: all 0.5s ease-in-out;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .tight-junction {
            width: 10px;
            height: 20px;
            background-color: #10b981;
            /* heal */
            transition: all 0.5s ease-in-out;
        }

        /* Interactive Card Hover */
        .solution-card {
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .solution-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        }

        .tab-btn.active {
            background-color: #292524;
            color: white;
        }

        /* Hide scrollbar for clean look */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f5f5f4;
        }

        ::-webkit-scrollbar-thumb {
            background: #d6d3d1;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #a8a29e;
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="antialiased font-sans">

    <!-- Chosen Palette: Warm Neutrals (Stone/Warm) for background/text, Emerald (Heal) for positive actions/healthy states, Red (Alert) for inflammation/leaks. -->

    <!-- Application Structure Plan: 
         1. Hero Section: Sets the tone, introduces the "behavior vs biology" paradigm.
         2. Interactive Mechanism (Step-by-step): Uses a custom HTML diagram and tabs to explain the complex biological process (Normal -> Zonulin -> Leaky) visually without overwhelming the user with text.
         3. Quantitative/Consequence Chart: Translates abstract consequences (Neuroinflammation, ATP loss) into a comparative Bar Chart to visually strike the impact of the condition.
         4. Solutions Grid: Clickable cards for nutritional interventions, encouraging exploration of the "cures".
         5. Footer: Disclaimers and support links. 
         *Reasoning*: This linear yet interactive flow guides the user from understanding the problem conceptually, visualizing its impact, and finally exploring actionable solutions, making dense medical text highly consumable. -->

    <!-- Visualization & Content Choices: 
         - Intro: Text block with bold accents -> Goal: Shift mindset.
         - Gut Mechanism: Interactive HTML/CSS cell diagram + JS Tabs -> Goal: Explain Zonulin & Tight Junctions dynamically. Justification: Better than static text; NO SVG used, pure DOM manipulation.
         - Biochemical Impact: Chart.js Bar Chart -> Goal: Compare Healthy vs Leaky state metrics (ATP, Inflammation). Justification: Makes abstract metabolic consequences visible and measurable.
         - Solutions: Interactive Grid Cards -> Goal: Organize dietary fixes. Justification: Chunking information makes it easier to digest. -->

    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

    <!-- Header / Nav -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <div class="text-xl font-bold text-warm-900 tracking-tight">Hiểu con từ Gốc</div>
            <nav class="hidden md:flex space-x-6 text-sm font-medium text-warm-800">
                <a href="#co-che" class="hover:text-heal">Cơ chế</a>
                <a href="#hau-qua" class="hover:text-alert">Hậu quả</a>
                <a href="#giai-phap" class="hover:text-heal">Giải pháp</a>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto px-4 py-8 space-y-20">

        <!-- 1. Hero Section -->
        <section class="text-center max-w-4xl mx-auto pt-10 pb-8">
            <span class="text-heal-dark font-semibold tracking-wider uppercase text-sm">HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI
                LOẠN TOÀN THÂN</span>
            <h1 class="text-4xl md:text-5xl font-extrabold text-warm-900 mt-4 mb-6 leading-tight">
                Hội chứng "rò rỉ ruột" (Leaky Gut)<br>Kẻ thù thầm lặng đằng sau hành vi
            </h1>
            <p class="text-lg text-warm-800 leading-relaxed mb-8">
                Thuật ngữ "Tự kỷ" hay các rối loạn hành vi thực chất chỉ là một nhãn mác bề ngoài, giống hệt như triệu
                chứng <strong>"bị sốt"</strong>. Đằng sau những hành vi bùng nổ hay thu mình, ẩn chứa những tổn thương
                sâu sắc từ bên trong. Một trong những tổn thương tàn phá nhất chính là sự sụp đổ của hàng rào niêm mạc
                ruột.
            </p>
            <div class="inline-block bg-warm-100 p-4 rounded-lg border-l-4 border-heal-dark text-left">
                <p class="text-sm italic text-warm-900">
                    "Các con đang đau đớn, đang bị tổn thương từ bên trong, nhưng lại bị giam cầm trong một cơ thể không
                    thể lên tiếng."
                </p>
            </div>
        </section>

        <!-- 2. Interactive Mechanism Section -->
        <section id="co-che" class="bg-white rounded-2xl shadow-sm border border-warm-200 p-6 md:p-10">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-warm-900 mb-4">Hàng rào an ninh & sự sụp đổ</h2>
                <p class="text-warm-800">
                    Đường ruột được bảo vệ bởi một lớp niêm mạc cực kỳ mỏng manh (chỉ dày 1 lớp tế bào). Khám phá cơ chế
                    các "liên kết chặt" bị phá vỡ thông qua mô hình tương tác dưới đây:
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 items-center">
                <!-- Interactive Controls -->
                <div class="space-y-4">
                    <button onclick="updateMechanism(0)" id="btn-step-0"
                        class="tab-btn active w-full text-left px-6 py-4 rounded-xl border border-warm-200 hover:bg-warm-100 transition duration-200 focus:outline-none">
                        <div class="font-bold text-lg mb-1">1. Hàng rào khỏe mạnh</div>
                        <div class="text-sm opacity-80">Các "liên kết chặt" khóa kín, chỉ cho dưỡng chất đi qua.</div>
                    </button>
                    <button onclick="updateMechanism(1)" id="btn-step-1"
                        class="tab-btn w-full text-left px-6 py-4 rounded-xl border border-warm-200 hover:bg-warm-100 transition duration-200 focus:outline-none">
                        <div class="font-bold text-lg mb-1">2. Sự phản bội của Zonulin</div>
                        <div class="text-sm opacity-80">Loạn khuẩn sinh ra Protein Zonulin, hoạt động như "chìa khóa" mở
                            chốt.</div>
                    </button>
                    <button onclick="updateMechanism(2)" id="btn-step-2"
                        class="tab-btn w-full text-left px-6 py-4 rounded-xl border border-warm-200 hover:bg-warm-100 transition duration-200 focus:outline-none">
                        <div class="font-bold text-lg mb-1">3. Rò rỉ ruột (Leaky Gut)</div>
                        <div class="text-sm opacity-80">Liên kết bung ra, độc tố và thức ăn ồ ạt tràn vào máu.</div>
                    </button>
                </div>

                <!-- Abstract HTML Diagram -->
                <div
                    class="bg-warm-50 p-8 rounded-xl border border-warm-200 h-80 flex flex-col justify-center relative overflow-hidden">

                    <div id="diagram-blood"
                        class="absolute top-0 left-0 w-full h-1/4 bg-red-50 flex justify-center items-end pb-2 font-semibold text-alert opacity-50 transition-opacity duration-500">
                        Dòng máu (mạch máu)
                    </div>

                    <div class="relative z-10 flex justify-center items-center h-32 mt-8" id="gut-barrier">
                        <!-- Rendered by JS -->
                    </div>

                    <div id="diagram-gut"
                        class="absolute bottom-0 left-0 w-full h-1/3 bg-amber-50 flex justify-center items-start pt-4 font-semibold text-amber-700 opacity-50">
                        Lòng ruột (thức ăn, vi khuẩn)
                    </div>

                    <!-- Floating Particles (Toxins/Nutrients) -->
                    <div id="particles-container" class="absolute inset-0 pointer-events-none"></div>
                </div>
            </div>

            <div id="mechanism-text" class="mt-8 p-5 bg-warm-50 rounded-lg text-warm-800 border-l-4 border-heal">
                <!-- Dynamic Text -->
            </div>
        </section>

        <!-- 3. Consequences - Quantitative Chart Section -->
        <section id="hau-qua" class="space-y-8">
            <div class="text-center max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-warm-900 mb-4">Cơn bão sinh hóa: Hậu quả của sự rò rỉ</h2>
                <p class="text-warm-800">
                    Khi rào cản sụp đổ, một loạt các phản ứng dây chuyền xảy ra. Biểu đồ dưới đây mô phỏng sự biến đổi
                    của các chỉ số sinh hóa khi chuyển từ trạng thái ruột bình thường sang trạng thái rò rỉ.
                </p>
            </div>

            <div class="bg-white p-6 rounded-2xl shadow-sm border border-warm-200">
                <!-- Chart Container Constraint -->
                <div class="chart-container">
                    <canvas id="impactChart"></canvas>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="p-4 bg-alert-light rounded-lg">
                        <h4 class="font-bold text-alert mb-2">🔥 Bão viêm thần kinh</h4>
                        <p class="text-sm text-warm-900">Hệ miễn dịch tấn công tạo ra bão Cytokine lan lên não, kích
                            hoạt trạng thái "chiến đấu hay bỏ chạy" gây hoảng loạn, cáu gắt.</p>
                    </div>
                    <div class="p-4 bg-purple-100 rounded-lg">
                        <h4 class="font-bold text-purple-700 mb-2">☠️ Cơn "say rượu" độc tính</h4>
                        <p class="text-sm text-warm-900">Độc tố nội sinh (p-cresol, Acetaldehyde) nhiễu loạn thần kinh.
                            Trẻ lờ đờ, mất nhận thức như bị đầu độc từ bên trong.</p>
                    </div>
                    <div class="p-4 bg-yellow-100 rounded-lg">
                        <h4 class="font-bold text-yellow-700 mb-2">🔋 Kiệt quệ năng lượng (ATP)</h4>
                        <p class="text-sm text-warm-900">Viêm nhiễm vắt kiệt tế bào. Ty thể lỗi nhịp. Trẻ thiếu năng
                            lượng học hỏi giống như xe tải chạy khi bình xăng cạn.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- 4. Solutions Section -->
        <section id="giai-phap" class="mb-12">
            <div class="mb-10 text-center">
                <h2 class="text-3xl font-bold text-warm-900 mb-4">Những "viên gạch vàng" vá lại màng ruột</h2>
                <p class="text-warm-800 max-w-3xl mx-auto">
                    Thay vì "nhổ cỏ dại" bằng kháng sinh bạo lực, y sinh hiện đại tập trung vào việc phục hồi hệ vi sinh
                    và cung cấp nguyên liệu để cơ thể tự xây lại các liên kết chặt. Nhấp vào các giải pháp dưới đây để
                    tìm hiểu.
                </p>
            </div>

            <!-- Interactive Brick Explorer -->
            <div class="flex flex-col lg:flex-row gap-6 items-stretch">
                <!-- Selectors -->
                <div class="lg:w-1/3 flex flex-col gap-3">
                    <button onclick="selectBrick(0)" id="brick-btn-0"
                        class="brick-btn w-full text-left px-5 py-4 rounded-xl border-2 transition-all duration-300 focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="text-3xl bg-white p-2 rounded-lg shadow-sm">🍲</div>
                            <span class="font-bold text-lg">Nước hầm xương</span>
                        </div>
                    </button>
                    <button onclick="selectBrick(1)" id="brick-btn-1"
                        class="brick-btn w-full text-left px-5 py-4 rounded-xl border-2 transition-all duration-300 focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="text-3xl bg-white p-2 rounded-lg shadow-sm">🛡️</div>
                            <span class="font-bold text-lg">Kẽm Carnosine</span>
                        </div>
                    </button>
                    <button onclick="selectBrick(2)" id="brick-btn-2"
                        class="brick-btn w-full text-left px-5 py-4 rounded-xl border-2 transition-all duration-300 focus:outline-none">
                        <div class="flex items-center gap-4">
                            <div class="text-3xl bg-white p-2 rounded-lg shadow-sm">🌈</div>
                            <span class="font-bold text-lg">Chống oxy hóa</span>
                        </div>
                    </button>
                </div>

                <!-- Content Display -->
                <div class="lg:w-2/3 rounded-2xl shadow-md border border-warm-200 p-6 md:p-8 relative overflow-hidden flex flex-col justify-center min-h-[350px] transition-colors duration-500"
                    id="brick-display-bg">
                    <!-- Absolute decorative icon -->
                    <div id="brick-bg-icon"
                        class="absolute -right-10 -bottom-10 text-9xl opacity-10 transition-transform duration-500 transform scale-100 pointer-events-none">
                        🍲</div>

                    <div class="relative z-10" id="brick-content">
                        <!-- Dynamic content injected here -->
                    </div>
                </div>
            </div>

            <!-- Golden Rule with Slider -->
            <div class="mt-12 bg-warm-900 text-white p-6 md:p-10 rounded-2xl relative overflow-hidden shadow-lg">
                <!-- decorative background -->
                <div class="absolute inset-0 opacity-20 pointer-events-none"
                    style="background-image: radial-gradient(#fbbf24 1px, transparent 1px); background-size: 20px 20px;">
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-3xl">⚠️</span>
                        <h4 class="text-2xl font-bold text-amber-400">Quy tắc thử nghiệm vi chất: "Chậm và ít"</h4>
                    </div>
                    <p class="text-warm-200 mb-8 leading-relaxed">
                        Đường ruột rò rỉ rất nhạy cảm. Việc cân nhắc tăng lượng L-Glutamine hay Kẽm cũng cần sự cẩn
                        trọng y hệt như việc bạn đắn đo <strong>nên uống nửa viên hay cả viên "thuốc giảm đau
                            aspirin"</strong> khi cơn đau đầu ập đến. <br><span class="text-heal-light">Thử kéo thanh
                            trượt dưới đây để xem nguyên lý áp dụng:</span>
                    </p>

                    <div class="bg-warm-800 p-6 rounded-xl border border-warm-700">
                        <div class="flex items-center gap-4 mb-2">
                            <span class="text-xs font-bold w-24 md:w-20 text-warm-400 uppercase tracking-wider">Liều
                                lượng:</span>
                            <input type="range" min="1" max="100" value="10"
                                class="w-full h-3 bg-warm-900 rounded-lg appearance-none cursor-pointer border border-warm-600 focus:outline-none"
                                id="dosageSlider" oninput="updateDosageInfo(this.value)">
                        </div>
                        <div class="flex justify-between text-xs text-warm-500 pl-28 pr-2 md:px-24 mb-6">
                            <span>Rất ít</span>
                            <span>Trung bình</span>
                            <span>Nhiều (Nóng vội)</span>
                        </div>

                        <div class="p-4 rounded-lg flex flex-col md:flex-row items-start gap-4 transition-colors duration-300"
                            id="dosageResultBox">
                            <div class="text-3xl md:text-4xl" id="dosageIcon">✅</div>
                            <div>
                                <h5 class="font-bold text-lg mb-1" id="dosageTitle">Lý tưởng để bắt đầu</h5>
                                <p class="text-sm md:text-base text-warm-200" id="dosageDesc">Cơ thể có đủ thời gian
                                    sinh lý để làm quen, hấp thu dưỡng chất để từ từ tự xây lại các liên kết chặt phục
                                    hồi màng ruột.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer / Resources -->
    <footer class="bg-warm-900 text-warm-200 py-10 mt-12">
        <div class="max-w-6xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div>
                <h3 class="text-xl font-bold text-white mb-4">Cùng bạn hiểu con</h3>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center">
                        <span class="mr-2">🌐</span>
                        <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                            class="hover:text-white underline">Cộng đồng Facebook: Tự kỷ là Rối loạn toàn thân</a>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">👤</span>
                        <a href="https://www.facebook.com/trolynamkhanh" target="_blank"
                            class="hover:text-white underline">Trợ lý Nam Khánh</a>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">📞</span>
                        <span><strong>Hotline/Zalo:</strong> <span
                                onclick="navigator.clipboard.writeText('0985391881'); alert('Đã copy số điện thoại: 0985.391.881');"
                                class="text-brand-light hover:text-white cursor-pointer transition underline"
                                title="Nhấn để copy">0985.391.881</span></span>
                    </li>
                    <li class="flex items-center">
                        <span class="mr-2">💬</span>
                        <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="hover:text-white underline">Nhóm
                            Zalo giải đáp thắc mắc</a>
                    </li>
                </ul>
            </div>

            <!-- Right Column: Disclaimer (Bottom Right of Website) -->
            <div class="flex flex-col justify-end mt-8 md:mt-0">
                <div class="bg-warm-800 p-5 md:p-6 rounded-xl border border-warm-700 shadow-inner">
                    <h4
                        class="text-sm font-bold text-alert-light mb-3 uppercase tracking-wider flex items-center gap-2">
                        <span class="text-lg">⚠️</span> TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM (DISCLAIMER)
                    </h4>
                    <div class="text-xs text-warm-300 space-y-3 leading-relaxed text-justify">
                        <p>Nội dung trong bài viết này hoàn toàn dựa trên các phân tích khoa học thực chứng và cơ chế
                            sinh hóa nội sinh, được biên soạn với mục đích cung cấp thông tin và kiến thức y sinh học
                            cho cộng đồng. Tất cả các thông tin, tài liệu và định hướng dinh dưỡng không nhằm mục đích
                            thay thế cho các chẩn đoán, tư vấn, hoặc phác đồ điều trị y khoa chuyên nghiệp.</p>
                        <p>Việc áp dụng bất kỳ thay đổi lớn nào về chế độ ăn, sử dụng thực phẩm bổ sung hoặc các liệu
                            pháp y sinh cần được thực hiện dưới sự giám sát, đánh giá và chỉ định trực tiếp từ các
                            chuyên gia y tế, bác sĩ chuyên khoa hoặc chuyên gia dinh dưỡng có giấy phép hành nghề, dựa
                            trên hồ sơ bệnh án và tình trạng sinh lý độc bản của từng cá nhân.</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Application Logic -->
    <script>
        // --- 1. Interactive Mechanism Logic ---
        const mechanismData = [
            {
                title: "1. Hàng rào khỏe mạnh",
                text: "Lớp tế bào biểu mô làm nhiệm vụ kiểm duyệt gắt gao. Các <strong>'liên kết chặt' (Tight junctions)</strong> khóa chặt các tế bào lại với nhau, chỉ mở cửa để hấp thu vi chất dinh dưỡng thiết yếu đã phân cắt nhỏ.",
                cellGap: '4px',
                junctionColor: '#10b981', // heal
                junctionHeight: '20px',
                borderColor: '#10b981',
                particles: ['vit', 'min', 'vit'] // Good particles
            },
            {
                title: "2. Sự phản bội của Zonulin",
                text: "Khi loạn khuẩn (vi khuẩn xấu, nấm men, dị ứng Gluten) tấn công niêm mạc, cơ thể tiết ra quá mức protein <strong>Zonulin</strong>. Zonulin hoạt động như một 'chiếc chìa khóa vạn năng' tự động mở toang các chốt khóa liên kết chặt.",
                cellGap: '12px',
                junctionColor: '#f59e0b', // amber-500 (weakening)
                junctionHeight: '10px',
                borderColor: '#f59e0b',
                particles: ['tox', 'bad', 'vit'] // Mixed particles
            },
            {
                title: "3. Rò rỉ ruột (Leaky Gut)",
                text: "Hàng rào an ninh sụp đổ. Các chốt khóa bung ra, tế bào rời rạc tạo lỗ hổng lớn. Độc tố (LPS, p-cresol), mảnh thức ăn chưa tiêu hóa ồ ạt tràn vào dòng máu, gây ra chuỗi thảm họa sinh hóa toàn thân.",
                cellGap: '24px',
                junctionColor: 'transparent', // broken
                junctionHeight: '0px',
                borderColor: '#ef4444', // alert
                particles: ['tox', 'bad', 'tox', 'food'] // Bad particles leaking
            }
        ];

        function renderGutBarrier(stateIndex) {
            const container = document.getElementById('gut-barrier');
            const data = mechanismData[stateIndex];

            // Build the abstract DOM cells
            let html = '';
            for (let i = 0; i < 4; i++) {
                // Cell
                html += `<div class="gut-cell shadow-sm border-b-4" style="border-color: ${data.borderColor}">TB</div>`;
                // Junction (if not last cell)
                if (i < 3) {
                    html += `<div class="flex flex-col justify-center" style="width: ${data.cellGap}; transition: width 0.5s;">
                                <div class="tight-junction rounded-sm mx-auto" style="background-color: ${data.junctionColor}; height: ${data.junctionHeight}"></div>
                             </div>`;
                }
            }
            container.innerHTML = html;

            // Render abstract particles moving from bottom (lòng ruột) to top (mạch máu)
            const particlesContainer = document.getElementById('particles-container');
            particlesContainer.innerHTML = '';

            if (stateIndex === 2) {
                // Animate toxins leaking up
                for (let i = 0; i < 5; i++) {
                    setTimeout(() => {
                        const particle = document.createElement('div');
                        particle.innerHTML = '🦠';
                        particle.style.position = 'absolute';
                        particle.style.left = (20 + Math.random() * 60) + '%';
                        particle.style.bottom = '30%';
                        particle.style.fontSize = '20px';
                        particle.style.transition = 'all 2s linear';
                        particle.style.opacity = '0';
                        particlesContainer.appendChild(particle);

                        // Trigger animation
                        setTimeout(() => {
                            particle.style.bottom = '80%';
                            particle.style.opacity = '1';
                        }, 50);
                    }, i * 400);
                }
            }
        }

        function updateMechanism(index) {
            // Update Buttons
            document.querySelectorAll('.tab-btn').forEach((btn, i) => {
                if (i === index) {
                    btn.classList.add('active', 'border-warm-800');
                    btn.classList.remove('bg-white');
                } else {
                    btn.classList.remove('active', 'border-warm-800');
                    btn.classList.add('bg-white');
                }
            });

            // Update Text
            const textDiv = document.getElementById('mechanism-text');
            textDiv.innerHTML = mechanismData[index].text;
            textDiv.style.borderLeftColor = mechanismData[index].borderColor;

            // Update Visual
            renderGutBarrier(index);
        }

        // --- 2. Quantitative Consequences Chart ---
        function initChart() {
            const ctx = document.getElementById('impactChart').getContext('2d');

            // Data representing the biological shift
            const data = {
                labels: [
                    ['Toàn vẹn', 'niêm mạc'],
                    ['Mức độ', 'viêm toàn thân'],
                    ['Độc tố', 'vào máu'],
                    ['Năng lượng', 'tế bào (ATP)'],
                    ['Kiểm soát', 'hành vi']
                ],
                datasets: [
                    {
                        label: 'Ruột khỏe mạnh',
                        data: [95, 10, 5, 90, 85],
                        backgroundColor: 'rgba(16, 185, 129, 0.7)', // heal
                        borderColor: 'rgb(16, 185, 129)',
                        borderWidth: 1
                    },
                    {
                        label: 'Hội chứng rò rỉ ruột',
                        data: [20, 85, 90, 30, 25],
                        backgroundColor: 'rgba(239, 68, 68, 0.7)', // alert
                        borderColor: 'rgb(239, 68, 68)',
                        borderWidth: 1
                    }
                ]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false, // Essential for Tailwind container sizing
                    plugins: {
                        legend: {
                            position: 'top',
                            labels: {
                                font: { family: "'Segoe UI', sans-serif", size: 14 }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + context.raw + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 100,
                            title: {
                                display: true,
                                text: 'Mức độ tương đối (%)',
                                font: { family: "'Segoe UI', sans-serif" }
                            }
                        },
                        x: {
                            ticks: {
                                font: { family: "'Segoe UI', sans-serif" }
                            }
                        }
                    },
                    animation: {
                        duration: 2000,
                        easing: 'easeOutQuart'
                    }
                }
            };

            new Chart(ctx, config);
        }

        // --- 3. Solutions Interaction (Mới) ---
        const solutionsData = [
            {
                icon: '🍲',
                title: 'Nước hầm xương nấu chậm',
                action: 'Tái tạo tế bào biểu mô',
                description: 'Là liệu pháp dinh dưỡng cổ xưa đầy sức mạnh khoa học, cung cấp nguồn <strong>Axit amin L-Glutamine</strong> dồi dào nhất. Đây chính là nguyên liệu chính yếu để tái tạo các tế bào biểu mô ruột bị tổn thương.',
                prep: 'Ninh nhỏ lửa từ 12-24 tiếng với một chút giấm táo để chiết xuất khoáng.',
                note: 'Một số trẻ nhạy cảm với lượng Histamine có trong nước hầm lâu ngày, cần các giải pháp L-Glutamine chuyên biệt khác.',
                colorClass: 'text-amber-700',
                bgClass: 'bg-amber-50',
                borderActive: 'border-amber-500',
                btnBgActive: 'bg-amber-100'
            },
            {
                icon: '🛡️',
                title: 'Kẽm (Zinc Carnosine)',
                action: 'Băng gạc sinh học',
                description: 'Kẽm không chỉ tăng cường miễn dịch mà cấu trúc <strong>Kẽm Carnosine</strong> đặc biệt có khả năng bám dính vào niêm mạc dạ dày và ruột, hoạt động như một lớp băng gạc sinh học, hỗ trợ làm lành vết loét và đóng lại các "liên kết chặt".',
                prep: 'Nguồn Kẽm tự nhiên có thể tìm thấy phong phú trong thịt bò hữu cơ, hạt bí ngô.',
                note: 'Cấu trúc Carnosine giúp đưa Kẽm đi sâu và lưu lại lâu hơn tại vết thương trên màng ruột.',
                colorClass: 'text-heal-dark',
                bgClass: 'bg-[#ecfdf5]', // emerald-50
                borderActive: 'border-heal',
                btnBgActive: 'bg-[#d1fae5]' // emerald-100
            },
            {
                icon: '🌈',
                title: 'Thực phẩm chống oxy hóa',
                action: 'Dập tắt bão viêm',
                description: 'Để dập tắt ngọn lửa viêm tại màng ruột, hãy khuyến khích trẻ "ăn một chiếc cầu vồng" – đa dạng các loại rau củ quả. Đây là những chiến binh chống viêm tự nhiên xuất sắc.',
                prep: 'Đặc biệt ưu tiên các loại quả mọng (dâu tằm, việt quất) hoặc tinh bột nghệ (Curcumin).',
                note: 'Sắc tố màu trong rau củ (như Anthocyanin trong việt quất) chứa năng lượng chống oxy hóa mạnh mẽ nhất.',
                colorClass: 'text-purple-700',
                bgClass: 'bg-purple-50',
                borderActive: 'border-purple-500',
                btnBgActive: 'bg-purple-100'
            }
        ];

        function selectBrick(index) {
            const data = solutionsData[index];

            // Cập nhật trạng thái các nút bấm (Buttons)
            document.querySelectorAll('.brick-btn').forEach((btn, i) => {
                const sData = solutionsData[i];
                if (i === index) {
                    btn.className = `brick-btn w-full text-left px-5 py-4 rounded-xl border-2 transition-all duration-300 focus:outline-none transform translate-x-2 lg:translate-x-4 shadow-md ${sData.borderActive} ${sData.btnBgActive}`;
                } else {
                    btn.className = `brick-btn w-full text-left px-5 py-4 rounded-xl border-2 transition-all duration-300 focus:outline-none border-warm-200 bg-white hover:bg-warm-50 opacity-70 hover:opacity-100`;
                }
            });

            // Cập nhật Background & Icon hiển thị
            const displayBg = document.getElementById('brick-display-bg');
            displayBg.className = `lg:w-2/3 rounded-2xl shadow-md border border-warm-200 p-6 md:p-8 relative overflow-hidden flex flex-col justify-center min-h-[350px] transition-colors duration-500 ${data.bgClass}`;

            const bgIcon = document.getElementById('brick-bg-icon');
            bgIcon.innerHTML = data.icon;

            // Hiệu ứng "pop" cho icon mờ
            bgIcon.classList.remove('scale-100');
            bgIcon.classList.add('scale-125');
            setTimeout(() => {
                bgIcon.classList.remove('scale-125');
                bgIcon.classList.add('scale-100');
            }, 300);

            // Cập nhật nội dung chữ với hiệu ứng Fade In/Out
            const contentDiv = document.getElementById('brick-content');
            contentDiv.style.opacity = 0;
            setTimeout(() => {
                contentDiv.innerHTML = `
                    <div class="inline-block px-3 py-1 rounded-full bg-white bg-opacity-70 text-sm font-bold tracking-wide uppercase shadow-sm ${data.colorClass} mb-4">
                        ${data.action}
                    </div>
                    <h3 class="text-2xl md:text-3xl font-extrabold text-warm-900 mb-4 leading-tight">${data.title}</h3>
                    <p class="text-base md:text-lg text-warm-800 leading-relaxed mb-6">
                        ${data.description}
                    </p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-white bg-opacity-70 p-4 rounded-xl shadow-sm">
                            <h4 class="font-bold text-warm-900 mb-2 flex items-center gap-2"><span>💡</span> Hướng dẫn</h4>
                            <p class="text-sm text-warm-800 leading-snug">${data.prep}</p>
                        </div>
                        <div class="bg-white bg-opacity-70 p-4 rounded-xl shadow-sm border-l-4 border-amber-400">
                            <h4 class="font-bold text-warm-900 mb-2 flex items-center gap-2"><span>📌</span> Ghi chú</h4>
                            <p class="text-sm text-warm-800 leading-snug">${data.note}</p>
                        </div>
                    </div>
                `;
                contentDiv.style.transition = 'opacity 0.4s ease-in-out';
                contentDiv.style.opacity = 1;
            }, 200);
        }

        // --- Logic cho thanh trượt "Quy tắc vàng" ---
        function updateDosageInfo(value) {
            const val = parseInt(value);
            const box = document.getElementById('dosageResultBox');
            const icon = document.getElementById('dosageIcon');
            const title = document.getElementById('dosageTitle');
            const desc = document.getElementById('dosageDesc');

            if (val < 35) {
                // Liều thấp - Tốt
                box.className = 'p-4 rounded-lg flex flex-col md:flex-row items-start gap-4 transition-colors duration-300 bg-[#047857] bg-opacity-30 border border-[#10b981]';
                icon.innerHTML = '✅';
                title.innerHTML = 'Lý tưởng để bắt đầu ("Chậm và ít")';
                title.className = 'font-bold text-lg mb-1 text-heal-light';
                desc.innerHTML = 'Đúng chuẩn y sinh. Cơ thể có đủ thời gian sinh lý để hấp thu dưỡng chất phục hồi và tự xây lại các liên kết chặt mà không bị "sốc".';
            } else if (val < 75) {
                // Liều trung bình - Thận trọng
                box.className = 'p-4 rounded-lg flex flex-col md:flex-row items-start gap-4 transition-colors duration-300 bg-amber-600 bg-opacity-30 border border-amber-500';
                icon.innerHTML = '⚠️';
                title.innerHTML = 'Cần quan sát thật kỹ';
                title.className = 'font-bold text-lg mb-1 text-amber-400';
                desc.innerHTML = 'Lượng vi chất (như L-Glutamine) đã tăng. Cần theo dõi sát sao phản ứng tiêu hóa của trẻ. Nếu trẻ khó chịu, cần lùi ngay về liều lượng ban đầu.';
            } else {
                // Liều cao - Nguy hiểm
                box.className = 'p-4 rounded-lg flex flex-col md:flex-row items-start gap-4 transition-colors duration-300 bg-alert-light bg-opacity-20 border border-alert';
                icon.innerHTML = '❌';
                title.innerHTML = 'Nguy cơ quá tải tổn thương (Nóng vội)';
                title.className = 'font-bold text-lg mb-1 text-alert-light';
                desc.innerHTML = 'Đường ruột đang tổn thương rò rỉ rất nhạy cảm. Ép dung nạp lượng lớn dinh dưỡng đột ngột giống như đổ dồn gạch vào một bức tường chưa khô vữa, có thể làm sập hệ thống.';
            }
        }

        // --- Initialization ---
        window.onload = () => {
            updateMechanism(0); // Init Mechanism to Step 1
            initChart();        // Draw Chart
            selectBrick(0);     // Init Solutions to Brick 1
            updateDosageInfo(10); // Init Golden Rule Slider
        };
    </script>

    <?php wp_footer(); ?>
</body>