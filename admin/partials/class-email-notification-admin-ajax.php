<?php
/**
 * Provide a admin core functions for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Email_Notifications
 * @subpackage Email_Notifications/admin/partials
 */




class Email_Notifications_Admin_Ajax{





    /**


	 * ######################


	 * ###


	 * #### CALLABLE FUNCTIONS


	 * ###


	 * ######################


	 */


    public static function Get_Email_Notification_save_template(){
        global $wpdb; 
        $table_name = $wpdb->prefix . 'posts_email_notifications';     
        $recipient_to =  !empty($_POST["recipient_to"]) ? $_POST["recipient_to"] : "";
        $email_notification_subject =  !empty($_POST["email_notification_subject"]) ? $_POST["email_notification_subject"] : "";
        $tiny_content =  !empty($_POST["tiny_content"]) ? $_POST["tiny_content"] : "";
        $email_notification_data = $wpdb->get_results("SELECT id FROM $table_name ");
        $email_notification_id = !empty($email_notification_data[0]->id) ? $email_notification_data[0]->id : "";
       

        if(!empty($email_notification_id)){
           $respones  = $wpdb->update( 
                $table_name, 
                array( 
                    'recipient_to' => $recipient_to, 
                    'subject' => $email_notification_subject, 
                    'email_content' => $tiny_content  
                ), 
                array('id' => $email_notification_id)
            );
            if(!empty($respones)){
                echo 2;
            }

        }
        else{
            $email_notification_data  = $wpdb->insert($table_name, 
            array(
                'recipient_to' => $recipient_to, 
                'subject' => $email_notification_subject, 
                 'email_content' => $tiny_content
            )); 
            if(!empty($email_notification_data)){
                echo 1;
            }
        }
        
        wp_die();

    }
   
    


}