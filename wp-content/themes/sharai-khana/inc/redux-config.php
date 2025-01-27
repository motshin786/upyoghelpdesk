<?php

if (!class_exists('Redux')) {
    return;
}

if (!class_exists('reduxNewsflash')) :

    class reduxNewsflash
    {

        public function __construct($parent, $params)
        {
        }
    }

endif;
//----------------------------------------------------------------------
// Remove Redux Framework Ads
//----------------------------------------------------------------------
add_filter('redux/sharai_khana_wp_options/aURL_filter', '__return_empty_string');

// This is your option name where all the Redux data is stored.
$opt_name = "sharai_khana_wp_options";

// This line is only for altering the demo. Can be easily removed.
$opt_name = apply_filters('redux_demo/opt_name', $opt_name);

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    'disable_tracking' => true,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => esc_html__('Sharai Khana Theme Options', 'sharai-khana'),
    'page_title' => esc_html__('Sharai Khana Theme Options', 'sharai-khana'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => true,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => true,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'forced_dev_mode_off' => true,
    // To forcefully disable the dev mode
    'update_notice' => true,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => true,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field
    // OPTIONAL -> Give you extra features
    'page_priority' => 100,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '',
    // Page slug used to denote the panel, will be based off page title then menu title then opt_name if not provided
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.
    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => true,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.
    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
    'use_cdn' => true,
    'show_options_object' => false,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'red',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);

Redux::setArgs($opt_name, $args);

//General  
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-indent-left',
    'title' => esc_html__('General', 'sharai-khana'),
    'submenu' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Favicon', 'sharai-khana'),
            'subtitle' => esc_html__('Use this field to upload your custom favicon.', 'sharai-khana'),
            'id' => 'custom_favicon',
            'default' => esc_url(get_template_directory_uri() . '/images/favicon.png'),
            'type' => 'media',
            'url' => true,
        ),
        array(
            'title' => esc_html__('Disable Preloader?', 'sharai-khana'),
            'subtitle' => esc_html__('By disabling this you will switch the pre load icon off.', 'sharai-khana'),
            'id' => 'sharai_khana_preloader_disable_status',
            'default' => '0',
            '1' => esc_html__('Yes', 'sharai-khana'),
            '0' => esc_html__('No', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'title' => esc_html__('Pre Loading Icon', 'sharai-khana'),
            'subtitle' => esc_html__('Use this field to upload your custom pre loading icon.', 'sharai-khana'),
            'id' => 'sharai_khana_preloader_img',
            'default' => esc_url(get_template_directory_uri() . '/images/loader.gif'),
            'type' => 'media',
            'url' => true,
            'required' => array('sharai_khana_preloader_disable_status', '=', '0'),
        ),

        array(
            'id' => 'sharai_khana_preloader_background',
            'type' => 'color_rgba',
            'title' => esc_html__('Preloader Background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a color for the preloader background.', 'sharai-khana'),
            'default' => array(
                'color' => '#FFFFFF',
                'alpha' => 1
            ),
            'required' => array('sharai_khana_preloader_disable_status', '=', '0'),
        ),

        array(
            'id' => 'sharai_khana_back_to_top_disable_status',
            'title' => esc_html__('Disable Back To Top Button?', 'sharai-khana'),
            'subtitle' => esc_html__('Select Yes to disable back to top button.', 'sharai-khana'),
            'default' => '0',
            '1' => esc_html__('Yes', 'sharai-khana'),
            '0' => esc_html__('No', 'sharai-khana'),
            'type' => 'switch'
        ),

        array(
            'id' => 'sharai_khana_back_to_top_background',
            'type' => 'color_rgba',
            'title' => esc_html__('Back To Top Button Background ', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a color for the Back To Top background.', 'sharai-khana'),
            'default' => array(
                'color' => '#80B435',
                'alpha' => 1
            ),
            'required' => array('sharai_khana_back_to_top_disable_status', '=', '0'),
        )

    )
));

// Logo
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-picture',
    'title' => esc_html__('Logo', 'sharai-khana'),
    'fields' => array(
        array(
            'id' => 'logo_type',
            'type' => 'button_set',
            'title' => esc_html__('Logo Type', 'sharai-khana'),
            'subtitle' => esc_html__('Select your logo type (image/text)', 'sharai-khana'),
            'options' => array(
                'image' => 'Image',
                'text' => 'Text',
            ),
            'default' => 'image',
        ),
        array(
            'id' => 'logo_image',
            'type' => 'media',
            'title' => esc_html__('Logo Image', 'sharai-khana'),
            'subtitle' => esc_html__('Use this field to upload your custom logo for use in the theme header. (Recommended 200px x 40px)', 'sharai-khana'),
            'required' => array('logo_type', '=', 'image'),
            'url' => true,
            'default' => array(
                'height' => '47',
                'width' => '265',
                'url' => esc_url(get_template_directory_uri() . '/images/logo.png'),
            ),
        ),
        array(
            'id' => 'logo_text',
            'type' => 'text',
            'title' => esc_html__('Logo Text', 'sharai-khana'),
            'subtitle' => esc_html__('Use this field to write the text which will appeared as a logo', 'sharai-khana'),
            'required' => array('logo_type', '=', 'text'),
            'default' => esc_html__('Sharai Khana', 'sharai-khana')
        ),
        array(
            'id' => 'logo-typography',
            'type' => 'typography',
            'title' => esc_html__('Logo Font Property', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the logo font properties.', 'sharai-khana'),
            'required' => array('logo_type', '=', 'text'),
            'google' => true,
            'font-backup' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'output' => array('.site-logo-text'),
            'units' => 'px',
            'default' => array(
                'font-family' => 'Lato',
                'color' => '#FFFFFF',
                'font-weight' => '700',
                'google' => true,
                'font-size' => '32px',
                'line-height' => '24px',
            ),
        ),
        array(
            'id' => 'site-logo-spacing',
            'type' => 'spacing',
            'output' => array('.site-logo'),
            'mode' => 'margin',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Margin Option For Logo', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (margin) for the Logo.', 'sharai-khana'),
            'default' => array(
                'margin-top' => '12px',
                'margin-right' => '0px',
                'margin-bottom' => '5px',
                'margin-left' => '0px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'site-logo-padding',
            'type' => 'spacing',
            'output' => array('.site-logo'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding Option For Logo', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the padding for the Logo.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '3px',
                'padding-right' => '0px',
                'padding-bottom' => '3px',
                'padding-left' => '0px',
                'units'          => 'px'
            ),
        ),
    )
));



//Header Content
Redux::setSection($opt_name, array(
    'icon' => 'el el-credit-card',
    'title' => esc_html__('Header Content', 'sharai-khana'),
));

