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
		url: $SERVER_PATH+"server/app/ajax/campaigns/list.php",
		data: {
			lang: localStorage.getItem("lang"),
			status:$GET["status"]
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
    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
	var tableElement = $('#campaigns-list');

    tableElement.dataTable( {
		"sDom": "<'row'<'col-md-6'><'col-md-6'f>>t<'row'<'col-md-12'p i>>",
		"sPaginationType": "bootstrap",
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [] }
		],
		"aaSorting": [],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sSearch": $s["search"],
			"sInfo": $s["showing_from_entry"]+"<b> _START_ "+$s["to_entry"]+" _END_ </b>"+$s["_of"] +" _TOTAL_ "+ $s["entries"],
			"sInfoEmpty": $s["no_entries"],
			"sZeroRecords": $s["search_no_entry"]
			},
		"sAjaxSource":$SERVER_PATH+"server/app/ajax/campaigns/table.php?status="+$GET["status"]+"&PATH="+$PATH,
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



function delete_campaign(id_campaign){
	filter_str="id_campaign||=||"+id_campaign;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"campaigns",
			filter_str:filter_str
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
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
				error_handler(response.error_code);
			}
		}
	});
}
