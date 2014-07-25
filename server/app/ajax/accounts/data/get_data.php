<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
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

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/data/get_data";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/
	include(PATH."functions/check_session.php");



	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);


	$response["data"]["page-title"]="<a href='../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8");


	$response["data"]["account-data"]="
		<h3 class='m-t-0'>".htmlentities($s["account_data"], ENT_QUOTES, "UTF-8")."</h3>
		<table class='m-b-10'>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["cif"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["cif"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["contact_name"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_name"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["email"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_email"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["phone"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_phone"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["address"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_address"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["postal_code"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_postal_code"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["city"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_city"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
			<tr>
				<td><span class='text-success m-r-10'>".htmlentities($s["country"], ENT_QUOTES, "UTF-8")."</span></td>
				<td>".htmlentities($brand["contact_country"], ENT_QUOTES, "UTF-8")."</td>
			</tr>
		</table>
		<p><a href='./edit/' class='btn btn-white'>".htmlentities($s["edit_personal_info"], ENT_QUOTES, "UTF-8")."</a></p>
		<p>".htmlentities($s["delete_your_account_help"], ENT_QUOTES, "UTF-8")." <a href='./delete/'>".htmlentities($s["here"], ENT_QUOTES, "UTF-8")."</a></p>
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
