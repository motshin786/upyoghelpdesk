<?php

add_shortcode('sharai_khana_service', 'sharai_khana_service');
add_shortcode('sharai_khana_service_item', 'sharai_khana_service_item');

//Main Service Block

function sharai_khana_service($atts, $content)
{

    $atts = shortcode_atts(array(
        'id' => wp_rand(),
        'custom_class_id' => wp_rand(),
        'layout' => '', // Grid/carousel
        'columns' => 3,
        'carousel' => 0,
        'carousel_nav' => 0,
        'carousel_dots' => 0,
        'carousel_autoplay' => 'true',
        'carousel_autoplaytimeout' => 5000,
        'theme' => '',
        'theme_color' => SHARAI_KHANA_PRIMARY_COLOR,
        'cont_ext_class' => '',
        'animation' => ''
    ), $atts);

    extract($atts);

    // For Custom Theme.

    $custom_class = "";
    $custom_class_data = "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class .= " sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-prev,";
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-next{color: " . $theme_color . " !important;}";
        $custom_class_data .= ".kc_" . $custom_class_id . " .owl-dots .active span{background: " . $theme_color . " !important;}";
        $custom_class_data .= ".kc_" . $custom_class_id . " .service-block-2 figure span.fa {background: " . $theme_color . ";}";
    }

    // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }


    //     $columns = ( $layout == 'layout_1' ) ? 2 : $columns;

    $output = '<div class="services  item_' . $columns . ' row ' . $custom_class . '" ' . $custom_class_data . '>';

    //@Since: Version 1.0.2
    // Carousel Layout.

    $carousel = ($layout == 'carousel' || $carousel == 1) ? 1 : 0;

    if ($carousel == 1) {

        $carousel_nav_status = ($carousel_nav == 1) ? 'false' : 'true';
        $carousel_dots_status = ($carousel_dots == 1) ? 'false' : 'true';

        $output .= '<div class="service-carousel owl-carousel"  data-carousel="' . $carousel . '" data-items="' . $columns . '" animation="' . $animation . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
    }

    // Modified shortcode.

    $content = str_replace('[sharai_khana_service_item', '[sharai_khana_service_item layout="' . $layout . '" cont_ext_class="' . $cont_ext_class . '" animation="' . $animation . '" columns="' . $columns . '"  "', $content);

    $output .= do_shortcode(sharai_khana_cleanup_shortcode($content));

    // Ending div condition for carousel.    
    if ($carousel == 1) {
        $output .= '</div>';
    }

    $output .= '</div>';

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
}

// Generate Each Service Block.

