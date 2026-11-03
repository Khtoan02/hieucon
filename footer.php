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
    class="bg-[#fffaf5] border-t border-[#fed7aa] text-stone-700 pt-12 pb-8 relative overflow-hidden [font-family:'Nunito',_sans-serif]">

    <!-- Thanh cam mỏng tạo điểm nhấn đồng bộ ở mép trên Footer -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#fed7aa] via-[#f97316] to-[#fed7aa]"></div>

    <div class="max-w-[1160px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">

        <div class="grid grid-cols-1 md:grid-cols-12 gap-8 lg:gap-12 mb-10 items-start">

            <!-- Cột 1: Thương hiệu & Thông điệp tích cực (5/12) -->
            <div class="md:col-span-5">
                <h2 class="[font-family:'Lora',_serif] text-2xl font-bold mb-3 text-stone-800 flex items-center gap-2.5">
                    <span class="w-8 h-8 rounded-lg bg-[#fff7ed] border border-[#fed7aa] flex items-center justify-center text-[#f97316]">
                        <i data-lucide="leaf" class="w-4 h-4"></i>
                    </span>
                    <span>Hiểu Con Từ Gốc</span>
                </h2>
                <p class="text-stone-600 text-sm sm:text-[15px] leading-relaxed mb-5 max-w-md">
                    Đồng hành cùng ba mẹ trên hành trình thấu hiểu nhu cầu của con, chăm sóc bữa ăn, giấc ngủ và xây dựng nền tảng dinh dưỡng lành mạnh mỗi ngày.
                </p>
                <div class="flex items-center gap-3">
                    <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener"
                        aria-label="Facebook"
                        class="w-9 h-9 rounded-full bg-white hover:bg-[#f97316] text-[#ea580c] hover:text-white flex items-center justify-center transition-colors border border-[#fed7aa] shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z" />
                        </svg>
                    </a>
                    <a href="https://www.youtube.com/@hieucontugoc?sub_confirmation=1" target="_blank" rel="noopener"
                        aria-label="Youtube"
                        class="w-9 h-9 rounded-full bg-white hover:bg-[#f97316] text-[#ea580c] hover:text-white flex items-center justify-center transition-colors border border-[#fed7aa] shadow-sm">
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
                <h3 class="[font-family:'Lora',_serif] text-base sm:text-lg font-bold mb-3.5 text-stone-800">
                    Chuyên mục chính
                </h3>
                <ul class="space-y-2.5 text-stone-600 text-sm font-medium">
                    <li>
                        <a href="<?php echo esc_url( home_url( '/docs/' ) ); ?>" class="hover:text-[#ea580c] transition-colors">
                            Thư viện cẩm nang
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/bai-viet-kien-thuc/' ) ); ?>" class="hover:text-[#ea580c] transition-colors">
                            Bài viết chia sẻ
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="hover:text-[#ea580c] transition-colors">
                            Đăng ký tư vấn 1:1
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Cột 3: Kết nối cộng đồng (4/12) -->
            <div class="md:col-span-4 bg-white rounded-2xl p-5 border border-[#fed7aa] shadow-[0_10px_28px_-16px_rgba(234,88,12,0.12)]">
                <h3 class="[font-family:'Lora',_serif] text-base sm:text-lg font-bold mb-1.5 text-stone-800">
                    Kết nối cùng cộng đồng
                </h3>
                <p class="text-stone-600 text-xs sm:text-sm leading-relaxed mb-4">
                    Nơi ba mẹ cùng lắng nghe, chia sẻ kinh nghiệm thực tế và đồng hành tích cực cùng con mỗi ngày.
                </p>
                <div class="grid grid-cols-2 gap-2.5">
                    <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white font-bold py-2.5 px-3 rounded-xl transition-all shadow-sm text-xs sm:text-sm no-underline">
                        <i data-lucide="users" class="w-4 h-4"></i> Cộng đồng FB
                    </a>
                    <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank"
                        rel="noopener noreferrer"
                        class="flex items-center justify-center gap-2 bg-[#fff7ed] hover:bg-[#ffedd5] text-[#c2410c] border border-[#fed7aa] font-bold py-2.5 px-3 rounded-xl transition-all text-xs sm:text-sm no-underline">
                        <span class="font-black text-sm text-[#ea580c] leading-none">Z</span> Nhóm Zalo
                    </a>
                </div>
            </div>

        </div>

        <!-- Phân cách -->
        <div class="w-full h-px bg-[#fed7aa]/60 mb-6"></div>

        <!-- Bản quyền & Ghi chú nhẹ nhàng -->
        <div class="flex flex-col sm:flex-row justify-between items-center gap-3 text-xs text-stone-500 text-center sm:text-left">
            <p>
                Nội dung trên website mang tính chất chia sẻ kiến thức dinh dưỡng và kinh nghiệm đồng hành cùng gia đình.
            </p>
            <p class="shrink-0 font-medium text-stone-600">
                &copy; <?php echo date('Y'); ?> Hiểu Con Từ Gốc. All rights reserved.
            </p>
        </div>

    </div>
</footer>
</div><!-- #page -->

<script>
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
