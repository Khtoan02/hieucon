<?php
/**
 * Template Name: Trang Giới Thiệu
 * 
 * @package Hieucon
 * 
 * ĐÂY LÀ FILE ĐỐI TƯỢNG ĐỂ WORDPRESS NHẬN DIỆN MẪU TRANG.
 * File này chỉ đóng vai trò như một "Router" (Đường dẫn yêu cầu) 
 * để gọi đến Controller xử lý, không nên viết HTML ở đây.
 */

// Chuyển hướng xử lý sang Controller (Giả sử bạn sẽ tạo About_Controller)
// \Hieucon\Controller\About_Controller::render();

// Để demo tạm thời trước khi bạn tạo Controller, mình gọi View thẳng:
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cẩm nang Dinh dưỡng Giấc ngủ cho Trẻ Tự Kỷ</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;800&family=Quicksand:wght@500;700&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        heading: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        sleep: {
                            50: '#f8fafc',
                            100: '#f1f5f9',
                            200: '#e2e8f0',
                            300: '#cbd5e1',
                            400: '#94a3b8',
                            500: '#64748b',
                            600: '#475569',
                            700: '#334155',
                            800: '#1e293b',
                            900: '#0f172a',
                        },
                        calm: {
                            light: '#dcfce7',
                            DEFAULT: '#22c55e',
                            dark: '#166534',
                        },
                        warm: {
                            light: '#ffedd5',
                            DEFAULT: '#f97316',
                        },
                        indigo: {
                            500: '#6366f1',
                            600: '#4f46e5',
                            700: '#4338ca',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 450px;
            margin-left: auto;
            margin-right: auto;
            height: 300px;
            max-height: 350px;
        }
        @media (min-width: 768px) {
            .chart-container {
                height: 350px;
            }
        }

        .fade-in {
            animation: fadeIn 0.4s ease-out forwards;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .transition-all-custom {
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>
<body class="bg-sleep-50 text-sleep-800 font-sans antialiased overflow-x-hidden">

    <!-- Chosen Palette: Soothing Sleep (Warm neutrals: Slate/Sleep-50, Deep Night: Sleep-800, Soft Green: Calm, Soft Amber: Warm, Soft Indigo) -->
    
    <!-- Application Structure Plan: 
        1. Hero Section: Introduces the core concept (Gut-Brain connection, Serotonin/Melatonin) to establish the "Why" and set a reassuring tone.
        2. Golden Rules (Interactive Cards): Breaks down the 3 absolute rules for dinner. Hovering over cards reveals the deeper biological reasoning without overwhelming the initial view.
        3. The "Sleep Pharmacy" (Chart + Interactive Details): Uses a Donut chart (Chart.js) to visualize the balance of a perfect meal. Selecting chart segments dynamically updates a detail panel to show specific food items and their biological roles.
        4. Menu Explorer: A dashboard-like tabbed interface to browse the 4 specific menus. This functional layout allows parents to quickly find dinner ideas without scrolling endlessly.
        5. Sleep Environment (Interactive Demo): A section featuring a "Turn off lights" toggle. This interactively demonstrates the physiological trigger for Melatonin (darkness), creating a memorable learning moment.
        6. CTA/Footer: Clear contact information for personalized support and community joining, ending with the requested concluding message.
    -->

    <!-- Visualization & Content Choices: 
        - Goal: Inform on Ideal Meal Balance -> Viz: Chart.js Doughnut Chart -> Interaction: Hover/Click updates detailed text block -> Justification: Visually reinforces that all 4 groups are needed in proportion -> Library/Method: Chart.js (NO SVG/Mermaid).
        - Goal: Organize Rules -> Viz: CSS Grid with Hover Cards -> Interaction: Hover to read details -> Justification: Keeps the initial view clean, allows deep dive into "Why" on demand -> Library/Method: Tailwind + HTML/CSS.
        - Goal: Organize Menus -> Viz: Tabbed Navigation Dashboard -> Interaction: Click to swap menu details -> Justification: Task-oriented design for quick daily reference -> Library/Method: Vanilla JS + Tailwind.
        - Goal: Teach Environment Concept -> Viz: Dynamic Background Color change -> Interaction: Toggle switch (Light/Dark mode) -> Justification: Simulates the physiological trigger for Melatonin, reinforcing the text -> Library/Method: Vanilla JS.
    -->

    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. HTML/CSS entities and Unicode used for iconography. -->

    <header class="bg-white border-b border-sleep-200 py-16 px-6 sm:px-12 lg:px-24">
        <div class="max-w-5xl mx-auto text-center fade-in">
            <div class="inline-block bg-indigo-100 text-indigo-700 px-5 py-1.5 rounded-full text-sm font-bold mb-6 tracking-wide shadow-sm uppercase">
                Cẩm nang Dinh dưỡng cho Giấc ngủ Tự nhiên
            </div>
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-heading font-bold text-sleep-800 mb-6 leading-tight">
                Kích Hoạt <span class="text-indigo-600">Serotonin Tự nhiên</span><br>
                <span class="text-2xl md:text-3xl lg:text-4xl text-sleep-600 font-heading mt-2 block">Giúp Trẻ Tự Kỷ Tìm Lại Giấc Ngủ Ngon</span>
            </h1>
            <p class="text-lg md:text-xl text-sleep-600 max-w-3xl mx-auto leading-relaxed mt-8 bg-sleep-50 p-6 rounded-2xl border border-sleep-100 shadow-sm">
                Giấc ngủ của trẻ không tự nhiên mà có. Nó là kết quả của một chuỗi phản ứng sinh hóa phức tạp bắt đầu từ <strong>Đường ruột</strong>. Ở trẻ tự kỷ, viêm ruột và loạn khuẩn làm cạn kiệt Serotonin (Hormone hạnh phúc) và Melatonin (Hormone giấc ngủ). Thay vì dùng thuốc an thần, ba mẹ hoàn toàn có thể cung cấp nguyên liệu sinh học từ bữa ăn tối để cơ thể con tự sản xuất lại giấc ngủ.
            </p>
        </div>
    </header>

    <section class="py-16 px-6 sm:px-12 lg:px-24 bg-sleep-50">
        <div class="max-w-6xl mx-auto">
            <div class="mb-12 text-center fade-in">
                <h2 class="text-3xl font-heading font-bold text-sleep-800 mb-4">📍 3 Nguyên tắc VÀNG cho bữa tối</h2>
                <p class="text-sleep-600 max-w-2xl mx-auto">
                    Khu vực này trình bày 3 quy tắc y sinh học cốt lõi. Hiểu rõ cơ chế "Mở đường", "Kẻ cắp giấc ngủ" và "Nhịp sinh học" sẽ giúp ba mẹ tạo nền tảng vững chắc để não bộ tự tổng hợp hormone. Rê chuột vào từng thẻ để xem chi tiết cơ chế hoạt động.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all-custom border-t-4 border-indigo-500 group flex flex-col h-full cursor-default fade-in" style="animation-delay: 0.1s;">
                    <div class="text-5xl mb-6 bg-indigo-50 w-20 h-20 flex items-center justify-center rounded-2xl group-hover:scale-110 transition-transform">🧠</div>
                    <h3 class="text-xl font-heading font-bold text-sleep-800 mb-3 group-hover:text-indigo-600 transition-colors">1. "Mở đường" lên NÃO</h3>
                    <p class="text-sleep-600 mb-4 font-bold text-sm bg-sleep-100 p-2 rounded-lg text-center">Thịt/Trứng + Tinh bột chậm</p>
                    <p class="text-sleep-600 text-base leading-relaxed flex-grow">
                        Để tạo ra Serotonin, cơ thể cần <strong>Tryptophan</strong>. Tuy nhiên, Tryptophan rất khó đi lên não nếu đi một mình. Luôn kết hợp với tinh bột hấp thu chậm. Tinh bột sẽ dọn dẹp các rào cản trong máu, mở ra "con đường thênh thang" đưa Tryptophan tiến thẳng lên não bộ.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all-custom border-t-4 border-red-500 group flex flex-col h-full cursor-default fade-in" style="animation-delay: 0.2s;">
                    <div class="text-5xl mb-6 bg-red-50 w-20 h-20 flex items-center justify-center rounded-2xl group-hover:scale-110 transition-transform">🚫</div>
                    <h3 class="text-xl font-heading font-bold text-sleep-800 mb-3 group-hover:text-red-600 transition-colors">2. Tránh "KẺ CẮP GIẤC NGỦ"</h3>
                    <p class="text-sleep-600 mb-4 font-bold text-sm bg-red-50 p-2 rounded-lg text-red-700 text-center">Không đường / Màu / MSG</p>
                    <p class="text-sleep-600 text-base leading-relaxed flex-grow">
                        Bữa tối tuyệt đối không chứa đường tinh luyện, nước ngọt, màu nhân tạo hay bột ngọt (MSG). Những chất này gây kích thích thần kinh quá mức, làm não bộ "căng như dây đàn", khiến con tăng động và phá vỡ hoàn toàn cấu trúc giấc ngủ.
                    </p>
                </div>

                <div class="bg-white rounded-3xl p-8 shadow-sm hover:shadow-xl transition-all-custom border-t-4 border-calm-DEFAULT group flex flex-col h-full cursor-default fade-in" style="animation-delay: 0.3s;">
                    <div class="text-5xl mb-6 bg-calm-light w-20 h-20 flex items-center justify-center rounded-2xl group-hover:scale-110 transition-transform">⏰</div>
                    <h3 class="text-xl font-heading font-bold text-sleep-800 mb-3 group-hover:text-calm-dark transition-colors">3. Tuân thủ NHỊP SINH HỌC</h3>
                    <p class="text-sleep-600 mb-4 font-bold text-sm bg-calm-light p-2 rounded-lg text-calm-dark text-center">Ăn trước ngủ 2 - 2.5 tiếng</p>
                    <p class="text-sleep-600 text-base leading-relaxed flex-grow">
                        Khi đi ngủ, toàn bộ năng lượng của cơ thể cần được dồn vào việc phục hồi não bộ và sửa chữa tế bào. Nếu ăn quá muộn, cơ thể phải gồng mình tiêu hóa thức ăn trong dạ dày, con sẽ rất khó có được một giấc ngủ sâu.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-16 px-6 sm:px-12 lg:px-24 bg-white border-y border-sleep-200 relative overflow-hidden">
        <div class="absolute top-0 left-0 w-full h-full bg-sleep-50 opacity-50 transform -skew-y-3 origin-top-left z-0"></div>
        <div class="max-w-6xl mx-auto relative z-10">
            <div class="mb-12 text-center fade-in">
                <h2 class="text-3xl font-heading font-bold text-sleep-800 mb-4">📍 4 nhóm Thực phẩm "Cây nhà lá vườn"</h2>
                <p class="text-sleep-600 max-w-2xl mx-auto">
                    Khu vực này giúp ba mẹ hình dung tỷ lệ của một bữa ăn an thần. Không cần tìm kiếm đâu xa, thuốc an thần tự nhiên tốt nhất nằm ở 4 nhóm chất này. Nhấp vào các phần của biểu đồ để xem chức năng sinh học chi tiết của từng loại thực phẩm.
                </p>
            </div>

            <div class="flex flex-col lg:flex-row items-center gap-12 bg-white p-8 rounded-3xl shadow-lg border border-sleep-100 fade-in" style="animation-delay: 0.2s;">
                <div class="w-full lg:w-5/12">
                    <h3 class="text-center font-bold text-sleep-700 mb-6 text-xl">Đĩa thức ăn AN THẦN</h3>
                    <div class="chart-container">
                        <canvas id="foodChart"></canvas>
                    </div>
                    <p class="text-xs text-center text-sleep-500 mt-6">*Tỷ lệ trên mang tính minh họa cho sự đa dạng cần thiết, không phải định lượng tuyệt đối.</p>
                </div>

                <div class="w-full lg:w-7/12">
                    <div id="food-detail-panel" class="bg-sleep-50 p-8 rounded-2xl h-full flex flex-col justify-center min-h-[350px] transition-all-custom border-l-4 border-indigo-500">
                        <div class="text-center text-sleep-400 my-auto">
                            <span class="text-4xl block mb-4">👆</span>
                            <p class="text-lg">Hãy nhấp vào biểu đồ bên trái để xem chi tiết từng nhóm thực phẩm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 px-6 sm:px-12 lg:px-24 bg-sleep-50">
        <div class="max-w-5xl mx-auto">
            <div class="mb-12 text-center fade-in">
                <h2 class="text-3xl font-heading font-bold text-sleep-800 mb-4">📍 4 Thực đơn mẫu "NGỦ NGON"</h2>
                <p class="text-sleep-600 max-w-2xl mx-auto">
                    Phần này là công cụ thực hành hằng ngày. Chúng tôi đã thiết kế sẵn 4 thực đơn kết hợp chuẩn xác các nhóm thực phẩm trên. Ba mẹ hãy nhấp vào các tab dưới đây để khám phá các mâm cơm tối nay.
                </p>
            </div>

            <div class="flex overflow-x-auto space-x-3 pb-4 mb-8 justify-start md:justify-center no-scrollbar fade-in" id="menu-nav" style="animation-delay: 0.1s;">
            </div>

            <div id="menu-display" class="bg-white rounded-3xl p-8 md:p-12 shadow-xl border border-sleep-100 min-h-[350px] flex flex-col justify-center transition-all-custom relative overflow-hidden fade-in" style="animation-delay: 0.2s;">
            </div>
            
            <div class="mt-8 bg-warm-light border border-warm-DEFAULT rounded-xl p-4 flex items-start gap-4 max-w-3xl mx-auto fade-in" style="animation-delay: 0.3s;">
                <span class="text-2xl mt-1">👨‍🍳</span>
                <p class="text-sm text-sleep-700 leading-relaxed font-medium">
                    <strong>Lời khuyên chế biến:</strong> Ba mẹ hãy luân phiên thay đổi 4 thực đơn này trong tuần. Ưu tiên các phương pháp chế biến giữ nguyên dưỡng chất như luộc, hấp, áp chảo. Tuyệt đối hạn chế chiên xào sử dụng nhiều dầu mỡ công nghiệp.
                </p>
            </div>
        </div>
    </section>

    <section id="environment-section" class="py-24 px-6 sm:px-12 lg:px-24 bg-white transition-colors duration-1000 ease-in-out">
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <h2 id="env-title" class="text-3xl font-heading font-bold text-sleep-800 mb-6 transition-colors duration-1000">💡 Lưu ý QUAN TRỌNG về môi trường</h2>
            <p id="env-desc" class="text-sleep-600 mb-10 text-lg transition-colors duration-1000 max-w-2xl mx-auto">
                Dinh dưỡng đúng kết hợp với môi trường êm dịu sẽ là chiếc nôi hoàn hảo. Yếu tố quyết định cuối cùng nằm ở ánh sáng. <strong>Hãy thử thao tác công tắc dưới đây để khám phá bí mật của cơ thể.</strong>
            </p>

            <button id="toggle-light-btn" class="bg-sleep-800 text-white hover:bg-black font-bold py-4 px-10 rounded-full shadow-lg transition-all-custom transform hover:scale-105 flex items-center justify-center mx-auto gap-3 text-lg focus:outline-none focus:ring-4 focus:ring-sleep-300">
                <span id="btn-icon" class="text-2xl">🌙</span> <span id="btn-text">Tắt đèn PHÒNG NGỦ</span>
            </button>

            <div id="melatonin-secret" class="mt-16 opacity-0 translate-y-10 h-0 overflow-hidden transition-all duration-1000 ease-in-out">
                <div class="bg-sleep-800/80 backdrop-blur-md text-sleep-100 p-8 md:p-10 rounded-3xl border border-sleep-600 text-left shadow-2xl">
                    <h3 class="text-2xl font-heading font-bold text-warm-DEFAULT mb-6 flex items-center gap-3 border-b border-sleep-600 pb-4">
                        <span class="text-3xl">✨</span> Phép màu của bóng tối đã bắt đầu
                    </h3>
                    <p class="mb-6 text-lg">
                        Tuyệt vời! Khi ánh sáng vừa tắt, não bộ của trẻ lập tức nhận tín hiệu để làm việc:
                    </p>
                    <div class="space-y-6">
                        <div class="flex items-start gap-4 bg-sleep-900/50 p-4 rounded-xl">
                            <span class="text-3xl">🫀</span>
                            <div>
                                <h4 class="font-bold text-white text-lg mb-1">Melatonin chỉ tiết ra trong bóng tối</h4>
                                <p class="text-sleep-300">Hormone giấc ngủ Melatonin không thể giải phóng nếu có ánh sáng. Tuyệt đối không cho con xem Tivi, iPad hay điện thoại sau bữa tối vì ánh sáng xanh sẽ phá hủy toàn bộ nỗ lực dinh dưỡng của bạn.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 bg-sleep-900/50 p-4 rounded-xl">
                            <span class="text-3xl">🎵</span>
                            <div>
                                <h4 class="font-bold text-white text-lg mb-1">Xoa Dịu Bằng Âm Thanh</h4>
                                <p class="text-sleep-300">Hãy giảm sáng đèn phòng, bật một bản nhạc không lời tần số thấp (nhạc sóng não) để báo hiệu cho hệ thần kinh giao cảm được nghỉ ngơi.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-4 bg-sleep-900/50 p-4 rounded-xl">
                            <span class="text-3xl">🛁</span>
                            <div>
                                <h4 class="font-bold text-white text-lg mb-1">Thư Giãn Qua Da</h4>
                                <p class="text-sleep-300">Một mẹo nhỏ: Cho con ngâm mình trong chậu nước ấm pha chút muối Epsom. Muối này chứa Magie Sulfate thẩm thấu rất tốt qua da, giúp thư giãn bó cơ cực kỳ hiệu quả.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer class="bg-sleep-900 text-sleep-300 py-20 px-6 sm:px-12 text-center border-t-8 border-indigo-600 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10 flex justify-center items-center pointer-events-none">
            <span class="text-[30rem]">🌙</span>
        </div>
        <div class="max-w-4xl mx-auto relative z-10">
            <h2 class="text-3xl font-heading font-bold text-white mb-6">ĐỂ ĐƯỢC TƯ VẤN DINH DƯỠNG CÁ NHÂN HÓA CHO TỪNG BÉ</h2>
            <p class="mb-10 text-lg leading-relaxed max-w-2xl mx-auto text-sleep-200">
                Mỗi em bé là một cá thể riêng biệt với tình trạng đường ruột và cơ địa khác nhau. Để xây dựng lộ trình dinh dưỡng và can thiệp sinh học phù hợp nhất cho con mình, ba mẹ vui lòng liên hệ:
            </p>
            
            <div class="flex flex-col sm:flex-row justify-center items-center gap-5 mb-12">
                <a href="tel:0988717107" class="bg-calm-DEFAULT hover:bg-calm-dark text-white font-bold py-4 px-8 rounded-full transition-transform transform hover:-translate-y-1 flex items-center gap-3 w-full sm:w-auto justify-center shadow-lg">
                    <span class="text-xl">📞</span> Hotline/Zalo: 0988.71.71.07
                </a>
                <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-4 px-8 rounded-full transition-transform transform hover:-translate-y-1 flex items-center gap-3 w-full sm:w-auto justify-center shadow-lg">
                    <span class="text-xl">💬</span> Tham gia Nhóm Zalo Hỗ Trợ
                </a>
            </div>

            <div class="flex flex-col md:flex-row justify-center gap-8 text-base font-semibold bg-sleep-800 p-6 rounded-2xl inline-flex flex-wrap shadow-inner">
                <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="hover:text-calm-light transition-colors flex items-center gap-2">
                    <span>🌐</span> Fanpage: Trợ lý Nam Khánh
                </a>
                <span class="hidden md:inline text-sleep-600">|</span>
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="hover:text-calm-light transition-colors flex items-center gap-2">
                    <span>🤝</span> Cộng đồng FB: Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân
                </a>
            </div>
            
            <div class="mt-16 pt-8 border-t border-sleep-700/50">
                <p class="text-xl font-heading font-bold text-calm-light italic leading-relaxed">
                    "Một đêm ngon giấc không chỉ xoa dịu hệ thần kinh đang quá tải, mà còn là chìa khóa vàng giúp não bộ tự chữa lành và mở ra cơ hội phục hồi toàn diện cho con."
                </p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            
            const foodData = [
                {
                    id: 'tryptophan',
                    title: '1. Nhóm Tryptophan',
                    subtitle: 'Nguyên liệu gốc tạo giấc ngủ',
                    icon: '🥩',
                    color: '#4f46e5',
                    items: [
                        '<strong>Thịt lườn gà (Ức gà ta):</strong> Chứa hàm lượng Tryptophan cao bậc nhất.',
                        '<strong>Trứng gà ta:</strong> Rất tốt khi luộc lòng đào, hấp hoặc đúc thịt để giữ trọn vẹn dinh dưỡng.',
                        '<strong>Hạt bí ngô, hạt hướng dương:</strong> Lành tính, an toàn, dễ xay nhuyễn trộn vào thức ăn.'
                    ]
                },
                {
                    id: 'carbs',
                    title: '2. Nhóm tinh bột chậm',
                    subtitle: 'Người mở đường',
                    icon: '🍠',
                    color: '#f97316',
                    items: [
                        '<strong>Khoai lang mật, bí đỏ:</strong> Vị ngọt tự nhiên, giàu chất xơ, không làm đường huyết tăng vọt gây kích thích.',
                        '<strong>Gạo mầm, gạo lứt xát dối, yến mạch:</strong> Giàu Vitamin B giúp phục hồi màng thần kinh.'
                    ]
                },
                {
                    id: 'magnesium',
                    title: '3. Nhóm Magie',
                    subtitle: 'Giãn cơ, xoa dịu thần kinh',
                    icon: '🥬',
                    color: '#22c55e',
                    items: [
                        '<strong>Rau ngót, mồng tơi, rau lang:</strong> Các loại rau xanh đậm của Việt Nam là kho Magie tự nhiên khổng lồ.',
                        'Tác dụng: Magie giúp các bó cơ của con bớt căng cứng, giảm bồn chồn, trằn trọc.'
                    ]
                },
                {
                    id: 'vitb6',
                    title: '4. Nhóm Vitamin B6',
                    subtitle: 'Xúc tác chuyển hóa',
                    icon: '🍌',
                    color: '#eab308',
                    items: [
                        '<strong>Chuối tây chín (chuối trứng cuốc):</strong> Vừa có B6 giúp tạo Serotonin, vừa có Magie giúp thư giãn.',
                        '<strong>Bơ sáp:</strong> Nguồn chất béo tốt giúp giảm viêm màng não.'
                    ]
                }
            ];

            const menusData = [
                {
                    id: 1,
                    name: 'Thực Đơn 1',
                    theme: 'Bữa Cơm Xoa Dịu Thần Kinh',
                    main: 'Cơm gạo mầm (hoặc gạo xát dối) ăn kèm <strong>Thịt lườn gà ta</strong> thái hạt lựu xào nấm rơm (Nấm rơm bổ sung Kẽm).',
                    soup: 'Canh <strong>rau ngót</strong> nấu thịt nạc băm (Cung cấp Magie tự nhiên).',
                    dessert: '1/2 quả <strong>chuối tây chín</strong> (Ăn sau bữa 30 phút).'
                },
                {
                    id: 2,
                    name: 'Thực Đơn 2',
                    theme: 'Bữa Ăn Nhẹ Bụng, Phục Hồi Ruột',
                    main: 'Cháo <strong>yến mạch</strong> nấu với <strong>bí đỏ</strong> và tôm đất băm nhuyễn. <em>(Yến mạch + Bí đỏ là bộ đôi hoàn hảo đưa Tryptophan lên não)</em>.',
                    soup: 'Khi tắt bếp, trộn 1 thìa <strong>dầu dừa ép lạnh</strong> (hoặc dầu Sachi) vào cháo để kháng viêm ruột.',
                    dessert: '1/4 quả <strong>bơ sáp</strong> dằm.'
                },
                {
                    id: 3,
                    name: 'Thực Đơn 3',
                    theme: 'Bữa Cơm An Thần Truyền Thống',
                    main: '<strong>Trứng gà ta</strong> đúc thịt heo băm (Áp chảo bằng mỡ lợn sạch hoặc dầu dừa). Kèm 1 củ <strong>khoai lang</strong> luộc nhỏ (Ăn thay cho 1 phần cơm trắng để ổn định đường huyết).',
                    soup: 'Canh <strong>mồng tơi</strong> nấu ngao hoặc canh <strong>rau lang</strong> nấu tôm.',
                    dessert: '<em>Khoai lang trong bữa chính đã đóng vai trò tinh bột chậm tạo vị ngọt.</em>'
                },
                {
                    id: 4,
                    name: 'Thực Đơn 4',
                    theme: 'Kết Hợp "Thực Vật - Động Vật"',
                    main: 'Cơm gạo lứt (hoặc gạo xát dối) rắc <strong>hạt bí ngô</strong> rang giã dối. Ăn kèm <strong>Ức gà ta</strong> xé phay trộn chút dầu mè và muối hồng (Giúp con nhận trọn vẹn Tryptophan mà không bị ngấy).',
                    soup: 'Canh <strong>bí đỏ</strong> nấu mọc (thịt heo băm) mềm ngọt, dễ tiêu hóa.',
                    dessert: '1/4 quả <strong>bơ sáp</strong> cắt miếng nhỏ, rưới thêm một chút xíu sữa hạt (không đường).'
                }
            ];

            const ctx = document.getElementById('foodChart').getContext('2d');
            const detailPanel = document.getElementById('food-detail-panel');
            let activeChartIndex = -1;

            const myChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: foodData.map(f => f.title.substring(3)),
                    datasets: [{
                        data: [30, 25, 25, 20],
                        backgroundColor: foodData.map(f => f.color),
                        borderWidth: 2,
                        borderColor: '#ffffff',
                        hoverOffset: 15
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom',
                            labels: {
                                font: { family: 'Nunito', size: 13, weight: 'bold' },
                                color: '#334155',
                                padding: 20,
                                usePointStyle: true
                            }
                        },
                        tooltip: {
                            callbacks: {
                                label: function(context) {
                                    return ' ' + foodData[context.dataIndex].subtitle;
                                }
                            },
                            backgroundColor: 'rgba(15, 23, 42, 0.9)',
                            titleFont: { family: 'Nunito', size: 14 },
                            bodyFont: { family: 'Nunito', size: 13 },
                            padding: 12,
                            cornerRadius: 8
                        }
                    },
                    cutout: '60%',
                    onClick: (e, activeElements) => {
                        if (activeElements.length > 0) {
                            const dataIndex = activeElements[0].index;
                            updateDetailPanel(dataIndex);
                        } else {
                            resetDetailPanel();
                        }
                    },
                    onHover: (e, activeElements) => {
                        e.native.target.style.cursor = activeElements.length ? 'pointer' : 'default';
                    }
                }
            });

            function updateDetailPanel(index) {
                if (activeChartIndex === index) return;
                activeChartIndex = index;
                const group = foodData[index];
                
                detailPanel.classList.remove('fade-in');
                void detailPanel.offsetWidth;
                
                detailPanel.style.borderColor = group.color;
                detailPanel.style.backgroundColor = '#ffffff';
                
                detailPanel.innerHTML = `
                    <div class="flex items-start gap-5">
                        <div class="text-6xl bg-sleep-50 rounded-2xl p-4 shadow-inner">${group.icon}</div>
                        <div>
                            <span class="inline-block px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wide text-white mb-2" style="background-color: ${group.color}">
                                ${group.subtitle}
                            </span>
                            <h4 class="font-heading font-bold text-sleep-800 text-2xl mb-4">${group.title}</h4>
                            <ul class="text-base text-sleep-700 space-y-3">
                                ${group.items.map(item => `<li class="flex items-start gap-2"><span style="color: ${group.color}">✓</span> <span>${item}</span></li>`).join('')}
                            </ul>
                        </div>
                    </div>
                `;
                
                detailPanel.classList.add('fade-in');
            }

            function resetDetailPanel() {
                activeChartIndex = -1;
                detailPanel.style.borderColor = '#6366f1';
                detailPanel.style.backgroundColor = '#f8fafc';
                detailPanel.innerHTML = `
                    <div class="text-center text-sleep-400 my-auto">
                        <span class="text-4xl block mb-4 animate-bounce">👆</span>
                        <p class="text-lg">Hãy nhấp vào biểu đồ bên trái để khám phá chức năng sinh học của từng nhóm thực phẩm.</p>
                    </div>
                `;
            }

            const menuNav = document.getElementById('menu-nav');
            const menuDisplay = document.getElementById('menu-display');
            let currentMenuId = 1;

            function renderMenuPills() {
                menuNav.innerHTML = '';
                menusData.forEach(menu => {
                    const btn = document.createElement('button');
                    const isActive = menu.id === currentMenuId;
                    btn.className = `whitespace-nowrap px-8 py-3 rounded-full font-bold text-sm md:text-base transition-all-custom transform ${isActive ? 'bg-indigo-600 text-white shadow-lg scale-105' : 'bg-white text-sleep-600 border border-sleep-200 hover:bg-indigo-50 hover:text-indigo-600'}`;
                    btn.innerText = menu.name;
                    btn.onclick = () => {
                        currentMenuId = menu.id;
                        renderMenuPills();
                        renderMenuContent();
                    };
                    menuNav.appendChild(btn);
                });
            }

            function renderMenuContent() {
                const menu = menusData.find(m => m.id === currentMenuId);
                
                menuDisplay.classList.remove('fade-in');
                void menuDisplay.offsetWidth;
                menuDisplay.classList.add('fade-in');

                menuDisplay.innerHTML = `
                    <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-50 rounded-bl-full -z-10 opacity-50"></div>
                    <div class="text-center mb-10 pb-6 border-b border-sleep-100">
                        <span class="inline-block bg-calm-light text-calm-dark px-4 py-1.5 rounded-full text-xs font-bold mb-3 uppercase tracking-wider">Trọng Tâm Dinh Dưỡng</span>
                        <h3 class="text-3xl font-heading font-bold text-sleep-800">${menu.theme}</h3>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 relative z-10">
                        <div class="bg-indigo-50/50 p-6 rounded-3xl hover:bg-indigo-50 transition-colors border border-indigo-100/50">
                            <div class="flex flex-col items-center text-center gap-2 mb-4">
                                <span class="text-4xl bg-white p-3 rounded-2xl shadow-sm mb-2">🍲</span>
                                <h4 class="font-bold text-indigo-700 text-lg uppercase tracking-wide">Món Chính</h4>
                            </div>
                            <p class="text-sleep-700 text-base leading-relaxed text-center">${menu.main}</p>
                        </div>
                        
                        <div class="bg-calm-light/30 p-6 rounded-3xl hover:bg-calm-light/50 transition-colors border border-calm-DEFAULT/10">
                            <div class="flex flex-col items-center text-center gap-2 mb-4">
                                <span class="text-4xl bg-white p-3 rounded-2xl shadow-sm mb-2">🥣</span>
                                <h4 class="font-bold text-calm-dark text-lg uppercase tracking-wide">Món Canh / Phụ</h4>
                            </div>
                            <p class="text-sleep-700 text-base leading-relaxed text-center">${menu.soup}</p>
                        </div>
                        
                        <div class="bg-warm-light/40 p-6 rounded-3xl hover:bg-warm-light/60 transition-colors border border-warm-DEFAULT/10">
                            <div class="flex flex-col items-center text-center gap-2 mb-4">
                                <span class="text-4xl bg-white p-3 rounded-2xl shadow-sm mb-2">🍌</span>
                                <h4 class="font-bold text-warm-DEFAULT text-lg uppercase tracking-wide">Tráng Miệng</h4>
                            </div>
                            <p class="text-sleep-700 text-base leading-relaxed text-center">${menu.dessert}</p>
                        </div>
                    </div>
                `;
            }

            renderMenuPills();
            renderMenuContent();

            const btnToggleLight = document.getElementById('toggle-light-btn');
            const envSection = document.getElementById('environment-section');
            const envTitle = document.getElementById('env-title');
            const envDesc = document.getElementById('env-desc');
            const btnIcon = document.getElementById('btn-icon');
            const btnText = document.getElementById('btn-text');
            const secretBox = document.getElementById('melatonin-secret');
            let isDark = false;

            btnToggleLight.addEventListener('click', () => {
                isDark = !isDark;
                
                if(isDark) {
                    envSection.classList.remove('bg-white');
                    envSection.classList.add('bg-sleep-900');
                    
                    envTitle.classList.remove('text-sleep-800');
                    envTitle.classList.add('text-white');
                    
                    envDesc.classList.remove('text-sleep-600');
                    envDesc.classList.add('text-sleep-300');
                    
                    btnToggleLight.classList.remove('bg-sleep-800', 'text-white', 'hover:bg-black', 'focus:ring-sleep-300');
                    btnToggleLight.classList.add('bg-warm-DEFAULT', 'text-white', 'hover:bg-warm-400', 'focus:ring-warm-200');
                    
                    btnIcon.innerText = '☀️';
                    btnText.innerText = 'Bật Đèn Trở Lại';

                    secretBox.classList.remove('opacity-0', 'translate-y-10', 'h-0');
                    secretBox.classList.add('opacity-100', 'translate-y-0', 'h-auto');
                    
                } else {
                    envSection.classList.add('bg-white');
                    envSection.classList.remove('bg-sleep-900');
                    
                    envTitle.classList.add('text-sleep-800');
                    envTitle.classList.remove('text-white');
                    
                    envDesc.classList.add('text-sleep-600');
                    envDesc.classList.remove('text-sleep-300');
                    
                    btnToggleLight.classList.add('bg-sleep-800', 'text-white', 'hover:bg-black', 'focus:ring-sleep-300');
                    btnToggleLight.classList.remove('bg-warm-DEFAULT', 'text-white', 'hover:bg-warm-400', 'focus:ring-warm-200');
                    
                    btnIcon.innerText = '🌙';
                    btnText.innerText = 'Tắt Đèn Phòng Ngủ';

                    secretBox.classList.add('opacity-0', 'translate-y-10');
                    secretBox.classList.remove('opacity-100', 'translate-y-0');
                    
                    setTimeout(() => {
                        if(!isDark) {
                           secretBox.classList.add('h-0');
                           secretBox.classList.remove('h-auto');
                        }
                    }, 1000);
                }
            });
        });
    </script>
</body>

