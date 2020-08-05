<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auditor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('authentication');

		// $isLogged = $this->authentication->check_type_user('admin');
		// if ($isLogged == false) {
		// 	$this->authentication->go_home();
		// }
	}

	public function index() {
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');		
        $this->load->view('auditor_view/auditor_menu');
        $this->load->view('auditor_view/auditor_index');
        $this->load->view('foundation_view/footer');
	}
}
