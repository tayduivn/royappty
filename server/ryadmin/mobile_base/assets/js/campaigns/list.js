function update(){
	if(page_selected=="index"){
		$.ajax({
			async: false,
			type: "GET",
			dataType: 'jsonp',
			jsonp: 'callback',
			jsonpCallback: 'jsonCallback',
			contentType: 'application/json',
			url: $SERVER_PATH+"server/mobile/ajax/campaigns/all_data.php",
			data: {
				id_user:$SESSION,
				lang:"es"
			},
			error: function(data, textStatus, jqXHR) {
				error_handler("ajax_error");
			},
			success: function(response) {
				console.log("[server/mobile/ajax/campaigns/all_data.php] Ajax Success");
				if(response.result){
					console.log("[server/mobile/ajax/campaigns/all_data.php] Responde Result true");
					jQuery.each(response.data,function(key,value){
						console.log("[server/mobile/ajax/campaigns/all_data.php] Update data: "+key);
						localStorage.removeItem(key);
						localStorage.setItem(key, value);
					});
				} else {
					error_handler(response.error_code);
				}
			}
		});
		for( var key in localStorage){
			console.log("[server/mobile/ajax/campaigns/all_data.php] Update loader: "+key);
			$(".ajax-loader-"+key).html(localStorage.getItem(key));
		}
		$("#form-wizard form").submit(function(e){
			e.preventDefault();
		});
	}
	setInterval(update, 1000);

}


function validate_promo(campaign){
	$.ajax({
		async: false,
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/mobile/ajax/campaigns/add_used_code.php",
		data: {
			"promo_password":$('#'+campaign+"-promo-password").val(),
			"id_campaign":campaign,
			"code":$('#'+campaign+"-code").val()
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax-error");
		},
		success: function(response) {
			if(response.result){
				transition_left("validate-"+campaign+"-2","validate-"+campaign+"-success");
			} else {
				transition_left("validate-"+campaign+"-2","validate-"+campaign+"-error");
			}
		}
	});
}
