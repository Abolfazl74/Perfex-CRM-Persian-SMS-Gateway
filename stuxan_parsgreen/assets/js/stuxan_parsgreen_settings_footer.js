$(function(){
	"use strict";
		$('#stuxan_parsgreen_validate').on('click',function(e){
			e.preventDefault();
			$('input[name="settings[stuxan_parsgreenhub_activation_code]"]').parents('.form-group').removeClass('has-error');
			var stuxan_parsgreen_purchase_key = $('input[name="settings[stuxan_parsgreenhub_activation_code]"]').val();
			var update_errors;
			if(stuxan_parsgreen_purchase_key != ''){
				var ubtn = $(this);
				ubtn.html($('#stuxan_parsgreen_validate_wrapper').data('wait-text'));
				ubtn.addClass('disabled');
				$.post(admin_url+'stuxan_parsgreenhub/validate',{
					purchase_key:stuxan_parsgreen_purchase_key,
				}).done(function(response){
					response=JSON.parse(response);
					if(response['status']){
						$('input[name="settings[stuxan_parsgreenhub_activated]"]').val(response['status']);
						$('#settings-form').submit();	
					}else{
						$('#stuxan_parsgreen_validate_messages').html('<div class="alert alert-danger"></div>');
						$('#stuxan_parsgreen_validate_messages .alert').append('<p>'+response['message']+'</p>');
						ubtn.removeClass('disabled');
						ubtn.html($('#stuxan_parsgreen_validate_wrapper').data('original-text'));
					}	
				}).fail(function(response){
					update_errors = JSON.parse(response.responseText);
					$('#stuxan_parsgreen_validate_messages').html('<div class="alert alert-danger"></div>');
					for (var i in update_errors){
						$('#stuxan_parsgreen_validate_messages .alert').append('<p>'+update_errors[i]+'</p>');
					}
					ubtn.removeClass('disabled');
					ubtn.html($('#stuxan_parsgreen_validate_wrapper').data('original-text'));
				});
			} 			
			else {
				$('input[name="settings[stuxan_parsgreenhub_activation_code]"]').parents('.form-group').addClass('has-error');
			}
		});
	});