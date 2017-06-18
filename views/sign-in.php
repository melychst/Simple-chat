
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				if ( isset($loginError) && ($loginError != '') ) {
			?>
			<div class="loginError">
				<?php echo $loginError; ?>
			</div>	
			<?php		
				}
			?>
			<div class="sign-form">
				<h1>Sign in</h1>
				<form class="form-horizontal" method="POST" action="user">
				  <div class="control-group">
				    <div class="controls">
				      <input type="text" id="name" placeholder="Name" name="name">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <input type="password" id="pass" placeholder="Password" name="pass">
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
</div>
