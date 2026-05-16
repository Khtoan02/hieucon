<?php
/**
 * The header for our landing pages
 *
 * @package Hieucon
 */
?><!doctype html>
<html <?php language_attributes(); ?> class="scroll-smooth">
<?php get_template_part('template-parts/header/site-head'); ?>

<body <?php body_class('bg-white text-text-dark antialiased leading-relaxed font-quicksand'); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
    <!-- Header tối giản cho Landing Page -->
    <header class="bg-navy py-4 text-center sticky top-0 z-[100] shadow-md">
        <a href="<?php echo home_url('/'); ?>" class="inline-block transition-transform hover:scale-105">
            <?php if ( has_site_icon() ) : ?>
                <img src="<?php echo esc_url(get_site_icon_url(96)); ?>" alt="<?php bloginfo('name'); ?>" class="mx-auto h-12 md:h-14 rounded-xl bg-white p-1">
            <?php else : ?>
                <div class="mx-auto h-12 w-12 bg-white text-navy flex items-center justify-center rounded-xl shadow-sm"><i data-lucide="dna" class="w-8 h-8" aria-hidden="true"></i></div>
            <?php endif; ?>
        </a>
    </header>
