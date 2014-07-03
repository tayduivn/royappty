<?php 

function debug_log($str){
	global $CONFIG;

	if($CONFIG["debug_mode"]==1){
		error_log("[DEBUG]".$str);
	}
	
}
function issetandnotempty($var){
	if((isset($var))&&(!empty($var))&&($var!="undefined")){
		return true;
	}
	return false;
}

function substr_dots($str,$limit){
	if ($limit<4){
		return $str;
		die;
	}
	if(strlen($str)>$limit){
		$res=substr($str,0, $limit-3);
		$res.="...";
		return $res;
		die;
	}
	return $str;
}

?>