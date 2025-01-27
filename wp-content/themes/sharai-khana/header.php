<?php
/**
 * The header 1 for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package sharai-khana
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="http://gmpg.org/xfn/11">
        <link rel="pingback" href="<?php esc_url( bloginfo('pingback_url') ); ?>">
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

            <?php endif;
        endif; ?>

                <?php wp_head(); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    
        <div class="header-style-default" >

        <?php 
        
            if (sharai_khana_wp_option('enable_disable_toolbar') != '0') { 
                
                if ( isset( $sharai_khana_top_bar_status ) && $sharai_khana_top_bar_status == 1 ) {
                
        ?>
    
            <div id="toolbar" class="hidden-xs hidden-sm">
                
                <div class="container" >
                    
                    <div class="row">

                        <div class=" col-toolbar-left col-lg-7 col-md-7 col-sm-12 col-xs-12">

                            <div class="toolbar-left margin-right20">

                                <?php
                                
                                    if ($toolbar_left = sharai_khana_wp_option('toolbar_left')) :

                                        echo do_shortcode(wp_kses($toolbar_left, sharai_khana_allowed_tags()));

                                    endif;
                                
                                ?>

                            </div> <!-- end .toolbar-left  -->

                        </div>


                        <div class="col-toolbar-right col-lg-3 col-md-3 col-sm-12 col-xs-12">

                                <div class="toolbar-right margin-right20">

                                    <?php

                                        if ($toolbar_right = sharai_khana_wp_option('toolbar_right')) :

                                            echo do_shortcode(wp_kses($toolbar_right, sharai_khana_allowed_tags()));

                                        endif;

                                    ?>

                                </div> <!-- end .toolbar-right  -->				

                        </div> <!-- end .col-md-3  -->
                        
                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

                                <div class="toolbar-right-button margin-right20">

                                    <?php

                                        if ($toolbar_right_button = sharai_khana_wp_option('toolbar_right_button')) :

                                            echo do_shortcode(wp_kses($toolbar_right_button, sharai_khana_allowed_tags()));

                                        endif;

                                    ?>

                                </div> <!-- end .toolbar-right  -->				

                        </div> <!-- end .col-md-3  -->                        
                        
                    </div><!-- .row -->
                    
                </div> <!-- .container end-->   
                
            </div> <!-- .toolbar end-->
            
        <?php } } ?>
	
	<?php // if header is sticky or not
                    if (sharai_khana_wp_option('enable_sticky_header') == '1') { ?>
	<header id="masthead" class="site-header header-sticky">
	<?php } else { ?>
	<header id="masthead" class="site-header header-static">
	<?php } ?>

		<div class="container">
                                                        
                                                <?php  

                                                    $mob_menu_left_status= sharai_khana_wp_option('mob_menu_left'); 

                                                    $mob_menu_left_class = ($mob_menu_left_status == 1 ) ? ' mob-menu-left' : '';

                                                ?> 
                    
			<div class="row<?php echo $mob_menu_left_class; ?>">
                            
			    <div class="col-md-3 col-sm-12 col-site-logo" style="width: 20%">
                                
                  <div class="site-logo">
    <a href="https://nudm.mohua.gov.in/" target="_blank" title="NUDM">
        <img class="" src="<?php echo site_url();?>/wp-content/uploads/2024/07/NUDM-LOGO_Transparent-Bg.png" alt="NUDM Logo"/>
    </a>
</div>
                                
                                                        
                </div> <!-- end .col-md-2  -->
                	    <div class="col-md-3 col-sm-12 col-site-logo" style="width: 20%">
                                
                   <div class="site-logo">
    <a href="https://mohua.gov.in/" target="_blank" title="MoHUA">
        <img class="" src="<?php echo site_url();?>/wp-content/uploads/2024/07/MoHUA_.png" alt="MoHUA" />
    </a>
</div>
                               
                                                        
                </div> <!-- end .col-md-2  -->
                
                	    <div class="col-md-3 col-sm-12 col-site-logo" style="width: 20%">
                                
                    <div class="site-logo">
    <a href="https://upyog.niua.org/" target="_blank" title="UPYOG">
        <img class="" src="<?php echo site_url();?>/wp-content/uploads/2024/06/upyog-6-removebg-preview.png" alt="UPYOG- Helpdesk Ticketing Tool System" style="margin-top: 10px;" />
    </a>
</div>
                              
                                                        
                </div> <!-- end .col-md-2  -->
                
                                                    <div class="col-md-3 col-sm-12 col-primary-menu" style="width: auto">
                                                        <?php if (has_nav_menu('primary', 'sharai-khana')) { ?>
                                                        
                                                            <div class="menu-sharai_khana">				
                                                                <nav id="site-navigation" class="main-navigation">
                                                                    <button class="menu-toggle" aria-expanded="false">
                                                                        <span class="fa fa-align-justify"></span>
                                                                    </button>
                                                                    <?php wp_nav_menu(array(
                                                                        'theme_location' => $sharai_khana_default_menu,
                                                                        'menu_class' => $sharai_khana_default_menu_class,
                                                                        'container_class'=> 'site_primary_menu'
                                                                        )); ?>
                                                                </nav><!-- #site-navigation -->
                                                            </div>
                                                        <?php } else { ?>
                                                            <p class="theme-help-block text-right"><?php esc_html_e('Top Menu Location.', 'sharai-khana'); ?></p>
                                                        <?php } ?>
                                                    </div>
				
		    </div><!-- .row end--> 		
		</div><!-- .container end--> 
		
	</header><!-- #masthead -->
        
                </div>
        
                <?php 
                
                    echo sharai_khana_breadcrumb();
                    
                    // add a extra class
                    
                    $front_page_extra_class = "";
                    
                    if( is_front_page() ) {
                        $front_page_extra_class = " default-blog";
                    }
                    
                
                ?>
	
	<?php // if post has custom field called VcYes = Yes, remove padding
	if ($VcYes == 'Yes') { ?>
	<div id="content" class="site-content">
	<?php } else { ?>
	<div id="content" class="site-content content-spacing container<?php echo esc_attr( $front_page_extra_class );?>">
	<?php } ?>