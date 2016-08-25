<?php
/**
 *  Template Name: Services Template
 *
 * @package dentistry
 */

get_header(); ?>
<div class="tp-main-container"> 
  <!--main-container-->
  <div class="tp-service-thumbnail">
    <div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
        <div class="row">
	        <div class="col-md-12 mb10">
    		    <?php the_content(); ?>
        	</div>
        </div>
        <?php endwhile; // End of the loop. ?>
      <div class="row">
      	<?php 
		$i=1; 
        $args = array( 'post_type' => 'service', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC' );
        $service = new WP_Query( $args );
		$total_element=count($service->posts);
        while ( $service->have_posts() ) : $service->the_post();

		$service_data = get_post_meta( $post->ID, 'service_data', true );	
		$service_icon_type = get_post_meta( $post->ID, 'service_icon_type', true );			

		if(isset($service_icon_type) && !empty($service_icon_type))
		{
			$service_icon_html = '<div class="service-caption service-icon">
            <i class="'.$service_icon_type.'"></i>
            </div>';
		}
		else if(isset($service_data['service_icon']))
		{
			$service_icon_html = '<div class="service-caption service-icon">
            <img src="'.esc_url($service_data['service_icon']).'"  class="img-responsive" alt="">
            </div>';
		}		
		else
		{
			$service_icon_html = '';
		}	
		
        ?>
        <div class="col-md-4 service-block">
          <div class="service-pic">
          <div class="effect-pic">
          <a href="<?php the_permalink(); ?>">
          	<?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
               the_post_thumbnail( 'full' ,array( 'class' => 'img-responsive' )  );
            }
            ?>   
          </a>
          </div>
          <?php echo $service_icon_html; ?>  
          </div>
          <div class="tp-section-service space-block">
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','dentistry'); ?></a>             
            </div>
        </div>
        <?php
			if(($i%3)==0 && $i<$total_element)
			{
				echo '</div><div class="row">';
			}				
			$i++;
			endwhile; 		
			wp_reset_postdata();		
		?>    
      </div>
    </div>
  </div>
</div>
<!--/.main-container-->
<?php get_footer(); ?>
