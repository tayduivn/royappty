//request.open('GET', 'http://www.royappty.com/', true);
//Server Path for WEB
//var $SERVER_PATH = $PATH+"../";
//Server Path for App
var $SERVER_PATH = "http://www.royappty.com/";

function loadjscssfile(filename, filetype){
 if (filetype=="js"){ //if filename is a external JavaScript file
  var fileref=document.createElement('script')
  fileref.setAttribute("type","text/javascript")
  fileref.setAttribute("src", filename)
 }
 else if (filetype=="css"){ //if filename is an external CSS file
  var fileref=document.createElement("link")
  fileref.setAttribute("rel", "stylesheet")
  fileref.setAttribute("type", "text/css")
  fileref.setAttribute("href", filename)
 }
 if (typeof fileref!="undefined")
  document.getElementsByTagName("head")[0].appendChild(fileref)
}

loadjscssfile($SERVER_PATH+"server/mobile/assets/css/server_style.css", "css");


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

$(document).ready(function(){
	$.ajax({
		async:false,
		dataType: 'json',
		url: $PATH+"data/brand.json",
		data: {
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("no_brand");
		},
		success: function(response) {
			if(response.result){
				localStorage.setItem('brand',response.data.id_brand);
				$BRAND=response.data.id_brand;
			} else {
				error_handeler("no_brand");									
			}
				
		}
	});

});