<?php
/**
 * Template Name: Trang Dinh dưỡng giấc ngủ
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loạn Khuẩn Đường Ruột - Hành Trình Thấu Hiểu</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Chosen Palette: Zen Garden (Stone, Sage Green, Terracotta, Soft Sand) -->
    <!-- Application Structure Plan: Nâng cấp phần Giải pháp dinh dưỡng thành một "Cẩm nang phục hồi hệ sinh thái" chi tiết. Sử dụng hình ảnh ẩn dụ khu vườn để cha mẹ dễ hình dung các bước: Cải tạo đất (Butyrate), Bón phân (Prebiotics) và Gieo hạt (Probiotics). Thêm các thẻ thực phẩm tương tác và biểu đồ sắc màu (Rainbow Diet). -->
    <!-- Visualization & Content Choices: 
         1. Doughnut Chart: Minh họa hệ vi sinh.
         2. Interactive Mechanism Cards: Giải thích cơ chế độc tính.
         3. Prebiotic Ranking Bar Chart: So sánh sức mạnh các loại chất xơ.
         4. Food Cards: Thẻ chi tiết về cách chế biến và lợi ích của thực phẩm vàng. -->
    <!-- CONFIRMATION: NO SVG graphics used. NO Mermaid JS used. -->

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #fafaf9; color: #292524; }
        
        .chart-container {
            position: relative;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            height: 350px;
            max-height: 400px;
        }

        .journey-dot { position: relative; }
        .journey-dot::after {
            content: '';
            position: absolute;
            left: 50%;
            bottom: -2.5rem;
            width: 2px;
            height: 2.5rem;
            background: #e7e5e4;
            transform: translateX(-50%);
        }

        .section-reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .section-reveal.visible { opacity: 1; transform: translateY(0); }

        .mechanism-card, .food-card { transition: all 0.3s ease; border: 1px solid #e7e5e4; }
        .mechanism-card.active, .food-card:hover { border-color: #f43f5e; box-shadow: 0 20px 25px -5px rgba(244, 63, 94, 0.1); transform: translateY(-4px); }
        
        .mechanism-details, .food-details { max-height: 0; overflow: hidden; transition: max-height 0.5s ease; }
        .mechanism-card.active .mechanism-details, .food-card.active .food-details { max-height: 500px; }

        .nav-link.active { color: #166534; font-weight: 700; }

        .cta-link { transition: all 0.2s ease; }
        .cta-link:hover { transform: translateY(-2px); filter: brightness(1.05); }

        .rainbow-grid div { height: 40px; border-radius: 8px; transition: transform 0.2s; cursor: help; }
        .rainbow-grid div:hover { transform: scale(1.1); }
    </style>
</head>
<body class="antialiased min-h-screen">

    <!-- Narrative Header -->
    <header class="bg-white/80 backdrop-blur-md border-b border-stone-200 sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-6 flex justify-between items-center py-4">
            <div class="flex items-center space-x-2">
                <span class="text-emerald-700 text-2xl">&#10045;</span>
                <span class="text-stone-900 font-bold tracking-tight">Hành Trình Thấu Hiểu Con</span>
            </div>
            <nav class="hidden md:flex space-x-8">
                <a href="#intro" class="nav-link text-sm text-stone-500 hover:text-emerald-700 transition-colors">Khởi đầu</a>
                <a href="#chaos" class="nav-link text-sm text-stone-500 hover:text-emerald-700 transition-colors">Ẩn họa</a>
                <a href="#hope" class="nav-link text-sm text-stone-500 hover:text-emerald-700 transition-colors">Hy vọng</a>
                <a href="#action" class="nav-link text-sm text-stone-500 hover:text-emerald-700 transition-colors">Giải pháp</a>
            </nav>
            <div class="md:hidden">
                <a href="tel:0988717107" class="text-emerald-700 text-xl">&#9990;</a>
            </div>
        </div>
    </header>

    <main>
        <!-- Start: Overview -->
        <section id="intro" class="section-reveal py-20 bg-white">
            <div class="max-w-4xl mx-auto px-6 text-center">
                <div class="journey-dot mb-8">
                    <span class="w-12 h-12 bg-stone-900 text-white rounded-full inline-flex items-center justify-center font-serif italic text-xl">1</span>
                </div>
                <h2 class="text-4xl font-extrabold text-stone-900 mb-6 leading-tight">Thấu hiểu "Vũ trụ" bên trong con</h2>
                <p class="text-lg text-stone-600 leading-relaxed mb-12">
                    Mọi hành vi "bất thường" của con đều là tiếng kêu cứu từ một hệ sinh thái đang bị tàn phá. Tự kỷ là một tình trạng sinh lý học phức tạp, không phải là khiếm khuyết tâm lý.
                </p>
                
                <div class="bg-stone-50 rounded-3xl p-8 border border-stone-100 shadow-sm">
                    <div class="flex flex-col md:flex-row items-center gap-10">
                        <div class="w-full md:w-1/2">
                            <div class="chart-container">
                                <canvas id="gutStateChart"></canvas>
                            </div>
                        </div>
                        <div class="w-full md:w-1/2 text-left space-y-6">
                            <h3 class="text-xl font-bold text-stone-800">Sự dịch chuyển Hệ sinh thái</h3>
                            <p class="text-sm text-stone-500">Mô phỏng sự thay đổi tỷ lệ vi khuẩn khi xảy ra loạn khuẩn (Dysbiosis).</p>
                            <button onclick="app.toggleState()" class="px-6 py-3 bg-stone-900 text-white text-sm font-bold rounded-full hover:bg-stone-800 transition-all flex items-center space-x-2">
                                <span id="btn-text">Mô phỏng Loạn Khuẩn</span>
                                <span>&#8646;</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Chaos: Mechanisms -->
        <section id="chaos" class="section-reveal py-24 bg-stone-50">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <div class="journey-dot mb-8">
                        <span class="w-12 h-12 bg-rose-600 text-white rounded-full inline-flex items-center justify-center font-serif italic text-xl">2</span>
                    </div>
                    <h2 class="text-3xl font-extrabold text-stone-900 mb-4">Khi "Kẻ cướp" chiếm quyền điều khiển</h2>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div class="mechanism-card bg-white p-8 rounded-2xl cursor-pointer group" onclick="app.toggleMechanism(this)">
                        <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center text-2xl mb-6 shadow-sm">&#9889;</div>
                        <h3 class="text-xl font-bold text-stone-800 mb-3">Suy kiệt năng lượng</h3>
                        <div class="mechanism-details border-t border-stone-100 pt-4">
                            <p class="text-sm text-stone-600">Hại khuẩn cướp vitamin/khoáng chất làm <strong>Ty thể</strong> suy yếu. Trẻ thiếu ATP (năng lượng) dẫn đến mệt mỏi, cáu gắt.</p>
                        </div>
                    </div>
                    <div class="mechanism-card bg-white p-8 rounded-2xl cursor-pointer group" onclick="app.toggleMechanism(this)">
                        <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center text-2xl mb-6 shadow-sm">&#129514;</div>
                        <h3 class="text-xl font-bold text-stone-800 mb-3">Độc tố nội sinh</h3>
                        <div class="mechanism-details border-t border-stone-100 pt-4">
                            <p class="text-sm text-stone-600">Chất thải p-cresol và Acetaldehyde xuyên qua niêm mạc ruột viêm, đi thẳng vào máu lên não.</p>
                        </div>
                    </div>
                    <div class="mechanism-card bg-white p-8 rounded-2xl cursor-pointer group" onclick="app.toggleMechanism(this)">
                        <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-full flex items-center justify-center text-2xl mb-6 shadow-sm">&#129496;</div>
                        <h3 class="text-xl font-bold text-stone-800 mb-3">Say độc tính</h3>
                        <div class="mechanism-details border-t border-stone-100 pt-4">
                            <p class="text-sm text-stone-600">Tắc nghẽn thụ thể thần kinh, gây trạng thái đờ đẫn, lăng xăng vô thức như đang say rượu.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Hope: Butyrate -->
        <section id="hope" class="section-reveal py-24 bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="journey-dot mb-8">
                            <span class="w-12 h-12 bg-emerald-700 text-white rounded-full inline-flex items-center justify-center font-serif italic text-xl">3</span>
                        </div>
                        <h2 class="text-4xl font-extrabold text-stone-900 mb-6">Butyrate: Vệ sĩ thầm lặng</h2>
                        <p class="text-lg text-stone-600 mb-8">Vũ khí mạnh nhất của lợi khuẩn để hàn gắn tổn thương.</p>
                        <div class="space-y-6">
                            <div class="flex items-start gap-4">
                                <span class="text-emerald-600 text-2xl">&#10004;</span>
                                <div><h4 class="font-bold">Hàn gắn màng ruột</h4><p class="text-sm text-stone-500">Cấp năng lượng cho tế bào biểu mô, đóng lại các lỗ rò rỉ.</p></div>
                            </div>
                            <div class="flex items-start gap-4">
                                <span class="text-emerald-600 text-2xl">&#10004;</span>
                                <div><h4 class="font-bold">Chống viêm thần kinh</h4><p class="text-sm text-stone-500">Vượt hàng rào máu não, xoa dịu các ổ viêm, hỗ trợ nhận thức.</p></div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-stone-50 p-10 rounded-3xl border border-stone-100 shadow-xl">
                        <div class="chart-container" style="height: 250px;">
                            <canvas id="butyrateImpactChart"></canvas>
                        </div>
                        <p class="text-center text-xs text-stone-400 mt-6 italic">Butyrate là "thức ăn" tối thượng của niêm mạc ruột.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Action: Nutrition (DETAILED VERSION) -->
        <section id="action" class="section-reveal py-24 bg-stone-900 text-white overflow-hidden">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <div class="journey-dot mb-8">
                        <span class="w-12 h-12 bg-amber-500 text-stone-900 rounded-full inline-flex items-center justify-center font-serif italic text-xl">4</span>
                    </div>
                    <h2 class="text-3xl font-extrabold mb-4">Nghệ thuật phục hồi hệ sinh thái</h2>
                    <p class="text-stone-400 max-w-2xl mx-auto">
                        Đừng chỉ "nhổ cỏ dại" bằng kháng sinh. Hãy học cách "cải tạo đất" và "bón phân" để khu vườn bên trong con tự chữa lành.
                    </p>
                </div>

                <!-- Concept: The Restoration Toolkit -->
                <div class="grid lg:grid-cols-3 gap-8 mb-20">
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
                        <div class="text-amber-500 text-3xl mb-4">&#127793;</div>
                        <h4 class="text-xl font-bold mb-3 italic">Giai đoạn 1: Bón Phân (Prebiotics)</h4>
                        <p class="text-sm text-stone-400 leading-relaxed">Cung cấp thức ăn để lợi khuẩn có sẵn trong ruột sinh sôi và sản xuất Butyrate. Đây là bước quan trọng nhất.</p>
                    </div>
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
                        <div class="text-emerald-500 text-3xl mb-4">&#127793;</div>
                        <h4 class="text-xl font-bold mb-3 italic">Giai đoạn 2: Gieo Hạt (Probiotics)</h4>
                        <p class="text-sm text-stone-400 leading-relaxed">Bổ sung các chủng lợi khuẩn mới. Chỉ hiệu quả khi đã có sẵn "phân bón" (Prebiotics) và "đất nền" tốt.</p>
                    </div>
                    <div class="p-8 rounded-3xl bg-white/5 border border-white/10">
                        <div class="text-blue-500 text-3xl mb-4">&#127793;</div>
                        <h4 class="text-xl font-bold mb-3 italic">Giai đoạn 3: Cải Tạo Đất (Polyphenols)</h4>
                        <p class="text-sm text-stone-400 leading-relaxed">Dùng các hợp chất chống oxy hóa từ thực vật đa sắc màu để dập tắt các ổ viêm và nuôi dưỡng đa dạng chủng loại.</p>
                    </div>
                </div>

                <!-- Deep Dive: Siêu thực phẩm vàng -->
                <div class="mb-16">
                    <h3 class="text-2xl font-bold text-amber-400 mb-8 text-center uppercase tracking-widest">Danh mục thực phẩm phục hồi</h3>
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Food 1 -->
                        <div class="food-card bg-white/5 p-6 rounded-2xl cursor-pointer" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-3xl">&#127820;</span>
                                <span class="bg-amber-900/30 text-amber-500 text-[10px] px-2 py-1 rounded">Siêu thực phẩm</span>
                            </div>
                            <h5 class="font-bold text-white">Chuối Xanh</h5>
                            <p class="text-xs text-stone-500 mt-2">Nguồn Tinh bột kháng dồi dào nhất.</p>
                            <div class="food-details mt-4 pt-4 border-t border-white/10">
                                <p class="text-xs text-stone-300 leading-relaxed">
                                    <strong>Cách dùng:</strong> Luộc sơ cả vỏ (rửa sạch) hoặc thái lát mỏng nấu canh/súp. Lợi khuẩn sẽ lên men chúng thành Butyrate - vệ sĩ màng ruột.
                                </p>
                            </div>
                        </div>
                        <!-- Food 2 -->
                        <div class="food-card bg-white/5 p-6 rounded-2xl cursor-pointer" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-3xl">&#129476;</span>
                                <span class="bg-stone-700 text-stone-300 text-[10px] px-2 py-1 rounded">Gia vị nền</span>
                            </div>
                            <h5 class="font-bold text-white">Hành & Tỏi</h5>
                            <p class="text-xs text-stone-500 mt-2">Giàu Inulin và FOS.</p>
                            <div class="food-details mt-4 pt-4 border-t border-white/10">
                                <p class="text-xs text-stone-300 leading-relaxed">
                                    <strong>Cách dùng:</strong> Sử dụng làm gia vị trong các món hầm, xào. Là món khoái khẩu của chủng <em>Bifidobacterium</em>.
                                </p>
                            </div>
                        </div>
                        <!-- Food 3 -->
                        <div class="food-card bg-white/5 p-6 rounded-2xl cursor-pointer" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-3xl">&#129361;</span>
                                <span class="bg-emerald-900/30 text-emerald-500 text-[10px] px-2 py-1 rounded">Cao cấp</span>
                            </div>
                            <h5 class="font-bold text-white">Măng Tây</h5>
                            <p class="text-xs text-stone-500 mt-2">Đa dạng hóa vi sinh.</p>
                            <div class="food-details mt-4 pt-4 border-t border-white/10">
                                <p class="text-xs text-stone-300 leading-relaxed">
                                    Chứa các sợi xơ hòa tan giúp nuôi dưỡng nhiều chủng lợi khuẩn cùng lúc, tăng tính đa dạng sinh học trong ruột.
                                </p>
                            </div>
                        </div>
                        <!-- Food 4 -->
                        <div class="food-card bg-white/5 p-6 rounded-2xl cursor-pointer" onclick="app.toggleFood(this)">
                            <div class="flex justify-between items-start mb-4">
                                <span class="text-3xl">&#127794;</span>
                                <span class="bg-blue-900/30 text-blue-400 text-[10px] px-2 py-1 rounded">Hỗ trợ</span>
                            </div>
                            <h5 class="font-bold text-white">Các loại Hạt</h5>
                            <p class="text-xs text-stone-500 mt-2">Kẽm và Omega thực vật.</p>
                            <div class="food-details mt-4 pt-4 border-t border-white/10">
                                <p class="text-xs text-stone-300 leading-relaxed">
                                    Hạt bí, hướng dường không chỉ có xơ mà còn giàu khoáng chất giúp niêm mạc ruột chống lại các tác nhân viêm.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Principle: Rainbow Diet -->
                <div class="grid lg:grid-cols-2 gap-12 items-center mb-16">
                    <div>
                        <h4 class="text-2xl font-bold mb-4">Nguyên lý "Ăn chiếc cầu vồng"</h4>
                        <p class="text-stone-400 text-sm leading-relaxed mb-6">
                            Mỗi sắc màu đại diện cho các hợp chất Polyphenol khác nhau. Sự đa dạng về màu sắc giúp nuôi dưỡng các chủng vi khuẩn khác nhau, tạo nên một hệ sinh thái bền vững.
                        </p>
                        <div class="rainbow-grid grid grid-cols-5 gap-2">
                            <div class="bg-red-600" title="Cà chua, củ dền (Chống viêm)"></div>
                            <div class="bg-orange-500" title="Cà rốt, bí đỏ (Vitamin A)"></div>
                            <div class="bg-yellow-400" title="Ớt chuông vàng (Cải thiện tiêu hóa)"></div>
                            <div class="bg-green-600" title="Cải xanh, măng tây (Prebiotics)"></div>
                            <div class="bg-purple-700" title="Bắp cải tím, việt quất (Chống oxy hóa não)"></div>
                        </div>
                        <p class="text-[10px] text-stone-500 mt-4 italic">* Di chuột vào các ô màu để xem gợi ý thực phẩm.</p>
                    </div>
                    <div class="bg-white p-6 rounded-3xl border border-white/10">
                        <h4 class="text-stone-800 text-center font-bold text-sm mb-4 uppercase">Ưu tiên Prebiotics trong thực phẩm</h4>
                        <div class="chart-container" style="height: 250px;">
                            <canvas id="prebioticChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Safety Protocol -->
                <div class="max-w-3xl mx-auto bg-amber-900/20 border-2 border-amber-900/50 p-8 rounded-3xl text-center">
                    <h4 class="text-xl font-bold text-amber-400 mb-4">&#9888; Ghi nhớ: Nguyên tắc "Nhỏ và Chậm"</h4>
                    <p class="text-sm text-amber-100 leading-relaxed mb-4">
                        Đường ruột của trẻ đang tổn thương rất nhạy cảm. Việc tăng đột ngột chất xơ có thể gây đầy hơi và bứt rứt hành vi. 
                    </p>
                    <div class="flex justify-center space-x-6">
                        <div class="text-xs"><span class="block text-xl mb-1">&#128301;</span>Quan sát phân</div>
                        <div class="text-xs"><span class="block text-xl mb-1">&#128338;</span>Tăng liều sau 3-5 ngày</div>
                        <div class="text-xs"><span class="block text-xl mb-1">&#128203;</span>Ghi nhật ký ăn uống</div>
                    </div>
                </div>

                <!-- NEW: Integrated Links Section -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4 mt-20">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="cta-link p-6 rounded-2xl bg-blue-600 text-center flex flex-col items-center">
                        <span class="text-2xl mb-2">&#128101;</span>
                        <span class="font-bold text-sm">Group Hiểu con từ Gốc</span>
                    </a>
                    <a href="https://zalo.me/g/vmgfxy834" target="_blank" class="cta-link p-6 rounded-2xl bg-emerald-600 text-center flex flex-col items-center">
                        <span class="text-2xl mb-2">&#128172;</span>
                        <span class="font-bold text-sm">Cộng đồng Zalo</span>
                    </a>
                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank" class="cta-link p-6 rounded-2xl bg-stone-700 text-center flex flex-col items-center">
                        <span class="text-2xl mb-2">&#128100;</span>
                        <span class="font-bold text-sm">Trợ lý Nam Khánh</span>
                    </a>
                    <a href="tel:0988717107" class="cta-link p-6 rounded-2xl bg-amber-600 text-center flex flex-col items-center">
                        <span class="text-2xl mb-2">&#9990;</span>
                        <span class="font-bold text-sm">Hotline: 0988.717.107</span>
                    </a>
                </div>
            </div>
        </section>
    </main>

    <footer class="bg-stone-50 py-20 border-t border-stone-200">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-bold text-stone-900 mb-6 italic">Hành trình này bạn không đơn độc</h2>
            <p class="text-stone-500 mb-12">Kiên nhẫn nuôi dưỡng "khu vườn" bên trong con là sự hy sinh thầm lặng nhưng vĩ đại nhất của người làm cha mẹ.</p>
            <div class="text-[10px] text-stone-400 uppercase tracking-widest mb-4">Tuyên bố miễn trừ trách nhiệm y khoa</div>
            <p class="text-[10px] text-stone-400 leading-relaxed max-w-2xl mx-auto italic">
                Nội dung hoàn toàn dựa trên phân tích khoa học thực chứng và cơ chế sinh hóa nội sinh. Thông tin không thay thế cho chẩn đoán chuyên nghiệp. Mọi thay đổi về chế độ ăn của trẻ cần được thực hiện dưới sự giám sát của chuyên gia y tế.
            </p>
        </div>
    </footer>

    <script>
        const app = {
            charts: {},
            isDysbiosis: false,

            init: function() {
                this.initCharts();
                this.initScrollObservers();
                this.initScrollSpy();
            },

            initCharts: function() {
                // Main Gut State Chart
                const gutCtx = document.getElementById('gutStateChart').getContext('2d');
                this.charts.gut = new Chart(gutCtx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Lợi Khuẩn', 'Hại Khuẩn', 'Nấm Men'],
                        datasets: [{
                            data: [85, 10, 5],
                            backgroundColor: ['#059669', '#d6d3d1', '#fda4af'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        cutout: '75%',
                        plugins: { legend: { display: false } }
                    }
                });

                // Butyrate Chart
                const butyrateCtx = document.getElementById('butyrateImpactChart').getContext('2d');
                this.charts.butyrate = new Chart(butyrateCtx, {
                    type: 'line',
                    data: {
                        labels: ['Tháng 0', 'Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4'],
                        datasets: [{
                            label: 'Phục hồi Niêm mạc (%)',
                            data: [10, 30, 60, 85, 95],
                            borderColor: '#10b981',
                            backgroundColor: 'rgba(16, 185, 129, 0.1)',
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { y: { beginAtZero: true, max: 100 }, x: { grid: { display: false } } }
                    }
                });

                // Prebiotic Chart
                const preCtx = document.getElementById('prebioticChart').getContext('2d');
                this.charts.prebiotic = new Chart(preCtx, {
                    type: 'bar',
                    data: {
                        labels: ['Chuối xanh', 'Măng tây', 'Hành tây', 'Hạt bí'],
                        datasets: [{
                            data: [95, 80, 75, 60],
                            backgroundColor: ['#f59e0b', '#10b981', '#6366f1', '#4b5563'],
                            borderRadius: 8
                        }]
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: { legend: { display: false } },
                        scales: { x: { display: false }, y: { grid: { display: false } } }
                    }
                });
            },

            toggleState: function() {
                this.isDysbiosis = !this.isDysbiosis;
                const chart = this.charts.gut;
                const btnText = document.getElementById('btn-text');
                if (this.isDysbiosis) {
                    chart.data.datasets[0].data = [25, 45, 30];
                    chart.data.datasets[0].backgroundColor = ['#a7f3d0', '#e11d48', '#a21caf'];
                    btnText.innerText = 'Phục hồi Cân Bằng';
                } else {
                    chart.data.datasets[0].data = [85, 10, 5];
                    chart.data.datasets[0].backgroundColor = ['#059669', '#d6d3d1', '#fda4af'];
                    btnText.innerText = 'Mô phỏng Loạn Khuẩn';
                }
                chart.update();
            },

            toggleMechanism: function(element) {
                document.querySelectorAll('.mechanism-card').forEach(c => { if (c !== element) c.classList.remove('active'); });
                element.classList.toggle('active');
            },

            toggleFood: function(element) {
                document.querySelectorAll('.food-card').forEach(c => { if (c !== element) c.classList.remove('active'); });
                element.classList.toggle('active');
            },

            initScrollObservers: function() {
                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
                }, { threshold: 0.1 });
                document.querySelectorAll('.section-reveal').forEach(el => observer.observe(el));
            },

            initScrollSpy: function() {
                const navLinks = document.querySelectorAll('.nav-link');
                const sections = document.querySelectorAll('section');
                window.addEventListener('scroll', () => {
                    let current = '';
                    sections.forEach(section => { if (pageYOffset >= section.offsetTop - 100) current = section.getAttribute('id'); });
                    navLinks.forEach(link => {
                        link.classList.remove('active');
                        if (link.getAttribute('href').includes(current)) link.classList.add('active');
                    });
                });
            }
        };

        window.onload = () => app.init();
    </script>
</body>
</html>