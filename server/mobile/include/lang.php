<?php
$lang="ES_es";
$lang_email = "es";

if(@!issetandnotempty($_POST['lang'])){
  if(@!issetandnotempty($_SESSION['lang'])){
    $lang="EN_en";
    $lang_email = "en";
    $_POST["lang"]="en";
  }
  else{
    $_POST["lang"]=$_SESSION['lang_email'];
  }
}
if($_POST["lang"] == 'es'){
  $lang="ES_es";
  $lang_email = "es";
  $_SESSION["lang"]="ES_es";
  $_SESSION["lang_email"]="es";
}
else{
  $lang="EN_en";
  $lang_email = "en";
  $_SESSION["lang"]="EN_en";
  $_SESSION["lang_email"]="en";
}
unset($_POST["lang"]);
include_once(PATH."lang/".$lang.".php");
?>
