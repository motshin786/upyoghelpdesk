<?php

add_shortcode('sharai_khana_counter', 'sharai_khana_counter');
add_shortcode('sharai_khana_counter_item', 'sharai_khana_counter_item');

//Main Counter Block
        
function sharai_khana_counter( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id' => wp_rand(),
                         'custom_class_id' => wp_rand(),
                         'layout' => 'layout_1',
                         'column' => 4,
                         'text_align' => 'center',
                         'time' => 1000,
                         'delay' => 10,
                         'disable_countup' => 0,
                         'hide_icon' => 0,
                         'theme' => '',
                         'counter_bg' => '#FCFCFC',
                         'counter_color' => "#fe3c47",
                         'text_color' => "#2C2C2C",
                         'icon_color'=> "#2C2C2C",
                         'border_color'=> "#CCCCCC",
                        'cont_ext_class' => '',
                        'animation' => ''
                     ), $atts);
     
     extract($atts);
      
     $output ='';
     
        // For Custom Theme.
     
        $custom_class = "";
        $custom_class_data= "";

       if (isset($theme) && !empty($theme) && $theme == "custom") {

            $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
            
            $layout_class = ( isset( $layout ) && $layout == 'layout_2' ) ? 'counter-block-2' : 'counter-block-1';
               
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class." { background: " . $counter_bg . "!important; }";
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class." .icon{ color: " . $icon_color . "!important; }";
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class." .counter{ color: " . $counter_color . "!important; }";
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class." .counter-postfix{ color: " . $counter_color . "!important; }";
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class.".counter-border .count-info:before { background: " . $border_color . "!important; }";
            $custom_class_data.=".kc_" . $custom_class_id . " .".$layout_class." p{ color: " . $text_color . "!important; }";

       }

        // Wrapped By Data Attribute.

       if ($custom_class != "") {

           $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
       }
     
     
     $output ='<div class="item_' . $column . ' row'.$custom_class.'" '.$custom_class_data.'>';

        $content = str_replace('[sharai_khana_counter_item', '[sharai_khana_counter_item column='.$column.' cont_ext_class="' . $cont_ext_class . '" layout="'.$layout.'" animation="' . $animation . '" text_align="'.$text_align.'"  time="'.$time.'"  delay="'.$delay.'"  disable_countup="'.$disable_countup.'" hide_icon="'.$hide_icon.'" counter_bg="'.$counter_bg.'" counter_color="'.$counter_color.'" text_color="'.$text_color.'" icon_color="'.$icon_color.'" ', $content);
     
        $output .=do_shortcode($content);
     
     $output .= '</div>';
     
     return $output;
    
}

// Generate Each Counter Block.

function sharai_khana_counter_item($atts,$content) {
    
    $atts = shortcode_atts(array(
                                            'column' => 4,
                                            'id'=> '',
                                            'counter_title' => '',
                                            'counter_title_tag' => 'h4',
                                            'counter_value' => '',
                                            'counter_value_tag' => 'span',
                                            'counter_post_fix' => '',
                                            'layout' => 'layout_1',
                                            'icon' => 'fa fa-briefcase',
                                            'text_align' => 'left',
                                            'time' => 1000,
                                            'delay' => 10,
                                            'disable_countup' => 0,
                                            'hide_icon' => 0,
                                            'counter_bg' => '#FFFFFF',
                                            'counter_color' => SHARAI_KHANA_PRIMARY_COLOR,
                                            'text_color' => SHARAI_KHANA_TEXT_COLOR,
                                            'icon_color'=> SHARAI_KHANA_TEXT_COLOR,
                                            'border_color'=> SHARAI_KHANA_BORDER_COLOR,
                                            'animation' => '',
                                            'cont_ext_class' => ''
                                        ), $atts);
    
    extract($atts);
    
    $sharai_khana_counter_animation = "";

    if (isset($animation) && $animation != "") {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button(array('base' => 'sharai_khana_counter_item'));
        $sharai_khana_counter_animation = " " . $animate_class->getCSSAnimation($animation);
    }
    
    
    $block_class = sharai_khana_counter_column_class( $column );
    $text_align_class = sharai_khana_alignment_class( $text_align );
    
    // Counter Layout.
    
    $counter_layout_class = 'counter-block-1';
    
    if( isset( $layout ) && $layout == 'layout_2' ) {
        $counter_layout_class = 'counter-block-2 counter-border';
    }
    
    $counter_layout_class.= $sharai_khana_counter_animation .' ' . $cont_ext_class;
    
    // Custom Style.
    // @Since: 1.0.2
    
    $custom_bg_style =  ' style="background:'.$counter_bg.';"';
    $custom_counter_style =  ' style="color:'.$counter_color.';"';
    $custom_text_style = ' style="color:'.$text_color.';"';
    $custom_icon_style = ' style="color:'.$icon_color.';"';
    
    
    // Hide icon from counter block.
    // @Since: 1.0.1
    
    if ( $hide_icon == 1 ) {
        
        $icon_html = "";
        
    } else {
        
        $icon_html = '<span class="icon ' . $icon . '"></span>';
        
    }
    
    // Counter Post Fix HTML.
    
    if( isset($counter_post_fix) && $counter_post_fix !="" ) {
        
        $counter_post_fix_html = '<span class="counter-postfix">' . $counter_post_fix . '</span>  ';
        
    } else {
        $counter_post_fix_html = '';
        
    }
        
        $output = '<div class="'.$block_class.' '.$text_align_class.'">
                                <div class="' . $counter_layout_class . '">
                                    ' . $icon_html . '
                                        <div class="count-info">
                                        <span class="counter sharai_khana_counter_num" data-disable_countup="'.$disable_countup.'" data-time="'.$time.'" data-delay="'.$delay.'">'.$counter_value.'</span>
                                        ' .  $counter_post_fix_html . '
                                        <p>'.$counter_title.'</p>
                                        </div> <!-- end .count-info  -->
                                </div><!-- end .counter-block-1  -->
                            </div> <!--  end col-sm-3  -->';

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
    
}