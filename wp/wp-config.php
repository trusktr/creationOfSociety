<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'creationOfSociety_wp');

/** MySQL database username */
define('DB_USER', 'ohf4809j2acvbyjw');

/** MySQL database password */
define('DB_PASSWORD', 'ehiufh3092jf40hg');

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
define('AUTH_KEY',         'jlEKOIeI$};% dFBS^Emdsb}W*I@SI+,:g)T-*DjT*OKB.aY-qX3+{e0X*C?BU $');
define('SECURE_AUTH_KEY',  '2}BnvOJL$|}L^5w-3.Yy;V333-l+[ZH;m=A{J@Bf=Gg$z=]QS=Ldvwio(.uK9ofK');
define('LOGGED_IN_KEY',    '(@-V*i}0O7P[;CPH$l+hV&j@u!JstWo%{<)d-pXx5!>n2;;jI-Zxj4h-.W?4rC9n');
define('NONCE_KEY',        'rI(`t|J0m:MZP3#aC1?I;RBXK_ LX55nLj;oy)|I!KgxZL&}P1kQ/iN)8[~BOhL ');
define('AUTH_SALT',        'tY<95h^^,X57Jf(K+ZM0H+b]mu[4Fer(cpX9pNjSS@~I3K|H^YK=U, JOXpO+qQf');
define('SECURE_AUTH_SALT', 'prt+zcsz]p&lA!`)fgO`uU8UW{|lX-&4@fraA5NBT@(^]H~qSTi6cSRa*h[~Wo1F');
define('LOGGED_IN_SALT',   'O&Qn||#i@d|W@5^xcl<NR!l+-we}ZY9V>=)#XPoF<FZ$IEt5[*no=Se`pWw_9uWz');
define('NONCE_SALT',       'H.}H$|)pe[!E{tffZ+Sx+|c03#%}}:3Dbwv{,X:hDOI`Wio9R^<2b;{-3y,<?89d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

