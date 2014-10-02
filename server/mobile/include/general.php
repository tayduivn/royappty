<?php
	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/


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
