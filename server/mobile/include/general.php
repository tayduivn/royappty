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
function dec32($num){
	return base_convert($num,10,32);
}

?>