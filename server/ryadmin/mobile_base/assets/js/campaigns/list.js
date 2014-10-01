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
				id_user:localStorage.getItem('id_user'),
				phone_key:localStorage.getItem("phone_key"),
				platform:localStorage.getItem("platform"),
				lang:"es"
			},
			error: function(data, textStatus, jqXHR) {
				//error_handler("ajax_error");
				alert(data+" "+textStatus+" "+jqXHR);
			},
			success: function(response) {
				if(response.result){
					jQuery.each(response.data,function(key,value){
						localStorage.removeItem(key);
						localStorage.setItem(key, value);
					});
					for( var key in localStorage){
						$(".ajax-loader-"+key).html(localStorage.getItem(key));
					}
					$("#form-wizard form").submit(function(e){
						e.preventDefault();
					});
				} else {
					error_handler(response.error_code);
				}
			}
		});
		
	}
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
