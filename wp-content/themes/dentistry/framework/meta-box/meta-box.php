<?php 
/**
 * Meta-box Options.
 */  
$meta_boxes = array(); 

/**
 * Slider meta box.
 */
$meta_boxes[] = array(
    'id' => 'meta-box-slider',
    'title' => 'Slider More Details',
    'pages' => array('slider'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Content',
            'desc' => '',
            'id' =>  'slider_content',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => 'Button On/Off',
            'desc' => '',
            'id' =>  'slider_btn_onoff',
            'type' => 'checkbox',
            'std' => ''
        ),			
        array(
            'name' => 'Button Text',
            'desc' => '',
            'id' =>  'slider_btn_txt',
            'type' => 'text',
            'std' => ''
        ),		
        array(
            'name' => 'Button Link',
            'desc' => '',
            'id' =>  'slider_btn_url',
            'type' => 'text',
            'std' => ''
        ),				
    )// field 
);

/**
 * Doctor meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-doctor',
    'title' => 'Doctor Information',
    'pages' => array('doctor'), // multiple post types
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Doctor Designation',
            'desc' => '',
            'id' =>  'doctor_designation',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Doctor Phone',
            'desc' => '',
            'id' =>  'doctor_phone',
            'type' => 'text',
            'std' => ''
        ),
        array(
            'name' => 'Doctor Facebook',
            'desc' => '',
            'id' =>  'doctor_fb',
            'type' => 'text',
            'std' => ''
        ),					
        array(
            'name' => 'Doctor Linkedin',
            'desc' => '',
            'id' =>  'doctor_linkedin',
            'type' => 'text',
            'std' => ''
        ),	
        array(
            'name' => 'Doctor Google Plus',
            'desc' => '',
            'id' =>  'doctor_googleplus',
            'type' => 'text',
            'std' => ''
        ),					
        array(
            'name' => 'Doctor Twitter',
            'desc' => '',
            'id' =>  'doctor_tw',
            'type' => 'text',
            'std' => ''
        )
    )// field
);



/**
 * Testimonial meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-testimonial',
    'title' => 'Author Information',
    'pages' => array('testimonial'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Author Details',
            'desc' => '',
            'id' =>  'testimonials_details',
            'type' => 'textarea',
            'std' => ''
        ),
        array(
            'name' => 'Author Treatment Name',
            'desc' => '',
            'id' =>  'testimonials_treatment',
            'type' => 'text',
            'std' => ''
        ),
  
    )// field 
);
/**
 * Slider meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-slider',
    'title' => 'Slider Information',
    'pages' => array('sliders'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Description',
            'desc' => '',
            'id' =>  'slider_description',
            'type' => 'textarea',
            'std' => ''
        ),        		  
        array(
            'name' => 'Button Display Yes/No',
            'desc' => '',
            'id' =>  'button_show',
            'type' => 'checkbox',
            'std' => ''
        ),		  
        array(
            'name' => 'Button Text',
            'id' =>  'slider_button_text',
            'type' => 'text',
            'std' => ''
        ),		  
        array(
            'name' => 'Button Link',
            'desc' => '',
            'id' =>  'slider_button_link',
            'type' => 'text',
            'std' => ''
        ),		  		
    )// field 
);
/**
 * FAQS meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-faq',
    'title' => 'Question and Answer Information',
    'pages' => array('faq'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array( 
        array(
            'name' => 'Answer',
            'desc' => '',
            'id' =>  'answer_description',
            'type' => 'textarea',
            'std' => ''
        ),                     
    )// field 
);


/**
 * Services meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-service',
    'title' => 'Service Data',
    'pages' => array('service'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array( 
        array(
            'name' => 'Price Description',
            'desc' => '',
            'id' =>  'service_price_description',
            'type' => 'textarea',
            'std' => ''
        ),     
        array(
            'name' => 'Price Extra Note',
            'desc' => '',
            'id' =>  'service_price_extra_note',
            'type' => 'textarea',
            'std' => ''
        ),    	
        array(
            'name' => 'Service Starting Price',
            'desc' => '',
            'id' =>  'service_price',
            'type' => 'text',
            'std' => ''
        ),    
        array(
            'name' => 'Service Icon',
            'desc' => 'Add Service Dental Icon Title Copy and insert here <a href="http://thegenius.co/dentistry/dentist-font/" target="_blank">Dental Icon List</a><br> if you want to use Image Icon than leave as blank',
            'id' =>  'service_icon_type',
            'type' => 'text',
            'std' => ''
        ),    		                 
    )// field 
);

/**
 * Career meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-career',
    'title' => 'Clinic Data',
    'pages' => array('career'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array( 
        array(
            'name' => 'Clinic Address',
            'desc' => '',
            'id' =>  'clinic_address',
            'type' => 'text',
            'std' => ''
        ),                     
    )// field 
);
/**
 * Post meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-post-video',
    'title' => 'Show Video',
    'pages' => array('post'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Video URL',
            'desc' => '<i>For Blog Posts, make sure Video post format is chosen.Make sure to use EMBED SRC URL - not the url to the video itself.</i>',
            'id' =>  'show_video',
            'type' => 'text',
            'std' => ''
        ),                     
    )// field 
);
/** 
 * Post meta box.
 */
$meta_boxes[] = array(
    'id' => 'dentistry-post-video-audio',
    'title' => 'Show Audio',
    'pages' => array('post'), // custom post type
    'context' => 'normal',
    'priority' => 'high',
    'fields' => array(
        array(
            'name' => 'Audio URL',
            'desc' => '<i>For Blog Posts, make sure Audio post format is chosen.</i>',
            'id' =>  'show_audio',
            'type' => 'text',
            'std' => ''
        ),                     
    )// field 
);

