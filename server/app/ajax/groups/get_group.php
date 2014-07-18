<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 18-07-2014
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
	$page_path="server/app/ajax/groups/get_group";
	debug_log("[".$page_path."] START");

 	$response=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

 	// Data check START

 	$table="groups";
 	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		error_log("[".$page_path."] ERROR group (id_brand=".$_SESSION["admin"]["id_brand"].",id_group=".$_POST["id_group"].") doesn't exist");
 		$response["error"]="ERROR group doesn't exist";
 		echo json_encode($response);
 		die();
	}

 	// Data check END


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	$response["result"]=true;


 	$table="groups";
	$filter=array();
	$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
	$group=getInBD($table,$filter);

	$response["data"]["modals"]="
	<div class='modal fade' id='group_notes_viewer' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
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
	<div class='modal fade' id='group_notes_add' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
	    		<div class='modal-content'>
	        			<div class='modal-header'>
	            		<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
					<br>
					<h4 id='myModalLabel' class='semi-bold'><i class='fa fa-file-text-o'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</h4>
				</div>
				<div class='modal-body'>
					<form id='group_notes_add_form' action='javascript:add_group_note()'>
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
					<a href='javascript:add_group_note()' class='btn btn-primary'>".htmlentities($s["add"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='delete_group_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
					<br>
					<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["delete_group"], ENT_QUOTES, "UTF-8")."</h4>
				</div>
				<div class='modal-body'>
					<p class='no-margin'>".htmlentities($s["warning"], ENT_QUOTES, "UTF-8")."</p>
					<p class='no-margin'>".htmlentities($s["delete_group_alert"], ENT_QUOTES, "UTF-8")."</p>
				</div>
				<div class='modal-footer'>
					<button type='button' class='btn btn-default' data-dismiss='modal'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</button>
					<a href='' class='btn btn-primary accept_button'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>
	</div>
	<div class='modal fade' id='deleted_group_success_alert' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
		<div class='modal-dialog'>
			<div class='modal-content'>
				<div class='modal-header'>
					<button type='button' class='close' data-dismiss='modal' aria-hidden='true'></button>
					<br>
					<h4 id='myModalLabel' class='semi-bold text-center'><i class='fa fa-check fa-4x'></i></h4>
				</div>
				<div class='modal-body text-center'>
					<h6 class='no-margin'>".htmlentities($s["group_deleted"], ENT_QUOTES, "UTF-8")."</p>
				</div>
				<div class='modal-footer'>
					<a href='' class='btn btn-primary accept_button'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</div>
	</div>
	";


	$response["data"]["page-title"]="<a href='../groups/'>".htmlentities($s["groups"], ENT_QUOTES, "UTF-8")."</a> / ";
	$response["data"]["page-title"].=htmlentities($group["name"], ENT_QUOTES, "UTF-8")."<a href='../group/edit/?id_group=".$_POST["id_group"]."' ";
	$response["data"]["page-title"].="class='m-l-10 pull-right m-t--3 btn btn-white btn-mini pull-right'>".htmlentities($s["edit_group"], ENT_QUOTES, "UTF-8")."</a>";
	$response["data"]["page-title"].="<a href='javascript:show_modal(\"delete_group_alert\",\"javascript:delete_group(".$group["id_group"].")\")' ";
	$response["data"]["page-title"].=" class='pull-right m-t--3 m-l-10 btn btn-danger btn-mini pull-right'>".htmlentities($s["delete"], ENT_QUOTES, "UTF-8")."</a>";
	$response["data"]["page-options"]="";



	$response["data"]["group-data"]="
		<h3 class='m-t-0'>".htmlentities($group["name"], ENT_QUOTES, "UTF-8")."</h3>
		<h5>";

	if($group["created"]==0){
		$response["data"]["group-data"].=htmlentities($s["without_created_date"], ENT_QUOTES, "UTF-8");
	}else{
		$response["data"]["group-data"].=htmlentities($s["created_date_the"], ENT_QUOTES, "UTF-8")." ".date("d/m/Y",$group["created"]);
	}


	$response["data"]["group-data"].="
		</h5>
		<h5>";





 	$table="group_notes";
	$filter=array();
	$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
	$fields=array();
	$table_order=" created desc";
	$limit = "10";

	$response["data"]["notes-list"]="
		<h4 class='m-t-0'>
			".htmlentities($s["notes"], ENT_QUOTES, "UTF-8")."
			<a href='javascript:show_modal(\"group_notes_add\",\"\")' class='btn btn-white btn-mini pull-right'><i class='fa fa-plus'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</a>
		</h4>
		<div class='text-center'>
			<i class='fa fa-file-text-o fa-4x m-b-10'></i>
			<p>
				".htmlentities("No hay notas que mostrar", ENT_QUOTES, "UTF-8")."
			</p>
			<a class='btn btn-white' href='javascript:show_modal(\"group_notes_add\",\"\")'>".htmlentities($s["add_first_note"], ENT_QUOTES, "UTF-8")."</a>
		</div>";



	if(isInBD($table,$filter)){
		$response["data"]["notes-list"]="<h4 class='m-t-0'>".htmlentities($s["notes"], ENT_QUOTES, "UTF-8")." <a href='javascript:show_modal(\"group_notes_add\",\"\")' class='btn btn-white btn-mini pull-right'><i class='fa fa-plus'></i> ".htmlentities($s["add_note"], ENT_QUOTES, "UTF-8")."</a></h4>";
		$group_notes=listInBD($table,$filter,$fields,$table_order,$limit);
		foreach($group_notes as $key=>$group_note){
			$group_note["title_preview"]=$group_note["title"];
			if(strlen($group_note["title"])>23){
				$group_note["title_preview"]=substr($group_note["title"],0,20)."...";
			}
			$response["data"]["notes-list"].="<div class=''><span class='text-black'>".date("d/m/Y",$group_note["created"])."</span> <a href='javascript:view_note(".$group_note["id_group_note"].")' class='text-success'>".htmlentities($group_note["title_preview"], ENT_QUOTES, "UTF-8")."</a></div>";
		}
		if(countInBD($table,$filter)>10){
			$response["data"]["notes-list"].="
				<div class='text-center m-t-10'>
					<a href='javascript:show_modal(\"group_all_notes\",\"\")' class='btn btn-mini btn-white'>".htmlentities($s["view_all_notes"], ENT_QUOTES, "UTF-8")."</a>
				</div>";
			$group_notes=listInBD($table,$filter,$fields,$table_order);

			$response["data"]["modals"].="
			<div class='modal fade' id='group_all_notes' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
				<div class='modal-dialog'>
					<div class='modal-content'>
						<div class='modal-header'>
							<button type='button' class='close' data-dismiss='modal' aria-hidden='true'>x</button>
							<br>
							<h4 id='myModalLabel' class='semi-bold'>".htmlentities($s["view_all_notes"], ENT_QUOTES, "UTF-8")."</h4>
						</div>
						<div class='modal-body'>

			";
			foreach($group_notes as $key=>$group_note){
				$response["data"]["modals"].="<div class=''><span class='text-black'>".date("d/m/Y",$group_note["created"])."</span> <a href='javascript:view_note(".$group_note["id_group_note"].")' class='text-success'>".htmlentities($group_note["title"], ENT_QUOTES, "UTF-8")."</a></div>";
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

	$blocks_count=0;
	for($i=1;$i<=4;$i++){
		if($group["resume_block_".$i."_display"]==1){
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
		if($group["resume_block_".$i."_display"]==1){
			$table="groups";
			$filter=array();
			$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
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
						$block_data=create_block_data($resume_block["resume_block_".$i."_title"],$group["id_group"]);
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


	$sql_complex="false";
	$table="user_groups";
	$filter=array();
	$filter["id_group"]=array("operation"=>"=","value"=>$_POST["id_group"]);
	if(isInBD($table,$filter)){
		$user_groups=listInBD($table,$filter);
		$sql_complex="";
		$or="";
		foreach ($user_groups as $key=>$user_group){
			$sql_complex.=$or." id_user=".$user_group["id_user"];
			$or=" or";
		}
	}


	$table="used_codes";
	$filter=array();
	$filter["complex"]=$sql_complex;
	$response["data"]["used-codes-list"]="<h4 class='m-t-0'>".htmlentities($s["last_validated_codes"], ENT_QUOTES, "UTF-8")."</h4><p class='text-center'><i class='fa fa-times fa-4x'></i></p><p class='text-center'>".htmlentities($s["no_used_codes"], ENT_QUOTES, "UTF-8")."</p>";
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
			$table="users";
			$filter=array();
			$filter["id_user"]=array("operation"=>"=","value"=>$used_code["id_user"]);
			$user=getInBD($table,$filter);
			$response["data"]["used-codes-list"].="
			<tr>
	           	<td><a href='../user/?id_user=".$user["id_user"]."' class='text-success'><i class='fa fa-user m-r-5'></i>".$user["name"]."</a></td>
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
	$filter["complex"]=$sql_complex;
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
