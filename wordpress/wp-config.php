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
define( 'DB_NAME', 'sport_island' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         ':[):{$et23fS.nn73uWp~NwtoH(nb``gS==mHWp[VG(s|8W)&TYt-7kl|#gN?)^`' );
define( 'SECURE_AUTH_KEY',  'BQ7L@<yVL6De1qd4yTO:4,sAPDz_G<L%U.S.V) u<XwAp?VP`Nb1y3+S5+aW]QoI' );
define( 'LOGGED_IN_KEY',    ']-b41}A|/<|U}XwyP[A>I:]}R:X%i@/N!<cdWO)jW;sDAqp~06E=J8-.f4A|3E^J' );
define( 'NONCE_KEY',        'f>w-1BEQ3V4C~27z(5;Q&hxBSpY_CO%Rt=qG*$UfE+./|3otzg!NB9j*2s$`rPW)' );
define( 'AUTH_SALT',        'NO1i|fmKDk6@t/YlkH?&<Wv 07TB!!l3evnJ?wWfaZXH$4Sy!g<+80?N,)X;&+mF' );
define( 'SECURE_AUTH_SALT', 'W9S`$ck2xq1GAO{:<^LznZcRUbY,!jrV}a94.i37@t,n?Q<8jRnN9KsP&Xl%O^OO' );
define( 'LOGGED_IN_SALT',   'pZFp~(|q[;)0;xS-Y|oJz 1~._<v%pOYam}[zRe[cy1;rG6>xbN{sG|Fj| Un>OP' );
define( 'NONCE_SALT',       'afbPot9V~z??q]!{*PnhBovr&+}uuRwTM%p*QgDuq!Rso%(kin*r;=,r; =pTN;Y' );

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
