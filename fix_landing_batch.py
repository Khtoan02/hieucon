import re
import os

files = [
    'page-templates/Tre_Tu_Ky_Tao_Bon_Man_Tinh_Landing.php',
    'page-templates/Tre_Tu_Ky_Tieu_Chay_Man_Tinh_Landing.php',
    'page-templates/Tre_Tu_Ky_Chay_Nuoc_Dai_Nhieu_Landing.php'
]

for file_path in files:
    with open(file_path, 'r', encoding='utf-8') as f:
        content = f.read()

    # Skip if it's already using get_header()
    if 'get_header();' in content:
        print(f"Skipping {file_path}, already processed.")
        continue

    # Extract template name
    template_name_match = re.search(r'<\?php\s*/\*\s*Template Name:\s*([^*]+)\s*\*/\s*\?>', content, re.IGNORECASE)
    template_name = template_name_match.group(1).strip() if template_name_match else "Landing Page"

    # Replace custom tailwind colors in the HTML content
    content = re.sub(r'\b(bg|text|border|fill|stroke)-navy\b', r'\1-[#002795]', content)
    content = re.sub(r'\b(bg|text|border|fill|stroke)-yellow\b', r'\1-[#FFD154]', content)
    content = re.sub(r'\b(bg|text|border|fill|stroke)-cream\b', r'\1-[#FAF9F6]', content)
    content = re.sub(r'\b(bg|text|border|fill|stroke)-text-dark\b', r'\1-[#3D3D3D]', content)
    content = re.sub(r'\b(bg|text|border|fill|stroke)-text-soft\b', r'\1-[#555555]', content)

    # Extract body content (everything after <body...> to the end)
    body_match = re.search(r'<body[^>]*>(.*)', content, re.DOTALL | re.IGNORECASE)
    if body_match:
        body_content = body_match.group(1).strip()
        # Remove closing body and html tags if they exist
        body_content = re.sub(r'</body>\s*</html>', '', body_content, flags=re.IGNORECASE)
        # Remove wp_footer calls
        body_content = re.sub(r'<\?php\s*wp_footer\(\);\s*\?>', '', body_content, flags=re.IGNORECASE)
        body_content = re.sub(r'<\?php\s*get_footer\(\);\s*\?>', '', body_content, flags=re.IGNORECASE)
        
        # Now construct the final PHP file
        new_content = f"""<?php /* Template Name: {template_name} */ ?>
<?php get_header(); ?>

<!-- Landing Page Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@400;500;600;700&display=swap" rel="stylesheet">

<!-- Landing Page Styles -->
<style>
    html {{ scroll-behavior: smooth; }}
    details > summary {{ list-style: none; }}
    details > summary::-webkit-details-marker {{ display: none; }}
    details[open] summary ~ * {{ animation: sweep .3s ease-in-out; }}
    @keyframes sweep {{
        0%    {{opacity: 0; margin-top: -10px}}
        100%  {{opacity: 1; margin-top: 0px}}
    }}
    .landing-wrapper h1, .landing-wrapper h2, .landing-wrapper h3, .landing-wrapper h4, .landing-wrapper h5, .landing-wrapper h6 {{ 
        font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; 
    }}
    .font-oswald {{ font-family: 'Oswald', sans-serif !important; }}
    .font-quicksand {{ font-family: 'Quicksand', sans-serif !important; }}
    /* Reset text color for landing page */
    .landing-wrapper {{
        font-family: 'Quicksand', sans-serif;
        color: #3D3D3D;
        background-color: #FAF9F6;
    }}
</style>

<div class="landing-wrapper antialiased leading-relaxed relative z-10 bg-white">
{body_content}
</div>

<?php get_footer(); ?>
"""
        with open(file_path, 'w', encoding='utf-8') as f:
            f.write(new_content)
        print(f"Processed {file_path}")
    else:
        print(f"Could not find body tag in {file_path}")

