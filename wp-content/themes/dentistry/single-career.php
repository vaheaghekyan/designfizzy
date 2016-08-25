<?php
/**
 * The template for displaying all Doctor posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dentistry
 */

get_header(); ?>
<div class="tp-main-container"> 
  <!--main-container-->
  <div class="tp-service-single"> 
    <!--service-single-->
    <div class="container">
      <div class="row">
        <div class="col-md-8 content-left">
          <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-12">
              <h1><?php the_title(); ?></h1>
              <?php 
				$clinic_address=get_post_meta( $post->ID, 'clinic_address', true );
		
				if(!empty($clinic_address))
				{
					echo '<p class="location"> <i class="fa fa-map-marker"></i>'.esc_html($clinic_address).'</p>';
				}					  
				the_content();	  
			  ?>
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
  <!--/.service-single--> 
</div>
<!--/.main-container-->
<?php get_footer(); ?>