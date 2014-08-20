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
		url: $SERVER_PATH+"server/ryadmin/ajax/brands/edit/brand.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_brand:$GET["id_brand"]
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
	function errorstep(error_code_str){
		$("#form-wizard #step-"+current_step).css("display","none");
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
			$('#form-end #name').val($('#form-step1 #name').val());
			$('#form-end #cif').val($('#form-step1 #cif').val());
			$('#form-end #active').val($('#form-step1 #active').val());
			$('#form-end #created').val($('#form-step1 #created').val());
			$('#form-end #android_key').val($('#form-step1 #android_key').val());
			$('#form-end #resume_block_1_display').val(0);if($('#form-step1 #resume_block_1_display').is(":checked")){$('#form-end #resume_block_1_display').val(1);}
			$('#form-end #resume_block_1_title').val($('#form-step1 #resume_block_1_title').val());
			$('#form-end #resume_block_2_display').val(0);if($('#form-step1 #resume_block_2_display').is(":checked")){$('#form-end #resume_block_2_display').val(1);}
			$('#form-end #resume_block_2_title').val($('#form-step1 #resume_block_2_title').val());
			$('#form-end #resume_block_3_display').val(0);if($('#form-step1 #resume_block_3_display').is(":checked")){$('#form-end #resume_block_3_display').val(1);}
			$('#form-end #resume_block_3_title').val($('#form-step1 #resume_block_3_title').val());
			$('#form-end #resume_block_4_display').val(0);if($('#form-step1 #resume_block_4_display').is(":checked")){$('#form-end #resume_block_4_display').val(1);}
			$('#form-end #resume_block_4_title').val($('#form-step1 #resume_block_4_title').val());
			$('#form-end #subscription_type').val($('#form-step1 #subscription_type').val());
			$('#form-end #contact_name').val($('#form-step1 #contact_name').val());
			$('#form-end #contact_email').val($('#form-step1 #contact_email').val());
			$('#form-end #contact_phone').val($('#form-step1 #contact_phone').val());
			$('#form-end #contact_address').val($('#form-step1 #contact_address').val());
			$('#form-end #contact_postal_code').val($('#form-step1 #contact_postal_code').val());
			$('#form-end #contact_city').val($('#form-step1 #contact_city').val());
			$('#form-end #contact_province').val($('#form-step1 #contact_province').val());
			$('#form-end #contact_country').val($('#form-step1 #contact_country').val());
			$('#form-end #payment_plan').val($('#form-step1 #payment_plan').val());
			$('#form-end #payment_method').val($('#form-step1 #payment_method').val());
			$('#form-end #payment_data').val($('#form-step1 #payment_data').val());
			$('#form-end #expiration_date').val($('#form-step1 #expiration_date').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/ryadmin/ajax/brands/edit/update_brand.php",
				data: {
					"id_brand":$("#form-end #id_brand").val(),
					"name":$("#form-end #name").val(),
					"cif":$("#form-end #cif").val(),
					"active":$("#form-end #active").val(),
					"created":$("#form-end #created").val(),
					"android_key":$("#form-end #android_key").val(),
					"resume_block_1_display":$("#form-end #resume_block_1_display").val(),
					"resume_block_1_title":$("#form-end #resume_block_1_title").val(),
					"resume_block_2_display":$("#form-end #resume_block_2_display").val(),
					"resume_block_2_title":$("#form-end #resume_block_2_title").val(),
					"resume_block_3_display":$("#form-end #resume_block_3_display").val(),
					"resume_block_3_title":$("#form-end #resume_block_3_title").val(),
					"resume_block_4_display":$("#form-end #resume_block_4_display").val(),
					"resume_block_4_title":$("#form-end #resume_block_4_title").val(),
					"subscription_type":$("#form-end #subscription_type").val(),
					"contact_name":$("#form-end #contact_name").val(),
					"contact_email":$("#form-end #contact_email").val(),
					"contact_phone":$("#form-end #contact_phone").val(),
					"contact_address":$("#form-end #contact_address").val(),
					"contact_postal_code":$("#form-end #contact_postal_code").val(),
					"contact_city":$("#form-end #contact_city").val(),
					"contact_province":$("#form-end #contact_province").val(),
					"contact_country":$("#form-end #contact_country").val(),
					"payment_plan":$("#form-end #payment_plan").val(),
					"payment_method":$("#form-end #payment_method").val(),
					"payment_data":$("#form-end #payment_data").val(),
					"expiration_date":$("#form-end #expiration_date").val()
				},
				error: function(data, textStatus, jqXHR) {
				errorstep("ajax_error");
				},
				success: function(response) {
					if(response.result){
						successstep();
						$("#brand-link").attr("href","../../brand/?id_brand="+response.data);
					} else {
						errorstep(response.error_code_str);
					}

				}
			});
		}
	});

	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["edit_brand_click_or_drag_image_here"]+'<br/>'+$s["edit_brand_to upload"] ,
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
					alert($s["edit_brand_an_error_occurred_when_downloading_the_file"]);
				}else{
					$('#'+result.preview).attr("src",result.filename);
				}
			}
		});
	});


});
