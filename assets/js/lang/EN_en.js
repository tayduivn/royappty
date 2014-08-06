var $s = new Array();

//general
$s["back"] = "Back";

//error index.html
$s["error_title"] = "Error in the Server";
$s["error_content"] = "An error occurred in the server while carrying out the operation. Please, try it again later. If the error persists, contact our technical service.";

$(document).ready(function() {
  $("#s-error-title").html($s["error_title"]);
  $("#s-error-content").html($s["error_content"]);
  $("#s-back").html($s["back"]);
});
