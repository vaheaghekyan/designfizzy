<?php
/**
 *  Template Name: Pricing List
 *
 * @package dentistry
 */

get_header(); ?>
<div class="tp-main-container"> <!--tp-main-container-->
	<div class="container">
		<?php while ( have_posts() ) : the_post(); ?>
        <div class="row">
	        <div class="col-md-12 mbtm-2">
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

        //get the saved meta as an array of pricing
		$pricing = get_post_meta($post->ID,'pricing',true); 

		$service_price_description = get_post_meta($post->ID,'service_price_description',true); 
		$service_price_extra_note = get_post_meta($post->ID,'service_price_extra_note',true); 					
        ?>
        <div class="col-md-6">
            <div class="pricing-block mbtm-3"><!-- pricing block -->
              <ul class="list-group">
                <li class="list-group-item price-list">
                  <h2 class="price-title"><?php the_title(); ?></h2>
                  <p><?php echo $service_price_description;?></p>
                  <?php 
					if(dentistry_tg_get_option('general_check_appnt_btn')!="")
					{
						echo '<a href="'.esc_url(dentistry_tg_get_option('general_appnt_btn_url')).'" class="btn-outline btn-outline-default">'.dentistry_tg_get_option('general_appnt_btn_text').'</a>';
					}				  
				  ?>                  
                  </li>                  
                 <?php 
                  $c = 1;
				  $odd_event_class='odd-bg';
				  if ( count( $pricing ) > 1) {
                        foreach( $pricing as $consult_pricing ) {
                            if ( isset( $consult_pricing['consult'] ) || isset( $consult_pricing['cost'] ) ) {
								echo '<li class="list-group-item '.$odd_event_class.'"><span class="price-badge">'.dentistry_tg_get_option('currency_symbols').$consult_pricing['cost'].'
								</span>'.$consult_pricing['consult'].'<div><strong class="minits">'.$consult_pricing['time'].'</strong></div> </li>';
                            	
								$odd_event_class = ( ($c%2)==0 )?'odd-bg':'even-bg';
								$c++;
							}
                        }
                    	if($service_price_extra_note)
						{
							echo '<li class="list-group-item '.$odd_event_class.'"><small>'.$service_price_extra_note.'</small></li>';	
						}
					} 
				 ?> 
              </ul>
            </div>
            <!-- /.pricing block -->         
        </div>
        <?php
			if(($i%2)==0 && $i<$total_element)
			{
				echo '</div><div class="row">';
			}				
			$i++;
			endwhile; 		
			wp_reset_postdata();		
		?>    
      </div>
    </div>
</div><!--/.tp-main-container-->
<?php get_footer(); ?>