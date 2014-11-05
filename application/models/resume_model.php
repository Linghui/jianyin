<?php

class Resume_model extends CI_Model {

	// for adding a person's very first resume, its resume_id and series_id is the same;
	public function add_very_new($resume) {
		$resume_id = uniqid("resume_id_");
		$resume_series_id = $resume_id;

		$resume['is_root'] = 1;

		$this -> add($resume_id, $resume_id, $resume);

		return $resume_id;
	}

	// for add more resume for a person, random its resume_id
	public function add_by_series_no_check($resume_series_id, $resume) {
		$resume_id = uniqid("resume_id_");

		$this -> add($resume_id, $resume_series_id, $resume);

		return $resume_id;
	}

	// check before add.
	public function add_by_series_check($resume_series_id, $resume) {

		$found = $this -> get($resume);
		if ($found) {
			return 0;
		}

		$resume_id = uniqid("resume_id_");

		$this -> add($resume_id, $resume_series_id, $resume);

		return $resume_id;
	}

	//
	private function add($resume_id, $resume_series_id, $resume) {

		$resume['resume_id'] = $resume_id;
		$resume['resume_series_id'] = $resume_series_id;

		$this -> mongo_db -> insert('resume', $resume);

		return $resume_id;
	}

	public function get($resume) {

		// check if there is a very same one.
		$data = $user = $this -> mongo_db -> get_where('resume', $resume);
		if ($data) {
			return 1;
		}

		return 0;
	}

	public function find($word) {
		$word = $this -> trans($word);
		$where = array('is_root' => 1, 'sex' => $word);
		$data = $user = $this -> mongo_db -> get_where('resume', $where);
		return $data;
	}

	public function trans($word) {
		return $word;
	}

}
