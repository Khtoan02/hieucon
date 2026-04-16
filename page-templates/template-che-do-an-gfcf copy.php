<?php
/**
 * Template Name: Trang Hiểu Đúng Để Đồng Hành Cùng Con
 * 
 * @package Hieucon
 */
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hành Trình Ngôn Ngữ Của Con - Helen Hoai</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        .gradient-bg {
            background: linear-gradient(135deg, #f5f3ff 0%, #ede9fe 100%);
        }
        .card-hover:hover {
            transform: translateY(-5px);
            transition: all 0.3s ease;
        }
        .milestone-dot {
            width: 20px;
            height: 20px;
            background-color: #7c3aed;
            border: 4px solid #fff;
            border-radius: 50%;
            position: absolute;
            left: -10px;
            top: 0;
        }
        .timeline-line {
            width: 2px;
            background-color: #ddd6fe;
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="text-slate-800 bg-purple-50/30">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-purple-100">
        <div class="max-w-6xl mx-auto px-4 h-16 flex items-center justify-between">
            <div class="flex items-center gap-2">
                <span class="text-2xl">💜</span>
                <span class="font-bold text-purple-700 text-lg uppercase tracking-wider">Hành Trình Ngôn Ngữ</span>
            </div>
            <div class="hidden md:flex gap-8 font-medium text-sm text-slate-600">
                <a href="#phan-biet" class="hover:text-purple-600 transition">Phân Biệt</a>
                <a href="#cac-moc" class="hover:text-purple-600 transition">Các Mốc</a>
                <a href="#nguyen-nhan" class="hover:text-purple-600 transition">Nguyên Nhân</a>
                <a href="#meo-hay" class="hover:text-purple-600 transition">Mẹo Hay</a>
            </div>
            <a href="#khi-nao" class="bg-purple-600 text-white px-5 py-2 rounded-full text-sm font-semibold hover:bg-purple-700 transition shadow-lg shadow-purple-200">
                Cần Hỗ Trợ?
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4 gradient-bg">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl md:text-6xl font-extrabold text-slate-900 mb-6 leading-tight">
                Con Chậm Nói: <span class="text-purple-600">Hiểu Đúng</span> Để Đồng Hành Cùng Con
            </h1>
            <p class="text-lg md:text-xl text-slate-600 mb-10 leading-relaxed max-w-2xl mx-auto italic">
                "Mỗi đứa trẻ là một mầm cây có nhịp điệu phát triển riêng. Hãy cùng chúng tôi giải mã ngôn ngữ của con để yêu thương và hỗ trợ đúng cách."
            </p>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="#cac-moc" class="bg-white text-purple-700 px-8 py-4 rounded-2xl font-bold shadow-xl shadow-purple-100 hover:shadow-2xl transition flex items-center gap-2 border border-purple-100">
                    Kiểm tra các mốc của con 🔍
                </a>
                <a href="#khi-nao" class="bg-purple-600 text-white px-8 py-4 rounded-2xl font-bold shadow-xl shadow-purple-200 hover:bg-purple-700 transition flex items-center gap-2">
                    Cần hỗ trợ ngay 💜
                </a>
            </div>
        </div>
    </section>

    <!-- Phân biệt Section (Infographic Style) -->
    <section id="phan-biet" class="py-20 px-4 max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold mb-4 text-purple-900">Chậm nói và Chậm ngôn ngữ có giống nhau?</h2>
            <p class="text-slate-500">Hiểu rõ khái niệm giúp ba mẹ có định hướng hỗ trợ chính xác</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-8">
            <div class="p-8 rounded-3xl bg-white border border-purple-100 relative overflow-hidden shadow-sm card-hover">
                <div class="text-5xl mb-6">🗣️</div>
                <h3 class="text-2xl font-bold text-purple-700 mb-4">Chậm phát âm (Speech)</h3>
                <p class="text-slate-600 leading-relaxed mb-6">
                    Con hiểu ý người khác, có vốn từ nhưng gặp khó khăn khi phát ra âm thanh tròn vành rõ chữ. 
                </p>
                <ul class="space-y-3 text-sm text-purple-800 font-medium">
                    <li class="flex items-start gap-2">✅ Nói ngọng, nói lắp</li>
                    <li class="flex items-start gap-2">✅ Người nghe khó hiểu âm thanh</li>
                    <li class="flex items-start gap-2">✅ Vẫn có nhu cầu giao tiếp cao</li>
                </ul>
            </div>

            <div class="p-8 rounded-3xl bg-purple-600 text-white relative overflow-hidden shadow-xl card-hover">
                <div class="text-5xl mb-6">🧠</div>
                <h3 class="text-2xl font-bold mb-4">Chậm ngôn ngữ (Language)</h3>
                <p class="text-purple-100 leading-relaxed mb-6">
                    Gặp khó khăn trong việc "trao đổi thông tin". Đây là vấn đề về tư duy và kết nối xã hội.
                </p>
                <ul class="space-y-3 text-sm font-medium">
                    <li class="flex items-start gap-2">✅ Khó hiểu lời người khác nói</li>
                    <li class="flex items-start gap-2">✅ Khó dùng từ ngữ/điệu bộ để diễn đạt</li>
                    <li class="flex items-start gap-2">✅ Ít tương tác, sống trong thế giới riêng</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section id="cac-moc" class="py-20 bg-purple-50/50 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4 text-purple-900 italic">Bản đồ Phát triển Ngôn ngữ</h2>
                <p class="text-slate-500 italic">Dấu hiệu cần lưu ý qua từng giai đoạn</p>
            </div>

            <div class="relative pl-8">
                <div class="timeline-line"></div>

                <!-- Milestone 6-12 -->
                <div class="mb-12 relative">
                    <div class="milestone-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 card-hover">
                        <h4 class="text-purple-600 font-bold mb-2 uppercase tracking-wide">6 - 12 THÁNG</h4>
                        <ul class="text-slate-600 space-y-2 list-disc pl-5">
                            <li>12 tháng: Không bập bẹ "ba-ba", "ma-ma".</li>
                            <li>Không phản ứng khi được gọi tên.</li>
                            <li>Không biết vẫy tay chào hoặc chỉ tay.</li>
                        </ul>
                    </div>
                </div>

                <!-- Milestone 12-18 -->
                <div class="mb-12 relative">
                    <div class="milestone-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 card-hover">
                        <h4 class="text-purple-600 font-bold mb-2 uppercase tracking-wide">12 - 18 THÁNG</h4>
                        <ul class="text-slate-600 space-y-2 list-disc pl-5">
                            <li>18 tháng: Chưa nói được từ đơn nào rõ rệt.</li>
                            <li>Không hiểu các yêu cầu đơn giản như "Đưa mẹ cái bát".</li>
                            <li>Không biết nói "Không" khi không thích.</li>
                        </ul>
                    </div>
                </div>

                <!-- Milestone 2y -->
                <div class="mb-12 relative">
                    <div class="milestone-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 card-hover">
                        <h4 class="text-purple-600 font-bold mb-2 uppercase tracking-wide">2 TUỔI</h4>
                        <ul class="text-slate-600 space-y-2 list-disc pl-5">
                            <li>Vốn từ ít hơn 50 từ.</li>
                            <li>Chưa biết ghép 2 từ (ví dụ: "Uống sữa").</li>
                            <li>Chỉ lặp lại lời người khác một cách máy móc.</li>
                        </ul>
                    </div>
                </div>

                <!-- Milestone 3y+ -->
                <div class="mb-12 relative">
                    <div class="milestone-dot"></div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-purple-100 card-hover">
                        <h4 class="text-purple-600 font-bold mb-2 uppercase tracking-wide">3 - 5 TUỔI</h4>
                        <ul class="text-slate-600 space-y-2 list-disc pl-5">
                            <li>Không biết đặt câu hỏi "Cái gì?", "Ai đây?".</li>
                            <li>Khó kể lại một câu chuyện có đầu có đuôi.</li>
                            <li>Thường xuyên dùng sai cấu trúc câu.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Red Flags Box -->
            <div class="mt-10 p-8 bg-rose-50 border-2 border-rose-100 rounded-3xl shadow-lg shadow-rose-100">
                <h3 class="text-rose-600 font-bold text-xl mb-4 flex items-center gap-2">
                    ⚠️ DẤU HIỆU "BÁO ĐỘNG ĐỎ"
                </h3>
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-rose-100">
                        <span class="text-xl">📉</span>
                        <p class="text-sm font-semibold text-rose-900">Mất kỹ năng đột ngột: Đã biết nói nhưng bỗng dưng ngừng nói.</p>
                    </div>
                    <div class="flex items-start gap-3 bg-white p-4 rounded-xl shadow-sm border border-rose-100">
                        <span class="text-xl">👁️</span>
                        <p class="text-sm font-semibold text-rose-900">Ít tương tác: Không giao tiếp mắt, sống trong thế giới riêng.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Section -->
    <section id="nguyen-nhan" class="py-20 px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4 text-purple-900 italic">Tại sao con lại chậm nói?</h2>
                <p class="text-slate-500 italic">Hiểu nguyên nhân để bớt lo lắng và tìm giải pháp</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <div class="p-6 text-center card-hover bg-white rounded-2xl shadow-md border border-purple-50">
                    <div class="text-4xl mb-4">👂</div>
                    <h4 class="font-bold text-purple-700 mb-2">Thính giác</h4>
                    <p class="text-sm text-slate-500">Con không nghe rõ nên không thể học phát âm.</p>
                </div>
                <div class="p-6 text-center card-hover bg-white rounded-2xl shadow-md border border-purple-50">
                    <div class="text-4xl mb-4">🧬</div>
                    <h4 class="font-bold text-purple-700 mb-2">Xử lý Thông tin</h4>
                    <p class="text-sm text-slate-500">Não bộ có cách kết nối thông tin khác biệt.</p>
                </div>
                <div class="p-6 text-center card-hover bg-white rounded-2xl shadow-md border border-purple-50">
                    <div class="text-4xl mb-4">🌱</div>
                    <h4 class="font-bold text-purple-700 mb-2">Chậm Chung</h4>
                    <p class="text-sm text-slate-500">Đi kèm với chậm vận động hoặc nhận thức khác.</p>
                </div>
                <div class="p-6 text-center card-hover bg-white rounded-2xl shadow-md border border-purple-50">
                    <div class="text-4xl mb-4">📱</div>
                    <h4 class="font-bold text-purple-700 mb-2">Môi trường</h4>
                    <p class="text-sm text-slate-500">Ít tương tác hoặc lạm dụng thiết bị điện tử sớm.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tips Section -->
    <section id="meo-hay" class="py-20 bg-purple-700 text-white px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold mb-4 italic">5 "Mẹo" Khơi Gợi Ngôn Ngữ Tại Nhà</h2>
                <p class="text-purple-200 italic">Ba mẹ là người thầy tốt nhất của con</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">🎙️ Bình luận viên</h5>
                    <p class="text-sm leading-relaxed">Hãy nói về mọi việc bạn đang làm. "Mẹ đang rửa táo màu đỏ, ngọt lịm!".</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">⏳ Quy tắc 10 giây</h5>
                    <p class="text-sm leading-relaxed">Sau khi đặt câu hỏi, hãy im lặng chờ đợi con 10 giây để con xử lý thông tin.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">📚 Đọc sách linh hoạt</h5>
                    <p class="text-sm leading-relaxed">Không cần đọc chữ, hãy chỉ vào hình và giả tiếng kêu vui nhộn của con vật.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">🌟 Làm gương thay vì sửa</h5>
                    <p class="text-sm leading-relaxed">Khi con nói sai, hãy nhẹ nhàng nhắc lại từ đúng một cách tự nhiên nhất.</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">➕ Mở rộng từ ngữ</h5>
                    <p class="text-sm leading-relaxed">Nếu con nói "Ô tô", bạn hãy thêm tính từ: "Đúng rồi, ô tô đỏ chạy nhanh!".</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md p-8 rounded-3xl border border-white/20 card-hover">
                    <h5 class="text-yellow-300 font-bold mb-3">❤️ Khen ngợi nỗ lực</h5>
                    <p class="text-sm leading-relaxed">Luôn hào hứng khi con cố gắng phát ra bất kỳ âm thanh hoặc cử chỉ nào.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section id="khi-nao" class="py-20 px-4 bg-white">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold mb-4 text-purple-900 italic">Đừng chờ đợi, hãy hành động sớm!</h2>
            <p class="text-slate-600 mb-12 italic">Mỗi ngày trôi qua đều là cơ hội quý giá để con phát triển.</p>
            
            <div class="grid md:grid-cols-3 gap-6 text-left mb-16">
                <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                    <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold mb-4 shadow-md">1</div>
                    <h5 class="font-bold text-purple-800 mb-2">Kiểm tra thính lực</h5>
                    <p class="text-xs text-slate-600">Đảm bảo con đang tiếp nhận âm thanh bình thường.</p>
                </div>
                <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                    <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold mb-4 shadow-md">2</div>
                    <h5 class="font-bold text-purple-800 mb-2">Khám chuyên khoa nhi</h5>
                    <p class="text-xs text-slate-600">Về phát triển, thần kinh và y sinh để có cái nhìn tổng thể.</p>
                </div>
                <div class="bg-purple-50 p-6 rounded-2xl border border-purple-100">
                    <div class="w-10 h-10 bg-purple-600 text-white rounded-full flex items-center justify-center font-bold mb-4 shadow-md">3</div>
                    <h5 class="font-bold text-purple-800 mb-2">Can thiệp ngôn ngữ</h5>
                    <p class="text-xs text-slate-600">Hành vi, âm ngữ trị liệu... để kích hoạt khả năng giao tiếp.</p>
                </div>
            </div>

            <!-- Helen Hoai Contact Section -->
            <div class="p-10 bg-gradient-to-br from-purple-600 to-indigo-700 rounded-[2rem] text-white shadow-2xl relative overflow-hidden">
                <div class="relative z-10">
                    <h3 class="text-3xl font-bold mb-4">Bạn cần tư vấn cho tình trạng cụ thể của trẻ?</h3>
                    <p class="text-purple-100 mb-8 max-w-2xl mx-auto">
                        Hãy liên hệ trực tiếp với Helen Hoai để nhận được hỗ trợ phù hợp giúp con yêu từng bước cải thiện khả năng ngôn ngữ.
                    </p>
                    <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" class="inline-flex items-center gap-3 bg-white text-purple-700 px-10 py-5 rounded-2xl font-bold text-lg hover:bg-purple-50 transition transform hover:scale-105 shadow-xl">
                        <span>Liên hệ với Helen Hoai trên Facebook</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>
                    <div class="mt-12 pt-8 border-t border-white/20">
                        <p class="text-2xl font-serif italic tracking-widest opacity-90">
                            Helen Hoai - Love for Autism
                        </p>
                    </div>
                </div>
                <!-- Decorative background elements -->
                <div class="absolute -top-24 -right-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-purple-400/20 rounded-full blur-3xl"></div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-purple-100 px-4 bg-white">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex flex-col items-center md:items-start gap-1">
                <div class="flex items-center gap-2">
                    <span class="text-2xl">🌱</span>
                    <span class="font-bold text-purple-800 text-sm uppercase tracking-widest">Hành Trình Ngôn Ngữ</span>
                </div>
                <span class="text-[10px] text-purple-400 font-semibold uppercase tracking-tighter">Helen Hoai - Love for Autism</span>
            </div>
            <div class="text-slate-400 text-[10px] text-center md:text-right">
                <p>Dựa trên kiến thức khoa học từ Raising Children Network.</p>
                <p>Nội dung mang tính chất tham khảo, hãy tham vấn ý kiến bác sĩ cho trường hợp cụ thể.</p>
                <p class="mt-2 text-purple-300">© 2024 Helen Hoai. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Smooth scroll logic
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });
    </script>
</body>
</html>
<?php wp_footer(); ?>