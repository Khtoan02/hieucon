<?php
/**
 * The footer for our theme
 *
 * @package Hieucon
 */
?>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <footer id="colophon" class="bg-gradient-to-b from-[#0A1931] to-[#0A1121] text-white pt-20 pb-8 relative overflow-hidden [font-family:'Nunito',_sans-serif]">
        <!-- Đồ họa trang trí (Decorative background) -->
        <i data-lucide="heart-handshake" class="absolute -right-20 -bottom-20 w-96 h-96 text-white/[0.03] rotate-[-15deg] pointer-events-none"></i>
        <i data-lucide="dna" class="absolute -left-10 top-20 w-64 h-64 text-white/[0.02] rotate-[30deg] pointer-events-none"></i>

        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-12 gap-12 lg:gap-16 mb-16">
                <!-- Cột 1: Thông điệp cốt lõi (4 cột) -->
                <div class="xl:col-span-4 flex flex-col">
                    <h2 class="[font-family:'Lora',_serif] text-2xl md:text-3xl font-bold mb-6 text-white flex items-center gap-3">
                        <i data-lucide="leaf" class="w-8 h-8 text-[#f97316]"></i>
                        Hiểu Con Từ Gốc
                    </h2>
                    <p class="text-white/80 text-lg leading-relaxed mb-6 italic border-l-4 border-[#f97316]/60 pl-4">
                        “Yêu thương không chỉ là chấp nhận, yêu thương là nỗ lực tìm ra gốc rễ vấn đề để <strong class="text-white">PHỤC HỒI</strong> sức khỏe cho con.”
                    </p>
                    <p class="text-white/70 text-sm leading-relaxed mb-8">
                        Chào mừng ba mẹ đến với phiên bản nâng cấp chuyên sâu của ngôi nhà chung "Thấu hiểu để yêu thương con đặc biệt". Hành trình nơi chúng ta chuyển dịch từ quan sát hành vi bề nổi sang thấu hiểu cơ thể sinh học bên trong.
                    </p>
                    <div class="flex gap-4 mt-auto">
                        <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener" aria-label="Facebook" class="w-10 h-10 rounded-full bg-white/10 hover:bg-[#f97316] flex items-center justify-center transition-colors border border-white/20 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="https://www.youtube.com/@hieucontugoc?sub_confirmation=1" target="_blank" rel="noopener" aria-label="Youtube" class="w-10 h-10 rounded-full bg-white/10 hover:bg-[#f97316] flex items-center justify-center transition-colors border border-white/20 text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M2.5 7.1A2.5 2.5 0 0 1 5 4.6h14a2.5 2.5 0 0 1 2.5 2.5v9.8a2.5 2.5 0 0 1-2.5 2.5H5a2.5 2.5 0 0 1-2.5-2.5V7.1z"/><path d="m10 15 5-3-5-3v6z"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Cột 2: Triết lý & Tiếp cận (4 cột) -->
                <div class="xl:col-span-4">
                    <h3 class="[font-family:'Lora',_serif] text-xl font-bold mb-6 text-white border-b border-white/10 pb-3">Tự Kỷ Là Rối Loạn Toàn Thân</h3>
                    <ul class="space-y-4 text-white/70 text-sm">
                        <li class="flex items-start gap-3">
                            <i data-lucide="brain-circuit" class="w-5 h-5 text-[#f97316] shrink-0 mt-0.5"></i>
                            <p>Khoa học chứng minh não bộ không hoạt động biệt lập. Những khó khăn của con là hệ quả từ sự rối loạn hệ thống.</p>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="activity" class="w-5 h-5 text-[#f97316] shrink-0 mt-0.5"></i>
                            <p>Đường ruột tổn thương, miễn dịch suy yếu và gánh nặng độc tố trực tiếp ngăn cản sự phát triển nhận thức.</p>
                        </li>
                        <li class="flex items-start gap-3">
                            <i data-lucide="puzzle" class="w-5 h-5 text-[#f97316] shrink-0 mt-0.5"></i>
                            <p><strong class="text-white">Tiếp cận toàn diện:</strong> Phục hồi sức khỏe Y sinh (Phần Nền) song hành cùng Can thiệp Giáo dục & Hành vi (Phần Kỹ năng).</p>
                        </li>
                    </ul>
                </div>

                <!-- Cột 3: Cộng đồng & Mục tiêu (4 cột) -->
                <div class="xl:col-span-4 bg-white/5 rounded-3xl p-6 border border-white/10">
                    <h3 class="[font-family:'Lora',_serif] text-xl font-bold mb-4 text-white">Trụ Cột Kiến Thức</h3>
                    <div class="flex flex-wrap gap-2 mb-6 text-[12px] font-medium text-[#0A1931]">
                        <span class="bg-[#f97316]/90 px-3 py-1 rounded-full">Trục Não - Ruột</span>
                        <span class="bg-[#f97316]/90 px-3 py-1 rounded-full">Dinh dưỡng trị liệu</span>
                        <span class="bg-[#f97316]/90 px-3 py-1 rounded-full">Giải độc tố</span>
                        <span class="bg-[#f97316]/90 px-3 py-1 rounded-full">Y sinh (Biomedical)</span>
                    </div>
                    
                    <p class="text-white/80 text-sm leading-relaxed mb-6">
                        Xây dựng cộng đồng cha mẹ hiểu biết, không phó mặc. Trở thành "người bác sĩ" tốt nhất của con dựa trên nền tảng khoa học thực chứng: <strong class="text-[#f97316] italic">"Cơ thể khỏe thì não bộ mới khỏe"</strong>.
                    </p>

                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" class="w-full flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#d94f00] text-white font-bold py-3 px-6 rounded-xl transition-all shadow-md hover:shadow-lg">
                        <i data-lucide="users" class="w-5 h-5"></i> Tham Gia Cộng Đồng
                    </a>
                </div>
            </div>

            <!-- Phân cách -->
            <div class="w-full h-px bg-gradient-to-r from-transparent via-white/20 to-transparent mb-8"></div>

            <!-- Disclaimer & Copyright -->
            <div class="flex flex-col lg:flex-row justify-between items-center lg:items-start gap-6 text-xs text-white/50 text-center lg:text-left">
                <div class="max-w-4xl">
                    <p class="font-bold text-white/70 mb-2 flex items-center justify-center lg:justify-start gap-1">
                        <i data-lucide="alert-triangle" class="w-4 h-4 text-[#f97316]"></i> LƯU Ý QUAN TRỌNG:
                    </p>
                    <p class="leading-relaxed">
                        Các thông tin trên website và trong cộng đồng mang tính chất chia sẻ kiến thức y sinh, giáo dục sức khỏe và hỗ trợ cộng đồng. Mọi quyết định can thiệp y tế chuyên sâu cần có sự thăm khám, xét nghiệm và tham vấn trực tiếp từ đội ngũ chuyên gia/bác sĩ phù hợp với thể trạng riêng biệt của từng trẻ.
                    </p>
                </div>
                <div class="shrink-0 mt-4 lg:mt-0 font-medium">
                    &copy; <?php echo date('Y'); ?> Hiểu Con Từ Gốc.<br>All rights reserved.
                </div>
            </div>

        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
    // Gọi lệnh render icon ở cuối cùng của file để đảm bảo toàn bộ icon trong footer đều được vẽ
    if (typeof lucide !== 'undefined') {
        lucide.createIcons({ strokeWidth: 1.5 });
    }
</script>

<!-- Custom Footer Code (Theme Settings) -->
<?php
$footer_code = get_option('hieucon_custom_footer_code', '');
if (!empty(trim($footer_code))) {
    echo $footer_code . "\n";
}
?>

</body>
</html>
