<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'testing');

/** MySQL database username */
define('DB_USER', 'bancroft');

/** MySQL database password */
define('DB_PASSWORD', '7NCJeQAJs0dt');

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
define('AUTH_KEY', 'zKKSfWUkTVG3tKGafaXQJEq5srVyDuWvT7vyRA3jw6w2hEGgTIrdOeBszrLzNVNu');
define('SECURE_AUTH_KEY', 'qgUwMMzZ7jG1VkujRCycyjrI1HCyEO2dqOb0ETF719luXs18Ci3A5JvcrOe8ASUM');
define('LOGGED_IN_KEY', 'vrTNIO1wO8Qad5RT8zEM4VCbD3vipUSwQbnpcRFB1dHk95t9Qo9dfNEReQWpJFd3');
define('NONCE_KEY', 'BEkt5gSu5Ue4PmM832zY33dU5EJL1yexfkGR2933RNPfc9wKAIUA1whw0JoMkApf');
define('AUTH_SALT', '6MnjuUVCguYpAj4DG2LhKYL6lMWd0jGmf0evQwYzavlZkqOWTDnF4Qy6T1yGDHnh');
define('SECURE_AUTH_SALT', '4TLTb7Hd7JaZ9vkN5xsKBeEVbvsjTPnTLG1PJ2r0DTzfKF0fZmIPrgt6VCSZi6w7');
define('LOGGED_IN_SALT', '1lDJmtflrn9KKlgf3GLj0OuC244pruO90qm60KVk366ET9ZXmm5JfR72DcAY9rg8');
define('NONCE_SALT', 'Cx5WX5cr3soOxDRA4FSspqrWs6uAUsYjNmRIYQ01O8OpOIygcsh6WzFiXxWExjrk');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
