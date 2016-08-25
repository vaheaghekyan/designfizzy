<?php
/**
 *  Template Name: Tab Gallery
 *
 * @package dentistry
 */
get_header(); ?>
<div class="tp-main-container">
  <div class="before-after-gallery"> 
    <!--gallery-->
    <div class="container">
      	<?php while ( have_posts() ) : the_post(); ?>
            <div class="row">
                <div class="col-md-12">
                    <?php the_content(); ?>
                </div>
            </div>
        <?php endwhile; // End of the loop. ?>
      <div class="row">
        <div class="col-md-3">
		<?php
			$tab_gallery_html='';
			$gallery_result_html='';
			$args = array( 'post_type' => 'gallery', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC' );
			$gallery = new WP_Query( $args );

			$k=1;
			if($gallery->have_posts())			
			{
				
			$tab_gallery_html .= '<ul class="nav nav-tabs tabs-left">';	
			while ( $gallery->have_posts() ) : $gallery->the_post();

			if($k==1)
			{
				$active_class="active";	
			}
			else
			{
				$active_class="";
			}			
			
			$tab_gallery_html .= '<li class="'.$active_class.'"><a href="#'.esc_attr(str_replace(" ","-",strtolower(get_the_title($post->ID)))).'" data-toggle="tab">'.esc_html(get_the_title($post->ID)).'</a></li>';

			$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
			if ( isset( $gallery_data['image_title'] ) ) 
			{				
				$gallery_result_html.= '<div class="tab-pane '.$active_class.'  fade in" id="'.esc_attr(str_replace(" ","-",strtolower(get_the_title($post->ID)))).'"> <div class="bf-gallery-desc"> <h2>'.esc_html(get_the_title($post->ID)).'</h2> '.apply_filters('the_content',get_the_content($post->ID)).'</div> <div class="before-after-gallery"> <div class="owl-carousel tab-treatment owl-theme">';
				
				for( $i = 0; $i < count( $gallery_data['image_title'] ); $i++ ) 
				{
					$gallery_result_html.= '<div class="item">
									<div class="'.esc_attr(str_replace(" ","-",strtolower(get_the_title($post->ID)))).'">
										  <div class="bf-pics row">
											<div class="ba-box">
											<div class="before-pic col-md-6">
												<img src="'.esc_url($gallery_data['image_url_before'][$i]).'" alt="" class="img-responsive">
											 <div class="bf-caption">
												'.esc_html__( 'Before', 'dentistry').'
											  </div>
											</div>
											<div class="after-pic col-md-6">
											<img src="'.esc_url($gallery_data['image_url_after'][$i]).'" alt="" class="img-responsive">
											  <div class="af-caption">
												'.esc_html__( 'After', 'dentistry').'
											  </div>
											</div>
											</div>										  
										  <div class="col-md-12 ba-title"><h2>'.esc_html($gallery_data['image_title'][$i]).'</h2></div>
										</div>
									</div>
								</div>';	
				}
				$gallery_result_html.='</div></div></div>';
			}
			$k++;
			endwhile; 		
			$tab_gallery_html .= '</ul>';	
			wp_reset_postdata();
		}
		
		echo $tab_gallery_html; 
		?>   

        </div>
        <div class="col-md-offset-1 col-md-8">
            <div class="tab-content">
				<?php echo $gallery_result_html; ?>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>