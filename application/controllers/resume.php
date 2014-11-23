<?php

class Resume extends CI_Controller {

	public function add() {

		$resume = array();

		$resume_str = $this -> getp("resume");

		try {
			$resume = json_decode($resume_str);
		} catch(Exception $e) {
			echo "json invalid";
		}

		$this -> load -> model('resume_model');

		$res = $this -> resume_model -> addResume($resume);
		echo $res;
	}

}
