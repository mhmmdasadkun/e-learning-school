<?php

class Admin extends CI_Model
{
    public function checking($data)
    {
        return $this->db->get_where('admins', $data);
    }
}
