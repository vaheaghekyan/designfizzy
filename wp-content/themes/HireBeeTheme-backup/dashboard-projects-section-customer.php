<div id="projects">

		<div class="dashboard-filters">
			<div class="row">

				<div class="large-12 columns dashboard-filter-sort">										
					<div>
						<?php hrb_output_statuses_fdropdown( $projects_no_filters, $attributes = array( 'name' => 'drop-filter-status', 'label' => __( 'Status', APP_TD ), 'base_link' => hrb_get_dashboard_url_for('projects') ) ); ?>
					</div>
					<div>
						<?php hrb_output_sort_fdropdown(); ?>
					</div>				
					<div>
						<?php hrb_output_results_fdropdown( hrb_get_dashboard_url_for('projects') ); ?>
					</div>
					<div>
						<?php hrb_output_project_relation_fdropdown( $projects_no_filters, $attributes = array( 'name' => 'drop-filter-role', 'label' => __( 'Role', APP_TD ), 'base_link' => hrb_get_dashboard_url_for('projects') ) ); ?>
					</div>
					<div>
						<?php  echo hrb_output_search_product(); ?>
					</div>
				</div>

			</div>
		</div>
		
		<?php $count_project=0; if ( ! empty( $projects ) && $projects->post_count > 0 ): ?>
			<?php while( $projects->have_posts() ) : $projects->the_post(); ?>

				<?php

				if( get_post_type( $project->ID ) == 'project'):
					$post_userid= $post->post_author;
					$current_userid= get_current_user_id();
					
					$project = hrb_get_project( $post );
                   
					$notifications = appthemes_get_user_unread_notifications( $dashboard_user->ID, array( 'project_id' => get_the_ID() ) );

					$participants = hrb_get_post_participants( $project->ID );

					$addons = get_the_hrb_project_addons( get_the_ID() );

				?>
              
<?php  if($post_userid==$current_userid){ $count_project++; ?>
  
					<article class="listing">

						<div class="row project-wrapper">
							<div class="large-12 columns ">
							<?php /*
								<div class="large-2 columns user-meta-info">

									<?php if ( $project->post_author == $dashboard_user->ID ) : ?>
										<span data-tooltip title="<?php echo esc_attr( __( 'Owned Project', APP_TD ) ); ?>" class="project-authored"><i class="icon i-authored-project"></i></span>
									<?php else: ?>
										<?php the_hrb_user_bulk_info( $project->post_author, array( 'show_gravatar' => array( 'size' => 55 ) ) ); ?>
									<?php endif; ?>

								</div>
							*/ ?>
								<div class="large-12 columns projects-section">
									<div class="row project-title-row">
										<div class="large-12 columns">
											<div class="large-7 small-7 columns">
												<h2><?php the_hrb_project_title(); ?></h2>
											</div>
											<div class="large-5 small-5 columns project-meta-info">
												<span data-tooltip title="<?php echo esc_attr( __( 'Status', APP_TD ) ); ?>" class="label project-status <?php echo esc_attr( get_the_hrb_project_or_workspace_status() ); ?>"><?php the_hrb_project_or_workspace_status(); ?></span>
												<span><?php the_hrb_dashboard_project_actions( $post ); ?></span>
											</div>
										</div>	
									</div>
									<?php if( $participants ): ?>
									<div class="row project-participants">
										<div class="large-12 columns">
											<label>Designer:</label> 												
											<?php foreach( $participants->results as $worker ): ?>
												 	<?php
												 		$workspaces_ids = hrb_get_participants_workspace_for( $post->ID, array( $project->post_author, $worker->ID, $dashboard_user->ID ) );
														if ( ! $workspaces_ids ) {
															continue;
														}

														$proposals = hrb_get_proposals_by_user( $worker->ID, array( 'post_id' => $post->ID ) );
														if ( empty( $proposals['results'] ) ) {
															continue;
														}

														$proposal = reset( $proposals['results'] );

														$dispute = '';

														if ( hrb_is_disputes_enabled() ) {
															$dispute = appthemes_get_disputes_for( $workspaces_ids );
															$dispute = reset( $dispute );
														}
													
													?>
													
													<span data-tooltip 	title="<?php echo esc_attr( __( 'Participant', APP_TD ) ); ?>">
														<?php the_hrb_user_gravatar( $worker, 25 ); ?>

														<?php if ( $dispute && 'publish' == $dispute->post_status ) : ?>
																<div class="label dispute-status right"><i class="icon i-dispute"></i><?php echo __( 'Opened Dispute', APP_TD ); ?></div>
														<?php endif; ?>

														<?php
															if ( $worker->ID != $dashboard_user->ID ) {
																the_hrb_user_display_name( $worker );
															} else {
																echo __( 'You', APP_TD );
															}
														?>
													</span>
											<?php endforeach; ?>

										</div>
									</div>
									<?php endif; ?>
									<div class="row section-meta-info">
										<div class="large-12 columns">
											<div class="large-3 small-6 columns project-date">
												<label>Posted: </label>
												<span data-tooltip title="<?php _e( 'Posted Date', APP_TD ); ?>" class="project-date"><?php the_hrb_project_posted_time_ago(); ?></span>
											</div>
											<div class="large-3 small-6 columns project-category">
												<label>Category: </label>
												<span data-tooltip title="<?php _e( 'Days until Expiration', APP_TD ); ?>" class="project-remain-days"></i><?php echo hrb_custom_get_categories_by_project( $project->ID ); ?></span>
											</div>
											<div class="large-3 small-6 columns project-price">
												<label>Total Price: </label>
												<span data-tooltip title="<?php _e( 'Budget', APP_TD ); ?>" class="project-budget"></i><?php the_hrb_project_budget(); ?></span>
											</div>
											<div class="large-3 small-6 columns project-notification">											
												<a href="<?php echo esc_url( hrb_get_dashboard_url_for( 'notifications' ) ); ?>"><span data-tooltip title="<?php echo esc_attr( __( 'Notifications', APP_TD ) ); ?>"></i><?php echo $notifications->found; ?></span></a>
												<label>Notification<?php if ($notifications->found >1 ) echo 's'; ?></label>
											</div>										
										</div>	
									</div>									

								</div><!-- projects-section -->

							</div>
						</div>

					</article>
    
     
     
<?php }?>



				<?php  endif;  ?>	
				
			<?php endwhile;  ?>
         <?php if(!$count_project){ ?>
         <center><h3>No projects found.Click <a href="/post-a-project" >here</a> to post a project new.</h3></center>
         <?php } ?>   
            
            

		<?php else: ?>

			<?php if ( current_user_can( 'edit_projects') ): ?>

					<h5 class="no-results"><?php echo sprintf( __( 'No projects found. Click <a href="%s">here</a> to post a project now.', APP_TD ), esc_url( get_the_hrb_project_create_url() ) ); ?></h5>

			<?php else: ?>

					<h5 class="no-results"><?php echo __( 'No projects found.', APP_TD ); ?></h5>

			<?php endif; ?>

	<?php endif; ?>

	<!-- ad space -->
	<?php hrb_display_ad_sidebar( 'hrb-project-ads' ); ?>

	<!-- pagination -->
	<?php	
	if ( ! empty( $projects ) && $projects->max_num_pages > 1 ) :
		hrb_output_pagination( $projects, '', hrb_get_dashboard_url_for( 'projects' ) );
	endif;
	?>

</div>