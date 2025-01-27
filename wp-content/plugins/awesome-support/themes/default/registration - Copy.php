<?php
/**
 * This is a built-in template file. If you need to customize it, please,
 * DO NOT modify this file directly. Instead, copy it to your theme's directory
 * and then modify the code. If you modify this file directly, your changes
 * will be overwritten during next update of the plugin.
 */

/**
 * Make the post data and the pre-form message global
 */
global $post;

$submit        = get_permalink( wpas_get_option( 'ticket_list' ) );
$registration  = wpas_get_option( 'allow_registrations', 'allow' ); // Make sure registrations are open
$redirect_to   = get_permalink( $post->ID );
$wrapper_class = 'allow' !== $registration && 'moderated' !== $registration ? 'wpas-login-only' : 'wpas-login-register';
$allow_html = [ 'label' => [ 'for' => true, ],
	'input' => [ 'type' => true, 'value' => true, 'id' => true, 'class' => true, 'name' => true, 'placeholder' => true, 'required' => true ],
	'div' => [ 'class' => true, 'id' => true, ]];
?>

<div class="wpas <?php echo esc_attr( $wrapper_class ); ?>">
	<?php do_action('wpas_before_login_form'); ?>

	<form class="wpas-form" id="wpas_form_login" method="post" role="form" action="<?php echo esc_url( wpas_get_login_url() ); ?>">
		<h3><?php esc_html_e( 'Log in', 'awesome-support' ); ?></h3>

		<?php
		/* Registrations are not allowed. */
		if ( 'disallow' === $registration ) {
			echo (wpas_get_notification_markup( 'failure', __( 'Registrations are currently not allowed.', 'awesome-support' ) ));
		}

		$username = new WPAS_Custom_Field( 'log', array(
			'name' => 'log',
			'args' => array(
				'spellcheck'    => false,
				'required'    => true,
				'field_type'  => 'text',
				'label'       => __( 'E-mail or username', 'awesome-support' ),
				'placeholder' => __( 'E-mail or username', 'awesome-support' ),
				'sanitize'    => 'sanitize_user'
			)
		) );

		$username = apply_filters( 'wpas_login_form_user_name', $username ) ;

		echo wp_kses($username->get_output(), $allow_html);

		$password = new WPAS_Custom_Field( 'pwd', array(
			'name' => 'pwd',
			'args' => array(
				'spellcheck'    => false,
				'required'    => true,
				'field_type'  => 'password',
				'label'       => __( 'Password', 'awesome-support' ),
				'placeholder' => __( 'Password', 'awesome-support' ),
				'sanitize'    => 'sanitize_text_field'
			)
		) );

		$password = apply_filters( 'wpas_login_form_password', $password ) ;

		echo wp_kses($password->get_output(), $allow_html);

		/**
		 * wpas_after_login_fields hook
		 */
		do_action( 'wpas_after_login_fields' );

		$rememberme = new WPAS_Custom_Field( 'rememberme', array(
			'name' => 'rememberme',
			'args' => array(
				'required'   => true,
				'field_type' => 'checkbox',
				'sanitize'   => 'sanitize_text_field',
				'options'    => array( '1' => __( 'Remember Me', 'awesome-support' ) ),
			)
		) );

		$rememberme = apply_filters( 'wpas_login_form_rememberme', $rememberme ) ;
		echo wp_kses($rememberme->get_output(), $allow_html);

		wpas_do_field( 'login', $redirect_to );
		wpas_make_button( __( 'Log in', 'awesome-support' ), array( 'onsubmit' => __( 'Logging In...', 'awesome-support' ) ) );
		printf( '<a href="%1$s" class="wpas-forgot-password-link">%2$s</a>', esc_url( wp_lostpassword_url( wpas_get_tickets_list_page_url() ) ), esc_html__( 'Forgot password?', 'awesome-support' ) ); ?>
	</form>

	<?php
	if ( 'allow' === $registration || 'moderated' === $registration ): ?>

		<form class="wpas-form" id="wpas_form_registration" method="post" action="<?php echo esc_url( get_permalink( $post->ID ) ); ?>">
			<h3><?php esc_html_e( 'Register', 'awesome-support' ); ?></h3>

			<?php
			$first_name_desc = wpas_get_option( 'reg_first_name_desc', '' ) ;
			$first_name = new WPAS_Custom_Field( 'first_name', array(
				'name' => 'first_name',
				'args' => array(
					'required'    => true,
					'field_type'  => 'text',
					'label'       => __( 'First Name', 'awesome-support' ),
					'placeholder' => __( 'First Name', 'awesome-support' ),
					'sanitize'    => 'sanitize_text_field',
					'desc'		  => $first_name_desc,
					'default'	  => ( isset( $_SESSION["wpas_registration_form"]["first_name"] ) && $_SESSION["wpas_registration_form"]["first_name"] ) ? $_SESSION["wpas_registration_form"]["first_name"] : ""
				)
			) );

			$first_name = apply_filters( 'wpas_registration_form_first_name', $first_name ) ;

			echo wp_kses($first_name->get_output(), $allow_html);




			$last_name_desc = wpas_get_option( 'reg_last_name_desc', '' ) ;
			$last_name = new WPAS_Custom_Field( 'last_name', array(
				'name' => 'last_name',
				'args' => array(
					'required'    => true,
					'field_type'  => 'text',
					'label'       => __( 'Last Name', 'awesome-support' ),
					'placeholder' => __( 'Last Name', 'awesome-support' ),
					'sanitize'    => 'sanitize_text_field',
					'desc'		  => $last_name_desc,
					'default'	  => ( isset( $_SESSION["wpas_registration_form"]["last_name"] ) && $_SESSION["wpas_registration_form"]["last_name"] ) ? $_SESSION["wpas_registration_form"]["last_name"] : ""
				)
			) );

			$last_name = apply_filters( 'wpas_registration_form_last_name', $last_name ) ;

			echo wp_kses($last_name->get_output(), $allow_html);
			
			
			
			

					$categories = get_terms(array(
					    'taxonomy' => 'projects', // Specify the taxonomy (e.g., 'category' for post categories)
					    'hide_empty' => false,    // Set to true to hide empty terms
					));

					// Check if there are any categories
					if (!empty($categories) && !is_wp_error($categories)) {
						echo '<div class="wpas-form-group" id="wpas_projects_wrapper">';
					    echo '<select class="wpas-form-control" name="wpas_projects" id="wpas_projects" required="">';
					     echo '<option id="Please Select Projects" value="Please Select Projects">Please Select Projects</option>';
					    
					    foreach ($categories as $category) {
					      echo '<option id='.$category->name.' value='.$category->name.'>'.$category->name.'</option>';
					
					    }
					    echo '</select>';
					    echo '<input type="hidden" name="ticket_id" value='.$post->ID.'>';
					    echo  '</div>';
					} else {
					    echo 'No Projects found.';
					}

                     
                     
                     	$categories = get_terms(array(
					    'taxonomy' => 'States', // Specify the taxonomy (e.g., 'category' for post categories)
					    'hide_empty' => false,    // Set to true to hide empty terms
					));

					// Check if there are any categories
					if (!empty($categories) && !is_wp_error($categories)) {
						echo '<div class="wpas-form-group" id="wpas_states_wrapper">';
					    echo '<select class="wpas-form-control" name="wpas_states" id="wpas_states" required="">';
					     echo '<option id="Please Select States" value="Please Select States">Please Select States</option>';
					    
					    foreach ($categories as $category) {
					      echo '<option id='.$category->name.' value='.$category->name.'>'.$category->name.'</option>';
					
					    }
					    echo '</select>';
					    echo '<input type="hidden" name="ticket_id" value='.$post->ID.'>';
					    echo  '</div>';
					} else {
					    echo 'No States found.';
					} 

				 
				 
				 wpas_add_custom_taxonomy('States', array(
    'label' => __('States', 'States'),
    'hierarchical' => true,
    'order' => 4,
    'show_ui' => true, // Make sure this is set to true
));
				
			
			    $projects = new WPAS_Custom_Field( 'custom_dropdown', array(
				'name' => 'custom_dropdown',
				'args' => array(
					'required'    => true,
					'type'  => 'select',
					'label'       => __( 'custom_dropdown', 'awesome-support' ),
					'placeholder' => __( 'custom_dropdown', 'awesome-support' ),
					'context' => array('registration'), // Where this field will be used
	              'options' => array( // Options for the select dropdown
	                'male' => __('Male', 'custom_dropdown'),
	                'female' => __('Female', 'custom_dropdown'),
	                'other' => __('Other', 'custom_dropdown')
	            ),
					'sanitize'    => 'sanitize_text_field',
					'desc'		  => $projects_desc,
					'default'	  => ( isset( $_SESSION["wpas_registration_form"]["custom_dropdown"] ) && $_SESSION["wpas_registration_form"]["custom_dropdown"] ) ? $_SESSION["wpas_registration_form"]["custom_dropdown"] : ""
				)
			) );

			$projects = apply_filters( 'wpas_registration_form_last_name', $projects ) ;

			echo wp_kses($projects->get_output(), $allow_html);
			
			
			
			
			// Step 1: Add the Select Field to the Registration Form
