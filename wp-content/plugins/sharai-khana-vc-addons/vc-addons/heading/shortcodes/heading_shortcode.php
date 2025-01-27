<?php

add_shortcode('sharai_khana_vc_heading', 'sharai_khana_vc_heading');

function sharai_khana_vc_heading( $atts, $content ) {
//    heading-separator-
    $atts = shortcode_atts(
            array(
            'id' => '',
            'custom_class_id' => wp_rand(),
            'title' => '',
            'title_tag' => 'h2',
            'title_color' => SHARAI_KHANA_TEXT_COLOR,
            'custom_title_class' => '',    
            'sub_title' => '',
            'sub_title_tag' => 'h4',
            'sub_title_color' => SHARAI_KHANA_TEXT_COLOR,
            'custom_sub_title_class' => '',
            'alt_pos' => 0,
            'theme' => '',
            'layout' => 'layout_1',
            'border_upper' => '#40C1F0',
            'border_bottom' => '#EEEEEE',
            'sep_img' => '',
            'hide_sep_img' => 0,
            'horizontal_sep_status' => 0,
            'sep_color' => SHARAI_KHANA_PRIMARY_COLOR,
            'sep_pos' => '', // default= 'between heading and sub heading', 'after_heading', 'before_heading', 'after_sub_heading', 'before_sub_heading'    
            'sep_attachment' => '', // default= 'with_sub_title', 'with_title', 'before_heading', 'after_sub_heading', 'before_sub_heading'    
            'content_alignment' => 'center',
            'animation' => '',
            ), $atts);

    extract($atts);
    
    // Animation Class

    $sharai_khana_heading_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_vc_heading'));
        $sharai_khana_heading_animation = " " . $animate_class->getCSSAnimation($animation);
    }
          
    $custom_class = "";
    $custom_class_data= "";
    
    $custom_heading_style = "";
    $custom_sub_heading_style = "";
    $custom_sep_color_style = "";
    
    $sep_img_url = "";
    $horizontal_sep_class = "";
    
    if( isset($horizontal_sep_status) && $horizontal_sep_status == 1 ) {
        $horizontal_sep_class=" heading-separator-horizontal";
    }
    
    $content_alignment_class = sharai_khana_alignment_class($content_alignment) . $sharai_khana_heading_animation;
    
    // Alter Position Class.
    
    $alt_pos_class = "";
    $alt_pos_status = 0;
    
    if( isset( $alt_pos ) && $alt_pos == 1 ) {
    
        $alt_pos_class = "heading-alt-pos";
        $alt_pos_status = 1;
    
    }
    
    
    if( $theme == "custom" ) {
        
        // For heading text custom style.
        
        if (isset( $title_color ) && !empty( $title_color ) && $title_color !=SHARAI_KHANA_TEXT_COLOR ) {
            
            $custom_heading_style .='color:'.$title_color.';';
        
        }
        
        // For Sub heading text custom style.
        
        if (isset( $sub_title_color ) && !empty( $sub_title_color ) && $sub_title_color !=SHARAI_KHANA_TEXT_COLOR ) {
        
            $custom_sub_heading_style .='color:'.$sub_title_color.';';
        
        }
        
        // For Sub heading text custom style.
        
        if (isset( $sep_color ) && !empty( $sep_color ) && $sep_color !=SHARAI_KHANA_PRIMARY_COLOR ) {
        
            $custom_sep_color_style .='background:'.$sep_color.';';
        
        }
        
    }
    
    
    // If Layout3 Then Custom CSS Will Generate.
    
    if( $layout == 'layout_3') {
        
        // For Layout 3 border bottom.
         
         if (isset( $border_upper ) && !empty( $border_upper ) && $border_upper !="#40C1F0" && $layout == "layout_3") {
        
            $custom_class.=" sharai_khana_custom kc_".$custom_class_id;
            $custom_class_data.="h2.kc_".$custom_class_id."::after{background: ".$border_upper.";}";
            
        }
        
        
        // For Layout 3 border bottom.
         
         if (isset( $border_bottom ) && !empty( $border_bottom ) && $border_bottom !="#EEEEEE" && $layout == "layout_3") {
             
            $custom_heading_style .= 'border-bottom-color:'.$border_bottom.';';
            
        }
        
    }
    
    // For Seperator.
    
    if( isset($hide_sep_img) && $hide_sep_img == 1 ) {
        $sep_img = "";
        $custom_class.=" sharai_khana_custom kc_".$custom_class_id;
        $sep_img_url = wp_get_attachment_url( $sep_img );
        $custom_class_data.='h2.kc_'.$custom_class_id.'::after{background-image: none;}';
        
    }
    
    if (isset( $sep_img ) && !empty( $sep_img ) ) {
    
        $custom_class.=" sharai_khana_custom kc_".$custom_class_id;
        $sep_img_url = wp_get_attachment_url( $sep_img );
        $custom_class_data.='h2.kc_'.$custom_class_id.'::after{background-image: url('.$sep_img_url.')}';
        
    }
    
    // Wrapped By Data Attribute.
    
    if( $custom_class !="" ) {
        
        $custom_class_data = ' data-custom_style="'.$custom_class_data.'"';
        
    }
    
    
    // Finally, Wrapped By Style Attribute.
    
    if( $custom_heading_style !="" ) {
        
        $custom_heading_style = ' style="'.$custom_heading_style.'"';
        
    }
    
    if( $custom_sub_heading_style !="" ) {
        
        $custom_sub_heading_style = ' style="'.$custom_sub_heading_style.'"';
        
    }
    
     if( $custom_sep_color_style !="" ) {
        
        $custom_sep_color_style = ' style="'.$custom_sep_color_style.'"';
        
    }
    
    $heading_html = "";
    $sub_heading_html = "";
    
    // Start New Code.
    
    
    $separator_before_title_html ="";
    $separator_after_title_html ="";
    
    $separator_before_sub_title_html ="";
    $separator_after_sub_title_html ="";
    
    $heading_separator_inline_html = '<span class="heading-separator-inline ' . $sep_pos .' heading-separator ' . $horizontal_sep_class . '"' . $custom_sep_color_style . '></span>';
    
    if( isset($sep_pos) && $sep_pos !="" ) {
        
        if( isset( $sep_attachment ) && $sep_attachment=="with_title" && $sep_pos =="before_text" ) {
            $separator_before_title_html = $heading_separator_inline_html;
        } else if( isset( $sep_attachment ) && $sep_attachment=="with_title" && $sep_pos =="after_text" ) {
            $separator_after_title_html = $heading_separator_inline_html;
        } else if( isset( $sep_attachment ) && $sep_attachment=="with_sub_title" && $sep_pos =="before_text" ) {
            $separator_before_sub_title_html = $heading_separator_inline_html;
        }  else if( isset( $sep_attachment ) && $sep_attachment=="with_sub_title" && $sep_pos =="after_text" ) {
            $separator_after_sub_title_html = $heading_separator_inline_html;
        }
        
        $separator_html = "";
        
    } else {
        
        
        $separator_html = '<span class="heading-separator' . $horizontal_sep_class . '"' . $custom_sep_color_style . '></span>';
        
    }
    
    
    // sep_attachment
    
    if( isset( $sep_attachment ) && $sep_attachment=="no_separator" ) {
        $separator_html = "";
    }
    
    // Custom Class For Heading Title.
    
    if( isset( $custom_title_class ) && $custom_title_class !="" ) {
        $custom_class.=' ' . $custom_title_class;
    }
    
    // Custom Class For Heading Sub Title.
    if( isset( $custom_sub_title_class ) && $custom_sub_title_class !="" ) {
        $custom_sub_title_class =' ' . $custom_sub_title_class;
    }
    
    
    // End New Code
        
    if( isset( $title ) && $title!="" ) {
        $heading_html.= '<' . $title_tag . ' class="section-heading' . $custom_class . '"' . $custom_heading_style . ' '.$custom_class_data.'>' . $separator_before_title_html . $title . $separator_after_title_html . '</' . $title_tag . '>';
    }
    
    
    if( isset( $sub_title ) && $sub_title!="") {
    
        $sub_heading_html .='<' . $sub_title_tag . ' class="section-subheading' . $custom_sub_title_class . '"' . $custom_sub_heading_style . '>' . $separator_before_sub_title_html . $sub_title . $separator_after_sub_title_html . '</' . $sub_title_tag . '>';
    
    }
    
    
    // Added in version 1.0.2
    
    if( $alt_pos_status == 1 ) {
        
        $tmp_heading_html = $heading_html;
        $heading_html = $sub_heading_html;
        $sub_heading_html = $tmp_heading_html;
        
    }
    
    
    // Buildiing Shortcode HTML.
    
     if ( $layout == "layout_3" ) {
        
        $output = '<h2 class="only-heading' . $custom_class . '" '.$custom_heading_style.' '.$custom_class_data.'>' . $title . '</h2>';
        
    } else if ( $layout == "layout_light" ) {
        
        $output = '<div class="row section-heading-wrapper section-heading-wrapper-alt">
                            <div class="col-md-12 col-sm-12 '.$content_alignment_class.'">
                                ' . $sub_heading_html . '
                                ' . $separator_html .'
                                ' . $heading_html .'
                            </div>
                        </div>';
        
    } else if ( $layout == "layout_2" ) {
        
        $output = '<div class="row section-heading-wrapper">
                            <div class="col-md-12 col-sm-12 text-left">
                                <' . $title_tag . ' class="section-heading margin-bottom-42' . $custom_class . '"' . $custom_heading_style . ' '.$custom_class_data.'>' . $title . '</' . $title_tag . '>
                            </div>
                        </div>';
    } else {
  
        $output = '<div class="row section-heading-wrapper">
                            <div class="col-md-12 col-sm-12 '.$content_alignment_class.'">
                                ' . $sub_heading_html . '
                                ' . $separator_html .'
                                ' . $heading_html .'
                            </div>
                        </div>';
        
    }

    return do_shortcode( sharai_khana_cleanup_shortcode( $output ) ); 
    
    
}