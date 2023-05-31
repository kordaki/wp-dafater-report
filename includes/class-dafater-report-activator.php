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
		$report_tbl = $wpdb->prefix . 'dafater_report';
		$user_tbl = $wpdb->prefix . 'users';
		// check if user table exist
		if ( $wpdb->get_var( "SHOW TABLES LIKE $report_tbl" ) != $this->wp_tbl_reports() ) {
			// create table dafater_report with columns id, created_at, updated_at, deleted_at, user_id as foreign key, amount as number, date as date
			var_dump("table not exist");

			$charset_collate = "ENGINE=InnoDB DEFAULT CHARSET=latin1";
			$table_query = "CREATE TABLE $report_tbl (
				id bigint(11) NOT NULL AUTO_INCREMENT,
				user_id bigint(20) unsigned NOT NULL,
				amount bigint(20) NOT NULL,
				date date DEFAULT NULL,
				created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at datetime DEFAULT NULL,
				deleted_at datetime DEFAULT NULL,
				PRIMARY KEY (id),
				FOREIGN KEY (user_id) REFERENCES $user_tbl(id)
			) $charset_collate;";

			require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
			dbDelta( $table_query );
			// print("<pre>");
			// print_r($table_query);
			// print("</pre>");
		};

		// crete page if it does not exist
		$post_tbl = $wpdb->prefix . 'posts';
		$page_data = $wpdb->get_row(
			$wpdb->prepare( "SELECT * from $post_tbl where post_name LIKE %s", "dafater_report_page%")
		);

		if(empty($page_data)){
			// create page
			$post_arr_data = array(
				"post_title"  => "گزارش عملکرد دفاتر",
				"post_name" => "dafater_report_page",
				"post_status" => "publish",
				"post_author" => 1,
				"post_content" => "hiiiii report bede baba",
				"post_type" => "page"
			);
			wp_insert_post($post_arr_data);
		}
	}

	public function wp_tbl_reports() {
		global $wpdb;
		return $wpdb->prefix . 'dafater_report';
	}

}
