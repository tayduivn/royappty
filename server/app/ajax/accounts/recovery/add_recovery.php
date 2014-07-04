<?php
 	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path= "server/app/ajax/account/login/create_session";
 	debug_log("[".$page_path."] START");

 	$response=array();


 	if(!issetandnotempty($_POST["email"])){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing email");
  		$response["error_code"]="reload";
  		echo json_encode($response);
 		die();
 	}

 	$table="admins";
 	$filter=array();
 	$filter["email"]=array("operation"=>"=","value"=>$_POST["email"]);
 	if(!isInBD($table,$filter)){
	 	$response["result"]=false;
		debug_log("[".$page_path."] ERROR Recovery error {email:'".$_POST["email"]."'}");
  	$response["error_str"]=$error["recovery_not_email"];
  	echo json_encode($response);
 		die();
 	}
 	$admin=getInBD($table,$filter);



	$response["result"]=true;

  $table="recovery_codes";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$admin["email"]);
  if(isInBD($table,$filter)){
    deleteInBD($table,$filter);
  }
  $table="recovery_codes";
  $data=array();
  $data["email"]=$admin["email"];
  $data["code"]=md5("code".$admin["email"].$timestamp);
 	addInBD($table,$data);



	debug_log("[".$page_path."] Code Created recovery_code:{email:".$data["email"].",code:".$data["code"]."}");
 	debug_log("[".$page_path."] END");


 	echo json_encode($response);
?>
