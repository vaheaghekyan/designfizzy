<?php

	/**
	 * HBCustom Set Cron Active
	 */
	add_action('init', 'hbcustom_cron_active', 0);
	function hbcustom_cron_active(){
		$max_customer_response_time = get_option('max-customer-response-time');
		$response_reminders_tine = get_option('response-reminders-time');
		if ($max_customer_response_time || $response_reminders_tine){
			add_action( 'wp_loaded','hbcustom_cron_flush_rules' );
			add_filter( 'rewrite_rules_array','hbcustom_add_cron_rules', 0, 1 );
			add_filter( 'query_vars','hbcustom_add_cron_vars', 0, 1 );
			add_action( 'wp', 'hbcustom_cron_run', 0);
			add_action( 'hbcustom_hourly_event', 'hbcustom_wp_cron_run' );
			if ( ! wp_next_scheduled( 'hbcustom_hourly_event' ) ) {
				wp_schedule_event(time(), 'hourly', 'hbcustom_hourly_event');
			}
		}
		else{
			wp_clear_scheduled_hook( 'hbcustom_hourly_event' );
		}
	}

	/**
	 * HBCustom Cron Flush Rules
	 */
	function hbcustom_cron_flush_rules(){
		$rules = get_option( 'rewrite_rules' );

		if ( ! isset( $rules['cron/hbcustom/?$'] ) ) {
			global $wp_rewrite;
			$wp_rewrite->flush_rules();
		}
	}

	/**
	 * HBCustom Add Cron Rules
	 */
	function hbcustom_add_cron_rules( $rules ) {
		$newrules = array();
		$newrules['cron/hbcustom/?$'] = 'index.php?cron=hbcustom';
		return $newrules + $rules;
	}

	/**
	 * HBCustom Add Cron Vars
	 */
	function hbcustom_add_cron_vars( $vars ) {
		if (!in_array('cron', $vars))
			array_push($vars, 'cron');
		return $vars;
	}

	/**
	 * HBCustom Cron Run
	 */
	function hbcustom_cron_run(){
		if (get_query_var('cron') == 'hbcustom') {
			if (get_option('max-customer-response-time'))
				hbcustom_completing_projects();
			if (get_option('response-reminders-time'))
				hbcustom_send_reminders_notifications();
			exit;
		}
	}

	/**
	 * HBCustom WP Cron Run
	 */
	function hbcustom_wp_cron_run(){
		if (get_option('max-customer-response-time'))
			hbcustom_completing_projects();
		if (get_option('response-reminders-time'))
			hbcustom_send_reminders_notifications();
	}

	/**
	 * HBCustom Send Customer Notifications By Reminders Time
	 */
	function hbcustom_send_reminders_notifications(){

		set_time_limit(0);

		$current_timestamp = current_time('timestamp');

		$result = hrb_get_projects(array(
			'post_status' 		=> HRB_PROJECT_STATUS_WORKING,
			'posts_per_page' 	=> -1
		));
		if ($result->found_posts){

			$projects = $result->posts;
			foreach ($projects as $project){

				$worker = hrb_get_post_participants($project->ID, array(
					'connected_meta' => array('type' => array('worker')),
					'fields' => 'ids'
				))->get_results();

				$workspace = hrb_p2p_get_post_workspaces($project->ID, array('fields' => 'ids'))->next_post();

				if ($worker && $workspace) {
					$worker = $worker[0];
					$p2p_id = hrb_p2p_get_participant_p2p_id($workspace, $worker);
					$status = p2p_get_meta($p2p_id, 'status', true);
					if (in_array($status, array(HRB_WORK_STATUS_COMPLETED, HRB_WORK_STATUS_INCOMPLETE))) {

						if (!$reminder_timestamp = get_post_meta($project->ID, 'last_reminder_author_timestamp', true)){
							$timestamp = strtotime(p2p_get_meta($p2p_id, 'status_timestamp', true));
							add_post_meta($project->ID, 'last_reminder_author_timestamp', $timestamp, true);
							$reminder_timestamp = $timestamp;
						}

						$timestamp = intval(($current_timestamp - $reminder_timestamp) / 3600);
						if ($timestamp >= intval(get_option('response-reminders-time'))){

							update_post_meta($project->ID, 'last_reminder_author_timestamp', $current_timestamp);

							$status = hrb_get_participants_statuses_verbiages( $status );
							$employer = get_user_by( 'id', $project->post_author );
							$worker = get_user_by( 'id', $worker );

							$project_link = html_link( get_permalink( $project->ID ), $project->post_title );
							$workspace_link = html_link( hrb_get_workspace_url( $workspace ), __( 'workspace', APP_TD ) );

							$work_status_link = html_link( hrb_get_workspace_url( $workspace ), __( 'work status', APP_TD ) );

							$subject = sprintf( __( 'User %1$s, working on - %2$s - has updated his %3$s to \'%4$s\'', APP_TD ), $worker->display_name, $project_link, $work_status_link, $status );

							$content = sprintf(
								__( 'Hello %2$s,%1$s
								User \'%3$s\' has just updated his work status on %4$s, to \'%5$s\'.', APP_TD ),
								"\r\n\r\n", $employer->display_name, $worker->display_name, $project_link, $status
							);

							$content .= "\r\n\r\n" . sprintf(
								__( "Please analyse his work and end the project accordingly. "
									. "You'll then be able to add your final review for user '%s'.", APP_TD ),
								$worker->display_name
							);

							$content .= "\r\n\r\n" . sprintf( __( "Visit the project %s.", APP_TD ), $workspace_link );

							appthemes_send_email($employer->user_email, $subject, $content);

							unset($status, $employer, $project_link, $workspace_link, $work_status_link, $subject, $content);
						}
						unset($timestamp, $reminder_timestamp);
					}
					unset($status, $p2p_id);
				}
				unset($worker, $workspace);
			}
			unset($projects);
		}
		unset($result, $current_timestamp);
	}

	/**
	 * HBCustom Completing Projects By Response Time
	 */
	function hbcustom_completing_projects(){

		set_time_limit(0);

		$current_timestamp = current_time('timestamp');

		$result = hrb_get_projects(array(
			'post_status' 		=> HRB_PROJECT_STATUS_WORKING,
			'posts_per_page' 	=> -1
		));
		if ($result->found_posts){

			remove_all_actions('hrb_transition_participant_status');

			$projects = $result->posts;
			foreach ($projects as $project){

				$worker = hrb_get_post_participants($project->ID, array(
					'connected_meta' 	=> array( 'type' => array( 'worker' ) ),
					'fields'			=> 'ids'
				))->get_results();

				$workspace = hrb_p2p_get_post_workspaces( $project->ID, array( 'fields' => 'ids' ) )->next_post();

				if ($worker && $workspace){
					$worker = $worker[0];
					$p2p_id = hrb_p2p_get_participant_p2p_id($workspace, $worker);
					$status = p2p_get_meta($p2p_id, 'status', true);
					if (in_array($status, array(HRB_WORK_STATUS_COMPLETED, HRB_WORK_STATUS_INCOMPLETE))){
						$timestamp = strtotime(p2p_get_meta($p2p_id, 'status_timestamp', true));
						$timestamp = intval(($current_timestamp - $timestamp) / 3600);
						if ($timestamp >= intval(get_option('max-customer-response-time'))){
							hrb_update_post_status( $project->ID, HRB_PROJECT_STATUS_CLOSED_COMPLETED );
							hrb_update_project_work_status( $workspace, $project->ID, HRB_PROJECT_STATUS_CLOSED_COMPLETED );
							hrb_p2p_update_participant_status($workspace, $worker, HRB_WORK_STATUS_COMPLETED );
						}
						unset($timestamp);
					}
					unset($status, $p2p_id);
				}
				unset($worker, $workspace);
			}
			unset($projects);
		}
		unset($result, $current_timestamp);
	}