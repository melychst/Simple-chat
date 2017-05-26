<?php

/**
* Validation
*/
class Validation{

	public $errors = array();
	public $min = 8;

	function emptyField($value, $key, $type = ''){

		if ($type != 'password') {
			$value = strip_tags(trim($value));
		}
		
		if ($value == '') {
			array_push($this->errors, "Field ".$key." not must be empty");
		}
		return $value;
		
	}

	function minLength($value, $key){
		
		if ( strlen($value) <  $this->min ) {
			array_push($this->errors, "Min length ".$key." field must be 8 chars");
		}
		return $value;
	}

	function maskEmail($value, $key){
		if ( preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/",$value) != 1 ) {
			array_push($this->errors, "This is not email ".$key);			
		}
		return $value; 
	}

	function passValid($pass, $key, $pass_corect){
		if ($pass != $pass_corect) {
			array_push($this->errors, "Паролі не співпадають");
			$_SESSION['pass_corect'] = '';
		}
		return $pass;
	}

	function maskPass($value, $key){
		if ( preg_match("/(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])/", $value) != 1 )  {
				array_push($this->errors, "Пароль надто простий ".$key);
		}
		return $value;
	}

	function cashPass($value){
		return password_hash($password, PASSWORD_DEFAULT);
	}
}

?>