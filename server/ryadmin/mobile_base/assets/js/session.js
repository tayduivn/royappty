
if ((typeof localStorage.getItem('id_user') == 'undefined') || (localStorage.getItem('id_user') == null)) {
	error_handler("no_user");
}else{
	$SESSION=localStorage.getItem('id_user');
	$.ajax({
		async:false,
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/mobile/ajax/session/create.php",
		data: {
			id_user:$SESSION,
			id_brand:$BRAND
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
}
