<?php
/**
 * The template for displaying all single posts
 *
 * @package Hieucon
 */

get_header(); ?>

<main id="primary" class="site-main pb-24">
    <?php
    while ( have_posts() ) :
        the_post();
        ?>
        
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
            <!-- Minimalist Typography Header -->
            <header class="w-full pt-28 md:pt-36 pb-12 lg:pb-16 text-center max-w-5xl mx-auto px-4 sm:px-6">
                <div class="inline-flex items-center gap-2 text-secondary font-bold uppercase tracking-widest text-[12px] md:text-[14px] mb-6 bg-white/60 backdrop-blur-md px-5 py-2 rounded-full border border-white shadow-sm">
                    <i data-lucide="calendar" class="w-4 h-4"></i>
                    <time datetime="<?php echo get_the_date( 'c' ); ?>"><?php echo get_the_date(); ?></time>
                </div>
                
                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-navy mb-8 leading-[1.15] tracking-tight">
                    <?php the_title(); ?>
                </h1>

                <!-- Đường kẻ phân cách tinh tế -->
                <div class="w-24 h-px bg-gradient-to-r from-transparent via-navy/30 to-transparent mx-auto mt-4"></div>
            </header>

            <!-- Bám sát container 1400px của phần thân -->
            <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8">

                <!-- Grid 2 cột cho Desktop: Cột nội dung (Trái) & Cột thông tin/Sidebar (Phải) -->
                <div class="flex flex-col lg:flex-row gap-10 xl:gap-16">
                    
                    <!-- Cột Nội Dung (Left) -->
                    <div class="w-full lg:w-8/12 xl:w-9/12">
                        <style>
                            .single-content {
                                font-family: 'Nunito', sans-serif;
                                color: #0A1931;
                                font-size: 1.1875rem; /* ~19px */
                                line-height: 1.8;
                            }
                            .single-content h2, .single-content h3, .single-content h4 {
                                font-family: 'Lora', serif;
                                color: #0A1931;
                                font-weight: 700;
                                margin-top: 3rem;
                                margin-bottom: 1.5rem;
                                line-height: 1.3;
                            }
                            .single-content h2 { font-size: 2.25rem; }
                            .single-content h3 { font-size: 1.875rem; }
                            .single-content h4 { font-size: 1.5rem; }
                            
                            .single-content p {
                                margin-bottom: 1.5rem;
                                color: rgba(10, 25, 49, 0.85);
                            }
                            
                            .single-content a {
                                color: #f97316;
                                font-weight: 600;
                                text-decoration: underline;
                                text-underline-offset: 4px;
                                transition: all 0.3s ease;
                            }
                            .single-content a:hover {
                                color: #ea580c;
                            }

                            .single-content ul {
                                list-style-type: disc;
                                padding-left: 1.5rem;
                                margin-bottom: 1.5rem;
                            }
                            .single-content ol {
                                list-style-type: decimal;
                                padding-left: 1.5rem;
                                margin-bottom: 1.5rem;
                            }
                            .single-content li {
                                margin-bottom: 0.75rem;
                            }

                            .single-content blockquote {
                                border-left: 4px solid #f97316;
                                padding: 1.5rem 1.5rem 1.5rem 2rem;
                                margin: 2rem 0;
                                background: rgba(255, 255, 255, 0.5);
                                border-radius: 0 1rem 1rem 0;
                                font-family: 'Lora', serif;
                                font-size: 1.25rem;
                                font-style: italic;
                                color: #0A1931;
                                box-shadow: 0 4px 20px -2px rgba(10, 25, 49, 0.05);
                            }

                            .single-content img {
                                border-radius: 1.25rem;
                                box-shadow: 0 10px 40px -10px rgba(10, 25, 49, 0.15);
                                margin: 2.5rem auto;
                                width: 100%;
                                max-width: 100% !important;
                                aspect-ratio: 16 / 9;
                                object-fit: cover;
                                display: block;
                            }

                            .single-content figure, .single-content .wp-caption {
                                position: relative;
                                margin: 2.5rem auto;
                                width: 100% !important;
                                max-width: 100% !important;
                                height: auto;
                            }

                            .single-content figure img, .single-content .wp-caption img {
                                margin: 0;
                                width: 100%;
                            }

                            .single-content figcaption, .single-content .wp-caption-text {
                                position: absolute;
                                bottom: 1.25rem;
                                left: 50%;
                                transform: translateX(-50%);
                                background: rgba(255, 255, 255, 0.65);
                                backdrop-filter: blur(12px);
                                -webkit-backdrop-filter: blur(12px);
                                border: 1px solid rgba(255, 255, 255, 0.8);
                                color: #0A1931;
                                font-size: 0.875rem;
                                font-weight: 700;
                                padding: 0.5rem 1.5rem;
                                border-radius: 999px;
                                box-shadow: 0 8px 30px -5px rgba(10, 25, 49, 0.2);
                                text-align: center;
                                max-width: 85%;
                                z-index: 10;
                                text-shadow: 0 1px 2px rgba(255,255,255,0.8);
                                display: -webkit-box;
                                -webkit-line-clamp: 2;
                                -webkit-box-orient: vertical;
                                overflow: hidden;
                            }
                            
                            .single-content img.alignleft { float: left; margin-right: 1.5rem; margin-bottom: 1.5rem; width: 50%; aspect-ratio: auto; }
                            .single-content img.alignright { float: right; margin-left: 1.5rem; margin-bottom: 1.5rem; width: 50%; aspect-ratio: auto; }
                            .single-content img.aligncenter { display: block; margin-left: auto; margin-right: auto; }
                        </style>

                        <div class="single-content bg-white/40 backdrop-blur-md p-6 md:p-10 lg:p-12 rounded-[2rem] md:rounded-[3rem] border border-white/60 shadow-soft">
                            <?php
                            the_content();
                            
                            wp_link_pages( array(
                                'before' => '<div class="page-links mt-8 font-bold text-navy">Trang: ',
                                'after'  => '</div>',
                            ) );
                            ?>
                        </div>
                    </div>

                    <!-- Cột Sidebar (Right) -->
                    <div class="w-full lg:w-4/12 xl:w-3/12">
                        <div class="sticky top-[120px] space-y-8">
                            
                            <!-- Mục lục -->
                            <div class="bg-white/60 backdrop-blur-md p-6 rounded-[2rem] border border-white shadow-soft">
                                <h4 class="font-serif font-bold text-lg text-navy mb-4 border-b border-navy/10 pb-2 flex items-center gap-2">
                                    <i data-lucide="list" class="w-5 h-5 text-secondary"></i> Mục lục
                                </h4>
                                <nav id="toc-container" class="text-[13px] font-medium text-navy/70 max-h-[50vh] overflow-y-auto pr-1 no-scrollbar">
                                    <!-- JS sẽ inject mục lục vào đây -->
                                </nav>
                            </div>

                            <!-- CTA Tham gia nhóm -->
                            <div class="bg-white/80 backdrop-blur-md rounded-[2rem] border border-white shadow-soft overflow-hidden group">
                                <!-- Image Header (Tỉ lệ vuông 1:1, không overlay/filter) -->
                                <div class="w-full aspect-square overflow-hidden bg-white">
                                    <img src="https://hieucontugoc.online/wp-content/uploads/2026/05/4.jpg" alt="Cộng đồng Hiểu Con Từ Gốc" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                </div>

                                <!-- Content -->
                                <div class="p-6 text-center relative z-10">
                                    <div class="bg-secondary/10 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4 text-secondary">
                                        <i data-lucide="heart-handshake" class="w-6 h-6"></i>
                                    </div>
                                    <h4 class="font-serif font-bold text-xl mb-3 text-navy leading-tight">Bạn không đơn độc</h4>
                                    <p class="text-navy/70 text-sm font-medium leading-relaxed mb-6">
                                        Cùng tham gia cộng đồng <strong class="text-navy">Hiểu Con Từ Gốc</strong> để chia sẻ kiến thức y sinh và nhận sự đồng hành.
                                    </p>
                                    <div class="grid grid-cols-1 gap-2.5">
                                        <a href="<?php echo home_url('/facebook-group'); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#1877F2] hover:bg-[#0d6edc] text-white font-bold py-2.5 px-4 rounded-xl text-xs transition-all duration-300 shadow-md hover:shadow-lg w-full justify-center">
                                            <i data-lucide="users" class="w-4 h-4"></i> Cộng đồng
                                        </a>
                                        <a href="<?php echo home_url('/zalo-group'); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-[#0068FF] hover:bg-[#0054cc] text-white font-bold py-2.5 px-4 rounded-xl text-xs transition-all duration-300 shadow-md hover:shadow-lg w-full justify-center">
                                            <span class="font-black text-xs text-white leading-none">Z</span> Góc chia sẻ
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!-- Thẻ (Tags) -->
                            <?php
                            $tags_list = get_the_tag_list( '', '' );
                            if ( $tags_list ) {
                                $tags_list = str_replace('<a ', '<a class="bg-white hover:bg-navy hover:text-white text-navy font-medium px-4 py-1.5 rounded-full text-sm transition-colors shadow-sm" ', $tags_list);
                                echo '<div class="bg-white/60 backdrop-blur-md p-6 rounded-[2rem] border border-white shadow-soft">';
                                echo '<h4 class="font-serif font-bold text-lg text-navy mb-4 border-b border-navy/10 pb-2">Từ khóa</h4>';
                                echo '<div class="flex flex-wrap gap-2">' . $tags_list . '</div>';
                                echo '</div>';
                            }
                            ?>

                        </div>
                    </div>

                </div>

            </div>
        </article>

        <!-- Related Posts (Nằm ngang dưới cùng, vẫn giữ 1400px) -->
        <?php
        $categories = get_the_category();
        if ( ! empty( $categories ) ) {
            $category_ids = array();
            foreach( $categories as $individual_category ) $category_ids[] = $individual_category->term_id;

            $args = array(
                'category__in'     => $category_ids,
                'post__not_in'     => array( get_the_ID() ),
                'posts_per_page'   => 4,
                'ignore_sticky_posts' => 1
            );

            $related_query = new WP_Query( $args );

            if( $related_query->have_posts() ) {
                ?>
                <section class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 mt-24">
                    <h3 class="font-serif text-3xl md:text-4xl text-navy mb-10 text-center md:text-left border-t border-navy/10 pt-16">Bài viết cùng chuyên mục</h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                        <?php
                        while( $related_query->have_posts() ) {
                            $related_query->the_post();
                            ?>
                            <a href="<?php the_permalink(); ?>" class="glass-card rounded-[2rem] p-4 shadow-soft hover:shadow-elegant transition-all duration-300 group flex flex-col h-full bg-white/40">
                                <div class="w-full h-40 rounded-xl overflow-hidden mb-4 bg-navy/5 relative">
                                    <?php if ( has_post_thumbnail() ) : ?>
                                        <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ) ); ?>
                                    <?php endif; ?>
                                </div>
                                <h4 class="font-serif text-lg font-bold text-navy mb-2 line-clamp-2 group-hover:text-secondary transition-colors leading-snug"><?php the_title(); ?></h4>
                                <span class="text-xs text-navy/50 font-bold mt-auto uppercase tracking-wider"><?php echo get_the_date(); ?></span>
                            </a>
                            <?php
                        }
                        wp_reset_postdata();
                        ?>
                    </div>
                </section>
                <?php
            }
        }
        ?>

    <?php endwhile; ?>