//Toolbar             
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Toolbar', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Display Toolbar', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it Off to disable the toolbar.', 'sharai-khana'),
            'id' => 'enable_disable_toolbar',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),
        array(
            'title' => esc_html__('Toolbar left content', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for toolbar left region.', 'sharai-khana'),
            'id' => 'toolbar_left',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '<ul class="top-bar-info clearfix">
    <li><span class="top-bar-dot"></span><strong>Visit Office:</strong> East Shibgonj, Sylhet, 3100</li>
    <li><span class="top-bar-dot"></span><strong>Call Us:</strong> +880-1911623458</li>
</ul>'
            ),
            'type' => 'textarea',
            'required' => array('enable_disable_toolbar', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),
        array(
            'title' => esc_html__('Toolbar right social', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for toolbar left region.', 'sharai-khana'),
            'id' => 'toolbar_right',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '<div class="top-bar-social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-pinterest"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
    <a href="#"><i class="fa fa-youtube"></i></a>
</div>'
            ),
            'type' => 'textarea',
            'required' => array('enable_disable_toolbar', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),
        array(
            'title' => esc_html__('Toolbar right button', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for toolbar left region.', 'sharai-khana'),
            'id' => 'toolbar_right_button',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '<a href="#" class="free-estimate">GET FREE QUOTE</a>'
            ),
            'type' => 'textarea',
            'required' => array('enable_disable_toolbar', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),

        array(
            'id' => 'toolbar-background',
            'type' => 'background',
            'output' => array('#toolbar'),
            'title' => esc_html__('Toolbar background', 'sharai-khana'),
            'subtitle' => esc_html__('Toolbar background with image, color, etc.', 'sharai-khana'),
            'required' => array('enable_disable_toolbar', '=', '1'),
            'default' => array(
                'background-color' => '#5c5c5c',
            ),
        ),
        array(
            'id' => 'toolbar-spacing',
            'type' => 'spacing',
            'output' => array('#toolbar'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding option for toolbar', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the toolbar.', 'sharai-khana'),
            'required' => array('enable_disable_toolbar', '=', '1'),
            'default' => array(
                'padding-top' => '0px',
                'padding-right' => '30px',
                'padding-bottom' => '0px',
                'padding-left' => '30px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'toolbar-typography',
            'type' => 'typography',
            'title' => esc_html__('Toolbar font size and line height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('#toolbar'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the toolbar font properties.', 'sharai-khana'),
            'required' => array('enable_disable_toolbar', '=', '1'),
            'default' => array(
                'font-size' => '16px',
                'line-height' => '28px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'toolbar-font-color',
            'type' => 'color',
            'output' => array('#toolbar'),
            'title' => esc_html__('Toolbar font color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the toolbar (default: #FFFFFF).', 'sharai-khana'),
            'required' => array('enable_disable_toolbar', '=', '1'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'toolbar_link-color',
            'type' => 'link_color',
            'title' => esc_html__('Toolbar link (text link) color option', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the toolbar link (text link) color properties.', 'sharai-khana'),
            'required' => array('enable_disable_toolbar', '=', '1'),
            'output' => array('#toolbar a'),
            'default' => array(
                'regular' => '#FFFFFF',
                'hover' => '#1A1A1A',
                'active' => '#1A1A1A',
            ),
        ),
    )
));

// Navbar
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Navbar', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'nav-bar-spacing',
            'type' => 'spacing',
            'output' => array('.menu-sharai_khana'),
            'mode' => 'margin',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Margin for navbar', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (margin) for the navbar.', 'sharai-khana'),
            'default' => array(
                'margin-top' => '0px',
                'margin-right' => '0px',
                'margin-bottom' => '0px',
                'margin-left' => '0px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'navigation-top-level-item-typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation top level item font', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the navigation top level item font properties.', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'color' => false,
            'output' => array('.main-navigation .menu a'),
            'units' => 'px',
            'default' => array(
                'font-family' => 'Lato',
                'font-weight' => '600',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '24px',
                'text-transform' => 'uppercase',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'navigation-top-level-item-spacing',
            'type' => 'spacing',
            'output' => array('.main-navigation ul a'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding for navigation top level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the navigation top level item.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '37px',
                'padding-right' => '15px',
                'padding-bottom' => '37px',
                'padding-left' => '15px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'navigation-top-level-item-color',
            'type' => 'color',
            'output' => array('.main-navigation .menu a'),
            'title' => esc_html__('Navigation top level item color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the navigation top level item(default: #555555).', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_TEXT_COLOR,
            'validate' => 'color',
        ),
        array(
            'id' => 'navigation-top-level-item-hover-active-color',
            'type' => 'color',
            'output' => array(
                '.main-navigation li:hover > a, 
.main-navigation li > a:focus, 
 .main-navigation .current_page_item > a,
.main-navigation .current-menu-item > a,
.main-navigation .current_page_item > a:hover,
.main-navigation .current-menu-item > a:hover,
.main-navigation .current_page_item > a:focus,
.main-navigation .current-menu-item > a:focus,
 .main-navigation .current_page_ancestor > a,
                                  .main-navigation .current-menu-ancestor > a'
            ),
            'title' => esc_html__('Navigation top level item hover/active color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a top level item hover/active color for the navigation (default: #80B435).', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        ),
        array(
            'id' => 'navigation-dropdown-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array('.main-navigation ul ul'),
            'title' => esc_html__('Navigation dropdown background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a background color for the navigation dropdown (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'navigation-dropdown-level-item-width',
            'type' => 'dimensions',
            'units' => array('px'), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true', // Allow users to select any type of unit
            'title' => esc_html__('Width for dropdown level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow your users to choose width for dropdown level item.', 'sharai-khana'),
            'output' => array('.main-navigation ul ul a'),
            'height' => false,
            'default' => array(
                'width' => 200,
                'units'          => 'px'
            )
        ),
        array(
            'id' => 'navigation-dropdown-level-item-typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation dropdown level item font property', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the navigation dropdown level item font properties.', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'color' => false,
            'output' => array('.main-navigation .menu ul a'),
            'units' => 'px',
            'default' => array(
                'font-family' => 'Lato',
                'font-weight' => '400',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '32px',
                'text-transform' => 'uppercase',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'navigation-dropdown-level-item-spacing',
            'type' => 'spacing',
            'output' => array('.main-navigation ul ul a'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding for navigation dropdown level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the navigation dropdown level item.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '7px',
                'padding-right' => '15px',
                'padding-bottom' => '7px',
                'padding-left' => '15px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'navigation-dropdown-level-item-color',
            'type' => 'color',
            'output' => array('.main-navigation ul ul a'),
            'title' => esc_html__('Navigation dropdown level item color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the navigation dropdown level item(default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'navigation-dropdown-level-item-hover-color',
            'type' => 'color',
            'output' => array(
                '.main-navigation ul ul a:hover,
                      .main-navigation ul ul a:focus,
					  .main-navigation ul ul .current_page_item > a:hover,
                      .main-navigation ul ul .current-menu-item > a:hover,
                      .main-navigation ul ul .current_page_item > a:focus,
                      .main-navigation ul ul .current-menu-item > a:focus'
            ),
            'title' => esc_html__('Navigation dropdown level item hover color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a hover color for the navigation dropdown level item (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'navigation-dropdown-level-item-hover-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array(
                '.main-navigation ul ul a:hover,
                      .main-navigation ul ul a:focus'
            ),
            'title' => esc_html__('Navigation dropdown level item hover background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a hover background color for the navigation dropdown level item (default: #000000).', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        ),
    )
));

//Footer Content
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-photo',
    'title' => esc_html__('Footer Content', 'sharai-khana'),
    'fields' => array(
        array(
            'title' => esc_html__('Display social icon in footer?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it Off to hide social icon in the footer.', 'sharai-khana'),
            'id' => 'enable_disable_custom_social',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'title' => esc_html__('Footer social', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own social icon and links in the footer.', 'sharai-khana'),
            'id' => 'custom_social',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '<div class="social-icons">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-pinterest"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
    <a href="#"><i class="fa fa-youtube"></i></a>
</div>'
            ),
            'type' => 'textarea',
            'required' => array('enable_disable_custom_social', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),
        array(
            'title' => esc_html__('Display copyright text?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it Off to disable copyright and powered by text.', 'sharai-khana'),
            'id' => 'enable_disable_footer_copyright',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'title' => esc_html__('Custom copyright', 'sharai-khana'),
            'subtitle' => esc_html__('Add custom text/html for copyright region.', 'sharai-khana'),
            'id' => 'custom_copyright',
            'default' => 'Copyright &copy; ' . date('Y') . ' - Sharai Khana. All Rights Reserved.',
            'type' => 'textarea',
            'required' => array('enable_disable_footer_copyright', '=', '1'),
        ),
        array(
            'title' => esc_attr__('Disable Credit Note', 'sharai-khana'),
            'subtitle' => esc_attr__('Select Yes to turn off theme design credit note in the footer.', 'sharai-khana'),
            'id' => 'disable_theme_credit',
            'default' => 0,
            'on' => esc_attr__('Yes', 'sharai-khana'),
            'off' => esc_attr__('No', 'sharai-khana'),
            'type' => 'switch',
        ),
        array(
            'id'       => 'footer_menu_display_status',
            'type'     => 'switch',
            'title'    =>  esc_html__('Display footer menu?', 'sharai-khana'),
            'subtitle' => '',
            'default'  => false
        )
    )
));

//Styling Options 
Redux::setSection($opt_name, array(
    'icon' => 'el el-adjust-alt',
    'title' => esc_html__('Styling Options', 'sharai-khana'),
));

// Header Styling
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Header Styling', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(

        array(
            'id' => 'theme_default_header_style',
            'type' => 'select',
            'title' => __('Default header style', 'sharai-khana'),
            'subtitle' => __('Select default header style and it will use all over the site.', 'sharai-khana'),
            // Must provide key => value pairs for select options
            'options' => array(
                '' => 'Default Header ( Nav Menu With Background )',
                'style-1' => 'Header 1 ( Left Logo & Full Width Menu With Background )'
            ),
            'default' => '',
        ),

        array(
            'title' => esc_html__('Display mobile menu before logo?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it ON to set mobile menu before LOGO.', 'sharai-khana'),
            'id' => 'mob_menu_left',
            'default' => 0,
            '1' => esc_html__('On', 'sharai-khana'),
            '0' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'title' => esc_html__('Sticky header', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it ON to enable sticky header.', 'sharai-khana'),
            'id' => 'enable_sticky_header',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),
        array(
            'id' => 'header-spacing-static',
            'type' => 'spacing',
            'output' => array('.header-static'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding for header', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the header.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '!=', '1'),
            'default' => array(
                'padding-top' => '0px',
                'padding-right' => '30px',
                'padding-bottom' => '0px',
                'padding-left' => '30px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-background-static',
            'type' => 'background',
            'output' => array('.header-static'),
            'title' => esc_html__('Header background', 'sharai-khana'),
            'subtitle' => esc_html__('Header background with image, color, etc when header is static.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '!=', '1'),
            'default' => array(
                'background-color' => '#FFFFFF',
            ),
        ),
        array(
            'id' => 'header-spacing-sticky-before',
            'type' => 'spacing',
            'output' => array('.header-sticky'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Sticky header padding (before header is fixed to top)', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for Header before header is fixed to the top.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '=', '1'),
            'default' => array(
                'padding-top' => '0px',
                'padding-right' => '30px',
                'padding-bottom' => '0px',
                'padding-left' => '30px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-spacing-sticky-after',
            'type' => 'spacing',
            'output' => array('.header-sticky.sticky-header'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Sticky header padding (after header is fixed to top)', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for Header after header is fixed to the top.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '=', '1'),
            'default' => array(
                'padding-top' => '0px',
                'padding-right' => '30px',
                'padding-bottom' => '0px',
                'padding-left' => '30px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-background-before-sticky',
            'type' => 'background',
            'output' => array('.header-sticky'),
            'title' => esc_html__('Header background (before header is fixed to top)', 'sharai-khana'),
            'subtitle' => esc_html__('Header background with image, color, etc before header is fixed to the top.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '=', '1'),
            'default' => array(
                'background-color' => '#FFFFFF',
            ),
        ),
        array(
            'id' => 'header-background-after-sticky',
            'type' => 'background',
            'output' => array('.header-sticky.sticky-header'),
            'title' => esc_html__('Header background (after header is fixed to top)', 'sharai-khana'),
            'subtitle' => esc_html__('Header background with image, color, etc after header is fixed to the top.', 'sharai-khana'),
            'required' => array('enable_sticky_header', '=', '1'),
            'default' => array(
                'background-color' => '#FFFFFF',
            ),
        ),
        array(
            'id' => 'header-font-color',
            'type' => 'color',
            'output' => array('.site-header'),
            'title' => esc_html__('Header font color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the header (default: #000000).', 'sharai-khana'),
            'default' => '#000000',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-heading-color',
            'type' => 'color',
            'output' => array('.site-header h1, .site-header h2, .site-header h3, .site-header h4, .site-header h5, .site-header h6'),
            'title' => esc_html__('Header heading color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a heading color for the header (default: #000000).', 'sharai-khana'),
            'default' => '#000000',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-link-color',
            'type' => 'link_color',
            'title' => esc_html__('Header links color', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the header link color properties.', 'sharai-khana'),
            'output' => array('.site-header a'),
            'default' => array(
                'regular' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'hover' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'active' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            ),
        ),
    )
));

//Body Styling
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Body Styling', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'body-background',
            'type' => 'background',
            'output' => array('body'),
            'title' => esc_html__('Body background', 'sharai-khana'),
            'subtitle' => esc_html__('Body background with image, color, etc.', 'sharai-khana'),
            'default' => array(
                'background-color' => '#ffffff',
            )
        ),
        array(
            'id' => 'body-typography',
            'type' => 'typography',
            'title' => esc_html__('Body font', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'all_styles' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'output' => array('body div.site, .sharai_khana_slider h2, .sharai_khana_slider h3'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the body font properties.', 'sharai-khana'),
            'default' => array(
                'color' => '#646464',
                'font-weight' => '400',
                'font-family' => 'Lato',
                'google' => true,
                'font-size' => '16px',
                'line-height' => '30px',
                'letter-spacing' => '0',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'link-color',
            'type' => 'link_color',
            'title' => esc_html__('Links color', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the body link color properties.', 'sharai-khana'),
            'output' => array('body a, .entry-header .entry-title a, .entry-content .entry-title a, .products .product a.product_type_variable, .products .product a.ajax_add_to_cart'),
            'default' => array(
                'regular' => SHARAI_KHANA_THEME_TEXT_COLOR,
                'hover' => SHARAI_KHANA_THEME_LINK_HOVER_COLOR,
                'active' => SHARAI_KHANA_THEME_TEXT_COLOR,
            ),
        ),

        array(
            'id' => 'heading-typography',
            'type' => 'typography',
            'title' => esc_html__('Heading Font', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'font-size' => false,
            'line-height' => false,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array('h1, h2, h3, h4, h5, h6'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the heading (h1, h2, h3, h4, h5, h6) font properties.', 'sharai-khana'),
            'default' => array(
                'color' => '#555555',
                'font-weight' => '700',
                'all_styles' => true,
                'font-family' => 'Open Sans',
                'google' => true,
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h1-typography',
            'type' => 'typography',
            'title' => esc_html__('H1 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h1'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H1 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '28px',
                'line-height' => '36px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h2-typography',
            'type' => 'typography',
            'title' => esc_html__('H2 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h2'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H2 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '26px',
                'line-height' => '36px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h3-typography',
            'type' => 'typography',
            'title' => esc_html__('H3 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h3'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H3 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '22px',
                'line-height' => '36px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h4-typography',
            'type' => 'typography',
            'title' => esc_html__('H4 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h4'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H4 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '20px',
                'line-height' => '24px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h5-typography',
            'type' => 'typography',
            'title' => esc_html__('H5 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h5'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H5 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '18px',
                'line-height' => '20px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'h6-typography',
            'type' => 'typography',
            'title' => esc_html__('H6 Font Size and Line Height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('h6'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the H6 font properties.', 'sharai-khana'),
            'default' => array(
                'font-size' => '16px',
                'line-height' => '16px',
                'units'          => 'px'
            ),
        )

    )
));

//Breadcrumb Styling
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Breadcrumb Styling', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(

        array(
            'title' => esc_html__('Customize Breadcrumb?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it On to set custom image for the breadcrumb.', 'sharai-khana'),
            'id' => 'custom_breadcrumb_status',
            'default' => 0,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'id' => 'breadcrumb-bg',
            'type' => 'background',
            'output' => array('.breadcrumb-container'),
            'title' => esc_html__('Breadcrumb background ', 'sharai-khana'),
            'subtitle' => esc_html__('Set custom background for page/post/custom post type.', 'sharai-khana'),
            'required' => array('custom_breadcrumb_status', '!=', '0'),
            'default' => array(
                'background-color' => '#FAFAFA',
                'background-image' => esc_url(get_template_directory_uri() . '/images/bg-geometry.png'),
                'background-attachment' => 'scroll',
                'background-repeat' => 'repeat',
                'background-size' => 'cover',
                'background-position' => 'center center'
            )
        ),
        array(
            'id'       => 'breadcrumb-bg-opacity',
            'type'     => 'select',
            'title'    => __('Background opacity', 'sharai-khana'),
            'subtitle' => __('Set custom opacity for the breadcrumb background overlay.', 'sharai-khana'),
            'desc'     => __('If you want to use solid color as breadcrumb background, select opacity value 1', 'sharai-khana'),
            'required' => array('custom_breadcrumb_status', '!=', '0'),
            'options'  => array(
                '0' => '0',
                '0.1' => '0.1',
                '0.2' => '0.2',
                '0.3' => '0.3',
                '0.4' => '0.4',
                '0.5' => '0.5',
                '0.6' => '0.6',
                '0.7' => '0.7',
                '0.8' => '0.8',
                '0.9' => '0.9',
                '1.0' => '1.0'
            ),
            'default'  => '0.5',
        )

    )
));

//Post Styling
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Blog Post Styling', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'post-bg',
            'type' => 'background',
            'output' => array('article.post'),
            'title' => esc_html__('Post background', 'sharai-khana'),
            'subtitle' => esc_html__('Set color for post, custom post type content background.', 'sharai-khana'),
            'default' => array(
                'background-color' => '#f9fafb',
            ),
            'validate' => 'background-color',
        ),
        array(
            'id' => 'post-sticky-bg',
            'type' => 'background',
            'output' => array('article.post.sticky'),
            'title' => esc_html__('Sticky post background', 'sharai-khana'),
            'subtitle' => esc_html__('Set color for sticky post content background.', 'sharai-khana'),
            'default' => array(
                'background-color' => '#f9fafb',
            ),
            'validate' => 'background-color',
        ),

        array(
            'id' => 'site-wide-icon-color',
            'type' => 'color',
            'output' => array('.entry-meta span .fa, .widget_recent_entries li a::before, .widget_recent_comments li::before, .widget_archive li a::before, .product-categories li a::before, .widget_categories li a::before,.widget_pages li a::before'),
            'title' => esc_html__('Meta Icon color', 'sharai-khana'),
            'subtitle' => esc_html__('Color will apply blog meta icons and widget icons.', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        )
    )
));

//Sidebar Styling
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Sidebar Styling', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sidebar-widget-search-btn-bg',
            'type' => 'color_rgba',
            'title' => esc_html__('Search button background', 'sharai-khana'),
            'subtitle' => esc_html__('Set color for the widget search button.', 'sharai-khana'),
            'default' => array(
                'color' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'alpha' => 1
            ),
            'output' => array(
                'background-color' => '.search-form span.input-group-addon'
            )
        ),

        array(
            'id' => 'sidebar-widget-border-color',
            'type' => 'color_rgba',
            'title' => esc_html__('Sidebar title border', 'sharai-khana'),
            'subtitle' => esc_html__('Set color for the widget title border.', 'sharai-khana'),
            'default' => array(
                'color' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'alpha' => 1
            ),
            'output' => array(
                'background-color' => '#secondary h2.widgettitle::after, #secondary h3.widget-title::after, #secondary_2 h3.widget-title::after, .woocommerce-product-search button[type="submit"], .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .woocommerce span.onsale, .woocommerce div.product .woocommerce-tabs ul.tabs li.active'
            )
        ),
        array(
            'id' => 'sidebar-widget-bg',
            'type' => 'background',
            'output' => array('#secondary .widget, #secondary_2 .widget'),
            'title' => esc_html__('Sidebar Background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a color for the sidebar background (default: #f9fafb).', 'sharai-khana'),
            'default' => array(
                'background-color' => '#f9fafb',
            ),
            'validate' => 'background-color',
        ),
        array(
            'id' => 'sidebar-widget-title-typography',
            'type' => 'typography',
            'title' => esc_html__('Sidebar Widget Title Font Setting', 'sharai-khana'),
            'font-family' => false,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'output' => array('#secondary .widget-title'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify Sidebar Widget Title font properties.', 'sharai-khana'),
            'default' => array(
                'color' => '#1a1a1a',
                'font-size' => '18px',
                'line-height' => '36px',
                'units'          => 'px'
            ),
        )
    )
));

//Footer Widget Box
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Footer Widget Box', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'bottom-footer-container',
            'type' => 'background',
            'title' => esc_html__('Container background', 'sharai-khana'),
            'subtitle' => esc_html__('Bottom background with image, color, etc.', 'sharai-khana'),
            'default' => array(
                'background-color' => '#5C5C5C'
            ),
            'output' => array(
                'background-color' => '.bottom-footer-container',
                'background-image' => '.bottom-footer-container',
                'background-repeat' => '.bottom-footer-container',
                'background-position' => '.bottom-footer-container',
                'background-size' => '.bottom-footer-container'
            )
        ),

        array(
            'id'       => 'footer-background-overlay-status',
            'type'     => 'switch',
            'title'    => 'Enable bottom background overlay?',
            'subtitle' => '',
            'default'  => false
        ),

        array(
            'id' => 'bottom-footer-container-overlay',
            'type' => 'color_rgba',
            'output' => array('background-color' => '.bottom-footer-container-overlay'),
            'title' => esc_html__('Bottom background overlay', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a color for the bottom background image overlay.', 'sharai-khana'),
            'default' => array(
                'color' => '#5C5C5C',
                'alpha' => 0.8
            ),
            'required' => array('footer-background-overlay-status', '=', '1'),
        ),

        array(
            'id' => 'bottom-spacing',
            'type' => 'spacing',
            'output' => array('#bottom'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Container padding', 'sharai-khana'),
            'subtitle' => esc_html__('Set custom padding for the footer widget box.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '80px',
                'padding-right' => '15px',
                'padding-bottom' => '32px',
                'padding-left' => '15px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'bottom-font-color',
            'type' => 'color',
            'output' => array('.bottom-footer-container'),
            'title' => esc_html__('Widget text color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the bottom.', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),

        array(
            'id' => 'bottom-widget-icon-color',
            'type' => 'color',
            'output' => array('.bottom-footer-container i.fa, .bottom-footer-container a i.fa'),
            'title' => esc_html__('Widget icon color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the bottom (default: #F25764).', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        ),

        array(
            'id' => 'bottom-link-color',
            'type' => 'link_color',
            'title' => esc_html__('Footer links color', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the bottom link color properties.', 'sharai-khana'),
            'output' => array(
                'regular' => '.bottom-footer-container a',
                'hover' => '.bottom-footer-container a:hover',
                'active' => '.bottom-footer-container a:active'
            ),
            'default' => array(
                'regular' => '#FFFFFF',
                'hover' => '#FAFAFA',
                'active' => '#FFFFFF',
            ),
        ),
        array(
            'id' => 'bottom-heading-color',
            'type' => 'color',
            'output' => array('#bottom h1, #bottom h2, #bottom h3, #bottom h4, #bottom h5, #bottom h6'),
            'title' => esc_html__('Widget Heading text', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a heading color for the bottom.', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'bottom-widget-title-typography',
            'type' => 'typography',
            'title' => esc_html__('Widget title font', 'sharai-khana'),
            'subtitle' => esc_html__('Specify Bottom Widget Title font properties.', 'sharai-khana'),
            'font-family' => false,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'output' => array('#bottom h3.widget-title'),
            'units' => 'px',
            'default' => array(
                'color' => '#FFFFFF',
                'font-size' => '28px',
                'line-height' => '36px',
                'units'          => 'px'
            ),
        ),

        array(
            'id' => 'sharai-khana-copyright-background',
            'type' => 'color',
            'output' => array('.site-footer'),
            'title' => __('Copyright container background', 'sharai-khana'),
            'default' => '#5C5C5C',
            'validate' => 'color',
            'mode'     => 'background'
        )

    )
));

// Custom Headers Styling
Redux::setSection($opt_name, array(
    'icon' => 'el el-edit',
    'title' => esc_html__('Customize Headers', 'sharai-khana'),
));

// Custom Default Header Style


// Custom Header Style 01
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Header 01', 'sharai-khana'),
    'desc' => esc_html__('Customize Left Aligned Logo & Menu Header Background. ( Template Reference - Homepage Header 1 )', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(

        /*----- Start Header 01 Toolbar ----*/

        array(
            'title' => esc_html__('Display toolbar?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it Off to disable the toolbar.', 'sharai-khana'),
            'id' => 'header_1_toolbar_status',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'title' => esc_html__('Toolbar left content', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for toolbar left region.', 'sharai-khana'),
            'id' => 'header_1_toolbar_left',
            'default' => sprintf(esc_html__('%1$s', 'sharai-khana'), '<p>Welcome to Sharai Khana Repair Center.</p>'),
            'type' => 'textarea',
            'required' => array('header_1_toolbar_status', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),
        array(
            'title' => esc_html__('Toolbar right content', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for toolbar left region.', 'sharai-khana'),
            'id' => 'header_1_toolbar_right',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '<div class="top-bar-social">
    <a href="#"><i class="fa fa-facebook"></i></a>
    <a href="#"><i class="fa fa-twitter"></i></a>
    <a href="#"><i class="fa fa-pinterest"></i></a>
    <a href="#"><i class="fa fa-instagram"></i></a>
    <a href="#"><i class="fa fa-youtube"></i></a>
</div>'
            ),
            'type' => 'textarea',
            'required' => array('header_1_toolbar_status', '=', '1'),
            'subtitle' => esc_html__('You can add html code in here.', 'sharai-khana')
        ),


        array(
            'id' => 'header-1-toolbar-background',
            'type' => 'background',
            'output' => array('.header-style-1 #toolbar'),
            'title' => esc_html__('Toolbar background', 'sharai-khana'),
            'subtitle' => esc_html__('Toolbar background with image, color, etc.', 'sharai-khana'),
            'required' => array('header_1_toolbar_status', '=', '1'),
            'default' => array(
                'background-color' => '#777777',
            ),
        ),
        array(
            'id' => 'header-1-toolbar-spacing',
            'type' => 'spacing',
            'output' => array('.header-style-1 #toolbar'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding option for toolbar', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the toolbar.', 'sharai-khana'),
            'required' => array('header_1_toolbar_status', '=', '1'),
            'default' => array(
                'padding-top' => '6px',
                'padding-right' => '30px',
                'padding-bottom' => '0px',
                'padding-left' => '30px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-1-toolbar-typography',
            'type' => 'typography',
            'title' => esc_html__('Toolbar font size and line height', 'sharai-khana'),
            'color' => false,
            'font-family' => false,
            'font-style' => false,
            'font-weight' => false,
            'text-align' => false,
            'output' => array('.header-style-1 #toolbar, .header-style-1 .top-bar-link a'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the toolbar font properties.', 'sharai-khana'),
            'required' => array('header_1_toolbar_status', '=', '1'),
            'default' => array(
                'font-size' => '18px',
                'line-height' => '36px',
            ),
        ),
        array(
            'id' => 'header-1-toolbar-font-color',
            'type' => 'color',
            'output' => array('.header-style-1 #toolbar'),
            'title' => esc_html__('Toolbar font color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the toolbar (default: #FFFFFF).', 'sharai-khana'),
            'required' => array('header_1_toolbar_status', '=', '1'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-1-toolbar_link-color',
            'type' => 'link_color',
            'title' => esc_html__('Toolbar link (text link) color option', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the toolbar link (text link) color properties.', 'sharai-khana'),
            'required' => array('header_1_toolbar_status', '=', '1'),
            'output' => array('.header-style-1 #toolbar a'),
            'default' => array(
                'regular' => '#FFFFFF',
                'hover' => '#1A1A1A',
                'active' => '#1A1A1A',
            ),
        ),

        /*-----  End Header 01 Toolbar ----*/

        /*----- Start Header 01 Logo Container ----*/

        array(
            'id' => 'header-1-logo-image-status',
            'type' => 'switch',
            'title' => esc_html__('Upload custom logo for header 01 page?', 'sharai-khana'),
            'subtitle' => '',
            'default' => false
        ),

        array(
            'id' => 'header-1-logo-image',
            'type' => 'media',
            'title' => esc_html__('Upload logo', 'sharai-khana'),
            'subtitle' => esc_html__('Use this field to upload your custom logo for use in the theme landing/one page. (Recommended 200px x 40px)', 'sharai-khana'),
            'url' => true,
            'default' => array(
                'height' => '47',
                'width' => '265',
                'url' => esc_url(get_template_directory_uri() . '/images/logo.png'),
            ),
            'required' => array('header-1-logo-image-status', '=', true),
        ),

        array(
            'title' => esc_html__('Header middle content', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for header-middle (middle part of the header) region.', 'sharai-khana'),
            'id' => 'header-middle',
            'default' => sprintf(
                esc_html__('%1$s', 'sharai-khana'),
                '
<div class="col-md-4 col-sm-4 info-separotor">
    <div class="header-icon-box">
        <div class="icon-container">
            <i class="fa fa-phone"></i>
        </div>
        <div class="text">
            <span class="head-heading">Get In Touch</span>                                                
            <span class="head-content">
                example@gmail.com
            </span>
        </div>
    </div>
</div><!-- end .col-md-4  -->

<div class="col-md-4 col-sm-4 info-separotor">
    <div class="header-icon-box">
        <div class="icon-container">
            <i class="fa fa-home"></i>
        </div>
        <div class="text">
            <span class="head-heading">Office Address</span>                                                
            <span class="head-content">
                Sylhet, Bangladesh
            </span>
        </div>
    </div><!-- end .repair-icon-box  -->
</div><!-- end .col-md-4  -->                                        

<div class="col-md-4 col-sm-4 info-separotor">
    <div class="header-icon-box">
        <div class="icon-container">
            <i class="fa fa-clock-o"></i>
        </div>
        <div class="text">
            <span class="head-heading">Opening Hour</span>                                                
            <span class="head-content">
                10.00 - 18.00 UTC+06
            </span>
        </div>
    </div><!-- end .header-icon-box  -->
</div> <!-- end .col-md-4  -->'
            ),
            'type' => 'textarea',
        ),


        array(
            'id' => 'header-1-middle-content-icon-color',
            'type' => 'color',
            'output' => array('.header-style-1 .header-icon-box .icon-container'),
            'title' => esc_html__('Header middle content icon color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a icon color for middle content.', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        ),

        array(
            'id' => 'header-1-middle-content-heading-color',
            'type' => 'color',
            'output' => array('.header-style-1 .header-icon-box .text .head-heading'),
            'title' => esc_html__('Header middle content heading color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a heading color for middle content.', 'sharai-khana'),
            'default' => '#111111',
            'validate' => 'color',
        ),

        array(
            'id' => 'header-1-middle-content-text-color',
            'type' => 'color',
            'output' => array('.header-style-1 .header-icon-box .text .head-content'),
            'title' => esc_html__('Header middle content text color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a text color below the heading for middle content.', 'sharai-khana'),
            'default' => '#777777',
            'validate' => 'color',
        ),


        /*----- End Header 01 Logo Container ----*/

        /*----- Start Header 01 Navigation ----*/

        array(
            'title' => esc_html__('Enable Sticky Header?', 'sharai-khana'),
            'subtitle' => esc_html__('Turn it On to enable sticky header.', 'sharai-khana'),
            'id' => 'header_1_enable_sticky_header',
            'default' => 1,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'id' => 'header-style-1-navigation-container-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array('.header-style-1 .navigation-container'),
            'title' => esc_html__('Navigation container background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a background color for the navigation container (default: #2E385C).', 'sharai-khana'),
            'default' => '#EEEEEE',
            'validate' => 'color',
        ),

        array(
            'id' => 'header-style-1-nav-bar-spacing',
            'type' => 'spacing',
            'output' => array('.header-style-1 .menu-sharai_khana'),
            'mode' => 'margin',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Margin for navbar', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (margin) for the navbar.', 'sharai-khana'),
            'default' => array(
                'margin-top' => '0px',
                'margin-right' => '0px',
                'margin-bottom' => '0px',
                'margin-left' => '0px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-style-1-navigation-top-level-item-typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation top level item font property', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the navigation top level item font properties.', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'color' => false,
            'output' => array('.header-style-1 .main-navigation .menu a'),
            'units' => 'px',
            'default' => array(
                'font-family' => 'Lato',
                'font-weight' => '800',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '28px',
                'text-transform' => 'uppercase',
            ),
        ),
        array(
            'id' => 'header-style-1-navigation-top-level-item-spacing',
            'type' => 'spacing',
            'output' => array('.header-style-1 .main-navigation ul a'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding for navigation top level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the navigation top level item.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '24px',
                'padding-right' => '24px',
                'padding-bottom' => '24px',
                'padding-left' => '24px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-style-1-navigation-top-level-item-color',
            'type' => 'color',
            'output' => array('.header-style-1 .main-navigation .menu a'),
            'title' => esc_html__('Navigation top level item color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the navigation top level item(default: #000000).', 'sharai-khana'),
            'default' => '#000000',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-style-1-navigation-top-level-item-hover-active-color',
            'type' => 'color',
            'output' => array(
                '.header-style-1 .main-navigation li:hover > a, 
.header-style-1 .main-navigation li > a:focus, 
 .header-style-1 .main-navigation .current_page_item > a,
.header-style-1 .main-navigation .current-menu-item > a,
.header-style-1 .main-navigation .current_page_item > a:hover,
.header-style-1 .main-navigation .current-menu-item > a:hover,
.header-style-1 .main-navigation .current_page_item > a:focus,
.header-style-1 .main-navigation .current-menu-item > a:focus,
 .header-style-1 .main-navigation .current_page_ancestor > a,
                                  .header-style-1 .main-navigation .current-menu-ancestor > a'
            ),
            'title' => esc_html__('Navigation top level item hover/active Color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a top level item hover/active color for the navigation (default: #80B435).', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
        ),

        array(
            'id' => 'header-style-1-navigation-top-level-item-hover-active-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array(
                '.header-style-1 .main-navigation li:hover > a, 
.header-style-1 .main-navigation li > a:focus, 
 .header-style-1 .main-navigation .current_page_item > a,
.header-style-1 .main-navigation .current-menu-item > a,
.header-style-1 .main-navigation .current_page_item > a:hover,
.header-style-1 .main-navigation .current-menu-item > a:hover,
.header-style-1 .main-navigation .current_page_item > a:focus,
.header-style-1 .main-navigation .current-menu-item > a:focus,
 .header-style-1 .main-navigation .current_page_ancestor > a,
                                  .header-style-1 .main-navigation .current-menu-ancestor > a'
            ),
            'title' => esc_html__('Navigation top level item hover/active background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a top level item hover/active color for the navigation (default: #1A1A1A).', 'sharai-khana'),
            'default' => '#333333',
            'validate' => 'color',
        ),


        array(
            'id' => 'header-style-1-navigation-dropdown-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array('.header-style-1 .main-navigation ul ul'),
            'title' => esc_html__('Navigation dropdown background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a background color for the navigation dropdown (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#F1F1F1',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-width',
            'type' => 'dimensions',
            'units' => array('px'), // You can specify a unit value. Possible: px, em, %
            'units_extended' => 'true', // Allow users to select any type of unit
            'title' => esc_html__('Width for dropdown level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow your users to choose width for dropdown level item.', 'sharai-khana'),
            'output' => array('.header-style-1 .main-navigation ul ul a'),
            'height' => false,
            'default' => array(
                'width' => 200,
                'units'          => 'px'
            )
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-typography',
            'type' => 'typography',
            'title' => esc_html__('Navigation dropdown level item font property', 'sharai-khana'),
            'subtitle' => esc_html__('Specify the navigation dropdown level item font properties.', 'sharai-khana'),
            'google' => true,
            'font-backup' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'color' => false,
            'output' => array('.header-style-1 .main-navigation .menu ul a'),
            'units' => 'px',
            'default' => array(
                'font-family' => 'Lato',
                'font-weight' => '400',
                'google' => true,
                'font-size' => '14px',
                'line-height' => '32px',
                'text-transform' => 'uppercase',
            ),
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-spacing',
            'type' => 'spacing',
            'output' => array('.header-style-1 .main-navigation ul ul a'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Padding for navigation dropdown level item', 'sharai-khana'),
            'subtitle' => esc_html__('Allow to choose the spacing (padding) for the navigation dropdown level item.', 'sharai-khana'),
            'default' => array(
                'padding-top' => '7px',
                'padding-right' => '15px',
                'padding-bottom' => '7px',
                'padding-left' => '15px',
                'units'          => 'px'
            ),
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-color',
            'type' => 'color',
            'output' => array('.header-style-1 .main-navigation ul ul a'),
            'title' => esc_html__('Navigation dropdown level item color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a font color for the navigation dropdown level item(default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-hover-color',
            'type' => 'color',
            'output' => array(
                '.header-style-1 .main-navigation ul ul a:hover,
                      .header-style-1 .main-navigation ul ul a:focus,
                            .header-style-1 .main-navigation ul ul .current_page_item > a:hover,
                      .header-style-1 .main-navigation ul ul .current-menu-item > a:hover,
                      .header-style-1 .main-navigation ul ul .current_page_item > a:focus,
                      .header-style-1 .main-navigation ul ul .current-menu-item > a:focus'
            ),
            'title' => esc_html__('Navigation dropdown level item hover color', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a hover color for the navigation dropdown level item (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
        ),
        array(
            'id' => 'header-style-1-navigation-dropdown-level-item-hover-background',
            'type' => 'color',
            'mode' => 'background-color',
            'output' => array('.header-style-1 .main-navigation ul ul a:hover,
                      .header-style-1 .main-navigation ul ul a:focus'),
            'title' => esc_html__('Navigation dropdown level item hover background', 'sharai-khana'),
            'subtitle' => esc_html__('Pick a hover background color for the navigation dropdown level item (default: #000000).', 'sharai-khana'),
            'default' => '#000000',
            'validate' => 'color',
        ),

        array(
            'title' => esc_html__('Navbar right content', 'sharai-khana'),
            'subtitle' => esc_html__('Add your own custom text/html for navbar-right (right part of the navbar) region.', 'sharai-khana'),
            'id' => 'header-style-1-navbar-right',
            'default' => sprintf(esc_html__('%1$s', 'sharai-khana'), '<a class="btn btn-theme btn-theme-invert btn-square" href="#" title="Book Appointment">BOOK APPOINTMENT</a>'),
            'type' => 'textarea',
        ),

        /*----- End Header 01 Navigation ----*/

    )
));

//WPBakery Elements.    
Redux::setSection($opt_name, array(
    'icon' => 'el el-cogs',
    'title' => esc_html__('WPBakery Elements', 'sharai-khana'),
));

Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Section Settings', 'senior-care'),
    'subsection' => true,
    'fields' => array(
        array(
            'title' => esc_html__('Customize section padding?', 'sharai-khana'),
            'subtitle' => esc_html__('Select Enable to set custom padding for sections.', 'sharai-khana'),
            'id' => 'custom_section_padding_status',
            'default' => 0,
            'on' => esc_html__('On', 'sharai-khana'),
            'off' => esc_html__('Off', 'sharai-khana'),
            'type' => 'switch',
        ),

        array(
            'id' => 'section-custom-padding',
            'type' => 'spacing',
            'output' => array('.section-content-block'),
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Set section padding (Large Screen)', 'sharai-khana'),
            'subtitle' => '',
            'required' => array('custom_section_padding_status', '!=', '0'),
            'default' => array(
                'padding-top' => '120px',
                'padding-right' => '0',
                'padding-bottom' => '120px',
                'padding-left' => '0',
                'units'          => 'px'
            ),
        ),

        array(
            'id' => 'section-custom-padding-tablet',
            'type' => 'spacing',
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Set Section Padding (Tablet - 768X1024)', 'sharai-khana'),
            'subtitle' => '',
            'required' => array('custom_section_padding_status', '!=', '0'),
            'default' => array(
                'padding-top' => '48px',
                'padding-right' => '12px',
                'padding-bottom' => '32px',
                'padding-left' => '12px',
                'units'          => 'px'
            ),
        ),

        array(
            'id' => 'section-custom-padding-mobile',
            'type' => 'spacing',
            'mode' => 'padding',
            'units' => array('px'),
            'units_extended' => 'true',
            'title' => esc_html__('Set Section Padding (Mobile - 478X736)', 'sharai-khana'),
            'subtitle' => '',
            'required' => array('custom_section_padding_status', '!=', '0'),
            'default' => array(
                'padding-top' => '32px',
                'padding-right' => '16px',
                'padding-bottom' => '32px',
                'padding-left' => '16px',
                'units'          => 'px'
            ),
        )
    )
));

// Headline
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Section Headline', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'sharai-khana-vc-headline-status',
            'type'     => 'switch',
            'title'    => 'Enable global section headine layout customization?',
            'subtitle' => '',
            'default'  => false
        ),

        array(
            'id' => 'vc-heading-typography',
            'type' => 'typography',
            'title' => esc_html__('Heading font', 'sharai-khana'),
            'google' => true,
            'color' => false,
            'font-backup' => true,
            'font-size' => true,
            'line-height' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array('.section-heading-wrapper h2.section-heading'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the heading font properties.', 'sharai-khana'),
            'default' => array(
                'color' => '#555555',
                'font-weight' => '800',
                'font-family' => 'Open Sans',
                'font-size' => '48px',
                'line-height' => '48px',
                'all_styles' => true,
                'google' => true,
                'units'          => 'px'
            ),
            'required' => array('sharai-khana-vc-headline-status', '=', true),
        ),

        array(
            'id' => 'sharai-khana-vc-heading-title-color',
            'type' => 'color',
            'output' => array('.section-heading-wrapper h2.section-heading'),
            'title' => __('Headline title color', 'sharai-khana'),
            'default' => '#555555',
            'validate' => 'color',
            'required' => array('sharai-khana-vc-headline-status', '=', true)
        ),

        array(
            'id' => 'vc-sub-heading-typography',
            'type' => 'typography',
            'title' => esc_html__('Sub heading font', 'sharai-khana'),
            'google' => true,
            'color' => false,
            'font-backup' => true,
            'font-size' => true,
            'line-height' => true,
            'letter-spacing' => true,
            'word-spacing' => true,
            'text-transform' => true,
            'all_styles' => true,
            'output' => array('.section-heading-wrapper h4.section-subheading'),
            'units' => 'px',
            'subtitle' => esc_html__('Specify the sub heading font properties.', 'sharai-khana'),
            'default' => array(
                'color' => '#7b7b7b',
                'font-weight' => '600',
                'font-family' => 'Open Sans',
                'font-size' => '22px',
                'line-height' => '24px',
                'all_styles' => true,
                'google' => true,
                'units'          => 'px'
            ),
            'required' => array('sharai-khana-vc-headline-status', '=', true),
        ),

        array(
            'id' => 'sharai-khana-vc-heading-sub-title-color',
            'type' => 'color',
            'output' => array('.section-heading-wrapper h4.section-subheading'),
            'title' => __('Headline sub title color', 'sharai-khana'),
            'default' => '#7b7b7b',
            'validate' => 'color',
            'required' => array('sharai-khana-vc-headline-status', '=', true)
        ),

        array(
            'id' => 'sharai-khana-vc-heading-separator-color',
            'type' => 'color',
            'output' => array('.section-heading-wrapper span.heading-separator, form.sharai-khana-appointment-form .appointment-form-wrapper.light-layout .appointment-form-heading .form-title::after'),
            'title' => __('Headline separator color', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
            'mode'     => 'background',
            'required' => array('sharai-khana-vc-headline-status', '=', true)
        ),

        array(
            'id'       => 'sharai-khana-vc-vertical-separator-size',
            'title'    => __('Select vertical separator size', 'sharai-khana'),
            'required' => array('sharai-khana-vc-headline-status', '=', true),
            'type'     => 'dimensions',
            'units'    => array('px'),
            'output' => array('.section-heading-wrapper span.heading-separator'),
            'default' => array(
                'width' => '2',
                'height' => '16',
                'units'          => 'px'
            ),
        ),
        array(
            'id'       => 'sharai-khana-vc-horizontal-separator-size',
            'title'    => __('Select horizontal separator size', 'sharai-khana'),
            'required' => array('sharai-khana-vc-headline-status', '=', true),
            'type'     => 'dimensions',
            'units'    => array('px'),
            'output' => array('.section-heading-wrapper span.heading-separator-horizontal'),
            'default' => array(
                'width' => '48',
                'height' => '2',
                'units'          => 'px'
            ),
        )


    )
));

// Buttons
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Button', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sharai-khana-vc-button-status',
            'type' => 'switch',
            'title' => 'Enable global theme button customization?',
            'subtitle' => '',
            'default' => false
        ),
        array(
            'id' => 'sharai-khana-vc-btn-bg',
            'type' => 'color_rgba',
            'output' => array('a.btn-theme'),
            'title' => __('Button background', 'sharai-khana'),
            'subtitle' => __('Pick a title color for the theme (default: #F25764).', 'sharai-khana'),
            'default' => array(
                'color' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'alpha' => '1'
            ),
            'mode' => 'background',
            'required' => array('sharai-khana-vc-button-status', '=', true)
        ),
        array(
            'id' => 'sharai-khana-vc-btn-color',
            'type' => 'color',
            'output' => array('a.btn-theme'),
            'title' => __('Button text color', 'sharai-khana'),
            'subtitle' => __('Pick a title color for the theme (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'required' => array('sharai-khana-vc-button-status', '=', true)
        ),
        array(
            'id' => 'sharai-khana-vc-btn-hover-bg',
            'type' => 'color_rgba',
            'output' => array('a.btn-theme:hover'),
            'title' => __('Button hover background', 'sharai-khana'),
            'subtitle' => __('Pick a title color for the theme (default: #254559).', 'sharai-khana'),
            'default' => array(
                'color' => '#254559',
                'alpha' => '1'
            ),
            'mode' => 'background',
            'required' => array('sharai-khana-vc-button-status', '=', true)
        ),
        array(
            'id' => 'sharai-khana-vc-btn-hover-color',
            'type' => 'color',
            'output' => array('a.btn-theme:hover'),
            'title' => __('Button text hover color', 'sharai-khana'),
            'subtitle' => __('Pick a title color for the theme (default: #FFFFFF).', 'sharai-khana'),
            'default' => '#FFFFFF',
            'validate' => 'color',
            'required' => array('sharai-khana-vc-button-status', '=', true)
        ),

        // Border Radius.
        array(
            'id'       => 'sharai-khana-vc-btn-radius',
            'type'     => 'select',
            'title'    => __('Border radius', 'sharai-khana'),
            'subtitle' => __('Set button border radius.', 'sharai-khana'),
            'required' => array('sharai-khana-vc-button-status', '=', true),
            'options'  => array(
                '0px' => '0 px',
                '1px' => '1 px',
                '2px' => '2 px',
                '3px' => '3 px',
                '4px' => '4 px',
                '5px' => '5 px',
                '6px' => '6 px',
                '32px' => '32 px '
            ),
            'default'  => '0px',
        )

    )
));

// Carousel Settings 
Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Carousel', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sharai-khana-vc-carousel-status',
            'type' => 'switch',
            'title' => 'Enable global carousel navigation customization?',
            'subtitle' => '',
            'default' => false
        ),


        array(
            'id' => 'sharai-khana-vc-carousel-arrow-color',
            'type' => 'color',
            'output' => array('.owl-nav i, .owl-prev i'),
            'title' => __('Carousel arrow color', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
            'required' => array('sharai-khana-vc-carousel-status', '=', true)
        ),

        array(
            'id' => 'sharai-khana-vc-carousel-dot-color',
            'type' => 'color',
            'output' => array('.owl-dots .owl-dot.active span'),
            'title' => __('Carousel dot color', 'sharai-khana'),
            'default' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
            'validate' => 'color',
            'mode' => 'background',
            'required' => array('sharai-khana-vc-carousel-status', '=', true)
        )

    )
));

// Color Customization.

Redux::setSection($opt_name, array(
    'icon' => 'el-icon-chevron-right',
    'title' => esc_html__('Global Color', 'sharai-khana'),
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'sharai-khana-vc-color-custom-status',
            'type' => 'switch',
            'title' => 'Enable global color customization?',
            'subtitle' => '',
            'default' => false
        ),
        array(
            'id' => 'sharai_khana_vc_primary_color',
            'type' => 'color_rgba',
            'title' => __('Primary color', 'sharai-khana'),
            'subtitle' => __('Pick a primary color for the theme.', 'sharai-khana'),
            'default' => array(
                'color' => SHARAI_KHANA_THEME_PRIMARY_COLOR,
                'alpha' => '1'
            ),
            'mode' => 'background',
            'required' => array('sharai-khana-vc-color-custom-status', '=', true)
        ),
        array(
            'id' => 'sharai-khana-vc-info-text',
            'type' => 'info',
            'style' => 'success',
            'title' => __('Information!', 'sharai-khana'),
            'icon' => 'el el-info-circle',
            'desc' => 'Color will be applied on the following elements: <ul class="redux-info-list">
                <li>Process Icon.</li>
                <li>Service Icon.</li>
                <li>Hightlight Icon.</li>
                <li>Hightlight Icon.</li>
                <li>Testimonial icon color, image border.</li>
                <li>Counter icon.</li>
                <li>Team social icon.</li>
                <li>Logo border.</li>
                </ul>',
            'required' => array('sharai-khana-vc-color-custom-status', '=', true)
        )
    )
));

/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if (!function_exists('remove_demo')) {

    function remove_demo()
    {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if (class_exists('ReduxFrameworkPlugin')) {
            remove_filter('plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2);

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::instance(), 'admin_notices'));
        }
    }
}