<?php
add_action( 'add_meta_boxes', 'dentistry_pricing_meta_box' );
/* Do something with the data entered */
add_action( 'save_post', 'dentistry_pricing_meta_save' );
/* Adds a box to the main column on the Post and Page edit screens */

function dentistry_pricing_meta_box() {
    add_meta_box(
        'pricing_table',
        esc_html__( 'Pricing Table', 'dentistry' ),
        'dentistry_pricing_table_custom_box',
        'service');
}
/* Prints the box content */
function dentistry_pricing_table_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dentistry_dynamic_meta_nonce' );
    ?>
    <div class="pricing_details">
        <?php	
        //get the saved meta as an arry
        $pricing = get_post_meta($post->ID,'pricing',true);
        $c = 0;     
        if ( count( $pricing ) > 1) {         
        foreach( $pricing as $consult_pricing ) {             
            if ( isset( $consult_pricing['consult'] ) || isset( $consult_pricing['cost'] ) ) 
            {                 
                printf( '<p> Consult Name:<input type="text" name="pricing[%1$s][consult]" value="%2$s" />&nbsp;&nbsp; Time <input type="text"  name="pricing[%1$s][time]" value="%3$s" />&nbsp;&nbsp; Price <input type="text"  name="pricing[%1$s][cost]" value="%4$s" class="last_price" />  <button class="remove_pricing remove_price">%5$s</button></p>', $c, $consult_pricing['consult'], $consult_pricing['time'],$consult_pricing['cost'],
        'Remove' );                 
                $c = $c +1;             
                }         
            }     
        }
        echo '<span id="here"></span>';
        ?>   
    </div>	
    <div class="clear_div">
    <button class="add button button-primary button-large"> Add New Price </button>
    </div>
<script type="text/javascript">
var $ =jQuery.noConflict();
$(document).ready(function() {
	var count = <?php echo esc_js($c); ?>;
	$(".add").click(function() {
		count = count + 1;

		$('#here').append('<p> Consult Name<input type="text" name="pricing['+count+'][consult]" value="" />&nbsp;&nbsp; Time: <input type="text" name="pricing['+count+'][time]" value="" />&nbsp;&nbsp; Price: <input type="text" name="pricing['+count+'][cost]" class="last_price" value="" /><button class="remove_pricing remove_price">Remove</button></p>');
		return false;
	});
	$(".remove_price").live('click', function() {
		$(this).parent().remove();
	});
});
</script>  
<style type="text/css">
#pricing_table .inside { margin:0; padding:0; }
#pricing_table { clear:both; }	
.pricing_details { margin-left:25px; }
.clear_div {   padding: 10px;  clear: both;  border-top: 1px solid #ddd;  background: #f5f5f5;}	
.remove_pricing{   background: #b73b27;
  border-color: #7f291b;
  color: #fff;
  text-shadow: none;
  border-radius: 3px;
  border-width: 1px;
  padding:3px 10px;
  float:right;
  margin-right:20px;
}
.remove_pricing:hover {   background: #b73b27;
  border-color: #7f291b;
  color: #fff;
  text-shadow: none;
  border-radius: 3px;
  border-width: 1px;
  padding:3px 10px;
 }	
.last_price{
	width:100px;
}
</style>    
<?php 
}

function dentistry_pricing_meta_save( $post_id ) {  
    // verify if this is an auto save routine. 
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
        return;
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dentistry_dynamic_meta_nonce'] ) )
        return;
    if ( !wp_verify_nonce( $_POST['dentistry_dynamic_meta_nonce'], plugin_basename( __FILE__ ) ) )
        return;
    // OK, we're authenticated: we need to find and save the data
    $pricing = $_POST['pricing'];
    update_post_meta($post_id,'pricing',$pricing);
}
?>