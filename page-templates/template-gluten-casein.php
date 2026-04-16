<?php
/**
 * Template Name: Trang Gluten & Casein
 * 
 * @package Hieucon
 */
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bí ẩn đằng sau bữa ăn: Gluten & Casein</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Quicksand', 'sans-serif'],
                    },
                    colors: {
                        primary: '#0ea5e9',
                        secondary: '#10b981',
                        accent: '#f59e0b',
                        dark: '#1e293b',
                    }
                }
            }
        }
    </script>
    <style>
        html { scroll-behavior: smooth; }

        .hero-bg {
            background: linear-gradient(135deg, #0c4a6e 0%, #0369a1 40%, #0ea5e9 100%);
        }

        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .anim { animation: fadeUp 0.7s ease-out forwards; opacity: 0; }
        .anim.d1 { animation-delay: 80ms; }
        .anim.d2 { animation-delay: 160ms; }
        .anim.d3 { animation-delay: 240ms; }
        .anim.d4 { animation-delay: 320ms; }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .card-hover {
            transition: transform 0.35s cubic-bezier(.4,0,.2,1), box-shadow 0.35s ease;
        }
        .card-hover:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 50px -12px rgba(0,0,0,0.15);
        }
    </style>
    <?php wp_head(); ?>
</head>

