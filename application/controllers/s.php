<?php

class S extends CI_Controller {


	public function index($short_id = 0)
	{
        $this->load->model('short_url_model');
        $short_url = $this->short_url_model->get_by_short_url_id($short_id);
        if($short_url){
            echo "ok " . $short_url->long_url;
            header("Location: " + $short_url->long_url);
        } else {
            echo "Do not found this short url!";
        }
	}
}
