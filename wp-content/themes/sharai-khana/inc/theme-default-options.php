<?php
/**
 * @package sharai-khana
 */
 
if (!function_exists('sharai_khana_wp_option')) {
    
    function sharai_khana_default_value( $id ) {
        
        $default_values = array(
            'enable_disable_toolbar' => 1,
            'enable_sticky_header' => 0,
            'enable_disable_headerbar' => 1,
            'navigation-dropdown-background' => '#FFFFFF',
            'navigation-top-level-item-hover-active-color' => '#80B435',
            'footer_menu_display_status' => 0,
            'theme_default_header_style' => '',
            'header_1_toolbar_status' => 1,
            'header_1_enable_sticky_header' => 1,
            'footer-background-overlay-status' => 0,
            'sharai_khana_preloader_disable_status' => 0,
            'sharai_khana_preloader_img' => '',
            'sharai_khana_preloader_background' => '#FFFFFF',
            'sharai_khana_back_to_top_disable_status' => 0,
            'sharai_khana_back_to_top_background' => '#80B435',
            'sharai_khana_vc_primary_color' => '#80B435'
        );
        
        $default_value = isset($default_values[$id]) ? $default_values[$id] : '';
        
        return $default_value;
    };
    

    function sharai_khana_wp_option($id, $fallback = false, $param = false) {
            
        if (!class_exists('Redux')) {
            
            return sharai_khana_default_value($id);
            
        }
        
        global $sharai_khana_wp_options;
        
        if ($fallback == false) {
            
            $fallback = '';
            
        }
        
        
        $output = ( isset($sharai_khana_wp_options[$id]) && $sharai_khana_wp_options[$id] !== '' ) ? $sharai_khana_wp_options[$id] : $fallback;
        if (!empty($sharai_khana_wp_options[$id]) && $param) {
            $output = $sharai_khana_wp_options[$id][$param];
        }
        return $output;
    }

}