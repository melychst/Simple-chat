<?php

/**
* ModelChat
*/

class ModelChat {
	public $messages = array();

	public function getMessages($count) {

		$sql = "SELECT id_user, message, date_add, attached, type_attached, name  FROM messages, users WHERE messages.id_user = users.id ORDER BY date_add DESC LIMIT $count";

		$res = mysql_query($sql);
		if ( $res ) {
			while( $row = mysql_fetch_assoc($res) ) {
				array_push($this->messages, $row);
			}
		}

		return $this->messages;	
	}

	public function addMessage($message, $linkFile, $typeFile) {
		$date_add = date("Y-m-d H:i:s");
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO messages (id_user, message, date_add, attached, type_attached) VALUE ('$user_id', '$message', '$date_add', '$linkFile', '$typeFile')";
		mysql_query($sql);
	}
}

?>