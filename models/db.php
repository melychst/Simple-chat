<?php
	$db = mysql_connect( HOST, USER, PASSWORD );
	if (!$db) {
		echo "Error";
	}
	mysql_select_db(DB, $db);

?>