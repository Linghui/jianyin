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
            foreach ($query->result() as $row) {
                return $row;
            }
        } else {
            return false;
        }
    }

    public function get_by_short_url_id($short_url_id)
    {
        $this->db->where('short_url_id', $short_url_id);
        $query = $this->db->get('short_url');
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                return $row;
            }
        } else {
            return false;
        }
    }

    public function add_long_url($long_url)
    {
        $this->long_url = $long_url;

        $this->db->insert('short_url', $this);

        return $this->db->insert_id();
    }
}
