<?php

class Call extends MY_Controller {


	public function index()
	{
		$key = $this -> input -> get('k');
		$p = $this -> input -> get('p');
		if(!$key){
			echo "error";
		}
		// $this -> call_model ->save($key, $p);
		
		echo "ok";
	}
}
