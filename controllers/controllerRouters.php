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
					//print_r($_POST);
					require_once('controllerUser.php');
					$user = new User($_POST);
					
					if ( is_array($user->register) ) {
						$views = "/views/sign-up.php";
					}

					if ( isset($user->login) && !$user->login) {
						$loginError = "Невірні логін або пароль";
						$views = "/views/sign-in.php";
					}

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
				ob_start();
				if ( !isset($_SESSION['user_name']) ) {
					header("Location: /");
					die();
				}

				if ( isset($_POST['massage']) ) {

					$messageAdd = $chat->validateMessage($_POST['massage']);
					$uploadFile = array();

					if ($_FILES['attached_file']['error'] == 0 ) {
						$uploadFile = $_FILES['attached_file'];
					}

					$chat->addMessage( $messageAdd, $uploadFile );
					//header("Location: /chat");
				}

				$chatMessages = $chat->getAllMessages($chat->countMessages);

				$views = "/views/chat.php";

				break;
			
			case '/chatajax':
				require_once('controllerChat.php');
				$chat = new Chat();

				if ( isset($_POST['count']) ){
					$countPost = $_POST['count'];
				} 
				$chatMessages = $chat->getAllMessages($countPost);
				echo json_encode($chatMessages);
				die();
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