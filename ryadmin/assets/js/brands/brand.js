/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 11-08-2014
* Version: 0.94
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/brands/get_brand.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_brand:$GET["id_brand"]
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


function delete_brand(id_brand){
	filter_str="id_brand||=||"+id_brand;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"brands",
			filter_str:filter_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.status){
				show_modal("deleted_brand_success_alert","javascript:window.location=\"../brands/\"");
            }else{
							error_handler(response.error_code);
			}

		}
	});
}

function update_brand(id_brand,active_status){
	filter_str="id_brand||=||"+id_brand;
	data_str="active||"+active_status;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/ryadmin/ajax/indb/actions.php",
		data: {
			func:"update",
			table:"brands",
			filter_str:filter_str,
			data_str:data_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.status){
				if(active_status==1){
					show_modal("unblock_brand_success_alert","javascript:window.location=\"./?id_brand="+id_brand+"\"");
				}else{
					show_modal("block_brand_success_alert","javascript:window.location=\"./?id_brand="+id_brand+"\"");
				}
			}else{
				error_handler(response.error_code);
			}

		}
	});
}
