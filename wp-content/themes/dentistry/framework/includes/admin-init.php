<?php
	/*-----------------------------------------------------------*
	/* 			DEFAULT THEME OPTIONS
	/*-----------------------------------------------------------*/
	add_action( 'after_setup_theme', 'dentistry_tg_default_options' );
	
	function dentistry_tg_default_options() {
		$options = array(
			'logo'     					=> get_template_directory_uri().'/images/logo.png',
			'favicon'  					=> get_template_directory_uri().'/images/favicon.ico',
			'header_right_content' 		=> '<a class="link" href="#"><i class="fa fa-comments-o"></i> +02 9389 4748</a> ',
			'header_left_content'		=> '<a class="tp-btn tp-btn-default" href="#">Get emergency</a>',
			'clinic_address'	    	=> '<i class="fa fa-map-marker"></i> 3 Bellevue Road Bellevue Hill NSW 2023 Australia',
			'top_social_fb'  			=> '#',			
			'top_social_tw'  			=> '#',			
			'top_social_google_plus'	=> '#',	
			'top_social_linkedin'		=> '#',						
			'top_social_instagram'		=> '#',
			'header_search_btn'			=> 'searchboxshowhide',
			'background_color'  		=> '#ffffff',
			'boxed_bg_color'	  		=> '#ffffff',
			'accent_color' 				=> '#323634',
			'accent_hover_color' 		=> '#f05b43',				
			'google_font'				=> 'Montserrat:400,700',
			'custome_css' 				=> '',
			'font-size-h1'  			=> '32',
			'font-weight-h1' 			=> '400',
			'font-color-h1' 			=> '#323634',
			'font-size-h2'  			=> '24',
			'font-weight-h2' 			=> '400',
			'font-color-h2' 			=> '#323634',
			'font-size-h3'  			=> '18',
			'font-weight-h3' 			=> '400',
			'font-color-h3' 			=> '#323634',
			'font-size-h4'  			=> '16',
			'font-weight-h4' 			=> '400',
			'font-color-h4' 			=> '#323634',			
			'font-size-p'  				=> '14',
			'font-weight-p' 			=> '400',
			'font-color-p' 				=> '#717774',
			'header_top_bk_color'  		=> '#f5f5f0',
			'header_bk_color'   		=> '#fff',
			'menu_bk_color'				=> '#3fce92',
			'menu_text_color'			=> '#ffffff',
			'menu_text_hover_color'		=> '#F5F5F0',
			'menu_sub_text_color'		=> '#ffffff',
			'menu_sub_text_hover_color'	=> '#F5F5F0',			
			'menu_sub_bg_color'			=> '#25b679',					
			'breadcrumb_bk_color'		=> '#fafaf6',
			'breadcrumb_bk_image'		=> get_template_directory_uri().'/images/ptn.png',				
			'footer_bk_color'			=> '#212423',
			'footer_heading_color'		=> '#ffffff',	
			'footer_accent_color'       => '#515654',			
			'footer_accent_hover_color' => '#f05b43',			
			'footer_text_color'			=> '#515654',
			'currency_symbols'			=> '&#36;',
			'animatespeed'				=> '500',
			'control_nav'				=> 'controlnav',
			'directive_nav'				=> 'directionnav',
			'slider_title_color'        => '#000000',
			'slider_text_color'         => '#717774',			
			'slider_btn_bkcolor'        => '#3FCE92',
			'slider_btn_txtcolor'		=> '#FFFFFF', 
			'slider_btn_bkcolor_hover'	=> '#f05b43', 			
			'slider_arrow_bkcolor'      => '#3FCE92',
			'slider_arrow_bkcolor_hover'=> '#333333', 
			'slider_pagination'			=> '#eef5f2',
			'slider_effect'				=> 'fade',	

			'primary_btn_bg_color'		=> '#f05b43',
			'primary_btn_color'			=> '#ffffff',
			'primary_btn_hover_bg_color'=> '#2aa9e0',
			'primary_btn_hover_color'	=> '#ffffff',	

			'second_btn_bg_color'		=> '#a8afac',
			'second_btn_color'			=> '#ffffff',
			'second_btn_hover_bg_color' => '#f05b43',
			'second_btn_hover_color'	=> '#ffffff',																	 
						
			'footer_code'				=> '<div class="tp-cta"><div class="container">
	  		<div class="row"><div class="col-md-2 cta-icon"><img src="http://thegenius.co/dentistry/demo/wp-content/uploads/2015/10/teeth_2.png" alt=""></div><div class="col-md-7 cta-content"><h2>We are dedicated to giving each of our patients the healthy smile they deserve!</h2></div>
				<div class="col-md-3 cta-btn"><a href="#" class="btn tp-btn-default">Get Emergancy</a></div></div></div></div>',
							
			'sub_footer'				=> '<div class="row">
											<div class="col-md-9 ft-contact">
											<h3>Contact Us</h3>
											<div class="row">
											  <div class="col-md-4 ft-address">
												<div><i class="fa fa-map-marker"></i>28 Jackson BLVD STE 1020 Chicago, IL 60604-2340 </div>
											  </div>
											  <div class="col-md-4 ft-phone">
												<div><i class="fa fa-phone"></i>1800-123-4567</div>
											  </div>
											  <div class="col-md-4 ft-mail">
												<div><i class="fa fa-envelope"></i><a href="mailto:info@denistry.com">info@denistry.com</a></div>
											  </div>
											</div>
											</div>
											<div class="col-md-3 ft-btn"><a class="btn tp-btn-default" href="#">get  Emergency</a></div>
											</div>',
			'copyright'					=> 'All rights reserved 2015 &copy; Dentistry',
			'social_facebook'			=> '#',
			'social_twitter'			=> '#',
			'social_google_plus'		=> '#',
			'social_youtube'			=> '#',
			'social_instagram'			=> '#',
			'main_layout'				=> 'full',
			'header_option'				=> 'first',
			'blog_layout'				=> 'blog_right',
			'color_layout'				=> 'green',
			'service_layout'			=> 'right_sidebar',						
	    );
	    return $options;				
	}

	/*-----------------------------------------------------------*
	/* 			THEME OPTION PAGE
	/*-----------------------------------------------------------*/

	add_action( 'admin_init', 'dentistry_tg_add_options' );
	function dentistry_tg_add_options() {
		// Register new options
		register_setting( 'thege_options', 'thege_options', 'dentistry_tg_options_validate' );
	}

	/*-----------------------------------------------------------*
	/* 			THEME OPTION ADMIN IN MENU
	/*-----------------------------------------------------------*/

	add_action( 'admin_menu', 'dentistry_tg_add_page' );
	function dentistry_tg_add_page() {
		$dentistry_tg_options_page = add_theme_page( 'Theme Option', 'Theme Option', 'manage_options', 'options_page', 'dentistry_tg_options_page' );
		add_action( 'admin_print_scripts-' . $dentistry_tg_options_page, 'dentistry_tg_print_scripts' );
	}
	
	function dentistry_tg_get_option($key)
	{
		$arr=get_option( 'thege_options' );
		if( isset( $arr[$key])) {
			return $arr[$key];
		}
	}
	
	function dentistry_tg_print_scripts() {
		wp_enqueue_style('thickbox'); // Stylesheet used by Thickbox
		wp_enqueue_script('thickbox');
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thege-upload', get_template_directory_uri().'/framework/js/thege-upload.js', array( 'thickbox', 'media-upload' ) );
		wp_enqueue_script('bootstrap', get_template_directory_uri().'/framework/js/bootstrap.js');	
		wp_enqueue_script('script', get_template_directory_uri().'/framework/js/script.js');
		wp_enqueue_style('bootstrap', get_template_directory_uri().'/framework/css/bootstrap.css');
		wp_enqueue_style('bootstrap.vertical-tabs', get_template_directory_uri().'/framework/css/bootstrap.vertical-tabs.css');		
	}	
	add_action( 'admin_enqueue_scripts', 'dentistry_enqueue_color_picker' );
	
	function dentistry_enqueue_color_picker( ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'my-script-handle1', get_template_directory_uri().'/framework/js/custom.js', array('wp-color-picker'),true);
	}

	add_action( 'wp_head', 'dentistry_action_head_hook' );
	function dentistry_action_head_hook() {
		
		/*  background color  */
		 $background_color =  dentistry_tg_get_option('background_color');
		 $boxed_bg_color =  dentistry_tg_get_option('boxed_bg_color');

		 $accent_color = dentistry_tg_get_option('accent_color');
		 $accent_hover_color = dentistry_tg_get_option('accent_hover_color');
		 
		 $custome_css = dentistry_tg_get_option('custome_css');

		 /*  header_background_color  */
		 $top_h_bk = dentistry_tg_get_option('header_top_bk_color');		 
		 $h_bk = dentistry_tg_get_option('header_bk_color');
		 $m_bk = dentistry_tg_get_option('menu_bk_color');

		 $breadcrumb_bk_color = dentistry_tg_get_option('breadcrumb_bk_color');


		 $menu_text = dentistry_tg_get_option('menu_text_color');
		 $menu_text_hover = dentistry_tg_get_option('menu_text_hover_color');
		 
 		 $menu_sub_bg_color = dentistry_tg_get_option('menu_sub_bg_color');
		 $menu_sub_text_color = dentistry_tg_get_option('menu_sub_text_color');
		 
		 $menu_sub_text_hover_color = dentistry_tg_get_option('menu_sub_text_hover_color');

		 $footer_bk = dentistry_tg_get_option('footer_bk_color');	
		 $footer_heading_color = dentistry_tg_get_option('footer_heading_color');	
		 $footer_text = dentistry_tg_get_option('footer_text_color');	
		 $footer_accent = dentistry_tg_get_option('footer_accent_color');			 
		 $footer_accent_hover_color = dentistry_tg_get_option('footer_accent_hover_color');

		 $tiny_footer_bk = dentistry_tg_get_option('tiny_footer_bk_color');	
		 $tiny_footer_text = dentistry_tg_get_option('tiny_footer_text_color');
		 	
		 //Primary Button
		 $primary_btn_bg_color = dentistry_tg_get_option('primary_btn_bg_color');
		 $primary_btn_color = dentistry_tg_get_option('primary_btn_color');		 
		 $hover_primary_btn_bg_color = dentistry_tg_get_option('primary_btn_hover_bg_color');
		 $hover_primary_btn_color = dentistry_tg_get_option('primary_btn_hover_color');	
	
		 //Secondary Button
		 $second_btn_bg_color = dentistry_tg_get_option('second_btn_bg_color');
		 $second_btn_color = dentistry_tg_get_option('second_btn_color');		 
		 $hover_second_btn_bg_color = dentistry_tg_get_option('second_btn_hover_bg_color');
		 $hover_second_btn_color = dentistry_tg_get_option('second_btn_hover_color');			 	 		 		 		 
	 
		 //Slider Option		 
		 $slider_text_color =  dentistry_tg_get_option('slider_text_color');
		 $slider_title_color =  dentistry_tg_get_option('slider_title_color');
		 $slider_btn_bkcolor =  dentistry_tg_get_option('slider_btn_bkcolor');
		 $slider_btn_txtcolor =  dentistry_tg_get_option('slider_btn_txtcolor');
		 $slider_btn_bkcolor_hover =  dentistry_tg_get_option('slider_btn_bkcolor_hover');

		 $slider_arrow_bkcolor =  dentistry_tg_get_option('slider_arrow_bkcolor');
		 $slider_arrow_bkcolor_hover =  dentistry_tg_get_option('slider_arrow_bkcolor_hover');	
		 
 		 $slider_pagination =  dentistry_tg_get_option('slider_pagination');
 		 $slider_effect =  dentistry_tg_get_option('slider_effect');		 		 

		 $control_nav =  dentistry_tg_get_option('control_nav');

		 /*  favicon upload */
		 $style = "";
		 $favicon = dentistry_tg_get_option('favicon');
		 if( $favicon != '' ) {
			$style .= '<link rel="icon" type="image/png" href="'. esc_url( $favicon ) .'" > ' . "\n";		 
		 } else {
		 	$style .= '<link rel="icon" type="image/png" href="'.get_template_directory_uri().'/framework/image/favicon.ico">'."\n";
		 } 	 
		 
		 /* google font [ font-family ] */
		 $google_font = dentistry_tg_get_option('google_font');		 
		 $google_font_family = "";
		 $google_font_family = isset($google_font)?$google_font:'';

		 if( $google_font_family != '') {
			 $style .= '<link href="http://fonts.googleapis.com/css?family='.$google_font_family.'" rel="stylesheet" type="text/css">';
		 }else {
			 $style .= '<link href="http://fonts.googleapis.com/css?family=Raleway:500,700,400" rel="stylesheet" type="text/css">';
		 }

		$google_font_explode = "";
		$font_family_google = explode( ':', $google_font_family );
		$google_font_explode = isset($font_family_google)?$font_family_google:'';

		$font_family = isset($google_font_explode[0])?$google_font_explode[0]:'';
		$font_weight = isset($google_font_explode[1])?$google_font_explode[1]:'';
		
		$font_family = str_replace("+"," ",strtolower($font_family));

		$style .= '<style type="text/css" >';
		$style .= 'html body { background-color: '.$background_color.'; font-family: '.$font_family.' !important; font-weight : '.$font_weight.';  } ' . "\n";
		$style .= 'body .main-holder{ background-color: '.$boxed_bg_color.';} ' . "\n";
		

		 /*   font h1,h2,h3,h4 typogrphy  */
		$style .= 'h1 { font-size 	: '.dentistry_tg_get_option('font-size-h1').'px;
					 font-weight	: '.dentistry_tg_get_option('font-weight-h1').';
					 font-family	: '.$font_family.';
					 color			: '.dentistry_tg_get_option('font-color-h1').';
				}';
		$style .= 'h2 { font-size 	: '.dentistry_tg_get_option('font-size-h2').'px;
					 font-family	: '.$font_family.';		 
					 font-weight	: '.dentistry_tg_get_option('font-weight-h2').';
					 color			: '.dentistry_tg_get_option('font-color-h2').';		
				}';		
		$style .= 'h3 { font-size 	: '.dentistry_tg_get_option('font-size-h3').'px;
					 font-family	: '.$font_family.';		 
					 font-weight	: '.dentistry_tg_get_option('font-weight-h3').';
					 color			: '.dentistry_tg_get_option('font-color-h3').';
				}';		
		$style .= 'h4 { font-size 	: '.dentistry_tg_get_option('font-size-h4').'px;
				 font-family	: '.$font_family.';		 
				 font-weight	: '.dentistry_tg_get_option('font-weight-h4').';
				 color			: '.dentistry_tg_get_option('font-color-h4').';
			}';					
		$style .= 'p { font-size 	: '.dentistry_tg_get_option('font-size-p').'px;
					 font-family	: '.$font_family.';		 
					 font-weight	: '.dentistry_tg_get_option('font-weight-p').';
					 color			: '.dentistry_tg_get_option('font-color-p').';
				}';
		
		if(dentistry_tg_get_option('main_layout')=="boxed")
		{
			$style .= 'body { background-color:#e6e6e1; } ' . "\n";		
		}
		
		$style .= 'a { color:'.$accent_color.'; text-decoration: none; } ' . "\n";
		$style .= 'a:hover { color:'.$accent_hover_color.';   text-decoration: none; } ' . "\n";		 
		$style .= '.tp-header,#nav.affix { background-color:'.$h_bk.';  }' ."\n";
		$style .= '.tp-top-bar { background-color:'.$top_h_bk.';  }' ."\n";

		$style .= '.tp-navbar .tp-navigation .navbar.navbar, .navbar-default.navbar,.tp-navbar,.dropdown-menu,.tp-navigation .dropdown-menu { background-color:'. $m_bk .'; } '."\n";

		$style .= '.tp-navigation .navbar-default .navbar-nav > .open > a, .tp-navigation .navbar-default .navbar-nav > .open > a:focus, .tp-navigation .navbar-default .navbar-nav > .open > a:hover,.tp-navigation .dropdown-menu > li > a:focus, .tp-navigation .dropdown-menu > li > a:hover { background-color:'. $m_bk .';color:'.$menu_text_hover.'; } '."\n";	 
		
		
	
		
		$style .= '#navigation ul li.current-menu-item a,#navigation > ul > li:hover > a { color:'.$menu_text_hover.'; } '."\n";	 		

		$style .= '#navigation ul ul li a{background-color:'.$menu_sub_bg_color.';color:'.$menu_sub_text_color.';}';

		$style .= '#navigation .dropdown-menu > li > a:focus, #navigation .dropdown-menu > li > a:hover{background-color:'.$menu_sub_bg_color.';color:'.$menu_text_hover.';}';

		$style .= '#navigation ul > li > a,#navigation .dropdown-menu > li > a{color:'.$menu_text.';}';

		$style .= '.tp-navigation .navbar-default .navbar-nav > li > a:focus, .navbar-default .navbar-nav > li > a:hover{ color:'.$menu_text_hover.';  }' ."\n";		

		$style .= '.navbar-default .navbar-nav .dropdown-menu>li>a:focus, .navbar-default .navbar-nav .dropdown-menu>li>a:hover { color:'.$menu_text_hover.'; background-color:transparent; }' ."\n";	
		

		$style .= '.tp-navigation #navigation > a, #navigation > a:focus, #navigation > a { background-color:'.$menu_sub_bg_color.' !important; }' ."\n";	
		
		if($primary_btn_bg_color)
		{			
			$style .= '.tp-btn-default{ color:'.$primary_btn_color.';background-color:'.$primary_btn_bg_color.'; }' ."\n";	
			$style .= '.tp-btn-default:hover { color:'.$hover_primary_btn_color.';background-color:'.$hover_primary_btn_bg_color.'; }' ."\n";	
		}

		if($second_btn_bg_color)
		{			
			$style .= '.tp-btn-grey{ color:'.$second_btn_color.';background-color:'.$second_btn_bg_color.'; }' ."\n";	
			$style .= '.tp-btn-grey:hover { color:'.$hover_second_btn_color.';background-color:'.$hover_second_btn_bg_color.'; }' ."\n";	
		}		
				
		$style .= '.tp-footer { background-color:'.$footer_bk.';  }' ."\n";
		$style .= '.tp-footer h2 { color:'.$footer_heading_color.';  }' ."\n";
		$style .= '.tp-footer p,.ft-link-block ul li,.ft-contact,.tp-tiny-footer { color:'.$footer_text.';  }' ."\n";
		$style .= '.tp-footer .ft-links ul li a,.ft-mail a,.tp-social-icon a { color:'.$footer_accent.';  }' ."\n";	

		$style .= '.tp-page-header{ background-color:'.$breadcrumb_bk_color.';  }' ."\n";		

		$breadcrumb_bk_image = dentistry_tg_get_option('breadcrumb_bk_image');
		
		if( $breadcrumb_bk_image != '' ) {
			$style .= '.tp-page-header{ background-image:url("'. esc_url( $breadcrumb_bk_image ) .'");} ' . "\n";		 
		} 	

		if( $control_nav == '' ) {
			$style .= '#slider .owl-pagination{ display:none;} ' . "\n";		 
		} 					
		
		$style .= '.tp-tiny-footer { background-color:'.$tiny_footer_bk.';  }' ."\n";
		$style .= '.tp-tiny-footer p { color:'.$tiny_footer_text.';  }' ."\n";
		
		$style .= '#slider .caption h1{ color:'.$slider_title_color.';  }' ."\n";
		$style .= '#slider .caption p{ color:'.$slider_text_color.';  }' ."\n";		
		
		$style .= 'body #slider .owl-nav .owl-prev, #slider .owl-nav .owl-next{ background-color:'.$slider_arrow_bkcolor.'; color:'.$slider_btn_txtcolor.'; }'. "\n";
		
		$style .= '.owl-theme .owl-controls .owl-dot span{ background:'.$slider_pagination.';}'. "\n";

		$style .= '#slider .owl-nav .owl-prev:hover, #slider .owl-nav .owl-next:hover { background-color:'.$slider_arrow_bkcolor_hover.'; color:'.$slider_btn_txtcolor.';}'. "\n";		
		
		$style .= '.owl-theme .owl-controls .owl-dot.active span,
