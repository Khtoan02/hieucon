<?php
/**
 * Template Name: Thư viện Ebook
 * Description: Archive template for Ebook post type (CPT).
 *
 * @package Hieucon
 */

get_header();

$current_member = class_exists('\Hieucon\Model\Member_Model') ? \Hieucon\Model\Member_Model::get_current_member() : false;
$member_id = 0;
$enrolled_ebooks = [];

if ($current_member) {
    $member_id = intval($current_member->id);
    $enrolled_ebooks = hieucon_get_member_enrolled_ebooks($member_id);
}
?>
<main id="primary"
    class="site-main min-h-screen py-12 md:py-20 bg-gradient-to-tr from-slate-50 via-slate-100 to-orange-50/20">
    <!-- Premium Library Grid CSS Styles -->
    <style>
        .lib-book-container {
            perspective: 1200px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background 0.4s;
        }

        .lib-book-mockup {
            position: relative;
            width: 220px;
            height: 308px;
            transform-style: preserve-3d;
            transform: rotateY(-18deg) rotateX(3deg);
            transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.6s;
            box-shadow: 5px 5px 20px rgba(15, 23, 42, 0.08), 12px 15px 30px rgba(15, 23, 42, 0.08);
            border-radius: 2px 10px 10px 2px;
        }

        .group:hover .lib-book-mockup {
            transform: rotateY(-5deg) rotateX(1deg) translateY(-8px) scale(1.05);
            box-shadow: 10px 25px 40px rgba(15, 23, 42, 0.15), 20px 35px 60px rgba(15, 23, 42, 0.18);
        }

        .lib-book-spine {
            position: absolute;
            width: 20px;
            height: 100%;
            left: -10px;
            top: 0;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.35) 0%, rgba(255, 255, 255, 0.15) 40%, rgba(0, 0, 0, 0.15) 100%), #1e293b;
            transform: rotateY(-90deg);
            transform-origin: right center;
            border-radius: 2px 0 0 2px;
        }

        .lib-book-pages-side {
            position: absolute;
            width: 16px;
            height: 98%;
            right: -8px;
            top: 1%;
            background: linear-gradient(to right, #ffffff 0%, #f8fafc 60%, #e2e8f0 100%);
            transform: rotateY(90deg);
            transform-origin: left center;
            box-shadow: inset 0px 0px 4px rgba(0, 0, 0, 0.15);
            border-radius: 0 4px 4px 0;
        }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.95);
            }

            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in-scale {
            animation: fadeInScale 0.4s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .filter-btn {
            cursor: pointer;
        }

        .filter-btn.active {
            background-color: #0d9488 !important;
            /* bg-primary */
            color: #ffffff !important;
            border-color: #0d9488 !important;
            box-shadow: 0 4px 14px rgba(13, 148, 136, 0.25) !important;
        }
    </style>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Header Banner Cozy style -->
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h1 class="text-3xl md:text-5xl font-serif font-bold text-navy leading-tight mb-4">Cẩm nang Kỹ Năng / Kiến
                Thức</h1>
            <p class="text-slate-600 text-sm md:text-base font-medium">Khám phá và sở hữu ngay các Cẩm nang kỹ năng,
                kiến thức nuôi dạy con, cẩm nang gia đình bản quyền biên soạn bởi Hieucon.</p>
            <div class="w-16 h-1 bg-primary mx-auto mt-6 rounded-full"></div>
        </div>

        <?php
        // Fetch all categories under ebook_cat
        $ebook_terms = get_terms([
            'taxonomy' => 'ebook_cat',
            'hide_empty' => true,
        ]);
        ?>

        <?php if (!empty($ebook_terms) && !is_wp_error($ebook_terms)): ?>
            <div class="flex flex-wrap items-center justify-center gap-3 mb-12" id="ebook-filters">
                <button type="button" data-filter="all"
                    class="filter-btn active px-6 py-2.5 rounded-full text-xs font-bold transition-all shadow-sm border border-slate-200/60 bg-white text-navy/80 hover:border-primary hover:text-primary">
                    Tất cả
                </button>
                <?php foreach ($ebook_terms as $term): ?>
                    <button type="button" data-filter="cat-<?php echo esc_attr($term->slug); ?>"
                        class="filter-btn px-6 py-2.5 rounded-full text-xs font-bold transition-all shadow-sm border border-slate-200/60 bg-white text-navy/80 hover:border-primary hover:text-primary">
                        <?php echo esc_html($term->name); ?>
                    </button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (have_posts()): ?>
            <!-- Expanded grid optimized for multiple books showcase -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-10" id="ebook-grid">
                <?php while (have_posts()):
                    the_post();
                    $price_details = hieucon_get_ebook_price_details(get_the_ID());
                    $price = $price_details['display_price'];
                    $orig_price = $price_details['original_price'];
                    $is_promo = $price_details['is_promo_active'];
                    $ebook_pages = get_post_meta(get_the_ID(), '_ebook_pages', true);
                    $ebook_pages = !empty($ebook_pages) ? intval($ebook_pages) : 0;

                    // Determine user ownership
                    $is_owned = false;
                    if ($current_member) {
                        if ($current_member->role === 'administrator' || $current_member->role === 'teacher' || $current_member->role === 'expert') {
                            $is_owned = true;
                        } elseif (is_array($enrolled_ebooks) && in_array(get_the_ID(), $enrolled_ebooks)) {
                            $is_owned = true;
                        }
                    }
                    if ($price === 0.0 && $current_member) {
                        $is_owned = true;
                    }

                    // Ebook category
                    $categories = get_the_terms(get_the_ID(), 'ebook_cat');
                    $cat_label = 'Tài liệu';
                    $cat_classes = [];
                    if (!empty($categories) && !is_wp_error($categories)) {
                        $cat_label = $categories[0]->name;
                        foreach ($categories as $cat) {
                            $cat_classes[] = 'cat-' . $cat->slug;
                        }
                    }
                    $cat_class_str = implode(' ', $cat_classes);
                    ?>
                    <article
                        class="ebook-card <?php echo esc_attr($cat_class_str); ?> bg-white/90 backdrop-blur-md rounded-[2.5rem] border border-white shadow-soft hover:shadow-elegant transition-all duration-500 overflow-hidden flex flex-col group p-6 relative">

                        <!-- Top visual display: 3D Mockup standing directly on the card -->
                        <div class="lib-book-container h-96 flex items-center justify-center relative select-none mb-6">
                            <!-- Cozy warm amber background glow behind book cover -->
                            <div
                                class="absolute w-72 h-72 rounded-full bg-secondary/10 filter blur-3xl group-hover:scale-125 transition-transform duration-700 pointer-events-none">
                            </div>

                            <!-- 3D Mockup cover -->
                            <div class="lib-book-mockup bg-slate-200">
                                <!-- Spine -->
                                <div class="lib-book-spine"
                                    style="background-color: <?php echo esc_attr($price === 0.0 ? '#10b981' : '#0d9488'); ?>;">
                                </div>

                                <!-- Cover image -->
                                <div class="w-full h-full rounded-r-lg overflow-hidden relative">
                                    <?php if (has_post_thumbnail()): ?>
                                        <?php the_post_thumbnail('large', ['class' => 'w-full h-full object-cover']); ?>
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full bg-gradient-to-tr from-teal-500 to-emerald-600 flex flex-col items-center justify-center p-3 text-center text-white">
                                            <i data-lucide="book-open" class="w-10 h-10 mb-2 opacity-80 animate-pulse-slow"></i>
                                            <span
                                                class="text-xs font-bold font-serif line-clamp-3 leading-snug"><?php the_title(); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Pages Edge -->
                                <div class="lib-book-pages-side"></div>
                            </div>
                        </div>

                        <!-- Card Information Content -->
                        <div class="flex-1 flex flex-col justify-between z-10 relative">
                            <div>
                                <!-- Consolidated Metadata Row -->
                                <div class="flex flex-wrap items-center gap-2 mb-3.5">
                                    <span
                                        class="px-2.5 py-0.5 rounded-full bg-slate-100 border border-slate-200/50 text-[10px] font-extrabold text-slate-500 uppercase tracking-wider">
                                        <?php echo esc_html($cat_label); ?>
                                    </span>
                                    <?php if ($is_promo): ?>
                                        <span
                                            class="px-2.5 py-0.5 rounded-full bg-orange-50 border border-orange-100 text-[10px] font-bold text-orange-600 uppercase tracking-wider">
                                            <?php
                                            if (!empty($price_details['promo_title'])) {
                                                echo esc_html($price_details['promo_title']);
                                            } else {
                                                if ($price_details['promo_target'] === 'all') {
                                                    echo 'Khuyến mãi';
                                                } elseif ($price_details['promo_target'] === 'new') {
                                                    echo 'Khách mới';
                                                } elseif ($price_details['promo_target'] === 'loyal') {
                                                    echo 'Hội viên';
                                                }
                                            }
                                            ?>
                                        </span>
                                    <?php endif; ?>
                                    <span class="inline-flex items-center gap-1 text-[11px] font-bold text-slate-400">
                                        <span class="w-1 h-1 rounded-full bg-slate-300"></span>
                                        <i data-lucide="file-text" class="w-3.5 h-3.5 text-slate-400"></i>
                                        <span><?php echo $ebook_pages ? $ebook_pages . ' trang' : 'Đang biên soạn'; ?></span>
                                    </span>
                                    <?php if ($is_owned): ?>
                                        <span class="inline-flex items-center gap-1 text-[11px] font-bold text-emerald-600 ml-auto">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 inline-block animate-pulse"></span>
                                            Đã sở hữu
                                        </span>
                                    <?php endif; ?>
                                </div>
                                <h2
                                    class="text-base md:text-xl font-serif font-bold text-navy group-hover:text-primary transition-colors duration-300 line-clamp-2 mb-2">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <p class="text-slate-500 text-xs md:text-sm line-clamp-2 mb-6 font-medium leading-relaxed">
                                    <?php echo wp_strip_all_tags(get_the_excerpt()); ?></p>
                            </div>

                            <!-- Unified Premium Footer (Border-topped single row) -->
                            <div class="border-t border-slate-100 pt-5 mt-auto flex items-center justify-between gap-4">
                                <!-- Price Display -->
                                <div class="flex flex-col">
                                    <span class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400 mb-0.5">Giá
                                        sở hữu</span>
                                    <?php if ($price === 0.0): ?>
                                        <span class="text-emerald-600 font-extrabold text-sm md:text-base">Miễn phí</span>
                                    <?php elseif (is_null($price)): ?>
                                        <span class="text-slate-500 font-bold text-xs md:text-sm">Chưa mở bán</span>
                                    <?php else: ?>
                                        <div class="flex items-baseline flex-wrap gap-1">
                                            <?php if ($is_promo): ?>
                                                <span class="text-slate-450 line-through text-[13px] font-medium mr-1">
                                                    <?php echo number_format($orig_price, 0, ',', '.'); ?>đ
                                                </span>
                                            <?php endif; ?>
                                            <span class="text-primary font-black text-[18px] md:text-[20px] leading-none">
                                                <?php echo number_format($price, 0, ',', '.'); ?> <span
                                                    class="text-[14px] font-bold">đ</span>
                                            </span>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Filled Premium Action Button -->
                                <div>
                                    <span
                                        class="inline-flex items-center gap-1.5 text-[11px] font-bold text-white uppercase tracking-wider leading-none bg-navy group-hover:bg-primary px-5 py-3.5 rounded-full shadow-md group-hover:shadow-lg group-hover:-translate-y-0.5 transition-all duration-300">
                                        Khám Phá Tài Liệu
                                        <i data-lucide="arrow-right"
                                            class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Click action overlay border highlight effect covering the entire card -->
                        <a href="<?php the_permalink(); ?>"
                            class="absolute inset-0 z-20 pointer-events-auto rounded-[2.5rem] border-2 border-transparent group-hover:border-primary/15 transition-all duration-500"></a>
                    </article>
                <?php endwhile; ?>
            </div>

            <!-- Pagination Grid Cozy links -->
            <div class="mt-16 flex justify-center">
                <?php
                echo paginate_links([
                    'prev_text' => '<span class="px-3.5 py-2 border border-slate-200 rounded-xl hover:bg-white text-navy font-bold text-xs flex items-center gap-1.5 shadow-sm"><i data-lucide="chevron-left" class="w-4 h-4"></i> Trước</span>',
                    'next_text' => '<span class="px-3.5 py-2 border border-slate-200 rounded-xl hover:bg-white text-navy font-bold text-xs flex items-center gap-1.5 shadow-sm">Sau <i data-lucide="chevron-right" class="w-4 h-4"></i></span>',
                    'type' => 'plain',
                ]);
                ?>
            </div>

        <?php else: ?>
            <div class="text-center py-20 bg-white rounded-[2.5rem] border border-slate-100 shadow-soft">
                <i data-lucide="book-open" class="w-16 h-16 text-slate-300 mx-auto mb-4 animate-pulse-slow"></i>
                <p class="text-slate-500 font-semibold text-sm">Hiện tại chưa có Cẩm nang nào được trưng bày trên tủ sách.
                </p>
            </div>
        <?php endif; ?>

        <!-- SEO Article at the bottom -->
        <?php
        $seo_page = get_page_by_path('docs');
        if ($seo_page && !empty($seo_page->post_content)): ?>
            <div
                class="mt-24 bg-white/70 backdrop-blur-xl border border-white p-8 md:p-12 rounded-[2.5rem] shadow-sm prose max-w-none text-slate-700">
                <div class="seo-content">
                    <?php echo apply_filters('the_content', $seo_page->post_content); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }

        // Category filter logic
        const filterButtons = document.querySelectorAll('.filter-btn');
        const ebookCards = document.querySelectorAll('.ebook-card');

        if (filterButtons.length > 0 && ebookCards.length > 0) {
            filterButtons.forEach(btn => {
                btn.addEventListener('click', function () {
                    // Update active button state
                    filterButtons.forEach(b => b.classList.remove('active'));
                    this.classList.add('active');

                    const filterValue = this.getAttribute('data-filter');

                    ebookCards.forEach(card => {
                        // Reset animation
                        card.style.animation = 'none';
                        card.offsetHeight; // trigger reflow
                        card.style.animation = null;

                        if (filterValue === 'all') {
                            card.classList.remove('hidden');
                            card.classList.add('animate-fade-in-scale');
                        } else {
                            if (card.classList.contains(filterValue)) {
                                card.classList.remove('hidden');
                                card.classList.add('animate-fade-in-scale');
                            } else {
                                card.classList.add('hidden');
                                card.classList.remove('animate-fade-in-scale');
                            }
                        }
                    });
                });
            });
        }
    });
</script>

<?php
get_footer();
