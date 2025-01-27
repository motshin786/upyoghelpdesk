<?php
/**
 * Ticket Details Template.
 *
 * This is a built-in template file. If you need to customize it, please,
 * DO NOT modify this file directly. Instead, copy it to your theme's directory
 * and then modify the code. If you modify this file directly, your changes
 * will be overwritten during next update of the plugin.
 */

/* Exit if accessed directly */
if( !defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * @var $post WP_Post
 */
global $post;

//echo "<pre>";
//print_r($post);
//echo "</pre>";


//echo $post->post_title;

/* Get author meta */
$author = get_user_by( 'id', $post->post_author );
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.main{width: 100%;display: block; height: auto; margin: 0 auto;padding: 0 auto;}	
.mainleft{width: 30%;display: block; height: auto; margin: 0;padding: 0 auto;float: left;}	
.mainright{width: 65%;display: block; height: auto; margin:10px;padding:0 auto;float: left;}	
.sharai_khana-breadcrumb-container {display: none;}
.content-spacing {padding-top: 20px; padding-bottom: 0px;}
.wpas-reply-attachements {
    background-color: #efefef;
    padding: 0px;
    margin-top: 0px;
    border-top-color: #ddd;
}

iframe#wpas-reply-wysiwyg_ifr {
    height: 100px !important;
}


</style>
<div class="wpas wpas-ticket-details">
<?php wpas_get_template( 'partials/ticket-navigation' ); ?>
<div class="mk" style="width:100%;margin-bottom: -35px;">
<table width="100%">
<tr>
<td width="75%" align="left"  style="margin: 0; padding:0px">
<table><tr><td width="15%" align="left" style="margin: 0; padding: 5px"><h6 style="float: left;"><span class="wpas-label wpas-label-status" style="background-color:#a01497;text-align: left;">Ticket Name</span> :</h6></td><td width="85%" align="right"  style="margin: 0; padding:5px"><div style="width: 100%;float:left"><h6 style="float: left;"><span class="wpas-label wpas-label-status" style="color: #dd3333;font-size: 15px;text-align: left;"><?php echo $post->post_title; ;?></span></h6>
</div></td></tr><tr><td width="15%" align="left" style="margin: 0; padding: 5px"><h6 style="float: left;"><span class="wpas-label wpas-label-status" style="background-color:#7caf77;text-align: left;">Description</span> :</h6></td><td align="left" style="margin: 0; padding:5px;width: 85%;"><div style="width: 100%;float:left;text-align: left; font-weight: bold;"><?php echo $post->post_content;?>&nbsp;<a 
href="<?php echo site_url();?>/index.php/edit-ticket-description/?ticket_id=<?php echo $post->ID;?>"><i class="fa fa-edit" style="font-size:25px;color:red"></i></a>
</div></td></tr></table>
</td>
<td width="25%" align="left" style="margin: 0; padding: 0px">
<table><tr><td width="30%" align="left"  style="margin: 0; padding:2px"><h6 style="float: left;"> <span class="wpas-label wpas-label-status" style="background-color:#dda756;">Assignee</span> :</h6> </td><td width="70%" align="left"  style="margin: 0; padding: 5px"><h6 style="float: left;"><span class="wpas-label wpas-label-status" style="color: #000;font-size: 15px;">
   		<?php   $current_user = wp_get_current_user();
		        $username = $current_user->display_name;
   		  		$ticket_id = get_the_ID();
				$assigned_agent_id = get_post_meta($ticket_id, '_wpas_assignee', true);
				if ($assigned_agent_id) {
				    $agent = get_userdata($assigned_agent_id);
				    $agent_name = $agent->display_name;
				} else {
				    $agent_name = __('Super-admin', 'text-domain');
				}
			    
			   echo esc_html($agent_name);
   		 
   		 
   		 ?></span></h6></td></tr><tr><td width="30%" align="left"  style="margin: 0; padding:2px"><h6 style="float: left;"> <span class="wpas-label wpas-label-status" style="background-color:#1e73be;">Reporter</span> :</h6> </td><td width="70%" align="left"  style="margin: 0; padding: 5px"><h6 style="float: left;"><span class="wpas-label wpas-label-status" style="color: #000;font-size: 15px;"><?php echo wp_kses_post(apply_filters('wpas_fe_template_detail_author_display_name', $author->data->display_name, $post )); ?></span></h6></td></tr></table>
</td>

</tr>
</table> 
</div>
<?php
	/**
	 * Display the table header containing the tickets details.
	 * By default, the header will contain ticket status, ID, priority, type and tags (if any).
	 */
	wpas_ticket_header(array(
		'container' => 'div',
		'container_class' => 'wpas-table-responsive'
	));
	?>
