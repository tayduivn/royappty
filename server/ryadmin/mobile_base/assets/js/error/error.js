$(document).ready(function() {
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/mobile/ajax/error/error.php",
		data: {
			error_code:$GET["error_code"]
		},
		error: function(data, textStatus, jqXHR) {
			window.location.href = $PATH+"error/base.html";
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			} else {
				window.location.href = $PATH+"error/base.html";
			}
				
		}
	});
	

});