<body class="bg-white text-gray-800 antialiased overflow-x-hidden">

    <!-- ═══════════════════════ HERO ═══════════════════════ -->
    <header class="hero-bg relative overflow-hidden">
        <!-- Decorative shapes -->
        <div class="absolute top-0 right-0 w-[500px] h-[500px] rounded-full bg-white/5 -translate-y-1/3 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[350px] h-[350px] rounded-full bg-white/5 translate-y-1/3 -translate-x-1/4"></div>
        <div class="absolute top-8 right-12 opacity-[0.06] hidden xl:block" style="animation: float 5s ease-in-out infinite;">
            <i class="fa-solid fa-wheat-awn text-white text-[200px]"></i>
        </div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 py-16 md:py-20 relative z-10 text-center">
            <div class="anim">
                <span class="inline-flex items-center gap-2 py-1.5 px-5 rounded-full bg-white/15 text-white font-semibold text-xs sm:text-sm mb-5 backdrop-blur-sm border border-white/25">
                    <span class="w-2 h-2 rounded-full bg-amber-400 animate-pulse"></span>
                    HIỂU CON TỪ GỐC - TỰ KỶ LÀ RỐI LOẠN TOÀN THÂN
                </span>
            </div>

            <h1 class="font-heading text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-white leading-tight mb-5 anim d1">
                Bí ẩn đằng sau những bữa ăn <br class="hidden md:block">
                <span class="text-amber-300">Gluten</span> & <span class="text-emerald-300">Casein</span>
            </h1>

            <p class="text-base sm:text-lg md:text-xl text-sky-100 max-w-4xl mx-auto mb-8 leading-relaxed anim d2">
                Tại sao lúa mì và sữa bò - những thực phẩm quen thuộc - lại có thể là "thủ phạm" giấu mặt gây ra sự bứt rứt, rối loạn hành vi và tiêu hóa ở trẻ?
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-3 anim d3">
                <a href="#kham-pha" class="bg-amber-400 hover:bg-amber-300 text-gray-900 px-8 py-3.5 rounded-full font-bold text-base shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Khám phá bản chất khoa học <i class="fa-solid fa-arrow-down animate-bounce"></i>
                </a>
                <a href="#lien-he" class="bg-white/20 hover:bg-white/30 text-white px-8 py-3.5 rounded-full font-bold text-base backdrop-blur-sm border border-white/30 transition-all flex items-center justify-center gap-2 hover:-translate-y-0.5">
                    Tôi cần hỗ trợ <i class="fa-solid fa-headset"></i>
                </a>
            </div>
        </div>

        <!-- Wave -->
        <div class="absolute bottom-0 left-0 w-full overflow-hidden leading-[0]">
            <svg class="relative block w-full h-[40px] md:h-[60px]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V120H0V95.8C59.71,118.06,158.51,122.5,224.27,110Z" fill="#ffffff"></path>
            </svg>
        </div>
    </header>

    <!-- ═══════════════════════ SECTION 1: Check Engine ═══════════════════════ -->
    <section id="kham-pha" class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="flex flex-col lg:flex-row items-stretch gap-0 rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border border-gray-200 anim">
                <!-- Dark side -->
                <div class="lg:w-[45%] bg-slate-800 text-white p-8 sm:p-10 lg:p-12 flex flex-col justify-center relative overflow-hidden">
                    <div class="absolute -right-8 -bottom-8 opacity-10">
                        <i class="fa-solid fa-car-burst text-[180px]"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-16 h-16 bg-red-500 text-white rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg">
                            <i class="fa-solid fa-car-burst"></i>
                        </div>
                        <h2 class="font-heading text-2xl sm:text-3xl font-bold mb-4">Chiếc đèn "Check Engine"</h2>
                        <p class="text-slate-300 leading-relaxed text-base sm:text-lg">
                            Tự kỷ hay những khó khăn về hành vi chỉ là một nhãn mác bề ngoài. Nó giống như đèn báo lỗi trên bảng điều khiển ô tô. Ánh đèn báo động hệ thống chuyển hóa đang trục trặc, chứ không tự nói lên nguyên nhân dưới nắp capo.
                        </p>
                    </div>
                </div>
                <!-- Light side -->
                <div class="lg:w-[55%] p-8 sm:p-10 lg:p-12 flex flex-col justify-center bg-white">
                    <h3 class="font-heading text-xl sm:text-2xl font-bold text-dark mb-4">Hiểu đúng về biểu hiện của con</h3>
                    <p class="text-gray-600 mb-4 leading-relaxed text-base sm:text-lg">
                        Khi quan sát những biểu hiện khó chịu của trẻ sau bữa ăn, chúng ta cần hiểu rằng <strong>đó không phải là kết quả của giáo dục sai cách.</strong>
                    </p>
                    <p class="text-gray-600 leading-relaxed text-base sm:text-lg">
                        Đó là một tình trạng sinh lý học phức tạp liên quan mật thiết đến đường ruột và hệ miễn dịch. Đối với hệ tiêu hóa đang nhạy cảm, có 2 loại protein đặc biệt thường trở thành tác nhân gây quá tải.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 2: Gluten & Casein ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-dark mb-3">Hai "bị cáo" chính: Gluten và Casein</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Vốn dĩ an toàn với người khỏe mạnh, nhưng lại là bài toán hóc búa với hệ tiêu hóa đang tổn thương.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 lg:gap-8">
                <!-- Gluten Card -->
                <div class="bg-white p-7 sm:p-8 rounded-2xl lg:rounded-3xl border border-amber-200 shadow-sm card-hover relative overflow-hidden group anim d1">
                    <div class="absolute -right-8 -top-8 text-amber-100 text-[160px] transition-transform group-hover:scale-110 opacity-60">
                        <i class="fa-solid fa-wheat-awn"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 shadow-md">
                            <i class="fa-solid fa-bread-slice"></i>
                        </div>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-amber-700 mb-3">Gluten</h3>
                        <p class="text-gray-700 leading-relaxed text-base sm:text-lg">
                            Là loại protein phức tạp chủ yếu trong <strong>lúa mì, lúa mạch, lúa mạch đen</strong>. Nhờ Gluten, bột mì mới có độ dẻo, dai và khả năng giữ bọt khí tạo độ xốp cho bánh mì, bánh ngọt.
                        </p>
                    </div>
                </div>

                <!-- Casein Card -->
                <div class="bg-white p-7 sm:p-8 rounded-2xl lg:rounded-3xl border border-blue-200 shadow-sm card-hover relative overflow-hidden group anim d2">
                    <div class="absolute -right-8 -top-8 text-blue-100 text-[160px] transition-transform group-hover:scale-110 opacity-60">
                        <i class="fa-solid fa-cow"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="w-14 h-14 bg-sky-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 shadow-md">
                            <i class="fa-solid fa-glass-water"></i>
                        </div>
                        <h3 class="font-heading text-2xl sm:text-3xl font-bold text-sky-700 mb-3">Casein</h3>
                        <p class="text-gray-700 leading-relaxed text-base sm:text-lg">
                            Thành phần protein chính trong <strong>sữa động vật có vú</strong>, chiếm khoảng 80% protein trong sữa bò. Đây là chất giúp sữa kết tủa và tạo thành phô mai.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 3: Infographic Mechanism ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white relative overflow-hidden">
        <div class="absolute top-0 right-0 w-[300px] h-[300px] rounded-full bg-sky-100/50 blur-[80px] -translate-y-1/2 translate-x-1/4"></div>
        <div class="absolute bottom-0 left-0 w-[250px] h-[250px] rounded-full bg-emerald-100/50 blur-[80px] translate-y-1/2 -translate-x-1/4"></div>

        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
            <div class="text-center mb-10 md:mb-14 anim">
                <span class="inline-block bg-primary text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Cơ chế sinh hóa</span>
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-dark mb-3">Câu chuyện ở cấp độ phân tử</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Tại sao hai loại protein này lại cứng đầu đến vậy? Hãy cùng hình dung qua 3 giai đoạn...</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Step 1 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover group anim d1">
                    <!-- Top colored bar + icon -->
                    <div class="bg-primary py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-10">
                            <i class="fa-solid fa-link text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-primary text-2xl font-heading font-extrabold">1</span>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-white relative z-10">Cấu trúc "cáp thép" Proline</h3>
                    </div>
                    <!-- Content -->
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-3">
                            Hầu hết các loại đạm (protein) từ thịt cá có cấu trúc khá lỏng lẻo, dễ dàng bị dịch vị dạ dày phân giải. Tuy nhiên, Gluten và Casein lại chứa một lượng khổng lồ axit amin mang tên <strong>Proline</strong>.
                        </p>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Đặc tính hóa học của Proline là tạo ra những điểm gấp khúc cực kỳ bền vững, biến chuỗi protein thành một "sợi dây cáp" cuộn gập, thắt nút phức tạp. Các enzyme tiêu hóa thông thường hoàn toàn "bó tay", chúng bị trượt đi và chỉ có thể cắt khối đạm cứng đầu này thành những đoạn ngắn dở dang.
                        </p>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover group anim d2">
                    <div class="bg-secondary py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-10">
                            <i class="fa-solid fa-scissors text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-secondary text-2xl font-heading font-extrabold">2</span>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-white relative z-10">"Kìm cắt cáp" enzyme DPP-IV</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-3">
                            Tạo hóa đã trang bị cho cơ thể một "chốt chặn" an toàn cuối cùng: <strong>Enzyme DPP-IV (Dipeptidyl Peptidase IV)</strong>. Nếu dịch vị dạ dày là chiếc kéo cắt giấy, thì DPP-IV chính là chiếc "kìm cắt cáp chuyên dụng" duy nhất có khả năng nhận diện và bẻ gãy các liên kết Proline.
                        </p>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Enzyme này không trôi nổi tự do mà được gắn chặt trên lớp <em>diềm bàn chải</em> – hệ thống hàng triệu sợi lông tơ (nhung mao) siêu nhỏ lót dọc niêm mạc ruột non, làm nhiệm vụ tinh chế thức ăn thành dưỡng chất đơn lẻ trước khi đưa vào máu.
                        </p>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="bg-white rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 overflow-hidden card-hover group anim d3">
                    <div class="bg-red-500 py-5 px-6 flex items-center gap-4 relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-10">
                            <i class="fa-solid fa-fire-flame-curved text-[80px] text-white"></i>
                        </div>
                        <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-lg shrink-0 relative z-10">
                            <span class="text-red-500 text-2xl font-heading font-extrabold">3</span>
                        </div>
                        <h3 class="font-heading text-lg sm:text-xl font-bold text-white relative z-10">Điểm gãy vỡ: Viêm ruột</h3>
                    </div>
                    <div class="p-6 sm:p-7">
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed mb-3">
                            Ở phần lớn trẻ rối loạn phát triển, hệ vi sinh đường ruột thường xuyên bị mất cân bằng (loạn khuẩn). Sự phát triển quá mức của hại khuẩn và nấm men tạo ra tình trạng viêm nhiễm niêm mạc kéo dài.
                        </p>
                        <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                            Hậu quả là lớp nhung mao mỏng manh bị bào mòn, xơ xác giống như một tấm thảm cũ. Khi "nhà máy" sản xuất DPP-IV bị phá hủy, cơ thể trẻ hoàn toàn mất đi khả năng vô hiệu hóa Gluten và Casein. Những mảng protein dở dang này tiếp tục trôi xuống, châm ngòi cho hàng loạt rắc rối.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 4: Consequences ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-red-500 text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Hệ lụy</span>
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-dark mb-3">Hệ lụy của "peptide lửng lơ"</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Khi không được cắt nhỏ hoàn toàn, Gluten và Casein biến thành các đoạn peptide lửng lơ, lọt vào máu qua kẽ hở ruột và gây ra 3 nhiễu loạn chính:</p>
            </div>

            <div class="grid sm:grid-cols-3 gap-5 lg:gap-6">
                <!-- Consequence 1 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d1">
                    <div class="w-14 h-14 bg-red-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-shield-virus"></i>
                    </div>
                    <h3 class="font-heading font-bold text-lg sm:text-xl text-dark mb-2">Kích hoạt miễn dịch</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Hệ miễn dịch coi peptide là vật thể lạ, lập tức tiết kháng thể tấn công, tạo ra tình trạng viêm nhiễm lan rộng toàn thân.</p>
                </div>

                <!-- Consequence 2 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d2">
                    <div class="w-14 h-14 bg-amber-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-battery-quarter"></i>
                    </div>
                    <h3 class="font-heading font-bold text-lg sm:text-xl text-dark mb-2">Suy hao năng lượng</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Cơ thể liên tục phải chống chọi vắt kiệt năng lượng tế bào (Ty thể). Trẻ mệt mỏi, cáu gắt như xe phải "chạy khi bình xăng cạn".</p>
                </div>

                <!-- Consequence 3 -->
                <div class="bg-white rounded-2xl p-6 sm:p-7 border border-gray-200 shadow-sm card-hover group anim d3">
                    <div class="w-14 h-14 bg-purple-500 text-white rounded-xl flex items-center justify-center text-2xl mb-5 group-hover:scale-110 transition-transform shadow-md">
                        <i class="fa-solid fa-brain"></i>
                    </div>
                    <h3 class="font-heading font-bold text-lg sm:text-xl text-dark mb-2">Nhiễu loạn thần kinh</h3>
                    <p class="text-gray-600 text-sm sm:text-base leading-relaxed">Peptide vượt hàng rào máu não, ảnh hưởng dẫn truyền thần kinh. Trẻ lờ đờ, mất kiểm soát hành vi như trạng thái "say rượu".</p>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ SECTION 5: Solutions ═══════════════════════ -->
    <section class="py-12 md:py-16 bg-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12">
            <div class="text-center mb-10 md:mb-12 anim">
                <span class="inline-block bg-secondary text-white px-4 py-1 rounded-full font-bold text-xs tracking-widest uppercase mb-3">Giải pháp</span>
                <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl font-bold text-dark mb-3">Tìm kiếm nguồn thay thế an toàn</h2>
                <p class="text-gray-500 max-w-3xl mx-auto text-base sm:text-lg">Can thiệp tận gốc là ngừng cung cấp "vật liệu" gây khó dễ, cho niêm mạc ruột cơ hội tự phục hồi. Việc cắt giảm không làm trẻ thiếu chất nếu thay thế đúng cách.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-6 lg:gap-8 mb-8 anim d1">
                <!-- Carb Alternative -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 card-hover">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-emerald-500 text-white rounded-xl flex items-center justify-center text-xl shadow-md shrink-0">
                            <i class="fa-solid fa-bowl-rice"></i>
                        </div>
                        <h3 class="font-heading text-xl sm:text-2xl font-bold text-dark">Thay thế lúa mì (carbohydrate)</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3 text-lg"></i>
                            Gạo tẻ, gạo lứt (nếu trẻ tiêu hóa tốt)
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3 text-lg"></i>
                            Khoai lang, khoai tây
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3 text-lg"></i>
                            Yến mạch không chứa Gluten (certified GF)
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-emerald-500 mt-1 mr-3 text-lg"></i>
                            Hạt kiều mạch
                        </li>
                    </ul>
                </div>

                <!-- Calcium Alternative -->
                <div class="bg-white p-6 sm:p-8 rounded-2xl lg:rounded-3xl shadow-md border border-gray-200 card-hover">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 bg-sky-500 text-white rounded-xl flex items-center justify-center text-xl shadow-md shrink-0">
                            <i class="fa-solid fa-bone"></i>
                        </div>
                        <h3 class="font-heading text-xl sm:text-2xl font-bold text-dark">Thay thế sữa bò (canxi)</h3>
                    </div>
                    <ul class="space-y-3">
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-sky-500 mt-1 mr-3 text-lg"></i>
                            Sữa hạt (sữa hạnh nhân, hạt điều, hạt sen...)
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-sky-500 mt-1 mr-3 text-lg"></i>
                            Nước cốt hầm xương nhỏ lửa
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-sky-500 mt-1 mr-3 text-lg"></i>
                            Mè đen, các loại cá nhỏ ăn cả xương (cá cơm)
                        </li>
                        <li class="flex items-start text-gray-700 text-base">
                            <i class="fa-solid fa-check text-sky-500 mt-1 mr-3 text-lg"></i>
                            Rau sẫm màu (súp lơ xanh, rau bó xôi)
                        </li>
                    </ul>
                </div>
            </div>

            <!-- The Rule -->
            <div class="bg-amber-500 rounded-2xl p-6 sm:p-8 text-white shadow-md anim d2">
                <div class="flex items-start gap-4">
                    <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-triangle-exclamation text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-lg sm:text-xl font-heading font-bold mb-2">Nguyên tắc cốt lõi: "Chậm và ít"</h3>
                        <p class="text-amber-50 text-sm sm:text-base leading-relaxed">
                            Cơ thể trẻ cần thời gian làm quen. Cắt giảm đột ngột có thể gây sốc sinh lý. Hãy thay đổi từ từ, quan sát phản ứng của trẻ qua nhật ký ăn uống hàng ngày. Việc này không phải phép màu chữa khỏi tự kỷ tức thì, nhưng nó tạo ra nền tảng nội môi ổn định để trẻ phát triển.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ═══════════════════════ FOOTER / CTA ═══════════════════════ -->
    <section id="lien-he" class="relative overflow-hidden">
        <div class="bg-gradient-to-br from-gray-900 via-slate-900 to-sky-900 py-14 md:py-20">
            <!-- Glow effects -->
            <div class="absolute top-0 right-1/3 w-[500px] h-[500px] bg-sky-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 left-1/3 w-[400px] h-[400px] bg-emerald-500/10 rounded-full blur-[120px]"></div>

            <div class="max-w-7xl mx-auto px-5 sm:px-8 lg:px-12 relative z-10">
                <!-- Heading -->
                <div class="text-center mb-10 md:mb-14 anim">
                    <h2 class="font-heading text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white mb-4">Cùng bạn hiểu con</h2>
                    <p class="text-slate-300 text-base sm:text-lg md:text-xl max-w-4xl mx-auto leading-relaxed">
                        Hành trình y sinh không phải là một con đường dễ dàng và không gia đình nào nên đi một mình. Nếu con đang gặp rào cản hành vi, rối loạn tiêu hóa, hãy để chúng tôi đồng hành.
                    </p>
                </div>

                <!-- CTA Cards -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-5 mb-12 anim d1">
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" 
                       class="bg-white/10 hover:bg-[#1877F2] border border-white/10 hover:border-[#1877F2] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(24,119,242,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Cộng đồng phụ huynh</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Facebook Group</span>
                        </div>
                    </a>

                    <a href="https://zalo.me/g/vmgfxy834" target="_blank" 
                       class="bg-white/10 hover:bg-[#0068FF] border border-white/10 hover:border-[#0068FF] text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(0,104,255,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-comment-dots text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Nhóm Zalo hỗ trợ</span>
                            <span class="text-sm text-slate-400 group-hover:text-blue-100 transition-colors">Giải đáp nhanh</span>
                        </div>
                    </a>

                    <a href="tel:0988717107" 
                       class="bg-white/10 hover:bg-primary border border-white/10 hover:border-primary text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(14,165,233,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-phone text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">0988.717.107</span>
                            <span class="text-sm text-slate-400 group-hover:text-sky-100 transition-colors">Hotline tư vấn</span>
                        </div>
                    </a>

                    <a href="https://www.facebook.com/trolynamkhanh" target="_blank" 
                       class="bg-white/10 hover:bg-secondary border border-white/10 hover:border-secondary text-white p-6 rounded-2xl transition-all duration-300 flex items-center gap-4 group backdrop-blur-sm hover:-translate-y-1 hover:shadow-[0_0_30px_rgba(16,185,129,0.3)]">
                        <div class="w-12 h-12 bg-white/10 group-hover:bg-white/20 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                            <i class="fa-solid fa-headset text-2xl"></i>
                        </div>
                        <div class="min-w-0">
                            <span class="font-bold text-base block truncate">Trợ lý Nam Khánh</span>
                            <span class="text-sm text-slate-400 group-hover:text-emerald-100 transition-colors">Kết nối trực tiếp</span>
                        </div>
                    </a>
                </div>

                <!-- Disclaimer + Copyright -->
                <div class="border-t border-white/10 pt-8 anim d2">
                    <div class="bg-white/5 rounded-2xl p-5 sm:p-6 backdrop-blur-sm border border-white/5 mb-6 max-w-5xl mx-auto">
                        <p class="text-slate-400 text-xs sm:text-sm leading-relaxed">
                            <strong class="text-slate-300">⚠️ TUYÊN BỐ MIỄN TRỪ TRÁCH NHIỆM Y KHOA:</strong> Bài viết chỉ nhằm mục đích cung cấp thông tin khoa học và giáo dục cộng đồng, hoàn toàn không thay thế cho các chẩn đoán hay phác đồ điều trị y khoa chuyên nghiệp. Mọi quyết định thay đổi chế độ ăn hoặc sử dụng thực phẩm bổ sung cần được tham khảo ý kiến bác sĩ hoặc chuyên gia y tế, dựa trên tình trạng sức khỏe thực tế của từng trẻ.
                        </p>
                    </div>
                    <div class="text-center">
                        <p class="text-slate-500 text-sm">&copy; <?php echo date('Y'); ?> Hiểu con từ Gốc - Tự kỷ là Rối loạn toàn thân</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Scroll animation -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
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

    <?php wp_footer(); ?>
</body>
