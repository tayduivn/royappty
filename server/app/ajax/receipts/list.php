<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 23-06-2014
	* Version: 0.93
	*
	*********************************************************/

	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => 1,
		"iTotalDisplayRecords" => 1,
		"aaData" => array()
	);

	$output["aaData"][]=array(
 	"#001177445587 ( <a href='./receipt.html' class='text-success'>Ver Recibo</a> )",
 	"2013-13-11",
 	"9.99€");

 echo json_encode($output);
?>
