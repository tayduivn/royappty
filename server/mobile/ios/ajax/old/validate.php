<?php
	/*********************************************************
	*	
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 1.01
	*
 	*********************************************************/
	
	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*	- no_brand
	*	- brand_not_valid
	*	- no_user
	*	- user_not_valid
	*	- user_inactive
	*
	*********************************************************/

	
	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
 	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:m:00"));
 	include(PATH."mobile/include/inbd.php");
	$page_path = "server/mobile/ajax/campaign/validate";
 	debug_log("[".$page_path."] START");
 	$response=array();
 	
 	
 	
 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/
 	
 	// BRAND 
 	$brand=array();$brand["id_brand"]=$_SESSION["user"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}	
 	// USER
  	$user=array();$user["id_user"]=$_SESSION["user"]["id_user"];
	if(!checkUser($user)){echo json_encode($response);die();}
	// CODE
  	$code=array();$code["id_brand"]=$_SESSION["user"]["id_brand"];$code["id_brand"]=$_SESSION["user"]["id_brand"];
	if(!checkCode($user)){echo json_encode($response);die();}	
 	
 	
 	
 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/
 	
 	$response["result"]=true;
  	$_SESSION['user']=array();
    $_SESSION['user']["id_user"] = $_POST["id_user"];
    $_SESSION['user']["id_brand"] = $_POST["id_brand"];
	debug_log("[".$page_path."] Session Created user:{id_user:".$_SESSION['user']["id_user"].",id_brand:".$_SESSION['user']["id_brand"]."}");



 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/
 	
 	$table="users";
 	$filter=array();
 	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
 	$data=array();
 	$data["last_connection"] = strtotime(date("Y-m-d H:i:00"));
 	updateInBD($table,$filter,$data);
	debug_log("[".$page_path."] User (".$_SESSION['user']["id_user"].") Update last_connection:".$data["last_connection"]);
 	
 	
 	
 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/
 	
 	debug_log("[".$page_path."] END");
 	echo json_encode($response);






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
				<td class='text-left' style='width:25%'><a href='../index.html?id_campaign=".$campaign["id_campaign"]."' class='m-l-10 h4' style=''>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a></td>
				<td class='text-center' style='width:50%'><h4 class='text-center'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</h4></td>
				<td class='text-right' style='width:25%'></td>
			</tr>
		</table>
 	</div>
 		
		  
 	";	

	$response["data"]["validate-code-step-1"]="
			<form id='form-step1'>
				<h2 class='text-center m-t-80'>".htmlentities($s["validate_code_title"], ENT_QUOTES, "UTF-8")."</h2>
				<h4 class='text-center'>2334SWF</h4>
				<h5 class='text-center m-t-40 m-l-30 m-r-30'>".htmlentities($s["validate_code_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
				<div class='text-center m-t-40 m-l-20 m-r-20'>
					<input type='submit' class='btn btn-block' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
				</div>
			</form>
			";
			$response["data"]["validate-code-step-2"]="
			<form id='form-step2' class='m-l-20 m-r-20'>
				<div id='form-warning'></div>
				<div class='text-center'>
					<div class='form-group m-t-80'>
						<div class='form-group'>
							<h3 class='form-label'>".htmlentities($s["insert_promo_code"], ENT_QUOTES, "UTF-8")."</h3>
							<span class='help'></span>
							<div class='controls'>
								<input type='password' id='promo_code' name='promo_code' class='form-control' style='text-align:center'>
							</div>
						</div>
					</div>
				</div>
				
				<div class='text-center m-t-20'>
					<input type='submit' class='btn btn-block btn-large' value='".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."' />
				</div>
			</form>
			";
	
	$response["data"]["validate-code-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='promo_code'/>
		</form>
	";
	$response["data"]["validate-code-step-loading"]="
		<div class='text-center m-t-40 m-l-20 m-r-20'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<h5 class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</h5>
			<div class='m-t-20'>
				<a href='./index.html?id_campaign=".$campaign["id_campaign"]."' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["validate-code-step-error"]="
		<div class='text-center m-t-20 m-l-20 m-r-20'>
			<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<h5 class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</h5>
			<div class='m-t-20'>
				<a href='javascript:prevstep()' class='btn btn-block'>".htmlentities($s["try_again"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["validate-code-step-success"]="
		<div class='text-center m-t-20 m-l-20 m-r-20'>
			<h1 class='text-center'><i class='fa fa-check fa-4x'></i></h1>
			<h3 class='text-center'>".htmlentities($s["validate_code_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<h5 class='msg'>".htmlentities($s["validate_code_success_subtitle"], ENT_QUOTES, "UTF-8")."</h5>
			<div class='m-t-20 m-l-20 m-r-20'>
				<a href='../../index.html' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	
	
	
	

 	echo json_encode($response);
	debug_log("[server/mobile/ajax/campaigns/get_campaign] END");

?>