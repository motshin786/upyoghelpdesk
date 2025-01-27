<?php

add_shortcode('sharai_khana_vc_button', 'sharai_khana_vc_button');

function sharai_khana_vc_button($atts, $content) {
    
    wp_enqueue_script( 'sharai_khana_vc-plugin-script');
    
    $atts = shortcode_atts(
            array(
                'id' => '',
                'custom_class_id' => wp_rand(),
                'title' => 'Button', // default button title.
                'btn_text' => '', // old plugin backup.
                'btn_url' => '', // old plugin backup
                'btn_info' => '', // contain link and button link title on hover mode.
                'animation' => '',
                'theme' => '',
                'btn_border' => '1',
                'btn_border_width' => '1',
                'btn_border_radius' => 32,
                'btn_bg' => SHARAI_KHANA_PRIMARY_COLOR,
                'btn_color' => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                'btn_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
                'btn_hover_bg' => SHARAI_KHANA_PRIMARY_COLOR,
                'btn_hover_color' => SHARAI_KHANA_TEXT_COLOR,
                'btn_hover_border_color' => SHARAI_KHANA_PRIMARY_COLOR,
                'cont_ext_class' => 'btn-theme'
            ), $atts);

    extract($atts);
    
    // Animation Class
    
    $sharai_khana_btn_animation = "";
    
    if( isset($animation) && $animation != "" ) {
        $animate_class = new WPBakeryShortCode_sharai_khana_vc_button( array( 'base' => 'sharai_khana_vc_button' ) );
        $sharai_khana_btn_animation = " ".$animate_class->getCSSAnimation( $animation );
    }
    
    // For Custom Theme.
     
     $custom_class = "";
     $custom_class_data= "";

    if (isset($theme) && !empty($theme) && $theme == "custom") {
        
        $btn_border_width = ( isset( $btn_border ) && $btn_border==1 ) ? $btn_border_width : 0;

        $custom_class.=" sharai_khana_custom kc_" . $custom_class_id;
        $custom_class_data.="a.kc_" . $custom_class_id . " {background:" . $btn_bg . " !important; color:" . $btn_color . " !important; border:" . $btn_border_width. "px solid " . $btn_border_color . " !important; border-radius:" . $btn_border_radius. "px !important;}";
        $custom_class_data.="a.kc_" . $custom_class_id . ":hover {background: " . $btn_hover_bg . " !important; color: " . $btn_hover_color . " !important; border:" . $btn_border_width. "px solid " . $btn_hover_border_color . " !important; border-radius: " . $btn_border_radius. "px !important;}";
        
    }
    
     // Wrapped By Data Attribute.

    if ($custom_class != "") {

        $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
    }
    
    
    // Parse Button Links.
    
    $btn_link_string = vc_build_link($btn_info);
    
    if(isset($btn_link_string['url']) && $btn_link_string['url']!="") {
  
        $btn_link = $btn_link_string['url'];
        
    } else if (( isset( $btn_url ) && $btn_url !="" ) ) {
        
        $btn_link = $btn_url;
        
    } else {
        
         $btn_link = "#";
    }
    
    // For Button Text.
    
     if (( isset( $btn_text ) && $btn_text !="" ) ) {
        
        $btn_link_text = $btn_text;
        
    } else if (( isset( $title ) && $title !="" ) ) {
        
        $btn_link_text = $title;
        
    } else {
    
        $btn_link_text = (isset($btn_link_string['title']) && $btn_link_string['title'] !="" ) ? $btn_link_string['title'] : $title;
    
    }
    
    
    // Target Settings.
    
    
    
     if (( isset( $btn_link_string['target'] ) && $btn_link_string['target'] !="" ) ) {
        
        $btn_target_text = 'target="' . $btn_link_string['target'] . '"';
        
    } else {
    
        $btn_target_text = "";
    
    }
    
    
    
    $btn_link_html = '<a href="' . $btn_link . '" title="' . $btn_link_text . '"  ' . $btn_target_text . ' class="btn '.$custom_class.' '.$cont_ext_class.' '.$sharai_khana_btn_animation.'" '.$custom_class_data.'>' . $btn_link_text . '</a>';

    return do_shortcode(sharai_khana_cleanup_shortcode($btn_link_html));
}
