
$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/requests/get_request.php",
		data: {
			id_request:$GET["id_request"]
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
		error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.status){
				show_modal("deleted_request_success_alert","javascript:window.location=\"../requests/\"");
            }else{
							error_handeler(response.error_code);
			}

		}
	});
}
