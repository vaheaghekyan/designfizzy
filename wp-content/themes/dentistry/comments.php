<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>
<div class="col-md-12">
<div id="comments" class="comments-area comments">
	<?php // You can start editing here -- including this comment! ?>
	<?php if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'dentistry' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . esc_html(get_the_title()) . '</span>'
				);
			?>
		</h2>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'dentistry' ); ?></h2>
			<div class="nav-links">
				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'dentistry' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'dentistry' ) ); ?></div>
			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'      => 'li',
					'callback' => 'dentistry_shape_comment',
					'avatar_size' => 100
				) );
			?>
		</ul><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'dentistry' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'dentistry' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'dentistry' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'dentistry' ); ?></p>
	<?php endif; ?>
<?php 
/**
	Comment form.
*/
$comment_form = array(
    'title_reply' => esc_html__('Leave Comments', 'dentistry'),
    'title_reply_to' => esc_html__('Leave a Reply to %s', 'dentistry'),
    'comment_notes_before' => '',
    'fields' => array(
        'author' => '
        <div class="form-group"><div class="col-md-2"><label for="author" class="control-label">Name</label></div>' .
        '<div class="col-md-10"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" aria-required="true"  class="form-control" /></div></div>',
        'email' => '' .
        '<div class="form-group"><div class="col-md-2"><label for="email" class="control-label">E-Mail</label></div>
        <div class="col-md-10"><input class = "form-control" id = "email" name = "email" type = "text" value = "' . esc_attr($commenter['comment_author_email']) . '" aria-required = "true" /></div></div>',
        'url' => '<div class="form-group"><div class="col-md-2"><label for="subject" class="control-label">Subject</label></div>
		<div class="col-md-10"><input class = "form-control" id="subject" name="subject" type="text" value = "'.esc_attr($commenter['comment_author_url']).'"  aria-required="true" /></div></div>',
    ),
    'label_submit' => esc_html__('Submit', 'dentistry'),
    'class_submit' => 'tp-btn tp-btn-default col-md-offset-2',
	'logged_in_as' => '',
    'comment_field' => '',
    'comment_notes_after' => ''
	
        )
;
$comment_form['comment_field'].='<div class="form-group"><div class="col-md-2"><label for="comment" class="control-label">Comment</label></div><div class="col-md-10">
    <textarea name = "comment" rows="8" id = "comment" class = "form-control-text form-control"></textarea></div></div>';
?>
    <div class="leave-comments">
        <?php comment_form($comment_form); ?>
    </div>
</div><!-- #comments -->
</div>