<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;

class Shortcode extends BaseClass {
	function register() {
		add_shortcode( 'inpsyde_plugin', [ $this, 'addShortcode' ] );
	}

	public function addShortcode( $atts = [], $content = null ) {
		$url = ( array_key_exists( "url", $atts ) )
			? $atts["url"]
			: "https://jsonplaceholder.typicode.com/users";

		include $this->plugin_path . 'views/interview.php';
	}
}