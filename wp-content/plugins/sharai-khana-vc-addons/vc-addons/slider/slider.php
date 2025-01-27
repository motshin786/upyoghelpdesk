<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'slider/shortcodes/slider_shortcode.php' );

// VC Elements.

function sharai_khana_slider_vc_addon_function() {
    
    $layout = array(
                    __("SELECT", "sharai_khana_vc") => '',
                    __("Slider Layout 01", "sharai_khana_vc") => 'slider_1'
                    );
    
    $theme = array(
                    __("Default Button", 'sharai_khana_vc') => '',
                    __("Custom Button", 'sharai_khana_vc') => 'custom'
                    );    
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Slider Block", "sharai_khana_vc"),
        "description" => __("Place Slider In Page.", "sharai_khana_vc"),
        "base" => "sharai_khana_slider",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_slider_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "controls" => "full",
        "is_container" => false,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            // add params same as with any other content element
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Layout", "sharai_khana_vc"),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select slider layout style.", "sharai_khana_vc")
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Slider Navigation Arrow?", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Disable Slider Image Zoom Effect?", 'sharai_khana_vc'),
                "param_name" => "bg_effect",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Slider Navigation Dots?", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Navigation Button Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => $theme,
                "description" => __("Select custom to design your own button style.", 'sharai_khana_vc'),
                "group" => "Design"
            ),
            
             array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Navigation Background", 'sharai_khana_vc'),
                "param_name" => "nav_bg",
                "value" => "#80b435",
                "description" =>  __("Set navigation background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Navigation Icon Color", 'sharai_khana_vc'),
                "param_name" => "nav_color",
                "value" => "#FFFFFF",
                "description" =>  __("Set navigation icon color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                'type' => 'iconpicker',
                'heading' => __('Left Navigation Icon', 'sharai_khana_vc'),
                'param_name' => 'carousel_nav_icon_left',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Design",
                "value" => 'fa-angle-left',
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                'type' => 'iconpicker',
                'heading' => __('Right Navigation Icon', 'sharai_khana_vc'),
                'param_name' => 'carousel_nav_icon_right',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Design",
                "value" => 'fa-angle-right',
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
               "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Slider Item", "sharai_khana_vc"),
        "description" => __('Add Slider Item.', "sharai_khana_vc"),
        "base" => "sharai_khana_slider_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_slider'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textarea_html",
                "heading" => __("Slider Title Text", "sharai_khana_vc"),
                "param_name" => "content",
                "description" => __("You can add html and custom css code as slider title text.", "sharai_khana_vc"),
                "group" => "General"
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Slider Title Class", 'sharai_khana_vc'),
                "param_name" => "slider_title_class",
                "value" => "",
                "description" => __("Example: theme-custom-no-text-shadow", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            array(
                'type' => 'animation_style',
                'heading' => __('Content Animation in Style', 'sharai_khana_vc'),
                'param_name' => 'content_animation_in',
                'description' => __('Choose your animation style', 'sharai_khana_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            ),
            
             array(
                'type' => 'animation_style',
                'heading' => __('Content Animation Out Style', 'sharai_khana_vc'),
                'param_name' => 'content_animation_out',
                'description' => __('Choose your animation style', 'sharai_khana_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            ),
           
            
            array(
                "type" => "textarea",
                "heading" => __("Slider Sub Title", "sharai_khana_vc"),
                "param_name" => "slider_sub_title",
                "description" => '',
                "group" => "General"
            ),
            
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Slider Sub Title Class", 'sharai_khana_vc'),
                "param_name" => "slider_sub_title_class",
                "value" => "",
                "description" => __("Example: theme-custom-no-text-shadow", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            array(
                "type" => "checkbox",
                "heading" => __("Hide Slider Sub Title", "sharai_khana_vc"),
                "param_name" => "slider_sub_title_status",
                "value" => array(__("Yes", "sharai_khana_vc") => "1"),
                "description" => '',
                "group" => "General"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Background Type", 'sharai_khana_vc'),
                "param_name" => "bg_type",
                "value" => array(
                                        'Image' => 'image', 
                                        'Solid Color' => 'solid'
                                     ),
                "description" =>"",
                "group" => "Design"
            ),
            
            array(
                "holder" => 'img',
                "type" => "attach_image",
                "heading" => __("Slider Background Image", "sharai_khana_vc"),
                "param_name" => "slider_image",
                "description" => '',
                'group' => 'Design',
                "dependency" => array('element' => "bg_type", 'value' => array('image'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Image Overlay Color", 'sharai_khana_vc'),
                "param_name" => "bg_color",
                "value" => "#555555",
                "description" => __("Note: Please keep alpha to 100% and set ovarlay opacity in following drop down.", "sharai_khana_vc"),
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('image'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Image Overlay Opacity", 'sharai_khana_vc'),
                "param_name" => "bg_opacity",
                "value" => sharai_khana_overlay_opacity(),
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('image'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Solid Background Color", 'sharai_khana_vc'),
                "param_name" => "solid_bg",
                "value" => "#000000",
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('solid'))
            ),
            
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "description" =>"",
                "group" => "Design"
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Slider Sub Title Text Color", 'sharai_khana_vc'),
                "param_name" => "slider_sub_title_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>"",
                "group" => "Design"
            ),
            
            /*-----  BUTTON 01----*/
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Button#1", "sharai_khana_vc"),
                "param_name" => "ctrl_btn_1",
                "value" => array(__("Yes", "sharai_khana_vc") => '1'),
                "description" => "",
                "group" => "Button 01"
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Button#1 Text", "sharai_khana_vc"),
                "param_name" => "btn_1_text",
                "description" => '',
                'group' => 'Button 01',
                "dependency" => array('element' => "ctrl_btn_1", 'value' => array('1'))
            ),
            
            
            array(
                "type" => "vc_link",
                "heading" => __("Button#1 URL", "sharai_khana_vc"),
                "param_name" => "btn_1_url",
                "description" => '',
                "group" => "Button 01",
                "dependency" => array('element' => "ctrl_btn_1", 'value' => array('1'))
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Button#1 Class", 'sharai_khana_vc'),
                "param_name" => "btn_1_class",
                "value" => "",
                "description" => __("Example: btn-theme-invert, btn-theme-white, btn-square, btn-small", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "ctrl_btn_1", 'value' => array('1'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button#1 Theme", 'sharai_khana_vc'),
                "param_name" => "btn_1_theme",
                "value" => $theme,
                "description" => __("Select custom to design your own button style.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "ctrl_btn_1", 'value' => array('1'))      
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Border Radius", 'sharai_khana_vc'),
                "param_name" => "btn_1_border_radius",
                "value" => sharai_khana_border_radius( 0, 64 ),
                "description" =>  __("Set button border radius.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "btn_1_theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Background", 'sharai_khana_vc'),
                "param_name" => "btn_1_bg",
                "value" => "#FFFFFF",
                "description" =>  __("Set button background.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "btn_1_theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_1_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button text color.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "btn_1_theme", 'value' => array('custom'))
            ),
            
            // Button Hover Color.
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Background", 'sharai_khana_vc'),
                "param_name" => "btn_1_hover_bg",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button hover background.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "btn_1_theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_1_hover_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>  __("Set button hover text color.", 'sharai_khana_vc'),
                "group" => "Button 01",
                "dependency" => array('element' => "btn_1_theme", 'value' => array('custom'))
            ),
            
            /*-----  BUTTON 02----*/
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Button#2", "sharai_khana_vc"),
                "param_name" => "ctrl_btn_2",
                "value" => array(__("Yes", "sharai_khana_vc") => '1'),
                "description" => "",
                "group" => "Button 02"
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Button#2 Text", "sharai_khana_vc"),
                "param_name" => "btn_2_text",
                "description" => '',
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                'group' => 'Button 02'
            ),
            
            
            array(
                "type" => "vc_link",
                "heading" => __("Button#2 URL", "sharai_khana_vc"),
                "param_name" => "btn_2_url",
                "description" => '',
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Button#2 Class", 'sharai_khana_vc'),
                "param_name" => "btn_2_class",
                "value" => "",
                "description" => __("Example: btn-theme-invert, btn-theme-white, btn-square, btn-small", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button#2 Theme", 'sharai_khana_vc'),
                "param_name" => "btn_2_theme",
                "value" => $theme,
                "description" => __("Select custom to design your own button style.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Border Radius", 'sharai_khana_vc'),
                "param_name" => "btn_2_border_radius",
                "value" => sharai_khana_border_radius( 0, 64 ),
                "description" =>  __("Set button border radius.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Background", 'sharai_khana_vc'),
                "param_name" => "btn_2_bg",
                "value" => "#FFFFFF",
                "description" =>  __("Set button background.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_2_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button text color.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            // Button Hover Color.
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Background", 'sharai_khana_vc'),
                "param_name" => "btn_2_hover_bg",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button hover background.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_2_hover_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>  __("Set button hover text color.", 'sharai_khana_vc'),
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1')),
                "group" => "Button 02"
            )
            
        )
    ));
}

sharai_khana_slider_vc_addon_function();


/*------------------------------  Visual Composer Part ---------------------------------*/


if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Sharai_Khana_Slider extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Sharai_Khana_Slider_Item extends WPBakeryShortCode {
        
    }

}