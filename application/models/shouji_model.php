<?php

class Shouji_model extends CI_Model {

	var $id = '';
	var $ip = '';
	var $api = '';
	var $para = '';
	var $update_time = '';
	

	public function save( $api, $para) {
			
		$this -> ip = $this -> input -> ip_address();
		$this -> api = $api;
		$this -> para= $para;
		
		$this -> db -> insert('shouji', $this);
		return;
	}

}
