<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Hieucon
 */

get_header();
?>

<main id="primary" class="site-main min-h-[calc(100vh-120px)] flex items-center justify-center py-16 px-4 bg-[#f8fafc]">
    <div class="max-w-2xl w-full mx-auto text-center bg-white border border-slate-200 p-8 sm:p-14 rounded-3xl shadow-[0_20px_48px_-24px_rgba(15,23,42,0.08)] relative overflow-hidden">

        <div class="inline-flex bg-[#fff7ed] border border-orange-200/80 p-4 rounded-2xl mb-5 text-[#f97316]">
            <i data-lucide="compass" class="w-10 h-10"></i>
        </div>

        <p class="text-xs font-extrabold uppercase tracking-widest text-[#f97316] mb-2">Mã lỗi 404</p>

        <h1 class="font-serif text-2xl sm:text-4xl font-bold text-[#0A1931] mb-4 leading-snug">
            Có vẻ ba mẹ đã rẽ nhầm hướng...
        </h1>

        <p class="text-base sm:text-lg text-slate-600 mb-8 max-w-xl mx-auto leading-relaxed">
            Trang ba mẹ đang tìm kiếm có thể đã được chuyển sang địa chỉ mới hoặc không còn tồn tại. Hãy quay lại Trang chủ để tiếp tục hành trình cùng con nhé.
        </p>

        <div class="flex flex-col sm:flex-row justify-center items-center gap-3.5">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#f97316] hover:bg-[#ea580c] text-white px-7 py-3.5 rounded-xl font-bold text-[15px] transition-all shadow-[0_12px_24px_-6px_rgba(249,115,22,0.4)] no-underline">
                <i data-lucide="home" class="w-4 h-4"></i>
                <span>Trở về Trang chủ</span>
            </a>

            <a href="<?php echo esc_url( home_url( '/dat-lich-tu-van/' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-[#f8fafc] hover:bg-slate-100 text-[#0A1931] border border-slate-200 px-6 py-3.5 rounded-xl font-semibold text-[15px] transition-all no-underline">
                <i data-lucide="calendar-check" class="w-4 h-4 text-[#f97316]"></i>
                <span>Đăng ký tư vấn 1:1</span>
            </a>
        </div>

    </div>
</main>

<?php get_footer(); ?>