<div class="main">
<div class="mainleft">
<table id="header-ticket-4025" class="wpas-table wpas-ticket-details-header myInput">
<thead>
<tr><th colspan="2">Chat With Attachment</th></tr>
</thead>
<tbody>
<tr><td width="50%"> <strong class="wpas-profilename"><?php echo wp_kses_post(apply_filters('wpas_fe_template_detail_author_display_name', $author->data->display_name, $post )); ?></strong>
<p style="text-align: center; margin-bottom: 0px !important;"><?php echo $post->post_content; ;?></p>
<p style="text-align: center; margin-bottom: 0px !important;"><time class="wpas-timestamp" datetime="<?php echo wp_kses_post(get_the_date( 'Y-m-d\TH:i:s' ) . wpas_get_offset_html5()); ?>">
								<span class="wpas-human-date"><?php echo wp_kses_post(get_the_date( get_option( 'date_format' ) . ' ' . get_option( 'time_format' ), $post->ID )); ?></span>
								<span class="wpas-date-ago"><?php printf( esc_html__( '%s ago', 'awesome-support' ), wp_kses_post(human_time_diff( get_the_time( 'U', $post->ID ), current_time( 'timestamp' ) )) ); ?></span>
							</time></p></td>
						
<td>
<?php
					/**
					 * wpas_frontend_ticket_content_before hook
					 *
					 * @since  3.0.0
					 */
					do_action( 'wpas_frontend_ticket_content_before', $post->ID, $post );
					
					/* Process missing html tag when pull content from email for ticket and ticket reply 11-5447420 */
					///$post->post_content = force_balance_tags( $post->post_content );
					
					/**
					 * Display the original ticket's content
					 */
					//echo '<div class="wpas-reply-content wpas-break-words">' .  make_clickable( apply_filters( 'the_content', $post->post_content ) ) . '</div>';

					/**
					 * wpas_frontend_ticket_content_after hook
					 *
					 * @since  3.0.0
					 */
					do_action( 'wpas_frontend_ticket_content_after', $post->ID, $post );
					?>	
</td>							
</tr>
<tr>
<td>
<?php
			// Set the number of replies
			$replies_per_page  = wpas_get_option( 'replies_per_page', 10 );
			$force_all_replies = WPAS()->session->get( 'force_all_replies' );

			// Check if we need to force displaying all the replies (direct link to a specific reply for instance)
			if ( true === $force_all_replies ) {
				$replies_per_page = - 1;
				WPAS()->session->clean( 'force_all_replies' ); // Clean the session
			}

			$args = array(
				'posts_per_page' => $replies_per_page,
				'no_found_rows'  => false,
			);

			$replies = wpas_get_replies( $post->ID, array( 'read', 'unread' ), $args, 'wp_query' );

			if ( $replies->have_posts() ):

				while ( $replies->have_posts() ):

					$replies->the_post();
					$user      = get_userdata( $post->post_author );
					if( $user && !empty( $user ) )
					{						
						$time_ago  = human_time_diff( get_the_time( 'U', $post->ID ), current_time( 'timestamp' ) );
						wpas_get_template( 'partials/ticket-reply', array( 'time_ago' => $time_ago, 'user' => $user, 'post' => $post ) );
					}	
				endwhile;

			endif;

			wp_reset_query(); ?>	
</td>
</tr>
</tbody>
</table>
<br/>
	
</div>
<?php
$ticket_id = get_the_ID();
$status = get_post_meta($ticket_id, '_wpas_status', true);
if($status === 'closed'){?>
<div class="mainrights"><div style="color: #31708f;background-color: #d9edf7;border-color: #bce8f1;padding:20px;">The ticket has been closed. <a href="<?php echo get_permalink(22);?>" style="font-weight:bold; color: #000;">you can drop a message to Administrator</a>&nbsp; for re-open the ticket or you can create a new ticket.</div></div>

<div class="mainright" style="display: none">	
<?php } else {?>
<div class="mainright">
<?php }  ?>


	<?php
	if ( $replies_per_page !== -1 && (int) $replies->found_posts > $replies_per_page ):

		$current = $replies->post_count;
		$total   = (int) $replies->found_posts;
		?>

		<div class="wpas-alert wpas-alert-info wpas-pagi">
			<div class="wpas-pagi-loader"><?php esc_html_e( 'Loading...', 'awesome-support' ); ?></div>
			<p class="wpas-pagi-text"><?php echo sprintf( _x( 'Showing %s replies of %s.', 'Showing X replies out of a total of X replies', 'awesome-support' ), "<span class='wpas-replies-current'>$current</span>", "<span class='wpas-replies-total'>$total</span>" ); ?>
				<?php
				if ( 'ASC' == wpas_get_option( 'replies_order', 'ASC' ) ) {
					$load_more_msg = __( 'Load newer replies', 'awesome-support' );
				} else {
					$load_more_msg = __( 'Load older replies', 'awesome-support' );
				} ?>
				<?php if ( -1 !== $replies_per_page ): ?><a href="#" class="wpas-pagi-loadmore"><?php echo esc_html( $load_more_msg ); ?></a><?php endif; ?>
			</p>
		</div>

	<?php endif; ?>

	<?php

	do_action( 'wpas_ticket_details_replies_after', $post );

	/**
	* Prepare to show the reply form.
	*/
	if ( apply_filters('wpas_show_reply_form_front_end',true, $post ) ) {
	?>

		<h5 style="margin-top: -15px;"><?php esc_html_e( 'Comments', 'awesome-support' ); ?></h5>

		<?php
		/**
		 * Display the reply form.
		 *
		 * @since 3.0.0
		 */

			wpas_get_reply_form();
	 } ?>	
</div>	
</div>	
</div>
