<?php
/* Template Name: Bài Viết: Tại Sao Trẻ Tự Kỷ Không Phản Ứng Khi Gọi Tên */
get_header(); 
?>

<!-- Import Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Tích hợp Tailwind CSS qua CDN -->
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    theme: {
      extend: {
        colors: {
          navy: '#002795',
          yellow: '#FFD154',
          cream: '#FAF9F6',
          bgAlt: '#f4f4f0',
          dark: '#3D3D3D',
          textMuted: '#555555',
        },
        fontFamily: {
          oswald: ['Oswald', 'sans-serif'],
          quicksand: ['Quicksand', 'sans-serif'],
        },
        boxShadow: {
          'card': '0 8px 24px rgba(0, 39, 149, 0.08)',
        }
      }
    }
  }
</script>

<div class="font-quicksand text-dark bg-cream text-base leading-relaxed overflow-x-hidden">
    
    <!-- HERO SECTION -->
    <header class="relative py-16 md:py-24 px-5 text-center bg-bgAlt overflow-hidden border-b border-gray-200">
        <!-- Glowing Blobs -->
        <div class="absolute w-[300px] h-[300px] md:w-[400px] md:h-[400px] rounded-full blur-[60px] md:blur-[80px] opacity-60 bg-[radial-gradient(circle,#FFD154_0%,transparent_70%)] -top-[50px] -left-[50px] md:-top-[100px] md:-left-[100px] z-0"></div>
        <div class="absolute w-[300px] h-[300px] md:w-[400px] md:h-[400px] rounded-full blur-[60px] md:blur-[80px] opacity-60 bg-[radial-gradient(circle,rgba(0,39,149,0.15)_0%,transparent_70%)] -bottom-[100px] -right-[50px] md:-bottom-[150px] md:-right-[100px] z-0"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto">
            <div class="flex flex-wrap gap-2.5 justify-center mb-6">
                <span class="bg-yellow/20 text-navy px-4 py-1.5 rounded-full text-sm font-semibold border border-yellow">Dấu hiệu nhận biết tự kỷ sớm</span>
                <span class="bg-yellow/20 text-navy px-4 py-1.5 rounded-full text-sm font-semibold border border-yellow">Trẻ không quay đầu khi gọi tên</span>
                <span class="bg-yellow/20 text-navy px-4 py-1.5 rounded-full text-sm font-semibold border border-yellow">Cách dạy trẻ tương tác</span>
            </div>
            <h1 class="font-oswald text-navy text-3xl md:text-5xl leading-tight mb-6">Tại Sao Trẻ Tự Kỷ Không Phản Ứng Khi Gọi Tên Và Cha Mẹ Cần Làm Gì Để Kết Nối?</h1>
            <div class="text-lg text-textMuted bg-white/80 p-6 md:p-8 rounded-xl backdrop-blur-md shadow-sm">
                Khoảnh khắc cha mẹ gọi tên nhưng con mải mê với đồ chơi, không hề ngoảnh lại luôn mang đến sự lo lắng tột độ. Đi thẳng vào vấn đề: <strong class="text-dark">Trẻ tự kỷ không phản ứng khi gọi tên hoàn toàn không phải vì con cố tình lờ đi</strong>, và phần lớn các bé đều có thính lực bình thường. Đây là một đặc điểm cốt lõi thuộc về thần kinh nhận thức.
            </div>
        </div>
    </header>

    <div class="max-w-[1000px] mx-auto px-5 py-12 md:py-16">
        
        <!-- SECTION 1: CƠ CHẾ -->
        <section class="mb-16">
            <h2 class="font-oswald text-navy text-2xl md:text-4xl leading-tight mt-8 relative">1. Giải Mã Cơ Chế Thần Kinh: Vì Sao Con Lơ Đễnh?</h2>
            <div class="w-14 h-1 rounded bg-yellow my-4"></div>
            <p class="mb-6">Khi thấy con lơ đễnh, phản xạ đầu tiên của nhiều phụ huynh là đưa con đi đo thính lực. Tuy nhiên, sự đứt gãy thực sự nằm ở cách não bộ xử lý thông tin chứ không phải màng nhĩ.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 md:gap-8 mt-8">
                <!-- Card 1 -->
                <div class="group h-[320px] md:h-[350px] [perspective:1000px] bg-transparent cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <!-- Front -->
                        <div class="absolute w-full h-full [backface-visibility:hidden] rounded-xl p-6 md:p-8 flex flex-col justify-center items-center shadow-card bg-white border-2 border-bgAlt">
                            <div class="text-5xl mb-4">🦻</div>
                            <h3 class="font-oswald text-navy text-xl md:text-2xl mb-2">Khả năng "Phát Hiện"</h3>
                            <p class="text-sm text-textMuted">Chạm/Hover để xem sự khác biệt giữa Nghe và Hiểu</p>
                        </div>
                        <!-- Back -->
                        <div class="absolute w-full h-full [backface-visibility:hidden] rounded-xl p-6 md:p-8 flex flex-col justify-center items-start shadow-card bg-navy text-white [transform:rotateY(180deg)] text-left">
                            <h3 class="font-oswald text-yellow text-xl md:text-2xl mb-3">Đứt gãy khâu "Đánh Giá"</h3>
                            <p class="text-sm md:text-base text-white/90">Giai đoạn 1 (Ghi nhận âm thanh): Trẻ làm rất tốt.<br><br>Giai đoạn 2 (Đánh giá ý nghĩa): Hệ thống phần thưởng thần kinh của trẻ không coi tên gọi là tín hiệu xã hội đủ hấp dẫn để ngắt quãng sự tập trung vào đồ vật hiện tại.</p>
                        </div>
                    </div>
                </div>
                <!-- Card 2 -->
                <div class="group h-[320px] md:h-[350px] [perspective:1000px] bg-transparent cursor-pointer">
                    <div class="relative w-full h-full text-center transition-transform duration-700 [transform-style:preserve-3d] group-hover:[transform:rotateY(180deg)]">
                        <!-- Front -->
                        <div class="absolute w-full h-full [backface-visibility:hidden] rounded-xl p-6 md:p-8 flex flex-col justify-center items-center shadow-card bg-white border-2 border-bgAlt">
                            <div class="text-5xl mb-4">🧠</div>
                            <h3 class="font-oswald text-navy text-xl md:text-2xl mb-2">Sóng điện não đồ (ERP)</h3>
                            <p class="text-sm text-textMuted">Sự thật ẩn giấu trong não bộ khi nghe tên gọi</p>
                        </div>
                        <!-- Back -->
                        <div class="absolute w-full h-full [backface-visibility:hidden] rounded-xl p-6 md:p-8 flex flex-col justify-center items-start shadow-card bg-navy text-white [transform:rotateY(180deg)] text-left">
                            <h3 class="font-oswald text-yellow text-xl md:text-2xl mb-3">Con nghe, nhưng không tương tác</h3>
                            <p class="text-sm md:text-base text-white/90">Nghiên cứu về sóng N100 và biên độ sóng P3 chỉ ra: Bộ não trẻ <strong class="text-white">vẫn nhận diện được âm thanh tên mình</strong>. Tuy nhiên, thay vì quay lại, con dùng tài nguyên não bộ để tập trung mạnh hơn vào các vật thể trực quan xung quanh.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- SECTION 2: TIMELINE -->
        <section class="mb-16">
            <h2 class="font-oswald text-navy text-2xl md:text-4xl leading-tight mt-8 relative">2. Cột Mốc Vàng: Trẻ Không Phản Ứng Ở Tháng Thứ Mấy Là "Cờ Đỏ"?</h2>
            <div class="w-14 h-1 rounded bg-yellow my-4"></div>
            <p class="mb-6">Triệu chứng này là một chỉ báo dự báo cực kỳ mạnh mẽ nếu được đặt đúng vào mốc thời gian phát triển.</p>

            <div class="relative pl-10 md:pl-12 my-10">
                <!-- Vertical Line -->
                <div class="absolute left-[15px] top-0 bottom-0 w-[2px] bg-yellow"></div>
                
                <!-- Nodes -->
                <div class="relative mb-8 bg-white p-5 md:p-6 rounded-xl shadow-card">
                    <div class="absolute -left-[45px] md:-left-[49px] top-5 w-8 h-8 bg-cream border-2 border-yellow rounded-full flex items-center justify-center text-sm z-10">🌱</div>
                    <h3 class="font-oswald text-navy text-xl mb-3 flex flex-wrap items-center gap-2.5">
                        6 - 9 Tháng Tuổi 
                        <span class="bg-navy/10 font-quicksand text-sm px-3 py-1 rounded-full text-navy font-semibold">Phát triển tự nhiên</span>
                    </h3>
                    <p class="text-textMuted">Khao khát tương tác xã hội đã được lập trình. Trẻ sơ sinh từ 6 tháng đã bắt đầu ghi nhớ và có nhận thức về âm thanh tên gọi của mình, đặc biệt là giọng mẹ.</p>
                </div>

                <div class="relative mb-8 bg-white p-5 md:p-6 rounded-xl shadow-card">
                    <div class="absolute -left-[45px] md:-left-[49px] top-5 w-8 h-8 bg-cream border-2 border-yellow rounded-full flex items-center justify-center text-sm z-10">⚠️</div>
                    <h3 class="font-oswald text-navy text-xl mb-3 flex flex-wrap items-center gap-2.5">
                        Quanh mốc 9 Tháng 
                        <span class="bg-[#fff8e1] font-quicksand text-sm px-3 py-1 rounded-full text-[#f57f17] font-semibold">Điểm gãy xuất hiện</span>
                    </h3>
                    <p class="text-textMuted">Phản xạ quay đầu tìm kiếm nguồn phát âm thanh đáng lẽ phải định hình rõ rệt. Nhưng phân tích dữ liệu chứng minh: trẻ tự kỷ tạo ra một sự nới rộng khác biệt rõ ràng từ thời điểm này.</p>
                </div>

                <div class="relative mb-8 bg-white p-5 md:p-6 rounded-xl shadow-card">
                    <div class="absolute -left-[45px] md:-left-[49px] top-5 w-8 h-8 bg-cream border-2 border-yellow rounded-full flex items-center justify-center text-sm z-10">🚩</div>
                    <h3 class="font-oswald text-navy text-xl mb-3 flex flex-wrap items-center gap-2.5">
                        Mốc 12 Tháng 
                        <span class="bg-[#ffebee] font-quicksand text-sm px-3 py-1 rounded-full text-[#c62828] font-semibold">Cờ Đỏ (Red Flag)</span>
                    </h3>
                    <p class="text-textMuted">Sự vắng mặt phản xạ duy trì đến 12 tháng được Tổ chức Autism Speaks và CDC khẳng định là một <strong class="text-dark">báo động đỏ</strong>. Trẻ có thể không bập bẹ, không chỉ trỏ và phớt lờ hoàn toàn tiếng gọi.</p>
                </div>
            </div>
        </section>

        <!-- SECTION 3: SO SÁNH -->
        <section class="mb-16">
            <h2 class="font-oswald text-navy text-2xl md:text-4xl leading-tight mt-8 relative">3. Phân Biệt Tự Kỷ Với Các Nguyên Nhân Khác</h2>
            <div class="w-14 h-1 rounded bg-yellow my-4"></div>
            <p class="mb-6">Dù là dấu hiệu kinh điển, y khoa vẫn yêu cầu chẩn đoán phân biệt kỹ lưỡng để tránh hoảng loạn.</p>

            <div class="grid grid-cols-1 gap-5 mt-8">
                <div class="bg-navy/5 rounded-xl border-l-4 border-navy p-6 shadow-sm">
                    <h4 class="font-oswald text-xl text-dark mb-2 flex items-center gap-2">👁️ Phổ Tự Kỷ (ASD)</h4>
                    <p class="text-textMuted">Phớt lờ tiếng gọi nhưng lại có thể giật mình, bịt tai la hét trước tiếng máy sấy tóc, máy hút bụi (quá mẫn cảm thính giác). Thiếu vắng nỗ lực giao tiếp bù đắp.</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-gray-200 p-6 shadow-sm">
                    <h4 class="font-oswald text-xl text-dark mb-2 flex items-center gap-2">🦻 Suy Giảm Thính Lực</h4>
                    <p class="text-textMuted">Không phản ứng với cả tiếng gọi lẫn các tiếng ồn môi trường xung quanh. Thường được loại trừ bằng bài đo thính lực lâm sàng đầu tiên.</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-gray-200 p-6 shadow-sm">
                    <h4 class="font-oswald text-xl text-dark mb-2 flex items-center gap-2">⚡ Tăng Động Giảm Chú Ý (ADHD)</h4>
                    <p class="text-textMuted">Sự lơ đễnh thường chỉ bộc lộ rõ rệt khi trẻ đạt 18 tháng tuổi trở lên (trong khi tự kỷ suy giảm từ 9-12 tháng).</p>
                </div>
                <div class="bg-white rounded-xl border-l-4 border-gray-200 p-6 shadow-sm">
                    <h4 class="font-oswald text-xl text-dark mb-2 flex items-center gap-2">🗣️ Chậm Phát Triển Ngôn Ngữ (DLD)</h4>
                    <p class="text-textMuted">Có thể chậm quay đầu nhưng vẫn biết dùng ngôn ngữ hình thể. Con cố gắng giao tiếp bằng ánh mắt và cử chỉ tay để bù đắp việc không nói được.</p>
                </div>
            </div>
        </section>

        <!-- JOINT ATTENTION INFO CTA -->
        <div class="bg-bgAlt text-dark border-l-4 border-yellow p-8 md:p-10 rounded-xl text-left my-10">
            <h3 class="font-oswald text-navy text-2xl mb-4">🧩 Sự Thiếu Hụt Chú Ý Chung (Joint Attention)</h3>
            <p class="mb-4">Bản chất của việc không đáp ứng tên gọi là sự đổ vỡ của <strong class="text-dark">Chú ý chung</strong> (khả năng 2 người cùng tập trung vào 1 đồ vật). Khi không phản hồi lại tên, con sẽ không tham gia vào việc chỉ ngón trỏ khoe đồ chơi hay nhìn theo hướng tay mẹ chỉ, làm ngưng trệ quá trình học từ vựng.</p>
            <p class="mb-6 italic text-textMuted">Bài viết này chỉ là một mảnh ghép. Hãy dùng Bảng kiểm tra toàn diện để nhìn thấy bức tranh đầy đủ hơn:</p>
            <a href="https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/" class="inline-block bg-yellow text-navy px-8 py-3 rounded-full font-oswald text-lg transition-transform duration-200 hover:-translate-y-1 hover:shadow-[0_6px_16px_rgba(255,209,84,0.4)]" target="_blank" rel="noopener">Làm Bảng Kiểm Tra Sức Khỏe Toàn Diện</a>
        </div>

        <!-- INTERACTIVE CHECKLIST -->
        <section class="bg-white border-2 border-dashed border-yellow rounded-xl p-6 md:p-10 my-16 text-center">
            <h2 class="font-oswald text-navy text-2xl md:text-3xl mb-4">Kiểm Tra Nhanh: Mức Độ Tương Tác Của Con</h2>
            <p class="text-textMuted">Đánh dấu vào các biểu hiện bạn quan sát thấy ở trẻ trong 1 tuần qua:</p>
            
            <div class="text-left max-w-2xl mx-auto flex flex-col gap-4 mt-8">
                <label class="flex items-start gap-3 p-4 bg-bgAlt rounded-lg cursor-pointer hover:bg-yellow/10 transition-colors">
                    <input type="checkbox" class="chk-eval mt-1 w-5 h-5 accent-navy">
                    <span class="text-dark font-medium">Trẻ có giật mình với tiếng ồn lớn (máy sấy, hút bụi) nhưng lờ đi khi được gọi tên?</span>
                </label>
                <label class="flex items-start gap-3 p-4 bg-bgAlt rounded-lg cursor-pointer hover:bg-yellow/10 transition-colors">
                    <input type="checkbox" class="chk-eval mt-1 w-5 h-5 accent-navy">
                    <span class="text-dark font-medium">Khi quay lại (nếu có), trẻ tránh nhìn trực tiếp vào mắt người gọi?</span>
                </label>
                <label class="flex items-start gap-3 p-4 bg-bgAlt rounded-lg cursor-pointer hover:bg-yellow/10 transition-colors">
                    <input type="checkbox" class="chk-eval mt-1 w-5 h-5 accent-navy">
                    <span class="text-dark font-medium">Trẻ hiếm khi dùng ngón tay trỏ để chỉ vào đồ vật muốn khoe với mẹ?</span>
                </label>
                <label class="flex items-start gap-3 p-4 bg-bgAlt rounded-lg cursor-pointer hover:bg-yellow/10 transition-colors">
                    <input type="checkbox" class="chk-eval mt-1 w-5 h-5 accent-navy" value="2">
                    <span class="text-dark font-medium">Trẻ đã bước qua tháng thứ 12 nhưng gần như không bao giờ phản ứng với tên gọi?</span>
                </label>
            </div>

            <div id="eval-result" class="mt-8 p-5 rounded-lg font-semibold bg-[#e8f5e9] text-[#2e7d32] transition-all duration-300 block">
                Hãy tick vào các ô trên để xem đánh giá sơ bộ dựa trên hành vi của con.
            </div>
        </section>

        <!-- SECTION 4: 3 BƯỚC CAN THIỆP -->
        <section class="mb-16">
            <h2 class="font-oswald text-navy text-2xl md:text-4xl leading-tight mt-8 relative">4. Quy Trình 3 Bước Can Thiệp Hành Vi (ABA) Tại Nhà</h2>
            <div class="w-14 h-1 rounded bg-yellow my-4"></div>
            <p class="mb-6">Cảm giác bất lực là điều dễ hiểu. Nhưng kỹ năng này hoàn toàn có thể rèn luyện thông qua Phân tích Hành vi Ứng dụng (ABA).</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white p-6 md:p-8 rounded-xl relative overflow-hidden shadow-card border-t-4 border-navy">
                    <div class="absolute -bottom-6 right-2 font-oswald text-[8rem] text-navy opacity-5 leading-none pointer-events-none">1</div>
                    <h3 class="font-oswald text-navy text-xl mb-4">Ngừng Gắn Tên Với Mệnh Lệnh</h3>
                    <ul class="list-disc pl-5 text-textMuted text-sm space-y-2">
                        <li>Tuyệt đối không dùng tên con để la mắng (VD: "Bi, không ném đồ!").</li>
                        <li>Việc này khiến não bộ đánh đồng tên gọi với sự kiện khó chịu (aversive stimulus), kích hoạt cơ chế phớt lờ tự vệ.</li>
                        <li>Trong 1-2 tuần đầu: Dùng đại từ chung chung hoặc chạm nhẹ để điều hướng. "Thanh lọc" ký ức tiêu cực.</li>
                    </ul>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-xl relative overflow-hidden shadow-card border-t-4 border-navy">
                    <div class="absolute -bottom-6 right-2 font-oswald text-[8rem] text-navy opacity-5 leading-none pointer-events-none">2</div>
                    <h3 class="font-oswald text-navy text-xl mb-4">Kỹ Thuật Ghép Nối (Pairing)</h3>
                    <ul class="list-disc pl-5 text-textMuted text-sm space-y-2">
                        <li>Mục tiêu: Xây dựng lộ trình thần kinh <strong class="text-dark">Tên gọi = Điều tuyệt vời</strong>.</li>
                        <li>Chuẩn bị phần thưởng vô điều kiện con cực thích (đồ chơi phát sáng, miếng bánh, trò cù lét).</li>
                        <li>Ở cự ly gần, gọi tên vui tươi. Ngay lúc con liếc mắt, lập tức trao thưởng. Nếu không quay, chạm nhẹ vai hỗ trợ (prompting).</li>
                    </ul>
                </div>
                <div class="bg-white p-6 md:p-8 rounded-xl relative overflow-hidden shadow-card border-t-4 border-navy">
                    <div class="absolute -bottom-6 right-2 font-oswald text-[8rem] text-navy opacity-5 leading-none pointer-events-none">3</div>
                    <h3 class="font-oswald text-navy text-xl mb-4">Khái Quát Hóa Dữ Liệu</h3>
                    <ul class="list-disc pl-5 text-textMuted text-sm space-y-2">
                        <li>Ghi chép tỷ lệ quay đầu mỗi ngày để theo dõi.</li>
                        <li>Khi đã quen ở cự ly gần, giãn cách từ từ: 2 mét, 5 mét, rồi ở phòng khác.</li>
                        <li><strong class="text-dark">Quan trọng:</strong> Cha mẹ cần duy trì trạng thái bình tĩnh (Window of Tolerance) làm mỏ neo cảm xúc an toàn cho con.</li>
                    </ul>
                </div>
            </div>
        </section>

        <!-- SECTION 5: FAQ -->
        <section class="mb-16 mt-10">
            <h2 class="font-oswald text-navy text-2xl md:text-4xl leading-tight relative">Câu Hỏi Thường Gặp (FAQ)</h2>
            <div class="w-14 h-1 rounded bg-yellow my-4"></div>
            
            <div class="mt-8 space-y-4">
                <!-- FAQ Item 1 -->
                <div class="faq-item bg-white rounded-lg shadow-sm overflow-hidden">
                    <button class="faq-question w-full text-left p-5 font-oswald text-lg text-navy flex justify-between items-center cursor-pointer">
                        Trẻ tự kỷ không phản ứng khi gọi tên có phải do bị điếc không?
                        <span class="faq-icon text-2xl text-yellow transition-transform duration-300">+</span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-5 bg-bgAlt">
                        <p class="pb-5 text-textMuted">Đa số trường hợp là không. Trẻ tự kỷ thường có thính lực cơ học hoàn toàn bình thường. Sự lơ đễnh xuất phát từ việc não bộ không gán "ưu tiên xã hội" cho tiếng gọi. Trẻ có thể lờ đi tên mình nhưng lại nhạy bén hoặc bịt tai hoảng sợ trước tiếng ồn của máy hút bụi.</p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item bg-white rounded-lg shadow-sm overflow-hidden">
                    <button class="faq-question w-full text-left p-5 font-oswald text-lg text-navy flex justify-between items-center cursor-pointer">
                        Nếu gọi mãi con không quay lại, tôi có nên hét lên không?
                        <span class="faq-icon text-2xl text-yellow transition-transform duration-300">+</span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-5 bg-bgAlt">
                        <p class="pb-5 text-textMuted">Tuyệt đối không. Việc hét lên hoặc tăng âm lượng đột ngột sẽ biến tên gọi thành một sự đe dọa. Trẻ sẽ càng trốn tránh và phớt lờ. Thay vào đó, hãy tiến lại gần, vỗ nhẹ vào vai con và sử dụng tông giọng vui tươi.</p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item bg-white rounded-lg shadow-sm overflow-hidden">
                    <button class="faq-question w-full text-left p-5 font-oswald text-lg text-navy flex justify-between items-center cursor-pointer">
                        Ở độ tuổi nào việc lờ đi tiếng gọi đáng lo ngại?
                        <span class="faq-icon text-2xl text-yellow transition-transform duration-300">+</span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-5 bg-bgAlt">
                        <p class="pb-5 text-textMuted">Trẻ sơ sinh bình thường phản xạ với âm thanh ở tháng thứ 6. Điểm gãy của trẻ tự kỷ bộc lộ rõ từ 9-12 tháng. Vắng mặt kỹ năng này ở mốc 12 tháng là "cờ đỏ" yêu cầu can thiệp ngay.</p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item bg-white rounded-lg shadow-sm overflow-hidden">
                    <button class="faq-question w-full text-left p-5 font-oswald text-lg text-navy flex justify-between items-center cursor-pointer">
                        Tại sao đôi lúc con vẫn quay lại nhưng thường xuyên phớt lờ?
                        <span class="faq-icon text-2xl text-yellow transition-transform duration-300">+</span>
                    </button>
                    <div class="faq-answer max-h-0 overflow-hidden transition-all duration-300 px-5 bg-bgAlt">
                        <p class="pb-5 text-textMuted">Điều này rất phổ biến. Trẻ thường chỉ quay lại khi tiếng gọi vô tình gắn liền với món đồ chơi/đồ ăn con đang khao khát lúc đó. Sự thiếu ổn định này chính là đặc tính của rối loạn xử lý ưu tiên xã hội.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- REFERENCES & DISCLAIMER -->
        <footer class="text-sm text-gray-500 mt-16 pt-6 border-t border-gray-200">
            <p><strong class="text-dark">Tuyên bố miễn trừ trách nhiệm:</strong> Toàn bộ thông tin được đúc kết từ báo cáo khoa học (PubMed, PLoS ONE) và tổ chức sức khỏe (CDC, Autism Speaks). Nội dung mang sứ mệnh giáo dục, không thay thế chẩn đoán y khoa. Hãy tìm kiếm sự tham vấn từ bác sĩ chuyên khoa nếu có dấu hiệu bất thường.</p>
            <details class="mt-4 cursor-pointer group">
                <summary class="text-navy font-semibold outline-none group-hover:text-yellow transition-colors">Xem nguồn tài liệu trích dẫn y khoa</summary>
                <ul class="mt-3 list-disc pl-5 space-y-1">
                    <li>Miller M, et al. "Response to name in infants developing autism spectrum disorder: a prospective study." The Journal of Pediatrics (2017).</li>
                    <li>Nijhof AD, et al. "Neural responses to hearing the own name in school-aged children with and without autism." PubMed (2024).</li>
                    <li>Tổ chức Autism Speaks. "Signs of Autism - By 12 months".</li>
                    <li>Conine DE, et al. "Evaluating a screening-to-intervention model with caregiver training for response to name..." Journal of Applied Behavior Analysis (2025).</li>
                </ul>
            </details>
        </footer>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ACCORDION LOGIC (Updated for Tailwind classes)
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            const answer = item.querySelector('.faq-answer');
            const icon = item.querySelector('.faq-icon');

            question.addEventListener('click', () => {
                const isOpen = answer.classList.contains('max-h-[500px]');

                // Close all others
                faqItems.forEach(otherItem => {
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    const otherIcon = otherItem.querySelector('.faq-icon');
                    otherAnswer.classList.remove('max-h-[500px]');
                    otherAnswer.classList.add('max-h-0');
                    otherIcon.classList.remove('rotate-45');
                });

                // Toggle current
                if (!isOpen) {
                    answer.classList.remove('max-h-0');
                    answer.classList.add('max-h-[500px]');
                    icon.classList.add('rotate-45');
                }
            });
        });

        // INTERACTIVE CHECKLIST LOGIC (Updated for Tailwind classes)
        const checkboxes = document.querySelectorAll('.chk-eval');
        const resultBox = document.getElementById('eval-result');

        function calculateScore() {
            let score = 0;
            let checkedCount = 0;
            
            checkboxes.forEach(chk => {
                if(chk.checked) {
                    score += parseInt(chk.value || 1); // default value 1 if not specified
                    checkedCount++;
                }
            });

            // Base Tailwind classes for the box
            const baseClasses = "mt-8 p-5 rounded-lg font-semibold transition-all duration-300 block ";

            if (checkedCount === 0) {
                resultBox.className = baseClasses + 'bg-[#e8f5e9] text-[#2e7d32]';
                resultBox.innerHTML = "Hãy tick vào các ô trên để xem đánh giá sơ bộ dựa trên hành vi của con.";
            } else if (score >= 3) {
                resultBox.className = baseClasses + 'bg-[#ffebee] text-[#c62828]';
                resultBox.innerHTML = "⚠️ <strong class='text-dark'>CỜ ĐỎ:</strong> Các dấu hiệu cho thấy sự thiếu hụt rõ rệt trong 'Chú ý chung' và phản xạ xã hội. Bạn nên đưa bé đi đánh giá chuyên sâu với bác sĩ nhi thần kinh sớm nhất có thể.";
            } else if (score >= 1) {
                resultBox.className = baseClasses + 'bg-[#fff8e1] text-[#f57f17]';
                resultBox.innerHTML = "👀 <strong class='text-dark'>CẦN LƯU Ý:</strong> Bé đang có biểu hiện trễ nhịp trong giao tiếp. Hãy bắt đầu áp dụng ngay 'Quy trình 3 Bước Can thiệp (Pairing)' tại nhà và theo dõi sát sao.";
            }
        }

        checkboxes.forEach(chk => {
            chk.addEventListener('change', calculateScore);
        });
    });
</script>

<?php get_footer(); ?>