<?php

class Resume extends CI_Controller {


	public function add()
	{
		$name = $this->input->get_post("name");
		echo $name;
	}
}
