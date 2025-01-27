<?php
/**
 * @package sharai-khana
 */
$PostThumbnailControl = get_post_meta($post->ID, 'post-thumbnail-control', $single = true);
$PostTitleControl = get_post_meta($post->ID, 'post-title-control', $single = true);
$PostMetaControl = get_post_meta($post->ID, 'post-meta-control', $single = true);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('single-post-inner'); ?>>
    
    <?php // if post has custom field called PostThumbnailControl = Show, show the post thumbnail
        if ($PostThumbnailControl != 'Hide') {
            ?>

            <?php if (has_post_thumbnail()) : ?>
            <div class="post-feat-img">
                <?php the_post_thumbnail('sharai-khana-blog-single-large'); ?>
            </div>
            <?php endif; ?>

        <?php } ?>

    <div class="entry-content clearfix">
        
       
            <?php // if post has custom field called SinglePostMetaControl = Show, show the post meta in single post
            if ($PostMetaControl != 'Hide') {
                ?>
                <div class="entry-meta">
                    <?php sharai_khana_posted_on(); ?>
                <?php sharai_khana_categories_comment(); ?>
                </div><!-- .entry-meta -->
            <?php } ?>
          

        <?php the_content(); ?>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'sharai-khana'),
            'after' => '</div>',
        ));
        ?>
        
            <?php
                /* translators: used between list items, there is a space after the comma */
                $tags_list = get_the_tag_list('', '');
                if ($tags_list) {
                    printf('<div class="tags-links">' . esc_html__('%1$s', 'sharai-khana') . '</div>', $tags_list);
                }
            ?>
                
    </div><!-- .entry-content -->

     
</article><!-- #post-## -->
