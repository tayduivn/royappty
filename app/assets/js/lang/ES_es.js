var $s = new Array();

$s["back"]="Volver";

//html errors
$error_s["error"]["title"] = "Error";
$error_s["error"]["content"]= "Ha ocurrido un error al cargar la página. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

$(document).ready(function(){
  $("#s-error-title").html($error_s["error"]["title"]);
  $("#s-error-content").html($error_s["error"]["content"]);
  $("#s-back").html($s["back"]);
})
