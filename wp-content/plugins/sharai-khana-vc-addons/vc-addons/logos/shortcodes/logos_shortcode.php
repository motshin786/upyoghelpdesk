<?php

add_shortcode('sharai_khana_logos', 'sharai_khana_logos');
add_shortcode('sharai_khana_logo_item', 'sharai_khana_logo_item');

//Main Logos Block
        
function sharai_khana_logos( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id' => 'logo_'.wp_rand(),
                        'custom_class_id' => wp_rand(),
                        'layout' => 'layout_1',
                        'carousel'=> 0,
                        'carousel_items' => 4,
                        'carousel_nav' => 0,
                        'carousel_dots' => 0,
                        'carousel_nav_icon_left' => 'fa fa-angle-left',
                        'carousel_nav_icon_right' => 'fa fa-angle-right',         
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                        'cont_ext_class' => '',
                        'animation' => ''
                     ), $atts);
     
     extract($atts);
     
     // For Custom Theme.

    $custom_class = "";
    $custom_class_data = "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
//        $custom_class_data.=".kc_" . $custom_class_id . " .logo-layout-1 .client-logo,";
        $custom_class_data.=".kc_" . $custom_class_id . " .logo-layout-1 .client-logo:hover{border: 1px solid " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .logo-items .owl-nav i.logo-nav-icon:after{background:" . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .logo-items .owl-dots .active span{background:" . $theme_color . ";}";
    }

    // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }
    
     // Animation Class
    
    $sharai_khana_logo_animation = "";
    
    if( isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button( array( 'base' => 'sharai_khana_logos' ) );
        $sharai_khana_logo_animation = " ".$animate_class->getCSSAnimation( $animation );
    }

     $carousel = ( $layout == "layout_2" ) ? 1 : 0;
     
     $logo_layout_class = ( $layout == "layout_2" ) ? "logo-layout-1 logo-carousel owl-carousel" : "logo-layout-1";
     
     $output ='<div class="item_'.$carousel_items.' row '.$custom_class.'" '.$custom_class_data.'>';
     
            if ( $carousel == 1 ) {

             // Starting div condition for carousel.


                   $carousel_nav_status = ( $carousel_nav ==1 ) ? 'false' : 'true';
                   $carousel_dots_status = ( $carousel_dots == 1 ) ? 'false' : 'true';

                  $output.='<div class="logo-items '.$logo_layout_class.' text-center" data-carousel="'.$carousel.'" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
     
           } else {
               
               $output.='<div class=" '.$logo_layout_class.' text-center">';
               
           }
            // Modified shortcode.

            $content = str_replace('[sharai_khana_logo_item', '[sharai_khana_logo_item layout="'.$layout.'" cont_ext_class="' . $cont_ext_class . '" animation="'.$sharai_khana_logo_animation.'" carousel_items="' . $carousel_items . '"', $content);

            $output .=do_shortcode($content);
            
            // Ending div condition for carousel.    
 
            $output .= '</div>';
        
     $output .= '</div>';
     
     return $output;
    
}

// Generate Each Logos Block.

function sharai_khana_logo_item( $atts,$content ) {
    
    $atts = shortcode_atts(array(
        'layout' => '',
        'logo_title' => '',
        'logo_image' => '',
        'logo_custom_link' => '#',
        'carousel_items' => '6',
        'cont_ext_class' => '',
        'animation' => ''
     ), $atts);
    
    extract($atts);
    
    $output = "";
    
    // Featured Image For Logos.

    $feat_image_url_string = "";

    $feat_image_info = sharai_khana_addon_get_img( $logo_image );

    if ( !empty( $feat_image_info ) ) {

        $title = $logo_title;

        $feat_image_url_string.= $feat_image_info;

    }    
    
    // Logo URL.
    
    $logo_custom_url = $logo_custom_link;
    
    $logo_custom_url_target = "";
            
    if( isset($logo_custom_link) && $logo_custom_link !="#") {

        $logo_custom_string = vc_build_link($logo_custom_link);
        $logo_custom_url = esc_url( $logo_custom_string['url'] );
        $logo_custom_url_target = ( isset( $logo_custom_string['target'] ) && $logo_custom_string['target'] !="" ) ? ' target="_blank"' : '';
        
        $feat_image_url_string = '<a href="' . $logo_custom_url . '" title="' . $logo_title . '" ' . $logo_custom_url_target . '>'.$feat_image_url_string.'</a>';
        
    }
    
    // Animation Class
    
    if( isset($animation) && $animation != "") {
        
        $sharai_khana_logo_animation = $animation;
        
    } else {
    
        $sharai_khana_logo_animation = "";
        
    }
 
    $column_class = sharai_khana_column_class( $carousel_items );
    
    $client_logo= 'client-logo' . ' ' . $cont_ext_class;
    
    if ($layout == "layout_2") {
   
        $output .= '<div class="col-xs-12 col-sm-2 col-md-2 col-lg-2 logo-container '.$sharai_khana_logo_animation.'">
                                <div class="' . $client_logo . '">
                                    ' . $feat_image_url_string . '
                                </div>
                            </div> ';
        
    } else {
        
        $output .= '<div class="'.$column_class.' logo-container '.$sharai_khana_logo_animation.'">
                                <div class="' . $client_logo . '">
                                    ' . $feat_image_url_string . '
                                </div>
                            </div> ';
    }
        
    return $output;
    
}