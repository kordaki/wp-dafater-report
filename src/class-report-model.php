<?php

class Report_Model
{

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	public static function name()
	{
		global $wpdb;
		return $wpdb->prefix . 'dafater_report';
	}

	public function create_table()
	{
		global $wpdb;
		$report_tbl = $this::name();
		$user_tbl = $wpdb->prefix . 'users';

		// check if user table exist
		if ($wpdb->get_var("SHOW TABLES LIKE $report_tbl") != $report_tbl) {
			$charset_collate = "ENGINE=InnoDB DEFAULT CHARSET=utf8";
			$table_query = "CREATE TABLE $report_tbl (
				id bigint(11) NOT NULL AUTO_INCREMENT,
				user_id bigint(20) unsigned NOT NULL,
				totalIncome bigint(20) NOT NULL,
				reports text NOT NULL,
				date date DEFAULT NULL,
				created_at datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
				updated_at datetime DEFAULT NULL,
				deleted_at datetime DEFAULT NULL,
				PRIMARY KEY (id),
				FOREIGN KEY (user_id) REFERENCES $user_tbl(id)
			) $charset_collate;";

			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			dbDelta($table_query);
		}
		;
	}

	public function get_reports($year, $month, $moghasem)
	{
		global $wpdb;
		$report_tbl = $this::name();

		// get_var
		// get_row
		// get_column
		require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-helper-date.php';
		$date = Helper_Date::shamsi_to_europe_date($year, $month);

		
		$reports = $wpdb->get_results(
			$wpdb->prepare(
				"SELECT 
					{$report_tbl}.id, 
					{$report_tbl}.totalIncome, 
					{$report_tbl}.reports, 
					{$report_tbl}.date, 
					{$report_tbl}.created_at, 
					{$report_tbl}.updated_at, 
					{$wpdb->users}.display_name, 
					{$wpdb->users}.user_email
				FROM ($report_tbl LEFT JOIN {$wpdb->users} ON {$report_tbl}.user_id = {$wpdb->users}.id)
				WHERE {$report_tbl}.deleted_at is NULL AND {$report_tbl}.date = %s 
			",
				$date,
			)
		);

		// sanitizing data
		foreach ($reports as $key => $value) {
			$reports[$key]->pdate = parsidate('M Y', $value->date, 'per');
			$reports[$key]->pcreated_at = parsidate('Y/m/d h:m', $value->created_at, 'per');
		}

		return $reports;
	}

	public static function get_report($user_id, $date = null)
	{
		require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-helper-date.php';
		if (!$date) {
			$date = Helper_Date::get_active_date_europe();
		}

		global $wpdb;
		$table_name = self::name();
		$report = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM $table_name WHERE user_id = %d AND date = %s AND deleted_at is NULL",
				$user_id,
				$date
			)
		);
		if ($report) {
			$persian_date_array = Helper_Date::get_persian_date_array($report->date);
			$report->pYear = $persian_date_array['year'];
			$report->pMonth = $persian_date_array['month'];
		}
		return $report;
	}

	public static function add_report($user_id, $date, $totalIncome, $reports)
	{
		global $wpdb;
		$table_name = self::name();
		$wpdb->insert(
			$table_name,
			array(
				"user_id" => $user_id,
				"totalIncome" => $totalIncome,
				"date" => $date,
				"reports" => $reports
			)
		);
	}

	public function drop_table()
	{
		global $wpdb;

		// Drop table if exist
		$report_table = $this::name();
		$wpdb->query("DROP TABLE IF EXISTS $report_table");
	}

}