<?php

class Jobs extends CI_Controller {

	public function index() {
		
		$cookie_file = dirname(__FILE__).'/cookie.txt'; 
		
		$url = "http://ehire.51job.com/MainLogin.aspx";
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$response = curl_exec($ch);
		curl_close($ch);

		echo $response;
	}

}
