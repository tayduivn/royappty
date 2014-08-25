/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 09-07-2014
* Version: 0.92
*
*********************************************************/

/*********************************************************
* AJAX RETURNS
*
* ERROR CODES
*
*********************************************************/



$(document).ready(function(){

	/*********************************************************
	* AJAX CALL LOAD PAGE
	*********************************************************/
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/policy/policy.php",
		data: {
			lang: localStorage.getItem("lang"),
			policy_type:$GET["policy_type"]
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			} else {
				error_handler(response.error_code);
			}
		}
	});
});