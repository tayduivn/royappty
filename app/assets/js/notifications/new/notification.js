/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 11-08-2014
* Version: 0.94
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/notifications/new/notification.php",
		data: {
			id_notification: $GET["id_notification"],
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
			content:{
				required: $s["notification_content_this_field_is_compulsory"],
				maxlength: $s["notification_content_it_canot_be_longer_than_75_characters"],
				minlength: $s["notification_content_this_field_needs_4_character_minimum"]
			}
		},
		rules:{
			content:{
		  		required:true,
			  	maxlength: 255,
			  	minlength: 4
		  	}
		},
		submitHandler:function(form){
			$('#form-end #content').val($('#form-step1 #content').val());
		 	$('#form-end #id_group').val($('#form-step1 #id_group').val());

			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/notifications/new/add_notification.php",
				data: {
					"content":$('#form-end #content').val(),
					"id_group":$('#form-end #id_group').val()
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

});
