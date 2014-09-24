<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 23-06-2014
* Version: 0.93
*
*********************************************************/
function normalize_str($string)
{
	$string = str_replace("?","",$string);
	$string = str_replace("¿","",$string);
	$string = str_replace("!","",$string);
	$string = str_replace("*","",$string);
	$string = str_replace(",","",$string);
	$string = str_replace("-","",$string);
	$string = str_replace("_","",$string);
	$string = str_replace("á","a",$string);
	$string = str_replace("é","e",$string);
	$string = str_replace("í","i",$string);
	$string = str_replace("ó","o",$string);
	$string = str_replace("ú","u",$string);
	$string = str_replace("ü","u",$string);
	$string = str_replace("ñ","n",$string);
	$string = str_replace("ç","c",$string);
	$string = str_replace("Á","A",$string);
	$string = str_replace("É","E",$string);
	$string = str_replace("Í","I",$string);
	$string = str_replace("Ó","O",$string);
	$string = str_replace("Ú","U",$string);
	$string = str_replace("Ü","U",$string);
	$string = str_replace("Ñ","N",$string);
	$string = str_replace("Ç","C",$string);
	$string = str_replace("\xc3\xa1","a",$string);
	$string = str_replace("\xc3\xa9","e",$string);
	$string = str_replace("\xc3\xad","i",$string);
	$string = str_replace("\xc3\xb3","o",$string);
	$string = str_replace("\xc3\xba","u",$string);
	$string = str_replace("\xc3\xbc","u",$string);
	$string = str_replace("\xc3\xb1","n",$string);
	$string = str_replace("\xc3\xa7","c",$string);
	$string = str_replace("\xc3\x81","A",$string);
	$string = str_replace("\xc3\x89","E",$string);
	$string = str_replace("\xc3\x8d","I",$string);
	$string = str_replace("\xc3\x93","O",$string);
	$string = str_replace("\xc3\x9a","U",$string);
	$string = str_replace("\xc3\x9c","U",$string);
	$string = str_replace("\xc3\x91","N",$string);
	$string = str_replace("\xc3\x87","C",$string);
	return $string;
}
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
