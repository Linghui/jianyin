<?php

class Tags extends CI_Controller {


	public function index()
	{
		$tags = array("分类1", "分类2");
		echo json_encode($tags);
	}
}
