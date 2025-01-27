<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'faq/shortcodes/faq_shortcode.php' );

// VC Elements.

function sharai_khana_faq_vc_addon_function() {
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("FAQs", 'sharai_khana_vc'),
        "description" => __('Place Faq In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_faq",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_faq_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "controls" => "full",
        "is_container" => false,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Select Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => array(
                                        __('Default', 'sharai_khana_vc') => 'default', 
                                        __('Custom', 'sharai_khana_vc') => 'custom'
                                     ),
                "group" => "Design",
                "description" => __("Choose Custom to create your own theme.", 'sharai_khana_vc')
            ),
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("FAQ title color", 'sharai_khana_vc'),
                "param_name" => "faq_title_color",
                "value" => "#2C2C2C",
                "description" =>__("This color will apply in faq title text.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("FAQ title background", 'sharai_khana_vc'),
                "param_name" => "faq_title_bg",
                "value" => "#FBFBFB",
                "description" =>__("This color will apply in faq title background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("FAQ details color", 'sharai_khana_vc'),
                "param_name" => "faq_details_color",
                "value" => "#2C2C2C",
                "description" =>__("This color will apply in faq details text.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("FAQ details background", 'sharai_khana_vc'),
                "param_name" => "faq_details_bg",
                "value" => "#FBFBFB",
                "description" =>__("This color will apply in faq details background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("FAQ Item", 'sharai_khana_vc'),
        "description" => 'Add faq item.',
        "base" => "sharai_khana_faq_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_faq'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            
                array(
                    "admin_label" => true,
                    "type" => "textfield",
                    "heading" => __("Title", 'sharai_khana_vc'),
                    "param_name" => "faq_title",
                    "description" => '',
                ),            
                array(
                    "type" => "textarea_html",
                    "heading" => __("Details", 'sharai_khana_vc'),
                    "param_name" => "content",
                    "description" => '',
                )
        )
    ));
}

sharai_khana_faq_vc_addon_function();

// For FAQ

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Faq extends WPBakeryShortCodesContainer {
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Faq_Item extends WPBakeryShortCode {
        
    }
}