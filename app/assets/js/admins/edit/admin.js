$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/admins/edit/admin.php",
		data: {
			id_admin:$GET["id_admin"]
		},
		error: function(data, textStatus, jqXHR) {
			$(".modal").modal("hide");
			$("#ajax_error").modal("show");
			if(jqXHR!=""){
				$("#ajax_error .modal-msg").html(jqXHR);
			}
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});

			} else {
				error_handeler(response.error_code);
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
		},
		rules:{
			name:{
		  		required:true,
			  	maxlength: 75,
			  	minlength: 4
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
				url: $SERVER_PATH+"server/app/ajax/admins/edit/update_admin.php",
				data: {
					"id_admin":$('#form-end #id_admin').val(),
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
					$(".modal").modal("hide");
					$("#ajax_error").modal("show");
					if(jqXHR!=""){
						$("#ajax_error .modal-msg").html(jqXHR);
					}
					errorstep();
				},
				success: function(response) {
					if(response.result){
						successstep();
						$("#admin-link").attr("href","../../admin/?id_admin="+response.data);
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
				}
			}
		});
	});


});
