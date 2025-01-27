<?php

add_shortcode('sharai_khana_faq', 'sharai_khana_faq');
add_shortcode('sharai_khana_faq_item', 'sharai_khana_faq_item');

//Main FAQ Block
        
function sharai_khana_faq( $atts, $content ){

     $atts = shortcode_atts(array(
                        'id'=> '',
                        'custom_class_id' => wp_rand(),
                        'layout' => 'layout_1',
                        'carousel'=> 0,
                        'item_per_row' => 4,
                        'carousel_nav' => 0,
                        'carousel_autoplay' => 'true',
                        'carousel_autoplaytimeout' => 5000,
                        'theme' => '',
                        'theme_color'=> SHARAI_KHANA_PRIMARY_COLOR,
                        'icon_bg'=> "#EEEEEE",
                        'content_alignment' => 'left',
                        'faq_title_color' => '#2C2C2C',
                        'faq_title_bg' => '#FBFBFB',
                        'faq_details_color' => '#2C2C2C',
                        'faq_details_bg' => '#FAFAFA'
                     ), $atts);
     
     extract($atts);

    // For Custom Theme.
     
     $custom_class = " sharai_khana_faq ";
     $custom_class_data= "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.=".kc_" . $custom_class_id . " .panel-heading{background: " . $faq_title_bg . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .faq-box .panel-title > a{color: " . $faq_title_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .faq-box .panel-heading [data-toggle='collapse']::after{color: " . $faq_title_color . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .faq-box .panel-details{background: " . $faq_details_bg . " !important;}";
        $custom_class_data.=".kc_" . $custom_class_id . " .faq-box .panel-body{color: " . $faq_details_color . " !important;}";
        
    }
     
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

     
     $output = '<div class="row' . $custom_class . '" ' . $custom_class_data . '>';

        $output .= '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="accordion_' . $custom_class_id . '">';

            // Modified shortcode.

            $content = str_replace('[sharai_khana_faq_item', '[sharai_khana_faq_item parent_id="accordion_' . $custom_class_id . '" layout="' . $layout . '" content_alignment="' . $content_alignment . '" item_per_row="' . $item_per_row . '" ', $content);

            $output .=do_shortcode($content);

        $output .= '</div>';

    $output .= '</div>';

    return $output;
    
}

// Generate Each FAQ  Block.

function sharai_khana_faq_item( $atts, $content ) {
    
        $atts = shortcode_atts(array(
            'parent_id' => '',
            'faq_title' => ''
         ), $atts);

        extract($atts);
    
        $faq_child_id = "faq_child_" . wp_rand();
        
        $output = '<div class="panel panel-default faq-box">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#'.$parent_id.'" href="#'.$faq_child_id.'" >'.$faq_title.'</a>
                                </h4>
                            </div>
                            <div id="'.$faq_child_id.'"  class="panel-details panel-collapse collapse">
                                <div class="panel-body">
                                    '.$content.'
                                </div>
                            </div>
                        </div>';

    return $output;
    
}