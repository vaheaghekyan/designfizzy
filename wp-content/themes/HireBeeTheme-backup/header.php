<!-- Header ad space -->
<?php hrb_display_ad_sidebar( 'hrb-header', $position = 'header' ); ?>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:300,300italic,600,600italic' rel='stylesheet' type='text/css'>
<div class="top-navigation">
	<div class="row">
		<div class="large-12 columns">
			<nav class="top-bar">
				<ul class="title-area">
					<!-- Title Area -->
					<li class="name"></li>
					<li class="toggle-topbar menu-icon"><a href="#"><span><?php echo __( 'Menu', APP_TD ); ?></span></a></li>
				</ul>

				<section class="top-bar-section">
					<!-- Left Nav Section -->
					<ul class="left">
						<?php the_hrb_logo(); ?>
					</ul>
				</section>

				<section class="top-bar-section">
					<!-- Right Nav Section -->
					<ul class="right">
						<?php do_action( 'hrb_before_user_nav_links' ); ?>

						<?php the_hrb_user_nav_links(); ?>

						<?php do_action( 'hrb_after_user_nav_links' ); ?>
					</ul>
				</section>
			</nav>
		</div><!-- end columns -->
	</div><!-- end row -->
</div><!-- end top-navigation -->
<?php 	
	if( $dashboard_user->roles[0] == ''):
?>
<div class="main-navigation">
	<div class="row">
		<div class="large-12 columns">
			<nav class="top-bar lower-top-bar">
				<ul class="title-area">
					<!-- Title Area -->
					<li class="name"></li>
					<li class="toggle-topbar menu-icon"><a href="#"><span></span></a></li>
				</ul>
				<section class="top-bar-section">
					<!-- Left Nav Section -->
					<?php the_hrb_nav_menu(); ?>
				</section>
			</nav>
		</div><!-- end columns -->
	</div><!-- end row -->
</div>
<?php endif; ?>

<?php if ( ( 'front' == $hrb_options->custom_header_vis && is_front_page() ) || 'any' == $hrb_options->custom_header_vis ): ?>

	<!-- widgetized area below navbar -->
	<?php hrb_display_ad_sidebar( 'hrb-header-nav', $position = 'inside' ); ?>

<?php endif; ?>

<?php if ( $hrb_options->categories_menu['show'] && ! is_page_template('categories-list-project.php') ): ?>

	<!-- optional category lists -->
	<div class="row category-row categories-menu <?php echo ( 'click' == $hrb_options->categories_menu['show'] && ! wp_is_mobile() ? 'click-cat-menu' : '' ); ?>">
		<div class="large-12 columns">
			<?php the_hrb_project_categories_list('categories_menu'); ?>
		</div>
	</div>

<?php endif; ?>



