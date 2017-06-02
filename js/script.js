$(function() {
	'use_strict';

    function WaitForMsg()  {

        $.ajax({
    
            type: 'POST',
            url: '/chatajax',
            async: true,
            cache: false,
            success: function(response){

            		var messages = $.parseJSON(response);
					var table = "<table id='table' data-count='"+messages.length+"'><thead><tr><td>Author</td><td>Message</td><td>Date, time</td></tr></thead><tbody>";

					var i = 0;

					messages.forEach (function(){
						table += "<tr><td>"+messages[i]['name']+"</td><td>"+messages[i]['message']+ "</td><td>"+messages[i]['date_add']+"</td></tr>";
						i++;
					})

					table += "</tbody></table>";

					$("#chat-messages").html(table);                    
                   setTimeout('WaitForMsg()',1000);
                
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown){
                
                setTimeout('WaitForMsg()',1000);
            }
            
        });
    }
    
    $(document).ready(function(){
        WaitForMsg();
    });
 

	


})(jQuery)