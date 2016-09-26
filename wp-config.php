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
define('DB_NAME', 'lcf');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'satelite');

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
define('AUTH_KEY',         'LF.2kDl3(j(BD1;p*lQMzt10[h>/Mf1f_5p3q{VK<]nBB1;@=bo^o!BXm1?LdEG.');
define('SECURE_AUTH_KEY',  ':g^VBQ%-v o}Ak/>qv4k6K[tM.do(,xTMoS|ELVWT,u{iG2zr~.S{[EO+I`BxZOF');
define('LOGGED_IN_KEY',    '[(OUPk9KJVt`9Ku?3:V._@7 Lu v:< y7r/=]k7%yw}._#L%ei!af_<~k!4&DcsJ');
define('NONCE_KEY',        'Kk9#/%Uo5;]1<4[UI78.i5C8pcjS}9mSvM%F&/:c[{Gh#&yJs3SWaNca^Q]Mi)~<');
define('AUTH_SALT',        'x`n~O6~{$]0Z55OdxR.H/)_d;e<2pk!Pae^kP.24bK}8p;epqPcs?FRMVP0x:u*0');
define('SECURE_AUTH_SALT', '_xB@MEIRF@n!*2Dzu({0Ot0Q6Ok(^m* Uxu952CnE9ZesQWcq-e8{2|; 6ooqU-U');
define('LOGGED_IN_SALT',   'o/]0Nuh<g&h~qgP}Ph$vq-:XZ`jhj)2#):p>xGj@QK@USm5d4UUsg>V>Ajg|%ZN/');
define('NONCE_SALT',       '.H*ee/>hV[59U$:w5/9$5GNYBLDx5p`UWf6k6A0j&P:TVNNo5KT2&ArPP-f5kR:;');

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
