<?php 
add_action( 'admin_init', 'dentistry_metabox_add_service_icon' );
add_action( 'admin_head-post.php', 'dentistry_metabox_treaticon_print_scripts' );
add_action( 'admin_head-post-new.php', 'dentistry_metabox_treaticon_print_scripts' );
add_action( 'save_post', 'dentistry_metabox_update_treaticon', 10, 2 );

/**
 * Add custom Meta Box to Posts post type
*/
if ( ! function_exists( 'dentistry_metabox_add_service_icon' ) ) : 

function dentistry_metabox_add_service_icon()
{
	add_meta_box(
	'post_icons',
	'Icon Image Uploader',
	'dentistry_metabox_service_icon',
	'service',// here you can set post type name
	'normal',
	'core');
}

endif;

/**
 * Print the Meta Box content
 */

if ( ! function_exists( 'dentistry_metabox_service_icon' ) ) :  
function dentistry_metabox_service_icon()
{
	global $post;
	$service_data = get_post_meta( $post->ID, 'service_data', true );

	// Use nonce for verification
    echo '<input type="hidden" name="service_icon_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	?>
    <div id="dynamic_form">
      <div id="field_wrap">
        <?php 
        if ( isset( $service_data['service_icon'] ) ) 
        {
        ?>
        <div class="field_row maindiv">
        <div class="box_class">
            <div class="form_field">
              <label>Icon Image</label>
              <input class="meta_image_url" value="<?php echo esc_url($service_data['service_icon']); ?>" type="hidden" name="icons[service_icon]" />
            </div>
          <div class="image_wrap">
          <img src="<?php echo esc_url($service_data['service_icon']); ?>" height="100" width="100" /> <br />
          <input type="button" class="button button-default" value="Choose File" onclick="add_image(this)" />
          </div>
        </div>
        <div class="clear"></div>
       </div>      
        <?php
        }
        else
        { 
		?>
		<div class="field_row maindiv">
			<div class="box_class">
				<div class="form_field">
				  <label>Icon Image</label>
				  <input class="meta_image_url" value="" type="hidden" name="icons[service_icon]" />
				</div>
				<div class="image_wrap"> 
					<input type="button" class="button" value="Choose File" onclick="add_image(this)" />
				</div>
			</div>
			<div class="clear"></div>
		</div>
		<?php
        }
        ?>
    </div>
    </div>
	<?php
}
endif;

/**
 * Print styles and scripts
 */
if ( ! function_exists( 'dentistry_metabox_treaticon_print_scripts' ) ) : 
 
function dentistry_metabox_treaticon_print_scripts()
{
    // Check for correct post_type
    global $post;
    if( 'service' != $post->post_type )// here you can set post type name
        return;
    ?>
    <style type="text/css">
	  #post_icons  { clear:both; }	
	  .image_wrap img{
		  padding:10px 0;
	  }
	  .box_class{
		  padding:15px;
		  float:left;
		  width:50%;

	  }
  	  .field_row .full{
  	  	width:95%;
  	  }
      .clear {
        clear:both;
      }
      #dynamic_form label {
        padding:0 6px;
      }
    </style>
    <script type="text/javascript">
        function add_image(obj) {
          var parent=jQuery(obj).parent().parent('div.box_class');
          var inputField = jQuery(parent).find("input.meta_image_url");

            tb_show('', 'media-upload.php?TB_iframe=true');
            window.send_to_editor = function(html) {
                var url = jQuery(html).prop('src');				
                inputField.val(url);
                jQuery(parent)
                .find("div.image_wrap")
                .html('<img src="'+url+'" height="100" width="100" /><br /><input type="button" class="button" value="Choose File" onclick="add_image(this)" />');
                tb_remove();
            };

            return false;  
        }
    </script>
<?php
}
endif;
/**
 * Save post action, process fields
 */ 
if ( ! function_exists( 'dentistry_metabox_update_treaticon' ) ) :  
  
function dentistry_metabox_update_treaticon( $post_id, $post_object ) 
{
    // Doing revision, exit earlier **can be removed**
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )  
        return;
 
    // Doing revision, exit earlier
    if ( 'revision' == $post_object->post_type )
        return;

    // Verify authenticity

    if ( !isset( $_POST['service_icon_meta_box_nonce'] ) || !wp_verify_nonce($_POST['service_icon_meta_box_nonce'] , basename(__FILE__))) {
       return;
    }

   // Correct post type
    if ( 'service' != $_POST['post_type'] ) // here you can set post type name
        return;

    if ( $_POST['icons'] ) 
    {
        // Build array for saving post meta
        $service_data = array();

		if ($_POST['icons']['service_icon'] != '') 
		{
			$service_data['service_icon'] = $_POST['icons']['service_icon'];
		}
        if ( $service_data ) 
           update_post_meta( $post_id, 'service_data', $service_data );
       else 
           delete_post_meta( $post_id, 'service_data' );
   } 
   // Nothing received, all fields are empty, delete option
   else 
   {
        delete_post_meta( $post_id, 'service_data' );
    }
}
endif;
?>