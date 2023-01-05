<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://profiles.wordpress.org/wpvirtuoso/
 * @since             1.0.0
 * @package           Rex_Slider
 *
 * @wordpress-plugin
 * Plugin Name:       Rex Slider
 * Plugin URI:        https://#
 * Description:       A very simple and easy to use slider plugin
 * Version:           1.0.0
 * Author:            Wp Virtuoso
 * Author URI:        https://https://profiles.wordpress.org/wpvirtuoso/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rex-slider
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
define( 'REX_SLIDER_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rex-slider-activator.php
 */
function activate_rex_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-slider-activator.php';
	Rex_Slider_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rex-slider-deactivator.php
 */
function deactivate_rex_slider() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-rex-slider-deactivator.php';
	Rex_Slider_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rex_slider' );
register_deactivation_hook( __FILE__, 'deactivate_rex_slider' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rex-slider.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rex_slider() {

	$plugin = new Rex_Slider();
	$plugin->run();

}
run_rex_slider();
