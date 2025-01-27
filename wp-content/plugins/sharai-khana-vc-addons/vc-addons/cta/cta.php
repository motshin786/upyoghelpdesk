<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'cta/shortcodes/cta_shortcode.php' );

// VC Elements.

function sharai_khana_cta_vc_addon_function() {

    $layout = array(
        __("Layout 01 ( Single Column )", 'sharai_khana_vc') => 'layout_1',
        __("Layout 02 ( Double Columns )", 'sharai_khana_vc') => 'layout_2',
    );

    vc_map(array(
        "name" => __("CTA Block", 'sharai_khana_vc'),
        "description" => __('Display Call To Action Box In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_vc_cta",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "description" => __("Select Layout of Call To Action Box", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textarea_html",
                "class" => "",
                "heading" => __("CTA Text", 'sharai_khana_vc'),
                "param_name" => "content",
                "value" => "",
                "description" => "Note: For Headline of CTA use h2 tag and for sub heading use h4 tag.",
                "group" => "General"
            ),
            
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("CTA Link", 'sharai_khana_vc'),
                "param_name" => "cta_link",
                "value" => "",
                "description" => "",
                "group" => "General"
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
                "type" => "dropdown",
                "class" => "",
                "heading" => __("CTA Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "description" =>"",
                "group" => "Design"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("CTA Button Alignment", 'sharai_khana_vc'),
                "param_name" => "btn_alignment",
                "value" => sharai_khana_content_alignment(),
                "description" =>"",
                "group" => "Design"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("CTA Button Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => array(
                    __("Default Button", 'sharai_khana_vc') => '',
                    __("Custom Button", 'sharai_khana_vc') => 'custom'
                    ),
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
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
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
                "value" => SHARAI_KHANA_LIGHT_BG,
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
                "value" => SHARAI_KHANA_LIGHT_BG,
                "description" =>  __("Set button hover border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            )
            
        )
    ));
}

sharai_khana_cta_vc_addon_function();
