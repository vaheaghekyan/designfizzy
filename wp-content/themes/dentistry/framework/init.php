<?php

/*****************************
*
*	THEME OPTIONS
*
*****************************/
/**
 * Theme-options.
 */
require get_template_directory() . '/framework/includes/theme-options.php';


/**
 * Theme-option Admin-ini.
 */
require get_template_directory() . '/framework/includes/admin-init.php';


/**
 * Theme-option Interface.
 */

require get_template_directory() . '/framework/includes/interface.php';

/**
 * Theme-option Save Data.
 */

require get_template_directory() . '/framework/includes/sanitization.php';

/**
 * Theme-option Save Data.
 */
require get_template_directory() . '/framework/meta-box/metabox-init.php';

?>