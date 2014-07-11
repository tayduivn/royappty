/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

var current_step=1;
function gotostep(step){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","block");
	current_step=step;
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-step"+current_step).css("display","block");
}
function nextstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","block");
	current_step+=1;
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-step"+current_step).css("display","block");
}
function prevstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","block");
	current_step-=1;
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-step"+current_step).css("display","block");
}
function loadingstep(){
$("#form-wizard #form-step"+current_step).css("display","none");
$("#form-wizard #form-error").css("display","none");
$("#form-wizard #form-success").css("display","none");
$("#form-wizard #form-loading").css("display","block");
}
function successstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-error").css("display","none");
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-success").css("display","block");
}
function errorstep(){
	$("#form-wizard #form-step"+current_step).css("display","none");
	$("#form-wizard #form-loading").css("display","none");
	$("#form-wizard #form-success").css("display","none");
	$("#form-wizard #form-error").css("display","block");
}

$(document).ready(function() {
	$("#form-wizard form").submit(function(e){
				e.preventDefault();
	});
});
