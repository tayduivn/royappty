/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/brands/ios/get_ios.php",
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

				$("form").submit(function(e){
					e.preventDefault();
				});

			} else {
				error_handler(response.error_code);
			}

		}
	});
	$('.droparea').each(function(){
		$(this).droparea({
			'instructions': '<br/><br/><h2><i class="fa fa-upload"></h2></i>'+$s["ios_app_click_or_drag_certificate_here"],
			'init' : function(result){},
			'start' : function(area){
				$('.result_box').css("display","none");
				area.find('.error').remove();
			},
			'error' : function(result, input, area){
				$('<div class="error">').html(result.error).prependTo(area);
				return 0;
			},
			'complete' : function(result, file, input, area){
				if(result.error){
					alert($s["ios_app_an_error_occurred_when_uploading_the_file"]);
				}else{
					$('#'+result.id_result_box).html(result.result_box_html);
					$('#'+result.id_result_box).css("display","block");
				}
			}
		});
	});
});
function generate_ios_app(){
	$("#generate_ios_app_terminal").html("<pre style='color:#666'><span style='color:purple'>[iOs Generator 1.0.0]</span> Connecting to Server<span class='pull-right'>[<span style='color:black'>START</span>]</span></pre>");
	$("#generate_ios_app_terminal_bar .progress-bar").css("width","0%");
	$("#generate_ios_app_terminal_bar").removeClass("progress-completed");
	call_step(1,9);

}
function call_step(step,stop_step){
	$.ajax({
		async: true,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/brands/ios/generate_step_"+step+".php",
		data: {
			lang: localStorage.getItem("lang"),
			id_brand:$GET["id_brand"]
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {

			if(response.result){
				$("#generate_ios_app_terminal").prepend(response.data);
				bar_status=((step+1)/stop_step)*100;
				$("#generate_ios_app_terminal_bar .progress-bar").css("width",bar_status+"%");
				if(step<stop_step){
					call_step(step+1,stop_step);
				}else{
					$("#generate_ios_app_terminal_bar").addClass("progress-completed");
				}
			} else {
				error_handler(response.error_code);
			}

		}
	});
}
function update_brand(id_brand,field_data,data_value){
	filter_str="id_brand||=||"+id_brand;
	data_str=field_data+"||"+data_value;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $PATH+"../server/ryadmin/ajax/indb/actions.php",
		data: {
			func:"update",
			table:"brands",
			filter_str:filter_str,
			data_str:data_str,
			callback_options_str:"id_brand="+$GET["id_brand"]
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.status){
				for (i in response.action){
					if(response.action[i]=="header"){
						window.location=response.actions[i].header;
					}else if(response.action[i]=="reload"){
						for (j in response.actions[i].reload){
							$("."+response.actions[i].reload[j].obj_class).html(response.actions[i].reload[j].obj_value);
						}
					}else if(response.action[i]=="prepend"){
						for (j in response.actions[i].prepend){
							$("."+response.actions[i].prepend[j].obj_class).prepend(response.actions[i].prepend[j].obj_value);
						}
					}else if(response.action[i]=="fadeout"){
						for (j in response.actions[i].fadeout){
							$("."+response.actions[i].fadeout[j].obj_class).slideUp('fast',function(){$(this).remove()});
						}
					}else if(response.action[i]=="fadein"){
						for (j in response.actions[i].fadein){
							$("."+response.actions[i].fadein[j].obj_class).slideDown('fast');
						}
					}
				}
			}else{
				error_handler(response.error_code);
			}
		}
	});
}
