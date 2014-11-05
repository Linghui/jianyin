<?php

class Resume extends CI_Controller {

	public function add() {

		$resume = array();

		$name = $this -> getp("name");
		$resume['name'] = $name;

		$sex = $this -> getp("sex");
		$resume['sex'] = $sex;

		$birth = $this -> getp("birth");
		$resume['birth'] = $birth;

		$card_id = $this -> getp("card_id");
		$resume['card_id'] = $card_id;

		$phone = $this -> getp("phone");
		$resume['phone'] = $phone;

		$email = $this -> getp("email");
		$resume['email'] = $email;

		$location = $this -> getp("location");
		$resume['location'] = $location;

		$education = $this -> getp("education");
		$resume['education'] = $education;

		// $job_history = $this -> getp("job_history");

		// get resume series unique id
		$resume_series_id = $this -> caiku_redis_model -> get_resume_series_id($name, $sex, $birth, $card_id, $phone, $email);

		$this -> load -> model('resume_model');

		// found means there is resume(s) added to database before
		if ($resume_series_id) {
			$resume_id = $this -> resume_model -> add_by_series_check($resume_series_id, $resume);
			if ($resume_id === 0) {
				echo "duplicated";
			} else {
				// TODO: merge the root;
				echo "1 resume_id $resume_id";
			}

		}
		//
		else {

			// the first one is root one, and always will be the latest merged one.
			$resume_series_id = $this -> resume_model -> add_very_new($resume);
			echo "1 resume_series_id : $resume_series_id ";

			if ($resume_series_id) {

				// save again for back up
				$resume_id = $this -> resume_model -> add_by_series_no_check($resume_series_id, $resume);
				echo "2 resume_id : $resume_id";

				$this -> caiku_redis_model -> add_resume_series_id($name, $sex, $birth, $card_id, $phone, $email, $resume_series_id);
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
