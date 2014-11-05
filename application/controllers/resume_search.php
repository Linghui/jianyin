<?php

class Resume_search extends CI_Controller {

	public function index() {
		$this -> load -> view('resume_search_view');
	}

	public function search() {
		$word = $this -> input -> get("w");

		if ($word) {
			$this -> load -> model('resume_model');
			$data = $this -> resume_model -> find($word);
			if ($data) {
				echo json_encode($data);
			} else {
				echo "no data";
			}

		} else {
			echo "no word";
		}
	}

}
