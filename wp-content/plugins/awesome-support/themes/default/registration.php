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
<style>
	#wpas_form_login {
  border-right: 1px solid #ccc;
  height: 400px;
}
</style>
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
		printf( '<a href="%1$s" class="wpas-forgot-password-link wpas-btn wpas-btn-default">%2$s</a>', esc_url( wp_lostpassword_url( wpas_get_tickets_list_page_url() ) ), esc_html__( 'Forgot password?', 'awesome-support' ) ); ?>
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
					 'required'    => true, // Make the field optional
                     'spellcheck'  => false,
					'field_type'  => 'text',
					'label'       => __( 'Last Name', 'awesome-support' ),
					'placeholder' => __( 'Last Name', 'awesome-support' ),
					'sanitize'    => 'sanitize_text_field',
					'desc'		  => $last_name_desc,
					 'default'     => isset($_SESSION["wpas_registration_form"]["last_name"]) ? $_SESSION["wpas_registration_form"]["last_name"] : ""
				)
			) );

			$last_name = apply_filters( 'wpas_registration_form_last_name', $last_name ) ;

			echo wp_kses($last_name->get_output(), $allow_html); 
			
			
					$dropdown_desc = wpas_get_option('reg_dropdown_desc', '');

// Define the dropdown field
$dropdown = new WPAS_Custom_Field('dropdown', array(
    'name' => 'dropdown',
    'args' => array(
        'required' => true,
        'field_type' => 'select',
        'label' => __('Select Option', 'awesome-support'),
        'placeholder' => __('Select an option', 'awesome-support'),
        'sanitize' => 'sanitize_text_field',
		 'options' => array(
            '' => __('Select an States/Empanelled/Team', 'awesome-support'),
            'States' => __('States', 'awesome-support'),
            'Empanelled' => __('Empanelled', 'awesome-support'),
            'Team' => __('Team', 'awesome-support'), // Add this line
        ),
        'desc' => $dropdown_desc,
        'default' => isset($_SESSION["wpas_registration_form"]["dropdown"]) ? $_SESSION["wpas_registration_form"]["dropdown"] : "",
    )
));

// Output the dropdown
echo $dropdown->get_output();
?>

<!-- Additional Dropdown for States -->
<div id="states-dropdown-wrapper" style="display:none;margin-bottom: 20px;">
     <select id="states-dropdown" name="states_dropdown" class="wpas-form-control">
        <option value=""><?php _e('Select a States', 'awesome-support'); ?></option>
        <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
		<option value="Andhra Pradesh">Andhra Pradesh</option>
		<option value="Arunachal Pradesh">Arunachal Pradesh</option>
		<option value="Assam">Assam</option>
		<option value="Bihar">Bihar</option>
		<option value="Chandigarh">Chandigarh</option>
		<option value="Chhattisgarh">Chhattisgarh</option>
		<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
		<option value="Daman and Diu">Daman and Diu</option>
		<option value="Delhi/NCR">Delhi/NCR</option>
		<option value="Goa">Goa</option>
		<option value="Gujarat">Gujarat</option>
		<option value="Haryana">Haryana</option>
		<option value="Himachal Pradesh">Himachal Pradesh</option>
		<option value="Jammu and Kashmir">Jammu and Kashmir</option>
		<option value="Jharkhand">Jharkhand</option>
		<option value="Karnataka">Karnataka</option>
		<option value="Kerala">Kerala</option>
		<option value="Ladakh">Ladakh</option>
		<option value="Lakshadweep">Lakshadweep</option>
		<option value="Madhya Pradesh">Madhya Pradesh</option>
		<option value="Maharashtra">Maharashtra</option>
		<option value="Manipur">Manipur</option>
		<option value="Meghalaya">Meghalaya</option>
		<option value="Mizoram">Mizoram</option>
		<option value="Nagaland">Nagaland</option>
		<option value="Odisha">Odisha</option>
		<option value="Puducherry">Puducherry</option>
		<option value="Punjab">Punjab</option>
		<option value="Rajasthan">Rajasthan</option>
		<option value="Sikkim">Sikkim</option>
		<option value="Tamil Nadu">Tamil Nadu</option>
		<option value="Telangana">Telangana</option>
		<option value="Tripura">Tripura</option>
		<option value="Uttar Pradesh">Uttar Pradesh</option>
		<option value="Uttarakhand">Uttarakhand</option>
		<option value="West Bengal">West Bengal</option>
</select>
</div>

