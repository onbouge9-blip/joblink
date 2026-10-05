<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'joblink-biemmoise' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '(zX%b_((P f|wOx,,Y&TR*b;zg~JuA|Mw-A9M{]1Wo Y|RoU 1i*`]ouu%Uq>oh:' );
define( 'SECURE_AUTH_KEY',  '-eH]&ha3z+ESis}=}FED?t(Jr}vTA^D{3yF?%,R)NV)[r EL@@smQrH@!yH5q^gY' );
define( 'LOGGED_IN_KEY',    'iH=g5=-,LkCT}%vR&<[*$-/!UIj8tEqGC)am=K48b]#8Bq[+./ OIuxmIv)z uiX' );
define( 'NONCE_KEY',        '-@|`FH,WhxFpd]1,$V`FE5Owrj$iu]KZGhr(lxdPa.])K<<6UNowrL6,Hwm 7[jn' );
define( 'AUTH_SALT',        ',U2?0n<R1;rqbYKVxS-l.v5G`#(YB-T}6n->aGWj:3L`drHj~BruAG)Vu&8K!s5|' );
define( 'SECURE_AUTH_SALT', '!:U0~7NRnjYzS*+IJYrq7v:=S/A;Z9<op6samS6u~<d|Myu hV>!3U+j`[-(^Bx|' );
define( 'LOGGED_IN_SALT',   'nPWkVf]v1gde,nh5U(SAb6N0QkJRzYKqyfmv5NqE%Tce~V2B,Q?i~A4~]4bb=M#k' );
define( 'NONCE_SALT',       'rk^xsE7MV{YIq{Cdk6vK.xiqpCs:h*h&!MdX#,^|1+a0#4A]`_ cUbVj;NTso5C?' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'wp_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
