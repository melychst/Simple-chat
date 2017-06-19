<?php

/**
* Config
*/
class Config 
{
	
	function __construct()
	{
		$db = mysql_connect(USER, PASSWORD, HOST);
		mysql_set_charset("utf8");
		//mysql_query('SET NAMES utf8 COLLATE utf8_general_ci');

		if (!$db) {
			echo "Error";
		}
		
		mysql_select_db(DB, $db);
	}
}
?>