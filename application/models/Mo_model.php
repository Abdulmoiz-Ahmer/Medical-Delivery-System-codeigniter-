<?php
class Mo_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_mypatients_count($mo_id)
    {
        return $this->db->where('assigned_mo', $mo_id)->from("Patients")->count_all_results();
    }

    public function get_mypatients($mo_id, $limit, $start = 1)
    {
        $this->db->select('Patients.id as pid, Patients.status, Patients.name as pname,Patients.assigned_mo,Patients.gender,Patients.birthday,Patients.cnic,Patients.email,Patients.address,Patients.email');
        $this->db->from('Patients');
        $this->db->limit($limit, $start);
        $this->db->where("Patients.assigned_mo=" . $mo_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_patient_using_cnic($cnic)
    {
        $query = $this->db->get_where('Patients', array('cnic' => $cnic));
        return $query->row_array();
    }

    public function get_patient_using_cnic_of_specific_doctor($cnic, $id)
    {
        $query = $this->db->get_where('Patients', array('cnic' => $cnic, 'assigned_mo' => $id));
        return $query->row_array();
    }

    public function set_prescription($prescription)
    {
        return $this->db->insert('Prescriptions', $prescription);
    }
}
