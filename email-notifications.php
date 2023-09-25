<?php

/**
 * This Plugin is used for Email Notifications
 *
 * @link              https://example.com
 * @since             1.0.0
 * @package           Email_Notifications
 *
 * @wordpress-plugin
 * Plugin Name:       Email Notifications
 * Plugin URI:        https://example.com
 * Description:       This Plugin is used to send email notifications when a new post is created.
 * Version:           1.0.0
 * Author:            Ritu Kaushal
 * Author URI:        https://example.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       email-notifications
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 
 */
define( 'EMAIL_NOTIFICATIONS_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-email-notifications-activator.php
 */
function activate_email_notifications() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-email-notifications-activator.php';
	Email_Notifications_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-email-notifications-deactivator.php
 */
function deactivate_email_notifications() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-email-notifications-deactivator.php';
	Email_Notifications_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_email_notifications' );
register_deactivation_hook( __FILE__, 'deactivate_email_notifications' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-email-notifications.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_email_notifications() {

	$plugin = new Email_Notifications();
	$plugin->run();

}
run_email_notifications();
