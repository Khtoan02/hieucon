import re

file_path = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/template-parts/header/layout-full.php'
with open(file_path, 'r') as f:
    content = f.read()

# 1. Change the main "Triệu Chứng Tự Kỷ" button to an anchor tag
content = content.replace(
    '<button class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">\n                            Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </button>',
    '<a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="text-navy/70 hover:text-navy group-hover:text-secondary font-bold transition-colors text-xs xl:text-sm uppercase tracking-[0.1em] xl:tracking-[0.15em] flex items-center gap-1.5 py-4 outline-none focus-visible:ring-2 focus-visible:ring-secondary rounded-sm px-1" aria-expanded="false" aria-haspopup="true">\n                            Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </a>'
)

# Wait, the exact string might be different. Let's use regex for the button to a.
pattern_button = re.compile(r'<button class="([^"]*?uppercase[^"]*?)".*?>\s*Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\s*<i data-lucide="chevron-down".*?</i>\s*</button>', re.DOTALL)
content = pattern_button.sub(r'<a href="/11-nhom-trieu-chung-tu-ky-toan-than" class="\1" aria-expanded="false" aria-haspopup="true">\n                            Triệu Chứng <span class="hidden xl:inline">Tự Kỷ</span>\n                            <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-300 group-hover:-rotate-180" aria-hidden="true"></i>\n                        </a>', content)

# 2. Fix the overview URLs. We need a mapping.
overview_links = {
    '01': '/van-dong-tho-tinh-o-tre-tu-ky',
    '02': '/van-dong-mieng-hong-tre-tu-ky',
    '03': '/tieu-hoa-da-day-tre-tu-ky',
    '04': '/xu-ly-cam-giac-o-tre-tu-ky',
    '05': '/ngon-ngu-giao-tiep-tre-tu-ky',
    '06': '/nhan-thuc-hoc-tap-tre-tu-ky',
    '07': '/hanh-vi-xa-hoi-tre-tu-ky',
    '08': '/di-ung-nhay-cam-thuc-pham-tre-tu-ky',
    '09': '/he-mien-dich-tre-tu-ky',
    '10': '/dinh-duong-vi-chat-o-tre-tu-ky',
    '11': '/nang-luong-chuyen-hoa-o-tre-tu-ky'
}

# In the left pane loop:
# <?php $tab_url = ($num === '03') ? '/tieu-hoa-da-day-tre-tu-ky' : '/trieu-chung/nhom-' . $num; ?>
# We should replace this logic with an array lookup.
new_tab_url_logic = """
                                        <?php
                                        $overview_links = [
                                            '01' => '/van-dong-tho-tinh-o-tre-tu-ky',
                                            '02' => '/van-dong-mieng-hong-tre-tu-ky',
                                            '03' => '/tieu-hoa-da-day-tre-tu-ky',
                                            '04' => '/xu-ly-cam-giac-o-tre-tu-ky',
                                            '05' => '/ngon-ngu-giao-tiep-tre-tu-ky',
                                            '06' => '/nhan-thuc-hoc-tap-tre-tu-ky',
                                            '07' => '/hanh-vi-xa-hoi-tre-tu-ky',
                                            '08' => '/di-ung-nhay-cam-thuc-pham-tre-tu-ky',
                                            '09' => '/he-mien-dich-tre-tu-ky',
                                            '10' => '/dinh-duong-vi-chat-o-tre-tu-ky',
                                            '11' => '/nang-luong-chuyen-hoa-o-tre-tu-ky'
                                        ];
                                        $tab_url = $overview_links[$num];
                                        ?>"""

content = re.sub(r'<\?php\s*\$tab_url\s*=\s*.*?;\s*\?>', new_tab_url_logic.strip(), content)

# 3. In the right pane, we must remove the first item from each array in symptom_groups_links.
# Actually, it's easier to just slice the array when we loop: `foreach(array_slice($symptom_groups_links['01'], 1) as $link)`
# Or, modify the python script to physically remove the first item from the array definitions.
# Let's replace the first element of each group in the PHP array definition with an empty string or just remove it using regex.
# Actually, since I generated the array, let's just find and replace the specific lines or use regex.
for grp, overview in overview_links.items():
    # Remove the first item which contains the overview link
    pattern = re.compile(r"'" + grp + r"' => \[\s*\['url' => '" + overview.replace('/', '\/') + r"', 'title' => '[^']*'\],\s*")
    content = pattern.sub(f"'{grp}' => [\n            ", content)

# 4. In the right pane loops, replace the `href="{overview_url}"` with the proper overview URL.
for grp, overview in overview_links.items():
    # Find <a href="/trieu-chung/nhom-01" class="flex items-center gap-3 mb-4...
    # and <a href="/trieu-chung/nhom-01" class="text-[12px] font-bold text-secondary...
    content = content.replace(f'href="/trieu-chung/nhom-{grp}"', f'href="{overview}"')

with open(file_path, 'w') as f:
    f.write(content)

print("Done fixing links.")
