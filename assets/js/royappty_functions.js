/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 06-08-2014
* Version: 0.94
*
*********************************************************/

function require(script) {
    $.ajax({
        url: script,
        dataType: "script",
        async: false,
        success: function () {
        },
        error: function () {
        }
    });
}

function logout(){
	session_destroy();
	window.location.href = $PATH;
}
function session_destroy(){
	localStorage.removeItem('id_brand');
	localStorage.removeItem('id_admin');
}

function error_handler(error_code){
	error_block:{
		if(error_code=="ajax_error"){window.location.href = $PATH+"error/?error_code=ajax_error";break error_block;}
		//Error Unknow
		window.location.href =  $PATH+"error/?error_code=base";break error_block;

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
