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
		url: $SERVER_PATH+"server/app/ajax/accounts/signup/signup.php",
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
			admin_name:{
					required: $s["signup_name_this_field_is_compulsory"],
					maxlength: $s["signup_name_it_canot_be_longer_than_50_characters"],
					minlength: $s["signup_name_this_field_needs_4_character_minimum"]
			},
			admin_email:{
				remote: $s["signup_email_this_email_is_already_registered"],
				required: $s["signup_email_this_field_is_compulsory"],
				email: $s["signup_email_format_is_not_correct"]
			},
			admin_password:{
				required: $s["signup_password_this_field_is_compulsory"],
				maxlength: $s["signup_password_it_canot_be_longer_than_25_characters"],
				minlength: $s["signup_password_this_field_needs_8_character_minimum"]
			},
			admin_password_repeat:{
				required:$s["signup_repeat_password_this_field_is_compulsory"],
				equalTo: $s["signup_repeat_password_both_passwords_do_not_coincide"]
			},
			accept_policy:{
				required: $s["signup_it_is_necessary_to accept_privacy_policy"],
			}
		},
		rules:{
			admin_name:{
				required:true,
				maxlength: 50,
				minlength: 4
			},
			admin_email:{
				remote:$SERVER_PATH+"server/app/ajax/accounts/signup/check_email_not_used.php",
				required:true,
				email: true
			},
			admin_password:{
				required:true,
				maxlength: 25,
				minlength: 8
			},
			admin_password_repeat:{
				required:true,
				equalTo:"#admin_password"
			},
			accept_policy:{
				required: true
			}
		},
		submitHandler:function(form){
			$('#form-end #admin_name').val($('#form-step1 #admin_name').val());
			$('#form-end #admin_email').val($('#form-step1 #admin_email').val());
			$('#form-end #admin_password').val($('#form-step1 #admin_password').val());
			nextstep();
		}
	});


	jQuery.validator.addMethod("app_name", function(app_name, element){
    	app_name = app_name.replace(/\s+/g, ""); 
		return this.optional(element) || app_name.match(/^[A-Za-z\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC][A-Za-z0-9\u00e1\u00e9\u00ed\u00f3\u00fa\u00c1\u00c9\u00cd\u00d3\u00da\u00f1\u00d1\u00FC\u00DC]*$/);
	}, $s["signup_app_name_format_is_not_correct"]);
	$("#form-step2").validate({
		messages:{
			app_name:{
				required:$s["signup_app_name_this_field_is_compulsory"],
				maxlength: $s["signup_app_name_it_canot_be_longer_than_75_characters"],
				minlength: $s["signup_app_name_this_field_needs_4_character_minimum"]
			},
			name:{
				required:$s["signup_name_step2_this_field_is_compulsory"],
				maxlength: $s["signup_name_step2_it_canot_be_longer_than_75_characters"],
				minlength: $s["signup_name_step2_this_field_needs_4_character_minimum"]
			},
			cif:{
				required: $s["signup_cif_this_field_is_compulsory"],
					maxlength: $s["signup_cif_it_canot_be_longer_than_20_characters"],
					minlength: $s["signup_cif_this_field_needs_4_character_minimum"]
			},
			contact_phone:{
				required: $s["signup_phone_this_field_is_compulsory"]
			},
			contact_address:{
				required: $s["signup_address_this_field_is_compulsory"]
			},
			contact_postal_code:{
				required: $s["signup_post_code_this_field_is_compulsory"]
			},
			contact_city:{
				required: $s["signup_city_this_field_is_compulsory"]
			},
			contact_province:{
				required: $s["signup_province_this_field_is_compulsory"]
			},
			contact_country:{
				required:$s["signup_country_this_field_is_compulsory"]
			}
		},
		rules:{
			app_name:{
				required:true,
				maxlength: 75,
				minlength: 4,
				app_name:true
			},
			name:{
				required:true,
				maxlength: 75,
				minlength: 4
			},
			cif:{
				required:true,
				maxlength: 20,
					minlength: 4
			},
			contact_phone:{
				required:true
			},
			contact_address:{
				required:true
			},
			contact_postal_code:{
				required:true
			},
			contact_city:{
				required:true
			},
			contact_province:{
				required:true
			},
			contact_country:{
				required:true
			}
		},
		submitHandler:function(form){
			$('#form-end #app_name').val($('#form-step2 #app_name').val());
			$('#form-end #name').val($('#form-step2 #name').val());
			$('#form-end #cif').val($('#form-step2 #cif').val());
			$('#form-end #contact_phone').val($('#form-step2 #contact_phone').val());
			$('#form-end #contact_address').val($('#form-step2 #contact_address').val());
			$('#form-end #contact_postal_code').val($('#form-step2 #contact_postal_code').val());
			$('#form-end #contact_city').val($('#form-step2 #contact_city').val());
			$('#form-end #contact_province').val($('#form-step2 #contact_province').val());
			$('#form-end #contact_country').val($('#form-step2 #contact_country').val());
			nextstep();

		}
	});
	$("#form-step3").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #subscription_type').val($('#form-step3 #subscription_type:checked').val());
			$.ajax({
				async: false,
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/signup/get_payment_plans.php",
				data: {
					subscription_type:$('#form-end #subscription_type').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep("ajax_error");
				},
				success: function(response) {
					if(response.result){
						jQuery.each(response.data,function(key,value){
							$(".ajax-loader-"+key).html(value);
						});
					}else{
						errorstep(response.error_code_str);
					}
				}
			});
			nextstep();
		}
	});


	$("#form-step4").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #payment_plan').val($('#form-step4 #payment_plan').val());
			nextstep();
		}
	});

	$("#form-step5").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #payment_method').val($('#form-step5 #payment_method').val());
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/signup/add_account.php",
				data: {
					app_name:$('#form-end #app_name').val(),
					name:$('#form-end #name').val(),
					cif:$('#form-end #cif').val(),
					contact_phone:$('#form-end #contact_phone').val(),
					contact_address:$('#form-end #contact_address').val(),
					contact_postal_code:$('#form-end #contact_postal_code').val(),
					contact_city:$('#form-end #contact_city').val(),
					contact_province:$('#form-end #contact_province').val(),
					contact_country:$('#form-end #contact_country').val(),
					admin_name:$('#form-end #admin_name').val(),
					admin_email:$('#form-end #admin_email').val(),
					admin_password:$('#form-end #admin_password').val(),
					subscription_type:$('#form-end #subscription_type').val(),
					payment_plan:$('#form-end #payment_plan').val(),
					payment_method:$('#form-end #payment_method').val()
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

	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["signup_click_or_drag_image_here"]+'<br/>'+$s["signup_to upload"],
			'init' : function(result){},
			'start' : function(area){
				area.find('.error').remove();
			},
			'error' : function(result, input, area){
				$('<div class="error">').html(result.error).prependTo(area);
				return 0;
			},
			'complete' : function(result, file, input, area){
				if(result.error){
					alert($s["singup_an_error_occurred_when_dowloading_the_file"]);
				}else{
					$('#'+result.preview).attr("src",result.filename);
					$('#form-end #'+result.label).val(result.path);
				}
			}
		});
	});


});
