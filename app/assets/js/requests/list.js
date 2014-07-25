/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

$(document).ready(function() {
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/requests/list.php",
		data: {
			lang: localStorage.getItem("lang"),
			status:$GET["status"]
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
    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
	var tableElement = $('#requests-list');

    tableElement.dataTable( {
		"sDom": "<'row'<'col-md-6'><'col-md-6'f>>t<'row'<'col-md-12'p i>>",
		"sPaginationType": "bootstrap",
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [] }
		],
		"aaSorting": [[ 0, "asc" ]],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sSearch": $s["request_list_search"],
			"sInfo": $s["request_list_showing_from_entry"]+"<b>_START_"+$s["request_list_to_entry"]+"_END_</b>"+$s["request_list_of"] +"_TOTAL_"+ $s["request_list_entries"],
			"sInfoEmpty": $s["request_list_no_entries"],
			"sZeroRecords": $s["request_list_search_no_entry"]
			},
		"sAjaxSource":$SERVER_PATH+"server/app/ajax/requests/table.php?status="+$GET["status"]+"&PATH="+$PATH,
		 bAutoWidth     : false,
        fnPreDrawCallback: function () {
            // Initialize the responsive datatables helper once.
            if (!responsiveHelper) {
                responsiveHelper = new ResponsiveDatatablesHelper(tableElement, breakpointDefinition);
            }
        },
        fnRowCallback  : function (nRow) {
            responsiveHelper.createExpandIcon(nRow);
        },
        fnDrawCallback : function (oSettings) {
            responsiveHelper.respond();
        }
	});

});



function delete_request(id_request){
	filter_str="id_request||=||"+id_request;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"requests",
			filter_str:filter_str
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
