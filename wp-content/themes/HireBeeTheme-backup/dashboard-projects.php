<?php 
	if($dashboard_user->roles[0] == "employer_freelancer" || $dashboard_user->roles[0] == "administrator" ){
?>
<h2><?php echo __( 'Projects', APP_TD  ); ?>
<a href="/post-a-project" class="button large">Add a Project</a>
</h2>

<div class="row content-projects">
	<div class="large-12 columns">

		<div class="section-container auto section-tabs project-trunk" data-section>
   			<section class="<?php echo esc_attr( 'projects' == hrb_get_dashboard_page() ? 'active' : '' ); ?>">

				<div class="content" data-section-content>
				
					<?php appthemes_load_template( 'dashboard-projects-section-projects.php', array( 'projects_no_filters' => $projects_no_filters, 'projects' => $projects ) ); ?>

				</div>

			</section>
			<?php /*
			<section class="<?php echo esc_attr( 'favorites' == hrb_get_dashboard_page() ? 'active' : '' ); ?>">

				<p class="title" data-section-title=""><a href="#favorites"><?php echo __( 'Favorites', APP_TD ); ?></a></p>

				<div class="content" data-section-content>

					<?php appthemes_load_template( 'dashboard-projects-section-favorites.php', array( 'projects' => $favorites ) ); ?>

				</div>

			</section>
			*/ ?>
			<?php do_action( 'hrb_dashboard_projects_tabs' ); ?>

		</div>

	</div>
</div>
<?php 
}elseif($dashboard_user->roles[0] == "freelancer" || $dashboard_user->roles[0] == "administrator"){
?>

<div class="dashboard-filters dashboard-designer">	
	<div class="row dashboard-filter-sort">		
		<h2><?php echo __( 'Projects', APP_TD  ); ?></h2>		
		<div>
			<?php  echo hrb_output_search_product(); ?>
		</div>		
		<div>
			<?php hrb_output_sort_fdropdown(); ?>
		</div>				
		<div>
			<?php hrb_output_results_fdropdown( hrb_get_dashboard_url_for('projects') ); ?>
		</div>				
	</div>
</div>

<div class="row content-projects content-designer">
	<div class="large-12 columns">

		<div class="section-container auto section-tabs project-trunk" data-section>
   			<section class="<?php echo esc_attr( 'projects' == hrb_get_dashboard_page() ? 'active' : '' ); ?>">

				<div class="content" data-section-content>

					<?php appthemes_load_template( 'dashboard-projects-section-designer.php', array( 'projects_no_filters' => $projects_no_filters, 'projects' => $projects ) ); ?>

				</div>

			</section>			
			<?php do_action( 'hrb_dashboard_projects_tabs' ); ?>

		</div>

	</div>
</div>
<?php 
}elseif($dashboard_user->roles[0] == "employer" ){
?>
<h2><?php echo __( 'Projects', APP_TD  ); ?>
<a href="/post-a-project" class="button large">Add a Project</a>
</h2>

<div class="row content-projects">
	<div class="large-12 columns">

		<div class="section-container auto section-tabs project-trunk" data-section>
   			<section class="<?php echo esc_attr( 'projects' == hrb_get_dashboard_page() ? 'active' : '' ); ?>">

				<div class="content" data-section-content>
				
<?php appthemes_load_template( 'dashboard-projects-section-customer.php', array( 'projects_no_filters' => $projects_no_filters, 'projects' => $projects ) ); ?>

				</div>

			</section>
			<?php /*
			<section class="<?php echo esc_attr( 'favorites' == hrb_get_dashboard_page() ? 'active' : '' ); ?>">

				<p class="title" data-section-title=""><a href="#favorites"><?php echo __( 'Favorites', APP_TD ); ?></a></p>

				<div class="content" data-section-content>

					<?php appthemes_load_template( 'dashboard-projects-section-favorites.php', array( 'projects' => $favorites ) ); ?>

				</div>

			</section>
			*/ ?>
			<?php do_action( 'hrb_dashboard_projects_tabs' ); ?>

		</div>

	</div>
</div>

<?php
} 
?>
