<?php
/*
Template Name: User Profile
*/
ob_start();
get_header();
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}
// Check if the user is logged in
if ( is_user_logged_in() ) {
    // Get the current user's ID
      $user_id = get_current_user_id();
      $custom_url = site_url();
    // Get user data
    $user_data = get_userdata($user_id);

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_password'])) {
        // Verify the nonce
        if ( !isset($_POST['profile_nonce']) || !wp_verify_nonce($_POST['profile_nonce'], 'update_profile_' . $user_id) ) {
            echo '<p>Security check failed. Please try again.</p>';
        } else {
            // Get the new password from the form
            $new_password = sanitize_text_field($_POST['new_password']);

            if ( !empty($new_password) ) {
                // Update the user's password
                wp_set_password($new_password, $user_id);
                 echo '<script>alert("Password updated successfully.")</script>';
                 wp_redirect($custom_url);
    			 ob_end_flush();
    			 exit;
                
            } else {
                echo '<p>Please enter a new password.</p>';
            }
        }
    }

    ?>

    <h2>User Profile</h2>
    <p><strong>Username:</strong> <?php echo esc_html($user_data->user_login); ?></p>
    <p><strong>Email:</strong> <?php echo esc_html($user_data->user_email); ?></p>

    <form method="post" action="">
        <h3>Update Password</h3>
        <p>
            <label for="new_password">New Password:</label>
            <input type="password" name="new_password" id="new_password" required>
        </p>
        <p>
            <?php wp_nonce_field('update_profile_' . $user_id, 'profile_nonce'); ?>
            <input type="submit" name="update_password" value="Update Password">
        </p>
    </form>

    <?php
} else {
    echo '<p>You need to be logged in to view this page.</p>';
}

get_footer();
?>
