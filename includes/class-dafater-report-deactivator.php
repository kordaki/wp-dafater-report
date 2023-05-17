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
	public static function deactivate() {

		// crete page if it does not exist
		$page_data = $wpdb->get_row(
			// why not get_var? ?????
			$wpdb->prepare( "SELECT ID from '{$wpdb->prefix}'posts where post_name=%s", "dafater_report")
		);
		$page_id = $page_data->ID;

		if($page_id > 0 ){
			// delete page
			wp_delete_post($page_id, true);
		}
	}

}
