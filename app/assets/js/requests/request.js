/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/requests/get_request.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_request:$GET["id_request"]
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


function delete_request(id_request){
	filter_str="id_request||=||"+id_request;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"requests",
			filter_str:filter_str
		},
		error: function(data, textStatus, jqXHR) {
			$('.modal').modal('hide');
			$('#ajax_error').modal('show');
			$('#ajax_error .msg-modal').html(jqXHR);
		},
		success: function(response) {
			if(response.status){
				show_modal("deleted_request_success_alert","javascript:window.location=\"../requests/\"");
            }else{

			}

		}
	});
}
