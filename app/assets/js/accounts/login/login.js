$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/login/login.php",
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
				required:"Este campo es obligatorio",
			  	email: "El formato de correo electr&oacute;nico no es correcto"
		  	},
		  	password:{
				required:"Este campo es obligatorio",
			  	maxlength: "No puede exceder de 25 caracteres",
			  	minlength: "Este campo necesita un m&iacute;nimo de 4 caracteres"
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
					errorstep();
				},
				success: function(response) {
					if(response.result){
						localStorage.setItem('id_brand',response.data.id_brand);
						localStorage.setItem('id_admin',response.data.id_admin);
						window.location.href = "../";
					} else {
						error_handeler("login_error");
					}

				}
			});
		}
	});

});
