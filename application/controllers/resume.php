<?php

class Resume extends CI_Controller {


	public function add()
	{
		$this->input->get_post("name");
		echo $name;
	}
}
