/************************************************************
* Royappty
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Modification: 10-02-2014
* Version: 1.0
* licensed through CC BY-NC 4.0
************************************************************/

$(document).ready(function(){
  $("#form-contact-info").submit(function(e){
        e.preventDefault();
  });
  $("#form-contact-info").validate({
    messages:{
      contact_info:{
        required: $s["contact_info_this_field_is_compulsory"]
      }
    },
    rules:{
      contact_info:{
          required:true,
        }
    },
    submitHandler:function(form){
       $.ajax({
        type: "POST",
        dataType: 'json',
        url: $SERVER_PATH+"server/www/ajax/contactinfo/add_contact_info.php",
        data: {
          "lang": localStorage.getItem("lang"),
          "contact_info":$('#form-contact-info #contact_info').val()
        },
        error: function(data, textStatus, jqXHR) {
          modal_error_handler("ajax_error");
        },
        success: function(response) {
          if(response.result){
            set_modal("base-modal",response.data.modal_title,response.data.modal_content,response.data.modal_button,"#");
            $('#form-contact-info #contact_info').val("");
          } else {
            modal_error_handler(response.error_code);
          }

        }
      });
    }
  });

});
