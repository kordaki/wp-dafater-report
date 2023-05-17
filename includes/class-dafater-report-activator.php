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
	public function activate() {

		global $wpdb;
		// $table_name = $wpdb->prefix . 'dafater_report';
		// check if user table exist
		if ( $wpdb->get_var( "SHOW TABLES LIKE '{$this->wp_tbl_reports()}'" ) == $this->wp_tbl_reports() ) {
			return;
		};

		// create table dafater_report with columns id, created_at, updated_at, deleted_at, user_id as foreign key, amount as number, date as date
		$sql = "CREATE TABLE $table_name (
			id mediumint(9) NOT NULL AUTO_INCREMENT,
			created_at timestamp DEFAULT CURRENT_TIMESTAMP NOT NULL,
			updated_at timestamp DEFAULT NULL,
			deleted_at timestamp DEFAULT NULL,
			user_id mediumint(9) NOT NULL,
			amount longint(9) NOT NULL,
			date date NOT NULL,
			PRIMARY KEY  (id),
			FOREIGN KEY (user_id) REFERENCES wp_users(id)
		) $charset_collate;";
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql );
	}

	public function wp_tbl_reports() {
		global $wpdb;
		return $wpdb->prefix . 'dafater_report';
	}

}
