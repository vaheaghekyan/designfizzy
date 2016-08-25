<?php
/**
 *  Template Name: Page+Slider
 *
 * @package dentistry
 */

get_header(); 

$args = array( 'post_type' => 'slider' , 'posts_per_page' => -1 , 'orderby' => 'menu_order ID','order' => 'ASC','post_status'=> 'publish' );
$loop = new WP_Query( $args );

if($loop->have_posts())
{
?>
<div class="tp-slider"><!-- slider start -->
  <div id="slider" class="owl-carousel owl-theme main-slider">
	<?php 
    while ( $loop->have_posts() ) : $loop->the_post();
    ?>
    <div class="item">
      <div class="container">
        <div class="caption">
          <h1><?php the_title(); ?></h1>
          <p><?php echo esc_html(get_post_meta( $post->ID, 'slider_content', true)); ?></p>
		 <?php if(get_post_meta( $post->ID, 'slider_btn_onoff', true )=='on'){ ?>
          <a href="<?php echo esc_url(get_post_meta( $post->ID, 'slider_btn_url', true ));?>" class="btn tp-btn-second"><?php echo 
		  get_post_meta( $post->ID, 'slider_btn_txt', true ); ?></a>
          <?php } ?>
         </div>
      </div>
        <?php 
		  if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
			  the_post_thumbnail( 'full');
		  }
          ?>
      </div>
    <?php 
  endwhile;
  wp_reset_postdata();
  ?>
  </div>
</div>
<!-- /.slider end -->
<?php 
}

while ( have_posts() ) : the_post(); 
?>
<div class="page-slider-content">
    <?php 
    the_content();
    ?>
</div>
<?php
endwhile; // End of the loop. ?>
<?php get_footer(); ?>