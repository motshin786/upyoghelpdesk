<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package sharai-khana
 */

global $sharai_khana_wp_option;

$theme_default_header_style = sharai_khana_wp_option('theme_default_header_style');

if( $theme_default_header_style == "" ) {
    $theme_default_header_style = "";
}

get_header($theme_default_header_style);
 
$PostSidebarControl = get_post_meta($post->ID, 'post-sidebar-control', $single = true);
$widthClass = ($PostSidebarControl == 'Without Sidebar' ? 'col-lg-12 col-md-12' : 'col-lg-8 col-md-8');
?>

<div class="row">

    <div id="primary" class="<?php echo esc_attr($widthClass); ?>" >
        <main id="main" class="site-main">

            <?php while (have_posts()) : the_post(); ?>

                <?php get_template_part('content', 'page'); ?>

                <?php
                // If comments are open or we have at least one comment, load up the comment template
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                ?>

            <?php endwhile; // end of the loop.  ?>

        </main><!-- #main -->
    </div><!-- #primary -->

    <?php // if post has custom field called PostSidebarControl = Full Width, remove sidebar
    if ($PostSidebarControl == 'Without Sidebar') {
        ?>
    </div> <!-- .row -->
<?php
} else {
    
    $assigned_sidebar = "";
    
    if( is_page(array('cart', 'checkout','my-account'))) {
        $assigned_sidebar = "wc_custom";
    }
    
    get_sidebar( $assigned_sidebar );
}
get_footer(); 