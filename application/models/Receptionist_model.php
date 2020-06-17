<?php
class Receptionist_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_patients($limit, $start = 1)
    {
        $this->db->select('Patients.id as pid,Patients.name as pname,Patients.status, Patients.assigned_mo,Patients.gender,Patients.birthday,Patients.cnic,Patients.email,Patients.address,Patients.email, Employee.name as ename');
        $this->db->from('Patients');
        $this->db->join('Employee', 'Patients.assigned_mo = Employee.id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_patient($id, $data)
    {
        return $this->db->update('Patients', $data, 'id=' . $id);
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

    public function get_particular_patient($id)
    {
        $query = $this->db->get_where('Patients', array('id' => $id));
        return $query->row_array();
    }

    public function get_particular_patient2($id)
    {
        $query = $this->db->get_where('Patients', array('id' => $id));
        if (empty($query->row_array)) {
            return true;
        } else {
            return false;
        }
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

    public function set_session($session)
    {
        return $this->db->insert('Sessions', $session);
    }

    //assign calls
    public function get_doctor($id)
    {
        $query = $this->db->get_where('Employee', array('id' => $id));
        return $query->row_array();
    }

    public function get_patient_using_cnic($cnic)
    {
        $query = $this->db->get_where('Patients', array('cnic' => $cnic));
        return $query->row_array();
    }

    public function get_patient_using_cnic_or_email($cnic, $email)
    {
        $this->db->select('*');
        $this->db->from('Patients');
        $this->db->where('cnic', $cnic);
        $this->db->or_where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function check_whether_patient_has_a_doctor($cnic)
    {
        $query = $this->db->get_where('Patients', array('cnic' => $cnic, 'assigned_mo!=' => NULL));
        return $query->row_array();
    }

    public function get_doctors_count()
    {
        return $this->db->where('role_id', 2)->from("Employee")->count_all_results();
    }

    public function get_patients_sessions()
    {
    }

    public function get_all_sessions_count()
    {
        return $this->db->from("Sessions")->count_all_results();
    }

    public function get_all_sessions_of_patient_count($cnic)
    {
        $result = $this->get_patient_using_cnic($cnic);
        if (!empty($result)) {
            return $this->db->where('p_id', $result["id"])->from("Sessions")->count_all_results();
        }
    }

    public function get_all_sessions($limit, $start = 1)
    {
        $this->db->select('Sessions.id as sid, Sessions.date, Sessions.symptoms,Patients.name as pname, Employee.name as ename');
        $this->db->from('Sessions');
        $this->db->join('Employee', 'Sessions.mo_id = Employee.id', 'left');
        $this->db->join('Patients', 'Sessions.p_id = Patients.id', 'left');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_all_patient_sessions($cnic, $limit, $start = 1)
    {
        $this->db->select('Sessions.id as sid, Sessions.date, Sessions.symptoms,Patients.name as pname, Employee.name as ename');
        $this->db->from('Sessions');
        $this->db->join('Employee', 'Sessions.mo_id = Employee.id', 'left');
        $this->db->join('Patients', 'Sessions.p_id = Patients.id', 'left');
        $this->db->where('Patients.cnic', $cnic);
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
    }


    public function get_doctors($limit, $start = 1)
    {
        $this->db->select('Employee.id,Employee.name, Employee.department, Employee.designation');
        $this->db->from('Employee');
        $this->db->limit($limit, $start);
        $this->db->where('role_id=2');
        $query = $this->db->get();
        return $query->result_array();
    }
}
