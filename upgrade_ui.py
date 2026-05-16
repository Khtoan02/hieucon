import re

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'r') as f:
    content = f.read()

# 1. Upgrade Center Nav Links (Add hover underline animation and refine typography)
# Replace Sản phẩm link
content = content.replace(
    '<button class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1"',
    '<button class="text-navy/80 hover:text-navy group-hover:text-secondary font-extrabold transition-colors text-[12px] xl:text-[13px] uppercase tracking-[0.15em] flex items-center gap-1.5 py-5 relative outline-none px-2"'
)
# Add underline to Sản phẩm
content = content.replace(
    'Sản phẩm \n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </button>',
    'Sản phẩm \n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>\n                        </button>'
)

# Replace Triệu Chứng link
content = content.replace(
    '<a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1"',
    '<a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="text-navy/80 hover:text-navy group-hover:text-secondary font-extrabold transition-colors text-[12px] xl:text-[13px] uppercase tracking-[0.15em] flex items-center gap-1.5 py-5 relative outline-none px-2"'
)
content = content.replace(
    'Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </a>',
    'Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>\n                        </a>'
)

# Replace Dinh Dưỡng link
content = content.replace(
    '<a href="/dinh-duong-cho-tre-tu-ky" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1"',
    '<a href="/dinh-duong-cho-tre-tu-ky" class="text-navy/80 hover:text-navy group-hover:text-secondary font-extrabold transition-colors text-[12px] xl:text-[13px] uppercase tracking-[0.15em] flex items-center gap-1.5 py-5 relative outline-none px-2"'
)
content = content.replace(
    'Dinh Dưỡng \n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </a>',
    'Dinh Dưỡng \n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                            <span class="absolute bottom-0 left-1/2 -translate-x-1/2 w-0 h-[3px] bg-secondary transition-all duration-300 group-hover:w-full opacity-0 group-hover:opacity-100 rounded-t-md"></span>\n                        </a>'
)

# 2. Redesign the CTAs block to be symmetric and highly premium
old_cta_block_pattern = re.compile(r'<!-- 3\. CTAs \(Nút chức năng bên phải\) -->\s*<div class="hidden lg:flex flex-1 justify-end items-center min-w-0 gap-3 xl:gap-4">.*?</div>\s*<!-- Nút Hamburger', re.DOTALL)

new_cta_block = """<!-- 3. CTAs (Nút chức năng bên phải) -->
                <div class="hidden lg:flex flex-1 justify-end items-center min-w-0 gap-3">
                    
                    <!-- Nút 1: Chuyên đề (Tài liệu Y Sinh) WITH MEGA MENU -->
                    <div class="group h-full flex items-center relative">
                        <a href="/chuyen-de" class="flex items-center gap-2 bg-[#f8fafc] hover:bg-white border border-navy/5 hover:border-secondary/30 px-4 xl:px-5 py-2.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant outline-none">
                            <i data-lucide="book-open" class="w-4 h-4 text-secondary"></i>
                            <span class="font-extrabold text-navy text-[11px] xl:text-[12px] uppercase tracking-wider">Tài liệu Y sinh</span>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full right-0 pt-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[900px] xl:w-[1000px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex flex-col relative overflow-hidden">
                                <div class="grid grid-cols-4 gap-6 relative z-10 text-left">
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[13px] uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Hành Vi & Tâm Lý</h5>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/cam-nang-hanh-vi" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Cẩm nang hành vi</a>
                                            <a href="/giai-ma-hoi-chung-pica" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Hội chứng PICA</a>
                                            <a href="/la-het" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> La hét & Khủng hoảng</a>
                                            <a href="/tu-ky-thoai-lui" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Tự kỷ thoái lui</a>
                                            <a href="/tieng-noi-cua-con" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Tiếng nói của con</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[13px] uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Não Bộ & Thần Kinh</h5>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/viem-than-kinh" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Viêm thần kinh</a>
                                            <a href="/suong-mu-nao-va-nam" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Sương mù não & Nấm men</a>
                                            <a href="/hieu-ung-opioid" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Hiệu ứng Opioid</a>
                                            <a href="/roi-loan-chuyen-hoa" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Rối loạn chuyển hóa</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[13px] uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Thể Chất & Sinh Lý</h5>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/van-dong-tho-tinh" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Vận động thô & tinh</a>
                                            <a href="/chay-nuoc-dai-nhieu" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Chảy nước dãi nhiều</a>
                                            <a href="/dinh-duong-giac-ngu" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Dinh dưỡng & Giấc ngủ</a>
                                            <a href="/duong-tang-dong" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Đường & Tăng động</a>
                                            <a href="/nghe-co-chon-loc" class="group/link flex items-center gap-2 text-navy/80 hover:text-secondary text-[13px] font-bold py-1 transition-colors"><div class="w-1.5 h-1.5 rounded-full bg-navy/20 group-hover/link:bg-secondary"></div> Nghe có chọn lọc</a>
                                        </div>
                                    </div>
                                    
                                    <div class="flex flex-col">
                                        <h5 class="text-secondary font-bold text-[13px] uppercase tracking-wider mb-4 border-b border-navy/5 pb-2">Đánh Giá & Công Cụ</h5>
                                        <div class="flex flex-col gap-2.5">
                                            <a href="/check-list" class="flex items-center gap-2 text-white bg-secondary hover:bg-secondary_dark text-[13px] font-bold py-3 px-5 rounded-xl shadow-md transition-all text-center justify-center mt-2 group/check"><i data-lucide="check-square" class="w-4 h-4 group-hover/check:scale-110 transition-transform"></i> Checklist Đánh Giá</a>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Nút 2: Tham gia nhóm -->
                    <a href="https://www.facebook.com/groups/tukylaroiloantoanthan" target="_blank" rel="noopener noreferrer" class="flex items-center gap-2 bg-navy hover:bg-navy-light text-white px-4 xl:px-5 py-2.5 rounded-full font-extrabold transition-all duration-300 shadow-md hover:shadow-lg text-[11px] xl:text-[12px] uppercase tracking-wider group">
                        <i data-lucide="users" class="w-4 h-4 text-secondary group-hover:scale-110 transition-transform"></i>
                        <span class="hidden xl:inline">Tham gia nhóm</span>
                        <span class="xl:hidden">Tham gia</span>
                    </a>
                </div>
                <!-- Nút Hamburger"""

content = old_cta_block_pattern.sub(new_cta_block, content)

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'w') as f:
    f.write(content)

print("Upgraded UX/UI of layout-full.php")
