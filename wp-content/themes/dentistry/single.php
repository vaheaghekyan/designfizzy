<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dentistry
 */

get_header(); 
$blog_layout=dentistry_tg_get_option('blog_layout');
?>
<div class="tp-main-container"> 
	<!--main-container-->
	<div class="tp-blog"> 
    	<!--blog-->
    	<div class="container">
          <div class="row">
			<?php dentistry_blog_layout_sidebar($blog_layout,'left'); ?>
            <div class="<?php echo esc_attr(dentistry_blog_layout_column($blog_layout)); ?>"><!-- col-md-8 -->
              <div class="row">
                  <?php if ( have_posts() ) : ?>
                  <?php /* Start the Loop */ ?>
                  <?php while ( have_posts() ) : the_post(); ?>
                  <?php
                        /* Include the Post-Format-specific template for the content.
                         * If you want to override this in a child theme, then include a file
                         * called content-___.php (where ___ is the Post Format name) and that will be used instead.
                         */
                        get_template_part( 'template-parts/content', 'single' );
                        
                        // related post 
                        dentistry_related_post();
                        
                        //  single post prev and next post display
                        dentistry_single_post_pre_next();
                        
                        // author bio
                        get_template_part( 'author-bio' );
        
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :					
                            comments_template();						
                        endif;
                        // Previous/next post navigation.
                  ?>
                  <?php endwhile; ?>
                  <?php else : ?>
                  <?php get_template_part( 'template-parts/content', 'none' ); ?>
                  <?php endif; ?>                
              </div>
            </div>
            <!--/.content-left-->
			<?php 
                dentistry_blog_layout_sidebar($blog_layout,'right');
            ?>
    		</div>
    	</div>
    </div>
  <!--/.blog--> 
</div>
<!--/.main-container-->
<?php get_footer(); ?>