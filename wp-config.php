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
define( 'DB_NAME', 'azampsks_pigalgo' );
define( 'WP_HOME', 'https://azamprojects.online/pigalgo/' );
define( 'WP_SITEURL', 'https://azamprojects.online/pigalgo/' );
/** MySQL database username */
define( 'DB_USER', 'azampsks_pigalgo' );

/** MySQL database password */
define( 'DB_PASSWORD', 'pigalgo@123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );
define( 'FS_METHOD', 'direct' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'S3vuEIfw)J5@B_+7/(+=c8)a.ab|4U=W87bO8,<%a^y5X1s8lFq#;JWs_O_j]GbC' );
define( 'SECURE_AUTH_KEY',  'a?xhoIy85no0DdlYHqFjbsx1HoG<&) _C6Z(u[P8w*K!+ E)LGZ|mqSN>nW(`_$;' );
define( 'LOGGED_IN_KEY',    '%cm6C!<wY%rr^|#PF$w8+e4>eCB#( bHQdi/`Usnh_pJ+$7#y#?8gzjOAJV^rxa@' );
define( 'NONCE_KEY',        's2fu$pNc>SU ,oIVB]jz%Tv8hfcjEK5Gr:]<6:6E)#0]Epq*8ZHakh4tqv6Xr;KL' );
define( 'AUTH_SALT',        ':I eLEy}w<pM&Z<=YZPMdFVCH*U>zIv3(/>vY5}n|MY[N$32u]P&S6Ud_(6Sy7w2' );
define( 'SECURE_AUTH_SALT', 'i_%RVby5-r|LlBO[V6i>tlNB((zIdtO%4a*Dr~?8c0b7g181bLc WAr&YPYHdQRE' );
define( 'LOGGED_IN_SALT',   ';-i;s.:xs)|KiO9,/f>UZ_ZnmI/+C~km!Mr@FRTMc2~K7@{BB(A-j7rm]wfsH6TT' );
define( 'NONCE_SALT',       '0?/63|g@@D=}c,b[!bJ:=waSmvxJi4P.?*>]s;F0Ik NsU})Mb_TtwUGG`WOA>V]' );

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
