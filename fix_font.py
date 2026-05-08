import re

with open('footer.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Add Google Fonts link if not present
fonts_link = '<link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">\n'

if 'fonts.googleapis.com/css2?family=Lora' not in content:
    content = content.replace('<footer id="colophon"', fonts_link + '    <footer id="colophon"')

# Replace font-serif
content = content.replace('font-serif', "[font-family:'Lora',_serif]")

with open('footer.php', 'w', encoding='utf-8') as f:
    f.write(content)
