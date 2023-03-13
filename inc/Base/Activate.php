<?php
/**
 * @package PluginTemplate
 */

namespace Inc\Base;

use PHPMailer\PHPMailer\Exception;

class Activate {
	public static function activate() {
		self::create_plugin_database_table();
		flush_rewrite_rules();
	}

	public static function create_plugin_database_table() {
		global $wpdb;
		$table_name      = $wpdb->prefix . "industry_four_interview";

		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$table_name}'" ) != $table_name ) {
			$sql = "CREATE TABLE wp_industry_four_interview(
					    ID int(11) NOT NULL AUTO_INCREMENT primary key,
					    userID int(10) NOT NULL,
					    useremail NVARCHAR(100) NOT NULL,
					    industry NVARCHAR(100) NOT NULL,
					    province NVARCHAR(100) NOT NULL,
					    numberOfEmployees NVARCHAR(100) NOT NULL,
					    startedIndustry NVARCHAR(100) NOT NULL,
					    obstacles NVARCHAR(200) NOT NULL,
					    answers NVARCHAR(10000) NOT NULL,
					    date DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
					)";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $sql );
		}
	}
}