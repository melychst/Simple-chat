<?php

/**
* Chat
*/

require_once ROOT.'/models/modelChat.php';

class Chat {

	public $modelChat; 
	public $fileSize = '300';
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
	public $tags = "<a><code><i><u>";

	public $fileCheck = false;

	function __construct(){
		$this->modelChat = new ModelChat();
	}

	public function getAllMessages() {

		$messagesAll = $this->modelChat->getMessages();
		return $messagesAll;
	}

	public function addMessage( $message, $uploadFile ){
/*
		echo "<pre>";
		print_r(getimagesize($uploadFile['tmp_name']));
		echo "</pre>";
*/
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
				 	list($uploadImageW, $uploadImageH, $codeType) = getimagesize($uploadFile['tmp_name']); // Получаем размеры и тип изображения (число)
				    $codeTypes = array("", "gif", "jpeg", "png"); // Массив с типами изображений

				    if ( ($uploadImageW > $this->imag_w ) || ($uploadImageH > $this->imag_h ) ) {
				    	$funcCrop = 'imagecreatefrom'.$codeTypes[$codeType];
				    	$imgOrg = $funcCrop($uploadFile['tmp_name']);
						$imgNew = imagecreatetruecolor($this->imag_w, $this->imag_h); // Создаём дескриптор для выходного изображения
						imagecopy($imgNew, $imgOrg, 0, 0, 0, 0, $this->imag_w, $this->imag_h); // Переносим часть изображения из исходного в выходное
						$func = 'image'.$codeTypes[$codeType]; // Получаем функция для сохранения результата	
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