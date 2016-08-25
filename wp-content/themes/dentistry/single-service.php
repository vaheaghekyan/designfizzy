<?php
/**
 * The template for displaying all Doctor posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dentistry
 */

get_header(); 
$service_layout=dentistry_tg_get_option('service_layout');
?>
<div class="tp-main-container"> 
  <!--main-container-->
  <div class="tp-service-single"> 
    <!--service-single-->
    <div class="container">
      <div class="row">
        <div class="<?php echo esc_attr( dentistry_service_layout_column($service_layout));?>">
          <div class="row">
			<?php while ( have_posts() ) : the_post(); ?>
            <div class="col-md-12">
              <div class="effect-pic">
              <?php 
				if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
					the_post_thumbnail( 'full',array( 'class' => 'img-responsive' ) );
				}			  
			  ?>
              </div>
              <h1><?php the_title(); ?></h1>              
              <?php the_content();?>
			</div>
			<?php endwhile; // End of the loop. ?>
          </div>
        </div>
        <?php 
		if($service_layout=="right_sidebar")
		{
		?>
        <div class="col-md-4">
          <div class="left-sidebar"><!--sidebar-->
			<?php if ( is_active_sidebar( 'sidebar-service' ) ) { ?>
                <?php dynamic_sidebar( 'sidebar-service' ); ?>
            <?php } ?>          
          </div>
        </div>
        <?php 
		}
		?>
      </div>
    </div>
  </div>
  <!--/.service-single--> 
</div>
<!--/.main-container-->
<?php get_footer(); ?>