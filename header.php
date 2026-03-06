<?php
/**
 * The header for our theme
 *
 * @package Hieucon
 */
?><!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Thư viện Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        primary: '#0d9488', 
                        secondary: '#f97316', 
                        secondary_dark: '#ea580c', 
                        navy: {
                            DEFAULT: '#0A1931',
                            light: '#1A365D',
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
                        'premium': '0 20px 50px -12px rgba(10, 25, 49, 0.15)'
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Nunito', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Lora', serif; }
        
        /* Hiệu ứng nền */
        .bg-healing-gradient {
            background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%);
            background-attachment: fixed;
        }

        /* Glassmorphism cho Header */
        .glass-header {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Khi cuộn trang (Sticky) */
        .glass-header.is-scrolled {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 30px rgba(10, 25, 49, 0.05);
        }
        
        .glass-header.is-scrolled .header-container { height: 75px; }

        /* Mega Menu */
        .glass-megamenu {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
        }
        
        /* Cầu nối Mega Menu */
        .mega-bridge::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            width: 100%;
            height: 20px;
        }

        /* Ẩn scrollbar cho slider */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
    </style>
    <?php wp_head(); ?>
</head>

<body <?php body_class('bg-healing-gradient text-navy antialiased min-h-[100vh]'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="main-header" class="glass-header sticky top-0 z-[100] w-full" aria-label="Main Navigation">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header Container -->
            <div class="header-container flex justify-between items-center h-[90px] transition-all duration-400">
                
                <!-- 1. Logo & Brand -->
                <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-3 cursor-pointer group shrink-0 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-xl p-1">
                    <div class="bg-navy text-white p-2.5 rounded-full shadow-md transition-all duration-500 group-hover:scale-105 group-hover:shadow-lg flex items-center justify-center">
                        <?php if ( has_site_icon() ) : ?>
                            <img src="<?php echo get_site_icon_url(96); ?>" alt="<?php bloginfo('name'); ?>" class="w-5 h-5 lg:w-6 lg:h-6 rounded-full object-cover bg-white">
                        <?php else : ?>
                            <i data-lucide="dna" class="w-5 h-5 lg:w-6 lg:h-6" aria-hidden="true"></i>
                        <?php endif; ?>
                    </div>
                    <div class="flex flex-col justify-center">
                        <h1 class="font-serif font-bold text-lg lg:text-[22px] leading-none text-navy tracking-tight">HIỂU CON TỪ GỐC</h1>
                        <p class="text-[9px] lg:text-[10px] font-extrabold text-navy/50 tracking-[0.1em] lg:tracking-[0.2em] uppercase mt-1 lg:mt-1.5 leading-none">Tự kỷ là rối loạn toàn thân</p>
                    </div>
                </a>

                <!-- 2. Main Navigation (Desktop) - Hiển thị từ màn hình lg (1024px) -->
                <nav class="hidden lg:flex items-center h-full absolute left-1/2 -translate-x-1/2 space-x-6 xl:space-x-12">
                    
                    <!-- Mega Menu "Sản phẩm" -->
                    <div class="group h-full flex items-center relative">
                        <button class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">
                            Sản phẩm 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
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
                </nav>

                <!-- 3. CTAs (Nút chức năng bên phải) - Giờ cũng hiện từ lg (1024px) -->
                <div class="hidden lg:flex items-center gap-3 xl:gap-4 shrink-0">
                    
                    <!-- Nút 1: Cẩm nang -->
                    <a href="/thuc-don-ngu-ngon" class="group relative flex items-center gap-2 xl:gap-3.5 bg-white/80 hover:bg-white border border-white hover:border-secondary/40 pl-2 pr-4 xl:pr-5 py-1.5 xl:py-2 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant">
                        <div class="bg-secondary/10 p-2 xl:p-2.5 rounded-full text-secondary group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                            <i data-lucide="book-open-text" class="w-4 h-4 xl:w-5 xl:h-5"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="font-extrabold text-navy text-[11px] xl:text-[13px] leading-tight group-hover:text-secondary transition-colors">Cẩm nang dinh dưỡng</span>
                            <span class="text-[8px] xl:text-[10px] font-extrabold text-navy/50 uppercase tracking-wider xl:tracking-widest mt-0.5 group-hover:text-navy">Giấc ngủ cho trẻ tự kỷ</span>
                        </div>
                    </a>
                    
                    <!-- Nút 2: Tham gia nhóm -->
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" class="bg-navy hover:bg-navy-light text-white px-4 xl:px-7 py-2.5 xl:py-3.5 rounded-full font-bold transition-all duration-300 shadow-md hover:shadow-premium flex items-center gap-2 xl:gap-3 text-[12px] xl:text-[14px] group">
                        <div class="bg-white/10 p-1 xl:p-1.5 rounded-full group-hover:bg-secondary/20 transition-colors">
                            <i data-lucide="users" class="w-3 h-3 xl:w-4 xl:h-4 text-white group-hover:text-secondary"></i>
                        </div>
                        <span class="hidden xl:inline">Tham gia nhóm "Hiểu Con Từ Gốc"</span>
                        <span class="xl:hidden">Tham gia nhóm</span>
                    </a>
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
        <!-- (Giữ nguyên cấu trúc mượt mà của Mobile Menu, đổi class breakpoint thành lg:hidden) -->
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
                <div class="flex flex-col border-b border-navy/5">
                    <button id="mobile-products-toggle" aria-expanded="false" class="flex justify-between items-center py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                        <span class="flex items-center gap-3"><i data-lucide="box" class="w-4 h-4 text-navy/40"></i> Sản phẩm</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-navy/40 transition-transform duration-300" id="mobile-products-icon"></i>
                    </button>
                    <div id="mobile-products-content" class="hidden flex-col gap-3 pl-4 py-4 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)] pt-5 overflow-hidden">
                        <span class="text-secondary font-extrabold text-[10px] uppercase tracking-widest mb-1 px-3">Tâm điểm y sinh</span>
                        <!-- Mobile Slider Products -->
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
            </div>

            <div class="p-5 flex flex-col gap-3 mt-auto border-t border-white bg-white/80 backdrop-blur-md pb-8">
                <a href="/thuc-don-giac-ngu" class="flex items-center gap-3 bg-white border border-secondary/20 hover:border-secondary p-3.5 rounded-2xl shadow-sm transition-all">
                    <div class="bg-secondary/10 p-2.5 rounded-xl text-secondary"><i data-lucide="book-open-text" class="w-5 h-5"></i></div>
                    <div class="flex flex-col text-left">
                        <span class="font-extrabold text-navy text-[13px] leading-tight">Cẩm nang dinh dưỡng</span>
                        <span class="text-[10px] font-extrabold text-secondary uppercase tracking-widest mt-0.5">Giấc ngủ cho trẻ tự kỷ</span>
                    </div>
                </a>
                
                <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" class="bg-navy hover:bg-navy-light text-white p-4 rounded-2xl font-bold text-center shadow-md flex items-center justify-center gap-2.5 text-sm">
                    <i data-lucide="users" class="w-4 h-4 text-secondary"></i> Tham gia nhóm "Hiểu Con Từ Gốc"
                </a>
            </div>
        </nav>
    </header>

    <script>
        lucide.createIcons({ strokeWidth: 1.5 });

        // Sticky Header
        const header = document.getElementById('main-header');
        window.addEventListener('scroll', () => {
            if (window.scrollY > 20) header.classList.add('is-scrolled');
            else header.classList.remove('is-scrolled');
        });

        // Mobile Menu
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileCloseBtn = document.getElementById('mobile-close-btn');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const mobileBackdrop = document.getElementById('mobile-backdrop');
        const productsToggle = document.getElementById('mobile-products-toggle');
        const productsContent = document.getElementById('mobile-products-content');
        const productsIcon = document.getElementById('mobile-products-icon');

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

        // Accordion
        if(productsToggle) {
            productsToggle.addEventListener('click', () => {
                const isExpanded = productsToggle.getAttribute('aria-expanded') === 'true';
                if (!isExpanded) {
                    productsContent.classList.remove('hidden');
                    productsContent.classList.add('flex');
                    if (productsIcon) productsIcon.classList.add('rotate-180');
                    productsToggle.setAttribute('aria-expanded', 'true');
                } else {
                    productsContent.classList.add('hidden');
                    productsContent.classList.remove('flex');
                    if (productsIcon) productsIcon.classList.remove('rotate-180');
                    productsToggle.setAttribute('aria-expanded', 'false');
                }
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
