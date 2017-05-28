<?php
	//print_r($_POST);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Sign in</h1>
			<form class="form-horizontal" method="POST" action="user">
			  <div class="control-group">
			    <label class="control-label" for="name">Name</label>
			    <div class="controls">
			      <input type="text" id="name" placeholder="name" name="name" required>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="pass">Password</label>
			    <div class="controls">
			      <input type="password" id="pass" placeholder="" name="pass" required>
			    </div>
			  </div>
			  <div class="control-group">
			    <div class="controls">
					<input type="hidden" value="login" name="user_action">
			     	<button type="submit" class="btn">Sign in</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div>