</main>

<style>
    html {
        scroll-behavior: smooth;
        scroll-padding-top: 120px; /* Cách header khi cuộn tới heading */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const content = document.querySelector('.single-content');
        const tocContainer = document.getElementById('toc-container');
        
        if (content && tocContainer) {
            const headings = content.querySelectorAll('h2, h3');
            if (headings.length === 0) {
                tocContainer.innerHTML = '<p class="italic text-navy/50">Nội dung ngắn, không có mục lục.</p>';
                return;
            }

            const ul = document.createElement('ul');
            ul.className = 'space-y-3';
            
            headings.forEach((heading, index) => {
                // Tạo ID cho thẻ heading nếu chưa có
                if (!heading.id) {
                    // Chuyển tiếng Việt có dấu thành không dấu, thay khoảng trắng bằng gạch ngang
                    const slug = heading.textContent.toLowerCase()
                        .normalize("NFD").replace(/[\u0300-\u036f]/g, "")
                        .replace(/[^a-z0-9 ]/g, "").replace(/\s+/g, '-');
                    heading.id = slug || ('heading-' + index);
                }
                
                const li = document.createElement('li');
                const a = document.createElement('a');
                a.href = '#' + heading.id;
                a.textContent = heading.textContent;
                a.className = 'block hover:text-secondary transition-colors duration-200 line-clamp-2 leading-relaxed';
                
                // Thụt lề và đổi style dựa theo H2 hay H3
                if (heading.tagName.toLowerCase() === 'h3') {
                    li.className = 'ml-4 relative before:content-[""] before:absolute before:-left-3 before:top-2 before:w-1 before:h-1 before:bg-navy/30 before:rounded-full';
                    a.className += ' text-navy/60';
                } else {
                    a.className += ' font-bold text-navy/80';
                }
                
                li.appendChild(a);
                ul.appendChild(li);
            });
            
            tocContainer.appendChild(ul);
        }
    });
</script>

<?php get_footer(); ?>
