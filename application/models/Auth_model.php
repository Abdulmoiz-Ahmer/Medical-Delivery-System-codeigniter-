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

    public function get_user_using_cnic_or_email($cnic, $email)
    {
        $this->db->select('*');
        $this->db->from('Employee');
        $this->db->where('cnic', $cnic);
        $this->db->or_where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_roles()
    {
        $query = $this->db->get('Roles');
        return $query->result_array();
    }
}
