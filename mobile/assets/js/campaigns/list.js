$(document).ready(function() {
	need_update=true;
	if ((typeof localStorage.getItem('last_update') == 'undefined')||(($timestamp-localStorage.getItem('last_update'))>60)) {
		need_update=true;
	}
	if(need_update){
		$.ajax({
			async: false,
			type: "POST",
			dataType: 'json',
			url: $SERVER_PATH+"server/mobile/ajax/campaigns/all_data.php",
			data: {
			},
			error: function(data, textStatus, jqXHR) {
				error_handeler("ajax_error");
			},
			success: function(response) {
				if(response.result){
					jQuery.each(response.data,function(key,value){
						localStorage.setItem(key, value);
					});
				} else {
					error_handeler(response.error_code);
				}

			}
		});
		localStorage.setItem('last_update', $timestamp);
	}
	for( var key in localStorage){
		$(".ajax-loader-"+key).html(localStorage.getItem(key));
	}
		$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});
});

function validate_promo(campaign){
	show_page("validate-"+campaign+"-loading");
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/mobile/ajax/campaigns/add_used_code.php",
		data: {
			"promo_password":$('#'+campaign+"-promo-password").val(),
			"id_campaign":campaign,
			"code":$('#'+campaign+"-code").val()
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax-error");
		},
		success: function(response) {
			if(response.result){
				show_page("validate-"+campaign+"-success");
			} else {
				show_page("validate-"+campaign+"-error");
			}
		}
	});
}


function show_page(page){

	$(".page").slideUp();
	$("#"+page).slideDown();
}
