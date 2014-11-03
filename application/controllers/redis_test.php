<?php

class Redis_test extends CI_Controller {

	public function index() {
		echo "redis ok";
	}

	public function set($name){
		$this->redis->set("test", $name);
	}
	
	public function get(){
		echo $this->redis->get("test");
	}
}
