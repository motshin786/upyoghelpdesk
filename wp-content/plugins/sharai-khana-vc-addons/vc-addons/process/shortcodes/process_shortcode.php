<?php

add_shortcode('sharai_khana_process', 'sharai_khana_process');
add_shortcode('sharai_khana_process_item', 'sharai_khana_process_item');

//MAIN PROCESS BLOCK
        
function sharai_khana_process( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id' => wp_rand(),
                        'custom_class_id' => wp_rand(),
                        'layout' => '', // Grid/carousel
                        'content_alignment' => 'left',
                        'columns' => 3,
                        'rm_link_status'=> 0,
                        'box_shadow_status' => 0,
                        'carousel_nav' => 0,
                        'carousel_dots' => 0,
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                        'animation' => '',
                        'cont_ext_class' => ''
                     ), $atts);
     
     extract($atts);
     
      // For Custom Theme.
     
     $custom_class = "";
     $custom_class_data= "";
     
     // No Gutter Class Fixing.
     
    if( isset($cont_ext_class) && $cont_ext_class !="" && strpos( $cont_ext_class, "no-gutter" ) !== false ){
         $custom_class .= $cont_ext_class ;
    }

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .process-container i.nav-icon:after{background: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .process-container .owl-dots .active span {background: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .process-container .owl-nav .owl-prev{color: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .process-container .owl-nav .owl-next{color: " . $theme_color . ";}";
        
    }
     
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        
    }
     
     $columns = ( $layout == 'layout_1' ) ? 2 : $columns;
      
     $output ='<div class="item_'.$columns.' row process-block '.$custom_class.'" '.$custom_class_data.'>';
     
     //@Since: Version 1.0.2
     // Carousel Layout.
     
     $carousel = ( $layout == 'carousel' ) ? 1 : 0;
     
      if( $carousel == 1 ) {
            
            $carousel_nav_status = ( $carousel_nav ==1) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots ==1) ? 'false' : 'true';
            
           $output.='<div class="process-carousel owl-carousel"  data-carousel="'.$carousel.'" data-items="' . $columns . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
           
        }
     
     // Modified shortcode.
     
     $content = str_replace('[sharai_khana_process_item', '[sharai_khana_process_item layout="'.$layout.'" columns="'.$columns.'" cont_ext_class="' . $cont_ext_class . '" animation="'.$animation.'" box_shadow_status="'.$box_shadow_status.'" content_alignment="'.$content_alignment.'" "', $content);
     
     $output .=do_shortcode(sharai_khana_cleanup_shortcode($content));
     
     // Ending div condition for carousel.    
        if( $carousel == 1 ) {
            $output .= '</div>';
        }
     
     $output .= '</div>';
     
     return do_shortcode( sharai_khana_cleanup_shortcode( $output ) ); 
    
}

// GENERATE EACH PROCESS BLOCK.

