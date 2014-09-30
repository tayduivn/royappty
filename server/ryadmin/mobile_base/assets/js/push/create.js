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