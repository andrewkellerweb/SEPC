<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sepc');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

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
define('AUTH_KEY',         '+|tv# HAVC(+&*(VOW@q1<X,vhSF].j=fSHt)sRlD8gEd2>-=DX y$[$|zC~E(]U');
define('SECURE_AUTH_KEY',  '=#mL,X{_!9RG;q#4v>@G1$6<IdW}`3neD-Jp4$j53$ (2GtxgnKK:5$*71M>:6u3');
define('LOGGED_IN_KEY',    'ife^GJ(A]YQ~DWV>mak{uaZ6uMD>$)S|]/i|pwlV(59gP|uI|sp)Vik3ysQZIL7q');
define('NONCE_KEY',        'oQwWh!=Rh)G=0Hq767z<US|){[ku;WKoZx~fV@[5H+-P<ho>X)h[|l!zG]W3HY}2');
define('AUTH_SALT',        '!WHDm?#SL?oJo;8 A``-8{14|viu7&w*]{dK4JZaeiCE&ht+.?-m#IGp#AhMg?N ');
define('SECURE_AUTH_SALT', '5d-GrgD qSEYQ?;de8,E1%c`AC>vO[*7+Fvq-2tdr@SPMaU&3;.`0;z2T/%T&*|^');
define('LOGGED_IN_SALT',   '0LX_#}ciS&?&VQl;oX#v97b`>l^nSZ=+|FDwx}j6S0TvhTqC~!+}U]7OAS|cBEB:');
define('NONCE_SALT',       'kCUiA`YGX@_;L<eDc7hWs@tKfT!AeuF::ScmGI]`.u81-I?C^8ywr<KLU9u&l/D#');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
