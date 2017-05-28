<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<script src='https://www.google.com/recaptcha/api.js'></script>
	<script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
</head>
<body>
<header>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<?php if ( isset($_SESSION['user_name']) ) { echo "Hello ".$_SESSION['user_name']; } ?>
			</div>
			<div class="col-md-2">
				<a href="/">Home</a> / <a href="/logout">Log out</a>
			</div>
		</div>
	</div>
</header>