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
	*		Empty code -> Handeled here
	*		No matching code -> Handeled here
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/accounts/verification/verification";
	debug_log("[".$page_path."] START");
	$response=array();


	/*********************************************************
	* DATA CHECK
	*
	* Using codeverification to know if there was an error
	* Empty code and Not maching are handeled in operations
	* block.
	*
	*********************************************************/

	$codeverification=false;
	if(!issetandnotempty($_POST["verification_code"])){
		debug_log("[".$page_path."] ERROR Data Missing code");
	}else{
		$table='admins';
		$filter=array();
		$filter["verification_code"]=array("operation"=>"=","value"=>$_POST["verification_code"]);
		$filter["verified"]=array("operation"=>"=","value"=>0);
		if(!isInBD($table,$filter)){
			debug_log("[".$page_path."] ERROR Code doesnt exists code:{".$_POST["verification_code"]."}");
		}else{
			$codeverification=true;
		}
	}




	/*********************************************************
	* AJAX OPERATIONS
	*
	* Send the page diferent page contents to show the admin
	* if there was an error or not.
	*
	*********************************************************/

	$response["result"]=true;

	if($codeverification){
			$response["data"]["verification-data"]="
				<div class='text-center' style='height:100%'>
					<img class='m-t-40 m-b-0' style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
					<h3>".htmlentities($s["verification_title"], ENT_QUOTES, "UTF-8")."</h3>
					<h5 class='p-b-20'>".htmlentities($s["verification_subtitle_success"], ENT_QUOTES, "UTF-8")."</h5>
					<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
				</div>

			";
	}else{
		$response["data"]["verification-data"]="
			<div class='text-center' style='height:100%'>
				<img class='m-t-40 m-b-0' style='width:320px' src='".$url_server."server/app/assets/img/royappty-logo.png' />
				<h3>".htmlentities($s["verification_title"], ENT_QUOTES, "UTF-8")."</h3>
				<h5 class='p-b-20 text-danger'>".htmlentities($s["verification_subtitle_error"], ENT_QUOTES, "UTF-8")."</h5>
				<a href='../' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>

		";
	}


	/*********************************************************
	* DATABASE REGISTRATION
	*
	* If Admin in verificated, update the admin DB table and
	* erase the activation code.
	*
	*********************************************************/

	if($codeverification){
		$table='admins';
		$filter=array();
		$filter["verification_code"]=array("operation"=>"=","value"=>$_POST["verification_code"]);
		$data=array();
		$data["verified"]=1;
		$data["verification_code"]="";
		updateInBD($table,$filter,$data);
	}


	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

 	echo json_encode($response);
	debug_log("[".$page_path."] END");
	die();

?>
