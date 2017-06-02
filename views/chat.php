<div class="main-chat">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Messages</h1>
				<div id="chat-messages">
					<table id="table" data-count="25">
						<thead>
							<tr>
								<td>№</td>
								<td>Author</td>
								<td>Message</td>
								<td>Attached</td>
								<td>Date, time</td>
							</tr>
						</thead>
						<tbody>
							<?php
								if ( is_array($chatMessages) ) {
									$i = 1;
									foreach ($chatMessages as $key => $message) {
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $message['name'] ?></td>
								<td><?php echo$message['message'] ?></td>
								<td>
								<?php 
								if ($message['attached'] != '') {
										if ($message['type_attached'] == 'text') {
												$class = "popup-link-text";
										} else {
												$class = "popup-link-img";
										}
								?>
									<a class="<?php echo $class; ?>" href="<?php echo $message['attached']; ?>">File for review</a>
								<?php 
								}else {
								?>
								
								File is no

								<?php	
								}
								?>
									
								</td>
								<td><?php echo$message['date_add'] ?></td>
							</tr>
							<?php
								$i++;
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
				<form method="POST" action="chat" enctype="multipart/form-data">
					<div class="control-group">
					    <label class="control-label" for="massage">Message</label>
					    <div class="controls">
					      <textarea id="massage" placeholder="" name="massage" required cols="30" rows="10"></textarea>
					    </div>
					</div>
					<div class="control-group">
					    <label class="control-label" for="attached_file">Upload file</label>					
					  	<div class="controls">
					      <input type="file" id="attached_file" placeholder="" name="attached_file" >
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

<div id="popup-text" class="close-popup"><div class="popup-text"></div></div>
<div id="popup-image" class="close-popup"><div class="popup-image"></div></div>


<script type="text/javascript" charset="utf-8">
    
    function WaitForMsg()  {

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
          //setTimeout('WaitForMsg()',5000);
                
            },
            
            error: function(XMLHttpRequest, textStatus, errorThrown){
                setTimeout('WaitForMsg()',1000);
            }
            
        });
    }
    
    $(document).ready(function(){

       	WaitForMsg();

     });



 
</script>