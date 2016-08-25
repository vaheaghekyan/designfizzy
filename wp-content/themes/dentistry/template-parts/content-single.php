<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */

$post_format = get_post_format();
if ($post_format === false) {
	$post_format = 'image';
}
$data = '';

switch ($post_format) {
	case 'standard':
		$style = 0;
		$data = '';
	break;
	case 'image':
		if (wp_get_attachment_url(get_post_thumbnail_id($post->ID))) {
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			$data .= '<div class="post-image"><div class="effect-pic"><img alt="" class="img-responsive" src="'.esc_url($thumbnail_url).'"/></div></div>';
		}
	break;
	case 'gallery':
		$values = get_post_custom();
		if(isset($values['product_gallery'])) {
			// The json decode and base64 decode return an array of image ids
			$ids = json_decode($values['product_gallery'][0]);								
		}
		else {
			$ids = array();								
		}												
		if (get_post_meta(get_the_ID(), 'product_gallery', true)) {
			$st_gallery_blog = get_post_meta(get_the_ID(), 'product_gallery', true);
		}															
		$data .= '<div id="owl-gallery" class="">';  // owl-corsol
		foreach ($ids as $item) {
			$thumbnail_url = wp_get_attachment_url($item);
			$data .= '<div class="item">';
			$data .= '<img src="'.esc_url($thumbnail_url).'" alt="" />';
			$data .= '</div>';
		}
		$data .= '</div>';							
	break;
	case 'video':			    	
		if (get_post_meta(get_the_ID(), 'show_video', true)) {
			$media_url = get_post_meta(get_the_ID(), 'show_video', true);			            
			$data .= '<div class="videoWrapper">';
			$data .= dentistry_video_embed(wp_oembed_get( $media_url ));
			$data .= '</div>';
		}
	break;
	case 'audio':
		if (get_post_meta(get_the_ID(), 'show_audio', true)) {
			$media_url = get_post_meta(get_the_ID(), 'show_audio', true);
			$data .= '<div class="videoWrapper">';
			$data .= '<div class="audio">'.dentistry_video_embed(wp_oembed_get($media_url)).'</div>';
			$data .= '</div>';
		}
	break;
	default:
		if (wp_get_attachment_url(get_post_thumbnail_id($post->ID))) {
			$thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
			$data .= '<div class="post-image"><div class="effect-pic"><img alt="" class="img-responsive" src="'.esc_url($thumbnail_url).'"/></div></div>';
		}
	break;
}
?>
<div class="col-md-12">
 <div class="post-holder"><!-- post holder -->
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php echo $data; ?>
    	<?php the_title( '<h1>', '</h1>' );?>
        <?php 
		if ( 'post' == get_post_type() ) :
			dentistry_blog_meta_html();	
		endif;
		?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'dentistry' ),
                    'after'  => '</div>',
                ) );
            ?>
        </div><!-- .entry-content -->
    </div><!-- #post-## -->
  </div><!-- /.post holder --> 
</div>