<?php
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
if (!function_exists('sharai_khana_comment')) :

    function sharai_khana_comment($comment, $args, $depth) {

        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' :
                // Display trackbacks differently than normal comments.
                ?>
                <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                    <p><?php esc_html_e('Pingback:', 'sharai-khana'); ?> <?php comment_author_link(); ?> <?php edit_comment_link(esc_html__('Edit', 'sharai-khana'), '<span class="ping-meta"><span class="edit-link">', '</span></span>'); ?></p>
                    <?php
                    break;
                default :
                    // Proceed with normal comments.
                    ?>
                <li id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>

                        <div class="comment-author vcard pull-left">
                            <?php echo get_avatar($comment, 42); ?>
                        </div><!-- .comment-author -->

                        <div class="comment-details">

                            <header class="comment-meta">
                                <cite class="fn"><?php esc_url( comment_author_link() ); ?></cite>
                                <br />
                                <div class="comment-date">
                                    <?php
                                    printf('<a href="%1$s"><time datetime="%2$s">%3$s</time></a>', esc_url(get_comment_link($comment->comment_ID)), get_comment_time('c'), sprintf(esc_html_x('%1$s at %2$s', '1: date, 2: time', 'sharai-khana'), get_comment_date(), get_comment_time())
                                    );
                                    edit_comment_link(esc_html__('Edit', 'sharai-khana'), ' <span class="edit-link">', '<span>');
                                    ?>
                                </div><!-- .comment-date -->
                            </header><!-- .comment-meta -->

                <?php if ('0' == $comment->comment_approved) : ?>
                                <p class="comment-awaiting-moderation"><?php esc_html_e('Your comment is awaiting moderation.', 'sharai-khana'); ?></p>
                            <?php endif; ?>

                            <div class="comment-content">
                            <?php comment_text(); ?>
                            </div><!-- .comment-content -->

                            <div class="reply">
                                    <?php comment_reply_link(array_merge($args, array('reply_text' => esc_html__('Reply', 'sharai-khana') . ' &rarr;', 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                            </div><!-- .reply -->

                        </div><!-- .comment-details -->

                    </article><!-- #comment-## -->
                <?php
                break;
        endswitch; // End comment_type check.
    }
endif;