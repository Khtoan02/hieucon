<?php
/**
 * Template Name: Trang chủ
 * 
 * @package Hieucon
 */
?>
<?php get_header(); ?>
<!-- Thêm scripts & styles đặc thù cho trang chủ -->
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://unpkg.com/lucide@latest"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">

<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ['Nunito', 'sans-serif'], // Font thân thiện, mềm mại cho nội dung
                    serif: ['Lora', 'serif'],       // Font nghệ thuật, cao cấp cho tiêu đề
                },
                colors: {
                    primary: '#0d9488', 
                    secondary: '#f97316', 
                    secondary_light: '#ffedd5',
                    secondary_dark: '#ea580c', 
                    navy: {
                        DEFAULT: '#0A1931', // Xanh navy đậm
                        light: '#1A365D',
                        muted: '#334155'
                    },
                    sunset: {
                        top: '#FFF9F0', 
                        mid: '#FFD6C0', 
                        bot: '#B4C8BB'  
                    }
                },
                boxShadow: {
                    'elegant': '0 10px 40px -10px rgba(10, 25, 49, 0.08)',
                    'soft': '0 4px 20px -2px rgba(10, 25, 49, 0.05)',
                }
            }
        }
    }
</script>
<style>
    body { font-family: 'Nunito', sans-serif; background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%); background-attachment: fixed; color: #0A1931; }
    h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Lora', serif; }
    
    .gradient-text {
        background: linear-gradient(90deg, #0A1931, #ea580c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    
    /* Hiệu ứng nền mượt mà trượt theo nội dung */
    .bg-healing-gradient {
        background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%);
        background-attachment: fixed;
    }

    /* Glassmorphism mềm mại hơn */
    .glass-elegant {
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.6);
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.9) 0%, rgba(255,255,255,0.6) 100%);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }

    /* Divider tinh tế */
    .elegant-divider {
        width: 40px;
        height: 2px;
        background-color: #f97316;
        margin: 1.5rem auto;
        border-radius: 2px;
        opacity: 0.6;
    }
