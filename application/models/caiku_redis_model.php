<?php

class Caiku_redis_model extends CI_Model {

	public function save($name, $sex, $card_id, $phone, $email) {

		if (!$this -> redis -> hget("resume_id")) {
			$this -> redis -> hmset("resume_id", array());
		}

		if (!$this -> redis -> hget("resume_id", $name)) {
			$this -> redis -> hmset("resume_id", array($name => array()));
		}

		if (!$this -> redis -> hget("resume_id", $name, $sex)) {
			$this -> redis -> hmset("resume_id", array($name => array($sex => array())));
		}
		
		

		return;
	}

}
