<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'logos/shortcodes/logos_shortcode.php' );

// VC Elements.

function sharai_khana_logos_vc_addon_function() {
    
    $layout = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("Simple Layout", 'sharai_khana_vc') => 'layout_1',
                    __("Carousel Layout", 'sharai_khana_vc') => 'layout_2'
                    );    
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Logos", 'sharai_khana_vc'),
        "description" => __( "Place Logo In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_logos",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_logo_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "controls" => "full",
        "is_container" => false,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Logos Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select logo layout style.", 'sharai_khana_vc')
            ),
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Items Per Row", 'sharai_khana_vc'),
                "param_name" => "carousel_items",
                "value" => sharai_khana_items_per_row(8,1),
                "group" => "General",
                "description" => __("Select no of item you like to show each row.", 'sharai_khana_vc')
            ),
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "dependency" => array('element' => "layout", 'value' => array('layout_2'))
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Arrow?", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_2'))
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Dots?", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_2'))
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for logo layout.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
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
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in logo border and navigation button.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'sharai_khana_vc' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'sharai_khana_vc' ),
                'weight' => 0,
                'group' => 'Animation',
            )
            
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("LOGO ITEM", 'sharai_khana_vc'),
        "description" => 'Add logo item',
        "base" => "sharai_khana_logo_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_logos'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
             array(
                "type" => "textfield",
                "heading" => __("Logo Title", 'sharai_khana_vc'),
                "param_name" => "logo_title",
                "description" => '',
                "group" => "General"
            ),
            array(
                "holder" => "img",
                "type" => "attach_image",
                "heading" => __("Logo Image", 'sharai_khana_vc'),
                "param_name" => "logo_image",
                "description" => '',
                "group" => "General"
            ),
            array(
                "admin_label" => true,
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Logo URL:", 'sharai_khana_vc'),
                "param_name" => "logo_custom_link",
                "value" => "",
                "description" => __("Add custom logo link.", 'sharai_khana_vc'),
                "group" => "General"
            )
            
            
        )
    ));
}

sharai_khana_logos_vc_addon_function();


/*------------------------------  Visual Composer ---------------------------------*/

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Sharai_Khana_Logos extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Sharai_Khana_Logo_Item extends WPBakeryShortCode {
        
    }

}