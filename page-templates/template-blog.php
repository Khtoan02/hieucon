<?php
/**
 * Template Name: Trang danh sách Blog
 *
 * @package Hieucon
 */

get_header(); ?>

<main id="primary" class="site-main pb-24">
    <!-- Hero Banner (Bám 1400px) -->
    <section class="w-full relative pt-20 pb-16 md:pt-28 md:pb-20 overflow-hidden">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center md:text-left flex flex-col md:flex-row items-center justify-between gap-8">
            <div class="max-w-3xl">
                <span class="inline-flex items-center gap-2 text-secondary font-bold text-xs md:text-sm mb-4 uppercase tracking-widest bg-white/60 backdrop-blur-md px-4 py-1.5 rounded-full border border-white shadow-sm">
                    <i data-lucide="sparkles" class="w-4 h-4"></i> Cẩm nang & Kiến thức
                </span>
                <h1 class="font-serif text-4xl md:text-5xl lg:text-6xl text-navy mb-6 leading-tight">
                    Góc chia sẻ
                </h1>
                <p class="text-base md:text-xl text-navy/70 font-medium leading-relaxed">
                    Nơi lưu giữ những bài viết, nghiên cứu và kinh nghiệm khoa học nhất về hành trình chăm sóc trẻ tự kỷ, tăng động.
                </p>
            </div>
            
            <div class="hidden lg:flex shrink-0">
                <i data-lucide="book-open-text" class="w-32 h-32 text-navy/5 -rotate-12"></i>
            </div>
        </div>
    </section>

    <!-- Post Grid -->
    <section class="relative">
        <div class="max-w-[1400px] mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <?php 
            $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : ((get_query_var('page')) ? get_query_var('page') : 1);
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 12,
                'paged' => $paged
            );
            $blog_query = new WP_Query($args);

            if ( $blog_query->have_posts() ) : ?>
                <!-- Sử dụng Grid 4 cột cho màn hình siêu lớn, 3 cột cho lg, 2 cột cho md -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                    <?php
                    while ( $blog_query->have_posts() ) :
                        $blog_query->the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white/60 backdrop-blur-md rounded-[2.5rem] p-4 md:p-5 border border-white shadow-soft hover:shadow-elegant transition-all duration-500 group flex flex-col h-full'); ?>>
                            
                            <!-- Thumbnail (Tỉ lệ 4:3 cho đều đẹp) -->
                            <a href="<?php the_permalink(); ?>" class="block w-full aspect-[4/3] rounded-[1.5rem] md:rounded-[2rem] overflow-hidden relative mb-5 bg-navy/5">
                                <?php if ( has_post_thumbnail() ) : ?>
                                    <?php the_post_thumbnail( 'medium_large', array( 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-700' ) ); ?>
                                <?php else : ?>
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i data-lucide="image" class="w-12 h-12 text-navy/20"></i>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Ngày tháng góc trên ảnh -->
                                <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm text-navy font-bold text-[10px] uppercase tracking-widest px-3 py-1.5 rounded-full shadow-sm">
                                    <?php echo get_the_date('d/m/Y'); ?>
                                </div>
                            </a>

                            <!-- Content -->
                            <div class="flex flex-col flex-grow px-2 pb-2">
                                <?php
                                $categories = get_the_category();
                                if ( ! empty( $categories ) ) {
                                    echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '" class="text-secondary font-extrabold uppercase tracking-widest text-[10px] mb-3 inline-block">' . esc_html( $categories[0]->name ) . '</a>';
                                }
                                ?>
                                
                                <h2 class="font-serif text-xl md:text-2xl font-bold text-navy mb-3 leading-snug group-hover:text-secondary transition-colors line-clamp-2">
                                    <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
                                </h2>
                                
                                <div class="text-navy/60 font-medium text-sm leading-relaxed mb-6 line-clamp-3 flex-grow">
                                    <?php echo wp_trim_words( get_the_excerpt(), 25, '...' ); ?>
                                </div>
                                
                                <a href="<?php the_permalink(); ?>" class="mt-auto flex items-center justify-center gap-2 bg-navy/5 hover:bg-navy text-navy hover:text-white font-bold py-3 px-6 rounded-xl text-[13px] transition-colors duration-300">
                                    Khám phá <i data-lucide="arrow-right" class="w-4 h-4"></i>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <!-- Pagination -->
                <div class="mt-20 flex justify-center">
                    <?php
                    $total_pages = $blog_query->max_num_pages;
                    if ($total_pages > 1) {
                        $current_page = max(1, $paged);
                        $pagination = paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'prev_text'    => '<i data-lucide="chevron-left" class="w-5 h-5"></i>',
                            'next_text'    => '<i data-lucide="chevron-right" class="w-5 h-5"></i>',
                            'type'      => 'array',
                        ));

                        if ( $pagination ) {
                            echo '<nav class="inline-flex items-center gap-2 bg-white/60 backdrop-blur-md p-2 rounded-2xl border border-white shadow-soft" aria-label="Pagination">';
                            foreach ( $pagination as $page ) {
                                // Xử lý style CSS cho nút phân trang
                                $page = str_replace( 'page-numbers', 'flex items-center justify-center min-w-[40px] h-[40px] rounded-xl font-bold transition-all text-navy hover:bg-navy hover:text-white', $page );
                                $page = str_replace( 'current', '!bg-secondary !text-white shadow-md', $page );
                                echo $page;
                            }
                            echo '</nav>';
                        }
                    }
                    ?>
                </div>
                <?php wp_reset_postdata(); ?>

            <?php else : ?>
                <div class="bg-white/60 backdrop-blur-md rounded-[3rem] p-16 text-center max-w-3xl mx-auto shadow-soft border border-white">
                    <i data-lucide="inbox" class="w-20 h-20 text-navy/10 mx-auto mb-6"></i>
                    <h2 class="font-serif text-3xl text-navy mb-4 font-bold">Chưa có bài viết nào</h2>
                    <p class="text-navy/70 text-lg">Bạn vui lòng quay lại sau khi chúng tôi cập nhật thêm nội dung nhé.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<script>
    // JS xử lý fallback class cho thẻ span current sinh ra từ hàm paginate_links nếu chưa được replace chuẩn
    document.addEventListener('DOMContentLoaded', function() {
        const paginations = document.querySelectorAll('.page-numbers');
        paginations.forEach(el => {
            if(el.tagName.toLowerCase() === 'span' && el.classList.contains('current')) {
                el.className = 'page-numbers current flex items-center justify-center min-w-[40px] h-[40px] rounded-xl font-bold transition-all !bg-secondary !text-white shadow-md px-2';
            } else if (!el.classList.contains('flex')) {
                el.classList.add('flex', 'items-center', 'justify-center', 'min-w-[40px]', 'h-[40px]', 'rounded-xl', 'font-bold', 'transition-all', 'text-navy', 'hover:bg-navy', 'hover:text-white', 'px-2');
            }
        });
    });
</script>

<?php get_footer(); ?>
