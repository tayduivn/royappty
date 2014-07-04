$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/recovery/recovery.php",
		data: {
			"error":$GET["error"]
		},
		error: function(data, textStatus, jqXHR) {

		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
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
			email:{
				required:"Este campo es obligatorio",
			  	email: "El formato de correo electr&oacute;nico no es correcto"
		  	}
		},
		rules:{
			email:{
		  		required:true,
			  	email: true
		  	}
		},
		submitHandler:function(form){
			$('#form-end #email').val($('#form-step1 #email').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/recovery/add_recovery.php",
				data: {
					"email":$('#form-end #email').val()
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