foreach ($meta_boxes as $meta_box) {
    $my_box = new Dentistry_Meta_Box($meta_box);
}

class Dentistry_Meta_Box {
    protected $_meta_box;
	/**
	 * create meta box based on given data.
	 */
    function __construct($meta_box) {
        $this->_meta_box = $meta_box;
        add_action('admin_menu', array(&$this, 'add'));
        add_action('save_post', array(&$this, 'save'));
    }
 	/**
	 * Add meta box for multiple post types.
	 */
    function add() {
        foreach ($this->_meta_box['pages'] as $page) {
            add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
        }
    }
	/**
	 * Callback function to show fields in meta box.
	 */
    function show() {
        global $post;
 		/**
		 * Use nonce for verification.
		 */
        echo  '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
        echo  '<table class="form-table">';
		
        foreach ($this->_meta_box['fields'] as $field) {            
			/**
			 *  get current post meta data.
			 */
            $meta = get_post_meta($post->ID, $field['id'], true);
			if( isset( $field['desc'] ) ) {
				$meta_description = $field['desc'];
			}
			
            echo  '<tr><th style="width:20%"><label for="',esc_attr($field['id']), '">', esc_html($field['name']), '</label></th><td>';
			
            switch ($field['type']) {
			    /**
				 *  Meta-box Text Field.
				 */	
                 case 'text':
                 	   echo  '<input type="text" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
                       '<br /><small>', $meta_description.'</small>';
                 break;					
			    /**
				 *  Meta-box Color Field.
				 */	
				case 'color':
				      echo '<input class="color-field" type="text" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" value="', $meta ? $meta : $field['std'], '"  />',
                      '<br /><small>', $meta_description.'</small>';
				break;
			    /**
				 *  Meta-box Textarea Field.
				 */	
                case 'textarea':
                      echo  '<textarea name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
                      '<br /><small>', $meta_description.'</small>';
                break;
			    /**
				 *  Meta-box Select Field.
				 */	
				case 'select':					
					  echo  '<select name="'.esc_attr($field['id']).'" id="'.esc_attr($field['id']).'">';
						     foreach ($field['options'] as $option) {
						  	    echo  '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
					 	     } 
					  echo  '</select><br /><span class="description">'.$meta_description.'</span>';
                break;
			    /**
				 *  Meta-box Radio Field.
				 */	
				case 'radio':
					  foreach ( $field['options'] as $option ) {
						       echo  '<input type="radio" name="'.esc_attr($field['id']).'" id="'.$option['value'].'" 
							   value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
							   <label for="'.$option['value'].'">'.$option['name'].'</label><br />';
					  }
					  echo  '<span class="description">'.$meta_description.'</span>';
				break;
			    /**
				 *  Meta-box Checkbox Field.
				 */	
	            case 'checkbox':
    	              echo  '<input type="checkbox" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '"', $meta ? ' checked="checked"' : '', ' />';
                break;
			    /**
				 *  Meta-box Checkbox-group Field.
				 */	
			    case 'checkbox_group':
					  foreach ($field['options'] as $option) {
					      echo  '<input type="checkbox" value="',$option['value'],'" name="',esc_html($field['id']),'[]" 
						  id="',$option['value'],'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' />
						  <label for="'.$option['value'].'">'.$option['name'].'</label><br />';
					  }
					  echo  '<span class="description">'.$meta_description.'</span>';
					break;
			    /**
				 *  Meta-box Image Field.
				 */	
				case 'image':
					  echo   '<span class="upload">';
					  if( $meta ) {									
						   echo  '<input type="hidden" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" 
								   class="regular-text form-control text-upload" value="',$meta,'"  />';							
						   echo  '<img style="width:150px; display:block;" src= "'.$meta.'"  class="preview-upload" />';
						   echo   '<input type="button" class="button button-upload" id="logo_upload" value="Upload an image"/></br>';		
						   echo   '<input type="button" class="button-remove" id="remove" value="Remove" /> ';
					  }else {
						   echo  '<input type="hidden" name="',esc_html($field['id']), '" id="', esc_attr($field['id']), '" 
									class="regular-text form-control text-upload" value="',$meta,'"  />';							
						   echo '<img style="" src= "'.$meta.'"  class="preview-upload" />';
						   echo  '<input type="button" class="button button-upload" id="logo_upload" value="Upload an image"/></br>';		
						   echo  '<input type="button" style="display:none;" id="remove" class="button-remove" value="" /> ';
					   }   echo  '</span><span class="description">'.$meta_description.'</span>';		
				break;
					
            }
            echo '<td></tr>';
        }
        echo  '</table>';
    }
 
 	/**
	 * Save data from meta box.
	 */
     function save($post_id) {
	 	/**
		 * Verify Nonce.
		 */
        if ( !isset( $_POST['mytheme_meta_box_nonce'] ) || !wp_verify_nonce($_POST['mytheme_meta_box_nonce'] , basename(__FILE__))) {
            return $post_id;
        }
		/**
		 * Check Autosave.
		 */
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
            return $post_id;
        }
        /**
		 * Check Permissions.
		 */
        if ('page' == $_POST['post_type']) {
            if (!current_user_can('edit_page', $post_id)) {
                return $post_id;
            }
        } elseif (!current_user_can('edit_post', $post_id)) {
            return $post_id;
        }
        /**
	     * Set Field & Update meta.
		 */
        foreach ($this->_meta_box['fields'] as $field) {			
            $old = get_post_meta($post_id, $field['id'], true);
            $new =  isset( $_POST[$field['id']] ) ? $_POST[$field['id']] : '' ;
 
            if ( $new && $new != $old) {
                update_post_meta($post_id, $field['id'], $new);
            } elseif ('' == $new && $old) {
                delete_post_meta($post_id, $field['id'], $old);
            }
        }
    }
} 
