<?php
require_once ROOT.'/recaptchalib.php';
/**
* Validation
*/
class Validation{

	public $errors = array();
	public $register;

	function __construct($name, $email, $pass, $pass_conf, $reCaptcha){
/*
		echo $name."<br>";
		echo $email."<br>";
		echo $pass."<br>";
		echo $pass_conf."<br>";
*/		
		$this->emptyField($name);
		$this->emptyField($email);
		$this->emptyField($pass);
		$this->emptyField($pass_conf);

		$this->maskEmail($email);

		$this->passValid($pass, $pass_conf);

		$this->reCaptcha($reCaptcha);

		if ( count($this->errors) > 0 ) {
			return $this->errors;
		}
		
		$this->register = 'true';

		return $this->register;
	}

	public function emptyField( $value ){
		if ($value == '') {
			$this->errors['empty'] = "Не всі поля заповнені";
			//array_push($this->errors, );
		}
	}

	public function maskEmail($value){
		if ( preg_match("/^[a-zA-Z0-9_\-.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-.]+$/",$value) != 1 ) {
			$this->errors['email'] = "Не коректний email";
			//array_push($this->errors, );			
		}
	}

	public function passValid($pass, $pass_conf){
		if ($pass != $pass_conf) {
			$this->errors['password'] =  "Паролі не співпадають";
			//array_push($this->errors, "Паролі не співпадають");
		}
	}

	public function reCaptcha($captha) {
			$reCaptcha = new ReCaptcha(CAPTCA_SECRET);	
			$response = $reCaptcha->verifyResponse(
					    $_SERVER["REMOTE_ADDR"],
					    $captha
					);
			if ($response != null && $response->success) {
				return;
			}
		$this->errors['reCaptcha'] = "Помилка каптчі";	
	}		
}

?>