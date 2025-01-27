<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'team/shortcodes/team_shortcode.php' );

// VC Elements.

function sharai_khana_team_vc_addon_function() {
    
    $layout = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("Layout 01 (Social Icon Bottom)", 'sharai_khana_vc') => 'layout_1',
                    __("Layout 02 (Social Icon Left)", 'sharai_khana_vc') => 'layout_2'
                    );    
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Team Block", 'sharai_khana_vc'),
        "description" => __('Add Team Members In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_team",
        "class" => "",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_team_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Team Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "description" => __("Select team layout style.", 'sharai_khana_vc'),
                "group" => "General"
            ),
             array("type" => "dropdown",
                "class" => "",
                "heading" => __("Items Per Row", 'sharai_khana_vc'),
                "param_name" => "carousel_items",
                "value" => sharai_khana_items_per_row(4,1,3, array( __("SELECT", 'sharai_khana_vc') => "" )), // Hints: Start from 4 and end to 1. We are going to set default then number "3" and prepend "select" text to that array.
                "group" => "General",
                "description" => __("Select no of item you like to show each row.", 'sharai_khana_vc'),
                "group" => "General"
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
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Social Icon Style", 'sharai_khana_vc'),
                "param_name" => "social_icon_style",
                "value" => array(
                                        __('Rounded', 'sharai_khana_vc') => '', 
                                        __('Square', 'sharai_khana_vc') => 'square'
                                     ),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" =>__("This color will apply on soical icon background and navigation button.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Social Icon Color", 'sharai_khana_vc'),
                "param_name" => "social_icon_color",
                "value" => SHARAI_KHANA_LIGHT_TEXT_COLOR,
                "description" =>__("This color will apply on soical icon color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
             array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Team Name Color", 'sharai_khana_vc'),
                "param_name" => "theme_team_name_color",
                "value" => '#1a1a1a',
                "description" =>__("This color will apply on team member name text.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
             array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Team Designation Color", 'sharai_khana_vc'),
                "param_name" => "theme_team_desg_color",
                "value" => "#808080",
                "description" =>__("This color will apply on team member designation text.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of team box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
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
        "name" => __("Team Item", 'sharai_khana_vc'),
        "description" => 'Add team item',
        "base" => "sharai_khana_team_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_team'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            array(
                "type" => "textfield",
                "heading" => __("Member Name", 'sharai_khana_vc'),
                "param_name" => "team_name",
                "description" => '',
                "group" => "General",
                "admin_label" => true
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Member Info", 'sharai_khana_vc'),
                "param_name" => "team_info",
                "description" => '',
                "group" => "General"
            ),
            
            array(
                "type" => "attach_image",
                "heading" => __("Team Image", 'sharai_khana_vc'),
                "param_name" => "team_image",
                "description" => '',
                "group" => "General"
            ),
            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Custom Profile Link", 'sharai_khana_vc'),
                "param_name" => "team_custom_link",
                "value" => "",
                "description" => __("Add custom team profile link.", 'sharai_khana_vc'),
                "group" => "General"
            ),
            
            // DESIGN TAB.
            
            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of team box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Select Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "group" => "Design",
                "description" => __("Set content alignment of team info block.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Disable Social Link?", 'sharai_khana_vc'),
                "param_name" => "social_link_status",
                "value" =>  array(
                                     __('No', 'sharai_khana_vc') => '0',
                                     __('Yes', 'sharai_khana_vc') => '1'
                                 ),
                "group" => "Social Links",
                "description" => __("Hide social link button from team block.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "textfield",
                "heading" => __("Facebook", 'sharai_khana_vc'),
                "param_name" => "team_facebook",
                "description" => '',
                "group" => "Social Links"
            ),
            array(
                "type" => "textfield",
                "heading" => __("Twitter", 'sharai_khana_vc'),
                "param_name" => "team_twitter",
                "description" => '',
                "group" => "Social Links"
            ),
            array(
                "type" => "textfield",
                "heading" => __("Google Plus", 'sharai_khana_vc'),
                "param_name" => "team_google_plus",
                "description" => '',
                "group" => "Social Links"
            ),
            array(
                "type" => "textfield",
                "heading" => __("Linkedin", 'sharai_khana_vc'),
                "param_name" => "team_linkedin",
                "description" => '',
                "group" => "Social Links"
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

sharai_khana_team_vc_addon_function();

function sharai_khana_author_social_links($profile_fields) {

        // Add new fields
        $profile_fields['twitter'] = 'Twitter Username';
        $profile_fields['facebook'] = 'Facebook URL';
        $profile_fields['gplus'] = 'Google+ URL';
        return $profile_fields;
        
}

add_filter('user_contactmethods', 'sharai_khana_author_social_links');

// For Team.

if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Team extends WPBakeryShortCodesContainer {
    }
}

if ( class_exists( 'WPBakeryShortCode' ) ) {
    class WPBakeryShortCode_Sharai_Khana_Team_Item extends WPBakeryShortCode {
    }
}