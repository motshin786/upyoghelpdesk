<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package sharai-khana
 */
$PostThumbnailControl = get_post_meta($post->ID, 'post-thumbnail-control', $single = true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content clearfix">

        <?php the_content(); ?>
        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'sharai-khana'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

</article><!-- #post-## -->
