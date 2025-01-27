<?php

class Sharai_Khana_Vc_Addon
{

    const VERSION = SHARAI_KHANA_VC_ADDON_CURRENT_VERSION;

    protected $plugin_slug = 'sharai_khana_vc';
    protected static $instance = null;

    private function __construct()
    {

        if (!defined('WPB_VC_VERSION')) {
            return '';
        }

        // Load plugin text domain
        add_action('init', array($this, 'load_plugin_textdomain'));

        // Activate plugin when new blog is added
        add_action('wpmu_new_blog', array($this, 'activate_new_site'));

        // Load public-facing style sheet and JavaScript.
        add_action('wp_enqueue_scripts', array($this, 'enqueue_styles'));
        add_action('vc_load_iframe_jscss', array($this, 'sharai_khana_load_front_editor_scripts'));
    }

    /**
     * Return the plugin slug.
     */
    public function get_plugin_slug()
    {
        return $this->plugin_slug;
    }

    /**
     * Return an instance of this class.
     */
    public static function get_instance()
    {

        // If the single instance hasn't been set, set it now.
        if (null == self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * Fired when the plugin is activated.
     */
    public static function activate($network_wide)
    {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_activate();
                }

                restore_current_blog();
            } else {
                self::single_activate();
            }
        } else {
            self::single_activate();
        }
    }

    /**
     * Fired when the plugin is deactivated.
     */
    public static function deactivate($network_wide)
    {

        if (function_exists('is_multisite') && is_multisite()) {

            if ($network_wide) {

                // Get all blog ids
                $blog_ids = self::get_blog_ids();

                foreach ($blog_ids as $blog_id) {

                    switch_to_blog($blog_id);
                    self::single_deactivate();
                }

                restore_current_blog();
            } else {
                self::single_deactivate();
            }
        } else {
            self::single_deactivate();
        }
    }

    /**
     * Fired when a new site is activated with a WPMU environment.
     */
    public function activate_new_site($blog_id)
    {

        if (1 !== did_action('wpmu_new_blog')) {
            return;
        }

        switch_to_blog($blog_id);
        self::single_activate();
        restore_current_blog();
    }

    private static function get_blog_ids()
    {

        global $wpdb;

        // get an array of blog ids
        $sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

        return $wpdb->get_col($sql);
    }

    /**
     * Fired for each blog when the plugin is activated.
     */
    private static function single_activate()
    {
        // @TODO: Define activation functionality here
    }

    /**
     * Fired for each blog when the plugin is deactivated.
     */
    private static function single_deactivate()
    {
        // @TODO: Define deactivation functionality here
    }

    /**
     * Load the plugin text domain for translation.
     */
    public function load_plugin_textdomain()
    {

        $domain = $this->plugin_slug;
        $locale = apply_filters('plugin_locale', get_locale(), $domain);
        load_textdomain($domain, trailingslashit(WP_LANG_DIR) . $domain . '/' . $domain . '-' . $locale . '.mo');

        require_once(SHARAI_KHANA_VC_PATH . 'includes/theme_vc_helpers.php');

        $custom_vc_elements = array(
            'banner', 'blog_post', 'button', 'contact_info', 'counter', 'cta', 'custom_elements', 'faq', 'gallery',
            'heading', 'highlights', 'logos', 'pricetable', 'process', 'service', 'slider', 'social_link', 'team', 'testimonial', 'video'
        );

        foreach ($custom_vc_elements as $key => $value) {
            require_once(SHARAI_KHANA_VC_PLUGIN_ADDON_PATH . $value . '/' . $value . '.php'); // New
        }
    }

    /**
     * Register and enqueue public-facing style sheet.
     */
    public function enqueue_styles()
    {

        // Styles.

        wp_enqueue_style($this->plugin_slug . '-animate-styles', plugins_url('assets/css/animate.css', __FILE__), [], self::VERSION);
        wp_enqueue_style($this->plugin_slug . '-venobox-styles', plugins_url('assets/css/venobox.css', __FILE__), [], self::VERSION);
        wp_enqueue_style($this->plugin_slug . '-owl-carousel-styles', plugins_url('assets/css/owl.carousel.css', __FILE__), [], self::VERSION);
        wp_enqueue_style($this->plugin_slug . '-owl-theme-styles', plugins_url('assets/css/owl.theme.css', __FILE__), [], self::VERSION);
        wp_enqueue_style($this->plugin_slug . '-plugin-styles', plugins_url('assets/css/public.css', __FILE__), [], self::VERSION);

        // Scripts.

        wp_enqueue_script($this->plugin_slug . '-venobox-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/venobox.min.js', ['jquery'], self::VERSION, TRUE);
        wp_enqueue_script($this->plugin_slug . '-waypoint-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/waypoints.min.js', ['jquery'], self::VERSION, TRUE);
        wp_enqueue_script($this->plugin_slug . '-backTop-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/jquery.backTop.min.js', ['jquery'], self::VERSION, TRUE);
        wp_enqueue_script($this->plugin_slug . '-counter-up-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/jquery.counterup.min.js', ['jquery'], self::VERSION, TRUE);
        wp_enqueue_script($this->plugin_slug . '-owl-carousel-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/owl.carousel.min.js', ['jquery'], self::VERSION, TRUE);
        wp_enqueue_script($this->plugin_slug . '-plugin-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/public.js', ['jquery'], self::VERSION);
    }

    /**
     * Front End Visual Composer Style & Scripts.
     */
    public function sharai_khana_load_front_editor_scripts()
    {
        wp_enqueue_style($this->plugin_slug . '-vc-front-end-styles', plugins_url('assets/css/vc_front_end_styles.css', __FILE__), [], self::VERSION);
        wp_enqueue_script($this->plugin_slug . '-vc-front-end-script', SHARAI_KHANA_VC_PLUGIN_DIR . 'public/assets/js/vc_front_end_scripts.js', ['jquery'], self::VERSION);
    }
}