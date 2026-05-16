import re

# Fix layout-default.php
file_path_default = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-default.php'
with open(file_path_default, 'r') as f:
    content = f.read()

# 1. Remove Desktop Mega Menus (Triệu Chứng, Dinh Dưỡng, Chuyên Đề) in layout-default.php
# These are between <!-- Mega Menu "Triệu Chứng" (HIERARCHICAL TABS) --> and <!-- 3. CTAs (Nút chức năng bên phải) -->
pattern_desktop_menus = re.compile(r'<!-- Mega Menu "Triệu Chứng".*?</nav>', re.DOTALL)
content = pattern_desktop_menus.sub('</nav>', content)

# 2. Remove Desktop CTA "Cẩm nang" in layout-default.php
pattern_desktop_cta = re.compile(r'<!-- Nút 1: Cẩm nang -->.*?<!-- Nút 2: Tham gia nhóm -->', re.DOTALL)
content = pattern_desktop_cta.sub('<!-- Nút 2: Tham gia nhóm -->', content)

# 3. Remove Mobile Accordions (Triệu Chứng, Dinh Dưỡng, Chuyên Đề) in layout-default.php
# Starts at <!-- Accordion: Triệu Chứng (HIERARCHICAL) --> and ends before <!-- 3. CTAs (Nút chức năng bên phải) -->
# Actually it ends before: <div class="p-5 flex flex-col gap-3 mt-auto border-t border-white bg-white/80 backdrop-blur-md pb-8">
pattern_mobile_accordions = re.compile(r'<!-- Accordion: Triệu Chứng \(HIERARCHICAL\).*?</div>\s*</div>\s*<div class="p-5 flex flex-col', re.DOTALL)
content = pattern_mobile_accordions.sub('</div>\n\n            <div class="p-5 flex flex-col', content)

# 4. Remove Mobile CTA "Cẩm nang" in layout-default.php
pattern_mobile_cta = re.compile(r'<a href="/thuc-don-giac-ngu".*?</a>\s*<a href="https://www.facebook.com/groups', re.DOTALL)
content = pattern_mobile_cta.sub('<a href="https://www.facebook.com/groups', content)

with open(file_path_default, 'w') as f:
    f.write(content)

# Fix layout-full.php
file_path_full = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php'
with open(file_path_full, 'r') as f:
    content_full = f.read()

# Fix spacing on Desktop Nav to prevent overlapping
content_full = content_full.replace('space-x-6 xl:space-x-8 2xl:space-x-10', 'space-x-4 lg:space-x-5 xl:space-x-6')

# To be even safer, make the CTA button on desktop slightly smaller or remove text on lg
# The CTA is: <span class="hidden xl:inline">Tham gia nhóm</span>
# The Cẩm nang CTA is also large. I'll make the text sizes a bit smaller on lg if needed, but reducing gap should help a lot.

with open(file_path_full, 'w') as f:
    f.write(content_full)

print("Done fixing headers")
