<?php
	$project = get_post();
	$workspace_id = hrb_p2p_get_post_workspaces($project->ID)->post->ID;
	$participant = hrb_p2p_get_participant( $workspace_id, get_current_user_id() );	
	$can_edit = current_user_can( 'edit_workspace', $workspace_id );	
?>

<form id="manage_project" name="manage_project" method="post" class="custom_review_confirm" action="<?php echo get_permalink($project); ?>#rating">
<?php if ('employer' == $participant->type) : 
			if (hrb_is_work_ended( $workspace_id ) ):
	?>
				<input type="button" class="button-primary button button-small hb_custom_request_confirm" id="hb_custom_request_modification" value="Request Modification">
				or
				<input type="button" class="button-primary button button-small hb_custom_request_confirm" id="hb_custom_review_complete_order" value="Review and Complete Order">

				<input type="hidden" name="project_status" value="working">

<?php 
			endif;
		elseif ('worker' == $participant->type) : 

				if( !hrb_is_work_ended( $workspace_id ) ):

			?>
				<input type="button" class="button-primary button button-small hb_custom_request_confirm" id="hb_custom_request_complete" value="Complete Project">

				<input type="hidden" name="work_status" value="completed">

<?php 		
			endif;
			
	endif; ?>	

<?php 
	// nonce && hidden fields
	wp_nonce_field('hrb-manage-project');

	hrb_hidden_input_fields( array(
		'workspace_id'	=> $workspace_id,
		'project_id'	=> esc_attr( $project->ID ),
		'action'		=> 'manage_project',
		//'project_status' => 'working',
	) );	
	
?>
</form>