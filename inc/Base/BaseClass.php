<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;


abstract class BaseClass {
	public $plugin_path;
	public $plugin_url;
	public $plugin_basename;
	public $settingsArray;

	public function __construct() {
		$this->plugin_path     = plugin_dir_path( dirname( __FILE__, 2 ) );
		$this->plugin_url      = plugin_dir_url( dirname( __FILE__, 2 ) );
		$this->plugin_basename = plugin_basename( dirname( __FILE__, 3 ) . '/plugin-template.php' );
		$this->settingsArray   = [];
	}

	abstract function register();
}