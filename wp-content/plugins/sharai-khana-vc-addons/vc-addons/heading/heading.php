<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'heading/shortcodes/heading_shortcode.php' );

// VC Elements.

function sharai_khana_heading_vc_addon_function() {
    
    $layout = array(
                    __("Layout 01 (Default)", 'sharai_khana_vc') => 'layout_1',
                    __("Layout 02 (Only Heading)", 'sharai_khana_vc') => 'layout_2',
                    __("Inline Heading", 'sharai_khana_vc') => 'layout_3',
                    __("Light Heading (For Black Background)", 'sharai_khana_vc') => 'layout_light'
                    );
    
     $theme = array(
                    __("Default", 'sharai_khana_vc') => '',
                    __("Custom", 'sharai_khana_vc') => 'custom'
                    );    
    
    // Wiz Heading Element.
 
    vc_map(array(
        "name" => __("Heading Block", 'sharai_khana_vc'),
        "description" => __("Place Heading In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_vc_heading",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "description" =>"",
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" => __("Title will be displayed below the separator.", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Additional Heading Title Class", 'sharai_khana_vc'),
                "param_name" => "custom_title_class",
                "value" => "",
                "description" => __("Example: heading-alt-style", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            array(
                "admin_label" => true,
                "type" => "textarea",
                "class" => "",
                "heading" => __("Sub Title", 'sharai_khana_vc'),
                "param_name" => "sub_title",
                "value" => "",
                "description" => __("Sub Title will be displayed above the separator.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_1', 'layout_light'))
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Additional Heading Sub Title Class", 'sharai_khana_vc'),
                "param_name" => "custom_sub_title_class",
                "value" => "",
                "description" => __("Example: subheading-alt-style", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Alter Heading Content Position", 'sharai_khana_vc'),
                "param_name" => "alt_pos",
                "value" => sharai_khana_boolean_term(),
                "description" =>__("If you select Yes, then title will be displayed followed by the Sub title.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_1', 'layout_light'))
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Select Heading Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "group" => "Design",
                "description" => __("Set content alignment of heading block.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Horizontal Separator?", 'sharai_khana_vc'),
                "param_name" => "horizontal_sep_status",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => __("A horizontal line will be appeared between title and sub title.", 'sharai_khana_vc'),
                "group" => "Design"
            ),
            
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Separator Attachment?", 'sharai_khana_vc'),
                "param_name" => "sep_attachment",
                "value" => array(
                                     __('Between Heading Title & Sub Title', 'sharai_khana_vc') => '', 
                                     __('With Heading Title', 'sharai_khana_vc') => 'with_title', 
                                     __('With Heading Sub Title', 'sharai_khana_vc') => 'with_sub_title',
                                    __('No Separator', 'sharai_khana_vc') => 'no_separator'
                                 ),
                "description" =>"",
                "group" => "Design"
            ),
            
             array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Separator Position?", 'sharai_khana_vc'),
                "param_name" => "sep_pos",
                "value" => array(
                                    __('Select', 'sharai_khana_vc') => '', 
                                     __('After Text', 'sharai_khana_vc') => 'after_text', 
                                     __('Before Text', 'sharai_khana_vc') => 'before_text'
                                 ),
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "sep_attachment", 'value' => array('with_sub_title' , 'with_title'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => $theme,
                "description" =>"",
                "group" => "Design"
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Separator Color", 'sharai_khana_vc'),
                "param_name" => "sep_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Title Color", 'sharai_khana_vc'),
                "param_name" => "title_color",
                "value" => SHARAI_KHANA_TEXT_COLOR,
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Sub Title Color", 'sharai_khana_vc'),
                "param_name" => "sub_title_color",
                "value" => SHARAI_KHANA_TEXT_COLOR,
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border Upper Color", 'sharai_khana_vc'),
                "param_name" => "border_upper",
                "value" => "#40C1F0",
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "layout", 'value' => array('layout_3'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border Bottom Color", 'sharai_khana_vc'),
                "param_name" => "border_bottom",
                "value" => "#EEEEEE",
                "description" =>"",
                "group" => "Design",
                "dependency" => array('element' => "layout", 'value' => array('layout_3'))
            ),
            array(
                'type' => 'animation_style',
                'heading' => __( 'Animation Style', 'sharai_khana_vc' ),
                'param_name' => 'animation',
                'description' => __( 'Choose your animation style', 'sharai_khana_vc' ),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )
            
        )
        
    ));
    
}

sharai_khana_heading_vc_addon_function();