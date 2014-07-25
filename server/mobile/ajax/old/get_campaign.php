<?php
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
	
	include(PATH."mobile/include/inbd.php");

	debug_log("[server/mobile/ajax/campaigns/get_campaign] START");
	
 	$response=array();
 	
 	
 	// Data check START
 	if(!@issetandnotempty($_SESSION["user"]["id_user"])){
	 	$response["result"]=false;
		error_log("[server/mobile/ajax/campaigns/list] ERROR Data Missing: Session User ID ( ".$_SESSION["user"]["id_user"]." )");
 		$response["error"]="ERROR Data Missing: Session User ID ( ".$_SESSION["user"]["id_user"]." )";
 		echo json_encode($response);
 		die();
 	}
	if(!@issetandnotempty($_SESSION["user"]["id_brand"])){
	 	$response["result"]=false;
		error_log("[server/mobile/ajax/campaigns/list] ERROR Data Missing: Session Brand ID");
 		$response["error"]="ERROR Data Missing: Session Brand ID";
 		echo json_encode($response);
 		die();
 	}
  	$table="users";
 	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[server/ajax/campaigns/get_campaign] ERROR User ID (".$_SESSION["user"]["id_user"].") doesn't exist");
 		$response["error"]="ERROR User doesn't exist";
 		echo json_encode($response);
 		die();
 	}
 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[server/ajax/campaigns/get_campaign] ERROR User (".$_SESSION["user"]["id_brand"].") doesn't exist");
 		$response["error"]="ERROR Brand doesn't exist";
 		echo json_encode($response);
 		die();
 	}
 	
 	// Data check END
 	
	$response["result"]=true;
 	$table="campaigns";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);
	$fields=array();
	$campaign=getInBD($table,$filter,$fields);
	$response["data"]["header-menu"]="
		<div class='navbar-inner'>
			<table style='width:100%'>
				<tr>
					<td class='text-left' style='width:25%'><a href='../index.html' class='m-l-10 h4' style=''>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
					<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
					<td class='text-right' style='width:25%'></td>
				</tr>
			</table>
 		</div>
		  
 	";	
 		$response["data"]["campaign"]="
 			<div class='col-md-12'>
				<div>
					<img class='full-width' src='".$url_server."resources/campaign-image/".$campaign["campaign_image_path"]."'/>
				</div>
				<h5 class='text-center'>".htmlentities($campaign["content"], ENT_QUOTES, "UTF-8")."</h5>
				<div class='text-center m-l-20 m-r-20'>
					<a href='./validate/index.html?id_campaign=".$campaign["id_campaign"]."' class='btn btn-block'>".htmlentities($campaign["button_title"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		
	";
	

	
	
	

 	echo json_encode($response);
	debug_log("[server/mobile/ajax/campaigns/get_campaign] END");

?>