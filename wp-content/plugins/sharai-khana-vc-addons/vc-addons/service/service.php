<?php

require_once(SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'service/shortcodes/service_shortcode.php');

// VC Elements.

function sharai_khana_service_vc_addon_function()
{

    $layout = array(
        __("Grid Style 01 (Default)", 'sharai_khana_vc') => 'layout_1',
        __("Grid Style 02", 'sharai_khana_vc') => 'layout_2',
        __("Grid Style 03", 'sharai_khana_vc') => 'layout_3'
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
        "name" => __("Service Block", 'sharai_khana_vc'),
        "description" => __("Add Multiple Service Blocks.", 'sharai_khana_vc'),
        "base" => "sharai_khana_service",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_service_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select service layout style.", 'sharai_khana_vc')
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "columns",
                "value" => $columns,
                "group" => "General",
                "description" => __("Select number columns each row.", 'sharai_khana_vc')
            ),

            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Carousel?", 'sharai_khana_vc'),
                "param_name" => "carousel",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Arrow?", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Carousel Navigation Dots?", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            // DESIGN TAB.

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for service layout.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "description" => __("Select custom to create your own theme.", 'sharai_khana_vc')
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" => __("This color will apply in navigation arrow and dot.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),

            array(
                'type' => 'animation_style',
                'heading' => __('Animation Style', 'sharai_khana_vc'),
                'param_name' => 'animation',
                'description' => __('Choose your animation style.', 'sharai_khana_vc'),
                'admin_label' => false,
                'weight' => 0,
                'group' => 'Animation',
            )

        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Service Item", 'sharai_khana_vc'),
        "description" => __("Add services item", 'sharai_khana_vc'),
        "base" => "sharai_khana_service_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_service'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "textarea",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" => __("Set the heading of services box. Example - Support Forum.", 'sharai_khana_vc'),
                "group" => "General",
            ),

            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Title", 'sharai_khana_vc'),
                "param_name" => "additional_title",
                "value" => "",
                "description" => __("Setup additional service text. Example - Starting@99", 'sharai_khana_vc'),
                "group" => "General",
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Display Short Description", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => array(
                    __('Default', 'sharai_khana_vc') => 'default',
                    __('Custom', 'sharai_khana_vc') => 'custom'
                ),
                "group" => "Design",
                "description" => __("Choose Custom to create your own service box.", 'sharai_khana_vc')
            ),

            array(
                "admin_label" => true,
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Display Short Description?", 'sharai_khana_vc'),
                "param_name" => "short_desc_status",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_3'))
            ),

            array(
                "type" => "textarea",
                "class" => "",
                "heading" => __("Short Description", 'sharai_khana_vc'),
                "param_name" => "short_desc",
                "value" => "",
                "description" => __("Add short description for service.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "short_desc_status", 'value' => array('1'))
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Service Icon', 'sharai_khana_vc'),
                'param_name' => 'icon',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "General",
                'description' => __('Select icon from library.', 'petcare_vc'),
            ),


            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Service Icon?", 'sharai_khana_vc'),
                "param_name" => "hide_service_icon",
                "value" => sharai_khana_boolean_term(),
                "group" => "General"
            ),

            array(
                "type" => "attach_image",
                "heading" => __("Service Image", 'sharai_khana_vc'),
                "param_name" => "service_image",
                "description" => __("Add service box image. Recommended Size: 800 X 530 px.", 'sharai_khana_vc'),
                "group" => "General",
            ),

            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Service Page URL", 'srcare_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link for service.", 'srcare_vc'),
                "group" => "General"
            ),


            // DESIGN TAB.

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Select Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "group" => "Design",
                "description" => __("Set content alignment of service block.", 'sharai_khana_vc')
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
                "description" => __("Choose Custom to create your own service box.", 'sharai_khana_vc')
            ),


            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background", 'sharai_khana_vc'),
                "param_name" => "theme_bg",
                "value" => "#FFFFFF",
                "description" => __("Regular service box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Icon/Additional Title Background", 'sharai_khana_vc'),
                "param_name" => "service_icon_bg",
                "value" => "#80B435",
                "description" => __("Custom Additional Icon/Title background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Icon/Additional Title Color", 'sharai_khana_vc'),
                "param_name" => "service_icon_color",
                "value" => "#FFFFFF",
                "description" => __("Custom Additional Icon/Title background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Hover Background", 'sharai_khana_vc'),
                "param_name" => "theme_hover_bg",
                "value" => "#FBFBFB",
                "description" => __("On mouse hover service box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),

            // Extra Class.

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of highlight box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            )


        )
    ));

    // SINGLE SERVICE VC BLOCK.

    vc_map(array(
        "name" => __("Single Service", 'sharai_khana_vc'),
        "description" => __('Add Single Service Block In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_single_service",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select layout style.", 'sharai_khana_vc')
            ),
            array(
                "admin_label" => true,
                "type" => "textarea",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" => "",
                "group" => "General",
            ),

            array(
                "type" => "attach_image",
                "heading" => __("Service Image", 'sharai_khana_vc'),
                "param_name" => "service_image",
                "description" => __("Add service box image. Recommended Size: 800 X 530 px.", 'sharai_khana_vc'),
                "group" => "General",
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Sevice Icon', 'sharai_khana_vc'),
                'param_name' => 'icon',
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "General",
                'description' => __('Select icon from library.', 'sharai_khana_vc'),
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Service Icon?", 'sharai_khana_vc'),
                "param_name" => "hide_service_icon",
                "value" => sharai_khana_boolean_term(),
                "group" => "General"
            ),

            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Service Page URL", 'sharai_khana_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link for service.", 'srcare_vc'),
                "group" => "General"
            ),

            // DESIGN TAB.

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of service box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "description" => __("Choose Custom to create your own service box.", 'sharai_khana_vc')
            ),


            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" => __("This color will apply in service navigation button.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
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

sharai_khana_service_vc_addon_function();


// For Services

if (class_exists('WPBakeryShortCodesContainer')) {
    class WPBakeryShortCode_Sharai_Khana_Service extends WPBakeryShortCodesContainer
    {
    }
}
if (class_exists('WPBakeryShortCode')) {
    class WPBakeryShortCode_Sharai_Khana_Service_Item extends WPBakeryShortCode
    {
    }
}