function custom_add_registration_fields() {
    ?>
    <p class="form-row form-group">
        <label for="gender"><?php _e('Gender', 'text-domain'); ?><span class="required">*</span></label>
        <select name="gender" id="gender" class="input">
            <option value=""><?php _e('Select Gender', 'text-domain'); ?></option>
            <option value="male"><?php _e('Male', 'text-domain'); ?></option>
            <option value="female"><?php _e('Female', 'text-domain'); ?></option>
            <option value="other"><?php _e('Other', 'text-domain'); ?></option>
        </select>
    </p>
    <?php
}
add_action('wpas_register_extra_fields', 'custom_add_registration_fields');

// Step 2: Validate and Process the Custom Field
function custom_process_registration_fields($submitted) {
    $gender = isset($submitted['gender']) ? sanitize_text_field($submitted['gender']) : '';

    if (empty($gender)) {
        wpas_errors()->add('gender_error', __('Please select a gender.', 'text-domain'));
    }

    $submitted['gender'] = $gender;
    return $submitted;
}
add_filter('wpas_process_register_fields', 'custom_process_registration_fields');

// Step 3: Save the Custom Field Data
function custom_save_registration_fields($user_id) {
    if (isset($_POST['gender'])) {
        $gender = sanitize_text_field($_POST['gender']);
        update_user_meta($user_id, 'gender', $gender);
    }
}
add_action('wpas_after_register_user', 'custom_save_registration_fields');

			
			
			
			

			$email_desc = wpas_get_option( 'reg_email_desc', '' ) ;
			$email = new WPAS_Custom_Field( 'email', array(
				'name' => 'email',
				'args' => array(
					'required'    => true,
					'spellcheck'    => false,
					'field_type'  => 'email',
					'label'       => __( 'Email', 'awesome-support' ),
					'placeholder' => __( 'Email', 'awesome-support' ),
					'sanitize'    => 'sanitize_text_field',
					'desc'		  => $email_desc,
					'default'	  => ( isset( $_SESSION["wpas_registration_form"]["email"] ) && $_SESSION["wpas_registration_form"]["email"] ) ? $_SESSION["wpas_registration_form"]["email"] : ""
				)
			) );

			$email = apply_filters( 'wpas_registration_form_email', $email ) ;

			echo wp_kses($email->get_output(), $allow_html);

			$pwd = new WPAS_Custom_Field( 'password', array(
				'name' => 'password',
				'args' => array(
					'required'    => true,
					'spellcheck'    => false,
					'field_type'  => 'password',
					'label'       => __( 'Enter a password', 'awesome-support' ),
					'placeholder' => __( 'Password', 'awesome-support' ),
					'sanitize'    => 'sanitize_text_field'
				)
			) );

			$pwd = apply_filters( 'wpas_registration_form_password', $pwd ) ;

			echo wp_kses($pwd->get_output(), $allow_html);

			$showpwd = new WPAS_Custom_Field( 'pwdshow', array(
				'name' => 'pwdshow',
				'args' => array(
					'required'   => false,
					'field_type' => 'checkbox',
					'sanitize'   => 'sanitize_text_field',
					'options'    => array( '1' => _x( 'Show Password', 'Login form', 'awesome-support' ) ),
				)
			) );

			echo wp_kses($showpwd->get_output(), $allow_html);

			/**
			 * wpas_after_registration_fields hook
			 *
			 * @Awesome_Support::terms_and_conditions_checkbox()
			 */
			do_action( 'wpas_after_registration_fields' );
			wpas_do_field( 'register', $redirect_to );
			wp_nonce_field( 'register', 'user_registration', false, true );
			wpas_make_button( __( 'Create Account', 'awesome-support' ), array( 'onsubmit' => __( 'Creating Account...', 'awesome-support' ) ) );
			?>
		</form>
	<?php endif; ?>
</div>
