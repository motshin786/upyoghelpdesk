<?php

require_once(SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . 'blog_post/shortcodes/blog_post_shortcode.php');

// VC Elements.

function sharai_khana_blog_post_vc_addon_function()
{

    $category_args = array(
        'taxonomy' => 'category',
        'hide_empty' => 1,
        'orderby' => 'title',
        'order' => 'ASC',
        'suppress_filters' => FALSE
    );

    $categories = get_categories($category_args);

    $categories_list = array(
        'Select' => ''
    );

    foreach ($categories as $category) :

        $categories_list[$category->name] = $category->slug;

    endforeach;

    wp_reset_query();

    $post_columns = array(
        'Select' => '',
        '1 Column' => '1',
        '2 Columns' => '2',
        '3 Columns' => '3',
        '4 Columns' => '4'
    );

    $layouts = array(
        'Layout 01' => 'layout_1',
        'Layout 02' => 'layout_2'
    );

    // Into VC Block

    vc_map(array(
        "name" => __("Blog Posts", 'sharai_khana_vc'),
        "description" => __('Place Blog Posts In Page.', 'sharai_khana_vc'),
        "base" => "sharai_khana_blog_post",
        "category" => "Sharai Khana Addon",
        "content_element" => true,
        "icon" => "icon-sharai-khana-vc-addon",
        "params" => array(
            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Layout", "sharai_khana_vc"),
                "param_name" => "layout",
                "value" => $layouts,
                "group" => "General",
                "description" => ''
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
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Column", "sharai_khana_vc"),
                "param_name" => "column",
                "value" => $post_columns,
                "group" => "General",
                "description" => ''
            ),

            array(
                "admin_label" => true,
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Content Alignment", 'sharai_khana_vc'),
                "param_name" => "content_alignment",
                "value" => sharai_khana_content_alignment(),
                "group" => "General",
                "description" => __("Set content alignment of Blog Post block.", 'sharai_khana_vc')
            ),

            // Post Settings

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Blog Category", "sharai_khana_vc"),
                "param_name" => "category",
                "value" => $categories_list,
                "group" => "Post Settings",
                "description" => ''
            ),

            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Description Length", "sharai_khana_vc"),
                "param_name" => "desc_length",
                "value" => '',
                "group" => "Post Settings",
                "description" => ''
            ),
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => __("Post Limit", "sharai_khana_vc"),
                "param_name" => "limit",
                "value" => '',
                "group" => "Post Settings",
                "description" => ''
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Post Order", "sharai_khana_vc"),
                "param_name" => "orderby",
                "value" => sharai_khana_order_by(),
                "group" => "Post Settings",
                "description" => ''
            ),
            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Post Order By", "sharai_khana_vc"),
                "param_name" => "order",
                "value" => sharai_khana_order_type(),
                "group" => "Post Settings",
                "description" => ''
            ),

            // Navigation Settings.

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Navigation", 'sharai_khana_vc'),
                "param_name" => "carousel_nav",
                "value" => sharai_khana_boolean_term(),
                "group" => "Carousel Settings",
                "description" => __("You can show/hide two arrow will display beside the carousel items.", 'sharai_khana_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Hide Carousel Dots", 'sharai_khana_vc'),
                "param_name" => "carousel_dots",
                "value" => sharai_khana_boolean_term(),
                "group" => "Carousel Settings",
                "description" => __("You can show/hide bottom will display below the carousel items.", 'sharai_khana_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Auto Play Time Out", 'sharai_khana_vc'),
                "param_name" => "carousel_autoplaytimeout",
                "value" => sharai_khana_carousel_timeout(),
                "group" => "Carousel Settings",
                "description" => __("Select scroll speed.", 'sharai_khana_vc'),
                "dependency" => array('element' => "carousel", 'value' => array('1'))
            ),

            // DESIGN TAB.


            array(
                "type" => "bwl_cont_ext",
                "class" => "",
                "heading" => __("Container Extra Class", 'sharai_khana_vc'),
                "param_name" => "cont_ext_class",
                "value" => "",
                "description" => __("Add additional class of blog post box.", 'sharai_khana_vc') . SHARAI_KHANA_ADDITIONAL_CLASS_LINK,
                "group" => "Design",
            ),

            array(
                "type" => "dropdown",
                "class" => "",
                "heading" => __("Enable Box Shadow?", 'sharai_khana_vc'),
                "param_name" => "box_shadow_status",
                "value" => sharai_khana_boolean_term(),
                "group" => "Design",
                "description" => __("You can add box shadow animation in blog post box.", 'sharai_khana_vc')
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
                "description" => __("This color will apply in carousel navigation button.", 'sharai_khana_vc'),
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

sharai_khana_blog_post_vc_addon_function();