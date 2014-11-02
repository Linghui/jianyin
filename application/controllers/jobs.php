<?php

class Jobs extends CI_Controller {

	public function index() {

		// $cookie_file = dirname(__FILE__).'/cookie.txt';
		$cookie_file = tempnam("tmp", "cookie.txt");

		$url = "http://ehire.51job.com/MainLogin.aspx";
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$response = curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HE);
		curl_close($ch);

		list($header, $body) = explode("\r\n\r\n", $response);
		foreach (explode("\r\n", $header) as $header) {
			$header_chunks = explode(":", $header,2);
			
			$header_key = $header_chunks[0];
			$header_value = $header_chunks[1];
			
			if(strcasecmp($header_key, "Cookie")){
				$pairs = explode(";", $header_value);
				foreach($pairs as $one){
					list($k, $v) = explode("=", $one);
					if(strcasecmp($k, "AccessKey")){
						echo $one;
						echo " ";
						$access_key = $v;
					}
				}
			}
		}
		echo $v;
	}

}
