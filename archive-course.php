<?php
/**
 * Template Name: Tất cả Khóa học
 * Description: Archive template for course post type.
 *
 * @package Hieucon
 */

get_header();
?>

<main id="primary" class="site-main min-h-screen py-12 md:py-20 bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header Banner -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-navy leading-tight mb-4">Học Viện E-Learning Hieucon</h1>
            <p class="text-slate-600 text-sm md:text-base font-medium">Khám phá các khóa học video chất lượng cao từ các chuyên gia hàng đầu giúp bạn nâng cao năng lực và tri thức.</p>
            <div class="w-16 h-1 bg-primary mx-auto mt-6 rounded-full"></div>
        </div>

        <?php if ( have_posts() ) : ?>
            <!-- Grid Courses -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); 
                    $price       = get_post_meta( get_the_ID(), '_course_price', true );
                    $level       = get_post_meta( get_the_ID(), '_course_level', true );
                    $duration    = get_post_meta( get_the_ID(), '_course_duration', true );
                    
                    // Format level string
                    $level_label = 'Cơ bản';
                    $level_class = 'bg-slate-50 text-slate-600 border-slate-200';
                    if ( $level === 'intermediate' ) {
                        $level_label = 'Trung cấp';
                        $level_class = 'bg-blue-50 text-blue-600 border-blue-150';
                    } elseif ( $level === 'advanced' ) {
                        $level_label = 'Nâng cao';
                        $level_class = 'bg-amber-50 text-amber-600 border-amber-150';
                    }
                ?>
                    <article class="bg-white rounded-3xl border border-slate-100 shadow-soft hover:shadow-elegant transition-all duration-300 overflow-hidden flex flex-col group">
                        <!-- Thumbnail -->
                        <div class="relative aspect-video w-full overflow-hidden bg-slate-100">
                            <?php if ( has_post_thumbnail() ) : ?>
                                <?php the_post_thumbnail( 'large', [ 'class' => 'w-full h-full object-cover group-hover:scale-105 transition-transform duration-500' ] ); ?>
                            <?php else : ?>
                                <div class="w-full h-full flex items-center justify-center text-slate-300">
                                    <i data-lucide="image" class="w-12 h-12"></i>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Badges over Thumbnail -->
                            <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider border <?php echo $level_class; ?>">
                                    <?php echo esc_html( $level_label ); ?>
                                </span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="p-6 flex-1 flex flex-col justify-between">
                            <div>
                                <h2 class="text-lg md:text-xl font-serif font-bold text-navy group-hover:text-primary transition-colors line-clamp-2 mb-3">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="text-slate-500 text-xs md:text-sm line-clamp-3 mb-6"><?php echo wp_strip_all_tags( get_the_excerpt() ); ?></p>
                            </div>

                            <!-- Meta Info & Price -->
                            <div class="border-t border-slate-100 pt-4 flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-1.5 text-slate-500 text-xs font-semibold">
                                    <i data-lucide="clock" class="w-4 h-4 text-slate-400"></i>
                                    <span><?php echo esc_html( $duration ? $duration : 'Chưa cập nhật' ); ?></span>
                                </div>
                                <div class="text-right">
                                    <?php if ( $price == 0 ) : ?>
                                        <span class="text-emerald-600 font-bold text-sm md:text-base bg-emerald-50 px-2.5 py-1 rounded-lg">Miễn phí</span>
                                    <?php else : ?>
                                        <span class="text-primary font-bold text-base md:text-lg"><?php echo number_format( $price, 0, ',', '.' ); ?> VND</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination -->
            <div class="mt-16 flex justify-center">
                <?php
                echo paginate_links( [
                    'prev_text' => '<span class="px-3 py-2 border border-slate-200 rounded-lg hover:bg-white text-navy font-bold text-xs"><i data-lucide="chevron-left" class="w-4 h-4 inline"></i> Trước</span>',
                    'next_text' => '<span class="px-3 py-2 border border-slate-200 rounded-lg hover:bg-white text-navy font-bold text-xs">Sau <i data-lucide="chevron-right" class="w-4 h-4 inline"></i></span>',
                    'type'      => 'plain',
                ] );
                ?>
            </div>

        <?php else : ?>
            <div class="text-center py-20 bg-white rounded-3xl border border-slate-100 shadow-soft">
                <i data-lucide="graduation-cap" class="w-16 h-16 text-slate-300 mx-auto mb-4"></i>
                <p class="text-slate-500 font-medium">Hiện tại chưa có khóa học nào được đăng tải trên hệ thống.</p>
            </div>
        <?php endif; ?>

        <!-- SEO Article Section at the bottom -->
        <?php
        $seo_page = get_page_by_path( 'khoa-hoc' );
        if ( $seo_page && ! empty( $seo_page->post_content ) ) : ?>
            <div class="mt-24 bg-white/70 backdrop-blur-xl border border-white p-8 md:p-12 rounded-[2.5rem] shadow-sm prose max-w-none text-slate-700">
                <div class="seo-content">
                    <?php echo apply_filters( 'the_content', $seo_page->post_content ); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    });
</script>

<?php
get_footer();
