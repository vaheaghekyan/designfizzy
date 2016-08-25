<?php
/**
 *  Template Name: Doctor Template
 *
 * @package dentistry
 */
get_header(); ?>
<div class="tp-main-container">
  <!--main-container-->
  <div class="tp-doctor-team">
    <!--tp-doctor-team-->
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
        $args = array( 'post_type' => 'doctor', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC' );
        $doctor = new WP_Query( $args );
        while ( $doctor->have_posts() ) : $doctor->the_post();
        
        $meta_doctor_designation = get_post_meta( $post->ID, 'doctor_designation', true );
        ?>
        <div class="col-md-4 team-box">
          <div class="effect-pic"><a href="<?php the_permalink(); ?>">
            <?php 
            if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
               the_post_thumbnail( 'full' ,array( 'class' => 'img-responsive' )  );
            }
            ?>  
          </a></div>
          <div class="tp-grey-box">
            <div class="team-caption"> 
              <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php 
            if($meta_doctor_designation)
            {
				echo '<div class="designation">'.esc_html($meta_doctor_designation).'</div>';				 
            }     
            ?>
            </div>
          </div>
        </div>
        <?php
            endwhile; 		
            wp_reset_postdata();		
        ?>      
        </div>
      	<!--/.team-box-->
  		</div>
	</div>
<!--/.tp-doctor-team-->
</div>
<?php get_footer(); ?>
