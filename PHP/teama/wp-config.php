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
define( 'DB_NAME', 'teama' );

/** MySQL database username */
define( 'DB_USER', 'admin_teama' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ipaQSzkOXdo99BNInyiq' );

/** MySQL hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',         '2j_WGtmUVXEGvS4Wqwz-YK$v_wWq$1Tiw99-4Z]~ @n#d[PUy017k`O^t9N;yy~D' );
define( 'SECURE_AUTH_KEY',  'mUbKGh`<`AUM3K,*%rwk}TVa7nQr2Hc(yrOAc$B/E<~~mrxc3 nn|YqtYpmvZIdS' );
define( 'LOGGED_IN_KEY',    '}892l)fh)G!}f;za&lWr9v4JrrB*0q#Et&v9vIxKRf;UX0^9H5q=fcrBk$$6q>_>' );
define( 'NONCE_KEY',        '%uCAut8zGB6X8YJ2cjF]/3-HS2Y1^;xkd`,4cxS4Ul5khXcx;HK{}W^~5ODa3?n+' );
define( 'AUTH_SALT',        'WGI7ysRK3Nw:Fv#gsggc}GL9FjlRx.*q4)A> ICBJ?~{47] tedh%O1 e]O{=J.)' );
define( 'SECURE_AUTH_SALT', 'd/-~M3@i+$C}[aQt~VNvg9WWZ:8n4kCz3YRy7;7pHcdPIUc}a3CIsk`n`kFyb%H5' );
define( 'LOGGED_IN_SALT',   'ZI02>JGBvF`{QbAX|L^k5IK?DRdQfIOhtMRY:w=>Od$?# S J^2LkADnqh!h;%Vv' );
define( 'NONCE_SALT',       'M=]=+CCjiC4_p&`G5y|O+-j)8(^=rL+|!zY~.7/V;b8x+5J<sq}LWk=PVu?rvW,m' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'ta_';

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
define( 'WP_DEBUG', true );
define('WP_DEBUG_LOG', true);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
