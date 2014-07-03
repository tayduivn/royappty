<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));
	
	include(PATH."include/inbd.php");

	debug_log("[server/ajax/campaigns/get_campaign] START");
	
 	$response=array();
 	
 	
 	// Data check START
 	if(!issetandnotempty($_SESSION["admin"]["id_admin"])){
	 	$response["result"]=false;
		error_log("[server/ajax/campaigns/get_campaign] ERROR Data Missing Session id_admin");
 		$response["error"]="ERROR Data Missing Session id_admin";
 		echo json_encode($response);
 		die();
 	}
	if(!issetandnotempty($_POST["id_campaign"])){
	 	$response["result"]=false;
		debug_log("[server/ajax/campaigns/get_campaign] ERROR Data Missing id_campaign");
 		$response["error"]="ERROR Data Missing id_campaign";
 		echo json_encode($response);
 		die();
 	}
  	$table="admins";
 	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_admin"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[server/ajax/campaigns/get_campaign] ERROR User (".$_SESSION["admin"]["id_admin"].") doesn't exist");
 		$response["error"]="ERROR User (".$_SESSION["admin"]["id_admin"].") doesn't exist";
 		echo json_encode($response);
 		die();
 	}
 	$table="campaigns";
 	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_admin"]);
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[server/ajax/campaigns/get_campaign] ERROR Campaign (id_user=".$_SESSION["admin"]["id_admin"].",id_campaign=".$_GET["id_campaign"].") doesn't exist");
 		$response["error"]="ERROR Campaing (id_user=".$_SESSION["admin"]["id_admin"].",id_campaign=".$_POST["id_campaign"].") doesn't exist";
 		echo json_encode($response);
 		die();
	}
 	// Data check END
	
	$response["result"]=true;
 	$table="campaigns";
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);
	$fields=array("name","description","type","status","campaign_icon_path","ini_date","end_date","cost","profit");
	$campaign=getInBD($table,$filter,$fields);
	
	
	$response["data"]["promo-icon"]="<img class='full-width' src='".$campaign["campaign_icon_path"]."'/>";
	$response["data"]["name"]=$campaign["name"];
	$response["data"]["description"]=htmlentities($campaign["description"]);
	$response["data"]["status"]=htmlentities($s["campaigns_status"][$campaign["status"]]);
	$response["data"]["type"]=htmlentities($s["campaigns_types"][$campaign["type"]]);
	$response["data"]["ini-date"]=date("d/m/Y H:m",$campaign["ini_date"]);
	if($campaign["ini_date"]==0){
		$response["data"]["ini-date"]=htmlentities($s["no_date"]);
	}
	$response["data"]["end-date"]=date("d/m/Y  H:m",$campaign["end_date"]);
	if($campaign["end_date"]==0){
		$response["data"]["end-date"]=htmlentities($s["no_date"]);
	}
	$response["data"]["profit-cost"]=htmlentities("Esta promoción tiene un coste de ".$cost." € y un beneficio de ".$profit." €");



 	$table="campaign_notes";
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);
	$campaign_notes=listInBD($table,$filter,$fields);

 	echo json_encode($response);
	error_log("[server/ajax/campaigns/get_campaign] END");

?>