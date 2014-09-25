$(document).ready(function() {
	$.ajax({
		async: false,
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/mobile/ajax/session/signup.php",
		data: {
			id_brand:$BRAND,
			lang:"es"
		},
		error: function(data, textStatus, jqXHR) {
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
				$("form").submit(function(e){
					e.preventDefault();
					signup();
				});
			} else {
				error_handler(response.error_code);
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
		type: "GET",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/mobile/ajax/users/add_user.php",
		data: {
			id_brand:$BRAND,
			android_key:localStorage.getItem("android_key"),
			signup_data:input_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("sign_up_error");
		},
		success: function(response) {
			if(response.result){
				localStorage.setItem('id_user', response.data.id_user);
				alert("Gracias por darte de alta en nuestro sistema ahora podr&aacute;s acceder a todas nuestras promociones y descuentos");
				window.location.href = "./index.html";
			} else {
				error_handler(response.error_code);
			}

		}
	});
}
