<?php
/**
* 
*/
class ModelUser{
	public function insertUser($name, $email, $pass){
		$sql = "INSERT INTO users (name, email, pass) VALUE ('$name', '$email', '$pass')";
		mysql_query($sql) or die();
		$message = "User was register";
		return $message;
	}

	public function getUser($name){
		$sql = "SELECT name, pass FROM users WHERE name = '$name'";
		$res = mysql_query($sql) or error_reporting();
		$user = mysql_fetch_assoc($res);

		if ( $user ) {
			return $user;
		}

		echo "User not found";
	}	
}

?>