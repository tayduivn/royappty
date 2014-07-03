<?php
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/requests/list";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
	
 	$response=array();
 	

 	
	
	$response["result"]=true;
 	$response["data"]["page-title"] = "<a href='./'>".htmlentities($s["requests"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["all_requests"], ENT_QUOTES, "UTF-8");
 	$response["data"]["table-header"] = "
 		<th style='width:70%'>".htmlentities($s["id_request"], ENT_QUOTES, "UTF-8")."</th>
 		<th style='width:20%'>".htmlentities($s["status"], ENT_QUOTES, "UTF-8")."</th>
        <th style='width:10%'>".htmlentities($s["creation_date"], ENT_QUOTES, "UTF-8")."</th>";
 	
 	if(!issetandnotempty($_POST["status"])){
	 	$_POST["status"]=0;
 	}
 
 	for($i=0;$i<=3;$i++){
	 	$tab_active[$i]="";
	 	if($_POST["status"]==$i){
		 	$tab_active[$i]="class='active'";
	 	}
 	}
 	
 	$response["data"]["tabs"]="
        	<li ".$tab_active[0]."><a href='?status=0'>".htmlentities($s["all_requests"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[1]."><a href='?status=in_process'>".htmlentities($s["active_requests"], ENT_QUOTES, "UTF-8")."</a></li>
            <li ".$tab_active[2]."><a href='?status=ended'>".htmlentities($s["end_requests"], ENT_QUOTES, "UTF-8")."</a></li>
           
    ";
 	
 	$response["data"]["modals"]=" 	
		<div class='modal fade' id='delete_request_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_request"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_request_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='deleted_request_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
						<br>
						<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
					</div>
					<div class='modal-body text-center'>
						<h6 class='no-margin'>".htmlentities($s["request_deleted"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
 	";
	
	
	

 	echo json_encode($response);
	debug_log("[server/ajax/requests/get_request] END");

?>