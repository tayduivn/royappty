/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

function view_note(id_group_note){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/groups/get_group_note.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_group_note:id_group_note
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				$("#group_notes_viewer .modal-msg").html(response.data);
				show_modal("group_notes_viewer","javascript:delete_group_note("+id_group_note+")");
			} else {
				error_handeler(response.error_code);
			}

		}
	});

}
function delete_group_note(id_group_note){
	filter_str="id_group_note||=||"+id_group_note;
	callback_options_str="id_group||=||"+$GET["id_group"];
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"group_notes",
			filter_str:filter_str,
			callback_options_str:callback_options_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.status){
	    		for (i in response.action){
		    		if(response.action[i]=="header"){
						window.location=response.actions[i].header;
		    		}else if(response.action[i]=="reload"){
			        	for (j in response.actions[i].reload){
				        	$("."+response.actions[i].reload[j].obj_class).html(response.actions[i].reload[j].obj_value);
			            }
					}else if(response.action[i]=="prepend"){
			           	for (j in response.actions[i].prepend){
				           	$("."+response.actions[i].prepend[j].obj_class).prepend(response.actions[i].prepend[j].obj_value);
			           	}
					}else if(response.action[i]=="fadeout"){
			           	for (j in response.actions[i].fadeout){
				           	$("."+response.actions[i].fadeout[j].obj_class).slideUp('fast',function(){$(this).remove()});
			           	}
					}else if(response.action[i]=="fadein"){
					   	for (j in response.actions[i].fadein){
					       	$("."+response.actions[i].fadein[j].obj_class).slideDown('fast');
					   	}
					}
	    		}

            }else{
				error_handeler(response.error_code);
			}

		}
	});
}
function add_group_note(){
	var timestamp = Number(new Date())/1000 |0;
	content = $("#group_notes_add_form #content").val().replace(/\r?\n/g,'<br />');
	data_str="id_group||"+$GET["id_group"]+"::id_brand||"+$BRAND+"::title||"+$("#group_notes_add_form #title").val()+"::content||"+content+"::created||"+timestamp;
	callback_options_str="id_group||=||"+$GET["id_group"];
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"add",
			table:"group_notes",
			data_str:data_str,
			callback_options_str:callback_options_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
			}
		},
		success: function(response) {
			if(response.status){
	    		for (i in response.action){
		    		if(response.action[i]=="header"){
						window.location=response.actions[i].header;
		    		}else if(response.action[i]=="reload"){
			        	for (j in response.actions[i].reload){
				        	$("."+response.actions[i].reload[j].obj_class).html(response.actions[i].reload[j].obj_value);
			            }
					}else if(response.action[i]=="prepend"){
			           	for (j in response.actions[i].prepend){
				           	$("."+response.actions[i].prepend[j].obj_class).prepend(response.actions[i].prepend[j].obj_value);
			           	}
					}else if(response.action[i]=="fadeout"){
			           	for (j in response.actions[i].fadeout){
				           	$("."+response.actions[i].fadeout[j].obj_class).slideUp('fast',function(){$(this).remove()});
			           	}
					}else if(response.action[i]=="fadein"){
					   	for (j in response.actions[i].fadein){
					       	$("."+response.actions[i].fadein[j].obj_class).slideDown('fast');
					   	}
					}
	    		}

            }else{
				error_handeler(response.error_code);
			}

		}
	});
}
$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/groups/get_group.php",
		data: {
			id_group:$GET["id_group"]
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			} else {
				error_handeler(response.error_code);
			}

		}
	});
	var d1_1 = [
        [0, parseInt($(".ajax-loader-graph-value-0").html())],
        [1, parseInt($(".ajax-loader-graph-value-1").html())],
        [2, parseInt($(".ajax-loader-graph-value-2").html())],
        [3, parseInt($(".ajax-loader-graph-value-3").html())],
        [4, parseInt($(".ajax-loader-graph-value-4").html())],
        [5, parseInt($(".ajax-loader-graph-value-5").html())],
        [6, parseInt($(".ajax-loader-graph-value-6").html())],
        [7, parseInt($(".ajax-loader-graph-value-7").html())],
        [8, parseInt($(".ajax-loader-graph-value-8").html())],
        [9, parseInt($(".ajax-loader-graph-value-9").html())],
        [10, parseInt($(".ajax-loader-graph-value-10").html())],
        [11, parseInt($(".ajax-loader-graph-value-11").html())],
        [12, parseInt($(".ajax-loader-graph-value-12").html())],
        [13, parseInt($(".ajax-loader-graph-value-13").html())],
        [14, parseInt($(".ajax-loader-graph-value-14").html())]
    ];

	var data1 = [
        {
            data: d1_1,
            bars: {
               show: true,
               barWidth:0.75,
               fillColor: "#ff3399",
               lineWidth: 0,
               align: "center"
            },
           color: "#fff"

        }

    ];

	$.plot($("#placeholder-bar-chart"), data1, {
		tooltip: true,
		tooltipOpts: {
			content: "%y",
			shifts: {
				x: -60,
				y: 25
			}
		},
        xaxis: {
			ticks: [
				[0,$(".ajax-loader-graph-label-0").html()],
				[1,$(".ajax-loader-graph-label-1").html()],
				[2,$(".ajax-loader-graph-label-2").html()],
				[3,$(".ajax-loader-graph-label-3").html()],
				[4,$(".ajax-loader-graph-label-4").html()],
				[5,$(".ajax-loader-graph-label-5").html()],
				[6,$(".ajax-loader-graph-label-6").html()],
				[7,$(".ajax-loader-graph-label-7").html()],
				[8,$(".ajax-loader-graph-label-8").html()],
				[9,$(".ajax-loader-graph-label-9").html()],
				[10,$(".ajax-loader-graph-label-10").html()],
				[11,$(".ajax-loader-graph-label-11").html()],
				[12,$(".ajax-loader-graph-label-12").html()],
				[13,$(".ajax-loader-graph-label-13").html()],
				[14,$(".ajax-loader-graph-label-14").html()]
			],
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 100
        },
        yaxis: {
            axisLabel: 'Value',
            axisLabelUseCanvas: true,
            axisLabelFontSizePixels: 12,
            axisLabelFontFamily: 'Verdana, Arial, Helvetica, Tahoma, sans-serif',
            axisLabelPadding: 5
        },
        grid: {
            borderWidth: 1,
			borderColor:'#f0f0f0',
 			hoverable: true,
 			hoverColor:'#f0f0f0',

        },
        series: {
            shadowSize: 1
        }

    });
});

function delete_group(id_group){
	filter_str="id_group||=||"+id_group;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"groups",
			filter_str:filter_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handeler("ajax_error");
		},
		success: function(response) {
			if(response.status){
	    		$.ajax({
					type: "POST",
					dataType: 'json',
					url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
					data: {
						func:"delete",
						table:"user_groups",
						filter_str:filter_str
					},
					error: function(data, textStatus, jqXHR) {
						error_handeler("ajax_error");
					},
					success: function(response) {
						if(response.status){
							$.ajax({
								type: "POST",
								dataType: 'json',
								url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
								data: {
									func:"delete",
									table:"group_notes",
									filter_str:filter_str
								},
								error: function(data, textStatus, jqXHR) {
									error_handeler("ajax_error");
								},
								success: function(response) {
									if(response.status){
										show_modal("deleted_group_success_alert","javascript:window.location=\"../groups/\"");
									}else{
										error_handeler(response.error_code);
									}
								}
							});
						}else{
							error_handeler(response.error_code);
						}
					}
				});
			}else{
				error_handeler(response.error_code);
			}
		}
	});
}
