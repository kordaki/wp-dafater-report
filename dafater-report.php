<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://kordaki.net
 * @since             1.0.0
 * @package           Dafater_Report
 *
 * @wordpress-plugin
 * Plugin Name:       گزارش عملکرد دفاتر اسناد
 * Plugin URI:        https://kordaki.net
 * Description:       افزونه ای برای گزارش عملکرد دفاتر اسناد رسمی در کانون سردفتران و دفتریاران استان.
 * Version:           1.0.0
 * Author:            Pouriya Kordaki
 * Author URI:        https://kordaki.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       dafater-report
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'DAFATER_REPORT_VERSION', '1.0.0' );
define( 'DAFATER_REPORT_PLUGIN_PATH', plugin_dir_path( __FILE__ ));
define( 'DAFATER_REPORT_PLUGIN_URL', plugin_dir_url( __FILE__ ));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-dafater-report-activator.php
 */
function activate_dafater_report() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dafater-report-activator.php';
	$activator = new Dafater_Report_Activator;
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-dafater-report-deactivator.php
 */
function deactivate_dafater_report() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-dafater-report-deactivator.php';
	$deactivator = new Dafater_Report_Deactivator;
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_dafater_report' );
register_deactivation_hook( __FILE__, 'deactivate_dafater_report' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-dafater-report.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_dafater_report() {

	$plugin = new Dafater_Report();
	$plugin->run();

}
run_dafater_report();
