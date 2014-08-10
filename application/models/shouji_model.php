<?php

class Shouji_model extends CI_Model {

	var $id = '';
	var $ip = '';
	var $api = '';
	var $para = '';
	var $update_time = '';

	public function save($api, $para) {

		$this -> ip = $this -> input -> ip_address();
		$this -> api = $api;
		$this -> para = $para;
		$this -> update_time = time();

		$this -> db -> insert('shouji', $this);
		return;
	}

	public function top50() {
		$sql = "select click_times, spend_time from bang order by click_times desc, spend_time desc limit 10";
		$query = $this -> db -> query($sql, array());
		if ($query -> num_rows() > 0) {
			return $query -> result();
		} else {
			return NULL;
		}
	}

}
