<div class="main-chat">
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h1>Messages</h1>
				<div class="chat-messages-wrap">
					<div id="chat-messages" data-count="<?php echo $chat->countMessages; ?>" data-limit="<?php echo $chat->limitMessges;?>">
					<?php
						if ( is_array($chatMessages) ) {
							$i = 1;
							foreach ($chatMessages as $key => $message) {
					?>
						<div class="wrap-message">
							<div class="author-info">
								<div class="name">
									<?php echo $message['name'] ?>
								</div>
							</div>
							<div class="message-block">
								<div class="message-header">
									<?php echo$message['date_add'] ?>
								</div>
								<div class="message-body">
									<?php echo$message['message'] ?>
								</div>
								
								<?php 
								if ($message['attached'] != '') {
									if ($message['type_attached'] == 'text') {
											$class = "popup-link-text";
									} else {
											$class = "popup-link-img";
									}
								?>
								<div class="message-footer">

									<a class="<?php echo $class; ?>" href="<?php echo $message['attached']; ?>">File for review</a>
								</div>									
								<?php 
								}
								?>								
							</div>
						</div>
					<?php
							}
						}
					?>
					</div>					
				</div>

			</div>
			<div class="col-md-4">
				<div id="add-messages">
					<h3>Add message</h3>
					<div class="insert-tags">
						<button class="insert-tag" value="code">Code</button>
						<button class="insert-tag" value="italic">italic</button>
						<button class="insert-tag" value="strong">strong</button>
						<button class="insert-tag" value="strike">strike</button>
					</div>
					<form method="POST" action="addMessage" enctype="multipart/form-data" id="addMessage">
						<div class="control-group">
						    <div class="controls">
						      <textarea id="massage" placeholder="" name="massage" cols="30" rows="10"></textarea>
						    </div>
						</div>
						<div class="control-group">					
						  	<div class="controls">
						      <input type="file" id="attached_file" placeholder="" name="attached_file" >
						    </div>
					  </div>
					  <div class="control-group">
						<div id="recaptcha" class="g-recaptcha" data-sitekey="<?php echo CAPTCHA; ?>"></div>
					  </div>			  
					  <div class="control-group">
					    <div class="controls">
					      	<button id="submit-message" type="submit" class="btn">Send message</button>
					    </div>
					  </div>
					</form>
					<div class="msgError">Заповніть будь ласка усі поля</div>
				</div>				
			</div>
		</div>
	</div>
</div>
<div class="add-messages">
</div>
<div id="content"></div>


<div id="popup" class="close-popup">
	<div class="popup-text"></div>
	<div class="popup-image"></div>
	<canvas id="pixie"></canvas>
</div>






<script type="text/javascript" charset="utf-8">


$(document).ready(function(){
var tags = {
		'code':"<code></code>",
		"italic":"<i></i>",
		"strong":"<strong></strong>",
		"strike":"<strike></strike>"
		};

$(".insert-tag").click(function(){

	var index = $(this).val(); 

	var insertText = tags[index];
	var text = $("#massage").val();
    var ctrl = document.getElementById("massage");

            var CaretPos = 0;
            if ( document.selection ) {
                ctrl.focus ();
                var Sel = document.selection.createRange();
                Sel.moveStart ('character', -ctrl.value.length);
                CaretPos = Sel.text.length;
            } else if ( ctrl.selectionStart || ctrl.selectionStart == '0' ) {
                CaretPos = ctrl.selectionStart;
            }

            var startText = text.substring(0, CaretPos);
            var endText = text.substring(CaretPos);

	        $("#massage").val(startText + insertText + endText);
    });

/*
$("#addMessage").submit(function(event) {
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
		})
		.fail(function() {
		})
		.always(function() {
		});

	});	 
*/


});
</script>