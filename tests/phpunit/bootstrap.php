<?php
/**
 * The following snippets uses `PLUGIN` to prefix
 * the constants and class names. You should replace
 * it with something that matches your plugin name.
 */
// define test environment
define( 'PLUGIN_PHPUNIT', true );

// define fake ABSPATH
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', sys_get_temp_dir() );
}
// define fake PLUGIN_ABSPATH
if ( ! defined( 'PLUGIN_ABSPATH' ) ) {
	define( 'PLUGIN_ABSPATH', sys_get_temp_dir() . '/wp-content/plugins/inpsyde/' );
}

$autoload = realpath( __DIR__ . '/../../vendor/autoload.php' );

if ( file_exists( $autoload ) ) {
	require_once $autoload;
} else {
	echo 'Autoload file not found. Please run `composer install`.';
	die( 1 );
}

// Include the class for PluginTestCase
require_once __DIR__ . '/inc/PluginTestCase.php';