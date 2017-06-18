<?php
	session_start();
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	include 'inc/config.php';
	require_once ROOT.'/recaptchalib.php';
	require_once(ROOT."/controllers/controllerRouters.php");

	$route = new Routers();
	$route->getUrl();
?>
<script>

		$(".close-popup").click(function() {
			$(".close-popup").css({
				display: 'none'
			}).fadeOut('4000');
		});

</script>