
$(document).ready(function() {
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/admins/list.php",
		data: {
			lang: localStorage.getItem("lang"),
			active:$GET["active"]
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
					$(".ajax-loader-"+key).html(value);
				});
			} else {
				$("#ajax_error .modal-msg").html(response.error);
				show_modal("ajax_error","");
			}

		}
	});
    var responsiveHelper = undefined;
    var breakpointDefinition = {
        tablet: 1024,
        phone : 480
    };
	var tableElement = $('#admins-list');
    tableElement.dataTable( {
		"sDom": "<'row'<'col-md-6'><'col-md-6'f>>t<'row'<'col-md-12'p i>>",
		"sPaginationType": "bootstrap",
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [] }
		],
		"aaSorting": [[ 0, "asc" ]],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sSearch": $s["admin_search"],
			"sInfo": $s["admin_showing_from_entry"]+"<b>_START_"+$s["admin_to_entry"]+"_END_</b>"+$s["admin_of"] +"_TOTAL_"+ $s["admin_entries"],
			"sInfoEmpty": $s["admin_no_entries"],
			"sZeroRecords": $s["admin_search_no_entry"]
			},
		"sAjaxSource":$SERVER_PATH+"server/app/ajax/admins/table.php?active="+$GET["active"]+"&PATH="+$PATH,
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



function delete_admin(id_admin){
	filter_str="id_admin||=||"+id_admin;
	$.ajax({
		type: "POST",
		dataType: 'json',
		url: $PATH+"../server/app/ajax/indb/actions.php",
		data: {
			func:"delete",
			table:"admins",
			filter_str:filter_str
		},
		error: function(data, textStatus, jqXHR) {
			$('.modal').modal('hide');
			$('#ajax_error').modal('show');
			$('#ajax_error .ajax_err_msg').html(jqXHR);
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

			}

		}
	});
}
