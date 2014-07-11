<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.91
*
*********************************************************/

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
