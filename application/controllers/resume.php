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

		// get resume series unique id
		$resume_series_id = $this -> caiku_redis_model -> get_resume_series_id($name, $sex, $birth, $card_id, $phone, $email);

		$this -> load -> model('resume_model');

		// found means there is resume(s) added to database before
		if ($resume_series_id > 0) {
			$resume_id = $this -> resume_model -> add_by_series($resume_series_id, $name, $sex, $birth, $card_id, $phone, $email);
			echo "1 resume_id : $resume_id";
		}
		//
		else {

			// the first one is root one, and always will be the latest merged one.
			$resume_series_id = $this -> resume_model -> add_very_new($name, $sex, $birth, $card_id, $phone, $email);
			echo "resume_series_id : $resume_series_id ";

			if ($resume_series_id != 0) {

				// save again for back up
				$resume_id = $this -> resume_model -> add_by_series($resume_series_id, $name, $sex, $birth, $card_id, $phone, $email);
				echo "2 resume_id : $resume_id";

				$this -> caiku_redis_model -> add_resume_series_id($name, $sex, $birth, $card_id, $phone, $email, $resume_id);
			}
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
