$(document).ready(function() {


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
					},
					error: function(data, textStatus, jqXHR) {
						alert(data+" "+textStatus+" "+jqXHR)
						error_handler("ajax_error");
					},
					success: function(response) {
						if(response.result){
							jQuery.each(response.data,function(key,value){
								localStorage.setItem(key, value);
							});
						} else {
							error_handler(response.error_code);
						}

					}
				});
				for( var key in localStorage){
					$(".ajax-loader-"+key).html(localStorage.getItem(key));
				}
				$("#form-wizard form").submit(function(e){
						e.preventDefault();
				});
		}
		setInterval(update, 60000);
	}


});

function validate_promo(campaign){
	$.ajax({
		type: "POST",
		dataType: 'json',
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