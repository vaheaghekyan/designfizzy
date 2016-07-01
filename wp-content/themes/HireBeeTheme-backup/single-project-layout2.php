
<div id="main" class="large-12 columns">

	<!-- project -->
	<div id="project" <?php post_class( 'single-project' ); ?>>

		<div class="section-container project-leaves">

			<div class="project-header-wrapper">

				<div class="single-project-header row">

					<div class="cf">

						<div class="budget-deadline large-2 small-6 columns">

							<div class="project-budget"  data-tooltip title="<?php echo $project_author->display_name; ?>">
								<span class="budget"><?php echo $project_author->display_name; ?></span>
								<span class="budget-type"><?php echo __( 'Posted by', APP_TD ); ?></span>
							</div>

						</div>

						<div class="budget-deadline large-2 small-6 columns">

							<div class="project-budget"  data-tooltip title="<?php echo __( 'Rating Author', APP_TD ); ?>">
								<span class="budget"><?php the_hrb_user_avg_rating( $project_author ); ?></span>
								<span class="budget-type"><?php echo __( 'Rating Author', APP_TD ); ?></span>
							</div>

						</div>

						<div class="budget-deadline large-2 small-6 columns">

							<div class="project-budget"  data-tooltip title="<?php hb_custom_get_assigned_freelancer(get_the_ID(), 'title');?>">
								<span class="budget"><?php hb_custom_get_assigned_freelancer(get_the_ID());?></span>
								<span class="budget-type"><?php echo __( 'Accepted by', APP_TD ); ?></span>
							</div>

						</div>

						<div class="budget-deadline large-2 small-6 columns">

							<div class="project-budget"  data-tooltip title="<?php hrb_custom_get_categories_by_project(get_the_ID()); ?>">
								<span class="budget"><?php hrb_custom_get_categories_by_project(get_the_ID()); ?></span>
								<span class="budget-type"><?php echo __( 'Category', APP_TD ); ?></span>
							</div>

						</div>

						<div class="budget-deadline large-2 small-6 columns">

							<div class="project-budget"  data-tooltip title="<?php echo __( 'Project Budget', APP_TD ); ?>">
								<span class="budget"><?php the_hrb_project_budget(); ?></span>
								<span class="budget-type"><?php echo the_hrb_project_budget_type(); ?></span>
							</div>

						</div>

						<div class="budget-deadline large-2 small-6 columns">
								<?php $remain_days = get_the_hrb_project_remain_days(); ?>

								<?php if ( '' !== $remain_days ): ?>
									<div class="<?php echo ( $remain_days < 0 ? 'project-expired' : '' ); ?>" data-tooltip title="<?php echo __( 'Time Until Expiration', APP_TD ); ?>">
										<div class="project-expires">
											<?php //the_hrb_project_remain_days(); ?>
											<?php hrb_custom_project_remain_days(); ?>
										</div>
									</div>
								<?php endif; ?>

						</div>
					</div>
				</div><!--end row -->

			</div><!--end wrapper -->

			<article class="project">

				<div class="article-header row collapse">

					<div class="large-4 small-6 columns add-ons">
						<?php the_hrb_project_addons(); ?>
					</div>

				</div><!-- end row -->

				<?php if ( function_exists('sharethis_button') && $hrb_options->listing_sharethis ): ?>

					<div class="row share-this">
						<div class="large-12 columns">
							<div><?php sharethis_button(); ?></div>
						</div>
					</div>

				<?php endif; ?>

				<div class="article-header row">
					<div class="large-9 small-9 columns article-title">

						<?php appthemes_before_post_title( HRB_PROJECTS_PTYPE ); ?>

						<h3><?php the_title(); ?></h3>

						<?php appthemes_after_post_title( HRB_PROJECTS_PTYPE ); ?>

					</div>

					<div class="large-3 columns single-project-meta-buttons">
						<?php the_hrb_custom_create_edit_proposal_link(); ?>
						<?php //the_hrb_create_edit_proposal_link();?>
						<?php //the_hrb_project_actions(); ?>
					</div>

				</div><!-- end row -->

				<div class="row">
					<div class="large-12 columns">
						<div class="section-container auto section-tabs project-trunk" data-section>

							<!-- dynamic content within tabs -->

							<section class="active">

								<p class="title"><a href="#details"><?php echo __( 'Details', APP_TD ); ?></a></p>

								<div class="content" data-section-content>

									<?php appthemes_load_template( 'single-project-section-details.php' ); ?>

									<div class="row">
										<div class="large-12 columns">
											<div class="section-container project-branches">
												<div class="project-custom-fields">
													<?php the_hrb_project_custom_fields( get_the_ID(), 'file', $include = false ); ?>
												</div>

												<div class="project-files">
													<?php the_hrb_project_files( get_the_ID(), '<fieldset><legend>'.__( 'Attachments' ).'</legend>', '</fieldset>' ); ?>
												</div>
											</div>
										</div>
									</div>

								</div>

							</section>
<?php /*
							<section>

								<p class="title"><a href="#proposals"><?php echo sprintf( __( 'Proposals (%s)', APP_TD ), appthemes_get_post_total_bids( get_the_ID() ) ); ?></a></p>
								<div class="content" data-section-content>

									<?php appthemes_load_template( 'single-project-section-proposals.php', array( 'proposals' => $proposals ) ); ?>

								</div>

							</section>
*/ ?>
							<?php if ( $hrb_options->projects_clarification ): ?>

							<section>

								<p class="title"><a href="#clarification"><?php echo sprintf( __( 'Clarification Board (%s)', APP_TD ), get_comments_number() ); ?></a></p>

								<div class="content" data-section-content>

									<?php appthemes_load_template( 'single-project-section-clarification.php' ); ?>

								</div>

							</section>

							<?php endif; ?>

							<?php if ( HRB_PROJECT_STATUS_WORKING == get_post_status() && hrb_custom_is_project_access() ): ?>

							<section>

								<p class="title"><a href="#manage"><?php echo __( 'Update Status', APP_TD ); ?></a></p>

								<div class="content dashboard-workspace" data-section-content>

									<?php appthemes_load_template( 'form-workspace-manage.php'); ?>

								</div>

							</section>

							<?php endif; ?>

							<?php if ( hrb_custom_is_project_review_access() ) : ?>

							<section>

								<p class="title"><a href="#rating"><?php echo __( 'Rate Designer', APP_TD ); ?></a></p>

								<div class="content dashboard-workspace" data-section-content>

									<?php appthemes_load_template( 'form-project-review.php' ); ?>

								</div>

							</section>

							<?php endif; ?>

						</div>
					</div>
				</div>

			</article>

		</div><!-- end section-container -->

	</div><!-- end #project -->

	<!-- ad space -->
	<?php hrb_display_ad_sidebar( 'hrb-single_project_ad_space' ); ?>

</div><!-- end #main -->