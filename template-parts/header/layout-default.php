<?php
$course_cats = get_terms([
    'taxonomy'   => 'course_cat',
    'hide_empty' => false,
]);
?>
<!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<?php get_template_part('template-parts/header/site-head'); ?>

<body <?php body_class('bg-healing-gradient text-navy antialiased min-h-[100vh] has-sticky-header'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="main-header" class="glass-header sticky top-0 z-[100] w-full" aria-label="Main Navigation">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Container -->
            <div class="header-container flex justify-between items-center h-[60px] lg:h-[72px] transition-all duration-400">
                
                <!-- 1. Logo & Brand -->
                <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-3 cursor-pointer group shrink-0 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-xl p-1">
                    <div class="transition-all duration-500 group-hover:scale-105 flex items-center justify-center">
                        <?php if ( has_site_icon() ) : ?>
                            <img src="<?php echo esc_url(get_site_icon_url(96)); ?>" alt="<?php bloginfo('name'); ?>" class="w-10 h-10 lg:w-12 lg:h-12 rounded-xl object-cover shadow-sm bg-white">
                        <?php else : ?>
                            <div class="w-10 h-10 lg:w-12 lg:h-12 bg-navy text-white flex items-center justify-center rounded-xl shadow-sm"><i data-lucide="dna" class="w-6 h-6" aria-hidden="true"></i></div>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="font-serif font-bold text-lg lg:text-[22px] leading-none text-navy tracking-tight">HIỂU CON TỪ GỐC</h1>
                        <p class="text-[9px] lg:text-[10px] font-extrabold text-navy/50 tracking-[0.1em] lg:tracking-[0.2em] uppercase mt-1 lg:mt-1.5 leading-none">Tự kỷ là rối loạn toàn thân</p>
                    </div>
                </a>

                <!-- 2. Main Navigation (Desktop) -->
                <nav class="hidden lg:flex items-center h-full absolute left-1/2 -translate-x-1/2 space-x-6 xl:space-x-8 2xl:space-x-10">
                    
                    <!-- Mega Menu "Sản phẩm" -->
                    <div class="group h-full flex items-center">
                        <button class="text-navy/80 hover:text-navy group-hover:text-secondary font-extrabold transition-colors text-[12px] xl:text-[13px] uppercase tracking-[0.15em] flex items-center gap-1.5 py-4 relative outline-none px-2" aria-expanded="false" aria-haspopup="true">
                            Sản phẩm 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>
                        </button>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[850px] xl:w-[980px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex gap-4 xl:gap-6 relative overflow-hidden">
                                
                                <i data-lucide="sparkles" class="absolute -bottom-6 -right-6 w-32 h-32 text-navy/5 rotate-12 pointer-events-none" aria-hidden="true"></i>

                                <!-- Cột 1: Thông tin & Trích dẫn -->
                                <div class="w-[30%] border-r border-navy/10 pr-6 flex flex-col z-10 relative">
                                    <h4 class="font-serif font-bold text-navy text-xl xl:text-2xl mb-4 leading-tight">Y Sinh Cốt Lõi</h4>
                                    
                                    <div class="p-6 bg-gradient-to-br from-secondary/5 to-[#FFF9F0] rounded-2xl border border-secondary/10 relative overflow-hidden mb-6 flex-grow flex flex-col justify-center">
                                        <i data-lucide="quote" class="absolute right-3 top-3 w-16 h-16 text-secondary/5 rotate-12" aria-hidden="true"></i>
                                        <p class="text-[14px] xl:text-[15px] text-navy/80 font-medium italic relative z-10 leading-relaxed font-serif">
                                            "Sức khỏe bền vững bắt nguồn từ việc thiết lập lại sự cân bằng toàn thân, từ gốc rễ tế bào."
                                        </p>
                                    </div>

                                    <a href="/san-pham" class="group/btn flex items-center justify-center gap-3 text-white bg-navy hover:bg-secondary font-bold text-[14px] p-4 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 w-full uppercase tracking-wider">
                                        <i data-lucide="layout-grid" class="w-4 h-4"></i> Xem tất cả sản phẩm
                                    </a>
                                </div>

                                <!-- Cột 2: Product Slider -->
                                <div class="w-[70%] pl-6 flex flex-col z-10 relative overflow-hidden">
                                    <div class="flex justify-between items-center mb-4 pr-1">
                                        <span class="text-secondary font-extrabold text-[11px] uppercase tracking-widest flex items-center gap-2">
                                            <i data-lucide="star" class="w-4 h-4 fill-secondary/20" aria-hidden="true"></i> Sản phẩm nổi bật
                                        </span>
                                        <div class="flex gap-2">
                                            <button id="mega-prev" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-navy/10 hover:border-secondary/40 hover:text-secondary text-navy/40 transition-colors shadow-sm outline-none" aria-label="Lùi lại"><i data-lucide="chevron-left" class="w-5 h-5"></i></button>
                                            <button id="mega-next" class="w-8 h-8 flex items-center justify-center rounded-full bg-white border border-navy/10 hover:border-secondary/40 hover:text-secondary text-navy/40 transition-colors shadow-sm outline-none" aria-label="Tiếp theo"><i data-lucide="chevron-right" class="w-5 h-5"></i></button>
                                        </div>
                                    </div>
                                    
                                    <!-- Slider -->
                                    <div id="mega-slider" class="flex gap-5 overflow-x-auto snap-x snap-mandatory scroll-smooth pb-4 no-scrollbar">
                                        <?php
                                        // Danh sách sản phẩm tinh
                                        $mega_products_data = [
                                            ['title' => 'Miwako A+', 'slug' => 'miwako-a', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/A_yzi6wk.png', 'desc' => 'Lon 700g - 750.000₫'],
                                            ['title' => 'Miwako', 'slug' => 'miwako', 'img' => 'https://statics.pancake.vn/web-media/47/72/37/5e/6a5a4c3c211b04c61cba1dd9586672a65c317ff5caec49342bdade7c-w:1652-h:1629-l:3980831-t:image/png.png', 'desc' => 'Lon 700g - 725.000₫'],
                                            ['title' => 'CareMIL', 'slug' => 'caremil', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Care_Milk_goeehp.png', 'desc' => 'Lon 800g - 960.000₫'],
                                            ['title' => 'DawnBridge NuraFix', 'slug' => 'dawnbridge-nurafix', 'img' => 'https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-NURA-FIX_MALAYSIA-DEC24.png', 'desc' => 'Hộp 30 gói, mỗi gói 30g - 800.000₫'],
                                            ['title' => 'Heilusan Omega-3', 'slug' => 'heilusan-omega-3', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Helusan_ydqh4i.png', 'desc' => '1 hộp/120 viên - 396.000₫'],
                                            ['title' => 'Folate 400 mcg', 'slug' => 'folate-400-mcg', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Folate_gxa2ro.png', 'desc' => '1 hộp/30 viên - 360.000₫'],
                                            ['title' => 'Neurocard Max', 'slug' => 'neurocard-max', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Neroucard_Max_zf1grp.png', 'desc' => '1 hộp/6 vỉ x 10 viên - 594.000₫'],
                                            ['title' => 'Dawn Bridge ProbioACE', 'slug' => 'probioace', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867140/ProbioACE_eufmi8.png', 'desc' => '1 hộp/20 gói x 2g - 900.000₫'],
                                            ['title' => 'BISUMI 120B', 'slug' => 'bisumi', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867138/Bisumi_b8hwar.png', 'desc' => '1 hộp/20 gói x 2g - 390.000₫'],
                                            ['title' => 'DawnBridge Nura-Zen', 'slug' => 'dawnbridge-nura-zen', 'img' => 'https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-NURA-ZEN_MALAYSIA-DEC24.png', 'desc' => 'Hộp 30 gói, mỗi gói 30g - 800.000₫'],
                                            ['title' => 'DawnBridge Botani9', 'slug' => 'dawnbridge-botani9', 'img' => 'https://www.dawnbridge.com.my/wp-content/uploads/2023/08/3D-BOTANI9_MALAYSIA-DEC24.png', 'desc' => 'Hộp 30 gói, mỗi gói 30g - 960.000₫'],
                                            ['title' => 'Obibebe', 'slug' => 'obibebe', 'img' => 'https://res.cloudinary.com/dirjpbi3s/image/upload/v1767867139/Obibebe_ytxvzs.png', 'desc' => 'Chăm sóc toàn diện'],
                                        ];
                                        
                                        foreach ($mega_products_data as $product) :
                                        ?>
                                        <a href="/<?php echo esc_attr($product['slug']); ?>" class="shrink-0 w-[240px] snap-start bg-gradient-to-br from-white to-[#f8fafc] rounded-[1.5rem] p-4 border border-white hover:border-secondary/30 hover:shadow-elegant transition-all duration-300 group/card relative overflow-hidden flex flex-col">
                                            <div class="w-full h-[140px] bg-white rounded-xl mb-4 overflow-hidden shadow-sm flex items-center justify-center p-2 relative">
                                                 <img src="<?php echo esc_url($product['img']); ?>" alt="<?php echo esc_attr($product['title']); ?>" class="w-full h-full object-contain group-hover/card:scale-110 transition-transform duration-500">
                                            </div>
                                            <h5 class="font-serif font-bold text-lg text-navy mb-1.5 group-hover/card:text-secondary transition-colors leading-tight line-clamp-1"><?php echo esc_html($product['title']); ?></h5>
                                            <p class="text-[12px] text-navy/60 leading-relaxed mb-4 flex-grow line-clamp-2"><?php echo esc_html($product['desc']); ?></p>
                                            <span class="text-[11px] font-bold text-navy flex items-center gap-1 group-hover/card:text-secondary uppercase tracking-wider mt-auto">
                                                Xem chi tiết <i data-lucide="arrow-right" class="w-3 h-3 group-hover/card:translate-x-1 transition-transform"></i>
                                            </span>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <!-- Link: Ebook -->
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'ebook' ) ); ?>" class="text-navy/80 hover:text-navy hover:text-secondary font-extrabold transition-colors text-[12px] xl:text-[13px] uppercase tracking-[0.15em] flex items-center gap-1.5 py-4 relative outline-none px-2 shrink-0">
                        Tài liệu
                        <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 hover:w-full opacity-0 hover:opacity-100 rounded-t-md"></span>
                    </a>

                    </nav>

                <!-- 3. CTAs (Nút chức năng bên phải) -->
                <div class="hidden lg:flex flex-1 justify-end items-center min-w-0 gap-3">
                    
                    <!-- Nút: Cộng đồng Facebook -->
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" 
                       title="Cộng Đồng Cha Mẹ"
                       class="flex items-center justify-center bg-gradient-to-br from-[#1877F2] to-[#0A58CA] hover:from-[#1464CC] hover:to-[#084298] text-white w-10 h-10 rounded-full font-extrabold transition-all duration-300 shadow-[0_4px_12px_rgba(24,119,242,0.3)] hover:shadow-[0_6px_16px_rgba(24,119,242,0.4)] hover:-translate-y-0.5 border border-white/10 group shrink-0"
                       aria-label="Cộng đồng Facebook">
                        <svg viewBox="0 0 320 512" class="w-3.5 h-3.5 text-white fill-current group-hover:scale-110 transition-transform"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                    </a>

                    <!-- Nút: Kết nối Zalo -->
                    <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" rel="noopener noreferrer"
                       title="Kết Nối Chuyên Gia"
                       class="flex items-center justify-center bg-gradient-to-br from-[#00A1FF] to-[#0068FF] hover:from-[#008CE6] hover:to-[#0052CC] text-white w-10 h-10 rounded-full font-extrabold transition-all duration-300 shadow-[0_4px_12px_rgba(0,104,255,0.3)] hover:shadow-[0_6px_16px_rgba(0,104,255,0.4)] hover:-translate-y-0.5 border border-white/10 group shrink-0"
                       aria-label="Kết nối Zalo">
                        <span class="font-black text-[13px] text-white leading-none group-hover:scale-110 transition-transform">Z</span>
                    </a>

                    <!-- Divider -->
                    <div class="w-px h-5 bg-navy/10"></div>

                    <?php 
                    $current_member = class_exists( '\Hieucon\Model\Member_Model' ) ? \Hieucon\Model\Member_Model::get_current_member() : false; 
                    if ( $current_member ) : 
                    ?>
                        <!-- Nút: Tài khoản (Đã đăng nhập) -->
                        <a href="<?php echo home_url('/tai-khoan/'); ?>"
                           class="flex items-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3 py-2 rounded-xl font-bold text-[11px] xl:text-[12px] transition-all duration-200 shadow-sm hover:shadow-md group shrink-0 border-0">
                            <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                            <span>Tài khoản</span>
                        </a>
                    <?php else : ?>
                        <!-- Nút: Đăng nhập (Chưa đăng nhập) -->
                        <a href="<?php echo home_url('/dang-nhap/'); ?>"
                           class="flex items-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3 py-2 rounded-xl font-bold text-[11px] xl:text-[12px] transition-all duration-200 shadow-sm hover:shadow-md shrink-0 border-0">
                            <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                            <span>Đăng nhập</span>
                        </a>
                    <?php endif; ?>

                </div>

                <!-- Nút Hamburger (Chỉ hiện dưới màn hình Desktop - lg) -->
                <div class="lg:hidden flex items-center">
                    <button id="mobile-menu-btn" aria-label="Mở menu điều hướng" aria-expanded="false" class="text-navy p-2.5 bg-white/70 rounded-xl border border-white shadow-sm hover:bg-white transition-colors">
                        <i data-lucide="menu" class="w-6 h-6"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- MOBILE DRAWER MENU (Tablet & Phone) -->
        <!-- ========================================== -->
        <div id="mobile-backdrop" class="fixed inset-0 bg-navy/40 backdrop-blur-sm z-[110] opacity-0 pointer-events-none transition-opacity duration-300 lg:hidden" aria-hidden="true"></div>
        
        <nav id="mobile-drawer" class="fixed top-0 right-0 h-[100dvh] w-[85%] sm:w-[380px] bg-[#f8fafc] z-[120] transform translate-x-full transition-transform duration-400 ease-in-out shadow-2xl overflow-y-auto lg:hidden flex flex-col border-l border-white" aria-label="Mobile Navigation">
            <div class="flex justify-between items-center p-5 border-b border-navy/5 bg-white/80 backdrop-blur-md sticky top-0 z-10">
                <div class="flex items-center gap-3">
                    <div class="bg-navy text-white p-1.5 rounded-full shadow-md flex items-center justify-center">
                        <i data-lucide="dna" class="w-4 h-4"></i>
                    </div>
                    <span class="font-serif font-bold text-base text-navy tracking-wide">MENU CHÍNH</span>
                </div>
                <button id="mobile-close-btn" class="p-2 text-navy/50 hover:text-navy hover:bg-navy/5 rounded-full transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </div>

            <div class="flex flex-col py-2 px-5 gap-1 flex-grow">
                
                <!-- Accordion: Sản phẩm -->
                <div class="flex flex-col border-b border-navy/5">
                    <button id="mobile-products-toggle" aria-expanded="false" class="flex justify-between items-center py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                        <span class="flex items-center gap-3"><i data-lucide="box" class="w-4 h-4 text-navy/40"></i> Sản phẩm</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-navy/40 transition-transform duration-300" id="mobile-products-icon"></i>
                    </button>
                    <div id="mobile-products-content" class="hidden flex-col gap-3 pl-4 py-4 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] pt-5 overflow-hidden">
                        <span class="text-secondary font-extrabold text-[10px] uppercase tracking-widest mb-1 px-3">Tâm điểm y sinh</span>
                        <div class="flex gap-3 overflow-x-auto no-scrollbar snap-x snap-mandatory px-3 -mx-3 pb-2 pt-1">
                            <?php
                            foreach ($mega_products_data as $product) :
                            ?>
                            <a href="/<?php echo esc_attr($product['slug']); ?>" class="shrink-0 w-[200px] snap-start bg-white border border-secondary/10 shadow-sm rounded-xl p-3 hover:border-secondary transition-colors group/mcard flex flex-col">
                                <div class="w-full h-[120px] bg-[#f8fafc] rounded-lg mb-3 flex items-center justify-center overflow-hidden relative p-2">
                                    <img src="<?php echo esc_url($product['img']); ?>" class="w-full h-full object-contain group-hover/mcard:scale-105 transition-transform">
                                </div>
                                <span class="text-navy font-bold text-sm mb-1 leading-tight line-clamp-1"><?php echo esc_html($product['title']); ?></span>
                                <span class="text-secondary text-[11px] font-bold flex items-center gap-1 mt-auto">Khám phá <i data-lucide="arrow-right" class="w-3 h-3"></i></span>
                            </a>
                            <?php endforeach; ?>
                        </div>
                        <div class="w-full h-px bg-navy/5 my-2 flex-shrink-0"></div>
                        <a href="/san-pham" class="text-navy/80 font-bold text-[14px] flex items-center gap-3 px-3 py-2 hover:text-navy"><i data-lucide="box" class="w-4 h-4 text-navy/30"></i> Xem tất cả sản phẩm</a>
                    </div>
                </div>

                <!-- Link: Ebook -->
                <div class="flex flex-col border-b border-navy/5">
                    <a href="<?php echo esc_url( get_post_type_archive_link( 'ebook' ) ); ?>" class="flex items-center gap-3 py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                        <i data-lucide="book-open" class="w-4 h-4 text-navy/40"></i> Tài liệu bồi dưỡng
                    </a>
                </div>

                <!-- Link: Tài khoản / Đăng nhập -->
                <div class="flex flex-col border-b border-navy/5">
                    <?php if ( $current_member ) : ?>
                        <a href="<?php echo home_url('/tai-khoan/'); ?>" class="flex items-center gap-3 py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                            <i data-lucide="user" class="w-4 h-4 text-navy/40"></i> Tài khoản của tôi
                        </a>
                    <?php else : ?>
                        <a href="<?php echo home_url('/dang-nhap/'); ?>" class="flex items-center gap-3 py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                            <i data-lucide="log-in" class="w-4 h-4 text-navy/40"></i> Đăng nhập / Đăng ký
                        </a>
                    <?php endif; ?>
                </div>

            </div>

            <div class="p-5 flex flex-col gap-3 mt-auto border-t border-white bg-white/80 backdrop-blur-md pb-8">


                <!-- Nút: Cộng đồng Facebook -->
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="bg-gradient-to-br from-[#1877F2] to-[#0A58CA] text-white p-3.5 rounded-2xl shadow-[0_4px_12px_rgba(24,119,242,0.25)] flex items-center gap-3 transition-transform hover:scale-[1.02] active:scale-95">
                    <div class="bg-white/20 w-9 h-9 rounded-xl flex items-center justify-center shrink-0">
                        <svg viewBox="0 0 320 512" class="w-4 h-4 text-white fill-current"><path d="M279.14 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.43 0 225.36 0c-73.22 0-121.08 44.38-121.08 124.72v70.62H22.89V288h81.39v224h100.17V288z"/></svg>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="font-extrabold text-[13px] leading-tight">Cộng Đồng Cha Mẹ</span>
                        <span class="font-bold text-[10px] text-white/80 uppercase tracking-widest mt-0.5">Nơi chia sẻ & đồng hành</span>
                    </div>
                </a>

                <!-- Nút: Kết nối Zalo -->
                <a href="https://zalo.me/g/vmgfxy834?joinSrc=9" target="_blank" class="bg-gradient-to-br from-[#00A1FF] to-[#0068FF] text-white p-3.5 rounded-2xl shadow-[0_4px_12px_rgba(0,104,255,0.25)] flex items-center gap-3 transition-transform hover:scale-[1.02] active:scale-95">
                    <div class="bg-white/20 w-9 h-9 rounded-xl flex items-center justify-center shrink-0">
                        <span class="font-black text-[18px] text-white leading-none">Z</span>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="font-extrabold text-[13px] leading-tight">Kết Nối Chuyên Gia</span>
                        <span class="font-bold text-[10px] text-white/80 uppercase tracking-widest mt-0.5">Hỏi đáp & tư vấn y sinh</span>
                    </div>
                </a>
            </div>
        </nav>
    </header>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(5px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons({ strokeWidth: 1.5 });
        });

        // Sticky Header
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) header.classList.add('is-scrolled');
            else header.classList.remove('is-scrolled');
        });

        // Mobile Menu Toggles
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileCloseBtn = document.getElementById('mobile-close-btn');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const mobileBackdrop = document.getElementById('mobile-backdrop');

        function toggleMobileMenu() {
            const isClosed = mobileDrawer.classList.contains('translate-x-full');
            if (isClosed) {
                mobileDrawer.classList.remove('translate-x-full');
                mobileBackdrop.classList.remove('opacity-0', 'pointer-events-none');
                mobileBackdrop.classList.add('opacity-100', 'pointer-events-auto');
                document.body.style.overflow = 'hidden'; 
                mobileMenuBtn.setAttribute('aria-expanded', 'true');
            } else {
                mobileDrawer.classList.add('translate-x-full');
                mobileBackdrop.classList.add('opacity-0', 'pointer-events-none');
                mobileBackdrop.classList.remove('opacity-100', 'pointer-events-auto');
                document.body.style.overflow = ''; 
                mobileMenuBtn.setAttribute('aria-expanded', 'false');
            }
        }

        if (mobileMenuBtn) mobileMenuBtn.addEventListener('click', toggleMobileMenu);
        if (mobileCloseBtn) mobileCloseBtn.addEventListener('click', toggleMobileMenu);
        if (mobileBackdrop) mobileBackdrop.addEventListener('click', toggleMobileMenu);

        // Function to handle Accordion
        function setupAccordion(toggleId, contentId, iconId) {
            const toggle = document.getElementById(toggleId);
            const content = document.getElementById(contentId);
            const icon = document.getElementById(iconId);

            if(toggle && content) {
                toggle.addEventListener('click', (e) => {
                    e.stopPropagation(); // prevent closing parent accordions
                    const isExpanded = toggle.getAttribute('aria-expanded') === 'true';
                    if (!isExpanded) {
                        content.classList.remove('hidden');
                        content.classList.add('flex');
                        if (icon) icon.classList.add('rotate-180');
                        toggle.setAttribute('aria-expanded', 'true');
                    } else {
                        content.classList.add('hidden');
                        content.classList.remove('flex');
                        if (icon) icon.classList.remove('rotate-180');
                        toggle.setAttribute('aria-expanded', 'false');
                    }
                });
            }
        }

        // Setup Accordions
        setupAccordion('mobile-products-toggle', 'mobile-products-content', 'mobile-products-icon');

        // Symptom Mega Menu Tabs Hover Logic
        const symptomTabs = document.querySelectorAll('.symptom-tab');
        const symptomPanes = document.querySelectorAll('.symptom-pane');

        if(symptomTabs.length > 0) {
            symptomTabs.forEach(tab => {
                tab.addEventListener('mouseenter', () => {
                    // Reset all tabs
                    symptomTabs.forEach(t => {
                        t.classList.remove('bg-white', 'shadow-sm', 'text-secondary');
                        t.classList.add('text-navy/80');
                        const icon = t.querySelector('.tab-indicator');
                        if(icon) {
                            icon.classList.remove('opacity-100');
                            icon.classList.add('opacity-0');
                        }
                    });
                    
                    // Hide all panes
                    symptomPanes.forEach(p => p.classList.add('hidden'));
                    
                    // Activate current tab
                    tab.classList.add('bg-white', 'shadow-sm', 'text-secondary');
                    tab.classList.remove('text-navy/80');
                    const currentIcon = tab.querySelector('.tab-indicator');
                    if(currentIcon) {
                        currentIcon.classList.remove('opacity-0');
                        currentIcon.classList.add('opacity-100');
                    }
                    
                    // Show current pane
                    const targetId = tab.getAttribute('data-target');
                    const targetPane = document.getElementById(targetId);
                    if(targetPane) targetPane.classList.remove('hidden');
                });
            });
        }

        // Mega menu slider logic
        const megaSlider = document.getElementById('mega-slider');
        const megaPrev = document.getElementById('mega-prev');
        const megaNext = document.getElementById('mega-next');

        if (megaSlider && megaNext && megaPrev) {
            // Scroll bằng độ rộng của 1 card (240px + 20px gap = 260px)
            megaNext.addEventListener('click', () => {
                megaSlider.scrollBy({ left: 260, behavior: 'smooth' });
            });
            megaPrev.addEventListener('click', () => {
                megaSlider.scrollBy({ left: -260, behavior: 'smooth' });
            });
        }
    </script>
