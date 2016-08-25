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
  <div class="tp-doctor-detail"> 
    <!--tp-doctor-detail-->
    <div class="container">
      <div class="row">
      <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-4">
          <div class="tp-dr-dtl"><!--dr-dtl-->
            <div class="tp-grey-box">
            <div class="effect-pic">
            <?php
			if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
				the_post_thumbnail( 'full',array( 'class' => 'img-responsive' ) );
			}
			?>
            </div>
			<?php 
            $meta_doctor_designation = get_post_meta( $post->ID, 'doctor_designation', true );
            $meta_doctor_phone = get_post_meta( $post->ID, 'doctor_phone', true );
            
            //Social Metadata
            $social_doctor_fb = get_post_meta( $post->ID, 'doctor_fb', true );
            $social_doctor_linkedin = get_post_meta( $post->ID, 'doctor_linkedin', true );
            $social_doctor_googleplus = get_post_meta( $post->ID, 'doctor_googleplus', true );
            $social_doctor_tw = get_post_meta( $post->ID, 'doctor_tw', true );            
            ?>
              <div class="caption">
                <h3><?php the_title(); ?></h3>
				<?php 
				if($meta_doctor_designation)
				{
					echo '<p class="designation">'.esc_html($meta_doctor_designation).'</p>';
				}	
				if($meta_doctor_phone)
				{
					echo '<p class="call">Call : '.esc_html($meta_doctor_phone).'</p>';
				}	
                ?>
                <div class="dr-social-icon">
				<?php 
				if($social_doctor_fb)
				{
					echo '<a href="'.esc_url($social_doctor_fb).'"><i class="fa fa-facebook-square"></i></a>';
				}	
				if($social_doctor_linkedin)
				{
					echo '<a href="'.esc_url($social_doctor_linkedin).'"><i class="fa fa-linkedin-square"></i></a>';
				}	
				if($social_doctor_googleplus)
				{
					echo '<a href="'.esc_url($social_doctor_googleplus).'"><i class="fa fa-google-plus-square"></i></a>';
				}	
				if($social_doctor_tw)
				{
					echo '<a href="'.esc_url($social_doctor_tw).'"><i class="fa fa-twitter-square"></i></a>';
				}
				?>
                </div>
              </div>
            </div>
          </div>
          <!--/.dr-dtl--> 
        </div>
        <div class="col-md-8">
        	<?php the_content(); ?>
        </div>
      <?php endwhile; // End of the loop. ?>
      </div>
    </div>
  </div>
  <!--/.tp-doctor-detail--> 
</div>
<?php get_footer(); ?>
