<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{

    private function getConfigSetting()
    {
        $config['base_url'] = base_url('admin/employees');
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->admin_model->get_employee_count();
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


    private function redirectToAllEmployee($config, $page, $data)
    {
        $this->pagination->initialize($config);
        $data['employees'] = $this->admin_model->get_employees($config['per_page'], $page);
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('admin');
        $this->load->view('dashboard');
    }

    private function redirectIfNotLoggedIn()
    {
        if (!$this->session->has_userdata('user')) {
            return redirect(base_url() . 'auth/');
        }
    }

    public function employees()
    {
        $this->redirectIfNotLoggedIn();
        $config = $this->getConfigSetting();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->session->flashdata('reroute');
        $data["user"] = $this->session->userdata('user');
        $this->redirectToAllEmployee($config, $page, $data);
    }

    public function __construct()
    {
        parent::__construct();
        // Load pagination library 
        $this->load->library('pagination');
        // Load post model 
        $this->load->model('admin_model');
        // Per page limit 
        $this->perPage = 10;
    }

    public function index()
    {
        redirect(base_url('admin/employees'));
    }

    public function updateEmployee()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $data["employeeToUpdate"] = $this->admin_model->get_particular_employee($this->uri->segment(3));
        $data["openUpdateEmployeeModal"] = true;
        $data["roles"] = $this->admin_model->get_roles();
        $data["employeeId"] = $this->uri->segment(3);
        $this->session->set_flashdata('reroute', $data);
        redirect(base_url() . 'admin/employees');
    }


    public function updateEmployeeData()
    {
        $data['growl'] = '0';
        $data['message'] = '';
        $data["roles"] = $this->admin_model->get_roles();
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/]');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('department', 'Department', 'required|alpha');
        $this->form_validation->set_rules('designation', 'Designation', 'required|alpha');
        $this->form_validation->set_rules('role', 'Role', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('salary', 'Salary', 'required|regex_match[/^[1-9]\d*(\.\d+)?$/]');
        $this->form_validation->set_rules('jdate', 'Joining Date', 'required');
        if ($this->form_validation->run() != FALSE) {
            $data['employee'] = $this->admin_model->get_particular_employee($this->uri->segment(3));
            if (!empty($data['employee'])) {
                $employee = array(
                    'name' => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'department' => $this->input->post('department'),
                    'designation' => $this->input->post('designation'),
                    'role_id' => $this->input->post('role'),
                    'salary' => $this->input->post('salary'),
                    'date_of_joining' => $this->input->post('jdate'),
                );
                $status = $this->admin_model->update_employee($this->uri->segment(3), $employee);
                if ($status == 1 || $status == '1') {
                    $data['growl'] = '1';
                    $data['message'] = 'Employee successfully updated!';
                } else {
                    $data['growl'] = '-1';
                    $data['message'] = 'Something Went Wrong!';
                }
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'No Such Employee Exists!';
            }
        } else {
            $data["openUpdateEmployeeModal"] = true;
            $data["updationOfEmployeeTimeErrors"] = validation_errors();
            $data["previousUpdationEmployeeData"] = $this->input->post();
        }
        $this->session->set_flashdata('reroute', $data);
        redirect(base_url('admin/employees'));
    }

    public function deleteEmployee()
    {
        $this->redirectIfNotLoggedIn();
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');

        if ($this->admin_model->delete_employee($this->uri->segment(3)) == 1) {
            $data['growl'] = '1';
            $data['message'] = 'Employee Successfully Deleted!';
        } else {
            $data['growl'] = '-1';
            $data['message'] = 'Something went wrong!';
        }
        $this->session->set_flashdata('reroute', $data);
        redirect(base_url() . 'admin/employees');
    }
}
