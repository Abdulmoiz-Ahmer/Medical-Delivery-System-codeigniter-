<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Msa extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load pagination library 
        $this->load->library('pagination');

        // Load post model 
        $this->load->model('msa_model');
        // Per page limit 
        $this->perPage = 10;
    }

    private function getPrescriptionConfigSetting()
    {
        $config['base_url'] = base_url('Msa/prescription');
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->msa_model->get_prescription_count();
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

    public function index()
    {
        redirect(base_url("Msa/prescription"));
    }

    public function updateStock()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $data["stockToUpdate"] = $this->msa_model->get_particular_stock($this->uri->segment(3));
        $data["openUpdateStockModal"] = true;
        $data["stockId"] = $this->uri->segment(3);
        $this->session->set_flashdata('reroute', $data);
        redirect(base_url() . 'Msa/stocks');
    }

    public function updateStockData()
    {
        $this->redirectIfNotLoggedIn();
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');
        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/]');
        $this->form_validation->set_rules('weight', 'Weight', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('weight_unit', 'Weight Unit', 'required|in_list[kg,g,mg,mcg]');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('cost_price', 'Cost Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('edate', 'Expiry Date', 'required');
        $this->form_validation->set_rules('mdate', 'Manufacturing Date', 'required');
        if ($this->form_validation->run() != FALSE) {
            $data['stock'] = $this->msa_model->get_particular_stock($this->uri->segment(3));
            if ($data['stock']) {
                $stock = array(
                    'name' => $this->input->post('name'),
                    'weight' => $this->input->post('weight'),
                    'weight_unit' => $this->input->post('weight_unit'),
                    'unit_price' => $this->input->post('unit_price'),
                    'quantity' => $this->input->post('quantity'),
                    'cost_price' => $this->input->post('cost_price'),
                    'date' => $this->input->post('mdate'),
                    'expiry' => $this->input->post('edate'),
                    'updated_by' => $data['user']['id']
                );

                $status = $this->msa_model->update_stock($this->uri->segment(3), $stock);

                if ($status == 1 || $status == '1') {
                    $data['growl'] = '1';
                    $data['message'] = 'Stock successfully updated!';
                } else {
                    $data['growl'] = '-1';
                    $data['message'] = 'Something Went Wrong!';
                }
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'No such stock batch or item Exists';
            }
        } else {
            $data["stockId"] = $this->uri->segment(3);
            $data["updationStockTimeErrors"] = validation_errors();
            $data["openUpdateStockModal"] = true;
            $data["previousUpdationStockData"] = $this->input->post();
        }
        $this->session->set_flashdata('reroute', $data);
        redirect(base_url() . 'Msa/stocks');
    }

    public function sendRequest()
    {
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');

        $data['prescription'] = $this->msa_model->get_particular_prescription($this->uri->segment(3));
        if (!empty($data['prescription'])) {
            if ($data['prescription'][0]['status'] == 1) {
                $this->load->library('email');

                $this->email->initialize(array(
                    'protocol' => 'smtp',
                    'smtp_host' => 'smtp.sendgrid.net',
                    'smtp_user' => 'apikey',
                    'smtp_pass' => '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',
                    'smtp_port' => 587,
                    'crlf' => "\r\n",
                    'newline' => "\r\n"
                ));

                $this->email->from('moiz@mangocoders.com', 'MDS');
                $this->email->to($data['prescription'][0]['email']);
                $this->email->subject('Request to send Medicine...');
                $this->email->message($data['prescription'][0]['general_details']);
                $this->email->send();

                echo $this->email->print_debugger();
                $data['growl'] = '1';
                $data['message'] = 'Request sent to the patient!';
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'Patient is Inactive...';
            }
        } else {
            $data['growl'] = '-1';
            $data['message'] = 'No such patient Exists';
        }

        $this->session->set_flashdata('reroute', $data);
        redirect(base_url() . 'Msa/prescription');
    }

    public function stocks()
    {
        $this->redirectIfNotLoggedIn();
        $config = $this->getStockConfigSetting();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->session->flashdata('reroute');
        $data["user"] = $this->session->userdata('user');
        $this->redirectToAllStocks($config, $page, $data);
    }

    public function prescription()
    {
        $this->redirectIfNotLoggedIn();
        $config = $this->getPrescriptionConfigSetting();
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data = $this->session->flashdata('reroute');
        $data["user"] = $this->session->userdata('user');
        $this->redirectToAllPrescriptions($config, $page, $data);
    }

    public function addStockData()
    {
        $this->redirectIfNotLoggedIn();
        $data['growl'] = '0';
        $data['message'] = '';
        $data["user"] = $this->session->userdata('user');
        $this->load->library('form_validation');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/]');
        $this->form_validation->set_rules('weight', 'Weight', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('weight_unit', 'Weight Unit', 'required|in_list[kg,g,mg,mcg]');
        $this->form_validation->set_rules('unit_price', 'Unit Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('quantity', 'Quantity', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('cost_price', 'Cost Price', 'required|numeric|greater_than[0]');
        $this->form_validation->set_rules('edate', 'Expiry Date', 'required');
        $this->form_validation->set_rules('mdate', 'Manufacturing Date', 'required');

        if ($this->form_validation->run() != FALSE) {
            $stock = array(
                'name' => $this->input->post('name'),
                'weight' => $this->input->post('weight'),
                'weight_unit' => $this->input->post('weight_unit'),
                'unit_price' => $this->input->post('unit_price'),
                'quantity' => $this->input->post('quantity'),
                'cost_price' => $this->input->post('cost_price'),
                'date' => $this->input->post('mdate'),
                'expiry' => $this->input->post('edate'),
                'added_by' => $data['user']['id']
            );
            $status = $this->msa_model->set_stock($stock);
            if ($status == 1 || $status == '1') {
                $data['growl'] = '1';
                $data['message'] = 'Stock successfully created!';
            } else {
                $data['growl'] = '-1';
                $data['message'] = 'Something Went Wrong!';
            }
        } else {
            $data["stockId"] = $this->uri->segment(3);
            $data["additionStockTimeErrors"] = validation_errors();
            $data["openStockAddModal"] = true;
            $data["previousAdditionStockData"] = $this->input->post();
        }

        $this->session->set_flashdata('reroute', $data);
        redirect(base_url('Msa/stocks'));
    }

    public function getStockConfigSetting()
    {
        $config['base_url'] = base_url('Msa/stocks');
        $config['uri_segment'] = 3;
        $config['total_rows'] = $this->msa_model->get_stocks_count();
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

    public function redirectToAllStocks($config, $page, $data)
    {
        $this->pagination->initialize($config);
        $data['stocks'] = $this->msa_model->get_stocks($config['per_page'], $page);
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('stock.php');
        $this->load->view('dashboard');
    }

    public function redirectToAllPrescriptions($config, $page, $data)
    {
        $this->pagination->initialize($config);
        $data['prescriptions'] = $this->msa_model->get_prescriptions($config['per_page'], $page);
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('prescription.php');
        $this->load->view('dashboard');
    }

    private function redirectIfNotLoggedIn()
    {
        if (!$this->session->has_userdata('user')) {
            return redirect(base_url() . 'auth/');
        } else {
            $data["user"] = $this->session->userdata('user');
            if ($data["user"]["role_id"] != 3) {
                return redirect(base_url() . 'dashboard/');
            }
        }
    }
}
