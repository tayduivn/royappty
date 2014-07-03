<?php
	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
	
	include(PATH."mobile/include/inbd.php");

	debug_log("[server/mobile/ajax/campaigns/list] START");
	
 	$response=array();
 	
 	
 	// Data check START
 	if(!issetandnotempty($_SESSION["user"]["id_user"])){
	 	$response["result"]=false;
		error_log("[server/mobile/ajax/campaigns/list] ERROR Data Missing: Session User ID ( ".$_SESSION["user"]["id_user"]." )");
 		$response["error"]="ERROR Data Missing: Session User ID ( ".$_SESSION["user"]["id_user"]." )";
 		echo json_encode($response);
 		die();
 	}
	if(!issetandnotempty($_SESSION["user"]["id_brand"])){
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
 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_brand"]);
	$fields=array("app_title");
	$brand=getInBD($table,$filter,$fields);
	
 	$table="campaigns";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["user"]["id_user"]);
	$filter["status"]=array("operation"=>"=","value"=>1);
	$fields=array();
	$campaigns=listInBD($table,$filter,$fields);
	$response["data"]["campaigns-list"]="";
	$response["data"]["header-menu"]="
	<div class='navbar-inner'>
			<table style='width:100%'>
				<tr>
					<td class='text-center' style='width:100%'><h4 class='text-center'>".htmlentities($brand["app_title"], ENT_QUOTES, "UTF-8")."</h4></td>
				</tr>
			</table>
 		</div>
		  
 	";	
	foreach($campaigns as $key=>$campaign){
		$img_file = PATH."../resources/campaign-icon/".$campaign["campaign_icon_path"];
		$imgData = base64_encode(file_get_contents($img_file));
		$src = 'data: '.mime_content_type($img_file).';base64,'.$imgData;

		$response["data"]["campaigns-list"].="
		<div class='col-md-12'>
			<a href='./campaign/index.html?id_campaign=".$campaign["id_campaign"]."'>
				<img class='full-width' src='".$src."'/>
			</a>
		</div>
		";	
	}
	
	
	
	

 	echo json_encode($response);
	debug_log("[server/mobile/ajax/campaigns/list] END");

?>