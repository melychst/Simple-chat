<?php

/**
* Chat
*/

require_once ROOT.'/models/modelChat.php';

class Chat {
	public $countMessages = 5;
	public $limitMessges = 5;
	public $modelChat; 
	public $fileSize = '300000';
	public $imag_w = '320';
	public $imag_h = '250';
	public $linkFile = '';
	public $fileType = '';
	public $fileTypes = array(
						'text/plain'	=> 'text', 
						'image/jpeg'	=> 'image',
						'image/gif'		=> 'image',
						'image/png'		=> 'image'
						);
	public $tags = "<a><code><i><strike><strong>";

	public $fileCheck = false;

	function __construct(){
		$this->modelChat = new ModelChat();
	}

	public function getAllMessages($count) {

		$messagesAll = $this->modelChat->getMessages($count);
		return $messagesAll;
	}

	public function addMessage( $message, $uploadFile ){

		if ( count($uploadFile) != 0 ) {
			$this->checkUploadFile( $uploadFile );

			if ( $this->fileCheck ) {
				$this->uploadFile( $uploadFile );
			}
			
		} 
		
		$this->modelChat->addMessage($message, $this->linkFile, $this->fileType );
	}

	public function uploadFile($uploadFile){
		$uploaddir = ROOT.'/uploads/';
		$uploadfile = $uploaddir.basename($uploadFile['name']);
		if ( move_uploaded_file( $uploadFile['tmp_name'], $uploadfile) ) {
		    $this->linkFile = '/uploads/'.basename($uploadFile['name']);
		}
	}

	public function checkUploadFile( $uploadFile ){

		foreach ($this->fileTypes as $key => $value) {

			if ( $key == $uploadFile['type'] ) {
				$this->fileType =  $value;
			}
		}

		switch ($this->fileType) {
			case 'text':
				if ($uploadFile['size'] > $this->fileSize) {
					return;
				}
				break;
			case 'image':
					//echo IMAGETYPE_GIF ." - ". IMAGETYPE_JPEG ." - ". IMAGETYPE_PNG;
				 	list($uploadImageW, $uploadImageH, $codeType) = getimagesize($uploadFile['tmp_name']); 
				    $codeTypes = array("", "gif", "jpeg", "png");

				    if ( ($uploadImageW > $this->imag_w ) || ($uploadImageH > $this->imag_h ) ) {
				    	$funcCrop = 'imagecreatefrom'.$codeTypes[$codeType];
				    	$imgOrg = $funcCrop($uploadFile['tmp_name']);
						$imgNew = imagecreatetruecolor($this->imag_w, $this->imag_h); 
						imagecopy($imgNew, $imgOrg, 0, 0, 0, 0, $this->imag_w, $this->imag_h); 
						$func = 'image'.$codeTypes[$codeType]; 
						$func($imgNew, $uploadFile['tmp_name']);			    	
				    }
				break;				
			default:
				return;
				break;
		}


		$this->fileCheck = true;
	}


	public function validateMessage($massage) {
		$massage = strip_tags($massage, $this->tags);

		return $massage;
	}	
}

?>