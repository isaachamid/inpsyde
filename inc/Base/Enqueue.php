<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;

class Enqueue extends BaseClass {
	public function getScriptModules() {
		return [
			[
				"handle" => "index_script",
				"src"    => $this->plugin_url . "assets/js/index.min.js"
			],
		];
	}

	public function getStyleModules() {
		return [
			[
				"handle" => "table_style",
				"src"    => $this->plugin_url . "assets/css/table.min.css"
			],
		];
	}

	public function register() {
		add_action( 'admin_enqueue_scripts', array( $this, 'adminEnqueue' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueueModules' ) );
	}

	function adminEnqueue() {
		wp_enqueue_style( 'admin_plugin_template_style', $this->plugin_url . 'assets/css/admin_plugin_template_style.min.css' );
		wp_enqueue_script( 'plugin_template_script', $this->plugin_url . 'assets/js/plugin_template_script.min.js' );
	}

	function enqueueModules() {
		foreach ( $this->getStyleModules() as $module ) {
			wp_enqueue_style( $module["handle"], $module["src"] );
		}

		wp_enqueue_script( "jquery" );

		foreach ( $this->getScriptModules() as $module ) {
			wp_enqueue_script( $module["handle"], $module["src"] );
		}
	}
}