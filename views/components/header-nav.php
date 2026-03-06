<?php
/**
 * Component: Header Navigation
 */
?>
<nav class="main-navigation">
    <?php
    wp_nav_menu( array(
        'theme_location' => 'primary-menu',
        'menu_id'        => 'primary-menu',
        'container'      => false,
        'fallback_cb'    => false, // Không hiện menu mặc định nếu chưa gán
    ) );
    ?>
</nav>
