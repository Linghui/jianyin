<?php

class Caiku_redis_model extends CI_Model {

	var $card_id_pre = "card_id_";
	var $phone_pre = "phone_";
	var $email_pre = "email_";

	public function add_resume_series_id($name, $sex, $birth, $card_id, $phone, $email, $resume_series_id) {
		$level_one_key = $this -> gen_key($name, $sex, $birth);

		$added = false;
		if ($card_id) {
			$this -> redis -> hset($level_one_key, array($this -> card_id_pre . $card_id => $resume_series_id));
			$added = true;
		}

		if ($phone) {
			$this -> redis -> hset($level_one_key, array($this -> phone_pre . $phone => $resume_series_id));
			$added = true;
		}

		if ($email) {
			$this -> redis -> hset($level_one_key, array($this -> email_pre . $email => $resume_series_id));
			$added = true;
		}
		
		return $added;
	}

	public function get_resume_series_id($name, $sex, $birth, $card_id, $phone, $email) {

		$level_one_key = $this -> gen_key($name, $sex, $birth);

		if ($this -> redis -> exists($level_one_key) == 0) {
			return 0;
		}

		if ($this -> redis -> hexists($level_one_key, $this -> card_id_pre . $card_id) != 0) {
			return $this -> redis -> hget($level_one_key, $this -> card_id_pre . $card_id);
		}

		if ($this -> redis -> hexists($level_one_key, $this -> phone_pre . $phone) != 0) {
			return $this -> redis -> hget($level_one_key, $this -> phone_pre . $phone);
		}

		if ($this -> redis -> hexists($level_one_key, $this -> email_pre . $email) != 0) {
			return $this -> redis -> hget($level_one_key, $this -> email_pre . $email);
		}

		return -1;
	}

	private function gen_key($name, $sex, $birth) {

		return "resume_" . $name . ":" . $sex . ":" . $birth;
	}

}
