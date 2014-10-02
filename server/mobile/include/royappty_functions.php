<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/


	function checkClosed(){
		global $page_path;
		global $response;
		global $CONFIG;

		if($CONFIG["close"]){
			$response["result"]=false;
			debug_log("[".$page_path."] ERROR System Closed");
			$response["error"]="ERROR System Closed";
			$response["error_code"]="system_closed";
			return false;
			die();
		}

		return true;
		die();
	}

	function checkBrand($brand){
		global $page_path;
		global $response;

		if(!@issetandnotempty($brand["id_brand"])){
		 	$response["result"]=false;
			debug_log("[".$page_path."] (checkBrand) ERROR Data Missing id_brand");
	 		$response["error"]="ERROR Data Missing brand identificator";
	  		$response["error_code"]="no_brand";
	 		return false;
	 		die();
	 	}
	 	$table="brands";
	 	$filter=array();
	 	$filter["id_brand"]=array("operation"=>"=","value"=>$brand["id_brand"]);
	 	$filter["active"]=array("operation"=>"=","value"=>1);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] (checkBrand) ERROR Brand not exists or inactive (id_brand=".$brand["id_brand"]." | active=1)");
	 		$response["error"]="ERROR Data Missing not exists or inactive";
	 		$response["error_code"]="brand_not_valid";
	 		return false;
	 		die();
	 	}
	 	return true;
	 	die();

	}

	function checkUser($user){
		global $page_path;
		global $response;

		if(!@issetandnotempty($user["id_user"])){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR Data Missing id_user");
	 		$response["error"]="ERROR Data Missing user identificator";
	  		$response["error_code"]="no_user";
			return false;
	 		die();
	 	}

	 	$table="users";
	 	$filter=array();
	 	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR User not exists (id_user=".$user["id_user"].")");
	 		$response["error"]="ERROR User not in the system";
	 		$response["error_code"]="user_not_valid";
	 		return false;
	 		die();
	 	}

	 	$table="users";
	 	$filter=array();
	 	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	 	$filter["active"]=array("operation"=>"=","value"=>1);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR User not exists (id_user=".$user["id_user"].")");
	 		$response["error"]="ERROR User not in the system";
	  		$response["error_code"]="user_inactive";
			echo json_encode($response);
	 		die();
	 	}
	 	return true;
	 	die();
	}


	function checkCode($code){
		global $page_path;
		global $response;

		if(!@issetandnotempty($code["promo_password"])){
			$response["result"]=false;
			debug_log("[".$page_path."] (checkCode) ERROR Data Missing promo_code");
			$response["error"]="ERROR Data Missing brand identificator";
				$response["error_code"]="no_brand";
			return false;
			die();
		}

	 	$table="admins";
	 	$filter=array();
	 	$filter["id_brand"]=array("operation"=>"=","value"=>$code["id_brand"]);
	 	$filter["promo_password"]=array("operation"=>"=","value"=>$code["promo_password"]);
	 	if(!isInBD($table,$filter)){
		 	$response["result"]=false;
			debug_log("[".$page_path."] ERROR Code incorrect (id_brand=".$code["id_brand"]." | promo_password=".$code["promo_password"].")");
	 		$response["error"]="ERROR Promo Password not valid";
	 		$response["error_code"]="promo_password_not_valid";
	 		return false;
	 		die();
	 	}
	 	return true;
	 	die();

	}

?>
