
if ((typeof localStorage.getItem('id_user') == 'undefined') || (localStorage.getItem('id_user') == null)) {
	error_handler("no_user");
}else{
		$SESSION_STATUS=false;
	$SESSION=localStorage.getItem('id_user');
	console.log("[server/mobile/ajax/session/create.php] Call Start");
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
			console.log("[server/mobile/ajax/session/create.php] Ajax Error : "+jqXHR);
			error_handler("ajax_error");
		},
		success: function(response) {
			console.log("[server/mobile/ajax/session/create.php] Ajax Success");
			if(response.result){
				update();
			} else {
				error_handler(response.error_code);
			}

		}
	});
}