.owl-theme .owl-controls.clickable .owl-dot:hover span { background-color:'.$slider_arrow_bkcolor.'; color:'.$slider_btn_txtcolor.';}'. "\n";
		
		$style .= '#slider .tp-btn-second:hover { background-color:'.$slider_btn_bkcolor_hover.'; color:'.$slider_btn_txtcolor.';}'. "\n";

		$style .= '#slider .tp-btn-second { background-color:'.$slider_btn_bkcolor.'; color:'.$slider_btn_txtcolor.';}'. "\n";		
		
		$style .= '.tp-footer .ft-links ul li a:hover,.tp-tiny-footer .tp-social-icon ul li a:hover,.tp-tiny-footer .tp-social-icon ul li a:active,.ft-mail a:hover,.tp-social-icon a:hover { color:'.$footer_accent_hover_color.';  }' ."\n";			
		
		$style .= $custome_css . "\n";
		
		$style .= '#navigation ul ul li:hover > a, #navigation ul ul li a:hover { color:'.$menu_sub_text_hover_color.'; } '."\n";		
		$style .= '</style>';
		echo $style;	 
	}

	function dentistry_enqueue_inline_script( $handle, $js, $deps = array(), $in_footer = false ){
		// Callback for printing inline script.
		$cb = function()use( $handle, $js ){
			// Ensure script is only included once.
			if( wp_script_is( $handle, 'done' ) )
				return;
	
		   // Print script & mark it as included.
			$speed =  dentistry_tg_get_option('animatespeed');
			$control_nav =  dentistry_tg_get_option('control_nav');
			$directive_nav =  dentistry_tg_get_option('directive_nav');
			$slider_effect =  dentistry_tg_get_option('slider_effect');			
	
			if( $control_nav != '' ) {
				$control_nav_check = 'true';
			}else {
				$control_nav_check = 'false';
			}
	
			if( $directive_nav != '' ) {
				$directive_nav_check = 'true';
			}else {
				$directive_nav_check = 'false';
			}
	
			if($slider_effect=="fade")
			{
				$slider_effect_call= "animateIn : 'fadeIn',animateOut : 'fadeOut',";
			}
			else{
				$slider_effect_call= "";
			}		

			if( is_rtl() ) {
				$rtl_check = 'true';
			}else {
				$rtl_check = 'false';
			}
			
			echo "<script type=\"text/javascript\">
					var $ = jQuery.noConflict();
					if($('.owl-theme').hasClass('main-slider'))
					{
						$(document).ready(function() {
						  $('.main-slider').owlCarousel({	
							  rtl:".$rtl_check.",		  
							  loop:true,
							  nav : ".$directive_nav_check.", 
							  slideSpeed : '".esc_js($speed)."',
							  paginationSpeed : '".esc_js($speed)."',
							  items: 1,
							  navText : ['<i class=\"fa fa-angle-left\"></i>','<i class=\"fa fa-angle-right\"></i>'],
							  autoPlay:'".esc_js($speed)."',	
							  responsive:{
								0:{
									items:1
								},
								600:{
									items:1
								},
								1000:{
									items:1
								}
							  },	
							  addClassActive: true,
							   autoplay:true,	
							  $slider_effect_call	
							  });
						});
					}		
				  </script>\n";
			
				  
			global $wp_scripts;
			$wp_scripts->done[] = $handle;
		};
		// (`wp_print_scripts` is called in header and footer, but $cb has re-inclusion protection.)
		$hook = $in_footer ? 'wp_print_footer_scripts' : 'wp_print_scripts';
	
		// If no dependencies, simply hook into header or footer.
		if( empty($deps)){
			add_action( $hook, $cb );
			return;
		}
	
		// Delay printing script until all dependencies have been included.
		$cb_maybe = function()use( $deps, $in_footer, $cb, &$cb_maybe ){
			foreach( $deps as &$dep ){
				if( !wp_script_is( $dep, 'done' ) ){
					// Dependencies not included in head, try again in footer.
					if( ! $in_footer ){
						add_action( 'wp_print_footer_scripts', $cb_maybe, 11 );
					}
					else{
						// Dependencies were not included in `wp_head` or `wp_footer`.
					}
					return;
				}
			}
			call_user_func( $cb );
		};
		add_action( $hook, $cb_maybe, 0 );
	}

	// Usage
	dentistry_enqueue_inline_script('slider','',array( 'jquery'));	

	/*-----------------------------------------------------------*
	/* 			THEME OPTION PAGE
	/*-----------------------------------------------------------*/
	
	function dentistry_tg_options_page() {
	global $thege_options;
	?>
	<div class='wrap'>
	  <div class="container-fluid">
	   <?php settings_errors( 'thege_framework' ); ?>
	    <div class="page-header">
	      <h1>Theme Options<small> v.1.0 </small></h1>
	    </div>
	    <div class="row to-wrapper">
	      <div id="to-wrapper">
	        <div class="col-md-2 sidebar">
	          <!-- required for floating -->
	          <!-- Nav tabs -->
	          <ul class="nav nav-tabs tabs-left">
			  	<?php  echo dentistry_tg_theme_tab_menu();?>
	          </ul>
	        </div>
	        <div class="col-md-10">
	          <div class="to-content">
	            <!-- Tab panes --> 
	            <form action='options.php' method='post' class="form-horizontal"> 
	              <?php settings_fields( 'thege_options' ); ?>
	              <?php do_settings_sections( 'options_page' ); ?>
	              <div class="tab-content">
	                <?php  echo dentistry_tg_theme_tab_page();   ?>
	              </div>
	              <!-- tab-content -->
	              <p class="submit">
	                <input name="thege_options[submit]" type="submit" class="button-primary" value="<?php esc_attr_e('Save Settings', 'dentistry'); ?>" />
	                <input name="thege_options[reset]"  type="submit" class="button-secondary" value="<?php esc_attr_e('Reset Defaults', 'dentistry'); ?>" onclick="return confirm('Are you sure to reset default theme setting?')" />
	              </p>
	            </form>
	          </div>
	        </div>
	      </div>
	    </div>
	  </div>
	</div>
<?php  
} 

add_action( 'after_switch_theme', 'dentistry_default_setting_option' );

function dentistry_default_setting_option() {
	$default_check=get_option( 'thege_options' );
	if(count($default_check)==1)
	{
		$thege_default = dentistry_tg_default_options();
		update_option( 'thege_options', $thege_default); 
	}
}
?>