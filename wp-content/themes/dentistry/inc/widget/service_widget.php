<?php
add_action( 'widgets_init', 'dentistry_service_widget' );
function dentistry_service_widget() {
	register_widget( 'Dentistry_service_widget' );
}


class Dentistry_service_widget extends WP_Widget {
	function __construct() {
		// Instantiate the parent object
		parent::__construct( false, 'Service Detail' );
	}
	function widget( $args, $instance ) {
	// Widget output
	extract($args);
	$icon_url = ($instance['icon_url']) ? $instance['icon_url'] : esc_html__('', 'dentistry');
	$title = ($instance['title']) ? $instance['title'] : esc_html__('Title', 'dentistry');
	$description = $instance['description'] ? $instance['description'] : esc_html__('Description', 'dentistry');
	echo $before_widget;
	if(isset($icon_url) && !empty($icon_url))
	{
		echo '<div class="left-icon"><img class="img-responsive" alt="" src="'.esc_url($icon_url).'"></div>';
	}
	?>
    <h3><?php echo esc_html($title); ?></h3>
    <p><?php echo $description; ?></p>
	<?php echo $after_widget; 
	}
	function update( $new_instance, $old_instance ) {
		// Save widget options
		$instance = $old_instance;
		$instance['icon_url'] = $new_instance['icon_url'];
		$instance['title'] = $new_instance['title'];
		$instance['description'] = $new_instance['description'];
		return $instance;
	}
	function form( $instance ) {		
		// Output admin widget options form
      if(!isset($instance['icon_url'])) $instance['icon_url'] = esc_html__('', 'dentistry');
      if(!isset($instance['title'])) $instance['title'] = esc_html__('Title Here', 'dentistry');
      if(!isset($instance['description'])) $instance['description'] = esc_html__('Description', 'dentistry');
  ?>
      <p>
     	<label for="<?php echo $this->get_field_id('icon_url'); ?>"><?php esc_html_e('Icon URL', 'dentistry') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['icon_url']); ?>" name="<?php echo $this->get_field_name('icon_url'); ?>" 
        id="<?php echo $this->get_field_id('icon_url'); ?>" class="widefat" />
      </p>
      <p>
     	<label for="<?php echo $this->get_field_id('title'); ?>"><?php esc_html_e('Title', 'dentistry') ?></label>
        <input  type="text" value="<?php echo esc_attr($instance['title']); ?>" name="<?php echo $this->get_field_name('title'); ?>" 
        id="<?php echo $this->get_field_id('title'); ?>" class="widefat" />
      </p>
     <p>
        <label for="<?php echo $this->get_field_id('description'); ?>">Description</label>
		<textarea name="<?php echo $this->get_field_name('description'); ?>" class="widefat" ><?php echo $instance['description']; ?></textarea>
      </p>      
      <?php
	}
}
?>