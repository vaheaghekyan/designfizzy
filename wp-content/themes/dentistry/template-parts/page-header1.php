<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */
?>
<header class="tp-header"><!-- header start -->
  <div class="container">
    <div class="row">
      <div class="col-md-5"> <!-- logo start -->
          <button class="btn tp-btn-default appointment">MAKE AN APPOINTMENT</button>
	 </div>

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
        <div class="col-md-5 tp-top-link"><!-- top link start -->
            <p class="navbar-text navbar-right"><?php echo dentistry_tg_get_option('header_right_content');?></p>
        </div>
      <!-- /.top link start --> 
    </div>
  </div>
</header>
<!-- /.header start --> 

<div class="tp-navigation" id="nav">
  <nav class="navbar navbar-default navbar-static-top marginBottom-0" role="navigation">
    <div class="container">
		<div id="navigation">
		<?php
        if ( has_nav_menu( 'primary' ) ) {
            wp_nav_menu( array( 
                'theme_location' => 'primary',
                  'container'=>false,
                  'walker'=>new Dentistry_Tg_Menu(),
                  'menu_class'=>'dentistry-main-menu nav navbar-nav',
                ) 
            );
        }
        ?>
        </div>
<!--        --><?php //if(dentistry_tg_get_option('header_search_btn')!=""){ ?><!--  -->
<!--        <form method="get" class="navbar-form navbar-right" action="--><?php //echo home_url( '/' ); ?><!--">-->
<!--          <!-- search form start -->
<!--          <div class="form-group">-->
<!--            <input type="text" class="form-control" value="--><?php //echo esc_attr(get_search_query()); ?><!--" name="s" placeholder="--><?php //echo esc_html__('Search','dentistry');?><!--" >-->
<!--          </div>-->
<!--          <button type="submit" class="btn tp-btn-default"><i class="fa fa-search"></i></button>-->
<!--        </form>-->
<!--        --><?php //} ?>
      <!-- /.navbar-collapse --> 
    </div>
  </nav>
</div>
