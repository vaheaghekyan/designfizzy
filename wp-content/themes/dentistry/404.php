<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package dentistry
 */

get_header(); ?>
<div class="error">
  <div class="container">
    <div class="row">
      <div class="col-md-12 error-block">
        <h1><?php esc_html_e( '404', 'dentistry' ); ?></h1>
        <h2><?php esc_html_e( 'ooopss, page not found !', 'dentistry' ); ?></h2>
        <p><?php esc_html_e( 'The page you were looking for could not be found.', 'dentistry' ); ?></p>
        <a class="btn tp-btn-default" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'go to homepage', 'dentistry' ); ?></a> </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>