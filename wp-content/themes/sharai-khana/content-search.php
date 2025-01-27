<?php
/**
 * The template part for displaying results in search pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package sharai-khana
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <div class="entry-content clearfix">
        <?php the_title(sprintf('<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h2>'); ?>
        
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-feat-img">
                <?php the_post_thumbnail('sharai-khana-blog-single-large'); ?>
            </div>
            <?php endif; ?>
        
         <div class="entry-meta clearfix">
                    <?php sharai_khana_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php sharai_khana_search_excerpt_highlight(); ?>
    </div><!-- .entry-summary -->

</article><!-- #post-## -->
