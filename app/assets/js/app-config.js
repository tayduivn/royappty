$('.droparea').droparea({
	'instructions': '<br/><br/><h2><i class="fa fa-picture-o"></h2></i>Piche o arraste aqu&iacute; la imagen <br/>a subir',
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
			alert("Ha ocurrido un error al subir el archivo");
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