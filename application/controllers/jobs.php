<?php

include_once ('simple_html_dom.php');

class Jobs extends CI_Controller {

	public function index() {

		$cookie_file = tempnam("tmp", "cookie.txt");

		$url = "http://ehire.51job.com/MainLogin.aspx";
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this -> get_request_headers());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		$response = curl_exec($ch);
		// $httpCode = curl_getinfo($ch, CURLINFO_HE);
		curl_close($ch);

		list($headers, $body) = explode("\r\n\r\n", $response, 2);

		$html = str_get_html($body);
		$ret = $html -> find('input[type=hidden]');

		$hidAccessKey = "";
		$fksc = "";
		$hidEhireGuid = "";

		foreach ($ret as $hidden) {
			if ($hidden -> id == "hidAccessKey") {
				$hidAccessKey = $hidden -> value;

			}
			if ($hidden -> id == "fksc") {
				$fksc = $hidden -> value;

			}
			if ($hidden -> id == "hidEhireGuid") {
				$hidEhireGuid = $hidden -> value;

			}
		}
		// echo "111 $hidAccessKey<br/>";
		// echo "222 $fksc<br/>";
		// echo "333 $hidEhireGuid<br/>";

		$url = "https://ehirelogin.51job.com/Member/UserLogin.aspx";
		$url = "http://www.jian-yin.com/test";
		$ch = curl_init($url);

		$POST_DATA = array("ctmName" => urlencode("中广互联"), "userName" => "zghl863", "password" => "cnjobs2014", "checkCode" => "", "oldAccessKey" => $hidAccessKey, "langtype" => "Lang=&Flag=1", "isRememberMe" => "false", "sc" => $fksc, "ec" => $hidEhireGuid);

		$postfields = http_build_query($POST_DATA);
		// curl_setopt($ch, CURLOPT_PORT, 1);
		// curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);

		curl_setopt($ch, CURLOPT_HTTPHEADER, $this -> get_request_headers());

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_HEADER, 1);
		$cookie_file = tempnam("tmp", "cookie.txt");
		// curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file);

		// $rrr = curl_setopt($ch, CURLOPT_CAINFO, "/usr/share/doc/libssl-doc/demos/cms/cacert.pem");
		// if (!$rrr) {
		// echo curl_error($ch);
		// } else {
		$response = curl_exec($ch);
		echo $response;
		// list($headers, $body) = explode("\r\n\r\n", $response, 2);
		// $location = get_header($headers, "Location");

		// echo "Location " . $location;
		// }

		curl_close($ch);

	}

	public function get_request_headers() {
		$out[] = "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8";
		// $out[] = "Accept-Encoding: gzip,deflate";
		$out[] = "Accept-Language: zh-CN,zh;q=0.8";
		$out[] = "Cache-Control: max-age=0";
		$out[] = "Connection: keep-alive";
		$out[] = "Content-Type: application/x-www-form-urlencoded";
		$out[] = "Host: ehirelogin.51job.com";
		// $out[] = "Origin: ehirelogin.51job.com";
		// $out[] = "Referer: http://ehire.51job.com/MainLogin.aspx";
		$out[] = "User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/38.0.2125.111 Safari/537.36";

		return $out;
	}

	public function get_header($headers, $key) {
		$ret_v;
		foreach (explode(
		"\r\n" , $headers) as $header) {
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

							if (strcasecmp($k, $key) == 0) {
								$ret_v = $v;
								break;
							}
						}
					}

				}
			}
		}
		return $ret_v;
	}

}
