
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

function show_modal(modal_id,accept_function){
	$('.modal').modal('hide'); 
	$('#'+modal_id).modal('show'); 
	if(accept_function!=""){
		$('#'+modal_id+" .accept_button").attr("href",accept_function);	
	}
}
