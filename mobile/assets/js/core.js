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

function error_handeler(error_code){
	
	error_block:{
		//Brand check errors
		if(error_code=="no_brand"){window.location.href = $PATH+"./error.html?error_code=no_brand";break error_block;}
		if(error_code=="brand_not_valid"){window.location.href = $PATH+"./error.html?error_code=brand_not_valid";break error_block;}
		
		//User check errors
		if(error_code=="no_user"){window.location.href = $PATH+"./signup/index.html";break error_block;}
		if(error_code=="user_not_valid"){window.location.href = $PATH+"./signup/index.html";break error_block;}
		if(error_code=="user_inactive"){window.location.href = $PATH+"./error/index.html?error_code=user_inactive";break error_block;}
		
		//Ajax Errors
		if(error_code=="ajax_error"){window.location.href = $PATH+"./error/index.hmtl?error_code=ajax_error";break error_block;}
		
		//Error Unknow
		window.location.href = "error.html";break error_block;
	}
}
