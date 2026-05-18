import re

file_path = '/Applications/ServBay/www/dawnbridge/wp-content/themes/hieucon/page-templates/Tre_Tu_Ky_Chay_Nuoc_Dai_Nhieu_Landing.php'

with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

replacements = {
    r'text-\[\#002795\]': 'text-navy',
    r'bg-\[\#002795\]': 'bg-navy',
    r'border-\[\#002795\]': 'border-navy',
    
    r'text-\[\#FFD154\]': 'text-yellow',
    r'bg-\[\#FFD154\]': 'bg-yellow',
    r'border-\[\#FFD154\]': 'border-yellow',
    
    r'text-\[\#FAF9F6\]': 'text-cream',
    r'bg-\[\#FAF9F6\]': 'bg-cream',
    r'border-\[\#FAF9F6\]': 'border-cream',
    
    r'text-\[\#3D3D3D\]': 'text-text-dark',
    r'bg-\[\#3D3D3D\]': 'bg-text-dark',
    
    r'text-\[\#555555\]': 'text-text-soft',
    r'bg-\[\#555555\]': 'bg-text-soft',
}

for pattern, replacement in replacements.items():
    content = re.sub(pattern, replacement, content, flags=re.IGNORECASE)

with open(file_path, 'w', encoding='utf-8') as f:
    f.write(content)

print("Colors updated successfully.")
