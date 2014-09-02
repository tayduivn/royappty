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
			id_brand:$BRAND
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

alert("loade");
function signup(){
	alert("calling");
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
			signup_data:input_str
		},
		error: function(data, textStatus, jqXHR) {
			alert("adduser:"+data+" - "+textStatus+" - "+jqXHR);
			error_handler("sign_up_error");
		},
		success: function(response) {
			if(response.result){
				localStorage.setItem('id_user', response.data.id_user);
				alert("User stored = "+localStorage.getItem("id_user"));
				window.location.href = "../";
			} else {
				error_handler(response.error_code);
			}

		}
	});
}
