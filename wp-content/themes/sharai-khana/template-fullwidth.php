<?php
/**
 *
 * Template Name: Full Width Template
 *
 * The template for displaying the contents without any sidebar.
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

    <div id="primary" class="col-md-12 col-lg-12" >
        
        <main id="main" class="site-main">

            <?php if (have_posts()) : ?>

                <?php /* Start the Loop */ ?>
                <?php while (have_posts()) : the_post(); ?>

                    <?php
                    /* Include the Post-Format-specific template for the content.
                     * If you want to override this in a child theme, then include a file
                     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                     */
                    get_template_part('content', 'page');
                    ?>

                <?php endwhile; ?>

                <?php sharai_khana_posts_navigation(); ?>

            <?php else : ?>

                <?php get_template_part('content', 'none'); ?>

            <?php endif; ?>

        </main><!-- #main -->
        
    </div><!-- #primary -->

</div><!-- .row end -->

<?php 
get_footer();