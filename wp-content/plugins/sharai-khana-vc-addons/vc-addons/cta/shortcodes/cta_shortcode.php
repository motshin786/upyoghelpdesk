<?php

add_shortcode('sharai_khana_vc_cta', 'sharai_khana_vc_cta');


function sharai_khana_vc_cta( $atts, $content ) {
    
    $atts = shortcode_atts(
            array(
                    'id'=> '',
                    'sub_intro' => '',
                    'sub_intro_tag' => 'h5',
                    'main_intro' => '',
                    'main_intro_tag' => 'h2',
                    'main_intro_color' => '#FFFFFF',
                    'cta_link'=> '#',
                    'cta_image'=> '#',
                    'icon'=> 'fa-play',
                    'icon_tag'=> 'span',
                    'button_text'=> __('JOIN WITH US', 'sharai_khana_vc'),
                    'layout' => 'layout_1',
                    'content_alignment' => 'center',
                    'btn_alignment' => '',
                    'theme' => '',
                    'btn_border' => '1',
                    'btn_border_width' => '2',
                    'btn_border_radius' => '32',
                    'btn_bg' => SHARAI_KHANA_PRIMARY_COLOR,
                    'btn_color' => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                    'btn_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
                    'btn_hover_bg' => SHARAI_KHANA_LIGHT_BG,
                    'btn_hover_color' => SHARAI_KHANA_TEXT_COLOR,
                    'btn_hover_border_color' => SHARAI_KHANA_LIGHT_BG,
                    'cont_ext_class' => ''
                  ), $atts);
    
    extract($atts);
    
    // Parse Button Links.
    
    $btn_link_string = vc_build_link($cta_link);
    
    if(isset($btn_link_string['url']) && $btn_link_string['url']!="") {
  
        $btn_link = $btn_link_string['url'];
        
    } else {
        
         $btn_link = "#";
    }
    
    // For Button Text.
    
    if(isset($btn_link_string['title']) && $btn_link_string['title']!="") {
  
        $btn_link_text = $btn_link_string['title'];
        
    } else {
        
         $btn_link_text = $button_text;
         
    }
    
    
    // Target Settings.
    
     if (( isset( $btn_link_string['target'] ) && $btn_link_string['target'] !="" ) ) {
        
        $btn_target_text = 'target="' . $btn_link_string['target'] . '"';
        
    } else {
    
        $btn_target_text = "";
    
    }
    
    //  CTA LAYOUT.
   
    
    if ($layout == "layout_2") {
        
        $btn_cta_class = 'btn-theme';
        
    } else {
        
        $btn_cta_class = 'btn-theme';
        
    }
    
    
     if( isset($theme) && $theme =="custom") {
        
             $btn_link_html = do_shortcode('[sharai_khana_vc_button title="'.$btn_link_text.'" '
                                                                                                . 'theme="custom" '
                                                                                                . 'cont_ext_class="'. $btn_cta_class . ' ' . $cont_ext_class . '" '
                                                                                                . 'btn_info="'.$cta_link.'" '
                                                                                                . 'btn_border="'.$btn_border.'" '
                                                                                                . 'btn_border_width="2" '
                                                                                                . 'btn_border_radius="'.$btn_border_radius.'" '
                                                                                                . 'btn_bg="'.$btn_bg.'" '
                                                                                                . 'btn_color="'.$btn_color.'" '
                                                                                                . 'btn_border_color="'.$btn_border_color.'" '
                                                                                                . 'btn_hover_bg="'.$btn_hover_bg.'" '
                                                                                                . 'btn_hover_color="'.$btn_hover_color.'" '
                                                                                                . 'btn_hover_border_color="'.$btn_hover_border_color.'" '
                                                                                                . '/]');
        
        } else {
            
            $btn_link_html = '<a href="' . $btn_link . '" title="' . $btn_link_text . '"  ' . $btn_target_text . ' class="btn '.$btn_cta_class.' '.$cont_ext_class.'">' . $btn_link_text . '</a>';
            
        }

    
    
    $alignment_class = sharai_khana_alignment_class( $content_alignment );
    
    
    $btn_alignment_class = '';
    
    if( isset($btn_alignment) && $btn_alignment !="" ) {
    
        $btn_alignment_class .= sharai_khana_alignment_class( $btn_alignment );
    
    }
    
    $output ='<div class="row">';
    
    if ($layout == "layout_2") {
        
        $output .= '<div class="cta-layout-2">
                            <div class="col-md-9 col-sm-12 ' . $alignment_class . '">
                                ' . $content . '
                            </div>

                            <div class="col-md-3 col-sm-12 ' .$btn_alignment_class . '">
                                ' . $btn_link_html . '
                            </div>
                        </div> ';
    }else {
        
         
        $output .= '<div class="'.$alignment_class.' cta-layout-1">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    ' . $content . '
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12' .$btn_alignment_class . '">
                                    ' . $btn_link_html . '
                                </div>
                            </div>';
        
    }
    
    $output .='</div>';

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
    
}


function sharai_khana_cta_link_html() {
    
    
    
    
}