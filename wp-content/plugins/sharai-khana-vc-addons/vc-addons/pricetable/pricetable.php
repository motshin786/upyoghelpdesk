<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'pricetable/shortcodes/pricetable_shortcode.php' );

// VC Elements.

function sharai_khana_pricetable_vc_addon_function() {


    $layout = array(
        __("Layout 01 (Simple Column Grid)", "sharai_khana_vc") => 'simple',
        __("Layout 02 (No Column Padding Grid)", "sharai_khana_vc") => 'no_padding'
    );
    
    $column = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("2 items each row", 'sharai_khana_vc') => '2',
                    __("3 items each row", 'sharai_khana_vc') => '3',
                    __("4 items each row (Default)", 'sharai_khana_vc') => '4'
                    );

    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Pricetable", "sharai_khana_vc"),
        "description" => __("Place Pricetable In Page.", "sharai_khana_vc"),
        "base" => "sharai_khana_pricetable",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_pricetable_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
        "content_element" => true,
        "show_settings_on_create" => true,
        "controls" => "full",
        "is_container" => false,
        "icon" => "icon-sharai-khana-vc-addon",
        "class" => "sharai_khana_pricetable",
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Price Table Layout", "sharai_khana_vc"),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select pricetable layout style.", "sharai_khana_vc")
            ),
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "column",
                "value" => $column,
                "group" => "General",
                "description" => __("Number of items display each row.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Display Price Header Border?", 'sharai_khana_vc'),
                "param_name" => "header_border",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "Design",
            ),            
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of pricing table box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
            )
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Pricetable Item", "sharai_khana_vc"),
        "description" => 'Add Pricetable Item',
        "base" => "sharai_khana_pricetable_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_pricetable'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "class" => 'sharai_khana_pricetable_item',
        "params" => array(
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Featured Plan?", "sharai_khana_vc"),
                "param_name" => "featured",
                "value" => array(
                                    __('No', 'sharai_khana_vc') => '0',
                                    __('Yes', 'sharai_khana_vc') => '1'
                                ),
                "description" => "",
                "group" => "General",
            ),
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Label", "sharai_khana_vc"),
                "param_name" => "pricetable_type",
                "value" => "",
                "description" => __("Example: Basic, Standard, Business, Premium etc.", "sharai_khana_vc"),
                "group" => "General",
            ),
            
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Description", "sharai_khana_vc"),
                "param_name" => "pricetable_desc",
                "value" => "",
                "description" => __("Add a short details for  pricing column.", "sharai_khana_vc"),
                "group" => "General",
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Currency", "sharai_khana_vc"),
                "param_name" => "pricetable_currency",
                "value" => '',
                "description" => __("Example: $", "sharai_khana_vc"),
                "group" => "General",
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Price", "sharai_khana_vc"),
                "param_name" => "pricetable_price",
                "value" => "",
                "description" =>  __("Example: 10, 10.99 or any numeric value.", "sharai_khana_vc"),
                "group" => "General",
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Period", "sharai_khana_vc"),
                "param_name" => "pricetable_period",
                "value" => array(
                                    __('Select', 'sharai_khana_vc') => '',
                                    __('Yearly', 'sharai_khana_vc') => 'year',
                                    __('Monthly', 'sharai_khana_vc') => 'month', 
                                    __('Daily', 'sharai_khana_vc') => 'day', 
                                    __('Hourly', 'sharai_khana_vc') => 'hour'
                                 ),
                "description" => __("Choose plan duration.", "sharai_khana_vc"),
                "group" => "General",
            ),
            
            // Pricing Table Details
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Details Type", "sharai_khana_vc"),
                "param_name" => "pricetable_details_type",
                "value" => array(
                                    __('Lists', 'sharai_khana_vc') => 'list', 
                                    __('Compact', 'sharai_khana_vc') => 'compact'
                                 ),
                "description" =>"",
                "group" => "Details",
            ),
            array(
                "type" => "textarea_html",
                "class" => "",
                "heading" => __("Details", "sharai_khana_vc"),
                "param_name" => "content",
                "value" => '',
                "description" => 'For lists details type use the shortcode: [sharai_khana_pt_item title="feature text"]',
                "group" => "Details",
            ),
            
            // Icons
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Type", "sharai_khana_vc"),
                "param_name" => "pricetable_image_type",
                "value" => array(
                                    __('Image Icon', 'sharai_khana_vc') => 'pti_image', 
                                    __('Font Awesome Icon', 'sharai_khana_vc') => 'pti_fa',
                                    __('No Image', 'sharai_khana_vc') => 'pti_none'
                                 ),
                "description" =>"",
                "group" => "Icon",
            ),
            
            array(
                "type" => "attach_image",
                "heading" => __("Pricetable Image", 'sharai_khana_vc'),
                "param_name" => "pricetable_image",
                "description" => __("Add pricetable image. Recommended Size: 64 X 64 px.", 'sharai_khana_vc'),
                "group" => "Icon",
                "dependency" => array('element' => "pricetable_image_type", 'value' => array('pti_image'))
            ),
            
            array(
                'type' => 'iconpicker',
                'heading' => __('Icon', 'sharai_khana_vc'),
                'param_name' => 'pricetable_icon',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "Icon",
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
                "dependency" => array('element' => "pricetable_image_type", 'value' => array('pti_fa'))
            ),
            
            // Button
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Button", 'sharai_khana_vc'),
                "param_name" => "rm_link_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Button",
                "description" => __("Display CTA button in pricing table.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Button Text", 'petcare_vc'),
                "param_name" => "url_text",
                "value" => __("Learn More &raquo;", 'petcare_vc'),
                "description" => __("Set custom text for button. Default - Purchase Now", 'sharai_khana_vc'),
                "group" => "Button",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Button Link", 'petcare_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link of read more button.", 'sharai_khana_vc'),
                "group" => "Button",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Button Extra Class", 'sharai_khana_vc'),
                "param_name" => "btn_ext_class",
                "value" => "",
                "description" => __("Add additional class of pricing table button.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Button",
            ),
            
            // Design
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of pricing table box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Content Alignment", "sharai_khana_vc"),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "description" => __("You can set pricing table content alignment.", "sharai_khana_vc"),
                "group" => "Design",
            ),
            
            // Regular
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_box_bg",
                "value" => "#FAFAFA",
                "description" => __("Set box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Label Color (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_type_color",
                "value" => "",
                "description" => __("Set regular pricetable type color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Currency Color (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_currency_color",
                "value" => "#659088",
                "description" => __("Set regular pricetable currency color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Price Color (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_price_color",
                "value" => "#80b435",
                "description" => __("Set regular pricetable price color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Period Color (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_period_color",
                "value" => "#646E7A",
                "description" => __("Set regular pricetable period color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Details (Regular)", 'sharai_khana_vc'),
                "param_name" => "pt_details_color",
                "value" => "#2C2C2C",
                "description" => __("Set regular pricetable details color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('0'))
            ),
            
            //Featured.
            
            array(
                "type" => "colorpicker",
                "class" => "vc_col-xs-4",
                "heading" => __("Box Background (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_box_bg",
                "value" => "#80b435",
                "description" => __("Set featured box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "vc_col-xs-4",
                "heading" => __("Label Color (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_type_color",
                "value" => "#FFFFFF",
                "description" => __("Set featured pricetable type color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Currency Color (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_currency_color",
                "value" => "#FFFFFF",
                "description" => __("Set featured pricetable Currency color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Price Color (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_price_color",
                "value" => "#FFFFFF",
                "description" => __("Set featured pricetable Price color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Period Color (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_period_color",
                "value" => "#FFFFFF",
                "description" => __("Set featured pricetable period color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Details (Featured)", 'sharai_khana_vc'),
                "param_name" => "fpt_details_color",
                "value" => "#FFFFFF",
                "description" => __("Set featured pricetable details color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "featured", 'value' => array('1'))
            ),
            
            // Featured Button Pricing Table.
            
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

sharai_khana_pricetable_vc_addon_function();

// For Pricing Table.

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Pricetable extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Pricetable_Item extends WPBakeryShortCode {
        
    }
}