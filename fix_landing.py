import re

file_path = 'page-templates/van-dong-tho-tinh-o-tre-tu-ky_Landing.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace custom tailwind colors in the HTML content
# Only replace instances of 'navy', 'yellow', 'cream' when they are used in tailwind classes
# like bg-navy, text-navy, border-yellow, etc.
content = re.sub(r'\b(bg|text|border|fill|stroke)-navy\b', r'\1-[#002795]', content)
content = re.sub(r'\b(bg|text|border|fill|stroke)-yellow\b', r'\1-[#FFD154]', content)
content = re.sub(r'\b(bg|text|border|fill|stroke)-cream\b', r'\1-[#FAF9F6]', content)
content = re.sub(r'\b(bg|text|border|fill|stroke)-text-dark\b', r'\1-[#3D3D3D]', content)
content = re.sub(r'\b(bg|text|border|fill|stroke)-text-soft\b', r'\1-[#555555]', content)

# Extract body content (everything after <body...> to the end, removing get_footer if present)
body_match = re.search(r'<body[^>]*>(.*)', content, re.DOTALL | re.IGNORECASE)
if body_match:
    body_content = body_match.group(1).strip()
    # Remove closing body and html tags if they exist
    body_content = re.sub(r'</body>\s*</html>', '', body_content, flags=re.IGNORECASE)
    # Remove <?php get_footer(); ?> if it exists because we will add it back
    body_content = re.sub(r'<\?php\s*get_footer\(\);\s*\?>', '', body_content, flags=re.IGNORECASE)
    
    # Now construct the final PHP file
    new_content = """<?php /* Template Name: Van_Dong_Tho_Va_Tinh_O_Tre_Tu_Ky_Landing */ ?>
<?php get_header(); ?>

<!-- Landing Page Styles -->
<style>
    html { scroll-behavior: smooth; }
    details > summary { list-style: none; }
    details > summary::-webkit-details-marker { display: none; }
    details[open] summary ~ * { animation: sweep .3s ease-in-out; }
    @keyframes sweep {
        0%    {opacity: 0; margin-top: -10px}
        100%  {opacity: 1; margin-top: 0px}
    }
    .landing-wrapper h1, .landing-wrapper h2, .landing-wrapper h3, .landing-wrapper h4, .landing-wrapper h5, .landing-wrapper h6 { 
        font-family: 'Oswald', sans-serif; 
        line-height: 1.4 !important; 
    }
    /* Reset text color for landing page */
    .landing-wrapper {
        font-family: 'Quicksand', sans-serif;
        color: #3D3D3D;
        background-color: #FAF9F6;
    }
</style>

<div class="landing-wrapper antialiased leading-relaxed relative z-10 bg-white">
""" + body_content + """
</div>

<?php get_footer(); ?>
"""
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Done")
else:
    print("Could not find body tag")

