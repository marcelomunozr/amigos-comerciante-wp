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
define('DB_NAME', 'amigos_comerciante');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '>V+,837i:,ijUUn~$+ya;rTuFVj_=mW)B2M5Po5,/AYl 18X 0*.@Xl`Fl+/ h+x');
define('SECURE_AUTH_KEY',  'n}X&:hyaUR@KVu:.{!0P/vD>#<aW!QS+R(}-6E+a{X!zG?*q1eq*3f/7k.aAT(_{');
define('LOGGED_IN_KEY',    '@d(<bQU1*shG%U*3z!9`1vn|{WHb|a`PB]-N*,XHjr/&s{}-.2v]QZ*iS~MnmV{&');
define('NONCE_KEY',        '[OP+Tx<A+6l|4f57uP3MXGdGaO=J&c0x{+Ck8?:E1xw?g`EIk#5oz]nr,{G|uiI9');
define('AUTH_SALT',        '||TZrQRQ? ogiIEc?%|}T?fA_g<NZFKWUYfIa-U{QlHn6g|h~+qpVKqK;%}2aAso');
define('SECURE_AUTH_SALT', 'LTV=GGzwUhw_Kq`lN)eWNUJ_Mb^_NDX[7tYQI}n{.P`(brd?P_]sODNL#$2[mZ3l');
define('LOGGED_IN_SALT',   '#s-+2iSE$2l6|E@=w]2fu#Cl(s0%>s_&;x9LG59mby> ;tp&VI@#Vrm&#}2$`:D5');
define('NONCE_SALT',       'G&:kgadnjXQ1GLW5|9>*3Bpk-ETy<9Iqp oNX/i5x~Q}+}WK9I+t7E~CK./=+i f');

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
