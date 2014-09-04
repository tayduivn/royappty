var pushNotification;
function onDeviceReady() {
	try{
		pushNotification = window.plugins.pushNotification;
  	  if (device.platform == 'android' || device.platform == 'Android' || device.platform == 'amazon-fireos' ){
   		 	pushNotification.register(successHandler, errorHandler, {"senderID": $android_senderID ,"ecb":"onNotification"});
		}else{
    		pushNotification.register(tokenHandler, errorHandler, {"badge":"true","sound":"true","alert":"true","ecb":"onNotificationAPN"});
		}
	}catch(err){
		error_handler("notification_error");
	}
}
function onNotificationAPN(e){
	if(e.alert){
    	navigator.notification.alert(e.alert);
	}
}
function onNotification(e){
	switch( e.event ){
		case 'registered':
			if ( e.regid.length > 0 ){
				localStorage.setItem("android_key", e.regid);
			}
		break;
		case 'message':
			if (e.foreground){
				navigator.notification.alert(e.payload.message, null,"Royappty");
			}else{
				alert(e.payload.message);
			}
		break;
		default:
		break;
	}
}
document.addEventListener('deviceready', onDeviceReady, true);