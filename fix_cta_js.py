with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'r') as f:
    content = f.read()

# Fix JS:
# symptomPanes.forEach(p => p.classList.add('hidden')); -> add remove('flex')
content = content.replace(
    "symptomPanes.forEach(p => p.classList.add('hidden'));",
    "symptomPanes.forEach(p => { p.classList.add('hidden'); p.classList.remove('flex'); });"
)
# Note: we have TWO blocks of this JS in layout-full.php because my previous script duplicated it!
# I will just replace all instances.

# And change the CTA:
old_cta = """<a href="/thuc-don-giac-ngu" class="group relative flex items-center gap-2 xl:gap-2.5 bg-white/80 hover:bg-white border border-white hover:border-secondary/40 pl-1.5 pr-3 xl:pr-4 py-1 xl:py-1.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant">
                        <div class="bg-secondary/10 p-1.5 xl:p-2 rounded-full text-secondary group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                            <i data-lucide="book-open-text" class="w-3.5 h-3.5 xl:w-4 xl:h-4"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="font-extrabold text-navy text-[10px] xl:text-[12px] leading-tight group-hover:text-secondary transition-colors">Cẩm nang dinh dưỡng</span>
                            <span class="text-[7px] xl:text-[9px] font-extrabold text-navy/50 uppercase tracking-wider xl:tracking-widest mt-0.5 group-hover:text-navy">Giấc ngủ cho trẻ tự kỷ</span>
                        </div>
                    </a>"""

new_cta = """<a href="/chuyen-de" class="group relative flex items-center gap-2 xl:gap-2.5 bg-white/80 hover:bg-white border border-white hover:border-secondary/40 pl-1.5 pr-3 xl:pr-4 py-1 xl:py-1.5 rounded-full transition-all duration-300 shadow-sm hover:shadow-elegant">
                        <div class="bg-secondary/10 p-1.5 xl:p-2 rounded-full text-secondary group-hover:bg-secondary group-hover:text-white transition-colors duration-300">
                            <i data-lucide="book-open" class="w-3.5 h-3.5 xl:w-4 xl:h-4"></i>
                        </div>
                        <div class="flex flex-col text-left">
                            <span class="font-extrabold text-navy text-[10px] xl:text-[12px] leading-tight group-hover:text-secondary transition-colors">Tài liệu Y sinh</span>
                            <span class="text-[7px] xl:text-[9px] font-extrabold text-navy/50 uppercase tracking-wider xl:tracking-widest mt-0.5 group-hover:text-navy">Các chuyên đề chuyên sâu</span>
                        </div>
                    </a>"""

content = content.replace(old_cta, new_cta)

with open('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php', 'w') as f:
    f.write(content)

print("Fixed layout-full.php")
