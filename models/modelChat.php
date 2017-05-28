<?php

/**
* ModelChat
*/
class ModelChat {
	public $messages = array();

	public function getMessages() {

		$sql = "SELECT id_user, message, date_add, name  FROM messages, users WHERE messages.id_user = users.id ORDER BY date_add DESC";

		$res = mysql_query($sql);

		while( $row = mysql_fetch_assoc($res) ) {
			array_push($this->messages, $row);
		}

		return $this->messages;	
	}

	public function addMessage($message) {
		$date_add = date("Y-m-d H:i:s");
		$user_id = $_SESSION['user_id'];
		$sql = "INSERT INTO messages (id_user, message, date_add) VALUE ('$user_id', '$message', '$date_add')";

		mysql_query($sql);
	}
}

?>