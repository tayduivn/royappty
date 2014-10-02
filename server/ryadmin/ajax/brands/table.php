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
	*	no_ryadmin
	* ryadmin_not_valid
	* ryadmin_inactive
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/admins/table";
	debug_log("[".$page_path."] START");
	$response=array();
 	$response["aaData"]=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$table="brands";
 	$filter=array();
	if(issetandnotempty($_GET["active"])){
	 	$filter["active"]=array("operation"=>"=","value"=>$_GET["active"]);
 	}
	if(isInBD($table,$filter)){
 		$brands=listInBD($table,$filter);
 		foreach($brands as $key=>$brand){

 			$table_field="
			<div>
				<a ";
			if($brand["active"]==2){
				$table_field.="class='text-muted' href='".$_GET["PATH"]."brand/?id_brand=".$brand["id_brand"]."'>".$brand["name"]." ( ".$s["brand_blocked"]." )</a>";
			}else{
				$table_field.="href='".$_GET["PATH"]."brand/?id_brand=".$brand["id_brand"]."'>".$brand["name"]."</a>";
			}
			$table_field.="
			</div>
			<div class='hidden-options'>
				<a href='".$_GET["PATH"]."brand/?id_brand=".$brand["id_brand"]."' class='btn btn-mini btn-white'>".htmlentities($s["view_report"], ENT_QUOTES, "UTF-8")."</a> <a href='".$_GET["PATH"]."brand/edit/?id_brand=".$brand["id_brand"]."' class='btn btn-mini btn-white'> ".htmlentities($s["edit"], ENT_QUOTES, "UTF-8")."</a>";
	 		if($brand["active"]==1){
				$table_field.=" <a href='javascript:show_modal(\"block_brand_alert\",\"javascript:block_brand(".$brand["id_brand"].",2)\")' class=' btn btn-mini btn-danger'> ".htmlentities($s["block"], ENT_QUOTES, "UTF-8")."</a>";
			}else{
				$table_field.=" <a href='javascript:show_modal(\"unblock_brand_alert\",\"javascript:block_brand(".$brand["id_brand"].",1)\")' class=' btn btn-mini btn-primary'> ".htmlentities($s["unblock"], ENT_QUOTES, "UTF-8")."</a>";
			}
 			$table_field.="</div>";

 			$table="campaigns";
 			$filter=array();
 			$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
 			$count_campaigns=countInBD($table,$filter);

			$table="users";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
			$count_users=countInBD($table,$filter);

			if($brand["created"]<=0){
				$brand["created"]="";
			}else{
				$brand["created"]=date("Y-m-d",$brand["created"]);
			}

	 		$response["aaData"][]=array(
				"#".$brand["id_brand"],
	 			$table_field,
	 			"<div class='text-center'>".$count_campaigns."</div>",
				"<div class='text-center'>". $count_users."</div>",
				"<div class='text-right'>". $subscription_type_name[$brand["subscription_type"]]."</div>",
	 			"<div class='text-right'>".$brand["created"]."</div>");
 		}

	}

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
