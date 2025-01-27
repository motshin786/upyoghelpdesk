<?php

add_shortcode('sharai_khana_slider', 'sharai_khana_slider');
add_shortcode('sharai_khana_slider_item', 'sharai_khana_slider_item');

//Main Slider Block

function sharai_khana_slider($atts, $content) {

    $atts = shortcode_atts(array(
                    'id' => wp_rand(),
                    'custom_class_id' => wp_rand(),
                    'theme' => '',
                    'nav_bg'=> '#80b435',
                    'nav_color'=> '#FFFFFF',
                    'layout' => 'slider_1',
                    'bg_effect' => 0,
                    'carousel_nav' => 0,
                    'carousel_dots' => 0,
                    'carousel_nav_icon_left' => 'fa fa-angle-left',
                    'carousel_nav_icon_right' => 'fa fa-angle-right',
                    'carousel_autoplay' => 'true',
                    'carousel_autoplaytimeout' => 5000
                ), $atts);

    extract($atts);
    
    // For Custom Theme.
     
     $custom_class = "";
     $custom_class_data= "";
     

    $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
    
    $carousel_effect_time = ( $carousel_autoplaytimeout/1000 ).'s';

    $custom_class_data.="div.kc_" . $custom_class_id . " .slide-bg{transition: all " . $carousel_effect_time . " ease-out !important; }";

    if (isset($theme) && !empty($theme) && $theme == "custom") {
        
        $custom_class_data.="div.kc_" . $custom_class_id . " .sharai_khana_slider .owl-nav div[class*='owl-']{background: " . $nav_bg . " !important; color: " . $nav_color . " !important;}";
        $custom_class_data.="div.kc_" . $custom_class_id . " .sharai_khana_slider .owl-dots .active{background: " . $nav_bg . " !important; }";
        
    }
     
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }
    
    // One more checking about parameters.
     $bg_effect_status = ( $bg_effect == 1 ) ? 'false' : 'true';
     $carousel_nav_status = ( $carousel_nav ==1) ? 'false' : 'true';
     $carousel_dots_status = ( $carousel_dots ==1) ? 'false' : 'true';
     
     $output = '<div class="item_1 slider-wrap '.$custom_class.'" '.$custom_class_data.'>
       <div id="slider_1" class="sharai_khana_slider ' . $layout . ' owl-carousel owl-theme" data-bg_effect="' . $bg_effect_status . '" data-nav="' . $carousel_nav_status . '" data-dots="' . $carousel_dots_status . '" data-nav_icon_left="' . $carousel_nav_icon_left . '" data-nav_icon_right="' . $carousel_nav_icon_right . '" data-autoplay="' . $carousel_autoplay . '" data-autoplaytimeout="' . $carousel_autoplaytimeout . '">';

    // Modified shortcode.

        $content = str_replace('[sharai_khana_slider_item', '[sharai_khana_slider_item layout="' . $layout . '" layout="' . $layout . '" layout="' . $layout . '" ', $content);

        $output .=do_shortcode($content);

        $output .= '</div>';

    $output .= '</div>';

    return $output;
}

// Generate Each Slider Block.

