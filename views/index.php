<?php
	print_r($_POST);
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<form class="form-horizontal" method="POST" >
			  <div class="control-group">
			    <label class="control-label" for="name">Name</label>
			    <div class="controls">
			      <input type="text" id="name" placeholder="name" name="name">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="email">Email</label>
			    <div class="controls">
			      <input type="email" id="email" placeholder="email" name="email">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="message">Message</label>
			    <div class="controls">
			      <textarea id="message" placeholder="Message" name="message" required=""></textarea>
			    </div>
			  </div>
			  <div class="control-group">
				<div class="g-recaptcha" data-sitekey="6LexByMUAAAAABaVA4KhuU_HvuMu6fdrD2xfkiTd" required=""></div>
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