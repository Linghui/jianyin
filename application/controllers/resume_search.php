<?php

class Resume_search extends CI_Controller {

	public function index() {
		$this -> load -> view('resume_search_view');
	}

	public function search() {
		$word = $this -> input -> get("w");

		if ($word) {
			$response = array();
			$this -> load -> model('resume_model');
			$data = $this -> resume_model -> find($word);

			if ($data) {
				$response['status'] = 1;
				$response['data'] = $data;
			} else {
				$response['status'] = 0;
			}

		} else {
			$response['status'] = -1;
		}

		echo json_encode($response);
	}

}
