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
	$timestamp=strtotime(date("Y-m-d H:i:00"));
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
	 	<div class='page'>
	 		<div class='page-container row'>
				<div class='page-content bg-white page-mobile'>
					<div class='content'>
						<div class='col-md-12'>
							<div class='text-center m-t-40 m-l-20 m-r-20'>
								<div class='loader-activity'></div>
								<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
								<h5 class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</h5>
							</div>
						</div>
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
