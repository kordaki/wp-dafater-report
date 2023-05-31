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

		// drop report table
		require_once plugin_dir_path( __FILE__ ) . '../src/class-report-table.php';
		$report_table = new Report_Table;
		$report_table->drop_table();


		// Remove page if exist
		require_once plugin_dir_path( __FILE__ ) . '../src/class-report-entry-page.php';
		$report_entry_page = new Report_Entry_Page;
		$report_entry_page->remove_page();
	}

}
