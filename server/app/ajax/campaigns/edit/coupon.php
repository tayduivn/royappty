<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 21-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	* no_brand
	* brand_not_valid
	*	no_admin
	* admin_not_valid
	* admin_inactive
	* post_no_campaign
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/campaigns/edit/coupon";
	debug_log("[".$page_path."] START");
 	$response=array();

	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// BD CONNECTION
	if(!checkBDConnection()){echo json_encode($response);die();}

	// BRAND
	$brand=array();$brand["id_brand"]=$_SESSION["admin"]["id_brand"];
	if(!checkBrand($brand)){echo json_encode($response);die();}

	// ADMIN
	$admin=array();$admin["id_admin"]=$_SESSION["admin"]["id_admin"];
	if(!checkAdmin($admin)){echo json_encode($response);die();}

	// POST
	if(!@issetandnotempty($_POST["id_campaign"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing id_campaign");
		$response["error_code"]="post_no_campaign";
		echo json_encode($response);
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

 	$response["result"]=true;

	$table="campaigns";
	$filter=array();
	$filter["id_campaign"]=array("operation"=>"=","value"=>$_POST["id_campaign"]);
	$campaign=getInBD($table,$filter);

	$response["data"]["page-title"]="<a href='../../../campaigns/'>".htmlentities($s["campaigns"], ENT_QUOTES, "UTF-8")."</a> / <a href='#'>".htmlentities($s["edit_campaign"], ENT_QUOTES, "UTF-8")."</a> / ".htmlentities($campaign["name"], ENT_QUOTES, "UTF-8");
	$response["data"]["page-options"]="";

	$response["data"]["new-coupon-step-1"]="
			<h4 class='m-t-0'>".htmlentities($new_coupon_s["step_1_title"], ENT_QUOTES, "UTF-8")." <span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 1 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
			<form id='form-step1'>
				<div id='form-warning'></div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($new_coupon_s["campaign_title"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($new_coupon_s["campaign_title_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<input type='text' id='name' name='name' class='form-control' value='".htmlentities($campaign["name"], ENT_QUOTES, "UTF-8")."'>
					</div>
				</div>
				<div class='form-group'>
					<label class='form-label'>".htmlentities($new_coupon_s["description"], ENT_QUOTES, "UTF-8")."</label>
					<span class='help'>".htmlentities($new_coupon_s["description_help"], ENT_QUOTES, "UTF-8")."</span>
					<div class='controls'>
						<textarea class='form-control' rows=4 id='description' name='description' value='".htmlentities($campaign["description"], ENT_QUOTES, "UTF-8")."'>".htmlentities($campaign["name"], ENT_QUOTES, "UTF-8")."</textarea>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
						<a id='prev_step' href='../../../campaigns' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</form>
						";
	$response["data"]["new-coupon-step-2"]="
		<h4 class='m-t-0'>".htmlentities($new_coupon_s["step_2_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 2 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
		<form id='form-step2'>
		<div id='form-warning'></div>
			<div class='row'>
				<div class='col-md-8'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["icon"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["icon_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='file' id='xfile' value='default' class='droparea spot' name='xfile' data-post='".$url_server."server/app/ajax/campaigns/upload-image.php?type=icon&width=500&height=500&crop=1&label=campaign_icon_path' />
						</div>
						<!--<label class='form-label'>".$new_coupon_s["choose_predefined_icon"]."</label>
						<div class='m-t-10'>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-01.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-01.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-02.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-02.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-03.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-03.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-04.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-04.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-05.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-05.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-06.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-06.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-07.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-07.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-08.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-08.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-09.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-09.jpg'/>
							</a>
							<a href=\"javascript:$('#campaign_icon_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-10.jpg')\">
								<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-icon/pre-icon-10.jpg'/>
							</a>
						</div>-->
					</div>
				</div>
				<div class='col-md-4'>
					<div class='grid simple'>
		            	<div class='iphone-panel'>
							<div class='iphone-content text-white'>
								<div class='iphone-top-menu text-center b-b' style='display:block; height:30px;vertical-align:middle;padding-top:5px;'>
									<span class='text-black'>".htmlentities($new_coupon_s["our_promos"], ENT_QUOTES, "UTF-8")."</span>
								</div>
								<div style='display:block;vertical-align:middle;height:247px;width:100%;overflow:hidden' class='p-l-10 p-r-10 text-center'>
									<img id='campaign_icon_path-preview' class='full-width m-t-10' src='".$url_server."resources/campaign-icon/".$campaign["campaign_icon_path"]."'/>
								<div style='height:136px;overflow:hidden' class='full-width m-t-10'>
									<img class='full-width' src='".$url_server."server/app/assets/img/default-icon.jpg'/>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style='overflow:auto'>
			<div class='form-group'>
				<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
					<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
				</div>
			</div>
		</form>
	";
	$response["data"]["new-coupon-step-3"]="
		<h4 class='m-t-0'>".htmlentities($new_coupon_s["step_3_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 3 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
			<form id='form-step3'>
				<div id='form-warning'></div>
				<div class='row'>
					<div class='col-md-8'>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($new_coupon_s["promo_title"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($new_coupon_s["promo_title_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' class='form-control ' id='title' name='title' placeholder='".htmlentities($new_coupon_s["promo_title_placeholder"], ENT_QUOTES, "UTF-8")."'  onchange=\"$('#title-preview').html($('#title').val());\" value='".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."'/>
							</div>
						</div>
						<div class='row'>
							<div class='col-md-12'>
								<div class='form-group'>
									<label class='form-label'>".htmlentities($new_coupon_s["promo_image"], ENT_QUOTES, "UTF-8")."</label>
									<span class='help'>".htmlentities($new_coupon_s["promo_image_help"], ENT_QUOTES, "UTF-8")."</span>
									<div class='controls'>
										<input type='file' id='xfile' value='default' class='droparea spot' name='xfile' data-post='".$url_server."server/app/ajax/campaigns/upload-image.php?type=icon&width=650&crop=0&label=campaign_image_path' />
									</div>
								</div>
							</div>
							<!--<div class='col-md-6'>
								<div class='form-group'>
									<label class='form-label'>".htmlentities($new_coupon_s["or_select_predefined_image"], ENT_QUOTES, "UTF-8")."</label>
									<span class='help'></span>
									<div style='overflow:auto;' class='m-t-10'>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-01.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-01.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-02.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-02.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-03.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-03.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-04.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-04.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-05.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-05.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-06.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-06.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-07.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-07.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-08.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-08.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-image/pre-image-09.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-09.jpg'/>
										</a>
										<a href=\"javascript:$('#campaign_image_path-preview').attr('src','".$url_server."server/app/assets/img/pre-icon/pre-icon-10.jpg')\">
											<img class='full-width pull-left m-l-10 m-b-10' style='width:50px' src='".$url_server."server/app/assets/img/pre-image/pre-image-10.jpg'/>
										</a>
									</div>
								</div>
							</div>-->
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($new_coupon_s["promo_content"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($new_coupon_s["promo_content_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<textarea class='form-control' rows='6' id='content' name='content' onkeypress=\"$('#content-preview').html($('#content').val());\" onchange=\"$('#content-preview').html($('#content').val());\">".htmlentities($campaign["content"], ENT_QUOTES, "UTF-8")."</textarea>
							</div>
						</div>
						<div class='form-group'>
							<label class='form-label'>".htmlentities($new_coupon_s["button_title"], ENT_QUOTES, "UTF-8")."</label>
							<span class='help'>".htmlentities($new_coupon_s["button_title_help"], ENT_QUOTES, "UTF-8")."</span>
							<div class='controls'>
								<input type='text' class='form-control' id='button_title' name='button_title' placeholder='".htmlentities($new_coupon_s["button_title_placeholder"], ENT_QUOTES, "UTF-8")."'  onchange=\"$('#button-preview').html($('#button_title').val());\" value='".htmlentities($campaign["button_title"], ENT_QUOTES, "UTF-8")."'/>
							</div>
						</div>
					</div>
					<div class='col-md-4'>
						<div class='grid simple'>
							<div class='iphone-panel'>
								<div class='iphone-content text-white'>
									<div class='iphone-top-menu text-center b-b' style='display:block; height:30px;vertical-align:middle;padding-top:5px;'>
										<span class='text-black' id='title-preview'>".htmlentities($campaign["title"], ENT_QUOTES, "UTF-8")."</span>
									</div>
									<div style='display:block;vertical-align:middle;height:247px;width:100%;overflow:hidden' class='text-center'>
										<img id='campaign_image_path-preview' class='full-width' src='".$url_server."resources/campaign-image/".$campaign["campaign_image_path"]."'/>
										<div class='m-t-10 p-l-10 p-r-10 text-muted text-small' style='overflow-wrap:break-word;font-size:9px;' id='content-preview'>
											".htmlentities($campaign["content"], ENT_QUOTES, "UTF-8")."
										</div>
										<div class='btn btn-white btn-mini m-t-10' id='button-preview'>
											".htmlentities($campaign["button_title"], ENT_QUOTES, "UTF-8")."
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div style='overflow:auto'>
					<div class='form-group'>
						<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
					    <a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
					</div>
				</div>
			</form>

	";
	$response["data"]["new-coupon-step-4"]="
		<h4 class='m-t-0'>".htmlentities($new_coupon_s["step_4_title"], ENT_QUOTES, "UTF-8")."<span class='pull-right text-muted'>".htmlentities($s["step_"], ENT_QUOTES, "UTF-8")." 4 ".htmlentities($s["_of"], ENT_QUOTES, "UTF-8")." 4</span></h4>
		<form id='form-step4'>
			<div id='form-warning'></div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["coupons_number"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["coupons_number_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='text' class='form-control' id='coupons_number' name='coupons_number' placeholder='".htmlentities($new_coupon_s["coupons_number_placeholder"], ENT_QUOTES, "UTF-8")."' value='".htmlentities($campaign["coupons_number"], ENT_QUOTES, "UTF-8")."'/>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["promo_usage_limit"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["promo_usage_limit_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='text' class='form-control ' id='usage_limit' name='usage_limit' placeholder='".htmlentities($new_coupon_s["promo_usage_limit"], ENT_QUOTES, "UTF-8")."' value='".htmlentities($campaign["usage_limit"], ENT_QUOTES, "UTF-8")."'/>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["promo_cost"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["promo_cost_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='text' id='cost' name='cost' class='form-control' value='".htmlentities($campaign["cost"], ENT_QUOTES, "UTF-8")."'>
						</div>
					</div>
				</div>
				<div class='col-md-6'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["promo_profit"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["promo_profit_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<input type='text' id='profit' name='profit' class='form-control' value='".$campaign["profit"]."'>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div class='form-group'>
						<label class='form-label'>".htmlentities($new_coupon_s["status"], ENT_QUOTES, "UTF-8")."</label>
						<span class='help'>".htmlentities($new_coupon_s["status_help"], ENT_QUOTES, "UTF-8")."</span>
						<div class='controls'>
							<select name='status' id='status'>
								<option value='1' ";
								if ($campaign["status"]==1){$response["data"]["new-coupon-step-4"].="selected";}
								$response["data"]["new-coupon-step-4"].=">".htmlentities($s["campaigns_status"][1], ENT_QUOTES, "UTF-8")."</option>
								<option value='2'";
								if ($campaign["status"]==2){$response["data"]["new-coupon-step-4"].="selected";}
								$response["data"]["new-coupon-step-4"].=">".htmlentities($s["campaigns_status"][2], ENT_QUOTES, "UTF-8")."</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class='row'>
				<div class='col-md-12'>
					<div style='overflow:auto'>
						<div class='form-group'>
							<input type='submit' class='btn btn-white pull-right' value='".htmlentities($s["next"], ENT_QUOTES, "UTF-8")."' />
							<a href='javascript:prevstep()' class='btn btn-white pull-left'>".htmlentities($s["previous"], ENT_QUOTES, "UTF-8")."</a>
						</div>
					</div>
				</div>
			</div>

		</form>

	";
	$response["data"]["new-coupon-step-end"]="
		<form id='form-end'>
			<input type='hidden' id='name' value='".$campaign["name"]."' />
			<input type='hidden' id='description' value='".$campaign["description"]."'/>
			<input type='hidden' id='campaign_icon_path' />
			<input type='hidden' id='campaign_image_path' />
			<input type='hidden' id='coupons_number' value='".$campaign["coupons_number"]."'/>
			<input type='hidden' id='usage_limit' value='".$campaign["usage_limit"]."' />
			<input type='hidden' id='title' value='".$campaign["title"]."' />
			<input type='hidden' id='content' value='".$campaign["content"]."' />
			<input type='hidden' id='button_title' value='".$campaign["button_title"]."' />
			<input type='hidden' id='cost' value='".$campaign["cost"]."' />
			<input type='hidden' id='profit' value='".$campaign["profit"]."' />
			<input type='hidden' id='status' value='".$campaign["status"]."' />
		</form>
	";
	$response["data"]["new-coupon-step-loading"]="
		<div class='text-center'>
			<div class='loader-activity'></div>
			<h3>".htmlentities($s["loading..."], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["this_may_take_several_seconds"], ENT_QUOTES, "UTF-8")."</div>
		</div>
	";
	$response["data"]["new-coupon-step-error"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-times'></i></h1>
			<h3 class='text-center'>".htmlentities($s["error"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($s["there_was_an_error_please_try_later"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../../campaigns/' class='btn btn-white'>".htmlentities($s["back"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";
	$response["data"]["new-coupon-step-success"]="
		<div class='text-center'>
			<h1 class='text-center'><i class='fa fa-check'></i></h1>
			<h3 class='text-center'>".htmlentities($new_coupon_s["success_title"], ENT_QUOTES, "UTF-8")."</h3>
			<div class='msg'>".htmlentities($new_coupon_s["success_subtitle"], ENT_QUOTES, "UTF-8")."</div>
			<div class='m-t-20'>
				<a href='../../../campaigns/' class='btn btn-white m-r-10'>".htmlentities($s["all_campaigns"], ENT_QUOTES, "UTF-8")."</a>
				<a id='campaign-link' href='#' class='btn btn-white m-l-10'>".htmlentities($s["view_campaign"], ENT_QUOTES, "UTF-8")."</a>
			</div>
		</div>
	";

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
	echo json_encode($response);
	die();

?>
