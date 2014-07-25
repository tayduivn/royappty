<?php 

include_once(PATH."include/settings.php");
include_once(PATH."include/bd.php");

if(!isset($manejador)) {
	$manejador = db_connect();
}

function isAdmin($filter=array()){
	global $manejador;
	global $conf;
	
	$query = "select * from ".$conf["bdprefix"]."admins where ";
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

function getAdmin($filter=array(),$fields = array()){
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
	$query .= " from ".$conf["bdprefix"]."admins where ";
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

function listAdmins($filter=array(),$fields = array()){
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
	$query .= " from ".$conf["bdprefix"]."admins where ";
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

function countAdmins($filter=array()){
	global $manejador;
	global $conf;
	
	$query = "select * from ".$conf["bdprefix"]."admins where ";
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
	return db_count($r);
}



function updateAdmin($filter=array(),$update_data = array()){
	global $manejador;
	global $conf;
	
	$query = "update ".$conf["bdprefix"]."admins set ";
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

function addAdmin($data){
	global $manejador;
	global $conf;
	
	$query = "insert into ".$conf["bdprefix"]."admins  (";
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

function deleteAdmins($filter=array()) {
	global $manejador;
	global $conf;

	$query = "delete from ".$conf["bdprefix"]."admins where";
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