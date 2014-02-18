<?php

class Call_model extends CI_Model {

	var $id = '';
	var $ip = '';
	var $api = '';
	var $para = '';
	

	public function save( $api, $para) {
			
		$this -> ip = $this -> input -> ip_address();
		$this -> api = $api;
		$this -> para = $para;
		
		$this -> db -> insert('call', $this);
		return;
	}

}
