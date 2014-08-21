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
		url: $SERVER_PATH+"server/ryadmin/ajax/brands/android/get_android.php",
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

				$("#android_project_number_form").validate({
					messages:{

					},
					rules:{

					},
					submitHandler:function(form){
						update_brand($GET["id_brand"],"android_project_number",$("#android_project_number").val());
					}
				});
				$("#android_server_key_form").validate({
					messages:{

					},
					rules:{

					},
					submitHandler:function(form){
						update_brand($GET["id_brand"],"android_server_key",$("#android_server_key").val());
					}
				});

			} else {
				error_handler(response.error_code);
			}

		}
	});
});

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
