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
        if ($data["user"]["role_id"] == 1) {
            $this->assign();
        } elseif ($data["user"]["role_id"] == 2) {
            $this->mypatients();
        } else if ($data["user"]["role_id"] == 3) {
            $this->patients();
        } else if ($data["user"]["role_id"] == 4) {
            $this->admin();
        }
    }


    public function admin()
    {
        $this->redirectIfNotLoggedIn();
        return redirect(base_url() . 'admin/');
    }

    public function assign()
    {
        $this->redirectIfNotLoggedIn();
        return redirect(base_url() . 'receptionist/allDoctors');
    }

    public function allpatients()
    {
        $this->redirectIfNotLoggedIn();
        return redirect(base_url() . 'receptionist/allpatients');
    }

    public function session()
    {
        $this->redirectIfNotLoggedIn();
        return redirect(base_url() . 'receptionist/session');
    }

    public function mypatients()
    {
        $this->redirectIfNotLoggedIn();
        return redirect(base_url() . 'Mo/mypatients');
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
