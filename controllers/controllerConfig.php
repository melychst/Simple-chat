<?php

/**
* Config
*/
class Config 
{
	
	function __construct()
	{
		$db = mysql_connect(USER, PASSWORD, HOST);

		if (!$db) {
			echo "Error";
		}
		
		mysql_select_db(DB, $db);
	}
}
?>