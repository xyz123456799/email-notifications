(function( $ ) {
	'use strict';

	/**
	 * This Plugin is used for custom js.
	 */
	jQuery(document).ready(function(){
		jQuery('textarea#email_notification_content').tinymce({
			height: 500,
			menubar: false,
			plugins: [
			   'a11ychecker','advlist','advcode','advtable','autolink','checklist','export',
			   'lists','link','image','charmap','preview','anchor','searchreplace','visualblocks',
			   'powerpaste','fullscreen','formatpainter','insertdatetime','media','table','help','wordcount'
			],
			toolbar: 'undo redo | a11ycheck casechange blocks | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist checklist outdent indent | removeformat | code table help'
		});
		jQuery('#email_notification_save').on('click',function(event){
			event.preventDefault();
			//alert("yes");
			var recipient_to = jQuery('#email_notification_recipient_to').val();
			var email_notification_subject = jQuery('#email_notification_subject').val();
			var tiny_content = tinymce.get('email_notification_content').getContent();
			if(recipient_to == '' && email_notification_subject == '' && tiny_content == ''){
				jQuery('.recipient_fields_required').css('display','none');
				jQuery('.subject_fields_required').css('display','none');
				jQuery('.all_fields_required').css('display','block');
				return false;
			}
			else if(recipient_to == ''){
				jQuery('.all_fields_required').css('display','none');
				jQuery('.recipient_fields_required').css('display','block');
				jQuery('.subject_fields_required').css('display','none');
				jQuery('.email_notification_fields_required').css('display','none');
				return false;
			}
			else if(email_notification_subject == ''){
				jQuery('.all_fields_required').css('display','none');
				jQuery('.recipient_fields_required').css('display','none');
				jQuery('.subject_fields_required').css('display','block');
				return false;
			}
			else if(tiny_content == ''){
				jQuery('.all_fields_required').css('display','none');
				jQuery('.recipient_fields_required').css('display','none');
				jQuery('.subject_fields_required').css('display','none');
				jQuery('.email_notification_fields_required').css('display','block');
				return false;
			}
			else if(recipient_to !='' && email_notification_subject!='' && tiny_content!=''){
				jQuery('.all_fields_required').css('display','none');
				jQuery('.recipient_fields_required').css('display','none');
				jQuery('.subject_fields_required').css('display','none');
				jQuery('.email_notification_fields_required').css('display','none');
				jQuery.ajax({
					url: ajax_object.ajax_url,
					type: "POST",
					dataType: "html",
					data: {
						'action':'email_notification_save_template',
						recipient_to:recipient_to,
						email_notification_subject:email_notification_subject,
						tiny_content:tiny_content
					},
					success: function(respones){
						if(respones !=""){
							if(respones == 1){
								setTimeout(function () {
									jQuery('.update_data').css('display','none');
									jQuery('.save_data').css('display','block');
									jQuery('.already_save_data').css('display','none');
								},2500);
							}
							else if(respones == 2){
								setTimeout(function () {
									jQuery('.update_data').css('display','block');
									jQuery('.save_data').css('display','none');
									jQuery('.already_save_data').css('display','none');
								},2500);
							}
							else if(respones == ''){
								setTimeout(function () {
									jQuery('.update_data').css('display','none');
									jQuery('.save_data').css('display','none');
									jQuery('.already_save_data').css('display','block');
								},2500);
								
							}
						}
					}
	
				});
			}
			return false;
		});
	});
	

})( jQuery );