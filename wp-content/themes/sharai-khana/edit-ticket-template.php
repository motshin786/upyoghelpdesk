<?php
error_reporting(0);
/* Template Name: Edit Ticket Description */
ob_start();
if (!is_user_logged_in()) {
    wp_redirect(wp_login_url());
    exit;
}

get_header();

// Get the current user
$current_user = wp_get_current_user();
$ticket_id = isset($_GET['ticket_id']) ? intval($_GET['ticket_id']) : 0;
$ticket = get_post($ticket_id);
if (!$ticket || $ticket->post_type !== 'ticket') {
    echo 'Ticket not found.';
    get_footer();
    exit;
}

 // Replace 123 with your actual post ID
$post_title = get_the_title($ticket_id);
// Replace with your actual ticket title
$post = get_page_by_title($post_title, OBJECT, 'ticket');
$post_slug = $post->post_name;
//echo "<br/>";
//$slug ='my-computer-is-not-working-kindly-check-my-computer';
///echo $custom_url = site_url().'/ticket/'.$post_slug.'/#reply-'.$ticket_id;

$custom_url = site_url().'/index.php/ticket/'.$post_slug;
//echo "<br/>";
// Check user capabilities (assuming support agents can edit tickets)
/*if (!current_user_can('edit_post', $ticket_id)) {
    echo 'You do not have permission to edit this ticket.';
    get_footer();
    exit;
} */

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ticket_description_nonce']) && wp_verify_nonce($_POST['ticket_description_nonce'], 'update_ticket_description')) {
    $new_description = sanitize_textarea_field($_POST['ticket_description']);
    wp_update_post(array(
        'ID' => $ticket_id,
        'post_content' => $new_description
    ));
   
     echo 'Ticket description updated successfully.';
     wp_redirect($custom_url);
     ob_end_flush();
    exit;
}

// Display the form
?>
<div class="edit-ticket-description-form">
    <h2>Edit Ticket Description</h2>
    <form method="POST">
        <?php wp_nonce_field('update_ticket_description', 'ticket_description_nonce'); ?>
        <p>
            <label for="ticket_description">Description:</label><br>
            <textarea id="ticket_description" name="ticket_description" rows="10" cols="50"><?php echo esc_textarea($ticket->post_content); ?></textarea>
        </p>
        <p>
            
            <button type="submit" class="wpas-btn wpas-btn-default" name="wpas-submit" value="" data-onsubmit="Please Wait...">Update Description</button>
        </p>
    </form>
</div>
<?php

get_footer();
?>
