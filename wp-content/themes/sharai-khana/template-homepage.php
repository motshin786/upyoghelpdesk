<?php
/**
 *
 * Template Name: Homepage
 *
 * The template for displaying the homepage.
 *
 * @package sharai-khana
 */
get_header();
?>

<div class="row">

    <div id="primary" class="">
        
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'page'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // end of the loop. ?>

        </main><!-- end #main -->
        
    </div><!-- end #primary -->

</div> <!-- end .row  -->

<?php 
get_footer();