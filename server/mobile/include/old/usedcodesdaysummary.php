<?php 

include_once(PATH."include/settings.php");
include_once(PATH."include/bd.php");

if(!isset($manejador)) {
	$manejador = db_connect();
}

function isUsedCodesDaySummary($filter=array()){
	global $manejador;
	global $conf;
	
	$query = "select * from ".$conf["bdprefix"]."used_codes_day_summary where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	if(db_count($r) > 0) {
		return true;
	}
	return false;
}



function getUsedCodesDaySummary($filter=array(),$fields = array()){
	global $manejador;
	global $conf;
	
	$query = "select ";
	$selected_fields = "*";
	if(!empty($fields)){
		$selected_fields = "";
		$coma = "";
		foreach ($fields as $key => $field){
			$selected_fields.= $coma." ".$field;
			$coma=",";
		}
	}
	$query .= $selected_fields;
	$query .= " from ".$conf["bdprefix"]."used_codes_day_summary where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	if(db_count($r) > 0) {
		return db_fetch($r);
	}
	return false;
}

function listUsedCodesDaySummary($filter=array(),$fields = array()){
	global $manejador;
	global $conf;
	
	$query = "select ";
	$selected_fields = "*";
	if(!empty($fields)){
		$selected_fields = "";
		$coma = "";
		foreach ($fields as $key => $field){
			$selected_fields.= $coma." ".$field;
			$coma=",";
		}
	}
	$query .= $selected_fields;
	$query .= " from ".$conf["bdprefix"]."used_codes_day_summary where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	$i=0;
	$data_array=array();
	while($data=db_fetch($r)) {
		$data_array[$i]=$data;
		$i++;
	}
	return $data_array;
}

function countUsedCodesDaySummary($filter=array()){
	global $manejador;
	global $conf;
	
	$query = "select count(*) from ".$conf["bdprefix"]."used_codes_day_summary where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	return db_fetch($r);
}

function sumUsedCodesDaySummary($filter=array(),$sum_field){
	
	global $manejador;
	global $conf;
	
	$query = "select sum(".$sum_field.") sum from ".$conf["bdprefix"]."used_codes_day_summary where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	return db_fetch($r);
}

function updateUsedCodesDaySummary($filter=array(),$update_data = array()){
	global $manejador;
	global $conf;
	
	$query = "update ".$conf["bdprefix"]."used_codes_day_summary set ";
	$coma = "";
	foreach($update_data as $key=>$value){
		$query .= $coma.$key." = '".$value."'";
		$coma=",";
	}
	
	$query .= " where ";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
	return true;
}

function addUsedCodesDaySummary($data){
	global $manejador;
	global $conf;
	
	$query = "insert into ".$conf["bdprefix"]."used_codes_day_summary  (";
	$coma = "";
	$values = "";
	foreach($data as $key => $value) {
		$query .= $coma.$key;
		$values .= $coma."'".db_secure_field($value,$manejador)."'";
		$coma = ",";
	}
	$query .= ") VALUES (".$values.")";
	$r = db_query($query,$manejador);
	return db_last_id();
}

function deleteUsedCodesDaySummary($filter=array()) {
	global $manejador;
	global $conf;

	$query = "delete from ".$conf["bdprefix"]."used_codes_day_summary where";
	$and="";
	foreach($filter as $key => $value) {
		if($key=="complex"){
			$query.=$and." (".$value.") ";
		}else{
			$query.=$and." ".$key." ".$value["operation"]." '".$value["value"]."' ";		
		}
		$and="and";
	}
	$query.=$and." 1";
	$r = db_query($query,$manejador);
}

?>