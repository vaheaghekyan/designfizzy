<?php
/**
 * dentistry functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package dentistry
 */


if ( ! function_exists( 'dentistry_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function dentistry_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on dentistry, use a find and replace
	 * to change 'dentistry' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'dentistry', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'dentistry' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'aside',
		'image',
		'video',
		'quote',
		'audio',
		'link',
		'gallery',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'dentistry_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

    add_editor_style( '/css/custom-editor-style.css' );	
}
endif; // dentistry_setup
add_action( 'after_setup_theme', 'dentistry_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function dentistry_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'dentistry_content_width', 640 );
}
add_action( 'after_setup_theme', 'dentistry_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dentistry_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'dentistry' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Secondary', 'dentistry' ),
		'id'            => 'sidebar-service',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="widget-box %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'dentistry' ),
		'id'            => 'sidebar-footer',
		'description'   => '',
		'before_widget' => '<div id="%1$s" class="col-md-3 ft-link-block %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3>',
		'after_title'   => '</h3>',
	) );		
}
add_action( 'widgets_init', 'dentistry_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function dentistry_scripts() {
	
	// Bootstrap 
	wp_enqueue_style( 'dentistry-bootstrap', get_template_directory_uri() .'/css/bootstrap.min.css','', '3.3.5' );	

	// Custom - style

	wp_enqueue_style( 'dentistry-custom-style', get_template_directory_uri() .'/css/custom-style.css');	
	if(function_exists('dentistry_tg_get_option')){
		$color = dentistry_tg_get_option('color_layout');
		if($color=="blue")
		{
			wp_enqueue_style( 'dentistry-custom-blue', get_template_directory_uri() .'/css/custom-style-blue.css');	
		}
	}
	
	// OWL - style
	wp_enqueue_style( 'dentistry-owl-carousel', get_template_directory_uri() .'/css/owl.carousel.css');		
	wp_enqueue_style( 'dentistry-owl-theme', get_template_directory_uri() .'/css/owl.theme.css');		
	wp_enqueue_style( 'dentistry-owl-transitions', get_template_directory_uri() .'/css/owl.transitions.css');		
		
	


	// Font Awesome
	wp_enqueue_style( 'dentistry-awesome-min', get_template_directory_uri() .'/css/font-awesome.min.css','', '4.4.0' );	
	
	wp_enqueue_style( 'dentistry-animate', get_template_directory_uri() .'/css/animate.css');	

	wp_enqueue_style( 'dentistry-navigation', get_template_directory_uri() .'/css/navigation.css');		

	wp_enqueue_style( 'dentistry-flaticon', get_template_directory_uri() .'/css/flaticon.css');		

	wp_enqueue_style( 'dentistry-style', get_stylesheet_uri() );
	
	// Bootstrap JS
	wp_enqueue_script( 'dentistry-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array(), null, true );	

	wp_enqueue_script( 'dentistry-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

	wp_enqueue_script( 'dentistry-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

	wp_enqueue_script( 'dentistry-owl-min', get_template_directory_uri() . '/js/owl.carousel.min.js', array(), null, true );

	if(is_rtl())
	{
		wp_enqueue_script( 'dentistry-custom-script', get_template_directory_uri() . '/js/custom-script-rtl.js', array('jquery'), null, true );
	}
	else{
		wp_enqueue_script( 'dentistry-custom-script', get_template_directory_uri() . '/js/custom-script.js', array('jquery'), null, true );
	}

	
	if(is_page_template('page-templates/gallery.php'))
	{
		wp_enqueue_style( 'dentistry-magnific-popup-style', get_template_directory_uri() .'/css/magnific-popup.css');
		wp_enqueue_script( 'dentistry-isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array(), null, true );
		wp_enqueue_script( 'dentistry-magnific-popup', get_template_directory_uri() . '/js/jquery.magnific-popup.min.js', array(), null, true );		
		wp_enqueue_script( 'dentistry-filter-script', get_template_directory_uri() . '/js/filter-script.js', array(), null, true );		
		wp_enqueue_script( 'dentistry-popup-gallery', get_template_directory_uri() . '/js/popup-gallery.js', array(), null, true );		
	}


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'dentistry_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Load Menu Walker file.
 */
require get_template_directory() . '/inc/nav-menu-walker.php';


/**
 * Load Framework Init file.
 */

require get_template_directory() . '/framework/init.php';


/**
 * Load Service Widget file.
 */
require get_template_directory() . '/inc/widget/service_widget.php';

/**
 * Load Popular Post file.
 */
require get_template_directory() . '/inc/widget/popular_post.php';

/**
 * Load Footer Post file.
 */
require get_template_directory() . '/inc/widget/footer_post.php';

/**
 * Load TGM file.
 */
require get_template_directory() . '/tgm-plugin/dentistry-plugin.php';



/**
 * 	Pagination 
 */
if ( ! function_exists( 'dentistry_pagination' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @since Devote 1.0
 *
 * @global WP_Query   $wp_query   WordPress Query object.
 * @global WP_Rewrite $wp_rewrite WordPress Rewrite object.
 */
function dentistry_pagination() {
	global $wp_query, $wp_rewrite;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 ) {
		return;
	}

	$paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
	$pagenum_link = html_entity_decode( get_pagenum_link() );
	$query_args   = array();
	$url_parts    = explode( '?', $pagenum_link );

	if ( isset( $url_parts[1] ) ) {
		wp_parse_str( $url_parts[1], $query_args );
	}

	$pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
	$pagenum_link = trailingslashit( $pagenum_link ) . '%_%';

	$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
	$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

	// Set up paginated links.
	$links = paginate_links( array(
		'base'     => $pagenum_link,
		'format'   => $format,
		'total'    => $wp_query->max_num_pages,
		'current'  => $paged,
		'mid_size' => 1,
		'add_args' => array_map( 'urlencode', $query_args ),
		'prev_text' => esc_html__( 'PREV', 'dentistry' ),
		'next_text' => esc_html__( 'NEXT', 'dentistry' ),
	) );

	if ( $links ) :
	?>
		<div class="col-md-12 tp-pagination">
        	<div class="pagination">
			<?php echo $links; ?>
			</div><!-- .pagination -->            
		</div><!-- .md 12 -->
	<?php
	endif;
}
endif; 


if ( ! function_exists( 'dentistry_single_post_pre_next' ) ) :

function dentistry_single_post_pre_next() {
	 $p = get_adjacent_post(false, '', true); 
	 $n = get_adjacent_post(false, '', false);
	 if(!empty($p) || !empty($n)){
 		echo '<div class="col-md-12"><div class="prev-next-links"><div class="row">';
		
        // previous post title with link 
        if(!empty($p))
		printf('<div class="col-md-6 col-sm-6 prev-link"><a href="#"><span><i class="fa fa-long-arrow-left"></i> Previous</span> </a><h3><a href="%s" title="%s">%s</a></h3></div>', get_permalink($p->ID), get_permalink($p->ID) , $p->post_title , $p->post_title  );
	                
		// next post title with link 
		if(!empty($n))
		printf('<div class="col-md-6 col-sm-6 text-right next-link"> <a href="%s"><span>Next <i class="fa fa-long-arrow-right"></i> </span></a><h3><a href="%s" title="%s">%s</a></h3></div>', get_permalink($n->ID), get_permalink($n->ID), $n->post_title , $n->post_title ); 
				
 		echo '</div></div></div>';
	 }		
}

endif; 


/**
 * 	Related Post.
 */
if ( ! function_exists( 'dentistry_related_post' ) ) :
 
function dentistry_related_post() {

	global $post;
	$original_post ="";
	$categories = get_the_category($post->ID);
	
	if ($categories) {
	echo '<div class="col-md-12"><div class="related-post"> <h2 class="related-title">Related Post</h2> <div class="row">';	
	
			$category_ids = array();		
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;		
				$args=array(
					'category__in' => $category_ids,
					'post__not_in' => array($post->ID),
					'posts_per_page'=> 2, // Number of related posts that will be shown.
					'ignore_sticky_posts'=>1
				);				
				$related_post_query = new wp_query( $args );
				if( $related_post_query->have_posts() ) {	
					while( $related_post_query->have_posts() ) {
						$related_post_query->the_post(); 
						echo '<div class="col-md-6">';
						?>
                        <h3><a href="<?php the_permalink()?>"><?php the_title(); ?></a></h3>  
						<p class="related-category">In 
                        <?php 
						$categories = get_the_category();
						$separator = ' , ';
						$output = '';
						if ( ! empty( $categories ) ) {
							foreach( $categories as $category ) {
								$output .= '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" title="' . esc_attr( sprintf( esc_html__( 'View all posts in %s', 'dentistry' ), $category->name ) ) . '">"' . esc_html( $category->name ) . '"</a> ' . $separator;
							}
							echo trim( $output, $separator );
						}
						?>
						</p>
						<?php
						echo '</div>';
				} // if
			} // foreach
			echo '</div></div></div>';
	} // if			
	$post = $original_post;
	wp_reset_postdata();
}

endif; 

if ( ! function_exists( 'dentistry_shape_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Shape 1.0
 */
function dentistry_shape_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	extract($args, EXTR_SKIP);

	if ( 'div' == $args['style'] ) {
		$tag = 'div';
		$add_below = 'comment';
	} else {
		$tag = 'li';
		$add_below = 'div-comment';
	}
?>
	<<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
	<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
	<?php endif; ?>
	<div class="text-outer"><!-- text-outer block start-->    
    	<div class="comment-section">
            <div class="comment-frame">      			
                <div class="user-pic">
                    <?php if (0 != $args['avatar_size']) echo get_avatar($comment, $args['avatar_size'] ); ?>
                </div>
            </div>
            <div class="tex-box user-comment">
                 <div class="comment-body">
                    <h3><?php 
                        printf(__('%s', 'dentistry'), sprintf('%s', get_comment_author_link())); ?>
                   </h3>
                    <div class="user-name">
                        <small><?php 
                            comment_time('d, F,Y');	?>
                        </small>
                        <small><?php 
                            echo human_time_diff( get_comment_time('U'), current_time('timestamp') ) . ' ago'; ?>
                        </small> <?php 
                            edit_comment_link( esc_html__( '(Edit)', 'dentistry' ), ' ' ); ?> 
                    </div> <!-- meta -->
                    <div class="comment-post">
                    <?php if ( $comment->comment_approved == '0' ) : ?>
                        <em><?php esc_html_e( 'Your comment is awaiting moderation.', 'dentistry' ); ?></em>
                        <br />
                    <?php endif; ?>
                    <?php comment_text(); ?>
                    </div>										
                    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                 </div><!-- media-body -->
            </div>
        </div>
    </div><!-- row block end--> 
	<?php if ( 'div' != $args['style'] ) : ?>
	</div>
	<?php endif; 
}
endif; // ends check for dentistry_shape_comment()

/**
*  The Blog post video iframe support browser.
*/
if(!function_exists('dentistry_video_embed')){
    function dentistry_video_embed($embed_code){
		$embed_code=str_replace('webkitallowfullscreen','',$embed_code);
		$embed_code=str_replace('mozallowfullscreen','',$embed_code);
		$embed_code=str_replace('frameborder="0"','',$embed_code);
		$embed_code=str_replace('frameborder="no"','',$embed_code);
		$embed_code=str_replace('scrolling="no"','',$embed_code);
		$embed_code=str_replace('&','&amp;',$embed_code);
		return $embed_code;
	}
}

if(!function_exists('dentistry_remove_empty_p')){
	function dentistry_remove_empty_p($content){
		$content = force_balance_tags($content);
		return preg_replace('#<p>\s*+(<br\s*/*>)?\s*</p>#i', '', $content);
	}
}

if(!function_exists('dentistry_blog_layout_sidebar')){
function dentistry_blog_layout_sidebar($val,$side){
	if($val=="blog_right" && $side=="right"){
	    echo '<div class="col-md-4 tp-right-side">';
		if ( is_active_sidebar( 'sidebar-1' ) ){
			dynamic_sidebar( 'sidebar-1' );
		}
	    echo '</div>';	
	}else if($val=="blog_left" && $side=="left"){
		
	    echo '<div class="col-md-4 tp-left-side">';
		if ( is_active_sidebar( 'sidebar-1' ) ) {
			dynamic_sidebar( 'sidebar-1' );
		}
	    echo '</div>';	
	}
	else if($side=="right" && $val==""){
	    echo '<div class="col-md-4 tp-right-side">';
		
		if ( is_active_sidebar( 'sidebar-1' ) ){
			dynamic_sidebar( 'sidebar-1' );
		}
	    echo '</div>';		
	}
}
}

if(!function_exists('dentistry_blog_layout_column')){
	function dentistry_blog_layout_column($val){
		if($val=="blog_right"){
			$class="col-md-8 tp-left-side";
		}else if($val=="blog_left"){
			$class="col-md-8 tp-right-side";
		}else{
			$class="col-md-8 tp-left-side";	
		}
		return esc_attr($class);
	}
}

if(!function_exists('dentistry_service_layout_column')){
	function dentistry_service_layout_column($val){
		if($val=="right_sidebar"){
			$class="col-md-8 content-left";
		}else if($val=="full"){
			$class="col-md-12";
		}else{
			$class="col-md-8 content-left";	
		}
		return esc_attr($class);
	}
}
// Replace class on comment link
add_filter('comment_reply_link', 'dentistry_replace_reply_link_class');

function dentistry_replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='btn tp-btn-grey", $class);
    return $class;
}
?>