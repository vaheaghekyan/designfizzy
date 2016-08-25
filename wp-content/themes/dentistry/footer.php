<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dentistry
 */
echo dentistry_tg_get_option('footer_code');
?>
<div class="tp-footer"><!-- footer section -->
<div class="container">
<div class="row ft-links">
<?php if ( is_active_sidebar( 'sidebar-footer' ) ) { ?>
	<?php dynamic_sidebar( 'sidebar-footer' ); ?>
<?php } ?>
</div>
<?php echo dentistry_tg_get_option('sub_footer'); ?>
<!-- /.footer button -->
<div class="row tp-tiny-footer"><!-- tiny footer -->
    <div class="col-md-9">
        <?php echo dentistry_tg_get_option('copyright'); ; ?>
    </div>
    <div class="col-md-3 tp-social-icon"><!-- social icon -->
        <ul>
        <?php
          //Option url for facebook social icon
          if(dentistry_tg_get_option('social_facebook')!="")
          {
            echo '<li><a href="'.esc_url(dentistry_tg_get_option('social_facebook')).'"><i class="fa fa-facebook-square"></i></a></li>';
          }

          //Option url for twitter social icon
          if(dentistry_tg_get_option('social_twitter')!="")
          {
            echo '<li><a href="'.esc_url(dentistry_tg_get_option('social_twitter')).'"><i class="fa fa-twitter-square"></i></a></li>';
          }

           //Option url for google plus social icon
          if(dentistry_tg_get_option('social_google_plus')!="")
          {
            echo '<li><a href="'.esc_url(dentistry_tg_get_option('social_google_plus')).'"><i class="fa fa-google-plus-square"></i></a></li>';
          }

          //Option url for youtube social icon
          if(dentistry_tg_get_option('social_youtube')!="")
          {
            echo '<li><a href="'.esc_url(dentistry_tg_get_option('social_youtube')).'"><i class="fa fa-youtube-square"></i></a></li>';
          }

          //Option url for instagram social icon
          if(dentistry_tg_get_option('social_instagram')!="")
          {
            echo '<li><a href="'.esc_url(dentistry_tg_get_option('social_instagram')).'"><i class="fa fa-instagram"></i></a></li>';
          }
        ?>
        </ul>
    </div>
    <!-- /.social icon -->
</div>
<!-- /.tiny footer -->
</div>
</div>
<!-- /.footer section -->
<?php
if(dentistry_tg_get_option('main_layout')=="boxed"){
	echo '</div>';
}
?>
<!-- back to top icon -->
<a href="#0" class="cd-top" title="Go to top"><?php esc_html_e( 'Top', 'dentistry' ); ?></a>
<?php wp_footer(); ?>
</body>
</html>