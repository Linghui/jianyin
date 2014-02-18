<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');


class Api extends CI_Controller {

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
		$this->load->library('Mobile_Detect');
		
		$deviceType = ($this->mobile_detect->isMobile() ? ($this->mobile_detect->isTablet() ? 'tablet' : 'phone') : 'computer');
		$load_view_name = "api_view";
		if( $deviceType == 'phone' ){
			$load_view_name = "mobile_api_view";
		}
		$this -> output -> cache(60000);
		$this -> load -> view($load_view_name);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
