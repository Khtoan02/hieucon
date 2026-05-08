<?php
/* Template Name: Thính giác ở trẻ tự kỷ */
get_header();
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giải mã thế giới âm thanh của con - Landing Page Giáo dục</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            scroll-behavior: smooth;
        }
        .glass-morphism {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .infographic-card:hover {
            transform: translateY(-8px);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        .bg-purple-light {
            background-color: #f8f5ff;
        }
    </style>
    <?php wp_head(); ?>
</head>
<body class="bg-purple-light text-slate-800">

    <!-- Hero Section -->
    <header class="relative bg-gradient-to-br from-purple-600 via-indigo-500 to-purple-400 py-24 px-6 overflow-hidden">
        <div class="max-w-5xl mx-auto relative z-10 text-center">
            <h1 class="text-4xl md:text-6xl font-bold text-white mb-6 leading-tight">
                Tại sao con TỰ KỶ nghe tiếng bóc kẹo, nhạc quảng cáo... giỏi hơn nghe tiếng bố mẹ?
            </h1>
            <p class="text-xl text-purple-50 mb-10 max-w-2xl mx-auto leading-relaxed">
                Giải mã bí ẩn về "Nghe có chọn lọc" ở trẻ tự kỷ dưới lăng kính khoa học thần kinh để thấu hiểu và kết nối với con sâu sắc hơn.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="#bi-an" class="bg-white text-purple-700 px-8 py-3 rounded-full font-bold shadow-xl hover:bg-purple-50 transition-all text-center">
                    Khám phá ngay
                </a>
                <a href="#ho-tro" class="bg-purple-800/40 text-white border-2 border-white/50 backdrop-blur-sm px-8 py-3 rounded-full font-bold shadow-xl hover:bg-purple-800 transition-all text-center">
                    Cần hỗ trợ
                </a>
            </div>
        </div>
        <svg class="absolute bottom-0 left-0 w-full h-24" preserveAspectRatio="none" viewBox="0 0 1440 320">
            <path fill="#f8f5ff" fill-opacity="1" d="M0,160L48,176C96,192,192,224,288,213.3C384,203,480,149,576,144C672,139,768,181,864,181.3C960,181,1056,139,1152,117.3C1248,96,1344,96,1392,96L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
        </svg>
    </header>

    <!-- The Problem Section -->
    <section id="bi-an" class="py-20 px-6 max-w-4xl mx-auto">
        <div class="flex flex-col md:flex-row items-center gap-12">
            <div class="md:w-1/2">
                <div class="bg-white p-8 rounded-3xl border-l-8 border-purple-500 shadow-lg italic text-lg text-slate-700 leading-relaxed">
                    <span class="text-4xl text-purple-300 font-serif leading-none">“</span>
                    Gọi con mãi không thưa, nhưng vừa bóc viên kẹo, bật ti vi.. ở phòng bên là con chạy đến ngay...
                    <span class="text-4xl text-purple-300 font-serif leading-none inline-block align-bottom">”</span>
                </div>
            </div>
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold text-purple-800 mb-6 uppercase tracking-tight">Con không hề bướng bỉnh!</h2>
                <p class="text-slate-600 leading-relaxed mb-6 text-lg">
                    Hiện tượng này thường bị nhầm lẫn với sự lơ đễnh hay cố tình chống đối. Nhưng thực tế, có đến **60% - 96%** trẻ tự kỷ gặp các vấn đề về nhạy cảm giác quan.
                </p>
                <p class="text-slate-600 leading-relaxed text-lg font-medium text-purple-700">
                    Hệ thần kinh của con tiếp nhận âm thanh theo một cách hoàn toàn khác biệt so với chúng ta.
                </p>
            </div>
        </div>
    </section>

    <!-- Science Deep Dive -->
    <section class="bg-white py-24 px-6 shadow-sm rounded-[4rem]">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-3xl font-bold text-center text-slate-800 mb-16 underline decoration-purple-300 decoration-4 underline-offset-8">
                3 Nút Thắt Thần Kinh Cha Mẹ Cần Biết
            </h2>

            <div class="grid md:grid-cols-3 gap-10">
                <div class="text-center p-8 bg-purple-50 rounded-[2.5rem] infographic-card shadow-sm border border-purple-100">
                    <div class="w-20 h-20 bg-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-8 text-white text-3xl shadow-lg rotate-3">📡</div>
                    <h3 class="text-xl font-bold mb-4 text-purple-900">Chiếc "Ra-đa" Bị Lệch</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Não bộ con rất giỏi bắt các âm thanh đơn giản. Nhưng với <strong>ngôn ngữ</strong>, chiếc "ra-đa" này bị yếu đi, khiến con không thể ưu tiên nghe tiếng người giữa các tạp âm khác.
                    </p>
                </div>

                <div class="text-center p-8 bg-white rounded-[2.5rem] infographic-card shadow-md border-t-4 border-indigo-400">
                    <div class="w-20 h-20 bg-indigo-500 rounded-2xl flex items-center justify-center mx-auto mb-8 text-white text-3xl shadow-lg -rotate-3">🔊</div>
                    <h3 class="text-xl font-bold mb-4 text-indigo-900">Bộ Lọc Tiếng Ồn Bị Hỏng</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Mọi âm thanh (tiếng quạt, tiếng xe, tiếng nói) đều vang lên với cường độ lớn như nhau. Con bị "quá tải" nên không bóc tách được lời mẹ nói.
                    </p>
                </div>

                <div class="text-center p-8 bg-purple-50 rounded-[2.5rem] infographic-card shadow-sm border border-purple-100">
                    <div class="w-20 h-20 bg-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-8 text-white text-3xl shadow-lg rotate-3">⏱️</div>
                    <h3 class="text-xl font-bold mb-4 text-pink-900">Tốc Độ Xử Lý Chậm</h3>
                    <p class="text-slate-600 leading-relaxed">
                        Não con cần khoảng nghỉ dài hơn để hiểu từ ngữ. Nếu nói nhanh, các từ sẽ dính liền vào nhau thành một dải âm thanh vô nghĩa trong tai con.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Visual Infographic -->
    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto">
            <div class="glass-morphism rounded-[3.5rem] shadow-2xl p-8 md:p-16 border border-purple-200">
                <div class="text-center mb-16">
                    <span class="bg-indigo-600 text-white px-5 py-1.5 rounded-full text-xs font-bold tracking-widest uppercase">Khoa học thường thức</span>
                    <h2 class="text-4xl font-black mt-4 text-purple-900">THẾ GIỚI ÂM THANH CỦA CON</h2>
                </div>

                <div class="space-y-12">
                    <div class="flex flex-col md:flex-row items-center gap-8 bg-white/50 p-6 rounded-3xl">
                        <div class="w-full md:w-1/3 text-center">
                            <div class="text-5xl mb-2">🎹</div>
                            <span class="font-bold text-indigo-700 uppercase tracking-wide text-sm">Âm thanh máy móc</span>
                        </div>
                        <div class="w-full md:w-1/3 text-center bg-indigo-100 py-4 rounded-2xl font-bold text-indigo-800 shadow-inner">
                            CỰC KỲ NHẠY BÉN
                        </div>
                        <div class="w-full md:w-1/3 text-sm text-slate-500 text-center md:text-left">
                            Dễ dự đoán, lặp lại nên não bộ "ưa thích" xử lý.
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-8 bg-purple-100/50 p-6 rounded-3xl">
                        <div class="w-full md:w-1/3 text-center">
                            <div class="text-5xl mb-2">🗣️</div>
                            <span class="font-bold text-purple-700 uppercase tracking-wide text-sm">Tiếng nói con người</span>
                        </div>
                        <div class="w-full md:w-1/3 text-center bg-purple-600 py-4 rounded-2xl font-bold text-white shadow-lg">
                            KHÓ KHĂN ĐỂ HIỂU
                        </div>
                        <div class="w-full md:w-1/3 text-sm text-slate-500 text-center md:text-left">
                            Quá nhiều biến đổi về cảm xúc và tốc độ.
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center gap-8 bg-pink-100/30 p-6 rounded-3xl">
                        <div class="w-full md:w-1/3 text-center">
                            <div class="text-5xl mb-2">🌪️</div>
                            <span class="font-bold text-pink-700 uppercase tracking-wide text-sm">Tiếng ồn môi trường</span>
                        </div>
                        <div class="w-full md:w-1/3 text-center bg-pink-200 py-4 rounded-2xl font-bold text-pink-900">
                            BỊ XỬ LÝ QUÁ TẢI
                        </div>
                        <div class="w-full md:w-1/3 text-sm text-slate-500 text-center md:text-left">
                            Não không thể tự động lọc bỏ các tạp âm gây nhiễu.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Support Tips -->
    <section class="py-20 px-6 max-w-4xl mx-auto">
        <h2 class="text-3xl font-bold text-center text-purple-900 mb-14">Gợi ý cho cha mẹ hỗ trợ con</h2>
        <div class="grid gap-6">
            <div class="group flex gap-6 items-center p-8 bg-white rounded-3xl shadow-sm border border-purple-100 hover:shadow-indigo-100 hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-white font-bold text-2xl group-hover:scale-110 transition-transform">1</div>
                <div>
                    <h4 class="font-bold text-purple-900 text-xl mb-2">Lọc âm thanh môi trường</h4>
                    <p class="text-slate-600">Tắt tivi, đóng cửa để tạo không gian yên tĩnh nhất trước khi nói chuyện với con.</p>
                </div>
            </div>
            <div class="group flex gap-6 items-center p-8 bg-white rounded-3xl shadow-sm border border-purple-100 hover:shadow-indigo-100 hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-white font-bold text-2xl group-hover:scale-110 transition-transform">2</div>
                <div>
                    <h4 class="font-bold text-purple-900 text-xl mb-2">Thiết lập sự chú ý trước</h4>
                    <p class="text-slate-600">Lại gần con, chạm nhẹ hoặc gọi tên để con "bắt sóng" bạn rồi mới nói.</p>
                </div>
            </div>
            <div class="group flex gap-6 items-center p-8 bg-white rounded-3xl shadow-sm border border-purple-100 hover:shadow-indigo-100 hover:shadow-xl transition-all">
                <div class="w-14 h-14 bg-indigo-600 rounded-2xl flex items-center justify-center flex-shrink-0 text-white font-bold text-2xl group-hover:scale-110 transition-transform">3</div>
                <div>
                    <h4 class="font-bold text-purple-900 text-xl mb-2">Nói chậm, câu ngắn</h4>
                    <p class="text-slate-600">Ngắt nghỉ rõ ràng để não bộ con có đủ thời gian để xử lý thông tin.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Support CTA Section -->
    <section id="ho-tro" class="bg-gradient-to-br from-indigo-900 to-purple-800 py-24 px-6 text-white text-center rounded-t-[5rem]">
        <div class="max-w-4xl mx-auto">
            <div class="mb-10 inline-block p-4 bg-white/10 rounded-full backdrop-blur-md text-pink-400">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                </svg>
            </div>
            <h2 class="text-4xl font-bold mb-8 leading-tight">Mỗi đứa trẻ là một bản thể đặc biệt</h2>
            <p class="text-indigo-100 text-xl mb-12 leading-relaxed">
                Nếu bạn cần hỗ trợ chuyên sâu cho tình trạng cụ thể của con mình, hãy kết nối ngay để được tư vấn lộ trình phù hợp nhất.
            </p>
            <div class="space-y-6">
                <a href="https://www.facebook.com/profile.php?id=61555235975765" target="_blank" class="inline-flex items-center gap-3 bg-white text-indigo-900 px-10 py-5 rounded-full font-black text-lg hover:bg-pink-100 hover:scale-105 transition-all shadow-2xl">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    LIÊN HỆ VỚI HELEN HOAI
                </a>
                <p class="text-indigo-300 text-sm italic underline decoration-pink-500 underline-offset-4">Tư vấn trực tiếp cho tình trạng của bé</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-indigo-950 py-12 px-6 text-indigo-400 text-xs">
        <div class="max-w-4xl mx-auto text-center space-y-4">
            <p class="font-bold text-sm">Tài liệu tham khảo:</p>
            <p class="italic leading-relaxed max-w-2xl mx-auto opacity-80">
                Rotschafer, S. E. (2021). Auditory discrimination in autism spectrum disorder. Frontiers in Neuroscience, 15, 651209. https://doi.org/10.3389/fnins.2021.651209
            </p>
            <div class="pt-6 border-t border-indigo-900/50">
                <p>© 2024 Chia sẻ Kiến thức cho Cộng đồng Cha mẹ Đặc biệt</p>
            </div>
        </div>
    </footer>

<?php get_footer(); ?>
