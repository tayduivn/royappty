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
		url: $SERVER_PATH+"server/app/ajax/apps/edit/app.php",
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
			$('#form-end #app_icon_path').val($('#app_icon_path-preview').attr("src"));
		 	nextstep();
		}
	});
	$("#form-step3").validate({
		messages:{
		},
		rules:{
		},
		submitHandler:function(form){
			$('#form-end #app_bg_path').val($('#app_bg_path-preview').attr("src"));
		 	nextstep();
		}
	});
	$("#form-step4").validate({
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
			$('#form-end #published_apple_store').val("0");
			if($('#form-step4 #published_apple_store').attr('checked')){
				$('#form-end #published_apple_store').val("1");
			}
			$('#form-end #published_google_play').val("0");
			if($('#form-step4 #published_google_play').attr('checked')){
				$('#form-end #published_google_play').val("1");
			}

			var brand_user_fields= "";
			var separator= "";
			$(".user_field_checkbox").each(function(){
				if($(this).attr('checked')){
					brand_user_fields=brand_user_fields+separator+$(this).attr('id');
					separator="::";
				}
			});

		 	$('#form-end #brand_user_fields').val(brand_user_fields);

			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/apps/edit/update_app.php",
				data: {
					"name":$('#form-end #name').val(),
					"description":$('#form-end #description').val(),
					"app_icon_path":$('#form-end #app_icon_path').val(),
					"app_bg_path":$('#form-end #app_bg_path').val(),
					"published_apple_store":$('#form-end #published_apple_store').val(),
					"published_google_play":$('#form-end #published_google_play').val(),
					"brand_user_fields":$('#form-end #brand_user_fields').val()
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

	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["edit_click_or_drag_image_here"]+'<br/>'+$s["edit_to upload"],
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
					alert($s["edit_an_error_occurred_when_downloading_the_file"]);
				}else{
					$('#'+result.preview).attr("src",result.filename);
				}
			}
		});
	});


});
