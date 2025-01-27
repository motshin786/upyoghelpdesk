<?php

/*-----------------------------------------------------------------------------------*/
/* Allowed tags                                                                      */
/*-----------------------------------------------------------------------------------*/

if (!( function_exists('sharai_khana_allowed_tags') )) {

    function sharai_khana_allowed_tags() {
        return array(
            'img' => array(
                'src' => array(),
                'alt' => array(),
                'class' => array(),
                'style' => array(),
            ),
            'a' => array(
                'href' => array(),
                'title' => array(),
                'class' => array(),
                'target' => array()
            ),
            'br' => array(),
            'i' => array(
                'class' => array(),
                'style' => array(),
            ),
            'ol' => array(
                'class' => array(),
                'style' => array(),
            ),
            'ul' => array(
                'class' => array(),
                'style' => array(),
            ),
            'li' => array(
                'class' => array(),
                'style' => array(),
            ),
            'section' => array(
                'class' => array(),
                'style' => array(),
            ),
            'div' => array(
                'class' => array(),
                'style' => array(),
            ),
            'span' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h1' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h2' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h3' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h4' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h5' => array(
                'class' => array(),
                'style' => array(),
            ),
            'h6' => array(
                'class' => array(),
                'style' => array(),
            ),
            'style' => array(),
            'em' => array(),
            'strong' => array(
                'class' => array(),
                'style' => array(),
            ),
            'p' => array(
                'class' => array(),
                'style' => array(),
            ),
        );
    }

}

/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package sharai-khana
 */

add_filter( 'get_the_archive_title', 'sharai_khana_modify_archive_title');

 function sharai_khana_modify_archive_title( $title ) {

    if ( is_post_type_archive()) {

        $title = sprintf( __( '%s' ,'sharai-khana' ), post_type_archive_title( '', false ) );

    }

    return $title;

};

// Shortcode Feature added in version 1.0.1

