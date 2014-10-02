<?php
  /************************************************************
  * Royappty
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Modification: 10-02-2014
  * Version: 1.0
  * licensed through CC BY-NC 4.0
  ************************************************************/

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
  if($_POST["lang"] == 'en'){
    $lang="EN_en";
    $lang_email = "en";
    $_SESSION["lang"]="EN_en";
    $_SESSION["lang_email"]="en";
  }
  else{
    $lang="ES_es";
    $lang_email = "es";
    $_SESSION["lang"]="ES_es";
    $_SESSION["lang_email"]="es";
  }

  $lang="ES_es";
    $lang_email = "es";
    $_SESSION["lang"]="ES_es";
    $_SESSION["lang_email"]="es";

  unset($_POST["lang"]);
  include_once(PATH."lang/".$lang.".php");
  
?>
