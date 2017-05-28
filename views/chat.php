
<div class="main-chat">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Messages</h1>
				<div id="chat-messages">
					<table>
						<thead>
							<tr>
								<td>Author</td>
								<td>Message</td>
								<td>Date, time</td>
							</tr>
						</thead>
						<tbody>
							<?php
								if ( is_array($chatMessages) ) {
									foreach ($chatMessages as $key => $message) {
									
							?>
							
							<tr>
								<td><?php echo $message['name'] ?></td>
								<td><?php echo$message['message'] ?></td>
								<td><?php echo$message['date_add'] ?></td>
							</tr>


							<?php
									}
								}

							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="add-messages">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Add message</h3>
				<form method="POST" action="chat">
				  <div class="control-group">
				    <label class="control-label" for="massage">Message</label>
				    <div class="controls">
				      <textarea id="massage" placeholder="" name="massage" required cols="30" rows="10"></textarea>
				    </div>
				  </div>
				  <div class="control-group">
					<div class="g-recaptcha" data-sitekey="6LexByMUAAAAABaVA4KhuU_HvuMu6fdrD2xfkiTd"></div>
				  </div>			  
				  <div class="control-group">
				    <div class="controls">
				      	<button type="submit" class="btn">Send message</button>
				    </div>
				  </div>
				</form>
			</div>
		</div>
	</div>
</div>
<div id="content"></div>
<script type="text/javascript" charset="utf-8">
    
    function WaitForMsg()
    {
        $.ajax({
       
            type: 'POST',
            url: '/chatajax',
            async: true,
            cache: false,
            success: function(response){

            		var messages = $.parseJSON(response);
					var table = "<table><thead><tr><td>Author</td><td>Message</td><td>Date, time</td></tr></thead><tbody>";

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
                
                // alert("Error: " + textStatus + "(" + errorThrown +")");
                
                setTimeout('WaitForMsg()',1000);
            }
            
        });
    }
    
    $(document).ready(function(){
        
        WaitForMsg();
        
    });
 
</script>