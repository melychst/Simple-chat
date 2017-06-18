<?php
/**
* 
*/
class ModelUser{
	public $userId;
	public function insertUser($name, $email, $pass, $ip, $browser){
		$sql = "INSERT INTO users (name, email, pass, ip, browser) VALUE ('$name', '$email', '$pass', '$ip', '$browser')";
		mysql_query($sql) or die();
		$this->userId = mysql_insert_id();

	}

	public function getUser($name){
		$sql = "SELECT id, name, pass, ip, browser FROM users WHERE name = '$name'";
		$res = mysql_query($sql) or error_reporting();
		$user = mysql_fetch_assoc($res);

		if ( $user ) {
			return $user;
		}
	}
		
}

?>