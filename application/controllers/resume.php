<?php

class Resume extends CI_Controller {

	public function add() {
		$name = $this -> getp("name");

		$sex = $this -> getp("sex");

		$age = $this -> getp("age");

		$phone = $this -> getp("phone");

		$card_id = $this -> getp("card_id");

		$email = $this -> getp("email");
		
		$location = $this -> getp("location");

		$education = $this -> getp("education");

		$job_history = $this -> getp("job_history");

	}

	private function getp($p_name) {

		$p = $this -> input -> get_post($p_name);
		if (!isset($p)) {
			echo "$p_name not valid";
			exit ;
		}

		return $p;
	}

}