function sharai_khana_breadcrumb() {
    
    global $post;
    
    $page_breadcrumb = '';
    
    if( empty( $post ) ) {
  
        $post_ID = 0;
        
    } else {
        
        $post_ID = $post->ID;
        
    }
    // Check if page header need to display or not.

    $sharai_khana_page_header_val = get_post_meta( $post_ID, SHARAI_KHANA_CMB_PREFIX . 'page_header', true);

    $sharai_khana_page_header_status = ( $sharai_khana_page_header_val == "" ) ? 1 : $sharai_khana_page_header_val;

    if( isset($sharai_khana_page_header_status) && $sharai_khana_page_header_status == 0 ) {

        return $page_breadcrumb; // Return Nothing.
        
    }
    
    // Page Menu Style 
    
    $page_menu_style = get_post_meta( $post_ID, 'page-menu-style', $single = true);
 
    if ($page_menu_style == "style1") {
        $breadcrumb_custom_style = "padding-top: 80px;";
    } else if ($page_menu_style == "style2") {
        $breadcrumb_custom_style = "padding-top: 80px;";
    } else {
        $breadcrumb_custom_style = "";
    }


    $breadcrumb_style ='style="background-position: 0% 0%; '.$breadcrumb_custom_style.' "';
    
    // start breadcrumb new code //
    
    $sharai_khana_custom_class = "";
    $breadcrumb_bg_overlay_style = "";
    
    $custom_breadcrumb_status = sharai_khana_wp_option('custom_breadcrumb_status');
    
    if ( isset($custom_breadcrumb_status) && $custom_breadcrumb_status == 1 ) {
        
        $sharai_khana_custom_class = " sharai_khana_custom";
        
        $breadcrumb_bg_style = sharai_khana_wp_option('breadcrumb-bg');
        $breadcrumb_bg_opacity = sharai_khana_wp_option('breadcrumb-bg-opacity');
        $breadcrumb_bg_overlay_style .= 'data-custom_style="';
        $breadcrumb_bg_overlay_style .= '.sharai_khana-breadcrumb-container{background-position: ' . $breadcrumb_bg_style['background-position'] .' !important; background-image: url(' . $breadcrumb_bg_style['background-image'] .') !important; background-size: ' . $breadcrumb_bg_style['background-size'] .' !important; background-repeat: ' . $breadcrumb_bg_style['background-repeat'] .' !important; }';
        $breadcrumb_bg_overlay_style .= '.sharai_khana-breadcrumb-container::before{background: '.$breadcrumb_bg_style['background-color'].' !important; opacity: '.$breadcrumb_bg_opacity.' !important; }';
        $breadcrumb_bg_overlay_style .= '"';
        
    }
    
    
    if(is_page()) {
       
       $large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');

        if(isset($large_image_url[0]) && $large_image_url[0]!="") {
            $breadcrumb_bg = $large_image_url[0];
             
            $breadcrumb_style ='style="background-position: 0% 0%; background-image: url('.$breadcrumb_bg .') !important; background-size: cover;background-repeat: no-repeat;"';

        } else  {
             $breadcrumb_bg = get_template_directory_uri(). '/images/header-bg.jpg';
             $breadcrumb_style ='style="background-position: 0% 0%; background-image: url('.$breadcrumb_bg .');"';
        }
 
    }
    
       $breadcrumb_header  = '<section class="sharai_khana-breadcrumb-container'.$sharai_khana_custom_class.'" '.$breadcrumb_bg_overlay_style.' data-stellar-background-ratio="0.1" '.$breadcrumb_style.'>

                                                <div class="container">

                                                    <div class="row">

                                                        <div class="col-sm-12 text-center">';
    
    
    $breadcrumb_footer = '</div>

                                            </div> <!-- end .row  -->

                                        </div> <!-- end .container  -->

                                    </section>';
    
    if (get_post_type() == "product") {

        if (function_exists('is_shop') && is_shop()) {

            $page_title = get_the_archive_title();
        } else {

            $page_title = get_the_title();
        }

        $breadcrumb_links = '<a href="' . esc_url(get_home_url('/')) . '">Home</a> / ' . $page_title;

        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb" id="custom_page_breadcrumb"> ' . $breadcrumb_links . ' </p>';

        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
    } else if ( is_archive() ) {

            
        $page_title = get_the_archive_title();

        $breadcrumb_links = '<a href="' . esc_url(get_home_url('/')) . '">Home</a> / ' . $page_title;



        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links . ' </p>';

        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
    } else if ( is_home() && !is_front_page() ) {
        
        $page_title = esc_attr__('Blog Page', 'sharai-khana');
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links .' </p>';
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
    } else if ( is_search() ) {
        
        $page_title = esc_attr__('Search Results for: ', 'sharai-khana') . '<span>' . get_search_query() . '</span>';
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>';
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
    } else if ( is_404() ) {
        
        $page_title = esc_attr__('404 Page', 'sharai-khana');
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links .' </p>';
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
    } else if( is_page() ) {
        
        $page_title = get_the_title();
        
        $breadcrumb_links = '<a href="'  . esc_url( get_home_url('/') ) . '">Home</a> / ' . $page_title;
        
        $breadcrumb_content = '<h2 style="color:#FFF; margin-top:-30px">NUDM - UPYOG Helpdesk</h3>
        <p class="page-breadcrumb" style="text-transform:lowercase"> support-upyog@niua.org </p>';
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
        
    } else if( is_category() || is_tag() ) {
      
        $page_title = get_queried_object()->name;
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links .' </p>';
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
    } else if ( is_singular('product') ) {
        
        $page_title =  get_the_title();

        if (strlen($page_title) >= 30) {
            $post_title = substr($page_title, 0, 30) . "....";
        }
        
        $category_term = get_the_terms($post->ID, 'category');
        
        $category_link_html = "";
        
        if( !empty( $category_term ) ) {
            
            $category_link = get_term_link($category_term[0]->slug, 'category');
            
            $category_link_html = '/ <a href="'.esc_url( $category_link ).'">'.$category_term[0]->name.'</a>';
            
        }
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> '.$category_link_html.' / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links .' </p>';
        
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
        
    } else if ( is_singular() ) {
        
        
        // Check if page header need to display or not.

        $sharai_khana_page_header_val = get_post_meta($post->ID, SHARAI_KHANA_CMB_PREFIX . 'page_header', true);
        
        $sharai_khana_page_header_status = ( $sharai_khana_page_header_val == "" ) ? 1 : $sharai_khana_page_header_val;
        
        if( isset($sharai_khana_page_header_status) && $sharai_khana_page_header_status == 0 && get_post_type()=="post") {
            
            return $page_breadcrumb; // Return Nothing.
            
        }
        
        $page_title =  get_the_title();

        if (strlen($page_title) >= 30) {
            $post_title = substr($page_title, 0, 30) . "....";
        }
        
        $category_term = get_the_terms($post->ID, 'category');
        
        $category_link_html = "";
        
        if( !empty( $category_term ) ) {
            
            $category_link = get_term_link($category_term[0]->slug, 'category');
            
            $category_link_html = '/ <a href="'.esc_url($category_link).'">'.$category_term[0]->name.'</a>';
            
        }
        
        $breadcrumb_links = '<a href="' . esc_url( get_home_url('/') ) . '">Home</a> '.$category_link_html.' / ' . $page_title;
        
        $breadcrumb_content = '<h1>' . $page_title . '</h1>
                                                <p class="page-breadcrumb"> ' . $breadcrumb_links .' </p>';
        
        
        $page_breadcrumb = $breadcrumb_header . $breadcrumb_content . $breadcrumb_footer;
        
        
    } else {
        
    }
    
    
    return do_shortcode($page_breadcrumb);
    
}


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function sharai_khana_body_classes($classes) {
    // Adds a class of group-blog to blogs with more than 1 published author.
    if (is_multi_author()) {
        $classes[] = 'group-blog';
    }

    return $classes;
}

