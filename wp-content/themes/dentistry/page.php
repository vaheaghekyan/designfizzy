<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package dentistry
 */

get_header(); ?>
<!--main-container-->
<div class="tp-main-container">
    <div class="container">
    	<div class="row">
            <div class="col-md-12">
				<?php while ( have_posts() ) : the_post(); ?>
                    <?php get_template_part( 'template-parts/content', 'page' ); ?>
                    <?php
                        // If comments are open or we have at least one comment, load up the comment template.
                        if ( comments_open() || get_comments_number() ) :
                            comments_template();
                        endif;
                    ?>
                <?php endwhile; // End of the loop. ?>
	      	</div>
		</div>
  	</div>
</div>
<!--/.main-container-->    
<?php get_footer(); ?>
