<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent:: __construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');
    }

	public function index() {
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('login_view/login_index');
		$this->load->view('foundation_view/footer');
	}

	public function ajax_adlogin_process() {
		$this->load->model('auth_model');

		$rtarfMail 	= $this->input->post('email');
		$password 	= $this->input->post('password');

		$checkADReturn 	= $this->authentication->check_ad($rtarfMail, $password);
		$loginData 	= $this->authentication->login_process($checkADReturn);

		echo json_encode($loginData);
	}
	
	public function logout() {
		$this->session->sess_destroy();
		redirect('login/index');
	}
}
