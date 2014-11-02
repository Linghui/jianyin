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
		// $httpCode = curl_getinfo($ch, CURLINFO_HE);
		curl_close($ch);

		list($header, $body) = explode("\r\n\r\n", $response);

		$access_key = 'not found';

		foreach (explode("\r\n", $header) as $header) {

			$header_chunks = explode(":", $header, 2);

			if (count($header_chunks) == 2) {

				$header_key = $header_chunks[0];
				$header_value = $header_chunks[1];

				if (strcasecmp($header_key, "Set-Cookie") == 0) {
					$pairs = explode(";", $header_value);
					foreach ($pairs as $one) {
						$pieces = explode("=", $one);
						if (count($pieces) == 2) {
							$k = trim($pieces[0]);

							$v = $pieces[1];

							if (strcasecmp($k, "AccessKey") == 0) {
								$access_key = $v;
								break;
							}
						}

					}
				}
			}
		}
		// echo "found : " . $access_key;

		$url = "https://ehirelogin.51job.com/Member/UserLogin.aspx";
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$POST_DATA = array(ctmName => urlencode("中广互联"), userName => "zghl863", password => "cnjobs2014", checkCode => "", oldAccessKey => $access_key, langtype => "Lang=&Flag=1", isRememberMe => "false", sc => "07e6a30d0c0dd9c6", ec => "687dc60d8ca8492f880d64999dc9218c");

		$postfields = http_build_query($POST_DATA);
		curl_setopt($ch, CURLOPT_PORT, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		$response = curl_exec($ch);
		
		curl_close($ch);
		
		echo $response;
	}

}
