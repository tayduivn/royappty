<?php
	define('PATH', str_replace('\\', '/','../../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d 00:00:00"));

	
	
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/get_campaign";
	debug_log("[".$page_path."] START");
	include(PATH."functions/check_session.php");
	
 	$response=array();
 	
 	
	$response["result"]=true;
	
	
 	$table="brands";
	$filter=array();
	$filter["id_brand"]=array("operation"=>"=","value"=>$_SESSION["admin"]["id_brand"]);
	$brand=getInBD($table,$filter);
	

	$response["data"]["page-title"]="<a href='../../'>".htmlentities($s["my_account"], ENT_QUOTES, "UTF-8")."</a> / <a href='../'>".htmlentities($s["subscription"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($s["change_subscription_type"], ENT_QUOTES, "UTF-8");
	
	
	
	
	$response["data"]["form-step-1"]="
			<h4 class='m-t-0'>".htmlentities($s["select_subscription_type"], ENT_QUOTES, "UTF-8")."</h4>
				<div id='form-warning'></div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='starter' ";
	if($brand["subscription_type"]=="starter"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["starter"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["starter"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4>".htmlentities($royappty_plans["starter"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
					         
						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='professional' ";
	if($brand["subscription_type"]=="professional"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["professional"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["professional"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4 style='white-space: nowrap;'>".htmlentities($royappty_plans["professional"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
					         
						</div>
					</div>
				</div>
				<div class='form-group m-t-20'>
					<span class='help'></span>
					<div class='controls' style='border:1px solid #f4f4f4;padding:10px;'>
						<div class=''>
							<table>
								<tr>
									<td style='vertical-align:middle;padding:10px;padding-right:30px;'>
										<input id='subscription_type' type='radio' name='subscription_type' value='unlimited' ";
	if($brand["subscription_type"]=="unlimited"){
		$response["data"]["form-step-1"].="checked";
	}
	$response["data"]["form-step-1"].=">
									</td>
									<td  style='width:100%'>
										<h3>".htmlentities($royappty_plans["unlimited"]["title"], ENT_QUOTES, "UTF-8")."</h3>
										<p>".htmlentities($royappty_plans["unlimited"]["subtitle"], ENT_QUOTES, "UTF-8")."</p>
									</td>
									<td>
										<h4 style='white-space: nowrap;'>".htmlentities($royappty_plans["unlimited"]["price"], ENT_QUOTES, "UTF-8")."</h4>
									</td>
								</tr>
							</table>
					         
						</div>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a href='../' class='btn btn-white pull-left'>".htmlentities($s["cancel"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>";
	
	$response["data"]["form-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["form-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../admins/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["form-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($s["subscription_success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["subscription_success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../' class='btn btn-white'>".htmlentities($s["accept"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	
	 	echo json_encode($response);
	debug_log("[server/ajax/campaigns/get_campaign] END");

?>