<?php
	$project = get_post();
	$workspace_id = hrb_p2p_get_post_workspaces($project->ID)->post->ID;
	$participant = hrb_p2p_get_participant( $workspace_id, get_current_user_id() );	
	$can_edit = current_user_can( 'edit_workspace', $workspace_id );	
?>
<div class="manage-project">
	<form id="manage_project" name="manage_project" method="post" class="custom" action="<?php echo get_permalink($project); ?>#rating">
		<fieldset>
			<legend><?php _e( 'Current Status:', APP_TD ) ?> <?php echo hrb_get_project_statuses_verbiages( $project->post_status ); ?></legend>

		<?php if ('employer' == $participant->type) : ?>

			<div class="row">
				<div class="large-6 small-10 columns">
					<div class="row collapse">
						<div class="large-5 small-5 columns">
							<span class="prefix"><?php echo __( 'Status', APP_TD ); ?></span>
						</div>
						<div class="large-7 small-7 columns">
							<select name="project_status" <?php disabled( ! $can_edit ); ?>>
								<?php foreach( get_the_hrb_participant_sel_statuses( $participant, $workspace_id ) as $status ): ?>
									<option value="<?php echo esc_attr( $status ); ?>" <?php selected( $project->post_status == $status ); ?> ><?php echo hrb_get_project_statuses_verbiages( $status ); ?></option>
								<?php endforeach; ?>
							</select>
						</div>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="large-12 columns">
					<textarea id="project_end_notes" name="project_end_notes" <?php disabled( ! $can_edit ); ?> placeholder="<?php echo esc_attr( __( 'Closing Notes', APP_TD ) ); ?>"></textarea>
				</div>
			</div>

			<?php if ( $can_edit ): ?>

				<div class="row">
					<div class="large-12 columns">
						<input type="submit" id="end_project" name="end_project" class="button" value="<?php echo __( 'Update', APP_TD ); ?>"/>
					</div>
				</div>

			<?php endif; ?>

		<?php elseif ('worker' == $participant->type) : ?>

				<div class="row">
					<div class="large-6 small-10 columns">
						<div class="row collapse">
							<div class="large-5 small-5 columns">
								<span class="prefix"><?php echo __( 'Status', APP_TD ); ?></span>
							</div>
							<div class="large-7 small-7 columns">
								<select name="work_status">
									<?php foreach( get_the_hrb_participant_sel_statuses( $participant, $workspace_id ) as $status ): ?>
										<option value="<?php echo esc_attr( $status ); ?>" <?php selected( $status == $participant->status ); ?> ><?php echo hrb_get_participants_statuses_verbiages( $status ); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<textarea id="work_end_notes" name="work_end_notes" placeholder="<?php echo esc_attr( __( 'Closing notes', APP_TD ) ); ?>"><?php echo $participant->status_notes; ?></textarea>
					</div>
				</div>
				<div class="row">
					<div class="large-12 columns">
						<input type="submit" id="end_work" name="end_work" class="button" onclick="return confirm('<?php echo __( "Are you sure?", APP_TD ); ?>'); return false;" value="<?php echo ( ! $participant->status ? __( 'End Work', APP_TD ) : __( 'Update', APP_TD ) ); ?>" />
					</div>
				</div>

		<?php endif; ?>
	<?php

	// nonce && hidden fields
	wp_nonce_field('hrb-manage-project');

	hrb_hidden_input_fields( array(
		'workspace_id'	=> $workspace_id,
		'project_id'	=> esc_attr( $project->ID ),
		'action'		=> 'manage_project',
	) );
	?>
		</fieldset>
	</form>
</div>