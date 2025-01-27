<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package sharai-khana
 */

if ( ! function_exists( 'sharai_khana_posts_navigation' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function sharai_khana_posts_navigation() {
	// Don't print empty markup if there's only one page.
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}
	?>
                <nav class="navigation posts-navigation" role="navigation">
                    <ul class="pager">

                        <?php if (get_next_posts_link()) : ?>
                            <li class="previous"><?php next_posts_link(esc_html__('Older posts', 'sharai-khana')); ?></li>
                        <?php endif; ?>

                        <?php if (get_previous_posts_link()) : ?>
                            <li class="next"><?php previous_posts_link(esc_html__('Newer posts', 'sharai-khana')); ?></li>
                        <?php endif; ?>

                    </ul><!-- .nav-links -->
                </nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sharai_khana_post_navigation' ) ) :
/**
 * Display navigation to next/previous post when applicable.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 */
function sharai_khana_post_navigation() {
	// Don't print empty markup if there's nowhere to navigate.
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );

	if ( ! $next && ! $previous ) {
		return;
	}
	?>
	<nav class="navigation post-navigation">
		<h2 class="sr-only"><?php esc_html_e( 'Post navigation', 'sharai-khana' ); ?></h2>
		<ul class="pager">
			<?php
				previous_post_link( '<li class="previous">%link</li>', esc_html__( 'Previous Post', 'sharai-khana' ) );
				next_post_link( '<li class="next">%link</li>', esc_html__( 'Next Post', 'sharai-khana' ) );
			?>
		</ul><!-- .nav-links -->
	</nav><!-- .navigation -->
	<?php
}
endif;

if ( ! function_exists( 'sharai_khana_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function sharai_khana_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		'<i class="fa fa-clock-o"></i>' . esc_html_x( ' %s', 'post date', 'sharai-khana' ),
		'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		'<i class="fa fa-user"></i>' . esc_html_x( ' %s', 'post author', 'sharai-khana' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);

	echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'sharai_khana_categories_comment' ) ) :
/**
 * Prints HTML with meta information for the categories and comments.
 */
function sharai_khana_categories_comment() {
	// Hide category for pages.
	if ( 'post' == get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'sharai-khana' ) );
		if ( $categories_list && sharai_khana_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder-o"></i> ' . esc_html__( '%1$s', 'sharai-khana' ) . '</span>', $categories_list );
		}
	}

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link"><i class="fa fa-comment-o"></i> ';
		comments_popup_link( esc_html__( 'Comment', 'sharai-khana' ), esc_html__( '1 Comment', 'sharai-khana' ), esc_html__( '% Comments', 'sharai-khana' ) );
		echo '</span>';
	}

}
endif;

if ( ! function_exists( 'sharai_khana_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the tags.
 */
function sharai_khana_entry_footer() {

        if ('post' == get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $tags_list = get_the_tag_list('', esc_html__(', ', 'sharai-khana'));
            if ($tags_list) {
                printf('<span class="tags-links"><i class="fa fa-tags"></i>' . esc_html__('Tagged: %1$s', 'sharai-khana') . '</span>', $tags_list);
            }
        }
}

endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function sharai_khana_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'sharai_khana_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'sharai_khana_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so sharai_khana_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so sharai_khana_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in sharai_khana_categorized_blog.
 */
function sharai_khana_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'sharai_khana_categories' );
}
add_action( 'edit_category', 'sharai_khana_category_transient_flusher' );
add_action( 'save_post',     'sharai_khana_category_transient_flusher' );