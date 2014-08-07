var $s = new Array();
var $error_s = new Array();

//Contact Infor
$s["contact-info_this_field_is_compulsory"] = "Este campo es obligatorio";

//General
$s["back"] = "Volver";
$s["close"] = "Cerrar";

//error index.html
$s["error_title"] = "Error en el Servidor";
$s["error_content"] ="Ha ocurrido un error en el servidor mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

//Modal errors
$error_s["ajax_error_title"]="Error en el Servidor";
$error_s["ajax_error_content"]="Ha ocurrido un error en el servidor mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

$error_s["db_connection_error_title"]="Error en la Base de datos";
$error_s["db_connection_error_content"]="Ha ocurrido un error en la base de datos mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

$(document).ready(function() {
  $("#s-error-title").html($s["error_title"]);
  $("#s-error-content").html($s["error_content"]);
  $("#s-back").html($s["back"]);
  $("#s-close").html($s["close"]);
});
