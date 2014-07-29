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
		url: $SERVER_PATH+"server/app/ajax/accounts/data/edit/data.php",
		data: {
			lang: localStorage.getItem("lang")
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
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
			name:{
				required: $s["data_edit_name_this_field_is_compulsory"],
				maxlength: $s["data_edit_name_it_canot_be_longer_than_75_characters"],
				minlength: $s["data_edit_name_this_field_needs_4_character_minimum"]
			}
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
			$('#form-end #cif').val($('#form-step1 #cif').val());
			$('#form-end #contact_name').val($('#form-step1 #contact_name').val());
			$('#form-end #contact_email').val($('#form-step1 #contact_email').val());
			$('#form-end #contact_phone').val($('#form-step1 #contact_phone').val());
			$('#form-end #contact_address').val($('#form-step1 #contact_address').val());
			$('#form-end #contact_postal_code').val($('#form-step1 #contact_postal_code').val());
			$('#form-end #contact_city').val($('#form-step1 #contact_city').val());
			$('#form-end #contact_country').val($('#form-step1 #contact_country').val());
			$.ajax({
				async: false,
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/accounts/data/edit/update_data.php",
				data: {
					name:$('#form-end #name').val(),
					cif:$('#form-end #cif').val(),
					contact_name:$('#form-end #contact_name').val(),
					contact_email:$('#form-end #contact_email').val(),
					contact_phone:$('#form-end #contact_phone').val(),
					contact_address:$('#form-end #contact_address').val(),
					contact_postal_code:$('#form-end #contact_postal_code').val(),
					contact_city:$('#form-end #contact_city').val(),
					contact_country:$('#form-end #contact_country').val()

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
