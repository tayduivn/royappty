/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

function error_handeler(error_code){

	error_block:{
		//Genral
		if(error_code=="login_error"){window.location.href = $PATH+"login/?error=login_error";break error_block;}

		//Brand check errors
		if(error_code=="no_brand"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="brand_not_valid"){window.location.href = $PATH+"lock/";break error_block;}
		//User check errors
		if(error_code=="no_admin"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="admin_not_valid"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="admin_inactive"){window.location.href = $PATH+"login/";break error_block;}
		//Ajax Errors
		if(error_code=="ajax_error"){window.location.href = $PATH+"error/?error_code=ajax_error";break error_block;}
		//Error Unknow
		window.location.href = $PATH+"error/";break error_block;
	}
}


function error_handler(error_code){

	error_block:{
		//Genral
		if(error_code=="login_error"){window.location.href = $PATH+"login/?error=login_error";break error_block;}

		//Brand check errors
		if(error_code=="no_brand"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="brand_not_valid"){window.location.href = $PATH+"lock/";break error_block;}
		//User check errors
		if(error_code=="no_admin"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="admin_not_valid"){window.location.href = $PATH+"login/";break error_block;}
		if(error_code=="admin_inactive"){window.location.href = $PATH+"login/";break error_block;}
		//Ajax Errors
		if(error_code=="ajax_error"){window.location.href = $PATH+"error/?error_code=ajax_error";break error_block;}
		//Error Unknow
		window.location.href = $PATH+"error/";break error_block;
	}
}

function print_area(){
	$(".only_printable").css("display","block");
	$("body").css("background-color","white");
	var printContents = document.getElementById("printable").innerHTML;

    var originalContents = document.body.innerHTML;

    document.body.innerHTML = printContents;

    window.print();

    document.body.innerHTML = originalContents;
	$("body").css("background-color","#1B1E24");
	$(".only_printable").css("display","none");

}
function show_modal(id_modal,accept_action){
	$('.modal').modal('hide');
	$("#"+id_modal).modal();
	$("#"+id_modal+" .accept_button").attr("href",accept_action);
}
function input_only_numbers(id_field){
	if(isNaN($("#"+id_field).val())){
		$("#"+id_field).val(0);
	}
}
