$.ajax({
	async:false,
	dataType: 'json',
	url: $PATH+"data/brand.json",
	data: {
	},
	error: function(data, textStatus, jqXHR) {
		error_handler("no_brand");
	},
	success: function(response) {
		if(response.result){
			localStorage.setItem('brand',response.data.id_brand);
			$BRAND=response.data.id_brand;
			if (typeof localStorage.getItem('id_user') == 'undefined') {
				error_handler("no_user");
			}else{
				$SESSION=localStorage.getItem('id_user');
				$.ajax({
					crossDomain: true,
					async:false,
					type: "POST",
					dataType: 'json',
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
		} else {
			error_handler("no_brand");
		}

	}
});
