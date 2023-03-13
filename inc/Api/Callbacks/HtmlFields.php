<?php

namespace Inc\Api\Callbacks;

class HtmlFields {
	public static function inputField( $args ) {
		$name        = ( $args['label_for'] );
		$class       = ( $args['class'] );
		$placeholder = ( $args['placeholder'] );
		$value       = esc_attr( get_option( $name ) );

		echo "<input type=\"text\" class=\"$class\" name=\"$name\" value=\"$value\" placeholder=\"$placeholder\">";
	}
}