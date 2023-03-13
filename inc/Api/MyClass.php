<?php

namespace Inc\Api;

class MyClass {

	public function addHooks() {

		add_action( 'init', [ __CLASS__, 'init' ], 20 );
	}

	public function init() {
		return true;
	}
}