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
	$page_path="server/app/ajax/admins/get_admin";
	debug_log("[".$page_path."] START");


 	$response=array();


 	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

 	// Data check START

 	$table="admins";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR Admin (id_brand=".$_SESSION["admin"]["id_brand"].",id_admin=".$_POST["id_admin"].") doesn't exist");
 		$response["error"]="ERROR Admin doesn't exist";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;

 	$table="admins";
	$filter=array();
	$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
	$fields=array();
	$admin=getInBD($table,$filter,$fields);
	if($admin["brand_admin"]!=1){

		$response["data"]["modals"]="
		<div class='modal fade' id='delete_admin_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
						<br>
						<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_admin"], ENT_QUOTES, "UTF-8")."</h4>
					</div>
					<div class='modal-body'>
						<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
						<p class='no-margin'>".htmlentities($s["delete_admin_alert"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>
		<div class='modal fade' id='deleted_admin_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			<div class='modal-dialog'>
				<div class='modal-content'>
					<div class='modal-header'>
						<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
						<br>
						<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
					</div>
					<div class='modal-body text-center'>
						<h6 class='no-margin'>".htmlentities($s["admin_deleted"], ENT_QUOTES, "UTF-8")."</p>
					</div>
					<div class='modal-footer'>
						<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>
		</div>

		";
	}

	$response["data"]["page-title"]="<a href='../admins/'>".htmlentities($s["admins"], ENT_QUOTES, "UTF-8")."</a> / ".$admin["name"]."<a href='../admin/edit/?id_admin=".$_POST["id_admin"]."' class='m-l-10 pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["edit_admin"], ENT_QUOTES, "UTF-8")."</a> ";
	if($admin["brand_admin"]!=1){
		$response["data"]["page-title"].="<a href='javascript:show_modal(\"delete_admin_alert\",\"javascript:delete_admin(".$admin["id_admin"].")\")' class='pull-right m-t--3 m-l-10 btn btn-danger btn-mini pull-right'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>";
	}




	$response["data"]["admin-data"]="
		<h3 class='m-t-0'>".htmlentities($admin["name"], ENT_QUOTES, "UTF-8")."</h3>
		<h5>".$s["admins_active_icon"][$admin["active"]]." ".htmlentities($s["admins_active"][$admin["active"]], ENT_QUOTES, "UTF-8")."</h5>
		<h6>".htmlentities($s["permissions"], ENT_QUOTES, "UTF-8")."</h6>
		<h6>".$s["admins_can_login_icon"][$admin["can_login"]]." ".htmlentities($s["admins_can_login"], ENT_QUOTES, "UTF-8")."</h6>
		<h6>".$s["admins_can_validate_codes_icon"][$admin["can_validate_codes"]]." ".htmlentities($s["admins_can_validate_codes"], ENT_QUOTES, "UTF-8")."</h6>
		<h6>".$s["admins_can_manage_campaigns_icon"][$admin["can_manage_campaigns"]]." ".htmlentities($s["admins_can_manage_campaigns"], ENT_QUOTES, "UTF-8")."</h6>
		<h6 class='text-black'>";

	if($admin["last_connection"]==0){
		$response["data"]["admin-data"].=htmlentities($s["without_last_connection"], ENT_QUOTES, "UTF-8");
	}else{
		$response["data"]["admin-data"].=htmlentities($s["last_connection_the"], ENT_QUOTES, "UTF-8")." ".date("d/m/Y  H:m",$admin["last_connection"]);
	}


	$response["data"]["admin-data"].="
		</h6>";

	$blocks_count=0;
	for($i=1;$i<=4;$i++){
		if($admin["resume_block_".$i."_display"]==1){
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
		if($admin["resume_block_".$i."_display"]==1){
			$table="admins";
			$filter=array();
			$filter["id_admin"]=array("operation"=>"=","value"=>$_POST["id_admin"]);
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
						$block_data=create_block_data($resume_block["resume_block_".$i."_title"],$admin["id_admin"]);
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
	$response["data"]["codes-validated-list"]="<h4 class='m-t-0'>".htmlentities($s["last_validated_codes"], ENT_QUOTES, "UTF-8")."</h4><p class='text-center'><i class='fa fa-times fa-4x'></i></p><p class='text-center'>".htmlentities($s["no_codes_validated"], ENT_QUOTES, "UTF-8")."</p>";
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
	for($i=0;$i<=14;$i++){
		$filter["start"]=array("operation"=>"=","value"=>$timestamp-((14-$i)*86400));
		$response["data"]["graph-label-".$i]=date("d/m",$timestamp-((14-$i)*86400));
		$response["data"]["graph-value-".$i]=0;
		if(isInBD($table,$filter)){
			$used_codes_day_summary=getInBD($table,$filter,$fields,$order,$limit);
			$response["data"]["graph-value-".$i]=$used_codes_day_summary["validated_codes_amount"];
		}

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