</style>
    <!-- Hero Section (Full-width Cover Image) -->
    <section class="w-full relative bg-white/10">
        <img src="https://hieu-con.dawnbridge.vn/wp-content/uploads/2026/03/Section-1.jpg" alt="Ảnh bìa Hiểu Con Từ Gốc" class="w-full h-auto max-h-[65vh] object-cover object-top block shadow-md">
        <!-- Lớp phủ nhẹ ở đáy ảnh để hòa quyện với nền -->
        <div class="absolute bottom-0 left-0 w-full h-24 bg-gradient-to-t from-[#FFF9F0] to-transparent"></div>
    </section>

    <!-- Welcome Message Section (Editorial Style) -->
    <section id="loi-chao" class="pt-16 pb-20 md:pt-24 md:pb-28 relative z-10 px-4">
        <div class="max-w-4xl mx-auto text-center">
            <span class="inline-flex items-center gap-2 text-secondary font-bold text-xs md:text-sm mb-6 uppercase tracking-widest">
                <i data-lucide="sparkles" class="w-4 h-4"></i> Bắt đầu từ lòng yêu thương
            </span>
            
            <h2 class="font-serif text-3xl md:text-5xl lg:text-6xl text-navy mb-6 leading-tight px-2">
                Chào mừng ba mẹ đến với<br class="hidden sm:block" />
                ngôi nhà chung
            </h2>
            <h3 class="font-serif text-2xl md:text-3xl lg:text-4xl text-secondary italic mb-12">
                "Thấu hiểu để yêu thương con đặc biệt"
            </h3>
            
            <!-- Trích dẫn tâm điểm -->
            <div class="relative max-w-3xl mx-auto my-16 px-4">
                <div class="absolute -top-8 left-1/2 -translate-x-1/2 text-secondary/20">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.017 21L16.41 14H12V3H22V14.5L18.414 21H14.017ZM3.017 21L5.41 14H1V3H11V14.5L7.414 21H3.017Z" />
                    </svg>
                </div>
                <p class="font-serif text-xl md:text-3xl text-navy leading-relaxed italic relative z-10">
                    Yêu thương không chỉ là chấp nhận,<br class="hidden md:block"> yêu thương là nỗ lực tìm ra gốc rễ vấn đề để <span class="font-bold text-secondary">PHỤC HỒI</span> sức khỏe cho con.
                </p>
                <div class="elegant-divider"></div>
            </div>
            
            <p class="text-base md:text-xl text-navy/70 font-medium mb-12 max-w-2xl mx-auto px-4 leading-relaxed">
                Tại đây, chúng ta chuyển dịch từ việc chỉ quan sát hành vi bề nổi sang việc thấu hiểu cơ thể sinh học bên trong.
            </p>
            
            <a href="#goc-nhin-khoa-hoc" class="inline-flex glass-elegant text-navy hover:bg-navy hover:text-white px-8 py-3.5 md:py-4 rounded-full text-base md:text-lg font-bold transition-all shadow-soft hover:shadow-elegant items-center gap-3 group cursor-pointer">
                Bắt đầu hành trình
                <i data-lucide="arrow-down" class="w-5 h-5 group-hover:translate-y-1 transition-transform"></i>
            </a>
        </div>
    </section>

    <!-- Why Whole-Body Section (Artistic Layout) -->
    <section id="goc-nhin-khoa-hoc" class="py-16 md:py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 md:mb-20">
                <h3 class="font-serif text-3xl md:text-5xl text-navy mb-6">Vì sao tự kỷ là rối loạn toàn thân?</h3>
                <div class="elegant-divider"></div>
                <p class="text-base md:text-xl text-navy/70 font-medium max-w-3xl mx-auto px-2 leading-relaxed">
                    Nhiều cha mẹ nghĩ rằng Tự kỷ/Tăng động chỉ là vấn đề của não bộ. Nhưng khoa học đã chứng minh: <strong class="text-navy font-bold">Não bộ không hoạt động biệt lập.</strong> Biểu hiện khó khăn thực chất là hệ quả của sự rối loạn hệ thống.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                <!-- Card 1 -->
                <div class="glass-card p-8 md:p-10 rounded-[2rem] shadow-soft hover:shadow-elegant transition-all duration-500 group flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white/80 rounded-full flex items-center justify-center mb-6 text-navy shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="activity" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-serif text-2xl font-bold text-navy mb-4">Đường ruột tổn thương</h4>
                    <p class="text-navy/70 font-medium leading-relaxed">
                        Rò rỉ ruột, loạn khuẩn đường ruột gửi tín hiệu sai lệch và ảnh hưởng trực tiếp lên não bộ thông qua trục Não - Ruột.
                    </p>
                </div>
                <!-- Card 2 -->
                <div class="glass-card p-8 md:p-10 rounded-[2rem] shadow-soft hover:shadow-elegant transition-all duration-500 group flex flex-col items-center text-center md:translate-y-8">
                    <div class="w-16 h-16 bg-white/80 rounded-full flex items-center justify-center mb-6 text-secondary shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="shield-alert" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-serif text-2xl font-bold text-navy mb-4">Hệ miễn dịch suy yếu</h4>
                    <p class="text-navy/70 font-medium leading-relaxed">
                        Sự quá mẫn cảm hoặc suy yếu của hệ miễn dịch gây ra các phản ứng viêm, đặc biệt là viêm thần kinh làm cản trở sự phát triển.
                    </p>
                </div>
                <!-- Card 3 -->
                <div class="glass-card p-8 md:p-10 rounded-[2rem] shadow-soft hover:shadow-elegant transition-all duration-500 group flex flex-col items-center text-center">
                    <div class="w-16 h-16 bg-white/80 rounded-full flex items-center justify-center mb-6 text-navy shadow-sm group-hover:-translate-y-2 transition-transform duration-300">
                        <i data-lucide="biohazard" class="w-7 h-7"></i>
                    </div>
                    <h4 class="font-serif text-2xl font-bold text-navy mb-4">Gánh nặng độc tố</h4>
                    <p class="text-navy/70 font-medium leading-relaxed">
                        Sự tích tụ độc tố và rối loạn chuyển hóa ngăn cản sự phát triển nhận thức và khả năng tiếp thu thế giới xung quanh của trẻ.
                    </p>
                </div>
            </div>

            <div class="mt-20 md:mt-32 text-center px-4">
                <div class="inline-flex flex-col md:flex-row items-center gap-4 bg-white/50 backdrop-blur-xl px-8 py-6 rounded-[2rem] border border-white/60 shadow-elegant max-w-3xl mx-auto">
                    <div class="bg-secondary/10 p-4 rounded-full shrink-0">
                        <i data-lucide="sun" class="w-8 h-8 text-secondary"></i>
                    </div>
                    <p class="text-center md:text-left text-lg md:text-xl font-medium text-navy leading-relaxed">
                        Vì vậy, muốn sửa lỗi ở Não bộ, ta phải bắt đầu <strong class="text-secondary font-bold uppercase tracking-wide">PHỤC HỒI từ cơ thể</strong>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Approach Section -->
    <section id="phuong-phap" class="py-20 md:py-28 relative">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col lg:flex-row gap-12 lg:gap-20 items-center">
                
                <!-- Left: Text content -->
                <div class="w-full lg:w-5/12 text-center lg:text-left">
                    <span class="text-secondary font-bold uppercase tracking-widest text-sm mb-4 block">Phương pháp</span>
                    <h3 class="font-serif text-3xl md:text-4xl lg:text-5xl text-navy mb-6 leading-tight">Tiếp cận toàn diện & kết hợp</h3>
                    <p class="text-navy/70 font-medium text-lg mb-8 leading-relaxed">
                        Chúng tôi khẳng định việc phục hồi sức khỏe sinh học cần được đan xen chặt chẽ như những mảnh ghép với giáo dục và trị liệu tâm lý.
                    </p>
                    <div class="text-navy font-serif italic text-lg md:text-xl pl-6 border-l-4 border-secondary/40 py-2">
                        "Giúp con rút ngắn thời gian can thiệp, đạt hiệu quả tối ưu."
                    </div>
                </div>

                <!-- Right: Visual blocks -->
                <div class="w-full lg:w-7/12 relative">
                    <div class="glass-card p-8 rounded-[2rem] shadow-elegant relative z-10 lg:-mr-10 mb-6 lg:mb-0 hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-start gap-5">
                            <div class="bg-navy/5 p-3 rounded-2xl text-navy">
                                <i data-lucide="heart-pulse" class="w-8 h-8"></i>
                            </div>
                            <div>
                                <h4 class="font-serif text-2xl font-bold text-navy mb-2">Phần Nền: Y Sinh</h4>
                                <p class="text-navy/70 font-medium leading-relaxed">Giúp con có cơ thể khỏe mạnh từ bên trong, thiết lập lại giấc ngủ và sự tập trung làm nền tảng.</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="glass-card p-8 rounded-[2rem] shadow-elegant relative z-20 lg:ml-10 hover:-translate-y-1 transition-transform duration-300">
                        <div class="flex items-start gap-5">
                            <div class="bg-secondary/10 p-3 rounded-2xl text-secondary">
                                <i data-lucide="graduation-cap" class="w-8 h-8"></i>
                            </div>
                            <div>
                                <h4 class="font-serif text-2xl font-bold text-navy mb-2">Phần Kỹ Năng: Giáo Dục</h4>
                                <p class="text-navy/70 font-medium leading-relaxed">Học hỏi kỹ năng mới, phát triển ngôn ngữ, hành vi và từng bước hòa nhập với thế giới.</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Community Activities -->
    <section id="hoat-dong" class="py-16 md:py-24 relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-16 md:mb-20">
                <h3 class="font-serif text-3xl md:text-4xl lg:text-5xl text-navy mb-6">Không gian này là để chúng ta...</h3>
                <div class="elegant-divider"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
                <!-- Activity 1 -->
                <div class="bg-white/40 backdrop-blur-md p-8 md:p-10 rounded-[2.5rem] border border-white/60 hover:bg-white/60 transition-colors duration-300 flex flex-col h-full">
                    <div class="mb-6">
                        <i data-lucide="book-open" class="w-10 h-10 text-navy mb-6 opacity-70"></i>
                        <h4 class="font-serif text-2xl font-bold text-navy mb-4">Khám phá kiến thức</h4>
                        <p class="text-navy/60 font-bold uppercase tracking-wider text-xs mb-6">Trụ cột khoa học</p>
                    </div>
                    <ul class="space-y-4 font-medium text-navy/80 flex-grow">
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Trục Não - Ruột & Hệ vi sinh vật.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Dinh dưỡng trị liệu & Chế độ ăn (GFCF, Low-Hista...).</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Giải độc tố & Cân bằng chuyển hóa.</span>
                        </li>
                    </ul>
                </div>

                <!-- Activity 2 -->
                <div class="bg-white/40 backdrop-blur-md p-8 md:p-10 rounded-[2.5rem] border border-white/60 hover:bg-white/60 transition-colors duration-300 flex flex-col h-full">
                    <div class="mb-6">
                        <i data-lucide="message-circle" class="w-10 h-10 text-secondary mb-6 opacity-80"></i>
                        <h4 class="font-serif text-2xl font-bold text-navy mb-4">Trao đổi & Tư vấn</h4>
                        <p class="text-navy/60 font-bold uppercase tracking-wider text-xs mb-6">Đồng hành sát sao</p>
                    </div>
                    <ul class="space-y-5 font-medium text-navy/80 flex-grow">
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-navy mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Hướng dẫn cách <strong class="text-navy">"đọc hiểu"</strong> tín hiệu cơ thể: giấc ngủ, tiêu hóa, hành vi, dị ứng...</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-navy mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Giải đáp thắc mắc về thực đơn, vi chất và lộ trình nền tảng.</span>
                        </li>
                    </ul>
                </div>

                <!-- Activity 3 -->
                <div class="bg-white/40 backdrop-blur-md p-8 md:p-10 rounded-[2.5rem] border border-white/60 hover:bg-white/60 transition-colors duration-300 flex flex-col h-full">
                    <div class="mb-6">
                        <i data-lucide="users" class="w-10 h-10 text-navy mb-6 opacity-70"></i>
                        <h4 class="font-serif text-2xl font-bold text-navy mb-4">Sẻ chia giải pháp</h4>
                        <p class="text-navy/60 font-bold uppercase tracking-wider text-xs mb-6">Không phó mặc</p>
                    </div>
                    <ul class="space-y-5 font-medium text-navy/80 flex-grow">
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Không chỉ sẻ chia cảm xúc, chúng ta tìm kiếm <strong class="text-navy">Giải pháp</strong>.</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-1.5 h-1.5 rounded-full bg-secondary mt-2.5 shrink-0"></div>
                            <span class="leading-relaxed">Cùng kiên trì áp dụng để thấy sự thay đổi tích cực mỗi ngày.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Goals Section -->
    <section class="py-16 md:py-24 relative">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="glass-card rounded-[3rem] p-8 md:p-16 shadow-elegant text-center">
                <i data-lucide="feather" class="w-12 h-12 text-secondary mx-auto mb-6 opacity-80"></i>
                <h3 class="font-serif text-3xl md:text-4xl text-navy mb-10">Mục tiêu của cộng đồng</h3>
                
                <div class="space-y-8 text-left max-w-2xl mx-auto">
                    <div class="flex items-start gap-4">
                        <span class="font-serif text-2xl text-secondary/40 font-bold mt-1">01.</span>
                        <p class="text-navy/80 font-medium text-lg md:text-xl leading-relaxed">Cha mẹ hiểu biết, không phó mặc, chủ động trở thành <strong class="text-navy font-bold">"người bác sĩ"</strong> tốt nhất của con.</p>
                    </div>
                    
                    <div class="flex items-start gap-4">
                        <span class="font-serif text-2xl text-secondary/40 font-bold mt-1">02.</span>
                        <p class="text-navy/80 font-medium text-lg md:text-xl leading-relaxed">Lan tỏa tư duy y học cốt lõi: <strong class="text-navy font-bold">"Cơ thể khỏe thì não bộ mới khỏe"</strong>.</p>
                    </div>

                    <div class="flex items-start gap-4">
                        <span class="font-serif text-2xl text-secondary/40 font-bold mt-1">03.</span>
                        <p class="text-navy/80 font-medium text-lg md:text-xl leading-relaxed">Là điểm tựa tin cậy, vững chãi dựa trên nền tảng <strong class="text-navy font-bold">khoa học thực chứng</strong>.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Disclaimer & Footer -->
    <footer class="mt-10 border-t border-white/40 bg-white/30 backdrop-blur-md pt-16 pb-10">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Disclaimer Box -->
            <div class="bg-white/60 backdrop-blur-sm rounded-3xl p-6 md:p-8 border border-white shadow-sm mb-16 flex flex-col md:flex-row gap-5 items-start">
                <div class="bg-secondary/10 p-3 rounded-full shrink-0">
                    <i data-lucide="info" class="w-6 h-6 text-secondary"></i>
                </div>
                <div>
                    <h4 class="font-serif text-navy font-bold text-lg mb-2">Lưu ý quan trọng</h4>
                    <p class="text-navy/70 font-medium text-sm md:text-base leading-relaxed">
                        Các thông tin trong nhóm mang tính chất chia sẻ kiến thức, giáo dục sức khỏe và hỗ trợ cộng đồng. Mọi quyết định can thiệp y tế chuyên sâu cần có sự tham vấn của các y bác sĩ, chuyên gia có chuyên môn phù hợp với thể trạng riêng biệt của từng trẻ.
                    </p>
                </div>
            </div>

            <div class="flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="flex items-center gap-3 text-center md:text-left">
                    <div class="p-2 bg-secondary/10 rounded-full text-secondary">
                        <i data-lucide="heart" class="w-4 h-4"></i>
                    </div>
                    <span class="font-serif italic text-navy text-base md:text-lg">Hiểu con từ gốc, yêu thương trọn vẹn.</span>
                </div>
                <div class="text-sm font-medium text-navy/50 text-center md:text-right">
                    &copy; 2024 Cộng đồng Hiểu Con Từ Gốc.<br class="md:hidden" /> All rights reserved.
                </div>
            </div>
        </div>
    </footer>

    <!-- Initialize Icons -->
    <script>
        // Cài đặt nét icon mảnh hơn (1.5) để trông tinh tế và cao cấp hơn
        lucide.createIcons({
            strokeWidth: 1.5
        });
    </script>
</body>