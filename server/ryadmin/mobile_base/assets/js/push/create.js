var pushNotification;
function onDeviceReady() {
	try{
		pushNotification = window.plugins.pushNotification;
  	  if (device.platform == 'android' || device.platform == 'Android' || device.platform == 'amazon-fireos' ){
	  	  	localStorage.setItem("platform", "android");
   		 	pushNotification.register(successHandler, errorHandler, {"senderID": $android_senderID ,"ecb":"onNotification"});
		}else{
			localStorage.setItem("platform", "ios");
  			pushNotification.register(tokenHandler, errorHandler, {"badge":"true","sound":"true","alert":"true","ecb":"onNotificationAPN"});
		}
	}catch(err){
	}
}
function tokenHandler (result) {
	localStorage.setItem("phone_key", result);
	check_user();
}
			
function successHandler (result) {
}
            
function errorHandler (error) {
}

function onNotificationAPN(e){
	
}
function onNotification(e){
	switch( e.event ){
		case 'registered':
			if ( e.regid.length > 0 ){
				localStorage.setItem("phone_key", e.regid);
				check_user();
			}
		break;
		case 'message':
			if (e.foreground){
				navigator.notification.alert(e.payload.message, null,"Royappty");
			}else{
				//alert(e.payload.message);
			}
		break;
		default:
		break;
	}
}
document.addEventListener('deviceready', onDeviceReady, true);

function check_user(){
	if ((typeof localStorage.getItem('id_user') == 'undefined') || (localStorage.getItem('id_user') == null)) {
		$.ajax({
			async:false,
			type: "GET",
			dataType: 'jsonp',
			jsonp: 'callback',
			jsonpCallback: 'jsonCallback',
			contentType: 'application/json',
			url: $SERVER_PATH+"server/mobile/ajax/session/signup_key.php",
			data: {
				phone_key:localStorage.getItem("phone_key"),
				id_brand:localStorage.getItem('id_brand')
			},
			error: function(data, textStatus, jqXHR) {
				error_handler("ajax_error");
			},
			success: function(response) {
				if(response.result){
					localStorage.setItem('id_user', response.data);
					update();
				} else {
					error_handler("no_user");
				}
	
			}
		});
	
	}else{
		alert("The local id_user= "+localStorage.getItem('id_user'));
		$.ajax({
			async:false,
			type: "GET",
			dataType: 'jsonp',
			jsonp: 'callback',
			jsonpCallback: 'jsonCallback',
			contentType: 'application/json',
			url: $SERVER_PATH+"server/mobile/ajax/session/create.php",
			data: {
				id_user:localStorage.getItem('id_user'),
				id_brand:$BRAND
			},
			error: function(data, textStatus, jqXHR) {
				error_handler("ajax_error");
			},
			success: function(response) {
				if(response.result){
					update();
				} else {
					error_handler(response.error_code);
				}
	
			}
		});
	}
}
