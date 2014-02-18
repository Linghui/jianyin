<?php

class Pinyin extends CI_Controller {

	var $words_transed = "";

	function __constructor() {
		parent::__constructor();
	}

	public function index() {

		$data['status'] = 0;

		// $this->load->model('pinyin_db_model', '', TRUE);
		$words = $this -> input -> get('words');

		if (!$words) {
			$data['status'] = 1;
			$data['error'] = "Input Null";
			echo json_encode($data);
			return;
		}

		// why again? becaues I don't know php very well.
		// stupid, but it works and is safty
		$words = trim($words);

		if (!$words) {
			$data['status'] = 1;
			$data['error'] = "Input Null";
			echo json_encode($data);
			return;
		}

		$check_length = mb_strlen($words);

		if ($check_length <= 1) {
			$data['status'] = 2;
			$data['error'] = "一个字儿就不必了吧...";
			echo json_encode($data);
			return;
		}

		if ($this -> isPinyin($words)) {
			$pinyin = $words;
			$allWrods = $this -> getWords($pinyin);
			if (count($allWrods) == 0) {
				$allWrods[] = "木有找到... 但是我们会尽快帮您找到";
				// record it.
				$this -> load -> model('new_pinyin_model');
				$this -> new_pinyin_model -> save($pinyin);
			}

			$data['words'] = $allWrods;
			$data['status'] = 0;

		} else {
			$data['pinyin'] = $this -> trans($words);
			// $allWrods[] = "http://www.jian-yin.com/?pinyin=".$pinyin;
			$data['url'] = "http://www.jian-yin.com?pinyin=" . $data['pinyin'];
		}

		echo json_encode($data);

		$this -> call_model ->save('index', $words);
	}

	private function getWords($pinyin) {

		$table_name = $this -> words_model -> getTabelName($pinyin);
		return $this -> pinyin_db_model -> getWords($pinyin, $table_name);
	}

	private function trans($words) {

		$length = mb_strlen($words);

		$table_name = $this -> words_model -> getTabelName($words);

		for ($index = 0; $index < $length; $index++) {
			$one = mb_substr($words, $index, 1);


			$word_pinyin = $this -> words_model -> getWordPinyin($one);
			if ( $word_pinyin ) {
				$this -> words_transed .= $word_pinyin;
			} else {
				$this -> words_transed .= $one;
			}

		}

		$result = $this -> pinyin_db_model -> save($words, $this -> words_transed, $table_name);
		return $this -> words_transed;

	}

	public function getShortUrl() {
		$url = $this -> input -> get('url');

		$data['status'] = 0;
		if ($url) {

			$url_req = 'https://api.weibo.com/2/short_url/shorten.json?';
			$url_req .= "access_token=2.00Ksxj4B0zUw4O2840ebcee2hefroC&url_long=";
			$url_req .= urlencode($url);
			$json_rep = json_decode(file_get_contents($url_req));

			if (array_key_exists("error_code", $json_rep)) {
				$data['status'] = 2;
			} else {
				$data['short_url'] = $json_rep -> urls[0] -> url_short;
			}

		} else {
			$data['status'] = 1;
		}

		echo json_encode($data);

	}

	public function addNew() {
		$words = $this -> input -> get('words');
		$pinyin = $this -> input -> get('pinyin');

		if (!$words) {
			$data['status'] = 1;
			$data['error'] = "短语不可以为空。";
			echo json_encode($data);
			return;
		}

		// why again? becaues I don't know php very well.
		// stupid, but it works and is safty
		$words = trim($words);

		if (!$words) {
			$data['status'] = 1;
			$data['error'] = "短语不可以为空。";
			echo json_encode($data);
			return;
		}

		if (!$pinyin) {
			$data['status'] = 2;
			$data['error'] = "简化语不可以为空。";
			echo json_encode($data);
			return;
		}

		// why again? becaues I don't know php very well.
		// stupid, but it works and is safty
		$pinyin = trim($pinyin);

		if (!$pinyin) {
			$data['status'] = 2;
			$data['error'] = "简化语不可以为空。";
			echo json_encode($data);
			return;
		}

		if (!$this -> isPinyin($pinyin)) {

			$data['status'] = 3;
			$data['error'] = "只支持符号简化翻译，不支持文字对文字的缩写";
			echo json_encode($data);
			return;
		}

		if ($this -> isPinyin($words)) {

			$data['status'] = 4;
			$data['error'] = "原文最好是汉字，否则就太迷惑了。。。。";
			echo json_encode($data);
			return;
		}

		$table_name = $this -> words_model -> getTabelName($pinyin);

		$row = $this -> pinyin_db_model -> get($words, $pinyin, $table_name);

		if ($row) {

			$data['status'] = 5;
			$data['error'] = "Sorry, Some good guy has already added this, but still thank you :)";
			echo json_encode($data);
			return;
		}

		$result = $this -> pinyin_db_model -> saveAll($words, $pinyin, $this -> input -> ip_address(), 2, $table_name);

		$data['status'] = 0;
		echo json_encode($data);
		
		$this -> call_model ->save('add_new', $words + "|" + $pinyin);
		return;
	}

	private function isLetter($one) {
		if (($one > 64 && $one < 91) || ($one > 96 && $one < 123) || ($one >= 48 && $one <= 57)) {
			return TRUE;
		} else {
			return FALSE;
		}

	}

	private function isPinyin($words) {

		$check_length = mb_strlen($words);
		// check for the first 5 letters at most
		// to see this is a request for trans words to pinyin, or pinyin to words
		if ($check_length >= 5) {
			$check_length = 5;
		}

		$is_pingyin = 0;

		for ($index = 0; $index < $check_length; $index++) {
			$one = mb_substr($words, $index, 1);
			$one = ord($one);

			if ($this -> isLetter($one)) {
				$is_pingyin++;
			} else {
				// $is_pingyin = FALSE;
			}
		}

		if ($is_pingyin >= 2 || ($check_length <= 3 && $is_pingyin >= 1)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}
