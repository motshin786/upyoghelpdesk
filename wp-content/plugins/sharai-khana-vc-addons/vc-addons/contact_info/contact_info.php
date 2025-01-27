<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'contact_info/shortcodes/contact_info_shortcode.php' );

// VC Elements.

function sharai_khana_contact_info_vc_function() {   
    
    $layout = array(
                    __("Square Box", 'sharai_khana_vc') => 'square-layout',
                    __("Rounded Box", 'sharai_khana_vc') => 'rounded-layout'
                    );    
 
    vc_map(array(
        "name" => __("Contact Info", 'sharai_khana_vc'),
        "description" => __( "Place Contact Info In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_contact_info",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(
            
            array(
                "admin_label" => true,
                "type" => "textarea",
                "class" => "",
                "heading" => __("Address", 'sharai_khana_vc'),
                "param_name" => "contact_address",
                "value" => "",
                "description" => __("Add your address.", 'sharai_khana_vc'),
                "group" => "General",
            ),  
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Phone", 'sharai_khana_vc'),
                "param_name" => "contact_phone",
                "value" => "",
                "description" => __("Add Phone Number.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Email", 'sharai_khana_vc'),
                "param_name" => "contact_email",
                "value" => "",
                "description" => __("Add Email Address. (Seperate multiple email by a comma)", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Web URL", 'sharai_khana_vc'),
                "param_name" => "contact_web",
                "value" => "",
                "description" => __("Add Site URL. (Seperate multiple site by a comma)", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            // DESIGN TAB.
            
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Style", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select icon layout style.", 'sharai_khana_vc')
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
                "description" =>__("This color will apply in icon background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Icon Color", 'sharai_khana_vc'),
                "param_name" => "theme_icon_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>__("This color will apply in icon color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for contact info layout.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            
        )
    ));
    
    
}

sharai_khana_contact_info_vc_function();