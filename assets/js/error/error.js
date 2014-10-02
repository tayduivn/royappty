/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function(){

	$("#s-error-title").html($error_s["server_connection_title"]);
	$("#s-error-content").html($error_s["server_connection_content"]);
	$("#s-back").html($s["back"]);

	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/www/ajax/error/error.php",
		data: {
				lang: localStorage.getItem("lang"),
				error_code:$GET["error_code"]
		},
		error: function(data, textStatus, jqXHR) {
			$("#s-error-title").html($error_s["ajax_error_title"]);
			$("#s-error-content").html($error_s["ajax_error_content"]);
			$("#s-back").html($s["back"]);
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			}
		}
	});
});
