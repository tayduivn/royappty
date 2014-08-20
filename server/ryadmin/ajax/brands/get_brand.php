<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 11-08-2014
	* Version: 0.94
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_brand
	* brand_not_valid
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
	$page_path="server/ryadmin/ajax/brands/get_brand";
	debug_log("[".$page_path."] START");


 	$response=array();


 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// RYADMIN
	$ryadmin=array();$ryadmin["id_ryadmin"]=$_SESSION["ryadmin"]["id_ryadmin"];
	if(!checkRyadmin($ryadmin)){echo json_encode($response);die();}

 	// Data check START
 	$table="brands";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Brand (id_brand=".$_SESSION["admin"]["id_brand"].") doesn't exist");
		$response["error"]="ERROR Brand doesn't exist";
		$response["error_code"]="no_brand";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
	$fields=array();
	$brand=getInBD($table,$filter,$fields);

	$response["data"]["modals"]="
		<div class='modal fade' id='delete_brand_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_brand"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_brand_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='deleted_brand_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
						<br>
						<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
					</div>
					<div class='modal-body text-center'>
						<h6 class='no-margin'>".htmlentities($s["brand_deleted"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>


	";

	if($brand["active"]==1){
		$response["data"]["modals"].="
			<div class='modal fade' id='block_brand_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
							<br>
							<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["block_brand"], ENT_QUOTES, "UTF-8")."</h4>
						</div>
						<div class='modal-body'>
							<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
							<p class='no-margin'>".htmlentities($s["block_brand_alert"], ENT_QUOTES, "UTF-8")."</p>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
							<a href='' class='btn btn-primary accept_button'>".htmlentities($s["block"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>
			<div class='modal fade' id='block_brand_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
							<br>
							<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
						</div>
						<div class='modal-body text-center'>
							<h6 class='no-margin'>".htmlentities($s["brand_blocked"], ENT_QUOTES, "UTF-8")."</p>
						</div>
						<div class='modal-footer'>
							<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>
		";
	}else{
		$response["data"]["modals"].="
			<div class='modal fade' id='unblock_brand_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
							<br>
							<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["unblock_brand"], ENT_QUOTES, "UTF-8")."</h4>
						</div>
						<div class='modal-body'>
							<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
							<p class='no-margin'>".htmlentities($s["unblock_brand_alert"], ENT_QUOTES, "UTF-8")."</p>
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
							<a href='' class='btn btn-primary accept_button'>".htmlentities($s["unblock"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>
			<div class='modal fade' id='unblock_brand_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
							<br>
							<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
						</div>
						<div class='modal-body text-center'>
							<h6 class='no-margin'>".htmlentities($s["unbrand_blocked"], ENT_QUOTES, "UTF-8")."</p>
						</div>
						<div class='modal-footer'>
							<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>
		";
	}


	$response["data"]["page-title"]="<a href='../brands/'>".htmlentities($s["brands"], ENT_QUOTES, "UTF-8")."</a> / ".$brand["name"]."<a href='../brand/edit/?id_brand=".$_POST["id_brand"]."' class='m-l-10 pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["edit"], ENT_QUOTES, "UTF-8")."</a> ";
	if($brand["active"]==1){
		$response["data"]["page-title"].="<a href='javascript:show_modal(\"block_admin_alert\",\"javascript:update_brand(".$brand["id_brand"].",0)\")' class='pull-right m-t--3 m-l-10 btn btn-danger btn-mini pull-right'>".htmlentities($s["block"], ENT_QUOTES, "UTF-8")."</a>";
	}else{
		$response["data"]["page-title"].="<a href='javascript:show_modal(\"unblock_admin_alert\",\"javascript:update_brand(".$brand["id_brand"].",1)\")' class='pull-right m-t--3 m-l-10 btn btn-primary btn-mini pull-right'>".htmlentities($s["unblock"], ENT_QUOTES, "UTF-8")."</a>";
	}
	$response["data"]["page-title"].="<a href='javascript:show_modal(\"delete_admin_alert\",\"javascript:delete_admin(".$brand["id_brand"].")\")' class='pull-right m-t--3 m-l-10 btn btn-danger btn-mini pull-right'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>";




	$response["data"]["brand-data"]="
		<h6 class='pull-right'>".htmlentities($s["created"], ENT_QUOTES, "UTF-8")." ".date("Y-m-d",$brand["created"])."</h6>
		<h3 class='m-t-0'>".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."</h3>
		<div class='row'>
			<div class='col-md-6'>
				<h4>".htmlentities($s["subscription_data"], ENT_QUOTES, "UTF-8")."</h4>
				<h5><b>".htmlentities($s["status"], ENT_QUOTES, "UTF-8")."</b> ".$s["brands_active_icon"][$brand["active"]]." ".htmlentities($s["brands_active"][$brand["active"]], ENT_QUOTES, "UTF-8")."</h5>
				<h5><b>".htmlentities($s["subscription_type"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["subscription_type"], ENT_QUOTES, "UTF-8")."</h5>
				<h5><b>".htmlentities($s["payment_plan"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["payment_plan"], ENT_QUOTES, "UTF-8")."</h5>
				<h5><b>".htmlentities($s["payment_method"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["payment_method"], ENT_QUOTES, "UTF-8")."</h5>
				<h5><b>".htmlentities($s["payment_data"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["payment_data"], ENT_QUOTES, "UTF-8")."</h5>
				<h5><b>".htmlentities($s["expiration_date"], ENT_QUOTES, "UTF-8")."</b> ".date("Y-m-d",$brand["expriration_date"])."</h5>
			</div>
			<div class='col-md-6'>
				<h4>".htmlentities($s["brand_data"], ENT_QUOTES, "UTF-8")."</h4>
				<p>
					<b>".htmlentities($s["name"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["name"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["cif"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["cif"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_name"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_name"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_email"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_email"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_phone"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_phone"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_address"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_address"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_postal_code"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_postal_code"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_city"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_city"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_province"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_province"], ENT_QUOTES, "UTF-8")."<br/>
					<b>".htmlentities($s["contact_country"], ENT_QUOTES, "UTF-8")."</b> ".htmlentities($brand["contact_country"], ENT_QUOTES, "UTF-8")."<br/>
				</p>
			</div>
		</div>


