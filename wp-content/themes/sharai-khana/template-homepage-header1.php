<?php
/**
 *
 * Template Name: Homepage Header 01
 *
 * The template for displaying the homepage with header style 01.
 *
 * @package sharai-khana
 */
get_header('style-1');
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