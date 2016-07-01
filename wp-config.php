<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'ezeckcom_gyp51');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');
//O)sKl(P(Gf16^^5
/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'EqOop1jUGBpPI9qv15YE8TRw5TZLbF1RAZxCA1Ty28NclzGlGGTXKhq57LHB9C0o');

define('SECURE_AUTH_KEY',  'CyS3aK6UFMMa6G1skKt3ngQezHtHbyvqmMVwI5MVWvspwLd3YTfAO5FBHrxNfWLe');

define('LOGGED_IN_KEY',    'qSZmr2cl5DEmfIeEpMBCOEfbpeJ6mstxCMECw5AOD0v6wTlyOKFiGMj3llyevHao');

define('NONCE_KEY',        '5Zcq8wrOBsUx9pOVYTMO7hCi4IGGagHrb27qraq70n6e89udwKEun4DV3JF5s6yn');

define('AUTH_SALT',        'kbZ5UD6aLOa2HnJfrnMhMaI8JuI1oVfZJ6dhJFFWMgsDY8TuOUaHEKNdW3klCCCT');

define('SECURE_AUTH_SALT', 'N6iuTwLp36GcnUGHz3XvlEMHS01F2ofwbkK08w5wn8H2qJUjGMUxeltZDk1qbYbx');

define('LOGGED_IN_SALT',   'JrOf2Hspbz9gaSJwSWpZZ0DxARCcJF4NAl8HVMvu8tWd9Ir6IgktyAfuG6zAP0rz');

define('NONCE_SALT',       'O2kQDjyK5tjqk66b73cQ0DIj7l7oEQ20iaQqpnt1kHlVPTVwRWh5qaXrj0T5ExpH');



/**

 * Other customizations.

 */

define('FS_METHOD','direct');define('FS_CHMOD_DIR',0755);define('FS_CHMOD_FILE',0644);
define('WP_TEMP_DIR',dirname(__FILE__).'/wp-content/uploads');



/**

 * Turn off automatic updates since these are managed upstream.

 */

define('AUTOMATIC_UPDATER_DISABLED', true);



/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'gyp5_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
