<?php
	session_start();
	include("header.php");
	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
	include 'inc/config.php';
	require_once("Controllers/controllerRouters.php");

	$route = new Routers();
	$route->getUrl();

	include("footer.php");
?>