<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'testimonial/shortcodes/testimonial_shortcode.php' );

// VC Elements.

function sharai_khana_testimonial_vc_addon_function() {
    
    $layout = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("Carousel Layout", 'sharai_khana_vc') => 'layout_1',
                    __("Simple Layout (Without Carousel)", 'sharai_khana_vc') => 'layout_2'
                    );    
    
      $testimony_style = array(
                    __("Large Icon", 'sharai_khana_vc') => 'large_icon',
                    __("Small Icon", 'sharai_khana_vc') => 'small_icon'
                    );   
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Testimonials", 'sharai_khana_vc'),
        "description" => __('Place Testimonials In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_testimonial",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_testimonial_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Testimonial Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select Testimonial Layout Style.", 'sharai_khana_vc')
            ),
            
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Style", 'sharai_khana_vc'),
                "param_name" => "testimony_style",
                "value" => $testimony_style,
                "group" => "General",
                "description" => __("Select Testimonial Layout Style.", 'sharai_khana_vc')
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Item Per Row", 'sharai_khana_vc'),
                "param_name" => "item_per_row",
                "value" => sharai_khana_items_per_row(3,1),
                "group" => "General",
                "description" => ''
            ),
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "dependency" => array('element' => "layout", 'value' => array('layout_1'))
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Arrow?", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_1'))
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Dots?", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_1'))
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of testimonial box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Select Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => array(
                                __('Select', 'sharai_khana_vc') => '', 
                                'Left' => 'left', 
                                'Center' => 'center'
                             ),
                "group" => "Design",
                "description" => __("Set content alignment of testimonial info block.", 'sharai_khana_vc')
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
                "description" =>__("This color will apply in quote icon, navigation arrow and dot.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Testimonial Background", 'sharai_khana_vc'),
                "param_name" => "testimonial_bg",
                "value" => '#FFFFFF',
                "description" =>__("This color will apply in testimonial container background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Testimonial Text Color", 'sharai_khana_vc'),
                "param_name" => "testimonial_theme_color",
                "value" => '#555555',
                "description" =>__("This color will apply in testimonial text color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Testimonial Designation Color", 'sharai_khana_vc'),
                "param_name" => "designation_color",
                "value" => '#888888',
                "description" =>__("This color will apply in testimonial designation color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            )               
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Testimonial Item", 'sharai_khana_vc'),
        "description" => 'Add testimonial item.',
        "base" => "sharai_khana_testimonial_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_testimonial'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            
                array(
                    "admin_label" => true,
                    "type" => "textarea_html",
                    "heading" => __("Testimonial Text", 'sharai_khana_vc'),
                    "param_name" => "content",
                    "description" => '',
                ),            
                array(
                    "admin_label" => true,
                    "type" => "textfield",
                    "heading" => __("User Name", 'sharai_khana_vc'),
                    "param_name" => "user_name",
                    "description" => '',
                ),
                array(
                    "type" => "textfield",
                    "heading" => __("User Designation", 'sharai_khana_vc'),
                    "param_name" => "user_designation",
                    "description" => '',
                ),
            
                array(
                    "type" => "attach_image",
                    "heading" => __("User Image", 'sharai_khana_vc'),
                    "param_name" => "user_image",
                    "description" => '',
                ),
        )
    ));
}

sharai_khana_testimonial_vc_addon_function();

// For Testimonial.

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    
    class WPBakeryShortCode_Sharai_Khana_Testimonial extends WPBakeryShortCodesContainer {
    }
    
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    
    class WPBakeryShortCode_Sharai_Khana_Testimonial_Item extends WPBakeryShortCode {
    }
    
}