<?php

add_shortcode('sharai_khana_pricetable', 'sharai_khana_pricetable');
add_shortcode('sharai_khana_pricetable_item', 'sharai_khana_pricetable_item');
add_shortcode('sharai_khana_pt_item', 'sharai_khana_pt_item');

//Main Pricing Table Block

function sharai_khana_pricetable($atts, $content) {

    $atts = shortcode_atts(array(
                        'id' => wp_rand(),
                        'layout' => 'simple', // simple, no_padding
                        'column' => '4',
                        'rm_link_status'=> 0,
                        'cont_ext_class' => '',
                        'animation' => '',
                        'header_border' => 0
                ), $atts);

    extract($atts);
    
     // No Gutter Class Fixing.
    
     $custom_class = "";
 
     if( isset($cont_ext_class) && $cont_ext_class !="" && strpos( $cont_ext_class, "no-gutter" ) !== false ){
         $custom_class .= $cont_ext_class ;
    }

    $output = '<div class="item_'.$column.' row ' . $custom_class.'">';

    // Modified shortcode.

    $content = str_replace('[sharai_khana_pricetable_item', '[sharai_khana_pricetable_item layout="' . $layout . '" animation="'.$animation.'" header_border="'.$header_border.'"  cont_ext_class="'.$cont_ext_class.'" column="' . $column . '"', $content);

    $output .=do_shortcode($content);

    $output .= '</div><!-- end .row  -->';

    return $output;
}

// Generate Each Pricing Column Block.

