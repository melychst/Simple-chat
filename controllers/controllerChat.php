<?php

/**
* Chat
*/

require_once ROOT.'/models/modelChat.php';

class Chat {

	public $modelChat; 
	public $linkFile = '';

	public $fileType = array(
						'text/plain' => 'text', 
						'image/jpeg' => 'image'
						);

	public $fileCheck = false;

	function __construct(){
		$this->modelChat = new ModelChat();
	}

	public function getAllMessages() {

		$messagesAll = $this->modelChat->getMessages();
		return $messagesAll;
	}

	public function addMessage($message, $uploadFile, $uploadFileType, $uploadFileSize ){

		if ( count($uploadFile) != 0) {
			$this->checkUploadFile( $uploadFileType, $uploadFileSize );
			$this->uploadFile($uploadFile);
		} 
		
		$this->modelChat->addMessage($message, $this->linkFile);
	}

	public function uploadFile($uploadFile){
		$uploaddir = ROOT.'/uploads/';
		$uploadfile = $uploaddir.basename($uploadFile['name']);
		if ( move_uploaded_file( $uploadFile['tmp_name'], $uploadfile) ) {
		    $this->linkFile = '/uploads/'.basename($uploadFile['name']);
		}
	}

	public checkUploadFile( $uploadFileType, $uploadFileSize ){

		foreach ($this->$fileType as $key => $value) {
			if ( $key == $uploadFileType ) {

			}
		}

		$this->fileCheck = true;
	}	
}

?>