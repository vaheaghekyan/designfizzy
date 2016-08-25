<?php
/**
 *  Template Name: Blog Template
 *
 * @package dentistry
 */
get_header(); 

$blog_layout=dentistry_tg_get_option('blog_layout');
query_posts('post_type=post&post_status=publish&posts_per_page='.get_option('posts_per_page').'&paged='. get_query_var('paged'));
?>
<!--main-container-->
<div class="tp-main-container">
  <!--blog-->
  <div class="tp-blog">
    <div class="container">
      <div class="row">
		<?php dentistry_blog_layout_sidebar($blog_layout,'left'); ?>
          <div class="<?php echo esc_attr(dentistry_blog_layout_column($blog_layout));?>"><!-- col-md-8 -->
          <div class="row">
			<?php if ( have_posts() ) : ?>
            <?php /* Start the Loop */  ?>
            <?php while ( have_posts() ) : the_post(); ?>
            <?php
                /* Include the Post-Format-specific template for the content.
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
      </div>
    </div>
  </div>
<!--/.blog--> 
</div>
<!--/.main-container-->
<?php get_footer(); ?>