<?php

class Resume_model extends CI_Model {

	// for adding a person's very first resume, its resume_id and series_id is the same;
	public function add_very_new($name, $sex, $birth, $card_id, $phone, $email) {
		$resume_id = uniqid("resume_id_");
		$resume_series_id = $resume_id;

		$this -> add($resume_id, $resume_id, $name, $sex, $birth, $card_id, $phone, $email);

		return $resume_id;
	}

	// for add more resume for a person, random its resume_id
	public function add_by_series_no_check($resume_series_id, $name, $sex, $birth, $card_id, $phone, $email) {
		$resume_id = uniqid("resume_id_");

		$this -> add($resume_id, $resume_series_id, $name, $sex, $birth, $card_id, $phone, $email);

		return $resume_id;
	}

	// check before add.
	public function add_by_series_check($resume_series_id, $name, $sex, $birth, $card_id, $phone, $email) {

		$found = $this -> get($name, $sex, $birth, $card_id, $phone, $email);
		if ($found) {
			return 0;
		}

		$resume_id = uniqid("resume_id_");

		$this -> add($resume_id, $resume_series_id, $name, $sex, $birth, $card_id, $phone, $email);

		return $resume_id;
	}

	//
	private function add($resume_id, $resume_series_id, $name, $sex, $birth, $card_id, $phone, $email) {
		$this -> load -> library('mongo_db');

		$resume = array('name' => $name, 'sex' => $sex, 'birth' => $birth, 'card_id' => $card_id, 'phone' => $phone, 'email' => $email);

		$resume['resume_id'] = $resume_id;
		$resume['resume_series_id'] = $resume_series_id;

		$this -> mongo_db -> insert('resume', $resume);

		return $resume_id;
	}

	public function get($name, $sex, $birth, $card_id, $phone, $email) {

		$resume = array('name' => $name, 'sex' => $sex, 'birth' => $birth, 'card_id' => $card_id, 'phone' => $phone, 'email' => $email);

		// check if there is a very same one.
		$data = $user = $this -> mongo_db -> get_where('resume', $resume);
		if ($data) {
			return 1;
		}

		return 0;
	}

}
