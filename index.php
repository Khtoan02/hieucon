<?php
/**
 * The main template file
 *
 * @package Hieucon
 */

get_header(); ?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while ( have_posts() ) :
                the_post();
                // Template cơ bản, bạn có thể gọi Controller từ đây nếu cần
                the_title( '<h1>', '</h1>' );
                the_content();
            endwhile;
        else :
            echo '<p>Chưa có nội dung nào.</p>';
        endif;
        ?>
    </div>
</main>

<?php get_footer(); ?>
