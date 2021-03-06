<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Test_for_temp extends CI_Controller {

	public function search_r() {
		$path = "js/resume";
		$current_dir = opendir($path);
		while (($file = readdir($current_dir)) !== false) {
			$sub_dir = $path . DIRECTORY_SEPARATOR . $file;
			if ($file == '.' || $file == '..') {
				continue;
			}
			echo "$sub_dir <br/>";
			$res = $this -> insert($sub_dir);
			echo $res;
			echo "<br/>";
		}

	}

	public function insert($file_full_name) {
		$this -> load -> library("Nusoap_lib");

		$client = new nusoap_client('http://service.ygys.net/resumeservice.asmx?wsdl', 'wsdl', '', '', '', '');
		$client -> soap_defencoding = 'utf-8';
		$client -> decode_utf8 = FALSE;
		$client -> xml_encoding = 'utf-8';

		// $file_full_name = "js/财务经理-liweimin.docx44511.htm";o 'analyze filename:'.$file_full_name;
		$handle = fopen($file_full_name, "r");
		$content = fread($handle, filesize($file_full_name));
		fclose($handle);
		//$content = file_get_contents($form->file->getTempName());
		//echo $content; exit;
		$pieces = explode(".", $file_full_name);

		$ext = $pieces[1];
		$username = 'u100046';
		$pwd = "MlsrtP/BEy0=";

		switch ($ext) {
			case 'txt' :
			case 'html' :
			case 'htm' :
			case 'Html' :
				$params = array('username' => $username, 'pwd' => $pwd, 'original' => $content);
				$result = $client -> call('TransResume', array('parameters' => $params));
				break;

			default :
				$params = array('username' => $username, 'pwd' => $pwd, 'content' => base64_encode($content), 'ext' => $ext);
				$result = $client -> call('TransResumeForFileBase64', array('parameters' => $params));
				break;
		}

		if ($client -> fault) {
			$this -> errors = "发生了严重错误,请稍后再试";
			return FALSE;
		} else {
			// Check for errors
			$error = $client -> getError();
			if ($error) {
				$this -> errors = '解析发生错误，请重试或换一份简历';
				return FALSE;
			}
		}

		// echo $result['TransResumeResult']['Name'];
		// echo '<meta http-equiv="Content-Type" content="text/html" charset="utf-8">';
		// echo "<p>";
		// echo json_encode($result);
		// echo "</p>";

		$this -> load -> model('resume_model');

		echo gettype($result);
		echo "<br/>";
		$res = -1;
		if (gettype($result) == "string") {
			echo $result;
			echo "<br/>";
		} else if (gettype($result) == "array" && array_key_exists('TransResumeResult', $result)) {
			$res = $this -> resume_model -> addResume($result['TransResumeResult']);
		}

		return $res;

		// echo json_encode($result);
		// echo $result;
		// var_dump();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
