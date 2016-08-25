<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'bhd');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'uTt@XEeL4]82z<@Jg[@IetZpT@crdm<c^/@BnXs;+8[9mkz*.NSsq7~DXr9tlM2l');
define('SECURE_AUTH_KEY',  '@8Q8nTN`j,5bs6|B(.OW9 .A,*FP`@.<P5BP$C<]sso)IE V{6??&)Eoh+1-0v<M');
define('LOGGED_IN_KEY',    'K<Sb9Jrl>k_`UF7pv*7z<hZ[<R]%T|0Ht2_CN}O]q-p=lib`cx5o06aC#}T45NC&');
define('NONCE_KEY',        'qmalG5b(}?!cPgD/Hd;G#VIP0qn!T+Q+iecDQ6t2PAylPsomJj8BvNat@3Xd!`5$');
define('AUTH_SALT',        'wdmY?|dlhzT2dSX*R};mPL$iKr |%GTPe&^3pi^0:yl@I*,<Q#~ki6[AslVi4or?');
define('SECURE_AUTH_SALT', 'F|H<umq)X52piwC$FNnZ+BnQ)C~Z[KUz<]Z1Boorb7[@ONU$@-?{(ee47kJv*4<Z');
define('LOGGED_IN_SALT',   '3Kh!q)g7wFPLPt[=[:~@fGEb%@z~yhx]FhZ0M:{t~7C|G>_xqr9Q0:3i]p!CxvPz');
define('NONCE_SALT',       '7<Ml/tfqJw0gwhPSew[B.kdQkfoSKd%.@?vB_~{.H}^yo{=MzPOT@6L_!PY><Y!`');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
