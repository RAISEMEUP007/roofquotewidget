<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wp_roof' );

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
define( 'AUTH_KEY',         'o>Z~+voo&I`0|)d-Yw&.?]rsD&)oZcjjABo|XTA>UjqpiZ:h>BIpd7VNCGkn.U7*' );
define( 'SECURE_AUTH_KEY',  's}27u;?7(}]jc`c&5HF]:tOrDVFp)]|^xBjI1Fc*j?z^; THOad)3R^G!Lu}zK(f' );
define( 'LOGGED_IN_KEY',    ':J~V$lw>,SzI_Y+:DNU/XPd{.af]2k?%i%|{!dYR[P:-91`ISJPyd=(mdy>VI-U3' );
define( 'NONCE_KEY',        'kt{L=/WaP7BcUaK(TXw-kh0|7na&,i#aw+T|4`+C%L8rv]!E4t~=KG;M_-s<^ldw' );
define( 'AUTH_SALT',        'b9gz,VgYR`2TIkdcKy< `#H!;8IXN/lrvp/?n1Ng`@: ~p:]>8g3rG*>)z)!-:^~' );
define( 'SECURE_AUTH_SALT', 'DYk(s!lRWP G;[[dHh3IUG=1SK+8Y4[?IWf)s}40r$UOzp=QWIM&/x^JsAWE0/4-' );
define( 'LOGGED_IN_SALT',   'c.=?7A+6r#3AErIcsZSve0HA_Oq{+un}4<}R{4j9-{r<{)298BO$-Gxr)_2,3R0f' );
define( 'NONCE_SALT',       '1(e%`EXJI?S>y+~p&/$=v%/g7*-N#h?-8(B[@rnbskxH`Jv`><[?|{fQNMC0mn&n' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
