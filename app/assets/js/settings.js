/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

var $SERVER_PATH = $PATH+"../";

//Check localStorage(lang)
//Check navigator(lang)
//Set localStorage depending on navigator(lang)
//Set localStorage depending on user's choice

if ((typeof localStorage.getItem('lang') == 'undefined')||(localStorage.getItem('lang') == null)){
  var navigatorLang = navigator.language || navigator.userLanguage;
  if(navigatorLang == 'es'){
    localStorage.setItem('lang','es');
  }
  else{
    localStorage.setItem('lang','en');
  }
}
else if(localStorage.getItem('lang') == 'es'){
  localStorage.setItem('lang','es');

}
else{
  localStorage.setItem('lang','en');
}

if(localStorage.getItem('lang')=='es'){
  require("../assets/js/lang/ES_es.js");
}
else{
  require("../assets/js/lang/EN_en.js");
}

function changelang(lang){
  localStorage.setItem('lang',lang);
  location.reload();
}


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

loadjscssfile("server/app/assets/css/server_style.css", "css");

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
