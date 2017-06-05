(function($) {
	'use_strict';


    $(document).ready(function(){

        WaitForMsg();
       
         function WaitForMsg(){

            $.ajax({
          
                type: 'POST',
                url: '/chatajax',
                async: true,
                cache: false,
                success: function(response){
                        var messages = $.parseJSON(response);
                        var table = "<table id='table' data-count='"+messages.length+"'><thead><tr><td>№</td><td>Author</td><td>Message</td><td>Attached</td><td>Date, time</td></tr></thead><tbody>";

                        var i = 0;
                        var j = 1;
                        var fileLink;
                        messages.forEach (function(){

                            if (messages[i]['attached'] != '') {
                                var fileLink ='';
                                if ( messages[i]['type_attached'] == 'text' ) {
                                        var class_link = 'popup-link-text';
                                } else {
                                        var class_link = 'popup-link-img';
                                }
                                fileLink = "<a id='link' class='"+class_link+"' href='"+messages[i]['attached']+"'>File for review</a>";
                            } else {
                                fileLink = 'File is no ggg';
                            }

                            table += "<tr>"+
                                                    "<td>"+j+"</td>"+
                                                    "<td>"+messages[i]['name']+"</td>"+
                                                    "<td>"+messages[i]['message']+"</td>"+
                                                    "<td>"+fileLink+"</td>"+
                                                    "<td>"+messages[i]['date_add']+"</td>"+
                                                "</tr>";
                            i++;
                            j++;
                        })

                        table += "</tbody></table>";

                        $("#chat-messages").html(table);

                    $("#table").on("click", ".popup-link-text", function (e) {
                            e.preventDefault();
                                $.ajax({
                                    url: this,
                                    type: "POST",
                                    data: {param1: 'value1'},
                                })
                                .done(function(data) {
                                    $("#popup-text .popup-text").html(data);
                                    console.log("success");
                                })
                                .fail(function() {
                                    console.log("error");
                                });     
                            $("#popup-text").css({
                                display: 'block'
                            }).fadeIn('4000');                      
                    });

                    $("#table").on("click", ".popup-link-img", function (e) {
                            e.preventDefault();
                            $("#popup-image .popup-image").html("<img src='"+$(this).attr('href')+"'>");
                                        
                            $("#popup-image").css({
                                display: 'block'
                            }).fadeIn('4000');
                    });                 
                
                    setTimeout(WaitForMsg(), 5000);
                    
                },
                
                error: function(XMLHttpRequest, textStatus, errorThrown){
                    setTimeout(WaitForMsg(),1000);
                }
                
            });
        } 


    });


})(jQuery)