/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 09-07-2014
* Version: 0.92
*
*********************************************************/

/*********************************************************
* AJAX RETURNS
*
* ERROR CODES
*
*********************************************************/

$(document).ready(function(){

	/*********************************************************
	* AJAX CALL LOAD PAGE
	*********************************************************/

	$("#s-error-title").html($error_s["server_connection_title"]);
	$("#s-error-content").html($error_s["server_connection_content"]);
	$("#s-back").html($s["back"]);

	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/error/error.php",
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
