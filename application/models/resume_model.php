<?php

class Resume_model extends CI_Model {

	public function addResume($resume) {

		if (!isset($resume['Name'])) {
			return 1;
		}

		if (!isset($resume['Sex'])) {
			return 2;
		}
		if (!isset($resume['Brith'])) {
			return 3;
		}
		if (!isset($resume['IDNO']) && !isset($resume['Email']) && !isset($resume['Mobile'])) {
			return 4;
		}

		$name = $resume['Name'];
		$sex = $resume['Sex'];
		$birth = $resume['Brith'];
		$card_id = $resume['IDNO'];
		$phone = $resume['Mobile'];
		$email = $resume['Email'];

		// $job_history = $this -> getp("job_history");

		// get resume series unique id
		$resume_series_id = $this -> caiku_redis_model -> get_resume_series_id($name, $sex, $birth, $card_id, $phone, $email);

		// found means there is resume(s) added to database before
		if ($resume_series_id) {
			$resume_id = $this -> add_by_series_check($resume_series_id, $resume);
			if ($resume_id === 0) {
				// echo "duplicated";
				return 5;
			} else {
				// TODO: merge the root;
				// echo "1 resume_id $resume_id";
			}

		}
		//
		else {

			// the first one is root one, and always will be the latest merged one.
			$resume_series_id = $this -> add_very_new($resume);
			// echo "1 resume_series_id : $resume_series_id ";

			if ($resume_series_id) {

				// save again for back up
				$resume_id = $this -> add_by_series_no_check($resume_series_id, $resume);
				// echo "2 resume_id : $resume_id";

				$this -> caiku_redis_model -> add_resume_series_id($name, $sex, $birth, $card_id, $phone, $email, $resume_series_id);
			}
		}

		return 0;

	}

	private function getp($p_name) {

		$p = $this -> input -> get_post($p_name);
		if (!$p) {
			echo "$p_name not valid";
			exit ;
		}

		return $p;
	}

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
		$where = array('is_root' => 1);
		$this -> mongo_db -> like('Original', $word);
		$this -> mongo_db -> where($where);
		$data = $this -> mongo_db -> get('resume');

		if ($data) {
			foreach ($data as $one) {
				$one['Original'] = null;
			}
		}

		return $data;
	}

	public function trans($word) {
		return $word;
	}

}
