import re

with open('footer.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace tailwind classes
content = content.replace('from-navy', 'from-[#0A1931]')
content = content.replace('text-navy', 'text-[#0A1931]')
content = content.replace('text-secondary', 'text-[#f97316]')
content = content.replace('border-secondary/60', 'border-[#f97316]/60')
content = content.replace('hover:bg-secondary', 'hover:bg-[#f97316]')
content = content.replace('bg-secondary', 'bg-[#f97316]')
content = content.replace('bg-secondary/90', 'bg-[#f97316]/90')

with open('footer.php', 'w', encoding='utf-8') as f:
    f.write(content)
