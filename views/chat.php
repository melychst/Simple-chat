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
				<div class="insert-tags">
					<button class="insert-tags" value="code" onclick="getCursorPosition( document.getElementById('massage') )">Code</button>
					<button class="insert-tags" value="i" value="i" >i</button>
					<button class="insert-tag" value="u" value="u" >u</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="content"></div>

<div id="popup-text" class="close-popup"><div class="popup-text"></div></div>
<div id="popup-image" class="close-popup"><div class="popup-image"></div></div>


<script type="text/javascript" charset="utf-8">


$(document).ready(function(){
 			
$(".insert-tag").click(function(){

    var ctrl = $("#massage");


            var CaretPos = 0;
            if ( document.selection ) {
                ctrl.focus ();
                var Sel = document.selection.createRange();
                Sel.moveStart ('character', -ctrl.value.length);
                CaretPos = Sel.text.length;
            } else if ( ctrl.selectionStart || ctrl.selectionStart == '0' ) {
                CaretPos = ctrl.selectionStart;
            }
            alert (CaretPos+" www");
            return CaretPos;
 

    })

});
            
            function getCursorPosition( ctrl ) {
            var CaretPos = 0;
            if ( document.selection ) {
                ctrl.focus ();
                var Sel = document.selection.createRange();
                Sel.moveStart ('character', -ctrl.value.length);
                CaretPos = Sel.text.length;
            } else if ( ctrl.selectionStart || ctrl.selectionStart == '0' ) {
                CaretPos = ctrl.selectionStart;
            }
            alert (CaretPos+" vvv");
            return CaretPos;
        }

 
</script>