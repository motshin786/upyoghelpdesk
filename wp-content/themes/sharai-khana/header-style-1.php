<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package petapalozza
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
        <?php if (!( function_exists('has_site_icon') && has_site_icon() )) : if (sharai_khana_wp_option('custom_favicon') != '') : ?>
                        <?php
                                $custom_favicon = sharai_khana_wp_option('custom_favicon', false);
                                if (is_array($custom_favicon)) {
                                    $custom_favicon_url = $custom_favicon['url'];
                                } else {
                                    $custom_favicon_url = $custom_favicon;
                                }
                           ?>
                        <link rel="icon" href="<?php echo esc_url($custom_favicon_url); ?>" />
                    <?php endif; endif; ?>
                <?php wp_head(); ?>
    </head>
    
<?php

    global $post;
    
    if (empty($post)) {
        $post_id = 0;
    } else {
        $post_id = $post->ID;
    }
 
    $sharai_khana_default_menu = 'primary';
    $sharai_khana_default_menu_class = 'menu theme_primary_menu';

    // Top Bar Display Status.

    $sharai_khana_top_bar_status = get_post_meta($post_id, 'sharai-khana-top-bar-status', $single = true);

    if (isset($sharai_khana_top_bar_status) && $sharai_khana_top_bar_status == "") {
        $sharai_khana_top_bar_status = 1;
    }

    // One Page Menu Status.

    $sharai_khana_one_page_menu_val = get_post_meta($post_id, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status'), true);
    $sharai_khana_default_menu = ( $sharai_khana_one_page_menu_val == 1 ) ? 'one-page-menu' : $sharai_khana_default_menu;
    $sharai_khana_default_menu_class = ( $sharai_khana_one_page_menu_val == 1 ) ? $sharai_khana_default_menu_class . ' one_page_menu' : $sharai_khana_default_menu_class;

    if ( is_page() || is_single() ) {
        
        $VcYes = get_post_meta($post_id, 'visual-composer-page', $single = true);

    } else{
        
        $VcYes = 'No';	
        
    }
    
?>
    
<body <?php body_class(); ?>>
    
    <?php 
    
        do_action('sharai_khana_loader');
    
    ?>
<div id="page" class="hfeed site">
    
        <div class="header-style-1" >
    
        <?php
        
            if (sharai_khana_wp_option('header_1_toolbar_status') != '0') { 
                
                if ( isset( $sharai_khana_top_bar_status ) && $sharai_khana_top_bar_status == 1 ) {
                
            ?>
    
            <div id="toolbar" class="hidden-xs hidden-sm">
                
                <div class="container" >
                    
                    <div class="row">
                        <div class="col-md-6 col-lg-6 col-toolbar-left">
                            <div class="toolbar-left">
                                <?php
                                
                                if ( $toolbar_left = sharai_khana_wp_option('header_1_toolbar_left') ) :
                                        echo do_shortcode(wp_kses($toolbar_left, sharai_khana_allowed_tags()));
                                endif;
                                
                                ?>
                            </div> <!-- end .toolbar-left  -->
                        </div>
                        <div class="col-md-6 col-lg-6 col-toolbar-right">
                              
                                <div class="toolbar-right">
                                    <?php
                                    if ( $toolbar_right = sharai_khana_wp_option('header_1_toolbar_right') ) :
                                                echo do_shortcode(wp_kses($toolbar_right, sharai_khana_allowed_tags()));
                                    endif;
                                    ?>
                                </div> <!-- end .toolbar-right  -->				
                        </div> <!-- end .col-md-6  -->
                        
                    </div><!-- .row -->
                    
                </div> <!-- .container end-->   
                
            </div> <!-- .toolbar end-->
            
        <?php } } ?>
	
	<?php // if header is sticky or not
        
                $header_sticky_class = ' header-sticky'; 
        
	if (sharai_khana_wp_option('header_1_enable_sticky_header') == '0') {
            
                    $header_sticky_class = "";
                
                } 
        
                ?>
                    
                <?php

                    $mob_menu_left_status = sharai_khana_wp_option('mob_menu_left');

                    $mob_menu_left_class = ($mob_menu_left_status == 1 ) ? ' mob-menu-left' : '';

                ?> 
                    
                <header id="masthead" class="site-header<?php echo $mob_menu_left_class; ?>" style="padding: 0;">
                    
                <div class="container">
                    
                    <div class="row">
                        
                        <div class="col-md-4 col-sm-12 col-site-logo">
                            <div class="site-logo" >
                                <?php 
                                                                                
                                        if ((sharai_khana_wp_option('logo_type') == 'image') && (sharai_khana_wp_option('logo_image') != '')) {

                                            $header_1_logo_image_status = sharai_khana_wp_option('header-1-logo-image-status');

                                            if ( isset($header_1_logo_image_status) && $header_1_logo_image_status == 1 ) {

                                                $logo_image = sharai_khana_wp_option('header-1-logo-image', false);

                                            } else {

                                                $logo_image = sharai_khana_wp_option('logo_image', false);

                                            }

                                            if( is_array( $logo_image ) ) {

                                                $logo_image_url = $logo_image['url'];

                                            } else {

                                                $logo_image_url = $logo_image;

                                            }

                                ?>
                                    <a href="<?php echo esc_url(home_url('/')) ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" ><img class="" src="<?php echo esc_url($logo_image_url); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                                <?php } elseif ((sharai_khana_wp_option('logo_type') == 'text') && (sharai_khana_wp_option('logo_text') != '')) { ?>
                                    <a href="<?php echo esc_url(home_url('/')) ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" ><span class="site-logo-text" ><?php echo sharai_khana_wp_option('logo_text', 'sharai-khana'); ?></span></a>
                                <?php } else { ?>
                                    <a href="<?php echo esc_url(home_url('/')) ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>" ><img class="" src="<?php echo get_template_directory_uri() . '/images/logo.png'; ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>"></a>
                                <?php } ?>
                            </div> <!--  end .site-logo -->
                        </div> <!-- end .col-md-2  -->
                        <div class="col-md-8 col-sm-12 hidden-xs">
                            <div class="header-middle">
                                <div class="row">
                                    <?php
                                    if ($header_middle = sharai_khana_wp_option('header-middle')) :
                                        echo do_shortcode(wp_kses($header_middle, sharai_khana_allowed_tags()));
                                    endif;
                                    ?>
                                </div>
                            </div> <!-- end .header-middle  -->
                        </div>
                    </div><!-- .row end--> 
                    
                </div><!-- .container end-->

                <div class="navigation-container<?php echo esc_attr( $header_sticky_class );?>">	
                    <div class="container">  
                        <div class="row">
                            <div class="col-md-9 col-sm-12 col-primary-menu">
                                <?php if (has_nav_menu($sharai_khana_default_menu, 'sharai-khana')) { ?>
                                <div class="menu-sharai_khana">				
                                        <nav id="site-navigation" class="main-navigation">
                                            <button class="menu-toggle" aria-expanded="false">
                                                <span class="fa fa-align-justify"></span>
                                            </button>
                                            <?php
                                            wp_nav_menu(array(
                                                'theme_location' => $sharai_khana_default_menu,
                                                'menu_class' => $sharai_khana_default_menu_class,
                                                'container_class' => 'site_primary_menu'
                                            ));
                                            ?>
                                        </nav><!-- #site-navigation -->
                                    </div>
                                <?php } else { ?>
                                    <p class="theme-help-block text-white"><?php esc_html_e('Top Menu Location.', 'sharai-khana'); ?></p>
                                <?php } ?>
                            </div>
                            <div class="col-md-3 col-sm-12">
                                <div class="navbar-right-content">
                                    <?php
                                    if ($navbar_right = sharai_khana_wp_option('header-style-1-navbar-right')) :
                                        echo do_shortcode(wp_kses($navbar_right, sharai_khana_allowed_tags()));
                                    endif;
                                    ?>
                                </div>
                            </div>             
                        </div><!-- .row end--> 		
                    </div><!-- .container end-->
                </div><!-- .navigation-container end-->

            </header><!-- #masthead -->
            
            </div> <!-- .header-style1 end--> 
        
                <?php
                
                echo sharai_khana_breadcrumb();
                // add a extra class
                $front_page_extra_class = "";
                if (is_front_page()) {
                    $front_page_extra_class = " default-blog";
                }
            ?>
            <?php // if post has custom field called VcYes = Yes, remove padding
            if ($VcYes == 'Yes') {
                ?>
                <div id="content" class="site-content">
            <?php } else { ?>
                    <div id="content" class="site-content content-spacing container">
                <?php } ?>