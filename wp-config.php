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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress_demo' );

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
define( 'AUTH_KEY',         'Xj?q^>v%I,RSqMB$k}W~*7s31{2z)A,qN5yWWlKgOX .{i|!8ZpzU,k09YikqLa_' );
define( 'SECURE_AUTH_KEY',  'FLohoJ5;[l)?AcMVkL4l$t$&~<_VBp;rSMpf06~_JT]Ww@!RCrtrY&Yz.0ZtaTO>' );
define( 'LOGGED_IN_KEY',    'a]dlgs{/|OORC<9l1/N;2LF2L6gk(^1d) V/0-t[>he.3Q3[7RU[7 ^om`@}Xh,c' );
define( 'NONCE_KEY',        '/SPr E ,sIv0Vq|cQ;HPxe5U$5,1?K~XODo|}jC^hy<I=eTwN~VXX:sAgJKeiZ]?' );
define( 'AUTH_SALT',        'uH!BC^nZBCCxNJ|,t<&v6rX>K H*gWu[stoo7q+H<qpk9[Jl&|nVW#X]53=(0!M2' );
define( 'SECURE_AUTH_SALT', '?sEWV8B.nL5>lb={hRn{@ qVz$V{!+X:&A*^*dRp-h4`s=;I+0Vg(5[%yekJHwX>' );
define( 'LOGGED_IN_SALT',   ',z_fKij6b{3FR?c$I0N!Pj9t.E!86<jf6ap$(@Rn4G/B_yO@Fs1bB6U,<.<X0Q,4' );
define( 'NONCE_SALT',       'H <CdkxS~vfgz5>kz(JA_X+`3Gyq<etQ$IyBN-m!3eeCTTxpDKOO37bm*~OI&eBw' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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
