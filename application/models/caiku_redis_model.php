<?php

class Caiku_redis_model extends CI_Model {

	var $card_id_pre = "card_id_";
	var $phone_pre = "phone_";
	var $email_pre = "email_";

	public function get_resume_series_key($name, $sex, $birth, $card_id, $phone, $email) {

		$level_one_key = $this -> gen_key($name, $sex, $birth);

		if ($this -> redis -> exists($level_one_key) == 0) {
			return 0;
		}

		if ($this -> redis -> hexists($level_one_key, $card_id_pre . $card_id) != 0) {
			return $this -> redis -> hget($level_one_key, $card_id_pre . $card_id);
		}

		if ($this -> redis -> hexists($level_one_key, $phone_pre . $phone) != 0) {
			return $this -> redis -> hget($level_one_key, $phone_pre . $phone);
		}

		if ($this -> redis -> hexists($level_one_key, $email_pre . $email) != 0) {
			return $this -> redis -> hget($level_one_key, $email_pre . $email);
		}

		return -1;
	}

	private function gen_key($name, $sex, $birth) {

		return "resume_" . $name . ":" . $sex . ":" . $birth;
	}

}
