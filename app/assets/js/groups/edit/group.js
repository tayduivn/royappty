/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'json',
		url: $SERVER_PATH+"server/app/ajax/groups/edit/group.php",
		data: {
			lang: localStorage.getItem("lang"),
			id_group:$GET["id_group"]
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
	var tableElement = $('#groups-list');

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

var current_step=1;
function nextstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step+=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #step-"+current_step).css("display","block");
	}
	function prevstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
		current_step-=1;
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #step-"+current_step).css("display","block");
	}
	function loadingstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","block");
	}
	function successstep(){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-error").css("display","none");
		$("#form-wizard #form-success").css("display","block");
	}
	function errorstep(error_code_str){
		$("#form-wizard #step-"+current_step).css("display","none");
		$("#form-wizard #form-loading").css("display","none");
		$("#form-wizard #form-success").css("display","none");
		$("#form-wizard #form-error").css("display","block");
		$("#form-wizard #form-error .msg").html(error_code_str);
	}

$(document).ready(function() {


	$("#form-wizard form").submit(function(e){
        e.preventDefault();
	});




	$("#form-step1").validate({
		messages:{
			name:{
				required: $s["group_edit_name_this_field_is_compulsory"],
				maxlength: $s["group_edit_name_it_canot_be_longer_than_75_characters"],
				minlength: $s["group_edit_name_this_field_needs_4_character_minimum"]
			}
		},
		rules:{
			name:{
		  		required:true,
			  	maxlength: 75,
			  	minlength: 4
		  	}
		},
		submitHandler:function(form){

			$('#form-end #name').val($('#form-step1 #name').val());
			var users_groups= "";
			var separator= "";
			$(".user_checkbox").each(function(){
				if($(this).attr('checked')){
					users_groups=users_groups+separator+$(this).attr('id');
					separator="::";
				}
			});

		 	$('#form-end #users_groups').val("");


			loadingstep();
		 	$.ajax({
				type: "POST",
				dataType: 'json',
				url: $SERVER_PATH+"server/app/ajax/groups/edit/update_group.php",
				data: {
					"id_group":$GET["id_group"],
					"name":$('#form-end #name').val(),
					"users_groups":users_groups
				},
				error: function(data, textStatus, jqXHR) {
					errorstep($error_s["ajax_error_content"])
				},
				success: function(response) {
					if(response.result){
						successstep();
						$("#group-link").attr("href","../../group/?id_group="+response.data);
					} else {
						errorstep(response.error_code_str);
					}

				}
			});
		}
	});



});
