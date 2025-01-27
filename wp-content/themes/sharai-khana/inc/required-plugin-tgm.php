<?php

require_once get_template_directory() . '/inc/class-tgm-plugin-activation.php';

add_action('tgmpa_register', 'sharai_khana_register_required_plugins');

function sharai_khana_register_required_plugins()
{

    $plugins = [
        [
            'name' => esc_html__('One Click Demo Import', 'sharai-khana'),
            'slug' => 'one-click-demo-import',
            'required' => true,
        ],

        [
            'name' => esc_html__('Mailchimp For Wp', 'sharai-khana'),
            'slug' => 'mailchimp-for-wp',
            'required' => true,
        ],

        [
            'name' => esc_html__('Contact Form 7', 'sharai-khana'),
            'slug' => 'contact-form-7',
            'required' => true,
        ],

        [
            'name' => esc_html__('Woocommerce', 'sharai-khana'),
            'slug' => 'woocommerce',
            'required' => false,
        ],

        [
            'name' => esc_html__('Widget Importer & Exporter', 'sharai-khana'),
            'slug' => 'widget-importer-exporter',
            'required' => true,
        ],

        [
            'name' => esc_html__('WordPress Importer', 'sharai-khana'),
            'slug' => 'wordpress-importer',
            'required' => true,
        ],

        [
            'name' => esc_html__('Redux Framework', 'sharai-khana'),
            'slug' => 'redux-framework',
            'required' => true,
        ],

        [
            'name' => esc_html__('WPBakery Page Builder', 'sharai-khana'),
            'slug' => 'js_composer',
            'source' => get_template_directory() . '/plugins/js_composer.zip',
            'required' => true,
            'version' => '6.10.0'
        ],

        [
            'name' => esc_html__('Sharai Khana Theme WPBakery Page Builder Addons', 'sharai-khana'),
            'slug' => 'sharai-khana-vc-addons',
            'source' => get_template_directory() . '/plugins/sharai-khana-vc-addons.zip',
            'required' => true,
            'version' => '1.2.4'
        ]
    ];

    $config = [
        'id' => 'sharai-khana', // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '', // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'has_notices' => true, // Show admin notices or not.
        'dismissable' => true, // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '', // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false, // Automatically activate plugins after installation or not.
        'message' => '', // Message to output right before the plugins table.
    ];

    tgmpa($plugins, $config);
}