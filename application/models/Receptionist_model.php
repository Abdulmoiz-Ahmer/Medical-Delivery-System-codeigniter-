<?php
class Receptionist_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_patients($limit, $start = 1)
    {
        $this->db->select('Patients.id as pid,Patients.name as pname,Patients.assigned_mo,Patients.gender,Patients.birthday,Patients.cnic,Patients.email,Patients.address,Patients.email, Employee.name as ename');
        $this->db->from('Patients');
        $this->db->join('Employee', 'Patients.assigned_mo = Employee.id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    function delete_patient($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('Patients');
    }

    public function get_patients_count()
    {
        return $this->db->count_all('Patients');
    }


    public function get_patient($email)
    {
        $query = $this->db->get_where('Patients', array('email' => $email));
        return $query->row_array();
    }

    public function set_patient($patient)
    {
        return $this->db->insert('Patients', $patient);
    }
}
