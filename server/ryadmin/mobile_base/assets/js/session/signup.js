$(document).ready(function() {

	$.ajax({
		async: false,
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/mobile/ajax/session/signup.php",
		data: {
			id_brand:$BRAND,
			lang:"es"
		},
		error: function(data, textStatus, jqXHR) {
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
				
				$("form").submit(function(e){
					e.preventDefault();
				});
				$("form").validate({
					messages:{
						email:{
							required: "Campo obligatorio",
							email: "Formato incorrecto"
					  	},
					  	password:{
							required: "Campo obligatorio",
						  	maxlength: "No puede ser mayor que 25 caracteres",
						  	minlength: "Mínimo 4 caracteres"
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
						$.ajax({
							async: false,
							type: "GET",
							dataType: 'jsonp',
							jsonp: 'callback',
							jsonpCallback: 'jsonCallback',
							contentType: 'application/json',
							url: $SERVER_PATH+"server/mobile/ajax/users/add_user.php",
							data: {
								id_brand:$BRAND,
								phone_key:localStorage.getItem("phone_key"),
								platform:localStorage.getItem("platform"),
								email:$("form #email").val(),
								password:$("form #password").val(),
							},
							error: function(data, textStatus, jqXHR) {
								error_handler("sign_up_error");
							},
							success: function(response) {
								if(response.result){
									localStorage.setItem('id_user', response.data.id_user);
									if(localStorage.getItem("platform")=="android"){
										window.location.href = "./index.html";
									}else{
										navigator.notification.alert(
											'Muchas gracias por darte de alta en nuestra app',
											signupDismissed,        
											'Registro',
											'Continuar'
										);		
									}
									
								
								} else {
									error_handler(response.error_code);
								}
					
							}
						});
					}
				});
			} else {
				error_handler(response.error_code);
			}

		}
	});


});
