/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function() {
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/users/list.php",
		data: {
			lang: localStorage.getItem("lang")
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
	var tableElement = $('#users-list');

    tableElement.dataTable( {
		"sDom": "<'row'<'col-md-6'><'col-md-6'f>>t<'row'<'col-md-12'p i>>",
		"sPaginationType": "bootstrap",
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [] }
		],
		"aaSorting": [],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
		"sSearch": $s["users_search"],
		"sInfo": $s["users_showing_from_entry"]+"<b>_START_"+$s["users_to_entry"]+"_END_</b>"+$s["users_of"] +"_TOTAL_"+ $s["users_entries"],
		"sInfoEmpty": $s["users_no_entries"],
		"sZeroRecords": $s["users_search_no_entry"]
			},
		"sAjaxSource":$SERVER_PATH+"server/app/ajax/users/table.php?status="+$GET["status"]+"&PATH="+$PATH,
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
