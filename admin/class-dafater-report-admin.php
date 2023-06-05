<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/admin
 * @author     Pouriya Kordaki <pouriya.kordaki@gmail.com>
 */

 require plugin_dir_path( __FILE__ ) . '../src/class-report-table.php';

class Dafater_Report_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		$valid_pages = array("dafater-report-list", "dafater-report-setting");
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if (in_array($page, $valid_pages)) {
			wp_enqueue_style("dr-bootstrap", DAFATER_REPORT_PLUGIN_URL . 'assets/css/bootstrap-rtl.min.css', array(), $this->version, 'all');
			wp_enqueue_style("dr-data-table", DAFATER_REPORT_PLUGIN_URL . 'assets/css/jquery.dataTables.min.css', array(), $this->version, 'all');
			wp_enqueue_style("dr-sweet-alert", DAFATER_REPORT_PLUGIN_URL . 'assets/css/sweetalert.min.css', array(), $this->version, 'all');

			wp_enqueue_style($this->plugin_name, DAFATER_REPORT_PLUGIN_URL . 'admin/css/dafater-report-admin.css', array(), $this->version, 'all');
		}
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		$valid_pages = array("dafater-report-list", "dafater-report-setting");
		$page = isset($_REQUEST['page']) ? $_REQUEST['page'] : '';
		if (in_array($page, $valid_pages)) {
			// load libraries
			wp_enqueue_script("jquery");
			wp_enqueue_script("dr-bootstrap-js", DAFATER_REPORT_PLUGIN_URL . 'assets/js/bootstrap.min.js', array('jquery'), $this->version, false);
			wp_enqueue_script("dr-data-table-js", DAFATER_REPORT_PLUGIN_URL . 'assets/js/jquery.dataTables.min.js', array('jquery'), $this->version, false);
			wp_enqueue_script("dr-sweet-alert-js", DAFATER_REPORT_PLUGIN_URL . 'assets/js/sweetalert.min.js', array('jquery'), $this->version, false);
			wp_enqueue_script("dr-validate-js", DAFATER_REPORT_PLUGIN_URL . 'assets/js/jquery.validate.min.js', array('jquery'), $this->version, false);

			wp_enqueue_script($this->plugin_name, DAFATER_REPORT_PLUGIN_URL . 'admin/js/dafater-report-admin.js', array('jquery'), $this->version, false);

			wp_localize_script(
				$this->plugin_name,
				'dr_public',
				array(
					'confirm_text' => 'Are you sure?',
					'cancel_text' => 'Cancel',
					'ajax_url' => admin_url('admin-ajax.php'),
				)
			);
		}
	}

	public function report_menu()
	{
		// main menu
		add_menu_page("گزارش کار دفاتر", "گزارش کار دفاتر", "manage_options", "dafater-report-list", array($this, "dafater_report_list"), "dashicons-clipboard", 21);

		// submenus
		add_submenu_page("dafater-report-list", "گزارش دفاتر", "گزارش ها", "manage_options", "dafater-report-list", array($this, "dafater_report_list"));
		add_submenu_page("dafater-report-list", "تنظیمات گزارش ها", "تنظیمات", "manage_options", "dafater-report-setting", array($this, "dafater_report_setting"));
	}

	public function dafater_report_list()
	{
		// get users list from database
		global $wpdb;
		$table_name = $wpdb->prefix . 'users';
		$users = $wpdb->get_results("SELECT * FROM $table_name");


		// select table from database
		$report_table = $wpdb->prefix . 'dafater_report';
		$report_tbl = $wpdb->get_var("SHOW TABLES LIKE $report_table");

		// $reports = $wpdb->get_results( "SELECT * FROM '{$wpdb->prefix}'posts where post_name='dafater_report-14'" );

		// $post_tbl = $wpdb->prefix . 'posts';
		// $page_data = $wpdb->get_results(
		// 	$wpdb->prepare( "SELECT * from $post_tbl where post_name LIKE %s", "dafater_report_page%")
		// );


		// print('<pre dir="ltr" style="text-align:left;">');
		// print_r($table_query);
		// print("</pre>");

		// echo "<h3>Report List page :X </h3>";

		$year = "1402";
		$month = "2";
		$report_table = new Report_Table;
		$reports = $report_table->get_reports($year, $month);

		ob_start();
		include_once plugin_dir_path(__FILE__) . 'partials/dafater-report-list.php';
		$setting_page = ob_get_clean();
		ob_end_clean();
		echo $setting_page;

	}
	public function dafater_report_setting()
	{
		$a = "2023-04-01 09:43:20";
		$b = "2023-06-01";

		$d = parsidate('M Y',$datetime=$a,$lang='per');
		print($d);

		ob_start();
		include_once plugin_dir_path(__FILE__) . 'partials/dafater-report-setting.php';
		$setting_page = ob_get_clean();
		ob_end_clean();
		echo $setting_page;

		// echo "<h3>Setting page :D </h3>";
	}



	public function handle_ajax_request_admin()
	{
		// handle ajax request of admin
		$target = isset($_REQUEST['target']) ? $_REQUEST['target'] : '';
		$method = isset($_REQUEST['method']) ? $_REQUEST['method'] : '';

		// print_r($param);

		// echo json_encode(
		// 	array(
		// 		"status" => 200,
		// 		"message" => "success",
		// 		"data" => array(
		// 			"name" => "pouriya",
		// 			"family" => $param,
		// 			"req" => $_REQUEST
		// 		)
		// 	)
		// );

		// $param = json_decode($param, true);
		// $action = isset($param['action']) ? $param['action'] : '';

		if (!empty($target)) {
			switch ($target) {
				case 'da_add_report':
					$this->add_report($_REQUEST);
					break;
				case 'da_update_report':
					$this->update_report($_REQUEST);
					break;
				case 'da_delete_report':
					$this->delete_report($_REQUEST);
					break;
				case 'da_get_reports': {
						$year = $_REQUEST['year'];
						$month = $_REQUEST['month'];
						$this->get_reports($year, $month);
						break;
					}
				default:
					# code...
					break;
			}
		}
		wp_die();
	}



	// preparing main db functions

	function get_reports($year, $month)
	{
		$report_table = new Report_Table;
		$reports = $report_table->get_reports($year, $month);
		
		$response = array("status" => 200, "message" => "success", "data" => array("reports" => $reports));
		echo json_encode($response);
	}

	function add_report($userId, $income, $date)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'dafater_report';
		$wpdb->insert(
			$table_name,
			array(
				"user_id" => $userId,
				"income" => $income,
				"date" => $date
			)
		);
	}

	function update_report($userId, $income, $date, $reportId)
	{
		global $wpdb;
		$table_name = $wpdb->prefix . 'dafater_report';
		$wpdb->update($table_name, array(
			"user_id" => $userId,
			"income" => $income,
			"date" => $date
		), array("id" => $reportId));
	}

	function soft_delete_report($reportId)
	{
		// currentDate needs to be dynamic
		$currentDate = "abcd";
		global $wpdb;
		$table_name = $wpdb->prefix . 'dafater_report';
		$wpdb->update($table_name, array(
			"deleted_at" => $currentDate,
		), array("id" => $reportId));
	}



}