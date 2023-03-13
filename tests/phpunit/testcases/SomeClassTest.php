<?php

use \Inc\Api\MyClass;
use \Inc\Api\SettingsApi;
use \Brain\Monkey\Functions;

class MyClassTest extends \PluginTestCase {
	public function testAddHooksActuallyAddsHooks() {
		( new MyClass() )->addHooks();
		self::assertTrue( has_action( 'init', [ MyClass::class, 'init' ] ) );
	}

	public function testRegistration() {
		$class = new SettingsApi();
		$class->addPages(['test']);
		$class->setSettings(['test']);
		$class->register();
		self::assertTrue( has_action('admin_menu', '\Inc\Api\SettingsApi->addAdminMenu()') );
		self::assertTrue( has_action('admin_init', '\Inc\Api\SettingsApi->registerCustomFields()') );
	}
}