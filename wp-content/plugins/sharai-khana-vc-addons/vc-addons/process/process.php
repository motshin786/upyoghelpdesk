<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'process/shortcodes/process_shortcode.php' );

// VC Elements.

function sharai_khana_process_vc_addon_function() {

    $layout = array(
        __("Grid Layout (Default)", 'sharai_khana_vc') => '',
        __("Carousel Layout", 'sharai_khana_vc') => 'carousel'
    );

    $columns = array(
        __("Select", 'sharai_khana_vc') => '',
        __("4 Columns", 'sharai_khana_vc') => 4,
        __("3 Columns (Default)", 'sharai_khana_vc') => 3,
        __("2 Columns", 'sharai_khana_vc') => 2,
        __("1 Column", 'sharai_khana_vc') => 1
    );


    //Register "container" content element. It will hold all your inner (child) content elements
    
    vc_map(array(
        "name" => __("Process Block", 'sharai_khana_vc'),
        "description" => __("Add multiple process blocks.", 'sharai_khana_vc'),
        "base" => "sharai_khana_process",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_process_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Process Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select process layout style.", 'sharai_khana_vc')
            ),
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "columns",
                "value" => $columns,
                "group" => "General",
                "description" => __("Select number columns each row.", 'sharai_khana_vc')
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
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for this block.", 'sharai_khana_vc')  . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Box Shadow?", 'sharai_khana_vc'),
                "param_name" => "box_shadow_status",
                "value" => array(
                                        __('No', 'sharai_khana_vc') => '0', 
                                        __('Yes', 'sharai_khana_vc') => '1'
                                     ),
                "group" => "Design",
                "description" => __("You can add box shadow animation in highlight box.", 'sharai_khana_vc')
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
                "description" =>__("This color will apply in process navigation button.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            )
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Process Item", 'sharai_khana_vc'),
        "description" => 'Add process item',
        "base" => "sharai_khana_process_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_process'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" => __("Set the heading of process box. Example - REGISTRATION.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => __("Content", 'sharai_khana_vc'),
                "param_name" => "process_content",
                "value" => "",
                "description" => __("Write a brief about process content.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Icon Type", 'sharai_khana_vc'),
                "param_name" => "icon_type",
                "value" => array(
                                        __('Custom Image', 'sharai_khana_vc') => 'img_icon', 
                                        __('Font Awesome Icon ( Default )', 'sharai_khana_vc') => 'fa_icon'
                                     ),
                "group" => "General",
                "description" => __("Display read more button in process box.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "attach_image",
                "heading" => __("Process Image", 'sharai_khana_vc'),
                "param_name" => "process_image",
                "description" => __("Add process image. Recommended Size: 72 X 72 px.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "icon_type", 'value' => array('img_icon'))
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
                "group" => "General",
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
                "dependency" => array('element' => "icon_type", 'value' => array('fa_icon'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Process Count Number?", 'sharai_khana_vc'),
                "param_name" => "process_count_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "General"
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Process Count Text", 'sharai_khana_vc'),
                "param_name" => "process_count_value",
                "value" => "",
                "description" => __("Example - 01, 02, 03", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "process_count_status", 'value' => array('1'))
            ),
            
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Add Custom Link?", 'sharai_khana_vc'),
                "param_name" => "rm_link_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "General"
            ),
            
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Custom Link", 'sharai_khana_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link in heading text.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for this block.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Select Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
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
                "description" => __("Choose Custom to create your own style.", 'sharai_khana_vc')
            ),
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background", 'sharai_khana_vc'),
                "param_name" => "theme_bg",
                "value" => "#f8f9fa",
                "description" =>__("Set box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Hover Background", 'sharai_khana_vc'),
                "param_name" => "theme_hover_bg",
                "value" => "#F8F9FA",
                "description" =>__("On mouse hover service box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Process Icon Color", 'sharai_khana_vc'),
                "param_name" => "process_icon_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in process font awesome icon.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Process Count Color", 'sharai_khana_vc'),
                "param_name" => "process_count_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in process count color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Process Title Color", 'sharai_khana_vc'),
                "param_name" => "process_title_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in process title.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Process Info Color", 'sharai_khana_vc'),
                "param_name" => "process_info_color",
                "value" => SHARAI_KHANA_TEXT_COLOR,
                "description" =>__("This color will apply in process info.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            )
            
            
        )
    ));
    
}

sharai_khana_process_vc_addon_function();

// For Process

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Process extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Process_Item extends WPBakeryShortCode {
        
    }
}