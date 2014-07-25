<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
<<<<<<< HEAD
<<<<<<< HEAD
	* Last Edit: 23-06-2014
	* Version: 0.91
	*
	*********************************************************/
	
=======
	* Last Edit: 17-07-2014
=======
	* Last Edit: 21-07-2014
>>>>>>> 709238bf3bbd33e8717121209baf54ef0fbe0e24
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* no_brand
	* brand_not_valid
	*	no_admin
	* admin_not_valid
	* admin_inactive
	* post_no_user
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
>>>>>>> FETCH_HEAD
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/users/get_user";
	debug_log("[".$page_path."] START");

 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

 	// Data check START
	if(!@issetandnotempty($_POST["id_user"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_user");
		$response["error_code"]="post_no_user";
		echo json_encode($response);
		die();
	}

 	$table="users";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR user (id_brand=".$_SESSION["admin"]["id_brand"].",id_user=".$_POST["id_user"].") doesn't exist");
 		$response["error"]="ERROR user doesn't exist";
 		echo json_encode($response);
 		die();
	}

 	// Data check END

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="users";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
	$user=getInBD($table,$filter);

	$response["data"]["modals"]="
	<div class='modal fade' id='user_notes_viewer' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
	    	<div class='modal-content'>
	    		<div class='modal-msg'>
	    		</div>

				<div class='modal-footer'>
					<a type='button' href='#' class='btn btn-danger pull-left accept_button'>".htmlentities($s["delete_note"], ENT_QUOTES, "UTF-8")."</a>
					<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["close"], ENT_QUOTES, "UTF-8")."</button>
				</div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='user_notes_add' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
	    		<div class='modal-content'>
	        		<div class='modal-header'>
	            	<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
					<br>
					<h4 id='myModalLabel' class='semi-bold'><i class='fa fa-file-text-o'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</h4>
				</div>
				<div class='modal-body'>
					<form id='user_notes_add_form' action='javascript:add_user_note()'>
						<div id='form-warning'></div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["title"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["title_note_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' id='title' name='title' class='form-control'>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($s["content"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($s["content_note_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<textarea class='form-control' rows=4 id='content' name='content'></textarea>
							</div>
						</div>
					</form>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["close"], ENT_QUOTES, "UTF-8")."</button>
					<a href='javascript:add_user_note()' class='btn btn-primary'>".htmlentities($s["add"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>
	</div>
	";
	$table='brand_user_fields';
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["main_field"]=array("operation"=>"=","value"=>1);
	$brand_user_fields=getInBD($table,$filter);

	$table='user_field_data';
	$filter=array();
	$filter["id_user_field"]=array("operation"=>"=","value"=>$brand_user_fields["id_user_field"]);
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	$user_field_data=getInBD($table,$filter);

	$response["data"]["page-title"]="<a href='../users/'>".htmlentities($s["users"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($user_field_data["field_value"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";


	$response["data"]["user-data"]="
		<h3 class='m-t-0'>".htmlentities($user_field_data["field_value"], ENT_QUOTES, "UTF-8")."</h3>
		<h5>";

	if($user["created"]==0){
		$response["data"]["user-data"].=htmlentities($s["without_created_date"], ENT_QUOTES, "UTF-8");
	}else{
		$response["data"]["user-data"].=htmlentities($s["created_date_the"], ENT_QUOTES, "UTF-8")." ".date("d/m/Y  H:m",$user["created"]);
	}


	$response["data"]["user-data"].="
		</h5>
		<h5>";
	if($user["last_connection"]==0){
		$response["data"]["user-data"].=htmlentities($s["without_last_connection"], ENT_QUOTES, "UTF-8");
	}else{
		$response["data"]["user-data"].=htmlentities($s["last_connection_the"], ENT_QUOTES, "UTF-8")." ".date("d/m/Y  H:m",$user["last_connection"]);
	}

	$response["data"]["user-data"].="
		</h5>";

	$table='user_field_data';
	$filter=array();
	$filter["id_user_field"]=array("operation"=>"<>","value"=>$brand_user_fields["id_user_field"]);
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	$user_field_datas=listInBD($table,$filter);
	foreach($user_field_datas as $key=>$user_field_data){
		$table="user_fields";
		$filter=array();
		$filter["id_user_field"]=array("operation"=>"=","value"=>$user_field_data["id_user_field"]);
		$user_field=getInBD($table,$filter);
		$response["data"]["user-data"].="<p><b>".$user_field_title_s[$user_field["title"]]."</b> ".$user_field_data["field_value"]."</p>";
	}




 	$table="user_notes";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
	$fields=array();
	$table_order=" created desc";
	$limit = "10";

	$response["data"]["notes-list"]="
		<h4 class='m-t-0'>
			".htmlentities($s["notes"], ENT_QUOTES, "UTF-8")."
			<a href='javascript:show_modal(\"user_notes_add\",\"\")' class='btn btn-white btn-mini pull-right'><i class='fa fa-plus'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</a>
		</h4>
		<div class='text-center'>
			<i class='fa fa-file-text-o fa-4x m-b-10'></i>
			<p>
				".htmlentities($s["user_there_are_no_notes_to_show"], ENT_QUOTES, "UTF-8")."
			</p>
			<a class='btn btn-white' href='javascript:show_modal(\"user_notes_add\",\"\")'>".htmlentities($s["add_first_note"], ENT_QUOTES, "UTF-8")."</a>
		</div>";



	if(isInBD($table,$filter)){
		$response["data"]["notes-list"]="<h4 class='m-t-0'>".htmlentities($s["notes"], ENT_QUOTES, "UTF-8")." <a href='javascript:show_modal(\"user_notes_add\",\"\")' class='btn btn-white btn-mini pull-right'><i class='fa fa-plus'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</a></h4>";
		$user_notes=listInBD($table,$filter,$fields,$table_order,$limit);
		foreach($user_notes as $key=>$user_note){
			$user_note["title_preview"]=$user_note["title"];
			if(strlen($user_note["title"])>23){
				$user_note["title_preview"]=substr($user_note["title"],0,20)."...";
			}
			$response["data"]["notes-list"].="<div class=''><span class='text-black'>".date("d/m/Y",$user_note["created"])."</span> <a href='javascript:view_note(".$user_note["id_user_note"].")' class='text-success'>".htmlentities($user_note["title_preview"], ENT_QUOTES, "UTF-8")."</a></div>";
		}
		if(countInBD($table,$filter)>10){
			$response["data"]["notes-list"].="
				<div class='text-center m-t-10'>
					<a href='javascript:show_modal(\"user_all_notes\",\"\")' class='btn btn-mini btn-white'>".htmlentities($s["view_all_notes"], ENT_QUOTES, "UTF-8")."</a>
				</div>";
			$user_notes=listInBD($table,$filter,$fields,$table_order);

			$response["data"]["modals"].="
			<div class='modal fade' id='user_all_notes' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
							<br>
							<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["view_all_notes"], ENT_QUOTES, "UTF-8")."</h4>
						</div>
						<div class='modal-body'>

			";
			foreach($user_notes as $key=>$user_note){
				$response["data"]["modals"].="<div class=''><span class='text-black'>".date("d/m/Y",$user_note["created"])."</span> <a href='javascript:view_note(".$user_note["id_user_note"].")' class='text-success'>".htmlentities($user_note["title"], ENT_QUOTES, "UTF-8")."</a></div>";
			}
			$response["data"]["modals"].="
						</div>
						<div class='modal-footer'>
							<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
							<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>";
		}

	}

	for($i=1;$i<=4;$i++){
		$response["data"]["resume-block-".$i]="";
		if($user["resume_block_".$i."_display"]==1){
			$table="users";
			$filter=array();
			$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
			$fields=array("resume_block_".$i."_title","resume_block_".$i."_data","resume_block_".$i."_link","resume_block_".$i."_link_content");

			$resume_block=getInBD($table,$filter,$fields);

			$response["data"]["resume-block-".$i]="
			<div class='tiles pink'>
				<div class='tiles-body'>
					<h6 class='text-white all-caps no-margin'>
						".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_title"]], ENT_QUOTES, "UTF-8")."
					</h6>
					<div class='heading'>
						".stripslashes($resume_block["resume_block_".$i."_data"])."
					</div>
					<div class='description'>
						<a href='".$resume_block["resume_block_".$i."_link"]."' class='text-white'>".htmlentities($resume_block_s[$resume_block["resume_block_".$i."_link_content"]], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</div>";
		}

	}

	$table="used_codes";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
	$response["data"]["used-codes-list"]="<h4 class='m-t-0'>".htmlentities($s["last_validated_codes"], ENT_QUOTES, "UTF-8")."</h4><p class='text-center'><i class='fa fa-times fa-4x'></i></p><p class='text-center'>".htmlentities($s["user_didnt_used_codes"], ENT_QUOTES, "UTF-8")."</p>";
	if (isInBD($table,$filter)){
		$response["data"]["used-codes-list"]="
		    <h4 class='m-t-0'>".htmlentities($s["last_promo_used"], ENT_QUOTES, "UTF-8")."</h4>
			<table class='full-width'>
            	<thead>
                	<tr>
	                	<th>Usuario</th>
	                	<th class='text-right'>Fecha</th>
                	</tr>
                </thead>
				<tbody>";
		$fields=array();
		$order="created asc";
		$limit=10;
		$used_codes=listInBD($table,$filter,$fields,$order,$limit);
		foreach($used_codes as $key=>$used_code){
			$table="campaigns";
			$filter=array();
			$filter["id_campaign"]=array("operation"=>"=","value"=>$used_code["id_campaign"]);
			$campaign=getInBD($table,$filter);
			$response["data"]["used-codes-list"].="
			<tr>
            	<td><a href='../campaign/?id_campaign=".$campaign["id_campaign"]."' class='text-success'><i class='fa fa-bullhorn m-r-5'></i>".$campaign["name"]."</a></td>
                <td class='text-right'>".date("d/m/Y  H:m",$used_code["created"])."</td>
            </tr>
			";
		}
		$response["data"]["used-codes-list"].="
				</tbody>
			</table>
		";
	}

	$response["data"]["graph-title"]="<h4 class='m-t-0'>".htmlentities($s["last_15_days"], ENT_QUOTES, "UTF-8")."</h4>";
	$table="used_codes_user_day_summaries";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$_POST["id_user"]);
	for($i=0;$i<=14;$i++){
		$filter["start"]=array("operation"=>"=","value"=>$timestamp-((14-$i)*86400));
		$response["data"]["graph-label-".$i]=date("d/m",$timestamp-((14-$i)*86400));
		$response["data"]["graph-value-".$i]=0;
		if(isInBD($table,$filter)){
			$used_codes_day_summary=getInBD($table,$filter,$fields,$order,$limit);
			$response["data"]["graph-value-".$i]=$used_codes_day_summary["used_codes_amount"];
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
