<?php

/**
* Chat
*/

require_once ROOT.'/models/modelChat.php';

class Chat {

	public $modelChat; 
	function __construct(){
		$this->modelChat = new ModelChat();
	}

	public function getAllMessages() {

		$messagesAll = $this->modelChat->getMessages();
		return $messagesAll;
	}

	public function addMessage($message){
		$this->modelChat->addMessage($message);
	}

}

?>