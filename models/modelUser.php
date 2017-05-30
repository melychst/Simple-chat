<?php
/**
* 
*/
class ModelUser{
	public $userId;
	public function insertUser($name, $email, $pass){
		$sql = "INSERT INTO users (name, email, pass) VALUE ('$name', '$email', '$pass')";
		mysql_query($sql) or die();
		$this->userId = mysql_insert_id();

	}

	public function getUser($name){
		$sql = "SELECT id, name, pass FROM users WHERE name = '$name'";
		$res = mysql_query($sql) or error_reporting();
		$user = mysql_fetch_assoc($res);

		if ( $user ) {
			return $user;
		}
	}
		
}

?>