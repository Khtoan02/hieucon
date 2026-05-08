import re

file_path = 'page-templates/checklist_landing.php'
with open(file_path, 'r', encoding='utf-8') as f:
    content = f.read()

# Replace <!DOCTYPE html> ... <head> ... <body> with get_header()
# We need to extract everything inside <style> and <script> in the head, if any.
head_match = re.search(r'<head>(.*?)</head>', content, re.DOTALL | re.IGNORECASE)
body_match = re.search(r'<body[^>]*>(.*)', content, re.DOTALL | re.IGNORECASE)

if head_match and body_match:
    head_content = head_match.group(1).strip()
    
    # Extract just the <style> and <link> from head
    links = re.findall(r'<link[^>]*>', head_content, re.IGNORECASE)
    styles = re.findall(r'<style>.*?</style>', head_content, re.DOTALL | re.IGNORECASE)
    
    links_str = '\n'.join(links)
    styles_str = '\n'.join(styles)

    body_content = body_match.group(1).strip()
    # Remove closing tags
    body_content = re.sub(r'</body>\s*</html>', '', body_content, flags=re.IGNORECASE)
    body_content = re.sub(r'<\?php\s*get_footer\(\);\s*\?>', '', body_content, flags=re.IGNORECASE)

    new_content = f"""<?php
/**
 * Template Name: Check List tổng quan hành vi của trẻ
 * 
 * @package Hieucon
 */
get_header();
?>

<!-- Landing Page Head Assets -->
{links_str}
{styles_str}

<div class="landing-checklist-wrapper antialiased relative z-10 bg-[var(--cream)] text-[var(--charcoal)] font-['Be_Vietnam_Pro',_sans-serif]">
{body_content}
</div>

<?php get_footer(); ?>
"""
    with open(file_path, 'w', encoding='utf-8') as f:
        f.write(new_content)
    print("Done checklist")
else:
    print("Could not parse checklist")
