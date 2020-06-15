<?php
class Admin_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_roles()
    {
        $query = $this->db->get('Roles');
        return $query->result_array();
    }


    public function get_employee_count()
    {
        return $this->db->from("Employee")->count_all_results();
    }

    public function delete_employee($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('Employee');
    }

    public function get_particular_employee($id)
    {
        $query = $this->db->get_where('Employee', array('id' => $id));
        return $query->row_array();
    }

    function update_employee($id, $data)
    {
        return $this->db->update('Employee', $data, 'id=' . $id);
    }

    public function get_employees($limit, $start)
    {
        $this->db->select('Employee.id as eid,Employee.name as ename,Employee.email,Employee.cnic,Employee.designation,Employee.department,Employee.date_of_joining,Employee.salary,Employee.role_id,Roles.role_name');
        $this->db->from('Employee');
        $this->db->join('Roles', 'Employee.role_id = Roles.id', 'left');
        $this->db->limit($limit, $start);
        $this->db->where('Employee.email !=','admin@mds.com');
        $query = $this->db->get();
        return $query->result_array();
    }
}
