<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;

class SettingsLink extends BaseClass {
	function register() {
		add_filter( "plugin_action_links_$this->plugin_basename", array( $this, 'settings_link' ) );
	}

	function settings_link( $links ) {
		//$settings_link = '<a href="options-general.php?page=template_plugin">Settings</a>';
		$settings_link = '<a href="admin.php?page=template_plugin_slug">Settings</a>';
		array_push( $links, $settings_link );

		return $links;
	}
}