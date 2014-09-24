/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/admins/new/admin.php",
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
});

var current_step=1;
function nextstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step+=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #step-"+current_step).css("display","block");
	}
	function prevstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step-=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #step-"+current_step).css("display","block");
	}
	function loadingstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-error").css("display","none");
		$("#form-wizard #form-success").css("display","block");
	}
	function errorstep(error_code_str){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-success").css("display","none");
		$("#form-wizard #form-error").css("display","block");
		$("#form-wizard #form-error .msg").html(error_code_str);
	}

$(document).ready(function() {


	$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});




	$("#form-step1").validate({
		messages:{
			name:{
				required: $s["admin_name_this_field_is_compulsory"],
				maxlength: $s["admin_name_it_canot_be_longer_than_75_characters"],
				minlength: $s["admin_name_this_field_needs_4_character_minimum"]
			},
			email:{
				email: $s["admin_email_format_is_not_correct"]
			}
		},
		rules:{
			name:{
		  		required:true,
			  	maxlength: 75,
			  	minlength: 4
		  	},
				email:{
					email: true
				}
		},
		submitHandler:function(form){

			$('#form-end #name').val($('#form-step1 #name').val());
		 	$('#form-end #can_validate_codes').val(0);if($('#form-step1 #can_validate_codes').is(":checked")){$('#form-end #can_validate_codes').val(1);}
		 	$('#form-end #promo_password').val($('#form-step1 #promo_password').val());
		 	$('#form-end #can_login').val(0);if($('#form-step1 #can_login').is(":checked")){$('#form-end #can_login').val(1);}
		 	$('#form-end #can_manage_campaigns').val(0);if($('#form-step1 #can_manage_campaigns').is(":checked")){$('#form-end #can_manage_campaigns').val(1);}
		 	$('#form-end #can_manage_admins').val(0);if($('#form-step1 #can_manage_admins').is(":checked")){$('#form-end #can_manage_admins').val(1);}
		 	$('#form-end #can_manage_users').val(0);if($('#form-step1 #can_manage_users').is(":checked")){$('#form-end #can_manage_users').val(1);}
		 	$('#form-end #can_manage_app').val(0);if($('#form-step1 #can_manage_app').is(":checked")){$('#form-end #can_manage_app').val(1);}
		 	$('#form-end #can_manage_brand').val(0);if($('#form-step1 #can_manage_brand').is(":checked")){$('#form-end #can_manage_brand').val(1);}
			$('#form-end #email').val($('#form-step1 #email').val());
			$('#form-end #password').val($('#form-step1 #password').val());
			$('#form-end #active').val($('#form-step1 #active').val());

			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/admins/new/add_admin.php",
				data: {
					"name":$('#form-end #name').val(),
					"can_validate_codes":$('#form-end #can_validate_codes').val(),
					"promo_password":$('#form-end #promo_password').val(),
					"can_login":$('#form-end #can_login').val(),
					"can_manage_campaigns":$('#form-end #can_manage_campaigns').val(),
					"can_manage_admins":$('#form-end #can_manage_admins').val(),
					"can_manage_users":$('#form-end #can_manage_users').val(),
					"can_manage_app":$('#form-end #can_manage_app').val(),
					"can_manage_brand":$('#form-end #can_manage_brand').val(),
					"email":$('#form-end #email').val(),
					"password":$('#form-end #password').val(),
					"active":$('#form-end #active').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep($error_s["ajax_error_content"])
				},
				success: function(response) {
					if(response.result){
						successstep();
						$("#admin-link").attr("href","../../admin/?id_admin="+response.data);
					} else {
						errorstep(response.error_code_str);
					}

				}
			});
		}
	});

	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["admin_click_or_drag_image_here"]+'<br/>'+$s["admin_to upload"],
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
					alert($s["admin_an_error_occurred_when_downloading_the_file"]);
				}else{
					$('#'+result.preview).attr("src",result.filename);
				}
			}
		});
	});


});
