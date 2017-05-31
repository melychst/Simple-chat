<?php
	session_start();
	
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	include 'inc/config.php';
	require_once(ROOT."/controllers/controllerRouters.php");

	$route = new Routers();
	$route->getUrl();
?>
<a class="popup-link-text" href="download/sities.txt">TEXT / </a>
<a class="popup-link-text" href="download/text.txt">TEXT</a>
<a class="popup-link-img" href="download/AG-2nd-story2-300.jpg">img</a>
<div id="popup-text" class="close-popup"><div class="popup-text"></div></div>
<div id="popup-image" class="close-popup"><div class="popup-image"></div></div>

<script>

	$(".popup-link-text").click(function (e) {
		e.preventDefault();

		$.ajax({
			url: this,
			type: "POST",
			data: {param1: 'value1'},
		})
		.done(function(data) {
			$("#popup-text .popup-text").html(data);
			console.log("success");
		})
		.fail(function() {
			console.log("error");
		});		
	$("#popup-text").css({
		display: 'block'
	}).fadeIn('4000');;
	
	});

	$(".popup-link-img").click(function (e) {
		e.preventDefault();
	$("#popup-image .popup-image").html("<img src='"+$(this).attr('href')+"'>");
				
	$("#popup-image").css({
		display: 'block'
	}).fadeIn('4000');;
	
	});	


	$(".close-popup").click(function() {
		$(".close-popup").css({
			display: 'none'
		}).fadeOut('4000');
	});
</script>
