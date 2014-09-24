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
		url: $SERVER_PATH+"server/app/ajax/accounts/data/delete/data.php",
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
		$("#form-wizard #form-step"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step+=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-step"+current_step).css("display","block");
	}
	function prevstep(){
		$("#form-wizard #form-step"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step-=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-step"+current_step).css("display","block");
	}
	function loadingstep(){
		$("#form-wizard #form-step"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #form-step"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #form-step"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-error").css("display","none");
		$("#form-wizard #form-success").css("display","block");
	}
	function errorstep(error_code_str){
		$("#form-wizard #form-step"+current_step).css("display","none");
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
		},
		rules:{
		},
		submitHandler:function(form){
			if($(delete_option).val()!=0){
				loadingstep();
				$('#form-end #delete_option').val($('#form-step1 #delete_option').val());
				$.ajax({
					async: false,
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/accounts/data/delete/delete_account.php",
					data: {
						delete_option:$('#form-end #delete_option').val()
					},
					error: function(data, textStatus, jqXHR) {
						errorstep($error_s["ajax_error_content"])
					},
					success: function(response) {
						if(response.result){
							window.location.href = $PATH+"lock/";
						} else {
							errorstep(response.error_code_str);
						}

					}
				});
			}
			else{
				$("#delete_fields_alert").html("<label class='error'>"+$s["delete_app_select_one_option"]+"</label>");
			}
		}
	});

});
