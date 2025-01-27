<?php
/**
 * The template for displaying search results pages.
 *
 * @package sharai-khana
 */

global $sharai_khana_wp_option;

$theme_default_header_style = sharai_khana_wp_option('theme_default_header_style');

if( $theme_default_header_style == "" ) {
    $theme_default_header_style = "";
}

get_header($theme_default_header_style);

?>

<div class="row">

    <div id="primary" class="col-lg-8 col-md-8">
        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>

                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php get_template_part('content', 'search'); ?>

                <?php endwhile; ?>

                <?php the_posts_navigation(); ?>

            <?php else : ?>

                <?php get_template_part('content', 'none'); ?>

            <?php endif; ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php
    get_sidebar();
    get_footer();