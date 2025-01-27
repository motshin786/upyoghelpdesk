<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'gallery/shortcodes/gallery_shortcode.php' );


// VC Elements.

function sharai_khana_gallery_vc_addon_function() {
        
      $layout = array(
                    __("SELECT", "sharai_khana_vc") => '',
                    __("Layout 01 (Simple)", "sharai_khana_vc") => 'simple',
                    __("Layout 02 (Carousel)", "sharai_khana_vc") => 'carousel'
                    );
      
        $columns = array(
            __("4 Columns (Default)", 'sharai_khana_vc') => 4,
            __("3 Columns", 'sharai_khana_vc') => 3,
            __("2 Columns", 'sharai_khana_vc') => 2,
            __("1 Column", 'sharai_khana_vc') => 1
        );
    
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Gallery", "sharai_khana_vc"),
        "description" => __( 'Place Gallery In Page.', "sharai_khana_vc"),
        "base" => "sharai_khana_gallery",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_gallery_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "controls" => "full",
        "is_container" => false,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            // add params same as with any other content element
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Layout", "sharai_khana_vc"),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select gallery layout style.", "sharai_khana_vc")
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "column",
                "value" => $columns,
                "group" => "General",
                "description" => __("Select number columns each row.", 'sharai_khana_vc'),
                "dependency" => array('element' => "layout", 'value' => array('layout_1'))
            ),
            
            
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Items Per Row", 'sharai_khana_vc'),
                "param_name" => "carousel_items",
                "value" => sharai_khana_items_per_row(7,1),
                "group" => "General",
                "description" => __("Select no of item you like to show each row.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Button?", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('carousel'))
            ),
            
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "dependency" => array('element' => "layout", 'value' => array('carousel'))
            ),
            
            // DESIGN TAB.
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Enable No Padding Gallery", "sharai_khana_vc"),
                "param_name" => "no_padding",
                "value" => sharai_khana_boolean_term(),
                "group" => "Design",
                "description" => __("If you select yes, then there will no space between each column.", "sharai_khana_vc")
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
                'type' => 'iconpicker',
                'heading' => __('Icon', 'sharai_khana_vc'),
                'param_name' => 'icon',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Design",
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in overlay & Icon color button.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            )
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Gallery Item", "sharai_khana_vc"),
        "description" => 'Add Gallery Item',
        "base" => "sharai_khana_gallery_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_gallery'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            array(
                "holder" => "image",
                "type" => "attach_image",
                "heading" => __("Choose Image", "sharai_khana_vc"),
                "param_name" => "gallery_img",
                "description" => __("Select gallery image.", "sharai_khana_vc"),
                "group" => "General"
            )
            
            
        )
    ));
}

sharai_khana_gallery_vc_addon_function();


// For Gallery

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Gallery extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Gallery_Item extends WPBakeryShortCode {
        
    }
}