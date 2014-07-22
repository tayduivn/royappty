$(document).ready(function(){
  $.ajax({
    async: false,
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/main/ajax/main/get_main.php",
    data: {
    },
    error: function(data, textStatus, jqXHR) {
      alert("error ajax");
    },
    success: function(response) {
      alert("success");
      if(response.result){
        jQuery.each(response.data,function(key,value){
          $(".ajax-loader-"+key).html(value);
        });
      }
    }
  });
});
