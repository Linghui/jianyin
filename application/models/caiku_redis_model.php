<?php

class Caiku_redis_model extends CI_Model {

	public function save($name, $sex, $card_id, $phone, $email) {

		if (!$this -> redis -> hget("resume_id")) {
			echo "new";
			$this -> redis -> hmset("resume_id", "test");
		}
		echo "over";

		// if (!$this -> redis -> hget("resume_id", $name)) {
		// $this -> redis -> hmset("resume_id", array($name => "test"));
		// }
		//
		// if (!$this -> redis -> hget("resume_id", $name, $sex)) {
		// $this -> redis -> hmset("resume_id", array($name => array($sex => "test")));
		// }

		return;
	}

}
