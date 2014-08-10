<?php

class Call extends CI_Controller {


	public function index()
	{
		
		$click_times = $this -> input -> get('c');
		$spend_time = $this -> input -> get('s');
		if(!$click_times || !$spend_time){
			echo "error";
			return;
		}
		$this -> bang_model ->save($click_times, $spend_time);
		
		echo "ok";
	}
}
