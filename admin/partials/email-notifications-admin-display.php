<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    Email_Notifications
 * @subpackage Email_Notifications/admin/partials
 */
global $wpdb; 
$table_name = $wpdb->prefix . 'posts_email_notifications';
$admin_email = get_option('admin_email');
$email_notification_data = $wpdb->get_results("SELECT * FROM $table_name ");
$admin_email_res = !empty($admin_email) ? $admin_email : "";
?>
<h1>Email Notification</h1>
<span style="display:none;" class="all_fields_required">All fields Required</span>
<span style="display:none;" class="save_data">Email Notifications Template Save Successfully.</span>
<span style="display:none;" class="update_data">Email Notifications Template Updated Successfully.</span>
<span style="display:none;" class="already_save_data">Email Notifications Template Already Save Successfully.</span>
<div class="Main-section">
    <div class="container">
        <div class="row">
            <form method="post" id="email_notification_form">
                <div class="col-md-12">
                    <label for="email-notification-to">Recipient(s)<span class="required">*</span></label>
                    <input type="email" name="email_notification_recipient_to" id="email_notification_recipient_to" value="<?php echo !empty($email_notification_data[0]->recipient_to) ? $email_notification_data[0]->recipient_to : $admin_email_res; ?>">
                    <span style="display:none;" class="recipient_fields_required">This field is Required</span>
                </div>
                <div class="col-md-12">
                    <label for="email-notification-subject">Subject<span class="required">*</span></label>
                    <input type="text" name="email_notification_subject" id="email_notification_subject" value="<?php echo !empty($email_notification_data[0]->subject) ? $email_notification_data[0]->subject : " "; ?>">
                    <span style="display:none;" class="subject_fields_required">This field is Required</span>
                </div>
                <div class="col-md-12">
                    <label for="email-notification-content"> Email Content<span class="required">*</span></label>
                    <textarea name="email_notification_content" id="email_notification_content" readonly><?php echo !empty($email_notification_data[0]->email_content) ? $email_notification_data[0]->email_content : "link - {postlink}"; ?></textarea>
                    <span style="display:none;" class="email_notification_fields_required">This field is Required</span>
                </div>
                <button type="submit" id="email_notification_save">Save Changes</button>
            </form>
        </div>
    </div>
</div>