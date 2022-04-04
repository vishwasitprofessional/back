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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'suomijazz' );

/** MySQL database username */
define( 'DB_USER', 'suomijazz' );

/** MySQL database password */
define( 'DB_PASSWORD', '?W.!T7DFqG?{vjPC' );

/** MySQL hostname */
define( 'DB_HOST', 'mysql17.nebula.fi:3306' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '3rwoA0#n|DV*:}gp!X}f0WE2u|_8.]DyaZ)OvG4BH3=P-[u6vu.nYt }Z{o/j66~' );
define( 'SECURE_AUTH_KEY',  '5^tF:aK{dg+lj2H``no%N3lf51/W4#&aNjdi0>8fo5:@6GY1lF)(GC&I2%v.9!:O' );
define( 'LOGGED_IN_KEY',    '86P/:$RaleV$}W?2V9@wq/pQ75j}<R]w5a&p{_oi`(s&F&^a/=T[yNw%!bxiB1zj' );
define( 'NONCE_KEY',        '@r;+iA;[,4(]/%A)?|$LJxuf2V{s[Nf[ybP@Ww%f}hLG j&C4}J=u7$uFz9jW_&y' );
define( 'AUTH_SALT',        'G3_S#<DJLjLEsh6tb<k*L ^|N% t}Ghn)_V=BUN; 0 2?uK<aV;*FNv%5+tM4k6>' );
define( 'SECURE_AUTH_SALT', '&lu)vt,Fo*r/X_!hd;5Gu%Zq9Z,-/c{39EL(nQ_+0Q}lSb+~LL1:U+n9Dn9,KsG_' );
define( 'LOGGED_IN_SALT',   '{z-d3(/mlBerl+ !0KtoKeAn9R?hyQ5-x!m1P]DagNmze7Ucp.j%m>Y7 Hc|>#}P' );
define( 'NONCE_SALT',       'KQX<c{j_@?Bgz-`tLO*4YpX07YyG)-9h7sgE[/vFf{W+*QtIm%mwKuUe-BEAOC3(' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_anjlvxbl_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
