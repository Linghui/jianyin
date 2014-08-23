<?php

class Upload extends CI_Controller {

	var $message = "";

	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url'));

		$role_id = $this -> user -> getRoleId();
		if ($role_id != $this -> role_model -> EDITOR_ROLD_ID) {
			echo "die";
			exit ;
		}

	}

	function index() {
		$this -> load -> view('include/header');

		$this -> load -> view('upload_form', array('error' => $this -> user -> getUserName()));

	}

	function do_upload() {
		$this -> message = "";
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'zip';
		$config['max_size'] = '10000';
		$config['remove_spaces'] = TRUE;

		$this -> load -> library('upload', $config);

		if (!$this -> upload -> do_upload()) {
			$error = array('error' => $this -> upload -> display_errors());

			$this -> load -> view('upload_form', $error);
		} else {

			$file_data = $this -> upload -> data();
			$file_name = $file_data['file_name'];
			$file_path = $file_data['file_path'];
			$orig_name = $file_data['orig_name'];

			$this -> deal_with_zip($file_name, $file_path, $orig_name);
			$data = array('message' => $this -> message);

			// $this -> load -> view('upload_result', $data);
			
		}

	}

	private function deal_with_zip($file_name, $file_path, $orig_name) {
		echo "success";
		// $full_path = $file_path . $file_name;
		// $command = "unzip -o $full_path -d temp/" . $this -> user -> getUserName();
		// log_message('debug', $command);
		// system($command);
// 
		// $pro_dir = $this -> getAttachDirName($orig_name);
		// log_message('debug', ' $pro_dir ' . $pro_dir);
		// $this -> deal_with_dir('temp/' . $this -> user -> getUserName() . '/' . $pro_dir);
	}

	private function getAttachDirName($orig_name) {
		return substr($orig_name, 0, stripos($orig_name, '.'));
	}

	private function deal_with_dir($dir) {
		$mydir = dir($dir);
		while ($cvsfile = $mydir -> read()) {
			if (preg_match("/\.csv/", $cvsfile)) {
				log_message('debug', "file:$dir/$cvsfile");

				$fandian_name;
				$owner;
				$cellphone;
				$adress;

				$foods = array();
				$fh = fopen($dir . "/" . $cvsfile, "r");
				while (!feof($fh)) {
					$line = fgets($fh);

					if (preg_match("/^ *$/", $line)) {
						continue;
					}

					$line = str_replace("\n", "", $line);

					if (preg_match("/^fandian/", $line)) {
						// echo "fandian " . $line;
						$list = explode(",", $line);
						$fandian_name = $list[1];
						continue;
					}

					if (preg_match("/^owner/", $line)) {
						// echo "owner " . $line;
						$list = explode(",", $line);
						$owner = $list[1];
						continue;
					}

					if (preg_match("/^cellphone/", $line)) {
						// echo "cellphone " . $line;
						$list = explode(",", $line);
						$cellphone = $list[1];
						continue;
					}

					if (preg_match("/^address/", $line)) {
						// echo "address " . $line;
						$list = explode(",", $line);
						$adress = $list[1];
						continue;
					}

					if (preg_match("/^food,price$/", $line)) {
						continue;
					}

					$list = explode(",", $line);
					$foods["$list[0]"] = $list[1];

				}
				fclose($fh);

				if (!$fandian_name || !$owner || !$cellphone || !$adress || sizeof($foods) <= 0) {
					// echo "$cvsfile data not enough";
					$this -> message .= "$cvsfile 信息不足";
					continue;
				}

				$fiandian_id = $this -> fandian_model -> addNew($fandian_name, $owner, $cellphone, $adress);
				log_message('debug', '$fiandian_id ' . $fiandian_id);
				if ($fiandian_id > 0) {
					foreach ($foods as $key => $value) {
						$this -> food_model -> addNewFood($fiandian_id, $key, $value);
					}

					$this -> card_order_model -> order($fiandian_id, 200, $this -> user -> getUserId());

				} else {
					// echo "$cvsfile cellphone number has been added";
					$this -> message .= "$cvsfile 电话号已被使用";
					continue;
				}

			}
		}
	}

}
?>