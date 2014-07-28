$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/mobile/ajax/campaigns/all_data.php",
		data: {
			"id_campaign":$GET["id_campaign"]
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
				$("#ajax_error .modal-msg").html(response.error);
				show_modal("ajax_error","");
			}
				
		}
	});
});

function validate_promo(campaign){
	alert(campaign);
}

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
		$("#form-wizard #form-error").css("display","none");
		$("#form-wizard #step-"+current_step).css("display","block");
	}
	function loadingstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		current_step+=1;
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-error").css("display","none");
		$("#form-wizard #form-success").css("display","block");
	}
	function errorstep(){
		current_step+=1;
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
			
		},
		submitHandler:function(form){
			nextstep();
		}
	});

	
	$("#form-step2").validate({
		messages:{
		},
		rules:{
			
		},
		submitHandler:function(form){
			
			$('#form-end #promo_code').val($('#form-step2 #promo_code').val());
			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/mobile/ajax/campaigns/add_used_code.php",
				data: {
					"promo_password":$('#form-end #promo_code').val(),
					"id_campaign":$GET["id_campaign"]
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
					} else {
						$('#form-step2 #promo_code').val("");
						errorstep();
					}
						
				}
			});
		}
	});
	
});

