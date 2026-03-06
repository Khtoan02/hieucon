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
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[800px] xl:w-[900px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex gap-6 xl:gap-8 relative overflow-hidden">
                                
                                <i data-lucide="sparkles" class="absolute -bottom-6 -right-6 w-32 h-32 text-navy/5 rotate-12 pointer-events-none" aria-hidden="true"></i>

                                <!-- Cột 1 -->
                                <div class="w-[40%] border-r border-navy/10 pr-6 xl:pr-8 flex flex-col">
                                    <span class="text-secondary font-extrabold text-[10px] xl:text-[11px] uppercase tracking-widest mb-4 flex items-center gap-2">
                                        <i data-lucide="star" class="w-4 h-4 fill-secondary/20" aria-hidden="true"></i> Sản phẩm tâm điểm
                                    </span>
                                    
                                    <a href="#" class="block bg-gradient-to-br from-white to-[#f8fafc] rounded-[1.5rem] p-5 xl:p-6 border border-white hover:border-secondary/30 hover:shadow-elegant transition-all duration-300 outline-none focus-visible:ring-2 focus-visible:ring-secondary group/featured relative overflow-hidden flex-grow">
                                        <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-bl from-secondary/10 to-transparent rounded-bl-[3rem] transition-transform duration-500 group-hover/featured:scale-150"></div>
                                        <div class="w-12 h-12 xl:w-14 xl:h-14 bg-secondary/10 text-secondary rounded-2xl flex items-center justify-center mb-4 group-hover/featured:-translate-y-1 transition-transform duration-300 shadow-sm">
                                            <i data-lucide="flask-conical" class="w-6 h-6 xl:w-7 xl:h-7" aria-hidden="true"></i>
                                        </div>
                                        <h5 class="font-serif font-bold text-lg xl:text-xl text-navy mb-2 group-hover/featured:text-secondary transition-colors leading-tight">Combo Y Sinh Cốt Lõi</h5>
                                        <p class="text-[13px] xl:text-[15px] text-navy/70 font-medium leading-relaxed mb-4">Liệu trình cân bằng đường ruột, hỗ trợ tiêu hóa chuẩn khoa học.</p>
                                        <span class="inline-flex items-center gap-2 text-xs xl:text-sm font-bold text-navy group-hover/featured:text-secondary transition-colors">
                                            Tìm hiểu thêm <i data-lucide="arrow-right" class="w-3 h-3 xl:w-4 xl:h-4 group-hover/featured:translate-x-1 transition-transform" aria-hidden="true"></i>
                                        </span>
                                    </a>
                                </div>
                                
                                <!-- Cột 2 -->
                                <div class="w-[30%] border-r border-navy/10 pr-4 pl-2">
                                    <span class="text-navy/40 font-extrabold text-[10px] xl:text-[11px] uppercase tracking-widest mb-4 block">Danh mục chuyên sâu</span>
                                    <ul class="space-y-3 xl:space-y-4">
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-secondary"><i data-lucide="pill" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Vi chất & Enzyme</span></a></li>
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-secondary"><i data-lucide="leaf" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Thực phẩm ăn kiêng</span></a></li>
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-secondary"><i data-lucide="shield-plus" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Hỗ trợ miễn dịch</span></a></li>
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-secondary"><i data-lucide="brain" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Dưỡng chất não bộ</span></a></li>
                                    </ul>
                                </div>

                                <!-- Cột 3 -->
                                <div class="w-[30%] pl-2">
                                    <span class="text-navy/40 font-extrabold text-[10px] xl:text-[11px] uppercase tracking-widest mb-4 block">Hỗ trợ phụ huynh</span>
                                    <ul class="space-y-3 xl:space-y-4">
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-primary"><i data-lucide="book-heart" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Sách hướng dẫn</span></a></li>
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-primary"><i data-lucide="monitor-play" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Khóa học online</span></a></li>
                                        <li><a href="#" class="group/link flex items-center gap-3 text-navy/80 hover:text-navy transition-colors p-1 -ml-1 rounded-xl"><div class="bg-white p-2 rounded-xl shadow-sm border border-navy/5 text-navy/40 group-hover/link:text-primary"><i data-lucide="puzzle" class="w-4 h-4"></i></div><span class="font-bold text-[13px] xl:text-[15px]">Đồ chơi trị liệu</span></a></li>
                                    </ul>
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
                    <div id="mobile-products-content" class="hidden flex-col gap-3 pl-4 py-4 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]">
                        <span class="text-secondary font-extrabold text-[10px] uppercase tracking-widest mb-1 px-3">Tâm điểm</span>
                        <a href="#" class="text-navy font-bold text-sm flex items-center gap-3 px-3 py-2.5 bg-white border border-secondary/20 shadow-sm rounded-xl hover:text-secondary">
                            <i data-lucide="flask-conical" class="w-4 h-4 text-secondary"></i> Combo Y Sinh Cốt Lõi
                        </a>
                        <div class="w-full h-px bg-navy/5 my-1.5"></div>
                        <span class="text-navy/40 font-extrabold text-[10px] uppercase tracking-widest mb-1 px-3 mt-1">Danh mục</span>
                        <a href="#" class="text-navy/80 font-bold text-[15px] flex items-center gap-3 px-3 py-2"><i data-lucide="pill" class="w-4 h-4 text-navy/30"></i> Vi chất & Enzyme</a>
                        <a href="#" class="text-navy/80 font-bold text-[15px] flex items-center gap-3 px-3 py-2"><i data-lucide="leaf" class="w-4 h-4 text-navy/30"></i> Thực phẩm ăn kiêng</a>
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
    </script>
