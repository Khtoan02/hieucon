import re
import urllib.request

# We will read layout-default.php, copy it, and inject the necessary parts to make layout-full.php

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-default.php', 'r') as f:
    content = f.read()

# 1. Change to floating pill header
content = content.replace(
    '<header id="main-header" class="glass-header sticky top-0 z-[100] w-full" aria-label="Main Navigation">',
    '<header id="main-header" class="fixed top-2 lg:top-4 left-1/2 -translate-x-1/2 z-[100] w-[96%] max-w-[1360px] transition-all duration-500" aria-label="Main Navigation">'
)
content = content.replace(
    '<div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">',
    '<div class="glass-header rounded-2xl lg:rounded-[2rem] backdrop-blur-2xl bg-white/85 border border-white/60 shadow-[0_8px_30px_rgb(0,0,0,0.06)] px-4 sm:px-6 lg:px-8">'
)

# 2. Fix flex layout of header container
content = content.replace(
    '<div class="header-container flex justify-between items-center h-[76px] transition-all duration-400">',
    '<div class="header-container flex items-center justify-between h-[68px] lg:h-[76px] transition-all duration-400 w-full">'
)
content = content.replace(
    '<a href="<?php echo home_url(\'/\'); ?>" class="flex items-center gap-3 cursor-pointer group shrink-0 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-xl p-1">',
    '<div class="flex-1 flex justify-start items-center min-w-0">\n                    <a href="<?php echo home_url(\'/\'); ?>" class="flex items-center gap-3 cursor-pointer group outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-xl p-1">'
)
# Add closing </div> for Logo
content = content.replace(
    '                    </a>\n\n                <!-- 2. Main Navigation (Desktop) -->',
    '                    </a>\n                </div>\n\n                <!-- 2. Main Navigation (Desktop) -->'
)

# 3. Fix Desktop Nav container
content = content.replace(
    '<nav class="hidden lg:flex items-center h-full absolute left-1/2 -translate-x-1/2 space-x-6 xl:space-x-8 2xl:space-x-10">',
    '<nav class="hidden lg:flex items-center justify-center shrink-0 space-x-4 lg:space-x-5 xl:space-x-7 px-2">'
)

# 4. We need to INJECT the "Triệu Chứng", "Dinh Dưỡng", "Chuyên Đề" right after the "Sản phẩm" mega menu closes.
# The "Sản phẩm" mega menu closes right before `</nav>`
injection_point = '                    </div>\n\n                    </nav>'
# Wait, let's find the `</nav>` for the desktop menu
parts = content.split('</nav>')
desktop_nav_content = parts[0]
the_rest = '</nav>'.join(parts[1:])

