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

function transition_left(old_page,new_page){
  $("#"+old_page).removeClass("center_mobile_page");
  $("#"+old_page).addClass("left_mobile_page");
  $("#"+new_page).removeClass("left_mobile_page");
  $("#"+new_page).removeClass("right_mobile_page");
  $("#"+new_page).addClass("center_mobile_page");
  page_selected=new_page;
  $(window).scrollTop(0);
}

function transition_right(old_page,new_page){
  $("#"+old_page).removeClass("center_mobile_page");
  $("#"+old_page).addClass("right_mobile_page");
  $("#"+new_page).removeClass("left_mobile_page");
  $("#"+new_page).removeClass("right_mobile_page");
  $("#"+new_page).addClass("center_mobile_page");
  page_selected=new_page;

  $(window).scrollTop(0);
}



function show_modal(modal_id,accept_function){
	$('.modal').modal('hide');
	$('#'+modal_id).modal('show');
	if(accept_function!=""){
		$('#'+modal_id+" .accept_button").attr("href",accept_function);
	}
}

function error_handeler(error_code){
  alert(error_code);
	error_block:{
		//Brand check errors
		if(error_code=="no_brand"){window.location.href = $PATH+"./error/?error_code=no_brand";break error_block;}
		if(error_code=="brand_not_valid"){window.location.href = $PATH+"./error/?error_code=brand_not_valid";break error_block;}

		//User check errors
		if(error_code=="no_user"){window.location.href = $PATH+"./signup/index.html";break error_block;}
		if(error_code=="user_not_valid"){window.location.href = $PATH+"./signup/index.html";break error_block;}
		if(error_code=="user_inactive"){window.location.href = $PATH+"./error/?error_code=user_inactive";break error_block;}

		//Ajax Errors
		if(error_code=="ajax_error"){window.location.href = $PATH+"./error/?error_code=ajax_error";break error_block;}

		//Error Unknow
		window.location.href = "error/base.html";break error_block;
	}
}
