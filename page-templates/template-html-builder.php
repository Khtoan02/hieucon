<?php
/**
 * Template Name: Trang Dán HTML Tự Do (Blank Canvas)
 * Description: Template này dùng để người quản trị dán trực tiếp mã HTML vào khung nội dung của WordPress.
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="custom-html-content">
        <?php
        while ( have_posts() ) :
            the_post();
            
            // Hàm the_content() sẽ xuất ra nội dung (HTML) mà bạn đã dán trong trang quản trị
            the_content();

        endwhile; // End of the loop.
        ?>
    </div>
</main><!-- #primary -->

<?php
get_footer();
?>
