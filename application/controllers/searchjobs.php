<?php

class Searchjobs extends CI_Controller {

	public function index() {
		$cookie_file = tempnam("tmp", "cookie.txt");

		$url = "http://ehire.51job.com/Candidate/SearchResume.aspx";
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$response = curl_exec($ch);

		$info = curl_getinfo($ch);

		curl_close($ch);

		if (empty($info['http_code'])) {
			echo "empty?";
		} else {
			if ($info['http_code'] == 302) {
				echo "登陆未成功";
			} else {
				echo $response;
			}

		}

	}

}
