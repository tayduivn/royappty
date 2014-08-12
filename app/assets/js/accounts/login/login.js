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
		url: $SERVER_PATH+"server/app/ajax/accounts/login/login.php",
		data: {
			"error":$GET["error"],
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
			}else{
				error_handler(response.error_code);
			}
		}
	});
});

//Form wizard
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
	$("#form-wizard #form-error").css("display","none");
	$("#form-wizard #form-success").css("display","none");
	$("#form-wizard #form-loading").css("display","block");
}
function errorstep(){
	$("#form-wizard #step-"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-success").css("display","none");
	$("#form-wizard #form-error").css("display","block");
}

$(document).ready(function() {
	$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});

	$("#form-step1").validate({
		messages:{
			email:{
				required:$s["email_this_field_is_compulsory"],
		  	email: $s["email_format_is_not_correct"]
	  	},
	  	password:{
				required:$s["password_this_field_is_compulsory"],
		  	maxlength: $s["password_it_canot_be_longer_than_25_characters"],
		  	minlength: $s["password_this_field_needs_4_character_minimum"]
			}
		},
		rules:{
			email:{
		  		required:true,
			  	email: true
		  	},
		  password:{
					required:true,
			  	maxlength: 25,
			  	minlength: 4
			}
		},
		submitHandler:function(form){
			$('#form-end #email').val($('#form-step1 #email').val());
		 	$('#form-end #password').val($('#form-step1 #password').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/login/create_session.php",
				data: {
					"email":$('#form-end #email').val(),
					"password":$('#form-end #password').val()
				},
				error: function(data, textStatus, jqXHR) {
					error_handler("ajax_error");
				},
				success: function(response) {
					if(response.result){
						localStorage.setItem('id_brand',response.data.id_brand);
						localStorage.setItem('id_admin',response.data.id_admin);
						window.location.href = "../";
					} else {
						error_handler("login_error");
					}

				}
			});
		}
	});

});
