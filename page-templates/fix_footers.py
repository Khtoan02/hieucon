import os
import glob
import re

os.chdir('/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/page-templates')

files = glob.glob('*.php')
updated_count = 0

for f in files:
    with open(f, 'r', encoding='utf-8') as file:
        content = file.read()
    
    old_content = None
    new_content = content
    while old_content != new_content:
        old_content = new_content
        new_content = new_content.strip()
        new_content = re.sub(r'(?i)</body>$', '', new_content).strip()
        new_content = re.sub(r'(?i)</html>$', '', new_content).strip()
        new_content = re.sub(r'<\?php\s+wp_footer\(\);\s*\?>$', '', new_content).strip()
        new_content = re.sub(r'<\?php\s+get_footer\(\);\s*\?>$', '', new_content).strip()
    
    final_content = new_content + '\n\n<?php get_footer(); ?>\n'
    
    if final_content != content:
        with open(f, 'w', encoding='utf-8') as file:
            file.write(final_content)
        updated_count += 1
        print(f"Updated {f}")

print(f"Total updated files: {updated_count}")
