<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));



	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/get_campaign";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");

 	$response=array();


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




 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

?>
