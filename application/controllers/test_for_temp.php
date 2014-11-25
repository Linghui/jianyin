<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Test_for_temp extends CI_Controller {

	public function index() {
		$this -> load -> library("Nusoap_lib");

		$client = new nusoap_client('http://service.ygys.net/resumeservice.asmx?wsdl', 'wsdl', '', '', '', '');
		$client -> soap_defencoding = 'utf-8';
		$client -> decode_utf8 = FALSE;
		$client -> xml_encoding = 'utf-8';

		$file_full_name = "js/[HuiZhang]简历_智联招聘.html";
		//echo 'analyze filename:'.$file_full_name;
		$handle = fopen($file_full_name, "r");
		$content = fread($handle, filesize($file_full_name));
		fclose($handle);
		//$content = file_get_contents($form->file->getTempName());
		//echo $content; exit;
		$ext = '.html';
		$username = 'u100046';
		$pwd = "MlsrtP/BEy0=";

		switch ($ext) {
			case '.txt' :
			case '.html' :
			case '.htm' :
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
		echo json_encode($result);

		$this -> load -> model('resume_model');

		$res = $this -> resume_model -> addResume($result['TransResumeResult']);

		echo $res;

		// echo json_encode($result);
		// echo $result;
		// var_dump();
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
