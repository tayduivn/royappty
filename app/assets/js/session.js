/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

function logout(){
	localStorage.removeItem('id_brand');
	localStorage.removeItem('id_admin');
	window.location.href = $PATH;
}




if ((typeof localStorage.getItem('id_brand') == 'undefined')||(localStorage.getItem('id_brand') == null)){
	error_handeler("no_brand");
}else{
	$BRAND=localStorage.getItem('id_brand');
	if ((typeof localStorage.getItem('id_admin') == 'undefined')||(localStorage.getItem('id_admin') == 'null')) {
		error_handeler("no_admin");
	}else{
		$SESSION=localStorage.getItem('id_admin');
		$.ajax({
			async:false,
			type: "POST",
			dataType: 'json',
			url: $SERVER_PATH+"server/app/ajax/session/create.php",
			data: {
				id_admin:$SESSION,
				id_brand:$BRAND
			},
			error: function(data, textStatus, jqXHR) {
				error_handeler("ajax_error");
			},
			success: function(response) {
				if(response.result){
				} else {
					error_handeler(response.error_code);
				}
			}
		});
		$(document).ready(function() {
			$.ajax({
				async: false,
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/general/get_menu.php",
				data: {
					path:$PATH
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
	}
}
