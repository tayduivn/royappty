/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 09-07-2014
* Version: 0.92
*
*********************************************************/

/*********************************************************
* AJAX RETURNS
*
* ERROR CODES
*
*********************************************************/

$(document).ready(function(){

	/*********************************************************
	* AJAX CALL LOAD PAGE
	*********************************************************/
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/accounts/signup/signup.php",
		data: {
			lang: localStorage.getItem("lang")
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			} else {
				error_handler(response.error_code);
			}
		}
	});

	/*********************************************************
	* FORM MANAGEMENT
	*********************************************************/

	$("#form-step1").validate({
		messages:{
			name:{
					required: $s["signup_name_this_field_is_compulsory"],
					maxlength: $s["signup_name_it_canot_be_longer_than_50_characters"],
					minlength: $s["signup_name_this_field_needs_4_character_minimum"]
			},
			email:{
				remote: $s["signup_email_this_email_is_already_registered"],
				required: $s["signup_email_this_field_is_compulsory"],
				email: $s["signup_email_format_is_not_correct"]
			},
			password:{
				required: $s["signup_password_this_field_is_compulsory"],
				maxlength: $s["signup_password_it_canot_be_longer_than_25_characters"],
				minlength: $s["signup_password_this_field_needs_8_character_minimum"]
			},
			password_repeat:{
				required:$s["signup_repeat_password_this_field_is_compulsory"],
				equalTo: $s["signup_repeat_password_both_passwords_do_not_coincide"]
			},
			accept_policy:{
				required: $s["signup_it_is_necessary_to accept_privacy_policy"],
			}
		},
		rules:{
			name:{
				required:true,
				maxlength: 50,
				minlength: 4
			},
			email:{
				remote:$SERVER_PATH+"server/ryadmin/ajax/accounts/signup/check_email_not_used.php",
				required:true,
				email: true
			},
			password:{
				required:true,
				maxlength: 25,
				minlength: 8
			},
			password_repeat:{
				required:true,
				equalTo:"#password"
			},
			accept_policy:{
				required: true
			}
		},
		submitHandler:function(form){
			$('#form-end #name').val($('#form-step1 #name').val());
			$('#form-end #email').val($('#form-step1 #email').val());
			$('#form-end #password').val($('#form-step1 #password').val());
			loadingstep();
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/ryadmin/ajax/accounts/signup/add_account.php",
				data: {
					name:$('#form-end #name').val(),
					email:$('#form-end #email').val(),
					password:$('#form-end #password').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep("ajax_error");
				},
				success: function(response) {
					if(response.result){
						successstep();
					} else {
						errorstep(response.error_code_str);
					}
				}
			});
		}
	});

	$("#form-step5").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #payment_method').val($('#form-step5 #payment_method').val());

		}
	});
});