<!-- Additional Dropdown for Empanelled -->
<div id="empanelled-dropdown-wrapper" style="display:none;margin-bottom: 20px;">
      <select id="empanelled-dropdown" name="empanelled_dropdown" class="wpas-form-control">
     <option value=""><?php _e('Select a Empanelled Agency', 'awesome-support'); ?></option>
     <option value="ABM Knowledgeware Ltd">ABM Knowledgeware Ltd</option>
	<option value="Aeon Software Pvt. Ltd">Aeon Software Pvt. Ltd</option>
	<option value="Access Infotech (P) Limited">Access Infotech (P) Limited</option>
	<option value="Amnex Infotechnologies Pvt. Ltd.">Amnex Infotechnologies Pvt. Ltd.</option>
	<option value="Aptex Techlogica Pvt Ltd">Aptex Techlogica Pvt Ltd</option>
	<option value="Arahas Technologies Private Limited">Arahas Technologies Private Limited</option>
	<option value="ASCENTech Information Technology Pvt. Ltd">ASCENTech Information Technology Pvt. Ltd</option>
	<option value="Bosch Global Software Technologies Private Limited">Bosch Global Software Technologies Private Limited</option>
	<option value="Bahwan CyberTek">Bahwan CyberTek</option>
	<option value="BDO India LLP">BDO India LLP</option>
	<option value="Bharat Electronics Limited">Bharat Electronics Limited</option>
	<option value="C.E. Info Systems Limited">C.E. Info Systems Limited</option>
	<option value="Civic Data Lab Private Limited">Civic Data Lab Private Limited</option>
	<option value="Cubastion Consulting Private Limited">Cubastion Consulting Private Limited</option>
	<option value="Comtech Info Solutions Pvt. Ltd">Comtech Info Solutions Pvt. Ltd</option>
	<option value="Deloitte Touche Tohmatsu India LLP">Deloitte Touche Tohmatsu India LLP</option>
	<option value="Entit Consultancy Services Pvt. Ltd.">Entit Consultancy Services Pvt. Ltd.</option>
	<option value="Ernst & Young LLP">Ernst & Young LLP</option>
	<option value="ESDS Software Solutions Ltd">ESDS Software Solutions Ltd</option>
	<option value="Fluentgrid Limited">Fluentgrid Limited</option>
	<option value="Globtier Infotech Private Limited">Globtier Infotech Private Limited</option>
	<option value="Gaia Smart Cities Solutions Pvt. Ltd.">Gaia Smart Cities Solutions Pvt. Ltd.</option>
	<option value="Genisys Information Systems (India) Private Limited">Genisys Information Systems (India) Private Limited</option>
	<option value="Grant Thornton Bharat LLP">Grant Thornton Bharat LLP</option>
	<option value="Highbar Technocrat Limited">Highbar Technocrat Limited</option>
	<option value="ICT Infracon LLP">ICT Infracon LLP</option>
	<option value="Indicsoft Technologies Pvt. Ltd.">Indicsoft Technologies Pvt. Ltd.</option>
	<option value="Puducherry">Innowave IT Infrastructures Limited</option>
	<option value="Intense Technologies Limited">Intense Technologies Limited</option>
	<option value="Infinite Computer Solutions India Limited">Infinite Computer Solutions India Limited</option>
	<option value="3i Infotech Limited">3i Infotech Limited</option>
	<option value="Information Kerala Mission">Information Kerala Mission</option>
	<option value="JMK Infosoft Solutions Ltd">JMK Infosoft Solutions Ltd</option>
	<option value="KPMG Advisory Services Private Limited">KPMG Advisory Services Private Limited</option>
	<option value="L&T Technology Services Limited">L&T Technology Services Limited</option>
	<option value="Medhaj Techno Concept Private Limited">Medhaj Techno Concept Private Limited</option>
	<option value="Margsoft Technologies Private Limited">Margsoft Technologies Private Limited</option>
	<option value="MLogica Computech (India) Pvt. Ltd">MLogica Computech (India) Pvt. Ltd</option>
	<option value="NeoSOFT Private Limited">NeoSOFT Private Limited</option>
	<option value="NeoGeoInfo Technologies Private Limited">NeoGeoInfo Technologies Private Limited</option>
	<option value="NBCC (India) Limited ">NBCC (India) Limited </option>
	<option value="NANGIA & CO LLP">NANGIA & CO LLP</option>
	<option value="NITCON Ltd">NITCON Ltd</option>
	<option value="Outworks Solutions Pvt. Ltd">Outworks Solutions Pvt. Ltd</option>
	<option value="Oasys Cybernetics Pvt. Ltd">Oasys Cybernetics Pvt. Ltd</option>
	<option value="Parity InfoTech Solutions Pvt. Ltd">Parity InfoTech Solutions Pvt. Ltd</option>
	<option value="PricewaterhouseCoopers Private Limited">PricewaterhouseCoopers Private Limited</option>
	<option value="Probity Software Private Limited">Probity Software Private Limited</option>
	<option value="RAH Infotech Pvt. Ltd.">RAH Infotech Pvt. Ltd.</option>
	<option value="RV Solutions Pvt. Ltd.">RV Solutions Pvt. Ltd.</option>
	<option value="Sumeru Software Solutions Private Limited">Sumeru Software Solutions Private Limited</option>
	<option value="Sparrow Softech Private Ltd.">Sparrow Softech Private Ltd.</option>
	<option value="Syook (Sparkyo Technology Private Limited)">Syook (Sparkyo Technology Private Limited)</option>
	<option value="SECON Pvt. Ltd">SECON Pvt. Ltd.</option>
	<option value="Sumato Globaltech Pvt. Ltd">Sumato Globaltech Pvt. Ltd</option>
	<option value="SRIT India Pvt. Ltd">SRIT India Pvt. Ltd</option>
	<option value="Tattva Foundation">Tattva Foundation</option>
	<option value="Techinfy Solutions Private Limited">Techinfy Solutions Private Limited</option>
	<option value="Telecommunications Consultants India Limited">Telecommunications Consultants India Limited</option>
	<option value="Trisys IT Services Private Limited">Trisys IT Services Private Limited</option>
	<option value="Trigyn Technologies Limited">Trigyn Technologies Limited</option>
	<option value="TCG Digital Solutions Private Ltd">TCG Digital Solutions Private Ltd</option>
	<option value="Ubuntu & Orenda Pvt. Ltd">Ubuntu & Orenda Pvt. Ltd</option>
	<option value="Udyat Smart Solutions Pvt. Ltd">Udyat Smart Solutions Pvt. Ltd</option>
	<option value="Uneecops Technologies Limited">Uneecops Technologies Limited</option>
	<option value="Velocis Systems Pvt. Ltd">Velocis Systems Pvt. Ltd</option>
	<option value="Vassar Labs IT Solutions Pvt. Ltd">Vassar Labs IT Solutions Pvt. Ltd</option>
	<option value="XtraNet Technologies Private Limited">XtraNet Technologies Private Limited</option>
    </select>
