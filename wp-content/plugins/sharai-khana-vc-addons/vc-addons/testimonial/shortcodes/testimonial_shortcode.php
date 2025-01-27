<?php

add_shortcode('sharai_khana_testimonial', 'sharai_khana_testimonial');
add_shortcode('sharai_khana_testimonial_item', 'sharai_khana_testimonial_item');

//Main Testimonial Block
        
function sharai_khana_testimonial( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id'=> '',
                        'custom_class_id' => wp_rand(),
                        'layout' => 'layout_1',
                        'testimony_style' => 'large_icon',
                        'carousel'=> 0,
                        'item_per_row' => 4,
                        'carousel_nav' => 0,
                        'carousel_dots' => 0,
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'cont_ext_class' => '',
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                        'testimonial_bg'=> '#FFFFFF',
                        'testimonial_theme_color'=> '#555555',
                        'designation_color'=> '#888888',
                        'icon_bg'=> "#EEEEEE",
                        'content_alignment' => 'center'
                     ), $atts);
     
     extract($atts);

    // For Custom Theme.
     
     $custom_class = " sharai_khana_testimonial ";
     $custom_class_data= "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .owl-prev,";
        $custom_class_data.=".kc_" . $custom_class_id . " .owl-next{color: " . $theme_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .owl-dots .active span{background: " . $theme_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 {background: " . $testimonial_bg . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 div.testimony-content{color: " . $testimonial_theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 div.testimony-content::before{color: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1.testimony-layout-alt div.testimony-content::before {background: " . $theme_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 .testimony-meta img{border-color: " . $theme_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 .testimony-meta h6{ color: " . $designation_color . "!important; }";
        $custom_class_data.=".kc_" . $custom_class_id . " .testimony-layout-1 .testimony-meta span{ color: " . $designation_color . "!important; }";        
        
    }
     
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    $carousel = ( $layout == "layout_1" ) ? 1 : 0;
     
     $output ='<div class="item_'.$item_per_row.' row '.$custom_class.'" '.$custom_class_data.'>';
     
      // Starting div condition for carousel.
        if( $carousel == 1 ) {
            
            $carousel_nav_status = ( $carousel_nav == 1) ? 'false' : 'true';
            $carousel_dots_status = ( $carousel_dots == 1) ? 'false' : 'true';
            
           $output.='<div class="testimonial-container owl-carousel" data-carousel="1" data-items="' . $item_per_row . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
           
        }
     
            // Modified shortcode.

            $content = str_replace('[sharai_khana_testimonial_item', '[sharai_khana_testimonial_item layout="'.$layout.'" testimony_style="'.$testimony_style.'" cont_ext_class="'.$cont_ext_class.'" content_alignment="'.$content_alignment.'" item_per_row="'.$item_per_row.'" ', $content);

            $output .=do_shortcode($content);
     
        // Ending div condition for carousel.    
        if( $carousel == 1 ) {
            $output .= '</div>';
        }
        
     $output .= '</div>';
     
     return $output;
    
}

// Generate Each Testimonial Block.

function sharai_khana_testimonial_item( $atts, $content ) {
    
        $atts = shortcode_atts(array(
            'layout' => 'layout_1',
            'testimony_style' => 'large_icon',
            'item_per_row'=>2,
            'testimonial_info' => '',
            'user_name' => '',
            'user_designation' => '',
            'user_image' => '',
            'content_alignment' => 'left',
            'cont_ext_class' => ''
         ), $atts);

        extract($atts);
    
        $content_alignment_class = sharai_khana_alignment_class($content_alignment);
        
        $block_class = ( $layout == "layout_1" ) ? "col-md-12 col-sm-12" : sharai_khana_column_class($item_per_row);
        
        // Featured Image For Testimonial.
      
        $feat_image_url_string = "";
      
        $feat_image_info = sharai_khana_addon_get_img( $user_image );
      
        if ( !empty( $feat_image_info ) ) {

            $feat_image_url_string.= $feat_image_info;

        }
        
        $testimonial_layout_style = ( isset( $testimony_style ) && $testimony_style =="small_icon" ) ? 'testimony-layout-1 testimony-layout-alt ' . $cont_ext_class : 'testimony-layout-1 ' . $cont_ext_class;
        
        $output =  '<div class="' . $block_class . ' ' . $content_alignment_class . '">

                                <div class="' . $testimonial_layout_style . '">

                                    <div class="testimony-content">
                                        ' . $content . '
                                    </div>

                                    <div class="testimony-meta">

                                        ' . $feat_image_url_string . '
                                        <h6>' . $user_name . '</h6>
                                        <span>' . $user_designation . '</span>

                                    </div>

                                </div> <!-- end .testimony-layout-1  -->

                            </div> <!--  end col-sm-12  -->';

    return $output;
    
}