function sharai_khana_slider_item($atts, $content) {
    
    $atts = shortcode_atts(array(
        
        'custom_class_id' => wp_rand(),
        'layout' => 'slider_1',
        'slider_title_class' => '',
        'content_alignment' => 'left',
        'content_animation_in' => 'zoomIn',
        'content_animation_out' => 'zoomOut',
        'content_color' => '#FFFFFF',
        
        'content_bg_status' => 0,
        'content_bg' => '#FFFFFF',
        'content_border' => '#659088',
        
        'slider_sub_title_status' => 0, // if status value is 1 then slider sub title will be hidden.
        'slider_sub_title' => '',
        'slider_sub_title_color' => '#FFFFFF',
        'slider_sub_title_class' => '',
        
        'bg_type' => 'image',  // image/solid/gradient
        'slider_image' => '',
        'bg_color' => '#555555',
        'bg_opacity' => '0.3',
        'solid_bg' => '#555555',
        
        'ctrl_btn_1' => 0,
        'btn_1_class' => '',
        'btn_1_cont_ext_class' => 'btn-theme margin-top-24',
        'btn_1_text' => __("BOOK APPOINTMENT", "sharai_khana_vc"),
        'btn_1_url' => '#',
        'btn_1_theme' => '', //default, custom.
        'btn_1_border' => '0',
        'btn_1_border_radius' => '32',
        'btn_1_bg' => '#FFFFFF',
        'btn_1_color' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_1_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_1_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_1_hover_color' => '#FFFFFF',
        'btn_1_hover_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
        
        
        'ctrl_btn_2' => 0,
        'btn_2_class' => '',
        'btn_2_cont_ext_class' =>  'btn-theme btn-theme-invert margin-top-24',
        'btn_2_text' => __("JOIN WITH US", "sharai_khana_vc"),
        'btn_2_url' => '#',
        'btn_2_theme' => '', //default, custom.
        'btn_2_border' => '0',
        'btn_2_border_radius' => '32',
        'btn_2_bg' => '#FFFFFF',
        'btn_2_color' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_2_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_2_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR,
        'btn_2_hover_color' => '#FFFFFF',
        'btn_2_hover_border_color' => SHARAI_KHANA_PRIMARY_COLOR
        
            ), $atts);

    extract($atts);
     $custom_class = "";
     $custom_class_data= "";
    
    // Cotent Alignment Class.
    
    $content_alignment_class = sharai_khana_alignment_class($content_alignment);

    $feat_image_url = wp_get_attachment_url($slider_image);

    // SLIDER TITLE
    
    $cs_slider_content_color = '';
    
    if(isset($content_color) && $content_color !="#FFFFFF" ) {
        $cs_slider_content_color = 'style="color:'.$content_color.' !important;"';
    }
    
    $slider_title_html = '<div class="slider_title_content ' . $slider_title_class . '" '.$cs_slider_content_color.'>' . $content . '</div>';
    
    // SLIDER SUB TITLE
    
    $cs_slider_sub_title_color = '';
    
    if(isset($slider_sub_title_color) && $slider_sub_title_color !="#FFFFFF" ) {
        $cs_slider_sub_title_color = 'style="color:'.$slider_sub_title_color.' !important;"';
    }
    
    $slider_sub_title_html = '<h3 '.$cs_slider_sub_title_color.' class="' . $slider_sub_title_class . '">' . $slider_sub_title . '</h3>';
    
    if ($slider_sub_title_status == 1 || $slider_sub_title == "" ) {

        $slider_sub_title_html = "";
        
    }

    // SLIDER BUTTONS
    
    /*------------------------------  Generate Button#1 ---------------------------------*/

    $btn_1_html = '';

    if ($ctrl_btn_1 == 1) {
        
        $btn_1_cont_ext_class = ( isset( $btn_1_class ) && $btn_1_class !="" ) ? $btn_1_cont_ext_class .' ' .$btn_1_class : $btn_1_cont_ext_class;
        
        if( isset($btn_1_theme) && $btn_1_theme =="custom") {
        
             $btn_1_html .= do_shortcode('[sharai_khana_vc_button title="'.$btn_1_text.'" '
                                                                                                . 'theme="custom" '
                                                                                                . 'cont_ext_class="'.$btn_1_cont_ext_class.'" '
                                                                                                . 'btn_info="'.$btn_1_url.'" '
                                                                                                . 'btn_border="'.$btn_1_border.'" '
                                                                                                . 'btn_border_width="0" '
                                                                                                . 'btn_border_radius="'.$btn_1_border_radius.'" '
                                                                                                . 'btn_bg="'.$btn_1_bg.'" '
                                                                                                . 'btn_color="'.$btn_1_color.'" '
                                                                                                . 'btn_border_color="'.$btn_1_border_color.'" '
                                                                                                . 'btn_hover_bg="'.$btn_1_hover_bg.'" '
                                                                                                . 'btn_hover_color="'.$btn_1_hover_color.'" '
                                                                                                . 'btn_hover_border_color="'.$btn_1_hover_border_color.'" '
                                                                                                . '/]');
        
        } else {
            
            $btn_1_url_string = vc_build_link($btn_1_url);
            $btn_1_html .= '<a href="' . $btn_1_url_string['url'] . '" class="btn '.$btn_1_cont_ext_class.'">' . $btn_1_text . '</a>';
            
        }
        
    }
    
    /*------------------------------  Generate Button#2 ---------------------------------*/
    
    $btn_2_html = '';

    if ($ctrl_btn_2 == 1) {
        
        $btn_2_cont_ext_class = ( isset( $btn_2_class ) && $btn_2_class !="" ) ? $btn_2_cont_ext_class .' ' .$btn_2_class : $btn_2_cont_ext_class;
        
         if( isset($btn_2_theme) && $btn_2_theme =="custom") {
             
              $btn_2_html .= do_shortcode('[sharai_khana_vc_button title="'.$btn_2_text.'" '
                                                                                                . 'theme="custom" '
                                                                                                . 'cont_ext_class="'.$btn_2_cont_ext_class.'" '
                                                                                                . 'btn_info="'.$btn_2_url.'" '
                                                                                                . 'btn_border="'.$btn_2_border.'" '
                                                                                                . 'btn_border_width="2" '
                                                                                                . 'btn_border_radius="'.$btn_2_border_radius.'" '
                                                                                                . 'btn_bg="'.$btn_2_bg.'" '
                                                                                                . 'btn_color="'.$btn_2_color.'" '
                                                                                                . 'btn_border_color="'.$btn_2_border_color.'" '
                                                                                                . 'btn_hover_bg="'.$btn_2_hover_bg.'" '
                                                                                                . 'btn_hover_color="'.$btn_2_hover_color.'" '
                                                                                                . 'btn_hover_border_color="'.$btn_2_hover_border_color.'" '
                                                                                                . '/]');
             
         } else {
             
             $btn_2_url_string = vc_build_link($btn_2_url);
             $btn_2_html .= '<a href="' . $btn_2_url_string['url'] . '" class="btn '.$btn_2_cont_ext_class.'">' . $btn_2_text . '</a>';
             
         }
        
        
    }
    
    // Button Wrapper.
    
    $output_btn_html = "";
    
    if( $btn_1_html !="" || $btn_2_html!="" ) {
        
        $output_btn_html.='<div class="slider-button">';
            $output_btn_html.=$btn_1_html;
            $output_btn_html.=$btn_2_html;
        $output_btn_html.='</div>';
    }

    
    // Content BG.
    
    $slider_content_bg_start_html = "";
    $slider_content_bg_end_html = "";
    
    if( isset( $content_bg_status ) && $content_bg_status == 1 ) {
        
        
        $custom_class = "";
        $custom_class_data = "";

        $custom_class.="sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .slider-contents-info:before{border-color: " . $content_border . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .slider-contents-info:after{border-color: " . $content_border . " !important;}";
            
        // Wrapped By Data Attribute.

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
        
    }
    
    $slider_html ='<div class="slider_item_container" data-bg_type="'.$bg_type.'" data-bg_img="' . $feat_image_url . '" data-bg_color="'.$bg_color.'" data-bg_opacity="'.$bg_opacity.'" data-solid_bg="'.$solid_bg.'">
                    <div class="item">
                        <div class="slider-content">
                            <div class="container '.$content_alignment_class.'">
                                <div class="row">
                                    <div class="col-sm-12  wow fadeInDown" data-wow-duration="1s" data-animation-in="'.$content_animation_in.'" data-animation-out="animate-out '.$content_animation_out.'">
                                        ' . $slider_title_html . '
                                        ' . $slider_sub_title_html . '                                            
                                        ' . $output_btn_html . '
                                        ' . $slider_content_bg_end_html . '
                                    </div> <!-- end .col-sm-12  -->
                                </div> <!-- end .row  -->
                            </div><!-- end .container -->
                        </div> <!--  end .slider-content -->
                    </div> <!-- end .item  -->
                </div> <!-- end .slider_item_container  -->';

    return $slider_html;
    
}
