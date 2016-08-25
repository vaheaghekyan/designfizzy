<?php
add_action( 'widgets_init', 'dentistry_footer_custom_post' );
function dentistry_footer_custom_post() {
	register_widget( 'Dentistry_Footer_Custom_Post' );
}
class Dentistry_Footer_Custom_Post extends WP_Widget {
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Custom Post Display' );
	}
	function widget( $args, $instance ) {
		// Widget output
    	extract($args);
        $title = ($instance['title']) ? $instance['title'] : esc_html__('Custom Post', 'dentistry');
        $custom_post = ($instance['custom_post']) ? $instance['custom_post'] : esc_html__('Select', 'dentistry');
		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;
	  ?>
	<div class="custom-post-widget">
	<?php
    $args = array( 'post_type' => $custom_post, 'posts_per_page' => -1,'orderby' => 'menu_order ID','order'   => 'ASC' );
    $doctor = new WP_Query( $args );
    
	if(count($doctor->posts)!=0)
	{
		echo '<ul>';
		while ( $doctor->have_posts() ) : $doctor->the_post();
		?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
		<?php
		endwhile; 		
		wp_reset_postdata();		
	
		echo '</ul>';
	}
		echo $after_widget;
     ?>
    </div>
	  <?php

	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['title'] = $new_instance['title'];
		$instance['custom_post'] = $new_instance['custom_post'];
		return $instance;
	}
	function form( $instance ) {		
		// Output admin widget options form
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Custom Post', 'dentistry');
      if(!isset($instance['custom_post'])) $instance['custom_post'] = 'service';  
	  
	  $select=$instance['custom_post'];
	  ?>
      <p>
     	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'dentistry') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
        id="<?php echo $this->get_field_id('title'); ?>" class="widefat" />
      </p>
        <p>
        <label for="<?php echo $this->get_field_id('custom_post'); ?>"><?php esc_html_e('Select', 'dentistry'); ?></label>
        <select name="<?php echo $this->get_field_name('custom_post'); ?>" id="<?php echo $this->get_field_id('custom_post'); ?>" class="widefat">
        <?php
        $options = array('service', 'doctor');
        foreach ($options as $option) {
        echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
        }
        ?>
        </select>
        </p>      
      <?php
	}
}
?>