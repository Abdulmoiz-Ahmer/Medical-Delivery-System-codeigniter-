<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
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


    public function index()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        if ($data["user"]["role_id"] == 1) {
            $this->load->view('assign');
        } elseif ($data["user"]["role_id"] == 2) {
            $this->load->view('myPatients');
        } else if ($data["user"]["role_id"] == 3) {
            $this->load->view('patients');
        }

        $this->load->view('dashboard');
    }


    public function assign()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('assign');
        $this->load->view('dashboard');
    }

    public function allpatients()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('allPatients');
        $this->load->view('dashboard');
    }

    public function session()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('session');
        $this->load->view('dashboard');
    }

    public function mypatients()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('myPatients');
        $this->load->view('dashboard');
    }


    public function patients()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('patients');
        $this->load->view('dashboard');
    }


    public function prescription()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('prescription');
        $this->load->view('dashboard');
    }

    public function requests()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('requests');
        $this->load->view('dashboard');
    }

    public function stock()
    {
        $this->redirectIfNotLoggedIn();
        $data["user"] = $this->session->userdata('user');
        $this->load->view('sidebar', $data);
        $this->load->view('navbar', $data);
        $this->load->view('stock');
        $this->load->view('dashboard');
    }

    private function redirectIfNotLoggedIn()
    {
        if (!$this->session->has_userdata('user')) {
            return redirect(base_url() . 'auth/');
        }
    }

    public function logout()
    {
        redirect(base_url() . '/auth/logout');
    }
}
