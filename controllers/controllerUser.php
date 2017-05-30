<?php
/**
* User
*/

require_once (ROOT."/models/modelUser.php");
require_once (ROOT."/controllers/controllerValidation.php");


class User {

	public $name = '';
	public $email = '';
	public $pass = '';
	public $pass_conf = '';
	public $modelUser;
	public $register;
	public $login;

	function __construct($userData){
		//print_r($userData);
		$this->name = strip_tags($userData['name']);
		$this->pass = $userData['pass'];

		if ( isset($userData['email']) ) {
			$this->email = strip_tags($userData['email']);
		}

		if ( isset($userData['pass_conf']) ) {
			$this->pass_conf = $userData['pass_conf'];
		}

		$this->modelUser = new ModelUser();

		$this->register = $this->userAction($userData['user_action']);

		return $this->register;


	}

	public function userAction($action) {

		switch ($action) {
			case 'register':
				$validation = new Validation($this->name, $this->email, $this->pass, $this->pass_conf);
				if ( $validation->register == 'true' ) {
					$this->userRigister();
				} else {
					return $validation->errors;
				}
				break;

			case 'login':
				
				$this->userLogin();
				break;
			default:
				break;
		}
	}

	public function userLogin() {

		$user = $this->modelUser->getUser($this->name);
		
		if ( !is_array($user) ||  !password_verify($this->pass, $user['pass']) ) {
			$this->login = false;
			return;
		}
		
		$_SESSION['user_name'] = $user['name'];
		$_SESSION['user_id'] = $user['id'];

		header("Location: /chat");
	}

	public function userRigister() {

		$this->pass = password_hash($this->pass, PASSWORD_DEFAULT);
		$res = $this->modelUser->insertUser($this->name, $this->email, $this->pass);


		$_SESSION['user_name'] = $this->name;
		$_SESSION['user_id'] = $this->modelUser->userId;
		header("Location: /chat");
	}
}



?>