<?php

class Resume_model extends CI_Model {

	public function add($name, $sex, $birth, $card_id, $phone, $email) {

		$resume_id = uniqid("resume_id_");
		$resume = array('resume_id' => $resume_id, 'name' => $name, 'sex' => $sex, 'birth' => $birth, 'card_id' => $card_id, 'phone' => $phone, 'email' => $email);
		$this -> mongo_db -> insert('resume', $resume);
	}

}
