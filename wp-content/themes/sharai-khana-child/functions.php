<?php
/**
 * @version    1.0
 * @package    sharai-khana
 * @author     Md Mahbub Alam Khan
 * @copyright  https://themeforest.net/user/xenioushk
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 * * Websites: http://bluewindlab.net
 */

/**
 * Enqueue style of child theme
 */
add_action( 'wp_enqueue_scripts', 'sharai_khana_enqueue_styles' );
function sharai_khana_enqueue_styles() {
 
    $sharai_khana_parent_style = 'sharai-khana-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
 
    wp_enqueue_style( $sharai_khana_parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $sharai_khana_parent_style ),
        wp_get_theme()->get('Version')
    );
}