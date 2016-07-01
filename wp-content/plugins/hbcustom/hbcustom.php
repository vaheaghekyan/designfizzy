<?php
/*
Plugin Name: HireBee Customized
Text Domain: hbcustom
Description: With this plugin you can customize hirebee theme.
Author: Champ Camba
Author URI: http://www.champ.ninja
Version: 1.1
*/

	// HBCustom Plugin Options
	if (!defined('HBCUSTOM_LIMIT_SEND_EMAILS')) // Maximum number of sendings at once
		define('HBCUSTOM_LIMIT_SEND_EMAILS', 50);

	// HBCustom Plugin Path
	if (!defined('HBCUSTOM_PLUGIN_NAME')) // hbcustom
		define('HBCUSTOM_PLUGIN_NAME', strtolower(trim(dirname(plugin_basename(__FILE__)), '/')));

	if (!defined('HBCUSTOM_PLUGIN_DIR')) // httdocs/domain/wp-content/plugins/hbcustom/
		define('HBCUSTOM_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . HBCUSTOM_PLUGIN_NAME . '/');

	if (!defined('HBCUSTOM_PLUGIN_DIR_VIEW')) // httdocs/domain/wp-content/plugins/hbcustom/
		define('HBCUSTOM_PLUGIN_DIR_VIEW', WP_PLUGIN_DIR . '/' . HBCUSTOM_PLUGIN_NAME . '/view/');

	if (!defined('HRBEE_THEME_DIR')) 
		define('HRBEE_THEME_DIR', ABSPATH . 'wp-content/themes/' . get_template());


	// include functions
	include_once(HBCUSTOM_PLUGIN_DIR ."functions.php");

	// include cron jobs
	include_once(HBCUSTOM_PLUGIN_DIR ."cron.php");

	// include class watermark
	include_once(HBCUSTOM_PLUGIN_DIR."watermark.class.php");

	// Database definitions
	if(!defined("HRBEE_TABLE_P2P"))
		define("HRBEE_TABLE_P2P", "{$wpdb->prefix}p2p");
	if(!defined("HRBEE_TABLE_P2PMETA"))
			define("HRBEE_TABLE_P2PMETA", "{$wpdb->prefix}p2pmeta");

	// Activate Plugin
	//register_activation_hook(__FILE__,hb_custom_activation());

		
