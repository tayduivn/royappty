<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_brand
	* brand_not_valid
	*	no_admin
	* admin_not_valid
	* admin_inactive
	* post_no_group
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/groups/edit/group";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
if(!checkClosed()){echo json_encode($response);die();}

// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["id_group"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_group");
		$response["error_code"]="post_no_group";
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$response["result"]=true;

	$table="groups";
	$filter=array();
	$filter["id_group"] = array("operation"=>"=","value"=>$_POST["id_group"]);
	$group=getInBD($table,$filter);

	$table="user_groups";
	$filter=array();
	$filter["id_group"] = array("operation"=>"=","value"=>$_POST["id_group"]);
	$user_groups=listInBD($table,$filter);

	$user_group_ids=array();
	$user_groups_str="";
	$user_groups_separator="";
	foreach($user_groups as $key=>$user_group){
		$user_group_ids[]=$user_group["id_user"];
		$user_groups_str.=$user_groups_separator.$user_group["id_user"];
		$user_groups_separator=" :: ";
	}


	$response["data"]["page-title"]="<a href='../../groups'>".htmlentities($s["groups"], ENT_QUOTES, "UTF-8")."</a> / <a href='#'>".htmlentities($s["edit_group"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($group["name"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-group-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["add_group_title"], ENT_QUOTES, "UTF-8")."</h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["group_name"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["group_name_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control' value='".$group["name"]."'>
					</div>
				</div>

				<div class='form-group'>
					<label class='form-label'>".htmlentities($s["select_users"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($s["select_users_help"], ENT_QUOTES, "UTF-8")."</span>
					<table class='table table-hover table-condensed dataTable' id='groups-list' aria-describedby='example_info'>
	                	<thead>
	                    	<tr class='ajax-loader-table-header'>
								<th style='width:35%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
						    	<th style='width:25%'>".htmlentities($s["used_codes"], ENT_QUOTES, "UTF-8")."</th>
						    	<th style='width:20%'>".htmlentities($s["creation_date"], ENT_QUOTES, "UTF-8")."</th>
						    	<th style='width:20%;'>".htmlentities($s["last_connection"], ENT_QUOTES, "UTF-8")."</th>
							</tr>
						</thead>
	                    <tbody>";
	$table="users";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$users=listInBD($table,$filter);
	foreach ($users as $key => $user){
		$table="used_codes_user_summaries";
		$filter=array();
		$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
		$sum_field="used_codes_amount";
		$user_codes_amount_total=sumInBD($table,$filter,$sum_field);

		$table='brand_user_fields';
		$filter=array();
		$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
		$filter["main_field"]=array("operation"=>"=","value"=>1);
		$brand_user_fields=getInBD($table,$filter);

		$table='user_field_data';
		$filter=array();
		$filter["id_user_field"]=array("operation"=>"=","value"=>$brand_user_fields["id_user_field"]);
		$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
		$user_field_data=getInBD($table,$filter);

		$response["data"]["new-group-step-1"].="
	    	<tr>
	        	<td>
					<div class='row-fluid'>
						<div class='checkbox check-default'>
							<input id='".$user["id_user"]."' class='user_checkbox' type='checkbox' ";
		if(in_array($user["id_user"],$user_group_ids)){
			$response["data"]["new-group-step-1"].=" checked ";
		}
		$response["data"]["new-group-step-1"].=">
							<label for='".$user["id_user"]."' class='p-l-30'>".htmlentities($user_field_data["field_value"], ENT_QUOTES, "UTF-8")."</label>
						</div>
					</div>
				</td>
	            <td>".$user_codes_amount_total."</td>
	            <td>".date("d/m/Y",$user["created"])."</td>
	            <td>".date("d/m/Y",$user["last_connection"])."</td>
			</tr>";
	}
	$response["data"]["new-group-step-1"].="
	                    </tbody>
					</table>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a id='prev_step' href='../' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
					</div>
			</form>";

	$response["data"]["new-group-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='name'/>
			<input type='hidden' id='users_groups'/>
		</form>
	";
	$response["data"]["new-group-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-group-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../groups/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-group-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["group_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["group_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../groups/' class='btn btn-white m-r-10'>".htmlentities($s["all_groups"], ENT_QUOTES, "UTF-8")."</a>
				<a id='group-link' href='#' class='btn btn-white m-l-10'>".htmlentities($s["view_group"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

?>
