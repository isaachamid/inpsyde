<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;

class Post extends BaseClass {
	public function register() {
		add_action( 'init', array( $this, 'custom_post_type' ) );
	}

	function custom_post_type() {
		register_post_type( 'book', [ 'public' => true, 'label' => 'Books' ] );
	}
}