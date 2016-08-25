<?php
/**
 *  Template Name: Gallery Template
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
        <div class="col-md-12">
		<?php
			$filter_gallery_html='';
			$gallery_result_html='';
			$args = array( 'post_type' => 'gallery', 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC' );
			$gallery = new WP_Query( $args );
			$total_element=count($gallery->posts);
			if($total_element!=0)
			{
				$filter_gallery_html .= '<a href="#" data-filter="*" class="current">'.esc_html__( 'All', 'dentistry').'</a>';	
				while ( $gallery->have_posts() ) : $gallery->the_post();				
				
				$filter_gallery_html .= '<a href="#" data-filter=".'.esc_attr(str_replace(" ","-",strtolower(get_the_title($post->ID)))).'" class="">'.esc_html(get_the_title($post->ID)).'</a>';
				
				$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );
				if ( isset( $gallery_data['image_title'] ) ) 
				{
					for( $i = 0; $i < count( $gallery_data['image_title'] ); $i++ ) 
					{
						$gallery_result_html.='<div class="'.esc_attr(str_replace(" ","-",strtolower(get_the_title($post->ID)))).' col-md-6">
								  <div class="bf-pics row">
									<div class="ba-box">
									<div class="before-pic col-md-6">
									<a href="'.esc_url($gallery_data['image_url_before'][$i]).'" title="'.esc_html__( 'Before', 'dentistry').' '.esc_html($gallery_data['image_title'][$i]).'"><img src="'.esc_url($gallery_data['image_url_before'][$i]).'" alt="" class="img-responsive">
									</a>
									  <div class="bf-caption">
										'.esc_html__( 'Before', 'dentistry').'
									  </div>
									</div>
									<div class="after-pic col-md-6">
									<a href="'.esc_url($gallery_data['image_url_after'][$i]).'" title="'.esc_html__( 'After', 'dentistry').' '.esc_html($gallery_data['image_title'][$i]).'">
									<img src="'.esc_url($gallery_data['image_url_after'][$i]).'" alt="" class="img-responsive"></a>
									  <div class="af-caption">
										'.esc_html__( 'After', 'dentistry').'
									  </div>
									</div>
									</div>							  
								  <div class="col-md-12"><h3>'.esc_html($gallery_data['image_title'][$i]).'</h3></div>
								</div>
							</div>';
					}
				}				
				endwhile; 		
				wp_reset_postdata();
			}
			?>   
          <div class="portfolioFilter"><?php echo $filter_gallery_html;?></div>
        </div>
      </div>
      <div class="popup-gallery">
          <div class="row portfolioContainer">
            <?php echo $gallery_result_html; ?>
          </div>
      </div>
    </div> <!--/gallery-->
  </div>
</div>
<?php get_footer(); ?>