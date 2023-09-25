<?php

/**
 * Fired during plugin activation
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Email_Notifications
 * @subpackage Email_Notifications/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Email_Notifications
 * @subpackage Email_Notifications/includes
 * @author     Ritu Kaushal <ritukaushal999@gmail.com>
 */

class Email_Notifications_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// WP Globals
	global $table_prefix, $wpdb;

	// Customer Table
	$EmailNotificationsTable = $table_prefix . 'posts_email_notifications';

	// Create Customer Table if not exist
	if( $wpdb->get_var( "show tables like '$EmailNotificationsTable'" ) != $EmailNotificationsTable ) {

			$sql = "CREATE TABLE `". $EmailNotificationsTable . "` ( ";
			$sql .= "  `id`  int(11)   NOT NULL auto_increment, ";
			$sql .= " `recipient_to` longtext NOT NULL, ";
			$sql .= " `subject` varchar(500) NOT NULL, ";
			$sql .= " `email_content` longtext NOT NULL, ";
			$sql .= "  PRIMARY KEY `email_id` (`id`) "; 
			$sql .= ") ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ; ";
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}
	}
	

}
