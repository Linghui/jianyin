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
		echo json_encode($this -> get_request_headers());
		// echo "found : " . $access_key;

		// $url = "https://ehirelogin.51job.com/Member/UserLogin.aspx";
		// $ch = curl_init($url);
		//
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// curl_setopt($ch, CURLOPT_VERBOSE, 1);
		// curl_setopt($ch, CURLOPT_HEADER, 1);
		// curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);
		//
		// $POST_DATA = array(ctmName => urlencode("中广互联"), userName => "zghl863", password => "cnjobs2014", checkCode => "", oldAccessKey => $access_key, langtype => "Lang=&Flag=1", isRememberMe => "false", sc => "07e6a30d0c0dd9c6", ec => "687dc60d8ca8492f880d64999dc9218c");
		//
		// $postfields = http_build_query($POST_DATA);
		// curl_setopt($ch, CURLOPT_PORT, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
		//
		// $response = curl_exec($ch);
		//
		// curl_close($ch);
		//
		// echo $response;
	}

	public function get_request_headers() {
		foreach ($_SERVER as $key => $value) {
			if (substr($key, 0, 5) == "HTTP_") {
				$key = str_replace(" ", "-", ucwords(strtolower(str_replace("_", " ", substr($key, 5)))));
				if (strcasecmp($key, "Accept-Encoding") == 0) {
					continue;
				}
				if (strcasecmp($key, "Age") == 0) {
					continue;
				}
				if (strcasecmp($key, "Cache-Control") == 0) {
					continue;
				}
				if (strcasecmp($key, "Connection") == 0) {
					continue;
				}
				if (strcasecmp($key, "Content-Length") == 0) {
					continue;
				}
				if (strcasecmp($key, "ETag") == 0) {
					continue;
				}
				if (strcasecmp($key, "Expires") == 0) {
					continue;
				}
				if (strcasecmp($key, "Host") == 0) {
					continue;
				}
				if (strcasecmp($key, "Keep-Alive") == 0) {
					continue;
				}
				if (strcasecmp($key, "Last-Modified") == 0) {
					continue;
				}
				if (strcasecmp($key, "Pragma") == 0) {
					continue;
				}
				if (strcasecmp($key, "Transfer-Encoding") == 0) {
					continue;
				}
				if (strcasecmp($key, "X-Cache") == 0) {
					continue;
				}
				if (strcasecmp($key, "Vary") == 0) {
					continue;
				}
				if (strcasecmp($key, "Via") == 0) {
					continue;
				}
				$out[] = "$key: $value";
			}
		}

		$out[] = "Accept-Encoding";

		return $out;
	}

}
