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
		url: $SERVER_PATH+"server/app/ajax/campaigns/edit/coupon.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_campaign:$GET["id_campaign"]
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
	$('.input-append.date').datepicker({
		autoclose: true,
		todayHighlight: true
	});
	 $('.timepicker-24').timepicker({
	 	showMeridian: false
     });



	$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});




	$("#form-step1").validate({
		messages:{
			name:{
				required: $s["edit_coupon_name_this_field_is_compulsory"],
				maxlength: $s["edit_coupon_name_it_canot_be_longer_than_75_characters"],
				minlength: $s["edit_coupon_name_this_field_needs_4_character_minimum"]
			},
			description:{
				required: $s["edit_coupon_description_this_field_is_compulsory"],
				minlength: $s["edit_coupon_description_this_field_needs_4_character_minimum"]
			}
		},
		rules:{
			name:{
		  		required:true,
			  	maxlength: 75,
			  	minlength: 4
		  	},
				description:{
					required:true,
					minlength: 4
				}
		},
		submitHandler:function(form){
			$('#form-end #name').val($('#form-step1 #name').val());
		 	$('#form-end #description').val($('#form-step1 #description').val());
		 	nextstep();
		}
	});
	$("#form-step2").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
		 	nextstep();
		}
	});
	$("#form-step3").validate({
		messages:{
			title:{
				required: $s["edit_coupon_title_this_field_is_compulsory"],
				maxlength: $s["edit_coupon_title_it_canot_be_longer_than_20_characters"],
				minlength: $s["edit_coupon_title_this_field_needs_4_character_minimum"]
			},
			button_title:{
				required: $s["edit_coupon_button_title_this_field_is_compulsory"],
				maxlength: $s["edit_coupon_button_title_it_canot_be_longer_than_20_characters"],
				minlength: $s["edit_coupon_button_title_this_field_needs_4_character_minimum"]
			}
		},
		rules:{
			title:{
					required:true,
					maxlength: 20,
					minlength: 4
				},
				button_title:{
					required:true,
					maxlength: 20,
					minlength: 4
				}
		},
		submitHandler:function(form){
			$('#form-end #title').val($('#form-step3 #title').val());
			$('#form-end #content').val($('#form-step3 #content').val());
			$('#form-end #button_title').val($('#form-step3 #button_title').val());
		 	nextstep();
		}
	});
	$("#form-step4").validate({
		messages:{
			coupons_number:{
				required: $s["edit_coupon_number_this_field_is_compulsory"],
				min: $s["edit_coupon_number_this_field_needs_1_coupon_minimum"],
				digits: $s["edit_coupon_this_field_requires_numbers_only"]
			},
			usage_limit:{
				digits: $s["edit_coupon_this_field_requires_numbers_only"]
			},
			cost:{
				number: $s["edit_coupon_this_field_requires_numbers_only"]
			},
			profit:{
				number: $s["edit_coupon_this_field_requires_numbers_only"]
			}
		},
		rules:{
			coupons_number:{
				required:true,
				min: 1,
				digits: true
			},
			usage_limit:{
				digits: true
			},
			cost:{
				number: true
			},
			profit:{
				number: true
			}
		},
		submitHandler:function(form){
			$('#form-end #coupons_number').val($('#form-step4 #coupons_number').val());
			$('#form-end #usage_limit').val($('#form-step4 #usage_limit').val());
			$('#form-end #cost').val($('#form-step4 #cost').val());
			$('#form-end #profit').val($('#form-step4 #profit').val());
			$('#form-end #status').val($('#form-step4 #status').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/campaigns/edit/update_coupon.php",
				data: {
					"id_campaign":$GET["id_campaign"],
					"name":$('#form-end #name').val(),
					"description":$('#form-end #description').val(),
					"type":1,
					"status":1,
					"campaign_icon_path":$('#form-end #campaign_icon_path').val(),
					"title":$('#form-end #title').val(),
					"campaign_image_path":$('#form-end #campaign_image_path').val(),
					"content":$('#form-end #content').val(),
					"button_title":$('#form-end #button_title').val(),
					"coupons_number":$('#form-end #coupons_number').val(),
					"usage_limit":$('#form-end #usage_limit').val(),
					"cost":$('#form-end #cost').val(),
					"profit":$('#form-end #profit').val(),
					"status":$('#form-end #status').val()
				},
				error: function(data, textStatus, jqXHR) {
					errorstep("ajax error");
				},
				success: function(response) {
					if(response.result){
						successstep();
						$("#campaign-link").attr("href","../../../campaign/?id_campaign="+response.data);
					} else {
						errorstep(response.error_code_str);
					}

				}
			});
		}
	});

	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["edit_coupon_click_or_drag_image_here"]+'<br/>'+$s["edit_coupon_to upload"],
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
					alert($s["edit_coupon_an_error_occurred_when_downloading_the_file"]);
				}else{
					$('#'+result.preview).attr("src",result.filename);
					$('#form-end #'+result.label).val(result.path);
				}
			}
		});
	});


});
