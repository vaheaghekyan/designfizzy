<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package dentistry
 */

get_header(); 

$blog_layout=dentistry_tg_get_option('blog_layout');
?>
<!--main-container-->
<div class="tp-main-container">
    <!-- tp-main-container-->
    <div class="container">
    	<div class="row">
		<?php 
             dentistry_blog_layout_sidebar($blog_layout,'left');
        ?>
        <div class="<?php echo esc_attr(dentistry_blog_layout_column($blog_layout));?>"><!-- col-md-8 -->
  			<div class="row">
				<?php if ( have_posts() ) : ?>
                <div class="col-md-12">
                <header class="page-header">
                <h1 class="page-title">
					<?php printf( esc_html__( 'Search Results for: %s', 'dentistry' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                </header><!-- .page-header -->
                </div>
                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>
                <?php
                /**
                 * Run the loop for the search to output the results.
                 * If you want to overload this in a child theme then include a file
                 * called content-search.php and that will be used instead.
                 */
                get_template_part( 'template-parts/content', 'search' );
                ?>
                <?php endwhile; ?>
                <?php dentistry_pagination(); ?>
                <?php else : ?>
                <?php get_template_part( 'template-parts/content', 'none' ); ?>
                <?php endif; ?>
                </div>
            </div>        
      		<?php 
          		dentistry_blog_layout_sidebar($blog_layout,'right');
        	?>
          </div><!-- row -->
    </div><!-- container -->
</div><!-- tp-main-container -->
<?php get_footer(); ?>
