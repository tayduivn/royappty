<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 21-07-2014
	* Version: 0.93
	*
	*********************************************************/

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
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/list";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8");
 	$response["data"]["table-header"] = "
 		<th style='width:30%'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%' class='text-right'>".htmlentities($s["used_codes"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:20%' class='text-right'>".htmlentities($s["creation_date"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:30%;' class='text-right'>".htmlentities($s["last_connection"], ENT_QUOTES, "UTF-8")."</th>";

 	$response["data"]["tabs"]="
        	<li class='active'><a href='?status=0'>".htmlentities($s["all_users"], ENT_QUOTES, "UTF-8")."</a></li>
    ";
 	$response["data"]["modals"]="

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
