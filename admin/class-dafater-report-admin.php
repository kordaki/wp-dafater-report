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
class Dafater_Report_Admin {

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
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/dafater-report-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/dafater-report-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function report_menu(){
		// main menu
		add_menu_page( "نام صفحه", "گزارش کار دفاتر", "manage_options", "dafater-report-list", array($this, "dafater_report_list"), "dashicons-clipboard", 21 );

		// submenus
		add_submenu_page( "dafater-report-list", "صفحه دومی", "گزارش ها", "manage_options", "dafater-report-list", array($this, "dafater_report_list"));
		add_submenu_page( "dafater-report-list", "صفحه سومی", "تنظیمات", "manage_options", "dafater-report-setting", array($this, "dafater_report_setting"));
	}

	public function dafater_report_list(){
		echo "<h3>Report List page :X </h3>";
	}
	public function dafater_report_setting(){
		echo "<h3>Setting page :D </h3>";
	}

}
