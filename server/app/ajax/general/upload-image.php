<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 17-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/inbd.php");
	$page_path="server/app/ajax/general/upload_image";
	debug_log("[".$page_path."] START");


	$res = new stdClass();
	// Result content type
	header('content-type: application/json');

	/*********************************************************
	* DATA CHECK
	*********************************************************/
	include(PATH."functions/check_session.php");


	// Maximum file size
	$maxsize = 10; //Mb
	// File size control
	if ($_FILES['xfile']['size'] > ($maxsize * 1048576)) {
	$res->error=true;
	echo json_encode($res);
    die();
	}
	if ($_FILES['xfile']['type'] != "image/jpeg") {
   $res->error=true;
	echo json_encode($res);
    die();
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

$types = Array('image/png', 'image/gif', 'image/jpeg');

$source = file_get_contents($_FILES["xfile"]["tmp_name"]);
$folder="../../../resources/tmp/";
$filename = $folder . $timestamp . '.jpg';

$width=0;
if(isset($_GET["width"])&&(!empty($_GET["width"]))){
	$width=$_GET["width"];
}
$height=0;
if(isset($_GET["height"])&&(!empty($_GET["height"]))){
	$height=$_GET["height"];
}
$crop=false;
if(isset($_GET["crop"])&&(!empty($_GET["crop"]))){
	$crop=true;
}

imageresize($source, $filename,$width,$height,$crop);

$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);

error_log($filename);
error_log('<img src="'.$url_server.'resources/tmp/'.'temp'.'.jpg" alt="image" />');


// Result data
$res->filename = $url_server.'resources/tmp/'.$timestamp . '.jpg';
$res->preview = $_GET["label"]."-preview";
$res->label = $_GET["label"];
$res->indice = "temp";
$res->path = "./";
$res->img = '<img src="'.$url_server.'resources/tmp/'.'temp'.'.jpg" alt="image" />';
$res->error =false;

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/



	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/
	// Return to JSON
	echo json_encode($res);
	debug_log("[".$page_path."] END");
	die();


	// Image resize function with php + gd2 lib
	function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 100) {
    $quality = $quality ? $quality : 80;
    $image = imagecreatefromstring($source);
    if ($image) {
        // Get dimensions
        $w = imagesx($image);
        $h = imagesy($image);
        if (($width && $w > $width) || ($height && $h > $height)) {
            $ratio = $w / $h;
            if (($ratio >= 1 || $height == 0) && $width && !$crop) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } elseif ($crop && $ratio <= ($width / $height)) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } else {
                $new_width = $height * $ratio;
                $new_height = $height;
            }
        } else {
            $new_width = $w;
            $new_height = $h;
        }
        $x_mid = $new_width * .5;  //horizontal middle
        $y_mid = $new_height * .5; //vertical middle
        // Resample
        $new = imagecreatetruecolor(round($new_width), round($new_height));
        imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        // Crop
        if ($crop) {
            $crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
            imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
            //($y_mid - ($height * .5))
        }
        // Output
        // Enable interlancing [for progressive JPEG]
        imageinterlace($crop ? $crop : $new, true);

        $dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        if ($dext == '') {
            $dext = $ext;
            $destination .= '.' . $ext;
        }
        switch ($dext) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($crop ? $crop : $new, $destination, $quality);
                break;
            case 'png':
                $pngQuality = ($quality - 100) / 11.111111;
                $pngQuality = round(abs($pngQuality));
                imagepng($crop ? $crop : $new, $destination, $pngQuality);
                break;
            case 'gif':
                imagegif($crop ? $crop : $new, $destination);
                break;
        }
        @imagedestroy($image);
        @imagedestroy($new);
        @imagedestroy($crop);
    }
}
?>
