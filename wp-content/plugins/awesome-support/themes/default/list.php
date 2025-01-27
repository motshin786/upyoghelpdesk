<?php
/* Get the tickets object */
global $wpas_tickets;

if ( $wpas_tickets->have_posts() ):

	/* Get list of columns to display */
	$columns 		  = wpas_get_tickets_list_columns();

	/* Get number of tickets per page */
	$tickets_per_page = wpas_get_option( 'tickets_per_page_front_end' );
	If ( empty($tickets_per_page) ) {
		$tickets_per_page = 5 ; // default number of tickets per page to 5 if no value specified.
	}

	?>
	<style type="text/css">
	.wrap .content-area main article .entry-content
	{
		min-width: 100%;
	}

* {
  box-sizing: border-box;
}

.myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 10px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}


.myInput {
  border-collapse: collapse;
  width: 100%;
  border: 1px solid #ddd;
  font-size: 18px;
}


.myInput th, 
.myInput td {
  text-align: left;
  padding: 12px;
  border: 1px solid #ccc;
}


.myInput tr {
  border-bottom: 1px solid #ddd;
}


.myInput tr.header, 
.myInput tr:hover {
  background-color: #f1f1f1;
}
th, td {
    border: 1px solid #ccc !important;
    text-align: center !important;
    font-size: 15px;
}
p {
    text-align: left;
}
.wpas-reply-meta .wpas-reply-user{text-align: left;}
</style>
	<div class="wpas wpas-ticket-list alignwide">

		<?php wpas_get_template( 'partials/ticket-navigation' ); ?>

		<!-- Filters & Search tickets -->
		<div class="wpas-row" id="wpas_ticketlist_filters">
			<div class="wpas-one-third">
				<select class="wpas-form-control wpas-filter-status">
					<option value=""><?php esc_html_e('All Status', 'awesome-support'); 
					
					?></option>
				</select>
			</div>
			<div class="wpas-one-third"></div>
			<div class="wpas-one-third" id="wpas_filter_wrap">
				<input class="wpas-form-control" id="wpas_filter" type="text" placeholder="<?php esc_html_e('Search tickets...', 'awesome-support'); ?>">
				<span class="wpas-clear-filter" title="<?php esc_html_e('Clear Filter', 'awesome-support'); ?>"></span>
			</div>
		</div>

		<!-- List of tickets -->
		<table id="wpas_ticketlist" class="wpas-table wpas-table-hover myInput" data-filter="#wpas_filter" data-filter-text-only="true" data-page-navigation=".wpas_table_pagination" data-page-size=" <?php echo esc_attr( $tickets_per_page ); ?>" >
			<thead>
				<tr colspan="12">
					<?php foreach ( $columns as $column_id => $column ) {

						$data_attributes = '';

						// Add the data attributes if any
						if ( isset( $column['column_attributes']['head'] ) && is_array( $column['column_attributes']['head'] ) ) {
							$data_attributes = wpas_array_to_data_attributes( $column['column_attributes']['head'] );
						}

						printf( '<th id="wpas-ticket-%1$s" %3$s>%2$s</th>', wp_kses_post($column_id), wp_kses_post($column['title']), wp_kses_post($data_attributes) );

					} ?>
					
					<th>Assignee</th>
					<th>Reporter</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$current_user = wp_get_current_user();
		        $username = $current_user->display_name;
               	while( $wpas_tickets->have_posts() ):
                     $wpas_tickets->the_post();
                     
			                   $ticket_id = get_the_ID();
							    $assigned_agent_id = get_post_meta($ticket_id, '_wpas_assignee', true);
							    if ($assigned_agent_id) {
							        $agent = get_userdata($assigned_agent_id);
							        $agent_name = $agent->display_name;
							    } else {
							        $agent_name = __('Super-admin', 'text-domain');
							    }  ?>
			                 
                 

				<?php 	echo '<tr  class="wpas-status-' . esc_attr( wpas_get_ticket_status( $wpas_tickets->post->ID ) ) . '" id="wpas_ticket_' . esc_attr( $wpas_tickets->post->ID ) . '">';

					foreach ( $columns as $column_id => $column ) {

						$data_attributes = '';

						// Add the data attributes if any
						if ( isset( $column['column_attributes']['body'] ) && is_array( $column['column_attributes']['body'] ) ) {
							$data_attributes = wpas_array_to_data_attributes( $column['column_attributes']['body'], true );
						}

						printf( '<td %s>', wp_kses_post($data_attributes) );

						/* Display the content for this column */
						wpas_get_tickets_list_column_content( $column_id, $column );

						echo '</td>';

					}
					
					
		
                     echo '<td>';
                         echo esc_html($agent_name); 
                     echo '</td>';
                      echo '<td >'.$username.'</td>';
					echo '</tr>';

				endwhile;

				wp_reset_query(); ?>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="12 <?php ///echo count($columns); ?>">
						<ul class="wpas_table_pagination"></ul>
					</td>
				</tr>
			</tfoot>
		</table>
	</div>
<?php else:
	echo wpas_get_notification_markup( 'info', sprintf( __( 'You haven\'t submitted a ticket yet. <a href="%s">Click here to submit your first ticket</a>.', 'awesome-support' ), wpas_get_submission_page_url() ) );
endif; ?>






