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
	
	public function top50(){
		$res = $this -> shouji_model ->top50();
		if($res){
			$index = 1;
			$output = "";
			foreach ($res as $row) {
				$output .= "$index. " . $row -> click_times."次 耗时". $row ->spend_time . "秒";
				$index++;
			}
			echo $output;
		} else {
			echo "error";
		}
		
	}
}
