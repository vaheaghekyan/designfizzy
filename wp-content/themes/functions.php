<?php
     /**
	  * Activation Hook
     */
     function hb_custom_activation(){
     	add_filter('init','hbcustom_flush_rules');
     }
	
	/**
	 * Flush rules to apply new rules
	*/
	function hbcustom_flush_rules() {
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
	}
	
	/**	
	 *Get Veriables & Identify View Type
	*/
	add_action( 'query_vars', 'hbcustom_query_vars' );
	function hbcustom_query_vars( $query_vars ) {
		$query_vars[] = 'hb_type';
		$query_vars[] = 'hb_project_id';

		return $query_vars;
	}

	/**	
	 *Get Veriables
	*/
	add_filter( 'query_vars', 'hbcustom_filter_query_vars' ,10 , 1);
	function hbcustom_filter_query_vars( $query_vars ) {
		$query_vars[] = 'hb_type';
		$query_vars[] = 'hb_project_id';

		return $query_vars;
	}


	/**
	* Add new rule to customize hirebee
	*/
	add_filter('rewrite_rules_array','hbcustom_rewriteRules');
	function hbcustom_rewriteRules($rules) {
				$newrules = array();
				$newrules['accept-this-project/(.*)$'] = 'index.php?hb_type=hbcustom_apply&hb_project_id=$matches[1]'; // Cannot remove this route.

				return $newrules + $rules;

	}

	/**
	 * Add Settings Page for HireBee Theme
	 */
	add_action('admin_menu', 'hrb_custom_admin_menu_settings');
	function hrb_custom_admin_menu_settings(){
		add_options_page( 'HireBee Custom Settings', 'HireBee Settings', 'administrator', 'hrb_custom_settings', 'hrb_custom_admin_menu_settings_page');
		add_action( 'admin_init', 'hrb_custom_register_settings' );
	}

	/**
	 * Add Custom HireBee Settings
	 */
	function hrb_custom_register_settings(){
		register_setting( 'hrb-custom-settings-group', 'limit-projects-active', 'intval' );
		register_setting( 'hrb-custom-settings-group', 'limit-projects-count', 'intval' );
		register_setting( 'hrb-custom-settings-group', 'new-project-notification', 'intval' );
		register_setting( 'hrb-custom-settings-group', 'max-customer-response-time', 'intval' );
		register_setting( 'hrb-custom-settings-group', 'response-reminders-time', 'intval' );
	}

	/**
	 * Custom HireBee Settings Page
	 */
	function hrb_custom_admin_menu_settings_page(){
		?>
		<style type="text/css">
			table.form-table tr th{
				width: 260px;
			}
		</style>
		<div class="wrap">
			<h2><?php _e('HireBee Custom Settings', APP_TD); ?></h2>

			<form method="post" action="options.php">
				<?php settings_fields( 'hrb-custom-settings-group' ); ?>
				<?php do_settings_sections( 'hrb-custom-settings-group' ); ?>
				<h3><?php _e('Max limit projects', APP_TD); ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="limit-projects-active"><?php _e('Limit Projects Active', APP_TD); ?></label></th>
						<td><input type="checkbox" id="limit-projects-active" name="limit-projects-active" value="1" <?php checked( '1', get_option( 'limit-projects-active' ) ); ?>/></td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="limit-projects-count"><?php _e('Limit Projects Count', APP_TD); ?></label></th>
						<td><input type="text" id="limit-projects-count" name="limit-projects-count" value="<?php echo esc_attr( get_option('limit-projects-count') ); ?>" /></td>
					</tr>
				</table>
				<h3><?php _e('Notification Emails', APP_TD); ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="new-project-notification"><?php _e('Send Workers New Project Notification Emails', APP_TD); ?></label></th>
						<td><input type="checkbox" id="new-project-notification" name="new-project-notification" value="1" <?php checked( '1', get_option( 'new-project-notification' ) ); ?>/></td>
					</tr>
				</table>
				<h3><?php _e('Max Customer Response', APP_TD); ?></h3>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"><label for="max-customer-response-time"><?php _e('Max Customer Response Time', APP_TD); ?></label></th>
						<td>
							<input type="text" id="max-customer-response-time" name="max-customer-response-time" value="<?php echo esc_attr( get_option('max-customer-response-time') ); ?>" />
							<span><?php _e('Hours.', APP_TD); ?></span>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="response-reminders-time"><?php _e('Response Reminders When Time Decreases To', APP_TD); ?></label></th>
						<td>
							<input type="text" id="response-reminders-time" name="response-reminders-time" value="<?php echo esc_attr( get_option('response-reminders-time') ); ?>" />
							<span><?php _e('Hours Left.', APP_TD); ?></span>
						</td>
					</tr>
				</table>
				<?php submit_button(); ?>

			</form>
		</div>
		<?php
	}

	/**
	 * Set customize template
	*/
	add_filter('template_include', 'hbcustom_template_include', 1, 1);
	function hbcustom_template_include( $template ) {
		if ( get_query_var( 'hb_type' )  == "hbcustom_apply") {
			if(!is_user_logged_in()){
				wp_redirect(get_bloginfo("url")."/login/?redirect_to=".$_SERVER["REQUEST_URI"]);
				exit;
			}
			if (get_option('limit-projects-active')) {
				$current_user = wp_get_current_user();
				$max_count_active_projects = intval(get_option('limit-projects-count', 0));
				$count_active_projects = intval(the_hrb_user_related_active_projects_count($current_user));
				if ($count_active_projects >= $max_count_active_projects) {
					appthemes_add_notice('limit-projects', __("<strong>Can't accept this project.</strong><br/>Designers can only work on {$max_count_active_projects} open projects at a time. Please fully complete those projects before you can accept more.", APP_TD));
					wp_redirect(esc_url(hrb_get_dashboard_url_for('projects')));
					exit;
				}
			}
			do_action('hrb_custom_action_accept_project');
			return HBCUSTOM_PLUGIN_DIR_VIEW."/apply-project.php";
		}
		return $template;
	}

	/**
	 * Outputs the formatted link to apply to a project or edit an existing proposal.
	 */
	function the_hrb_custom_create_edit_proposal_link( $post_id = 0, $text = '', $before = '', $after = '' ) {
		$post_id = get_the_hrb_loop_id( $post_id );

		if(current_user_can(HRB_ROLE_FREELANCER) ){
			
			if(get_post_status($post_id) == "publish" ){
				$url = get_bloginfo("url")."/accept-this-project/".$post_id;
				echo html( 'a', array(
					'class' => 'button secondary expand',
					'href' => $url,
					'onclick' => 'return confirm("You\'re about to accept this project. Click \'Confirm\' to proceed.");',
				), $before . "Accept This Project" . $after );
			}
		}

		if(current_user_can(HRB_ROLE_EMPLOYER) || current_user_can(HRB_ROLE_BOTH)){

			if(get_post_status($post_id) == HRB_PROJECT_STATUS_WAITING_FUNDS ){

				$user_id = get_current_user_id();
				$post = get_post($post_id);

				if ($post && $post->post_author == $user_id) {

					$workspace_ids = hrb_get_participants_workspace_for($post->ID, $user_id);
					foreach ($workspace_ids as $workspace_id) {
						$order = appthemes_get_order_connected_to($workspace_id);
						if ($order && APPTHEMES_ORDER_PENDING == $order->get_status()) {
							echo html('a', array(
								'class' => 'button secondary expand',
								'href' => hrb_get_workspace_transfer_funds_url($workspace_id),
							), $before . __('Pay & Start Project', APP_TD) . $after);
							break;
						}
					}
				}
			}
		}

	}

	/**
	* Get assigned freelancer
	* @param $project_id 
	*/
	function hb_custom_get_assigned_freelancer($project_id, $out_type=''){
		global $user_ID;

		$results = array();
		$workspaces = hrb_p2p_get_post_workspaces($project_id);

		if ($workspaces->have_posts()) {

			$workspace_id = $workspaces->post->ID;

			$results = hrb_p2p_get_workspace_participants($workspace_id)->get_results();
			if($out_type == 'title' ){
				foreach ($results as $user) {
					if ($user_ID == $user->data->ID) {
						_e('You', APP_TD);
					} else {
						echo $user->data->display_name;
					}
				}
			}else{
				foreach ($results as $user) {
					echo '<a href="'.$user->data->profile_url.'">';
					if ($user_ID == $user->data->ID) {
						_e('You', APP_TD);
					} else {
						echo $user->data->display_name;
					}
					echo '</a>';
				}
			}			
		}

		if (empty($results))
			_e('None', APP_TD);
	}

	/**
	 * Get list categories by project
	 */
	function hrb_custom_get_categories_by_project( $project_id ){

		if(!$project_id){			
			$project_id = get_the_ID();
		}

		$terms = wp_get_object_terms( get_the_ID(), HRB_PROJECTS_CATEGORY );

		if ( empty( $terms ) ) {
			_e('None', APP_TD);
			return;
		}

		$terms_list = array();

		foreach ( $terms as $term ) {
			$terms_list[] = $term->name;
		}

		echo join( ', ', $terms_list );
	}

	/**
	 * Outputs the formatted remaining days in listings
	 */
	function hrb_custom_project_remain_days( $post_id = 0, $alt_output = false, $layout="default" ) {

		$days = get_the_hrb_project_remain_days( $post_id );

		$expired = true;

		if ( 'publish' != get_post_status( $post_id ) ) {

			$current_date = strtotime(current_time('mysql'));
			$expire_date  = strtotime(get_the_hrb_project_expire_date( $post_id, 'Y-m-d H:i:s' ));
			if ($expire_date > $current_date && in_array(get_post_status( $post_id ), array(HRB_PROJECT_STATUS_WORKING, HRB_PROJECT_STATUS_WAITING_FUNDS))) {
				$days_left = floor(($expire_date - $current_date) / (3600*24));
				$days_left_label = _n('hour', 'hours', $days_left, APP_TD);
			}
			else{
				$days_left = ! $alt_output ? '&nbsp;' : '';
				$days_left_label = __( 'Not Available', APP_TD );
			}

		} elseif ( '' === $days ) {

			$days_left = ! $alt_output ? '-' : '';
			$days_left_label = __( 'Endless', APP_TD );

		} elseif ( $days > 0 ) {

			$days_left = (int) $days;
			$days_left_label = _n( 'hour', 'hours', $days, APP_TD );

		} else {

			$expired = true;

			$days_left = __( 'Expired', APP_TD );
			$days_left_label = ! $alt_output ? __( 'n/a', APP_TD ) : '';
		}

		if ( $alt_output ) {
			$remain_days = sprintf( '%s %s', $days_left, $days_left_label );
		} else {
			if($layout == "default"){
				$remain_days = sprintf( '<span class="days-left">%s</span> <span class="days-left-label">%s</span>', $days_left, $days_left_label );
			}else{
				$remain_days = sprintf( ' <span class="days-left-label">%s</span> <span class="days-left">%s</span>', $days_left_label, $days_left );	
			}			
		}

		echo $remain_days;
	}

	/**
	 * Send Workers New Project Notification Emails
	 */
	//add_action('publish_project', 'hrb_custom_new_project_notification', 10, 2);
	function hrb_custom_new_project_notification($post){
		global $wpdb;

		if (!get_option('new-project-notification'))
			return;

		$user_query = new WP_User_Query( array(
			'fields' => array('ID', 'user_email'),
			'orderby' => 'email',
			'order' => 'ASC',
			'meta_query' => array(
				'relation' => 'OR',
				array(
					'key' => $wpdb->prefix.'capabilities',
					'value' => HRB_ROLE_FREELANCER,
					'compare' => 'like'
				),
				array(
					'key' => $wpdb->prefix.'capabilities',
					'value' => HRB_ROLE_BOTH,
					'compare' => 'like'
				)
			)
		) );

		$freelancers = $user_query->get_results();
		unset($user_query);

		if (!empty($freelancers)){

			remove_filter('wp_mail', 'hrb_append_signature');

			$domain = preg_replace( '#^www\.#', '', strtolower( $_SERVER['SERVER_NAME'] ) );
			$blogname = wp_specialchars_decode( get_bloginfo( 'name' ), ENT_QUOTES );

			$headers = array(
				'from' => sprintf( 'From: %1$s <%2$s>', $blogname, "wordpress@$domain" ),
				'MIME-Version: 1.0',
				'Content-Type: text/html; charset="' . get_bloginfo( 'charset' ) . '"',
				'reply_to' => "Reply-To: noreply@$domain"
			);

			$subject = sprintf( __( "[%s] New Project Published: %s", APP_TD ), get_bloginfo( 'name' ), $post->post_title );

			$content = html( 'p', sprintf(
				__( 'A new project was published: %s', APP_TD ),
				html_link( get_permalink( $post ), $post->post_title ) ) );

			ob_start();
			appthemes_load_template( array( 'email-template.php', APP_FRAMEWORK_DIR_NAME . '/templates/email-template.php' ), array( 'content' => $content ) );
			$body = ob_get_clean();

			$freelancers_chunk = array_chunk($freelancers, HBCUSTOM_LIMIT_SEND_EMAILS);
			unset($freelancers);

			foreach($freelancers_chunk as $freelancers){
				$options = $bcc = array();
				$to = '';
				foreach($freelancers as $freelancer){
					if ($post->post_author == $freelancer->ID)
						continue;
					if (!$to){
						$to = $freelancer->user_email;
						continue;
					}
					$bcc[] = 'Bcc: '.$freelancer->user_email;
				}
				$options = array_merge($headers, $bcc);
				wp_mail( $to, $subject, $body, $options );
			}
		}
	}

	/**
	*	Show only posts and media related to logged in author
	**/
	add_action('pre_get_posts', 'query_set_only_author' );
	function query_set_only_author( $wp_query ) {
		 if( current_user_can("employer") || current_user_can("freelancer") ) {
	    	if("workspace" == get_post_type()){
		      global $current_user, $pagenow;
				    if( !is_a( $current_user, 'WP_User') )
				    return;
				    if( 'admin-ajax.php' != $pagenow || $_REQUEST['action'] != 'query-attachments' )
				    return;
				    if( !current_user_can('manage_media_library') )
				    $wp_query_obj->set('author', $current_user->ID );
				    return;
		    }
	    }
	}

	// Fix post counts
	function fix_post_counts($views) {
	    global $current_user, $wp_query;
	    unset($views['mine']);
	    $types = array(
	        array( 'status' =>  NULL ),
	        array( 'status' => 'publish' ),
	        array( 'status' => 'draft' ),
	        array( 'status' => 'pending' ),
	        array( 'status' => 'trash' )
	    );
	    foreach( $types as $type ) {
	        $query = array(
	            'author'      => $current_user->ID,
	            'post_type'   => 'post',
	            'post_status' => $type['status']
	        );
	        $result = new WP_Query($query);
	        if( $type['status'] == NULL ):
	            $class = ($wp_query->query_vars['post_status'] == NULL) ? ' class="current"' : '';
	            $views['all'] = sprintf(
	            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
	            admin_url('edit.php?post_type=post'),
	            $class,
	            $result->found_posts,
	            __('All')
	        );
	        elseif( $type['status'] == 'publish' ):
	            $class = ($wp_query->query_vars['post_status'] == 'publish') ? ' class="current"' : '';
	            $views['publish'] = sprintf(
	            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
	            admin_url('edit.php?post_type=post'),
	            $class,
	            $result->found_posts,
	            __('Publish')
	        );
	        elseif( $type['status'] == 'draft' ):
	            $class = ($wp_query->query_vars['post_status'] == 'draft') ? ' class="current"' : '';
	            $views['draft'] = sprintf(
	            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
	            admin_url('edit.php?post_type=post'),
	            $class,
	            $result->found_posts,
	            __('Draft')
	        );
	        elseif( $type['status'] == 'pending' ):
	            $class = ($wp_query->query_vars['post_status'] == 'pending') ? ' class="current"' : '';
	            $views['pending'] = sprintf(
	            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
	            admin_url('edit.php?post_type=post'),
	            $class,
	            $result->found_posts,
	            __('Pending')
	        );
	        elseif( $type['status'] == 'trash' ):
	            $class = ($wp_query->query_vars['post_status'] == 'trash') ? ' class="current"' : '';
	            $views['trash'] = sprintf(
	            '<a href="%1$s"%2$s>%4$s <span class="count">(%3$d)</span></a>',
	            admin_url('edit.php?post_type=post'),
	            $class,
	            $result->found_posts,
	            __('Trash')
	        );
	        endif;
	    }
	    return $views;
	}

	// Fix media counts
	function fix_media_counts($views) {
	    global $wpdb, $current_user, $post_mime_types, $avail_post_mime_types;
	    $views = array();
	    $count = $wpdb->get_results( "
	        SELECT post_mime_type, COUNT( * ) AS num_posts 
	        FROM $wpdb->posts 
	        WHERE post_type = 'attachment' 
	        AND post_author = $current_user->ID 
	        AND post_status != 'trash' 
	        GROUP BY post_mime_type
	    ", ARRAY_A );
	    foreach( $count as $row )
	        $_num_posts[$row['post_mime_type']] = $row['num_posts'];
	    $_total_posts = array_sum($_num_posts);
	    $detached = isset( $_REQUEST['detached'] ) || isset( $_REQUEST['find_detached'] );
	    if ( !isset( $total_orphans ) )
	        $total_orphans = $wpdb->get_var("
	            SELECT COUNT( * ) 
	            FROM $wpdb->posts 
	            WHERE post_type = 'attachment'
	            AND post_author = $current_user->ID 
	            AND post_status != 'trash' 
	            AND post_parent < 1
	        ");
	    $matches = wp_match_mime_types(array_keys($post_mime_types), array_keys($_num_posts));
	    foreach ( $matches as $type => $reals )
	        foreach ( $reals as $real )
	            $num_posts[$type] = ( isset( $num_posts[$type] ) ) ? $num_posts[$type] + $_num_posts[$real] : $_num_posts[$real];
	    $class = ( empty($_GET['post_mime_type']) && !$detached && !isset($_GET['status']) ) ? ' class="current"' : '';
	    $views['all'] = "<a href='upload.php'$class>" . sprintf( __('All <span class="count">(%s)</span>', 'uploaded files' ), number_format_i18n( $_total_posts )) . '</a>';
	    foreach ( $post_mime_types as $mime_type => $label ) {
	        $class = '';
	        if ( !wp_match_mime_types($mime_type, $avail_post_mime_types) )
	            continue;
	        if ( !empty($_GET['post_mime_type']) && wp_match_mime_types($mime_type, $_GET['post_mime_type']) )
	            $class = ' class="current"';
	        if ( !empty( $num_posts[$mime_type] ) )
	            $views[$mime_type] = "<a href='upload.php?post_mime_type=$mime_type'$class>" . sprintf( translate_nooped_plural( $label[2], $num_posts[$mime_type] ), $num_posts[$mime_type] ) . '</a>';
	    }
	    $views['detached'] = '<a href="upload.php?detached=1"' . ( $detached ? ' class="current"' : '' ) . '>' . sprintf( __( 'Unattached <span class="count">(%s)</span>', 'detached files' ), $total_orphans ) . '</a>';
	    return $views;
	}

	/**
	*  Creating a new array will reset the allowed filetypes
	**/
	function hb_custom_myme_types($mime_types){
	    $mime_types = array(
	        'jpg|jpeg|jpe' => 'image/jpeg',
	        'gif' => 'image/gif',
	        'png' => 'image/png',
	        'bmp' => 'image/bmp',
			'psd' => 'application/x-photoshop',
//			'psd' => 'application/octet-stream',
	        'tif|tiff' => 'image/tiff'

	    );
	    return $mime_types;
	}
	add_filter('upload_mimes', 'hb_custom_myme_types', 1, 1);

	/**
	* Add default media library in clarification board
	**/
	add_action("wp_head","hb_custom_header_script");

	function hb_custom_header_script(){
		wp_enqueue_media();
	
	   ?>
       

		<script type="text/javascript">
		 jQuery(document).ready(function(){

			 if (jQuery('div.workspace-content div.work-status.completed.closed_complete').length && jQuery('div.workspace-content div.participant-actions a.review-user').length){
				 jQuery('html, body').animate({
					 scrollTop: jQuery('.form-review-fieldset').show().offset().top - 200
				 }, 1000);
			 }

		 	var file_frame;
 
				// "mca_tray_button" is the ID of my button that opens the Media window
				jQuery('#hb_custom_media_clarification_board').live('click', function( event ){
				 
				  event.preventDefault();
				 
					if ( file_frame ) {
						file_frame.open();
						return;
					}
				 
					file_frame = wp.media.frames.file_frame = wp.media({
						title: jQuery( this ).data( 'uploader_title' ),
						button: {
							text: jQuery( this ).data( 'uploader_button_text' )
						},
						multiple: true  
					});
				 
					file_frame.on( 'select', function() {
				 
						attachment = file_frame.state().get('selection').toJSON();
				 
				 		var files = [];
				 		var files_id = [];
				 		jQuery.each(attachment,function(i,f){
				 			console.log(f);
				 			files.push(f.filename +'|'+f.url);
				 			files_id.push(f.id);
				 		});
				 		jQuery("#hb_custom_media_clarification_board").val("Attach Files ("+attachment.length+" files attached)");
				 		jQuery("input[name=hb_custom_attached_files]").val(files.join('||'));
				 		jQuery("input[name=hb_custom_attached_files_id]").val(files_id.join(','));
				 	});

					file_frame.on('close',function() {
						    var selection = file_frame.state().get('selection');
						    if(!selection.length){
						        jQuery("#hb_custom_attached_files").val('');
				 				jQuery("#hb_custom_media_clarification_board").val("Attach Files");
				 				
						    }
					});
				 
					file_frame.open();
				 
				});

		 });

		</script>
		<?php 

	}


	/**
	*	Allow employer/worker to upload files
	*/
	add_action('init', 'allow_contributor_uploads');
		function allow_contributor_uploads() {
			if( current_user_can("employer") || current_user_can("freelancer") ) {
			   	if("workspace" == get_post_type() || "project" == get_post_type()){
				  
				    $employer = get_role('employer');
				    $employer->add_cap('upload_files');

				    $freelancer = get_role('freelancer');
				    $freelancer->add_cap('upload_files');
				}
			}
		}

	
	/**
	*	Append file attachments
	*/
	add_filter("comment_post","hb_comment_clarification_board");
	function hb_comment_clarification_board($comment_id){
		$commentarr = get_comment($comment_id, ARRAY_A);

		if (empty($_POST['hb_custom_attached_files']))
			return $comment_id;

		remove_all_filters('pre_comment_content');

		$files = explode("||",$_POST['hb_custom_attached_files']);

		if(!empty($files)){
			$attachment_label =  "<div class='attached_label'> - ".sizeof($files). _n( ' file', ' files', sizeof($files) , APP_TD ) ." attached </div>";			
			$attachments .= "<ul class='hb_cb_files' style='list-style-type: none;'>";

			foreach ($files as $key) {
				 $f = explode("|", $key);
				 $attachments .= "<li class='file-extension file-other'><div><img src='".$f[1]."'></div><a href='".$f[1]."' title='".$f[0]."' target='_blank'>".$f[0]."</a></li>";
			}

			$attachments .= "</ul>";
			$commentarr["comment_content"] = $attachment_label.$commentarr["comment_content"].$attachments;
			wp_update_comment( $commentarr );
		}

		if (isset($_POST['hb_custom_watermark']) && !empty($_POST['hb_custom_attached_files_id'])){
			$ids = explode(',', $_POST['hb_custom_attached_files_id']);
			$ids = array_map('intval', $ids);
			foreach ($ids as $id) {
				if (wp_get_attachment_image($id)){
					$attachment_path = get_attached_file($id);
					$watermark = new Watermark($attachment_path);
					$watermark->setWatermarkImage(HBCUSTOM_PLUGIN_DIR.'watermark.png');
					$watermark->setType(Watermark::CENTER);
					$watermark->saveAs($attachment_path);
				}
			}
		}

		return $comment_id;
	}

	/**
	 * HBCustom Accept Project to Freelancer
	 */
	add_action('hrb_custom_action_accept_project', 'hrb_custom_accept_project', 10, 0);
	function hrb_custom_accept_project(){
		global $wpdb, $current_user;
		get_currentuserinfo();

		// Get Project Object
		$project_id = get_query_var("hb_project_id");
		$project    = get_post($project_id);

		// If project not exist then redirect user on home page
		if (!$project){
			wp_redirect( home_url() );
			exit;
		}

		if ($project->post_type == HRB_PROJECTS_PTYPE && $project->post_status == 'publish'){
			if (user_can($current_user, HRB_ROLE_EMPLOYER)){
				appthemes_add_notice('accept-project-fail', __("<strong>Can't accept this project.</strong> - You are not freelancer!", APP_TD));
				wp_redirect( hrb_get_dashboard_url_for('projects') );
				exit;
			}
			else{
				$workspace_id = hrb_get_cached_workspaces_for($project->ID);
				$workspace_id = $workspace_id[0];

				$p2p_data = get_post_meta($project->ID, '_p2p_data', true);

				$order_id = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT p2p_from
							 FROM ".HRBEE_TABLE_P2P."
						 WHERE
						   p2p_type = %s
						   AND
						   p2p_to = %d
						",
							"order-connection",
							$workspace_id
					)
				);

				if (!empty($p2p_data) && is_array($p2p_data)){
					$time = current_time('mysql');

					$comment = get_comments(array(
						'post_id' => $project->ID,
						'type'    => 'proposal'
					));
					$comment = $comment[0];

					wp_update_comment(array(
						'comment_ID' => $comment->comment_ID,
						'comment_author' => $current_user->user_login,
						'comment_author_email' => $current_user->user_email,
						'comment_author_url' => 'http://',
						'comment_content' => 'Date proposed:'.$time
					));

					$wpdb->update( $wpdb->comments, array( 'user_id' => $current_user->ID ), array( 'comment_ID' => $comment->comment_ID ) );

					$price = appthemes_escrow_receiver_amount(get_post_meta($project->ID, '_hrb_budget_price', true));

					update_post_meta($order_id, 'receivers', array(
						$current_user->ID => $price
					));

					if ($p2p_id = intval($p2p_data['candidate_id'])){
						$wpdb->update(
							HRBEE_TABLE_P2P,
							array('p2p_to' => $current_user->ID),
							array('p2p_id' => $p2p_id),
							array('%d'),
							array('%d')
						);
					}

					if ($p2p_id = intval($p2p_data['worker_id'])){
						$wpdb->update(
							HRBEE_TABLE_P2P,
							array('p2p_to' => $current_user->ID),
							array('p2p_id' => $p2p_id),
							array('%d'),
							array('%d')
						);
					}

					if ($p2p_id = intval($p2p_data['workspace_id'])){
						$wpdb->update(
							HRBEE_TABLE_P2P,
							array('p2p_from' => $project->ID),
							array('p2p_id' => $p2p_id),
							array('%d'),
							array('%d')
						);
					}

					delete_post_meta($project->ID, '_p2p_data');
					update_post_meta($project->ID, '_bids', 1);

					wp_update_post(array(
						'ID' 			=> $project->ID,
						'post_status' 	=> 'working'
					));

					hrb_custom_accepted_project_notify_parties($workspace_id,$project, $project->post_author, $current_user->ID);
				}
			}
		}
		else{
			wp_redirect( hrb_get_dashboard_url_for() );
			exit;
		}
	}

	/**
	 * HBCustom waiting funds notifications for employer
	 */
	add_action('wp', 'hrb_custom_waiting_funds_notifications');
	function hrb_custom_waiting_funds_notifications(){
		if (hrb_get_dashboard_page() && !in_array(hrb_get_dashboard_page(), array('workspace'))) {
			if (hrb_is_escrow_enabled() && (current_user_can(HRB_ROLE_EMPLOYER) || current_user_can(HRB_ROLE_BOTH))) {
				$user_id = get_current_user_id();
				$posts = get_posts(array(
					'author' => $user_id,
					'post_type' => HRB_PROJECTS_PTYPE,
					'post_status' => HRB_PROJECT_STATUS_WAITING_FUNDS,
					'posts_per_page' => -1
				));
				if (!empty($posts)) {
					$notices = '';
					appthemes_add_notice('waiting-funds', __('<strong>Important:</strong> You need to make payments for one (or more) of your projects for designers to begin working.', APP_TD));
					foreach ($posts as $post) {
						$workspace_ids = hrb_get_participants_workspace_for($post->ID, $user_id);
						foreach ($workspace_ids as $workspace_id) {
							$order = appthemes_get_order_connected_to($workspace_id);
							if ($order && APPTHEMES_ORDER_PENDING == $order->get_status()) {
								$notices .= $notices ? '<br/>' : '';
								$notices .= sprintf(__('<a href="%s">Make payment</a> for project <a href="%s">%s</a>', APP_TD), hrb_get_workspace_transfer_funds_url($workspace_id), get_permalink($post), $post->post_title);
							}
						}
					}
					appthemes_add_notice('transfer-funds', $notices);
				}
			}
		}
		else if (is_singular( HRB_PROJECTS_PTYPE ) && get_post_status() == HRB_PROJECT_STATUS_WAITING_FUNDS){
			if (hrb_is_escrow_enabled() && (current_user_can(HRB_ROLE_EMPLOYER) || current_user_can(HRB_ROLE_BOTH))) {
				$user_id = get_current_user_id();
				$post = get_post();
				if ($user_id == $post->post_author){
					$notices = '';
					$workspace_ids = hrb_get_participants_workspace_for($post->ID, $user_id);
					foreach ($workspace_ids as $workspace_id) {
						$order = appthemes_get_order_connected_to($workspace_id);
						if ($order && APPTHEMES_ORDER_PENDING == $order->get_status()) {
							$notices .= $notices ? '<br/>' : '';
							$notices .= sprintf(__('<strong>Important:</strong> You need to make the payment for this project, for the designer to begin working. <a href="%s">Make Payment</a>', APP_TD), hrb_get_workspace_transfer_funds_url($workspace_id));
						}
					}
					appthemes_add_notice('transfer-funds', $notices);
				}
			}
		}
	}

	/**
	 * HBCustom check access to project page actions
	 */
	function hrb_custom_is_project_access(){
		$post = get_post();
		$user_id = get_current_user_id();
		if ($post->post_author == $user_id)
			return true;
		$participants = hrb_get_post_participants($post->ID)->get_results();
		if (!empty($participants) && is_array($participants)){
			foreach($participants as $participant){
				if ($participant->ID == $user_id)
					return true;
			}
		}
		return false;
	}

	/**
	 * HBCustom check access to project page actions
	 */
	function hrb_custom_is_project_review_access(){
		$post = get_post();
		if (in_array($post->post_status, array(HRB_PROJECT_STATUS_CLOSED_COMPLETED, HRB_PROJECT_STATUS_CLOSED_INCOMPLETE)) && $post->post_author == get_current_user_id()) {
			$count = get_comments(array(
				'post_id' 	=> $post->ID,
				'type' 		=> 'review',
				'count' 	=> true
			));
			return !$count;
		}
		return false;
	}

	/**
	 * HBCustom check access to clarification in development mode
	 */
	function hrb_custom_is_clarification_access(){
		$project = get_post();
		$workspace_id = hrb_p2p_get_post_workspaces($project->ID)->post->ID;		
		//$participant = hrb_p2p_get_participant( $workspace_id, get_current_user_id() );	
		
		if ( $workspace_id && HRB_PROJECT_STATUS_WORKING == get_post_status() ) {
			return false;
		}
		return true;
	}

	function hrb_custom_is_complete_status(){
		$project = get_post();
		$workspace_id = hrb_p2p_get_post_workspaces($project->ID)->post->ID;		

		return hrb_is_work_ended( $workspace_id );
	}
	/*
		Custom Participant Type
	*/
	function hrb_get_participant_type(){
		$project = get_post();
		$workspace_id = hrb_p2p_get_post_workspaces($project->ID)->post->ID;

		if($workspace_id){
			$participant = hrb_p2p_get_participant( $workspace_id, get_current_user_id() );		
		}		

		return $participant->type;		
	}
	/*
		Custom Notification Feed
	*/
	function hrb_get_custom_notification(){
		$project = get_post();

		$notifications = appthemes_get_user_unread_notifications( get_current_user_id(), array( 'project_id' => $project->ID ) );

		foreach( $notifications->results as $notification ){
			var_dump($notification->message);
		}
		return;
	}	

	/*
		Custom Comment
	*/
	function custom_comment_template($comment, $args, $depth) {	
			
		if ( 'div' == $args['style'] ) {
			$tag = 'div';
			$add_below = 'comment';
		} else {
			$tag = 'li';
			$add_below = 'div-comment';
		}	

		if( isset($comment->notification) ){
	?>
			<<?php echo $tag; ?> <?php comment_class( $current_comment_author ); ?> id="comment-<?php comment_ID(); ?>">
			<?php if ( 'div' != $args['style'] ) : ?>
			<div class="comment-body">
			<?php endif; ?>
			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
				?>
			</div>

			<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			<?php if ( 'div' != $args['style'] ) : ?>
			</div>
			<?php endif; ?>
	<?php	
		}else{
			$current_comment_author = "";			
			global $current_user;			
			if(get_comment_author() == $current_user->display_name){
				$current_comment_author	= "current_comment_author";
			}
	?>
			<<?php echo $tag; ?> <?php comment_class( $current_comment_author ); ?> id="comment-<?php comment_ID(); ?>">
			<?php if ( 'div' != $args['style'] ) : ?>
			<div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
			<?php endif; ?>
			<div class="comment-author vcard">
				<?php if ( 0 != $args['avatar_size'] ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				<?php printf( __( '<cite class="fn">%s</cite> <span class="says">says:</span>' ), get_comment_author_link() ); ?>
			</div>
			<?php if ( '0' == $comment->comment_approved ) : ?>
			<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.' ) ?></em>
			<br />
			<?php endif; ?>

			<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID, $args ) ); ?>">
				<?php
					/* translators: 1: date, 2: time */
					printf( __( '%1$s at %2$s' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( __( '(Edit)' ), '&nbsp;&nbsp;', '' );
				?>
			</div>

			<?php comment_text( get_comment_id(), array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>

			<?php
			comment_reply_link( array_merge( $args, array(
				'add_below' => $add_below,
				'depth'     => $depth,
				'max_depth' => $args['max_depth'],
				'before'    => '<div class="reply">',
				'after'     => '</div>'
			) ) );
			?>

			<?php if ( 'div' != $args['style'] ) : ?>
			</div>
			<?php endif; ?>
	<?php			
		}
	    
	}
	/**
	 * Notify employer and candidate on an accepted project.
	 * Notification + Email
	 */
	function hrb_custom_accepted_project_notify_parties( $workspace_id, $project, $employer_id, $freelacer_id) {

		global $wpdb;
		$employer = get_user_by( 'id', $employer_id);
		$worker = get_user_by( 'id', $freelacer_id );

		$url =  hrb_get_workspace_url( $workspace_id );

		$project_link = html_link( $url, $project->post_title );

		### notify recipient

		$subject_message = sprintf( __( 'User \'%1$s\' has accepted your project - %2$s -', APP_TD ), $worker->display_name, $project_link );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
				user \'%3$s\' has accepted your project  \'%4$s\'.', APP_TD ),
			"\r\n\r\n", $employer->display_name, $worker->display_name, $project_link
		);

		$participant = array(
			'recipient' => $employer->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' => ''//get_the_hrb_proposal_url( $proposal ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'action', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );

		### notify sender

		$subject_message = sprintf( __( 'You\'ve accepted the project \'%1$s\' -', APP_TD ),$project_link );

		$content = sprintf(
			__( 'Hello %2$s,%1$s
				You\'ve accepted the project \'%3$s\'.', APP_TD ),
			"\r\n\r\n", $worker->display_name, $project_link
		);

		$participant = array(
			'recipient' => $worker->ID,
			'message' => $subject_message,
			'send_mail' => array(
				'content' => wpautop( $content ),
			),
			'meta' => array(
				'subject' => wp_strip_all_tags( $subject_message ),
				'project_id' => $project->ID,
				'action' =>''// get_the_hrb_proposal_url( $proposal ),
			),
		);

		appthemes_send_notification( $participant['recipient'], $participant['message'], 'notification', $participant['meta'], array( 'send_mail' => $participant['send_mail'] ) );
	}

	/**
	 * Adding data to p2p table
	 */
	function hrb_custom_add_p2p($form, $to, $type){
		global $wpdb;

		$wpdb->insert(HRBEE_TABLE_P2P,
			array(
				"p2p_from" => $form,
				"p2p_to" => $to,
				"p2p_type" => $type
			),
			array(
				'%d',
				'%d',
				'%s'
			)
		);

		return $wpdb->insert_id;
	}

	/**
	 * Adding data to p2pmeta table
	 */
	function hrb_custom_add_p2pmeta($ID, $key, $value){
		global $wpdb;

		$wpdb->insert(HRBEE_TABLE_P2PMETA,
			array(
				"p2p_id" => $ID,
				"meta_key" => $key,
				"meta_value" => $value
			),
			array(
				'%d',
				'%s',
				'%s'
			)
		);

		return $wpdb->insert_id;
	}

	/**
	 * Creating proposal with order and workspace of project
	 */
	add_action('publish_project', 'hrb_custom_paypal_send', 0, 2);
	function hrb_custom_paypal_send($ID, $post){
		global $wpdb, $current_user;

		// If proposal exists for project that do not do anything
		if (get_comments(array('post_id' => $ID, 'count' => true, 'type' => 'proposal')))
			return;

		// Get current user info
		get_currentuserinfo();

		// Remove all unnecessary actions
		remove_all_actions('publish_project');
		remove_all_actions('waiting_funds_workspace');
		remove_all_actions('transition_post_status');
		remove_all_actions('hrb_transition_participant_status');

		// Get current time and timestamp
		$time = current_time('mysql');
		$timestamp = strtotime($time);

		// Create proposal for project
		$data = array(
			'comment_post_ID' => $ID,
			'comment_author' => $current_user->user_login,
			'comment_author_email' => $current_user->user_email,
			'comment_author_url' => '',
			'comment_content' => '',
			'comment_type' => HRB_PROPOSAL_CTYPE,
			'comment_parent' => 0,
			'user_id' => $current_user->ID,
			'comment_date' => $time,
			'comment_approved' => 1,
		);

		$comment_id = wp_insert_comment($data);
		$post_meta 	= get_post_meta($ID);

		// Setup accepted terms for candidate and employer
		$data = array(
			"updated" => $timestamp,
			//"_hrb_featured" => "on",
			"_hrb_delivery" => $post_meta['_hrb_duration'][0],
			"_hrb_accept_site_terms" => "on",
			"_hrb_credits_required" => "1",
			"_hrb_employer_decision" => HRB_TERMS_ACCEPT,
			"_hrb_employer_notes" => "",
			"_hrb_candidate_decision" => HRB_TERMS_ACCEPT,
			"_hrb_candidate_decision_timestamp" => $time,
			"_hrb_candidate_notes" => "",
			"_hrb_employer_decision_timestamp" => $time
		);

		add_comment_meta($comment_id, '_bid_currency', $post_meta['_hrb_budget_currency'][0]);
		add_comment_meta($comment_id, '_bid_data', serialize($data));
		add_comment_meta($comment_id, '_bid_amount', $post_meta['_hrb_budget_price'][0]);
		add_comment_meta($comment_id, '_hrb_status', HRB_PROPOSAL_STATUS_ACCEPTED);

		// Change status project to waiting funds
		$wpdb->update( $wpdb->posts, array( 'post_status' => HRB_PROJECT_STATUS_WAITING_FUNDS ), array( 'ID' => $post->ID ) );

		clean_post_cache( $post->ID );

		$old_status = $post->post_status;
		$post->post_status = HRB_PROJECT_STATUS_WAITING_FUNDS;
		wp_transition_post_status( HRB_PROJECT_STATUS_WAITING_FUNDS, $old_status, $post );

		// Create workspace for this project with status waiting funds
		$args = array(
			'post_status'  	=> HRB_PROJECT_STATUS_WAITING_FUNDS,
			'post_type'    	=> HRB_WORKSPACE_PTYPE,
			'post_author'  	=> $post->post_author,
			'post_title'   	=> $post->post_title,
			'post_name'		=> $post->post_name,
			'post_content' 	=> ''
		);

		$workspace_id = wp_insert_post($args);

		// Create order
		$args = array(
			'post_status'  	=> APPTHEMES_ORDER_PENDING,
			'post_type'    	=> APPTHEMES_ORDER_PTYPE,
			'post_author'  	=> $post->post_author,
			'post_title'	=> sprintf( __( "Funds Transfer for '%s'", APP_TD ), $post->post_title ),
			'post_content' 	=> __( 'Transaction Data', APP_TD )
		);

		$transaction_id = wp_insert_post($args);

		wp_update_post(array(
			'ID' => $transaction_id,
			'post_name' => $transaction_id
		));

		// Associate workspace with order and project

		$p2p_data = array();

		$id = hrb_custom_add_p2p($ID, 0, HRB_P2P_CANDIDATES);
		$p2p_data['candidate_id'] = $id;
		hrb_custom_add_p2pmeta($id, 'proposal_id', $comment_id);
		hrb_custom_add_p2pmeta($id, 'timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'status', HRB_TERMS_ACCEPT);

		$id = hrb_custom_add_p2p($ID, $workspace_id, HRB_P2P_WORKSPACES);
		$p2p_data['workspace_id'] = $id;
		hrb_custom_add_p2pmeta($id, 'timestamp',$time);

		$id = hrb_custom_add_p2p($workspace_id, $current_user->ID, HRB_P2P_PARTICIPANTS);
		$p2p_data['employer_id'] = $id;
		hrb_custom_add_p2pmeta($id, 'timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'type', HRB_ROLE_EMPLOYER);
		hrb_custom_add_p2pmeta($id, 'status', HRB_WORK_STATUS_WAITING);
		hrb_custom_add_p2pmeta($id, 'status_timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'agreement_timestamp', $time);

		$id = hrb_custom_add_p2p($workspace_id, $current_user->ID, HRB_P2P_PARTICIPANTS);
		$p2p_data['worker_id'] = $id;
		hrb_custom_add_p2pmeta($id, 'timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'type', 'worker');
		hrb_custom_add_p2pmeta($id, 'status', HRB_WORK_STATUS_WAITING);
		hrb_custom_add_p2pmeta($id, 'status_timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'agreement_timestamp', $time);
		hrb_custom_add_p2pmeta($id, 'proposal_id', $comment_id);
		hrb_custom_add_p2pmeta($id, 'development_terms', 0);

		$id = hrb_custom_add_p2p($transaction_id, $workspace_id, APPTHEMES_ORDER_CONNECTION);
		hrb_custom_add_p2pmeta($id, 'type', HRB_WORKSPACE_PTYPE);
		hrb_custom_add_p2pmeta($id, 'price', $post_meta['_hrb_budget_price'][0]);

		update_post_meta($ID, '_p2p_data', $p2p_data);

		update_post_meta($ID, '_bid_data', array(
			'updated' => $timestamp
		));
		update_post_meta($ID, '_bids', 0);
		update_post_meta($ID, '_bid_amount_avg', $post_meta['_hrb_budget_price'][0]);

		$hash = substr( sha1( $timestamp . mt_rand( 0, 1000 ) ), 0, 20 );
		update_post_meta($workspace_id, '_hrb_workspace_hash', $hash);

		update_post_meta($ID, '_hrb_workspace', $workspace_id);
		update_post_meta($transaction_id, 'currency', $post_meta['_hrb_budget_currency'][0]);
		update_post_meta($transaction_id, 'ip_address', appthemes_get_ip());
		update_post_meta($transaction_id, 'is_escrow', intval(appthemes_is_escrow_enabled()));
		update_post_meta($transaction_id, 'total_price', $post_meta['_hrb_budget_price'][0]);
		update_post_meta($transaction_id, '_log_messages', array(
			"time" => $timestamp,
			"message" => "Escrow Order Created",
			"type" => "major"
		));

		// Redirect to transfer funds page
		wp_redirect(hrb_get_workspace_transfer_funds_url($workspace_id), 301);
		exit;
	}

	add_action('waiting_funds_to_working', 'hrb_custom_publish_project', 0, 1);
	function hrb_custom_publish_project($post){
		global $wpdb;

		// Remove all unnecessary actions notifications
		remove_all_actions('transition_post_status');
		remove_all_actions('hrb_transition_participant_status');
		remove_all_actions('publish_project');
		remove_all_actions('working_workspace');

		// Change project status to publish and live on site
		if ($post->post_type == HRB_PROJECTS_PTYPE){

			$wpdb->update( $wpdb->posts, array( 'post_status' => 'publish' ), array( 'ID' => $post->ID ) );

			clean_post_cache( $post->ID );

			$old_status = $post->post_status;
			$post->post_status = 'publish';
			wp_transition_post_status( 'publish', $old_status, $post );

			$p2p_data = get_post_meta($post->ID, '_p2p_data', true);
			if ($p2p_id = intval($p2p_data['workspace_id'])){
				$wpdb->update(HRBEE_TABLE_P2P, array('p2p_from' => 0), array('p2p_id' => $p2p_id), array('%d'), array('%d'));
			}
			if ($p2p_id = intval($p2p_data['employer_id'])){
				$wpdb->update(
					HRBEE_TABLE_P2PMETA,
					array('meta_value' => HRB_WORK_STATUS_WAITING),
					array('p2p_id' => $p2p_id, 'meta_key' => 'status'),
					array('%s'),
					array('%d', '%s')
				);
			}
			if ($p2p_id = intval($p2p_data['worker_id'])){
				$wpdb->update(
					HRBEE_TABLE_P2PMETA,
					array('meta_value' => HRB_WORK_STATUS_WORKING),
					array('p2p_id' => $p2p_id, 'meta_key' => 'status'),
					array('%s'),
					array('%d', '%s')
				);
			}

			hrb_new_project_notify_author($post->ID);
			if (get_option('new-project-notification')){
				hrb_custom_new_project_notification($post);
			}
		}
	}

	/**
	 * HBCustom add rating scripts and styles on project page
	 */
	add_action( 'wp_enqueue_scripts', 'hrb_custom_project_rating_scripts' );
	function hrb_custom_project_rating_scripts(){
		if (is_singular(HRB_PROJECTS_PTYPE)){
			// enqeue required styles/scripts
			appthemes_reviews_enqueue_styles();
			appthemes_reviews_enqueue_scripts();
		}
	}

	/**
	 * HBCustom Init Functionally
	 */
	add_action('init', 'hrb_custom_init', 0, 0);
	function hrb_custom_init(){
		remove_filter( 'comments_open', '_hrb_clarification_open', 10 );
		remove_action('appthemes_bid_approved', 'hrb_proposal_notify_parties');
		remove_action('appthemes_transaction_paid', 'hrb_escrow_funds_available_notify', 15);
	}
?>
