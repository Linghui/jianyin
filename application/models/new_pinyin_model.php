<?php

class New_pinyin_model extends CI_Model {

	var $pinyin = '';
	var $ip = '';

	public function save($pinyin) {
		$this -> pinyin = $pinyin;
		$this -> ip = $this -> input -> ip_address();
		$this -> db -> insert('new_pinyin', $this);
		return;
	}

}
