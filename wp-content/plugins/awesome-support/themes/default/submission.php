<?php
/**
 * This is a built-in template file. If you need to customize it, please,
 * DO NOT modify this file directly. Instead, copy it to your theme's directory
 * and then modify the code. If you modify this file directly, your changes
 * will be overwritten during next update of the plugin.
 */

global $post;
?>
<style>
#wpas_Other_wrapper{display: none;}
#wpas_assigned_user_wrapper{display: none;}
.wpas-form-group:nth-child(odd){width: 49%; float: left; padding: 0% 1% 1% 0%;}
.wpas-form-group:nth-child(even){width:50%;float: right;padding: 0% 1% 1% 0%;}
#wpas_files_wrapper{width: 48%;float: right;padding: 0%;margin: -330px 10px 0px 0px;}
</style>	

<div class="wpas wpas-submit-ticket">

	<?php

	wpas_get_template( 'partials/ticket-navigation' );

	do_action( 'wpas_ticket_submission_form_outside_top' );
	?>

	<form class="wpas-form" role="form" method="post" action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" id="wpas-new-ticket" enctype="multipart/form-data">

		<?php
		/**
		 * The wpas_submission_form_inside_top has to be placed
		 * inside the form, right in between the form opening tag
		 * and the first field being rendered.
		 *
		 * @since  4.4.0
		 */
		do_action( 'wpas_submission_form_inside_top' );

		/**
		 * Filter the subject field arguments
		 *
		 * @since 3.2.0
		 *
		 * Note the use of the The wpas_submission_form_inside_before
		 * action hook.  It will be placed inside the form, usually
		 * right in between the form opening tag
		 * and the subject field.
		 *
		 * However, the hook can be moved if the subject field is set
		 * to a different sort order in the custom fields array.
		 *
		 * The wpas_submission_form_inside_after_subject action
		 * hook is also declared as a post-render hook.
		 */
		$subject_args = apply_filters( 'wpas_subject_field_args', array(
			'name' => 'title',
			'args' => array(
				'required'   => true,
				'field_type' => 'text',
				'label'      => __( 'Ticket Name', 'awesome-support' ),
				'sanitize'   => 'sanitize_text_field',
				'order'		 => '29',
				'pre_render_action_hook_fe'		=> 'wpas_submission_form_inside_before_subject',
				'post_render_action_hook_fe'	=> 'wpas_submission_form_inside_after_subject',
			)
		) );

		wpas_add_custom_field($subject_args['name'], $subject_args['args']);

		/**
		 * Filter the description field arguments
		 *
		 * @since 3.2.0
		 */
		$body_args = apply_filters( 'wpas_description_field_args', array(
			'name' => 'message',
			'args' => array(
				'required'   => true,
				'field_type' => 'wysiwyg',
				'label'      => __( 'Ticket Description', 'awesome-support' ),
				'sanitize'   => 'sanitize_text_field',
				'order'		 => '30',
				'pre_render_action_hook_fe'		=> 'wpas_submission_form_inside_before_description',
				'post_render_action_hook_fe'	=> 'wpas_submission_form_inside_after_description',
			)
		) );

		wpas_add_custom_field($body_args['name'], $body_args['args']);

		/**
		 * Declare an action hook just before rendering all the fields...
		 */
		do_action( 'wpas_submission_form_pre_render_fields' );

		/* All custom fields have been declared so render them all */
		WPAS()->custom_fields->submission_form_fields();

		/**
		 * Declare an action hook just after rendering all the fields...
		 */
		do_action( 'wpas_submission_form_post_render_fields' );


		/**
		 * The wpas_submission_form_inside_before hook has to be placed
		 * right before the submission button.
		 *
		 * @since  3.0.0
		 */
		do_action( 'wpas_submission_form_inside_before_submit' );

		wp_nonce_field( 'new_ticket', 'wpas_nonce', true, true );
		wpas_make_button( __( 'Submit ticket', 'awesome-support' ), array( 'name' => 'wpas-submit' ) );

		/**
		 * The wpas_submission_form_inside_before hook has to be placed
		 * right before the form closing tag.
		 *
		 * @since  3.0.0
		 */
		do_action( 'wpas_submission_form_inside_after' );
		wpas_do_field( 'submit_new_ticket' );
		?>
	</form>
</div>

  <script>
  // Get references to the dropdown and textbox
  var dropdown = document.getElementById("wpas_department");
  var textbox = document.getElementById("wpas_Other_wrapper");

  // Add event listener to the dropdown
  dropdown.addEventListener("change", function() {
    // Check if the selected value is option3
    if (dropdown.value === "150") {
      // If option3 is selected, show the textbox
    
      textbox.style.display = "block";
       document.getElementById("wpas_files_wrapper").style.width = "47%";
       document.getElementById("wpas_files_wrapper").style.cssFloat = "left";
        document.getElementById("wpas_files_wrapper").style.margin = "-250px 0px 0px 15px";
    
   
       
    } else {
      // Otherwise, hide the textbox
      textbox.style.display = "none";
       document.getElementById("wpas_files_wrapper").style.width = "48%";
       document.getElementById("wpas_files_wrapper").style.cssFloat = "right";
        document.getElementById("wpas_files_wrapper").style.margin = "-330px 35px 0px 0px";
      
    }
  });
</script> 
