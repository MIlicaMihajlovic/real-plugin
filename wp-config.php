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
define( 'DB_NAME', 'real_wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define('AUTH_KEY',         '*WhCcmtHYZ)VvP.B5pY4i}oWxCCd<g/N(}Yj~UGGQasp$BpD>0yR%B{o/-!8p8P8');
define('SECURE_AUTH_KEY',  'wwq&B:KHF-e-;{!00|OWaQfpm`|%yK#jS8GUt@us GgYdo-iaH@+=}6u4~8|.n/x');
define('LOGGED_IN_KEY',    'v+7h S++`z2XQ%-$Pqwf`#pr1 NhF}}B>iJ4rT+D_30;<rd:^+|[Gz3G<0f:Q@8.');
define('NONCE_KEY',        'fDVvkVk5y<! `|c[zza5@I/9.dSLc|kHJ$#*&)hW|#Dr^>raVH%[kE+SsJ([a:3&');
define('AUTH_SALT',        'fF ?ux?Vusxo9277/N[-OfMRs,*AEI>d:waV<{}(xiH NKQu}%_N{Axb{X}+Q/$T');
define('SECURE_AUTH_SALT', '+M{RH8(0{ %,ywiszW;(ZN.Dqg0t]p|<RX~mcMsDz0^F-=0^z<a&P=K_D+s/~UJN');
define('LOGGED_IN_SALT',   '=<S.a<By+_}[Hx)Q=.,2VK??QuR9)bw/%V1jw|hTOcVC{ewGrieiZlk ,_19iJ`J');
define('NONCE_SALT',       ')[n,(W@( IrL]jp+d<GDhJq[= KM>e]zYEKWr7M+;R/r1uK_m)C5=q 3$gFm;?i<');

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
