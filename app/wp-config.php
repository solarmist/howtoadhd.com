<?php

// sane default for wp-cli etc
if ( ! isset( $_SERVER['HTTP_HOST'] ) ) {
	$_SERVER['HTTP_HOST'] = '';
}

/**
 * MySQL settings
 */
define( 'DB_NAME', getenv( 'MYSQL_DATABASE' ) );
define( 'DB_USER', getenv( 'MYSQL_USER' ) );
define( 'DB_PASSWORD', getenv( 'MYSQL_PASSWORD' ) );
define( 'DB_HOST', getenv( 'MYSQL_HOST' ) );

define( 'DB_COLLATE', 'utf8mb4_general_ci' );
define( 'DB_CHARSET', 'utf8mb4' );

$table_prefix = 'wp_';

/**
 * Memcached settings
 */
const WP_CACHE = true;

global $memcached_servers;
$memcached_servers = array(
	array(
		getenv( 'CACHE_HOST' ),
		getenv( 'CACHE_PORT' ),
	)
);

/**
 * Authentication keys and salts
 */
define( 'AUTH_KEY', getenv( 'AUTH_KEY' ) );
define( 'SECURE_AUTH_KEY', getenv( 'SECURE_AUTH_KEY' ) );
define( 'LOGGED_IN_KEY', getenv( 'LOGGED_IN_KEY' ) );
define( 'NONCE_KEY', getenv( 'NONCE_KEY' ) );
define( 'AUTH_SALT', getenv( 'AUTH_SALT' ) );
define( 'SECURE_AUTH_SALT', getenv( 'SECURE_AUTH_SALT' ) );
define( 'LOGGED_IN_SALT', getenv( 'LOGGED_IN_SALT' ) );
define( 'NONCE_SALT', getenv( 'NONCE_SALT' ) );

/**
 * Site URL
 */
defined( 'WP_SITEURL' ) or define( 'WP_SITEURL', 'http://' . $_SERVER['HTTP_HOST'] );
defined( 'WP_HOME' ) or define( 'WP_HOME', 'http://' . $_SERVER['HTTP_HOST'] );

/**
 * Filesystem settings
 */
const DISALLOW_FILE_EDIT = true;
const DISALLOW_FILE_MODS = true;

/**
 * wp-content dir
 */
const WP_CONTENT_DIR = __DIR__ . '/wp-content';
define( 'WP_CONTENT_URL', WP_SITEURL . '/wp-content' );

/**
 * dropins dir
 */
const DROPINS_DIR = WP_CONTENT_DIR . '/dropins';

/**
 * mu-plugins dir
 */
const WPMU_PLUGIN_DIR = WP_CONTENT_DIR . '/mu-plugins';
define( 'WPMU_PLUGIN_URL', WP_CONTENT_URL . '/mu-plugins' );

/**
 * plugins dir
 */
const PLUGIN_DIR = WP_CONTENT_DIR . '/plugins';
define( 'PLUGIN_URL', WP_CONTENT_URL . '/plugins' );

/**
 * Debud
 */
if ( $env = getenv( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', $env );
} else {
	define( 'WP_DEBUG', false );
}
unset( $env );

/**
 * Disable wp-cron
 */
define( 'DISABLE_WP_CRON', true );

if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/wordpress/' );
}

/**
 * S3 Uploads / Tachyon image server
 */
define( 'S3_UPLOADS_BUCKET', getenv( 'S3_UPLOADS_BUCKET' ) );
define( 'S3_UPLOADS_KEY', getenv( 'S3_UPLOADS_KEY' ) );
define( 'S3_UPLOADS_SECRET', getenv( 'S3_UPLOADS_SECRET' ) );
define( 'S3_UPLOADS_REGION', getenv( 'S3_UPLOADS_REGION' ) );

if ( $s3_uploads_bucket_url = getenv( 'S3_UPLOADS_BUCKET_URL' ) ) {
	define( 'S3_UPLOADS_BUCKET_URL', $s3_uploads_bucket_url );
}

if ( $s3_endpoint = getenv( 'S3_ENDPOINT' ) ) {
	define( 'S3_ENDPOINT', $s3_endpoint );
}
unset( $s3_uploads_bucket_url, $s3_endpoint );

/**
 * SES WP Main
 */
define( 'AWS_SES_WP_MAIL_KEY', getenv( 'AWS_SES_WP_MAIL_KEY' ) );
define( 'AWS_SES_WP_MAIL_SECRET', getenv( 'AWS_SES_WP_MAIL_SECRET' ) );
define( 'AWS_SES_WP_MAIL_REGION', getenv( 'AWS_SES_WP_MAIL_REGION' ) );

if ( $ses_endpoint = getenv( 'AWS_SES_WP_MAIL_ENDPOINT' ) ) {
	define( 'AWS_SES_WP_MAIL_ENDPOINT', $ses_endpoint );
}
unset( $ses_endpoint );

/**
 * Dont concat scripts
 */
const CONCATENATE_SCRIPTS = false;

/**
 * It's time to begin - now count it in 5-6-7-8
 */
require_once __DIR__ . '/vendor/autoload.php';
require_once ABSPATH . 'wp-settings.php';