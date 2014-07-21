$('.droparea').droparea({
	'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>'+$s["click_or_drag_image_here"]+'<br/>'+$s["to upload"],
	'init' : function(result){},
	'start' : function(area){
		area.find('.error').remove();
	},
	'error' : function(result, input, area){
		$('<div class="error">').html(result.error).prependTo(area);
		return 0;
	},
	'complete' : function(result, file, input, area){
		if(result.error){
			alert($s["an_error_ocurred_when_downloading_the_file"]);
		}else{
			alert(result.filename);
			if((/image/i).test(file.type)){
				$("#avatar64").attr("src","<?php echo PATH;?>users/temp.jpg");
				$("#areas").css("display","none");
				$("#areas_ok").fadeIn();
			}
		}
	}
});