</div>

<!-- Additional Dropdown for NIUA Team -->
<div id="niua-team-dropdown-wrapper" style="display:none; margin-bottom: 20px;">
    <select id="niua-team-dropdown" name="niua_team_dropdown" class="wpas-form-control">
        <option value=""><?php _e('Select a Team', 'awesome-support'); ?></option>
        <option value="NIUA-Team">NIUA-Team</option>
        <option value="PWC">PWC</option>
    </select>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const dropdown = document.querySelector('[name="wpas_dropdown"]'); // Main dropdown
    const statesDropdownWrapper = document.getElementById('states-dropdown-wrapper');
    const empanelledDropdownWrapper = document.getElementById('empanelled-dropdown-wrapper');
    const niuaTeamDropdownWrapper = document.getElementById('niua-team-dropdown-wrapper'); // New NIUA-Team wrapper

    const statesDropdown = document.getElementById('states-dropdown');
    const empanelledDropdown = document.getElementById('empanelled-dropdown');
    const niuaTeamDropdown = document.getElementById('niua-team-dropdown'); // New NIUA-Team dropdown

    if (dropdown) {
        toggleDropdowns(dropdown.value);
        dropdown.addEventListener('change', function() {
            toggleDropdowns(dropdown.value);
        });
    }

    function toggleDropdowns(value) {
        if (value === 'States') {
            statesDropdownWrapper.style.display = 'block';
            empanelledDropdownWrapper.style.display = 'none';
            niuaTeamDropdownWrapper.style.display = 'none';
            statesDropdown.setAttribute('required', 'required');
            empanelledDropdown.removeAttribute('required');
            niuaTeamDropdown.removeAttribute('required');
        } else if (value === 'Empanelled') {
            empanelledDropdownWrapper.style.display = 'block';
            statesDropdownWrapper.style.display = 'none';
            niuaTeamDropdownWrapper.style.display = 'none';
            empanelledDropdown.setAttribute('required', 'required');
            statesDropdown.removeAttribute('required');
            niuaTeamDropdown.removeAttribute('required');
        } else if (value === 'Team') {
            niuaTeamDropdownWrapper.style.display = 'block'; // Show NIUA-Team
            statesDropdownWrapper.style.display = 'none';
            empanelledDropdownWrapper.style.display = 'none';
            niuaTeamDropdown.setAttribute('required', 'required');
            statesDropdown.removeAttribute('required');
            empanelledDropdown.removeAttribute('required');
        } else {
            statesDropdownWrapper.style.display = 'none';
            empanelledDropdownWrapper.style.display = 'none';
            niuaTeamDropdownWrapper.style.display = 'none';
            statesDropdown.removeAttribute('required');
            empanelledDropdown.removeAttribute('required');
            niuaTeamDropdown.removeAttribute('required');
        }
    }
});

</script>
<?php
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
