<?php

class Shouji extends CI_Controller {


	public function index()
	{
		
		$api = $this -> input -> get('a');
		$para = $this -> input -> get('p');
		if(!$api || !$para){
			echo "error";
			return;
		}
		$this -> shouji_model ->save($api, $para);
		
		echo "ok";
	}
}