";

	$blocks_count=0;
	for($i=1;$i<=4;$i++){
		if($brand["resume_block_".$i."_display"]==1){
			$blocks_count++;
		}
	}
	$blocks_width=100;
	if($blocks_count>0){
		$blocks_width=12/$blocks_count;
	}
	$response["data"]["resume-blocks"]="";
	for($i=1;$i<=4;$i++){
		$response["data"]["resume-block-".$i]="";
		if($brand["resume_block_".$i."_display"]==1){
			$table="brands";
			$filter=array();
			$filter["id_brand"]=array("operation"=>"=","value"=>$_POST["id_brand"]);
			$fields=array("resume_block_".$i."_title","resume_block_".$i."_data","resume_block_".$i."_link","resume_block_".$i."_link_content");

			$resume_block=getInBD($table,$filter,$fields);

			$response["data"]["resume-blocks"].="
			<div class='col-md-".$blocks_width."'>
				<div class='grid simple'>
					<div class='tiles pink'>
						<div class='tiles-body'>
							<h6 class='text-white all-caps no-margin'>
								".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_title"]], ENT_QUOTES, "UTF-8")."
							</h6>
							<div class='heading'>";
						$block_data=create_block_data($resume_block["resume_block_".$i."_title"],$brand["id_brand"]);
						$response["data"]["resume-blocks"].="

							<h1><span class='animate-number text-white' data-value='".$block_data."' data-animation-duration='1200'>0</h1>
							</div>
							<div class='description'>
								<a href='".$resume_block["resume_block_".$i."_link"]."' class='text-white'>".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_link_content"]], ENT_QUOTES, "UTF-8")."</a>
							</div>
						</div>
					</div>
				</div>
			</div>";
		}

	}



	$table="used_codes";
	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	$response["data"]["codes-validated-list"]="
		<h4 class='m-t-0'>".htmlentities($s["last_validated_codes"], ENT_QUOTES, "UTF-8")."</h4>
		<p class='m-t-40 text-center'><i class='fa fa-times fa-4x'></i></p>
		<p class='text-center'>".htmlentities($s["no_codes_validated"], ENT_QUOTES, "UTF-8")."</p>";
	if (isInBD($table,$filter)){
		$response["data"]["codes-validated-list"]="
		    <h4 class='m-t-0'>".htmlentities($s["last_validated_codes"], ENT_QUOTES, "UTF-8")."</h4>
			<table class='full-width'>
            	<thead>
                	<tr>
	                	<th>".htmlentities($s["campaign"], ENT_QUOTES, "UTF-8")."</th>
	                	<th class='text-right'>".htmlentities($s["date"], ENT_QUOTES, "UTF-8")."</th>
                	</tr>
                </thead>
				<tbody>";
		$fields=array();
		$order="created asc";
		$limit=10;
		$validated_codes=listInBD($table,$filter,$fields,$order,$limit);
		foreach($validated_codes as $key=>$validated_code){
			$table="campaigns";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$validated_code["id_campaign"]);
			$campaign=getInBD($table,$filter);
			$response["data"]["codes-validated-list"].="
			<tr>
            	<td><a href='../campaign/?id_campaign=".$campaign["id_campaign"]."' class='text-success'><i class='fa fa-bullhorn m-r-5'></i>".$campaign["name"]."</a></td>
                <td class='text-right'>".date("d/m/Y  H:m",$validated_code["created"])."</td>
            </tr>
			";
		}
		$response["data"]["used-codes-list"].="
				</tbody>
			</table>
		";
	}

	$response["data"]["graph-title"]="<h4 class='m-t-0'>".htmlentities($s["last_15_days"], ENT_QUOTES, "UTF-8")."</h4>";
	$table="validated_codes_day_summaries";
	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	$usage_count=0;
	for($i=0;$i<=14;$i++){
		$filter["start"]=array("operation"=>"=","value"=>$timestamp-((14-$i)*86400));
		$response["data"]["graph-label-".$i]=date("d/m",$timestamp-((14-$i)*86400));
		$response["data"]["graph-value-".$i]=0;
		if(isInBD($table,$filter)){
			$used_codes_day_summary=getInBD($table,$filter,$fields,$order,$limit);
			$usage_count+=$used_codes_day_summary;
			$response["data"]["graph-value-".$i]=$used_codes_day_summary["validated_codes_amount"];
		}

	}
	if($usage_count==0){
		$response["data"]["graph-empty"]="
			<div class='ajax-loader-graph-title'>
				<h4 class='m-t-0'>".htmlentities($s["last_15_days"], ENT_QUOTES, "UTF-8")."</h4>
			</div>
			<div class='text-center text-muted'>
				<p class='m-t-40'><i class='fa fa-bar-chart-o fa-4x'></i></p>
				<h6>".htmlentities($s["there_is_not_graph_data"], ENT_QUOTES, "UTF-8")."</h6>
			</div>
		";
		$response["cssdisplay"]["graph-empty"] = 1;
		$response["cssdisplay"]["graph"] = 0;
	}


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
