<?php

class Resume extends CI_Controller {

	public function add() {
		$name = $this -> getp("name");
		echo $name;

		$sex = $this -> getp("sex");
		echo $sex;
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
