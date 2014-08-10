<?php

class Bang_model extends CI_Model {

	var $id = '';
	var $ip = '';
	var $click_times = '';
	var $spend_time = '';
	

	public function save( $click_times, $spend_time) {
			
		$this -> ip = $this -> input -> ip_address();
		$this -> click_times = $click_times;
		$this -> spend_time= $spend_time;
		
		$this -> db -> insert('bang', $this);
		return;
	}

}
