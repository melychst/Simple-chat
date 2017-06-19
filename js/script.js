(function($) {
	'use strict';

    $(document).ready(function(){
 
    var timerId = setTimeout(WaitForMsg, 1000, 0);

    function WaitForMsg(countParam){
       var count;
       var limit = $("#chat-messages").attr("data-limit");

        if (countParam != 0) {
          count = countParam;
        } else {
          count = $("#chat-messages").attr("data-count");
        }

        $.ajax({
            type: 'POST',
            url: '/chatajax',
            data: {
                  count:count,
                },
            async: true,
            cache: false,
            success: function(response){
                    clearTimeout(timerId);
                    var messages = $.parseJSON(response);
                    if (messages.length < count ) {
                      var newCount = count;
                    } else {
                      var newCount = messages.length;
                    }

                    var messagesBox = "<div id='chat-messages' data-count='"+newCount+"' data-limit='"+limit+"'>";
                    var i = 0;
                    
                    messages.forEach (function(){
                      var fileLink = '';
                      if (messages[i]['attached'] != '') {
                          var fileLink ='';
                          if ( messages[i]['type_attached'] == 'text' ) {
                                  var class_link = 'popup-link-text';
                          } else {
                                  var class_link = 'popup-link-img';
                          }
                          fileLink = "<a id='link' class='"+class_link+"' href='"+messages[i]['attached']+"'>File for review</a>";
                      }

                        messagesBox +=  "<div class='wrap-message'>"+
                                          "<div class='author-info'>"+
                                            messages[i]['name']+
                                          "</div>"+
                                          "<div class='message-block'>"+
                                            "<div class='message-header'>"+
                                            messages[i]['date_add']+
                                            "</div>"+
                                            "<div class='message-body'>"+
                                            messages[i]['message']+
                                            "</div>";
                                            if (fileLink != '') {
                                              messagesBox += "<div class='message-footer'>"+
                                                                 fileLink+                  
                                                                "</div>";
                                            }                    
                                            
                         messagesBox +=  "</div>"+
                                        "</div>";

                        i++;
                    })                        

                    messagesBox +=  "</div>";

                    $(".chat-messages-wrap").html(messagesBox);

                    $("#chat-messages").on("click", ".popup-link-text", function (e) {
                            e.preventDefault();
                                $.ajax({
                                    url: this,
                                    type: "POST",
                                    data: {param1: 'value1'},
                                })
                                .done(function(data) {
                                    $("#popup .popup-text").html(data);
                                })
                                .fail(function() {
                                });     
                            $("#popup").css({
                                display: 'block'
                            });
                            $("#popup .popup-text").css({
                                display: 'block'
                            });
                            $("#popup .popup-image").css({
                                display: 'none'
                            }); 

                    });

                    $("#chat-messages").on("click", ".popup-link-img", function (e) {
                            e.preventDefault();
                            $("#popup .popup-image").html("<img src='"+$(this).attr('href')+"'>");
                            $("#popup").css({
                                display: 'block'
                            });
                            $("#popup .popup-image").css({
                                display: 'inline-block'
                            });
                            $("#popup .popup-text").css({
                                display: 'none'
                            });
                    });

                    //var newCount = $("#chat-messages").attr("data-count");                 
                    timerId = setTimeout(WaitForMsg, 1000, newCount);
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown){
                console.log("ERROR");
            }
            
        });
    }


    $(document).scroll(function(event) {

      if ( $(document).width() > 480 ) {
            var documentHeight = $(document).height();
            var scrollTop = +$(document).scrollTop();
            var windowHeight= $(window).height();
              if ( (scrollTop + windowHeight) == documentHeight ) {
                var count = +$("#chat-messages").attr("data-count") + +$("#chat-messages").attr("data-limit");
                WaitForMsg(count);
              }
              var headerHeigh = $("header").height() + 40;
             
              if (scrollTop > headerHeigh ) {
                 $("#add-messages").css({
                   position: 'fixed',
                   top:'10px',
                 });
              }

              if (scrollTop < headerHeigh ) {
                 $("#add-messages").css({
                   position: 'static',
                 });
              }   
      }
       
    });


    $(function() {
      $("#chat-messages .popup-link-text").click(function(e) {
              e.preventDefault();
                  $.ajax({
                      url: $(this).attr("href"),
                      type: "POST",
                      data: {param1: 'value1'},
                  })
                  .done(function(data) {
                      $("#popup-text .popup-text").html(data);
                  })
                  .fail(function() {
                  });     
              $("#popup-text").css({
                  display: 'block'
              }).fadeIn('4000');                      
      });

      $("#chat-messages .popup-link-img").click(function(e) {
              e.preventDefault();
              $("#popup-image .popup-image").html("<img src='"+$(this).attr('href')+"'>");
              $("#popup-image").css({
                  display: 'block'
              }).fadeIn('4000');
      });
    })
  });

/* Валідація форми реєєстрації */
  $(function () {

    $('input').focus(function () {
      $(this).css('border','#d3d3d3 solid 1px');
      $('.msgError').fadeOut(100);
    })

    $('input').change(function () {
      $(this).css('border','#0a2032 solid 1px');
    })

    $('#signUp').submit(function () {
      var mass  =  {
        'name' : $('#name').val(),
        'email' : $('#email').val(),
        'pass' : $('#pass').val(),
        'pass_conf' : $('#pass_conf').val(),
        'capcha' : grecaptcha.getResponse(),
      }

      for (var key in mass ) {
          if ( mass[key] == '' ) {
            $('.msgError').fadeIn(100);
            $('#' + key).css('border','#e01a32 solid 1px');
            return false;
          }

      }
    })
  })


  /* Валідація відправки повідомлення */

  $(function () {

    $('textarea').focus(function () {
      $(this).css('border','#d3d3d3 solid 1px');
      $('.msgError').fadeOut(100);
    })

    $('input').change(function () {
      $(this).css('border','#0a2032 solid 1px');
    })

    $('#addMessage').submit(function () {
      var mass  =  {
        'massage' : $('#massage').val(),
        'capcha' : grecaptcha.getResponse(),
      }

      for (var key in mass ) {
          if ( mass[key] == '' ) {
            $('.msgError').fadeIn(100);
            $('#' + key).css('border','#e01a32 solid 1px');
            return false;
          }
      }

      event.preventDefault();
      var formData = new FormData(this);
    
      $.ajax({
        url: '/chat',
        type: 'POST',
        contentType: false,
            processData: false,   
          data: formData,
      })
      .done(function() {
        $("#massage").val('');
      });
    })
  })

})(jQuery)