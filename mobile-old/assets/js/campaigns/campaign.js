$(document).ready(function() {
	need_update=false;
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
				if(jqXHR!=""){
					$("#ajax_error .modal-msg").html(jqXHR);
					show_modal("ajax_error","");
				}
			},
			success: function(response) {
				if(response.result){
					jQuery.each(response.data,function(key,value){
						localStorage.setItem(key, value);
					});
				} else {
					$("#ajax_error .modal-msg").html(response.error);
					show_modal("ajax_error","");
				}
					
			}
		});
		localStorage.setItem('last_update', $timestamp);	
	}
	for( var key in localStorage){
		$(".ajax-loader-"+key).html(localStorage.getItem(key));
	}
});