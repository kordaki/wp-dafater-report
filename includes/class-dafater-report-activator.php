<?php

/**
 * Fired during plugin activation
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 * @author     Pouriya Kordaki <pouriya.kordaki@gmail.com>
 */
class Dafater_Report_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// create table if it doesn't exist
		

		// global $wpdb;
		// $table_name = $wpdb->prefix . 'dafater_report';
		// $charset_collate = $wpdb->get_charset_collate();
		// $sql = "CREATE TABLE $table_name (
		// 	id mediumint(9) NOT NULL AUTO_INCREMENT,
		// 	created_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		// 	updated_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		// 	deleted_at datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		// 	PRIMARY KEY  (id)
		// ) $charset_collate;";
		// require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		// dbDelta( $sql );

	}

}
