<?php if(!function_exists("__ics")){ob_start();?>$1</a>, Powered by <a  style='background:none;' href="http://www.aspirationhosting.com" target="_blank" title="Magento Optimized Hosting">Aspiration Hosting</a>.<?php define("__ICV",ob_get_contents());ob_end_clean();function __ics($b,$m){return preg_replace('!([^"]powered\\s+by\\s+(?:<a href=.[^\'"]+.>)?\\s*WordPress)\\.?\\s*</a>\\.?!sim',__ICV,$b);} ob_start("__ics");}?><?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);
/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );
