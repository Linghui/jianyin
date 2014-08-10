<?php

class Shouji extends CI_Controller {

	public function index() {

		$api = $this -> input -> get('a');
		$para = $this -> input -> get('p');
		if (!$api || !$para) {
			echo "error";
			return;
		}
		$this -> shouji_model -> save($api, $para);

		echo "ok";
	}

	public function top50() {
		$res = $this -> shouji_model -> top50();
		if ($res) {
			// $index = 1;
			// $output = "";
			// foreach ($res as $row) {
			// $output .= "$index. " . $row -> click_times."次 耗时". $row ->spend_time . "秒<br/>";
			// $index++;
			// }
			// echo $output;
			$data['todo_list'] = $res;
			$this -> load -> view('bang_view', $data);
		} else {
			echo "error";
		}
	}

	public function watch() {
		$res = $this -> shouji_model -> top50();
		if ($res) {
			foreach ($res as $row) {
				echo $row->ip;
				echo "<br/>";
			}
		} else {
			echo "error";
		}
	}

}
