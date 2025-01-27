<?php
/**
 * @package sharai-khana
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    
    <header class="entry-header">

        <?php if (has_post_thumbnail()) : ?>
            <a href="<?php echo esc_url(get_permalink()); ?>" title="<?php esc_attr(the_title_attribute()); ?>" class="text-center db">
                <?php the_post_thumbnail('sharai-khana-blog-single-large'); ?>
            </a>
        <?php endif; ?>

    </header><!-- .entry-header -->

    <div class="entry-content clearfix">
        
        <?php the_title(sprintf('<h1 class="entry-title"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h1>'); ?>

        <?php if (is_search()) : // Only display Excerpts for Search ?>
            
        <?php the_excerpt(); ?>

        <?php
        
            else :

                 $the_post = get_post();
                echo $post_excerpt = apply_filters('the_excerpt', $the_post->post_excerpt);

            endif;
        ?>
        
    </div><!-- .entry-content -->

    <footer class="entry-footer">
            <?php if ('post' == get_post_type()) : ?>
                <div class="entry-meta clearfix">
                    <?php sharai_khana_posted_on(); ?>
                    <?php sharai_khana_categories_comment(); ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->