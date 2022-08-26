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
define( 'DB_NAME', 'al-hikmah' );

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
define( 'AUTH_KEY',         '-/H^`pd,Bb[/qV^$BFd|MSn&do2d VW+~@xL;;oU{UnTc(c ZrBUfb<5$5hoo`|a' );
define( 'SECURE_AUTH_KEY',  'rN!_?xc-=a5%*N`PWuAyf=)N#/M,_*=w14slXnT>ka]6R4. 5=~(UYlciZ7xzj].' );
define( 'LOGGED_IN_KEY',    'R!nEPGf{p2XL28vLu?C)^{#p#NnW]wReY=_u x4zH/R)_O)anpczw`^UY%*|G#KO' );
define( 'NONCE_KEY',        'E]QcXaO[JNCRkAe1}cVKYAAGB}O abRqff5vWv`rpCjcQvnOwOTFsKTP8QUjjAk|' );
define( 'AUTH_SALT',        '#_YVf_#=y;~bOT&)mO-dp$HXvdEzo)z1d@q[n35B$YxFviDoP_TAU8Xv2.FM~a*M' );
define( 'SECURE_AUTH_SALT', '$TZbFVW{;OfdOO ?a7=N^WY~D)J58MCtWVbp%.;C,4hI4Q~w<gv1F4w}&`NuK+T!' );
define( 'LOGGED_IN_SALT',   'yQhFpFVGPdS/[ LP{+w#&Raul70,$r25/8>3Tg_(frV+qPNoE@i@BqQy9JWYMnO>' );
define( 'NONCE_SALT',       'il]cA3qoI>p]]U68HJmSb0{8BD&dDt)^y@KW*E:(`%T(0|N)0MT{Uy((H@kd}1F=' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
// $table_prefix = 'wp_';
$table_prefix = 'wphb_';

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
