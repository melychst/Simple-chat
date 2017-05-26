<?php
	session_start();
	include("header.php");
	include("inc/config.php");
	error_reporting(E_ALL);
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1>Welcome to Simple chat</h1>
			<div class="links">
				<a href="<?php echo 'sign-in'; ?>">Sign in</a> / <a href="<?php echo 'sign-up'; ?>">Sign up</a>
			</div>
		</div>
	</div>
</div>


<?php
	include("footer.php");
?>