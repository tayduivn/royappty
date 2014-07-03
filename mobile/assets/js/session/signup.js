$(document).ready(function() {
	
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/mobile/ajax/session/signup.php",
		data: {
			id_brand:$BRAND
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
function signup(){
	input_str="";
	and="";
	$(".form-control").each(function(){
		input_str=input_str+and+$(this).attr("id")+"="+$(this).val();
		and="&";
	});
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/mobile/ajax/session/signin.php",
		data: {
			id_brand:$BRAND
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
				$.ajax({
					async: false,
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/mobile/ajax/users/add_user.php",
					data: {
						id_brand:$BRAND,
						signup_data:input_str
					},
					error: function(data, textStatus, jqXHR) {
						error_handeler("sign_up_error");
					},
					success: function(response) {
						if(response.result){
							localStorage.setItem('id_user', response.data.id_user);
							window.location.href = "./index.html";
						} else {
							error_handeler(response.error_code);
						}
							
					}
				});
				
				
				
			} else {
				error_handeler(response.error_code);
			}
				
		}
	});
}
