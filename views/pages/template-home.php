<?php
/**
 * Template Name: Trang Chủ Hieucon
 * 
 * @package Hieucon
 */

/**
 * HOOK VÒNG ĐỜI CHO MVC: CÁCH HOẠT ĐỘNG
 * 
 * Nếu file template này được truy cập bằng WordPress (VD: bạn gán template cho Page) 
 * thì biến $data do Controller cấp phát sẽ KHÔNG CÓ => Lúc đó mình bắt buộc phải
 * "Đá" quá trình điều hướng về lại Controller Home_Controller::render().
 * 
 * Phía Controller load_view() sẽ require LẠI file này nhưng KÈM $data.
 */

if ( ! isset( $data ) ) {
    // Gọi Controller và thoái lui (Bắt đầu chu kỳ MVC)
    \Hieucon\Controller\Home_Controller::render();
    exit;
}

// ============== ĐÂY LÀ PHẦN VIEW HTML CHỈ NHẬN BIẾN ĐÃ XỬ LÝ (Không code query DB ở đây) =============
get_header(); ?>

<main id="primary" class="site-main">
    <div class="container" style="padding: 2em; max-width: 1200px; margin: auto; font-family: sans-serif;">
        <!-- Phần Component Banner -->
        <section class="hero text-center" style="background: #f1f5f9; padding: 4rem 2rem; border-radius: 8px;">
            <h1 style="color: #0f172a; margin-bottom: 0.5rem;"><?php echo esc_html( $hero_title ); ?></h1>
            <p style="color: #64748b; font-size: 1.1rem;"><?php echo esc_html( $hero_desc ); ?></p>
        </section>

        <!-- Phần Nội dung DB -->
        <section class="recent-posts" style="margin-top: 3rem;">
            <h2 style="border-bottom: 2px solid #e2e8f0; padding-bottom: 1rem;">Bài viết mới cập nhật</h2>
            
            <?php if ( ! empty( $recent_posts ) ) : ?>
                <div class="grid" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 1.5rem; margin-top: 1.5rem;">
                    <?php foreach ( $recent_posts as $post_obj ) : ?>
                        <article class="card" style="border: 1px solid #cbd5e1; padding: 1rem; border-radius: 8px;">
                            <h3 style="margin-top: 0; font-size: 1.25rem;">
                                <a href="<?php echo get_permalink( $post_obj->ID ); ?>" style="text-decoration: none; color: #2563eb;">
                                    <?php echo esc_html( $post_obj->post_title ); ?>
                                </a>
                            </h3>
                            <p style="color: #475569; font-size: 0.95rem;">
                                <?php echo wp_trim_words( $post_obj->post_content, 20 ); ?>
                            </p>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>Không có bài viết nào ở đây.</p>
            <?php endif; ?>
            
        </section>
    </div>
</main>

<?php get_footer(); ?>
