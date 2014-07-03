<?php
 	@session_start();
	
 	$response=array();
  	$response["result"]=true;
 	$session_data["id_brand"]=1;
 	$_SESSION['user'] = $session_data;
 	
 	echo json_encode($response);
?>