<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Test_for_temp extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index() {
		
		$rand_messages = array('rand message' , 'ok', 'not ok', 'cool');
		
		$index = rand(0, count($rand_messages) - 1);
		

		$protocol = array('p' => '1', 'c' => '0', 't' => $rand_messages[$index]);
		$message = array();
		array_push($message, $protocol);

		echo json_encode($message);

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
