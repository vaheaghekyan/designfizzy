<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */

get_header(); 

$blog_layout=dentistry_tg_get_option('blog_layout');
?>
<div class="tp-main-container"><!-- #main-container -->
	<div class="tp-blog"><!--blog-->
    	<div class="container">
    		<div class="row">
				<?php dentistry_blog_layout_sidebar($blog_layout,'left'); ?>        
                <div class="<?php echo esc_attr(dentistry_blog_layout_column($blog_layout)); ?>"><!-- col-md-8 -->	
                    <div class="row">
                        <?php if ( have_posts() ) : ?>
                        <div class="col-md-12">
                            <header class="page-header">
                                <?php
                                    the_archive_title( '<h1 class="page-title">', '</h1>' );
                                    the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                ?>
                            </header><!-- .page-header -->
                        </div>
                        <?php /* Start the Loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                        <?php
                        /*
                         * Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', get_post_format() );
                        ?>                        
                        <?php endwhile; ?>
                        <?php dentistry_pagination(); ?>
                        <?php else : ?>
                        <?php get_template_part( 'template-parts/content', 'none' ); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- /.content left -->
				<?php 
                    dentistry_blog_layout_sidebar($blog_layout,'right');
                ?>
			</div><!--// #row -->
		</div><!--// #container -->
	</div><!--// #blog-->
</div><!--// #main-container -->
<?php get_footer(); ?>