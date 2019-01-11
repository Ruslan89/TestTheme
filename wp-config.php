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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'TJ6yDkYp0i9wFh1dlex6u7aBEZXCmTIvCw2HaHW+wzkZhYXkBv95MoZ+Mh5sKJ/8RsFF6u9g1HIZnrJhm0gptQ==');
define('SECURE_AUTH_KEY',  'XN8W9PWaITiCKFrnn4e8QhWFkNNk7MIRO5npwXQwkpmxbVoLVIpvV9oR1XLmyEJctiLsXZcmHuugRW0vhP8pMw==');
define('LOGGED_IN_KEY',    'qUB3gvdUE4LjFAamlet+NbHrYbDGyXDDhr5mBO1OF9+Ruo+OfjMfxiSvmpSqXvkWGqw9fURThXA21cVLYT3T4w==');
define('NONCE_KEY',        'rdNm+dZVcXubK8aSkt5G0lOWVGmN2ih1JfPjMXzqoXH5jdjVkbV5cutW1ksKl1pltBpsSYieURGEHvBTUgUyTA==');
define('AUTH_SALT',        'zmuGpv+Rb6B43m1ziJh1o5pnnLq8V1yR2IL2ROEpb4WgismudtxCbTvFxEG4serj6+W4THkRkYZ5KO0KFhicCQ==');
define('SECURE_AUTH_SALT', '60S5fhB2SHZbAQVts4nhPnVQ09kHCm+2KfZyDS/cWK7StReklGUESdTY20DksA1ucjHqiYCKysmdvOADJel91g==');
define('LOGGED_IN_SALT',   'YJK3+JckRSPP9SghoI4pfC184EsioUqy3iobx8ZqJMLdGDuFHaRUCUU+yrbou3Q0lEpRbTjcXzwE/hjvZAw6ow==');
define('NONCE_SALT',       'DMA9Aq+HWOlWr6HWGRHt1wrE/dFH3TONmGf7ypyvxt2ZuxzKyzQw+AQ97EKBW/HhQn+JR2gM4dvok/zFUzDbKQ==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_oho7svvu2e_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
