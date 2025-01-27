<?php

require_once( SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'counter/shortcodes/counter_shortcode.php' );

// VC Elements.

function sharai_khana_counter_vc_addon_function() {
    
    $layout = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("Layout 01", 'sharai_khana_vc') => 'layout_1',
                    __("Layout 02", 'sharai_khana_vc') => 'layout_2'
                    );
    
    $column = array(
                    __("SELECT", 'sharai_khana_vc') => '',
                    __("4 items each row (Default)", 'sharai_khana_vc') => '4',
                    __("3 items each row", 'sharai_khana_vc') => '3',
                    __("2 items each row", 'sharai_khana_vc') => '2'
                    );
    
    
    //Register "container" content element. It will hold all your inner (child) content elements
    vc_map(array(
        "name" => __("Counters", 'sharai_khana_vc'),
        "description" => __( "Place Counter In Page.", 'sharai_khana_vc'),
        "base" => "sharai_khana_counter",
        "category" => "Sharai Khana Addon",
        "as_parent" => array('only' => 'sharai_khana_counter_item'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
                "heading" => __("Counter Layout", 'sharai_khana_vc'),
                "param_name" => "layout",
                "value" => $layout,
                "group" => "General",
                "description" => __("Select counter layout style.", 'sharai_khana_vc')
            ),
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Choose Column", 'sharai_khana_vc'),
                "param_name" => "column",
                "value" => $column,
                "group" => "General",
                "description" => __("Number of items display each row.", 'sharai_khana_vc')
            ),
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Select Content Alignment", 'sharai_khana_vc'),
                "param_name" => "text_align",
                "value" => sharai_khana_content_alignment(),
                "group" => "General",
                "description" => __("Set content alignment of each counter block.", 'sharai_khana_vc')
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Disable Count Up?", 'sharai_khana_vc'),
                "param_name" => "disable_countup",
                "value" => sharai_khana_boolean_term(),
                "group" => "General",
                "description" => __("Select Yes to disable count up animation.", 'sharai_khana_vc')
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Count Time", 'sharai_khana_vc'),
                "param_name" => "time",
                "value" => sharai_khana_count_time(),
                "group" => "General",
                "description" => __("The total duration of the count up animation.", 'sharai_khana_vc')
            ),
            
            array("type" => "dropdown",
                "class" => "",
                "heading" => __("Count Delay", 'sharai_khana_vc'),
                "param_name" => "delay",
                "value" => sharai_khana_count_delay(),
                "group" => "General",
                "description" => __("The delay in milliseconds per number count up.", 'sharai_khana_vc')
            ),
            
            array(
                "type" => "checkbox",
                "class" => "",
                "heading" => __("Hide Icon?", 'sharai_khana_vc'),
                "param_name" => "hide_icon",
                "value" => array(__("Yes", 'sharai_khana_vc') => "1"),
                "description" => "",
                "group" => "General"
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
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class for counter layout.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Counter Color", 'sharai_khana_vc'),
                "param_name" => "counter_color",
                "value" => "#fe3c47",
                "description" => __("Set counter & post fix text color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Text Color", 'sharai_khana_vc'),
                "param_name" => "text_color",
                "value" => "#2C2C2C",
                "description" => __("Set text color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Icon Color", 'sharai_khana_vc'),
                "param_name" => "icon_color",
                "value" => "#2C2C2C",
                "description" => __("Set icon color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Border & Seperator Color", 'sharai_khana_vc'),
                "param_name" => "border_color",
                "value" => "#CCCCCC",
                "description" => __("Set border & seperator color.", 'sharai_khana_vc'),
                "group" => "Design",
                "dependency" => array('element' => "theme", 'value' => array('custom'))
            ),
            
            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Counter Box Background", 'sharai_khana_vc'),
                "param_name" => "counter_bg",
                "value" => "#FCFCFC",
                "description" => __("Set counter box background. (Only for Layout 01)", 'sharai_khana_vc'),
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
            
        ),
        "js_view" => 'VcColumnView'
    ));

    vc_map(array(
        "name" => __("Counter Item", 'sharai_khana_vc'),
        "description" => 'Add counter item',
        "base" => "sharai_khana_counter_item",
        "icon" => "icon-sharai-khana-vc-addon",
        "content_element" => true,
        "as_child" => array('only' => 'sharai_khana_counter'), // Use only|except attributes to limit parent (separate multiple values with comma)
        "params" => array(
            // add params same as with any other content element
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Counter Value", 'sharai_khana_vc'),
                "param_name" => "counter_value",
                "value" => "",
                "description" => __("Add any number. Please do not add string.", 'sharai_khana_vc'),
                "group" => "General",
            ),
            
            array(
                "admin_label" => true,
                "type" => "textfield",
                "class" => "",
                "heading" => __("Counter Text", 'sharai_khana_vc'),
                "param_name" => "counter_title",
                "value" => "",
                "description" => "Example:  Supports, Categories, Tags",
                "group" => "General",
            ),
            
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Counter Post Fix", 'sharai_khana_vc'),
                "param_name" => "counter_post_fix",
                "value" => "",
                "description" => __("Add any symbol after the counter value. Example: %, + ", 'sharai_khana_vc'),
                "group" => "General",
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
            )
            
        )
    ));
}

sharai_khana_counter_vc_addon_function();

/*------------------------------  Visual Composer Section---------------------------------*/

if (class_exists('WPBakeryShortCodesContainer')) {

    class WPBakeryShortCode_Sharai_Khana_Counter extends WPBakeryShortCodesContainer {
        
    }

}

if (class_exists('WPBakeryShortCode')) {

    class WPBakeryShortCode_Sharai_Khana_Counter_Item extends WPBakeryShortCode {
        
    }

}

