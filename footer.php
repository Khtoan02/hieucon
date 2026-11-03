<?php
/**
 * The footer for our theme
 *
 * @package Hieucon
 */
?>
<link
    href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap"
    rel="stylesheet">
<footer id="colophon"
    class="bg-gradient-to-b from-[#0A1931] to-[#0A1121] text-white pt-12 pb-8 relative overflow-hidden [font-family:'Nunito',_sans-serif]">

    <div class="max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 mb-10 items-start">

            <!-- Cột 1: Thương hiệu & Thông điệp tích cực (5/12) -->
            <div class="md:col-span-5">
                <h2 class="[font-family:'Lora',_serif] text-2xl font-bold mb-3.5 text-white flex items-center gap-2.5">
                    <i data-lucide="leaf" class="w-6 h-6 text-[#f97316]"></i>
                    <span>Hiểu Con Từ Gốc</span>
                </h2>
                <p class="text-white/75 text-sm sm:text-[15px] leading-relaxed mb-5 max-w-md">
                    Đồng hành cùng ba mẹ trên hành trình thấu hiểu nhu cầu của con, chăm sóc bữa ăn, giấc ngủ và xây dựng nền tảng dinh dưỡng lành mạnh mỗi ngày.
                </p>
                <div class="flex items-center gap-3">
                    <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener"
                        aria-label="Facebook"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#f97316] flex items-center justify-center transition-colors border border-white/15 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@hieucontugoc?sub_confirmation=1" target="_blank" rel="noopener"
                        aria-label="Youtube"
                        class="w-9 h-9 rounded-full bg-white/10 hover:bg-[#f97316] flex items-center justify-center transition-colors border border-white/15 text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M2.5 7.1A2.5 2.5 0 0 1 5 4.6h14a2.5 2.5 0 0 1 2.5 2.5v9.8a2.5 2.5 0 0 1-2.5 2.5H5a2.5 2.5 0 0 1-2.5-2.5V7.1z" />
                            <path d="m10 15 5-3-5-3v6z" />
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Cột 2: Liên kết nhanh (3/12) -->
            <div class="md:col-span-3">
                <h3 class="[font-family:'Lora',_serif] text-base sm:text-lg font-bold mb-3.5 text-white">
                    Chuyên mục chính
                </h3>
                <ul class="space-y-2.5 text-white/75 text-sm">
                    <li>
                        <a href="<?php echo esc_url( home_url( '/docs/' ) ); ?>" class="hover:text-[#f97316] transition-colors">
                            Thư viện cẩm nang
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/bai-viet-kien-thuc/' ) ); ?>" class="hover:text-[#f97316] transition-colors">
                            Bài viết chia sẻ
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="hover:text-[#f97316] transition-colors">
                            Đăng ký trao đổi 1:1
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Cột 3: Kết nối cộng đồng (4/12) -->
            <div class="md:col-span-4 bg-white/5 rounded-2xl p-5 border border-white/10">
                <h3 class="[font-family:'Lora',_serif] text-base sm:text-lg font-bold mb-2 text-white">
                    Kết nối cùng cộng đồng
                </h3>
                <p class="text-white/75 text-xs sm:text-sm leading-relaxed mb-4">
                    Nơi ba mẹ cùng lắng nghe, chia sẻ kinh nghiệm thực tế và đồng hành tích cực cùng con mỗi ngày.
                </p>
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 bg-[#1877F2] hover:bg-[#0d6edc] text-white font-bold py-2.5 px-3 rounded-xl transition-all shadow-sm text-xs sm:text-sm">
                        <i data-lucide="users" class="w-4 h-4"></i> Cộng đồng
                    </a>
                    <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 bg-[#0068FF] hover:bg-[#0054cc] text-white font-bold py-2.5 px-3 rounded-xl transition-all shadow-sm text-xs sm:text-sm">
                        <span class="font-black text-sm text-white leading-none">Z</span> Góc chia sẻ
                    </a>
                </div>
            </div>

        </div>

        <!-- Phân cách -->
        <div class="w-full h-px bg-white/10 mb-6"></div>

        <!-- Bản quyền & Ghi chú nhẹ nhàng -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-white/55 text-center sm:text-left">
            <p>
                Nội dung trên website mang tính chất chia sẻ kiến thức dinh dưỡng và kinh nghiệm đồng hành cùng gia đình.
            </p>
            <p class="shrink-0 font-medium">
                &copy; <?php echo date('Y'); ?> Hiểu Con Từ Gốc. All rights reserved.
            </p>
        </div>

    </div>
</footer>
</div><!-- #page -->

<script>
    if (typeof tailwind !== 'undefined' && tailwind.config && tailwind.config.theme) {
        tailwind.config.theme.extend = tailwind.config.theme.extend || {};
        tailwind.config.theme.extend.colors = Object.assign({
            navy: { DEFAULT: '#0A1931', light: '#1A365D' },
            secondary: '#f97316',
            secondary_dark: '#ea580c'
        }, tailwind.config.theme.extend.colors || {});
    }
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
wp_footer();
?>

</body>

</html>
