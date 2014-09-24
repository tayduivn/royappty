/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

function logout(){
	localStorage.removeItem('id_ryadmin');
	window.location.href = $PATH;
}


	if ((typeof localStorage.getItem('id_ryadmin') == 'undefined')||(localStorage.getItem('id_ryadmin') == 'null')) {
		error_handler("no_ryadmin");
	}else{
		$SESSION=localStorage.getItem('id_ryadmin');
		$.ajax({
			async:false,
			type: "POST",
			dataType: 'json',
			url: $SERVER_PATH+"server/ryadmin/ajax/session/create.php",
			data: {
				id_ryadmin:$SESSION
			},
			error: function(data, textStatus, jqXHR) {
				error_handler("ajax_error");
			},
			success: function(response) {
				if(response.result){
				} else {
					error_handler(response.error_code);
				}
			}
		});
		$(document).ready(function() {
			$.ajax({
				async: false,
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/ryadmin/ajax/general/get_menu.php",
				data: {
					path:$PATH,
					lang: localStorage.getItem("lang")
				},
				error: function(data, textStatus, jqXHR) {
					error_handler("ajax_error");
				},
				success: function(response) {
					if(response.result){
						jQuery.each(response.data,function(key,value){
							$(".ajax-loader-"+key).html(value);
						});
					} else {
						error_handler(response.error_code);
					}
				}
			});
		});
	}
