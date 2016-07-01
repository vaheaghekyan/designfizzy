<?php
	$project = get_post();
	$workspace_id = intval(end(hrb_get_cached_workspaces_for($project->ID)));
	$participant = end(hrb_get_post_participants($post->ID)->get_results());
?>

<form id="add-review-form" class="review-user review-user-<?php echo esc_attr( $participant->ID ); ?>" action="<?php echo esc_url( get_permalink( $project->ID ) ); ?>" method="post">

	<div class="row">
		<div class="large-12 columns">
			<label><?php _e( 'Rating', APP_TD ); ?></label>
			<div id="review-rating"></div>
		</div>
	</div>

	<br/>

	<div class="row">
		<div class="large-12 columns">
			<label><?php _e( 'Review', APP_TD ); ?></label>
			<textarea name="comment" id="review_body" class="required"></textarea>
		</div>
	</div>

	<input type="submit" class="button small right" value="<?php esc_attr_e( 'Submit Review', APP_TD ); ?>" onclick="return confirm('<?php echo __( 'Submit Review?', APP_TD ) ?>'); return false;"/>

	<?php
	wp_comment_form_unfiltered_html_nonce();

	hrb_hidden_input_fields(
		array(
			'action'				=> 'review_user',
			'comment_post_ID'		=> esc_attr( $project->ID ),
			'comment_type'			=> esc_attr( APP_REVIEWS_CTYPE ),
			'review_recipient_ID'	=> esc_attr( $participant->ID ),
			'workspace_id'			=> $workspace_id,
			'url_referer'			=> esc_url( $_SERVER['REQUEST_URI'] ),
		)
	);
	?>
</form>
