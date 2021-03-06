<!DOCTYPE html>
<html lang="en">
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="lib/jquery-3.2.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="js/parallaxsoon3.js"></script>
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="left-col">
					<h2>
						<?php if ( isset($_SESSION['user_name']) ) { echo "Hello ".$_SESSION['user_name']; } ?>	
					</h2>	
				</div>
			</div>
			<div class="col-md-2">
				<div class="right-col">
					<a href="/logout">Log out</a>
				</div>
			</div>
		</div>
	</div>
</header>