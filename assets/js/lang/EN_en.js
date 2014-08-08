var $s = new Array();
var $error_s = new Array();

//Contact Infor
$s["contact_info_this_field_is_compulsory"] = "This field is compulsory";

//Contact Form
$s["contact_form_name_this_field_is_compulsory"] = "This field is compulsory";
$s["contact_form_name_it_canot_be_longer_than_75_characters"] = "It cannot be longer than 75 characters";
$s["contact_form_name_this_field_needs_4_character_minimum"] = "This field needs 4 character minimum";
$s["contact_form_email_this_field_is_compulsory"] = "This field is compulsory";
$s["contact_form_email_format_is_not_correct"] = "Email format is not correct";
$s["contact_form_content_this_field_is_compulsory"] = "This field is compulsory";

//General
$s["back"] = "Back";
$s["close"] = "Close";

//error index.html
$s["error_title"] = "Error in the Server";
$s["error_content"] = "An error occurred in the server while carrying out the operation. Please, try it again later. If the error persists, contact our technical service.";

//Modal errors
$error_s["ajax_error_title"]="Error in the Server";
$error_s["ajax_error_content"]="An error occurred in the server while carrying out the operation. Please, try it again later. If the error persists, contact our technical service.";

$error_s["db_connection_error_title"]="Error in the Database Server";
$error_s["db_connection_error_content"]="An error occurred in the database server while carrying out the operation. Please, try it again later. If the error persists, contact our technical service.";

$(document).ready(function() {
  $("#s-error-title").html($s["error_title"]);
  $("#s-error-content").html($s["error_content"]);
  $("#s-back").html($s["back"]);
  $("#s-close").html($s["close"]);
});
