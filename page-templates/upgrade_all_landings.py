import os
import re
import random

base_path = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/page-templates/'

images_pool = [
    'choking_hero_img_1779078758367.png',
    'stuffing_hero_img_1779078774052.png',
    'articulation_hero_img_1779078788806.png',
    'oral_motor_weakness_hero_img_1779078815111.png',
    'oral_motor_therapy_hero_img_1779078827681.png',
    'language_vs_speech_img_1779079183423.png',
    'vat_ly_tri_lieu_hero_vi_1779077058220.png'
]

files = [f for f in os.listdir(base_path) if f.endswith('Landing.php')]

updated_count = 0

for f in files:
    full_path = os.path.join(base_path, f)
    with open(full_path, 'r', encoding='utf-8') as file:
        content = file.read()
    
    if 'id="hero-section"' in content:
        # Already upgraded
        # Just check for line-height and body bg
        if 'background-color: #FAF9F6;' not in content:
            content = re.sub(r'body\s*{[^}]*}', r'body { font-family: \'Quicksand\', sans-serif; background-color: #FAF9F6; }', content)
        if 'line-height: 1.4 !important;' not in content:
            content = re.sub(r'</style>', r'    h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }\n    </style>', content)
        with open(full_path, 'w', encoding='utf-8') as file:
            file.write(content)
        continue

    # Try to extract H1 and P
    # We find the first <section> or <header> that contains <h1
    hero_pattern = r'<(section|header|div)[^>]*class=\"[^\"]*bg-navy[^\"]*\"[^>]*>.*?<h1[^>]*>(.*?)</h1>.*?<p[^>]*>(.*?)</p>.*?</\1>'
    hero_match = re.search(hero_pattern, content, flags=re.DOTALL | re.IGNORECASE)
    
    if not hero_match:
        # Try a more forgiving match for just H1 and P
        h1_match = re.search(r'<h1[^>]*>(.*?)</h1>', content, re.DOTALL | re.IGNORECASE)
        p_match = re.search(r'</h1>\s*.*?<p[^>]*>(.*?)</p>', content, re.DOTALL | re.IGNORECASE)
        if h1_match and p_match:
            h1_text = h1_match.group(1).strip()
            p_text = p_match.group(1).strip()
            # Find the outer container to replace
            container_match = re.search(r'<(section|header|div)[^>]*>.*?<h1.*?</\1>', content, flags=re.DOTALL | re.IGNORECASE)
            if container_match:
                hero_match = container_match
            else:
                continue
        else:
            print(f'Cannot parse Hero for {f}')
            continue
    else:
        h1_text = hero_match.group(2).strip()
        p_text = hero_match.group(3).strip()

    # Extract CTA if any
    a_match = re.search(r'<a[^>]*href=\"([^\"]+)\"[^>]*>(.*?)</a>', hero_match.group(0), flags=re.DOTALL | re.IGNORECASE)
    a_href = a_match.group(1).strip() if a_match else 'https://hieucontugoc.online/bang-kiem-tra-suc-khoe-toan-dien/'
    a_text = a_match.group(2).strip() if a_match else 'KIỂM TRA SỨC KHỎE TOÀN DIỆN CHO CON'

    # Clean HTML from h1 and p
    h1_text = re.sub(r'<[^>]+>', '', h1_text)
    p_text = re.sub(r'<[^>]+>', '', p_text)

    # Random image
    img = random.choice(images_pool)

    new_hero = f'''<!-- HERO SECTION -->
    <section class=\"relative bg-navy pt-32 pb-24 md:pt-40 md:pb-32 px-6 overflow-hidden\" id=\"hero-section\">
        <div class=\"absolute top-0 left-0 w-full h-full overflow-hidden z-0\">
            <div class=\"absolute -top-24 -left-24 w-96 h-96 bg-[#2563eb] rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-[blob_7s_infinite]\"></div>
            <div class=\"absolute top-1/4 -right-24 w-96 h-96 bg-yellow rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-[blob_7s_infinite_2s]\"></div>
        </div>
        
        <div class=\"max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-12 items-center relative z-10\">
            <div class=\"text-left\">
                <div class=\"inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[rgba(255,255,255,0.1)] backdrop-blur-md border border-solid border-[rgba(255,255,255,0.2)] text-cream text-sm font-semibold mb-6\">
                    <span class=\"w-2 h-2 rounded-full bg-yellow animate-pulse\"></span>
                    Góc Nhìn Chuyên Gia
                </div>
                <h1 class=\"font-oswald text-4xl md:text-5xl lg:text-5xl font-bold leading-tight mb-6 text-white tracking-wide uppercase\">
                    {h1_text}
                </h1>
                <p class=\"font-quicksand text-lg md:text-xl leading-relaxed text-[rgba(250,249,246,0.9)] mb-8 font-light\">
                    {p_text}
                </p>
                <a href=\"{a_href}\" class=\"inline-block bg-yellow text-navy font-bold px-8 py-4 rounded-full shadow-lg hover:scale-105 hover:shadow-xl transition-all text-lg\">
                    {a_text}
                </a>
            </div>
            
            <div class=\"relative hidden lg:block\">
                <div class=\"absolute inset-0 bg-[rgba(255,209,84,0.2)] rounded-3xl transform rotate-2 scale-105\"></div>
                <img src=\"<?php echo get_stylesheet_directory_uri(); ?>/assets/images/{img}\" alt=\"Hero Image\" class=\"relative rounded-3xl shadow-[0_25px_50px_-12px_rgba(0,0,0,0.25)] border border-solid border-[rgba(255,255,255,0.1)] object-cover w-full h-auto\" />
            </div>
        </div>
    </section>'''
    
    content = content.replace(hero_match.group(0), new_hero)

    # 1. Header replacement
    # Some pages start with <?php get_header(); ?> but no head.
    if '<?php get_header(); ?>' not in content:
        content = re.sub(r'<\!DOCTYPE html>\s*<html lang=\"vi\">\s*<head>', '<?php get_header(); ?>\n<head>', content)

    # Make sure style has the needed rules
    if 'background-color: #FAF9F6;' not in content:
        if '<style>' in content:
            content = re.sub(r'<style>', r'<style>\n        body { font-family: \'Quicksand\', sans-serif; background-color: #FAF9F6; }\n        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }', content)
        else:
            content = content.replace('</head>', '<style>\n        body { font-family: \'Quicksand\', sans-serif; background-color: #FAF9F6; }\n        h1, h2, h3, h4, h5, h6 { font-family: \'Oswald\', sans-serif; line-height: 1.4 !important; }\n    </style>\n</head>')

    # Footer
    if '<?php get_footer(); ?>' not in content:
        content = re.sub(r'</body>\s*</html>', '<?php get_footer(); ?>\n</body>\n</html>', content)
        
    with open(full_path, 'w', encoding='utf-8') as file:
        file.write(content)
    
    print(f'SUCCESS: {f}')
    updated_count += 1

print(f'Total pages upgraded: {updated_count}')
