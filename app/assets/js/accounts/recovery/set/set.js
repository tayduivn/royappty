$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/recovery/set/set.php",
		data: {
			"code":$GET["code"]
		},
		error: function(data, textStatus, jqXHR) {

		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			}else{
				error_handeler(response.error_code);
			}
		}
	});
});

//Form wizard
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
	current_step=1;
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-step"+current_step).css("display","block");
}
function loadingstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-error").css("display","none");
	$("#form-wizard #form-success").css("display","none");
	$("#form-wizard #form-loading").css("display","block");
}
function successstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-error").css("display","none");
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-success").css("display","block");
}
function errorstep(error_str){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-success").css("display","none");
	if(error_str != null){
		$("#form-wizard #form-error #msg").html(error_str);
	}
	$("#form-wizard #form-error").css("display","block");
}

$(document).ready(function() {
	$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});

	$("#form-step1").validate({
		messages:{
			password:{
				required:$s["set_password_this_field_is_compulsory"],
				maxlength: $s["set_password_it_canot_be_longer_than_25_characters"],
				minlength: $s["set_password_this_field_needs_8_character_minimum"]
			},
			password_repeat:{
				required:$s["set_repeat_password_this_field_is_compulsory"],
				equalTo:$s["set_repeat_password_both_passwords_do_not_coincide"]
			}
		},
		rules:{
			password:{
				required:true,
				maxlength: 25,
				minlength: 8
			},
			password_repeat:{
				required:true,
				equalTo:"#password"
			}
		},
		submitHandler:function(form){
			$('#form-end #password').val($('#form-step1 #password').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/recovery/set/set_password.php",
				data: {
					"password":$('#form-end #password').val(),
					"code":$('#form-end #code').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep();
				},
				success: function(response) {
					if(response.result){
						successstep();
					} else {
						errorstep(response.error_str);
					}

				}
			});
		}
	});

});
