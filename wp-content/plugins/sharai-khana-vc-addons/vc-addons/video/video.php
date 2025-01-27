<?php

require_once(SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'video/shortcodes/video_shortcode.php');

// VC Elements.

function sharai_khana_video_vc_addon_function()
{

    $layout = array(
        __("Layout 01 (Video Link With Image) ", 'sharai_khana_vc') => 'layout_1',
        __("Layout 02 (Video Link Without Iimage) ", 'sharai_khana_vc') => 'layout_2'
    );

    vc_map(array(
        "name" => __("Video Box", 'sharai_khana_vc'),
        "description" => __('Display Video Box In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_vc_video",
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
                "type" => "attach_image",
                "heading" => __("Video Background Image", 'sharai_khana_vc'),
                "param_name" => "video_bg",
                "description" => '',
                'param_holder_class' => 'vc_colored-dropdown',
                "group" => "General",
                "dependency" => array('element' => "layout", 'value' => array('layout_1'))
            ),

            array(
                'type' => 'iconpicker',
                'heading' => __('Video Icon', 'sharai_khana_vc'),
                'param_name' => 'icon',
                "value" => "fa-play",
                'settings' => array(
                    'emptyIcon' => false, // default true, display an "EMPTY" icon?
                    'type' => 'fontawesome',
                    'iconsPerPage' => 50, // default 100, how many icons per/page to display
                ),
                "group" => "General",
                'description' => __('Select icon from library.', 'sharai_khana_vc')
            ),

            array(
                "type" => "vc_link",
                "class" => "",
                "heading" => __("Video Link", 'sharai_khana_vc'),
                "param_name" => "video_link",
                "value" => "",
                "description" => __("Video CTA Link Example: https://www.youtube.com/watch?v=nrJtHemSPW4", 'sharai_khana_vc'),
                "group" => "General"
            ),

            // Design Tab.

            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of video box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Design", 'sharai_khana_vc'),
                "param_name" => "icon_type",
                "value" => array(
                    __('Rouned Icon', 'sharai_khana_vc')  => 'vbox_icon_rounded',
                    __('Square Icon', 'sharai_khana_vc')  => 'vbox_icon_square'
                ),
                "description" => __("Set video button design.", 'sharai_khana_vc'),
                "group" => "Design"
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Button Alignment", 'sharai_khana_vc'),
                "param_name" => "icon_alignment",
                "value" => array(
                    __('Center', 'sharai_khana_vc')  => 'vbox_center_center',
                    __('Bottom Left', 'sharai_khana_vc')  => 'vbox_bottom_left',
                    __('Bottom Right', 'sharai_khana_vc')  => 'vbox_bottom_right'
                ),
                "description" => __("Set video button position.", 'sharai_khana_vc'),
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
                "description" => __("Choose Custom to create your own theme.", 'sharai_khana_vc')
            ),

            array(
                "type" => "colorpicker",
                "class" => "",
                "heading" => __("Theme Color", 'sharai_khana_vc'),
                "param_name" => "theme_color",
                "value" => SHARAI_KHANA_PRIMARY_COLOR,
                "description" => __("This color will apply in Icon border button.", 'sharai_khana_vc'),
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

sharai_khana_video_vc_addon_function();