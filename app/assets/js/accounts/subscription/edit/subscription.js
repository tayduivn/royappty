/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/subscription/edit/subscription.php",
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
			if($('#form-step1 input[name="subscription_type"]:checked').val()!="starter"){
				$.ajax({
					async: false,
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/accounts/subscription/edit/payment_plans.php",
					data: {
						subscription_type:$('#form-step1 input[name="subscription_type"]:checked').val()
					},
					error: function(data, textStatus, jqXHR) {
						error_handler("ajax_error");
					},
					success: function(response) {
						if(response.result){
							jQuery.each(response.data,function(key,value){
								$(".ajax-loader-"+key).html(value);
							});
							nextstep();
						} else {
							error_handler(response.error_code);
						}

					}
				});
			}else{
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/accounts/subscription/edit/update_subscription.php",
					data: {
						subscription_type:$('#form-step1 input[name="subscription_type"]:checked').val(),
						payment_plan:"monthly",
						payment_method:"free"
					},
					error: function(data, textStatus, jqXHR) {
						errorstep($error_s["ajax_error_content"])
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

		}
	});

	$("#form-step2").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$.ajax({
				async: false,
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/subscription/edit/payment_methods.php",
				data: {
					subscription_type:$('#form-step1 input[name="subscription_type"]:checked').val(),
					payment_plan:$('#form-step2 input[name="payment_plan"]:checked').val()
				},
				error: function(data, textStatus, jqXHR) {
					error_handler("ajax_error");
				},
				success: function(response) {
					if(response.result){
						jQuery.each(response.data,function(key,value){
							$(".ajax-loader-"+key).html(value);
						});
						nextstep();
					} else {
						error_handler(response.error_code);
					}

				}
			});
		}
	});
	$("#form-step3").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/subscription/edit/update_subscription.php",
				data: {
					subscription_type:$('#form-step1 input[name="subscription_type"]:checked').val(),
					payment_plan:$('#form-step2 input[name="payment_plan"]:checked').val(),
					payment_method:$('#form-step3 input[name="payment_method"]:checked').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep($error_s["ajax_error_content"])
				},
				success: function(response) {
					if(response.result){
						window.location.href = $PATH+"my-account/subscription/payment_gateway";
					} else {
						errorstep(response.error_code_str);
					}

				}
			});
		}
	});

});
