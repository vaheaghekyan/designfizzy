<?php
/**
 * The template for displaying Comments.
 */
?>

<?php $is_dispute = hrb_is_disputes_enabled() && APP_DISPUTE_PTYPE == get_post_type(); ?>

<div id="comments" class="row">
	<div class="columns-12">

		<?php if ( post_password_required() ) : ?>
			<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', APP_TD ); ?></p>
		</div><!-- #comments -->
		<?php
				/* Stop the rest of comments.php from being processed,
				 * but don't kill the script entirely -- we still have
				 * to fully load the template.
				 */
				return;
			endif;
		?>

		<?php // You can start editing here -- including this comment! ?>

		<div class="section-head">
			<a id="add-review" name="add-review"></a>
			<h2 id="left-hanger-add-review"><?php _e( ( HRB_PROJECTS_PTYPE == get_post_type() || HRB_WORKSPACE_PTYPE == get_post_type() ? __( 'Clarification Board', APP_TD ) : __( 'Discussion', APP_TD ) ), APP_TD ); ?></h2>
		</div>

		<?php appthemes_before_comments(); ?>

		<?php if ( have_comments() ) : ?>
			<h2 id="comments-title">
				<?php
					if ( HRB_PROJECTS_PTYPE != get_post_type() && ! $is_dispute ) {
						$type = __( 'thought', APP_TD );
					} else {
						$type = __( 'messages', APP_TD );
					}
					printf( _n( 'One %2$s on &ldquo;%3$s&rdquo;', '%1$s %2$s on &ldquo;%3$s&rdquo;', get_comments_number(), APP_TD ),
					number_format_i18n( get_comments_number() ), $type, '<span>' . get_the_title() . '</span>' );
				?>
			</h2>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-above">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', APP_TD ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', APP_TD ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', APP_TD ) ); ?></div>
			</nav>
			<?php endif; // check for comment navigation ?>

			<ol class="commentlist">
				<?php
					/* Loop through and list the comments. Tell wp_list_comments()
					 * to use twentyeleven_comment() to format the comments.
					 * If you want to overload this in a child theme then you can
					 * define twentyeleven_comment() and that will be used instead.
					 * See twentyeleven_comment() in twentyeleven/functions.php for more.
					 */
					wp_list_comments('avatar_size=75&callback=custom_comment_template');

				?>
			</ol>

			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
			<nav id="comment-nav-below">
				<h1 class="assistive-text"><?php _e( 'Comment navigation', APP_TD ); ?></h1>
				<div class="nav-previous"><?php previous_comments_link( __( '&larr; Older Comments', APP_TD ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( 'Newer Comments &rarr;', APP_TD ) ); ?></div>
			</nav>
			<?php endif; // check for comment navigation ?>

		<?php
			/* If there are no comments and comments are closed, let's leave a little note, shall we?
			 * But we don't want the note on pages or post types that do not support comments.
			 */
			elseif ( ! comments_open() && ! is_page() && post_type_supports( get_post_type(), 'comments' ) ) :
		?>
			<p class="nocomments"><?php _e( 'Discussion is closed.', APP_TD ); ?></p>
		<?php 
			endif; 

			if ( !hrb_custom_is_clarification_access() ){
				appthemes_load_template( 'single-project-section-confirm.php' );
			}	
		?>

		<?php appthemes_after_comments(); ?>

		<?php appthemes_before_comments_form(); ?>

		<?php
			$post_id = null;

			$comment_form_args = array(				
				'comment_field' => '<p class="comment-form-comment"><label for="comment">' 
									. _x( 'Message', 'noun', APP_TD ) 
									. '</label> <textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Your message..."></textarea>'
									. '<input type="hidden" name="redirect_to" value="'.get_permalink($post_id).(isset($_GET["hash"])?"?hash=".get_query_var("hash"):"").'"/></p>'
									. '<input type="hidden" name="hb_custom_attached_files" value=""\>'
									. '<input type="hidden" name="hb_custom_attached_files_id" value=""\>'
									. '<input type="button" class="button-primary button button-small right pull-right hb_custom_media_upload_button" id="hb_custom_media_clarification_board" value="Attach files" /><label class="max_file_size">Max file size 40mb.</label>'
									. '<label for="hrb_custom_watermark">'
									. '<input type="checkbox" name="hb_custom_watermark" id="hrb_custom_watermark" value="1">'
									. '&nbsp;&nbsp;&nbsp;' . __('Add Watermark', APP_TD) . '</label>',
				'logged_in_as'  => '<p class="logged-in-as">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a><a href="%3$s" title="Log out of this account">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '</p>',
				'label_submit'  => __( 'Submit Request', APP_TD ),


			);

			if( 'employer' == hrb_get_participant_type() ){
				$project_status = sanitize_text_field( $_POST['project_status'] );
		
				if ( hrb_get_project_statuses_verbiages( $project_status ) == "Work In Progress" ){
					$comment_form_args['title_reply'] = 'Please write your modification request below';	
				}

			}

			if( HRB_WORKSPACE_PTYPE == get_post_type()){
				$comment_form_args['logged_in_as'] = '';
				$comment_form_args['comment_notes_after'] = '';
			}
		?>

		<?php
			// skip the login buttons for disputes comments
			if ( $is_dispute ) {
				$comment_form_args['logged_in_as'] = '';
			}
		?>

		<?php 		
			if ( !hrb_custom_is_complete_status() ){
				comment_form( $comment_form_args ); 
			}	
		?>

		<?php appthemes_after_comments_form(); ?>

	</div>
</div><!-- #comments -->
