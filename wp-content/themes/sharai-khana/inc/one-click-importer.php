<?php

function sharai_khana_import_files()
{

    $preview_url = "https://wp.bwlthemes.com/";
    $demo_data_folder = trailingslashit(get_template_directory()) . 'demo-data/';
    $demo_data_img_folder = trailingslashit(get_template_directory_uri()) . 'demo-data/';

    return [

        // Sharai Khana 01
        [
            'import_file_name' => 'Sharai Khana - Slider Version',
            'categories' => ['Computer Repair'],
            'local_import_file' => $demo_data_folder . 'content.xml',
            'local_import_widget_file' => $demo_data_folder . 'widgets.wie',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'sharai_khana_preview.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/'
        ],

        // Sharai Khana 02
        [
            'import_file_name' => 'Sharai Khana - Banner Version',
            'categories' => ['Computer Repair'],
            'local_import_file' => $demo_data_folder . 'content.xml',
            'local_import_widget_file' => $demo_data_folder . 'widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'sharai_khana_banner_version.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/home-page-2/'
        ],

        // Fixer Buddies
        [
            'import_file_name' => 'Fixer Buddies - Slider Version',
            'categories' => ['Computer Repair'],
            'local_import_file' => $demo_data_folder . 'fixer_buddies/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'fixer_buddies/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'fixer_buddies/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'fixer_buddies/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'fixer_buddies/fixer_buddies_preview.jpg',
            'import_notice' => '',
            'preview_url' => 'http://wp.bwlthemes.com/wp_sharai_khana/fixer-buddies/'
        ],

        // Fitbone
        [
            'import_file_name' => 'Fit Bone - Slider Version',
            'categories' => ['Physiotherapy'],
            'local_import_file' => $demo_data_folder . 'fit_bone/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'fit_bone/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'fit_bone/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'fit_bone/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'fit_bone/fit_bone_preview.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/fit-bone/'
        ],

        // Bicycle Fix
        [
            'import_file_name' => 'Bicycle Fix - Banner Version',
            'categories' => ['Bicycle Repair'],
            'local_import_file' => $demo_data_folder . 'bicycle_fix/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'bicycle_fix/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'bicycle_fix/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'bicycle_fix/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'bicycle_fix/bicycle_fix_preview.jpg',
            'import_notice' => '',
            'preview_url' => 'http://wp.bwlthemes.com/wp_sharai_khana/bicycle-fix/'
        ],

        // Quala Coat
        [
            'import_file_name' => 'Quala Coat - Slider Version',
            'categories' => ['Law Firm'],
            'local_import_file' => $demo_data_folder . 'quala_coat/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'quala_coat/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'quala_coat/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'quala_coat/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'quala_coat/quala_coat_preview.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/quala-coat/'
        ],

        // Aqua Shatar
        [
            'import_file_name' => 'Aqua Shatar - Slider Version',
            'categories' => ['Swim Academy'],
            'local_import_file' => $demo_data_folder . 'aqua_shatar/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'aqua_shatar/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'aqua_shatar/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'aqua_shatar/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'aqua_shatar/aqua_shatar_preview.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/aqua-shatar/'
        ],

        // Aqua Shatar
        [
            'import_file_name' => 'Move Fast - Banner Version',
            'categories' => ['Moving Service'],
            'local_import_file' => $demo_data_folder . 'move_fast/content.xml',
            'local_import_widget_file' => $demo_data_folder . 'move_fast/widgets.wie',
            'local_import_customizer_file_url' => $demo_data_folder . 'move_fast/customizer.dat',
            'local_import_redux' => [
                [
                    'file_path' => $demo_data_folder . 'move_fast/theme_options.json',
                    'option_name' => 'sharai_khana_wp_options',
                ],
            ],
            'import_preview_image_url' => $demo_data_img_folder . 'move_fast/move_fast_preview.jpg',
            'import_notice' => '',
            'preview_url' => $preview_url . 'wp_sharai_khana/move-fast/'
        ]

    ];
}

add_filter('pt-ocdi/import_files', 'sharai_khana_import_files');

function sharai_khana_after_import_setup($selected_import)
{
    // Assign menus to their locations.
    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
    $footer_menu = get_term_by('name', 'Footer Menu', 'nav_menu');

    set_theme_mod(
        'nav_menu_locations',
        [
            'primary' => $main_menu->term_id,
            'footer-menu' => $footer_menu->term_id
        ]
    );

    // Get Front Page Info.

    if ($selected_import['import_file_name'] == "Move Fast - Banner Version") {

        // Move Fast - Banner Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Aqua Shatar - Slider Version") {

        // Aqua Shatar - Slider Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Quala Coat - Slider Version") {

        // Quala Coat - Slider Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Bicycle Fix - Banner Version") {

        // Bicycle Fix - Banner Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Fit Bone - Slider Version") {

        // Fit Bone - Slider Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Fixer Buddies - Slider Version") {

        // Fixer Buddies - Slider Version
        $front_page_id = get_page_by_title('Home Page 1');
    } else if ($selected_import['import_file_name'] == "Sharai Khana - Banner Version") {

        // Sharai Khana - Banner Version
        $front_page_id = get_page_by_title('Home Page 2');
    } else {
        // Default Sharai Khana Slider Version.
        $front_page_id = get_page_by_title('Home Page 1');
    }

    // Get Blog Page Info.

    $blog_page_id  = get_page_by_title('Blog Right Sidebar');

    // Assign Home & Blog Page.
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);

    // Update Permalinks
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');
}

add_action('pt-ocdi/after_import', 'sharai_khana_after_import_setup');

add_action('pt-ocdi/enable_wp_customize_save_hooks', '__return_true');

add_filter('pt-ocdi/regenerate_thumbnails_in_content_import', '__return_false');

add_filter('pt-ocdi/disable_pt_branding', '__return_true');

function sharai_khana_ocdi_confirmation_dialog_options($options)
{
    return array_merge($options, [
        'width'       => 800,
        'dialogClass' => 'wp-dialog',
        'resizable'   => false,
        'height'      => 660,
        'modal'       => true,
    ]);
}
add_filter('pt-ocdi/confirmation_dialog_options', 'sharai_khana_ocdi_confirmation_dialog_options', 10, 1);