<?php
	/**
	 * Theme-options.
	 */
	$thege_options = array();
	/**
	 * Theme-options Field.
	 */ 
	$thege_options[] = array(
		'name' => esc_html__( 'Header Setting', 'dentistry' ),
		'description' => 'Configure Header Section to customize your to upload your preferred logo, favicon, contact number',
		'type' => 'section'
	);
	$thege_options[] =array(
		'name' => esc_html__( 'Plain Text Logo', 'dentistry' ),
		'description' => 'Check this box to enable a plain text logo rather than an image logo. Will use your site title.',				
		'type' => 'checkbox',
		'id' => 'checker',
		'options' => array(	'name' => 'Plain Text Logo' )
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Custom Logo Upload', 'dentistry' ),
		'description' => 'Upload a logo for your theme.',		
		'type' => 'logo',
		'id' => 'logo'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Custom Favicon Upload', 'dentistry' ),
		'description' => "Upload a 16px x 16px Png/Gif image that will represent your website's favicon. Use X-Icon Editor to easily create a favicon.",		
		'type' => 'logo',
		'id' => 'favicon'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Logo Right sidebar content', 'dentistry' ),
		'description' => "Add Phone Number,Email or any short information",
		'type' => 'editor',	
		'id' => 'header_right_content',
		'settings' => array(
			'media_buttons' => false,
			'quicktags' => true,
			'textarea_rows' => 7,
			'tinymce' => array( 'plugins' => 'wordpress' )
		)	
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Logo Left sidebar content', 'dentistry' ),
		'description' => "Add Phone Number,Email or any short information",
		'type' => 'editor',	
		'id' => 'header_left_content',
		'settings' => array(
			'media_buttons' => false,
			'quicktags' => true,
			'textarea_rows' => 7,
			'tinymce' => array( 'plugins' => 'wordpress' )
		)	
	);


	$thege_options[] =array(
		'name' => esc_html__( 'Search Box Show/Hide', 'dentistry' ),
		'description' => 'Check this box to display Header Search Box',				
		'type' => 'checkbox',
		'id' => 'header_search_btn',
		'class' => 'btn',
		'options' => array(	'name' => 'Display Button' )
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Clinic Address', 'dentistry' ),
		'type' => 'text',
		'description' => 'Clinic Address',
		'id' => 'clinic_address',
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Social Facebook', 'dentistry' ),
		'type' => 'text',
		'description' => 'Add Social Facebook URL',
		'id' => 'top_social_fb',
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Social Twitter', 'dentistry' ),
		'type' => 'text',
		'description' => 'Add Social Twitter URL',
		'id' => 'top_social_tw',
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Social Google Plus', 'dentistry' ),
		'type' => 'text',
		'description' => 'Add Social Google Plus URL',
		'id' => 'top_social_google_plus',
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Social Linkedin', 'dentistry' ),
		'type' => 'text',
		'description' => 'Add Social Linkedin URL',
		'id' => 'top_social_linkedin',
	);
	$thege_options[] = array(
		'name' => esc_html__( 'General Settings', 'dentistry' ),
		'description' => 'Configure general settings of your currency symbol of pricing and general setting of theme',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Currency Symbols', 'dentistry' ),
		'type' => 'text',
		'description' => "Currency Symbols for price table",
		'id' => 'currency_symbols',
		
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Styling Options', 'dentistry' ),
		'description' => 'Configure the visual appearance of your theme, or insert any custom CSS.',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Background Color', 'dentistry' ),
		'description' => 'Choose the background color of your site',		
		'type' => 'color',
		'id' => 'background_color'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Boxed Background Color', 'dentistry' ),
		'description' => 'Choose the Boxed Background color of your site',		
		'type' => 'color',
		'id' => 'boxed_bg_color'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Header Top Box Background Color', 'dentistry' ),
		'description' => 'Choose the Top Box background color of your section',		
		'type' => 'color',
		'id' => 'header_top_bk_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Header Background Color', 'dentistry' ),
		'description' => 'Choose the Header background color of your header section',		
		'type' => 'color',
		'id' => 'header_bk_color'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Background Color', 'dentistry' ),
		'description' => 'Choose the background color of menubar',		
		'type' => 'color',
		'id' => 'menu_bk_color'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Menu Text Color', 'dentistry' ),
		'description' => 'Choose menu text color of menubar',		
		'type' => 'color',
		'id' => 'menu_text_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Menu Text hover Color', 'dentistry' ),
		'description' => 'Choose menu text hover color of menubar',		
		'type' => 'color',
		'id' => 'menu_text_hover_color'
	);	

	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Background Color', 'dentistry' ),
		'description' => 'Choose sub menu Background color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_bg_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Text Color', 'dentistry' ),
		'description' => 'Choose sub menu Text color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_text_color'
	);	

	$thege_options[] = array(
		'name' => esc_html__( 'Menubar Sub Menu Text Hover Color', 'dentistry' ),
		'description' => 'Choose sub menu Text Hover color of menubar',		
		'type' => 'color',
		'id' => 'menu_sub_text_hover_color'
	);			

	
	$thege_options[] = array(
		'name' => esc_html__( 'Breadcrumb Background Color', 'dentistry' ),
		'description' => 'Choose the Breadcrumb background color of your section',		
		'type' => 'color',
		'id' => 'breadcrumb_bk_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Breadcrumb Background Image', 'dentistry' ),
		'description' => 'Choose the Breadcrumb background image of your section',		
		'type' => 'logo',
		'id' => 'breadcrumb_bk_image'
	);	
	
	$thege_options[] = array(
		'name' => esc_html__( 'Footer Background Color', 'dentistry' ),
		'description' => 'Choose the background color of footer',		
		'type' => 'color',
		'id' => 'footer_bk_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Footer Heading Color', 'dentistry' ),
		'description' => 'Choose the heading color of footer',		
		'type' => 'color',
		'id' => 'footer_heading_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Footer Text Color', 'dentistry' ),
		'description' => 'Choose the text color of footer',		
		'type' => 'color',
		'id' => 'footer_text_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Footer accent Color', 'dentistry' ),
		'description' => 'Choose the accent color of footer',		
		'type' => 'color',
		'id' => 'footer_accent_color'
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Footer accent hover Color', 'dentistry' ),
		'description' => 'Choose the accent hover color of footer',		
		'type' => 'color',
		'id' => 'footer_accent_hover_color'
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Accent Color', 'dentistry' ),
		'description' => 'Choose the accent color of your site',
		'type' => 'color',
		'id' => 'accent_color'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Accent Hover Color', 'dentistry' ),
		'description' => 'Choose the accent hover color of your site',
		'type' => 'color',
		'id' => 'accent_hover_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Primary Button Background Color', 'dentistry' ),
		'description' => 'Choose the Primary Button Background color of your site',
		'type' => 'color',
		'id' => 'primary_btn_bg_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Primary Button Text Color', 'dentistry' ),
		'description' => 'Choose the Primary Button Text color of your site',
		'type' => 'color',
		'id' => 'primary_btn_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Hover Primary Button Background Color', 'dentistry' ),
		'description' => 'Choose the Hover Primary Button Background color of your site',
		'type' => 'color',
		'id' => 'primary_btn_hover_bg_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Hover Primary Button Text Color', 'dentistry' ),
		'description' => 'Choose the Hover Primary Button Text color of your site',
		'type' => 'color',
		'id' => 'primary_btn_hover_color'
	);


	$thege_options[] = array(
		'name' => esc_html__( 'Secondary Button Background Color', 'dentistry' ),
		'description' => 'Choose the Secondary Button Background color of your site',
		'type' => 'color',
		'id' => 'second_btn_bg_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Secondary Button Text Color', 'dentistry' ),
		'description' => 'Choose the Secondary Button Text color of your site',
		'type' => 'color',
		'id' => 'second_btn_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Hover Secondary Button Background Color', 'dentistry' ),
		'description' => 'Choose the Hover Secondary Button Background color of your site',
		'type' => 'color',
		'id' => 'second_btn_hover_bg_color'
	);

	$thege_options[] = array(
		'name' => esc_html__( 'Hover Secondary Button Text Color', 'dentistry' ),
		'description' => 'Choose the Hover Secondary Button Text color of your site',
		'type' => 'color',
		'id' => 'second_btn_hover_color'
	);



	$thege_options[] = array(
		'name' => esc_html__( 'Custom CSS', 'dentistry' ),
		'type' => 'textarea',
		'description' => 'Add custom CSS to here that affect in front',
		'id' => 'custome_css'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Typography', 'dentistry' ),
		'description' => 'Theme font typography',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Body Font', 'dentistry' ),
		'type' => 'select',
		'description' => "Quickly add a custom Google Font for body from Google Font Directory. Example font name: 
						 'Source Sans Pro', for including font weights type Source Sans Pro:300",
		'id' => 'google_font',
		'options' => array(
			'Montserrat:400normal,700normal&subset=all' 	=> esc_html__( 'Montserrat', 'dentistry' ),
			'Raleway:300'   => esc_html__( 'Raleway','dentistry'),
			'Roboto:300' =>  esc_html__( 'Roboto','dentistry'),
			'Open+Sans:300' => esc_html__('Open+Sans','dentistry')
	     )	
	);
	$thege_options[] = array(
		'name' => esc_html__( 'H1 Headings', 'dentistry' ),
		'description' => 'Choose Size and Style for h1 (This Styles Your Page Titles)',
		'type' => 'typography',
		'id_1' => 'font-size-h1',
		'label_1' => 'Font Size',
		'id_2' => 'font-weight-h1',
		'label_2' => 'Font Weight',	
		'id_3' => 'font-color-h1',
		'label_3' => 'Font Color',		
	); 	
	$thege_options[] = array(
		'name' => esc_html__( 'H2 Headings', 'dentistry' ),
		'description' => 'Choose Size and Style for h2 (This Styles Your Page Titles)',
		'type' => 'typography',
		'id_1' => 'font-size-h2',
		'label_1' => 'Font Size',
		'id_2' => 'font-weight-h2',
		'label_2' => 'Font Weight',	
		'id_3' => 'font-color-h2',
		'label_3' => 'Font Color',
	); 	
	$thege_options[] = array(
		'name' => esc_html__( 'H3 Headings', 'dentistry' ),
		'description' => 'Choose Size and Style for h3 (This Styles Your Page Titles)',
		'type' => 'typography',
		'id_1' => 'font-size-h3',
		'label_1' => 'Font Size',
		'id_2' => 'font-weight-h3',
		'label_2' => 'Font Weight',	
		'id_3' => 'font-color-h3',
		'label_3' => 'Font Color',
	); 	
	$thege_options[] = array(
		'name' => esc_html__( 'H4 Headings', 'dentistry' ),
		'description' => 'Choose Size and Style for h3 (This Styles Your Page Titles)',
		'type' => 'typography',
		'id_1' => 'font-size-h4',
		'label_1' => 'Font Size',
		'id_2' => 'font-weight-h4',
		'label_2' => 'Font Weight',	
		'id_3' => 'font-color-h4',
		'label_3' => 'Font Color',
	); 	
	$thege_options[] = array(
		'name' => esc_html__( 'P Headings', 'dentistry' ),
		'description' => 'Choose Size and Style for P (This Styles Your Page Titles)',
		'type' => 'typography',
		'id_1' => 'font-size-p',
		'label_1' => 'Font Size',
		'id_2' => 'font-weight-p',
		'label_2' => 'Font Weight',	
		'id_3' => 'font-color-p',
		'label_3' => 'Font Color',
	); 	
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Setting', 'dentistry' ),
		'description' => 'Slieder option customization.',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Effect', 'dentistry' ),
		'type' => 'select',
		'description' => "Select your slider effect",
		'id' => 'slider_effect',
		'options' => array(
			'fade' 	=> esc_html__( 'fade', 'dentistry'),
			'slide' => esc_html__( 'slide', 'dentistry')			
	     )			
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Animation Speed', 'dentistry' ),
		'description' => 'Animation Speed of slider',		
		'id' => 'animatespeed',
		'type' => 'text'		
	);			
	$thege_options[] =array(
		'name' => esc_html__( 'Control Nav', 'dentistry' ),
		'description' => 'controlNav pagination bullets',				
		'id' => 'control_nav',
		'type' => 'checkbox',
		'class' => 'controlNav',
		'options' => array(	'name' => 'controlNav' )
	);
	$thege_options[] =array(
		'name' => esc_html__( 'Direction Nav', 'dentistry' ),
		'description' => 'Direction right and left side arrow',				
		'id' => 'directive_nav',
		'type' => 'checkbox',
		'class' => 'directionNav',
		'options' => array(	'name' => 'direction' )
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Heading Title Color', 'dentistry' ),
		'description' => 'Select Slider Heading Title Color',		
		'type' => 'color',
		'id' => 'slider_title_color'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Text Color', 'dentistry' ),
		'description' => 'Slider Text Color',		
		'type' => 'color',
		'id' => 'slider_text_color'
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Button Background Color', 'dentistry' ),
		'description' => 'Slider Button Background Color',		
		'type' => 'color',
		'id' => 'slider_btn_bkcolor'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Button Hover Background Color', 'dentistry' ),
		'description' => 'Select slider button hover background color',		
		'type' => 'color',
		'id' => 'slider_btn_bkcolor_hover'
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Slider Button Text Color', 'dentistry' ),
		'description' => 'Select slider button text color',		
		'type' => 'color',
		'id' => 'slider_btn_txtcolor'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Arrow Background Color', 'dentistry' ),
		'description' => 'Select slider arrow background color',		
		'type' => 'color',
		'id' => 'slider_arrow_bkcolor'
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Arrow Hover Background Color', 'dentistry' ),
		'description' => 'Select slider arrow hover background color',		
		'type' => 'color',
		'id' => 'slider_arrow_bkcolor_hover'
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Pagination Color', 'dentistry' ),
		'description' => 'Select slider pagination circle',		
		'type' => 'color',
		'id' => 'slider_pagination'
	);			
	$thege_options[] = array(
		'name' => esc_html__( 'Footer Setting', 'dentistry' ),
		'description' => 'Configure footer  settings of your about us, location, and newsletter and newsletter shortcode.',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Footer CTA', 'dentistry' ),
		'description' => 'Footer Call to Action area',		
		'id' => 'footer_code',
		'type' => 'editor',	
		'settings' => array(
			'media_buttons' => false,
			'quicktags' => true,
			'textarea_rows' => 7,
			'tinymce' => array( 'plugins' => 'wordpress' )
		)			
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Sub Footer', 'dentistry' ),
		'description' => 'Sub Footer Description with contact details',		
		'id' => 'sub_footer',
		'type' => 'editor',	
		'settings' => array(
			'media_buttons' => false,
			'quicktags' => true,
			'textarea_rows' => 7,
			'tinymce' => array( 'plugins' => 'wordpress' )
		)			
	);				
	$thege_options[] = array(
		'name' => esc_html__( 'Tiny Footer', 'dentistry' ),
		'description' => 'Tiny Footer',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Copyright', 'dentistry' ),
		'description' => "Copyright",
		'type' => 'editor',
		'id' => 'copyright',
		'settings' => array(
			'media_buttons' => false,
			'quicktags' => true,
			'textarea_rows' => 5,
			'tinymce' => array( 'plugins' => 'wordpress' )
		)
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Facebook', 'dentistry' ),
		'description' => 'Facebook',		
		'id' => 'social_facebook',
		'type' => 'text'		
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Twitter', 'dentistry' ),
		'description' => 'Twitter',		
		'id' => 'social_twitter',
		'type' => 'text'		
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Google+', 'dentistry' ),
		'description' => 'Google+',		
		'id' => 'social_google_plus',
		'type' => 'text'		
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Youtube', 'dentistry' ),
		'description' => 'Youtube',		
		'id' => 'social_youtube',
		'type' => 'text'		
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Instagram', 'dentistry' ),
		'description' => 'Instagram',		
		'id' => 'social_instagram',
		'type' => 'text'		
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Layout Settings', 'dentistry' ),
		'description' => 'Layouts panel is where you can adjust various columns and siderbar options for your website.',
		'type' => 'section'
	);
	$thege_options[] = array(
		'name' => esc_html__( 'Theme Color ', 'dentistry' ),
		'description' => 'Select color for your theme',		
		'id' => 'color_layout',
		'type' => 'radio',	
		'options' => array(	'green' => '<img src="'.get_template_directory_uri().'/framework/image/green.png"  />',
							'blue' => '<img src="'.get_template_directory_uri().'/framework/image/blue.png"  />')
			
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Main Layout', 'dentistry' ),
		'description' => 'Select layout for you website',		
		'id' => 'main_layout',
		'type' => 'radio',	
		'options' => array(	'full' => '<img src="'.get_template_directory_uri().'/framework/image/full.png"  />',
							'boxed' => '<img src="'.get_template_directory_uri().'/framework/image/boxed.png"  />' )
			
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Header Option', 'dentistry' ),
		'description' => 'Select header option for menubar,logo and other information stucture',		
		'id' => 'header_option',
		'type' => 'radio',	
		'options' => array(	'first' => '<img src="'.get_template_directory_uri().'/framework/image/header2.jpg"  />',
							'second' => '<img src="'.get_template_directory_uri().'/framework/image/header1.jpg"  />',
							'third' => '<img src="'.get_template_directory_uri().'/framework/image/header3.jpg"  />' )
			
	);		
	$thege_options[] = array(
		'name' => esc_html__( 'Blog', 'dentistry' ),
		'description' => 'Select columns option for blog page',		
		'id' => 'blog_layout',
		'type' => 'radio',	
		'options' => array(	'blog_right' => '<img src="'.get_template_directory_uri().'/framework/image/left-sidebar.png"  />',
							'blog_left' => '<img src="'.get_template_directory_uri().'/framework/image/right-sidebar.png"  />')
			
	);	
	$thege_options[] = array(
		'name' => esc_html__( 'Services', 'dentistry' ),
		'description' => 'Select services layout',		
		'id' => 'service_layout',
		'type' => 'radio',	
		'options' => array(	'right_sidebar' => '<img src="'.get_template_directory_uri().'/framework/image/left-sidebar.png"  />',
							'full' => '<img src="'.get_template_directory_uri().'/framework/image/boxed.png"  />')
			
	);	
	if ( function_exists( 'dentistry_plugin_get_html_import' ) )
	{
		$thege_options[] = array(
			'name' => esc_html__( 'Import Data', 'dentistry' ),
			'description' => dentistry_plugin_get_html_import(),
			'type' => 'section'
		);	
	}
?>