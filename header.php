<?php
/**
 * The header for our theme
 *
 * @package Hieucon
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="masthead" class="site-header">
    <nav class="glass-elegant sticky top-0 z-50 transition-all shadow-soft">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20 lg:h-24">
                <!-- Logo & Brand (Dùng Favicon của WordPress nếu có) -->
                <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-3 md:gap-4 cursor-pointer group">
                    <div class="shrink-0 transition-transform group-hover:scale-105 duration-300">
                        <?php if ( has_site_icon() ) : ?>
                            <img src="<?php echo get_site_icon_url(96); ?>" alt="<?php bloginfo('name'); ?>" class="w-11 h-11 md:w-14 md:h-14 rounded-2xl shadow-md border-2 border-white/60 object-cover bg-white">
                        <?php else : ?>
                            <div class="bg-navy text-white p-3 rounded-2xl shadow-md">
                                <i data-lucide="dna" class="w-6 h-6 md:w-7 md:h-7"></i>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="font-serif font-bold text-xl md:text-2xl lg:text-3xl leading-none text-navy tracking-tight drop-shadow-sm">HIỂU CON TỪ GỐC</h1>
                        <p class="text-[10px] md:text-[12px] font-bold text-navy/70 tracking-[0.15em] uppercase mt-1">Tự kỷ là rối loạn toàn thân</p>
                    </div>
                </a>

                <!-- Desktop Mega Menu -->
                <div class="hidden lg:flex items-center">
                    <div class="relative group">
                        <button class="flex items-center gap-1.5 px-4 py-8 text-navy/80 hover:text-navy font-bold transition-colors text-sm uppercase tracking-widest">
                            Sản phẩm 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180"></i>
                        </button>
                        
                        <!-- Mega Menu Panel -->
                        <div class="absolute left-1/2 -translate-x-1/2 top-full pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 z-50">
                            <!-- Mũi tên chỉ lên -->
                            <div class="absolute -top-1 left-1/2 -translate-x-1/2 w-4 h-4 bg-white rotate-45 border-l border-t border-navy/10 z-10"></div>
                            
                            <div class="w-[650px] bg-white rounded-3xl shadow-elegant border border-navy/10 p-8 grid grid-cols-2 gap-8 relative overflow-hidden">
                                <div class="absolute top-0 right-0 w-32 h-32 bg-secondary/5 rounded-bl-full -z-10"></div>
                                
                                <!-- Column 1 -->
                                <div class="space-y-5">
                                    <h4 class="font-serif font-bold text-navy border-b-2 border-navy/5 pb-3 text-lg flex items-center gap-2">
                                        <i data-lucide="baby" class="w-5 h-5 text-secondary"></i> Dành Cho Mẹ & Bé
                                    </h4>
                                    <a href="#" class="group/item flex items-start gap-4 p-3 -mx-3 rounded-2xl hover:bg-navy/5 transition-all">
                                        <div class="bg-secondary/10 p-2.5 rounded-xl text-secondary group-hover/item:scale-110 group-hover/item:bg-secondary group-hover/item:text-white transition-all shadow-sm">
                                            <i data-lucide="brain" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-navy text-sm mb-1 group-hover/item:text-secondary transition-colors">Bisumi Bổ Não</div>
                                            <p class="text-xs text-navy/60 leading-relaxed font-medium">Bổ sung tế bào gốc, phục hồi tế bào thần kinh từ rễ.</p>
                                        </div>
                                    </a>
                                    <a href="#" class="group/item flex items-start gap-4 p-3 -mx-3 rounded-2xl hover:bg-navy/5 transition-all">
                                        <div class="bg-secondary/10 p-2.5 rounded-xl text-secondary group-hover/item:scale-110 group-hover/item:bg-secondary group-hover/item:text-white transition-all shadow-sm">
                                            <i data-lucide="leaf" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-navy text-sm mb-1 group-hover/item:text-secondary transition-colors">Men Vi Sinh Probi</div>
                                            <p class="text-xs text-navy/60 leading-relaxed font-medium">Cân bằng hệ vi sinh đường ruột, hỗ trợ trục Não-Ruột.</p>
                                        </div>
                                    </a>
                                </div>
                                
                                <!-- Column 2 -->
                                <div class="space-y-5 flex flex-col">
                                    <h4 class="font-serif font-bold text-navy border-b-2 border-navy/5 pb-3 text-lg flex items-center gap-2">
                                        <i data-lucide="shield-check" class="w-5 h-5 text-navy/70"></i> Hỗ Trợ Chuyên Sâu
                                    </h4>
                                    <a href="#" class="group/item flex items-start gap-4 p-3 -mx-3 rounded-2xl hover:bg-navy/5 transition-all">
                                        <div class="bg-navy/5 p-2.5 rounded-xl text-navy group-hover/item:scale-110 group-hover/item:bg-navy group-hover/item:text-white transition-all shadow-sm">
                                            <i data-lucide="biohazard" class="w-5 h-5"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-navy text-sm mb-1 group-hover/item:text-navy transition-colors">Detox Thải Độc</div>
                                            <p class="text-xs text-navy/60 leading-relaxed font-medium">Đào thải độc tố kim loại nặng an toàn, giảm viêm.</p>
                                        </div>
                                    </a>
                                    
                                    <div class="mt-auto pt-4">
                                        <div class="p-5 bg-gradient-to-br from-secondary_light to-[#FFF9F0] rounded-2xl border border-secondary/20 relative overflow-hidden group/ad cursor-pointer">
                                            <div class="absolute right-0 bottom-0 opacity-10 transform translate-x-1/4 translate-y-1/4 group-hover/ad:scale-110 transition-transform">
                                                <i data-lucide="star" class="w-24 h-24"></i>
                                            </div>
                                            <p class="text-[13px] text-navy/80 font-bold mb-3 italic relative z-10 leading-snug">
                                                "Sản phẩm y sinh thiết kế riêng biệt để tái lập cân bằng toàn thân."
                                            </p>
                                            <a href="#" class="inline-flex text-xs font-black text-secondary tracking-widest uppercase items-center gap-1.5 hover:gap-2.5 transition-all relative z-10">
                                                Xem tất cả <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons: Cân bằng kích thước & chiều cao -->
                <div class="flex items-stretch gap-3 lg:gap-4">
                    <a href="/thuc-don-giac-ngu" class="hidden sm:flex flex-col justify-center items-center bg-secondary hover:bg-secondary_dark text-white px-5 py-2.5 md:py-3 rounded-2xl transition-all shadow-md hover:shadow-lg active:scale-95 border-b-2 border-orange-800/40 relative overflow-hidden group h-full min-h-[52px]">
                        <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                        <span class="relative font-bold text-[13px] md:text-sm tracking-wide uppercase leading-tight drop-shadow-sm">Cẩm nang Dinh dưỡng</span>
                        <span class="relative text-[10px] md:text-[11px] text-white/90 font-medium tracking-wider mt-0.5 flex items-center gap-1.5 drop-shadow-sm">
                            Giấc ngủ cho trẻ tự kỷ <i data-lucide="star" class="w-3 h-3 text-yellow-300 fill-yellow-300 animate-pulse"></i>
                        </span>
                    </a>
                    
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" class="bg-navy hover:bg-[#1A365D] text-white px-6 py-2.5 md:py-3 rounded-2xl font-bold transition-all shadow-md hover:shadow-lg flex items-center gap-3 text-sm md:text-base active:scale-95 relative overflow-hidden group border border-navy/20 h-full min-h-[52px]">
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        <i data-lucide="heart" class="w-4 h-4 md:w-5 md:h-5 text-red-500 fill-red-500/20 group-hover:scale-110 transition-transform"></i>
                        <span class="hidden xl:inline relative z-10 tracking-wide font-bold">Tham gia nhóm</span>
                        <span class="xl:hidden sm:inline relative z-10 tracking-wide font-bold">Cộng đồng</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>
</header>
