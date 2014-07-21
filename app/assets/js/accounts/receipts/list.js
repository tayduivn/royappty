
$(document).ready(function() {
	$.ajax({
		async:false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/accounts/receipts/list.php",
		data: {
			status:$GET["status"]
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
	var tableElement = $('#campaigns-list');

    tableElement.dataTable( {
		"sDom": "<'row'<'col-md-6'><'col-md-6'f>>t<'row'<'col-md-12'p i>>",
		"sPaginationType": "bootstrap",
		 "aoColumnDefs": [
          { 'bSortable': false, 'aTargets': [] }
		],
		"aaSorting": [[ 0, "asc" ]],
		"oLanguage": {
			"sLengthMenu": "_MENU_ ",
			"sSearch": $s["receipt_search"],
			"sInfo": $s["receipt_showing_from_entry"]+"<b>_START_"+$s["receipt_to_entry"]+"_END_</b>"+$s["receipt_of"] +"_TOTAL_"+ $s["receipt_entries"],
			"sInfoEmpty": $s["receipt_no_entries"],
			"sZeroRecords": $s["receipt_search_no_entry"]
			},
		"sAjaxSource":$SERVER_PATH+"server/app/ajax/accounts/receipts/table.php?status="+$GET["status"]+"&PATH="+$PATH,
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
