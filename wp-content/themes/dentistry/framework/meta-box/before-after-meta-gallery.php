<?php 
add_action( 'admin_init', 'dentistry_add_metabox_gallery' );
add_action( 'admin_head-post.php', 'dentistry_print_scripts_before_after' );
add_action( 'admin_head-post-new.php', 'dentistry_print_scripts_before_after' );
add_action( 'save_post', 'dentistry_update_metabox_gallery', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
*/
if ( ! function_exists( 'dentistry_add_metabox_gallery' ) ) :
function dentistry_add_metabox_gallery()
{
	add_meta_box(
	'post_gallery',
	'Image Uploader with Title',
	'dentistry_post_meta_gallery',
	'gallery',// here you can set post type name
	'normal',
	'core');
}
endif;

/**
 * Print the Meta Box content
 */
if ( ! function_exists( 'dentistry_post_meta_gallery' ) ) : 
function dentistry_post_meta_gallery()
{
	global $post;
	$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );

	// Use nonce for verification
     echo '<input type="hidden" name="after_before_gallery_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';

	?>
    <div id="dynamic_form">
      <div id="field_wrap">
        <?php 
        if ( isset( $gallery_data['image_url_before'] ) ) 
        {
            for( $i = 0; $i < count( $gallery_data['image_url_before'] ); $i++ ) 
           {
    
       ?>    
      <div class="field_row maindiv">
        <div class="field_left full titlediv" style="float:none;">
          <div class="form_field">
            <label>Patient Name</label>
            <?php
            $gallery_title="";
            if(isset($gallery_data['image_title'][$i]))
             {
              $gallery_title=$gallery_data['image_title'][$i];
             } 
             ?>
            <input class="meta_image_title" value="<?php echo esc_html($gallery_title); ?>" type="text" name="gallery[image_title][]" />
            <input class="remove_pricing" style="float:right" type="button" value="Remove" onclick="remove_field(this)"  />
          </div>
        </div>
        <div style="width:100%;margin-bottom:10px;padding-left:6px;">
          <small>Patient Name must be enter to display your before after gallery on front</small>
        </div>    
    
        <div class="imgdiv" style="width:100%">
        <div class="box_class" style="float:left; width:50%;">
          <div class="field_left">
            <div class="form_field">
              <label>Before Image URL</label>
              <input class="meta_image_url" value="<?php echo esc_url($gallery_data['image_url_before'][$i]); ?>" type="hidden" name="gallery[image_url_before][]" />
            </div>
          </div>
          <div class="field_right image_wrap">
          <img src="<?php echo esc_url($gallery_data['image_url_before'][$i]); ?>" height="140" width="200" /> <br />
          <input type="button" class="button button-default" value="Choose File" onclick="add_image(this)" />
          </div>
    
    
        </div>
        <div class="box_class" style="float:left; width:50%;">
          <div class="field_left">
            <div class="form_field">
              <label>After Image URL </label>
              <input class="meta_image_url" value="<?php echo esc_url($gallery_data['image_url_after'][$i]); ?>" type="hidden" name="gallery[image_url_after][]" />
            </div>
          </div>
          <div class="field_right image_wrap"> 
          <img src="<?php echo esc_url($gallery_data['image_url_after'][$i]); ?>" height="140" width="200" /><br />
            <input type="button" class="button button-default" value="Choose File" onclick="add_image(this)" />      
          </div>
        </div>
        
        </div><!-- imgdiv -->    
        
        <div class="clear"></div>
      </div>              
      <?php
            } // endif
        } // endforeach
        ?>
    </div>
    <div style="display:none" id="master-row">
      <div class="field_row maindiv">
        <div class="field_left full titlediv" style="float:none;">
          <div class="form_field">
            <label>Image Title</label>
            <input class="meta_image_title" value="" type="text" name="gallery[image_title][]" />
            <input class="remove_pricing" style="float:right" type="button" value="Remove" onclick="remove_field(this)"  />
          </div>
        </div>
        <div style="width:100%;margin-bottom:10px;padding-left:6px;">
          <small>Image title must be enter to display your before after gallery on front</small>
        </div>  
            
        <div class="imgdiv" style="width:100%">
        <div class="box_class" style="float:left; width:50%;">
          <div class="field_left">
            <div class="form_field">
              <label>Before Image URL</label>
              <input class="meta_image_url" value="" type="hidden" name="gallery[image_url_before][]" />
            </div>
          </div>
          <div class="field_right image_wrap"> 
          <input type="button" class="button" value="Choose File" onclick="add_image(this)" />
          </div>
    
        </div>
        <div class="box_class" style="float:left; width:50%;">
          <div class="field_left">
            <div class="form_field">
              <label>After Image URL </label>
              <input class="meta_image_url" value="" type="hidden" name="gallery[image_url_after][]" />
            </div>
          </div>
          <div class="field_right image_wrap"> 
            <input type="button" class="button" value="Choose File" onclick="add_image(this)" />      
          </div>
        </div>
        
        </div><!-- imgdiv -->   
        
        <div class="clear"></div>
      </div>
    </div>
    <div id="add_field_row" class="clear_div">
      <input class="button button-primary button-large" type="button" value="Add Image Gallery" onclick="add_field_row();" />
    </div>
    </div>
	<?php
}
endif;

