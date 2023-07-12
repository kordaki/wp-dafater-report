<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/public
 * @author     Pouriya Kordaki <pouriya.kordaki@gmail.com>
 */

// require plugin_dir_path( __FILE__ ) . '../src/class-report-model.php';

class Dafater_Report_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dafater_Report_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dafater_Report_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/dafater-report-public.css', array(), $this->version, 'all');
		wp_enqueue_style("dr-bootstrap", DAFATER_REPORT_PLUGIN_URL . 'assets/css/bootstrap-rtl.min.css', array(), $this->version, 'all');


	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dafater_Report_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dafater_Report_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/dafater-report-public.js', array('jquery'), $this->version, false);


		require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-helper-date.php';

		$user = wp_get_current_user();
		wp_localize_script(
			$this->plugin_name,
			'dr_public',
			array(
				'ajax_url' => admin_url('admin-ajax.php'),
				'moteamel_list' => Helper_Date::get_moteamel_list(),
			)
		);

	}

	public function report_page_template()
	{
		global $post;
		if ($post->post_name == 'dafater_report_page') {
			$page_template = DAFATER_REPORT_PLUGIN_PATH . 'public/partials/report_page_layout.php';
			return $page_template;
		}
	}

	public function render_dafater_report_form()
	{
		$user = wp_get_current_user();
		$user_name = $user->display_name;

		require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-report-model.php';
		$report = Report_Model::get_report($user->ID);
		$is_edit = !empty($report) ? true : false;

		// $data = $report;

		require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-helper-date.php';
		$active_month = $is_edit ? $report->pMonth : Helper_Date::get_active_month();
		$active_year = $is_edit ? $report->pYear : Helper_Date::get_active_year();
		$month_list = Helper_Date::get_month_list();
		$year_list = Helper_Date::get_year_list();
		$moteamel_list = Helper_Date::get_moteamel_list();
		ob_start();
		include_once DAFATER_REPORT_PLUGIN_PATH . 'public/partials/dafater-report-public-display.php';
		$template = ob_get_contents();
		ob_clean();
		echo $template;
	}


	public function handle_ajax_request_public()
	{
		// handle ajax request of public / users
		$target = isset($_REQUEST['target']) ? $_REQUEST['target'] : '';

		if (!empty($target)) {
			switch ($target) {
				case 'da_add_report':
					$this->add_user_report($_REQUEST);
					break;
				case 'da_update_report':
					$this->update_user_report($_REQUEST);
					break;
				default:
					# code...
					break;
			}
		}
		wp_die();
	}

	public function add_user_report($request)
	{
		$isNullIncome = $request['nullIncome'];
		$user_id = get_current_user_id();

		$reportList = array();

		if (isset($isNullIncome)) {
			// this month was without income
		} else {
			$moamel = $request['moamel'];
			$moteamel = $request['moteamel'];
			$documentNumber = $request['documentNumber'];
			$income = $request['income'];

			foreach ($income as $key => $row) {
				$lineReport = array(
					"moamel" => $moamel[$key],
					"moteamel" => $moteamel[$key],
					"documentNumber" => $documentNumber[$key],
					"income" => $income[$key],
				);
				array_push($reportList, $lineReport);
			}
		}


		// require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-helper-date.php';
		// $active_date_europe = Helper_Date::get_active_date_europe();

		// require_once DAFATER_REPORT_PLUGIN_PATH . 'src/class-report-model.php';
		// Report_Model::add_report($user_id, $active_date_europe, $income);

		// $response = array("status" => 200, "message" => "success", "data" => array("report" => $income, "date" => $active_date_europe, "user_id" => $user_id));
		// $response = array("status" => 200, "message" => "success", "data" => array("report" => $request, "date" => $isNullIncome, "user_id" => $user_id));
		$response = array("status" => 200, "message" => "success", "data" => array("report" => $isNullIncome, "date" => $reportList, "user_id" => $user_id));

		echo json_encode($response);
	}

	public function update_user_report($request)
	{
		$response = array("status" => 200, "message" => "success222", "data" => array("report" => $request));
		echo json_encode($response);
	}
}