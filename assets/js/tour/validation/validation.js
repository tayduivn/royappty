/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function(){
  $.ajax({
    async: false,
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/www/ajax/tour/validation/get_validation.php",
    data: {
      lang: localStorage.getItem("lang")
    },
    error: function(data, textStatus, jqXHR) {
      error_handler("error ajax");
    },
    success: function(response) {
      if(response.result){
        jQuery.each(response.data,function(key,value){
           $(".ajax-loader-"+key).html(value);
        });
      }else{
        error_handler(response.error_code);
      }
    }
  });
});
