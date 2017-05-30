<?php
	if( isset($user->register) ){
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<ul>
				<?php 
				foreach ($user->register as $key => $value) {
					echo "<li>".$value."</li>";
				}
				?>
			</ul>	
		</div>
	</div>
</div>

<?php				
	}

?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Register</h1>
			<form class="form-horizontal" method="POST" action="user">
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
			    <label class="control-label" for="pass">Password</label>
			    <div class="controls">
			      <input type="password" id="pass" placeholder="" name="pass">
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="pass">Confirm Password</label>
			    <div class="controls">
			      <input type="password" id="pass_conf" placeholder="" name="pass_conf">
			    </div>
			  </div>
			  <div class="control-group">
				<div class="g-recaptcha" data-sitekey="6LexByMUAAAAABaVA4KhuU_HvuMu6fdrD2xfkiTd"></div>
			  </div>			  
			  			  
			  <div class="control-group">
			    <div class="controls">
			    	<input type="hidden" value="register" name="user_action">
			      	<button type="submit" class="btn">Register</button>
			    </div>
			  </div>
			</form>
		</div>
	</div>
</div>