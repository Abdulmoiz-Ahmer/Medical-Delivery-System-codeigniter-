<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
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
		$this->load->model('auth_model');
	}

	public function logout()
	{
		if ($this->session->has_userdata('user')) {
			$this->session->unset_userdata('user');
		}
		return redirect('auth/');
	}

	public function index()
	{
		$this->redirectIfLoggedIn();
		$this->load->view('auth');
	}

	public function login()
	{
		$this->redirectIfLoggedIn();
		$this->load->view('auth');
	}

	public function show()
	{
		$this->redirectIfLoggedIn();
		$data['growl'] = '0';
		$data['message'] = '';
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');

		if ($this->form_validation->run() != FALSE) {
			$user['user'] = $this->auth_model->get_user($this->input->post('email'));
			if (!empty($user['user'])) {

				if (password_verify($this->input->post('password'), $user['user']["password"])) {
					$this->session->set_userdata("user", $user['user']);
					redirect('dashboard/');
					// return $this->load->view('dashboard');
				}
			}

			$data['growl'] = '-1';
			$data['message'] = 'Either Email or Password is Incorrect!';
		}
		$this->load->view('auth', $data);
	}

	public function create()
	{
		$this->redirectIfLoggedIn();
		$data['roles'] = $this->auth_model->get_roles();
		print_r($data);
		$this->load->view('register', $data);
	}

	private function redirectIfLoggedIn()
	{
		if ($this->session->has_userdata('user')) {
			return redirect('dashboard/');
		}
	}

	public function store()
	{
		$data['growl'] = '0';
		$data['message'] = '';
		$data['roles'] = $this->auth_model->get_roles();

		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		$this->form_validation->set_rules('name', 'Name', 'required|regex_match[/^[a-zA-Z]+(?:[\s.]+[a-zA-Z]+)*$/]');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
		$this->form_validation->set_rules('cnic', 'CNIC', 'required|exact_length[15]|regex_match[/^[0-9+]{5}-[0-9+]{7}-[0-9]{1}$/]');
		$this->form_validation->set_rules('department', 'Department', 'required|alpha');
		$this->form_validation->set_rules('designation', 'Designation', 'required|alpha');
		$this->form_validation->set_rules('role', 'Role', 'required|is_natural_no_zero');
		$this->form_validation->set_rules('salary', 'Salary', 'required|regex_match[/^[1-9]\d*(\.\d+)?$/]');
		$this->form_validation->set_rules('jdate', 'Joining Date', 'required');

		if ($this->form_validation->run() != FALSE) {
			$data['user'] = $this->auth_model->get_user($this->input->post('email'));
			if (empty($data['user'])) {
				$options = array("cost" => 10);
				$hashPassword = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $options);
				$employee = array(
					'name' => $this->input->post('name'),
					'email' => $this->input->post('email'),
					'password' => $hashPassword,
					'cnic' => $this->input->post('cnic'),
					'department' => $this->input->post('department'),
					'designation' => $this->input->post('designation'),
					'role_id' => $this->input->post('role'),
					'salary' => $this->input->post('salary'),
					'date_of_joining' => $this->input->post('jdate'),
				);
				$status = $this->auth_model->set_user($employee);
				if ($status == 1 || $status == '1') {
					$data['growl'] = '1';
					$data['message'] = 'User successfully created!';
					$data['clear'] =  true;
				} else {
					$data['growl'] = '-1';
					$data['message'] = 'Something Went Wrong!';
				}
			} else {
				$data['growl'] = '-1';
				$data['message'] = 'User is already registered with this email!';
			}
		}

		$this->load->view('register', $data);
	}
}
