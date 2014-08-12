var $s = new Array();
var $error_s = new Array();

//Contact Infor
$s["contact_info_this_field_is_compulsory"] = "Este campo es obligatorio";

//Contact Form
$s["contact_form_name_this_field_is_compulsory"] = "Este campo es obligatorio";
$s["contact_form_name_it_canot_be_longer_than_75_characters"] = "No puede exceder los 75 caracteres";
$s["contact_form_name_this_field_needs_4_character_minimum"] = "Este campo necesita un m&iacute;nimo de 4 caracteres";
$s["contact_form_email_this_field_is_compulsory"] = "Este campo es obligatorio";
$s["contact_form_email_format_is_not_correct"] = "El formato del email no es v&aacute;lido";
$s["contact_form_content_this_field_is_compulsory"] = "Este campo es obligatorio";

//General
$s["back"] = "Volver";
$s["close"] = "Cerrar";

//error index.html
$s["error_title"] = "Error en el Servidor";
$s["error_content"] ="Ha ocurrido un error en el servidor mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

//error index.html
$s["close_title"] = "Pronto estaremos de regreso";
$s["close_content"] = "Estamos octualizando Royappty para ti y pronto volverá a estar disponible.<br/>Si necesitas contactar con nosotros puedes hacerlo mediante tel&eacute;fono o email.";
$s["close_contact_info"] = "<i class='fa fa-phone'></i> "+$config["company_phone"]+" <i class='fa fa-envelope-o'></i> "+$config["company_info_mail"];

//Modal errors
$error_s["ajax_error_title"]="Error en el Servidor";
$error_s["ajax_error_content"]="Ha ocurrido un error en el servidor mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

$error_s["db_connection_error_title"]="Error en la Base de datos";
$error_s["db_connection_error_content"]="Ha ocurrido un error en la base de datos mientras se realizaba la operación. Por favor vuelva a intentarlo más tarde. En caso de que este error persista contacte con el servico técnico.";

$(document).ready(function() {
  $("#s-error-title").html($s["error_title"]);
  $("#s-error-content").html($s["error_content"]);
  $("#s-close-title").html($s["close_title"]);
  $("#s-close-content").html($s["close_content"]);
  $("#s-close-contact-info").html($s["close_contact_info"]);
  $("#s-back").html($s["back"]);
  $("#s-close").html($s["close"]);
});
