<?php

class Pinyin_db_model extends CI_Model {

	var $words = '';
	var $pinyin = '';
	var $priority = '';
	var $ip = '';
	var $is_new = 0;

	function __construct() {
		parent::__construct();
	}


	public function save($words, $pinyin, $table_name) {
		$this -> saveAll($words, $pinyin, $this -> input -> ip_address(), 1, $table_name);
	}

	public function saveAll($words, $pinyin, $ip, $is_new, $table_name) {
		$this -> words = $words;
		$this -> pinyin = strtoupper($pinyin);
		$this -> priority = 1;
		$this -> ip = $ip;
		$this -> is_new = $is_new;

		$query = $this -> db -> get_where("$table_name", array('words' => $words));

		$result = 0;
		if ($query -> num_rows() > 0) {
			$result = 1;
			foreach ($query->result() as $row) {
				$result = 2;
				$row -> priority = $row -> priority + 1;
				$this -> db -> update($table_name, $row, array('words' => $words));
				break;
			}

		} else {
			$this -> db -> insert($table_name, $this);
		}

		return $result;
	}

	public function getWords($pinyin, $table_name) {

		$data = array();

		$pinyin = strtoupper($pinyin);

		$this -> db -> where("pinyin", $pinyin);
		$this -> db -> order_by("priority", "desc");
		$query = $this -> db -> get($table_name);
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row -> words;
			}
		} else {

		}

		return $data;
	}
	
	// return the only one if there is
	public function get( $words, $pinyin, $table_name){
		$this -> db -> where("words", $words);
		$this -> db -> where("pinyin", $pinyin);
		$query = $this -> db -> get($table_name);
		if ($query -> num_rows() > 0) {
			foreach ($query->result() as $row) {
				return $row;
			}
		} else {
			return NULL;
		}
		
	}

}
