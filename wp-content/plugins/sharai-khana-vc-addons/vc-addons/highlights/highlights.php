<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'highlights/shortcodes/highlights_shortcode.php' );

// VC Elements.

function sharai_khana_highlights_vc_addon_function() {

    $layout = array(
        __("Layout 01 ( Icon Box Top )", 'sharai_khana_vc') => 'layout_1',
        __("Layout 02 ( Transparent Icon Box Top )", 'sharai_khana_vc') => 'layout_2',
        __("Layout 03 ( Transparent Icon Box Right )", 'sharai_khana_vc') => 'layout_3',
        __("Layout 04 ( Transparent Icon Box Left )", 'sharai_khana_vc') => 'layout_4'
    );

    $columns = array(
        __("4 Columns (Default)", 'sharai_khana_vc') => 4,
        __("3 Columns", 'sharai_khana_vc') => 3,
        __("2 Columns", 'sharai_khana_vc') => 2,
        __("1 Column", 'sharai_khana_vc') => 1
    );


    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Highlight Box", 'sharai_khana_vc'),
        "description" => __("Add Multiple Highlight Blocks.", 'sharai_khana_vc'),
        "base" => "sharai_khana_highlights",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_highlights_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Highlight Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select highlight layout style.", 'sharai_khana_vc')
            ),
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "columns",
                "value" => $columns,
                "group" => "General",
                "description" => __("Select number columns each row.", 'sharai_khana_vc')
            ),
            
            array(
                "admin_label" => true,
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Enable Carousel?", 'sharai_khana_vc'),
                "param_name" => "carousel",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
            ),
            
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Navigation", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => sharai_khana_boolean_term(),
                "group" => "General",
                "description" => __("You can show/hide two arrow will display beside the carousel items.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Dots", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => sharai_khana_boolean_term(),
                "group" => "General",
                "description" => __("You can show/hide bottom will display below the carousel items.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),
            
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "General",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),
            
            
            // DESIGN TAB.
            
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
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of highlight box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "heading" => __("Navigation Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply in seperator line, carousel navigation arrows and dots.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background", 'sharai_khana_vc'),
                "param_name" => "theme_bg",
                "value" => "#FFFFFF",
                "description" =>__("Regular highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Hover Background", 'sharai_khana_vc'),
                "param_name" => "theme_hover_bg",
                "value" => "#FBFBFB",
                "description" =>__("On mouse hover highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => "#40C1F0",
                "description" =>__("This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Hover Color", 'sharai_khana_vc'),
                "param_name" => "theme_hover_color",
                "value" => "#FAFAFA",
                "description" =>__("On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show Border?", 'sharai_khana_vc'),
                "param_name" => "border_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Design",
                "description" => __("Hide border from highlight box.", 'sharai_khana_vc'),
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border Color", 'sharai_khana_vc'),
                "param_name" => "theme_border",
                "value" => "#EBEBEB",
                "description" =>__("Set border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "border_status", 'value' => array('1'))
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
            
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Highlight Item", 'sharai_khana_vc'),
        "description" => 'Add highlights item',
        "base" => "sharai_khana_highlights_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_highlights'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" => __("Set the heading of highlights box. Example - Support Forum.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => __("Content", 'sharai_khana_vc'),
                "param_name" => "highlights_content",
                "value" => "",
                "description" => __("Write a brief about highlight content.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Type", 'sharai_khana_vc'),
                "param_name" => "icon_type",
                "value" => array(
                                        __('Font Awesome Icon ( Default )', 'sharai_khana_vc') => 'fa_icon', 
                                        __('Custom Image', 'sharai_khana_vc') => 'img_icon'
                                     ),
                "group" => "General",
                "description" => __("Display read more button in highlight box.", 'sharai_khana_vc')
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
                "type" => "attach_image",
                "heading" => __("Highlight Image", 'sharai_khana_vc'),
                "param_name" => "highlights_img",
                "description" => __("Add Highlight image", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "icon_type", 'value' => array('img_icon'))
            ),
            
            array(                
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Badge?", 'sharai_khana_vc'),
                "param_name" => "badge_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "General",
                "description" => __("Display Badge Box in highlight box.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Badge Text", 'sharai_khana_vc'),
                "param_name" => "badge_text",
                "value" => "",
                "description" => __("Example - New, Hot, Speical etc.", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "badge_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Badge Theme?", 'sharai_khana_vc'),
                "param_name" => "badge_theme",
                "value" => array(
                                    'Gray' => 'label-secondary', 
                                    'Blue' => 'label-primary', 
                                    'Green' => 'label-success', 
                                    'Red' => 'label-danger',
                                    'Yellow' => 'label-warning',
                                    'Light Blue' => 'label-info',
                                    'White' => 'label-light',
                                    'Black' => 'label-dark'
                                 ),
                "group" => "General",
                "description" => __("Select badge theme.", 'sharai_khana_vc'),
                "dependency" => array('element' => "badge_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Read More Button", 'sharai_khana_vc'),
                "param_name" => "rm_link_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Button",
                "description" => __("Display read more button in highlight box.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Button Text", 'sharai_khana_vc'),
                "param_name" => "url_text",
                "value" => __("Read More", 'sharai_khana_vc'),
                "description" => __("Set custom text for button. Default - Read more", 'sharai_khana_vc'),
                "group" => "Button",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Read More Link", 'sharai_khana_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link of heading/read more button.", 'sharai_khana_vc'),
                "group" => "Button"
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Additional Button Class", 'sharai_khana_vc'),
                "param_name" => "ext_btn_class",
                "value" => '',
                "description" => __("Set custom class for button.", 'sharai_khana_vc'),
                "group" => "Button",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of highlight box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
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
                "description" => __("Choose Custom to create your own highlight box.", 'sharai_khana_vc')
            ),
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background", 'sharai_khana_vc'),
                "param_name" => "theme_bg",
                "value" => "#FFFFFF",
                "description" =>__("Regular highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Hover Background", 'sharai_khana_vc'),
                "param_name" => "theme_hover_bg",
                "value" => "#FBFBFB",
                "description" =>__("On mouse hover highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => "#40C1F0",
                "description" =>__("This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Hover Color", 'sharai_khana_vc'),
                "param_name" => "theme_hover_color",
                "value" => "#FAFAFA",
                "description" =>__("On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show Border?", 'sharai_khana_vc'),
                "param_name" => "border_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Design",
                "description" => __("Hide border from highlight box.", 'sharai_khana_vc'),
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border Color", 'sharai_khana_vc'),
                "param_name" => "theme_border",
                "value" => "#EBEBEB",
                "description" =>__("Set border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "border_status", 'value' => array('1'))
            )
        )
    ));


    // SINGLE HIGHLIGHT VC BLOCK.

    vc_map(array(
        "name" => __("Single Highlight Box", 'sharai_khana_vc'),
        "description" => __('Add Single Highlight Block.', 'sharai_khana_vc'),
        "base" => "sharai_khana_single_highlight",
        "icon" => "icon-sharai-khana-vc-addon",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "params" => array(
            // add params same as with any other content element

            array(
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
                "type" => "textfield",
                "class" => "",
                "heading" => __("Title", 'sharai_khana_vc'),
                "param_name" => "title",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),
            array(
                "type" => "textarea",
                "class" => "",
                "heading" => __("Content", 'sharai_khana_vc'),
                "param_name" => "highlights_content",
                "value" => "",
                "description" =>"",
                "group" => "General",
            ),
            
            array(                
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Icon Type", 'sharai_khana_vc'),
                "param_name" => "icon_type",
                "value" => array(
                                        __('Font Awesome Icon ( Default )', 'sharai_khana_vc') => 'fa_icon', 
                                        __('Custom Image', 'sharai_khana_vc') => 'img_icon'
                                     ),
                "group" => "General",
                "description" => __("Display read more button in highlight box.", 'sharai_khana_vc')
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
                "type" => "attach_image",
                "heading" => __("Highlight Image", 'sharai_khana_vc'),
                "param_name" => "highlights_img",
                "description" => __("Add Highlight image", 'sharai_khana_vc'),
                "group" => "General",
                "dependency" => array('element' => "icon_type", 'value' => array('img_icon'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Read More Button", 'sharai_khana_vc'),
                "param_name" => "rm_link_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Button",
                "description" => __("Display read more button in highlight box.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Button Text", 'sharai_khana_vc'),
                "param_name" => "url_text",
                "value" => __("Read More", 'sharai_khana_vc'),
                "description" => __("Set custom text for button. Default - Read more", 'sharai_khana_vc'),
                "group" => "Button",
                "dependency" => array('element' => "rm_link_status", 'value' => array('1'))
            ),
            
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Read More Link", 'sharai_khana_vc'),
                "param_name" => "read_more_link",
                "value" => "",
                "description" => __("You can set custom link of heading/read more button.", 'sharai_khana_vc'),
                "group" => "Button"
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of highlight box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
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
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Select Theme", 'sharai_khana_vc'),
                "param_name" => "theme",
                "value" => array(
                                        __('Default', 'sharai_khana_vc') => 'default', 
                                        __('Custom', 'sharai_khana_vc') => 'custom'
                                     ),
                "group" => "Design",
                "description" => __("Choose Custom to create your own highlight box.", 'sharai_khana_vc')
            ),
            
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Background", 'sharai_khana_vc'),
                "param_name" => "theme_bg",
                "value" => "#FFFFFF",
                "description" =>__("Regular highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Box Hover Background", 'sharai_khana_vc'),
                "param_name" => "theme_hover_bg",
                "value" => "#FBFBFB",
                "description" =>__("On mouse hover highlight box background.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => "#40C1F0",
                "description" =>__("This color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Hover Color", 'sharai_khana_vc'),
                "param_name" => "theme_hover_color",
                "value" => "#FAFAFA",
                "description" =>__("On mouse hover this color will apply in Icon background ( For Layout 1 ), Icon color (layout 02, layout 03), seperator and button background (mouse hover mode).", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Show Border?", 'sharai_khana_vc'),
                "param_name" => "border_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Design",
                "description" => __("Hide border from highlight box.", 'sharai_khana_vc'),
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border Color", 'sharai_khana_vc'),
                "param_name" => "theme_border",
                "value" => "#EBEBEB",
                "description" =>__("Set border color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "border_status", 'value' => array('1'))
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

sharai_khana_highlights_vc_addon_function();
 
 //Hightlights

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Highlights extends WPBakeryShortCodesContainer {
    }
}
if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Highlights_item extends WPBakeryShortCode {
    }
}