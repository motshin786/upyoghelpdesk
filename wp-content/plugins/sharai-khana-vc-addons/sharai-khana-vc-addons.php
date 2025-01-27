<?php
/*
  Plugin Name: Sharai Khana Theme WPBakery Page Builder Addons
  Version: 1.2.4
  Description: Sharai Khana Theme WPBakery Page Builder Addons
  Author: xenioushk
  Author URI:  https://bluewindlab.net
  Text Domain: sharai_khana_vc
  Domain Path: /languages/
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

/* ----------------------------------------------------------------------------*
 * Public-Facing Functionality
 * ---------------------------------------------------------------------------- */

if (function_exists('wp_get_theme') && trim(wp_get_theme()) == "Sharai Khana") {
    // For Main Theme.
    $sharai_khana_activate_status = 1;
} else if (function_exists('wp_get_theme') && trim(wp_get_theme()) == "Sharai Khana Child") {
    //For Child Theme.
    $sharai_khana_activate_status = 1;
} else {
    //For Other Theme
    $sharai_khana_activate_status = 0;
}

if ($sharai_khana_activate_status == 0) {
    return '';
}

// End of plugin activation check status.

define('SHARAI_KHANA_VC_ADDON_TITLE', 'Sharai Khana Theme WPBakery Page Builder Addons');
define('SHARAI_KHANA_VC_ADDON_CURRENT_VERSION', '1.2.4'); // change plugin current version in here.

define('SHARAI_KHANA_VC_PATH', plugin_dir_path(__FILE__)); // relative path.
define("SHARAI_KHANA_VC_PLUGIN_DIR", plugins_url() . '/sharai-khana-vc-addons/'); // absolute dir with http.
define("SHARAI_KHANA_VC_PLUGIN_ADDON_PATH", SHARAI_KHANA_VC_PATH . '/vc-addons/');

define("SHARAI_KHANA_PRIMARY_COLOR", "#80B435");
define("SHARAI_KHANA_LIGHT_BG", "#FFFFFF");
define("SHARAI_KHANA_LINK_HOVER_COLOR", "#50726C");
define("SHARAI_KHANA_TEXT_COLOR", "#888888");
define("SHARAI_KHANA_LIGHT_TEXT_COLOR", "#FFFFFF");
define("SHARAI_KHANA_BORDER_COLOR", "#CCCCCC");

define("SHARAI_KHANA_ADDITIONAL_CLASS_LINK", ' <a href="https://wp.bwlthemes.com/wp_sharai_khana/doc/#additional_classes_section" target="_blank">Check Additional Class Reference.</a>');

require_once(plugin_dir_path(__FILE__) . 'public/class-sharai-khana-vc-addon.php');

register_activation_hook(__FILE__, ['Sharai_Khana_Vc_Addon', 'activate']);
register_deactivation_hook(__FILE__, ['Sharai_Khana_Vc_Addon', 'deactivate']);

add_action('plugins_loaded', ['Sharai_Khana_Vc_Addon', 'get_instance']);

if (is_admin()) {

    require_once(plugin_dir_path(__FILE__) . 'admin/class-sharai-khana-vc-addon-admin.php');
    add_action('plugins_loaded', ['Sharai_Khana_Vc_Addon_Admin', 'get_instance']);
}