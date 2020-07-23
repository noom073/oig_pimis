<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent:: __construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');

		$isLogged = $this->authentication->check_type_user('user');
		if ($isLogged == false) {
			$this->authentication->go_home();
		}
    }

	public function index() {
		echo 'user';
		$this->load->model('user_model');
		$this->load->model('auth_model');

		// $data = $this->home_model->get_user()->result();
		// var_dump($this->authentication->check_login());

		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/menu');
		$this->load->view('user_view/user_index');
		$this->load->view('foundation_view/footer');
	}
}