function sharai_khana_process_item( $atts, $content ) {
    
    $atts = shortcode_atts(array(
                                            'custom_class_id' => wp_rand(),
                                            'layout' => '',
                                            'content_alignment' => 'center',
                                            'icon_type' => 'img_icon',
                                            'icon' => 'fa fa-book',
                                            'process_image' => '',
                                            'process_icon' => '',
                                            'columns' => '3',
                                            'animation' => '',
                                            'title' => '',
                                            'process_count_status' => 0,
                                            'process_count_value' => '',
                                            'process_content' => '',
                                            'rm_link_status' => 0,
                                            'read_more_link' => '#',
                                            'box_shadow_status' => 0,
                                            'cont_ext_class' => '',
                                            'theme' => '',
                                            'theme_bg' => '#FFFFFF',
                                            'theme_hover_bg' => '#FBFBFB',
                                            'process_title_color' => SHARAI_KHANA_PRIMARY_COLOR,
                                            'process_icon_color' => SHARAI_KHANA_PRIMARY_COLOR,
                                            'process_count_color' => SHARAI_KHANA_PRIMARY_COLOR,
                                            'process_info_color' => SHARAI_KHANA_TEXT_COLOR,
                                            'count_box_bg' => SHARAI_KHANA_PRIMARY_COLOR,
                                            'count_box_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR, // Apply in to box border, button border
                                        ), $atts);
    
    extract($atts);
    
     // Alignment.
     
     $content_alignment = sharai_khana_alignment_class($content_alignment);
     
     /*----- Box Shadow ----*/
        
        $box_shadow_class = "";
        
        if( isset( $box_shadow_status ) && $box_shadow_status==1 ) {
            
            $box_shadow_class .= ' theme-custom-box-shadow ';
            
        }
     
     // Animation Class
    
    $sharai_khana_process_animation = "";
    
    if( isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button( array( 'base' => 'sharai_khana_process_item' ) );
        $sharai_khana_process_animation = " ".$animate_class->getCSSAnimation( $animation );
    }
    
    
    $custom_class = "";
    $custom_class_data = "";
    
     if (isset( $theme ) && !empty( $theme ) && $theme =="custom" ) {
     
        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;

        $custom_class_data.='.kc_' . $custom_class_id . '{background: ' . $theme_bg . ';}';
        $custom_class_data.='.kc_' . $custom_class_id . ':hover{background: ' . $theme_hover_bg . ';}';

        $custom_class_data.='.kc_' . $custom_class_id . ' i.fa {color: ' . $process_icon_color . ';}';
        $custom_class_data.='.kc_' . $custom_class_id . ' h3 {color: ' . $process_title_color . ';}';
        $custom_class_data.='.kc_' . $custom_class_id . ' h3 a{color: ' . $process_title_color . ' !important;}';
        $custom_class_data.='.kc_' . $custom_class_id . ' .process_count {color: ' . $process_count_color . ' !important;}';
        $custom_class_data.='.kc_' . $custom_class_id . ' .process-info{color: ' . $process_info_color . ' !important;}';

        $custom_class_data = ' data-custom_style="'.$custom_class_data.'"';
        
      }
      
        /*-----  Icon/Image Settings ----*/
      
       $feat_image_url_string = "";

        if (isset( $icon_type ) && $icon_type == "fa_icon") {

            $feat_image_url_string .= '<i class="' . $icon . '"></i>';
            
        } else {
            
            $feat_image_info = sharai_khana_addon_get_img( $process_image );

            if ( !empty( $feat_image_info ) ) {

                $feat_image_url_string.= $feat_image_info;
                
            }
            
        }



    // Layout 01

    $column_class = sharai_khana_column_class($columns);
    
    $column_class = $column_class .' ' .$sharai_khana_process_animation;  
    
    $content_alignment_class = $box_shadow_class;
    
    // Container Extra Class.
    
    if( isset($cont_ext_class) && $cont_ext_class != "" ) {
        $content_alignment_class.= ' ' . $cont_ext_class;
    }
    
    // Heading Title
    
    $heading_title = $title;
    
    // Process Count
    
    if(isset($process_count_status) && $process_count_status == 1 && $process_count_value !="" ) {
        $heading_title .= "<span class='process_count'>" . $process_count_value . "</span>";
    }
    
    // Custom Heading Link.

    if ( isset( $rm_link_status ) && $rm_link_status == 1) {

        $read_more_link_string = vc_build_link($read_more_link);

        $highlight_link = ( isset($read_more_link_string['url']) && $read_more_link_string['url'] != "" ) ? esc_url($read_more_link_string['url']) : "#";

        $highlight_target = ( isset($read_more_link_string['target']) && $read_more_link_string['target'] != "" ) ? ' target="_blank"' : "";

        $heading_title = '<a href="' . $highlight_link . '" ' . $highlight_target . ' title="' . $title . '">' . $heading_title . '</a>';
    }
    
    $output = '<div class="' . $column_class . '">
                        <div class="process-step-1 ' . $content_alignment_class . ' ' . $custom_class . '" ' . $custom_class_data . '>
                             ' . $feat_image_url_string . '
                            <h3>' . $heading_title . '</h3>
                            <div class="process-info">' . $process_content . '</div>
                        </div> 
                    </div>';


    return do_shortcode( sharai_khana_cleanup_shortcode( $output ) ); 
    
}