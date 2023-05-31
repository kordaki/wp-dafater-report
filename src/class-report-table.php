<?php

class Report_Table {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */


	public static function name() {
		global $wpdb;
		return $wpdb->prefix . 'dafater_report';
	}

	public function create_table(){
		global $wpdb;
		$report_tbl = $this::name();
		$user_tbl = $wpdb->prefix . 'users';

		// check if user table exist
		if ( $wpdb->get_var( "SHOW TABLES LIKE $report_tbl" ) != $report_tbl ) {
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
		};
	}

    public function drop_table(){
        global $wpdb;

		// Drop table if exist
		$report_table = $this::name();
		$wpdb->query("DROP TABLE IF EXISTS $report_table");
    }

}
