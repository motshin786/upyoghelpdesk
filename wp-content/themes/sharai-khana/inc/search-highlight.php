<?php
/**
 * Custom function to highlight search terms
 *
 *
 * @package sharai-khana
 */

function sharai_khana_search_excerpt_highlight() {
    
//    $excerpt = get_the_excerpt();
    
    $the_post = get_post();
    $excerpt = apply_filters('the_excerpt', $the_post->post_excerpt);
                
    $keys = implode('|', explode(' ', get_search_query()));
    $excerpt = preg_replace('/(' . $keys .')/iu', '<strong class="search-highlight">\0</strong>', $excerpt);
    echo '<p>' . do_shortcode(wp_kses($excerpt, sharai_khana_allowed_tags())) . '</p>';
    
}