function sharai_khana_service_item($atts, $content)
{

    $atts = shortcode_atts(array(
        'custom_class_id' => wp_rand(),
        'layout' => '',
        'content_alignment' => 'text-left',
        'columns' => '3',
        'title' => '',
        'title_tag' => 'h2',
        'additional_title' => '',
        'short_desc_status' => 0,
        'short_desc' => '',
        'services_content' => '',
        'icon' => 'fa fa-wrench',
        'hide_service_icon' => 0,
        'service_image' => '',
        'read_more_link' => '#',
        'single' => 0,
        'theme' => '',
        'theme_bg' => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
        'service_icon_bg' => '#80b435', // Apply in to box background and box icon color (For Layout 1)
        'service_icon_color' => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
        'theme_hover_bg' => '#FBFBFB', // Apply in to box background and box icon color (For Layout 1)
        'theme_color' => '#40C1F0', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
        'theme_hover_color' => '#CEEFFB', // Apply in to box icon bg (For Layout 1 ), box icon color and button background #40C1F0
        'theme_border' => '#EBEBEB', // Apply in to box border, button border
        'border_status' => 1,
        'animation' => '',
        'cont_ext_class' => ''
    ), $atts);

    extract($atts);

    $custom_class = "";
    $custom_class_data = "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $btn_border = $theme_border;


        if (isset($border_status) && $border_status == 0) {
            $theme_border = 'transparent';
        }

        $custom_class .= " sharai_khana_custom kc_" . $custom_class_id;

        $custom_class_data .= '.kc_' . $custom_class_id . '{border-color: ' . $theme_border . '; background: ' . $theme_bg . ';}';
        $custom_class_data .= '.kc_' . $custom_class_id . ':hover{background: ' . $theme_hover_bg . ';}';
        $custom_class_data .= '.kc_' . $custom_class_id . ' h2 span{background: ' . $service_icon_bg . '; color: ' . $service_icon_color . '!important;}';
        $custom_class_data .= '.kc_' . $custom_class_id . ' figure span.fa{background: ' . $service_icon_bg . '!important; color: ' . $service_icon_color . '!important;}';

        $custom_class_data .= '.kc_' . $custom_class_id . ':hover figure span.fa{background: ' . $theme_hover_color . '!important;}';

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    // Featured Image For Service.

    $feat_image_url_string = "";

    $feat_image_info = sharai_khana_addon_get_img($service_image);

    if (!empty($feat_image_info)) {

        $feat_image_url_string .= $feat_image_info;
    }

    // Animation Class

    $sharai_khana_service_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_service_item'));
        $sharai_khana_service_animation = " " . $animate_class->getCSSAnimation($animation);
    }

    $content_alignment_class = sharai_khana_alignment_class($content_alignment) . $sharai_khana_service_animation  . ' ' . $cont_ext_class;

    // Layout 01

    if ($single == 1) {
        $column_class = ''; // Full width column
    } else {
        $column_class =  sharai_khana_column_class($columns);
    }

    $read_more_link_string = vc_build_link($read_more_link);
    $read_more_url = (isset($read_more_link_string['url']) && $read_more_link_string['url'] != "") ? esc_url($read_more_link_string['url']) : "#";


    /*----- Layout Class ----*/

    if (isset($layout) && $layout == "layout_3") {

        $service_layout_class = 'service-block-1 service-block-3';
    } else if (isset($layout) && $layout == "layout_2") {

        $service_layout_class = 'service-block-2';
    } else {

        $service_layout_class = 'service-block-1';
    }


    /*----- Additional Title ----*/
    $additional_title_class = '';
    $only_title = $title;
    if (isset($additional_title) && $additional_title != "") {
        $title .= '<br /><span>' . $additional_title . '</span>';
        //            $additional_title_class =' class="margin-top-rev-24"';
    }



    /*----- Service Icon Status. ----*/

    $service_icon = '<span class="' . $icon . '"></span>';

    if (isset($hide_service_icon) && $hide_service_icon == 1) {
        $service_icon = '';
    }


    $service_link_start = '<a href="' . $read_more_url . '" title="' . $only_title . '">';
    $service_link_end = '</a>';

    $service_content_wrapper_start = '';
    $service_content_wrapper_end = '';

    $service_content = '';
    $service_inline_link = '';

    $service_content_wrapper_start .= '<div class="service-content">';
    $service_content_wrapper_end .= '</div>';

    if (isset($layout) && $layout == "layout_3") {

        $service_link_start = '';
        $service_link_end = '';


        $service_inline_link .= '<a href="' . $read_more_url . '" class="btn btn-theme btn-theme-small margin-top-5">View Details</a>';
    }

    if ($short_desc_status == 1) {
        $service_content .= '<p>' . $short_desc . '</p>';
    }




    $output = '<div class="' . $column_class . '">
                
                                ' . $service_link_start . '

                                        <article class="' . $service_layout_class . ' ' . $content_alignment_class . ' ' . $custom_class . '" ' . $custom_class_data . '>

                                                <figure>
                                                     ' . $feat_image_url_string . '
                                                     ' . $service_icon . '
                                                </figure>
                                                
                                                ' . $service_content_wrapper_start . '

                                                    <h2 ' . $additional_title_class . '>' . $title . '</h2>
                                                        
                                                    ' . $service_content . '
                                                    ' . $service_inline_link . '
                                                    
                                                ' . $service_content_wrapper_end . '

                                        </article>

                                    ' . $service_link_end . '
                          </div>';



    return do_shortcode(sharai_khana_cleanup_shortcode($output));
}

// FOR SINGLE SERVICE.

add_shortcode('sharai_khana_single_service', 'sharai_khana_single_service');

function sharai_khana_single_service($atts, $content)
{

    $atts = shortcode_atts(array(
        'layout' => 'layout_1',
        'content_alignment' => 'left',
        'columns' => '4',
        'title' => '',
        'title_tag' => 'h2',
        'services_content' => '',
        'icon' => 'fa fa-wrench',
        'service_image' => '',
        'read_more_link' => '#',
        'single' => 1,
        'theme' => '',
        'theme_bg' => '#FFFFFF', // Apply in to box background and box icon color (For Layout 1)
        'animation' => '',
        'cont_ext_class' => ''
    ), $atts);

    extract($atts);

    // URL.

    $read_more_link_string = vc_build_link($read_more_link);

    // Modified shortcode.

    $content = '[sharai_khana_service_item '
        . 'layout="' . $layout . '" '
        . 'title="' . $title . '" '
        . 'services_content="' . $services_content . '" '
        . 'content_alignment="' . sharai_khana_alignment_class($content_alignment) . '" '
        . ' icon="' . $icon . '" '
        . ' service_image="' . $service_image . '" '
        . 'read_more_link="' . esc_url($read_more_link_string['url']) . '" '
        . 'single="' . $single . '" '
        . 'theme="' . $theme . '" '
        . 'theme_bg="' . $theme_bg . '" '
        . 'animation="' . $animation . '" '
        . 'cont_ext_class="' . $cont_ext_class . '"'
        . ']';

    $output = do_shortcode($content);

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
}