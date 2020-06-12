<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Receptionist extends CI_Controller
{

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     *	- or -
     * 		http://example.com/index.php/welcome/index
     *	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct()
    {
        parent::__construct();
        // Load pagination library 
        $this->load->library('pagination');
        // Load post model 
        $this->load->model('receptionist_model');
        // Per page limit 
        $this->perPage = 10;
    }

    public function index()
    {
        redirect(base_url('receptionist/allpatients'));
    }

    private function getConfigSetting()
    {
        $config['base_url'] = base_url('receptionist/allpatients');
        $config['uri_segment'] = 3;

        $config['total_rows'] = $this->receptionist_model->get_patients_count();
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

    public function allpatients()
    {
        $this->redirectIfNotLoggedIn();
        $config = $this->getConfigSetting();

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->session->flashdata('reroute');
        $data["user"] = $this->session->userdata('user');
        $this->redirectToAllPatients($config, $page, $data);
    }

    public function deletePatient()
    {
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');

        if ($this->receptionist_model->delete_patient($this->uri->segment(3)) == 1) {
            $data['growl'] = '1';
            $data['message'] = 'Patient Successfully Deleted!';
        } else {
            $data['growl'] = '-1';
            $data['message'] = 'Something went wrong!';
        }
        $this->session->set_flashdata('reroute', $data);
        redirect('receptionist/allpatients');
    }

    private function redirectToAllPatients($config, $page, $data)
    {
        $this->pagination->initialize($config);
        $data['patients'] = $this->receptionist_model->get_patients($config['per_page'], $page);
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('allPatients');
        $this->load->view('dashboard');
    }

    public function store()
    {
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');

        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]|regex_match[/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/]');
        $this->form_validation->set_rules('gender', 'Gender', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('bday', 'Date of Birth', 'required');
        if ($this->form_validation->run() != FALSE) {
            $data['patient'] = $this->receptionist_model->get_patient($this->input->post('email'));
            echo $data['patient'];
            if (empty($data['patient'])) {
                $patient = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'cnic' => $this->input->post('cnic'),
                    'address' => $this->input->post('address'),
                    'gender' => $this->input->post('gender'),
                    'birthday' => $this->input->post('bday'),
                    'registered_by' => $data['user']['id']
                );
                $status = $this->receptionist_model->set_patient($patient);
                if ($status == 1 || $status == '1') {
                    $data['growl'] = '1';
                    $data['message'] = 'Patient successfully created!';
                    $data['clear'] =  true;
                    $data["openModal"] = 0;
                } else {
                    $data['growl'] = '-1';
                    $data['message'] = 'Something Went Wrong!';
                }
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'Patient is already registered with this email!';
            }
        } else {
            $data["openModal"] = 1;
        }
        $this->session->set_flashdata('reroute', $data);
        redirect('receptionist/allpatients');
    }

    private function redirectIfNotLoggedIn()
    {
        if (!$this->session->has_userdata('user')) {
            return redirect(base_url() . 'auth/');
        }
    }
}
