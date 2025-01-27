<?php

function sharai_khana_widgets_init_home() {
    register_sidebar(array(
        'name' => esc_html__('Woocommerce Sidebar', 'sharai-khana'),
        'id' => 'sidebar-wc_custom',
        'description' => esc_html__('Sidebar Woocommerce Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Bottom Jumbo Widget', 'sharai-khana'),
        'id' => 'bottom-jumbo-widget',
        'description' => esc_html__('Bottom Jumbo Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Bottom One', 'sharai-khana'),
        'id' => 'bottom-1',
        'description' => esc_html__('Bottom One Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Bottom Two', 'sharai-khana'),
        'id' => 'bottom-2',
        'description' => esc_html__('Bottom Two Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Bottom Three', 'sharai-khana'),
        'id' => 'bottom-3',
        'description' => esc_html__('Bottom Three Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
    
    register_sidebar(array(
        'name' => esc_html__('Bottom Four', 'sharai-khana'),
        'id' => 'bottom-4',
        'description' => esc_html__('Bottom Four Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Sidebar Left', 'sharai-khana'),
        'id' => 'sidebar-left',
        'description' => esc_html__('Sidebar Left Sidebar Area', 'sharai-khana'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ));
}

add_action('widgets_init', 'sharai_khana_widgets_init_home');


//Count number of widgets in a sidebar
if ( ! function_exists( 'sharai_khana_count_widgets' ) ) :
/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function sharai_khana_count_widgets( $sidebar_id ) {
	// If loading from front page, consult $_wp_sidebars_widgets rather than options
	// to see if wp_convert_widget_settings() has made manipulations in memory.
	global $_wp_sidebars_widgets;
	if ( empty( $_wp_sidebars_widgets ) ) :
		$_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
	endif;
	
	$sidebars_widgets_count = $_wp_sidebars_widgets;
	
	if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
		$widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
		$widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
		if ( $widget_count % 7 == 0 || $widget_count > 6 ) :
			// Seven or more widgets in one row of a particular page/post 
			$widget_classes .= ' col-lg-3 col-md-3';
	    elseif ( 6 == $widget_count ) :
			// Otherwise show five widgets per row
			$widget_classes .= ' col-lg-2 col-md-2';
	    elseif ( 5 == $widget_count ) :
			// Otherwise show five widgets per row
			$widget_classes .= ' col-lg-15 col-md-15';
		elseif ( 4 == $widget_count ) :
			// Otherwise show four widgets per row
			$widget_classes .= ' col-lg-3 col-md-3';
		elseif ( 3 == $widget_count ) :
			// Otherwise show three widgets per row
			$widget_classes .= ' col-lg-4 col-md-4';
		elseif ( 2 == $widget_count ) :
			// Otherwise show two widgets per row
			$widget_classes .= ' col-lg-6 col-md-6';
		elseif ( 1 == $widget_count ) :
			// Otherwise show one widgets per row
			$widget_classes .= ' col-lg-12 col-md-12';
		endif; 

		return $widget_classes;
	endif;
}
endif;


//Count number of sidebar in the bottom
if ( ! function_exists( 'sharai_khana_count_bottom_sidebar' ) ) :
/**
 * Count number of sidebar in the bottom
 * Used to add classes to sidebar areas so sidebar can be displayed one, two, three or four per row
 */
function sharai_khana_count_bottom_sidebar() {
	
                $num_of_bottom_sidebar = (int) is_active_sidebar( 'bottom-1' ) 
                                                           + (int) is_active_sidebar( 'bottom-2' ) 
                                                           + (int) is_active_sidebar( 'bottom-3' ) 
                                                           + (int) is_active_sidebar( 'bottom-4' ); // etc.


                $sharai_khana_default_col_class = "col-md-4 col-sm-12";

                if( $num_of_bottom_sidebar > 0 ) {

                    $bottom_sidebar_custom_class = 'col-md-' . (12/$num_of_bottom_sidebar); 

                } else {

                    $bottom_sidebar_custom_class = $sharai_khana_default_col_class;

                }

	if (   is_active_sidebar( 'bottom-1' )  || is_active_sidebar( 'bottom-2' ) || is_active_sidebar( 'bottom-3' ) ) { ?>
	
	<div class="row">
	    <?php
		if ( is_active_sidebar( 'bottom-1' ) ) { ?>
		<div class="<?php echo esc_attr($bottom_sidebar_custom_class); ?>" >
			<?php dynamic_sidebar( 'bottom-1' ); ?>
		</div>
		<?php }
		
		if ( is_active_sidebar( 'bottom-2' ) ) { 	?>
		<div class="<?php echo esc_attr($bottom_sidebar_custom_class); ?>" >
			<?php dynamic_sidebar( 'bottom-2' ); ?>
		</div>
		<?php }
		
		if ( is_active_sidebar( 'bottom-3' ) ) { 	?>
		<div class="<?php echo esc_attr($bottom_sidebar_custom_class); ?>" >
			<?php dynamic_sidebar( 'bottom-3' ); ?>
		</div>
		<?php }
		
		if ( is_active_sidebar( 'bottom-4' ) ) { 	?>
		<div class="<?php echo esc_attr($bottom_sidebar_custom_class); ?>" >
			<?php dynamic_sidebar( 'bottom-4' ); ?>
		</div>
		<?php } ?>
	</div><!--bottom-->
	
	<?php }	
			
}
endif;

//Count number of sidebar in the bottom
if ( ! function_exists( 'sharai_khana_jumbo_bottom_sidebar' ) ) :
/**
 * Count number of sidebar in the bottom
 * Used to add classes to sidebar areas so sidebar can be displayed one, two, three or four per row
 */
function sharai_khana_jumbo_bottom_sidebar() {
	
$num_of_bottom_sidebar = (int) is_active_sidebar( 'bottom-jumbo-widget' ); // etc.

    //Fixed in version 1.0.1

    if( $num_of_bottom_sidebar == 0 ) {
        return '';
    }

$bottom_sidebar_custom_class = 'col-md-' . (12/$num_of_bottom_sidebar); 

	if ( is_active_sidebar( 'bottom-jumbo-widget' ) ) { ?>
	
	<div class="row">
	    <?php
				
		if ( is_active_sidebar( 'bottom-jumbo-widget' ) ) { 	?>
		<div class="<?php echo esc_attr($bottom_sidebar_custom_class); ?>" >
			<?php dynamic_sidebar( 'bottom-jumbo-widget' ); ?>
		</div>
		<?php } ?>
	</div><!--bottom-->
	
	<?php }	
			
}
endif;