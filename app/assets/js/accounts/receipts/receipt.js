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
		url: $SERVER_PATH+"server/app/ajax/accounts/receipts/get_receipt.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_receipt:$GET["id_receipt"]
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
