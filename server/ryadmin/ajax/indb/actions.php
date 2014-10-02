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
	* db_connection_error
	*	post_no_func
	*	post_no_table
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));

	include(PATH."include/inbd.php");
	$page_path="server/ryadmin/ajax/inbd/actions";
	debug_log("[".$page_path."] START");

	$response=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
	if(!checkClosed()){echo json_encode($response);die();}

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	if(!@issetandnotempty($_POST["func"]) && !@issetandnotempty($_GET["func"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing func");
		$response["error_code"]="post_no_func";
		echo json_encode($response);
		die();
	}
	if(!@issetandnotempty($_POST["table"]) && !@issetandnotempty($_GET["table"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing table");
		$response["error_code"]="post_no_table";
		echo json_encode($response);
		die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/
	if((isset($_POST))&&(!empty($_POST))){
		$ajaxdata=$_POST;
	}else if((isset($_GET))&&(!empty($_GET))){
		$ajaxdata=$_GET;
	}

	$callback_path="./";
	if(isset($ajaxdata["path"])){
		$callback_path=$ajaxdata["path"];
		unset($ajaxdata["path"]);
	}
	$callback_options="";
	if(isset($ajaxdata["callback_options_str"])){
		$ajaxdata["callback_options"] = explode("::", $ajaxdata["callback_options_str"]);
		$callback_options="?";
		$and="";
		foreach($ajaxdata["callback_options"] as $key => $callback_option_tmp){
			$callback_options_array=explode("||",$callback_option_tmp);
			$callback_options.=$and.$callback_options_array[0].$callback_options_array[1].$callback_options_array[2];
			$and="&";
		}
	}
	if ((isset($ajaxdata["func"]))&&(!empty($ajaxdata["func"]))){
		$func=$ajaxdata["func"];
		unset($ajaxdata["func"]);
	}else{
		$response["status"]=false;
		echo json_encode($response);
		die();
	}

	if($func=="delete"){

		error_log("delete");
		$table=$ajaxdata["table"];
		$filter=array();
		$ajaxdata["filters"] = explode("::", $ajaxdata["filter_str"]);

		foreach($ajaxdata["filters"] as $key => $filter_tmp){
			$filter_array=explode("||",$filter_tmp);
			$filter[$filter_array[0]]=array("operation"=>$filter_array[1],"value"=>$filter_array[2]);
			error_log($filter_array[0]." = ".$filter_array[2]);
		}

		deleteInBD($table,$filter);
		$response["status"]=true;
		$response["action"][0]="header";
		$response["actions"][0]["header"]="./".$callback_options;
		echo json_encode($response);

	}else if($func=="update"){

		$table=$ajaxdata["table"];

		$filter=array();
		$ajaxdata["filters"] = explode("::", $ajaxdata["filter_str"]);

		foreach($ajaxdata["filters"] as $key => $filter_tmp){
			$filter_array=explode("||",$filter_tmp);
			$filter[$filter_array[0]]=array("operation"=>$filter_array[1],"value"=>$filter_array[2]);
			error_log($filter_array[0]." = ".$filter_array[2]);
		}

		$data=array();
		$ajaxdata["datas"] = explode("::", $ajaxdata["data_str"]);

		foreach($ajaxdata["datas"] as $key => $data_tmp){
			$data_array=explode("||",$data_tmp);
			$data[$data_array[0]]=$data_array[1];
			error_log($data_array[0]."=".$data_array[1]);
		}

		updateInBD($table,$filter,$data);
		$response["status"]=true;
		$response["action"][0]="header";
		$response["actions"][0]["header"]="./".$callback_options;
		echo json_encode($response);

	}else if($func=="add"){
		$table=$ajaxdata["table"];
		$data=array();
		$ajaxdata["datas"] = explode("::", $ajaxdata["data_str"]);

		foreach($ajaxdata["datas"] as $key => $data_tmp){
			$data_array=explode("||",$data_tmp);
			$data[$data_array[0]]=$data_array[1];
			error_log($data_array[0]."=".$data_array[1]);
		}

		addInBD($table,$data);
		$response["status"]=true;
		$response["action"][0]="header";
		$response["actions"][0]["header"]="./".$callback_options;
		echo json_encode($response);

	}else{
		$response["status"]=false;
		echo json_encode($response);
		die();
	}

?>
