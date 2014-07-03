$.ajax({
	async:false,
	dataType: 'json',
	url: $PATH+"data/session.json",
	data: {
	},
	error: function(data, textStatus, jqXHR) {
		if(jqXHR!=""){
			//window.location.href = $PATH+"login/";
		}
	},
	success: function(response) {
		if(response.result){
			$SESSION=response.data.id_user;
			$.ajax({
				async:false,
				dataType: 'json',
				url: $PATH+"data/brand.json",
				data: {
				},
				error: function(data, textStatus, jqXHR) {
					window.location.href = $PATH+"error/fatal_error.html";
				},
				success: function(response) {
					if(response.result){
						$BRAND=response.data.id_brand;
						$.ajax({
							async:false,
							type: "POST",
							dataType: 'json',
							url: $SERVER_PATH+"server/mobile/ajax/session/create.php",
							data: {
								id_user:$SESSION,
								id_brand:$BRAND
							},
							error: function(data, textStatus, jqXHR) {
								//window.location.href = $PATH+"error/user_not_valid.html";
								alert(jqXHR);
							},
							success: function(response) {
								if(response.result){
								} else {
								//	window.location.href = $PATH+"error/user_not_valid.html";
						
								}
									
							}
						});
					} else {
						window.location.href = $PATH+"error/fatal_error.html";
					}
				}
			});

		} else {
			window.location.href = $PATH+"login/";
		}
			
	}
});