/**
 * Print styles and scripts
 */
if ( ! function_exists( 'dentistry_print_scripts_before_after' ) ) : 
function dentistry_print_scripts_before_after()
{
    // Check for correct post_type
    global $post;
    if( 'gallery' != $post->post_type )// here you can set post type name
        return;
    ?>
    <style type="text/css">
	#post_gallery  .inside { margin:0; padding:0; }
	#post_gallery  { clear:both; }	
	.clear_div {   padding: 10px;  clear: both;  border-top: 1px solid #ddd;  background: #f5f5f5;}	
	.remove_pricing{   background: #b73b27;
		border-color: #7f291b;
		color: #fff;
		text-shadow: none;
		border-radius: 3px;
		border-width: 1px;
		padding:3px 10px;
	}
	.remove_pricing:hover {   background: #b73b27;
		border-color: #7f291b;
		color: #fff;
		text-shadow: none;
		border-radius: 3px;
		border-width: 1px;
		padding:3px 10px;
	}  	   
	.field_left {
		float:left;
	}
	.field_right {
		float:left;
		margin-left:10px;
	}    
	.field_row .full{
		width:95%;
	}
	.clear {
		clear:both;
	}
	#dynamic_form input[type=text] {
		width:300px;
	}
	#dynamic_form .field_row {
		border: 1px solid #eee;
		padding: 20px;
	}
	#dynamic_form label {
		padding:0 6px;
	}
    </style>
    <script type="text/javascript">
        function add_image(obj) {
          var parent=jQuery(obj).parent().parent('div.box_class');
          var inputField = jQuery(parent).find("input.meta_image_url");
          var inputTitle = jQuery(parent).find("input.meta_image_title");

            tb_show('', 'media-upload.php?TB_iframe=true');
            window.send_to_editor = function(html) {
                var url = jQuery(html).prop('src');
                inputField.val(url);
                jQuery(parent)
                .find("div.image_wrap")
                .html('<img src="'+url+'" height="140" width="200" /><br /><input type="button" class="button" value="Choose File" onclick="add_image(this)" />');
                tb_remove();
            };

            return false;  
        }

        function remove_field(obj) {
            var parent=jQuery(obj).parent().parent().parent();
            //console.log(parent)
            parent.remove();
        }

        function add_field_row() {
            var row = jQuery('#master-row').html();
            jQuery(row).appendTo('#field_wrap');
        }
    </script>
<?php
}
endif;
/**
 * Save post action, process fields
 */ 
  
if ( ! function_exists( 'dentistry_update_metabox_gallery' ) ) :   
function dentistry_update_metabox_gallery( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
 
    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity


    if ( !isset( $_POST['after_before_gallery_meta_box_nonce'] ) || !wp_verify_nonce($_POST['after_before_gallery_meta_box_nonce'] , basename(__FILE__))) {
       return;
    }

   // Correct post type
    if ( 'gallery' != $_POST['post_type'] ) // here you can set post type name
        return;

    if ( $_POST['gallery'] ) 
    {
        // Build array for saving post meta
        $gallery_data = array();
        for ($i = 0; $i < count( $_POST['gallery']['image_url_before'] ); $i++ ) 
        {
            if ( '' != $_POST['gallery']['image_url_before'][ $i ] ) 
            {
                $gallery_data['image_url_before'][]  = $_POST['gallery']['image_url_before'][ $i ];
            }
		
        }
       for ($i = 0; $i < count( $_POST['gallery']['image_url_after'] ); $i++ ) 
        {
            if ( '' != $_POST['gallery']['image_url_after'][ $i ] ) 
            {
                $gallery_data['image_url_after'][]  = $_POST['gallery']['image_url_after'][ $i ];
            }			
      	}
       for ($i = 0; $i < count( $_POST['gallery']['image_title'] ); $i++ ) 
        {		
	        if ( '' != $_POST['gallery']['image_title'][ $i ] ) 
            {
                $gallery_data['image_title'][]  = $_POST['gallery']['image_title'][ $i ];
            }

	}
        if ( $gallery_data ) 
           update_post_meta( $post_id, 'gallery_data', $gallery_data );
       else 
           delete_post_meta( $post_id, 'gallery_data' );
   } 
   // Nothing received, all fields are empty, delete option
   else 
   {
        delete_post_meta( $post_id, 'gallery_data' );
    }
}
endif;
?>