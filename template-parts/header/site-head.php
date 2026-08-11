<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="h61OLPtQuXHYPDSmBL1rTgHiQ5AA4Y7irbKTbEpmG98" />
    <meta name="google-site-verification" content="Jae7HEZAmpvimQlqC_16GUHrVA_68FfoQS4fUYSqn1g" />
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <?php
    $is_sub_checklist_page = is_singular('hieucon_sub_chk') || (strpos($_SERVER['REQUEST_URI'], '/ket-qua-nhan-dien') !== false);
    if ($is_sub_checklist_page): ?>
    <script>
      window.tailwind = {
        config: {
          corePlugins: {
            preflight: false
          }
        }
      };
    </script>
    <?php endif; ?>
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Thư viện Icon -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lora:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600&family=Nunito:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    
    <!-- Tự động khởi tạo Open Graph Meta Tags cho Social Media -->
    <?php
    $og_title = is_singular() ? get_the_title() : get_bloginfo('name');
    $og_desc = is_singular() && has_excerpt() ? wp_strip_all_tags(get_the_excerpt()) : get_bloginfo('description');
    $og_url = is_singular() ? get_permalink() : home_url('/');
    
    // Hình ảnh mặc định nếu bài viết không có ảnh đại diện (Lấy ảnh bìa trang chủ)
    $default_og_image = 'https://hieucontugoc.online/wp-content/uploads/2026/05/2.jpg';
    $og_image = has_post_thumbnail() ? get_the_post_thumbnail_url(get_the_ID(), 'large') : $default_og_image;
    ?>
    <meta property="og:title" content="<?php echo esc_attr($og_title); ?>">
    <meta property="og:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta property="og:url" content="<?php echo esc_url($og_url); ?>">
    <meta property="og:image" content="<?php echo esc_url($og_image); ?>">
    <meta property="og:type" content="<?php echo is_single() ? 'article' : 'website'; ?>">
    <meta property="og:site_name" content="<?php echo esc_attr(get_bloginfo('name')); ?>">
    
    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($og_title); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($og_desc); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($og_image); ?>">
    <!-- Kết thúc Open Graph -->

    <script>
        tailwind.config = {
            corePlugins: {
                preflight: <?php echo $is_sub_checklist_page ? 'false' : 'true'; ?>
            },
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Nunito', 'sans-serif'],
                        serif: ['Lora', 'serif'],
                    },
                    colors: {
                        primary: '#0d9488', 
                        secondary: '#f97316', 
                        secondary_dark: '#ea580c', 
                        navy: {
                            DEFAULT: '#0A1931',
                            light: '#1A365D',
                        },
                        sunset: {
                            top: '#FFF9F0', 
                            mid: '#FFD6C0', 
                            bot: '#B4C8BB'  
                        }
                    },
                    boxShadow: {
                        'elegant': '0 10px 40px -10px rgba(10, 25, 49, 0.08)',
                        'soft': '0 4px 20px -2px rgba(10, 25, 49, 0.05)',
                        'premium': '0 20px 50px -12px rgba(10, 25, 49, 0.15)'
                    }
                }
            }
        }
    </script>
    <style>
        /* CSS Variables cho Header Height */
        :root {
            --header-height-mobile: 60px;
            --header-height-desktop: 72px;
            --header-fixed-offset-mobile: 12px; /* top-3 */
            --header-fixed-offset-desktop: 16px; /* top-4 */
        }

        /* Tự động đẩy nội dung xuống đối với các trang chuẩn dùng main#primary */
        body.has-fixed-header main#primary {
            padding-top: calc(var(--header-height-mobile) + var(--header-fixed-offset-mobile) + 12px);
        }
        @media (min-width: 1024px) {
            body.has-fixed-header main#primary {
                padding-top: calc(var(--header-height-desktop) + var(--header-fixed-offset-desktop) + 16px);
            }
        }

        /* Cách header khi cuộn neo (Anchor links) */
        html {
            scroll-padding-top: calc(var(--header-height-mobile) + 20px);
        }
        @media (min-width: 1024px) {
            html {
                scroll-padding-top: calc(var(--header-height-desktop) + 20px);
            }
        }

        body { font-family: 'Nunito', sans-serif; }
        h1, h2, h3, h4, h5, h6, .font-serif { font-family: 'Lora', serif; }
        
        /* Hiệu ứng nền */
        .bg-healing-gradient {
            background: linear-gradient(to bottom, #FFF9F0 0%, #FFD6C0 45%, #B4C8BB 100%);
            background-attachment: fixed;
        }

        /* Glassmorphism cho Header */
        .glass-header {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Khi cuộn trang (Sticky) */
        .glass-header.is-scrolled {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 30px rgba(10, 25, 49, 0.05);
        }
        
        .glass-header.is-scrolled .header-container { height: 52px; }
        @media (min-width: 1024px) {
            .glass-header.is-scrolled .header-container { height: 64px; }
        }

        /* Mega Menu */
        .glass-megamenu {
            background: linear-gradient(135deg, rgba(255,255,255,0.98) 0%, rgba(255,255,255,0.95) 100%);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
        }
        
        /* Cầu nối Mega Menu */
        .mega-bridge::before {
            content: '';
            position: absolute;
            top: -20px;
            left: 0;
            width: 100%;
            height: 20px;
        }

        /* Ẩn scrollbar cho slider */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }
        .no-scrollbar {
            -ms-overflow-style: none; /* IE and Edge */
            scrollbar-width: none; /* Firefox */
        }
    </style>
    <?php wp_head(); ?>
    
    <!-- Custom CSS (Theme Settings) -->
    <?php
    $custom_css = get_option('hieucon_custom_css', '');
    if (!empty(trim($custom_css))) {
        echo '<style id="hieucon-custom-css">' . "\n";
        echo wp_strip_all_tags($custom_css) . "\n";
        echo '</style>' . "\n";
    }
    ?>
    
    <!-- Custom Head Code (Theme Settings) -->
    <?php
    $head_code = get_option('hieucon_custom_head_code', '');
    if (!empty(trim($head_code))) {
        echo $head_code . "\n";
    }
    ?>
</head>
<!-- Custom Body Code (Theme Settings) -->
<?php
$body_code = get_option('hieucon_custom_body_code', '');
if (!empty(trim($body_code))) {
    echo $body_code . "\n";
}
?>