symptoms_menu = """
                    <!-- Mega Menu "Triệu Chứng" -->
                    <div class="group h-full flex items-center">
                        <a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">
                            Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[900px] xl:w-[1000px] z-50">
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
                                            ['url' => '/tre-tu-ky-hay-nga-thang-bang-kem', 'title' => 'Trẻ Tự Kỷ Hay Ngã, Thăng Bằng Kém'],
                                            ['url' => '/tre-tu-ky-kho-leo-cau-thang', 'title' => 'Trẻ Tự Kỷ Khó Leo Cầu Thang'],
                                            ['url' => '/van-dong-tinh-kem-o-tre-tu-ky', 'title' => 'Vận Động Tinh Kém Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-di-nhon-got-toe-walking', 'title' => 'Trẻ Tự Kỷ Đi Nhón Gót'],
                                            ['url' => '/truong-luc-co-thap-o-tre-tu-ky', 'title' => 'Trương Lực Cơ Thấp Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-ngoi-kieu-chu-w', 'title' => 'Trẻ Tự Kỷ Ngồi Kiểu Chữ W'],
                                            ['url' => '/dang-di-bat-thuong-o-tre-tu-ky', 'title' => 'Dáng Đi Bất Thường Ở Trẻ Tự Kỷ'],
                                            ['url' => '/vat-ly-tri-lieu-tre-tu-ky', 'title' => 'Vật Lý Trị Liệu Trẻ Tự Kỷ'],
                                            ['url' => '/truong-luc-co-thap-tu-ky', 'title' => 'Trương Lực Cơ Thấp & Tự Kỷ'],
                                        ],
                                        '02' => [
                                            ['url' => '/tre-tu-ky-chay-nuoc-dai-nhieu', 'title' => 'Trẻ Tự Kỷ Chảy Nước Dãi Nhiều'],
                                            ['url' => '/tre-tu-ky-hay-bi-sac-khi-an', 'title' => 'Trẻ Tự Kỷ Hay Bị Sặc Khi Ăn'],
                                            ['url' => '/tre-tu-ky-chi-an-do-mem-tranh-nhai', 'title' => 'Trẻ Tự Kỷ Chỉ Ăn Đồ Mềm, Tránh Nhai'],
                                            ['url' => '/tre-nhai-khong-ky-nhoi-day-mieng', 'title' => 'Trẻ Nhai Không Kỹ, Nhồi Đầy Miệng'],
                                            ['url' => '/tre-tu-ky-phat-am-khong-ro', 'title' => 'Trẻ Tự Kỷ Phát Âm Không Rõ'],
                                            ['url' => '/cham-noi-do-van-dong-mieng-yeu', 'title' => 'Chậm Nói Do Vận Động Miệng Yếu'],
                                            ['url' => '/oral-motor-therapy-la-gi-giai-thich-de-hieu-cho-me', 'title' => 'Oral Motor Therapy Là Gì?'],
                                            ['url' => '/cham-noi-do-ngon-ngu-hay-do-van-dong-mieng-yeu', 'title' => 'Chậm Nói Do Ngôn Ngữ Hay Do Vận Động Miệng Yếu?'],
                                        ],
                                        '03' => [
                                            ['url' => '/tre-tu-ky-tao-bon-man-tinh', 'title' => 'Trẻ Tự Kỷ Táo Bón Mãn Tính'],
                                            ['url' => '/tre-tu-ky-tieu-chay-man-tinh', 'title' => 'Trẻ Tự Kỷ Tiêu Chảy Mãn Tính'],
                                            ['url' => '/trao-nguoc-axit-o-tre-tu-ky', 'title' => 'Trào Ngược Axit Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-ken-an-cuc-doan', 'title' => 'Trẻ Tự Kỷ Kén Ăn Cực Đoan'],
                                            ['url' => '/tre-tu-ky-hay-dau-bung-khong-ro-nguyen-nhan', 'title' => 'Trẻ Tự Kỷ Hay Đau Bụng Không Rõ Nguyên Nhân'],
                                            ['url' => '/phan-bat-thuong-o-tre-tu-ky', 'title' => 'Phân Bất Thường Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-cham-tang-can', 'title' => 'Trẻ Tự Kỷ Chậm Tăng Cân'],
                                            ['url' => '/tre-tu-ky-tu-choi-uong-nuoc', 'title' => 'Trẻ Tự Kỷ Từ Chối Uống Nước'],
                                            ['url' => '/tre-tu-ky-day-hoi-bung-cang-phinh', 'title' => 'Trẻ Tự Kỷ Đầy Hơi, Bụng Căng Phình'],
                                            ['url' => '/truc-ruot-nao-tu-ky', 'title' => 'Trục Ruột Não & Tự Kỷ'],
                                            ['url' => '/che-do-an-khong-gluten-casein-gfcf-cho-tre-tu-ky', 'title' => 'Chế Độ Ăn Không Gluten Casein'],
                                            ['url' => '/dysbiosis-duong-ruot-o-tre-tu-ky', 'title' => 'Dysbiosis Đường Ruột Ở Trẻ Tự Kỷ'],
                                        ],
                                        '04' => [
                                            ['url' => '/tre-tu-ky-nhay-cam-am-thanh', 'title' => 'Trẻ Tự Kỷ Nhạy Cảm Âm Thanh'],
                                            ['url' => '/tre-tu-ky-tranh-om-ap-dung-cham', 'title' => 'Trẻ Tự Kỷ Tránh Ôm ấp, Đụng Chạm'],
                                            ['url' => '/tre-tu-ky-nhay-cam-mui-vi', 'title' => 'Trẻ Tự Kỷ Nhạy Cảm Mùi Vị'],
                                            ['url' => '/tim-kiem-ap-luc-sau-o-tre-tu-ky', 'title' => 'Tìm Kiếm Áp Lực Sâu Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-chi-an-thuc-an-cung-ket-cau', 'title' => 'Trẻ Tự Kỷ Chỉ Ăn Thức Ăn Cùng Kết Cấu'],
                                            ['url' => '/tre-tu-ky-khong-so-dau-khong-so-nguy-hiem', 'title' => 'Trẻ Tự Kỷ Không Sợ Đau'],
                                            ['url' => '/tre-tu-ky-de-bi-phan-tan', 'title' => 'Trẻ Tự Kỷ Dễ Bị Phân Tán'],
                                            ['url' => '/sensory-processing-disorder-khac-tu-ky-the-nao', 'title' => 'Sensory Processing Disorder Khác Tự Kỷ Thế Nào?'],
                                            ['url' => '/lieu-phap-tich-hop-cam-giac-ot', 'title' => 'Liệu Pháp Tích Hợp Cảm Giác (OT)'],
                                        ],
                                        '05' => [
                                            ['url' => '/tre-tu-ky-chua-co-ngon-ngu-non-verbal', 'title' => 'Trẻ Tự Kỷ Chưa Có Ngôn Ngữ'],
                                            ['url' => '/tre-tu-ky-cham-noi', 'title' => 'Trẻ Tự Kỷ Chậm Nói'],
                                            ['url' => '/tre-tu-ky-keo-tay-khong-the-len-tieng', 'title' => 'Trẻ Tự Kỷ Kéo Tay, Không Thể Lên Tiếng'],
                                            ['url' => '/tre-tu-ky-khong-hieu-chi-dan', 'title' => 'Trẻ Tự Kỷ Không Hiểu Chỉ Dẫn'],
                                            ['url' => '/echolalia-o-tre-tu-ky', 'title' => 'Echolalia Ở Trẻ Tự Kỷ'],
                                            ['url' => '/cot-moc-phat-trien-ngon-ngu-0-6-tuoi', 'title' => 'Cột Mốc Phát Triển Ngôn Ngữ 0-6 Tuổi'],
                                            ['url' => '/tre-khong-noi-co-phai-tu-ky-phan-biet-cham-noi-don-thuan', 'title' => 'Phân Biệt Chậm Nói Đơn Thuần'],
                                            ['url' => '/aac-giao-tiep-thay-the-cho-tre-tu-ky-khong-ngon-ngu', 'title' => 'AAC (Giao Tiếp Thay Thế) Cho Trẻ Tự Kỷ'],
                                        ],
                                        '06' => [
                                            ['url' => '/tre-tu-ky-thieu-tap-trung-lo-dang', 'title' => 'Trẻ Tự Kỷ Thiếu Tập Trung, Lơ Đãng'],
                                            ['url' => '/tre-tu-ky-tang-dong-hyperactivity', 'title' => 'Trẻ Tự Kỷ Tăng Động'],
                                            ['url' => '/tre-tu-ky-xu-ly-thong-tin-cham', 'title' => 'Trẻ Tự Kỷ Xử Lý Thông Tin Chậm'],
                                            ['url' => '/tre-tu-ky-kho-giai-quyet-van-de', 'title' => 'Trẻ Tự Kỷ Khó Giải Quyết Vấn Đề'],
                                            ['url' => '/cham-phat-trien-toan-dien-o-tre-tu-ky', 'title' => 'Chậm Phát Triển Toàn Diện Ở Trẻ Tự Kỷ'],
                                            ['url' => '/adhd-tu-ky', 'title' => 'ADHD & Tự Kỷ'],
                                            ['url' => '/roi-loan-chuc-nang-dieu-hanh-o-tre-tu-ky', 'title' => 'Rối Loạn Chức Năng Điều Hành Ở Trẻ Tự Kỷ'],
                                        ],
                                        '07' => [
                                            ['url' => '/tre-tu-ky-khong-phan-ung-khi-goi-ten', 'title' => 'Trẻ Tự Kỷ Không Phản Ứng Khi Gọi Tên'],
                                            ['url' => '/thieu-giao-tiep-mat-o-tre-tu-ky', 'title' => 'Thiếu Giao Tiếp Mắt Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-it-choi-cung-ban', 'title' => 'Trẻ Tự Kỷ Ít Chơi Cùng Bạn'],
                                            ['url' => '/hanh-vi-stimming-o-tre-tu-ky', 'title' => 'Hành Vi Stimming Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-khang-cu-thay-doi', 'title' => 'Trẻ Tự Kỷ Kháng Cự Thay Đổi'],
                                            ['url' => '/tre-tu-ky-bung-phat-cam-xuc', 'title' => 'Trẻ Tự Kỷ Bùng Phát Cảm Xúc'],
                                            ['url' => '/tre-tu-ky-quan-tam-cuc-doan-1-chu-de', 'title' => 'Trẻ Tự Kỷ Quan Tâm Cực Đoan 1 Chủ Đề'],
                                            ['url' => '/meltdown-tantrum-o-tre-tu-ky', 'title' => 'Meltdown & Tantrum Ở Trẻ Tự Kỷ'],
                                            ['url' => '/stimming-la-gi-tai-sao-khong-nen-ngan-tre-tu-ky', 'title' => 'Stimming Là Gì?'],
                                            ['url' => '/roi-loan-lo-au-o-tre-tu-ky', 'title' => 'Rối Loạn Lo Âu Ở Trẻ Tự Kỷ'],
                                        ],
                                        '08' => [
                                            ['url' => '/tre-tu-ky-do-tai-ma-sau-khi-an', 'title' => 'Trẻ Tự Kỷ Đỏ Tai/Má Sau Khi Ăn'],
                                            ['url' => '/benh-cham-eczema-o-tre-tu-ky', 'title' => 'Bệnh Chàm Eczema Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-them-gluten-sua', 'title' => 'Trẻ Tự Kỷ Thèm Gluten & Sữa'],
                                            ['url' => '/hanh-vi-tre-tu-ky-thay-doi-sau-an', 'title' => 'Hành Vi Trẻ Tự Kỷ Thay Đổi Sau Ăn'],
                                            ['url' => '/bung-cang-phinh-doi-hanh-vi-o-tre-tu-ky', 'title' => 'Bụng Căng Phình & Đổi Hành Vi Ở Trẻ Tự Kỷ'],
                                            ['url' => '/dai-dam-tai-phat-o-tre-tu-ky', 'title' => 'Đái Dầm Tái Phát Ở Trẻ Tự Kỷ'],
                                            ['url' => '/ige-igg', 'title' => 'IgE & IgG'],
                                            ['url' => '/casein-gluten-anh-huong-khong-bo-tre-tu-ky-ra-sao', 'title' => 'Casein & Gluten Ảnh Hưởng Não Bộ Ra Sao?'],
                                        ],
                                        '09' => [
                                            ['url' => '/tre-tu-ky-hay-om-vat-len-toi-6-8-lan-nam', 'title' => 'Trẻ Tự Kỷ Hay Ốm Vặt Lên Tới 6-8 Lần/Năm'],
                                            ['url' => '/viem-tai-giua-tai-phat-o-tre-tu-ky', 'title' => 'Viêm Tai Giữa Tái Phát Ở Trẻ Tự Kỷ'],
                                            ['url' => '/viem-xoang-tai-phat-o-tre-tu-ky', 'title' => 'Viêm Xoang Tái Phát Ở Trẻ Tự Kỷ'],
                                            ['url' => '/dung-khang-sinh-lien-tiep-anh-huong-tre-tu-ky-the-nao', 'title' => 'Dùng Kháng Sinh Liên Tiếp Ảnh Hưởng Thế Nào?'],
                                            ['url' => '/nhiem-nam-candida-tai-phat-o-tre-tu-ky', 'title' => 'Nhiễm Nấm Candida Tái Phát Ở Trẻ Tự Kỷ'],
                                            ['url' => '/benh-tu-mien-gia-dinh-co-lien-quan-tre-tu-ky-khong', 'title' => 'Bệnh Tự Miễn Gia Đình Có Liên Quan Tự Kỷ?'],
                                            ['url' => '/pandas-pans-la-gi-khi-mien-dich-tan-cong-nao-tre', 'title' => 'PANDAS/PANS Là Gì?'],
                                            ['url' => '/probiotics-cho-tre-tu-ky', 'title' => 'Probiotics Cho Trẻ Tự Kỷ'],
                                        ],
                                        '10' => [
                                            ['url' => '/dom-trang-mong-tay-o-tre-tu-ky', 'title' => 'Đốm Trắng Móng Tay Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tre-tu-ky-toc-mong-rung-nhieu', 'title' => 'Trẻ Tự Kỷ Tóc Mỏng, Rụng Nhiều'],
                                            ['url' => '/tre-tu-ky-an-day-du-nhung-khong-tang-can', 'title' => 'Trẻ Tự Kỷ Ăn Đầy Đủ Nhưng Không Tăng Cân'],
                                            ['url' => '/pica-o-tre-tu-ky', 'title' => 'Pica Ở Trẻ Tự Kỷ'],
                                            ['url' => '/bong-troc-long-ban-chan-o-tre-tu-ky', 'title' => 'Bong Tróc Lòng Bàn Chân Ở Trẻ Tự Kỷ'],
                                            ['url' => '/kem-magie-trong-dieu-tri-tu-ky', 'title' => 'Kẽm, Magie Trong Điều Trị Tự Kỷ'],
                                            ['url' => '/gen-mthfr-methylfolate-b9-o-tre-tu-ky-la-gi', 'title' => 'Gen MTHFR & Methylfolate (B9) Ở Trẻ Tự Kỷ'],
                                            ['url' => '/tai-sao-tre-tu-ky-thuong-thieu-vi-chat-du-an-nhieu', 'title' => 'Tại Sao Trẻ Tự Kỷ Thường Thiếu Vi Chất?'],
                                        ],
                                        '11' => [
                                            ['url' => '/tre-tu-ky-met-moi-li-bi-qua-muc', 'title' => 'Trẻ Tự Kỷ Mệt Mỏi, Li Bì Quá Mức'],
                                            ['url' => '/tre-tu-ky-ngu-kho-day', 'title' => 'Trẻ Tự Kỷ Ngủ Khó Dậy'],
                                            ['url' => '/tre-tu-ky-mat-ky-nang-da-biet-regression', 'title' => 'Trẻ Tự Kỷ Mất Kỹ Năng Đã Biết (Regression)'],
                                            ['url' => '/hanh-vi-tre-tu-ky-doi-theo-gio', 'title' => 'Hành Vi Trẻ Tự Kỷ Đổi Theo Giờ'],
                                            ['url' => '/tre-tu-ky-cham-tang-chieu-cao-can-nang', 'title' => 'Trẻ Tự Kỷ Chậm Tăng Chiều Cao Cân Nặng'],
                                            ['url' => '/roi-loan-ti-the-o-tre-tu-ky', 'title' => 'Rối Loạn Ti Thể Ở Trẻ Tự Kỷ'],
                                            ['url' => '/methyl-hoa-methylation-o-tre-tu-ky-anh-huong-gi', 'title' => 'Methyl Hóa (Methylation) Ảnh Hưởng Gì?'],
                                            ['url' => '/thut-lui-ky-nang-o-tre-tu-ky', 'title' => 'Thụt Lùi Kỹ Năng Ở Trẻ Tự Kỷ'],
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
                                        
                                        <div class="mt-auto pt-4 border-t border-navy/5 shrink-0">
                                            <a href="/<?php echo $symptom['slug']; ?>" class="text-[12px] font-bold text-secondary uppercase tracking-widest flex items-center gap-1.5 hover:text-navy transition-colors">
                                                Xem bài tổng quan Nhóm <?php echo $num; ?> <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
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
                        <a href="/dinh-duong-cho-tre-tu-ky" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">
                            Dinh Dưỡng 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[900px] xl:w-[1050px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium flex relative overflow-hidden">
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

                    <!-- Mega Menu "Chuyên Đề" -->
                    <div class="group h-full flex items-center">
                        <a href="/chuyen-de" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">
                            Chuyên Đề 
                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full left-1/2 -translate-x-1/2 pt-4 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[900px] xl:w-[1000px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex flex-col relative overflow-hidden">
                                <div class="grid grid-cols-4 gap-6 relative z-10">
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-sm uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Hành Vi & Tâm Lý</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/cam-nang-hanh-vi" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Cẩm nang hành vi</a>
                                            <a href="/giai-ma-hoi-chung-pica" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Hội chứng PICA</a>
                                            <a href="/la-het" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">La hét & Khủng hoảng</a>
                                            <a href="/tu-ky-thoai-lui" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Tự kỷ thoái lui</a>
                                            <a href="/tieng-noi-cua-con" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Tiếng nói của con</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-sm uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Não Bộ & Thần Kinh</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/viem-than-kinh" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Viêm thần kinh</a>
                                            <a href="/suong-mu-nao-va-nam" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Sương mù não & Nấm men</a>
                                            <a href="/hieu-ung-opioid" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Hiệu ứng Opioid</a>
                                            <a href="/roi-loan-chuyen-hoa" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Rối loạn chuyển hóa</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-sm uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Thể Chất & Sinh Lý</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/van-dong-tho-tinh" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Vận động thô & tinh</a>
                                            <a href="/chay-nuoc-dai-nhieu" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Chảy nước dãi nhiều</a>
                                            <a href="/dinh-duong-giac-ngu" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Dinh dưỡng & Giấc ngủ</a>
                                            <a href="/duong-tang-dong" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Đường & Tăng động</a>
                                            <a href="/nghe-co-chon-loc" class="text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors">Nghe có chọn lọc</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-sm uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Đánh Giá & Công Cụ</h5>
                                        <div class="flex flex-col gap-2">
                                            <a href="/check-list" class="flex items-center gap-2 text-white bg-secondary hover:bg-secondary_dark text-[13px] font-bold py-2 px-4 rounded-xl shadow-sm transition-all text-center justify-center mt-2"><i data-lucide="check-square" class="w-4 h-4"></i> Checklist Đánh Giá</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
"""

