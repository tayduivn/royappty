$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/signup/signup.php",
		data: {
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
function gotostep(step){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","block");
	current_step=step;
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-step"+current_step).css("display","block");
}
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
function errorstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
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
			admin_name:{
					required:"Este campo es obligatorio",
					maxlength: "No puede exceder de 50 caracteres",
					minlength: "Este campo necesita un m&iacute;nimo de 4 caracteres"
			},
			admin_email:{
				remote:"Este correo electrónico ya está registrado",
				required:"Este campo es obligatorio",
				email: "El formato de correo electr&oacute;nico no es correcto"
			},
			admin_password:{
				required:"Este campo es obligatorio",
				maxlength: "No puede exceder de 25 caracteres",
				minlength: "Este campo necesita un m&iacute;nimo de 8 caracteres"
			},
			admin_password_repeat:{
				required:"Este campo es obligatorio",
				equalTo:"Las claves no coinciden"
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
			}
		},
		submitHandler:function(form){
			$('#form-end #admin_name').val($('#form-step1 #admin_name').val());
			$('#form-end #admin_email').val($('#form-step1 #admin_email').val());
			$('#form-end #admin_password').val($('#form-step1 #admin_password').val());
			nextstep();
		}
	});
	$("#form-step2").validate({
		messages:{
			name:{
				required:"Este campo es obligatorio",
					maxlength: "No puede exceder de 75 caracteres",
					minlength: "Este campo necesita un m&iacute;nimo de 4 caracteres"
			},
			cif:{
				required:"Este campo es obligatorio",
					maxlength: "No puede exceder de 20 caracteres",
					minlength: "Este campo necesita un m&iacute;nimo de 4 caracteres"
			},
			contact_address:{
				required:"Este campo es obligatorio"
			},
			contact_postal_code:{
				required:"Este campo es obligatorio"
			},
			contact_city:{
				required:"Este campo es obligatorio"
			},
			contact_province:{
				required:"Este campo es obligatorio"
			},
			contact_country:{
				required:"Este campo es obligatorio"
			}
		},
		rules:{
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
			$('#form-end #name').val($('#form-step2 #name').val());
			$('#form-end #cif').val($('#form-step2 #cif').val());
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
			app_name:{
					required:"Este campo es obligatorio",
					maxlength: "No puede exceder de 75 caracteres",
					minlength: "Este campo necesita un m&iacute;nimo de 4 caracteres"
				}
		},
		rules:{
			app_name:{
					required:true,
					maxlength: 75,
					minlength: 4
				}
		},
		submitHandler:function(form){
			$('#form-end #app_name').val($('#form-step3 #app_name').val());
			$('#form-end #app_description').val($('#form-step3 #app_description').val());
		nextstep();
		}
	});

	$("#form-step4").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #subscription_type').val($('#form-step4 #subscription_type:checked').val());
			if($('#form-end #subscription_type').val()=="welcome"){
				$('#form-end #payment_plan').val("monthly");
				$('#form-end #payment_method').val("free");
				loadingstep();

				$.ajax({
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/accounts/signup/add_account.php",
					data: {
						name:$('#form-end #name').val(),
						cif:$('#form-end #cif').val(),
						contact_address:$('#form-end #contact_address').val(),
						contact_postal_code:$('#form-end #contact_postal_code').val(),
						contact_city:$('#form-end #contact_city').val(),
						contact_country:$('#form-end #contact_country').val(),
						admin_name:$('#form-end #admin_name').val(),
						admin_email:$('#form-end #admin_email').val(),
						admin_password:$('#form-end #admin_password').val(),
						subscription_type:$('#form-end #subscription_type').val(),
						payment_plan:$('#form-end #payment_plan').val(),
						payment_method:$('#form-end #payment_method').val(),
						app_name:$('#form-end #app_name').val(),
						app_description:$('#form-end #app_description').val(),
						app_icon_path:$('#form-end #app_icon_path').val(),
						app_bg_path:$('#form-end #app_bg_path').val()
					},
					error: function(data, textStatus, jqXHR) {
						errorstep();
					},
					success: function(response) {
						if(response.result){
							successstep();
						} else {
							errorstep();
						}

					}
				});



			}else if($('#form-end #subscription_type').val()=="starter"){
				$('#form-end #payment_plan').val("monthly");
				$('#form-end #payment_method').val("free");

				loadingstep();
				$.ajax({
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/accounts/signup/add_account.php",
					data: {
						name:$('#form-end #name').val(),
						cif:$('#form-end #cif').val(),
						contact_address:$('#form-end #contact_address').val(),
						contact_postal_code:$('#form-end #contact_postal_code').val(),
						contact_city:$('#form-end #contact_city').val(),
						contact_country:$('#form-end #contact_country').val(),
						admin_name:$('#form-end #admin_name').val(),
						admin_email:$('#form-end #admin_email').val(),
						admin_password:$('#form-end #admin_password').val(),
						subscription_type:$('#form-end #subscription_type').val(),
						payment_plan:$('#form-end #payment_plan').val(),
						payment_method:$('#form-end #payment_method').val(),
						app_name:$('#form-end #app_name').val(),
						app_description:$('#form-end #app_description').val(),
						app_icon_path:$('#form-end #app_icon_path').val(),
						app_bg_path:$('#form-end #app_bg_path').val()
					},
					error: function(data, textStatus, jqXHR) {
						errorstep();
					},
					success: function(response) {
						if(response.result){
							successstep();
						} else {
							errorstep();
						}

					}
				});

			}else{
				loadingstep();
				$(document).ready(function(){
					$.ajax({
						async: false,
						type: "POST",
						dataType: 'json',
						url: $SERVER_PATH+"server/app/ajax/accounts/signup/get_payment_plans.php",
						data: {
							subscription_type:$('#form-end #subscription_type').val()
						},
						error: function(data, textStatus, jqXHR) {
							errorstep();
						},
						success: function(response) {
							if(response.result){
								jQuery.each(response.data,function(key,value){
									$(".ajax-loader-"+key).html(value);
								});
							}else{
								errorstep();
							}
						}
					});
				});
				nextstep();
			}

		}
	});


	$("#form-step5").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){

			$('#form-end #payment_plan').val($('#form-step5 #payment_plan').val());
			$('#form-end #payment_method').val($('#form-step5 #payment_method').val());
			loadingstep();
			$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/signup/add_account.php",
				data: {
					name:$('#form-end #name').val(),
					cif:$('#form-end #cif').val(),
					contact_address:$('#form-end #contact_address').val(),
					contact_postal_code:$('#form-end #contact_postal_code').val(),
					contact_city:$('#form-end #contact_city').val(),
					contact_country:$('#form-end #contact_country').val(),
					admin_name:$('#form-end #admin_name').val(),
					admin_email:$('#form-end #admin_email').val(),
					admin_password:$('#form-end #admin_password').val(),
					subscription_type:$('#form-end #subscription_type').val(),
					payment_plan:$('#form-end #payment_plan').val(),
					payment_method:$('#form-end #payment_method').val(),
					app_name:$('#form-end #app_name').val(),
					app_description:$('#form-end #app_description').val(),
					app_icon_path:$('#form-end #app_icon_path').val(),
					app_bg_path:$('#form-end #app_bg_path').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep();
				},
				success: function(response) {
					if(response.result){
						successstep();
					} else {
						errorstep();
					}

				}
			});
		}
	});
	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>Piche o arraste aqu&iacute; la imagen <br/>a subir',
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
					alert("Ha ocurrido un error al subir el archivo");
				}else{
					$('#'+result.preview).attr("src",result.filename);
					$('#form-end #'+result.label).val(result.path);
					alert(result.path);
				}
			}
		});
	});


});
