with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'r') as f:
    content = f.read()

# 1. Remove the old Mega Menu "Chuyên Đề" from the middle nav
# We need to find `<!-- Mega Menu "Chuyên Đề" -->` and remove everything until its closing `</div>`
start_marker = '<!-- Mega Menu "Chuyên Đề" -->'
end_marker = '                    </div>\n\n                    </nav>'

import re
# Regex to match the Chuyên Đề block before </nav>
pattern = re.compile(r'<!-- Mega Menu "Chuyên Đề" -->.*?(?=</div>\n\n                    </nav>)', re.DOTALL)
content = pattern.sub('', content)

# 2. Replace the CTA button with the Mega Menu integrated CTA
old_cta = """<a href="/chuyen-de" class="group relative flex items-center gap-2 xl:gap-2.5 bg-white/80 hover:bg-white border border-white hover:border-secondary/40 pl-1.5 pr-3 xl:pr-4 py-1 xl:py-1.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant">
                        <div class="bg-secondary/10 p-1.5 xl:p-2 rounded-full text-secondary group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                            <i data-lucide="book-open" class="w-3.5 h-3.5 xl:w-4 xl:h-4"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="font-extrabold text-navy text-[10px] xl:text-[12px] leading-tight group-hover:text-secondary transition-colors">Tài liệu Y sinh</span>
                            <span class="text-[7px] xl:text-[9px] font-extrabold text-navy/50 uppercase tracking-wider xl:tracking-widest mt-0.5 group-hover:text-navy">Các chuyên đề chuyên sâu</span>
                        </div>
                    </a>"""

new_cta_with_mega = """<!-- Nút 1: Chuyên đề (Tài liệu Y Sinh) WITH MEGA MENU -->
                    <div class="group h-full flex items-center relative">
                        <a href="/chuyen-de" class="group/cta relative flex items-center gap-2 xl:gap-2.5 bg-white/80 hover:bg-white border border-white hover:border-secondary/40 pl-1.5 pr-3 xl:pr-4 py-1 xl:py-1.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant outline-none focus-visible:ring-2 focus-visible:ring-secondary">
                            <div class="bg-secondary/10 p-1.5 xl:p-2 rounded-full text-secondary group-hover/cta:bg-secondary group-hover/cta:text-white transition-colors duration-300">
                                <i data-lucide="book-open" class="w-3.5 h-3.5 xl:w-4 xl:h-4"></i>
                            </div>
                            <div class="flex flex-col text-left">
                                <span class="font-extrabold text-navy text-[10px] xl:text-[12px] leading-tight group-hover/cta:text-secondary transition-colors">Tài liệu Y sinh</span>
                                <span class="text-[7px] xl:text-[9px] font-extrabold text-navy/50 uppercase tracking-wider xl:tracking-widest mt-0.5 group-hover/cta:text-navy">Các chuyên đề chuyên sâu</span>
                            </div>
                        </a>
                        
                        <!-- Dropdown Panel -->
                        <div class="absolute top-full right-0 pt-5 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 transform translate-y-3 group-hover:translate-y-0 w-[900px] xl:w-[1000px] z-50">
                            <div class="mega-bridge glass-megamenu rounded-[2rem] shadow-premium p-6 xl:p-8 flex flex-col relative overflow-hidden">
                                <div class="grid grid-cols-4 gap-6 relative z-10 text-left">
                                    
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
                    </div>"""

content = content.replace(old_cta, new_cta_with_mega)

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'w') as f:
    f.write(content)

print("Merged Chuyên Đề Mega Menu into CTA")