function sharai_khana_pricetable_item($atts, $content) {

    $atts = shortcode_atts(array(
                                        'id' => '',
                                        'custom_class_id' => wp_rand(),
                                        'layout' => 'simple', // simple, no_padding
                                        'column' => '4',
                                        'content_alignment' => 'center',
                                        'pricetable_image_type' => 'pti_image',
                                        'pricetable_image' => '',
                                        'pricetable_icon' => 'fa fa-smile',
                                        'title' => '',
                                        'subtitle' => '',
        
                                        'rm_link_status' => 0,
                                        'url_text' => __("Learn More &raquo;", 'sharai_khana_vc'),
                                        'read_more_link' => '#',        
                                        'btn_ext_class' => '',
        
                                        'pricetable_type' => '',
                                        'pricetable_desc' => '',
                                        'pricetable_currency' => '$',
                                        'pricetable_price' => '',
                                        'pricetable_period' => '',
                                        'pricetable_details_type' => 'list', // list/compact
                                        
                                        'pt_box_bg' => '#FAFAFA',
                                        'pt_currency_color' => '#659088',
                                        'pt_price_color' => '#80b435',
                                        'pt_period_color' => '#646E7A',
                                        'pt_details_color' => '',
                                        'pt_type_color' => '#00595a',
                                        
                                        'fpt_box_bg' => '#FAFAFA',
                                        'fpt_currency_color' => '#659088',
                                        'fpt_type_color' => '#00595a',
                                        'fpt_price_color' => '#ffbd0f',
                                        'fpt_period_color' => '#FFFFFF',
                                        'fpt_details_color' => '#888888',
        
                                        'pricetable_link' => '#',
                                        'pricetable_link_text' => __("GET STARTED", "sharai_khana_vc"),
                                        'featured' => 0,
                                        'animation' => '',
                                        'header_border' => 0,
                                        'cont_ext_class' => ''       
            ), $atts);

    extract($atts);
    
 
        $column_class =  sharai_khana_pricing_table_column_class($column);    

        $content_alignment_class =  sharai_khana_alignment_class($content_alignment) .' ' . $cont_ext_class . ' ';

        if( isset($header_border) && $header_border==1 ) {
            $content_alignment_class .='price-table-header-border';
        }
    
        // Pricing Table Icon.
    
      $feat_image_url_string = "";
      
      if( isset($pricetable_image_type) && $pricetable_image_type == "pti_none" ) {
          
             $feat_image_url_string .= "";
          
      } else if( isset($pricetable_image_type) && $pricetable_image_type == "pti_fa" ) {
          
            $feat_image_url_string .= '<i class="' . $pricetable_icon . '"></i>';
          
      } else {
      
            $feat_image_info = sharai_khana_img_dimension( $pricetable_image );

            if ( !empty( $feat_image_info ) ) {

                $feat_image_url_string.= '<img ' . $feat_image_info . ' alt="' . $pricetable_type . '" class="img-responsive">';

            }
      
       }
    
        // Pricing Table Details Type.

        if( $pricetable_details_type == "compact" ) {

            $pricing_table_items = '<div class="sharai_khana-pricing-container-details">
                                                    ' . do_shortcode(sharai_khana_cleanup_shortcode(trim($content))) . '
                                                    </div>';

        } else {

            $pricing_table_items = '<ul class="price-table-item">
                                                    ' . do_shortcode(sharai_khana_cleanup_shortcode(trim($content)) ) . '
                                                </ul>';
        }
       
        
        
        $pricetable_desc_html = "";
        
        if( isset($pricetable_desc) && $pricetable_desc == "" ) {
            $pricetable_desc_html.= '<span class="subtitle text-uppercase">'.$pricetable_desc.'</span>';
        }
        
        
       // Pricing Table CTA Button

        $read_more_html = "";

        if( $rm_link_status == 1 ) {

            $btn_pricing_table = 'btn-theme price-plan-btn ' . $btn_ext_class;
            $read_more_link_string = vc_build_link($read_more_link);
            $read_more_html .= '<a href="'.esc_url( $read_more_link_string['url'] ).'" class="' . $btn_pricing_table . '">'.$url_text.'</a>';

        }
    
    // No Padding Pricing Table Class
    
    $layout_class = "";
    
    if( $layout== "no_padding" ) {
        $layout_class .= " sharai_khana-no-padding-pricing-column";
    }
    
    // Featured Pricing Table Class
    
    $sharai_khana_pricing_highlight = "";
    
    if( $featured == 1 ) {
        $sharai_khana_pricing_highlight .= "sharai_khana-pricing-highlight";
    }
    
    // Animation Class
    
    $sharai_khana_pricing_animation = "";
    
    if( isset( $animation ) && $animation != "" ) {
        $animate_class = new WPBakeryShortCode_sharai_khana_pricetable_item( array( 'base' => 'sharai_khana_pricetable_item' ) );
        $sharai_khana_pricing_animation = $animate_class->getCSSAnimation( $animation );
    }
    
    // Custom Class Data.
    
    $custom_class_data= "";

    $custom_class =" sharai_khana_custom kc_" . $custom_class_id;
    
    if ( $featured == 1 ) {
        
        $custom_class_data .= ( isset($fpt_box_bg) && $fpt_box_bg !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight{ background: " . $fpt_box_bg . " !important;}" : '';
        $custom_class_data .= ( isset($fpt_type_color) && $fpt_type_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight h2.title{ color: " . $fpt_type_color . " !important;}" : '';
        $custom_class_data .= ( isset($fpt_price_color) && $fpt_price_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight .price-value{ color: " . $fpt_price_color . " !important;}" : '';
        $custom_class_data .= ( isset($fpt_period_color) && $fpt_period_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight .month{ color: " . $fpt_period_color . " !important;}" : '';
        $custom_class_data .= ( isset($fpt_currency_color) && $fpt_currency_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight .currency{ color: " . $fpt_currency_color . " !important;}" : '';
        $custom_class_data .= ( isset($fpt_details_color) && $fpt_details_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1.sharai_khana-pricing-highlight .pricing-content{ color: " . $fpt_details_color . " !important;}" : '';
        
    } else {

        $custom_class_data .= ( isset($pt_box_bg) && $pt_box_bg !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1{ background: " . $pt_box_bg . " !important;}" : '';
        $custom_class_data .= ( isset($pt_type_color) && $pt_type_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1 h2.title { color: " . $pt_type_color . " !important;}" : '';
        $custom_class_data .= ( isset($pt_price_color) && $pt_price_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1 .price-value { color: " . $pt_price_color . " !important;}" : '';
        $custom_class_data .= ( isset($pt_period_color) && $pt_period_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1 .month{ color: " . $pt_period_color . " !important;}" : '';
        $custom_class_data .= ( isset($pt_currency_color) && $pt_currency_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1 .currency { color: " . $pt_currency_color . " !important;}" : '';
        $custom_class_data .= ( isset($pt_details_color) && $pt_details_color !="" ) ? ".kc_" . $custom_class_id . " .price-table-layout-1 .pricing-content { color: " . $pt_details_color . " !important;}" : '';
        
    }

    // Wrapped By Data Attribute.

    if ($custom_class_data != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }

    
    $pricetable_period_html = (isset($pricetable_period) && $pricetable_period !="") ? '<span class="month">/ ' . $pricetable_period . '</span>' : '';
    
    $output = '<div class="'.$column_class . $custom_class . $layout_class . $sharai_khana_pricing_animation . '" ' . $custom_class_data . '>

                        <div class="price-table-layout-1 '. $sharai_khana_pricing_highlight . ' '.$content_alignment_class.'">                        

                            <div class="price-table-header">
                                ' . $feat_image_url_string . ' 
                                <h2 class="title">' . $pricetable_type . '</h2>   
                                ' . $pricetable_desc_html . '
                                <span class="currency">' . $pricetable_currency . '</span>
                                <span class="price-value">' . $pricetable_price . '</span>        
                                ' . $pricetable_period_html . '
                            </div>
                            <div class="pricing-content">
                                  ' . $pricing_table_items . '  
                                  ' . $read_more_html . '
                            </div> 
                            
                        </div><!-- end .pricing-container  -->  

                    </div> <!-- end .col-md-3  -->';  
    

    return do_shortcode(sharai_khana_cleanup_shortcode($output));
    
}

// Generate Each Pricing Item row.

function sharai_khana_pt_item($atts, $content) {

    $atts = shortcode_atts(array(
        'title' => ''
            ), $atts);

    extract($atts);

    if (isset($title) && $title != "") {
        return '<li>' . $title . '</li>';
    }
}