add_filter('body_class', 'sharai_khana_body_classes');

if (version_compare($GLOBALS['wp_version'], '4.1', '<')) :

    /**
     * Filters wp_title to print a neat <title> tag based on what is being viewed.
     *
     * @param string $title Default title text for current view.
     * @param string $sep Optional separator.
     * @return string The filtered title.
     */
    function sharai_khana_wp_title($title, $sep) {
        if (is_feed()) {
            return $title;
        }

        global $page, $paged;

        // Add the blog name
        $title .= get_bloginfo('name', 'display');

        // Add the blog description for the home/front page.
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && ( is_home() || is_front_page() )) {
            $title .= " $sep $site_description";
        }

        // Add a page number if necessary:
        if (( $paged >= 2 || $page >= 2 ) && !is_404()) {
            $title .= " $sep " . sprintf(esc_html__('Page %s', 'sharai-khana'), max($paged, $page));
        }

        return esc_attr($title);
        
    }

    add_filter('wp_title', 'sharai_khana_wp_title', 10, 2);
endif;


/***********************************************************
* @Description: Media Query Stylesheet
***********************************************************/

function sharai_khana_custom_stylesheet() {
    
    // Header Default Menu Color Settings
    
    $header1_background_color_before_sticky = sharai_khana_wp_option('header-background-before-sticky');
    $nav_menu_arrow = sharai_khana_wp_option('navigation-top-level-item-color');
    $nav_menu_arrow_hover = sharai_khana_wp_option('navigation-dropdown-level-item-hover-color');
    $close_btn_color= sharai_khana_wp_option('navigation-dropdown-background');
    $close_btn_bg = sharai_khana_wp_option('navigation-top-level-item-hover-active-color');
    
    // Header Style 01 Menu Color Settings
    
    $header_style_1_navigation_container_background = sharai_khana_wp_option('header-style-1-navigation-container-background');
    $header_style_1_navigation_top_level_item_color = sharai_khana_wp_option('header-style-1-navigation-top-level-item-color');
    $header_style_1_nav_menu_arrow = sharai_khana_wp_option('header-style-1-navigation-top-level-item-color');
    $header_style_1_nav_menu_arrow_hover = sharai_khana_wp_option('header-style-1-navigation-dropdown-level-item-hover-color');
    $header_style_1_close_btn_color= sharai_khana_wp_option('header-style-1-navigation-dropdown-background');
    $header_style_1_close_btn_bg = sharai_khana_wp_option('header-style-1-navigation-top-level-item-hover-active-color');
    
    
    $sharai_khana_custom_stylesheet_output ='<style type="text/css">';
    
    // Custom VC Addon.
    
    $sharai_khana_vc_button_status = sharai_khana_wp_option('sharai-khana-vc-button-status');
    
    if ( isset($sharai_khana_vc_button_status) && $sharai_khana_vc_button_status == 1 ) {
        
        $sharai_khana_vc_btn_bg = sharai_khana_wp_option('sharai-khana-vc-btn-bg');
      
        $sharai_khana_vc_btn_color = sharai_khana_wp_option('sharai-khana-vc-btn-color');
        
        $sharai_khana_vc_btn_hover_bg = sharai_khana_wp_option('sharai-khana-vc-btn-hover-bg');
        $sharai_khana_vc_btn_hover_color = sharai_khana_wp_option('sharai-khana-vc-btn-hover-color');
        
        $sharai_khana_vc_btn_radius = sharai_khana_wp_option('sharai-khana-vc-btn-radius');
        
        if( isset($sharai_khana_vc_btn_radius) ) {
            
            $sharai_khana_vc_btn_radius = $sharai_khana_vc_btn_radius;
            
        } else {
            $sharai_khana_vc_btn_radius = "0px";
        }

        $sharai_khana_custom_stylesheet_output .='.btn-theme, .nav-previous a, .nav-next a, .pager .previous a, .pager .previous a:focus, .pager .next a, .pager .next a:focus, .btn-social-icon, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce div.product form.cart .button, #place_order{ background: ' . $sharai_khana_vc_btn_bg['color'] .' !important; border-color: ' . $sharai_khana_vc_btn_bg['color'] .' !important; border-radius: ' . $sharai_khana_vc_btn_radius .' !important; color: ' . $sharai_khana_vc_btn_color .' !important;  }';
        $sharai_khana_custom_stylesheet_output .='.btn-theme:hover, .nav-previous a:hover, .nav-next a:hover, .pager .previous a:hover, .pager .next a:hover,.single-post-inner .tags-links a:hover,  .btn-social-icon:hover, .woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce div.product form.cart .button:hover, #place_order:hover{ background: ' . $sharai_khana_vc_btn_hover_bg['color'] .' !important; border-color: ' . $sharai_khana_vc_btn_hover_bg['color'] .' !important; border-radius: ' . $sharai_khana_vc_btn_radius .' !important;  color: ' . $sharai_khana_vc_btn_hover_color .' !important;  }';
        
        // WooCommerce Button.       
        
        
    }
    
    // Customize Color.
    
    $sharai_khana_vc_color_custom_status = sharai_khana_wp_option('sharai-khana-vc-color-custom-status');
    
    if ( isset($sharai_khana_vc_color_custom_status) && $sharai_khana_vc_color_custom_status == 1 ) {
        
        $sharai_khana_vc_primary_color = sharai_khana_wp_option('sharai_khana_vc_primary_color');    
        
        
        
        // Toolbar Link Separator line color.
        $sharai_khana_custom_stylesheet_output .='.separator-line{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        
        // Overlay.        
        $sharai_khana_custom_stylesheet_output .='.section-primary-overlay-bg:before{ background: ' . sharai_khana_hex_to_rgba( $sharai_khana_vc_primary_color['color'], 0.9 ) .' !important; }';
        
        // Highlight Text.
        
        $sharai_khana_custom_stylesheet_output .='.our-experience span, .text-highlighter-primary{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        // About Us Slogan.        
        $sharai_khana_custom_stylesheet_output .='.about-us-slogan::after{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='ul.custom-bullet-list li:before{ border-color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        // Slider.
        $sharai_khana_custom_stylesheet_output .='.sharai_khana_slider .owl-dots .active{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        // Process.
        $sharai_khana_custom_stylesheet_output .='.process-step-1 i.fa{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        // Hightlight.
        
        $sharai_khana_custom_stylesheet_output .='.highlight-layout-1 span, .highlight-layout-1 h2::after, .highlight-layout-3 h2::after{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.highlight-layout-1.highlight-layout-4 span, .highlight-layout-1.highlight-layout-4 h2::after{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important;}';
        $sharai_khana_custom_stylesheet_output .='.highlight-layout-2 span, .highlight-layout-3 span{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        // Service.
        $sharai_khana_custom_stylesheet_output .='.service-block-1 figure span, .service-block-2 figure span{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.service-block-1 h2 span, .service-block-2 h2 span{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Pricing Table
        $sharai_khana_custom_stylesheet_output .='.price-table-layout-1 .title{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.price-table-layout-1 .price-value{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.price-table-layout-1:before, .price-table-layout-1:after{ border-color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Blog
        $sharai_khana_custom_stylesheet_output .='.latest-details{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Counter
        $sharai_khana_custom_stylesheet_output .='.counter-block-1 .icon, .counter-block-2 .icon{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Testimonial
        $sharai_khana_custom_stylesheet_output .='.testimony-layout-1 div.testimony-content::before{ color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.testimony-layout-1.testimony-layout-alt div.testimony-content::before{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.testimony-layout-1 .testimony-meta img{ border-color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Team
        $sharai_khana_custom_stylesheet_output .='.team-layout-1 .team-info .team-social-share a{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        $sharai_khana_custom_stylesheet_output .='.team-layout-1 .team-info .team-social-share a:hover{ background: #FFFFFF !important; color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Logo
        $sharai_khana_custom_stylesheet_output .='.logo-layout-1 .client-logo:hover{ border-color: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
        //Contact
        $sharai_khana_custom_stylesheet_output .='.contact-info .icon-container{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';       
        
        // Footer Social Icon Background.
        $sharai_khana_custom_stylesheet_output .='.bottom-footer-container .footer-widget-social-icons a{ background: ' . $sharai_khana_vc_primary_color['color'] .' !important; }';
        
    }
    
    // For Tablet.
    
    $sharai_khana_custom_stylesheet_output.='@media screen and (max-width: 768px) {';

        if(isset($header1_background_color_before_sticky['background-color'])) {
            
            $sharai_khana_custom_stylesheet_output.='.header-style-default .main-navigation ul {background: ' . $header1_background_color_before_sticky['background-color'] . ' !important;}';
            $sharai_khana_custom_stylesheet_output.='.header-style-default span.sub-menu-nav-arrow{color: ' . $nav_menu_arrow . ' !important; }';
            $sharai_khana_custom_stylesheet_output.='.header-style-default .menu-item-has-children ul.sub-menu a:hover i{color: ' . $nav_menu_arrow_hover . ' !important; }';
            $sharai_khana_custom_stylesheet_output.='.header-style-default span.btn-menu-close{ background: ' . $close_btn_bg . '; color: ' . $close_btn_color . ' !important; }';
        }

        if (isset($header_style_1_navigation_container_background)) {
            $sharai_khana_custom_stylesheet_output.='.header-style-1 .main-navigation ul {background: '.$header_style_1_navigation_container_background.'; color: '.$header_style_1_navigation_top_level_item_color.' !important; }';
            $sharai_khana_custom_stylesheet_output.='.header-style-1 span.sub-menu-nav-arrow{color: ' . $header_style_1_nav_menu_arrow . ' !important; }';
            $sharai_khana_custom_stylesheet_output.='.header-style-1 .menu-item-has-children ul.sub-menu a:hover i{color: ' . $header_style_1_nav_menu_arrow_hover . ' !important; }';
            $sharai_khana_custom_stylesheet_output.='.header-style-1 span.btn-menu-close{ background: ' . $header_style_1_close_btn_bg . '; color: ' . $header_style_1_close_btn_color . ' !important; }';
        }

      $sharai_khana_custom_stylesheet_output.='}';
    
    
    $sharai_khana_custom_stylesheet_output .='</style>';
    
    echo $sharai_khana_custom_stylesheet_output;
    
}

add_action('wp_head', 'sharai_khana_custom_stylesheet');

/*--  Pre Loader Action --*/

if (!function_exists('cb_sharai_khana_preloader') && class_exists('Redux') && class_exists('Sharai_Khana_Vc_Addon') ) {

    function cb_sharai_khana_preloader() {
        
        $sharai_khana_preloader_disable_status = sharai_khana_wp_option('sharai_khana_preloader_disable_status');
        $sharai_khana_preloader_img = sharai_khana_wp_option('sharai_khana_preloader_img');
        $sharai_khana_preloader_background = sharai_khana_wp_option('sharai_khana_preloader_background');
        $output = '';
        
        if( $sharai_khana_preloader_disable_status == 1 ) {
            
            echo $output;
            
        } else {
            // Custom Preloader Background.
            $custom_class = "";

            if (is_array($sharai_khana_preloader_background) && !empty($sharai_khana_preloader_background['color'])) {
                $custom_class .= ' style="background: ' . $sharai_khana_preloader_background['color'] . ' !important;"';
            } else {
                $custom_class .= ' style="background: ' . $sharai_khana_preloader_background . ' !important;"';
            }

            // Custom Preloader Icon.
            
            if ( is_array( $sharai_khana_preloader_img ) && $sharai_khana_preloader_img['url'] !=""   ) {
                $sharai_khana_preloader_img_src = $sharai_khana_preloader_img['url'];
            } else {
                $sharai_khana_preloader_img_src = esc_url(get_template_directory_uri() . '/images/loader.gif');
            }

            echo $output.='<div id="preloader" ' . $custom_class . '><span><img src="' . $sharai_khana_preloader_img_src . '" alt="' . __('Loading....', 'sharai-khana') . '" /></span></div>';
        }
        
    }

    add_action('sharai_khana_loader', 'cb_sharai_khana_preloader');
    
}

/* --  Back To Top Icon -- */

if (!function_exists('btt_sharai_khana_footer_content')  && class_exists('Redux') && class_exists('Sharai_Khana_Vc_Addon') ) {

    function btt_sharai_khana_footer_content() {
        
        $sharai_khana_back_to_top_disable_status = sharai_khana_wp_option('sharai_khana_back_to_top_disable_status');
        $sharai_khana_back_to_top_background = sharai_khana_wp_option('sharai_khana_back_to_top_background');
        
        $output = '';
        
        if( $sharai_khana_back_to_top_disable_status == 1 ) {
            echo $output;
        } else {
            
            $custom_class = "";
            $custom_class_data = "";
            if (is_array($sharai_khana_back_to_top_background) && !empty($sharai_khana_back_to_top_background['color'])) {

                $custom_class .= ' class=" sharai_khana_custom"';
                $custom_class_data .= "#backTop.custom{ background-color: " . $sharai_khana_back_to_top_background['color'] . " !important;}";
                $custom_class_data = ' data-custom_style="' . $custom_class_data . '"';
            }

            echo $output.='<a id="backTop" ' . $custom_class . ' ' . $custom_class_data . '>Back To Top</a>';
        }
        
    }

    add_action('wp_footer', 'btt_sharai_khana_footer_content');
    
}

/* Convert hexdec color string to rgb(a) string */

if ( ! function_exists('sharai_khana_hex_to_rgba')) {

    function sharai_khana_hex_to_rgba($color, $opacity = false) {

        $default = 'rgb(0,0,0)';

        //Return default if no color provided
        if (empty($color))
            return $default;

        //Sanitize $color if "#" is provided 
        if ($color[0] == '#') {
            $color = substr($color, 1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array($color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5]);
        } elseif (strlen($color) == 3) {
            $hex = array($color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2]);
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if ($opacity) {
            if (abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba(' . implode(",", $rgb) . ',' . $opacity . ')';
        } else {
            $output = 'rgb(' . implode(",", $rgb) . ')';
        }

        //Return rgb(a) color string
        return $output;
    }

}