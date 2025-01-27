<?php
/**
 * The template for displaying all single posts.
 *
 * @package sharai-khana
 */

global $sharai_khana_wp_option;

$theme_default_header_style = sharai_khana_wp_option('theme_default_header_style');

if( $theme_default_header_style == "" ) {
    $theme_default_header_style = "";
}

get_header( $theme_default_header_style );

$PostSidebarControl = get_post_meta($post->ID, 'post-sidebar-control', $single = true);
$widthClass = ($PostSidebarControl == 'Without Sidebar' ? 'col-lg-12 col-md-12' : 'col-lg-8 col-md-8');
?>


<div class="row">

    <div id="primary" class="<?php echo esc_attr($widthClass); ?>" >
        
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'single'); ?>

                <?php sharai_khana_post_navigation(); ?>
     

                    <?php
                    // Display author bio if post isn't password protected
                    if (!post_password_required()) :
                        ?>

                        <?php if (get_the_author_meta('description') != '') : ?>  

                            <div class="article-author clearfix">

                                <div class="topic-bold-header clearfix">
                                    <h4><?php esc_html_e('Article by', 'sharai-khana'); ?> <?php the_author_posts_link(); ?></h4>
                                </div> <!-- end .topic-bold-header  -->

                                <figure class="author-avatar">

                                    <?php
                                    if (function_exists('get_avatar')) {
                                        echo get_avatar(get_the_author_meta('ID'), 80);
                                    }
                                    ?>

                                </figure>

                                <div class="about_author">
                                    <?php the_author_meta('description') ?>
                                </div>

            <?php
            // Retrieve a custom field value
            $fbHandle = get_the_author_meta('facebook');
            $fbHandle = ( $fbHandle == "") ? "#" : $fbHandle;

            $twitterHandle = get_the_author_meta('twitter');
            $twitterHandle = ( $twitterHandle == "") ? "#" : $twitterHandle;

            $gHandle = get_the_author_meta('gplus');
            $gHandle = ( $gHandle == "") ? "#" : $gHandle;
            ?>



                                <div class="social-icons margin-top-11 clearfix">
                                    <a class="fa fa-facebook social_icons" href="<?php echo esc_url($fbHandle); ?>" target="_blank"></a>
                                    <a class="fa fa-twitter social_icons" href="<?php echo esc_url($twitterHandle); ?>" target="_blank"></a>
                                    <a class="fa fa-google-plus social_icons" href="<?php echo esc_url($gHandle); ?>" target="_blank"></a>
                                </div>

                            </div> <!-- end .article-author  -->

        <?php endif; // no description, no author's meta   ?>

                        <?php
                    //end password protection check 
                    endif;
                    ?>
            

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // end of the loop.  ?>

        </main><!-- #main -->
        
    </div><!-- #primary -->

    <?php // if post has custom field called SidebarControl = Full Width, remove sidebar
    if ($PostSidebarControl == 'Without Sidebar') {
        ?>
    </div> <!-- .row -->
<?php

} else {
   }
get_footer();