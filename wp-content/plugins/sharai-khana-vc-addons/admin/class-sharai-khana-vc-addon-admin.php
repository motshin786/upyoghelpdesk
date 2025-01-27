<?php

class Sharai_Khana_Vc_Addon_Admin {
    
    protected static $instance = null;
    
    protected $plugin_screen_hook_suffix = null;

    private function __construct() {
        $plugin = Sharai_Khana_Vc_Addon::get_instance();
        $this->plugin_slug = $plugin->get_plugin_slug();

        // Load admin style sheet and JavaScript.
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }
    
    public static function get_instance() {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    public function enqueue_admin_scripts() {
        wp_enqueue_style($this->plugin_slug . '-admin-styles', plugins_url('assets/css/admin.css', __FILE__), array(), Sharai_Khana_Vc_Addon::VERSION);
        wp_enqueue_script($this->plugin_slug . '-plugin-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'admin/assets/js/admin.js', array('jquery', 'jquery-ui-core', 'jquery-ui-autocomplete'), Sharai_Khana_Vc_Addon::VERSION);
    }

}

// Generate param type "bwl_cont_ext"

if (function_exists('vc_add_shortcode_param')) {
    vc_add_shortcode_param('bwl_cont_ext', 'cb_bwl_cont_ext', SHARAI_KHANA_VC_PLUGIN_DIR . '/admin/assets/js/vc-admin.js');
}

if (!function_exists('cb_bwl_cont_ext')) {

    function cb_bwl_cont_ext($settings, $value) {
        return '<div class="my_param_block">'
                . '<input name="' . esc_attr($settings['param_name']) . '" class="bwl_cont_ext wpb_vc_param_value wpb-textinput ' .
                esc_attr($settings['param_name']) . ' ' .
                esc_attr($settings['type']) . '_field" type="text" value="' . esc_attr($value) . '" />'
                . '</div>'; // New button element
    }

}