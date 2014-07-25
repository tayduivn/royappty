<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

=======
	* Last Edit: 17-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
>>>>>>> FETCH_HEAD
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

<<<<<<< HEAD


=======
>>>>>>> FETCH_HEAD
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/admins/table";
	debug_log("[".$page_path."] START");

<<<<<<< HEAD

=======
>>>>>>> FETCH_HEAD

	$response=array();
 	$response["aaData"]=array();

<<<<<<< HEAD
=======

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	include(PATH."functions/check_session.php");


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

>>>>>>> FETCH_HEAD
	$table="admins";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	if(issetandnotempty($_GET["active"])){
	 	$filter["active"]=array("operation"=>"=","value"=>$_GET["active"]);
 	}
	if(isInBD($table,$filter)){
 		$admins=listInBD($table,$filter);
 		foreach($admins as $key=>$admin){

 			$admin["can_login_str"]="<i class='fa fa-bullhorn text-danger'></i>";
 			if($admin["can_login"]==1){
 				$admin["can_login_str"]=htmlentities($s["yes"], ENT_QUOTES, "UTF-8");
 			}
 			$admin["can_validate_codes_str"]=htmlentities($s["no"], ENT_QUOTES, "UTF-8");
 			if($admin["can_validate_codes"]==1){
 				$admin["can_validate_codes_str"]=htmlentities($s["yes"], ENT_QUOTES, "UTF-8");
 			}
 			$admin["manager_access"]="";
 			if($admin["can_login"]==1){
 				$admin["manager_access"].="<i title='".htmlentities($s["can_login_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-home text-green'></i> | ";
 			}else{
	 			$admin["manager_access"].="<i title='".htmlentities($s["cant_login_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-home text-danger'></i> | ";
 			}

 			if($admin["can_manage_campaigns"]==1){
 				$admin["manager_access"].="<i title='".htmlentities($s["can_manage_campaigns_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-bullhorn text-green'></i> | ";
 			}else{
	 			$admin["manager_access"].="<i title='".htmlentities($s["cant_manage_campaigns_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-bullhorn text-danger'></i> | ";
 			}
 			if($admin["can_manage_admins"]==1){
 				$admin["manager_access"].="<i title='".htmlentities($s["can_manage_admins_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-sitemap text-green'></i> | ";
 			}else{
	 			$admin["manager_access"].="<i title='".htmlentities($s["cant_manage_admins_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-sitemap text-danger'></i> | ";
 			}
 			if($admin["can_manage_users"]==1){
 				$admin["manager_access"].="<i title='".htmlentities($s["can_manage_users_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-group text-green'></i> | ";
 			}else{
	 			$admin["manager_access"].="<i title='".htmlentities($s["cant_manage_users_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-group text-danger'></i> | ";
 			}
 			if($admin["can_manage_app"]==1){
 				$admin["manager_access"].="<i title='".htmlentities($s["can_manage_app_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-gears text-green'></i>";
 			}else{
	 			$admin["manager_access"].="<i title='".htmlentities($s["cant_manage_app_tooltip"], ENT_QUOTES, "UTF-8")."' class='fa fa-gears text-danger'></i>";
 			}

 			if($admin["can_validate_codes"]==1){
	 			$admin["can_validate_codes_str"]="<i title='".htmlentities($s["can_validate_codes"], ENT_QUOTES, "UTF-8")."' class='fa fa-check text-green'></i>";
 			}else{
	 			$admin["can_validate_codes_str"]="<i title='".htmlentities($s["cant_validate_codes"], ENT_QUOTES, "UTF-8")."' class='fa fa-times text-danger'></i>";
 			}


 			$admin["last_connection_str"]="Sin uso";
 			if($admin["last_connection"]!=0){
	 			$admin["last_connection_str"]=date("d/m/Y  H:m",$admin["last_connection"]);
 			}

 			$table_field="<div class='m-b-5'><a href='".$_GET["PATH"]."admin/?id_admin=".$admin["id_admin"]."' class='";
 			if($admin["active"]==0){
	 			$table_field.="text-muted";
	 		}
 			$table_field.="'>".$admin["name"]."</a> ";
 			if($admin["brand_admin"]==1){
 				$table_field.="<span class='text-muted'>( ".htmlentities($s["brand_admin"], ENT_QUOTES, "UTF-8")." )</span>";
 			}
 			if($admin["active"]==0){
 				$table_field.="<span class='text-muted'>( ".htmlentities($s["inactive_admin"], ENT_QUOTES, "UTF-8")." )</span>";
 			}

 			$table_field.="</div><div class='hidden-options'><a href='".$_GET["PATH"]."admin/?id_admin=".$admin["id_admin"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a> <a href='".$_GET["PATH"]."admin/edit/?id_admin=".$admin["id_admin"]."' class='btn btn-mini btn-white'> ".htmlentities($s["edit"], ENT_QUOTES, "UTF-8")."</a>";
 			if($admin["brand_admin"]==0){
	 			$table_field.=" <a href='javascript:show_modal(\"delete_admin_alert\",\"javascript:delete_admin(".$admin["id_admin"].")\")' class=' btn btn-mini btn-danger'> ".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>";
 			}
 			$table_field.="</div>";

 			$table="validated_codes_month_summaries";
 			$filter=array();
 			$filter["id_admin"]=array("operation"=>"=","value"=>$admin["id_admin"]);
 			$validated_codes_amount=getInBD($table,$filter);
 			if(!issetandnotempty($validated_codes_amount)){
	 			$validated_codes_amount["validated_codes_amount"]=0;
 			}


	 		$response["aaData"][]=array(
	 			 $table_field,
	 			"<div class='text-center text-muted'>".$admin["manager_access"]."</div>",
	 			"<div class='text-center'>". $admin["can_validate_codes_str"]."</div>",
	 			 $admin["last_connection_str"],
	 			 "<div class='text-right'>".$validated_codes_amount["validated_codes_amount"]."</div>");
 		}

	}
<<<<<<< HEAD
	debug_log("[".$page_path."] END");

 	echo json_encode($response);
=======
	
	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

>>>>>>> FETCH_HEAD

?>
