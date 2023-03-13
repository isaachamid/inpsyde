<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Pages;

use Inc\Base\BaseClass;
use Inc\Api\SettingsApi;

class Admin extends BaseClass {
	public $pages;
	public $subpages;
	public $settings;

	public function __construct() {
		parent::__construct();
		$this->settingsArray = [
			"first_name" => "First Name",
			"last_name"  => "Last Name"
		];
	}

	public function register() {
		$this->settings = new SettingsApi();
		$this->setPages();
		$this->setSubPages();
		$this->setSettings();
		$this->setSections();
		$this->setFields();
		$this->settings->addPages( $this->pages )->withSubPage( 'Dashboard' )->addSubPages( $this->subpages )->register();
	}

	public function setPages() {
		$this->pages = [
			[
				'page_title' => 'Template Plugin',
				'menu_title' => 'Template Plugin',
				'capability' => 'manage_options',
				'menu_slug'  => 'template_plugin_slug',
				'callback'   => function () {
					return require_once $this->plugin_path . 'views/admin.php';
				},
				'icon_url'   => 'dashicons-store',
				'position'   => 110
			],
		];
	}

	public function setSubPages() {
		$this->subpages = [
			[
				'parent_slug' => 'template_plugin_slug',
				'page_title'  => 'Custom Post Types',
				'menu_title'  => 'CPT',
				'capability'  => 'manage_options',
				'menu_slug'   => 'template_cpt',
				'callback'    => function () {
					return require_once $this->plugin_path . 'views/cpt.php';
				}
			],
			[
				'parent_slug' => 'template_plugin_slug',
				'page_title'  => 'Custom Widgets',
				'menu_title'  => 'Widgets',
				'capability'  => 'manage_options',
				'menu_slug'   => 'template_widgets',
				'callback'    => function () {
					return require_once $this->plugin_path . 'views/widgets.php';
				}
			],
		];
	}

	public function setSettings() {
		$args = [];

		foreach ( $this->settingsArray as $key => $value ) {
			$args[] = [
				"option_group" => "template_plugin_options_group",
				"option_name"  => $key,
				"callback"     => function ( $input ) {
					return $input;
				},
			];
		}

		$this->settings->setSettings( $args );
	}

	public function setSections() {
		$args = [
			[
				"id"       => "template_plugin_admin_index",
				"title"    => "Settings",
				"callback" => function ( $input ) {
					echo "Check this beautiful section";
				},
				"page"     => "template_plugin_slug"
			]
		];

		$this->settings->setSections( $args );
	}

	public function setFields() {
		$args = [];

		foreach ( $this->settingsArray as $key => $value ) {
			$args[] = [
				"id"       => $key,
				"title"    => $value,
				"callback" => "Inc\Api\Callbacks\HtmlFields::inputField",
				"page"     => "template_plugin_slug",
				"section"  => "template_plugin_admin_index",
				"args"     => [
					"label_for"   => $key,
					"class"       => "regular-text",
					"placeholder" => $value,
				],
			];
		}

		$this->settings->setFields( $args );
	}
}