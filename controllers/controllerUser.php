<?php
/**
* User
*/

require_once (ROOT."/models/modelUser.php");

class User {

	public $name = '';
	public $email = '';
	public $pass = '';
	public $modelUser;

	function __construct($userData) {
		$this->name = $userData['name'];
		$this->pass = $userData['pass'];

		if ( isset($userData['email']) ) {
			$this->email = $userData['email'];
		}

		$this->modelUser = new ModelUser();
	}

	public function userAction($action) {

		switch ($action) {
			case 'register':
				$this->userRigister();
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

		print_r( $user );
	}

	public function userRigister() {
		$res = $this->modelUser->insertUser($this->name, $this->email, $this->pass);
		echo $res;
	}	
}



?>