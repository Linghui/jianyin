<?php

class Resume_search extends CI_Controller {

	public function index() {
		$this -> load -> view('resume_search_view');
	}

	public function search() {
		$word = $this -> input -> get("w");

		if ($word) {
			$data = $this -> mongo_db -> find($word);
			echo json_encode($data);
		} else {
			echo "no data";
		}
	}

}
