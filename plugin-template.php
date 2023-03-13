<?php
/**
 * plugin-template
 *
 * @package           PluginTemplate
 * @author            Hamed Motallebi
 * @copyright         2020 Hamed Motallebi
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       Inpsyde Plugin Template
 * Plugin URI:        https://gitlab.com/ivy-man
 * Description:       Description of the plugin.
 * Version:           0.0.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Hamed Motallebi
 * Author URI:        https://gitlab.com/ivy-man
 * Text Domain:       plugin-template
 * License:           GPLv2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

Copyright (C) 2020 Hamed Motallebi
 */

// Make sure we don't expose any info if called directly
defined( 'ABSPATH' ) or die( 'Hi there!  I\'m just a plugin, not much I can do when called directly.' );

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}

//define( 'PLUGIN_BASENAME', plugin_basename( __FILE__ ) );

function activate_template_plugin(){
	\Inc\Base\Activate::activate();
}
register_activation_hook(__FILE__, 'activate_template_plugin');

function deactivate_template_plugin(){
	\Inc\Base\Deactivate::deactivate();
}
register_activation_hook(__FILE__, 'deactivate_template_plugin');

if ( class_exists( 'Inc\\Init' ) ) {
	Inc\Init::register_services();
}