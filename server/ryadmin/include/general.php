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
