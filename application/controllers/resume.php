<?php

class Resume extends CI_Controller {

	public function add() {
		$name = $this -> getp("name");

		$sex = $this -> getp("sex");

		$birth = $this -> getp("birth");

		$card_id = $this -> getp("card_id");

		$phone = $this -> getp("phone");

		$email = $this -> getp("email");

		$age = $this -> getp("age");

		// $location = $this -> getp("location");
		//
		// $education = $this -> getp("education");
		//
		// $job_history = $this -> getp("job_history");
		//

		$resume_series_key = $this -> caiku_redis_model -> get_resume_series_key($name, $sex, $birth, $card_id, $phone, $email);

		if ($resume_series_key > 0) {
			$this -> load -> library('resume_model');

		} else {
			$resume_id = $this -> resume_model -> add($name, $sex, $birth, $card_id, $phone, $email);
			echo "resume_id $resume_id";
		}

	}

	private function getp($p_name) {

		$p = $this -> input -> get_post($p_name);
		if (!$p) {
			echo "$p_name not valid";
			exit ;
		}

		return $p;
	}

}
