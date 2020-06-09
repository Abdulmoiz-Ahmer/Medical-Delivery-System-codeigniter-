<?php
class Auth_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function set_user($employee)
    {
        return $this->db->insert('Employee', $employee);
    }

    public function get_user($email)
    {
        $query = $this->db->get_where('Employee', array('email' => $email));
        return $query->row_array();
    }

    public function get_roles()
    {
        $query = $this->db->get('Roles');
        return $query->result_array();
    }
}
