$(document).ready(function(){
  $.ajax({
    async: false,
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/www/ajax/tour/get_tour.php",
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
