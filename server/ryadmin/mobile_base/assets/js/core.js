(function (){
  window.$GET = [];
  if(location.search){
    var params = decodeURIComponent(location.search).match(/[a-z_]\w*(?:=[^&]*)?/gi);
    if(params){
      var pm, i = 0;
      for(; i < params.length; i++){
        pm = params[i].split('=');
        $GET[pm[0]] = pm[1] || '';
      }
    }
  }
})();

var page_selected="index";

var pushNotification;
function onDeviceReady() {
}
function onNotificationAPN(e) {

}
function onNotification(e) {

}
function tokenHandler (result) {

}

function successHandler (result) {

}

function errorHandler (error) {

}
function alertDismissed() {
	// do something
}
function signupDismissed() {
	window.location.href = "./index.html";
}

document.addEventListener('deviceready', onDeviceReady, true);
