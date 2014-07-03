<?php
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => 1,
		"iTotalDisplayRecords" => 1,
		"aaData" => array()
	);
	
	$output["aaData"][]=array( 
 	"#001177445587 - Cambio Nombre ( <a href='./request.html' class='text-success'>Ver Solicitud</a> )", 
 	"2013-13-11", 
 	"<i class='fa fa-check'></i> Finalizada");
 	$output["aaData"][]=array( 
 	"#001177445586 - Publicación App ( <a href='./request.html' class='text-success'>Ver Solicitud</a> )", 
 	"2013-13-01", 
 	"<i class='fa fa-check'></i> Finalizada");
 	
 echo json_encode($output);
?>