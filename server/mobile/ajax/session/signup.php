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
	$page_path = "server/mobile/ajax/session/signup";
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
	 	<div class='page-container row bg-white'>
			<div class='content'>
				<div class='m-t-40'>
					<div class='text-center'>
						<h1 class=''>".$s["signup_title"]."</h1>
						<h4>".$s["signup_subtitle"]."</h4>
					</div>
					<div class='m-l-20 m-r-20'>
						<form method='post'>
							<div id='form-warning' class='text-error text-center h5'></div>
							<div class='form-group'>
								<label class='form-label'>".$s["email"]."</label>
								<span class='help'></span>
								<div class='controls'>
									<input type='text' id='email' name='email' class='form-control'>
								</div>
							</div>
							<div class='form-group'>
								<label class='form-label'>".$s["password"]."</label>
								<span class='help'></span>
								<div class='controls'>
									<input type='password' id='password' name='password' class='form-control'>
								</div>
							</div>
							<div style='overflow:auto'>
								<div class='form-group text-center'>
									<input type='submit' class='btn btn-success btn-block' value='".$s["signup_button"]."' />
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
