<?php
	session_start();
	include("header.php");
	error_reporting(E_ALL);
	include 'inc/config.php';

	require_once("class/Routers.php");

echo "<pre>";
	print_r($_SERVER);
echo "</pre>";

$route = new Routers();

$route->getUrl();



	include("footer.php");
?>