full_desktop_nav = desktop_nav_content + symptoms_menu + the_rest

# 5. Fix CTAs: replace `hidden lg:flex items-center gap-3 xl:gap-4 shrink-0`
# With `hidden lg:flex flex-1 justify-end items-center min-w-0 gap-3 xl:gap-4`
full_desktop_nav = full_desktop_nav.replace(
    '<div class="hidden lg:flex items-center gap-3 xl:gap-4 shrink-0">',
    '<div class="hidden lg:flex flex-1 justify-end items-center min-w-0 gap-3 xl:gap-4">'
)

# Replace the hamburger menu container
full_desktop_nav = full_desktop_nav.replace(
    '<div class="lg:hidden flex items-center">',
    '<div class="lg:hidden flex-1 flex justify-end items-center min-w-0">'
)

# Now for the Mobile Drawer
# I will just write a snippet to insert into the mobile drawer right after the "Sản phẩm" accordion
mobile_menus = """
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

                <!-- Accordion: Chuyên Đề -->
                <div class="flex flex-col border-b border-navy/5">
                    <button id="mobile-chuyende-toggle" aria-expanded="false" class="flex justify-between items-center py-4 text-navy font-bold uppercase tracking-widest text-sm w-full text-left outline-none rounded-lg">
                        <span class="flex items-center gap-3"><i data-lucide="book-open" class="w-4 h-4 text-navy/40"></i> Chuyên Đề</span>
                        <i data-lucide="chevron-down" class="w-4 h-4 text-navy/40 transition-transform duration-300" id="mobile-chuyende-icon"></i>
                    </button>
                    <div id="mobile-chuyende-content" class="hidden flex-col gap-2 pl-4 py-3 bg-white/60 rounded-2xl mb-4 border border-white shadow-[inset_0_2px_4px_rgba(0,0,0,0.02)]">
                        <a href="/chuyen-de" class="text-secondary font-bold text-[13px] py-2 px-3 flex items-center gap-2 hover:text-secondary_dark">Tổng quan Chuyên Đề <i data-lucide="arrow-right" class="w-3 h-3"></i></a>
                    </div>
                </div>
"""

full_desktop_nav = full_desktop_nav.replace(
    '                        <a href="/san-pham" class="text-navy/80 font-bold text-[14px] flex items-center gap-3 px-3 py-2 hover:text-navy"><i data-lucide="box" class="w-4 h-4 text-navy/30"></i> Xem tất cả sản phẩm</a>\n                    </div>\n                </div>\n\n            </div>',
    '                        <a href="/san-pham" class="text-navy/80 font-bold text-[14px] flex items-center gap-3 px-3 py-2 hover:text-navy"><i data-lucide="box" class="w-4 h-4 text-navy/30"></i> Xem tất cả sản phẩm</a>\n                    </div>\n                </div>\n\n' + mobile_menus + '\n            </div>'
)

# Re-inject JS
js_addons = """
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
"""
full_desktop_nav = full_desktop_nav.replace("        setupAccordion('mobile-products-toggle', 'mobile-products-content', 'mobile-products-icon');", js_addons)

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'w') as f:
    f.write(full_desktop_nav)

print("Rebuilt layout-full.php")
