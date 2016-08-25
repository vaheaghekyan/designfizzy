<?php
/**
 *  Template Name: Page+Sidebar
 *
 *
 * @package dentistry
 */

get_header(); ?>
<div class="tp-main-container"> 
  <!--main-container-->
    <div class="container">
      <div class="row">
        <div class="col-md-8 content-left">
          <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-12">
              <?php the_content();?>
			</div>
			<?php endwhile; // End of the loop. ?>
          </div>
        </div>
        <div class="col-md-4">
          <div class="left-sidebar"><!--sidebar-->
				<?php if ( is_active_sidebar( 'sidebar-service' ) ) { ?>
                    <?php dynamic_sidebar( 'sidebar-service' ); ?>
                <?php } ?>          
          </div>
          <!--/.sidebar--> 
        </div>
      </div>
    </div>
  </div>
<!--/.main-container-->
<?php get_footer(); ?>