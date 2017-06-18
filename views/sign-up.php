

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php
				if( isset($user->register) ){
			?>
			<div class="loginError">
				<ul>
					<?php 
					foreach ($user->register as $key => $value) {
						echo "<li>".$value."</li>";
					}
					?>
				</ul>	
			</div>
			<?php				
				}

			?>
			<div class="sign-form">
				<h1>Register</h1>
				<form class="form-horizontal" method="POST" action="user" id="signUp">
				  <div class="control-group">
				    <div class="controls">
				      <input type="text" id="name" placeholder="Name" name="name">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <input type="email" id="email" placeholder="Email" name="email">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <input type="password" id="pass" placeholder="Password" name="pass">
				    </div>
				  </div>
				  <div class="control-group">
				    <div class="controls">
				      <input type="password" id="pass_conf" placeholder="Password" name="pass_conf">
				    </div>
				  </div>
				  <div class="control-group">
					<div class="g-recaptcha" data-sitekey="<?php echo CAPTCHA; ?>"></div>
				  </div>			  
				  			  
				  <div class="control-group">
				    <div class="controls">
				    	<input type="hidden" value="register" name="user_action">
				      	<button type="submit" class="btn">Register</button>
				    </div>
				  </div>
				</form>
				<div class="msgError">Заповніть будь ласка усі поля</div>
			</div>
		</div>
	</div>
</div>