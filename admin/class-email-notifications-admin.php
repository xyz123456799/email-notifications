<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Email_Notifications
 * @subpackage Email_Notifications/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Email_Notifications
 * @subpackage Email_Notifications/admin
 * @author     Ritu Kaushal <ritukaushal999@gmail.com>
 */
/**
 * The class responsible for defining all actions that occur in the activation hook
 * side of the site.
 */
		
require_once plugin_dir_path( __FILE__ ) . 'partials/class-email-notification-admin-ajax.php';

class Email_Notifications_Admin {

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
		 * defined in Email_Notifications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Email_Notifications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/email-notifications-admin.css', array(), $this->version, 'all' );

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
		 * defined in Email_Notifications_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Email_Notifications_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_script( $this->plugin_name.'ajaxHandle', plugin_dir_url( __FILE__ ) . 'js/email-notifications-admin.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( $this->plugin_name.'tinymce-jquery', plugin_dir_url( __FILE__ ) . 'js/tinymce-jquery.min.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name.'ajaxHandle','ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php')));
	}

	/**
	 * Register the menu for the admin area.
	 *
	 * @since    1.0.0
	 */

	public function email_notifications_admin_menu(){
		add_menu_page('Email Notifications','Email Notifications','manage_options','email_notifications','display_email_notifications');

		function display_email_notifications(){
			require_once plugin_dir_path( __FILE__ ) . 'partials/email-notifications-admin-display.php';
		}
	}

	public function email_notification_save_template(){
		Email_Notifications_Admin_Ajax::Get_Email_Notification_save_template();
	}

	public function email_notifications_post_publish($post_id){
		global $wpdb;
		$post_type = get_post_type($post_id);
		$table_name = $wpdb->prefix . 'posts_email_notifications';
		$email_notification_data = $wpdb->get_results("SELECT * FROM $table_name");
		$recipient_to = !empty($email_notification_data[0]->recipient_to) ? $email_notification_data[0]->recipient_to : "";
		$email_notification_subject = !empty($email_notification_data[0]->subject) ? $email_notification_data[0]->subject : "";
		$email_content = !empty($email_notification_data[0]->email_content) ? $email_notification_data[0]->email_content : "";
		$post_link = get_permalink($post_id);
		$site_url = site_url();
		$post_date = get_the_time('Y-m-d',$post_id);
		$email_content = str_replace('{postlink}', $post_link, $email_content);
		$admin_email = get_option('admin_email');
		if($post_type == 'post'){
			$headers  = "From: " . strip_tags($admin_email) . "\r\n";
			$headers .= "Reply-To: " . strip_tags($recipient_to) . "\r\n";
			$headers .= "MIME-Version: 1.0\r\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

			
			$message .= "<p>Hello</p>"."\r\n";
			$message .="<p>New post added on ".$site_url."</p>"."\r\n";
			$message .="<p>".$post_link."</p>"."\r\n";
			$message .="<p>".$post_date."</p>"."\r\n";
			
			$sent = wp_mail($recipient_to, $email_notification_subject, $message, $headers);
		}

		
		
	}
	

}