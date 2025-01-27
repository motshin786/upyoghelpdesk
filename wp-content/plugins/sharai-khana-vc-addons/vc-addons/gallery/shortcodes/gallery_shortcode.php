<?php

add_shortcode('sharai_khana_gallery', 'sharai_khana_gallery');
add_shortcode('sharai_khana_gallery_item', 'sharai_khana_gallery_item');

//Main Gallery Block
        
function sharai_khana_gallery( $atts, $content ){

     $atts = shortcode_atts(array(
                         'id' => wp_rand(),
                         'custom_class_id' => wp_rand(),
                         'layout' => 'simple', // simple, carousel
                         'column' => '4',
                         'no_padding'=> 0,
                         'icon' => 'fa fa-file-photo-o',
                         'carousel_items' => '4',
                        'carousel_nav' => 0,
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR
                     ), $atts);
     
     extract($atts);
     
     // For Custom Theme.
     
     $custom_class = "";
     $custom_class_data= "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .gallery-box:after{background: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .gallery-box .gallery-icon-container li a:hover{color: " . $theme_color . ";}";
        $custom_class_data.=".kc_" . $custom_class_id . " .gallery-carousel .owl-dots .active span {background: " . $theme_color . ";}";
        
    }
     
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    $carousel = ( $layout == "carousel" ) ? 1 : 0;
     
     
     $output ='<div class="item_'.$column.' row '.$custom_class.'" '.$custom_class_data.'>';
     
        // Starting div condition for carousel.
        if( $carousel == 1 ) {
            
            $carousel_nav_status = ( $carousel_nav ==1 ) ? 'false' : 'true';
            
           $output.='<div class="gallery-carousel owl-carousel" data-carousel="1" data-items="' . $carousel_items . '" data-nav="' . $carousel_nav_status . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';
           
        }
     
     
        // Modified shortcode.

        $content = str_replace('[sharai_khana_gallery_item', '[sharai_khana_gallery_item layout="'.$layout.'" column="' . $column . '" no_padding="' . $no_padding . '" icon="' . $icon . '" ', $content);

        $output .=do_shortcode($content);
     
     // Ending div condition for carousel.    
        if( $carousel == 1 ) {
            $output .= '</div>';
        }
     
        $output .= '</div>';
     
     return $output;
    
}

// Generate Each Gallery Block.

function sharai_khana_gallery_item($atts,$content) {
    
    
    $atts = shortcode_atts(array(
        'layout' => 'simple', // simple, carousel
        'column' => '4',
        'gallery_img' => '',
        'no_padding'=> 0,
        'icon' => 'fa file-search',
        
     ), $atts);
    
    extract($atts);
    
    $column_class =  sharai_khana_gallery_column_class($column);    
    
    $feat_image_url = wp_get_attachment_url( $gallery_img  );
    
    // Featured Image For Gallery.

    $feat_image_url_string = "";

    $feat_image_info = sharai_khana_addon_get_img( $gallery_img );

    if ( !empty( $feat_image_info ) ) {

        $feat_image_url_string.= $feat_image_info;

    }
    
    $no_padding_class = "";
    
    if( isset( $no_padding ) && $no_padding == 1 ) {
        $no_padding_class = "no-padding-gallery";
    }
    
    $output = '<div class="'.$column_class.' gallery-container '.$no_padding_class.'">
                        <div class="gallery-box">
                        ' . $feat_image_url_string . '
                        <ul class="gallery-icon-container">
                            <li><a class="gallery-light-box" data-gall="myGallery" href="'.$feat_image_url.'"><i class="'.$icon.'"></i></a></li>
                        </ul>
                    </div>
                    </div>
                    ';
    
    return $output;
    
}