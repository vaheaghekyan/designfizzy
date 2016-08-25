<?php
/** 
 * Theme-option Menubar.
 */
function dentistry_tg_theme_tab_menu() {
    global $thege_options;		
		 $counter=0;
		 $menu = "";
		 foreach ( $thege_options as $value ) {
			if ( $value['type'] == "section" ) {
					$counter++;
					if( $counter == 1 ) {
					$menu .= '<li class="active"> <a data-toggle="tab" data-toggle="tab"  
					href="' . esc_attr( '#options-group-'.$counter) . '">' . esc_html( $value['name'] ) . '</a> </li>';
					}else {
					$menu .= '<li> <a data-toggle="tab" data-toggle="tab" 
					href="' . esc_attr( '#options-group-'.  $counter ) . '">' . esc_html( $value['name'] ) . '</a> </li>';
					}
				}
		 } // END foreach 
	return $menu;	
}
/**
 * Theme-option Field.
 */	
function dentistry_tg_theme_tab_page() {
	global $thege_options;				
	$output= ""; $val= ""; $id= ""; $val_1= ""; $val_2= ""; $val_3 = ""; $no_display="";
	$counter=0;
	$options = get_option( 'thege_options' );
	foreach ( $thege_options as $value ) {				        
	 
		if( $value['type'] != "section" && $value['type'] != "typography" ) {
				$value['id'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower($value['id']) );
				if ( isset(   $options[ ( $value['id']  ) ]   ) ) {
					$val = $options[( $value['id']  )];
					$val = stripslashes($val);
				}							
		} // != "section" if loop
		
		if( $value['type'] == "typography" ) {									
				$value['id_1'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower(esc_html($value['id_1'])) );
				$value['id_2'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower(esc_html($value['id_2'])) );
				$value['id_3'] = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower(esc_html($value['id_3'])) );
				if( isset( $options[esc_html( $value['id_1'] )] ) ||
					isset( $options[esc_html( $value['id_2'] )] ) ||
					isset( $options[esc_html( $value['id_3'] )] ) ){		
						$val_1 = $options[esc_html( $value['id_1'] )];
						$val_2 = $options[esc_html( $value['id_2'] )];
						$val_3 = $options[esc_html( $value['id_3'] )];
				}
		} // != "section" if loop
		
		switch ( $value['type'] )  {
		case "section" :
			  if ( $value['type'] == "section" ) {
					if( $counter >=1 ) { 
						$output .= '</div>';
					}								
					$counter++;
					if( $counter == 1) {
						$output .= '<div id="options-group-'.$counter.'" class="tab-pane fade in active">';
					} else {
						$output .= '<div id="options-group-'.$counter.'" class="tab-pane fade">';										
					}
					$output .= '<div class="row">';
					$output .= '<div class="col-md-12 to-section">' ;
					$output .= '<h1> '.esc_html($value['name']).' </h1>';
					$output .= '<p> '.$value['description'].' </p>';
					$output .= '</div>'; 
					$output .= '</div>';
			} 
		break;
		case "text" :	
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7">';
				$output .= '<input class="form-control" type="text" name=" thege_options'.esc_attr('['.$value['id'].']').'" 
							value = "'.esc_attr( $val ).'" /> ';
				$output .= '</div>';			
				$output .= '</div>';
		break;
		case "hidetext" :


				if( isset($value['class']) ){
					$valueclass = $value['class'];
				}
				$output .= '<div class="row to-section '.$valueclass.'">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7">';
				$output .= '<input class="form-control" type="text" name=" thege_options'.esc_attr('['.$value['id'].']').'" 
							value = "'.esc_attr( $val ).'" /> ';
				$output .= '</div>';			
				$output .= '</div>';
		break;
		case "textarea" :
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7 textarea_control">';
				$output .= '<textarea class="form-control" name="thege_options'.esc_attr('['.$value['id'].']' ).'"/>'.esc_attr($val).'</textarea>';
				$output .= '</div>';			
				$output .= '</div>';
		break;
		case "hidetextarea" :
				if( isset($value['class']) ){
					$valueclass = $value['class'];
				}						
				$output .= '<div class="row to-section '.$valueclass.' ">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7 textarea_control">';
				$output .= '<textarea class="form-control" name="thege_options'.esc_attr('['.$value['id'].']' ).'"/>'.esc_attr($val).'</textarea>';
				$output .= '</div>';			
				$output .= '</div>';
		break;					
		case "logo" :
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7">';								
				$output .= '<span class="upload">';
				$output .= '<input type="hidden" id="thege_logo" class="regular-text form-control text-upload" 
				name="thege_options'.esc_attr('['.$value['id'].']' ).'"  value = "'.esc_attr( $val ).'"  /><br />';
				if( esc_url( $val ) != '' ) {
					$output .='<img style="background-color: #666; padding:2px; display:block;" src= "'.esc_url( $val ).'"
					class="preview-upload" />';
					$output .= '<input type="button" class="button button-upload" id="logo_upload" value="Upload an image"/></br>';		
					$output .= '<input type="button" class="button-remove" id="remove" value="Remove" /> ';
				}else {
					$output .='<img style="display:none;" src="'.esc_url( $val ).'" class="preview-upload" />';
					$output .= '<input type="button" class="button button-upload" id="logo_upload" value="Upload an image"/></br>';		
					$output .= '<input type="button" style="display:none;" id="remove" class="button-remove" value="" /> ';
				}
				$output .= '</span>';		
				$output .= '</div>';
				$output .= '</div>';								
		break;
		case "radio" : 
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div> ';
				$output .= '<div class="col-md-7">';
				$name = '['. $value['id'] .']';
				$for_call = $value['id'];
				foreach ($value['options'] as $key => $option) {
					$key_call=$key.'-'.$for_call;
					if( $val == $key ) {
					
						$output .= '<div class="radio_layout"><input type="radio" name="thege_options' . esc_attr( $name ) . '"  
						value="'. esc_attr( $key ) . '" checked = checked id="'. esc_attr( $key_call ) . '"  />
						<label for="' . esc_attr( $key_call ) . '">' . $option  . '</label></div>';
					} else {
						$output .= '<div class="radio_layout"><input type="radio" name="thege_options' . esc_attr( $name ) . '"  
						value="'. esc_attr( $key ) . '" id="'. esc_attr( $key_call ) . '" />
						<label for="' . esc_attr( $key_call ) . '">' .  $option  . '</label></div>';
					}									
				}		
				$output .= '</div>';
				$output .= '</div>';
		break;
		
		case "select" : 
				$output .= '<div class="row to-section" id="'.$value['id'].'">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div> ';
				$output .= '<div class="col-md-7">';
		
			$output .= '<select class="form-control" name="thege_options'.esc_attr('['.$value['id'].']').'" >';
			foreach ($value['options'] as $key => $option ) {
				if( $key == $val ) {
				$output .= '<option selected=selected value="' .htmlentities(esc_attr( $key )) . '">' .(esc_html( $option )). '</option>';
				} else {
				$output .= '<option value="' .htmlentities(esc_attr( $key )). '">' .(esc_html( $option )). '</option>';					
				}
			}
			
			$output .= '</select>';
			$output .= '</div>';
			$output .= '</div>';
		
		break;
		

		case "multiselect" : 
				$output .= '<div class="row to-section" id="'.$value['id'].'">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div> ';
				$output .= '<div class="col-md-7">';
		
			
			if (isset($val) && !empty($val)) {
				$selected_val=explode(",", $val);
			}
			else{
				$selected_val=array('');	
			}
			if(count($value['options'])!="0")
			{
				$output .= '<select class="form-control" multiple name="thege_options'.esc_attr('['.$value['id'].']').'[]" >';			
			}	
									
			foreach ($value['options'] as $key => $option ) {

				if (in_array($key, $selected_val))	
				{	
					$output .= '<option selected=selected value="'.htmlentities(esc_attr( $key )).'">'.(esc_html( $option )).'</option>';
				} else {
					$output .= '<option value="'.htmlentities(esc_attr( $key )).'">'.(esc_html( $option )).'</option>';					
				}
			}
			

			if(count($value['options'])!="0")
			{
				$output .= '</select>';
			}			
			
			$output .= '</div>';
			$output .= '</div>';
		
		break;					
		case "typography" :

			$output .= '<div class="row to-section">';
			$output .= '<div class="col-md-5">';
			
			$output .= '<label> '.esc_html($value['name']).' </label>';					
			$output .= '<p> '.esc_html($value['description']).' </p>';
			$output .= '</div> ';
			$output .= '<div class="col-md-7">';
			
			/* row start  */
			$output .= '<div class="row">';
			$output .= '<div class="col-md-4"> ';
			$output .= '<label> '.$value['label_1'].' </label>';
			$output .= '<div class="input-group custom-search-form">';
			$output .= '<input class="form-control" type="text" name="thege_options' . esc_attr( '[' . $value['id_1'] . ']' ) . ' " 
						value = "'. $val_1 .'" /> 
						<span class="input-group-btn"> 
						<button class="btn btn-default" type="button" disabled="disabled"> px </button> 
						</span> 
						</div>';
			$output .= '</div>';
			
			$output .= '<div class="col-md-4">';
			$output .= '<label> '.esc_html($value['label_2']).' </label>';							
			$output .= '<div class="input-group custom-search-form">';
			$output .= '<input class="form-control" type="text" name="thege_options' . esc_attr( '[' . $value['id_2'] . ']' ) . ' " 
						value = "'. esc_attr(  $val_2 ) .'" /> 
						<span class="input-group-btn"> 
						<button class="btn btn-default" type="button" disabled="disabled"> px </button> 
						</span> 
						</div>';
			$output .= '</div>';						
			$output .= '</div> <hr>';      					

			$output .= '<div class="row">';
			$output .= '<div class="col-md-4">';
			$output .= '<label> '.esc_html($value['label_3']).' </label>';									
			$output .= '<input class="color-field" type="text" name="thege_options' . esc_attr('['.$value['id_3'].']').' " 
						value = "'. esc_attr( $val_3 ) .'" /> ';						
			$output .= '</div>'; 						
			$output .= '</div>';
			$output .= '</div>';
			$output .= '</div>';																		
		break;
		
		case "checkbox":
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div> ';
				$output .= '<div class="col-md-7">';
				foreach ($value['options'] as $key => $option) {
				
				$key = preg_replace('/[^a-zA-Z0-9._\-]/', '', strtolower(esc_html($value['name'])) );
					$valueclass="";
					if( isset($value['class']) && !empty($value['class']) ){
						$valueclass = $value['class'];
					}						
					if( isset($val) && !empty($val)){
						$output .= '<input type="checkbox" class="'.$valueclass.'" 
						name="thege_options[' . esc_attr( $value['id'] ) . ']"  
						id="'.$value['id'].'" value="'.esc_attr( $val ). '" checked = checked  />';

						$no_display .='<label for="'.esc_attr( $id ).'">'.esc_html( $option ).'</label>';
					} else {
						$output .= '<input type="checkbox" name="thege_options[' . esc_attr( $value['id'] ) . ']"  
						value="'. esc_attr( $key ) . '" class="'.$valueclass.'"  id="'.$value['id'].'"  />';
						$no_display .='<label for="'.esc_attr( $id ).'">'.esc_html( $option ).'</label>';
					}									
				}							
				$output .= '</div>';
				$output .= '</div>';
		break;
		
		case "color" :
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
					$output .= '<label class="control-label"> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';
				$output .= '<div class="col-md-7"> ';
				$output .= '<input class="color-field" type="text" name="thege_options'.esc_attr('['.$value['id'].']').'" 
							value = "'.esc_attr( $val ).'" /> ';
				$output .= '</div>';
				$output .= '</div>';														
		break;
		
		case "editor" :
				$output .= '<div class="row to-section">';
				$output .= '<div class="col-md-5">';
				$output .= '<label class="control-label"> '.esc_html($value['name']).' </label> <p> '.esc_html($value['description']).' </p>';
				$output .= '</div>';								
				$output .= '<div class="col-md-7"> ';								
				echo $output;
					$textarea_name = 'thege_options'.esc_attr('['.$value['id'].']').'';
					$default_editor_settings = array(
						'textarea_name' => $textarea_name,																	 
						'media_buttons' => false,
						'quicktags' => false,
						'textarea_rows' => 5,
						'tinymce' => array( 'plugins' => 'wordpress' )
					);
					$editor_settings = array();
					if ( isset( $value['settings'] ) ) {
						$editor_settings = $value['settings'];
					}
					$editor_settings = array_merge( $default_editor_settings, $editor_settings );
					wp_editor( $val , $value['id'] , $editor_settings );
					$output = '';
				$output .= '</div>';
				$output .= '</div>';														
		break;
		
		default : 	break;					
		} // switch					
	 } // foreach 
	 return $output;		
}
?>