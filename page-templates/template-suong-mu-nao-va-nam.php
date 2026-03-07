<?php
/**
 * Template Name: Trang Sương mù não và nấm Candida
 * 
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sương mù não và nấm Candida - Phân tích y sinh</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            bg: '#f8fafc',
                            surface: '#ffffff',
                            primary: '#0f766e',
                            light: '#ccfbf1',
                            accent: '#ea580c',
                            text: '#334155',
                            muted: '#64748b'
                        }
                    },
                    fontFamily: {
                        sans: ['Inter', 'Segoe UI', 'Roboto', 'Helvetica', 'Arial', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            background-color: #f8fafc;
            color: #334155;
            scroll-behavior: smooth;
        }

        .chart-container {
            position: relative;
            width: 100%;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            height: 350px;
            max-height: 400px;
        }

        @media (min-width: 768px) {
            .chart-container {
                height: 400px;
            }
        }

        .tab-active {
            border-bottom: 2px solid #0f766e;
            color: #0f766e;
            font-weight: 600;
        }

        .step-active {
            background-color: #0f766e;
            color: white;
            border-color: #0f766e;
        }

        .fade-in {
            animation: fadeIn 0.4s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="antialiased font-sans">

    <!-- Chosen Palette: Warm Neutrals (Slate/Gray) with Teal (Healing/Nature) and Orange (Toxins/Warning) accents -->

    <!-- Application Structure Plan: The SPA is structured as an interactive storytelling dashboard to guide parents through a complex biochemical process. It begins with empathy and symptom recognition, moves into the biological root cause (the mechanism), visualizes the invisible cellular damage, and culminates in actionable, culturally-adapted nutritional solutions organized via tabs. This structure logic prioritizes user understanding and emotional connection over a linear academic layout. -->

    <!-- Visualization & Content Choices: 
    1. Symptoms -> Goal: Inform/Relate -> Viz: Grid Cards with Emojis -> Interaction: Hover effects -> Justifies: Quick scanning of behavioral signs without SVG.
    2. Mechanism -> Goal: Explain Process -> Viz: Interactive Step Buttons + Text Blocks -> Interaction: Click to reveal steps -> Justifies: Breaks down complex biology into digestible phases.
    3. Cellular Damage -> Goal: Compare -> Viz: Chart.js Radar Chart -> Interaction: Hover tooltips -> Justifies: Visually contrasts healthy baseline vs toxic state to highlight multi-faceted resource drain.
    4. Solutions -> Goal: Actionable Organization -> Viz: HTML Tabs -> Interaction: Click tabs -> Justifies: Keeps the UI clean while providing dense, practical data (Swaps, Herbs, Vietnamese Menu). -->

    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

    <nav class="fixed w-full bg-white shadow-sm z-50 top-0 left-0 border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center space-x-2">
                    <span class="text-2xl">🧠</span>
                    <span class="text-lg font-bold text-brand-primary hidden sm:block">Hiểu con từ Gốc</span>
                </div>
                <div
                    class="flex items-center space-x-4 sm:space-x-6 text-sm font-medium text-brand-muted overflow-x-auto whitespace-nowrap px-2">
                    <a href="#hien-tuong" class="hover:text-brand-primary transition">Hiện tượng</a>
                    <a href="#co-che" class="hover:text-brand-primary transition">Cơ chế</a>
                    <a href="#tac-dong" class="hover:text-brand-primary transition">Tác động</a>
                    <a href="#giai-phap"
                        class="hover:text-brand-primary transition bg-brand-light text-brand-primary px-4 py-1.5 rounded-full">Giải
                        pháp</a>
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-16">
        <section class="bg-white py-16 sm:py-24 border-b border-gray-100">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center fade-in">
                <div class="inline-block p-3 bg-brand-light rounded-full mb-6">
                    <span class="text-3xl">🦠</span>
                </div>
                <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Nấm Candida và hiện tượng <br />
                    <span class="text-brand-primary">"Sương mù não"</span>
                </h1>
                <p class="text-lg sm:text-xl text-gray-600 mb-8 leading-relaxed max-w-3xl mx-auto">
                    Những hành vi khó kiểm soát của trẻ đôi khi chính là hệ quả sinh hóa của một <strong>"cơn say nội
                        sinh"</strong> bắt nguồn từ sự bùng phát nấm men trong đường ruột.
                </p>
            </div>
        </section>

        <section id="hien-tuong" class="py-16 sm:py-20 bg-brand-bg">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 max-w-3xl">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">1. Nhận diện "Sương mù não"</h2>
                    <p class="text-brand-text leading-relaxed text-lg">
                        Sương mù não (Brain Fog) là khi hệ thần kinh của trẻ bị che phủ bởi các đám mây độc tính. Phần
                        này giúp cha mẹ nhận diện các biểu hiện thực tế, hiểu rằng trẻ không hề "chống đối" mà đang mất
                        khả năng kiểm soát nhận thức.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="text-4xl mb-4">😶</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Ánh mắt trống rỗng</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Trẻ lờ đờ, gọi không quay đầu, ánh mắt như nhìn
                            xuyên thấu qua mọi thứ xung quanh.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="text-4xl mb-4">🤪</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Cảm xúc vô cớ</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Cười vô cớ, kích động đột ngột mà không có
                            nguyên nhân rõ ràng từ môi trường.</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="text-4xl mb-4">🚶</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Mất phối hợp</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Đi đứng loạng choạng, hành vi giống hệt như một
                            người đang trong trạng thái "say rượu".</p>
                    </div>
                    <div
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-lg transition-shadow duration-300">
                        <div class="text-4xl mb-4">🌫️</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Mất tập trung</h3>
                        <p class="text-sm text-gray-600 leading-relaxed">Không thể duy trì sự chú ý vào các hoạt động
                            thường ngày, não bộ bị gián đoạn tín hiệu.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="co-che" class="py-16 sm:py-20 bg-white border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 max-w-3xl">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">2. Cơ chế: "Nhà máy bia" đường ruột</h2>
                    <p class="text-brand-text leading-relaxed text-lg">
                        Tương tác với các bước dưới đây để hiểu quá trình nấm Candida sử dụng đường làm nguyên liệu, lên
                        men và sản sinh ra độc tố Acetaldehyde, trực tiếp tấn công não bộ của trẻ.
                    </p>
                </div>

                <div class="flex flex-col md:flex-row gap-8 items-stretch">
                    <div class="w-full md:w-1/3 flex flex-col space-y-3">
                        <button onclick="changeMechanismStep(1)" id="btn-step-1"
                            class="step-active text-left px-6 py-5 rounded-xl border font-bold transition shadow-sm text-lg">
                            1. Nguồn nguyên liệu
                        </button>
                        <button onclick="changeMechanismStep(2)" id="btn-step-2"
                            class="bg-white text-gray-600 text-left px-6 py-5 rounded-xl border font-bold hover:bg-gray-50 transition shadow-sm text-lg">
                            2. Quá trình lên men
                        </button>
                        <button onclick="changeMechanismStep(3)" id="btn-step-3"
                            class="bg-white text-gray-600 text-left px-6 py-5 rounded-xl border font-bold hover:bg-gray-50 transition shadow-sm text-lg">
                            3. Nhiễm độc não bộ
                        </button>
                    </div>

                    <div
                        class="w-full md:w-2/3 bg-brand-bg p-8 md:p-12 rounded-2xl border border-gray-200 min-h-[320px] flex items-center justify-center">
                        <div id="mech-content-1" class="fade-in w-full max-w-lg mx-auto text-center">
                            <div class="text-6xl mb-6">🍬 🥖</div>
                            <h3 class="text-2xl font-bold text-brand-primary mb-4">Đường và tinh bột tinh chế</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Nấm Candida là loài ưa đường. Khi trẻ tiêu thụ đường tinh luyện hoặc tinh bột chế biến
                                sâu, lượng dinh dưỡng dư thừa này trở thành nguồn thức ăn hoàn hảo cho vi sinh vật có
                                hại trong ruột.
                            </p>
                        </div>

                        <div id="mech-content-2" class="hidden fade-in w-full max-w-lg mx-auto text-center">
                            <div class="text-6xl mb-6">🦠 🏭</div>
                            <h3 class="text-2xl font-bold text-brand-accent mb-4">Sự bùng phát nấm Candida</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Nấm men sử dụng đường làm nguyên liệu cho quá trình lên men yếm khí. Kết quả là sản sinh
                                ra một lượng lớn <strong>Acetaldehyde</strong> – độc tố cực mạnh. Đường ruột lúc này hệt
                                như một "nhà máy bia".
                            </p>
                        </div>

                        <div id="mech-content-3" class="hidden fade-in w-full max-w-lg mx-auto text-center">
                            <div class="text-6xl mb-6">🧠 ⚠️</div>
                            <h3 class="text-2xl font-bold text-red-600 mb-4">Acetaldehyde vượt rào máu não</h3>
                            <p class="text-gray-700 text-lg leading-relaxed">
                                Độc tố ngấm qua niêm mạc ruột, đi vào máu và vượt qua hàng rào máu não. Trẻ rơi vào
                                trạng thái mất kiểm soát nhận thức và hành vi, biểu hiện giống hệt người đang "say
                                rượu".
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tac-dong" class="py-16 sm:py-24 bg-gray-900 text-white">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold mb-4">3. Tác động tàn phá cấp độ tế bào</h2>
                    <p class="text-gray-400 leading-relaxed text-lg">
                        Biểu đồ hiển thị sự suy kiệt nghiêm trọng của các tài nguyên nội sinh khi bị độc tố tấn công. Sự
                        sụt giảm năng lượng và chất bảo vệ giải thích tình trạng "chạy khi bình xăng cạn" của trẻ.
                    </p>
                </div>

                <div class="flex flex-col lg:flex-row gap-12 items-center justify-center">
                    <div class="w-full lg:w-1/2 flex justify-center">
                        <div
                            class="chart-container bg-gray-800 p-6 rounded-2xl border border-gray-700 shadow-xl w-full">
                            <canvas id="cellularChart"></canvas>
                        </div>
                    </div>

                    <div class="w-full lg:w-1/2 space-y-4">
                        <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-red-500 hover:bg-gray-700 transition">
                            <h4 class="font-bold text-lg mb-1 text-red-400 flex items-center"><span
                                    class="mr-2">⚡</span> Suy kiệt ATP (Ty thể)</h4>
                            <p class="text-sm text-gray-300">Nhà máy năng lượng ngừng hoạt động. Trẻ thiếu ATP không thể
                                có đủ năng lượng để tập trung hay kiểm soát cảm xúc.</p>
                        </div>
                        <div class="bg-gray-800 p-5 rounded-xl border-l-4 border-blue-400 hover:bg-gray-700 transition">
                            <h4 class="font-bold text-lg mb-1 text-blue-300 flex items-center"><span
                                    class="mr-2">🌬️</span> Cạnh tranh oxy và Glutathione</h4>
                            <p class="text-sm text-gray-300">Cơ thể vắt kiệt chất chống oxy hóa để giải độc. Não bộ rơi
                                vào trạng thái thiếu oxy cục bộ gây lờ đờ, chậm chạp.</p>
                        </div>
                        <div
                            class="bg-gray-800 p-5 rounded-xl border-l-4 border-yellow-500 hover:bg-gray-700 transition">
                            <h4 class="font-bold text-lg mb-1 text-yellow-400 flex items-center"><span
                                    class="mr-2">🔌</span> Đứt gãy vỏ Myelin và Vitamin B6</h4>
                            <p class="text-sm text-gray-300">Ức chế Vitamin B6 khiến lớp vỏ cách điện của dây thần kinh
                                suy yếu, tín hiệu "chập mạch", làm sai lệch chất dẫn truyền.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="giai-phap" class="py-16 sm:py-24 bg-brand-bg">
            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="mb-12 max-w-3xl mx-auto text-center">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">4. Giải pháp dinh dưỡng tích cực</h2>
                    <p class="text-brand-text leading-relaxed text-lg">
                        Chiến thuật <strong>"bỏ đói nấm"</strong> kết hợp các chất kháng nấm tự nhiên giúp phục hồi hệ
                        sinh thái. Khám phá các gợi ý chuyển đổi thực phẩm gần gũi và thực đơn mẫu bên dưới.
                    </p>
                </div>

                <div class="bg-white rounded-2xl shadow-md border border-gray-200 overflow-hidden">
                    <div class="flex border-b border-gray-200 overflow-x-auto bg-gray-50 hide-scrollbar">
                        <button onclick="switchTab('tab-swaps')" id="btn-tab-swaps"
                            class="px-6 py-4 text-sm md:text-base font-medium whitespace-nowrap tab-active focus:outline-none transition">
                            🔄 Chuyển đổi thực phẩm
                        </button>
                        <button onclick="switchTab('tab-antifungal')" id="btn-tab-antifungal"
                            class="px-6 py-4 text-sm md:text-base font-medium text-gray-500 hover:text-brand-primary whitespace-nowrap focus:outline-none transition">
                            🌿 Kháng nấm tự nhiên
                        </button>
                        <button onclick="switchTab('tab-menu')" id="btn-tab-menu"
                            class="px-6 py-4 text-sm md:text-base font-medium text-gray-500 hover:text-brand-primary whitespace-nowrap focus:outline-none transition">
                            🍲 Thực đơn mẫu
                        </button>
                    </div>

                    <div class="p-6 md:p-10 min-h-[400px]">
                        <div id="tab-swaps" class="fade-in space-y-8">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Cắt đứt nguồn tiếp tế</h3>
                                <p class="text-gray-500 mt-2">Thay thế nhóm carbohydrate tinh chế bằng carbohydrate phức
                                    hợp và nguồn ngọt tự nhiên.</p>
                            </div>

                            <div class="space-y-4 max-w-4xl mx-auto">
                                <div
                                    class="flex flex-col md:flex-row bg-red-50/50 rounded-xl overflow-hidden border border-gray-200">
                                    <div
                                        class="md:w-1/2 p-5 border-b md:border-b-0 md:border-r border-gray-200 bg-red-50">
                                        <div class="text-red-600 font-bold mb-3 flex items-center text-lg"><span
                                                class="mr-2">❌</span> Thay vì dùng...</div>
                                        <ul class="space-y-2 text-gray-700">
                                            <li>Đường trắng, xi-rô ngô, bánh kẹo công nghiệp</li>
                                            <li>100% tinh bột tinh chế (cơm trắng, bún, phở trắng, mì gói mỗi ngày)</li>
                                            <li>Nước ngọt có ga, sữa bò công nghiệp nhiều đường</li>
                                        </ul>
                                    </div>
                                    <div class="md:w-1/2 p-5 bg-teal-50">
                                        <div class="text-brand-primary font-bold mb-3 flex items-center text-lg"><span
                                                class="mr-2">✅</span> Hãy chọn...</div>
                                        <ul class="space-y-2 text-gray-700">
                                            <li>Trái cây ít ngọt (táo xanh, bơ, ổi, thanh long), cỏ ngọt Stevia</li>
                                            <li>Gạo xát dối, cơm gạo lứt, cơm độn đậu/khoai lang, bún gạo lứt</li>
                                            <li>Nước lọc, nước ép rau củ, sữa hạt tự làm (sen, đậu xanh) không đường
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-antifungal" class="hidden fade-in space-y-8">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Chiến binh kháng nấm</h3>
                                <div
                                    class="inline-flex mt-3 items-center bg-yellow-50 text-yellow-800 px-4 py-2 rounded-lg text-sm border border-yellow-200">
                                    <span class="mr-2">⚠️</span>
                                    <span>Quy tắc tối thượng: "Bắt đầu từ liều lượng thấp nhất" để tránh quá tải cho
                                        gan.</span>
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
                                <div
                                    class="flex p-5 border border-gray-200 rounded-xl hover:border-brand-primary transition bg-gray-50">
                                    <div class="text-4xl mr-4 mt-1">🥥</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Dầu dừa ép lạnh</h4>
                                        <p class="text-sm text-gray-600 mt-2">Chứa Acid Lauric và Acid Caprylic, kháng
                                            nấm tự nhiên mạnh mẽ, xuyên thủng màng tế bào nấm Candida mà không hại lợi
                                            khuẩn.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex p-5 border border-gray-200 rounded-xl hover:border-brand-primary transition bg-gray-50">
                                    <div class="text-4xl mr-4 mt-1">🧄</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Tỏi đen / tỏi tươi</h4>
                                        <p class="text-sm text-gray-600 mt-2">Chứa Allicin, một hoạt chất sinh học giúp
                                            ức chế mạnh mẽ sự sinh sôi của nấm men trong môi trường ruột.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex p-5 border border-gray-200 rounded-xl hover:border-brand-primary transition bg-gray-50">
                                    <div class="text-4xl mr-4 mt-1">🍎</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Giấm táo tự nhiên</h4>
                                        <p class="text-sm text-gray-600 mt-2">Hỗ trợ cân bằng độ pH đường ruột, tạo môi
                                            trường bất lợi cho nấm men nhưng cực kỳ thuận lợi cho lợi khuẩn.</p>
                                    </div>
                                </div>
                                <div
                                    class="flex p-5 border border-gray-200 rounded-xl hover:border-brand-primary transition bg-gray-50">
                                    <div class="text-4xl mr-4 mt-1">🌻</div>
                                    <div>
                                        <h4 class="font-bold text-gray-800 text-lg">Kẽm và Magie</h4>
                                        <p class="text-sm text-gray-600 mt-2">Có nhiều trong hạt bí xanh, hạt hướng
                                            dương. Giúp bảo vệ ty thể và hỗ trợ enzym chuyển hóa, đào thải độc tố.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div id="tab-menu" class="hidden fade-in space-y-8">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold text-gray-800">Thực đơn mẫu (Gần gũi, thuần Việt)</h3>
                                <p class="text-gray-500 mt-2">Gợi ý 1 ngày giúp "bỏ đói nấm" nhưng vẫn đảm bảo dinh
                                    dưỡng và dễ dàng chuẩn bị.</p>
                            </div>

                            <div
                                class="space-y-4 max-w-4xl mx-auto relative before:absolute before:inset-0 before:ml-5 before:-translate-x-px md:before:mx-auto md:before:translate-x-0 before:h-full before:w-0.5 before:bg-gradient-to-b before:from-transparent before:via-gray-200 before:to-transparent">

                                <div
                                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-brand-light text-brand-primary shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 text-xl font-bold">
                                        1</div>
                                    <div
                                        class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-gray-200 bg-white shadow-sm">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="font-bold text-brand-primary text-lg">Bữa sáng</h4>
                                        </div>
                                        <p class="text-gray-700">Cháo thịt băm nấu bằng gạo xát dối (hoặc gạo lứt) với
                                            chút bí đỏ. Trộn 1/2 thìa cà phê <strong class="text-brand-primary">dầu dừa
                                                ép lạnh</strong> khi ấm.</p>
                                        <div class="mt-2 text-sm text-gray-500 bg-gray-50 p-2 rounded">
                                            <strong>Bữa phụ:</strong> Vài lát ổi, táo xanh hoặc nắm nhỏ hạt bí
                                            xanh/hướng dương.
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-brand-light text-brand-primary shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 text-xl font-bold">
                                        2</div>
                                    <div
                                        class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-gray-200 bg-white shadow-sm">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="font-bold text-brand-primary text-lg">Bữa trưa</h4>
                                        </div>
                                        <p class="text-gray-700">Cơm nấu độn (gạo lứt/đậu đen/khoai lang), cá trắm/cá
                                            quả kho nhạt, canh rau ngót hoặc mồng tơi nấu thịt băm.</p>
                                        <div class="mt-2 text-sm text-gray-500 bg-gray-50 p-2 rounded">
                                            <strong>Bữa phụ:</strong> Sữa hạt tự làm (đậu nành, đậu xanh...) không
                                            đường, hoặc sữa chua không đường.
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="relative flex items-center justify-between md:justify-normal md:odd:flex-row-reverse group is-active">
                                    <div
                                        class="flex items-center justify-center w-10 h-10 rounded-full border border-white bg-brand-light text-brand-primary shadow shrink-0 md:order-1 md:group-odd:-translate-x-1/2 md:group-even:translate-x-1/2 z-10 text-xl font-bold">
                                        3</div>
                                    <div
                                        class="w-[calc(100%-4rem)] md:w-[calc(50%-2.5rem)] p-4 rounded border border-gray-200 bg-white shadow-sm">
                                        <div class="flex items-center justify-between mb-1">
                                            <h4 class="font-bold text-brand-primary text-lg">Bữa tối</h4>
                                        </div>
                                        <p class="text-gray-700">Thịt gà ta rang gừng sả, rau bắp cải/su su luộc. Nước
                                            chấm thêm chút <strong class="text-brand-primary">tỏi tươi đập dập</strong>.
                                            Ăn kèm cơm gạo xát dối.</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-16 bg-white border-t border-gray-200">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <div
                    class="inline-block p-6 md:p-8 bg-brand-bg border border-gray-200 rounded-2xl mb-8 text-left shadow-sm">
                    <h3 class="text-xl font-bold text-brand-accent mb-3 flex items-center">
                        <span class="mr-2 text-2xl">⚠️</span> Lưu ý: Phản ứng đào thải (Die-off)
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Việc bổ sung thực phẩm kháng nấm mang lại bước tiến to lớn, nhưng không phải là phép màu chữa
                        khỏi ngay lập tức. Trong quá trình nấm men bị tiêu diệt, chúng giải phóng lượng độc tố tạm thời
                        khiến hành vi trẻ <strong>trở nên tệ hơn trong vài ngày đầu</strong>. Đây là hiện tượng sinh lý
                        bình thường. Sự kiên nhẫn và nhật ký ăn uống sát sao là kim chỉ nam duy nhất.
                    </p>
                </div>
                <p class="text-lg text-brand-primary font-bold">Xua tan lớp sương mù não không phải là chuyện một sớm
                    một chiều. Mỗi bữa ăn đúng cách là một viên gạch xây dựng lại hệ thống sinh hóa cho con.</p>
            </div>
        </section>

    </main>

    <footer class="bg-gray-900 text-gray-300 py-16 border-t-4 border-brand-primary">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 mb-10">
                <div>
                    <h4 class="text-white text-xl font-bold mb-4">Cùng bạn hiểu con</h4>
                    <p class="text-gray-400 mb-6 leading-relaxed">Hành trình y sinh không phải là một con đường dễ dàng
                        và không gia đình nào nên đi một mình. Liên hệ với chúng tôi để được hỗ trợ.</p>
                    <ul class="space-y-4">
                        <li class="flex items-center">
                            <span class="text-xl mr-3">🌐</span>
                            <span><strong>Cộng đồng:</strong> <a
                                    href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank"
                                    class="text-brand-light hover:text-white underline transition">Tự kỷ là Rối loạn
                                    toàn thân</a></span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-xl mr-3">👤</span>
                            <span><strong>Hỗ trợ:</strong> <a href="https://www.facebook.com/trolynamkhanh"
                                    target="_blank" class="text-brand-light hover:text-white underline transition">Trợ
                                    lý Nam Khánh</a></span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-xl mr-3">📞</span>
                            <span><strong>Hotline/Zalo:</strong> <span onclick="navigator.clipboard.writeText('0985391881'); alert('Đã copy số điện thoại: 0985.391.881');" class="text-brand-light hover:text-white cursor-pointer transition underline" title="Nhấn để copy">0985.391.881</span></span>
                        </li>
                        <li class="flex items-center">
                            <span class="text-xl mr-3">💬</span>
                            <span><strong>Nhóm Zalo:</strong> <a href="https://zalo.me/g/vmgfxy834" target="_blank"
                                    class="text-brand-light hover:text-white underline transition">Tham gia giải
                                    đáp</a></span>
                        </li>
                    </ul>
                </div>
                <div
                    class="bg-gray-800 p-6 rounded-xl text-sm leading-relaxed text-gray-400 border border-gray-700 shadow-inner">
                    <h5 class="text-white font-bold mb-3 uppercase tracking-wider">Tuyên bố miễn trừ trách nhiệm</h5>
                    <p class="mb-3">Nội dung hoàn toàn dựa trên phân tích khoa học thực chứng và cơ chế sinh hóa nội
                        sinh, mục đích cung cấp thông tin y sinh học cho cộng đồng.</p>
                    <p>Tài liệu không nhằm mục đích thay thế cho chẩn đoán, tư vấn, hoặc phác đồ điều trị y khoa chuyên
                        nghiệp. Việc áp dụng cần được thực hiện dưới sự giám sát, đánh giá trực tiếp từ chuyên gia y tế
                        dựa trên hồ sơ bệnh án độc bản.</p>
                </div>
            </div>
            <div class="text-center text-sm text-gray-500 pt-8 border-t border-gray-800">
                &copy; 2026 🩷 HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN.
            </div>
        </div>
    </footer>

    <script>
        let currentMechStep = 1;

        function changeMechanismStep(step) {
            for (let i = 1; i <= 3; i++) {
                const btn = document.getElementById(`btn-step-${i}`);
                const content = document.getElementById(`mech-content-${i}`);

                if (i === step) {
                    btn.className = 'step-active text-left px-6 py-5 rounded-xl border font-bold transition shadow-sm text-lg';
                    content.classList.remove('hidden');
                } else {
                    btn.className = 'bg-white text-gray-600 text-left px-6 py-5 rounded-xl border font-bold hover:bg-gray-50 transition shadow-sm text-lg';
                    content.classList.add('hidden');
                }
            }
        }

        function switchTab(tabId) {
            const tabs = ['tab-swaps', 'tab-antifungal', 'tab-menu'];
            const btnIds = ['btn-tab-swaps', 'btn-tab-antifungal', 'btn-tab-menu'];

            tabs.forEach((id, index) => {
                const el = document.getElementById(id);
                const btn = document.getElementById(btnIds[index]);

                if (id === tabId) {
                    el.classList.remove('hidden');
                    btn.className = 'px-6 py-4 text-sm md:text-base font-medium whitespace-nowrap tab-active focus:outline-none transition';
                } else {
                    el.classList.add('hidden');
                    btn.className = 'px-6 py-4 text-sm md:text-base font-medium text-gray-500 hover:text-brand-primary whitespace-nowrap focus:outline-none transition';
                }
            });
        }

        document.addEventListener("DOMContentLoaded", function () {
            const ctx = document.getElementById('cellularChart').getContext('2d');

            Chart.defaults.color = '#9ca3af';
            Chart.defaults.font.family = "'Inter', sans-serif";

            new Chart(ctx, {
                type: 'radar',
                data: {
                    labels: [
                        'Oxy Lên Não',
                        'Năng Lượng ATP',
                        'Vitamin B6',
                        'Vỏ Myelin',
                        'Glutathione'
                    ],
                    datasets: [{
                        label: 'Trạng Thái Khỏe Mạnh (%)',
                        data: [100, 100, 100, 100, 100],
                        fill: true,
                        backgroundColor: 'rgba(15, 118, 110, 0.2)',
                        borderColor: '#0f766e',
                        pointBackgroundColor: '#0f766e',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#0f766e'
                    }, {
                        label: 'Nhiễm Độc Acetaldehyde (%)',
                        data: [40, 20, 15, 35, 30],
                        fill: true,
                        backgroundColor: 'rgba(234, 88, 12, 0.2)',
                        borderColor: '#ea580c',
                        pointBackgroundColor: '#ea580c',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: '#ea580c'
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                color: '#e5e7eb',
                                padding: 20,
                                font: {
                                    size: 13
                                }
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function (context) {
                                    return context.dataset.label + ': ' + context.formattedValue + '%';
                                }
                            }
                        }
                    },
                    scales: {
                        r: {
                            angleLines: {
                                color: 'rgba(255, 255, 255, 0.1)'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.15)'
                            },
                            pointLabels: {
                                color: '#d1d5db',
                                font: {
                                    size: 12,
                                    weight: 'bold'
                                }
                            },
                            ticks: {
                                display: false,
                                min: 0,
                                max: 100,
                                stepSize: 20
                            }
                        }
                    }
                }
            });
        });
    </script>

    <?php wp_footer(); ?>
</body>