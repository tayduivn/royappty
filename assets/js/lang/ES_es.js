var $s = new Array();

//general
$s["back"] = "Volver";

//error app index.html
$s["error_title"] = "Error en el Servidor";
$s["error_content"] ="Ha ocurrido un error en el servidor mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";
$(document).ready(function() {
  $("#s-error-title").html($s["error_title"]);
  $("#s-error-content").html($s["error_content"]);
  $("#s-back").html($s["back"]);
});
