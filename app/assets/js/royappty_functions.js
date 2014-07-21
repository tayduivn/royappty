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
		//Set password errors
		if(error_code=="set_password_no_code"){window.location.href = $PATH+"error/?error_code=set_password_no_code";break error_block;}
		if(error_code=="set_password_code_not_valid"){window.location.href = $PATH+"error/?error_code=set_password_code_not_valid";break error_block;}

		//Get Create Session Brand
		if(error_code=="post_create_no_brand"){window.location.href = $PATH+"login/";break error_block;}
		//Get Create Sesiion Admin
		if(error_code=="post_create_no_admin"){window.location.href = $PATH+"login/";break error_block;}
		//Get Admin
		if(error_code=="post_no_admin"){window.location.href = $PATH+"admins/";break error_block;}
		//Get Campaign
		if(error_code=="post_no_campaign"){window.location.href = $PATH+"campaings/";break error_block;}
		//Get Receipt
		if(error_code=="post_no_receipt"){window.location.href = $PATH+"receipts/";break error_block;}
		//Get Group
		if(error_code=="post_no_group"){window.location.href = $PATH+"groups/";break error_block;}
		//Get Request
		if(error_code=="post_no_request"){window.location.href = $PATH+"requests/";break error_block;}
		//Get campaign_note
		if(error_code=="post_no_campaign_note"){window.location.href = $PATH+"campaigns/";break error_block;}
		//Get group_note
		if(error_code=="post_no_group_note"){window.location.href = $PATH+"groups/";break error_block;}
		//Get user_note
		if(error_code=="post_no_user_note"){window.location.href = $PATH+"users/";break error_block;}
		//Get error_code
		if(error_code=="post_no_error_code"){window.location.href = $PATH;break error_block;}
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
