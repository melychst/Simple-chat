<?php

/**
* Routers
*/

require_once $_SERVER['DOCUMENT_ROOT']."/models/db.php";

class Routers {
	
	public function getUrl() {
		$views = ''; 
		switch ($_SERVER['REQUEST_URI']) {
			case '/':
				$views = "/views/index.php";
				break;
			case '/login':
				$views = "/views/sign-in.php";
				break;
			case '/register':
				$views = "/views/sign-up.php";
				break;
			case '/user':
				if ( isset($_POST['user_action']) ) {
					require_once('controllerUser.php');
					$user = new User($_POST);
					$user->userAction( $_POST['user_action'] );
				} else {
					header("Location: /" );
				}
				break;

			case '/logout':
				$_SESSION = array();
				header("Location: /");
				break;

			case '/chat':
				require_once('controllerChat.php');
				$chat = new Chat();
				
				if ( !isset($_SESSION['user_name']) ) {
					header("Location: /");
					die();
				}

				if ( isset($_POST['massage']) ) {
					$chat->addMessage( $_POST['massage'] );
					header("Location: /chat");
				}

				$chatMessages = $chat->getAllMessages();

				$views = "/views/chat.php";

				break;
			
			case '/chatajax':
				require_once('controllerChat.php');
				$chat = new Chat();				
				$chatMessages = $chat->getAllMessages();
				echo json_encode($chatMessages);
				break;


			default:
				$views = "/views/404.php";
				break;
		}

		if ( $views != '' ) {
			include("header.php");
			include( $_SERVER['DOCUMENT_ROOT'].$views );	
			include("footer.php");
		}
	}
}

?>