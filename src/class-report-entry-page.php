<?php

class Report_Entry_Page {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */

	public function create_page(){

		// require_once plugin_dir_path( __FILE__ ) . '../src/class-report-table.php';
		// $report_table_class = new Report_Table;
		// $report_table_class->create_table();

		global $wpdb;
		$post_tbl = $wpdb->prefix . 'posts';
		$page_data = $wpdb->get_row(
			$wpdb->prepare( "SELECT * from $post_tbl where post_name LIKE %s", "dafater_report_page%")
		);
		
		// crete page if it does not exist
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

    public function remove_page(){
		global $wpdb;
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
