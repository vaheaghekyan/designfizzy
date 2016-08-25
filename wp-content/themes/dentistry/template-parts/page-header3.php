<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */
?>
<header class="tp-header-4 header3 tp-header">
<!-- header start -->
<div class="container">
  <div class="row">
    <div class="col-md-4 header-btn"><!-- top link start --> 
      <?php echo dentistry_tg_get_option('header_left_content');?>
    </div>
    <div class="col-md-4 tp-logo-4"> <!-- logo start --> 
			<?php 
            if(dentistry_tg_get_option('checker')!=""){ ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            	<?php } else{ ?>		
            <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
            <?php if(dentistry_tg_get_option('logo')!=""){ 	?>
            	<img src="<?php echo esc_url(dentistry_tg_get_option('logo')); ?>" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
            <?php 	
            } else {?>
            	<img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php bloginfo( 'name' ); ?>" class="img-responsive">
            <?php } ?>
            </a>      
            <?php } ?> 
	</div>
    <!-- /.logo start -->
    <div class="col-md-4 mt20 header-call">
      <?php echo dentistry_tg_get_option('header_right_content');?>
    </div>
  </div>
  </div></header>
  
<div class="tp-navigation" id="nav">
  <nav class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
		<div id="navigation" class="text-center">
		<?php
        if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array( 
                'theme_location' => 'primary',
                  'container'=>false,
                  'walker'=>new Dentistry_Tg_Menu(),
                  'menu_class'=>'dentistry-main-menu',
                ) 
            );
        }
        ?>
        </div>
      <!-- /.navbar-collapse --> 
    </div>
  </nav>
</div>