<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dentistry
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
 if ( ! function_exists( '_wp_render_title_tag' ) ) :
     function theme_slug_render_title() {
?>
<title><?php wp_title( '|', false, 'right' ); ?></title>
<?php
     }
     add_action( 'wp_head', 'theme_slug_render_title' );
endif;
?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
if(dentistry_tg_get_option('main_layout')=="boxed"){
	echo '<div class="main-holder">';
}
?>
<div class="tp-top-bar"><!-- top bar start -->
  <div class="container">
    <div class="row">
      <div class="col-md-6 clinic-address">
      	<?php if(dentistry_tg_get_option('clinic_address')!=""){ ?>
        	<div><?php echo dentistry_tg_get_option('clinic_address');?></div>
        <?php } ?>
      </div>
      <div class="col-md-6 tp-social">
        <ul>
        <?php 
		 if(dentistry_tg_get_option('top_social_fb')!=""){
        	echo '<li><a href="'.dentistry_tg_get_option('top_social_fb').'"><i class="fa fa-facebook fa-2x"></i></a></li>';
         }
		 if(dentistry_tg_get_option('top_social_tw')!=""){
        	echo '<li><a href="'.dentistry_tg_get_option('top_social_tw').'"><i class="fa fa-twitter fa-2x"></i></a></li>';
         }
		 if(dentistry_tg_get_option('top_social_google_plus')!=""){
        	echo '<li><a href="'.dentistry_tg_get_option('top_social_google_plus').'"><i class="fa fa-instagram fa-2x"></i></a></li>';
         }
		 if(dentistry_tg_get_option('top_social_linkedin')!=""){
        	echo '<li><a href="'.dentistry_tg_get_option('top_social_linkedin').'"><i class="fa fa-linkedin"></i></a></li>';
         }
		?>
        </ul>
      </div>
    </div>
  </div>
</div>
<?php

$header_option=dentistry_tg_get_option('header_option');
if($header_option=='first')
{
	get_template_part( 'template-parts/page', 'header1' ); 
}
else if($header_option=='second')
{
	get_template_part( 'template-parts/page', 'header2' ); 
}
else if($header_option=='third')
{
	get_template_part( 'template-parts/page', 'header3' ); 
}
else 
{
	get_template_part( 'template-parts/page', 'header1' ); 
}

if(!is_front_page() && !is_page_template('page-templates/page-slider.php'))
{
	if(function_exists('bcn_display'))
	{
?>    
<div class="tp-page-header">
  <div class="container">
	<div class="row">
	  <div class="col-md-12 page-caption tp-breadcrumb">
		<ol class="breadcrumb">
		  <li>
		  <?php 
			bcn_display();		 
		  ?>
		  </li>
		</ol>
	  </div>
	</div>
  </div>
</div>
<!-- tp breadcrumb --> 
<?php 
	}
}
?>  