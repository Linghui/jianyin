<?php

class Resume_model extends CI_Model {

	public function add($name, $sex, $birth, $card_id, $phone, $email) {
		$this -> load -> library('mongo_db');

		$resume = array('name' => $name, 'sex' => $sex, 'birth' => $birth, 'card_id' => $card_id, 'phone' => $phone, 'email' => $email);

		// check if there is a very same one.
		$data = $user = $this -> mongo_db -> get_where('resume', $resume);
		if ($data) {
			return 0;
		}

		$resume_id = uniqid("resume_id_");

		$resume['resume_id'] = $resume_id;

		$this -> mongo_db -> insert('resume', $resume);

		return $resume_id;
	}

}
