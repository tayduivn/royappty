<?php
	/************************************************************
  * Royappty
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Modification: 10-02-2014
  * Version: 1.0
  * licensed through CC BY-NC 4.0
  ************************************************************/


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
 	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
 	include(PATH."include/inbd.php");
	$page_path = "server/mobile/ajax/session/signin";
 	debug_log("[".$page_path."] START");
 	$response=array();



 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/

 	// BRAND
 	$brand=array();$brand["id_brand"]=$_GET["id_brand"];
	if(!checkBrand($brand)){echo "jsonCallback(".json_encode($response).")";die();}

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
 	echo "jsonCallback(".json_encode($response).")";
 	die();

?>
