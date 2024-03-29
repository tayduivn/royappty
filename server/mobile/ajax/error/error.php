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
	*
	*
	*********************************************************/


	/*********************************************************
 	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
 	*********************************************************/
  define('PATH', str_replace('\\', '/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/inbd.php");
	$page_path = "server/mobile/ajax/error/error";
 	debug_log("[".$page_path."] START");
 	$response=array();


 	/*********************************************************
 	* DATA CHECK
 	*********************************************************/



 	/*********************************************************
 	* AJAX OPERATIONS
 	*********************************************************/

 	$response["result"]=true;

 	switch ($_GET["error_code"]){
 		case "no_brand":
 			$response["data"]["page"]="
 			<div class='page'>
				<div class='page-container row'>
					<div class='page-content bg-white page-mobile'>
						<div class='content'>
							<div class='col-md-12'>
								<div class='text-center m-t-20 m-l-20 m-r-20'>
									<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
									<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
									<h5 class='msg'>".htmlentities($error["no_brand"], ENT_QUOTES, "UTF-8")."</h5>
									<div class='m-t-20'>
										<a href='../' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
 			";
 			break;
 		case "brand_not_valid":
 			$response["data"]["page"]="
 			<div class='page'>
				<div class='page-container row'>
					<div class='page-content bg-white page-mobile'>
						<div class='content'>
							<div class='col-md-12'>
								<div class='text-center m-t-20 m-l-20 m-r-20'>
									<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
									<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
									<h5 class='msg'>".htmlentities($error["brand_not_valid"], ENT_QUOTES, "UTF-8")."</h5>
									<div class='m-t-20'>
										<a href='../' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
 			";
 			break;
 		case "user_inactive":
 			$response["data"]["page"]="
 			<div class='page'>
				<div class='page-container row'>
					<div class='page-content bg-white page-mobile'>
						<div class='content'>
							<div class='col-md-12'>
								<div class='text-center m-t-20 m-l-20 m-r-20'>
									<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
									<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
									<h5 class='msg'>".htmlentities($error["user_inactive"], ENT_QUOTES, "UTF-8")."</h5>
									<div class='m-t-20'>
										<a href='../' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
 			";
 			break;
 		case "ajax_error":
 			$response["data"]["page"]="
 			<div class='page'>
				<div class='page-container row'>
					<div class='page-content bg-white page-mobile'>
						<div class='content'>
							<div class='col-md-12'>
								<div class='text-center m-t-20 m-l-20 m-r-20'>
									<h1 class='text-center'><i class='fa fa-times fa-4x'></i></h1>
									<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
									<h5 class='msg'>".htmlentities($error["ajax_error"], ENT_QUOTES, "UTF-8")."</h5>
									<div class='m-t-20'>
										<a href='../' class='btn btn-block'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
 			";
 			break;
	 	default:
 	}




 	/*********************************************************
 	* DATABASE REGISTRATION
 	*********************************************************/




 	/*********************************************************
 	* AJAX CALL RETURN
 	*********************************************************/



 	echo "jsonCallback(".json_encode($response).")";
	debug_log("[".$page_path."] END");

?>
