<?php
/**
 *  Template Name: Services Icon
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
        $args = array( 'post_type' => 'service', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order' => 'ASC' );
        $service = new WP_Query( $args );
		$total_element=count($service->posts);
        while ( $service->have_posts() ) : $service->the_post();

		$service_data = get_post_meta( $post->ID, 'service_data', true );	
		
		if(($i%2)==0)
		{
			$box_class="tp-dark-box";
		}
		else{
			$box_class="tp-light-box";
		}	
        ?>
        <div class="col-md-4 <?php echo esc_attr($box_class);?>"> 
          <!--tp-dark-box-->
          <div class="tp-service-blk"> 
            <!--service-box-->
            <div class="service-icon"><a href="<?php the_permalink(); ?>">
            <?php

			$service_icon_type = get_post_meta($post->ID, 'service_icon_type', true );	

			if(isset($service_icon_type) && !empty($service_icon_type))
			{
				echo '<div class="service-three-icon service-icon">
				<i class="'.$service_icon_type.'"></i>
				</div>';
			}			 
			else if(isset($service_data['service_icon']))
			{
				echo '<img src="'.esc_url($service_data['service_icon']).'"  class="img-responsive" alt="">';
			}	
			?>  
            </a></div>
            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
            <?php the_excerpt(); ?>
            <a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','dentistry'); ?></a> </div>
        </div>
        <!--/.tp-dark-box-->        
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