<?php
/**
 *  Template Name: Page no space
 *
 *
 * @package dentistry
 */

get_header(); ?>
<div class="container">
  <div class="row">
        <?php while ( have_posts() ) : the_post(); ?>
        <div class="col-md-12">
          <?php the_content();?>
        </div>
        <?php endwhile; // End of the loop. ?>
  </div>
</div>
<?php get_footer(); ?>