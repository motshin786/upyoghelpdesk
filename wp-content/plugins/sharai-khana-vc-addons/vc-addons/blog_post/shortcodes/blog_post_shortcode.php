<?php

add_shortcode('sharai_khana_blog_post', 'sharai_khana_blog_post');

function sharai_khana_blog_post($atts)
{

    // Enqueue styles.

    $id_prefix = wp_rand();

    $atts = shortcode_atts(
        array(
            'custom_class_id' => wp_rand(),
            'post_type' => 'post',
            'layout' => 'layout_1',
            'meta_key' => '',
            'meta_value' => '',
            'orderby' => 'ID',
            'order' => 'ASC',
            'limit' => -1,
            'category' => '',
            'posts_count' => 0,
            'column' => '3',
            'desc_length' => 21,
            'content_alignment' => 'left',
            'carousel' => 0,
            'carousel_items' => 4,
            'carousel_nav' => 1,
            'carousel_dots' => 0,
            'carousel_autoplay' => 'true',
            'carousel_autoplaytimeout' => 5000,
            'theme' => '',
            'theme_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'cont_ext_class' => '',
            'animation' => '',
            'box_shadow_status' => 1
        ),
        $atts
    );

    extract($atts);

    // Animation Class

    $sharai_khana_blog_post_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_blog_post'));
        $sharai_khana_blog_post_animation = " " . $animate_class->getCSSAnimation($animation);
    }

    /* ----- Box Shadow ---- */

    $box_shadow_class = "";

    if (isset($box_shadow_status) && $box_shadow_status == 1) {

        $box_shadow_class .= ' theme-custom-box-shadow';
    }

    // For Custom Theme.

    $custom_class = "";
    $custom_class_data = "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class .= " sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-prev,";
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-next{color: " . $theme_color . " !important;}";
        $custom_class_data .= ".kc_" . $custom_class_id . "  figure:after {color: " . $theme_color . " !important;}";
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-dots .active span{background: " . $theme_color . " !important;}";
        $custom_class_data .= ".kc_" . $custom_class_id . " .latest-blog-alt .latest-details{background: " . $theme_color . " !important;}";
    }

    // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    //    $output = '<div class="row' . $custom_class . '" ' . $custom_class_data . '>';
    $output = '<div class="item_' . $column . $custom_class . '" ' . $custom_class_data . '>';

    //    $carousel = ( $layout == 'layout_2') ? 1 : 0;
    $carousel_items = $column;

    // Starting div condition for carousel.
    if ($carousel == 1) {

        $carousel_nav_status = ($carousel_nav == 1) ? 'false' : 'true';
        $carousel_dots_status = ($carousel_dots == 1) ? 'false' : 'true';

        $output .= '<div class="latest-news-carousel owl-carousel" data-carousel="1" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '"  data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
    }

    $args = array(
        'post_status' => 'publish',
        'post_type' => $post_type,
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $limit,
        'ignore_sticky_posts' => 0
    );

    if (isset($category) && $category != "") {
        $args['category_name'] = $category;
    }

    $column_class = sharai_khana_column_class($column);

    $counter = 0;

    $outer_loop = 1;

    $end_point = $column - 1;

    $loop = new WP_Query($args);

    if ($loop->have_posts()) :

        $ecs_total_item = $loop->post_count;

        while ($loop->have_posts()) :

            $loop->the_post();

            if ($counter % $column == 0 && $carousel != 1) {
                $output .= '<div class="row new-blog-row">';
            }

            // Gather All Causes Data.

            $post_id = get_the_ID();
            $author = get_the_author();

            $news_date = get_the_time('d');
            //            $news_month = get_the_time('F Y');
            $news_month = get_the_time('d, F Y');

            $post_single_page_url = get_the_permalink();

            $news_post_title = '<a href="' . $post_single_page_url . '">' . get_the_title() . '</a>';

            if ($desc_length == 0) {
                $news_excerpt_content = '';
            } else if ($desc_length > 0) {

                $crop_content = wp_trim_words(get_the_content(), $desc_length);

                $news_excerpt_content = substr($crop_content, 0, strlen($crop_content) - 8);
            } else {
                $news_excerpt_content = get_the_content();
            }

            $news_thumb = "";

            if (has_post_thumbnail()) {

                $news_thumb = get_the_post_thumbnail($post_id, 'large');
            }

            $post_category = get_the_category();
            $category_link = get_term_link($post_category[0]->slug, 'category');

            $content_alignment_class = sharai_khana_alignment_class($content_alignment);

            $column_class = $column_class . ' ' . $sharai_khana_blog_post_animation;

            $latest_news_container_class = 'latest-news-container' . $box_shadow_class . ' ' . $cont_ext_class;

            $latest_news_container_class .= (isset($layout) && $layout == "layout_2") ? ' latest-blog-alt' : '';

            $output .= '<div class="' . $column_class . ' ' . $content_alignment_class . '">
                    
                        <div class="' . $latest_news_container_class . '"> 
                            
                            <div class="latest-thumbnail">
                                <a href="' . $post_single_page_url . '">
                                     ' . $news_thumb . '
                                </a>
                            </div>
                            <div class="news-content">                               
                                <h4 class="latest-title">
                                    ' . $news_post_title . '
                                </h4>                           
                                <div class="latest-details">
                                        <span> <i class="fa fa-pencil-square-o"></i> ' . $author . ' </span> 
                                        <span> &nbsp; <i class="fa fa-comment-o"></i> ' . $loop->comment_count . ' Comments </span>
                                </div>      
                               <p>' . $news_excerpt_content . '</p>
                            </div> 

                        </div> <!-- end latest  -->
                        
                        </div> <!--  end col-lg-4  -->';

            if (($counter == $end_point || $ecs_total_item == $outer_loop) && $carousel != 1) {

                $output .= '</div><!-- end .row-new--> ';

                $counter = 0;
            } else {

                $counter++;
            }

            $outer_loop++;


        endwhile;

    else :

        // Regular View.
        $output .= "<p>" . __('Sorry, No news found!', 'sharai_khana_vc') . "</div>";

    endif;

    // Ending div condition for carousel.    
    if ($carousel == 1) {
        $output .= '</div>';
    }

    $output .= '</div><!--  end .row -->';

    wp_reset_query();
    return $output;
}