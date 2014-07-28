<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*	- no_brand
	*	- brand_not_valid
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
 	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));
 	include(PATH."mobile/include/inbd.php");
	$page_path = "server/mobile/ajax/session/signup";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

 	// BRAND
 	$brand=array();$brand["id_brand"]=$_POST["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

 	$response["result"]=true;

 	$response["data"]["page"]="
	 	<div class='page-container row bg-white'>
			<div class='content'>
				<div class='m-t-40'>
					<div class='text-center'>
						<h1 class=''>".$s["signup_title"]."</h1>
						<h4>".$s["signup_subtitle"]."</h4>
					</div>
					<div class='m-l-20 m-r-20'>
						<form onsubmit='signup()' method='post'>
							<div id='form-warning' class='text-error text-center h5'></div>";
	$table="brand_user_fields";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$brand_user_fields=listInBD($table,$filter);
	foreach($brand_user_fields as $key=>$brand_user_field){
		$table="user_fields";
		$filter=array();
		$filter["id_user_field"]=array("operation"=>"=","value"=>$brand_user_field["id_user_field"]);
		$user_field=getInBD($table,$filter);

		$response["data"]["page"].="
							<div class='form-group'>
								<label class='form-label'>".$user_field_title_s[$user_field["title"]]."</label>
								<span class='help'></span>";
		if($user_field["field_type"]=="text"){
			$response["data"]["page"].="
								<div class='controls'>
									<input type='text' id='".$user_field["title"]."' name='".$user_field["title"]."' class='form-control'>
								</div>";
		}
		$response["data"]["page"].="
							</div>";
	}

 	$response["data"]["page"].="
							<div style='overflow:auto'>
								<div class='form-group text-center'>
									<input type='submit' class='btn btn-success btn-block' value='".$s["signup_button"]."' />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>

 	";


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
