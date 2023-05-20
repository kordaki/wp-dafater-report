<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 * @author     Pouriya Kordaki <pouriya.kordaki@gmail.com>
 */
class Dafater_Report_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public function deactivate() {

		global $wpdb;
		// Remove page if exist
		$post_tbl = $wpdb->prefix . 'posts';
		$page_data = $wpdb->get_row(
			$wpdb->prepare( "SELECT * from $post_tbl where post_name LIKE %s", "dafater_report_page%")
		);
		$page_id = $page_data->ID;

		if($page_id > 0 ){
			// delete page
			wp_delete_post($page_id, true);
		}
	}

}
