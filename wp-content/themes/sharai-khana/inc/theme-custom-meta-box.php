<?php
/**
 * Custom functions for metabox
 *
 * @package sharai_khana
 */

 
/**
 * function to return a custom field value.
 */
function sharai_khana_get_custom_field($value) {
    global $post;
    
    $custom_field = get_post_meta($post->ID, $value, true);
    if (!empty($custom_field))
        return is_array($custom_field) ? stripslashes_deep($custom_field) : stripslashes(wp_kses_decode_entities($custom_field));

    return false;
}

/**
 * Register the Meta box
 */
function sharai_khana_add_custom_meta_box() {
    add_meta_box('sharai-khana-meta-box', esc_html__('Post Layout Settings', 'sharai-khana'), 'sharai_khana_meta_box_output', 'post', 'side', 'high');
    add_meta_box('sharai-khana-meta-box', esc_html__('Page Layout Settings', 'sharai-khana'), 'sharai_khana_meta_box_output', 'page', 'side', 'high');
}

add_action('add_meta_boxes', 'sharai_khana_add_custom_meta_box');

/**
 * Output the Meta box
 */
function sharai_khana_meta_box_output( $post ) {

        // create a nonce field
        wp_nonce_field( 'my_sharai_khana_meta_box_nonce', 'sharai_khana_meta_box_nonce' ); 
            
                $sharai_khana_page_header_val = get_post_meta($post->ID, esc_attr( SHARAI_KHANA_CMB_PREFIX . 'page_header'), true);
                
                $sharai_khana_page_header_status = ( $sharai_khana_page_header_val == "" ) ? 1 : $sharai_khana_page_header_val;
            
            ?>

            <p class="post-attributes-label-wrapper">
                <label for="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_header'); ?>"  class="post-attributes-label"><?php esc_html_e('Display Page Header?', 'sharai-khana') ?></label>
                <select name="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_header'); ?>" class="widefat">
                    <option value="1" <?php echo ( isset($sharai_khana_page_header_status) && ($sharai_khana_page_header_status == 1) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'sharai-khana') ?></option>
                    <option value="0" <?php echo ( isset($sharai_khana_page_header_status) && ($sharai_khana_page_header_status == 0) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('No', 'sharai-khana') ?></option>
                </select>
            </p>
            
            
        
        <?php 
        
            if( get_post_type() == "page") : 
                
                 // Fetch Page Header Top Bar Display Status
                
                $sharai_khana_top_bar_val = get_post_meta($post->ID, 'sharai-khana-top-bar-status', true);

                $sharai_khana_top_bar_status = ( $sharai_khana_top_bar_val == "" ) ? 1 : $sharai_khana_top_bar_val;

                // Fetch Page One Page Menu Display Status

                $sharai_khana_one_page_menu_val = get_post_meta($post->ID, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status'), true);
                $sharai_khana_one_page_menu_status = ( $sharai_khana_one_page_menu_val == "" ) ? 0 : $sharai_khana_one_page_menu_val;

                // Fetch Page Footer Display Status

                $sharai_khana_page_footer_val = get_post_meta($post->ID, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status'), true);
                $sharai_khana_page_footer_status = ( $sharai_khana_page_footer_val == "" ) ? 1 : $sharai_khana_page_footer_val;
                
        ?>

            <p class="post-attributes-label-wrapper">
                <label for="visual-composer-page" class="post-attributes-label"><?php esc_html_e('WPBakery Page Builder Page?', 'sharai-khana') ?></label>
            </p>
                <select name="visual-composer-page" class="widefat">
                    <option value="No" <?php if (sharai_khana_get_custom_field('visual-composer-page')) selected(sharai_khana_get_custom_field('visual-composer-page'), 'No'); ?>><?php esc_html_e('No', 'sharai-khana') ?></option>
                    <option value="Yes" <?php if (sharai_khana_get_custom_field('visual-composer-page')) selected(sharai_khana_get_custom_field('visual-composer-page'), 'Yes'); ?>><?php esc_html_e('Yes', 'sharai-khana') ?></option>
                </select>
            
            <p class="post-attributes-label-wrapper">
                <label for="sharai-khana-top-bar-status" class="post-attributes-label"><?php esc_html_e('Header Tool Bar Status', 'sharai-khana') ?></label>
            </p>
            <select name="sharai-khana-top-bar-status" class="widefat">
                <option value="1" <?php echo ( isset($sharai_khana_top_bar_status) && ($sharai_khana_top_bar_status == 1) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('Show', 'sharai-khana') ?></option>
                <option value="0" <?php echo ( isset($sharai_khana_top_bar_status) && ($sharai_khana_top_bar_status == 0) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('Hide', 'sharai-khana') ?></option>
            </select> 


            <p class="post-attributes-label-wrapper">
                <label for="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status'); ?>" class="post-attributes-label"><?php esc_html_e('Enable One Page Menu?', 'sharai-khana') ?></label>
            </p>

            <select name="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status'); ?>" class="widefat">
                <option value="0" <?php echo ( isset($sharai_khana_one_page_menu_status) && ($sharai_khana_one_page_menu_status == 0) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('No', 'sharai-khana') ?></option>
                <option value="1" <?php echo ( isset($sharai_khana_one_page_menu_status) && ($sharai_khana_one_page_menu_status == 1) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'sharai-khana') ?></option>
            </select>
            
            <p class="post-attributes-label-wrapper">
                <label for="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status'); ?>" class="post-attributes-label"><?php esc_html_e('Display Page Footer?', 'sharai-khana') ?></label>
            </p>

            <select name="<?php echo esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status'); ?>" class="widefat">
                <option value="1" <?php echo ( isset($sharai_khana_page_footer_status) && ($sharai_khana_page_footer_status == 1) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('Yes', 'sharai-khana') ?></option>
                <option value="0" <?php echo ( isset($sharai_khana_page_footer_status) && ($sharai_khana_page_footer_status == 0) ) ? 'selected="selected"' : ''; ?>><?php esc_html_e('No', 'sharai-khana') ?></option>
            </select>

        <?php else : ?>

                <p class="post-attributes-label-wrapper" class="widefat">
                    <label for="post-sidebar-control"><?php esc_html_e('Post Sidebar', 'sharai-khana') ?></label>
                </p>

                <select name="post-sidebar-control" class="widefat">
                    <option value="Right Sidebar" <?php if (sharai_khana_get_custom_field('post-sidebar-control')) selected(sharai_khana_get_custom_field('post-sidebar-control'), 'Right Sidebar'); ?>><?php esc_html_e('Right Sidebar', 'sharai-khana') ?></option>
                    <option value="Without Sidebar" <?php if (sharai_khana_get_custom_field('post-sidebar-control')) selected(sharai_khana_get_custom_field('post-sidebar-control'), 'Without Sidebar'); ?>><?php esc_html_e('No Sidebar', 'sharai-khana') ?></option>
                </select>

                <p class="post-attributes-label-wrapper" class="widefat">
                    <label for="post-thumbnail-control"><?php esc_html_e('Post Thumbnail', 'sharai-khana') ?></label>
                </p>

                <select name="post-thumbnail-control" class="widefat">
                    <option value="Show" <?php if (sharai_khana_get_custom_field('post-thumbnail-control')) selected(sharai_khana_get_custom_field('post-thumbnail-control'), 'Show'); ?>><?php esc_html_e('Show', 'sharai-khana') ?></option>
                    <option value="Hide" <?php if (sharai_khana_get_custom_field('post-thumbnail-control')) selected(sharai_khana_get_custom_field('post-thumbnail-control'), 'Hide'); ?>><?php esc_html_e('Hide', 'sharai-khana') ?></option>
                </select>

                <p class="post-attributes-label-wrapper">
                    <label for="post-title-control"><?php esc_html_e('Post Title', 'sharai-khana') ?></label>
                </p>

                <select name="post-title-control" class="widefat">
                    <option value="Show" <?php if (sharai_khana_get_custom_field('post-title-control')) selected(sharai_khana_get_custom_field('post-title-control'), 'Show'); ?>><?php esc_html_e('Show', 'sharai-khana') ?></option>
                    <option value="Hide" <?php if (sharai_khana_get_custom_field('post-title-control')) selected(sharai_khana_get_custom_field('post-title-control'), 'Hide'); ?>><?php esc_html_e('Hide', 'sharai-khana') ?></option>
                </select>

                <p class="post-attributes-label-wrapper" class="widefat">
                    <label for="post-meta-control"><?php esc_html_e('Post Meta', 'sharai-khana') ?></label>
                </p>

                <select name="post-meta-control" class="widefat">
                    <option value="Show" <?php if (sharai_khana_get_custom_field('post-meta-control')) selected(sharai_khana_get_custom_field('post-meta-control'), 'Show'); ?>><?php esc_html_e('Show', 'sharai-khana') ?></option>
                    <option value="Hide" <?php if (sharai_khana_get_custom_field('post-meta-control')) selected(sharai_khana_get_custom_field('post-meta-control'), 'Hide'); ?>><?php esc_html_e('Hide', 'sharai-khana') ?></option>
                </select>

        <?php 

        endif; 
}


/**
 * Save the Meta box values
 */
function sharai_khana_meta_box_save( $post_id ) {

	// Stop the script when doing autosave
	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

	// Verify the nonce. If insn't there, stop the script
	if( !isset( $_POST['sharai_khana_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['sharai_khana_meta_box_nonce'], 'my_sharai_khana_meta_box_nonce' ) ) return;

	// Stop the script if the user does not have edit permissions
	if( !current_user_can( 'edit_post', get_the_id() ) ) return;

                // Save the Display Page Header
                if (isset($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_header')]))
                        update_post_meta($post_id, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_header'), esc_attr($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_header')]));
                
                // Save the One Page Menu Display Status
                if (isset($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status')]))
                    update_post_meta($post_id, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status'), esc_attr($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'one_page_menu_status')]));
                
                // Save the Display Page Footer
                if (isset($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status')]))
                    update_post_meta($post_id, esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status'), esc_attr($_POST[esc_attr(SHARAI_KHANA_CMB_PREFIX . 'page_footer_status')]));
	
	// Save the Sidebar Display
	if( isset( $_POST['post-sidebar-control'] ) )
		update_post_meta( $post_id, 'post-sidebar-control', esc_attr( $_POST['post-sidebar-control'] ) );
	
	// Save the Post Thumbnail Display
	if( isset( $_POST['post-thumbnail-control'] ) )
		update_post_meta( $post_id, 'post-thumbnail-control', esc_attr( $_POST['post-thumbnail-control'] ) );
	
	// Save the Post Title Display
	if( isset( $_POST['post-title-control'] ) )
		update_post_meta( $post_id, 'post-title-control', esc_attr( $_POST['post-title-control'] ) );
	
	// Save the Post Meta Display
	if( isset( $_POST['post-meta-control'] ) )
		update_post_meta( $post_id, 'post-meta-control', esc_attr( $_POST['post-meta-control'] ) );
        
                // Save the WPBakery Page Builder Display 
                if (isset($_POST['visual-composer-page']))
                    update_post_meta($post_id, 'visual-composer-page', esc_attr($_POST['visual-composer-page']));
    
                // Save the Top Bar Display 
                if (isset($_POST['sharai-khana-top-bar-status']))
                    update_post_meta($post_id, 'sharai-khana-top-bar-status', esc_attr($_POST['sharai-khana-top-bar-status']));
                
                // Save the WPBakery Page Builder Display 
                if (isset($_POST['page-menu-style']))
                    update_post_meta($post_id, 'page-menu-style', esc_attr($_POST['page-menu-style']));
	
	

}

add_action( 'save_post', 'sharai_khana_meta_box_save' );