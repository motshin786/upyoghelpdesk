<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'button/shortcodes/button_shortcode.php' );

// VC Elements.

function sharai_khana_button_vc_addon_function() {
    
    $theme = array(
                    __("Default Button", 'sharai_khana_vc') => '',
                    __("Custom Button", 'sharai_khana_vc') => 'custom'
                    );
 
    vc_map(array(
        "name" => __("Buttons", 'sharai_khana_vc'),
        "description" => __("Place Buttons In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_vc_button",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            
             array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Button Text", 'sharai_khana_vc'),
                "param_name" => "btn_text",
                "value" => "",
                "description" => __("Add button text.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
             array(
                "holder" => "link",
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Button Info", 'sharai_khana_vc'),
                "param_name" => "btn_info",
                "value" => "",
                "description" => __("Add button info.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => $theme,
                "description" => __("Select button theme", 'sharai_khana_vc'),
                "group" => "Design"
            ),
            
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Button Border", 'sharai_khana_vc'),
                "param_name" => "btn_border",
                "value" => array(
                                        __("Yes", 'sharai_khana_vc') => 1, 
                                        __("No", 'sharai_khana_vc') => 0
                                     ),
                "description" =>  __("Set No, if you hide button border.", 'sharai_khana_vc'),
                "group" => "Design"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Border Radius", 'sharai_khana_vc'),
                "param_name" => "btn_border_radius",
                "value" => sharai_khana_border_radius(1,32),
                "description" =>  __("Set button border radius.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Background", 'sharai_khana_vc'),
                "param_name" => "btn_bg",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>  __("Set button text color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Border Color", 'sharai_khana_vc'),
                "param_name" => "btn_border_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            // Button Hover Color.
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Background", 'sharai_khana_vc'),
                "param_name" => "btn_hover_bg",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button hover background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_hover_color",
                "value" => SHARAI_KHANA_TEXT_COLOR,
                "description" =>  __("Set button hover text color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Border Color", 'sharai_khana_vc'),
                "param_name" => "btn_hover_border_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button hover border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of button.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array(
                        'type' => 'animation_style',
                        'heading' => __( 'Animation Style', 'sharai_khana_vc' ),
                        'param_name' => 'animation',
                        'description' => __( 'Choose your animation style', 'sharai_khana_vc' ),
                        'admin_label' => false,
                        'weight' => 0,
                        'group' => 'Animation',
                    ),
        )
        
    ));
    
}

sharai_khana_button_vc_addon_function();

// For Button.
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_sharai_khana_vc_button extends WPBakeryShortCode {
        
    }
}