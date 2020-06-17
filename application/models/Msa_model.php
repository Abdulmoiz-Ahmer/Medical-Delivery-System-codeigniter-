<?php
class Msa_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_prescription_count()
    {
        return $this->db->count_all('Prescriptions');
    }

    public function get_prescriptions($limit, $start = 1)
    {
        $this->db->select('Prescriptions.id as pr_id, Prescriptions.general_details, Prescriptions.mo_comment ,Prescriptions.intake_duration, Prescriptions.create_date, Patients.id as pid, Patients.name, Patients.email, Patients.address, Patients.status,Employee.name as dname');
        $this->db->from('Prescriptions');
        $this->db->join('Patients', 'Prescriptions.patient_id = Patients.id', 'left');
        $this->db->join('Employee', 'Prescriptions.added_by = Employee.id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function set_stock($stock)
    {
        return $this->db->insert('Stock', $stock);
    }

    public function get_particular_stock($id)
    {
        $this->db->select('*');
        $this->db->from('Stock');
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_stock($id, $data)
    {
        return $this->db->update('Stock', $data, 'id=' . $id);
    }


    public function get_particular_prescription($id)
    {
        $this->db->select('Prescriptions.id as pr_id,Prescriptions.general_details,  Patients.email, Patients.status');
        $this->db->from('Prescriptions');
        $this->db->join('Patients', 'Prescriptions.patient_id = Patients.id', 'left');
        $this->db->where('Prescriptions.id', $id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_stocks($limit, $start = 1)
    {
        $this->db->select('*');
        $this->db->from('Stock');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_stocks_count()
    {
        return $this->db->count_all('Stock');
    }
}
