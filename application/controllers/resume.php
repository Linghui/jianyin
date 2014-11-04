<?php

class Resume extends CI_Controller {

	public function add() {
		$name = $this -> getp("name");

		$sex = $this -> getp("sex");

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
		$this -> caiku_redis_model -> save($name, $sex, $card_id, $phone, $email);

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
