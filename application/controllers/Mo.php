<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MO extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load pagination library 
        $this->load->library('pagination');
        // Load post model 
        $this->load->model('mo_model');
        // Per page limit 
        $this->perPage = 10;
    }


    public function index()
    {
        redirect(base_url('Mo/mypatients'));
    }

    public function mypatients()
    {
        $this->redirectIfNotLoggedIn();
        $config = $this->getConfigSetting();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->session->flashdata('reroute');
        $data["user"] = $this->session->userdata('user');
        $this->redirectToAllMyPatients($config, $page, $data);
    }

    private function getConfigSetting()
    {
        $config['base_url'] = base_url('Mo/mypatients');
        $config['uri_segment'] = 3;
        $data["user"] = $this->session->userdata('user');
        $config['total_rows'] = $this->mo_model->get_mypatients_count($data["user"]["id"]);
        $config['per_page'] = $this->perPage;  // it display 10 records on per page
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['last_link'] = false;
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');
        return $config;
    }

    private function redirectToAllMyPatients($config, $page, $data)
    {
        $this->pagination->initialize($config);
        $data['patients'] = $this->mo_model->get_mypatients($data["user"]["id"], $config['per_page'], $page);
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('myPatients');
        $this->load->view('dashboard');
    }

    public function add_prescripiton()
    {
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('cnic', 'Patients Cnic No.', 'required|exact_length[15]|regex_match[/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/]');
        $this->form_validation->set_rules('gdetails', 'Medicines', 'required');
        $this->form_validation->set_rules('intake', 'Intake Duration', 'required');
        $this->form_validation->set_rules('comment', 'Comment', 'required');

        if ($this->form_validation->run() != FALSE) {
            $data['patient'] = $this->mo_model->get_patient_using_cnic($this->input->post('cnic'));
            if (!empty($data['patient'])) {
                $data["patient"] = $this->mo_model->get_patient_using_cnic_of_specific_doctor($this->input->post('cnic'), $data["user"]["id"]);
                if (!empty($data['patient'])) {
                    $prescription = array(
                        'general_details' => $this->input->post('gdetails'),
                        'intake_duration' => $this->input->post('intake'),
                        'mo_comment' => $this->input->post('comment'),
                        'patient_id' => $data["patient"]["id"],
                        'added_by' => $data["user"]["id"]

                    );
                    $status = $this->mo_model->set_prescription($prescription);
                    if ($status == 1 || $status == '1') {
                        $data['growl'] = '1';
                        $data['message'] = 'Prescription successfully created!';
                        $data['clear'] =  true;
                        $data["openModal"] = 0;
                    } else {
                        $data['growl'] = '-1';
                        $data['message'] = 'Something Went Wrong!';
                    }
                } else {
                    $data['growl'] = '-1';
                    $data['message'] = 'This patient is not assigned to doctor!';
                }
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'No Such Patients Exists!';
            }
        } else {
            $data["openAddPrescriptionModal"] = true;
            $data["additionOfPrescription"] = validation_errors();
            $data["previousAddPrescripitionData"] = $this->input->post();
        }
        $this->session->set_flashdata('reroute', $data);
        // redirect(base_url('Mo/mypatients'));
    }

    private function redirectIfNotLoggedIn()
    {
        if (!$this->session->has_userdata('user')) {
            return redirect(base_url() . 'auth/');
        } else {
            $data["user"] = $this->session->userdata('user');
            if ($data["user"]["role_id"] != 2) {
                return redirect(base_url() . 'dashboard/');
            }
        }
    }

    public function logout()
    {
        redirect(base_url() . '/auth/logout');
    }
}
