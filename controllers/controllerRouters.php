<?php

/**
* Routers
*/

require_once $_SERVER['DOCUMENT_ROOT']."/models/db.php";

class Routers {
	
	public function getUrl() {

		switch ($_SERVER['REQUEST_URI']) {
			case '/':
				include($_SERVER['DOCUMENT_ROOT']."/views/index.php");
				break;
			case '/login':
				include($_SERVER['DOCUMENT_ROOT']."/views/sign-in.php");
				break;
			case '/register':
				include($_SERVER['DOCUMENT_ROOT']."/views/sign-up.php");
				break;
			case '/user':
			

				if ( isset($_POST['user_action']) ) {
					require_once('controllerUser.php');
					$user = new User($_POST);
					$user->userAction( $_POST['user_action'] );
				} else {
					//header("Location: /" );
					echo "Must be redirect";
				}

				break;

			default:
				include($_SERVER['DOCUMENT_ROOT']."/views/404.php");
				break;
		}
	}
}

?>