$(document).ready(function(){
	localStorage.removeItem('id_brand');
	localStorage.removeItem('id_admin');
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/lock.php",
		data: {
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
				// No error Handeler
			}
		}
	});
});
