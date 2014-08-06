window.addEventListener('load', function () {
    new FastClick(document.body);
}, false);
var pages=new Array();
$.ajax({
	async: false,
	type: "POST",
	dataType: 'json',
	url: $SERVER_PATH+"server/mobile/ajax/mobile/mobile.php",
	data: {
	},
	error: function(data, textStatus, jqXHR) {
		error_handler("ajax_error");
	},
	success: function(response) {
		if(response.result){
			jQuery.each(response.data,function(key,value){
				pages[key]=value;
			});
		} else {
			error_handler(response.error_code);
		}

	}
});

var slider = new PageSlider($(".ajax-loader-page"));
slider.slidePage($(pages["homepage"]));
