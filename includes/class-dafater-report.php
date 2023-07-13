<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://kordaki.net
 * @since      1.0.0
 *
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Dafater_Report
 * @subpackage Dafater_Report/includes
 * @author     Pouriya Kordaki <pouriya.kordaki@gmail.com>
 */
class Dafater_Report
{

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Dafater_Report_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct()
	{
		if (defined('DAFATER_REPORT_VERSION')) {
			$this->version = DAFATER_REPORT_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'dafater-report';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Dafater_Report_Loader. Orchestrates the hooks of the plugin.
	 * - Dafater_Report_i18n. Defines internationalization functionality.
	 * - Dafater_Report_Admin. Defines all hooks for the admin area.
	 * - Dafater_Report_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies()
	{

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-dafater-report-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-dafater-report-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-dafater-report-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-dafater-report-public.php';

		$this->loader = new Dafater_Report_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Dafater_Report_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale()
	{

		$plugin_i18n = new Dafater_Report_i18n();

		$this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks()
	{

		$plugin_admin = new Dafater_Report_Admin($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
		$this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');

		// add new field to user profile:
		$this->loader->add_action('show_user_profile', $plugin_admin, 'extra_user_field');
		$this->loader->add_action('edit_user_profile', $plugin_admin, 'extra_user_field');
		$this->loader->add_action('user_new_form', $plugin_admin, 'extra_user_field');
		// save the new field into database -> user_meta
		$this->loader->add_action('personal_options_update', $plugin_admin, 'save_extra_user_field');
		$this->loader->add_action('edit_user_profile_update', $plugin_admin, 'save_extra_user_field');


		// add admin menu
		$this->loader->add_action('admin_menu', $plugin_admin, 'report_menu');


		//action hook for ajax request
		$this->loader->add_action('wp_ajax_admin_ajax_request', $plugin_admin, 'handle_ajax_request_admin');

		// add new roles
		add_role(
			'moghasem',
			'مقسم',
			array(
				'read' => true,
				'edit_posts' => true,
				'delete_posts' => true,
				'moderate_comments' => false,
				'manage_options' => true,
				'edit_theme_options' => false,
				'install_plugins' => false,
				'update_plugin' => false,
				'update_core' => false,
				'edit_users' => false,
			)
		);
		add_role(
			'daftarkhane',
			'دفترخانه',
			array(
				'read' => true,
				'edit_posts' => false,
				'delete_posts' => false,
				'moderate_comments' => false,
				'install_plugins' => false,
				'update_plugin' => false,
				'update_core' => false,
				'Capability' => 'Subscriber'
			)
		);


		function custom_login_redirect()
		{
			return home_url() . '//dafater_report_page/';
		}
		add_filter('login_redirect', 'custom_login_redirect');


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks()
	{

		$plugin_public = new Dafater_Report_Public($this->get_plugin_name(), $this->get_version());

		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
		$this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');

		$this->loader->add_filter('page_template', $plugin_public, 'report_page_template');
		add_shortcode('dafater-report-form', array($plugin_public, 'render_dafater_report_form'));

		//action hook for ajax request
		$this->loader->add_action('wp_ajax_public_ajax_request', $plugin_public, 'handle_ajax_request_public');

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run()
	{
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name()
	{
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Dafater_Report_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader()
	{
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version()
	{
		return $this->version;
	}

}