<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */

?>
<header class="tp-header header2" id="nav"><!-- header start -->
  <div class="container">
    <div class="row tp-navigation">
      <div class="col-md-2 tp-logo"> <!-- logo start --> 
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
        <div class="col-md-10">
            <nav class="navbar navbar-default navbar-right navbar-static-top marginBottom-0">
                  <div id="navigation">
                    <?php
                        if ( has_nav_menu( 'primary' ) ) {
                            wp_nav_menu( array( 
                                'theme_location' => 'primary',
                                  'container'=>false,
                                  'walker'=>new Dentistry_Tg_Menu(),
                                  'menu_class'=>'st-main-menu nav navbar-nav',
                                ) 
                            );
                        }
                    ?>
                  </div>
              </nav>
        </div>
      <!-- /.top link start --> 
    </div>
  </div>
</header>