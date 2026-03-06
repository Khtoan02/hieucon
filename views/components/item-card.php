<?php
/**
 * Component: Item Card (Post/Product)
 * Yêu cầu: Biến $post_obj được truyền từ tệp gọi
 */

if ( ! isset( $post_obj ) ) return;
?>
<article class="item-card">
    <a href="<?php echo get_permalink( $post_obj->ID ); ?>" class="card-link">
        <?php echo get_the_post_thumbnail( $post_obj->ID, 'medium' ); ?>
        <h3><?php echo esc_html( $post_obj->post_title ); ?></h3>
    </a>
</article>
