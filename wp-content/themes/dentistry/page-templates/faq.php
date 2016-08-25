<?php
/**
 *  Template Name: FAQ
 *
 * @package dentistry
 */

get_header(); ?>
<div class="tp-main-container"><!--main-container-->
  <div class="container">
	<?php while ( have_posts() ) : the_post(); ?>
    <div class="row">
        <div class="col-md-12 mb20">
            <?php the_content(); ?>
        </div>
    </div>
    <?php endwhile; // End of the loop. ?>  
    <div class="row">
        <div class="col-md-3"><!-- Nav tabs -->
        <?php 
        // Set your args
        $args = array(
            'hide_empty' => 1   // Show terms that are not associated with any posts
        );
        
        // Get the terms
        $faq_list = get_terms('faq_categories', $args);
        ?>      
        <ul class="nav nav-tabs tabs-left">
        <?php 
        $i=1;
        $tab_html='';
        foreach($faq_list as $faq)
        {
            if($i==1)
            {
                $class='class="active"';
            }
            else
            {
                $class='';			
            }
            $tab_html.='<li '.$class.'><a href="#'.esc_attr(str_replace(" ","-",strtolower($faq->name))).'" data-toggle="tab">'.esc_html($faq->name).'</a></li>';
            
            $i++;
        }
		echo $tab_html;
        ?>
        </ul>
    </div>
        <div class="col-md-9">
            <div class="tab-content">
            <?php 
            $j=1;
            $faq_result_html='';
            foreach($faq_list as $faq)
            {
                if($j==1)
                {
                    $class='active in';
                }
                else
                {
                    $class='';			
                }			
                $faq_result_html.='<div class="tab-pane '.$class.' fade" id="'.esc_attr(str_replace(" ","-",strtolower($faq->name))).'">';
            
                $args = array(
                    'post_type' => 'faq',
                    'posts_per_page' => -1,
                    'tax_query' => array(
                    array(
                            'taxonomy' => 'faq_categories',
                            'field'    => 'term_id',
                            'terms'    => array( $faq->term_id)
                        ),
                    ),
                );				
                $faq_query = new WP_Query($args);
                
                while ( $faq_query->have_posts() ) : $faq_query->the_post();
                
                $faq_result_html .= '<h3>'.esc_html(get_the_title($faq_query->ID)).' ?</h3>';
                $faq_answer = get_post_meta( $post->ID, 'answer_description', true );
                if(isset($faq_answer) && !empty($faq_answer))
                {
                    $faq_result_html.='<p>'.$faq_answer.'</p>';
                }			
                endwhile;
                $faq_result_html.='</div>';
                $j++;
            }
            echo $faq_result_html;
            ?>
       </div>
     </div>
   </div>
 </div>
</div>
<?php get_footer(); ?>