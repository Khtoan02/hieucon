<?php
/**
 * Template Name: Check List tổng quan hành vi của trẻ
 * 
 * @package Hieucon
 */
$is_start = isset($_GET['start']);
get_header();
?>

<!-- Landing Page Head Assets -->
<link
  href="https://fonts.googleapis.com/css2?family=Oswald:wght@400;500;600;700&family=Quicksand:wght@300;400;500;600;700&display=swap"
  rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  tailwind.config = {
    corePlugins: {
      preflight: false,
    },
    theme: {
      extend: {
        colors: {
          navy: '#002795',
          yellow: '#FFD154',
          cream: '#FAF9F6',
          'text-dark': '#3D3D3D',
          'text-soft': '#555555'
        },
        fontFamily: {
          oswald: ['Oswald', 'sans-serif'],
          quicksand: ['Quicksand', 'sans-serif']
        }
      }
    }
  }
</script>

<?php
// Include style rules
include get_template_directory() . '/page-templates/parts-checklist/styles.php';

// Include HTML markup layout split into steps
include get_template_directory() . '/page-templates/parts-checklist/intro.php';
include get_template_directory() . '/page-templates/parts-checklist/child-info.php';
include get_template_directory() . '/page-templates/parts-checklist/checklist-survey.php';
include get_template_directory() . '/page-templates/parts-checklist/success.php';
include get_template_directory() . '/page-templates/parts-checklist/result-page.php';

// Include Javascript modules and initialization
include get_template_directory() . '/page-templates/parts-checklist/scripts.php';
?>
</div>
<?php get_footer(); ?>