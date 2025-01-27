<?php

require_once(SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'banner/shortcodes/banner_shortcode.php');

// VC Elements.

function sharai_khana_banner_vc_addon_function()
{

    $layout = array(
        __("Layout 01 ( Single Column )", 'sharai_khana_vc') => 'layout_1'
    );

    $theme = array(
        __("Default Button", 'sharai_khana_vc') => '',
        __("Custom Button", 'sharai_khana_vc') => 'custom'
    );

    vc_map(array(
        "name" => __("Static Banner", 'sharai_khana_vc'),
        "description" => __("Home Page Static Banner.", 'sharai_khana_vc'),
        "base" => "sharai_khana_vc_banner",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(

            array(
                "admin_label" => true,
                "type" => "textarea_html",
                "class" => "",
                "heading" => __("Banner Text", 'sharai_khana_vc'),
                "param_name" => "content",
                "value" => "",
                "description" => "",
                "group" => "General"
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "description" => "",
                "group" => "General"
            ),

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class to container.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "General",
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
                "description" => "",
                "group" => "Design"
            ),

            array(
                "type" => "attach_image",
                "heading" => __("Background Image", "sharai_khana_vc"),
                "param_name" => "banner_bg",
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
                "description" => "",
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('image'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Gradient Color?", 'sharai_khana_vc'),
                "param_name" => "gradient",
                "value" => sharai_khana_boolean_term(),
                "description" => "",
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('image'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Overlay Color 02", 'sharai_khana_vc'),
                "param_name" => "bg_color_2",
                "value" => "#555555",
                "description" => __("Note: Please keep alpha to 100% and set ovarlay opacity in following drop down.", "sharai_khana_vc"),
                "group" => "Design",
                "dependency" => array('element' => "gradient", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Overlay Opacity 02", 'sharai_khana_vc'),
                "param_name" => "bg_opacity_2",
                "value" => sharai_khana_overlay_opacity(),
                "description" => "",
                "group" => "Design",
                "dependency" => array('element' => "gradient", 'value' => array('1'))
            ),


            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Solid Background Color", 'sharai_khana_vc'),
                "param_name" => "solid_bg",
                "value" => "#000000",
                "description" => "",
                "group" => "Design",
                "dependency" => array('element' => "bg_type", 'value' => array('solid'))
            ),

            /*-----  BUTTON#1----*/

            array(
                "admin_label" => true,
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Button#1", "sharai_khana_vc"),
                "param_name" => "ctrl_btn_1",
                "value" => array(__("Yes", "sharai_khana_vc") => '1'),
                "description" => "",
                "group" => "Button 01"
            ),

            array(
                "admin_label" => true,
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
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Button #1 Extra Class", 'sharai_khana_vc'),
                "param_name" => "btn_1_cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of button#1.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "value" => sharai_khana_border_radius(0, 64),
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

            /*-----  BUTTON#2----*/

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
                "admin_label" => true,
                "type" => "textfield",
                "heading" => __("Button#2 Text", "sharai_khana_vc"),
                "param_name" => "btn_2_text",
                "description" => '',
                'group' => 'Button 02',
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1'))
            ),


            array(
                "admin_label" => true,
                "type" => "vc_link",
                "heading" => __("Button#2 URL", "sharai_khana_vc"),
                "param_name" => "btn_2_url",
                "description" => '',
                "group" => "Button 02",
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1'))
            ),

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Button #2 Extra Class", 'sharai_khana_vc'),
                "param_name" => "btn_2_cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of button#2.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "group" => "Button 02",
                "dependency" => array('element' => "ctrl_btn_2", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Border Radius", 'sharai_khana_vc'),
                "param_name" => "btn_2_border_radius",
                "value" => sharai_khana_border_radius(0, 64),
                "description" =>  __("Set button border radius.", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "btn_2_theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Background", 'sharai_khana_vc'),
                "param_name" => "btn_2_bg",
                "value" => "#FFFFFF",
                "description" =>  __("Set button background.", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "btn_2_theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_2_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button text color.", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "btn_2_theme", 'value' => array('custom'))
            ),

            // Button Hover Color.
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Background", 'sharai_khana_vc'),
                "param_name" => "btn_2_hover_bg",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>  __("Set button hover background.", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "btn_2_theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Button Hover Text Color", 'sharai_khana_vc'),
                "param_name" => "btn_2_hover_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>  __("Set button hover text color.", 'sharai_khana_vc'),
                "group" => "Button 02",
                "dependency" => array('element' => "btn_2_theme", 'value' => array('custom'))
            ),

            array(
                'type' => 'animation_style',
                'heading' => __('Animation Style', 'sharai_khana_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style', 'sharai_khana_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )

        )
    ));
}

sharai_khana_banner_vc_addon_function();