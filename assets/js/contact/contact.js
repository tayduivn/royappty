$(document).ready(function(){
  $.ajax({
    async: false,
    type: "POST",
    dataType: 'json',
    url: $SERVER_PATH+"server/www/ajax/contact/get_contact.php",
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


  $("#form-contact").submit(function(e){
        e.preventDefault();
  });
  $("#form-contact").validate({
    messages:{
      name:{
        required: $s["contact_form_name_this_field_is_compulsory"],
        maxlength: $s["contact_form_name_it_canot_be_longer_than_75_characters"],
        minlength: $s["contact_form_name_this_field_needs_4_character_minimum"]
      },
      email:{
        required: $s["contact_form_email_this_field_is_compulsory"],
        email: $s["contact_form_email_format_is_not_correct"]
      },
      content:{
        required: $s["contact_form_content_this_field_is_compulsory"]
      }
    },
    rules:{
      name:{
        required:true,
        maxlength: 75,
        minlength: 4
      },
      email:{
       required:true,
       email: true
      },
      content:{
        required:true
      }
    },
    submitHandler:function(form){
       $.ajax({
        type: "POST",
        dataType: 'json',
        url: $SERVER_PATH+"server/www/ajax/contact/send_contact.php",
        data: {
          "lang": localStorage.getItem("lang"),
          "name":$('#form-contact #name').val(),
          "email":$('#form-contact #email').val(),
          "content":$('#form-contact #content').val()
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
