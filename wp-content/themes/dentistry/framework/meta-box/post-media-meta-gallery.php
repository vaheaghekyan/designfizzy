<?php
// The function that outputs the metabox html
function dentistry_product_gallery_metabox() {
	global $post;
	// Here we get the current images ids of the gallery
	$values = get_post_custom($post->ID);
	if(isset($values['product_gallery'])) {
		// The json decode return an array of image ids
		$ids = json_decode($values['product_gallery'][0]);
	}else {
		$ids = array();
	}
	//wp_nonce_field('my_meta_box_nonce', 'post_gallery_meta_box_nonce'); // Security
	echo  '<input type="hidden" name="post_gallery_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
	// Implode the array to a comma separated list
	$cs_ids = implode(",", $ids);   
	// We display the gallery
	$html  = do_shortcode('[gallery ids="'.$cs_ids.'"]');
	// Here we store the image ids which are used when saving the product
	$html .= '<input id="product_gallery_ids" type="hidden" name="product_gallery_ids" value="'.$cs_ids. '" />';
	// A button which we will bind to later on in JavaScript
	$html .= '<div class="clear_div">';
	$html .= '<input id="manage_gallery" title="Manage gallery" type="button" value="Manage gallery" class="button-primary button-large" />';
	if(!empty($cs_ids))	{
		$html .= '&nbsp;&nbsp;<input id="remove_gallery" title="Remove gallery" type="button" value="Remove gallery" class="remove_gallery" />';
		$html .= '</div>';
	}else{
		$html .= '&nbsp;&nbsp;<input id="remove_gallery" title="Remove gallery" type="button" value="Remove gallery" 
		class="remove_gallery" style="display:none;" />';
		$html .= '</div>';		
	}	
	echo $html;
}
// A function that will add the metabox to the edit page
function dentistry_add_product_gallery_metabox() { 
	// More info about arguments in the WP Codex
	add_meta_box(
		'product_gallery',          // Name of the box
		'Gallery',              // Title of the box
		'dentistry_product_gallery_metabox',  // The metabox html function 
		'post',                  // SET TO THE POST TYPE WHERE THE METABOX IS SHOWN
		'normal',                   // Specifies where the box is shown
		'high'                      // Specifies where the box is shown
	); 
}
// This function takes care of saving the metabox's value
function dentistry_save_product_metaboxes($post_id) {
	if ( !isset( $_POST['post_gallery_meta_box_nonce'] ) || !wp_verify_nonce($_POST['post_gallery_meta_box_nonce'] , basename(__FILE__))) {
		return ;
	}		
	// Check if data is in post
	if (isset($_POST['product_gallery_ids'])) {
		// Encode so it can be stored an retrieved properly
		$encode = json_encode(explode(',',$_POST['product_gallery_ids']));
		update_post_meta($post_id, 'product_gallery', $encode);
	}
}
// Hook these actions into Wordpress
add_action('add_meta_boxes', 'dentistry_add_product_gallery_metabox');
add_action('save_post', 'dentistry_save_product_metaboxes');
function dentistry_post_gallery_request() {
	// The $_REQUEST contains all the data sent via ajax
	if ( isset($_REQUEST) ) {
		$call_data = $_REQUEST['call_data'];
		// Let's take the data that was sent and do something with it
		if ( isset($call_data)) {
			echo do_shortcode('[gallery ids="'.$call_data.'"]');
		}
	}
	// Always die in functions echoing ajax content
	die();
}
add_action( 'wp_ajax_dentistry_post_gallery_request', 'dentistry_post_gallery_request' );
add_action( 'admin_head-post.php', 'dentistry_images_call_js' );
add_action( 'admin_head-post-new.php', 'dentistry_images_call_js' );
function dentistry_images_call_js(){ ?>
<script type="text/javascript">
( function( $ ) {
	$( function() {
		$('#manage_gallery').click(function() {
		// Create the shortcode from the current ids in the hidden field
		var gallerysc = '[gallery ids="' + $('#product_gallery_ids').val() + '"]';
		// Open the gallery with the shortcode and bind to the update event
		wp.media.gallery.edit(gallerysc).on('update', function(g) {
		// We fill the array with all ids from the images in the gallery
		var id_array = [];
		$.each(g.models, function(id, img) { id_array.push(img.id); });
		// Make comma separated list from array and set the hidden value
		$('#product_gallery_ids').val(id_array.join(","));
		var call = id_array.join(",");

		var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
			$.ajax({
					url: ajaxurl,
					data: {
					'action':'dentistry_post_gallery_request',
					'call_data' : call
				},
				success:function(data) {
					// This outputs the result of the ajax request
					//console.log(data);
					$('figure.gallery-item').remove();
					$('#product_gallery_ids').before(data);
					$('#remove_gallery').show();
				},
				error: function(errorThrown){
				console.log(errorThrown);
			}
		});				
		// On the next post this field will be send to the save hook in WP
	});
});
$('#remove_gallery').click(function() {
// Create the shortcode from the current ids in the hidden field
$('#product_gallery_ids').val('');
	$('figure.gallery-item').remove();
		$(this).hide();
		// On the next post this field will be send to the save hook in WP
	});
} );
} ( jQuery ) );
</script>
<style type="text/css">
#product_gallery .inside { margin:0; padding:0; }
#product_gallery { clear:both; }
#product_gallery .inside #gallery-1 { clear:both;   float: left; }
#product_gallery .inside #gallery-1 .gallery-item { width:100px; height:100px; float:left; padding:0; margin:9px; margin-bottom:20px; }
#product_gallery .inside #gallery-1 .gallery-item img { width:100px; height:100px; border:5px solid #DDD;}
.clear_div {   padding: 10px;  clear: both;  border-top: 1px solid #ddd;  background: #f5f5f5;}
.remove_gallery {   background: #b73b27;
  border-color: #7f291b;
  color: #fff;
  text-shadow: none;
  border-radius: 3px;
  border-width: 1px;
  padding:3px 10px;
}
.remove_gallery:hover {   background: #b73b27;
  border-color: #7f291b;
  color: #fff;
  text-shadow: none;
  border-radius: 3px;
  border-width: 1px;
  padding:3px 10px;
 }
#product_gallery .inside .wp-caption-text{ display:none; }
</style>
<?php } ?>