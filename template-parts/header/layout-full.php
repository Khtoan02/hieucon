<?php
$course_cats = get_terms([
    'taxonomy'   => 'course_cat',
    'hide_empty' => false,
]);
?>
<!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<?php get_template_part('template-parts/header/site-head'); ?>

<body <?php body_class('bg-healing-gradient text-navy antialiased min-h-[100vh] has-fixed-header'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <header id="main-header" class="fixed top-3 lg:top-4 left-1/2 -translate-x-1/2 z-[100] w-[96%] max-w-[1440px] transition-all duration-500" aria-label="Main Navigation">
        <div class="glass-header relative rounded-2xl lg:rounded-[2rem] backdrop-blur-2xl bg-white/90 border border-white/70 shadow-[0_4px_24px_rgba(0,0,0,0.07)] px-4 sm:px-5 lg:px-6 xl:px-8">
            <!-- Header Container: 3-column CSS Grid for perfect balance -->
            <div class="grid grid-cols-[1fr_auto_1fr] items-center h-[60px] lg:h-[70px] gap-4">
                
                <!-- COL 1: Logo & Brand (LEFT) -->
                <div class="flex justify-start items-center">
                    <a href="<?php echo home_url('/'); ?>" class="flex items-center gap-2.5 cursor-pointer group outline-none rounded-xl" aria-label="Trang chủ Hiểu Con Từ Gốc">
                        <div class="relative shrink-0">
                            <?php if ( has_site_icon() ) : ?>
                                <img src="<?php echo esc_url(get_site_icon_url(96)); ?>" alt="<?php bloginfo('name'); ?>" class="w-9 h-9 lg:w-11 lg:h-11 rounded-xl object-cover shadow-sm bg-white group-hover:scale-105 transition-transform duration-300">
                            <?php else : ?>
                                <div class="w-9 h-9 lg:w-11 lg:h-11 bg-navy text-white flex items-center justify-center rounded-xl shadow-sm group-hover:scale-105 transition-transform duration-300"><i data-lucide="dna" class="w-5 h-5 lg:w-6 lg:h-6" aria-hidden="true"></i></div>
                            <?php endif; ?>
                            <span class="absolute -bottom-0.5 -right-0.5 w-3 h-3 bg-secondary rounded-full border-2 border-white shadow-sm"></span>
                        </div>
                        <div class="flex flex-col justify-center">
                            <span class="font-serif font-bold text-[16px] lg:text-[18px] xl:text-[20px] leading-none text-navy tracking-tight group-hover:text-secondary transition-colors duration-300">HIỂU CON TỪ GỐC</span>
                            <span class="text-[8px] lg:text-[9px] font-bold text-navy/40 tracking-[0.12em] uppercase mt-1 leading-none">Tự kỷ là rối loạn toàn thân</span>
                        </div>
                    </a>
                </div>

                <!-- COL 2: Main Navigation (CENTER — perfectly centered) -->
                <nav class="hidden lg:flex items-center gap-1 xl:gap-2">
                    
                    <!-- Mega Menu "Sản phẩm" -->
                    <div class="group h-full flex items-center">
                        <button class="nav-link relative flex items-center gap-1.5 px-3 py-2 rounded-xl text-navy/70 hover:text-navy group-hover:text-secondary font-bold text-[12px] xl:text-[13px] uppercase tracking-[0.12em] transition-all duration-200 hover:bg-navy/5 group-hover:bg-navy/5" aria-expanded="false" aria-haspopup="true">
                            Sản phẩm 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>
                        </button>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 w-[900px] xl:w-[1020px] z-[200]">
                            <div class="mega-bridge bg-white/95 backdrop-blur-2xl border border-white/80 rounded-2xl shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15),0_0_0_1px_rgba(0,0,0,0.04)] p-7 xl:p-9 flex gap-4 xl:gap-6 relative overflow-hidden">
                                
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

                    
                    <!-- Mega Menu "Triệu Chứng" -->
                    <div class="group h-full flex items-center">
                        <a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="nav-link relative flex items-center gap-1.5 px-3 py-2 rounded-xl text-navy/70 hover:text-navy group-hover:text-secondary font-bold text-[12px] xl:text-[13px] uppercase tracking-[0.12em] transition-all duration-200 hover:bg-navy/5 group-hover:bg-navy/5" aria-expanded="false" aria-haspopup="true">
                            Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 w-[900px] xl:w-[1020px] z-[200]">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex gap-6 relative overflow-hidden h-[480px]">
                                <i data-lucide="activity" class="absolute -bottom-6 -right-6 w-32 h-32 text-navy/5 rotate-12 pointer-events-none" aria-hidden="true"></i>
                                
                                <!-- Left Pane: 11 Groups Tabs -->
                                <div class="w-[35%] border-r border-navy/5 pr-4 overflow-y-auto no-scrollbar relative z-10 flex flex-col">
                                    <h4 class="font-serif font-bold text-navy text-lg xl:text-xl mb-3 leading-tight shrink-0">11 Nhóm Triệu Chứng</h4>
                                    <div class="flex flex-col gap-1 pb-4">
                                        <?php
                                        $symptoms = [
                                            '01' => ['title' => 'Vận động thô & tinh', 'icon' => 'person-standing', 'slug' => 'van-dong-tho-tinh-o-tre-tu-ky'],
                                            '02' => ['title' => 'Vận động miệng họng', 'icon' => 'smile', 'slug' => 'van-dong-mieng-hong-tre-tu-ky'],
                                            '03' => ['title' => 'Tiêu hóa & dạ dày', 'icon' => 'apple', 'slug' => 'tieu-hoa-da-day-tre-tu-ky'],
                                            '04' => ['title' => 'Xử lý cảm giác', 'icon' => 'eye', 'slug' => 'xu-ly-cam-giac-o-tre-tu-ky'],
                                            '05' => ['title' => 'Ngôn ngữ & giao tiếp', 'icon' => 'message-circle', 'slug' => 'ngon-ngu-giao-tiep-tre-tu-ky'],
                                            '06' => ['title' => 'Nhận thức & học tập', 'icon' => 'brain', 'slug' => 'nhan-thuc-hoc-tap-tre-tu-ky'],
                                            '07' => ['title' => 'Hành vi & xã hội', 'icon' => 'users', 'slug' => 'hanh-vi-xa-hoi-tre-tu-ky'],
                                            '08' => ['title' => 'Dị ứng thực phẩm', 'icon' => 'shield-alert', 'slug' => 'di-ung-nhay-cam-thuc-pham-tre-tu-ky'],
                                            '09' => ['title' => 'Hệ miễn dịch', 'icon' => 'shield-plus', 'slug' => 'he-mien-dich-tre-tu-ky'],
                                            '10' => ['title' => 'Dinh dưỡng & vi chất', 'icon' => 'test-tube', 'slug' => 'dinh-duong-vi-chat-o-tre-tu-ky'],
                                            '11' => ['title' => 'Năng lượng chuyển hóa', 'icon' => 'zap', 'slug' => 'nang-luong-chuyen-hoa-o-tre-tu-ky']
                                        ];
                                        foreach ($symptoms as $num => $symptom) :
                                            $isActive = ($num === '01');
                                            $tabClass = $isActive ? 'bg-white shadow-sm text-secondary' : 'text-navy/80 hover:bg-white hover:text-secondary';
                                            $iconColor = $isActive ? 'text-secondary' : 'opacity-0 text-secondary/50';
                                        ?>
                                        <a href="/<?php echo $symptom['slug']; ?>" class="symptom-tab group/stab p-2.5 rounded-xl font-bold text-[13px] transition-all flex justify-between items-center cursor-pointer <?php echo $tabClass; ?>" data-target="pane-<?php echo $num; ?>">
                                            <div class="flex items-center gap-2.5">
                                                <div class="w-6 h-6 rounded-md bg-navy/5 flex items-center justify-center shrink-0 group-hover/stab:bg-secondary/10 transition-colors">
                                                    <i data-lucide="<?php echo esc_attr($symptom['icon']); ?>" class="w-3.5 h-3.5"></i>
                                                </div>
                                                <span><?php echo $num; ?>. <?php echo esc_html($symptom['title']); ?></span>
                                            </div>
                                            <i data-lucide="chevron-right" class="w-4 h-4 transition-all tab-indicator group-hover/stab:opacity-100 <?php echo $iconColor; ?>"></i>
                                        </a>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                
                                <!-- Right Pane: Content for Tabs -->
                                <div class="w-[65%] pl-2 relative z-10 flex flex-col">
                                    <?php
                                    $symptom_groups_links = [
                                        '01' => [
                                            ['url' => '/tre-tu-ky-hay-nga-thang-bang-kem', 'title' => 'Trẻ tự kỷ hay ngã, thăng bằng kém'],
                                            ['url' => '/tre-tu-ky-kho-leo-cau-thang', 'title' => 'Trẻ tự kỷ khó leo cầu thang'],
                                            ['url' => '/van-dong-tinh-kem-o-tre-tu-ky', 'title' => 'Vận động tinh kém ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-di-nhon-got-toe-walking', 'title' => 'Trẻ tự kỷ đi nhón gót'],
                                            ['url' => '/truong-luc-co-thap-o-tre-tu-ky', 'title' => 'Trương lực cơ thấp ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-ngoi-kieu-chu-w', 'title' => 'Trẻ tự kỷ ngồi kiểu chữ W'],
                                            ['url' => '/dang-di-bat-thuong-o-tre-tu-ky', 'title' => 'Dáng đi bất thường ở trẻ tự kỷ'],
                                            ['url' => '/vat-ly-tri-lieu-tre-tu-ky', 'title' => 'Vật lý trị liệu trẻ tự kỷ'],
                                            ['url' => '/truong-luc-co-thap-tu-ky', 'title' => 'Trương lực cơ thấp & tự kỷ'],
                                        ],
                                        '02' => [
                                            ['url' => '/tre-tu-ky-chay-nuoc-dai-nhieu', 'title' => 'Trẻ tự kỷ chảy nước dãi nhiều'],
                                            ['url' => '/tre-tu-ky-hay-bi-sac-khi-an', 'title' => 'Trẻ tự kỷ hay bị sặc khi ăn'],
                                            ['url' => '/tre-tu-ky-chi-an-do-mem-tranh-nhai', 'title' => 'Trẻ tự kỷ chỉ ăn đồ mềm, tránh nhai'],
                                            ['url' => '/tre-nhai-khong-ky-nhoi-day-mieng', 'title' => 'Trẻ nhai không kỹ, nhồi đầy miệng'],
                                            ['url' => '/tre-tu-ky-phat-am-khong-ro', 'title' => 'Trẻ tự kỷ phát âm không rõ'],
                                            ['url' => '/cham-noi-do-van-dong-mieng-yeu', 'title' => 'Chậm nói do vận động miệng yếu'],
                                            ['url' => '/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me', 'title' => 'Oral Motor Therapy là gì?'],
                                            ['url' => '/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu', 'title' => 'Chậm nói do ngôn ngữ hay do vận động miệng yếu?'],
                                        ],
                                        '03' => [
                                            ['url' => '/tre-tu-ky-tao-bon-man-tinh', 'title' => 'Trẻ tự kỷ táo bón mãn tính'],
                                            ['url' => '/tre-tu-ky-tieu-chay-man-tinh', 'title' => 'Trẻ tự kỷ tiêu chảy mãn tính'],
                                            ['url' => '/trao-nguoc-axit-o-tre-tu-ky', 'title' => 'Trào ngược axit ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-ken-an-cuc-doan', 'title' => 'Trẻ tự kỷ kén ăn cực đoan'],
                                            ['url' => '/tre-tu-ky-hay-dau-bung-khong-ro-nguyen-nhan', 'title' => 'Trẻ tự kỷ hay đau bụng không rõ nguyên nhân'],
                                            ['url' => '/phan-bat-thuong-o-tre-tu-ky', 'title' => 'Phân bất thường ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-cham-tang-can', 'title' => 'Trẻ tự kỷ chậm tăng cân'],
                                            ['url' => '/tre-tu-ky-tu-choi-uong-nuoc', 'title' => 'Trẻ tự kỷ từ chối uống nước'],
                                            ['url' => '/tre-tu-ky-day-hoi-bung-cang-phinh', 'title' => 'Trẻ tự kỷ đầy hơi, bụng căng phình'],
                                            ['url' => '/truc-ruot-nao-tu-ky', 'title' => 'Trục ruột não & tự kỷ'],
                                            ['url' => '/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky', 'title' => 'Chế độ ăn không gluten, casein'],
                                            ['url' => '/dysbiosis-duong-ruot-o-tre-tu-ky', 'title' => 'Dysbiosis đường ruột ở trẻ tự kỷ'],
                                        ],
                                        '04' => [
                                            ['url' => '/tre-tu-ky-nhay-cam-am-thanh', 'title' => 'Trẻ tự kỷ nhạy cảm âm thanh'],
                                            ['url' => '/tre-tu-ky-tranh-om-ap-dung-cham', 'title' => 'Trẻ tự kỷ tránh ôm ấp, đụng chạm'],
                                            ['url' => '/tre-tu-ky-nhay-cam-mui-vi', 'title' => 'Trẻ tự kỷ nhạy cảm mùi vị'],
                                            ['url' => '/tim-kiem-ap-luc-sau-o-tre-tu-ky', 'title' => 'Tìm kiếm áp lực sâu ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-chi-an-thuc-an-cung-ket-cau', 'title' => 'Trẻ tự kỷ chỉ ăn thức ăn cùng kết cấu'],
                                            ['url' => '/tre-tu-ky-khong-so-dau-khong-so-nguy-hiem', 'title' => 'Trẻ tự kỷ không sợ đau'],
                                            ['url' => '/tre-tu-ky-de-bi-phan-tan', 'title' => 'Trẻ tự kỷ dễ bị phân tán'],
                                            ['url' => '/sensory-processing-disorder-khac-tu-ky-the-nao', 'title' => 'Sensory Processing Disorder khác tự kỷ thế nào?'],
                                            ['url' => '/lieu-phap-tich-hop-cam-giac-ot', 'title' => 'Liệu pháp tích hợp cảm giác (OT)'],
                                        ],
                                        '05' => [
                                            ['url' => '/tre-tu-ky-chua-co-ngon-ngu-non-verbal', 'title' => 'Trẻ tự kỷ chưa có ngôn ngữ'],
                                            ['url' => '/tre-tu-ky-cham-noi', 'title' => 'Trẻ tự kỷ chậm nói'],
                                            ['url' => '/tre-tu-ky-keo-tay-khong-the-len-tieng', 'title' => 'Trẻ tự kỷ kéo tay, không thể lên tiếng'],
                                            ['url' => '/tre-tu-ky-khong-hieu-chi-dan', 'title' => 'Trẻ tự kỷ không hiểu chỉ dẫn'],
                                            ['url' => '/echolalia-o-tre-tu-ky', 'title' => 'Echolalia ở trẻ tự kỷ'],
                                            ['url' => '/cot-moc-phat-trien-ngon-ngu-0-6-tuoi', 'title' => 'Cột mốc phát triển ngôn ngữ 0–6 tuổi'],
                                            ['url' => '/tre-khong-noi-co-phai-tu-ky-phan-biet-cham-noi-don-thuan', 'title' => 'Phân biệt chậm nói đơn thuần'],
                                            ['url' => '/aac-giao-tiep-thay-the-cho-tre-tu-ky-khong-ngon-ngu', 'title' => 'AAC (giao tiếp thay thế) cho trẻ tự kỷ'],
                                        ],
                                        '06' => [
                                            ['url' => '/tre-tu-ky-thieu-tap-trung-lo-dang', 'title' => 'Trẻ tự kỷ thiếu tập trung, lơ đãng'],
                                            ['url' => '/tre-tu-ky-tang-dong-hyperactivity', 'title' => 'Trẻ tự kỷ tăng động'],
                                            ['url' => '/tre-tu-ky-xu-ly-thong-tin-cham', 'title' => 'Trẻ tự kỷ xử lý thông tin chậm'],
                                            ['url' => '/tre-tu-ky-kho-giai-quyet-van-de', 'title' => 'Trẻ tự kỷ khó giải quyết vấn đề'],
                                            ['url' => '/cham-phat-trien-toan-dien-o-tre-tu-ky', 'title' => 'Chậm phát triển toàn diện ở trẻ tự kỷ'],
                                            ['url' => '/adhd-tu-ky', 'title' => 'ADHD & tự kỷ'],
                                            ['url' => '/roi-loan-chuc-nang-dieu-hanh-o-tre-tu-ky', 'title' => 'Rối loạn chức năng điều hành ở trẻ tự kỷ'],
                                        ],
                                        '07' => [
                                            ['url' => '/tre-tu-ky-khong-phan-ung-khi-goi-ten', 'title' => 'Trẻ tự kỷ không phản ứng khi gọi tên'],
                                            ['url' => '/thieu-giao-tiep-mat-o-tre-tu-ky', 'title' => 'Thiếu giao tiếp mắt ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-it-choi-cung-ban', 'title' => 'Trẻ tự kỷ ít chơi cùng bạn'],
                                            ['url' => '/hanh-vi-stimming-o-tre-tu-ky', 'title' => 'Hành vi stimming ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-khang-cu-thay-doi', 'title' => 'Trẻ tự kỷ kháng cự thay đổi'],
                                            ['url' => '/tre-tu-ky-bung-phat-cam-xuc', 'title' => 'Trẻ tự kỷ bùng phát cảm xúc'],
                                            ['url' => '/tre-tu-ky-quan-tam-cuc-doan-1-chu-de', 'title' => 'Trẻ tự kỷ quan tâm cực đoan 1 chủ đề'],
                                            ['url' => '/meltdown-tantrum-o-tre-tu-ky', 'title' => 'Meltdown & tantrum ở trẻ tự kỷ'],
                                            ['url' => '/stimming-la-gi-tai-sao-khong-nen-ngan-tre-tu-ky', 'title' => 'Stimming là gì?'],
                                            ['url' => '/roi-loan-lo-au-o-tre-tu-ky', 'title' => 'Rối loạn lo âu ở trẻ tự kỷ'],
                                        ],
                                        '08' => [
                                            ['url' => '/tre-tu-ky-do-tai-ma-sau-khi-an', 'title' => 'Trẻ tự kỷ đỏ tai/má sau khi ăn'],
                                            ['url' => '/benh-cham-eczema-o-tre-tu-ky', 'title' => 'Bệnh chàm eczema ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-them-gluten-sua', 'title' => 'Trẻ tự kỷ thèm gluten & sữa'],
                                            ['url' => '/hanh-vi-tre-tu-ky-thay-doi-sau-an', 'title' => 'Hành vi trẻ tự kỷ thay đổi sau ăn'],
                                            ['url' => '/bung-cang-phinh-doi-hanh-vi-o-tre-tu-ky', 'title' => 'Bụng căng phình & đổi hành vi ở trẻ tự kỷ'],
                                            ['url' => '/dai-dam-tai-phat-o-tre-tu-ky', 'title' => 'Đái dầm tái phát ở trẻ tự kỷ'],
                                            ['url' => '/ige-igg', 'title' => 'IgE & IgG'],
                                            ['url' => '/casein-gluten-anh-huong-khong-bo-tre-tu-ky-ra-sao', 'title' => 'Casein & gluten ảnh hưởng não bộ ra sao?'],
                                        ],
                                        '09' => [
                                            ['url' => '/tre-tu-ky-hay-om-vat-len-toi-6-8-lan-nam', 'title' => 'Trẻ tự kỷ hay ốm vặt lên tới 6–8 lần/năm'],
                                            ['url' => '/viem-tai-giua-tai-phat-o-tre-tu-ky', 'title' => 'Viêm tai giữa tái phát ở trẻ tự kỷ'],
                                            ['url' => '/viem-xoang-tai-phat-o-tre-tu-ky', 'title' => 'Viêm xoang tái phát ở trẻ tự kỷ'],
                                            ['url' => '/dung-khang-sinh-lien-tiep-anh-huong-tre-tu-ky-the-nao', 'title' => 'Dùng kháng sinh liên tiếp ảnh hưởng thế nào?'],
                                            ['url' => '/nhiem-nam-candida-tai-phat-o-tre-tu-ky', 'title' => 'Nhiễm nấm Candida tái phát ở trẻ tự kỷ'],
                                            ['url' => '/benh-tu-mien-gia-dinh-co-lien-quan-tre-tu-ky-khong', 'title' => 'Bệnh tự miễn gia đình có liên quan tự kỷ?'],
                                            ['url' => '/pandas-pans-la-gi-khi-mien-dich-tan-cong-nao-tre', 'title' => 'PANDAS/PANS là gì?'],
                                            ['url' => '/probiotics-cho-tre-tu-ky', 'title' => 'Probiotics cho trẻ tự kỷ'],
                                        ],
                                        '10' => [
                                            ['url' => '/dom-trang-mong-tay-o-tre-tu-ky', 'title' => 'Đốm trắng móng tay ở trẻ tự kỷ'],
                                            ['url' => '/tre-tu-ky-toc-mong-rung-nhieu', 'title' => 'Trẻ tự kỷ tóc mỏng, rụng nhiều'],
                                            ['url' => '/tre-tu-ky-an-day-du-nhung-khong-tang-can', 'title' => 'Trẻ tự kỷ ăn đầy đủ nhưng không tăng cân'],
                                            ['url' => '/pica-o-tre-tu-ky', 'title' => 'Pica ở trẻ tự kỷ'],
                                            ['url' => '/bong-troc-long-ban-chan-o-tre-tu-ky', 'title' => 'Bong tróc lòng bàn chân ở trẻ tự kỷ'],
                                            ['url' => '/kem-magie-trong-dieu-tri-tu-ky', 'title' => 'Kẽm, magie trong điều trị tự kỷ'],
                                            ['url' => '/gen-mthfr-methylfolate-b9-o-tre-tu-ky-la-gi', 'title' => 'Gen MTHFR & Methylfolate (B9) ở trẻ tự kỷ'],
                                            ['url' => '/tai-sao-tre-tu-ky-thuong-thieu-vi-chat-du-an-nhieu', 'title' => 'Tại sao trẻ tự kỷ thường thiếu vi chất?'],
                                        ],
                                        '11' => [
                                            ['url' => '/tre-tu-ky-met-moi-li-bi-qua-muc', 'title' => 'Trẻ tự kỷ mệt mỏi, li bì quá mức'],
                                            ['url' => '/tre-tu-ky-ngu-kho-day', 'title' => 'Trẻ tự kỷ ngủ khó dậy'],
                                            ['url' => '/tre-tu-ky-mat-ky-nang-da-biet-regression', 'title' => 'Trẻ tự kỷ mất kỹ năng đã biết (regression)'],
                                            ['url' => '/hanh-vi-tre-tu-ky-doi-theo-gio', 'title' => 'Hành vi trẻ tự kỷ đổi theo giờ'],
                                            ['url' => '/tre-tu-ky-cham-tang-chieu-cao-can-nang', 'title' => 'Trẻ tự kỷ chậm tăng chiều cao, cân nặng'],
                                            ['url' => '/roi-loan-ti-the-o-tre-tu-ky', 'title' => 'Rối loạn ti thể ở trẻ tự kỷ'],
                                            ['url' => '/methyl-hoa-methylation-o-tre-tu-ky-anh-huong-gi', 'title' => 'Methyl hóa (methylation) ảnh hưởng gì?'],
                                            ['url' => '/thut-lui-ky-nang-o-tre-tu-ky', 'title' => 'Thụt lùi kỹ năng ở trẻ tự kỷ'],
                                        ]
                                    ];
                                    ?>
                                    
                                    <?php foreach ($symptoms as $num => $symptom) : 
                                        $is_active = ($num === '01');
                                        $hidden_class = $is_active ? '' : 'hidden ';
                                    ?>
                                    <!-- Pane <?php echo $num; ?> -->
                                    <div id="pane-<?php echo $num; ?>" class="symptom-pane <?php echo $hidden_class; ?>flex flex-col h-full animate-fadeIn">
                                        <a href="/<?php echo $symptom['slug']; ?>" class="flex items-center gap-3 mb-4 pb-3 border-b border-navy/5 shrink-0 group/paneheader hover:bg-[#f8fafc] p-2 -mx-2 rounded-xl transition-colors">
                                            <div class="w-10 h-10 rounded-xl bg-secondary/10 flex items-center justify-center text-secondary group-hover/paneheader:bg-secondary group-hover/paneheader:text-white transition-colors"><i data-lucide="<?php echo esc_attr($symptom['icon']); ?>" class="w-5 h-5"></i></div>
                                            <div>
                                                <h5 class="font-serif font-bold text-navy text-xl leading-tight group-hover/paneheader:text-secondary transition-colors">Nhóm <?php echo $num; ?>: <?php echo esc_html($symptom['title']); ?></h5>
                                                <p class="text-[12px] text-navy/60 group-hover/paneheader:text-navy flex items-center gap-1 transition-colors">Bài viết tổng quan chuyên đề <i data-lucide="arrow-right" class="w-3 h-3"></i></p>
                                            </div>
                                        </a>
                                        
                                        <div class="grid grid-cols-2 gap-x-6 gap-y-2.5 overflow-y-auto no-scrollbar pr-2 pb-4 content-start">
                                            <?php foreach($symptom_groups_links[$num] as $link): ?>
                                            <a href="<?php echo $link['url']; ?>" class="group/link flex items-center gap-2.5 text-[13px] font-bold text-navy hover:text-secondary transition-colors p-1.5 rounded-lg hover:bg-[#f8fafc]">
                                                <div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary transition-colors shrink-0"></div>
                                                <span class="line-clamp-1 leading-tight" title="<?php echo esc_attr($link['title']); ?>"><?php echo $link['title']; ?></span>
                                            </a>
                                            <?php endforeach; ?>
                                        </div>
                                        
                                        <div class="mt-auto pt-4 border-t border-navy/5 shrink-0 flex items-center justify-between gap-3">
                                            <a href="/<?php echo $symptom['slug']; ?>" class="text-[12px] font-bold text-secondary uppercase tracking-widest flex items-center gap-1.5 hover:text-navy transition-colors shrink-0">
                                                Xem tổng quan nhóm <?php echo $num; ?> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                                            </a>
                                            <a href="/bang-kiem-tra-suc-khoe-toan-dien" class="flex items-center gap-2 bg-secondary hover:bg-amber-600 text-white text-[11px] font-extrabold uppercase tracking-wider px-3.5 py-2 rounded-xl shadow-sm hover:shadow-md transition-all duration-200 shrink-0 group/checklist">
                                                <i data-lucide="clipboard-check" class="w-3.5 h-3.5 group-hover/checklist:scale-110 transition-transform"></i>
                                                Bảng kiểm tra sức khoẻ toàn diện
                                            </a>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mega Menu "Dinh Dưỡng" -->
                    <div class="group h-full flex items-center">
                        <a href="/dinh-duong-cho-tre-tu-ky" class="nav-link relative flex items-center gap-1.5 px-3 py-2 rounded-xl text-navy/70 hover:text-navy group-hover:text-secondary font-bold text-[12px] xl:text-[13px] uppercase tracking-[0.12em] transition-all duration-200 hover:bg-navy/5 group-hover:bg-navy/5" aria-expanded="false" aria-haspopup="true">
                            Dinh Dưỡng 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 w-[900px] xl:w-[1020px] z-[200]">
                            <div class="mega-bridge bg-white/95 backdrop-blur-2xl border border-white/80 rounded-2xl shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15),0_0_0_1px_rgba(0,0,0,0.04)] flex relative overflow-hidden">
                                <div class="w-full grid grid-cols-4 gap-4 xl:gap-6 relative z-10 p-6 xl:p-8">
                                    
                                    <!-- Cột 1 -->
                                    <div class="flex flex-col">
                                        <a href="/khai-niem-cot-loi" class="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                                            <div class="w-6 h-6 rounded-md bg-secondary/10 flex items-center justify-center text-secondary"><i data-lucide="microscope" class="w-3.5 h-3.5"></i></div>
                                            <h5 class="font-serif font-bold text-navy text-sm xl:text-base uppercase tracking-wider">Khái Niệm Cốt Lõi</h5>
                                        </a>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/roi-loan-toan-than" class="group/core block p-3 rounded-xl bg-[#f8fafc] border border-transparent hover:border-navy/10 hover:bg-white hover:shadow-sm transition-all">
                                                <h6 class="text-[12px] xl:text-[13px] font-bold text-navy mb-1 leading-tight group-hover/core:text-secondary transition-colors">Tự kỷ: Rối loạn toàn thân</h6>
                                            </a>
                                            <a href="/khoa-hoc-dinh-duong" class="group/core block p-3 rounded-xl bg-[#f8fafc] border border-transparent hover:border-navy/10 hover:bg-white hover:shadow-sm transition-all">
                                                <h6 class="text-[12px] xl:text-[13px] font-bold text-navy mb-1 leading-tight group-hover/core:text-secondary transition-colors">Khoa học đằng sau</h6>
                                            </a>
                                            <a href="/dinh-duong-ca-nhan-hoa" class="group/core block p-3 rounded-xl bg-[#f8fafc] border border-transparent hover:border-navy/10 hover:bg-white hover:shadow-sm transition-all">
                                                <h6 class="text-[12px] xl:text-[13px] font-bold text-navy mb-1 leading-tight group-hover/core:text-secondary transition-colors">Tại sao cần cá nhân hóa?</h6>
                                            </a>
                                        </div>
                                    </div>

                                    <!-- Cột 2 -->
                                    <div class="flex flex-col">
                                        <a href="/nen-tang-co-ban" class="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                                            <div class="w-6 h-6 rounded-md bg-secondary/10 flex items-center justify-center text-secondary"><i data-lucide="layers" class="w-3.5 h-3.5"></i></div>
                                            <h5 class="font-serif font-bold text-navy text-sm xl:text-base uppercase tracking-wider">Nền Tảng Cơ Bản</h5>
                                        </a>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/buoc-1-tranh-doc-to" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">1.</span> Tránh đồ ăn vặt & Độc tố</a>
                                            <a href="/buoc-2-an-uong-lanh-manh" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">2.</span> Nguyên tắc ăn lành mạnh</a>
                                            <a href="/buoc-3-thuc-pham-bo-sung" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">3.</span> Thực phẩm bổ sung</a>
                                            <a href="/buoc-4-giai-quyet-ken-an" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">4.</span> Giải quyết chứng kén ăn</a>
                                            <a href="/buoc-5-che-do-an-gfcfsf" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">5.</span> Chế độ ăn GFCFSF</a>
                                            <a href="/buoc-6-dinh-duong-cho-nao" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">6.</span> Dinh dưỡng cho não</a>
                                        </div>
                                    </div>

                                    <!-- Cột 3 -->
                                    <div class="flex flex-col">
                                        <a href="/tri-lieu-sau" class="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                                            <div class="w-6 h-6 rounded-md bg-secondary/10 flex items-center justify-center text-secondary"><i data-lucide="dna" class="w-3.5 h-3.5"></i></div>
                                            <h5 class="font-serif font-bold text-navy text-sm xl:text-base uppercase tracking-wider">Trị Liệu Sâu</h5>
                                        </a>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/buoc-7-che-do-low-sag" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">7.</span> Chế độ Low SAG</a>
                                            <a href="/buoc-8-che-do-scd-gaps" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">8.</span> Chế độ SCD/GAPS</a>
                                            <a href="/buoc-9-che-do-low-oxalate" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">9.</span> Chế độ Low Oxalate</a>
                                            <a href="/buoc-10-che-do-fail-safe" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">10.</span> Chế độ Fail-Safe</a>
                                            <a href="/buoc-11-ho-tro-tieu-hoa" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">11.</span> Hỗ trợ hệ tiêu hóa</a>
                                            <a href="/buoc-12-bo-sung-chuyen-sau" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex gap-2"><span class="text-secondary/50">12.</span> Bổ sung chuyên sâu</a>
                                        </div>
                                    </div>

                                    <!-- Cột 4 -->
                                    <div class="flex flex-col">
                                        <a href="/cong-thuc" class="flex items-center gap-2 mb-4 hover:opacity-80 transition-opacity">
                                            <div class="w-6 h-6 rounded-md bg-secondary/10 flex items-center justify-center text-secondary"><i data-lucide="chef-hat" class="w-3.5 h-3.5"></i></div>
                                            <h5 class="font-serif font-bold text-navy text-sm xl:text-base uppercase tracking-wider">50 Công Thức Nấu Ăn</h5>
                                        </a>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/cong-thuc-bua-sang" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-navy/20"></div> Bữa sáng</a>
                                            <a href="/cong-thuc-mon-chinh" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-navy/20"></div> Món chính</a>
                                            <a href="/cong-thuc-bua-phu" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-navy/20"></div> Bữa phụ & Ăn vặt</a>
                                            <a href="/cong-thuc-nuoc-ep" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 flex items-center gap-2"><div class="w-1.5 h-1.5 rounded-full bg-navy/20"></div> Sinh tố & Nước ép</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Mega Menu "Khóa học" -->
                    <div class="group h-full flex items-center">
                        <button class="nav-link relative flex items-center gap-1.5 px-3 py-2 rounded-xl text-navy/70 hover:text-navy group-hover:text-secondary font-bold text-[12px] xl:text-[13px] uppercase tracking-[0.12em] transition-all duration-200 hover:bg-navy/5 group-hover:bg-navy/5" aria-expanded="false" aria-haspopup="true">
                            Khóa học 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>
                        </button>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 w-[600px] xl:w-[700px] z-[200]">
                            <div class="mega-bridge bg-white/95 backdrop-blur-2xl border border-white/80 rounded-2xl shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15),0_0_0_1px_rgba(0,0,0,0.04)] p-6 xl:p-8 flex gap-6 relative overflow-hidden">
                                
                                <i data-lucide="graduation-cap" class="absolute -bottom-6 -right-6 w-32 h-32 text-navy/5 rotate-12 pointer-events-none" aria-hidden="true"></i>

                                <!-- Cột 1: Thông tin & Lối vào chính -->
                                <div class="w-[40%] border-r border-navy/10 pr-6 flex flex-col justify-between z-10 relative">
                                    <div>
                                        <h4 class="font-serif font-bold text-navy text-xl xl:text-2xl mb-2 leading-tight">E-Learning</h4>
                                        <p class="text-[12px] text-navy/60 leading-relaxed mb-4">Hệ thống bài giảng y sinh học, dinh dưỡng và chăm sóc trẻ tự kỷ chuyên sâu từ gốc rễ tế bào.</p>
                                    </div>

                                    <a href="<?php echo home_url('/courses/'); ?>" class="group/btn flex items-center justify-center gap-3 text-white bg-navy hover:bg-secondary font-bold text-[13px] p-3.5 rounded-xl shadow-md hover:shadow-lg transition-all duration-300 w-full uppercase tracking-wider">
                                        <i data-lucide="graduation-cap" class="w-4 h-4"></i> Tất cả khóa học
                                    </a>
                                </div>

                                <!-- Cột 2: Các khóa học hiện có -->
                                <div class="w-[60%] pl-6 flex flex-col z-10 relative">
                                    <span class="text-secondary font-extrabold text-[11px] uppercase tracking-widest flex items-center gap-2 mb-3">
                                        <i data-lucide="play-circle" class="w-4 h-4" aria-hidden="true"></i> Khóa học nổi bật
                                    </span>
                                    
                                    <div class="grid grid-cols-1 gap-2 overflow-y-auto max-h-[220px] pr-2 no-scrollbar">
                                        <?php
                                        $mega_courses_query = new WP_Query( [
                                            'post_type'      => 'course',
                                            'posts_per_page' => 5,
                                            'post_status'    => 'publish',
                                            'orderby'        => 'date',
                                            'order'          => 'DESC'
                                        ] );
                                        if ( $mega_courses_query->have_posts() ) :
                                            while ( $mega_courses_query->have_posts() ) : $mega_courses_query->the_post();
                                                $c_price = get_post_meta( get_the_ID(), '_course_price', true );
                                                $c_price_label = ($c_price == 0) ? 'Miễn phí' : number_format($c_price, 0, ',', '.') . 'đ';
                                        ?>
                                                <a href="<?php the_permalink(); ?>" class="flex items-center justify-between p-2.5 rounded-xl bg-gradient-to-br from-white to-[#f8fafc] border border-white hover:border-secondary/30 hover:shadow-sm transition-all group/item">
                                                    <div class="flex items-center gap-2.5 min-w-0">
                                                        <div class="w-7 h-7 rounded-lg bg-secondary/5 flex items-center justify-center text-secondary group-hover/item:bg-secondary group-hover/item:text-white transition-colors shrink-0">
                                                            <i data-lucide="graduation-cap" class="w-3.5 h-3.5"></i>
                                                        </div>
                                                        <span class="font-bold text-navy text-[13px] group-hover/item:text-secondary transition-colors truncate"><?php the_title(); ?></span>
                                                    </div>
                                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-600 group-hover/item:bg-secondary/10 group-hover/item:text-secondary transition-colors shrink-0"><?php echo esc_html($c_price_label); ?></span>
                                                </a>
                                        <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        else :
                                        ?>
                                            <p class="text-[12px] text-navy/40 italic">Chưa có khóa học nào.</p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- COL 3: CTAs (RIGHT) -->
                <div class="hidden lg:flex justify-end items-center gap-2 xl:gap-3">

                    <!-- Tài liệu Y sinh -->
                    <div class="group relative flex items-center">
                        <a href="/chuyen-de" class="flex items-center gap-2 border border-navy/10 hover:border-secondary/40 bg-[#f5f7fa] hover:bg-white px-3.5 xl:px-4 py-2 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md outline-none group/btn">
                            <div class="w-6 h-6 rounded-lg bg-secondary/10 flex items-center justify-center group-hover/btn:bg-secondary/20 transition-colors">
                                <i data-lucide="book-open" class="w-3.5 h-3.5 text-secondary"></i>
                            </div>
                            <span class="font-bold text-navy text-[11px] xl:text-[12px] uppercase tracking-wider group-hover/btn:text-secondary transition-colors">Tài liệu Y sinh</span>
                        </a>
                        <!-- Chuyên Đề Dropdown -->
                        <div class="absolute top-full right-0 pt-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 translate-y-2 group-hover:translate-y-0 w-[860px] xl:w-[960px] z-[200]">
                            <div class="mega-bridge bg-white/95 backdrop-blur-2xl border border-white/80 rounded-2xl shadow-[0_20px_60px_-10px_rgba(0,0,0,0.15),0_0_0_1px_rgba(0,0,0,0.04)] p-6 xl:p-8 relative overflow-hidden">
                                <div class="grid grid-cols-4 gap-6 relative z-10 text-left">
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[12px] uppercase tracking-wider mb-3 border-b border-navy/5 pb-2">Hành Vi & Tâm Lý</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/cam-nang-hanh-vi" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Cẩm nang hành vi</a>
                                            <a href="/giai-ma-hoi-chung-pica" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Hội chứng PICA</a>
                                            <a href="/la-het" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>La hét & Khủng hoảng</a>
                                            <a href="/tu-ky-thoai-lui" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Tự kỷ thoái lui</a>
                                            <a href="/tieng-noi-cua-con" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Tiếng nói của con</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[12px] uppercase tracking-wider mb-3 border-b border-navy/5 pb-2">Não Bộ & Thần Kinh</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/viem-than-kinh" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Viêm thần kinh</a>
                                            <a href="/suong-mu-nao-va-nam" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Sương mù não & Nấm men</a>
                                            <a href="/hieu-ung-opioid" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Hiệu ứng Opioid</a>
                                            <a href="/roi-loan-chuyen-hoa" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Rối loạn chuyển hóa</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[12px] uppercase tracking-wider mb-3 border-b border-navy/5 pb-2">Thể Chất & Sinh Lý</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/van-dong-tho-tinh" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Vận động thô & tinh</a>
                                            <a href="/chay-nuoc-dai-nhieu" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Chảy nước dãi nhiều</a>
                                            <a href="/dinh-duong-giac-ngu" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Dinh dưỡng & Giấc ngủ</a>
                                            <a href="/duong-tang-dong" class="group/l flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/l:bg-secondary shrink-0"></div>Đường & Tăng động</a>
                                        </div>
                                    </div>
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[12px] uppercase tracking-wider mb-3 border-b border-navy/5 pb-2">Đánh Giá & Công Cụ</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/check-list" class="flex items-center gap-2 text-white bg-secondary hover:bg-secondary_dark text-[13px] font-bold py-2.5 px-4 rounded-xl shadow-sm transition-all justify-center mt-1"><i data-lucide="check-square" class="w-4 h-4"></i>Checklist Đánh Giá</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Divider -->
                    <div class="w-px h-5 bg-navy/10"></div>

                    <!-- Facebook -->
                    <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener noreferrer"
                       title="Cộng đồng"
                       class="flex items-center justify-center bg-[#1877F2] hover:bg-[#0d6edc] text-white w-9 h-9 xl:w-10 xl:h-10 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md shrink-0"
                       aria-label="Cộng đồng Facebook">
                        <svg class="w-4 h-4 xl:w-4.5 xl:h-4.5 fill-white" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    </a>

                    <!-- Zalo -->
                    <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank" rel="noopener noreferrer"
                       title="Góc chia sẻ"
                       class="flex items-center justify-center bg-[#0068FF] hover:bg-[#0054cc] text-white w-9 h-9 xl:w-10 xl:h-10 rounded-xl transition-all duration-200 shadow-sm hover:shadow-md shrink-0"
                       aria-label="Góc chia sẻ Zalo">
                        <svg class="w-4.5 h-4.5 xl:w-5 xl:h-5 fill-white" viewBox="0 0 48 48"><path d="M24 4C12.95 4 4 12.95 4 24c0 3.67.99 7.12 2.72 10.09L4 44l10.22-2.68A19.9 19.9 0 0024 44c11.05 0 20-8.95 20-20S35.05 4 24 4zm9.54 27.46c-.39 1.1-2.28 2.09-3.17 2.22-.81.12-1.83.17-2.96-.19-.68-.22-1.55-.5-2.67-.99-4.7-2.03-7.76-6.76-8-7.07-.22-.3-1.84-2.45-1.84-4.67 0-2.22 1.16-3.31 1.58-3.76.39-.41.85-.52 1.13-.52.28 0 .57 0 .82.01.27.01.63-.1.99.76.39.9 1.32 3.22 1.44 3.45.12.23.2.5.04.8-.16.3-.24.49-.47.76-.22.27-.47.6-.67.81-.22.22-.46.47-.2.92.27.45 1.18 1.95 2.54 3.16 1.74 1.56 3.21 2.04 3.66 2.27.45.22.71.19.97-.11.27-.3 1.14-1.33 1.44-1.79.3-.45.6-.38 1.01-.22.41.15 2.6 1.23 3.05 1.45.45.22.75.34.86.52.11.19.11 1.09-.28 2.19z"/></svg>
                    </a>

                    <?php 
                    $current_member = \Hieucon\Model\Member_Model::get_current_member(); 
                    if ( $current_member ) : 
                    ?>
                        <!-- Nút: Tài khoản (Đã đăng nhập) -->
                        <a href="<?php echo home_url('/tai-khoan/'); ?>"
                           class="flex items-center gap-1.5 bg-navy hover:bg-navy/80 text-white px-3 py-2 rounded-xl font-bold text-[11px] xl:text-[12px] transition-all duration-200 shadow-sm hover:shadow-md group shrink-0">
                            <i data-lucide="user" class="w-4 h-4 text-secondary group-hover:text-white transition-colors"></i>
                            <span>Tài khoản</span>
                        </a>
                    <?php else : ?>
                        <!-- Nút: Đăng nhập (Chưa đăng nhập) -->
                        <a href="<?php echo home_url('/dang-nhap/'); ?>"
                           class="flex items-center gap-1.5 bg-secondary hover:bg-secondary_dark text-white px-3 py-2 rounded-xl font-bold text-[11px] xl:text-[12px] transition-all duration-200 shadow-sm hover:shadow-md shrink-0">
                            <i data-lucide="log-in" class="w-4 h-4 text-white"></i>
                            <span>Đăng nhập</span>
                        </a>
                    <?php endif; ?>

                </div>

                <!-- Mobile Hamburger -->
                <div class="lg:hidden flex justify-end items-center">
                    <button id="mobile-menu-btn" aria-label="Mở menu" aria-expanded="false" class="p-2 bg-[#f5f7fa] border border-navy/10 rounded-xl text-navy hover:bg-white transition-colors shadow-sm">
                        <i data-lucide="menu" class="w-5 h-5"></i>
                    </button>
                </div>

            </div>
        </div>
    </header>

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


            <!-- Accordion: Triệu Chứng (HIERARCHICAL) -->
            <div class="flex flex-col border-b border-navy/5">
                <button id="mobile-symptoms-toggle" aria-expanded="false" class="flex justify-between items-center py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                    <span class="flex items-center gap-3"><i data-lucide="activity" class="w-4 h-4 text-navy/40"></i> Triệu Chứng</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-navy/40 transition-transform duration-300" id="mobile-symptoms-icon"></i>
                </button>
                <div id="mobile-symptoms-content" class="hidden flex-col gap-1 pl-4 py-3 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]">
                    <a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="text-secondary font-bold text-[13px] py-2 px-3 flex items-center gap-2 hover:text-secondary_dark">Tổng quan 11 nhóm <i data-lucide="arrow-right" class="w-3 h-3"></i></a>
                    <div class="w-full h-px bg-navy/5 my-1"></div>
                    <a href="/van-dong-tho-tinh-o-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="person-standing" class="w-3.5 h-3.5 opacity-50"></i> 01. Vận động thô & tinh</a>
                    <a href="/van-dong-mieng-hong-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="smile" class="w-3.5 h-3.5 opacity-50"></i> 02. Vận động miệng họng</a>
                    <a href="/tieu-hoa-da-day-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="apple" class="w-3.5 h-3.5 opacity-50"></i> 03. Tiêu hóa & dạ dày</a>
                    <a href="/xu-ly-cam-giac-o-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="eye" class="w-3.5 h-3.5 opacity-50"></i> 04. Xử lý cảm giác</a>
                    <a href="/ngon-ngu-giao-tiep-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="message-circle" class="w-3.5 h-3.5 opacity-50"></i> 05. Ngôn ngữ giao tiếp</a>
                    <a href="/nhan-thuc-hoc-tap-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="brain" class="w-3.5 h-3.5 opacity-50"></i> 06. Nhận thức & học tập</a>
                    <a href="/hanh-vi-xa-hoi-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="users" class="w-3.5 h-3.5 opacity-50"></i> 07. Hành vi & xã hội</a>
                    <a href="/di-ung-nhay-cam-thuc-pham-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="shield-alert" class="w-3.5 h-3.5 opacity-50"></i> 08. Dị ứng thực phẩm</a>
                    <a href="/he-mien-dich-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="shield-plus" class="w-3.5 h-3.5 opacity-50"></i> 09. Hệ miễn dịch</a>
                    <a href="/dinh-duong-vi-chat-o-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="test-tube" class="w-3.5 h-3.5 opacity-50"></i> 10. Dinh dưỡng vi chất</a>
                    <a href="/nang-luong-chuyen-hoa-o-tre-tu-ky" class="text-navy/80 font-bold text-[13px] py-2 px-3 hover:text-secondary hover:bg-white rounded-lg transition-colors flex items-center gap-2"><i data-lucide="zap" class="w-3.5 h-3.5 opacity-50"></i> 11. Năng lượng chuyển hóa</a>
                </div>
            </div>

            <!-- Accordion: Dinh Dưỡng -->
            <div class="flex flex-col border-b border-navy/5">
                <button id="mobile-nutrition-toggle" aria-expanded="false" class="flex justify-between items-center py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                    <span class="flex items-center gap-3"><i data-lucide="microscope" class="w-4 h-4 text-navy/40"></i> Dinh Dưỡng</span>
                    <i data-lucide="chevron-down" class="w-4 h-4 text-navy/40 transition-transform duration-300" id="mobile-nutrition-icon"></i>
                </button>
                <div id="mobile-nutrition-content" class="hidden flex-col gap-2 pl-4 py-3 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]">
                    <a href="/dinh-duong-cho-tre-tu-ky" class="text-secondary font-bold text-[13px] py-2 px-3 flex items-center gap-2 hover:text-secondary_dark">Tổng quan Dinh Dưỡng <i data-lucide="arrow-right" class="w-3 h-3"></i></a>
                </div>
            </div>



        </div>

        <div class="p-5 flex flex-col gap-3 mt-auto border-t border-white bg-white/80 backdrop-blur-md pb-8">
            <?php 
            $current_member = \Hieucon\Model\Member_Model::get_current_member(); 
            if ( $current_member ) : 
            ?>
                <!-- Mobile CTA: Tài khoản -->
                <a href="<?php echo home_url('/tai-khoan/'); ?>" class="bg-gradient-to-br from-navy to-navy/80 text-white p-3.5 rounded-2xl shadow-[0_4px_12px_rgba(10,25,49,0.15)] flex items-center gap-3 transition-transform hover:scale-[1.02] active:scale-95 group">
                    <div class="bg-white/20 w-9 h-9 rounded-xl flex items-center justify-center shrink-0">
                        <i data-lucide="user" class="w-5 h-5 text-secondary group-hover:text-white transition-colors"></i>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="font-extrabold text-[13px] leading-tight">Tài Khoản Của Tôi</span>
                        <span class="font-bold text-[10px] text-white/80 uppercase tracking-widest mt-0.5">Chào, <?php echo esc_html($current_member->full_name); ?></span>
                    </div>
                </a>
            <?php else : ?>
                <!-- Mobile CTA: Đăng nhập -->
                <a href="<?php echo home_url('/dang-nhap/'); ?>" class="bg-gradient-to-br from-secondary to-secondary_dark text-white p-3.5 rounded-2xl shadow-[0_4px_12px_rgba(249,115,22,0.25)] flex items-center gap-3 transition-transform hover:scale-[1.02] active:scale-95 group">
                    <div class="bg-white/20 w-9 h-9 rounded-xl flex items-center justify-center shrink-0">
                        <i data-lucide="log-in" class="w-5 h-5 text-white"></i>
                    </div>
                    <div class="flex flex-col text-left">
                        <span class="font-extrabold text-[13px] leading-tight">Đăng Nhập / Đăng Ký</span>
                        <span class="font-bold text-[10px] text-white/80 uppercase tracking-widest mt-0.5">Xác thực OTP bảo mật</span>
                    </div>
                </a>
            <?php endif; ?>

            <a href="/chuyen-de" class="flex items-center gap-3 bg-white border border-secondary/20 hover:border-secondary p-3.5 rounded-2xl shadow-sm transition-all">
                <div class="bg-secondary/10 p-2.5 rounded-xl text-secondary"><i data-lucide="book-open" class="w-5 h-5"></i></div>
                <div class="flex flex-col text-left">
                    <span class="font-extrabold text-navy text-[13px] leading-tight">Tài liệu Y sinh</span>
                    <span class="text-[10px] font-extrabold text-secondary uppercase tracking-widest mt-0.5">Các chuyên đề chuyên sâu</span>
                </div>
            </a>
            
            <div class="grid grid-cols-2 gap-2">
                <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener noreferrer" class="bg-[#1877F2] hover:bg-[#0d6edc] text-white p-3 rounded-2xl font-bold text-center shadow-md flex items-center justify-center gap-2 text-xs">
                    <i data-lucide="users" class="w-4 h-4"></i> Cộng đồng
                </a>
                <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank" rel="noopener noreferrer" class="bg-[#0068FF] hover:bg-[#0054cc] text-white p-3 rounded-2xl font-bold text-center shadow-md flex items-center justify-center gap-2 text-xs">
                    <span class="font-black text-sm text-white leading-none">Z</span> Góc chia sẻ
                </a>
            </div>
        </div>
    </nav>
</header>

    <style>
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeIn { animation: fadeIn 0.25s ease-out forwards; }

        /* Mega Menu: allow pointer to travel from nav item to dropdown without flickering */
        .glass-header { overflow: visible !important; }

        /* Bridge gap: invisible hover area between button and panel */
        .group:hover > div[class*="absolute top-full"] {
            pointer-events: auto;
        }

        /* Mega menu panel entrance animation */
        .group:hover > div[class*="absolute top-full"] > div {
            animation: fadeIn 0.2s ease-out forwards;
        }

        /* Consistent divider style in mega menus */
        .mega-section-title {
            font-size: 11px;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--color-secondary, #D97706);
            padding-bottom: 8px;
            border-bottom: 1px solid rgba(0,0,0,0.05);
            margin-bottom: 12px;
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
                    symptomPanes.forEach(p => { p.classList.add('hidden'); p.classList.remove('flex'); });
                    
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
                    if(targetPane) {
                        targetPane.classList.remove('hidden');
                        targetPane.classList.add('flex');
                    }
                });
            });
        }
        
        setupAccordion('mobile-products-toggle', 'mobile-products-content', 'mobile-products-icon');
        setupAccordion('mobile-symptoms-toggle', 'mobile-symptoms-content', 'mobile-symptoms-icon');
        setupAccordion('mobile-nutrition-toggle', 'mobile-nutrition-content', 'mobile-nutrition-icon');
        setupAccordion('mobile-chuyende-toggle', 'mobile-chuyende-content', 'mobile-chuyende-icon');
        setupAccordion('mobile-courses-toggle', 'mobile-courses-content', 'mobile-courses-icon');

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
