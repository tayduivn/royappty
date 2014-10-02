<?php

	/************************************************************
	* Royappty
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Modification: 10-02-2014
	* Version: 1.0
	* licensed through CC BY-NC 4.0
	************************************************************/

	function normalize_str($string)
	{
		$string = str_replace("?","",$string);
		$string = str_replace("�","",$string);
		$string = str_replace("!","",$string);
		$string = str_replace("*","",$string);
		$string = str_replace(",","",$string);
		$string = str_replace("-","",$string);
		$string = str_replace("_","",$string);
		$string = str_replace("�","a",$string);
		$string = str_replace("�","e",$string);
		$string = str_replace("�","i",$string);
		$string = str_replace("�","o",$string);
		$string = str_replace("�","u",$string);
		$string = str_replace("�","u",$string);
		$string = str_replace("�","n",$string);
		$string = str_replace("�","c",$string);
		$string = str_replace("�","A",$string);
		$string = str_replace("�","E",$string);
		$string = str_replace("�","I",$string);
		$string = str_replace("�","O",$string);
		$string = str_replace("�","U",$string);
		$string = str_replace("�","U",$string);
		$string = str_replace("�","N",$string);
		$string = str_replace("�","C",$string);
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
