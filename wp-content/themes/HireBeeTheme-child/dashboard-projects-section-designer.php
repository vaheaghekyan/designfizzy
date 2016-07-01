<div id="projects">		
		<?php if ( ! empty( $projects ) && $projects->post_count > 0 ): ?>
			<?php while( $projects->have_posts() ) : $projects->the_post(); ?>

				<?php

				if( get_post_type( $project->ID ) == 'project'):
					$project = hrb_get_project( $post );

					$notifications = appthemes_get_user_unread_notifications( $dashboard_user->ID, array( 'project_id' => get_the_ID() ) );

					$participants = hrb_get_post_participants( $project->ID );

					$addons = get_the_hrb_project_addons( get_the_ID() );					

				?>

					<article class="listing">

						<div class="row project-wrapper">
							<div class="large-12 columns ">							
								<div class="large-9 columns projects-section">
									<div class="row project-title-row">
										<div class="large-12 columns">
											<div class="large-7 small-7 columns">
												<h2><?php the_hrb_project_title(); ?></h2>
											</div>											
										</div>	
									</div>
									<div class="row project-desc-info">
										<?php echo $project->post_content; ?>										
									</div>
									<div class="row section-meta-info">
										<div class="large-12 columns">
											<div class="large-3 small-6 columns user-meta-info">
												<?php if ( $project->post_author == $dashboard_user->ID ) : ?>
													<span data-tooltip title="<?php echo esc_attr( __( 'Owned Project', APP_TD ) ); ?>" class="project-authored"><i class="icon i-authored-project"></i></span>
												<?php else: ?>
													<?php the_hrb_user_bulk_info( $project->post_author, 
														array( 
															'show_gravatar' => false, 'show_rating' => false,
															'show_name' => array(
																				'before' => '<label>by</label><span class="user-display-name">',
																				'after' => '</span>',
																				'atts' => array(),
																			),
																			'show_success_rate' => array(
																				'before' => '<span class="user-success-rate">(',
																				'after' => ')</span>',
																				'atts' => array(),
																			),
														) ); 
													?>
												<?php endif; ?>
											</div>
											<div class="large-3 small-6 columns project-date">
												<label> </label>
												<span data-tooltip title="<?php _e( 'Posted Date', APP_TD ); ?>" class="project-date"><?php the_hrb_project_posted_time_ago(); ?></span>
											</div>
											<div class="large-3 small-6 columns project-category">
												<label> </label>
												<span data-tooltip title="<?php _e( 'Days until Expiration', APP_TD ); ?>" class="project-remain-days"></i><?php echo hrb_custom_get_categories_by_project( $project->ID ); ?></span>
											</div>																						
											<div class="large-3 small-6 columns total-proposals">
												<label> Need </label>
												<span data-tooltip title="<?php _e( 'Needs Designer', APP_TD ); ?>" class="total-proposals">													
												<?php 
														$post_id = get_the_hrb_loop_id(0);
														$total = appthemes_get_post_total_bids( $post_id );
														if ($total > 1 ){															
															echo $total ." Designers";
														}else{
															echo $total ." Designer";
														}

												 ?>
												 </span>
											</div>									
										</div>	
									</div>									

								</div><!-- projects-section -->
								<div class="large-3 columns projects-section right-designer">
									<div class="project-remain-days">
										<span data-tooltip title="<?php _e( 'Days until Expiration', APP_TD ); ?>" class="project-remain-days"><?php the_hrb_project_remain_days( $post_id , false); ?></span>
									</div>
									<div class="dashboard-budget">
										<span data-tooltip title="<?php _e( 'Budget', APP_TD ); ?>" class="project-budget"><?php the_hrb_project_budget(); ?></span>
										<span>fixed price</span>
									</div>
								</div>

							</div>
						</div>

					</article>

				<?php endif; ?>	
				
			<?php endwhile; ?>

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