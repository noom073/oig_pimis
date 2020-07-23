<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

    public function __construct() {
        parent:: __construct();

		$this->load->helper('url');
		$this->load->library('session');
    }

	public function index() {
		$this->load->view('foundation_view/header');
		$this->load->view('foundation_view/navbar_basic');
		$this->load->view('main_view/main_index');
		$this->load->view('foundation_view/footer');
	}
}
