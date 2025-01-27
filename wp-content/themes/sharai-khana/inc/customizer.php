<?php

/**
 * sharai-khana Theme Customizer
 *
 * @package sharai-khana
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function sharai_khana_customize_register($wp_customize) {
    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';
}

add_action('customize_register', 'sharai_khana_customize_register');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function sharai_khana_customize_preview_js() {
    wp_enqueue_script('sharai-khana-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), SHARAI_KHANA_THEME_VER, true);
}

add_action('customize_preview_init', 'sharai_khana_customize_preview_js');
