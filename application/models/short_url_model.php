<?php

class Short_url_model extends CI_Model
{
    public $short_url_id;
    public $long_url;

    public function get_by_long_url($long_url)
    {
        $this->db->where('long_url', $long_url);
        $query = $this->db->get('short_url');
        if ($query->num_rows() > 0) {
            $query->row();
        } else {
            return;
        }
    }

    public function add_long_url($long_url)
    {
        $this->long_url = $long_url;

        $this->db->insert('short_url', $this);

        return $this->db->insert_id();
    }
}
