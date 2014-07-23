$(document).ready(function(){
  $.ajax({
    async: false,
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/www/ajax/main/get_main.php",
    data: {
    },
    error: function(data, textStatus, jqXHR) {
      alert("error ajax");
    },
    success: function(response) {
      if(response.result){
        jQuery.each(response.data,function(key,value){
           $(".ajax-loader-"+key).html(value);
        });
      }
    }
  });
});
